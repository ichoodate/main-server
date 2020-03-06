<?php

namespace App\Database\Models;

use App\Database\Model;
use App\Database\Models\Activity;
use App\Database\Models\Card;
use App\Database\Models\FacePhoto;
use App\Database\Models\UserIdealTypeKwdPvt;
use App\Database\Models\Match;
use App\Database\Models\UserSelfKwdPvt;
use App\Database\Models\ProfilePhoto;
use App\Database\Models\Popularity;
use App\Database\Models\Reply;
use App\Database\Models\Role;
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
        self::PASSWORD
    ];
    protected $casts = [
        self::ID => 'integer'
    ];
    protected $fillable = [
        self::ID,
        self::EMAIL,
        self::BIRTH,
        self::GENDER,
        self::PASSWORD,
        self::NAME,
        self::EMAIL_VERIFIED,
        self::CREATED_AT
    ];

    const ID             = 'id';
    const EMAIL          = 'email';
    const PASSWORD       = 'password';
    const BIRTH          = 'birth';
    const GENDER         = 'gender';
    const NAME           = 'name';
    const EMAIL_VERIFIED = 'email_verified';
    const CREATED_AT     = 'created_at';

    const GENDER_MAN   = 'man';
    const GENDER_WOMAN = 'woman';

    const GENDER_VALUES = [
        self::GENDER_MAN,
        self::GENDER_WOMAN
    ];

    public function getExpandable()
    {
        return ['facePhoto'];
    }

    public function activities()
    {
        return $this->hasMany(Activity::class, 'user_id', 'id');
    }

    public function activityQuery()
    {
        return inst(Activity::class)->query()
            ->qWhere(Activity::USER_ID, $this->{static::ID});
    }

    public function chooserCards()
    {
        return $this->hasMany(Card::class, 'chooser_id', 'id');
    }

    public function chooserCardQuery()
    {
        return inst(Card::class)->query()
            ->qWhere(Card::CHOOSER_ID, $this->{static::ID});
    }

    public function facePhoto()
    {
        return $this->hasOne(FacePhoto::class, 'user_id', 'id');
    }

    public function facePhotoQuery()
    {
        return inst(FacePhoto::class)->query()
            ->qWhere(FacePhoto::USER_ID, $this->{static::ID});
    }

    public function userIdealTypeKwdPvts()
    {
        return $this->hasMany(UserIdealTypeKwdPvt::class, 'user_id', 'id');
    }

    public function userIdealTypeKwdPvtQuery()
    {
        return inst(UserIdealTypeKwdPvt::class)->query()
            ->qWhere(UserIdealTypeKwdPvt::USER_ID, $this->{static::ID});
    }

    public function matches()
    {
        if ( $this->{static::GENDER} === static::GENDER_MAN )
        {
            return $this->hasMany(Match::class, 'man_id', 'id');
        }
        else if ( $this->{static::GENDER} === static::GENDER_WOMAN )
        {
            return $this->hasMany(Match::class, 'woman_id', 'id');
        }
    }

    public function matchQuery()
    {
        $query = inst(Match::class)->query();

        if ( $this->{static::GENDER} === static::GENDER_MAN )
        {
            return $query->qWhere(Match::MAN_ID, $this->{static::ID});
        }
        else if ( $this->{static::GENDER} === static::GENDER_WOMAN )
        {
            return $query->qWhere(Match::WOMAN_ID, $this->{static::ID});
        }
    }

    public function userSelfKwdPvts()
    {
        return $this->hasMany(UserSelfKwdPvt::class, 'user_id', 'id');
    }

    public function userSelfKwdPvtQuery()
    {
        return inst(UserSelfKwdPvt::class)->query()
            ->qWhere(UserSelfKwdPvt::USER_ID, $this->{static::ID});
    }

    public function profilePhotos()
    {
        return $this->hasMany(ProfilePhoto::class, 'user_id', 'id');
    }

    public function profilePhotoQuery()
    {
        return inst(ProfilePhoto::class)->query()
            ->qWhere(ProfilePhoto::USER_ID, $this->{static::ID});
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'writer_id', 'id');
    }

    public function ticketQuery()
    {
        return inst(Ticket::class)->query()
            ->qWhere(Ticket::WRITER_ID, $this->{static::ID});
    }

    public function receivedPopularities()
    {
        return $this->hasMany(Popularity::class, 'receiver_id', 'id');
    }

    public function receivedPopularityQuery()
    {
        return inst(Popularity::class)->query()
            ->qWhere(Popularity::RECEIVER_ID, $this->{static::ID});
    }

    public function replies()
    {
        return $this->hasMany(Reply::class, 'writer_id', 'id');
    }

    public function replyQuery()
    {
        return inst(Reply::class)->query()
            ->qWhere(Reply::WRITER_ID, $this->{static::ID});
    }

    public function roles()
    {
        return $this->hasMany(Role::class, 'user_id', 'id');
    }

    public function roleQuery()
    {
        return inst(Role::class)->query()
            ->qWhere(Role::USER_ID, $this->{static::ID});
    }

    public function sentPopularities()
    {
        return $this->hasMany(Popularity::class, 'sender_id', 'id');
    }

    public function sentPopularityQuery()
    {
        return inst(Popularity::class)->query()
            ->qWhere(Popularity::SENDER_ID, $this->{static::ID});
    }

    public function shownerCards()
    {
        return $this->hasMany(Card::class, 'showner_id', 'id');
    }

    public function shownerCardQuery()
    {
        return inst(Card::class)->query()
            ->qWhere(Card::SHOWNER_ID, $this->{static::ID});
    }

}
