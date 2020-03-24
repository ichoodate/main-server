<?php

namespace App\Database\Models;

use App\Database\Model;
use App\Database\Models\Reply;
use App\Database\Models\User;

class Ticket extends Model {

    protected $table = 'tickets';
    protected $casts = [
        self::ID => 'integer',
        self::WRITER_ID => 'integer'
    ];
    protected $fillable = [
        self::ID,
        self::WRITER_ID,
        self::SUBJECT,
        self::DESCRIPTION,
        self::CREATED_AT,
        self::UPDATED_AT
    ];

    const ID          = 'id';
    const WRITER_ID   = 'writer_id';
    const SUBJECT     = 'subject';
    const DESCRIPTION = 'description';
    const CREATED_AT  = 'created_at';
    const UPDATED_AT  = 'updated_at';

    public function getExpandable()
    {
        return ['replies', 'writer'];
    }

    public function replies()
    {
        return $this->hasMany(Reply::class, 'ticket_id', 'id');
    }

    public function writer()
    {
        return $this->belongsTo(User::class, 'writer_id', 'id');
    }

}
