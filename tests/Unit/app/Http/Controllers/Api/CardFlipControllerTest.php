<?php

namespace Tests\Unit\App\Http\Controllers\Api;

use App\Database\Models\User;
use App\Services\CardFlip\CardFlipFindingService;
use App\Services\CardFlip\FreeCardFlipCreatingService;
use Tests\Unit\App\Http\Controllers\Api\_TestCase;

class CardFlipControllerTest extends _TestCase {

    public function testShow()
    {
        $authUser = $this->factory(User::class)->make();
        $expands  = $this->uniqueString();
        $fields   = $this->uniqueString();
        $id       = $this->uniqueString();

        $this->setAuthUser($authUser);
        $this->setInputParameter('expands', $expands);
        $this->setInputParameter('fields', $fields);
        $this->setRouteParameter('card_flip', $id);

        $this->assertReturn([CardFlipFindingService::class, [
            'auth_user'
                => $authUser,
            'expands'
                => $expands,
            'fields'
                => $fields,
            'id'
                => $id
        ], [
            'auth_user'
                => 'authorized user',
            'expands'
                => '[expands]',
            'fields'
                => '[fields]',
            'id'
                => $id
        ]]);
    }

    public function testStore()
    {
        $authUser = $this->factory(User::class)->make();
        $cardId   = $this->uniqueString();
        $type     = $this->uniqueString();
        $timezone = $this->uniqueString();

        $this->setAuthUser($authUser);
        $this->setInputParameter('card_id', $cardId);
        $this->setInputParameter('type', $type);
        $this->setInputParameter('timezone', $timezone);

        $this->assertReturn([FreeCardFlipCreatingService::class, [
            'auth_user'
                => $authUser,
            'card_id'
                => $cardId,
        ], [
            'auth_user'
                => 'authorized user',
            'card_id'
                => '[card_id]',
        ]]);
    }

}
