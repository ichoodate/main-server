<?php

namespace Tests\Unit\App\Services\Auth;

use App\Database\Models\Photo;
use App\Database\Models\Role;
use App\Database\Models\User;
use App\Database\Models\Balance;
use App\Services\CreatingService;
use App\Services\FacePhoto\FacePhotoCreatingService;
use App\Services\UserIdealTypeKwdPvt\UserIdealTypeKwdPvtMergingService;
use App\Services\ProfilePhoto\ProfilePhotoCreatingService;
use App\Services\UserSelfKwdPvt\UserSelfKwdPvtMergingService;
use Illuminate\Support\Facades\Hash;
use Tests\_InstanceMocker as InstanceMocker;
use Tests\Unit\App\Services\_TestCase;
use Tests\Unit\App\Database\Models\_Mocker as ModelMocker;
use Tests\Unit\App\Database\Queries\_Mocker as QueryMocker;

class AuthSignUpServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
            'result'
                => 'created user',

            'same_email_user'
                => 'same email user for {{email}}'
        ]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([
            'email'
                => ['required', 'string', 'email'],

            'gender'
                => ['required', 'string', 'in:' . implode(',', User::GENDER_VALUES)],

            'name'
                => ['required', 'string'],

            'password'
                => ['required', 'string', 'min:6'],

            'same_email_user'
                => ['null']
        ]);
    }

    public function testArrTraits()
    {
        $this->verifyArrTraits([
            CreatingService::class
        ]);
    }

    public function testCallbackCreated()
    {
        $this->when(function ($proxy, $serv) {

            $created = $this->factory(User::class)->make();

            $proxy->data->put('created', $created);

            $this->verifyCallback($serv, 'created');

            $this->assertEquals($created, auth()->getUser());
        });
    }

    public function testLoaderBalance()
    {
        $this->when(function ($proxy, $serv) {

            $balance = $this->mMock();
            $result  = $this->factory(User::class)->make();
            $return  = $this->uniqueString();

            InstanceMocker::add(Balance::class, $balance);
            ModelMocker::create($balance, [
                Balance::USER_ID
                    => $result->getKey(),
                Balance::COUNT
                    => 0,
                Balance::DELETED_AT
                    => null
            ], $return);

            $proxy->data->put('result', $result);

            $this->verifyLoader($serv, 'balance', $return);
        });
    }

    public function testLoaderCreated()
    {
        $this->when(function ($proxy, $serv) {

            $user     = $this->mMock();
            $return   = $this->uniqueString();
            $email    = $this->uniqueString();
            $name     = $this->uniqueString();
            $password = $this->uniqueString();
            $gender   = $this->uniqueString();
            $hash     = $this->mMock();

            $hash->shouldReceive('make')->with($password)->andReturn('abcd');

            Hash::swap($hash);
            InstanceMocker::add(User::class, $user);
            ModelMocker::create($user, [
                User::EMAIL_VERIFIED
                    => false,
                User::EMAIL
                    => $email,
                User::GENDER
                    => $gender,
                User::NAME
                    => $name,
                User::PASSWORD
                    => 'abcd'
            ], $return);

            $proxy->data->put('email',    $email);
            $proxy->data->put('password', $password);
            $proxy->data->put('gender',   $gender);
            $proxy->data->put('name',     $name);

            $this->verifyLoader($serv, 'created', $return);
        });
    }

    public function testLoaderSameEmailUser()
    {
        $this->when(function ($proxy, $serv) {

            $user      = $this->mMock();
            $userQuery = $this->mMock();
            $email     = $this->uniqueString();
            $return    = $this->uniqueString();

            InstanceMocker::add(User::class, $user);
            ModelMocker::query($user, $userQuery);
            QueryMocker::lockForUpdate($userQuery);
            QueryMocker::qWhere($userQuery, User::EMAIL, $email);
            QueryMocker::first($userQuery, $return);

            $proxy->data->put('email', $email);

            $this->verifyLoader($serv, 'same_email_user', $return);
        });
    }

}
