<?php

namespace App\Services;

use App\Service;
use App\Services\DateTimeChangingService;

class NowTimezoneService extends Service {

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
            'now_timezone_date' => ['timezone', function ($timezone) {

                return [DateTimeChangingService::class, [
                    'after_timezone'
                        => $timezone,
                    'before_datetime_obj'
                        => inst(\DateTime::class),
                    'type'
                        => DateTimeChangingService::TYPE_DATE
                ]];
            }],

            'now_timezone_time' => ['timezone', function ($timezone) {

                return [DateTimeChangingService::class, [
                    'after_timezone'
                        => $timezone,
                    'before_datetime_obj'
                        => inst(\DateTime::class),
                    'type'
                        => DateTimeChangingService::TYPE_TIME
                ]];
            }],

            'now_timezone_date_to_utc' => ['timezone', 'now_timezone_date', function ($timezone, $nowTimezoneDate) {

                return [DateTimeChangingService::class, [
                    'after_timezone'
                        => 'UTC',
                    'before_time'
                        => $nowTimezoneDate,
                    'before_timezone'
                        => $timezone,
                    'type'
                        => DateTimeChangingService::TYPE_TIME
                ]];
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
            'timezone'
                => ['required', 'timezone']
        ];
    }

    public static function getArrTraits()
    {
        return [];
    }

}
