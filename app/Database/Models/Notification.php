<?php

namespace App\Database\Models;

use App\Database\Model;
use App\Database\Models\Obj;
use App\Database\Models\User;

class Notification extends Model {

    protected $table = 'notifications';
    protected $casts = [
        self::ID         => 'integer',
        self::USER_ID    => 'integer',
        self::RELATED_ID => 'integer'
    ];
    protected $fillable = [
        self::ID,
        self::USER_ID,
        self::RELATED_ID,
        self::CREATED_AT,
        self::UPDATED_AT,
        self::DELETED_AT
    ];

    const ID         = 'id';
    const USER_ID    = 'user_id';
    const RELATED_ID = 'related_id';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';

    public function getExpandable()
    {
        return ['related', 'user'];
    }

    public function related()
    {
        return $this->belongsTo(Obj::class, 'related_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
