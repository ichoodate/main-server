<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;

class CardGroupCardApiController extends ApiController {

    public function index()
    {
        return [CardGroupCardListingService::class, [
            'auth_user'
                => auth()->user(),
            'card_group_id'
                => $this->get('card_group_id')
        ], [
            'auth_user'
                => 'authorized user',
            'card_group_id'
                => 'card_group_id'
        ]];
    }

}
