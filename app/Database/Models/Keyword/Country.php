<?php

namespace App\Database\Models\Keyword;

use App\Database\Models\Keyword\Nationality;
use App\Database\Models\Keyword\Residence;
use App\Database\Models\Keyword\State;
use App\Database\Model;

class Country extends Model {

    protected $table = 'keyword_countries';
    protected $fillable = [
        self::ID,
        self::ISO,
        self::NAME,
        self::E164,
        self::CCTLD,
        self::CURRENCY,
        self::LANGUAGE
    ];

    const ID        = 'id';
    const ISO       = 'iso'; // iso_3166_1_alpha2
    const NAME      = 'name';
    const E164      = 'e164';
    const CCTLD     = 'cctld';
    const CURRENCY  = 'currency';
    const LANGUAGE  = 'language';

    public function getExpandable()
    {
        return ['state', 'residence', 'nationality'];
    }

    public function nationality()
    {
        return $this->hasOne(Nationality::class, 'country_id', 'id');
    }

    public function nationalityQuery()
    {
        return app(Nationality::class)->query()
            ->qWhere(Nationality::COUNTRY_ID, $this->{static::ID});
    }

    public function residence()
    {
        return $this->hasOne(Residence::class, 'related_id', 'id');
    }

    public function residenceQuery()
    {
        return app(Residence::class)->query()
            ->qWhere(Residence::RELATED_ID, $this->{static::ID});
    }

    public function state()
    {
        return $this->hasMany(State::class, 'country_id', 'id');
    }

    public function stateQuery()
    {
        return app(State::class)->query()
            ->qWhere(State::COUNTRY_ID, $this->{static::ID});
    }

}
