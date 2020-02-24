<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Services\FacePhoto\FacePhotoFindingService;
use App\Services\FacePhoto\FacePhotoCreatingService;

class FacePhotoController extends ApiController {

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
        return [FacePhotoCreatingService::class, [
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
