<?php

namespace App\Database\Models;

use App\Database\Model;
use App\Database\Models\User;

class ProfilePhoto extends Model {

    protected $table = 'profile_photos';
    protected $casts = [
        self::ID => 'integer',
        self::USER_ID => 'integer'
    ];
    protected $fillable = [
        self::ID,
        self::USER_ID,
        self::DATA,
        self::CREATED_AT
    ];

    const ID          = 'id';
    const USER_ID     = 'user_id';
    const DATA        = 'data';
    const CREATED_AT  = 'created_at';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
