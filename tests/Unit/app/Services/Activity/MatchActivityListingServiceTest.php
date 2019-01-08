<?php

namespace Tests\Unit\App\Services\Activity;

use App\Database\Models\Activity;
use App\Database\Models\Match;
use App\Services\Match\MatchFindingService;
use Tests\Unit\App\Database\Queries\_Mocker as QueryMocker;
use Tests\Unit\App\Services\_TestCase;

class MatchActivityListingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
            'match'
                => 'match for {{match_id}}'
        ]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([
            'match_id'
                => ['required', 'integer'],
        ]);
    }

    public function testCallbackQueryMatch()
    {
        $this->when(function ($proxy, $serv) {

            $query = $this->mMock();
            $match = $this->factory(Match::class)->make();

            QueryMocker::qWhere($query, Activity::RELATED_ID, $match->{Match::ID});

            $proxy->data->put('match', $match);
            $proxy->data->put('query', $query);

            $this->verifyCallback($serv, 'query.match');
        });
    }

    public function testLoaderMatch()
    {
        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make();
            $id       = $this->uniqueString();
            $return   = [MatchFindingService::class, [
                'auth_user'
                    => $authUser,
                'id'
                    => $id
            ], [
                'auth_user'
                    => '{{auth_user}}',
                'id'
                    => '{{match_id}}'
            ]];

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('match_id', $id);

            $this->verifyLoader($serv, 'match', $return);
        });
    }

    public function testLoaderModelClass()
    {
        $this->when(function ($proxy, $serv) {

            $this->verifyLoader($serv, 'model_class', Activity::class);
        });
    }

}
