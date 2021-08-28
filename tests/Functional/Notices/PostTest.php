<?php

namespace Tests\Functional\Notices;

use App\Models\Notice;
use App\Models\Role;
use App\Models\User;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class PostTest extends _TestCase
{
    protected $uri = 'notices';

    public function test()
    {
        User::factory()->create(['id' => 1]);
        Role::factory()->create(['user_id' => 1, 'type' => 'admin']);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('subject', $subject = 'abcd');
            $this->setInputParameter('description', $description = 'bcde');
            $this->setInputParameter('type', 'event');

            $this->runService();

            $this->assertResultWithPersisting(new Notice([
                'type' => 'event',
                'subject' => $subject,
                'description' => $description,
            ]));
        });
    }
}
