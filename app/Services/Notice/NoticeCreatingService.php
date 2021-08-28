<?php

namespace App\Services\Notice;

use App\Models\Notice;
use App\Services\PermittedUserRequiringService;
use FunctionalCoding\Service;

class NoticeCreatingService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'model' => '{{admin_role}}',
        ];
    }

    public static function getArrCallbacks()
    {
        return [];
    }

    public static function getArrLoaders()
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

    public static function getArrPromiseLists()
    {
        return [];
    }

    public static function getArrRuleLists()
    {
        return [
            'description' => ['required', 'string'],

            'subject' => ['required', 'string'],

            'type' => ['required', 'in:'.implode(',', Notice::TYPE_VALUES)],
        ];
    }

    public static function getArrTraits()
    {
        return [
            PermittedUserRequiringService::class,
        ];
    }
}
