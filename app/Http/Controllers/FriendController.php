<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Services\Friend\FriendCreatingService;
use App\Services\Friend\FriendDeletingService;
use App\Services\Friend\FriendFindingService;
use App\Services\Friend\FriendListingService;

class FriendController extends Controller
{
    public static function destroy()
    {
        return [FriendDeletingService::class];
    }

    public static function index()
    {
        return [FriendListingService::class, [
            'sender_id' => static::input('sender_id'),
            'receiver_id' => static::input('receiver_id'),
            'is_bidirectional' => static::input('is_bidirectional'),
        ], [
            'sender_id' => '[sender_id]',
            'receiver_id' => '[receiver_id]',
            'is_bidirectional' => '[is_bidirectional]',
        ]];
    }

    public static function show()
    {
        return [FriendFindingService::class];
    }

    public static function store()
    {
        return [FriendCreatingService::class, [
            'user_id' => static::input('user_id'),
        ], [
            'user_id' => '[user_id]',
        ]];
    }
}
