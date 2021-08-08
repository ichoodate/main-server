<?php

namespace Tests\Functional\PwdResets;

use App\Database\Models\User;
use App\Database\Models\PwdReset;
use Tests\Functional\_TestCase;

class PostTest extends _TestCase {

    protected $uri = 'api/pwd-resets';

    public function test()
    {
        $this->factory(User::class)->create([
            User::ID => 1,
            User::EMAIL => 'abcd@gmail.com'
        ]);

        $this->when(function () {

            $this->setInputParameter('email', 'abcd@gmail.com');

            $this->assertResultWithPersisting(new PwdReset([
                PwdReset::EMAIL => 'abcd@gmail.com',
                PwdReset::COMPLETE => false
            ]));
        });
    }

    public function testErrorEmailRuleEmail()
    {
        $this->when(function () {

            $this->setInputParameter('email', 'abcd');

            $this->assertError('[email] must be a valid email address.');
        });
    }

    public function testErrorNotNullRuleUser()
    {
        $this->factory(User::class)->create([
            User::ID => 1,
            User::EMAIL => 'abcd@gmail.com'
        ]);

        $this->when(function () {

            $this->setInputParameter('email', 'bcde@gmail.com');

            $this->assertError('user for [email] must exist.');
        });
    }

    public function testErrorRequiredRuleEmail()
    {
        $this->when(function () {

            $this->assertError('[email] is required.');
        });
    }

}
