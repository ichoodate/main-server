<?php

namespace App\Database\Models;

use App\Database\Model;

class Invoice extends Model {

    protected $table = 'invoices';
    protected $casts = [
        self::ID => 'integer',
        self::USER_ID => 'integer'
    ];
    protected $fillable = [
        self::ID,
        self::USER_ID,
        self::CREATED_AT,
    ];

    const ID         = 'id';
    const USER_ID    = 'user_id';
    const CREATED_AT = 'created_at';

    public function getExpandable()
    {
        return ['user'];
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
