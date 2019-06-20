<?php

namespace Tests\Unit\App\Services\PwdReset;

use App\Database\Models\PwdReset;
use App\Database\Models\User;
use App\Services\CreatingService;
use Tests\_InstanceMocker as InstanceMocker;
use Tests\Unit\App\Database\Models\_Mocker as ModelMocker;
use Tests\Unit\App\Database\Queries\_Mocker as QueryMocker;
use Tests\Unit\App\Services\_TestCase;

class PwdResetCreatingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
            'user'
                => 'user for {{email}}'
        ]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([
            'email'
                => ['required', 'email'],

            'user'
                => ['not_null']
        ]);
    }

    public function testArrTraits()
    {
        $this->verifyArrTraits([
            CreatingService::class
        ]);
    }

    public function testLoaderUser()
    {
        $this->when(function ($proxy, $serv) {

            $email  = $this->uniqueString();
            $inst   = $this->mMock();
            $query  = $this->mMock();
            $return = $this->uniqueString();

            InstanceMocker::add(User::class, $inst);
            ModelMocker::query($inst, $query);
            QueryMocker::qWhere($query, User::EMAIL, $email);
            QueryMocker::first($query, $return);

            $proxy->data->put('email', $email);

            $this->verifyLoader($serv, 'user', $return);
        });
    }

    public function testLoaderCreated()
    {
        $this->when(function ($proxy, $serv) {

            $user   = $this->factory(User::class)->make();
            $type   = $this->uniqueString();
            $return = $this->mMock();

            $proxy->data->put('user', $user);

            $result = $this->resolveLoader($serv, 'created');

            $this->assertEquals(1, preg_match('/^[a-zA-Z0-9]{1,}$/', $result->{PwdReset::TOKEN}));
            $this->assertEquals($user->{User::EMAIL}, $result->{PwdReset::EMAIL});
            $this->assertEquals(false, $result->{PwdReset::COMPLETE});
        });
    }

}
