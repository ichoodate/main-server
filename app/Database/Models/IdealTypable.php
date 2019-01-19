<?php

namespace App\Database\Models;

use App\Database\Model;
use App\Database\Models\Obj;
use App\Database\Models\User;

class IdealTypable extends Model {

    protected $table = 'ideal_typables';
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'keyword_id' => 'integer'
    ];
    protected $visible = [
        self::ID,
        self::USER_ID,
        self::KEYWORD_ID,
        self::CREATED_AT,
        self::DELETED_AT
    ];

    const USER_ID      = 'user_id';
    const KEYWORD_ID   = 'keyword_id';
    const CREATED_AT   = 'created_at';
    const UPDATED_AT   = 'updated_at';
    const DELETED_AT   = 'deleted_at';


    public function objQuery()
    {
        return inst(Obj::class)->aliasQuery()
            ->qWhere(Obj::ID, $this->{static::KEYWORD_ID});
    }

    public function userQuery()
    {
        return inst(User::class)->aliasQuery()
            ->qWhere(User::ID, $this->{static::USER_ID});
    }

}
