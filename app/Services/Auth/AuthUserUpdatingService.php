<?php

namespace App\Services\Auth;

use App\Service;
use App\Database\Models\Keyword\BirthYear;
use App\Database\Models\User;
use App\Database\Models\UserSelfKwdPvt;

class AuthUserUpdatingService extends Service {

    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'auth_user.birth' => ['auth_user', 'birth', function ($authUser, $birth) {

                $keywordIds = inst(BirthYear::class)->query()
                    ->qSelect(BirthYear::ID)
                    ->getQuery();

                inst(UserSelfKwdPvt::class)->query()
                    ->qWhere(UserSelfKwdPvt::USER_ID, $authUser->getKey())
                    ->qWhereIn(UserSelfKwdPvt::KEYWORD_ID, $keywordIds)
                    ->delete();

                $keyword = inst(BirthYear::class)->query()
                    ->qWhere(BirthYear::TYPE, substr($birth, 0, 4))
                    ->first();

                inst(UserSelfKwdPvt::class)->create([
                    UserSelfKwdPvt::USER_ID => $authUser->getKey(),
                    UserSelfKwdPvt::KEYWORD_ID => $keyword->getKey()
                ]);

                $authUser->{User::BIRTH} = $birth;
                $authUser->save();
            }],

            'auth_user.name' => ['auth_user', 'name', function ($authUser, $name) {

                $authUser->{User::NAME} = $name;
                $authUser->save();
            }],

            'auth_user.email' => ['auth_user', 'email', function ($authUser, $email) {

                $authUser->{User::EMAIL} = $email;
                $authUser->{User::EMAIL_VERIFIED} = false;
                $authUser->save();

                // inst(EmailVerfication::class)->create([
                //     EmailVerfication::EMAIL => $email,
                //     EmailVerfication::CODE => str_random(6)
                // ]);

                // TODO: send email with code
            }]
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'result' => ['auth_user', function ($authUser) {

                return $authUser;
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
            'auth_user'
                => ['required'],

            'birth'
                => ['string', 'date_format:Y-m-d'],

            'email'
                => ['string', 'email'],

            'name'
                => ['string']
        ];
    }

    public static function getArrTraits()
    {
        return [];
    }

}
