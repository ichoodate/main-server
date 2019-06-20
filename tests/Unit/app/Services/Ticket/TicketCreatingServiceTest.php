<?php

namespace Tests\Unit\App\Services\Ticket;

use App\Database\Models\Ticket;
use App\Database\Models\User;
use App\Services\CreatingService;
use Tests\_InstanceMocker as InstanceMocker;
use Tests\Unit\App\Database\Models\_Mocker as ModelMocker;
use Tests\Unit\App\Services\_TestCase;

class TicketCreatingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([
            'auth_user'
                => ['required'],

            'description'
                => ['required', 'string'],

            'subject'
                => ['required', 'string']
        ]);
    }

    public function testArrTraits()
    {
        $this->verifyArrTraits([
            CreatingService::class
        ]);
    }

    public function testLoaderCreated()
    {
        $this->when(function ($proxy, $serv) {

            $inst        = $this->mMock();
            $authUser    = $this->factory(User::class)->make();
            $subject     = $this->uniqueString();
            $description = $this->uniqueString();
            $return      = $this->uniqueString();

            InstanceMocker::add(Ticket::class, $inst);
            ModelMocker::create($inst, [
                Ticket::WRITER_ID   => $authUser->getKey(),
                Ticket::SUBJECT     => $subject,
                Ticket::DESCRIPTION => $description
            ], $return);

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('subject', $subject);
            $proxy->data->put('description', $description);

            $this->verifyLoader($serv, 'created', $return);
        });
    }

}
