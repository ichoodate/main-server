<?php

namespace Tests\Unit\App\Services\CardGroup;

use App\Database\Models\Card;
use App\Database\Models\CardGroup;
use App\Database\Models\Match;
use App\Database\Models\User;
use App\Services\Match\MatchCreatingService;
use Tests\_InstanceMocker as InstanceMocker;
use Tests\Unit\App\Database\Models\_Mocker as ModelMocker;
use Tests\Unit\App\Database\Queries\_Mocker as QueryMocker;
use Tests\Unit\App\Database\Collections\_Mocker as CollectionMocker;
use Tests\Unit\App\Services\_TestCase;

class CardGroupCreatingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([]);
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
        $this->verifyArrTraits([]);
    }

    public function testLoaderCards()
    {
        $this->when(function ($proxy, $serv) {

            $userIdField = $this->uniqueString();
            $created     = $this->factory(CardGroup::class)->make();
            $authUser    = $this->factory(User::class)->make();
            $users       = $this->factory(User::class)->make([], 2);
            $matches     = $this->factory(Match::class)->make([], 2);
            $return      = $this->mMock();

            InstanceMocker::add(Card::class, $mock = $this->mMock());
            ModelMocker::newCollection($mock, $return);

            foreach ( $matches as $i => $match )
            {
                $card = $this->mMock();

                ModelMocker::create(Card::class, [
                    Card::GROUP_ID   => $created->getKey(),
                    Card::MATCH_ID   => $match->getKey(),
                    Card::CHOOSER_ID => $authUser->getKey(),
                    Card::SHOWNER_ID => $users[$i]->getKey()
                ], $card);

                CollectionMocker::push($return, $card);
            }

            $proxy->data->put('matches', $matches);
            $proxy->data->put('users', $users);
            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('created', $created);

            $this->verifyLoader($serv, 'cards', $return);
        });
    }

    public function testLoaderCreated()
    {
        $this->when(function ($proxy, $serv) {

            $this->assertException(function () use ($serv) {

                $this->resolveLoader($serv, 'created');
            });
        });
    }

    public function testLoaderMatches()
    {
        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make();
            $users    = $this->factory(User::class)->make([], rand(2, 4));
            $input    = $this->mMock();
            $return   = [MatchCreatingService::class, [
                'auth_user'
                    => $authUser,
                'matching_users'
                    => $users,
                'matching_user_ids'
                    => implode(',', $users->modelKeys())
            ], [
                'auth_user'
                    => '{{auth_user}}',
                'matching_users'
                    => '{{users}}',
                'matching_users.*'
                    => '{{users.*}}',
                'matching_user_ids'
                    => 'ids of {{users}}'
            ]];

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('users', $users);

            $this->verifyLoader($serv, 'matches', $return);
        });
    }

    public function testLoaderUsers()
    {
        $this->when(function ($proxy, $serv) {

            $this->assertException(function () use ($serv) {

                $this->resolveLoader($serv, 'users');
            });
        });
    }

}
