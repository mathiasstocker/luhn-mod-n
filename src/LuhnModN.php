<?php

namespace S4A\LuhnModN;

class LuhnModN
{
    /**
     * @param int|string $number      a number without checksum in the base defined with $base
     * @param int        $base        The base to work in. The given $number has to be in this base and the return value will be in this base.
     *                                Valid values: 2 - 36
     * @param bool       $concatenate If this value is set to true, the given number with the concatenated checksum will be returned.
     *                                If this value is false only the checksum will be returned.
     *
     * @return string the given number with the checksum or the checksum (see $concatenate) in the given $base
     */
    public function createChecksum(int|string $number, int $base, bool $concatenate = true): string
    {
        $number = (string) $number;
        $factor = 2;
        $sum = 0;

        for ($i = strlen($number) - 1; $i >= 0; --$i) {
            $character = substr($number, $i, 1);
            $codePoint = (int) base_convert($character, $base, 10);
            $addend = $factor * $codePoint;
            $factor = 2 === $factor ? 1 : 2;
            $addend = intdiv($addend, $base) + ($addend % $base);
            $sum += $addend;
        }

        $remainder = $sum % $base;
        $checksumBase10 = ($base - $remainder) % $base;

        $checksum = base_convert((string) $checksumBase10, 10, $base);

        if (!$concatenate) {
            return $checksum;
        }

        return $number.$checksum;
    }

    /**
     * @param string $number a number with checksum in the base defined with $base
     * @param int    $base   The base to work in. The given $number has to be in this base and the return value will be in this base.
     *                       Valid values: 2 - 36
     *
     * @return bool Returns true if the given number has a valid luhn checksum, false otherwise
     */
    public function hasValidChecksum(string $number, int $base): bool
    {
        $checksum = substr($number, -1);
        $numberWithoutChecksum = substr($number, 0, -1);

        return $checksum === $this->createChecksum($numberWithoutChecksum, $base, false);
    }
}
