<?php

namespace App\Services;

use App\Service;

class DateTimeChangingService extends Service {

    const TYPE_DATE  = 'date';
    const TYPE_RANGE = 'range';
    const TYPE_TIME  = 'time';

    const TYPE_VALUES = [
        self::TYPE_DATE,
        self::TYPE_RANGE,
        self::TYPE_TIME
    ];

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
            'after_datetime_obj' => ['before_time', 'before_timezone', 'after_timezone', function ($beforeTime, $beforeTimezone, $afterTimezone) {

                return (new \DateTime($beforeTime, new \DateTimeZone($beforeTimezone)))->setTimeZone(new \DateTimeZone($afterTimezone));
            }],

            'before_time' => ['before_datetime_obj', function ($beforeDatetimeObj) {

                return $beforeDatetimeObj->format('Y-m-d H:i:s');
            }],

            'before_timezone' => ['before_datetime_obj', function ($beforeDatetimeObj) {

                return $beforeDatetimeObj->getTimeZone()->getName();
            }],

            'result' => ['type', 'after_datetime_obj', function ($type, $afterDatetimeObj) {

                if ( $type == self::TYPE_TIME )
                {
                    return $afterDatetimeObj->format('Y-m-d H:i:s');
                }
                else if ( $type == self::TYPE_DATE )
                {
                    return $afterDatetimeObj->format('Y-m-d');
                }
                else if ( $type == self::TYPE_RANGE )
                {
                    return [$afterDatetimeObj->format('Y-m-d') . ' 00:00:00', $afterDatetimeObj->format('Y-m-d') . ' 23:59:59'];
                }
            }]
        ];
    }

    public static function getArrPromiseLists()
    {
        return [];
    }

    public static function getArrRuleLists()
    {
        return [];
    }

    public static function getArrTraits()
    {
        return [];
    }

}
