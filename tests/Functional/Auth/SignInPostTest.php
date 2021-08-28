<?php

namespace Tests\Functional\Auth;

use App\Models\User;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class SignInPostTest extends _TestCase
{
    protected $uri = 'auth/sign-in';

    public function test()
    {
        User::factory()->create([
            'id' => 1,
            'email' => $this->faker->email,
            'password' => 'abcdef',
        ]);
        User::factory()->create([
            'id' => 2,
            'email' => 'abc123@example.com',
            'password' => 'bcdefg',
        ]);
        User::factory()->create([
            'id' => 3,
            'email' => $this->faker->email,
            'password' => 'cdefgh',
        ]);

        $this->when(function () {
            $this->setInputParameter('email', 'abc123@example.com');
            $this->setInputParameter('password', 'bcdefg');

            $this->runService();

            $this->assertIsString($this->data['result']);
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

    public function testErrorRequiredRuleEmail()
    {
        $this->when(function () {
            $this->runService();

            $this->assertError('[email] is required.');
        });
    }

    public function testErrorRequiredRulePassword()
    {
        $this->when(function () {
            $this->runService();

            $this->assertError('[password] is required.');
        });
    }
}
