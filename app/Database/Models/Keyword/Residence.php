<?php

namespace App\Database\Models\Keyword;

use App\Database\Models\Obj;
use App\Database\Model;

class Residence extends Model {

    protected $table = 'keyword_residences';
    protected $fillable = [
        self::ID,
        self::PARENT_ID,
        self::RELATED_ID
    ];

    const ID         = 'id';
    const PARENT_ID  = 'parent_id';
    const RELATED_ID = 'related_id';

    const ENTITIES = [
        self::ID,
        self::PARENT_ID,
        self::RELATED_ID
    ];

    public function related()
    {
        return $this->belongsTo(Obj::class, 'related_id', 'id');
    }

}
