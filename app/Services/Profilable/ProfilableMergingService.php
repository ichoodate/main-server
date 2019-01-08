<?php

namespace App\Services\Profilable;

use App\Database\Models\Obj;
use App\Database\Models\Profilable;
use App\Service;
use App\Services\Obj\KeywordObjListingService;

class ProfilableMergingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'keywords'
                => 'keywords of {{keyword_ids}}',

            'keywords.*'
                => 'keywords.* of {{keyword_ids}}'
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

                $collection = inst(Profilable::class)->newCollection();

                foreach ( $newKeywordIds as $index => $newKeywordId )
                {
                    $profilable = inst(Profilable::class)->create([
                        Profilable::KEYWORD_ID
                            => $newKeywordId,
                        Profilable::USER_ID
                            => $authUser->getKey()
                    ]);

                    $collection->push($profilable);
                }

                return $collection;
            }],

            'existed' => ['keywords', 'auth_user', function ($keywords, $authUser) {

                return inst(Profilable::class)->aliasQuery()
                    ->lockForUpdate()
                    ->qWhereIn(Profilable::KEYWORD_ID, $keywords->modelKeys())
                    ->qWhere(Profilable::USER_ID, $authUser->getKey())
                    ->get();
            }],

            'existed_keyword_ids' => ['existed', function ($existedModels) {

                return $existedModels->pluck(Profilable::KEYWORD_ID)->all();
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
