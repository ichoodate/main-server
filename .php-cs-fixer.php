<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

return (new Config())
    ->setRules([
        '@PhpCsFixer' => true,
        'ordered_imports' => [
            'sort_algorithm' => 'alpha',
        ],
    ])
    ->setFinder(
        Finder::create()
            ->in(__DIR__.DIRECTORY_SEPARATOR.'app')
            ->in(__DIR__.DIRECTORY_SEPARATOR.'bootstrap')
            ->in(__DIR__.DIRECTORY_SEPARATOR.'config')
            ->in(__DIR__.DIRECTORY_SEPARATOR.'database')
            ->in(__DIR__.DIRECTORY_SEPARATOR.'routes')
            ->in(__DIR__.DIRECTORY_SEPARATOR.'tests')
    )
;
