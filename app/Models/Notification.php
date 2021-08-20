<?php

namespace App\Models;

use App\Model;

class Notification extends Model
{
    public const CREATED_AT = 'created_at';
    public const DELETED_AT = 'deleted_at';
    public const ID = 'id';
    public const RELATED_ID = 'related_id';
    public const UPDATED_AT = 'updated_at';
    public const USER_ID = 'user_id';
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

    protected $table = 'notifications';

    public function related()
    {
        return $this->belongsTo(Obj::class, 'related_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
