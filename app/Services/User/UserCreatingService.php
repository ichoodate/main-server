<?php

namespace App\Services\User;

use App\Database\Models\Balance;
use App\Database\Models\Photo;
use App\Database\Models\Role;
use App\Database\Models\User;
use App\Service;
use App\Services\FacePhoto\FacePhotoUpdatingService;
use App\Services\IdealTypable\IdealTypableMergingService;
use App\Services\ProfilePhoto\ProfilePhotoCreatingService;
use App\Services\Profilable\ProfilableMergingService;

class UserCreatingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'user'
                => 'same email user for {{email}}'
        ];
    }

    public static function getArrCallbackLists()
    {
        return [
            'created' => ['created', function ($created) {

                auth()->setUser($created);
            }]
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'created' => ['email', 'password', 'gender', 'birth', 'name', function ($email, $password, $gender, $birth, $name) {

                return inst(User::class)->create([
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
                ]);
            }],

            'face_photo' => ['result', 'face_photo_upload', function ($result, $facePhotoUpload) {

                return [FacePhotoUpdatingService::class, [
                    'auth_user'
                        => $result,
                    'upload'
                        => $facePhotoUpload
                ], [
                    'auth_user'
                        => '{{result}}',
                    'upload'
                        => '{{face_photo_upload}}'
                ]];
            }],

            'ideal_typables' => ['ideal_typable_keyword_ids', function ($idealTypableKeywordIds) {

                return [IdealTypableMergingService::class, [
                    'keyword_ids'
                        => $idealTypableKeywordIds
                ], [
                    'keyword_ids'
                        => '{{ideal_typable_keyword_ids}}'
                ]];
            }],

            'profile_photos' => ['result', 'profile_photo_uploads', function ($result, $profilePhotoUploads) {

                return [ProfilePhotoCreatingService::class, [
                    'auth_user'
                        => $result,
                    'uploads'
                        => $profilePhotoUploads
                ], [
                    'auth_user'
                        => '{{result}}',
                    'uploads'
                        => '{{profile_photo_uploads}}'
                ]];
            }],

            'profilables' => ['profilable_keyword_ids', function ($profilableKeywordIds) {

                return [ProfilableMergingService::class, [
                    'keyword_ids'
                        => $profilableKeywordIds
                ], [
                    'keyword_ids'
                        => '{{profilable_keyword_ids}}'
                ]];
            }],

            'user' => ['email', function ($email) {

                return inst(User::class)->aliasQuery()
                    ->lockForUpdate()
                    ->qWhere(User::EMAIL, $email)
                    ->first();
            }]
        ];
    }

    public static function getArrPromiseLists()
    {
        return [];
    }

    public static function getArrRuleLists()
    {
        return [
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
        ];
    }

    public static function getArrTraits()
    {
        return [];
    }

}
