<?php

namespace App\Models\Keyword;

use App\Model;
use App\Models\Obj;

class Residence extends Model
{
    public const ENTITIES = [
        self::ID,
        self::PARENT_ID,
        self::RELATED_ID,
    ];
    public const ID = 'id';
    public const PARENT_ID = 'parent_id';
    public const RELATED_ID = 'related_id';
    protected $fillable = [
        self::ID,
        self::PARENT_ID,
        self::RELATED_ID,
    ];

    protected $table = 'keyword_residences';

    public function related()
    {
        return $this->belongsTo(Obj::class, 'related_id', 'id');
    }
}
