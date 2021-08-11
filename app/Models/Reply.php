<?php

namespace App\Models;

use App\Model;

class Reply extends Model
{
    public const ID = 'id';
    public const TICKET_ID = 'ticket_id';
    public const WRITER_ID = 'writer_id';
    public const DESCRIPTION = 'description';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    protected $table = 'replies';
    protected $casts = [
        self::ID => 'integer',
        self::TICKET_ID => 'integer',
        self::WRITER_ID => 'integer',
    ];

    protected $fillable = [
        self::ID,
        self::TICKET_ID,
        self::WRITER_ID,
        self::DESCRIPTION,
        self::CREATED_AT,
        self::UPDATED_AT,
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id', 'id');
    }

    public function writer()
    {
        return $this->belongsTo(User::class, 'writer_id', 'id');
    }
}
