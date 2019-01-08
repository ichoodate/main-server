<?php

namespace Tests\Unit\App\Services\Obj;

use App\Database\Models\Obj;
use App\Database\Collections\Collection;
use Tests\_InstanceMocker as InstanceMocker;
use Tests\Unit\App\Database\Models\_Mocker as ModelMocker;
use Tests\Unit\App\Database\Queries\_Mocker as QueryMocker;
use Tests\Unit\App\Services\_TestCase;

class KeywordObjListingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
        ]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([
            'ids'
                => ['required', 'string']
        ]);
    }

    public function testLoaderResult()
    {
        $this->when(function ($proxy, $serv) {

            $obj      = $this->mMock();
            $objQuery = $this->mMock();
            $obj1     = $this->factory(Obj::class)->make();
            $obj2     = $this->factory(Obj::class)->make();
            $obj3     = $this->factory(Obj::class)->make();
            $list     = inst(Collection::class, [[$obj1, $obj2]]);
            $ids      = $obj2->getKey().','.$obj3->getKey().','.$obj1->getKey();
            $return   = inst(Collection::class, [[$obj2, null, $obj1]]);

            InstanceMocker::add(Obj::class, $obj);
            ModelMocker::aliasQuery($obj, $objQuery);
            QueryMocker::qWhereIn($objQuery, Obj::ID, [$obj2->getKey(), $obj3->getKey(), $obj1->getKey()]);
            QueryMocker::qWhereIn($objQuery, Obj::TYPE, [Obj::TYPE_KEYWORD_BODY]);
            QueryMocker::get($objQuery, $list);

            $proxy->data->put('ids', $ids);

            $this->verifyLoader($serv, 'result', $return);
        });
    }

}
