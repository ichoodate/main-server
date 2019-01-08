<?php

namespace App\Database\Models;

use App\Database\Model;
use App\Database\Models\Ticket;
use App\Database\Models\User;

class Reply extends Model {

    protected $table = 'replies';
    protected $visible = [
        self::ID,
        self::TICKET_ID,
        self::WRITER_ID,
        self::DESCRIPTION,
        self::CREATED_AT,
        self::UPDATED_AT
    ];

    const TICKET_ID        = 'ticket_id';
    const WRITER_ID        = 'writer_id';
    const DESCRIPTION      = 'description';
    const CREATED_AT       = 'created_at';
    const UPDATED_AT       = 'updated_at';


    public function ticketQuery()
    {
        return inst(Ticket::class)->aliasQuery()
            ->qWhere(Ticket::ID, $this->{static::TICKET_ID});
    }

    public function writerQuery()
    {
        return inst(User::class)->aliasQuery()
            ->qWhere(User::ID, $this->{static::WRITER_ID});
    }

}
