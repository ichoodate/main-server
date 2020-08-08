<?php

namespace App\Database\Models\Keyword;

use App\Database\Model;

class Language extends Model {

    protected $table = 'keyword_languages';
    protected $fillable = [
        self::ID,
        self::TYPE
    ];

    const ID   = 'id';
    const TYPE = 'type';

    const TYPE_DE_DE = 'de-DE';
    const TYPE_EL_GR = 'el-GR';
    const TYPE_EN_US = 'en-US';
    const TYPE_ES_ES = 'es-ES';
    const TYPE_FR_FR = 'fr-FR';
    const TYPE_IT_IT = 'it-IT';
    const TYPE_JA_JP = 'ja-JP';
    const TYPE_RU_RU = 'ru-RU';
    const TYPE_KO_KR = 'ko-KR';
    const TYPE_VI_VN = 'vi-VN';
    const TYPE_ZH_CN = 'zh-CN';
    const TYPE_ZH_TW = 'zh-TW';

    const TYPE_VALUES = [
        self::TYPE_DE_DE,
        self::TYPE_EL_GR,
        self::TYPE_EN_US,
        self::TYPE_ES_ES,
        self::TYPE_FR_FR,
        self::TYPE_IT_IT,
        self::TYPE_JA_JP,
        self::TYPE_RU_RU,
        self::TYPE_KO_KR,
        self::TYPE_VI_VN,
        self::TYPE_ZH_CN,
        self::TYPE_ZH_TW
    ];
}
