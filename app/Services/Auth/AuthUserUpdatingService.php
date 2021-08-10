<?php

namespace App\Services\Auth;

use App\Database\Models\Keyword\BirthYear;
use App\Database\Models\User;
use App\Database\Models\UserSelfKwdPvt;
use FunctionalCoding\Service;

class AuthUserUpdatingService extends Service
{
    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'auth_user.birth' => function ($authUser, $birth) {
                $keywordIds = (new BirthYear())->query()
                    ->qSelect(BirthYear::ID)
                    ->getQuery()
                ;

                (new UserSelfKwdPvt())->query()
                    ->qWhere(UserSelfKwdPvt::USER_ID, $authUser->getKey())
                    ->qWhereIn(UserSelfKwdPvt::KEYWORD_ID, $keywordIds)
                    ->delete()
                ;

                $keyword = (new BirthYear())->query()
                    ->qWhere(BirthYear::TYPE, substr($birth, 0, 4))
                    ->first()
                ;

                (new UserSelfKwdPvt())->create([
                    UserSelfKwdPvt::USER_ID => $authUser->getKey(),
                    UserSelfKwdPvt::KEYWORD_ID => $keyword->getKey(),
                ]);

                $authUser->{User::BIRTH} = $birth;
                $authUser->save();
            },

            'auth_user.email' => function ($authUser, $email) {
                $authUser->{User::EMAIL} = $email;
                $authUser->{User::EMAIL_VERIFIED} = false;
                $authUser->save();

            // (new EmailVerfication)->create([
                //     EmailVerfication::EMAIL => $email,
                //     EmailVerfication::CODE => str_random(6)
                // ]);

                // TODO: send email with code
            },

            'auth_user.name' => function ($authUser, $name) {
                $authUser->{User::NAME} = $name;
                $authUser->save();
            },
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'result' => function ($authUser) {
                return $authUser;
            },
        ];
    }

    public static function getArrPromiseLists()
    {
        return [];
    }

    public static function getArrRuleLists()
    {
        return [
            'auth_user' => ['required'],

            'birth' => ['string', 'date_format:Y-m-d'],

            'email' => ['string', 'email'],

            'name' => ['string'],
        ];
    }

    public static function getArrTraits()
    {
        return [];
    }
}
