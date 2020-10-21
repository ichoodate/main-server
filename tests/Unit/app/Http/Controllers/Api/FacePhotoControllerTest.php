<?php

namespace Tests\Unit\App\Http\Controllers\Api;

use App\Database\Models\User;
use App\Services\FacePhoto\FacePhotoFindingService;
use App\Services\FacePhoto\FacePhotoListingService;
use App\Services\FacePhoto\FacePhotoCreatingService;
use Tests\Unit\App\Http\Controllers\Api\_TestCase;

class FacePhotoControllerTest extends _TestCase {

    public function testShow()
    {
        $authUser = $this->setAuthUser();
        $expands  = $this->setInputParameter('expands');
        $fields   = $this->setInputParameter('fields');
        $id       = $this->setRouteParameter('face_photo');

        $this->assertReturn([FacePhotoFindingService::class, [
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

    public function testStore()
    {
        $authUser = $this->setAuthUser();
        $data     = $this->setInputParameter('data');

        $this->assertReturn([FacePhotoCreatingService::class, [
            'auth_user'
                => $authUser,
            'data'
                => $data,
        ], [
            'auth_user'
                => 'authorized user',
            'data'
                => '[data]',
        ]]);
    }

}
