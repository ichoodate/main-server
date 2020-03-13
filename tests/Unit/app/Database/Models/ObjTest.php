<?php

namespace Tests\Unit\App\Database\Models;

use App\Database\Models\Card;
use App\Database\Models\CardFlip;
use App\Database\Models\CardGroup;
use App\Database\Models\Coin;
use App\Database\Models\ChattingContent;
use App\Database\Models\FacePhoto;
use App\Database\Models\UserIdealTypeKwdPvt;
use App\Database\Models\Keyword;
use App\Database\Models\Obj;
use App\Database\Models\Match;
use App\Database\Models\Notification;
use App\Database\Models\Payment;
use App\Database\Models\Popularity;
use App\Database\Models\UserSelfKwdPvt;
use App\Database\Models\ProfilePhoto;
use App\Database\Models\Notice;
use App\Database\Models\Ticket;
use App\Database\Models\Reply;
use App\Database\Models\Role;
use App\Database\Models\User;
use Tests\Unit\App\Database\Models\_TestCase;

class ObjTest extends _TestCase {

    public function testConcreteQuery()
    {
        $func = function ($type, $class) {

            $this->assertHasOneOrManyQuery(
                'concrete',
                $class,
                $class::ID, [
                Obj::TYPE => $type
            ]);
        };

        foreach ( [
            Obj::TYPE_CARD
                => Card::class,
            Obj::TYPE_CARD_FLIP
                => CardFlip::class,
            Obj::TYPE_CARD_GROUP
                => CardGroup::class,
            Obj::TYPE_CHATTING_CONTENT
                => ChattingContent::class,
            Obj::TYPE_COIN
                => Coin::class,
            Obj::TYPE_FACE_PHOTO
                => FacePhoto::class,
            Obj::TYPE_KEYWORD_AGE_RANGE
                => Keyword\AgeRange::class,
            Obj::TYPE_KEYWORD_BIRTH_YEAR
                => Keyword\BirthYear::class,
            Obj::TYPE_KEYWORD_BLOOD
                => Keyword\Blood::class,
            Obj::TYPE_KEYWORD_BODY
                => Keyword\Body::class,
            Obj::TYPE_KEYWORD_CAREER
                => Keyword\Career::class,
            Obj::TYPE_KEYWORD_COUNTRY
                => Keyword\Country::class,
            Obj::TYPE_KEYWORD_DRINK
                => Keyword\Drink::class,
            Obj::TYPE_KEYWORD_EDU_BG
                => Keyword\EduBg::class,
            Obj::TYPE_KEYWORD_HOBBY
                => Keyword\Hobby::class,
            Obj::TYPE_KEYWORD_LANGUAGE
                => Keyword\Language::class,
            Obj::TYPE_KEYWORD_NATIONALITY
                => Keyword\Nationality::class,
            Obj::TYPE_KEYWORD_RELIGION
                => Keyword\Religion::class,
            Obj::TYPE_KEYWORD_RESIDENCE
                => Keyword\Residence::class,
            Obj::TYPE_KEYWORD_SMOKE
                => Keyword\Smoke::class,
            Obj::TYPE_KEYWORD_STATURE
                => Keyword\Stature::class,
            Obj::TYPE_KEYWORD_STATURE_RANGE
                => Keyword\StatureRange::class,
            Obj::TYPE_KEYWORD_WEIGHT
                => Keyword\Weight::class,
            Obj::TYPE_KEYWORD_WEIGHT_RANGE
                => Keyword\WeightRange::class,
            Obj::TYPE_MATCH
                => Match::class,
            Obj::TYPE_NOTICE
                => Notice::class,
            Obj::TYPE_NOTIFICATION
                => Notification::class,
            Obj::TYPE_PAYMENT
                => Payment::class,
            Obj::TYPE_POPULARITY
                => Popularity::class,
            Obj::TYPE_PROFILE_PHOTO
                => ProfilePhoto::class,
            Obj::TYPE_QUESTION_POST
                => Ticket::class,
            Obj::TYPE_REPLY_POST
                => Reply::class,
            Obj::TYPE_ROLE
                => Role::class,
            Obj::TYPE_USER
                => User::class,
            Obj::TYPE_USER_IDEAL_TYPE_KWD_PVT
                => UserIdealTypeKwdPvt::class,
            Obj::TYPE_USER_SELF_KWD_PVT
                => UserSelfKwdPvt::class,
        ] as $type => $class )
        {
            call_user_func($func, $type, $class);
        }
    }

}
