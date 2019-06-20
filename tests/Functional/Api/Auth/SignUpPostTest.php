<?php

namespace Tests\Functional\Api\Auth;

use App\Database\Models\Balance;
use App\Database\Models\User;
use Tests\Functional\_TestCase;

class SignUpPostTest extends _TestCase {

    protected $uri = 'api/auth/sign-up';

    public function test()
    {
        $this->when(function () {

            $birth    = $this->faker->date;
            $gender   = $this->faker->randomElement(User::GENDER_VALUES);
            $password = $this->faker->word;
            $email    = $this->faker->email;
            $name     = $this->faker->name;

            $this->setInputParameter('birth', $birth);
            $this->setInputParameter('gender', $gender);
            $this->setInputParameter('password', $password);
            $this->setInputParameter('email', $email);
            $this->setInputParameter('name', $name);

            $this->assertResultWithPersisting(new User([
                User::BIRTH
                    => $birth,
                User::GENDER
                    => $gender,
                // User::PASSWORD
                //     => $password,
                User::NAME
                    => $name,
                User::EMAIL
                    => $email
            ]));

            $this->assertPersistence(new Balance([
                Balance::USER_ID
                    => 1,
                Balance::TYPE
                    => Balance::TYPE_BASIC,
                Balance::COUNT
                    => 0,
                Balance::DELETED_AT
                    => '9999-12-31 23:59:59'
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

    public function testErrorInRuleGender()
    {
        $this->when(function () {

            $this->setInputParameter('gender', 'abcd');

            $this->assertError('[gender] is invalid.');
        });
    }

    public function testErrorMinRulePassword()
    {
        $this->when(function () {

            $this->setInputParameter('password', 'abcd');

            $this->assertError('[password] must be at least 6 characters.');
        });
    }

    public function testErrorNotNullRuleSameEmailUser()
    {
        $this->factory(User::class)->create([
            User::EMAIL
                => 'abcd@gmail.com'
        ]);

        $this->when(function () {

            $gender   = User::GENDER_MAN;
            $password = 'some password';
            $email    = 'abcd@gmail.com';
            $name     = 'john smith';

            $this->setInputParameter('gender', $gender);
            $this->setInputParameter('password', $password);
            $this->setInputParameter('email', $email);
            $this->setInputParameter('name', $name);

            $this->assertError('same email user for [email] must not exist.');
        });
    }

    public function testErrorRequiredRuleEmail()
    {
        $this->when(function () {

            $this->assertError('[email] is required.');
        });
    }

    public function testErrorRequiredRuleGender()
    {
        $this->when(function () {

            $this->assertError('[gender] is required.');
        });
    }

    public function testErrorRequiredRuleName()
    {
        $this->when(function () {

            $this->assertError('[name] is required.');
        });
    }

    public function testErrorRequiredRulePassword()
    {
        $this->when(function () {

            $this->assertError('[password] is required.');
        });
    }

    public function testErrorStringRuleEmail()
    {
        $this->when(function () {

            $this->setInputParameter('email', ['abcd']);

            $this->assertError('[email] must be a string.');
        });
    }

    public function testErrorStringRuleGender()
    {
        $this->when(function () {

            $this->setInputParameter('gender', ['abcd']);

            $this->assertError('[gender] must be a string.');
        });
    }

    public function testErrorStringRuleName()
    {
        $this->when(function () {

            $this->setInputParameter('name', ['abcd']);

            $this->assertError('[name] must be a string.');
        });
    }

    public function testErrorStringRulePassword()
    {
        $this->when(function () {

            $this->setInputParameter('password', ['abcd']);

            $this->assertError('[password] must be a string.');
        });
    }

}
