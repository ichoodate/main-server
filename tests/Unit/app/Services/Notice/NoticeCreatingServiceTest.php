<?php

namespace Tests\Unit\App\Services\Notice;

use App\Database\Models\Notice;
use Tests\Unit\App\Database\Models\_Mocker as ModelMocker;
use Tests\Unit\App\Services\_TestCase;

class NoticeCreatingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([
            'description'
                => ['required', 'string'],

            'subject'
                => ['required', 'string'],

            'type'
                => ['required', 'in:' . implode(',', Notice::TYPE_VALUES)]
        ]);
    }

    public function testLoaderCreated()
    {
        $this->when(function ($proxy, $serv) {

            $type        = $this->uniqueString();
            $subject     = $this->uniqueString();
            $description = $this->uniqueString();
            $return      = $this->uniqueString();

            ModelMocker::create(Notice::class, [
                Notice::TYPE        => $type,
                Notice::SUBJECT     => $subject,
                Notice::DESCRIPTION => $description
            ], $return);

            $proxy->data->put('type', $type);
            $proxy->data->put('subject', $subject);
            $proxy->data->put('description', $description);

            $this->verifyLoader($serv, 'created', $return);
        });
    }

}
