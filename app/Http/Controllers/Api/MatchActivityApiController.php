<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;

class MatchActivityApiController extends ApiController {

    public function index()
    {
        return [MatchActivityListingService::class, [
            'auth_user'
                => auth()->user(),
            'match_id'
                => $this->get('match_id')
        ], [
            'auth_user'
                => 'authorized user',
            'match_id'
                => 'match_id'
        ]];
    }

}
