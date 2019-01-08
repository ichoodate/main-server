<?php

namespace Tests\Unit\App\Services\ProfilePhoto;

use App\Database\Models\ProfilePhoto;
use App\Database\Models\User;
use Tests\_InstanceMocker as InstanceMocker;
use Tests\Unit\App\Database\Collections\_Mocker as CollectionMocker;
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
            'uploads'
                => ['required', 'array'],

            'uploads.*'
                => ['base64_image']
        ]);
    }

    public function testLoaderCreated()
    {
        $this->when(function ($proxy, $serv) {

            $return     = $this->mMock();
            $authUser   = $this->factory(User::class)->make();
            $uploads    = [11, 22, 33];
            $created    = ['model1', 'model2', 'model3'];

            InstanceMocker::add(ProfilePhoto::class, $return);
            ModelMocker::newCollection($return, $return);

            for ( $i = 0; $i < 3; $i++ )
            {
                InstanceMocker::add(ProfilePhoto::class, $inst = $this->mMock());
                ModelMocker::create($inst, [
                    ProfilePhoto::USER_ID => $authUser->getKey(),
                    ProfilePhoto::DATA    => $uploads[$i],
                ], $created[$i]);

                CollectionMocker::push($return, $created[$i]);
            }

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('uploads', $uploads);

            $this->verifyLoader($serv, 'created', $return);
        });
    }

}
