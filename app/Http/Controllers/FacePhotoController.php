<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Services\FacePhoto\FacePhotoFindingService;
use App\Services\FacePhoto\FacePhotoUpdatingService;

class FacePhotoController extends Controller
{
    public static function show()
    {
        return [FacePhotoFindingService::class];
    }

    public static function store()
    {
        return [FacePhotoUpdatingService::class, [
            'data' => static::input('data'),
        ], [
            'data' => '[data]',
        ]];
    }
}
