<?php

namespace Tests\Feature\App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Tests\Feature\_TestCase as TestCase;

abstract class _TestCase extends TestCase {

    abstract public function setUpArgs();

    public function assertResult($expect)
    {
        $serv   = $this->runService();
        $result = $serv->data()->get('result');

        $this->assertEquals([], $serv->errors()->all(), implode(',', $serv->errors()->all()));
        $this->assertNotNull($result);

        if ( $expect instanceof Collection )
        {
            $this->assertEquals(get_class($result), get_class($expect));

            foreach ( $expect as $item )
            {
                $filtered = $result->filter(function ($value) use ($item) {

                    if ( $item instanceof Model )
                    {
                        $item = $item->toArray();
                    }

                    $value = $value->toArray();

                    return [] == array_diff_assoc($item, $value);
                });

                $this->assertEquals(1, $filtered->count());
            }
        }
        else if ( $expect instanceof Model )
        {
            $this->assertEquals(get_class($result), get_class($expect));

            $this->assertRecordExist($expect);

            $expect = $expect->toArray();
            $result = $result->toArray();

            $this->assertEquals([], array_diff_assoc($expect, $result));
        }
        else
        {
            $this->assertEquals($expect, $result);
        }
    }

    public function assertRecordExist($model)
    {
        $attrs = $model->getAttributes();
        $query = $model->query();

        foreach ( $attrs as $key => $value )
        {
            $query->where($key, $value);
        }

        $this->assertNotNull($query->first());
    }

    public function assertError($expect)
    {
        $serv   = $this->runService();
        $actual = $serv->errors();

        $this->assertEquals(1, count($actual), $actual);
        $this->assertEquals($expect, $actual[0]);
    }

    public function runService()
    {
        $args = $this->setUpArgs();

        $serv = inst(static::class(), [null, $args[0], $args[1]]);

        $serv->runProcess();

        return $serv;
    }

}
