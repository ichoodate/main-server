<?php

namespace App\Models;

use App\Model;

class Subscription extends Model
{
    public const ID = 'id';
    public const USER_ID = 'user_id';
    public const PAYMENT_ID = 'payment_id';
    public const TYPE = 'type';
    public const CREATED_AT = 'created_at';
    public const DELETED_AT = 'deleted_at';

    public const TYPE_VALUES = ['level1', 'level2', 'level3'];

    protected $table = 'subscriptions';
    protected $casts = [
        self::ID => 'integer',
        self::USER_ID => 'integer',
        self::PAYMENT_ID => 'integer',
    ];
    protected $fillable = [
        self::ID,
        self::USER_ID,
        self::PAYMENT_ID,
        self::TYPE,
        self::CREATED_AT,
        self::DELETED_AT,
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
