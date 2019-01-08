<?php

namespace Tests\Unit\App\Database\Models;

use App\Database\Models\Activity;
use App\Database\Models\Card;
use App\Database\Models\CardAct;
use App\Database\Models\FacePhoto;
use App\Database\Models\IdealTypable;
use App\Database\Models\Match;
use App\Database\Models\MatchAct;
use App\Database\Models\Popularity;
use App\Database\Models\ProfilePhoto;
use App\Database\Models\Profilable;
use App\Database\Models\Reply;
use App\Database\Models\Ticket;
use App\Database\Models\RoleUser;
use App\Database\Models\User;

class UserTest extends _TestCase {

    public function testActivityQuery()
    {
        $this->assertHasOneOrManyQuery(
            'activity',
            Activity::class,
            Activity::USER_ID
        );
    }

    public function testChooserCardQuery()
    {
        $this->assertHasOneOrManyQuery(
            'chooserCard',
            Card::class,
            Card::CHOOSER_ID
        );
    }

    public function testFacePhotoQuery()
    {
        $this->assertHasOneOrManyQuery(
            'facePhoto',
            FacePhoto::class,
            FacePhoto::USER_ID
        );
    }

    public function testIdealTypableQuery()
    {
        $this->assertHasOneOrManyQuery(
            'idealTypable',
            IdealTypable::class,
            IdealTypable::USER_ID
        );
    }

    public function testMatchQuery()
    {
        $this->assertHasOneOrManyQuery(
            'match',
            Match::class,
            Match::MAN_ID, [
            User::GENDER => User::GENDER_MAN
        ]);

        $this->assertHasOneOrManyQuery(
            'match',
            Match::class,
            Match::WOMAN_ID, [
            User::GENDER => User::GENDER_WOMAN
        ]);
    }

    public function testProfilableQuery()
    {
        $this->assertHasOneOrManyQuery(
            'profilable',
            Profilable::class,
            Profilable::USER_ID
        );
    }

    public function testProfilePhotoQuery()
    {
        $this->assertHasOneOrManyQuery(
            'profilePhoto',
            ProfilePhoto::class,
            ProfilePhoto::USER_ID
        );
    }

    public function testQuestionQuery()
    {
        $this->assertHasOneOrManyQuery(
            'question',
            Ticket::class,
            Ticket::WRITER_ID
        );
    }

    public function testReceivedPopularityQuery()
    {
        $this->assertHasOneOrManyQuery(
            'receivedPopularity',
            Popularity::class,
            Popularity::RECEIVER_ID
        );
    }

    public function testReplyQuery()
    {
        $this->assertHasOneOrManyQuery(
            'reply',
            Reply::class,
            Reply::WRITER_ID
        );
    }

    public function testRoleUserQuery()
    {
        $this->assertHasOneOrManyQuery(
            'roleUser',
            RoleUser::class,
            RoleUser::USER_ID
        );
    }

    public function testSentPopularityQuery()
    {
        $this->assertHasOneOrManyQuery(
            'sentPopularity',
            Popularity::class,
            Popularity::SENDER_ID
        );
    }

    public function testShownerCardQuery()
    {
        $this->assertHasOneOrManyQuery(
            'shownerCard',
            Card::class,
            Card::SHOWNER_ID
        );
    }

}
