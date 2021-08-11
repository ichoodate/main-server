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
    protected $uri = 'api/notices';

    public function test()
    {
        $this->factory(User::class)->create(['id' => 1]);
        $this->factory(Role::class)->create(['user_id' => 1, 'type' => Role::TYPE_ADMIN]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('subject', $subject = $this->uniqueString());
            $this->setInputParameter('description', $description = $this->uniqueString());
            $this->setInputParameter('type', Notice::TYPE_EVENT);

            $this->assertResultWithPersisting(new Notice([
                'type' => Notice::TYPE_EVENT,
                'subject' => $subject,
                'description' => $description,
            ]));
        });
    }
}
