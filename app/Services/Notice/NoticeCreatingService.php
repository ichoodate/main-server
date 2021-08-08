<?php

namespace App\Services\Notice;

use App\Database\Models\Notice;
use App\Services\AdminRoleExistingService;
use Illuminate\Extend\Service;

class NoticeCreatingService extends Service
{
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
            'created' => function ($description, $subject, $type) {
                return (new Notice())->create([
                    Notice::TYPE => $type,
                    Notice::SUBJECT => $subject,
                    Notice::DESCRIPTION => $description,
                ]);
            },
        ];
    }

    public static function getArrPromiseLists()
    {
        return [];
    }

    public static function getArrRuleLists()
    {
        return [
            'admin_role' => ['required'],

            'description' => ['required', 'string'],

            'subject' => ['required', 'string'],

            'type' => ['required', 'in:'.implode(',', Notice::TYPE_VALUES)],
        ];
    }

    public static function getArrTraits()
    {
        return [
            AdminRoleExistingService::class,
        ];
    }
}
