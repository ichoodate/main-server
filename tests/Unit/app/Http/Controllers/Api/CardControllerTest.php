<?php

namespace Tests\Unit\App\Http\Controllers\Api;

use App\Database\Models\Card;
use App\Database\Models\Match;
use App\Database\Models\User;
use App\Services\Card\CardFindingService;
use App\Services\Card\CardListingService;
use Tests\Unit\App\Http\Controllers\Api\_TestCase;

class CardControllerTest extends _TestCase {

    public function testIndex()
    {
        $authUser           = $this->setAuthUser();
        $after              = $this->setInputParameter('after');
        $authUserStatus     = $this->setInputParameter('auth_user_status');
        $before             = $this->setInputParameter('before');
        $cardType           = $this->setInputParameter('card_type');
        $cursorId           = $this->setInputParameter('cursor_id');
        $expands            = $this->setInputParameter('expands');
        $fields             = $this->setInputParameter('fields');
        $limit              = $this->setInputParameter('limit');
        $matchStatus        = $this->setInputParameter('match_status');
        $matchingUserStatus = $this->setInputParameter('matching_user_status');
        $groupBy            = $this->setInputParameter('group_by');
        $orderBy            = $this->setInputParameter('order_by');
        $page               = $this->setInputParameter('page');
        $timezone           = $this->setInputParameter('timezone');

        $this->assertReturn([CardListingService::class, [
            'after'
                => $after,
            'auth_user'
                => $authUser,
            'auth_user_status'
                => $authUserStatus,
            'before'
                => $before,
            'card_type'
                => $cardType,
            'match_status'
                => $matchStatus,
            'matching_user_status'
                => $matchingUserStatus,
            'timezone'
                => $timezone,
            'cursor_id'
                => $cursorId,
            'limit'
                => $limit,
            'page'
                => $page,
            'expands'
                => $expands,
            'fields'
                => $fields,
            'group_by'
                => '',
            'order_by'
                => ''
        ], [
            'after'
                => '[after]',
            'auth_user'
                => 'authorized user',
            'auth_user_status'
                => '[auth_user_status]',
            'before'
                => '[before]',
            'card_type'
                => '[card_type]',
            'match_status'
                => '[match_status]',
            'matching_user_status'
                => '[matching_user_status]',
            'timezone'
                => '[timezone]',
            'cursor_id'
                => '[cursor_id]',
            'limit'
                => '[limit]',
            'page'
                => '[page]',
            'expands'
                => '[expands]',
            'fields'
                => '[fields]',
            'group_by'
                => '[group_by]',
            'order_by'
                => '[order_by]'
        ]]);
    }

    public function testShow()
    {
        $authUser = $this->setAuthUser();
        $expands  = $this->setInputParameter('expands');
        $fields   = $this->setInputParameter('fields');
        $id       = $this->setRouteParameter('card');

        $this->assertReturn([CardFindingService::class, [
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

}
