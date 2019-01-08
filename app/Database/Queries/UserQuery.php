<?php

namespace App\Database\Queries;

use App\Database\Models\Activity;
use App\Database\Models\Card;
use App\Database\Models\FacePhoto;
use App\Database\Models\IdealTypable;
use App\Database\Models\Match;
use App\Database\Models\Profilable;
use App\Database\Models\ProfilePhoto;
use App\Database\Models\Popularity;
use App\Database\Models\Ticket;
use App\Database\Models\Reply;
use App\Database\Models\RoleUser;
use App\Database\Models\User;
use App\Database\Query;

class UserQuery extends Query {

    public function activityQuery()
    {
        $subQuery = $this->qSelect(User::ID)->getQuery();

        return inst(Activity::class)->aliasQuery()
            ->qWhereIn(Activity::USER_ID, $subQuery);
    }

    public function chooserCardQuery()
    {
        $subQuery = $this->qSelect(User::ID)->getQuery();

        return inst(Card::class)->aliasQuery()
            ->qWhereIn(Card::CHOOSER_ID, $subQuery);
    }

    public function facePhotoQuery()
    {
        $subQuery = $this->qSelect(User::ID)->getQuery();

        return inst(FacePhoto::class)->aliasQuery()
            ->qWhereIn(FacePhoto::USER_ID, $subQuery);
    }

    public function idealTypableQuery()
    {
        $subQuery = $this->qSelect(User::ID)->getQuery();

        return inst(IdealTypable::class)->aliasQuery()
            ->qWhereIn(IdealTypable::USER_ID, $subQuery);
    }

    public function profilableQuery()
    {
        $subQuery = $this->qSelect(User::ID)->getQuery();

        return inst(Profilable::class)->aliasQuery()
            ->qWhereIn(Profilable::USER_ID, $subQuery);
    }

    public function profilePhotoQuery()
    {
        $subQuery = $this->qSelect(User::ID)->getQuery();

        return inst(ProfilePhoto::class)->aliasQuery()
            ->qWhereIn(ProfilePhoto::USER_ID, $subQuery);
    }

    public function questionQuery()
    {
        $subQuery = $this->qSelect(User::ID)->getQuery();

        return inst(Ticket::class)->aliasQuery()
            ->qWhereIn(Ticket::WRITER_ID, $subQuery);
    }

    public function receivedPopularityQuery()
    {
        $subQuery = $this->qSelect(User::ID)->getQuery();

        return inst(Popularity::class)->aliasQuery()
            ->qWhereIn(Popularity::RECEIVER_ID, $subQuery);
    }

    public function replyQuery()
    {
        $subQuery = $this->qSelect(User::ID)->getQuery();

        return inst(Reply::class)->aliasQuery()
            ->qWhereIn(Reply::WRITER_ID, $subQuery);
    }

    public function roleUserQuery()
    {
        $subQuery = $this->qSelect(User::ID)->getQuery();

        return inst(RoleUser::class)->aliasQuery()
            ->qWhereIn(RoleUser::USER_ID, $subQuery);
    }

    public function sentPopularityQuery()
    {
        $subQuery = $this->qSelect(User::ID)->getQuery();

        return inst(Popularity::class)->aliasQuery()
            ->qWhereIn(Popularity::SENDER_ID, $subQuery);
    }

    public function shownerCardQuery()
    {
        $subQuery = $this->qSelect(User::ID)->getQuery();

        return inst(Card::class)->aliasQuery()
            ->qWhereIn(Card::SHOWNER_ID, $subQuery);
    }

}
