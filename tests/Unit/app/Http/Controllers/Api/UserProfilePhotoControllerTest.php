<?php

namespace Tests\Unit\App\Http\Controllers\Api;

use App\Database\Models\User;
use App\Services\ProfilePhoto\ProfilePhotoPagingService;

class UserProfilePhotoControllerTest extends _TestCase {

    public function testIndex()
    {
        $this->factory(User::class)->create(['id' => 1234]);
        $this->factory(User::class)->create(['id' => 2345]);

        $cursorId = $this->uniqueString();
        $limit    = $this->uniqueString();
        $page     = $this->uniqueString();
        $expands  = $this->uniqueString();
        $fields   = $this->uniqueString();
        $id       = 1234;

        $this->setAuthUser(User::find(1234));
        $this->setInputParameter('cursor_id', $cursorId);
        $this->setInputParameter('limit', $limit);
        $this->setInputParameter('page', $page);
        $this->setInputParameter('expands', $expands);
        $this->setInputParameter('fields', $fields);
        $this->setRouteParameter('id', $id);

        $this->assertReturn([ProfilePhotoPagingService::class, [
            'auth_user'
                => User::find(1234),
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
                => new \stdClass,
            'order_by'
                => new \stdClass
        ], [
            'auth_user'
                => 'user for 1234',
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
