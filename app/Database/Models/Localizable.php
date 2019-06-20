<?php

namespace App\Database\Models;

use App\Database\Model;
use App\Database\Models\Obj;

class Localizable extends Model {

    protected $table = 'localizables';
    protected $casts = [
        self::ID => 'integer',
        self::KEYWORD_ID => 'integer'
    ];
    protected $fillable = [
        self::ID,
        self::KEYWORD_ID,
        self::LANGUAGE,
        self::TEXT
    ];

    const ID         = 'id';
    const KEYWORD_ID = 'keyword_id';
    const LANGUAGE   = 'language';
    const TEXT       = 'text';

    const LANGUAGE_VALUES = [
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
        'zh-TW'
    ];

    public function getExpandable()
    {
        return ['keyword.concrete'];
    }

    public function keyword()
    {
        return $this->belongsTo(Obj::class, 'keyword_id', 'id');
    }

    public function keywordQuery()
    {
        return inst(Obj::class)->query()
            ->qWhere(Obj::ID, $this->{static::KEYWORD_ID});
    }

}
