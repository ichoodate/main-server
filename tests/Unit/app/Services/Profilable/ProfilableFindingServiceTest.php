<?php

namespace Tests\Unit\App\Services\Profilable;

use App\Database\Models\User;
use App\Database\Models\Profilable;
use Tests\Unit\App\Services\_TestCase;

class ProfilableFindingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
            'model'
                => 'profilable of {{id}}'
        ]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([]);
    }

    public function testLoaderModelClass()
    {
        $this->when(function ($proxy, $serv) {

            $this->verifyLoader($serv, 'model_class', Profilable::class);
        });
    }

    public function testLoaderPermittedUser()
    {
        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make();
            $model = $this->factory(Profilable::class)->make();

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('model', $model);

            $this->verifyLoader($serv, 'permitted_user', null);
        });

        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make();
            $model = $this->factory(Profilable::class)->make([Profilable::USER_ID => $authUser->getKey()]);

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('model', $model);

            $this->verifyLoader($serv, 'permitted_user', $authUser);
        });
    }

}
