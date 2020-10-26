<?php

namespace Tests\Unit\App\Services\ChattingContent;

use App\Database\Models\Friend;
use App\Database\Models\ChattingContent;
use App\Database\Models\Match;
use App\Database\Models\User;
use App\Services\Match\MatchFindingService;
use Tests\Unit\App\Database\Models\_Mocker as ModelMocker;
use Tests\Unit\App\Database\Queries\_Mocker as QueryMocker;
use Tests\Unit\App\Services\_TestCase;

class ChattingContentCreatingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
            'match'
                => 'match of {{match_id}}',

            'match_propose'
                => 'match_propose for {{match}} and {{auth_user}}'
        ]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([
            'auth_user'
                => ['required'],

            'match'
                => ['not_null'],

            'match_id'
                => ['required', 'integer'],

            'match_propose'
                => ['not_null'],

            'message'
                => ['required', 'string']
        ]);
    }

    public function testArrTraits()
    {
        $this->verifyArrTraits([]);
    }

    public function testLoaderCreated()
    {
        $this->when(function ($proxy, $serv) {

            $return   = $this->uniqueString();
            $message  = $this->uniqueString();
            $authUser = $this->factory(User::class)->make();
            $match    = $this->factory(Match::class)->make();

            ModelMocker::create(ChattingContent::class, [
                ChattingContent::WRITER_ID
                    => $authUser->getKey(),
                ChattingContent::MESSAGE
                    => $message,
                ChattingContent::MATCH_ID
                    => $match->getKey()
            ], $return);

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('match', $match);
            $proxy->data->put('message', $message);

            $this->verifyLoader($serv, 'created', $return);
        });
    }

    public function testLoaderMatch()
    {
        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make();
            $matchId  = $this->factory(Match::class)->make();
            $return   = [MatchFindingService::class, [
                'auth_user'
                    => $authUser,
                'id'
                    => $matchId
            ], [
                'auth_user'
                    => '{{auth_user}}',
                'id'
                    => '{{match_id}}'
            ]];

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('match_id', $matchId);

            $this->verifyLoader($serv, 'match', $return);
        });

    }

    public function testLoaderMatchPropose()
    {
        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make();
            $match    = $this->factory(Match::class)->make();
            $query    = $this->mMock();
            $return   = $this->uniqueString();

            ModelMocker::query(Friend::class, $query);
            QueryMocker::qWhere($query, Friend::MATCH_ID, $match->getKey());
            QueryMocker::first($query, $return);

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('match', $match);

            $this->verifyLoader($serv, 'match_propose', $return);
        });
    }

}
