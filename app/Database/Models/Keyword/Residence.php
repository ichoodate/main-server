<?php

namespace App\Database\Models\Keyword;

use App\Database\Model;
use App\Database\Models\Obj;

class Residence extends Model
{
    public const ID = 'id';
    public const PARENT_ID = 'parent_id';
    public const RELATED_ID = 'related_id';

    public const ENTITIES = [
        self::ID,
        self::PARENT_ID,
        self::RELATED_ID,
    ];

    protected $table = 'keyword_residences';
    protected $fillable = [
        self::ID,
        self::PARENT_ID,
        self::RELATED_ID,
    ];

    public function related()
    {
        return $this->belongsTo(Obj::class, 'related_id', 'id');
    }
}
