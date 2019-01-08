<?php

namespace Tests\Unit\App\Services\User;

use App\Database\Models\Profilable;
use App\Database\Models\User;
use App\Services\Obj\KeywordObjListingService;
use Tests\_InstanceMocker as InstanceMocker;
use Tests\Unit\App\Services\_TestCase;
use Tests\Unit\App\Database\Collections\_Mocker as CollectionMocker;
use Tests\Unit\App\Database\Models\_Mocker as ModelMocker;
use Tests\Unit\App\Database\Queries\_Mocker as QueryMocker;

class MatchingUserRandommingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([
            'keyword_ids'
                => ['required', 'integers'],
        ]);
    }

    public function testCallbackQueryKeywords()
    {
        $this->when(function ($proxy, $serv) {

            $query               = $this->mMock();
            $user                = $this->mMock();
            $userQuery           = $this->mMock();
            $profilable          = $this->mMock();
            $profilableQuery     = $this->mMock();
            $keywords            = $this->mMock();
            $keywordIds          = $this->uniqueString();
            $matchingGender      = $this->uniqueString();
            $userBaseQuery       = $this->uniqueString();
            $profilableBaseQuery = $this->uniqueString();

            CollectionMocker::modelKeys($keywords, $keywordIds);
            InstanceMocker::add(Profilable::class, $profilable);
            ModelMocker::aliasQuery($user, $userQuery);
            QueryMocker::qWhere($userQuery, User::GENDER, $matchingGender);
            QueryMocker::getQuery($userQuery, $userBaseQuery);
            InstanceMocker::add(User::class, $user);
            ModelMocker::aliasQuery($profilable, $profilableQuery);
            QueryMocker::qSelect($profilableQuery, Profilable::USER_ID);
            QueryMocker::qGroupBy($profilableQuery, Profilable::USER_ID);
            QueryMocker::qWhereIn($profilableQuery, Profilable::KEYWORD_ID, $keywordIds);
            QueryMocker::qWhereIn($profilableQuery, Profilable::USER_ID, $userBaseQuery);
            QueryMocker::orderByRaw($profilableQuery, 'count(*) desc');
            QueryMocker::limit($profilableQuery, 1000);
            QueryMocker::getQuery($profilableQuery, $profilableBaseQuery);
            QueryMocker::qWhereIn($query, User::ID, $profilableBaseQuery);
            QueryMocker::orderByRaw($query, 'rand()');

            $proxy->data->put('query', $query);
            $proxy->data->put('keywords', $keywords);
            $proxy->data->put('matching_gender', $matchingGender);

            $this->verifyCallback($serv, 'query.keywords');
        });

    }

    public function testLoaderKeywords()
    {
        $this->when(function ($proxy, $serv) {

            $keywordIds = [$this->uniqueString()];
            $return     = app(KeywordObjListingService::class, [[
                'ids'
                    => $keywordIds
            ], [
                'ids'
                    => '{{keyword_ids}}'
            ]]);

            $proxy->data->put('keyword_ids', $keywordIds);

            $this->verifyLoader($serv, 'keywords', $return);
        });
    }

    public function testLoaderMatchingGender()
    {
        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make([
                User::GENDER => User::GENDER_MAN
            ]);
            $return = User::GENDER_WOMAN;

            $proxy->data->put('auth_user', $authUser);

            $this->verifyLoader($serv, 'matching_gender', $return);
        });

        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make([
                User::GENDER => User::GENDER_WOMAN
            ]);
            $return = User::GENDER_MAN;

            $proxy->data->put('auth_user', $authUser);

            $this->verifyLoader($serv, 'matching_gender', $return);
        });
    }

    public function testLoaderModelClass()
    {
        $this->when(function ($proxy, $serv) {

            $this->verifyLoader($serv, 'model_class', User::class);
        });
    }

}
