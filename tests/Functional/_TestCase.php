<?php

namespace Tests\Functional;

use App\Database\Model;
use Faker\Generator as Faker;
use Illuminate\Extend\Service;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
class _TestCase extends TestCase
{
    use DatabaseMigrations;
    use WithoutMiddleware;

    public $environment = 'functional';

    public function setUp(): void
    {
        parent::setUp();

        $this->faker = app(Faker::class);
    }

    public function assertDeletion($model)
    {
        $this->assertPersistence($model, 0);
    }

    public function assertError($msg)
    {
        $serv = $this->runService();
        $errors = $serv->totalErrors()->all();

        $this->assertContains($msg, $errors, implode(',', $errors));
    }

    public static function assertException($executeClosure, $expectClosure = null)
    {
        try {
            call_user_func($executeClosure);
        } catch (\Exception $e) {
            if (null != $expectClosure) {
                call_user_func($expectClosure, $e);
            }

            static::success();

            return;
        }

        static::fail();
    }

    public function assertPersistence($model, $existCount = 1)
    {
        $attrs = $model->getAttributes();
        $query = inst(get_class($model))->query();

        foreach ($attrs as $attr => $value) {
            $query->where($attr, $value);
        }

        $this->assertEquals($existCount, $query->count());
    }

    public function assertResult($expect)
    {
        $serv = $this->runService();
        $result = $serv->data()->get('result');
        $errors = $serv->totalErrors()->all();

        $this->assertEquals([], $errors, implode(',', $errors));
        $this->assertEquals($expect, $result);
    }

    public function assertResultWithFinding($expectId)
    {
        $serv = $this->runService();
        $result = $serv->data()->get('result');
        $errors = $serv->totalErrors()->all();

        $this->assertInstanceOf(Model::class, $result);
        $this->assertEquals($expectId, $result->getKey());
    }

    public function assertResultWithListing($expectIds)
    {
        $serv = $this->runService();
        $result = $serv->data()->get('result');
        $errors = $serv->totalErrors()->all();

        $this->assertEquals([], $errors, implode(',', $errors));

        foreach ($expectIds as $expectId) {
            $this->assertContains($expectId, $result->modelKeys());
        }
    }

    public function assertResultWithPaging($expectIds)
    {
        $serv = $this->runService();
        $result = $serv->data()->get('result')->modelKeys();
        $errors = $serv->totalErrors()->all();

        sort($expectIds);
        sort($result);

        $this->assertEquals([], $errors, implode(',', $errors));
        $this->assertEquals($result, $expectIds);
    }

    public function assertResultWithPersisting($expects)
    {
        $serv = $this->runService();
        $result = $serv->data()->get('result');
        $errors = $serv->totalErrors()->all();

        if ($expects instanceof Model) {
            $this->assertInstanceOf(Model::class, $result);

            $expects = collect([$expects]);
            $result = collect([$result]);
        }

        $this->assertEquals([], $errors, implode(',', $errors));
        $this->assertEquals(get_class($expects), get_class($result));

        foreach ($result as $i => $model) {
            $expect = $expects[$i];

            $this->assertInstanceOf(Model::class, $model);
            $this->assertEquals(get_class($expect), get_class($model));
            $this->assertEquals([], array_diff($expect->toArray(), $model->toArray()));
        }
    }

    public function assertResultWithReturning($expect)
    {
        $serv = $this->runService();
        $result = $serv->data()->get('result');
        $errors = $serv->totalErrors()->all();

        $this->assertEquals([], $errors, implode(',', $errors));
        $this->assertEquals($expect, $result);
    }

    public static function factory($modelClass)
    {
        $path = str_replace('App\\Database\\Models\\', '', $modelClass);

        return inst('Database\\Factories\\Model\\'.$path.'Factory');
    }

    public function getHttpMethod()
    {
        $class = explode('\\', static::class);
        $class = array_pop($class);
        $class = snake_case($class);
        $class = preg_replace('/_test$/', '', $class);
        $class = explode('_', $class);

        return strtoupper(array_pop($class));
    }

    public function getQuery($serv)
    {
        $builder = $serv->data()->get('query');
        $addSlashes = str_replace('?', "'?'", $builder->toSql());
        $q = vsprintf(str_replace('?', '%s', $addSlashes), $builder->getBindings());
    }

    public function getResponse()
    {
        $method = $this->getHttpMethod();

        return $this->call($method, $url = $this->url, $parameters = $this->inputs, $cookies = [], $files = [], $server = [], $content = null);
    }

    public static function invokeMethod($object, $method, $args, $public = true)
    {
        if (is_string($method)) {
            $reflection = new \ReflectionClass($object);

            $method = $reflection->getMethod($method);

            if ($public) {
                $method->setAccessible(true);
            }

            return $method->invokeArgs($object, $args);
        }
        $method = \Closure::bind($method, $object);

        return call_user_func_array($method, $args);
    }

    public static function ref(...$args)
    {
        return new \ReflectionClass(...$args);
    }

    public function runService()
    {
        $response = $this->getResponse();
        $content = $response->getOriginalContent();

        $this->assertTrue(Service::isCanServicify($content));

        $service = Service::initService($content);
        $service->run();

        return $service;
    }

    public function setAuthUser($user)
    {
        auth()->setUser($user);
    }

    public function setInputParameter($key, $value)
    {
        $this->inputs[$key] = $value;
    }

    public function setRouteParameter($key, $value)
    {
        $replace = $value;
        $subject = $this->url;
        $search = '{'.$key.'}';

        $this->url = str_replace($search, $replace, $subject);
    }

    public static function success()
    {
        static::assertTrue(true);
    }

    public static function uniqueString()
    {
        return str_random(50);
    }

    public function when()
    {
        $args = func_get_args();

        auth()->logout();

        $this->url = $this->uri;
        $this->inputs = [];

        app('db')->beginTransaction();

        call_user_func($args[0]);

        app('db')->rollback();
    }
}
