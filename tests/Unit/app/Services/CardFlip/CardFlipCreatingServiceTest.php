<?php

namespace Tests\Unit\App\Services\CardFlip;

use App\Database\Models\CardFlip;
use App\Database\Models\Card;
use App\Database\Models\User;
use App\Service;
use App\Services\CreatingService;
use App\Services\UsedCoinAddingService;
use App\Services\Card\CardFindingService;
use App\Services\RequiredCoin\CardFlipRequiredCoinReturningService;
use Tests\Unit\App\Database\Models\_Mocker as ModelMocker;
use Tests\_InstanceMocker as InstanceMocker;
use Tests\Unit\App\Services\_TestCase;

class CardFlipCreatingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
            'card'
                => 'card for {{card_id}}',

            'required_coin'
                => 'required coin for activity of {{card}}'
        ]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([
            'auth_user'
                => ['required'],

            'card_id'
                => ['required', 'integer'],

            'timezone'
                => ['required']
        ]);
    }

    public function testArrTraits()
    {
        $this->verifyArrTraits([
            CreatingService::class,
            UsedCoinAddingService::class,
        ]);
    }

    public function testLoaderCard()
    {
        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make();
            $cardId   = $this->uniqueString();
            $return   = [CardFindingService::class, [
                'auth_user'
                    => $authUser,
                'id'
                    => $cardId
            ], [
                'auth_user'
                    => '{{auth_user}}',
                'id'
                    => '{{card_id}}'
            ]];

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('card_id', $cardId);

            $this->verifyLoader($serv, 'card', $return);
        });
    }

    public function testLoaderCreated()
    {
        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make();
            $card     = $this->factory(Card::class)->make();
            $type     = $this->uniqueString();
            $return   = $this->mMock();

            ModelMocker::create(CardFlip::class, [
                CardFlip::USER_ID    => $authUser->getKey(),
                CardFlip::RELATED_ID => $card->getKey(),
                CardFlip::TYPE       => $type
            ], $return);

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('card', $card);
            $proxy->data->put('type', $type);

            $this->verifyLoader($serv, 'created', $return);
        });
    }

    public function testLoaderMatchCardFlip()
    {
        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make();
            $card     = $this->factory(Card::class)->make();
            $type     = CardFlip::TYPE_CARD_FLIP;
            $return   = null;

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('card', $card);
            $proxy->data->put('type', $type);

            $this->verifyLoader($serv, 'match_activity', $return);
        });

        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make();
            $card     = $this->factory(Card::class)->make();
            $type     = CardFlip::TYPE_CARD_OPEN;
            $return   = $this->mMock();

            InstanceMocker::add(CardFlip::class, $return);
            ModelMocker::create($return, [
                CardFlip::RELATED_ID => $card->{Card::MATCH_ID},
                CardFlip::USER_ID    => $authUser->getKey(),
                CardFlip::TYPE       => CardFlip::TYPE_MATCH_OPEN
            ], $return);

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('card', $card);
            $proxy->data->put('type', $type);

            $this->verifyLoader($serv, 'match_activity', $return);
        });

        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make();
            $card     = $this->factory(Card::class)->make();
            $type     = CardFlip::TYPE_CARD_PROPOSE;
            $return   = $this->mMock();

            InstanceMocker::add(CardFlip::class, $return);
            ModelMocker::create($return, [
                CardFlip::RELATED_ID => $card->{Card::MATCH_ID},
                CardFlip::USER_ID    => $authUser->getKey(),
                CardFlip::TYPE       => CardFlip::TYPE_MATCH_PROPOSE
            ], $return);

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('card', $card);
            $proxy->data->put('type', $type);

            $this->verifyLoader($serv, 'match_activity', $return);
        });
    }

    public function testLoaderRequiredCoin()
    {
        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make();
            $card     = $this->factory(Card::class)->make();
            $type     = $this->uniqueString();
            $timezone = $this->uniqueString();
            $return   = [CardFlipRequiredCoinReturningService::class, [
                'auth_user'
                    => $authUser,
                'card'
                    => $card,
                'card_id'
                    => $card->getKey(),
                'type'
                    => $type,
                'timezone'
                    => $timezone
            ], [
                'auth_user'
                    => '{{auth_user}}',
                'card'
                    => '{{card}}',
                'card_id'
                    => '{{card_id}}',
                'type'
                    => '{{type}}',
                'timezone'
                    => '{{timezone}}'
            ]];

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('card', $card);
            $proxy->data->put('type', $type);
            $proxy->data->put('timezone', $timezone);

            $this->verifyLoader($serv, 'required_coin', $return);
        });
    }

}
