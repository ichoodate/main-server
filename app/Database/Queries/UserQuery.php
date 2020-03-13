<?php

namespace App\Database\Queries;

use App\Database\Models\Card;
use App\Database\Models\CardFlip;
use App\Database\Models\FacePhoto;
use App\Database\Models\UserIdealTypeKwdPvt;
use App\Database\Models\Match;
use App\Database\Models\UserSelfKwdPvt;
use App\Database\Models\ProfilePhoto;
use App\Database\Models\Popularity;
use App\Database\Models\Ticket;
use App\Database\Models\Reply;
use App\Database\Models\Role;
use App\Database\Models\User;
use App\Database\Query;

class UserQuery extends Query {

    public function cardFlipQuery()
    {
        $subQuery = $this->qSelect(User::ID)->getQuery();

        return inst(CardFlip::class)->query()
            ->qWhereIn(CardFlip::USER_ID, $subQuery);
    }

    public function chooserCardQuery()
    {
        $subQuery = $this->qSelect(User::ID)->getQuery();

        return inst(Card::class)->query()
            ->qWhereIn(Card::CHOOSER_ID, $subQuery);
    }

    public function facePhotoQuery()
    {
        $subQuery = $this->qSelect(User::ID)->getQuery();

        return inst(FacePhoto::class)->query()
            ->qWhereIn(FacePhoto::USER_ID, $subQuery);
    }

    public function userIdealTypeKwdPvtQuery()
    {
        $subQuery = $this->qSelect(User::ID)->getQuery();

        return inst(UserIdealTypeKwdPvt::class)->query()
            ->qWhereIn(UserIdealTypeKwdPvt::USER_ID, $subQuery);
    }

    public function userSelfKwdPvtQuery()
    {
        $subQuery = $this->qSelect(User::ID)->getQuery();

        return inst(UserSelfKwdPvt::class)->query()
            ->qWhereIn(UserSelfKwdPvt::USER_ID, $subQuery);
    }

    public function profilePhotoQuery()
    {
        $subQuery = $this->qSelect(User::ID)->getQuery();

        return inst(ProfilePhoto::class)->query()
            ->qWhereIn(ProfilePhoto::USER_ID, $subQuery);
    }

    public function ticketQuery()
    {
        $subQuery = $this->qSelect(User::ID)->getQuery();

        return inst(Ticket::class)->query()
            ->qWhereIn(Ticket::WRITER_ID, $subQuery);
    }

    public function receivedPopularityQuery()
    {
        $subQuery = $this->qSelect(User::ID)->getQuery();

        return inst(Popularity::class)->query()
            ->qWhereIn(Popularity::RECEIVER_ID, $subQuery);
    }

    public function replyQuery()
    {
        $subQuery = $this->qSelect(User::ID)->getQuery();

        return inst(Reply::class)->query()
            ->qWhereIn(Reply::WRITER_ID, $subQuery);
    }

    public function roleQuery()
    {
        $subQuery = $this->qSelect(User::ID)->getQuery();

        return inst(Role::class)->query()
            ->qWhereIn(Role::USER_ID, $subQuery);
    }

    public function sentPopularityQuery()
    {
        $subQuery = $this->qSelect(User::ID)->getQuery();

        return inst(Popularity::class)->query()
            ->qWhereIn(Popularity::SENDER_ID, $subQuery);
    }

    public function shownerCardQuery()
    {
        $subQuery = $this->qSelect(User::ID)->getQuery();

        return inst(Card::class)->query()
            ->qWhereIn(Card::SHOWNER_ID, $subQuery);
    }

}
