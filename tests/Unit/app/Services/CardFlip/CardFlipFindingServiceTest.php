<?php

namespace Tests\Unit\App\Services\CardFlip;

use App\Database\Models\CardFlip;
use App\Database\Models\Notification;
use App\Database\Models\Obj;
use App\Database\Models\User;
use App\Services\FindingService;
use App\Services\PermittedUserRequiringService;
use Tests\Unit\App\Services\_TestCase;
use Tests\Unit\App\Database\Models\_Mocker as ModelMocker;
use Tests\Unit\App\Database\Queries\_Mocker as QueryMocker;

class CardFlipFindingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
            'model'
                => 'card_flip for {{id}}'
        ]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([]);
    }

    public function testArrTraits()
    {
        $this->verifyArrTraits([
            PermittedUserRequiringService::class,
            FindingService::class
        ]);
    }

    public function testLoaderModelClass()
    {
        $this->when(function ($proxy, $serv) {

            $this->verifyLoader($serv, 'model_class', CardFlip::class);
        });
    }

    public function testLoaderPermittedUser()
    {
        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make();
            $model    = $this->factory(CardFlip::class)->make();
            $return   = null;

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('model', $model);

            $this->verifyLoader($serv, 'permitted_user', $return);
        });

        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make();
            $model    = $this->factory(CardFlip::class)->make([CardFlip::USER_ID => $authUser->getKey()]);
            $return   = $authUser;

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('model', $model);

            $this->verifyLoader($serv, 'permitted_user', $return);
        });
    }

}
