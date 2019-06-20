<?php

namespace Tests\Unit\App\Services;

class DateTimeChangingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([]);
    }

    public function testArrTraits()
    {
        $this->verifyArrTraits([]);
    }

    public function testLoaderAfterDatetimeObj()
    {
        $this->when(function ($proxy, $serv) {

            $beforeTime     = '2019-01-02 11:22:33';
            $beforeTimezone = 'Asia/Seoul';
            $afterTimezone  = 'UTC';
            $return         = (new \DateTime($beforeTime, new \DateTimeZone($beforeTimezone)))->setTimeZone(new \DateTimeZone($afterTimezone));

            $proxy->data->put('before_time', $beforeTime);
            $proxy->data->put('before_timezone', $beforeTimezone);
            $proxy->data->put('after_timezone', $afterTimezone);

            $this->verifyLoader($serv, 'after_datetime_obj', $return);
        });
    }

    public function testLoaderBeforeTime()
    {
        $this->when(function ($proxy, $serv) {

            $return            = '2019-01-02 11:22:33';
            $beforeDateTimeObj = new \DateTime($return);

            $proxy->data->put('before_datetime_obj', $beforeDateTimeObj);

            $this->verifyLoader($serv, 'before_time', $return);
        });
    }

    public function testLoaderBeforeTimezone()
    {
        $this->when(function ($proxy, $serv) {

            $return            = 'UTC';
            $date              = '2019-01-02 11:22:33';

            $beforeDateTimeObj = new \DateTime($date, new \DateTimeZone($return));

            $proxy->data->put('before_datetime_obj', $beforeDateTimeObj);

            $this->verifyLoader($serv, 'before_timezone', $return);
        });

        $this->when(function ($proxy, $serv) {

            $return            = 'Asia/Seoul';
            $date              = '2019-01-02 11:22:33';
            $beforeDateTimeObj = new \DateTime($date, new \DateTimeZone($return));

            $proxy->data->put('before_datetime_obj', $beforeDateTimeObj);

            $this->verifyLoader($serv, 'before_timezone', $return);
        });
    }

    public function testLoaderResult()
    {
        $this->when(function ($proxy, $serv) {

            $type             = static::class()::TYPE_TIME;
            $date             = '2019-01-02 11:22:33';
            $afterDateTimeObj = new \DateTime($date);
            $return           = $date;

            $proxy->data->put('after_datetime_obj', $afterDateTimeObj);
            $proxy->data->put('type', $type);

            $this->verifyLoader($serv, 'result', $return);
        });

        $this->when(function ($proxy, $serv) {

            $type             = static::class()::TYPE_DATE;
            $date             = '2019-01-02 11:22:33';
            $afterDateTimeObj = new \DateTime($date);
            $return           = '2019-01-02';

            $proxy->data->put('after_datetime_obj', $afterDateTimeObj);
            $proxy->data->put('type', $type);

            $this->verifyLoader($serv, 'result', $return);
        });

        $this->when(function ($proxy, $serv) {

            $type             = static::class()::TYPE_RANGE;
            $date             = '2019-01-02 11:22:33';
            $afterDateTimeObj = new \DateTime($date);
            $return           = ['2019-01-02 00:00:00', '2019-01-02 23:59:59'];

            $proxy->data->put('after_datetime_obj', $afterDateTimeObj);
            $proxy->data->put('type', $type);

            $this->verifyLoader($serv, 'result', $return);
        });
    }

}
