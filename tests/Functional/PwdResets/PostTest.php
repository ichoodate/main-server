<?php

namespace Tests\Functional\PwdResets;

use App\Models\PwdReset;
use App\Models\User;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class PostTest extends _TestCase
{
    protected $uri = 'pwd-resets';

    public function test()
    {
        User::factory()->create([
            User::ID => 1,
            User::EMAIL => 'abcd@gmail.com',
        ]);

        $this->when(function () {
            $this->setInputParameter('email', 'abcd@gmail.com');

            $this->runService();

            $this->assertResultWithPersisting(new PwdReset([
                PwdReset::EMAIL => 'abcd@gmail.com',
                PwdReset::COMPLETE => false,
            ]));
        });
    }

    public function testErrorEmailRuleEmail()
    {
        $this->when(function () {
            $this->setInputParameter('email', 'abcd');

            $this->runService();

            $this->assertError('[email] must be a valid email address.');
        });
    }

    public function testErrorNotNullRuleUser()
    {
        User::factory()->create([
            User::ID => 1,
            User::EMAIL => 'abcd@gmail.com',
        ]);

        $this->when(function () {
            $this->setInputParameter('email', 'bcde@gmail.com');

            $this->runService();

            $this->assertError('user for [email] must exist.');
        });
    }

    public function testErrorRequiredRuleEmail()
    {
        $this->when(function () {
            $this->runService();

            $this->assertError('[email] is required.');
        });
    }
}
