<?php

namespace App\Database\Models;

use App\Database\Model;

class Notification extends Model
{
    public const ID = 'id';
    public const USER_ID = 'user_id';
    public const RELATED_ID = 'related_id';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';
    public const DELETED_AT = 'deleted_at';

    protected $table = 'notifications';
    protected $casts = [
        self::ID => 'integer',
        self::USER_ID => 'integer',
        self::RELATED_ID => 'integer',
    ];
    protected $fillable = [
        self::ID,
        self::USER_ID,
        self::RELATED_ID,
        self::CREATED_AT,
        self::UPDATED_AT,
        self::DELETED_AT,
    ];

    public function related()
    {
        return $this->belongsTo(Obj::class, 'related_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
