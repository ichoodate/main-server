<?php

namespace Tests\Feature;

use Tests\_TestCase as TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

abstract class _TestCase extends TestCase {

    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();

        app('db')->statement('SET FOREIGN_KEY_CHECKS=0');
    }

    public function tearDown()
    {
        app('db')->statement('SET FOREIGN_KEY_CHECKS=1');

        parent::tearDown();
    }

}
