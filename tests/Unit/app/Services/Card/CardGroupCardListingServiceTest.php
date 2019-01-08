<?php

namespace Tests\Unit\App\Services\Card;

use App\Database\Models\Card;
use App\Database\Models\CardGroup;
use App\Database\Models\User;
use App\Services\CardGroup\CardGroupFindingService;
use Tests\Unit\App\Database\Queries\_Mocker as QueryMocker;
use Tests\Unit\App\Services\_TestCase;

class CardGroupCardListingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([
            'card_group_id'
                => ['required', 'integer']
        ]);
    }

    public function testCallbackQueryCardGroup()
    {
        $this->when(function ($proxy, $serv) {

            $query     = $this->mMock();
            $cardGroup = $this->factory(CardGroup::class)->make();

            QueryMocker::qWhere($query, Card::GROUP_ID, $cardGroup->getKey());

            $proxy->data->put('card_group', $cardGroup);
            $proxy->data->put('query', $query);

            $this->verifyCallback($serv, 'query.card_group');
        });
    }

    public function testLoaderCardGroup()
    {
        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make();
            $id       = $this->uniqueString();
            $return   = [CardGroupFindingService::class, [
                'auth_user'
                    => $authUser,
                'id'
                    => $id
            ], [
                'auth_user'
                    => '{{auth_user}}',
                'id'
                    => '{{card_group_id}}'
            ]];

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('card_group_id', $id);

            $this->verifyLoader($serv, 'card_group', $return);
        });
    }

    public function testLoaderModelClass()
    {
        $this->when(function ($proxy, $serv) {

            $this->verifyLoader($serv, 'model_class', Card::class);
        });
    }

}
