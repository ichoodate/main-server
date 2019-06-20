<?php

namespace Tests\Unit\App\Services;

use App\Service;
use Tests\Unit\_TestCase as TestCase;
use Illuminate\Support\Collection;

abstract class _TestCase extends TestCase {

    abstract public function testArrBindNames();

    abstract public function testArrRuleLists();

    abstract public function testArrTraits();

    public function assertContainModelKeys($model, array $ids, $result)
    {
        $collection = $model::find($ids);

        foreach ( $collection as $model )
        {
            $this->assertContains(
                $model->getKey(),
                $result->modelKeys()
            );
        }

        $this->assertEquals(count($ids), $collection->count());
    }

    public function assertModel($model, integer $id, $result)
    {
        $this->assertNotNull($expect = $model::find($id));
        $this->assertEquals($expect, $result);
    }

    public function assertMethodExists($prefix, $key)
    {
        $method = $prefix . studly_case(str_replace('.', '_', str_replace('*', 'Asterisk', $key)));

        $exists = array_pluck($this->ref(static::class)->getMethods(), 'name');

        $this->assertContains($method, $exists, $method . ' not exists');
    }

    public function ifData()
    {
        $args = func_get_args();
        $fArg = array_shift($args);

        call_user_func_array($fArg, array_merge([app(Collection::class)], $args));
    }

    public function resolveBindName($serv, $key, $expect)
    {
        $proxy  = $this->proxy($serv);

        $resolver = $proxy->getArrBindNames()[$key];

        return $proxy->resolve($resolver);
    }

    public function resolveCallback($serv, $key)
    {
        $proxy = $this->proxy($serv);

        $resolver = $proxy->getArrCallbackLists()[$key];

        $proxy->resolve($resolver);
    }

    public function resolveLoader($serv, $key)
    {
        $proxy  = $this->proxy($serv);

        $resolver = $proxy->getArrLoaders()[$key];

        return $proxy->resolve($resolver);
    }

    public function resolveRuleList($serv, $key1, $key2)
    {
        $proxy = $this->proxy($serv);

        $resolver = $proxy->getArrRuleLists()[$key1][$key2];

        return $proxy->resolve($resolver);
    }

    public function testArrCallbackLists()
    {
        $serv  = inst(static::class());

        foreach ( $serv->getArrCallbackLists() as $key => $list )
        {
            $key = studly_case(str_replace('.', '_', $key));

            $this->assertMethodExists('testCallback', $key);
        }

        $this->success();
    }

    public function testArrLoaders()
    {
        $serv = inst(static::class());

        foreach ( $serv->getArrLoaders() as $key => $value )
        {
            $this->assertMethodExists('testLoader', $key);
        }

        $this->success();
    }

    public function testExtendClass()
    {
        if ( $this->class() != Service::class )
        {
            $this->assertEquals(Service::class, get_parent_class($this->class()));
        }

        $this->success();
    }

    public function testDataRuleInverseStructure()
    {
        $class         = static::class();
        $loaderArrKeys = array_keys(static::class()::getArrLoaders());

        foreach ( $class::getAllTraits() as $class )
        {
            $keys = $class::getAllRuleLists()->keys()->all();
            $loaderAllKeys = $class::getAllLoaders()->keys()->all();
            $loaderKeys = array_diff($loaderArrKeys, $loaderAllKeys);

            foreach ( $keys as $key )
            {
                $this->assertNotContains($key, $loaderKeys, $key . implode(',', $loaderArrKeys));
            }
        }

        $this->success();
    }

    public function testResolverKey()
    {
        $class      = static::class();
        $callbacks  = $class::getArrCallbackLists();
        $loaders    = $class::getArrLoaders();
        $ruleKeys   = $class::getAllRuleLists()->keys()->all();
        $loaderKeys = $class::getAllLoaders()->keys()->all();
        $allKeys    = array_merge($ruleKeys, $loaderKeys);

        foreach ( $callbacks as $callback )
        {
            $deps = array_slice($callback, 0, -1);

            foreach ( $deps as $dep )
            {
                $this->assertContains($dep, $allKeys);
            }
        }

        // foreach ( $loaders as $loader )
        // {
        //     $deps = array_slice($loader, 0, -1);

        //     foreach ( $deps as $dep )
        //     {
        //         $this->assertContains($dep, $allKeys);
        //     }
        // }

        $this->success();
    }

    public function verifyArrBindNames(array $expects)
    {
        $serv  = inst(static::class());

        foreach ( $serv->getArrBindNames() as $key => $value )
        {
            if ( is_string($value) )
            {
                $this->assertContains($key, array_keys($expects));
                $this->assertEquals($value, $expects[$key]);
            }
            else
            {
                $this->assertException(function () use ($value) {

                    call_user_func($value);
                });
            }
        }

        foreach ( $expects as $key => $value )
        {
            $this->assertContains($key, array_keys($serv->getArrBindNames()));
        }

        $this->success();
    }

    public function verifyArrRuleLists(array $expects)
    {
        $serv    = inst(static::class());
        $actuals = $serv->getArrRuleLists();

        foreach ( $actuals as $key => $list )
        {
            $this->assertContains($key, array_keys($expects));

            foreach ( $list as $i => $value )
            {
                $this->assertContains($value, $expects[$key]);
            }
        }

        foreach ( $expects as $key => $list )
        {
            $this->assertContains($key, array_keys($actuals));

            foreach ( $list as $value )
            {
                $this->assertContains($value, $actuals[$key]);
            }
        }

        $this->success();
    }

    public function verifyArrTraits(array $expects)
    {
        $serv    = inst(static::class());
        $actuals = $serv->getArrTraits();

        $this->assertEquals($expects, $actuals);
    }

    public function verifyCallback($serv, $key)
    {
        $this->resolveCallback($serv, $key);

        $this->success();
    }

    public function verifyLoader($serv, $key, $expect, $args = [])
    {
        $actual = $this->resolveLoader($serv, $key);

        if ( is_object($actual) && $actual instanceof \Closure )
        {
            $actual = $actual->call($serv, ...$args);
        }

        $this->assertEquals($expect, $actual);

        if ( is_array($expect) && array_key_exists(0, $expect) && get_parent_class($expect[0]) == Service::class )
        {
            $this->assertMethodExists('testData', $key);
        }
    }

    public function verifyData($serv, $key, $expect)
    {
        foreach ( $serv->data()->keys() as $dataKey )
        {
            $serv->validated->put($dataKey, true);
        }

        $serv->validate($key);

        $this->assertEquals(true, $serv->data()->has($key));
        $this->assertEquals($expect, $serv->data()->get($key));
        $this->assertEquals([], $serv->errors()->all());
    }

    public function when()
    {
        $serv  = inst($this->class());
        $proxy = $this->proxy($serv);
        $args  = func_get_args();
        $func  = array_shift($args);

        $ruleKeys   = $serv->getAllRuleLists()->keys()->all();
        $loaderKeys = $serv->getAllLoaders()->keys()->all();
        $keys       = array_merge($ruleKeys, $loaderKeys);
        $values     = $keys;

        foreach ( $values as $i => $value )
        {
            $values[$i] = '[' . $value . ']';
        }

        $proxy->names = $proxy->names->merge(array_combine($keys, $values));

        app('db')->beginTransaction();

        call_user_func_array($func, array_merge([$proxy, $serv], $args));

        app('db')->rollback();
    }

}
