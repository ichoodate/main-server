<?php

namespace App\Models;

use App\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Obj extends Model
{
    public const ID = 'id';
    public const MODEL_CLASS = 'model_class';
    public const TYPE = 'type';

    public const TYPE_BALANCE = 'balance';
    public const TYPE_CARD = 'card';
    public const TYPE_CARD_FLIP = 'card_flip';
    public const TYPE_CARD_GROUP = 'card_group';
    public const TYPE_CHATTING_CONTENT = 'chatting_content';
    public const TYPE_COIN = 'coin';
    public const TYPE_FACE_PHOTO = 'face_photo';
    public const TYPE_IDEAL_TYPE_KEYWORD = 'ideal_type_keyword';
    public const TYPE_INVOICE = 'invoice';
    public const TYPE_KEYWORD_AGE_RANGE = 'keyword/age_range';
    public const TYPE_KEYWORD_BIRTH_YEAR = 'keyword/birth_year';
    public const TYPE_KEYWORD_BLOOD = 'keyword/blood';
    public const TYPE_KEYWORD_BODY = 'keyword/body';
    public const TYPE_KEYWORD_CAREER = 'keyword/career';
    public const TYPE_KEYWORD_COUNTRY = 'keyword/country';
    public const TYPE_KEYWORD_DRINK = 'keyword/drink';
    public const TYPE_KEYWORD_EDU_BG = 'keyword/edu_bg';
    public const TYPE_KEYWORD_HOBBY = 'keyword/hobby';
    public const TYPE_KEYWORD_LANGUAGE = 'keyword/language';
    public const TYPE_KEYWORD_NATIONALITY = 'keyword/nationality';
    public const TYPE_KEYWORD_RELIGION = 'keyword/religion';
    public const TYPE_KEYWORD_RESIDENCE = 'keyword/residence';
    public const TYPE_KEYWORD_SMOKE = 'keyword/smoke';
    public const TYPE_KEYWORD_STATE = 'keyword/state';
    public const TYPE_KEYWORD_STATURE = 'keyword/stature';
    public const TYPE_KEYWORD_STATURE_RANGE = 'keyword/stature_range';

    public const TYPE_KEYWORD_VALUES = [
        self::TYPE_KEYWORD_AGE_RANGE,
        self::TYPE_KEYWORD_BIRTH_YEAR,
        self::TYPE_KEYWORD_BLOOD,
        self::TYPE_KEYWORD_BODY,
        self::TYPE_KEYWORD_CAREER,
        self::TYPE_KEYWORD_COUNTRY,
        self::TYPE_KEYWORD_DRINK,
        self::TYPE_KEYWORD_EDU_BG,
        self::TYPE_KEYWORD_HOBBY,
        self::TYPE_KEYWORD_LANGUAGE,
        self::TYPE_KEYWORD_NATIONALITY,
        self::TYPE_KEYWORD_RELIGION,
        self::TYPE_KEYWORD_RESIDENCE,
        self::TYPE_KEYWORD_SMOKE,
        self::TYPE_KEYWORD_STATE,
        self::TYPE_KEYWORD_STATURE,
        self::TYPE_KEYWORD_STATURE_RANGE,
        self::TYPE_KEYWORD_WEIGHT,
        self::TYPE_KEYWORD_WEIGHT_RANGE,
    ];
    public const TYPE_KEYWORD_WEIGHT = 'keyword/weight';
    public const TYPE_KEYWORD_WEIGHT_RANGE = 'keyword/weight_range';
    public const TYPE_MATCH = 'match';
    public const TYPE_NOTICE = 'notice';
    public const TYPE_NOTIFICATION = 'notification';
    public const TYPE_PAYMENT = 'payment';
    public const TYPE_POPULARITY = 'popularity';
    public const TYPE_PROFILE_PHOTO = 'profile_photo';
    public const TYPE_PWD_RESET = 'pwd_reset';
    public const TYPE_QUESTION_POST = 'ticket';
    public const TYPE_RELATED_KEYWORD = 'related_keyword';
    public const TYPE_REPLY_POST = 'reply';
    public const TYPE_ROLE = 'role';
    public const TYPE_ROLE_USER = 'role_user';
    public const TYPE_USER = 'user';
    public const TYPE_USER_SELF_KEYWORD = 'user_keyword';

    public const TYPE_VALUES = [
        self::TYPE_BALANCE,
        self::TYPE_CARD,
        self::TYPE_CARD_FLIP,
        self::TYPE_CARD_GROUP,
        self::TYPE_CHATTING_CONTENT,
        self::TYPE_FACE_PHOTO,
        self::TYPE_INVOICE,
        self::TYPE_KEYWORD_AGE_RANGE,
        self::TYPE_KEYWORD_BIRTH_YEAR,
        self::TYPE_KEYWORD_BLOOD,
        self::TYPE_KEYWORD_BODY,
        self::TYPE_KEYWORD_CAREER,
        self::TYPE_KEYWORD_COUNTRY,
        self::TYPE_KEYWORD_DRINK,
        self::TYPE_KEYWORD_EDU_BG,
        self::TYPE_KEYWORD_HOBBY,
        self::TYPE_KEYWORD_LANGUAGE,
        self::TYPE_KEYWORD_NATIONALITY,
        self::TYPE_KEYWORD_RELIGION,
        self::TYPE_KEYWORD_RESIDENCE,
        self::TYPE_KEYWORD_SMOKE,
        self::TYPE_KEYWORD_STATE,
        self::TYPE_KEYWORD_STATURE,
        self::TYPE_KEYWORD_STATURE_RANGE,
        self::TYPE_KEYWORD_WEIGHT,
        self::TYPE_KEYWORD_WEIGHT_RANGE,
        self::TYPE_MATCH,
        self::TYPE_RELATED_KEYWORD,
        self::TYPE_NOTIFICATION,
        self::TYPE_PAYMENT,
        self::TYPE_POPULARITY,
        self::TYPE_PROFILE_PHOTO,
        self::TYPE_PWD_RESET,
        self::TYPE_NOTICE,
        self::TYPE_QUESTION_POST,
        self::TYPE_REPLY_POST,
        self::TYPE_ROLE,
        self::TYPE_ROLE_USER,
        self::TYPE_USER,
        self::TYPE_IDEAL_TYPE_KEYWORD,
        self::TYPE_USER_SELF_KEYWORD,
    ];

    public $incrementing = true;
    protected $appends = [self::MODEL_CLASS];
    protected $casts = [
        self::ID => 'integer',
    ];
    protected $fillable = [
        self::ID,
        self::TYPE,
        self::MODEL_CLASS,
    ];
    protected $guarded = [self::ID];
    protected $hidden = [
        self::MODEL_CLASS,
    ];
    protected $table = 'objs';

    public function concrete()
    {
        return $this->morphTo(null, 'type', 'id');
    }

    public function getModelClassAttribute()
    {
        return Relation::morphMap()[$this->getAttribute(static::TYPE)];
    }

    public function setModelClassAttribute($value)
    {
        $this->attributes[static::TYPE] = array_flip(Relation::morphMap())[$value];
    }
}
