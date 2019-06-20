<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Services\FacePhoto\FacePhotoFindingService;
use App\Services\FacePhoto\FacePhotoListingService;
use App\Services\FacePhoto\FacePhotoUpdatingService;

class FacePhotoController extends ApiController {

    public static function index()
    {
        return [FacePhotoListingService::class, [
            'auth_user'
                => auth()->user(),
            'expands'
                => static::input('expands'),
            'fields'
                => static::input('fields'),
            'group_by'
                => new \stdClass,
            'order_by'
                => new \stdClass
        ], [
            'auth_user'
                => 'authorized user',
            'expands'
                => '[expands]',
            'fields'
                => '[fields]',
            'group_by'
                => '[group_by]',
            'order_by'
                => '[order_by]'
        ]];
    }

    public static function show()
    {
        return [FacePhotoFindingService::class, [
            'auth_user'
                => auth()->user(),
            'expands'
                => static::input('expands'),
            'fields'
                => static::input('fields'),
            'id'
                => request()->route()->face_photo
        ], [
            'auth_user'
                => 'authorized user',
            'expands'
                => '[expands]',
            'fields'
                => '[fields]',
            'id'
                => request()->route()->face_photo
        ]];
    }

    public static function store()
    {
        return [FacePhotoUpdatingService::class, [
            'auth_user'
                => auth()->user(),
            'upload'
                => static::input('upload')
        ], [
            'auth_user'
                => 'authorized user',
            'upload'
                => '[upload]'
        ]];
    }

}
