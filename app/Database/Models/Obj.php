<?php

namespace App\Database\Models;

use App\Database\Model;

class Obj extends Model {

    public $incrementing = true;
    public $timestamps   = false;
    protected $appends   = [self::MODEL_CLASS];
    protected $guarded   = [self::ID];
    protected $table     = 'objs';
    protected $casts = [
        'id' => 'integer'
    ];
    protected $visible = [
        self::ID,
        self::TYPE
    ];

    const MODEL_CLASS = 'model_class';
    const TYPE        = 'type';

    const TYPE_ACTIVITY                  = 'activity';
    const TYPE_BALANCE                   = 'balance';
    const TYPE_CARD                      = 'card';
    const TYPE_CARD_GROUP                = 'card_group';
    const TYPE_CHATTING_CONTENT          = 'chatting_content';
    const TYPE_COIN                      = 'coin';
    const TYPE_FACE_PHOTO                = 'face_photo';
    const TYPE_KEYWORD_AGE_RANGE         = 'keyword_age_range';
    const TYPE_KEYWORD_BLOOD             = 'keyword_blood';
    const TYPE_KEYWORD_BODY              = 'keyword_body';
    const TYPE_KEYWORD_CAREER            = 'keyword_career';
    const TYPE_KEYWORD_CHARACTER         = 'keyword_character';
    const TYPE_KEYWORD_COUNTRY           = 'keyword_country';
    const TYPE_KEYWORD_DRINK             = 'keyword_drink';
    const TYPE_KEYWORD_EDU_BG            = 'keyword_edu_bg';
    const TYPE_KEYWORD_HOBBY             = 'keyword_hobby';
    const TYPE_KEYWORD_LANGUAGE          = 'keyword_language';
    const TYPE_KEYWORD_NATIONALITY       = 'keyword_nationality';
    const TYPE_KEYWORD_RELIGION          = 'keyword_religion';
    const TYPE_KEYWORD_RESIDENCE_COUNTRY = 'keyword_residence_country';
    const TYPE_KEYWORD_RESIDENCE_STATE   = 'keyword_residence_state';
    const TYPE_KEYWORD_SMOKE             = 'keyword_smoke';
    const TYPE_KEYWORD_STATE             = 'keyword_state';
    const TYPE_KEYWORD_STATURE_RANGE     = 'keyword_stature_range';
    const TYPE_MATCH                     = 'match';
    const TYPE_NOTICE                    = 'notice';
    const TYPE_NOTIFICATION              = 'notification';
    const TYPE_PAYMENT                   = 'payment';
    const TYPE_POPULARITY                = 'popularity';
    const TYPE_PROFILABLE                = 'profilable';
    const TYPE_PROFILE_PHOTO             = 'profile_photo';
    const TYPE_QUESTION_POST             = 'ticket';
    const TYPE_REPLY_POST                = 'reply';
    const TYPE_ROLE                      = 'role';
    const TYPE_ROLE_USER                 = 'role_user';
    const TYPE_USER                      = 'user';

    const TYPE_VALUES = [
        self::TYPE_ACTIVITY,
        self::TYPE_BALANCE,
        self::TYPE_CARD,
        self::TYPE_CARD_GROUP,
        self::TYPE_CHATTING_CONTENT,
        self::TYPE_FACE_PHOTO,
        self::TYPE_KEYWORD_AGE_RANGE,
        self::TYPE_KEYWORD_BLOOD,
        self::TYPE_KEYWORD_BODY,
        self::TYPE_KEYWORD_CAREER,
        self::TYPE_KEYWORD_CHARACTER,
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
        self::TYPE_KEYWORD_STATURE_RANGE,
        self::TYPE_MATCH,
        self::TYPE_NOTIFICATION,
        self::TYPE_PAYMENT,
        self::TYPE_POPULARITY,
        self::TYPE_PROFILABLE,
        self::TYPE_PROFILE_PHOTO,
        self::TYPE_NOTICE,
        self::TYPE_QUESTION_POST,
        self::TYPE_REPLY_POST,
        self::TYPE_ROLE,
        self::TYPE_ROLE_USER,
        self::TYPE_USER
    ];

    public function getModelClassAttribute()
    {
        $type = $this->getAttribute(static::TYPE);

        return 'App\\Database\\Models\\' . studly_case($type);
    }

    public function setModelClassAttribute($value)
    {
        $className = basename($value);

        $this->attributes[static::TYPE] = snake_case($className);
    }

    public function concreteQuery()
    {
        $this->{static::MODEL_CLASS};

        return inst($class)->aliasQuery()
            ->qWhere($class::ID, $this->{static::ID});
    }

}
