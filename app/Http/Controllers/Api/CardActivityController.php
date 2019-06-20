<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Services\Activity\CardActivityCreatingService;

class CardActivityController extends ApiController {

    public static function store()
    {
        return [CardActivityCreatingService::class, [
            'auth_user'
                => auth()->user(),
            'card_id'
                => request()->route()->card,
            'type'
                => static::input('type'),
            'timezone'
                => static::input('timezone')
        ], [
            'auth_user'
                => 'authorized user',
            'card_id'
                => request()->route()->card,
            'type'
                => '[type]',
            'timezone'
                => '[timezone]'
        ]];
    }

}
