<?php

namespace App\Database\Models;

use App\Database\Model;
use App\Database\Models\Obj;

class Localizable extends Model {

    protected $table = 'Localizables';
    protected $visible = [
        self::ID,
        self::KEYWORD_ID,
        self::LANGUAGE,
        self::TEXT
    ];

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

    public function objQuery()
    {
        return inst(Obj::class)->aliasQuery()
            ->qWhere(Obj::ID, $this->{static::KEYWORD_ID});
    }

}
