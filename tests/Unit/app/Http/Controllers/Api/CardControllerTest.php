<?php

namespace Tests\Unit\App\Http\Controllers\Api;

use App\Database\Models\Card;
use App\Database\Models\Match;
use App\Database\Models\User;
use App\Services\Card\CardFindingService;
use App\Services\Card\CardPagingService;
use Tests\Unit\App\Http\Controllers\Api\_TestCase;

class CardControllerTest extends _TestCase {

    public function testIndex()
    {
        $authUser           = $this->factory(User::class)->make();
        $authUserStatus     = $this->uniqueString();
        $cardType           = $this->uniqueString();
        $matchStatus        = $this->uniqueString();
        $matchingUserStatus = $this->uniqueString();
        $cursorId           = $this->uniqueString();
        $limit              = $this->uniqueString();
        $page               = $this->uniqueString();
        $expands            = $this->uniqueString();
        $fields             = $this->uniqueString();
        $groupBy            = $this->uniqueString();
        $orderBy            = $this->uniqueString();

        $this->setAuthUser($authUser);
        $this->setInputParameter('auth_user_status', $authUserStatus);
        $this->setInputParameter('card_type', $cardType);
        $this->setInputParameter('match_status', $matchStatus);
        $this->setInputParameter('matching_user_status', $matchingUserStatus);
        $this->setInputParameter('cursor_id', $cursorId);
        $this->setInputParameter('limit', $limit);
        $this->setInputParameter('page', $page);
        $this->setInputParameter('expands', $expands);
        $this->setInputParameter('fields', $fields);
        $this->setInputParameter('group_by', $groupBy);
        $this->setInputParameter('order_by', $orderBy);

        $this->assertReturn([CardPagingService::class, [
            'auth_user'
                => $authUser,
            'auth_user_status'
                => $authUserStatus,
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
            'auth_user'
                => 'authorized user',
            'auth_user_status'
                => '[auth_user_status]',
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
        $authUser = $this->factory(User::class)->make();
        $expands  = $this->uniqueString();
        $fields   = $this->uniqueString();
        $id       = $this->uniqueString();

        $this->setAuthUser($authUser);
        $this->setInputParameter('expands', $expands);
        $this->setInputParameter('fields', $fields);
        $this->setRouteParameter('id', $id);

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
