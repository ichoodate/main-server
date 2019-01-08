<?php

namespace App\Database\Models;

use App\Database\Model;
use App\Database\Models\Reply;
use App\Database\Models\User;

class Ticket extends Model {

    protected $table = 'tickets';
    protected $visible = [
        self::ID,
        self::WRITER_ID,
        self::SUBJECT,
        self::DESCRIPTION,
        self::CREATED_AT,
        self::UPDATED_AT
    ];

    const WRITER_ID   = 'writer_id';
    const SUBJECT     = 'subject';
    const DESCRIPTION = 'description';
    const CREATED_AT  = 'created_at';
    const UPDATED_AT  = 'updated_at';


    public function replyQuery()
    {
        return inst(Reply::class)->aliasQuery()
            ->qWhere(Reply::TICKET_ID, $this->{static::ID});
    }

    public function writerQuery()
    {
        return inst(User::class)->aliasQuery()
            ->qWhere(User::ID, $this->{static::WRITER_ID});
    }

}
