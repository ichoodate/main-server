<?php

namespace App\Services\Obj;

use App\Database\Models\Obj;
use App\Service;

class KeywordObjListingService extends Service {

    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'result' => ['ids', function ($ids) {

                $ids = preg_split('/\s*,\s*/', $ids);

                return inst(Obj::class)->aliasQuery()
                    ->qWhereIn(Obj::ID, $ids)
                    ->qWhereIn(Obj::TYPE, [Obj::TYPE_KEYWORD_BODY])
                    ->get()
                    ->sortById($ids);
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
            'ids'
                => ['required', 'string']
        ];
    }

    public static function getArrTraits()
    {
        return [];
    }

}
