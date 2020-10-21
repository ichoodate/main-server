<?php

namespace Tests\Unit\App\Http\Controllers\Api;

use App\Database\Models\User;
use App\Services\CardFlip\CardFlipFindingService;
use App\Services\CardFlip\FreeCardFlipCreatingService;
use Tests\Unit\App\Http\Controllers\Api\_TestCase;

class CardFlipControllerTest extends _TestCase {

    public function testShow()
    {
        $authUser = $this->setAuthUser();
        $expands  = $this->setInputParameter('expands');
        $fields   = $this->setInputParameter('fields');
        $id       = $this->setRouteParameter('card_flip');

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
        $authUser = $this->setAuthUser();
        $cardId   = $this->setInputParameter('card_id');
        $type     = $this->setInputParameter('type');
        $timezone = $this->setInputParameter('timezone');

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
