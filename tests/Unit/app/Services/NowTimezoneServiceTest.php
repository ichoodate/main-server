<?php

namespace Tests\Unit\App\Services;

use App\Services\DateTimeChangingService;
use Tests\_InstanceMocker as InstanceMocker;
use Tests\Unit\App\Services\_TestCase;

class NowTimezoneServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
        ]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([
            'timezone'
                => ['required', 'timezone']
        ]);
    }

    public function testLoaderNowTimezoneDate()
    {
        $this->when(function ($proxy, $serv) {

            $beforeDatetimeObj = $this->mMock();
            $timezone          = $this->uniqueString();
            $return            = [DateTimeChangingService::class, [
                'after_timezone'
                    => $timezone,
                'before_datetime_obj'
                    => $beforeDatetimeObj,
                'type'
                    => DateTimeChangingService::TYPE_DATE
            ]];

            InstanceMocker::add(\DateTime::class, $beforeDatetimeObj);

            $proxy->data->put('timezone', $timezone);

            $this->verifyLoader($serv, 'now_timezone_date', $return);
        });
    }

    public function testLoaderNowTimezoneTime()
    {
        $this->when(function ($proxy, $serv) {

            $beforeDatetimeObj = $this->mMock();
            $timezone          = $this->uniqueString();
            $return            = [DateTimeChangingService::class, [
                'after_timezone'
                    => $timezone,
                'before_datetime_obj'
                    => $beforeDatetimeObj,
                'type'
                    => DateTimeChangingService::TYPE_TIME
            ]];

            InstanceMocker::add(\DateTime::class, $beforeDatetimeObj);

            $proxy->data->put('timezone', $timezone);

            $this->verifyLoader($serv, 'now_timezone_time', $return);
        });
    }

    public function testLoaderNowTimezoneDateToUtc()
    {
        $this->when(function ($proxy, $serv) {

            $nowTimezoneDate = $this->uniqueString();
            $return          = [DateTimeChangingService::class, [
                'after_timezone'
                    => 'UTC',
                'before_datetime_obj'
                    => $nowTimezoneDate,
                'type'
                    => DateTimeChangingService::TYPE_TIME
            ]];

            $proxy->data->put('now_timezone_date', $nowTimezoneDate);

            $this->verifyLoader($serv, 'now_timezone_date_to_utc', $return);
        });
    }

}
