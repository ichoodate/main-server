<?php

namespace Tests\Functional\PwdResets;

use App\Models\PwdReset;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class PutTest extends _TestCase
{
    protected $uri = 'pwd-resets/{id}';

    public function test()
    {
        User::factory()->create([
            User::ID => 1,
            User::EMAIL => 'abcd@gmail.com',
        ]);
        PwdReset::factory()->create([
            PwdReset::ID => 11,
            PwdReset::TOKEN => 'de99a620c50f2990e87144735cd357e7',
            PwdReset::EMAIL => 'abcd@gmail.com',
            PwdReset::COMPLETE => false,
        ]);

        $this->when(function () {
            $this->setRouteParameter('id', 11);
            $this->setInputParameter('token', 'de99a620c50f2990e87144735cd357e7');
            $this->setInputParameter('new_password', 'abcdef');

            $this->assertResultWithPersisting(new PwdReset([
                PwdReset::ID => 11,
                PwdReset::TOKEN => 'de99a620c50f2990e87144735cd357e7',
                PwdReset::EMAIL => 'abcd@gmail.com',
                PwdReset::COMPLETE => true,
            ]));

            $this->assertTrue(Hash::check('abcdef', User::find(1)->password));
            $this->assertTrue(auth()->attempt([
                User::EMAIL => 'abcd@gmail.com',
                User::PASSWORD => 'abcdef',
            ]));
        });
    }

    public function testErrorFalseRuleResultComplete()
    {
        PwdReset::factory()->create([
            PwdReset::ID => 11,
            PwdReset::TOKEN => 'de99a620c50f2990e87144735cd357e7',
            PwdReset::EMAIL => 'abcd@gmail.com',
            PwdReset::COMPLETE => true,
        ]);

        $this->when(function () {
            $this->setRouteParameter('id', 11);
            $this->setInputParameter('token', 'de99a620c50f2990e87144735cd357e7');

            $this->assertError('completion of password reset for 11 must be false.');
        });
    }

    public function testErrorIntegerRuleId()
    {
        $this->when(function () {
            $this->setRouteParameter('id', 'abcd');

            $this->assertError('abcd must be an integer.');
        });
    }

    public function testErrorNotNullRuleResult()
    {
        PwdReset::factory()->create([
            PwdReset::ID => 11,
            PwdReset::TOKEN => 'de99a620c50f2990e87144735cd357e7',
            PwdReset::EMAIL => 'abcd@gmail.com',
        ]);

        $this->when(function () {
            $this->setRouteParameter('id', 12);

            $this->assertError('password reset for 12 must exist.');
        });
    }

    public function testErrorRequiredRuleNewPassword()
    {
        $this->when(function () {
            $this->assertError('[new_password] is required.');
        });
    }

    public function testErrorRequiredRuleToken()
    {
        $this->when(function () {
            $this->assertError('[token] is required.');
        });
    }

    public function testErrorSameRuleResultToken()
    {
        PwdReset::factory()->create([
            PwdReset::ID => 11,
            PwdReset::TOKEN => 'de99a620c50f2990e87144735cd357e7',
            PwdReset::EMAIL => 'abcd@gmail.com',
        ]);

        $this->when(function () {
            $this->setRouteParameter('id', 11);
            $this->setInputParameter('token', 'e99a654735cd320c508714f2990ed7e7');

            $this->assertError('token of password reset for 11 and [token] must match.');
        });
    }

    public function testErrorStringRuleNewPassword()
    {
        $this->when(function () {
            $this->setInputParameter('new_password', [1, 2, 3, 4]);

            $this->assertError('[new_password] must be a string.');
        });
    }

    public function testErrorStringRuleToken()
    {
        $this->when(function () {
            $this->setInputParameter('token', [1, 2, 3, 4]);

            $this->assertError('[token] must be a string.');
        });
    }
}
