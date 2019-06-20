<?php

namespace Tests\Unit\App\Services\Card;

use App\Database\Models\Card;
use App\Database\Models\User;
use App\Services\FindingService;
use App\Services\PermittedUserRequiringService;
use Tests\Unit\App\Services\_TestCase;

class CardFindingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
            'model'
                => 'card for {{id}}'
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

            $this->verifyLoader($serv, 'model_class', Card::class);
        });
    }

    public function testLoaderPermittedUser()
    {
        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make();
            $model    = $this->factory(Card::class)->make([Card::CHOOSER_ID => $authUser->getKey()]);
            $return   = $authUser;

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('model', $model);

            $this->verifyLoader($serv, 'permitted_user', $return);
        });

        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make();
            $model    = $this->factory(Card::class)->make([Card::SHOWNER_ID => $authUser->getKey()]);
            $return   = $authUser;

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('model', $model);

            $this->verifyLoader($serv, 'permitted_user', $return);
        });

        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make();
            $model    = $this->factory(Card::class)->make();
            $return   = null;

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('model', $model);

            $this->verifyLoader($serv, 'permitted_user', $return);
        });
    }

}
