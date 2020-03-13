<?php

namespace Tests\Unit\App\Database\Models;

use App\Database\Models\Card;
use App\Database\Models\CardFlip;
use App\Database\Models\FacePhoto;
use App\Database\Models\UserIdealTypeKwdPvt;
use App\Database\Models\Match;
use App\Database\Models\Popularity;
use App\Database\Models\ProfilePhoto;
use App\Database\Models\UserSelfKwdPvt;
use App\Database\Models\Reply;
use App\Database\Models\Role;
use App\Database\Models\Ticket;
use App\Database\Models\User;
use Tests\Unit\App\Database\Models\_TestCase;

class UserTest extends _TestCase {

    public function testCardFlipQuery()
    {
        $this->assertHasOneOrManyQuery(
            'cardFlip',
            CardFlip::class,
            CardFlip::USER_ID
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

    public function testUserIdealTypeKwdPvtQuery()
    {
        $this->assertHasOneOrManyQuery(
            'userIdealTypeKwdPvt',
            UserIdealTypeKwdPvt::class,
            UserIdealTypeKwdPvt::USER_ID
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

    public function testUserSelfKwdPvtQuery()
    {
        $this->assertHasOneOrManyQuery(
            'userSelfKwdPvt',
            UserSelfKwdPvt::class,
            UserSelfKwdPvt::USER_ID
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

    public function testRoleQuery()
    {
        $this->assertHasOneOrManyQuery(
            'role',
            Role::class,
            Role::USER_ID
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

    public function testTicketQuery()
    {
        $this->assertHasOneOrManyQuery(
            'ticket',
            Ticket::class,
            Ticket::WRITER_ID
        );
    }

}
