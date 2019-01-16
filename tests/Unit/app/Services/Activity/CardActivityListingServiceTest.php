<?php

namespace Tests\Unit\App\Services\Activity;

use App\Database\Models\Activity;
use App\Database\Models\Card;
use App\Services\Card\CardFindingService;
use Tests\Unit\App\Database\Queries\_Mocker as QueryMocker;
use Tests\Unit\App\Services\_TestCase;

class CardActivityListingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
            'card'
                => 'card for {{card_id}}'
        ]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([
            'card_id'
                => ['required', 'integer'],
        ]);
    }

    public function testCallbackQueryCard()
    {
        $this->when(function ($proxy, $serv) {

            $query = $this->mMock();
            $card = $this->factory(Card::class)->make();

            QueryMocker::qWhere($query, Activity::RELATED_ID, $card->getKey());

            $proxy->data->put('card', $card);
            $proxy->data->put('query', $query);

            $this->verifyCallback($serv, 'query.card');
        });
    }

    public function testLoaderCard()
    {
        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make();
            $id       = $this->uniqueString();
            $return   = [CardFindingService::class, [
                'auth_user'
                    => $authUser,
                'id'
                    => $id
            ], [
                'auth_user'
                    => '{{auth_user}}',
                'id'
                    => '{{card_id}}'
            ]];

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('card_id', $id);

            $this->verifyLoader($serv, 'card', $return);
        });
    }

    public function testLoaderModelClass()
    {
        $this->when(function ($proxy, $serv) {

            $this->verifyLoader($serv, 'model_class', Activity::class);
        });
    }

}
