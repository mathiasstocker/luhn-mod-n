<?php

declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use S4A\LuhnModN\LuhnModN;

/**
 * @internal
 */
final class LuhnModNTest extends TestCase
{
    public function testCreateChecksumBase2(): void
    {
        $luhn = new LuhnModN();

        self::assertEquals('00', $luhn->createChecksum('0', 2));
        self::assertEquals('0', $luhn->createChecksum('0', 2, false));

        self::assertEquals('10010011001011000000010110100100', $luhn->createChecksum('1001001100101100000001011010010', 2));
        self::assertEquals('0', $luhn->createChecksum('1001001100101100000001011010010', 2, false));
    }

    public function testCreateChecksumBase10(): void
    {
        $luhn = new LuhnModN();

        self::assertEquals('00', $luhn->createChecksum('0', 10));
        self::assertEquals('0', $luhn->createChecksum('0', 10, false));

        self::assertEquals('12345678903', $luhn->createChecksum('1234567890', 10));
        self::assertEquals('3', $luhn->createChecksum('1234567890', 10, false));
    }

    public function testCreateChecksumBase16(): void
    {
        $luhn = new LuhnModN();

        self::assertEquals('00', $luhn->createChecksum('0', 16));
        self::assertEquals('0', $luhn->createChecksum('0', 16, false));

        self::assertEquals('499602d2f', $luhn->createChecksum('499602d2', 16));
        self::assertEquals('f', $luhn->createChecksum('499602d2', 16, false));
    }

    public function testCreateChecksumBase37(): void
    {
        $luhn = new LuhnModN();

        self::assertEquals('00', $luhn->createChecksum('0', 36));
        self::assertEquals('0', $luhn->createChecksum('0', 36, false));

        self::assertEquals('kf12ois', $luhn->createChecksum('kf12oi', 36));
        self::assertEquals('s', $luhn->createChecksum('kf12oi', 36, false));
    }
}
