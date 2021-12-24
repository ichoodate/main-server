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
            'model' => function ($adminRole) {
                return $adminRole;
            },

            'permitted_user' => function ($authUser, $model) {
                if (!empty($model)) {
                    return $authUser;
                }
            },

            'result' => function ($description, $subject, $type) {
                return (new Notice())->create([
                    Notice::TYPE => $type,
                    Notice::SUBJECT => $subject,
                    Notice::DESCRIPTION => $description,
                ]);
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
