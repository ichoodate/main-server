<?php

namespace App\Database\Models;

use App\Database\Model;
use App\Database\Models\Photo;

class Notice extends Model {

    protected $table = 'notices';
    protected $casts = [
        self::ID => 'integer'
    ];
    protected $fillable = [
        self::ID,
        self::TYPE,
        self::SUBJECT,
        self::DESCRIPTION,
        self::CREATED_AT,
        self::UPDATED_AT
    ];

    const ID          = 'id';
    const TYPE        = 'type';
    const SUBJECT     = 'subject';
    const DESCRIPTION = 'description';
    const CREATED_AT  = 'created_at';
    const UPDATED_AT  = 'updated_at';


    const TYPE_NOTICE  = 'notice';
    const TYPE_EVENT   = 'event';
    const TYPE_FAQ     = 'faq';

    const TYPE_VALUES = [
        self::TYPE_NOTICE,
        self::TYPE_EVENT,
        self::TYPE_FAQ
    ];

}
