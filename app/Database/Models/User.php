<?php

namespace App\Database\Models;

use App\Database\Model;
use App\Database\Models\FacePhoto;
use App\Database\Models\Friend;
use App\Database\Models\Match;
use App\Database\Models\Popularity;
use App\Database\Models\User;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

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

    public function facePhoto()
    {
        return $this->hasOne(FacePhoto::class, 'user_id', 'id');
    }

    public function friend()
    {
        return $this->relation(Friend::class, ['id', ':auth_user_id:'], ['receiver_id', 'sender_id'], false);
    }

    public function match()
    {
        return $this->{User::GENDER} == User::GENDER_MAN ? $this->relation(Match::class, ['id', ':auth_user_id:'], ['man_id', 'woman_id'], false) : $this->relation(Match::class, ['id', ':auth_user_id:'], ['woman_id', 'man_id'], false);
    }

    public function popularity()
    {
        return $this->relation(Popularity::class, ['id', ':auth_user_id:'], ['receiver_id', 'sender_id'], false);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

}
