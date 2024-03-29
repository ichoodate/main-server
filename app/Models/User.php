<?php

namespace App\Models;

use App\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable;
    use Authorizable;
    use CanResetPassword;
    use MustVerifyEmail;
    use Notifiable;
    public const BIRTH = 'birth';
    public const CREATED_AT = 'created_at';
    public const EMAIL = 'email';
    public const EMAIL_VERIFIED = 'email_verified';
    public const GENDER = 'gender';

    public const GENDER_MAN = 'man';

    public const GENDER_VALUES = [
        self::GENDER_MAN,
        self::GENDER_WOMAN,
    ];
    public const GENDER_WOMAN = 'woman';

    public const ID = 'id';
    public const NAME = 'name';
    public const PASSWORD = 'password';
    protected $casts = [
        self::ID => 'integer',
    ];
    protected $fillable = [
        self::ID,
        self::EMAIL,
        self::BIRTH,
        self::GENDER,
        self::PASSWORD,
        self::NAME,
        self::EMAIL_VERIFIED,
        self::CREATED_AT,
    ];
    protected $hidden = [
        self::PASSWORD,
    ];

    protected $table = 'users';

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
        return User::GENDER_MAN == $this->{User::GENDER} ? $this->relation(Matching::class, ['id', ':auth_user_id:'], ['man_id', 'woman_id'], false) : $this->relation(Matching::class, ['id', ':auth_user_id:'], ['woman_id', 'man_id'], false);
    }

    public function popularity()
    {
        return $this->relation(Popularity::class, ['id', ':auth_user_id:'], ['receiver_id', 'sender_id'], false);
    }

    public function roles()
    {
        return $this->hasMany(Role::class, 'user_id', 'id');
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
