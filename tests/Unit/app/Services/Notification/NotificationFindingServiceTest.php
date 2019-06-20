<?php

namespace Tests\Unit\App\Services\Notification;

use App\Database\Models\Notification;
use App\Database\Models\User;
use App\Services\FindingService;
use App\Services\PermittedUserRequiringService;
use Tests\Unit\App\Services\_TestCase;

class NotificationFindingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
            'model'
                => 'notification for {{id}}'
        ]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([]);
    }

    public function testArrTraits()
    {
        $this->verifyArrTraits([
            FindingService::class,
            PermittedUserRequiringService::class
        ]);
    }

    public function testLoaderModelClass()
    {
        $this->when(function ($proxy, $serv) {

            $this->verifyLoader($serv, 'model_class', Notification::class);
        });
    }

    public function testLoaderPermittedUser()
    {
        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make();
            $model    = $this->factory(Notification::class)->make();
            $return   = null;

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('model', $model);

            $this->verifyLoader($serv, 'permitted_user', $return);
        });

        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make();
            $model    = $this->factory(Notification::class)->make([Notification::USER_ID => $authUser->getKey()]);
            $return   = $authUser;

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('model', $model);

            $this->verifyLoader($serv, 'permitted_user', $return);
        });
    }

}
