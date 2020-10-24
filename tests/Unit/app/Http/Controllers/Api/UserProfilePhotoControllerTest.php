<?php

namespace Tests\Unit\App\Http\Controllers\Api;

use App\Database\Models\User;
use App\Services\ProfilePhoto\ProfilePhotoListingService;

class UserProfilePhotoControllerTest extends _TestCase {

    public function testIndex()
    {
        $userId   = $this->uniqueString();
        $cursorId = $this->uniqueString();
        $limit    = $this->uniqueString();
        $page     = $this->uniqueString();
        $expands  = $this->uniqueString();
        $fields   = $this->uniqueString();
        $groupBy  = $this->uniqueString();
        $orderBy  = $this->uniqueString();

        $this->setRouteParameter('user', $userId);
        $this->setInputParameter('cursor_id', $cursorId);
        $this->setInputParameter('limit', $limit);
        $this->setInputParameter('page', $page);
        $this->setInputParameter('expands', $expands);
        $this->setInputParameter('fields', $fields);
        $this->setInputParameter('group_by', $groupBy);
        $this->setInputParameter('order_by', $orderBy);

        $this->assertReturn([ProfilePhotoListingService::class, [
            'user_id'
                => $userId,
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
            'user_id'
                => $userId,
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

}
