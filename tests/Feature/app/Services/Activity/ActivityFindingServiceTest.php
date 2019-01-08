<?php

namespace Tests\Feature\App\Services\Activity;

use App\Database\Models\Activity;
use App\Database\Models\User;
use Tests\Feature\App\Services\_TestCase;

class ActivityFindingServiceTest extends _TestCase {

    public function testId()
    {
        $this->factory(User::class)->create([
            'id' => 1
        ]);
        $this->factory(Activity::class)->create([
            'id' => 11,
            'user_id' => 1
        ]);
        $this->factory(Activity::class)->create([
            'id' => 12,
            'user_id' => 1
        ]);

        $this->id = 11;
        $this->authUserId = 1;
        $this->assertResult(Activity::find(11));

        $this->id = 12;
        $this->assertResult(Activity::find(12));
    }

    public function testPermittedUser()
    {
        $this->factory(User::class)->create([
            'id' => 1
        ]);
        $this->factory(User::class)->create([
            'id' => 2
        ]);
        $this->factory(Activity::class)->create([
            'id' => 11,
            'user_id' => 1
        ]);
        $this->factory(Activity::class)->create([
            'id' => 12,
            'user_id' => 2
        ]);

        $this->authUserId = 1;
        $this->id = 11;
        $this->assertResult(Activity::find(11));

        $this->id = 12;
        $this->assertError('authorized user who is owner of activity of [id] is required.');
    }

}
