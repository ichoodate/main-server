<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

return (new Config())
    ->setRules([
        '@PhpCsFixer' => true,
    ])
    ->setFinder(
        Finder::create()
            ->in(__DIR__.DIRECTORY_SEPARATOR.'app')
            ->in(__DIR__.DIRECTORY_SEPARATOR.'tests')
    )
;
