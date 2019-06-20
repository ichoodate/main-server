<?php

namespace App\Database\Models;

use App\Database\Model;
use App\Database\Models\Obj;
use App\Database\Models\User;

class UserSelfKwdPvt extends Model {

    protected $table = 'user_self_kwd_pvts';
    protected $casts = [
        self::ID => 'integer',
        self::USER_ID => 'integer',
        self::KEYWORD_ID => 'integer'
    ];
    protected $fillable = [
        self::ID,
        self::USER_ID,
        self::KEYWORD_ID
    ];

    const ID         = 'id';
    const USER_ID    = 'user_id';
    const KEYWORD_ID = 'keyword_id';

    public function getExpandable()
    {
        return ['keyword.concrete', 'user'];
    }

    public function keyword()
    {
        return $this->belongsTo(Obj::class, 'keyword_id', 'id');
    }

    public function keywordQuery()
    {
        return inst(Obj::class)->query()
            ->qWhere(Obj::ID, $this->{static::KEYWORD_ID});
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
