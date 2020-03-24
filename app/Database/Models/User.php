<?php

namespace App\Database\Models;

use App\Database\Model;
use App\Database\Models\Card;
use App\Database\Models\CardFlip;
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

    public function cardFlips()
    {
        return $this->hasMany(CardFlip::class, 'user_id', 'id');
    }

    public function chooserCards()
    {
        return $this->hasMany(Card::class, 'chooser_id', 'id');
    }

    public function facePhoto()
    {
        return $this->hasOne(FacePhoto::class, 'user_id', 'id');
    }

    public function userIdealTypeKwdPvts()
    {
        return $this->hasMany(UserIdealTypeKwdPvt::class, 'user_id', 'id');
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

    public function userSelfKwdPvts()
    {
        return $this->hasMany(UserSelfKwdPvt::class, 'user_id', 'id');
    }

    public function profilePhotos()
    {
        return $this->hasMany(ProfilePhoto::class, 'user_id', 'id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'writer_id', 'id');
    }

    public function receivedPopularities()
    {
        return $this->hasMany(Popularity::class, 'receiver_id', 'id');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class, 'writer_id', 'id');
    }

    public function roles()
    {
        return $this->hasMany(Role::class, 'user_id', 'id');
    }

    public function sentPopularities()
    {
        return $this->hasMany(Popularity::class, 'sender_id', 'id');
    }

    public function shownerCards()
    {
        return $this->hasMany(Card::class, 'showner_id', 'id');
    }

}
