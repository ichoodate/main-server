<?php

namespace Tests\Unit\App\Services\Notification;

use App\Database\Models\Activity;
use App\Database\Models\Notification;
use App\Services\Activity\ActivityFindingService;
use Tests\Unit\App\Database\Queries\_Mocker as QueryMocker;
use Tests\Unit\App\Services\_TestCase;

class ActivityNotificationListingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
            'activity'
                => 'activity for {{activity_id}}'
        ]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([
            'activity_id'
                => ['required', 'integer'],
        ]);
    }

    public function testCallbackQueryActivity()
    {
        $this->when(function ($proxy, $serv) {

            $query    = $this->mMock();
            $activity = $this->factory(Activity::class)->make();

            QueryMocker::qWhere($query, Notification::ACTIVITY_ID, $activity->getKey());

            $proxy->data->put('activity', $activity);
            $proxy->data->put('query', $query);

            $this->verifyCallback($serv, 'query.activity');
        });
    }

    public function testLoaderActivity()
    {
        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make();
            $id       = $this->uniqueString();
            $return   = [ActivityFindingService::class, [
                'auth_user'
                    => $authUser,
                'id'
                    => $id
            ], [
                'auth_user'
                    => '{{auth_user}}',
                'id'
                    => '{{activity_id}}'
            ]];

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('activity_id', $id);

            $this->verifyLoader($serv, 'activity', $return);
        });
    }

    public function testLoaderModelClass()
    {
        $this->when(function ($proxy, $serv) {

            $this->verifyLoader($serv, 'model_class', Notification::class);
        });
    }

}
