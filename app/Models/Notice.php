<?php

namespace App\Models;

use App\Model;

class Notice extends Model
{
    public const CREATED_AT = 'created_at';
    public const DESCRIPTION = 'description';
    public const ID = 'id';
    public const SUBJECT = 'subject';
    public const TYPE = 'type';
    public const TYPE_VALUES = [
        'notice',
        'event',
        'faq',
    ];
    public const UPDATED_AT = 'updated_at';

    protected $casts = [
        self::ID => 'integer',
    ];
    protected $fillable = [
        self::ID,
        self::TYPE,
        self::SUBJECT,
        self::DESCRIPTION,
        self::CREATED_AT,
        self::UPDATED_AT,
    ];

    protected $table = 'notices';
}
