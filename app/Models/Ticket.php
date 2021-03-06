<?php

namespace App\Models;

use App\Model;

class Ticket extends Model
{
    public const CREATED_AT = 'created_at';
    public const DESCRIPTION = 'description';
    public const ID = 'id';
    public const SUBJECT = 'subject';
    public const UPDATED_AT = 'updated_at';
    public const WRITER_ID = 'writer_id';
    protected $casts = [
        self::ID => 'integer',
        self::WRITER_ID => 'integer',
    ];
    protected $fillable = [
        self::ID,
        self::WRITER_ID,
        self::SUBJECT,
        self::DESCRIPTION,
        self::CREATED_AT,
        self::UPDATED_AT,
    ];

    protected $table = 'tickets';

    public function replies()
    {
        return $this->hasMany(Reply::class, 'ticket_id', 'id');
    }

    public function writer()
    {
        return $this->belongsTo(User::class, 'writer_id', 'id');
    }
}
