<?php

namespace App\Database\Models\Keyword;

use App\Database\Model;
use App\Database\Models\Keyword\Country;
use App\Database\Models\Keyword\Residence;

class State extends Model {

    protected $table = 'keyword_states';
    protected $fillable = [
        self::ID,
        self::COUNTRY_ID,
        self::NAME
    ];

    const ID         = 'id';
    const COUNTRY_ID = 'country_id';
    const NAME       = 'name';

    const ENTITIES = [
        self::ID,
        self::COUNTRY_ID,
        self::NAME,
    ];

    public function getExpandable()
    {
        return ['country', 'residence'];
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function residence()
    {
        return $this->hasOne(Residence::class, 'related_id', 'id');
    }

}
