<?php

namespace Tests\Functional\Api\IdealTypeKeyword;

use App\Database\Models\User;
use App\Database\Models\UserIdealTypeKwdPvt;
use App\Database\Models\Keyword\Residence;
use Tests\Functional\_TestCase;

class ResidencesPostTest extends _TestCase {

    protected $uri = 'api/ideal-type-keyword/residences';

    public function test()
    {
        $this->factory(User::class)->create(['id' => 1]);
        $this->factory(User::class)->create(['id' => 2]);
        $this->factory(Residence::class)->create(['id' => 11]);
        $this->factory(Residence::class)->create(['id' => 12]);
        $this->factory(Residence::class)->create(['id' => 13]);
        $this->factory(UserIdealTypeKwdPvt::class)->create(['id' => 101, 'user_id' => 1, 'keyword_id' => 11]);
        $this->factory(UserIdealTypeKwdPvt::class)->create(['id' => 102, 'user_id' => 1, 'keyword_id' => 12]);
        $this->factory(UserIdealTypeKwdPvt::class)->create(['id' => 104, 'user_id' => 2, 'keyword_id' => 12]);

        $this->when(function () {

            $this->setAuthUser(User::find(1));
            $this->setInputParameter('keyword_id', 13);

            $this->assertResultWithPersisting(new UserIdealTypeKwdPvt([
                UserIdealTypeKwdPvt::USER_ID
                    => 1,
                UserIdealTypeKwdPvt::KEYWORD_ID
                    => 13
            ]));
            $this->assertEquals(0, UserIdealTypeKwdPvt::query()
                ->where(UserIdealTypeKwdPvt::USER_ID, 1)
                ->whereIn(UserIdealTypeKwdPvt::KEYWORD_ID, [11, 12])
                ->count()
            );
            $this->assertEquals(1, UserIdealTypeKwdPvt::query()
                ->where(UserIdealTypeKwdPvt::USER_ID, 2)
                ->where(UserIdealTypeKwdPvt::KEYWORD_ID, 12)
                ->count()
            );
        });
    }

    public function testErrorIntegerRuleKeywordId()
    {
        $this->when(function () {

            $this->setInputParameter('keyword_id', 'abcd');

            $this->assertError('[keyword_id] must be an integer.');
        });
    }

    public function testErrorRequiredRuleAuthUser()
    {
        $this->when(function () {

            $this->assertError('authorized user is required.');
        });
    }

    public function testErrorRequiredRuleKeywordId()
    {
        $this->when(function () {

            $this->assertError('[keyword_id] is required.');
        });
    }

    public function testErrorNotNullRuleKeywordModel()
    {
        $this->factory(Residence::class)->create(['id' => 11]);
        $this->factory(Residence::class)->create(['id' => 12]);

        $this->when(function () {

            $this->setInputParameter('keyword_id', 13);

            $this->assertError('residence_country keyword for [keyword_id] must exist.');
        });
    }

}
