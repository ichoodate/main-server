<?php

namespace Tests\Unit\App\Services\FacePhoto;

use App\Database\Models\FacePhoto;
use App\Database\Models\User;
use Tests\_InstanceMocker as InstanceMocker;
use Tests\Unit\App\Database\Collections\_Mocker as CollectionMocker;
use Tests\Unit\App\Database\Models\_Mocker as ModelMocker;
use Tests\Unit\App\Database\Queries\_Mocker as QueryMocker;
use Tests\Unit\App\Services\_TestCase;

class FacePhotoUpdatingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([
            'auth_user'
                => ['required'],

            'upload'
                => ['required', 'base64_image']
        ]);
    }

    public function testArrTraits()
    {
        $this->verifyArrTraits([]);
    }

    public function testCallbackAuthUser()
    {
        $this->when(function ($proxy, $serv) {

            $inst     = $this->mMock();
            $query    = $this->mMock();
            $authUser = $this->factory(User::class)->make();

            InstanceMocker::add(FacePhoto::class, $inst);
            ModelMocker::query($inst, $query);
            QueryMocker::qWhere($query, FacePhoto::USER_ID, $authUser->getKey());
            QueryMocker::delete($query);

            $proxy->data->put('auth_user', $authUser);

            $this->verifyCallback($serv, 'auth_user');
        });
    }

    public function testLoaderResult()
    {
        $this->when(function ($proxy, $serv) {

            $inst     = $this->mMock();
            $created  = $this->mMock();
            $return   = $this->uniqueString();
            $upload   = $this->uniqueString();
            $authUser = $this->factory(User::class)->make();

            InstanceMocker::add(FacePhoto::class, $inst);
            ModelMocker::create($inst, [
                FacePhoto::USER_ID => $authUser->getKey(),
                FacePhoto::DATA    => $upload,
            ], $return);

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('upload', $upload);

            $this->verifyLoader($serv, 'result', $return);
        });
    }

}
