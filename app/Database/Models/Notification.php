<?php

namespace App\Database\Models;

use App\Database\Model;
use App\Database\Models\Activity;
use App\Database\Models\User;

class Notification extends Model {

    protected $table = 'notifications';
    protected $casts = [
        self::ID => 'integer',
        self::USER_ID => 'integer',
        self::ACTIVITY_ID => 'integer'
    ];
    protected $fillable = [
        self::ID,
        self::USER_ID,
        self::ACTIVITY_ID,
        self::CREATED_AT,
        self::UPDATED_AT,
        self::DELETED_AT
    ];

    const ID          = 'id';
    const USER_ID     = 'user_id';
    const ACTIVITY_ID = 'activity_id';
    const CREATED_AT  = 'created_at';
    const UPDATED_AT  = 'updated_at';
    const DELETED_AT  = 'deleted_at';

    public function getExpandable()
    {
        return ['activity', 'user'];
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class, 'activity_id', 'id');
    }

    public function activityQuery()
    {
        return inst(Activity::class)->query()
            ->qWhere(Activity::ID, $this->{static::ACTIVITY_ID});
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
