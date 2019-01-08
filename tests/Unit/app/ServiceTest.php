<?php

namespace Tests\Unit\App;

use App\Service;
use Tests\Unit\_TestCase as TestCase;

class ServiceTest extends TestCase {

    public function testChilds()
    {
        $this->when(function ($proxy, $serv) {

            $proxy->childs->put('key', 'value');

            $this->assertSame($proxy->childs, $proxy->childs());
            $this->assertEquals($proxy->childs, $proxy->childs());
            $this->assertEquals('value', $proxy->childs()->get('key'));
        });
    }

    public function testData()
    {
        $this->when(function ($proxy, $serv) {

            $proxy->data->put('key', 'value');

            $this->assertNotSame($proxy->data, $proxy->data());
            $this->assertEquals($proxy->data, $proxy->data());
            $this->assertEquals('value', $proxy->data()->get('key'));
        });
    }

    public function testErrors()
    {
        $this->when(function ($proxy, $serv) {

            $proxy->errors->put('key', 'value');

            $this->assertNotSame($proxy->errors, $proxy->errors());
            $this->assertEquals($proxy->errors, $proxy->errors());
            $this->assertEquals('value', $proxy->errors()->get('key'));
        });
    }

    public function testGetAllBindNames()
    {
        $this->when(function () {

            $serv = inst(_ChildService::class);

            $this->assertEquals([
                'key1' => 'parent name1',
                'key2' => 'child name2',
                'key3' => 'child name3'
            ], $serv->getAllBindNames()->all());
        });
    }

    public function testGetAllCallbackLists()
    {
        $this->when(function () {

            $serv = inst(_ChildService::class);

            $this->assertEquals([
                'key1' => [['parent callback1']],
                'key2' => [['parent callback2'], ['child callback2']],
                'key3' => [['child callback3']]
            ], $serv->getAllCallbackLists()->all());
        });
    }

    public function testGetAllLoaders()
    {
        $this->when(function () {

            $serv = inst(_ChildService::class);

            $this->assertEquals([
                'key1' => ['parent loader1'],
                'key2' => ['child loader2'],
                'key3' => ['child loader3']
            ], $serv->getAllLoaders()->all());
        });
    }

    public function testGetAllRuleLists()
    {
        $this->when(function () {

            $serv = inst(_ChildService::class);

            $this->assertEquals([
                'key1' => ['parent rule1'],
                'key2' => ['parent rule2', 'child rule2'],
                'key3' => ['child rule3']
            ], $serv->getAllRuleLists()->all());
        });
    }

    public function testGetArrBindNames()
    {
        $this->when(function () {

            $serv = inst(_ChildService::class);

            $this->assertEquals([
                'key2' => 'child name2',
                'key3' => 'child name3'
            ], $serv->getArrBindNames());
        });
    }

    public function testGetArrCallbackLists()
    {
        $this->when(function () {

            $serv = inst(_ChildService::class);

            $this->assertEquals([
                'key2.0' => ['child callback2'],
                'key3.0' => ['child callback3']
            ], $serv->getArrCallbackLists());
        });
    }

    public function testGetArrLoaders()
    {
        $this->when(function () {

            $serv = inst(_ChildService::class);

            $this->assertEquals([
                'key2' => ['child loader2'],
                'key3' => ['child loader3']
            ], $serv->getArrLoaders());
        });
    }

    public function testGetArrRuleLists()
    {
        $this->when(function () {

            $serv = inst(_ChildService::class);

            $this->assertEquals([
                'key2' => ['child rule2'],
                'key3' => ['child rule3']
            ], $serv->getArrRuleLists());
        });
    }

    public function testGetResult()
    {
        $this->when(function ($proxy, $serv) {

            $proxy->errors->push('error1');
            $proxy->data->put('result', 'value');

            $this->assertEquals($proxy->resolveError(), $proxy->getResult());
        });

        $this->when(function ($proxy, $serv) {

            $childServ = inst(_ChildService::class);
            $childProxy = $this->proxy($childServ);

            $childProxy->errors->push('error1');
            $proxy->childs->push($childServ);
            $proxy->data->put('result', 'value');

            $this->assertEquals($proxy->resolveError(), $proxy->getResult());
        });

        $this->when(function ($proxy, $serv) {

            $proxy->data->put('result', 'result1');

            $this->assertEquals('result1', $proxy->getResult());
        });
    }

    public function testGetTotalErrors()
    {
        $this->when(function ($proxy, $serv) {

            $childServ  = inst(_ChildService::class);
            $childProxy = $this->proxy($childServ);

            $childProxy->errors->push('error1');
            $proxy->childs->push($childServ);
            $proxy->errors->push('error2');

            $this->assertContains('error1', $proxy->getTotalErrors());
            $this->assertContains('error2', $proxy->getTotalErrors());
            $this->assertEquals(2, $proxy->getTotalErrors()->count());
        });
    }

    public function testIsResolveError()
    {
        $this->when(function ($proxy, $serv) {

            $this->assertTrue($proxy->isResolveError($proxy->resolveError()));
            $this->assertFalse($proxy->isResolveError(null));
        });
    }

    public function testResolve()
    {
        $this->when(function ($proxy, $serv) {

            $proxy->data->put('key1', '1111');
            $proxy->data->put('key2', '2222');

            $this->assertEquals('11112222', $proxy->resolve(['key1', 'key2', function ($key1, $key2) {

                return $key1 . $key2;
            }]));
        });

        $this->when(function ($proxy, $serv) {

            $proxy->data->put('key1', '1111');

            $this->assertTrue($proxy->isResolveError($proxy->resolve(['key1', 'key2', function ($key1, $key2) {

                return $key1 . $key2;
            }])));
        });

        $this->when(function ($proxy, $serv) {

            $proxy->data->put('key1', '1111');

            $this->assertEquals('1111null', $proxy->resolve(['key1', 'key2', function ($key1, $key2 = 'null') {

                return $key1 . $key2;
            }]));
        });
    }

    public function testResolveError()
    {
        $this->when(function ($proxy, $serv) {

            $this->assertInstanceOf(\Exception::class, $proxy->resolveError());
        });
    }

    public function testResolveBindName()
    {
        $this->when(function () {

            $serv = new class extends Service {

                public static function getArrBindNames()
                {
                    return [
                        'key1' => 'name1',

                        'key2' => [function () {

                            return '{{key1}}';
                        }],

                        'key3' => ['key1', function ($key1) {

                            return 'name3'. $key1;
                        }],

                        'key4' => ['key2', function () {

                            return 'name4';
                        }]
                    ];
                }
            };

            $proxy = $this->proxy($serv);

            $proxy->data->put('key1', 'value1');

            $this->assertEquals('name1', $proxy->resolveBindName('key1'));
            $this->assertEquals('name1', $proxy->resolveBindName('key2'));
            $this->assertEquals('name3value1', $proxy->resolveBindName('key3'));
            $this->assertEquals($proxy->resolveError(), $proxy->resolveBindName('key4'));
        });

        $this->when(function () {

            $serv = new class extends Service {

                public static function getArrBindNames()
                {
                    return [
                        'key1' => 'name1',
                        'key2' => [function () {

                            return '{{key1}}';
                        }],
                        'key3' => ['key1', function ($key1) {

                            return 'name3'. $key1;
                        }]
                    ];
                }
            };

            $proxy = $this->proxy($serv);

            $proxy->data->put('key1', 'value1');

            $this->assertEquals('name1', $proxy->resolveBindName('key2'));
            $this->assertEquals('name3value1', $proxy->resolveBindName('key3'));
        });
    }

    public function testResolveLoader()
    {
        $this->when(function () {

            $serv = new class extends Service {

                public static function getArrLoaders()
                {
                    return [
                        'key2' => [function () {

                            return 'bcd';
                        }],
                        'key3' => ['key1', function ($key1) {

                            return $key1 . 'cde';
                        }],
                        'key4' => ['key2', function ($key2) {

                            return $key2 . 'def';
                        }],
                        'key5' => [function () {

                            return new class extends Service {

                                public static function getArrLoaders()
                                {
                                    return [
                                        'result' => [function () {

                                            return 'efg';
                                        }]
                                    ];
                                }
                            };
                        }]
                    ];
                }
            };

            $proxy = $this->proxy($serv);

            $proxy->data->put('key2', 'abc');

            $this->assertEquals('bcd', $proxy->resolveLoader('key2'));
            $this->assertEquals($proxy->resolveError(), $proxy->resolveLoader('key3'));
            $this->assertEquals('abcdef', $proxy->resolveLoader('key4'));
            $this->assertEquals('efg', $proxy->resolveLoader('key5'));
        });
    }

    public function testRunProcess()
    {
        $this->when(function () {

            $serv = new class extends Service {

                public static function getArrBindNames()
                {
                    return [
                        'key1' => 'name1',
                        'key2' => 'name1',
                        'key3' => 'name1',
                        'key4' => 'name1'
                    ];
                }

                public static function getArrCallbackLists()
                {
                    return [];
                }

                public static function getArrLoaders()
                {
                    return [
                        'key2' => [function () {

                            return 'value2';
                        }]
                    ];
                }

                public static function getArrRuleLists()
                {
                    return [
                        'key3' => ['required']
                    ];
                }
            };

            $proxy = $this->proxy($serv);

            $proxy->inputs->put('key4', 'value4');

            $this->assertFalse($proxy->processed);

            $proxy->runProcess();

            $this->assertFalse($proxy->validatedList->has('key1'));
            $this->assertTrue($proxy->validatedList->has('key2'));
            $this->assertTrue($proxy->validatedList->has('key3'));
            $this->assertTrue($proxy->validatedList->has('key4'));
            $this->assertTrue($proxy->processed);
        });
    }

    public function testValidate()
    {
        $this->when(function () {

            $serv = new class extends Service {

                public static function getArrBindNames()
                {
                    return [
                        'key1' => 'name1'
                    ];
                }

                public static function getArrRuleLists()
                {
                    return [
                        'key1' => ['integer']
                    ];
                }
            };

            $proxy = $this->proxy($serv);

            $proxy->inputs->put('key1', 1234);

            $this->assertTrue($proxy->validate('key1'));
        });
    }

    public function testValidatedResults()
    {
        $this->when(function ($proxy, $serv) {

            $proxy->validatedList->put('key1', false);

            $this->assertNotSame($proxy->validatedList, $proxy->validatedList());
            $this->assertEquals($proxy->validatedList, $proxy->validatedList());
            $this->assertEquals(false, $proxy->validatedList()->get('key'));
        });
    }

    public function testAllTestFileExist()
    {
        $dir   = new \RecursiveDirectoryIterator('app/Services');
        $list  = new \RecursiveIteratorIterator($dir);
        $files = new \RegexIterator($list, '/\.php$/');

        foreach( $files as $file )
        {
            $totalPath = './tests/Unit/' . $file->getPath() . DIRECTORY_SEPARATOR . $file->getBasename('.php') . 'Test.php';

            $this->assertTrue(file_exists($totalPath), $totalPath);
        }
    }
}

class _ParentService extends Service {

    public static function getArrBindNames()
    {
        return [
            'key1' => 'parent name1',
            'key2' => 'parent name2'
        ];
    }

    public static function getArrRuleLists()
    {
        return [
            'key1' => ['parent rule1'],
            'key2' => ['parent rule2']
        ];
    }

    public static function getArrCallbackLists()
    {
        return [
            'key1.0' => ['parent callback1'],
            'key2.0' => ['parent callback2']
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'key1' => ['parent loader1'],
            'key2' => ['parent loader2']
        ];
    }

}

class _ChildService extends Service {

    public static function getArrBindNames()
    {
        return [
            'key2' => 'child name2',
            'key3' => 'child name3'
        ];
    }

    public static function getArrRuleLists()
    {
        return [
            'key2' => ['child rule2'],
            'key3' => ['child rule3']
        ];
    }

    public static function getArrCallbackLists()
    {
        return [
            'key2.0' => ['child callback2'],
            'key3.0' => ['child callback3']
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'key2' => ['child loader2'],
            'key3' => ['child loader3']
        ];
    }

    public static function getArrTraits()
    {
        return [
            _ParentService::class
        ];
    }
}
