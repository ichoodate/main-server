<?php

namespace App\Services\Auth;

use App\Models\Keyword\BirthYear;
use App\Models\User;
use App\Models\UserKeyword;
use FunctionalCoding\Service;

class AuthUserUpdatingService extends Service
{
    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbacks()
    {
        return [
            'auth_user.birth' => function ($authUser, $birth) {
                $keywordIds = (new BirthYear())->query()
                    ->select(BirthYear::ID)
                    ->getQuery()
                ;

                (new UserKeyword())->query()
                    ->where(UserKeyword::USER_ID, $authUser->getKey())
                    ->whereIn(UserKeyword::KEYWORD_ID, $keywordIds)
                    ->delete()
                ;

                $keyword = (new BirthYear())->query()
                    ->where(BirthYear::TYPE, substr($birth, 0, 4))
                    ->first()
                ;

                (new UserKeyword())->create([
                    UserKeyword::USER_ID => $authUser->getKey(),
                    UserKeyword::KEYWORD_ID => $keyword->getKey(),
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
            'auth_user' => function ($authToken = '') {
                return [AuthUserFindingService::class, [
                    'auth_token' => $authToken,
                ], [
                    'auth_token' => '{{auth_token}}',
                ]];
            },

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
