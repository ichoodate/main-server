<?php

namespace App\Database\Models;

use App\Database\Model;
use App\Database\Models\Obj;
use App\Database\Models\User;

class Profilable extends Model {

    protected $table = 'profilables';
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
