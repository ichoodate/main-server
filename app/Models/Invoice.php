<?php

namespace App\Models;

use App\Model;

class Invoice extends Model
{
    public const CREATED_AT = 'created_at';
    public const ID = 'id';
    public const USER_ID = 'user_id';
    protected $casts = [
        self::ID => 'integer',
        self::USER_ID => 'integer',
    ];
    protected $fillable = [
        self::ID,
        self::USER_ID,
        self::CREATED_AT,
    ];

    protected $table = 'invoices';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
