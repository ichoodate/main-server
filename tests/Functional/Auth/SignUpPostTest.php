<?php

namespace Tests\Functional\Auth;

use App\Models\Balance;
use App\Models\User;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class SignUpPostTest extends _TestCase
{
    protected $uri = 'auth/sign-up';

    public function test()
    {
        $this->when(function () {
            $birth = $this->faker->date;
            $gender = $this->faker->randomElement(User::GENDER_VALUES);
            $password = $this->faker->regexify('[A-Za-z]{12}');
            $email = $this->faker->email;
            $name = $this->faker->name;

            $this->setInputParameter('birth', $birth);
            $this->setInputParameter('gender', $gender);
            $this->setInputParameter('password', $password);
            $this->setInputParameter('email', $email);
            $this->setInputParameter('name', $name);

            $this->runService();

            $this->assertResultWithPersisting(new User([
                User::BIRTH => $birth,
                User::GENDER => $gender,
                User::PASSWORD => $password,
                User::NAME => $name,
                User::EMAIL => $email,
            ]));
            $this->assertPersistence(new Balance([
                Balance::USER_ID => User::where('email', $email)->first()->getKey(),
                Balance::TYPE => 'basic',
                Balance::COUNT => 0,
                Balance::DELETED_AT => null,
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

    public function testErrorInRuleGender()
    {
        $this->when(function () {
            $this->setInputParameter('gender', 'abcd');

            $this->runService();

            $this->assertError('[gender] is invalid.');
        });
    }

    public function testErrorMinRulePassword()
    {
        $this->when(function () {
            $this->setInputParameter('password', 'abcd');

            $this->runService();

            $this->assertError('[password] must be at least 6 characters.');
        });
    }

    public function testErrorNotNullRuleSameEmailUser()
    {
        User::factory()->create([
            User::EMAIL => 'abcd@gmail.com',
        ]);

        $this->when(function () {
            $gender = User::GENDER_MAN;
            $password = 'some password';
            $email = 'abcd@gmail.com';
            $name = 'john smith';

            $this->setInputParameter('gender', $gender);
            $this->setInputParameter('password', $password);
            $this->setInputParameter('email', $email);
            $this->setInputParameter('name', $name);

            $this->runService();

            $this->assertError('same email user for [email] must not exist.');
        });
    }

    public function testErrorRequiredRuleEmail()
    {
        $this->when(function () {
            $this->runService();

            $this->assertError('[email] is required.');
        });
    }

    public function testErrorRequiredRuleGender()
    {
        $this->when(function () {
            $this->runService();

            $this->assertError('[gender] is required.');
        });
    }

    public function testErrorRequiredRuleName()
    {
        $this->when(function () {
            $this->runService();

            $this->assertError('[name] is required.');
        });
    }

    public function testErrorRequiredRulePassword()
    {
        $this->when(function () {
            $this->runService();

            $this->assertError('[password] is required.');
        });
    }

    public function testErrorStringRuleEmail()
    {
        $this->when(function () {
            $this->setInputParameter('email', ['abcd']);

            $this->runService();

            $this->assertError('[email] must be a string.');
        });
    }

    public function testErrorStringRuleGender()
    {
        $this->when(function () {
            $this->setInputParameter('gender', ['abcd']);

            $this->runService();

            $this->assertError('[gender] must be a string.');
        });
    }

    public function testErrorStringRuleName()
    {
        $this->when(function () {
            $this->setInputParameter('name', ['abcd']);

            $this->runService();

            $this->assertError('[name] must be a string.');
        });
    }

    public function testErrorStringRulePassword()
    {
        $this->when(function () {
            $this->setInputParameter('password', ['abcd']);

            $this->runService();

            $this->assertError('[password] must be a string.');
        });
    }
}
