<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Services\FacePhoto\FacePhotoCreatingService;
use App\Services\FacePhoto\FacePhotoFindingService;

class FacePhotoController extends Controller
{
    public static function show()
    {
        return [FacePhotoFindingService::class];
    }

    public static function store()
    {
        return [FacePhotoCreatingService::class, [
            'data' => static::input('data'),
        ], [
            'data' => '[data]',
        ]];
    }
}
