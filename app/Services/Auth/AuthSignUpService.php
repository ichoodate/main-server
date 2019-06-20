<?php

namespace App\Services\Auth;

use App\Database\Models\Balance;
use App\Database\Models\Photo;
use App\Database\Models\Role;
use App\Database\Models\User;
use App\Service;
use App\Services\CreatingService;
use App\Services\FacePhoto\FacePhotoUpdatingService;
use App\Services\UserIdealTypeKwdPvt\UserIdealTypeKwdPvtMergingService;
use App\Services\ProfilePhoto\ProfilePhotoCreatingService;
use App\Services\UserSelfKwdPvt\UserSelfKwdPvtMergingService;
use Illuminate\Support\Facades\Hash;

class AuthSignUpService extends Service {

    public static function getArrBindNames()
    {
        return [
            'result'
                => 'created user',

            'same_email_user'
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
            'balance' => ['result', function ($result) {

                return inst(Balance::class)->create([
                    Balance::USER_ID => $result->getKey(),
                    Balance::TYPE => Balance::TYPE_BASIC,
                    Balance::COUNT => 0,
                    Balance::DELETED_AT => '9999-12-31 23:59:59'
                ]);
            }],

            'created' => ['birth', 'email', 'password', 'gender', 'name', function ($birth, $email, $password, $gender, $name) {

                return inst(User::class)->create([
                    User::BIRTH
                        => $birth,
                    User::EMAIL_VERIFIED
                        => false,
                    User::EMAIL
                        => $email,
                    User::GENDER
                        => $gender,
                    User::NAME
                        => $name,
                    User::PASSWORD
                        => Hash::make($password)
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

            'user_ideal_type_kwd_pvts' => ['result', 'ideal_type_keyword_ids', function ($result, $idealTypeKeywordIds) {

                return [UserIdealTypeKwdPvtMergingService::class, [
                    'auth_user'
                        => $result,
                    'keyword_ids'
                        => $idealTypeKeywordIds
                ], [
                    'auth_user'
                        => '{{result}}',
                    'keyword_ids'
                        => '{{ideal_type_keyword_ids}}'
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

            'user_self_kwd_pvts' => ['result', 'self_keyword_ids', function ($result, $selfKeywordIds) {

                return [UserSelfKwdPvtMergingService::class, [
                    'auth_user'
                        => $result,
                    'keyword_ids'
                        => $selfKeywordIds
                ], [
                    'auth_user'
                        => '{{result}}',
                    'keyword_ids'
                        => '{{self_keyword_ids}}'
                ]];
            }],

            'same_email_user' => ['email', function ($email) {

                return inst(User::class)->query()
                    ->lockForUpdate()
                    ->qWhere(User::EMAIL, $email)
                    ->first();
            }]
        ];
    }

    public static function getArrPromiseLists()
    {
        return [
            'created'
                => ['same_email_user']
        ];
    }

    public static function getArrRuleLists()
    {
        return [
            'birth'
                => ['required', 'date_format:Y-m-d'],

            'email'
                => ['required', 'string', 'email'],

            'gender'
                => ['required', 'string', 'in:' . implode(',', User::GENDER_VALUES)],

            'name'
                => ['required', 'string'],

            'password'
                => ['required', 'string', 'min:6'],

            'same_email_user'
                => ['null']
        ];
    }

    public static function getArrTraits()
    {
        return [
            CreatingService::class
        ];
    }

}
