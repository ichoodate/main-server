<?php

namespace App\Services\Notice;

use App\Database\Models\Photo;
use App\Database\Models\Notice;
use Illuminate\Extend\Service;
use App\Services\AdminRoleExistingService;
use App\Services\CreatingService;
use App\Services\Photo\PhotosCreatingService;

class NoticeCreatingService extends Service {

    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'created' => ['type', 'subject', 'description', function ($type, $subject, $description) {

                return (new Notice)->create([
                    Notice::TYPE        => $type,
                    Notice::SUBJECT     => $subject,
                    Notice::DESCRIPTION => $description
                ]);
            }]
        ];
    }

    public static function getArrPromiseLists()
    {
        return [];
    }

    public static function getArrRuleLists()
    {
        return [
            'admin_role'
                => ['required'],

            'description'
                => ['required', 'string'],

            'subject'
                => ['required', 'string'],

            'type'
                => ['required', 'in:' . implode(',', Notice::TYPE_VALUES)],
        ];
    }

    public static function getArrTraits()
    {
        return [
            AdminRoleExistingService::class,
            CreatingService::class
        ];
    }

}
