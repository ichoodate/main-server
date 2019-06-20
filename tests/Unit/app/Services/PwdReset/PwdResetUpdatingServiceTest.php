<?php

namespace Tests\Unit\App\Services\PwdReset;

use App\Database\Models\PwdReset;
use App\Database\Models\User;
use App\Services\UpdatingService;
use Illuminate\Support\Facades\Hash;
use Tests\_InstanceMocker as InstanceMocker;
use Tests\Unit\App\Database\Models\_Mocker as ModelMocker;
use Tests\Unit\App\Database\Queries\_Mocker as QueryMocker;
use Tests\Unit\App\Services\_TestCase;

class PwdResetUpdatingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([
            'id'
                => ['required', 'string'],

            'user'
                => ['not_null'],

            'new_password'
                => ['required', 'string']
        ]);
    }

    public function testArrTraits()
    {
        $this->verifyArrTraits([]);
    }

    public function testCallbackUserNewPassword()
    {
        $this->when(function ($proxy, $serv) {

            $user     = $this->mMock(User::class);
            $hash     = $this->mMock();
            $password = $this->uniqueString();

            $hash->shouldReceive('make')->with($password)->once()->andReturn('abcd');
            Hash::swap($hash);
            ModelMocker::setAttribute($user, User::PASSWORD, 'abcd');
            ModelMocker::save($user);

            $proxy->data->put('user', $user);
            $proxy->data->put('new_password', $password);

            $this->verifyCallback($serv, 'user.new_password');
        });
    }

    public function testCallbackResultComplete()
    {
        $this->when(function ($proxy, $serv) {

            $result = $this->mMock(PwdReset::class);

            ModelMocker::setAttribute($result, PwdReset::COMPLETE, true);
            ModelMocker::save($result);

            $proxy->data->put('result', $result);

            $this->verifyCallback($serv, 'result_complete');
        });
    }

    public function testLoaderResult()
    {
        $this->when(function ($proxy, $serv) {

            $id       = $this->uniqueString();
            $return   = $this->uniqueString();
            $pwdReset = $this->mMock(PwdReset::class);
            $query    = $this->mMock();

            InstanceMocker::add(PwdReset::class, $pwdReset);
            ModelMocker::query($pwdReset, $query);
            QueryMocker::qWhere($query, PwdReset::ID, $id);
            QueryMocker::qWhere($query, PwdReset::COMPLETE, false);
            QueryMocker::first($query, $return);

            $proxy->data->put('id', $id);

            $this->verifyLoader($serv, 'result', $return);
        });
    }

    public function testLoaderUser()
    {
        $this->when(function ($proxy, $serv) {

            $user   = $this->mMock(User::class);
            $result = $this->factory(PwdReset::class)->create();
            $query  = $this->mMock();
            $return = $this->uniqueString();

            InstanceMocker::add(User::class, $user);
            ModelMocker::query($user, $query);
            QueryMocker::qWhere($query, User::EMAIL, $result->{PwdReset::EMAIL});
            QueryMocker::first($query, $return);

            $proxy->data->put('result', $result);

            $this->verifyLoader($serv, 'user', $return);
        });
    }

}
