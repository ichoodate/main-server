<?php

namespace Tests\Unit\App\Services\ChattingContent;

use App\Database\Models\ChattingContent;
use App\Database\Models\Match;
use App\Database\Models\User;
use App\Services\FindingService;
use App\Services\Match\MatchFindingService;
use Tests\Unit\App\Services\_TestCase;

class ChattingContentFindingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
            'model'
                => 'chatting_content for {{id}}'
        ]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([
           'auth_user'
                => ['required']
         ]);
    }

    public function testArrTraits()
    {
        $this->verifyArrTraits([
            FindingService::class
        ]);
    }

    public function testLoaderMatch()
    {
        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make();
            $model    = $this->factory(ChattingContent::class)->make();
            $return   = [MatchFindingService::class, [
                'auth_user'
                    => $authUser,
                'id'
                    => $model->{ChattingContent::MATCH_ID}
            ], [
                'auth_user'
                    => '{{auth_user}}',
                'id'
                    => 'match_id of {{model}}'
            ]];

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('model', $model);

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
