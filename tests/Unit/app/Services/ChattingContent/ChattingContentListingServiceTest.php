<?php

namespace Tests\Unit\App\Services\ChattingContent;

use App\Database\Models\Match;
use App\Database\Models\ChattingContent;
use App\Services\ListingService;
use App\Services\ChattingContent\ChattingContentFindingService;
use App\Services\Match\MatchFindingService;
use Tests\Unit\App\Database\Queries\_Mocker as QueryMocker;
use Tests\Unit\App\Services\_TestCase;

class ChattingContentListingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([
            'auth_user'
                => ['required'],

            'match_id'
                => ['required', 'integer']
        ]);
    }

    public function testArrTraits()
    {
        $this->verifyArrTraits([
            ListingService::class
        ]);
    }

    public function testCallbackQueryMatch()
    {
        $this->when(function ($proxy, $serv) {

            $query = $this->mMock();
            $match = $this->factory(Match::class)->make();

            QueryMocker::qWhere($query, ChattingContent::MATCH_ID, $match->getKey());

            $proxy->data->put('query', $query);
            $proxy->data->put('match', $match);

            $this->verifyCallback($serv, 'query.match');
        });
    }

    public function testLoaderCursor()
    {
        $this->when(function ($proxy, $serv) {

            $authUser = $this->uniqueString();
            $id       = $this->uniqueString();
            $return   = [ChattingContentFindingService::class, [
                'auth_user'
                    => $authUser,
                'id'
                    => $id
            ], [
                'auth_user'
                    => '{{auth_user}}',
                'id'
                    => '{{id}}'
            ]];

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('id', $id);

            $this->verifyLoader($serv, 'cursor', $return);
        });
    }

    public function testLoaderMatch()
    {
        $this->when(function ($proxy, $serv) {

            $id       = $this->uniqueString();
            $authUser = $this->uniqueString();
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

            $this->verifyLoader($serv, 'model_class', ChattingContent::class);
        });
    }

}
