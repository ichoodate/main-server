<?php

namespace Tests\Functional;

use App\Http\Middlewares\ResponseHeaderSettingMiddleware;
use App\Http\Middlewares\ServiceRunMiddleware;
use App\Model;
use Faker\Generator as Faker;
use FunctionalCoding\JWT\Service\TokenEncryptionService;
use FunctionalCoding\Service;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
class _TestCase extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->faker = app(Faker::class);

        $this->withoutMiddleware(ServiceRunMiddleware::class);
        $this->withoutMiddleware(ResponseHeaderSettingMiddleware::class);

        app('db')->beginTransaction();
    }

    public function tearDown(): void
    {
        $this->beforeApplicationDestroyed(function () {
            DB::disconnect();
        });

        app('db')->rollback();

        parent::tearDown();
    }

    public function assertError($msg)
    {
        $errors = $this->service->totalErrors();

        $this->assertContains($msg, $errors, implode(',', $errors));
    }

    public function assertPersistence($model, $existCount = 1)
    {
        $attrs = $model->getAttributes();
        $query = app(get_class($model))->query();

        foreach ($attrs as $attr => $value) {
            $query->where($attr, $value);
        }

        $this->assertEquals($existCount, $query->count());
    }

    public function assertResult($expect)
    {
        $errors = $this->service->totalErrors();
        $this->assertEquals([], $errors, implode(',', $errors));

        $result = $this->service->data()->getArrayCopy()['result'];
        $this->assertEquals($expect, $result);
    }

    public function assertResultWithFinding($expectId)
    {
        $errors = $this->service->totalErrors();
        $this->assertEquals([], $errors, implode(',', $errors));

        $result = $this->service->data()->getArrayCopy()['result'];

        $this->assertInstanceOf(Model::class, $result);
        $this->assertEquals($expectId, $result->getKey());
    }

    public function assertResultWithListing($expectIds)
    {
        $errors = $this->service->totalErrors();
        $this->assertEquals([], $errors, implode(',', $errors));

        $result = $this->service->data()->getArrayCopy()['result'];

        foreach ($expectIds as $expectId) {
            $this->assertContains($expectId, $result->modelKeys());
        }
    }

    public function assertResultWithPaging($expectIds)
    {
        $errors = $this->service->totalErrors();
        $this->assertEquals([], $errors, implode(',', $errors));

        $result = $this->service->data()->getArrayCopy()['result']->modelKeys();

        sort($expectIds);
        sort($result);

        $this->assertEquals($result, $expectIds);
    }

    public function assertResultWithPersisting($expects)
    {
        $errors = $this->service->totalErrors();
        $this->assertEquals([], $errors, implode(',', $errors));

        $result = $this->service->data()->getArrayCopy()['result'];
        if ($expects instanceof Model) {
            $this->assertInstanceOf(Model::class, $result);

            $expects = collect([$expects]);
            $result = collect([$result]);
        }

        foreach ($result as $i => $model) {
            $expect = $expects[$i];

            $this->assertInstanceOf(Model::class, $model);
            $this->assertEquals(get_class($expect), get_class($model));
            $this->assertEquals([], array_diff($expect->toArray(), $model->toArray()));
        }
    }

    public function getResponse()
    {
        $class = explode('\\', static::class);
        $class = array_pop($class);
        $class = Str::snake($class);
        $class = preg_replace('/_test$/', '', $class);
        $class = explode('_', $class);
        $method = strtoupper(array_pop($class));

        return $this->call($method, $url = $this->url, $parameters = $this->inputs, $cookies = [], $files = [], $server = $this->server, $content = null);
    }

    public function runService()
    {
        $response = $this->getResponse();
        $content = $response->getOriginalContent();

        $this->assertTrue(Service::isInitable($content));

        $service = Service::initService($content);
        $service->run();

        $this->service = $service;
        $this->data = $service->data()->getArrayCopy();

        return $service;
    }

    public function setAuthUser($user)
    {
        $service = new TokenEncryptionService([
            'payload' => [
                'uid' => $user->getKey(),
                'expired_at' => '9999-12-31 23:59:59',
            ],
            'public_key' => \file_get_contents(storage_path('app/id_rsa.pub')),
        ], [
            'payload' => '...',
            'public_key' => '...',
        ]);
        $this->server['HTTP_AUTHORIZATION'] = 'Bearer '.$service->run();
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

    public function when()
    {
        $args = func_get_args();

        auth()->logout();

        $this->url = $this->uri;
        $this->inputs = [];
        $this->server = [];

        app('db')->beginTransaction();

        call_user_func($args[0]);

        app('db')->rollback();
    }
}
