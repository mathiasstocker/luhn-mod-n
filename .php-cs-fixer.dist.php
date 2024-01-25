<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$finder = (new Finder())
    ->in(__DIR__)
    ->exclude('vendor')
;

return (new Config())
    ->setRules([
        '@PhpCsFixer' => true,
        'php_unit_test_class_requires_covers' => false,
    ])
    ->setRiskyAllowed(true)
    ->setFinder($finder)
;
