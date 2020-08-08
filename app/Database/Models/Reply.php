<?php

namespace App\Database\Models;

use App\Database\Model;
use App\Database\Models\Ticket;
use App\Database\Models\User;

class Reply extends Model {

    protected $table = 'replies';
    protected $casts = [
        self::ID => 'integer',
        self::TICKET_ID => 'integer',
        self::WRITER_ID => 'integer'
    ];

    protected $fillable = [
        self::ID,
        self::TICKET_ID,
        self::WRITER_ID,
        self::DESCRIPTION,
        self::CREATED_AT,
        self::UPDATED_AT
    ];

    const ID          = 'id';
    const TICKET_ID   = 'ticket_id';
    const WRITER_ID   = 'writer_id';
    const DESCRIPTION = 'description';
    const CREATED_AT  = 'created_at';
    const UPDATED_AT  = 'updated_at';

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id', 'id');
    }

    public function writer()
    {
        return $this->belongsTo(User::class, 'writer_id', 'id');
    }

}
