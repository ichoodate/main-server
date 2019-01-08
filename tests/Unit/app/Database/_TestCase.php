<?php

namespace Tests\Unit\App\Database;

use Tests\Unit\_TestCase as TestCase;

abstract class _TestCase extends TestCase {

    // abstract public static function testTestMethodExists();

    public static function verifyTestMethodExists($appendix)
    {
        $allMethods = static::ref(static::class())->getMethods();

        foreach ( $allMethods as $method )
        {
            $isSrcMethod    = $method->class == static::class();
            $isQueryMethod  = ends_with($method->name, $appendix);
            $testMethodName = 'test' . ucfirst($method->name);
            $hasTestMethod  = method_exists(static::class, $testMethodName);

            if ( $isSrcMethod && $isQueryMethod )
            {
                static::assertTrue($hasTestMethod,
                    $testMethodName . ' is required'
                );
            }
        }

        static::success();
    }

}
