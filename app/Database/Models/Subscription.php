<?php

namespace App\Database\Models;

use App\Database\Model;

class Subscription extends Model {

    protected $table = 'subscriptions';
    protected $casts = [
        self::ID => 'integer',
        self::USER_ID => 'integer',
        self::PAYMENT_ID => 'integer'
    ];
    protected $fillable = [
        self::ID,
        self::USER_ID,
        self::PAYMENT_ID,
        self::TYPE,
        self::CREATED_AT,
        self::DELETED_AT
    ];

    const ID         = 'id';
    const USER_ID    = 'user_id';
    const PAYMENT_ID = 'payment_id';
    const TYPE       = 'type';
    const CREATED_AT = 'created_at';
    const DELETED_AT = 'deleted_at';

    const TYPE_VALUES = ['level1', 'level2', 'level3'];

    public function getExpandable()
    {
        return ['payment', 'user'];
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id', 'id');
    }

    public function paymentQuery()
    {
        return inst(Payment::class)->query()
            ->qWhere(Payment::ID, $this->{static::PAYMENT_ID});
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function userQuery()
    {
        return inst(User::class)->query()
            ->qWhere(User::ID, $this->{static::USER_ID});
    }

}
