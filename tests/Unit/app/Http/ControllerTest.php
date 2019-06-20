<?php

namespace Tests\Unit\App\Http;

use Tests\Unit\_TestCase;

class ControllerTest extends _TestCase {

    public function testAllTestFileExist()
    {
        $dir   = new \RecursiveDirectoryIterator('app/Http/Controllers');
        $list  = new \RecursiveIteratorIterator($dir);
        $files = new \RegexIterator($list, '/\.php$/');

        foreach( $files as $file )
        {
            $totalPath = './tests/Unit/' . $file->getPath() . '/' . $file->getBasename('.php') . 'Test.php';

            $this->assertTrue(file_exists($totalPath), $totalPath);
        }
    }

}
