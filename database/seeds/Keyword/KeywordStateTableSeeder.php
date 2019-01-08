<?php

namespace Database\Seeds;

use Illuminate\Support\Facades\DB;
use App\Database\Models\Obj;
use App\Database\Models\Keyword\State;

class StateTableSeeder extends TableSeeder {

    public function run()
    {
        $languages = [
            'de-DE',
            'el-GR',
            'en-US',
            'es-ES',
            'fr-FR',
            'it-IT',
            'ja-JP',
            'ko-KR',
            'ru-RU',
            'vi-VN',
            'zh-CN',
            'zh-TW'
        ];

        foreach ( $languages as $language )
        {
            $subQuery      = 'select name from geo.countries';
            $query         = 'select * from geo.states where place in ('.$subQuery.') and view="long"';
            $getstateUrl   = 'http://query.yahooapis.com/v1/public/yql?q='.urlencode($query).'&format=json';
            $stateJsonData = file_get_contents($getstateUrl);
            $stateArrData  = json_decode($stateJsonData, true);

            foreach ( $stateArrData['query']['results']['place'] as $data )
            {
                $keywordState = State::qWhere('woeid', $data['admin1']['woeid'])->get()->first();

                if( empty($keywordState) )
                {
                    $keyword = Obj::create([Obj::TYPE => Obj::TYPE_KEYWORD_RESIDENCE_STATE]);

                    $keywordState = State::create([
                        'id'                => $keyword->getKey(),
                        'iso_3166_1_alpha2' => $data['country']['code'],
                        'woeid'             => $data['admin1']['woeid']
                    ]);
                }

                $localizable = $keywordState->localizables()->qWhere('language', $language)->first();

                if( empty($localizable) )
                {
                    Localizable::create([
                        'id'            => $keywordState->{State::ID},
                        'language'      => $language,
                        'text'          => $data['admin1']['content']
                    ]);
                }
            }
        }
    }
}
