<?php

namespace App\Services\IdealTypable;

use App\Database\Models\IdealTypable;
use App\Service;
use App\Services\Obj\KeywordObjListingService;

class IdealTypableMergingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'keywords'
                => 'keywords of {{keyword_ids}}',

            'keywords.*'
                => 'keywords.* of {{keyword_ids}}',
        ];
    }

    public static function getArrCallbackLists()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'created' => ['auth_user', 'new_keyword_ids', function ($authUser, $newKeywordIds) {

                $idealTypables = inst(IdealTypable::class)->newCollection();

                foreach ( $newKeywordIds as $index => $newKeywordId )
                {
                    $idealTypable = inst(IdealTypable::class)->create([
                        IdealTypable::KEYWORD_ID
                            => $newKeywordId,
                        IdealTypable::USER_ID
                            => $authUser->getKey()
                    ]);

                    $idealTypables->push($idealTypable);
                }

                return $idealTypables;
            }],

            'existed' => ['keywords', 'auth_user', function ($keywords, $authUser) {

                return inst(IdealTypable::class)->aliasQuery()
                    ->lockForUpdate()
                    ->qWhereIn(IdealTypable::KEYWORD_ID, $keywords->modelKeys())
                    ->qWhere(IdealTypable::USER_ID, $authUser->getKey())
                    ->get();
            }],

            'existed_keyword_ids' => ['existed', function ($existed) {

                return $existed->pluck(IdealTypable::KEYWORD_ID)->all();
            }],

            'keywords' => ['keyword_ids', function ($keywordIds) {

                return [KeywordObjListingService::class, [
                    'ids' => $keywordIds
                ], [
                    'ids' => '{{keyword_ids}}'
                ]];
            }],

            'new_keyword_ids' => ['existed_keyword_ids', 'keyword_ids', function ($existedKeywordIds, $keywordIds) {

                return array_values(array_diff($keywordIds, $existedKeywordIds));
            }]
        ];
    }

    public static function getArrPromiseLists()
    {
        return [];
    }

    public static function getArrRuleLists()
    {
        return [
            'auth_user'
                => ['required'],

            'keywords.*'
                => ['not_null'],

            'keyword_ids'
                => ['required', 'integers']
        ];
    }

    public static function getArrTraits()
    {
        return [];
    }

}
