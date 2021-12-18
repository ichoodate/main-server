<?php

namespace App\Services\Notice;

use App\Models\Notice;
use App\Services\PermittedUserRequiringService;
use FunctionalCoding\Service;

class NoticeCreatingService extends Service
{
    public static function getBindNames()
    {
        return [
            'model' => '{{admin_role}}',
        ];
    }

    public static function getCallbacks()
    {
        return [];
    }

    public static function getLoaders()
    {
        return [
            'result' => function ($description, $subject, $type) {
                return (new Notice())->create([
                    Notice::TYPE => $type,
                    Notice::SUBJECT => $subject,
                    Notice::DESCRIPTION => $description,
                ]);
            },

            'model' => function ($adminRole) {
                return $adminRole;
            },

            'permitted_user' => function ($model, $authUser) {
                if (!empty($model)) {
                    return $authUser;
                }
            },
        ];
    }

    public static function getPromiseLists()
    {
        return [];
    }

    public static function getRuleLists()
    {
        return [
            'description' => ['required', 'string'],

            'subject' => ['required', 'string'],

            'type' => ['required', 'in:'.implode(',', Notice::TYPE_VALUES)],
        ];
    }

    public static function getTraits()
    {
        return [
            PermittedUserRequiringService::class,
        ];
    }
}
