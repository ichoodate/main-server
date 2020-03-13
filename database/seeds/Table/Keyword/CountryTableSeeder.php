<?php

namespace Database\Seeds\Table\Keyword;

use App\Database\Models\Obj;
use App\Database\Models\Keyword\Country;
use App\Database\Models\Photo;
use Database\Seeds\TableSeeder;

class CountryTableSeeder extends TableSeeder {

    public function run()
    {
        foreach ( [
            ['KR', 'South Korea', '82', '.kr', 'KRW', 'ko-KR'],
            ['US', 'United States', '1', '.us', 'USD', 'en-US'],
            ['JP', 'Japan', '81', '.jp', 'JPY', 'ja-JP'],
            ['CN', 'China', '86', '.cn', 'RMB', 'zh-CN']
        ] as $val )
        {
            Country::create([
                Country::ISO => $val[0],
                Country::NAME => $val[1],
                Country::E164 => $val[2],
                Country::CCTLD => $val[3],
                Country::CURRENCY => $val[4],
                Country::LANGUAGE => $val[5]
            ]);
        }
    }

        // $languages = [
        //     'de-DE',
        //     'el-GR',
        //     'en-US',
        //     'es-ES',
        //     'fr-FR',
        //     'it-IT',
        //     'ja-JP',
        //     'ko-KR',
        //     'ru-RU',
        //     'vi-VN',
        //     'zh-CN',
        //     'zh-TW'
        // ];

        // foreach ( $languages as $language )
        // {
        //     $yqlQuery     = 'select * from geo.countries where lang="'.$language.'" and view="long"';
        //     $yqlUrl       = 'http://query.yahooapis.com/v1/public/yql?q='.urlencode($yqlQuery).'&format=json';
        //     $yqlJson      = file_get_contents($yqlUrl);
        //     $yqlArr       = json_decode($yqlJson, true);

        //     foreach( $yqlArr['query']['results']['place'] as $data )
        //     {
        //         $keywordCountry = Country::qWhere(Country::TYPE, $data['country']['code'])->get()->first();

        //         if ( empty($keywordCountry) )
        //         {
        //             $keywordCountry = Country::create([
        //                 Country::TYPE    => $data['country']['code'],
        //                 Country::WOE_ID  => $data['country']['woeid'],
        //                 Country::SUPPORT => false
        //             ]);
        //         }
        //         else
        //         {
        //             $keywordCountry->update([
        //                 Country::WOE_ID => $data['country']['woeid']
        //             ]);
        //         }

        //         $localizable = Localizable::query()
        //             ->qWhere(Localizable::KEYWORD_ID, $keywordCountry->{Country::ID})
        //             ->qWhere(Localizable::LANGUAGE,   $language)
        //             ->first();

        //         if( empty($localizable) )
        //         {
        //             Localizable::create([
        //                 Localizable::KEYWORD_ID   => $keywordCountry->{Country::ID},
        //                 Localizable::LANGUAGE     => $language,
        //                 Localizable::TEXT         => $data['country']['content']
        //             ]);
        //         }
        //     }
        // }

        // $geonamesUrl  = 'http://api.geonames.org/countryInfoJSON?username=dbwhddn10';
        // $geonamesJson = file_get_contents($geonamesUrl);
        // $geonamesArr  = json_decode($geonamesJson, true);

        // foreach( $geonamesArr['geonames'] as $data )
        // {
        //     $keywordCountry = Country::qWhere(Country::TYPE, $data['countryCode'])->first();

        //     if ( empty($keywordCountry) )
        //     {
        //         Country::create([
        //             Country::TYPE         => $data['countryCode'],
        //             Country::CURRENCY     => $data['currencyCode'],
        //             Country::GEONAME_ID   => $data['geonameId'],
        //             Country::LANGUAGE    => $data['languages'],
        //             Country::SUPPORT      => false
        //         ]);
        //     }
        //     else
        //     {
        //         $keywordCountry->update([
        //             Country::CURRENCY   => $data['currencyCode'],
        //             Country::GEONAME_ID => $data['geonameId'],
        //             Country::LANGUAGE  => $data['languages']
        //         ]);
        //     }
        // }

        // $keywordCountries = Country::get();

        // foreach ( $languages as $language )
        // {
        //     $countryNameJson  = file_get_contents('https://cdn.rawgit.com/umpirsky/country-list/master/country/icu/'.str_replace('-', '_', $language).'/country.json');
        //     $countryNameArr   = json_decode($countryNameJson, true);

        //     foreach ( $keywordCountries as $keywordCountry )
        //     {
        //         $localizable = Localizable::query()
        //             ->qWhere(Localizable::KEYWORD_ID, $keywordCountry->{Country::ID})
        //             ->qWhere(Localizable::LANGUAGE,   $language)
        //             ->first();
        //         $countryCode = $keywordCountry[Country::TYPE];

        //         if( empty($localizable) )
        //         {
        //             if ( ! array_key_exists($countryCode, $countryNameArr) )
        //             {
        //                 Localizable::create([
        //                     Localizable::KEYWORD_ID   => $keywordCountry->{Country::ID},
        //                     Localizable::LANGUAGE     => $language,
        //                     Localizable::TEXT         => $countryNameArr[$countryCode]
        //                 ]);
        //             }
        //             else
        //             {
        //                 throw new \Exception($language.'\'s '.$countryCode.' code name is not exist' . PHP_EOL);
        //             }
        //         }
        //     }
        // }

        // /*
        //     https://gist.github.com/dbwhddn10/95bb7573d3cbdfc8105d - forked and updated calling code
        //     https://gist.github.com/paulochf/9616f85f3f3904f1c36f - origin
        // */
        // $dummyForKeywordCountriesTableE164Column = array(
        //     array('iso' => 'AF','phonecode' => '93'),
        //     array('iso' => 'AL','phonecode' => '355'),
        //     array('iso' => 'DZ','phonecode' => '213'),
        //     array('iso' => 'AS','phonecode' => '1684'),
        //     array('iso' => 'AD','phonecode' => '376'),
        //     array('iso' => 'AO','phonecode' => '244'),
        //     array('iso' => 'AI','phonecode' => '1264'),
        //     array('iso' => 'AQ','phonecode' => '672'),
        //     array('iso' => 'AG','phonecode' => '1268'),
        //     array('iso' => 'AR','phonecode' => '54'),
        //     array('iso' => 'AM','phonecode' => '374'),
        //     array('iso' => 'AW','phonecode' => '297'),
        //     array('iso' => 'AU','phonecode' => '61'),
        //     array('iso' => 'AT','phonecode' => '43'),
        //     array('iso' => 'AZ','phonecode' => '994'),
        //     array('iso' => 'BS','phonecode' => '1242'),
        //     array('iso' => 'BH','phonecode' => '973'),
        //     array('iso' => 'BD','phonecode' => '880'),
        //     array('iso' => 'BB','phonecode' => '1246'),
        //     array('iso' => 'BY','phonecode' => '375'),
        //     array('iso' => 'BE','phonecode' => '32'),
        //     array('iso' => 'BZ','phonecode' => '501'),
        //     array('iso' => 'BJ','phonecode' => '229'),
        //     array('iso' => 'BM','phonecode' => '1441'),
        //     array('iso' => 'BT','phonecode' => '975'),
        //     array('iso' => 'BO','phonecode' => '591'),
        //     array('iso' => 'BA','phonecode' => '387'),
        //     array('iso' => 'BW','phonecode' => '267'),
        //     array('iso' => 'BV','phonecode' => '47'),
        //     array('iso' => 'BR','phonecode' => '55'),
        //     array('iso' => 'IO','phonecode' => '246'),
        //     array('iso' => 'BN','phonecode' => '673'),
        //     array('iso' => 'BG','phonecode' => '359'),
        //     array('iso' => 'BF','phonecode' => '226'),
        //     array('iso' => 'BI','phonecode' => '257'),
        //     array('iso' => 'KH','phonecode' => '855'),
        //     array('iso' => 'CM','phonecode' => '237'),
        //     array('iso' => 'CA','phonecode' => '1'),
        //     array('iso' => 'CV','phonecode' => '238'),
        //     array('iso' => 'KY','phonecode' => '1345'),
        //     array('iso' => 'CF','phonecode' => '236'),
        //     array('iso' => 'TD','phonecode' => '235'),
        //     array('iso' => 'CL','phonecode' => '56'),
        //     array('iso' => 'CN','phonecode' => '86'),
        //     array('iso' => 'CX','phonecode' => '61'),
        //     array('iso' => 'CC','phonecode' => '672'),
        //     array('iso' => 'CO','phonecode' => '57'),
        //     array('iso' => 'KM','phonecode' => '269'),
        //     array('iso' => 'CG','phonecode' => '242'),
        //     array('iso' => 'CD','phonecode' => '243'),
        //     array('iso' => 'CK','phonecode' => '682'),
        //     array('iso' => 'CR','phonecode' => '506'),
        //     array('iso' => 'CI','phonecode' => '225'),
        //     array('iso' => 'HR','phonecode' => '385'),
        //     array('iso' => 'CU','phonecode' => '53'),
        //     array('iso' => 'CY','phonecode' => '357'),
        //     array('iso' => 'CZ','phonecode' => '420'),
        //     array('iso' => 'DK','phonecode' => '45'),
        //     array('iso' => 'DJ','phonecode' => '253'),
        //     array('iso' => 'DM','phonecode' => '1767'),
        //     array('iso' => 'DO','phonecode' => '1809'),
        //     array('iso' => 'EC','phonecode' => '593'),
        //     array('iso' => 'EG','phonecode' => '20'),
        //     array('iso' => 'SV','phonecode' => '503'),
        //     array('iso' => 'GQ','phonecode' => '240'),
        //     array('iso' => 'ER','phonecode' => '291'),
        //     array('iso' => 'EE','phonecode' => '372'),
        //     array('iso' => 'ET','phonecode' => '251'),
        //     array('iso' => 'FK','phonecode' => '500'),
        //     array('iso' => 'FO','phonecode' => '298'),
        //     array('iso' => 'FJ','phonecode' => '679'),
        //     array('iso' => 'FI','phonecode' => '358'),
        //     array('iso' => 'FR','phonecode' => '33'),
        //     array('iso' => 'GF','phonecode' => '594'),
        //     array('iso' => 'PF','phonecode' => '689'),
        //     array('iso' => 'TF','phonecode' => '262'),
        //     array('iso' => 'GA','phonecode' => '241'),
        //     array('iso' => 'GM','phonecode' => '220'),
        //     array('iso' => 'GE','phonecode' => '995'),
        //     array('iso' => 'DE','phonecode' => '49'),
        //     array('iso' => 'GH','phonecode' => '233'),
        //     array('iso' => 'GI','phonecode' => '350'),
        //     array('iso' => 'GR','phonecode' => '30'),
        //     array('iso' => 'GL','phonecode' => '299'),
        //     array('iso' => 'GD','phonecode' => '1473'),
        //     array('iso' => 'GP','phonecode' => '590'),
        //     array('iso' => 'GU','phonecode' => '1671'),
        //     array('iso' => 'GT','phonecode' => '502'),
        //     array('iso' => 'GN','phonecode' => '224'),
        //     array('iso' => 'GW','phonecode' => '245'),
        //     array('iso' => 'GY','phonecode' => '592'),
        //     array('iso' => 'HT','phonecode' => '509'),
        //     array('iso' => 'HM','phonecode' => '0'),
        //     array('iso' => 'VA','phonecode' => '39'),
        //     array('iso' => 'HN','phonecode' => '504'),
        //     array('iso' => 'HK','phonecode' => '852'),
        //     array('iso' => 'HU','phonecode' => '36'),
        //     array('iso' => 'IS','phonecode' => '354'),
        //     array('iso' => 'IN','phonecode' => '91'),
        //     array('iso' => 'ID','phonecode' => '62'),
        //     array('iso' => 'IR','phonecode' => '98'),
        //     array('iso' => 'IQ','phonecode' => '964'),
        //     array('iso' => 'IE','phonecode' => '353'),
        //     array('iso' => 'IL','phonecode' => '972'),
        //     array('iso' => 'IT','phonecode' => '39'),
        //     array('iso' => 'JM','phonecode' => '1876'),
        //     array('iso' => 'JP','phonecode' => '81'),
        //     array('iso' => 'JO','phonecode' => '962'),
        //     array('iso' => 'KZ','phonecode' => '7'),
        //     array('iso' => 'KE','phonecode' => '254'),
        //     array('iso' => 'KI','phonecode' => '686'),
        //     array('iso' => 'KP','phonecode' => '850'),
        //     array('iso' => 'KR','phonecode' => '82'),
        //     array('iso' => 'KW','phonecode' => '965'),
        //     array('iso' => 'KG','phonecode' => '996'),
        //     array('iso' => 'LA','phonecode' => '856'),
        //     array('iso' => 'LV','phonecode' => '371'),
        //     array('iso' => 'LB','phonecode' => '961'),
        //     array('iso' => 'LS','phonecode' => '266'),
        //     array('iso' => 'LR','phonecode' => '231'),
        //     array('iso' => 'LY','phonecode' => '218'),
        //     array('iso' => 'LI','phonecode' => '423'),
        //     array('iso' => 'LT','phonecode' => '370'),
        //     array('iso' => 'LU','phonecode' => '352'),
        //     array('iso' => 'MO','phonecode' => '853'),
        //     array('iso' => 'MK','phonecode' => '389'),
        //     array('iso' => 'MG','phonecode' => '261'),
        //     array('iso' => 'MW','phonecode' => '265'),
        //     array('iso' => 'MY','phonecode' => '60'),
        //     array('iso' => 'MV','phonecode' => '960'),
        //     array('iso' => 'ML','phonecode' => '223'),
        //     array('iso' => 'MT','phonecode' => '356'),
        //     array('iso' => 'MH','phonecode' => '692'),
        //     array('iso' => 'MQ','phonecode' => '596'),
        //     array('iso' => 'MR','phonecode' => '222'),
        //     array('iso' => 'MU','phonecode' => '230'),
        //     array('iso' => 'YT','phonecode' => '269'),
        //     array('iso' => 'MX','phonecode' => '52'),
        //     array('iso' => 'FM','phonecode' => '691'),
        //     array('iso' => 'MD','phonecode' => '373'),
        //     array('iso' => 'MC','phonecode' => '377'),
        //     array('iso' => 'MN','phonecode' => '976'),
        //     array('iso' => 'MS','phonecode' => '1664'),
        //     array('iso' => 'MA','phonecode' => '212'),
        //     array('iso' => 'MZ','phonecode' => '258'),
        //     array('iso' => 'MM','phonecode' => '95'),
        //     array('iso' => 'NA','phonecode' => '264'),
        //     array('iso' => 'NR','phonecode' => '674'),
        //     array('iso' => 'NP','phonecode' => '977'),
        //     array('iso' => 'NL','phonecode' => '31'),
        //     array('iso' => 'AN','phonecode' => '599'),
        //     array('iso' => 'NC','phonecode' => '687'),
        //     array('iso' => 'NZ','phonecode' => '64'),
        //     array('iso' => 'NI','phonecode' => '505'),
        //     array('iso' => 'NE','phonecode' => '227'),
        //     array('iso' => 'NG','phonecode' => '234'),
        //     array('iso' => 'NU','phonecode' => '683'),
        //     array('iso' => 'NF','phonecode' => '672'),
        //     array('iso' => 'MP','phonecode' => '1670'),
        //     array('iso' => 'NO','phonecode' => '47'),
        //     array('iso' => 'OM','phonecode' => '968'),
        //     array('iso' => 'PK','phonecode' => '92'),
        //     array('iso' => 'PW','phonecode' => '680'),
        //     array('iso' => 'PS','phonecode' => '970'),
        //     array('iso' => 'PA','phonecode' => '507'),
        //     array('iso' => 'PG','phonecode' => '675'),
        //     array('iso' => 'PY','phonecode' => '595'),
        //     array('iso' => 'PE','phonecode' => '51'),
        //     array('iso' => 'PH','phonecode' => '63'),
        //     array('iso' => 'PN','phonecode' => '64'),
        //     array('iso' => 'PL','phonecode' => '48'),
        //     array('iso' => 'PT','phonecode' => '351'),
        //     array('iso' => 'PR','phonecode' => '1787'),
        //     array('iso' => 'QA','phonecode' => '974'),
        //     array('iso' => 'RE','phonecode' => '262'),
        //     array('iso' => 'RO','phonecode' => '40'),
        //     array('iso' => 'RU','phonecode' => '7'),
        //     array('iso' => 'RW','phonecode' => '250'),
        //     array('iso' => 'SH','phonecode' => '290'),
        //     array('iso' => 'KN','phonecode' => '1869'),
        //     array('iso' => 'LC','phonecode' => '1758'),
        //     array('iso' => 'PM','phonecode' => '508'),
        //     array('iso' => 'VC','phonecode' => '1784'),
        //     array('iso' => 'WS','phonecode' => '684'),
        //     array('iso' => 'SM','phonecode' => '378'),
        //     array('iso' => 'ST','phonecode' => '239'),
        //     array('iso' => 'SA','phonecode' => '966'),
        //     array('iso' => 'SN','phonecode' => '221'),
        //     array('iso' => 'SC','phonecode' => '248'),
        //     array('iso' => 'SL','phonecode' => '232'),
        //     array('iso' => 'SG','phonecode' => '65'),
        //     array('iso' => 'SK','phonecode' => '421'),
        //     array('iso' => 'SI','phonecode' => '386'),
        //     array('iso' => 'SB','phonecode' => '677'),
        //     array('iso' => 'SO','phonecode' => '252'),
        //     array('iso' => 'ZA','phonecode' => '27'),
        //     array('iso' => 'GS','phonecode' => '500'),
        //     array('iso' => 'ES','phonecode' => '34'),
        //     array('iso' => 'LK','phonecode' => '94'),
        //     array('iso' => 'SD','phonecode' => '249'),
        //     array('iso' => 'SR','phonecode' => '597'),
        //     array('iso' => 'SJ','phonecode' => '47'),
        //     array('iso' => 'SZ','phonecode' => '268'),
        //     array('iso' => 'SE','phonecode' => '46'),
        //     array('iso' => 'CH','phonecode' => '41'),
        //     array('iso' => 'SY','phonecode' => '963'),
        //     array('iso' => 'TW','phonecode' => '886'),
        //     array('iso' => 'TJ','phonecode' => '992'),
        //     array('iso' => 'TZ','phonecode' => '255'),
        //     array('iso' => 'TH','phonecode' => '66'),
        //     array('iso' => 'TL','phonecode' => '670'),
        //     array('iso' => 'TG','phonecode' => '228'),
        //     array('iso' => 'TK','phonecode' => '690'),
        //     array('iso' => 'TO','phonecode' => '676'),
        //     array('iso' => 'TT','phonecode' => '1868'),
        //     array('iso' => 'TN','phonecode' => '216'),
        //     array('iso' => 'TR','phonecode' => '90'),
        //     array('iso' => 'TM','phonecode' => '7370'),
        //     array('iso' => 'TC','phonecode' => '1649'),
        //     array('iso' => 'TV','phonecode' => '688'),
        //     array('iso' => 'UG','phonecode' => '256'),
        //     array('iso' => 'UA','phonecode' => '380'),
        //     array('iso' => 'AE','phonecode' => '971'),
        //     array('iso' => 'GB','phonecode' => '44'),
        //     array('iso' => 'US','phonecode' => '1'),
        //     array('iso' => 'UM','phonecode' => '1'),
        //     array('iso' => 'UY','phonecode' => '598'),
        //     array('iso' => 'UZ','phonecode' => '998'),
        //     array('iso' => 'VU','phonecode' => '678'),
        //     array('iso' => 'VE','phonecode' => '58'),
        //     array('iso' => 'VN','phonecode' => '84'),
        //     array('iso' => 'VG','phonecode' => '1284'),
        //     array('iso' => 'VI','phonecode' => '1340'),
        //     array('iso' => 'WF','phonecode' => '681'),
        //     array('iso' => 'EH','phonecode' => '212'),
        //     array('iso' => 'YE','phonecode' => '967'),
        //     array('iso' => 'ZM','phonecode' => '260'),
        //     array('iso' => 'ZW','phonecode' => '263'),
        //     array('iso' => 'RS','phonecode' => '381'),
        //     array('iso' => 'AP','phonecode' => '0'),
        //     array('iso' => 'ME','phonecode' => '382'),
        //     array('iso' => 'AX','phonecode' => '358'),
        //     array('iso' => 'BQ','phonecode' => '599'),
        //     array('iso' => 'CW','phonecode' => '599'),
        //     array('iso' => 'GG','phonecode' => '44'),
        //     array('iso' => 'IM','phonecode' => '44'),
        //     array('iso' => 'JE','phonecode' => '44'),
        //     array('iso' => 'XK','phonecode' => '381'),
        //     array('iso' => 'BL','phonecode' => '590'),
        //     array('iso' => 'MF','phonecode' => '590'),
        //     array('iso' => 'SX','phonecode' => '1'),
        //     array('iso' => 'SS','phonecode' => '211')
        // );

        // foreach ( $dummyForKeywordCountriesTableE164Column as $key => $data )
        // {
        //     $keywordCountry = Country::qWhere(Country::TYPE, $data['iso'])->get()->first();

        //     if ( ! empty($keywordCountry) )
        //     {
        //         $keywordCountry->e164 = $data['phonecode'];
        //         $keywordCountry->save();
        //     }
        // }

}
