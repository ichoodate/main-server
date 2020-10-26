<?php

namespace Tests\Unit\App\Services\ProfilePhoto;

use App\Database\Models\ProfilePhoto;
use App\Database\Models\User;
use Tests\_InstanceMocker as InstanceMocker;
use Tests\Unit\App\Database\Models\_Mocker as ModelMocker;
use Tests\Unit\App\Services\_TestCase;

class ProfilePhotoCreatingServiceTest extends _TestCase {

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
                => ['required', 'base64']
        ]);
    }

    public function testArrTraits()
    {
        $this->verifyArrTraits([]);
    }

    public function testLoaderCreated()
    {
        $this->when(function ($proxy, $serv) {

            $profilePhoto = $this->mMock();
            $authUser     = $this->factory(User::class)->make();
            $upload       = $this->uniqueString();
            $return       = $this->uniqueString();

            InstanceMocker::add(ProfilePhoto::class, $profilePhoto);
            ModelMocker::create($profilePhoto, [
                ProfilePhoto::USER_ID => $authUser->getKey(),
                ProfilePhoto::DATA    => $upload,
            ], $return);

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('upload', $upload);

            $this->verifyLoader($serv, 'created', $return);
        });
    }

}
