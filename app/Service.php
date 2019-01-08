<?php

namespace App;

use App\Validation\Validator;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Validation\Factory as ValidationFactory;

class Service {

    protected $data;
    protected $errors;
    protected $inputs;
    protected $names;
    protected $processed;
    protected $validatedList;

    public function __construct($parent = null, array $data = [], array $names = [])
    {
        $this->childs        = inst(Collection::class);
        $this->data          = inst(Collection::class);
        $this->errors        = inst(Collection::class);
        $this->inputs        = inst(Collection::class, [$data]);
        $this->names         = inst(Collection::class, [$names]);
        $this->validatedList = inst(Collection::class);
        $this->processed     = false;
    }

    public function childs()
    {
        return $this->childs;
    }

    public function data()
    {
        $data = $this->data->all();

        ksort($data);

        return inst(Collection::class, [$data]);
    }

    public function errors()
    {
        return clone $this->errors;
    }

    public static function getAllBindNames()
    {
        $arr = [];

        foreach ( static::getArrTraits() as $class )
        {
            $arr = array_merge($arr, $class::getAllBindNames()->all());
        }

        $arr = array_merge($arr, static::getArrBindNames());

        return inst(Collection::class, [$arr]);
    }

    public static function getAllCallbackLists()
    {
        $arr = [];

        foreach ( static::getArrTraits() as $class )
        {
            $arr = array_merge_recursive($arr, $class::getAllCallbackLists()->all());
        }

        foreach ( static::getArrCallbackLists() as $key => $resolver )
        {
            $key = explode('.', $key)[0];

            if ( ! array_key_exists($key, $arr) )
            {
                $arr[$key] = [];
            }

            $arr[$key][] = $resolver;
        }

        return inst(Collection::class, [$arr]);
    }

    public static function getAllLoaders()
    {
        $arr = [];

        foreach ( static::getArrTraits() as $class )
        {
            $arr = array_merge($arr, $class::getAllLoaders()->all());
        }

        $arr = array_merge($arr, static::getArrLoaders());

        return inst(Collection::class, [$arr]);
    }

    public static function getAllPromiseLists()
    {
        $arr = [];

        foreach ( static::getArrTraits() as $class )
        {
            $arr = array_merge_recursive($arr, $class::getAllPromiseLists()->all());
        }

        $arr = array_merge_recursive($arr, static::getArrPromiseLists());

        return inst(Collection::class, [$arr]);
    }

    public static function getAllRuleLists()
    {
        $arr = [];

        foreach ( static::getArrTraits() as $class )
        {
            $arr = array_merge_recursive($arr, $class::getAllRuleLists()->all());
        }

        $arr = array_merge_recursive($arr, static::getArrRuleLists());

        return inst(Collection::class, [$arr]);
    }

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
        return [];
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

    protected function getDependencies($key)
    {
        $loader       = $this->getAllLoaders()->get($key, []);
        $ruleList     = $this->getAllRuleLists()->get($key, []);
        $callbackList = $this->getAllCallbackLists()->get($key, []);
        $deps         = array_slice($loader, 0, -1);

        foreach ( $ruleList as $rule )
        {
            $deps = array_merge($deps, $this->getBindKeys($rule));
        }

        foreach ( $callbackList as $callback )
        {
            $deps = array_merge($deps, array_slice($callback, 1, -1));
        }

        return $deps;
    }

    public function inputs()
    {
        return clone $this->inputs;
    }

    protected function isResolveError($value)
    {
        $errorClass = get_class($this->resolveError());

        return is_object($value) && $value instanceof $errorClass;
    }

    protected function newChild($resolved)
    {
        $resolved = array_add($resolved, 1, []);
        $resolved = array_add($resolved, 2, []);

        $class = $resolved[0];
        $data  = $resolved[1];
        $names = $resolved[2];

        foreach ( $names as $key => $name )
        {
            $names[$key] = $this->resolveBindName($name);
        }

        $service = inst($class, [$this, $data, $names]);

        // $this->childs->put($key, $service);

        return $service;
    }

    protected function resolve(array $arr = [])
    {
        $resolver = \Closure::bind(array_last($arr), $this);
        $depNames = array_slice($arr, 0, -1);
        $depVals  = [];
        $params   = (new \ReflectionFunction($resolver))->getParameters();

        foreach ( $depNames as $i => $depName )
        {
            if ( $this->data->has($depName) )
            {
                $depVals[] = $this->data->get($depName);
            }
            else if ( $params[$i]->isDefaultValueAvailable() )
            {
                $depVals[] = $params[$i]->getDefaultValue();
            }
            else
            {
                // this is not throw exception, but only return exception class
                return $this->resolveError();
            }
        }

        return call_user_func_array($resolver, $depVals);
    }

    protected function getBindKeys(string $str)
    {
        $matches = [];

        preg_match_all('/\{\{([a-z0-9\_\.\*]+)\}\}/', $str, $matches);

        return $matches[1];
    }

    protected function resolveBindName(string $name)
    {
        while ( $boundKeys = $this->getBindKeys($name) )
        {
            $key      = $boundKeys[0];
            $pattern  = '/\{\{' . $key . '\}\}/';
            $bindName = $this->getAllBindNames()->merge($this->names)->get($key);

            if ( $bindName == null )
            {
                throw new \Exception('"' . $key . '" name not exists');
            }

            $replace = $this->resolveBindName($bindName);
            $name    = preg_replace($pattern, $replace, $name, 1);
        }

        return $name;
    }

    protected function resolveCallbackList($callbackList)
    {
        foreach ( $callbackList as $callback )
        {
            $this->resolve($callback);
        }
    }

    protected function resolveError()
    {
        return new \Exception('can\'t be resolve');
    }

    protected function resolveLoader($loader)
    {
        $resolved = $this->resolve($loader);

        if ( is_array($resolved) && array_key_exists(0, $resolved) && is_string($resolved[0]) && class_exists($resolved[0]) && get_parent_class($resolved[0]) == Service::class )
        {
            $resolved = $this->newChild($resolved);
        }

        return $resolved;
    }

    protected function resolveRuleList($ruleList)
    {
        foreach ( $ruleList as $i => $rule )
        {
            $available     = true;
            $requiredNames = [];
            $bindKeys      = $this->getBindKeys($rule);

            foreach ( $bindKeys as $bindKey )
            {
                if ( ! $this->validate($bindKey) )
                {
                    $available = false;
                }
                if ( ! $this->names->has($bindKey) )
                {
                    throw new \Exception('"' . $bindKey . '" name not exists');
                }
                if ( ! $this->data()->has($bindKey) )
                {
                    throw new \Exception('"' . $bindKey . '" param data not exists');
                }
            }

            if ( $available )
            {
                $ruleList[$i] = preg_replace('/\{\{([a-z0-9\_\.\*]+)\}\}/', '$1', $rule);
            }
            else
            {
                unset($ruleList[$i]);
            }
        }

        return array_values($ruleList);
    }

    public function runProcess()
    {
        if ( ! $this->processed )
        {
            foreach ( $this->getAllBindNames()->merge($this->names) as $key => $name )
            {
                $this->names[$key] = $this->resolveBindName($name);
            }

            foreach ( $this->inputs()->keys() as $key )
            {
                $this->validate($key);
            }

            foreach ( $this->getAllRuleLists()->keys() as $key )
            {
                $this->validate($key);
            }

            foreach ( $this->getAllLoaders()->keys() as $key )
            {
                $this->validate($key);
            }

            $this->processed = true;
        }
    }

    protected function validate($key)
    {
        if ( $this->validatedList->has($key) )
        {
            return $this->validatedList->get($key);
        }

        // case for array.* rule
        if ( count(explode('.', $key)) > 1 )
        {
            $this->validate(explode('.', $key)[0]);
        }

        $promiseList = $this->getAllPromiseLists()->get($key, []);

        foreach ( $promiseList as $value )
        {
            $this->validate($value);
        }

        $ruleList         = $this->getAllRuleLists()->get($key, []);
        $resolvedRuleList = $this->resolveRuleList($ruleList);

        if ( count($ruleList) != count($resolvedRuleList) )
        {
            $this->validatedList->put($key, false);
        }

        $callbackList = $this->getAllCallbackLists()->get($key, []);

        foreach ( $callbackList as $callback )
        {
            $deps = array_slice($callback, 1, -1);

            foreach ( $deps as $dep )
            {
                if ( ! $this->validate($dep) )
                {
                    $this->validatedList->put($key, false);
                }
            }
        }

        $loader = $this->getAllLoaders()->get($key, []);
        $deps   = array_slice($loader, 0, -1);

        foreach ( $deps as $dep )
        {
            if ( ! $this->validate($dep) )
            {
                return $this->validatedList->put($key, false)->get($key);
            }
        }

        if ( $this->inputs()->has($key) )
        {
            $value = $this->inputs()->get($key);
            $data  = $this->data();

            $data->put($key, $value);
        }
        else if ( ! $this->data()->has($key) && $this->getAllLoaders()->has($key) )
        {
            $loader = $this->getAllLoaders()->get($key);
            $value  = $this->resolveLoader($loader);
            $data   = $this->data(); // should be exist after loader resolved

            if ( $value instanceof Service )
            {
                $service = $value;
                $service->runProcess();

                if ( ! $service->errors()->isEmpty() )
                {
                    $this->errors = $this->errors->merge($service->errors());

                    return $this->validatedList->put($key, false)->get($key);
                }

                if ( ! $service->data()->has('result') )
                {
                    throw new \Exception('result data key is not exists');
                }

                $value = $service->data()->get('result');
            }

            if ( ! $this->isResolveError($value) )
            {
                $data->put($key, $value);
            }
        }
        else
        {
            $data = $this->data();
        }

        $factory = inst(ValidationFactory::class);
        $factory->resolver(function ($tr, array $data, array $rules, array $messages, array $names) {

            return new Validator($tr, $data, $rules, $messages, $names);
        });

        $validator = $factory->make($data->toArray(), [$key => $resolvedRuleList], [], $this->names->toArray());
        $validator->passes();

        $errors = $validator->errors()->all();

        if ( ! empty($errors) )
        {
            $this->errors = $this->errors->merge($errors);

            return $this->validatedList->put($key, false)->get($key);
        }

        if ( ! $this->validatedList->has($key) )
        {
            $this->validatedList->put($key, true);

            if ( $data->has($key) )
            {
                $this->data->put($key, $data->get($key));

                $callbackList = $this->getAllCallbackLists()->get($key, []);

                $this->resolveCallbackList($callbackList);
            }
        }

        return $this->validatedList->get($key);
    }

    public function validatedList()
    {
        $list = $this->validatedList->all();

        ksort($list);

        return inst(Collection::class, [$list]);
    }

}
