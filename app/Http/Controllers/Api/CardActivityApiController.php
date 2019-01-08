<?php

namespace App\Http\Controllers\Api;

use App\Services\Activity\CardActivityListingService;
use App\Http\Controllers\ApiController;

class CardActivityApiController extends ApiController {

    public function index()
    {
        return [CardActivityListingService::class, [
            'auth_user'
                => auth()->user(),
            'card_id'
                => $this->get('card_id')
        ], [
            'auth_user'
                => 'authorized user',
            'card_id'
                => 'card_id'
        ]];
    }

    public function post()
    {
        return [CardActivityCreatingService::class, [
            'auth_user'
                => auth()->user(),
            'card_id'
                => $this->get('card_id'),
            'type'
                => $this->get('type')
        ], [
            'auth_user'
                => 'authorized user',
            'card_id'
                => 'card_id',
            'type'
                => 'type'
        ]];
    }

}
