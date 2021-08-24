<?php

namespace App\Models\Keyword;

use App\Model;

class Language extends Model
{
    public const ID = 'id';
    public const TYPE = 'type';
    public const TYPE_VALUES = [
        'de-DE',
        'el-GR',
        'en-US',
        'es-ES',
        'fr-FR',
        'it-IT',
        'ja-JP',
        'ko-KR',
        'ru-RU',
        'vi-VN',
        'zh-CN',
        'zh-TW',
    ];

    protected $fillable = [
        self::ID,
        self::TYPE,
    ];

    protected $table = 'keyword_languages';
}
