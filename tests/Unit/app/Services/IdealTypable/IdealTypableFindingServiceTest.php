<?php

namespace Tests\Unit\App\Services\IdealTypable;

use App\Database\Models\User;
use App\Database\Models\IdealTypable;
use Tests\Unit\App\Services\_TestCase;

class IdealTypableFindingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
           'model'
                => 'ideal_typable of {{id}}'
         ]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([]);
    }

    public function testLoaderModelClass()
    {
        $this->when(function ($proxy, $serv) {

          $this->verifyLoader($serv, 'model_class', IdealTypable::class);
        });
    }

    public function testLoaderPermittedUser()
    {
        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make();
            $model    = $this->factory(IdealTypable::class)->make([IdealTypable::USER_ID => $authUser->getKey()]);
            $return   = $authUser;

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('model', $model);

            $this->verifyLoader($serv, 'permitted_user', $return);
        });

        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make();
            $model    = $this->factory(IdealTypable::class)->make();
            $return   = null;

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('model', $model);

            $this->verifyLoader($serv, 'permitted_user', $return);
        });
    }

}
