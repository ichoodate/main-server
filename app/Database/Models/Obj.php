<?php

namespace App\Database\Models;

use App\Database\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Obj extends Model {

    public $incrementing = true;
    protected $appends   = [self::MODEL_CLASS];
    protected $guarded   = [self::ID];
    protected $table     = 'objs';
    protected $casts = [
        self::ID => 'integer'
    ];
    protected $hidden = [
        self::MODEL_CLASS
    ];
    protected $fillable = [
        self::ID,
        self::TYPE,
        self::MODEL_CLASS
    ];

    const ID          = 'id';
    const TYPE        = 'type';
    const MODEL_CLASS = 'model_class';

    const TYPE_BALANCE                     = 'balance';
    const TYPE_CARD                        = 'card';
    const TYPE_CARD_FLIP                   = 'card_flip';
    const TYPE_CARD_GROUP                  = 'card_group';
    const TYPE_CHATTING_CONTENT            = 'chatting_content';
    const TYPE_COIN                        = 'coin';
    const TYPE_FACE_PHOTO                  = 'face_photo';
    const TYPE_INVOICE                     = 'invoice';
    const TYPE_KEYWORD_AGE_RANGE           = 'keyword/age_range';
    const TYPE_KEYWORD_BIRTH_YEAR          = 'keyword/birth_year';
    const TYPE_KEYWORD_BLOOD               = 'keyword/blood';
    const TYPE_KEYWORD_BODY                = 'keyword/body';
    const TYPE_KEYWORD_CAREER              = 'keyword/career';
    const TYPE_KEYWORD_COUNTRY             = 'keyword/country';
    const TYPE_KEYWORD_DRINK               = 'keyword/drink';
    const TYPE_KEYWORD_EDU_BG              = 'keyword/edu_bg';
    const TYPE_KEYWORD_HOBBY               = 'keyword/hobby';
    const TYPE_KEYWORD_LANGUAGE            = 'keyword/language';
    const TYPE_KEYWORD_NATIONALITY         = 'keyword/nationality';
    const TYPE_KEYWORD_RELIGION            = 'keyword/religion';
    const TYPE_KEYWORD_SMOKE               = 'keyword/smoke';
    const TYPE_KEYWORD_STATE               = 'keyword/state';
    const TYPE_KEYWORD_RESIDENCE_COUNTRY   = 'keyword/residence_country';
    const TYPE_KEYWORD_RESIDENCE_STATE     = 'keyword/residence_state';
    const TYPE_KEYWORD_STATURE             = 'keyword/stature';
    const TYPE_KEYWORD_STATURE_RANGE       = 'keyword/stature_range';
    const TYPE_KEYWORD_WEIGHT              = 'keyword/weight';
    const TYPE_KEYWORD_WEIGHT_RANGE        = 'keyword/weight_range';
    const TYPE_MATCH                       = 'match';
    const TYPE_MATCHING_KWD_PVT            = 'matching_kwd_pvt';
    const TYPE_NOTICE                      = 'notice';
    const TYPE_NOTIFICATION                = 'notification';
    const TYPE_QUESTION_POST               = 'ticket';
    const TYPE_PAYMENT                     = 'payment';
    const TYPE_POPULARITY                  = 'popularity';
    const TYPE_PROFILE_PHOTO               = 'profile_photo';
    const TYPE_PWD_RESET                   = 'pwd_reset';
    const TYPE_REPLY_POST                  = 'reply';
    const TYPE_ROLE                        = 'role';
    const TYPE_ROLE_USER                   = 'role_user';
    const TYPE_USER                        = 'user';
    const TYPE_USER_IDEAL_TYPE_KWD_PVT     = 'user_ideal_type_kwd_pvt';
    const TYPE_USER_SELF_KWD_PVT           = 'user_self_kwd_pvt';

    const TYPE_VALUES = [
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
        self::TYPE_KEYWORD_RESIDENCE_COUNTRY,
        self::TYPE_KEYWORD_RESIDENCE_STATE,
        self::TYPE_KEYWORD_SMOKE,
        self::TYPE_KEYWORD_STATE,
        self::TYPE_KEYWORD_STATURE,
        self::TYPE_KEYWORD_STATURE_RANGE,
        self::TYPE_KEYWORD_WEIGHT,
        self::TYPE_KEYWORD_WEIGHT_RANGE,
        self::TYPE_MATCH,
        self::TYPE_MATCHING_KWD_PVT,
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
        self::TYPE_USER_IDEAL_TYPE_KWD_PVT,
        self::TYPE_USER_SELF_KWD_PVT
    ];

    const TYPE_KEYWORD_VALUES = [
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
        self::TYPE_KEYWORD_RESIDENCE_COUNTRY,
        self::TYPE_KEYWORD_RESIDENCE_STATE,
        self::TYPE_KEYWORD_SMOKE,
        self::TYPE_KEYWORD_STATE,
        self::TYPE_KEYWORD_STATURE,
        self::TYPE_KEYWORD_STATURE_RANGE,
        self::TYPE_KEYWORD_WEIGHT,
        self::TYPE_KEYWORD_WEIGHT_RANGE
    ];

    public function getExpandable()
    {
        return ['concrete'];
    }

    public function getModelClassAttribute()
    {
        $segments = [];
        $type     = $this->getAttribute(static::TYPE);
        foreach ( explode('\\', $type) as $value )
        {
            $segments[] = studly_case($value);
        }

        return 'App\\Database\\Models\\' . implode('\\', $segments);
    }

    public function setModelClassAttribute($value)
    {
        $modelClass = $value;

        $this->attributes[static::TYPE] = array_flip(Relation::morphMap())[$modelClass];
    }

    public function concrete()
    {
        return $this->morphTo(null, 'type', 'id');
    }

}
