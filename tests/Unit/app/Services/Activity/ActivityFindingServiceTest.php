<?php

namespace Tests\Unit\App\Services\Activity;

use App\Database\Models\Activity;
use App\Database\Models\Notification;
use App\Database\Models\Obj;
use App\Database\Models\User;
use App\Services\Activity\ActivityFindingService as Serv;
use Tests\Unit\App\Services\_TestCase;
use Tests\Unit\App\Database\Models\_Mocker as ModelMocker;
use Tests\Unit\App\Database\Queries\_Mocker as QueryMocker;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ActivityFindingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
            'model'
                => 'activity of {{id}}'
        ]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([]);
    }

    public function testLoaderModelClass()
    {
        $this->when(function ($proxy, $serv) {

            $this->verifyLoader($serv, 'model_class', Activity::class);
        });
    }

    public function testLoaderPermittedUser()
    {
        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make();
            $return   = null;
            $model    = $this->factory(Activity::class)->make();

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('model', $model);

            $this->verifyLoader($serv, 'permitted_user', $return);
        });

        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make();
            $return   = $authUser;
            $model    = $this->factory(Activity::class)->make([Activity::USER_ID => $authUser->getKey()]);

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('model', $model);

            $this->verifyLoader($serv, 'permitted_user', $return);
        });
    }

    public function testRun()
    {
        $this->when(function ($proxy, $serv) {

            $this->factory(Activity::class)->create([]);

            $proxy->inputs->put('auth_user', $authUser);
            $proxy->inputs->put('id', 11);
            $proxy->run();

            // $this->verifyValue($proxy, 'result', Activity::find(11));
        });
    }

}
