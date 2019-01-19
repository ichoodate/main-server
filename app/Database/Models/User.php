<?php

namespace App\Database\Models;

use App\Database\Model;
use App\Database\Models\Activity;
use App\Database\Models\Card;
use App\Database\Models\FacePhoto;
use App\Database\Models\IdealTypable;
use App\Database\Models\Match;
use App\Database\Models\Profilable;
use App\Database\Models\ProfilePhoto;
use App\Database\Models\Popularity;
use App\Database\Models\Reply;
use App\Database\Models\RoleUser;
use App\Database\Models\Ticket;
use App\Database\Models\User;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;

class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail, Notifiable;

    protected $table = 'users';
    protected $hidden = [
        self::PASSWORD,
        self::REMEMBER_TOKEN
    ];
    protected $casts = [
        'id' => 'integer'
    ];
    protected $visible = [
        self::ID,
        self::EMAIL,
        self::GENDER,
        self::PASSWORD,
        self::BIRTH,
        self::NAME,
        self::ACTIVE,
        self::COIN,
        self::REMEMBER_TOKEN,
        self::CREATED_AT
    ];

    const ACTIVE         = 'active';
    const BIRTH          = 'birth';
    const COIN           = 'coin';
    const CREATED_AT     = 'created_at';
    const EMAIL          = 'email';
    const GENDER         = 'gender';
    const NAME           = 'name';
    const PASSWORD       = 'password';
    const REMEMBER_TOKEN = 'remember_token';

    const GENDER_MAN   = 'man';
    const GENDER_WOMAN = 'woman';

    const GENDER_VALUES = [
        self::GENDER_MAN,
        self::GENDER_WOMAN
    ];

    public function activityQuery()
    {
        return inst(Activity::class)->aliasQuery()
            ->qWhere(Activity::USER_ID, $this->{static::ID});
    }

    public function chooserCardQuery()
    {
        return inst(Card::class)->aliasQuery()
            ->qWhere(Card::CHOOSER_ID, $this->{static::ID});
    }

    public function facePhotoQuery()
    {
        return inst(FacePhoto::class)->aliasQuery()
            ->qWhere(FacePhoto::USER_ID, $this->{static::ID});
    }

    public function idealTypableQuery()
    {
        return inst(IdealTypable::class)->aliasQuery()
            ->qWhere(IdealTypable::USER_ID, $this->{static::ID});
    }

    public function matchQuery()
    {
        $query = inst(Match::class)->aliasQuery();
        if ( $this->{static::GENDER} === static::GENDER_MAN )
        {
            return $query->qWhere(Match::MAN_ID, $this->{static::ID});
        }
        else if ( $this->{static::GENDER} === static::GENDER_WOMAN )
        {
            return $query->qWhere(Match::WOMAN_ID, $this->{static::ID});
        }
    }

    public function profilableQuery()
    {
        return inst(Profilable::class)->aliasQuery()
            ->qWhere(Profilable::USER_ID, $this->{static::ID});
    }

    public function profilePhotoQuery()
    {
        return inst(ProfilePhoto::class)->aliasQuery()
            ->qWhere(ProfilePhoto::USER_ID, $this->{static::ID});
    }

    public function questionQuery()
    {
        return inst(Ticket::class)->aliasQuery()
            ->qWhere(Ticket::WRITER_ID, $this->{static::ID});
    }

    public function receivedPopularityQuery()
    {
        return inst(Popularity::class)->aliasQuery()
            ->qWhere(Popularity::RECEIVER_ID, $this->{static::ID});
    }

    public function replyQuery()
    {
        return inst(Reply::class)->aliasQuery()
            ->qWhere(Reply::WRITER_ID, $this->{static::ID});
    }

    public function roleUserQuery()
    {
        return inst(RoleUser::class)->aliasQuery()
            ->qWhere(RoleUser::USER_ID, $this->{static::ID});
    }

    public function sentPopularityQuery()
    {
        return inst(Popularity::class)->aliasQuery()
            ->qWhere(Popularity::SENDER_ID, $this->{static::ID});
    }

    public function shownerCardQuery()
    {
        return inst(Card::class)->aliasQuery()
            ->qWhere(Card::SHOWNER_ID, $this->{static::ID});
    }

}
