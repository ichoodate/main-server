<?php

namespace Tests\Unit\App\Services\IdealTypable;

use App\Database\Models\Obj;
use App\Database\Models\IdealTypable;
use App\Database\Models\User;
use App\Services\Obj\KeywordObjListingService;
use Tests\Unit\App\Database\Collections\_Mocker as CollectionMocker;
use Tests\Unit\App\Database\Models\_Mocker as ModelMocker;
use Tests\Unit\App\Database\Queries\_Mocker as QueryMocker;
use Tests\Unit\App\Services\_TestCase;

class IdealTypableMergingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
            'keywords'
                => 'keywords of {{keyword_ids}}',

            'keywords.*'
                => 'keywords.* of {{keyword_ids}}',
        ]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([
            'auth_user'
                => ['required'],

            'keywords.*'
                => ['not_null'],

            'keyword_ids'
                => ['required', 'integers']
        ]);
    }

    public function testLoaderCreated()
    {
        $this->when(function ($proxy, $serv) {

            $authUser      = $this->factory(User::class)->make();
            $newKeywordIds = [11, 22, 33];
            $return        = $this->mMock();
            $newModel1     = $this->uniqueString();
            $newModel2     = $this->uniqueString();
            $newModel3     = $this->uniqueString();

            ModelMocker::newCollection(IdealTypable::class, $return);

            ModelMocker::create(IdealTypable::class, [
                IdealTypable::KEYWORD_ID => 11,
                IdealTypable::USER_ID    => $authUser->getKey()
            ], $newModel1);

            ModelMocker::create(IdealTypable::class, [
                IdealTypable::KEYWORD_ID => 22,
                IdealTypable::USER_ID    => $authUser->getKey()
            ], $newModel2);

            ModelMocker::create(IdealTypable::class, [
                IdealTypable::KEYWORD_ID => 33,
                IdealTypable::USER_ID    => $authUser->getKey()
            ], $newModel3);

            CollectionMocker::push($return, $newModel1);
            CollectionMocker::push($return, $newModel2);
            CollectionMocker::push($return, $newModel3);

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('new_keyword_ids', $newKeywordIds);

            $this->verifyLoader($serv, 'created', $return);
        });
    }

    public function testLoaderExisted()
    {
        $this->when(function ($proxy, $serv) {

            $return     = $this->uniqueString();
            $keywords   = $this->mMock();
            $query      = $this->mMock();
            $authUser   = $this->factory(User::class)->make();
            $keywordIds = $this->uniqueString();

            CollectionMocker::modelKeys($keywords, $keywordIds);
            ModelMocker::aliasQuery(IdealTypable::class, $query);
            QueryMocker::lockForUpdate($query);
            QueryMocker::qWhereIn($query, IdealTypable::KEYWORD_ID, $keywordIds);
            QueryMocker::qWhere($query, IdealTypable::USER_ID, $authUser->getKey());
            QueryMocker::get($query, $return);

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('keywords', $keywords);

            $this->verifyLoader($serv, 'existed', $return);
        });
    }

    public function testLoaderExistedKeywordIds()
    {
        $this->when(function ($proxy, $serv) {

            $return  = $this->uniqueString();
            $existed = $this->mMock();

            CollectionMocker::pluck($existed, IdealTypable::KEYWORD_ID);
            CollectionMocker::all($existed, $return);

            $proxy->data->put('existed', $existed);

            $this->verifyLoader($serv, 'existed_keyword_ids', $return);
        });
    }

    public function testLoaderKeywords()
    {
        $this->when(function ($proxy, $serv) {

            $ids    = $this->uniqueString();
            $return = [KeywordObjListingService::class, [
                'ids'
                    => $ids
            ], [
                'ids'
                    => '{{keyword_ids}}'
            ]];

            $proxy->data->put('keyword_ids', $ids);

            $this->verifyLoader($serv, 'keywords', $return);
        });
    }

    public function testLoaderNewKeywordIds()
    {
        $this->when(function ($proxy, $serv) {

            $ids        = [1, 2, 3, 4, 5];
            $existedIds = [2, 4];
            $return     = [1, 3, 5];

            $proxy->data->put('existed_keyword_ids', $existedIds);
            $proxy->data->put('keyword_ids', $ids);

            $this->verifyLoader($serv, 'new_keyword_ids', $return);
        });
    }

}
