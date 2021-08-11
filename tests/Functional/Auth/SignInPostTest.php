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
    protected $uri = 'api/auth/sign-in';

    public function test()
    {
        $this->factory(User::class)->create([
            'id' => 1,
            'email' => $this->faker->email,
            'password' => bcrypt('abcdef'),
        ]);
        $this->factory(User::class)->create([
            'id' => 2,
            'email' => 'abc123@example.com',
            'password' => bcrypt('bcdefg'),
        ]);
        $this->factory(User::class)->create([
            'id' => 3,
            'email' => $this->faker->email,
            'password' => bcrypt('cdefgh'),
        ]);

        $this->when(function () {
            $this->setInputParameter('email', 'abc123@example.com');
            $this->setInputParameter('password', 'bcdefg');

            $this->assertResult(User::find(2));
            $this->assertEquals(auth()->user(), User::find(2));
        });
    }

    public function testErrorEmailRuleEmail()
    {
        $this->when(function () {
            $this->setInputParameter('email', 'abcd');

            $this->assertError('[email] must be a valid email address.');
        });
    }

    public function testErrorRequiredRuleEmail()
    {
        $this->when(function () {
            $this->assertError('[email] is required.');
        });
    }

    public function testErrorRequiredRulePassword()
    {
        $this->when(function () {
            $this->assertError('[password] is required.');
        });
    }
}
