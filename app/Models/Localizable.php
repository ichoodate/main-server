<?php

namespace App\Models;

use App\Model;

class Localizable extends Model
{
    public const ID = 'id';
    public const KEYWORD_ID = 'keyword_id';
    public const LANGUAGE = 'language';

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
    public const TEXT = 'text';
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

    protected $table = 'localizables';

    public function keywordObj()
    {
        return $this->belongsTo(Obj::class, 'keyword_id', 'id');
    }
}
