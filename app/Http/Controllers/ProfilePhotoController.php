<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Services\ProfilePhoto\ProfilePhotoCreatingService;
use App\Services\ProfilePhoto\ProfilePhotoFindingService;
use App\Services\ProfilePhoto\ProfilePhotoListingService;

class ProfilePhotoController extends Controller
{
    public static function index()
    {
        return [ProfilePhotoListingService::class, [
            'user_id' => static::input('user_id'),
        ], [
            'user_id' => '[user_id]',
        ]];
    }

    public static function show()
    {
        return [ProfilePhotoFindingService::class];
    }

    public static function store()
    {
        return [ProfilePhotoCreatingService::class, [
            'data' => static::input('data'),
        ], [
            'data' => '[data]',
        ]];
    }
}
