<?php

namespace App\Database\Models;

use App\Database\Model;
use App\Database\Models\Keyword\State;

class ResidenceState extends Model {

    protected $table = 'keyword_residence_states';
    protected $visible = [
        self::ID,
        self::TYPE
    ];

    const STATE_ID = 'state_id';

    const ENTITIES = [
        self::ID,
        self::STATE_ID
    ];

    public function stateQuery()
    {
        return inst(State::class)->aliasQuery()
            ->qWhere(State::ID, $this->{static::STATE_ID});
    }

}
