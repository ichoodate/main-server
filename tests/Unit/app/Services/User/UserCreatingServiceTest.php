<?php

namespace Tests\Unit\App\Services\User;

use App\Database\Models\Photo;
use App\Database\Models\Role;
use App\Database\Models\User;
use App\Database\Models\Balance;
use App\Services\FacePhoto\FacePhotoUpdatingService;
use App\Services\IdealTypable\IdealTypableMergingService;
use App\Services\ProfilePhoto\ProfilePhotoCreatingService;
use App\Services\Profilable\ProfilableMergingService;
use Tests\_InstanceMocker as InstanceMocker;
use Tests\Unit\App\Services\_TestCase;
use Tests\Unit\App\Database\Models\_Mocker as ModelMocker;
use Tests\Unit\App\Database\Queries\_Mocker as QueryMocker;

class UserCreatingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
            'user'
                => 'same email user for {{email}}'
        ]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([
            'birth'
                => ['required', 'string', 'date'],

            'email'
                => ['required', 'string', 'email'],

            'gender'
                => ['required', 'string', 'in:' . implode(',', User::GENDER_VALUES)],

            'name'
                => ['required', 'string'],

            'password'
                => ['required', 'string', 'min:6'],

            'user'
                => ['null']
        ]);
    }

    public function testCallbackCreated()
    {
        $this->when(function ($proxy, $serv) {

            $created = $this->factory(User::class)->make();

            $proxy->data->put('created', $created);

            $this->verifyCallback($serv, 'created');

            $this->assertEquals($created, auth()->getUser());
        });
    }

    public function testLoaderFacePhoto()
    {
        $this->when(function ($proxy, $serv) {

            $result = $this->factory(User::class)->make();
            $upload = $this->uniqueString();
            $return = [FacePhotoUpdatingService::class, [
                'auth_user'
                    => $result,
                'upload'
                    => $upload
            ], [
                'auth_user'
                    => '{{result}}',
                'upload'
                    => '{{face_photo_upload}}'
            ]];

            $proxy->data->put('face_photo_upload', $upload);
            $proxy->data->put('result', $result);

            $this->verifyLoader($serv, 'face_photo', $return);
        });
    }

    public function testLoaderIdealTypables()
    {
        $this->when(function ($proxy, $serv) {

            $keywordIds = $this->uniqueString();
            $return     = [IdealTypableMergingService::class, [
                'keyword_ids'
                    => $keywordIds
            ], [
                'keyword_ids'
                    => '{{ideal_typable_keyword_ids}}'
            ]];

            $proxy->data->put('ideal_typable_keyword_ids', $keywordIds);

            $this->verifyLoader($serv, 'ideal_typables', $return);
        });
    }

    public function testLoaderCreated()
    {
        $this->when(function ($proxy, $serv) {

            $user     = $this->mMock();
            $return   = $this->uniqueString();
            $email    = $this->uniqueString();
            $name     = $this->uniqueString();
            $password = $this->uniqueString();
            $gender   = $this->uniqueString();
            $birth    = $this->uniqueString();

            InstanceMocker::add(User::class, $user);
            ModelMocker::create($user, [
                User::ACTIVE
                    => false,
                User::BIRTH
                    => $birth,
                User::COIN
                    => 0,
                User::EMAIL
                    => $email,
                User::GENDER
                    => $gender,
                User::NAME
                    => $name,
                User::PASSWORD
                    => $password
            ], $return);

            $proxy->data->put('email',    $email);
            $proxy->data->put('password', $password);
            $proxy->data->put('gender',   $gender);
            $proxy->data->put('birth',    $birth);
            $proxy->data->put('name',     $name);

            $this->verifyLoader($serv, 'created', $return);
        });
    }

    public function testLoaderProfilables()
    {
        $this->when(function ($proxy, $serv) {

            $keywordIds = $this->uniqueString();
            $return     = [ProfilableMergingService::class, [
                'keyword_ids'
                    => $keywordIds
            ], [
                'keyword_ids'
                    => '{{profilable_keyword_ids}}'
            ]];

            $proxy->data->put('profilable_keyword_ids', $keywordIds);

            $this->verifyLoader($serv, 'profilables', $return);
        });
    }

    public function testLoaderProfilePhotos()
    {
        $this->when(function ($proxy, $serv) {

            $result  = $this->factory(User::class)->make();
            $uploads = $this->uniqueString();
            $return  = [ProfilePhotoCreatingService::class, [
                'auth_user'
                    => $result,
                'uploads'
                    => $uploads
            ], [
                'auth_user'
                    => '{{result}}',
                'uploads'
                    => '{{profile_photo_uploads}}'
            ]];

            $proxy->data->put('profile_photo_uploads', $uploads);
            $proxy->data->put('result', $result);

            $this->verifyLoader($serv, 'profile_photos', $return);
        });
    }

    public function testLoaderUser()
    {
        $this->when(function ($proxy, $serv) {

            $user      = $this->mMock();
            $userQuery = $this->mMock();
            $email     = $this->uniqueString();
            $return    = $this->uniqueString();

            InstanceMocker::add(User::class, $user);
            ModelMocker::aliasQuery($user, $userQuery);
            QueryMocker::lockForUpdate($userQuery);
            QueryMocker::qWhere($userQuery, User::EMAIL, $email);
            QueryMocker::first($userQuery, $return);

            $proxy->data->put('email', $email);

            $this->verifyLoader($serv, 'user', $return);
        });
    }

}
