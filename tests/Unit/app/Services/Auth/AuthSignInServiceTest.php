<?php

namespace Tests\Unit\App\Services\Auth;

use App\Database\Models\Obj;
use App\Database\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\_InstanceMocker as InstanceMocker;
use Tests\Unit\App\Services\_TestCase;
use Tests\Unit\App\Database\Models\_Mocker as ModelMocker;
use Tests\Unit\App\Database\Queries\_Mocker as QueryMocker;

class AuthSignInServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
            'result' => 'user for {{email}} and {{password}}'
        ]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([
            'email'
                => ['required', 'email'],

            'password'
                => ['required', 'string'],

            'result'
                => ['not_null']
        ]);
    }

    public function testLoaderIsSignedIn()
    {
        $this->when(function ($proxy, $serv) {

            $email    = 'abcd@gmail.com';
            $password = '1234';
            $user     = $this->factory(User::class)->create([
                'email' => $email,
                'password' => $password,
            ]);

            $proxy->data->put('email', $email);
            $proxy->data->put('password', $password);

            $this->verifyLoader($serv, 'is_signed_in', true);
        });

        $this->when(function ($proxy, $serv) {

            $email    = 'abcd@gmail.com';
            $password = '1234';

            $this->factory(User::class)->create([
                'email' => $email,
                'password' => '2345',
            ]);

            $proxy->data->put('email', $email);
            $proxy->data->put('password', $password);

            $this->verifyLoader($serv, 'is_signed_in', false);
        });

        $this->when(function ($proxy, $serv) {

            $email    = 'abcd@gmail.com';
            $password = '1234';

            $this->factory(User::class)->create([
                'email' => 'bcde@gmail.com',
                'password' => $password,
            ]);

            $proxy->data->put('email', $email);
            $proxy->data->put('password', $password);

            $this->verifyLoader($serv, 'is_signed_in', false);
        });
    }

    public function testArrTraits()
    {
        $this->verifyArrTraits([
        ]);
    }

}