<?php

namespace Tests\Unit\App\Http\Controllers\Api;

use App\Database\Models\User;
use App\Services\Activity\CardActivityCreatingService;
use Tests\Unit\App\Http\Controllers\Api\_TestCase;

class CardActivityControllerTest extends _TestCase {

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

        $this->assertReturn([CardActivityCreatingService::class, [
            'auth_user'
                => $authUser,
            'card_id'
                => $cardId,
            'type'
                => $type,
            'timezone'
                => $timezone
        ], [
            'auth_user'
                => 'authorized user',
            'card_id'
                => '[card_id]',
            'type'
                => '[type]',
            'timezone'
                => '[timezone]',
        ]]);
    }

}
