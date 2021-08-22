<?php

namespace Tests\Functional\Users;

use App\Models\ProfilePhoto;
use App\Models\User;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class IdProfilePhotosGetTest extends _TestCase
{
    protected $uri = 'api/users/{id}/profile-photos';

    public function test()
    {
        User::factory()->create(['id' => 1]);
        User::factory()->create(['id' => 2]);
        User::factory()->create(['id' => 3]);
        ProfilePhoto::factory()->create(['id' => 11, 'user_id' => 1]);
        ProfilePhoto::factory()->create(['id' => 12, 'user_id' => 1]);
        ProfilePhoto::factory()->create(['id' => 13, 'user_id' => 2]);
        ProfilePhoto::factory()->create(['id' => 14, 'user_id' => 2]);
        ProfilePhoto::factory()->create(['id' => 15, 'user_id' => 3]);
        ProfilePhoto::factory()->create(['id' => 16, 'user_id' => 3]);

        $this->when(function () {
            $this->setRouteParameter('id', 1);

            $this->assertResultWithListing([11, 12]);
        });

        $this->when(function () {
            $this->setRouteParameter('id', 2);

            $this->assertResultWithListing([13, 14]);
        });

        $this->when(function () {
            $this->setRouteParameter('id', 3);

            $this->assertResultWithListing([15, 16]);
        });
    }

    public function test2()
    {
        app('db')->getSchemaBuilder()->disableForeignKeyConstraints();

        app('db')->beginTransaction();

        ProfilePhoto::factory()->create(['id' => 2]);

        app('db')->rollback();

        app('db')->getSchemaBuilder()->enableForeignKeyConstraints();

        $this->success();
    }
}
