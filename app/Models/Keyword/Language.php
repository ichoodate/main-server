<?php

namespace App\Models\Keyword;

use App\Model;

class Language extends Model
{
    public const ID = 'id';
    public const TYPE = 'type';

    public const TYPE_DE_DE = 'de-DE';
    public const TYPE_EL_GR = 'el-GR';
    public const TYPE_EN_US = 'en-US';
    public const TYPE_ES_ES = 'es-ES';
    public const TYPE_FR_FR = 'fr-FR';
    public const TYPE_IT_IT = 'it-IT';
    public const TYPE_JA_JP = 'ja-JP';
    public const TYPE_KO_KR = 'ko-KR';
    public const TYPE_RU_RU = 'ru-RU';

    public const TYPE_VALUES = [
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
        self::TYPE_ZH_TW,
    ];
    public const TYPE_VI_VN = 'vi-VN';
    public const TYPE_ZH_CN = 'zh-CN';
    public const TYPE_ZH_TW = 'zh-TW';
    protected $fillable = [
        self::ID,
        self::TYPE,
    ];

    protected $table = 'keyword_languages';
}
