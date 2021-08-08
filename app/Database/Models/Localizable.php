<?php

namespace App\Database\Models;

use App\Database\Model;

class Localizable extends Model
{
    public const ID = 'id';
    public const KEYWORD_ID = 'keyword_id';
    public const LANGUAGE = 'language';
    public const TEXT = 'text';

    public const LANGUAGE_VALUES = [
        'de-DE',
        'el-GR',
        'en-US',
        'es-ES',
        'fr-FR',
        'it-IT',
        'ja-JP',
        'ru-RU',
        'ko-KR',
        'vi-VN',
        'zh-CN',
        'zh-TW',
    ];

    protected $table = 'localizables';
    protected $casts = [
        self::ID => 'integer',
        self::KEYWORD_ID => 'integer',
    ];
    protected $fillable = [
        self::ID,
        self::KEYWORD_ID,
        self::LANGUAGE,
        self::TEXT,
    ];

    public function keyword()
    {
        return $this->belongsTo(Obj::class, 'keyword_id', 'id');
    }
}
