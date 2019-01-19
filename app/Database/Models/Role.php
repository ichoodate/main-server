<?php

namespace App\Database\Models;

use App\Database\Model;
use App\Database\Models\RoleUser;

class Role extends Model {

    protected $table = 'roles';
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer'
    ];
    protected $visible = [
        self::ID,
        self::USER_ID,
        self::TYPE
    ];

    const USER_ID = 'user_id';
    const TYPE    = 'type';

    const TYPE_ADMIN  = 'admin';
    const TYPE_NORMAL = 'normal';

    const TYPE_VALUES = [
        self::TYPE_ADMIN,
        self::TYPE_NORMAL
    ];

    public function roleUserQuery()
    {
        return inst(RoleUser::class)->aliasQuery()
            ->qWhere(RoleUser::ROLE_ID, $this->{static::ID});
    }

}
