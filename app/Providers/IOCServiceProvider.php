<?php

namespace App\Providers;

use App\Database\Models\Card;
use Faker\Generator as Faker;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;

class IOCServiceProvider extends ServiceProvider
{
    /**
     * Register the model observer service provider.
     *
     * @return void
     */
    public function register()
    {
        $isTesting =
            $this->app->environment('unit-testing') ||
            $this->app->environment('integrate-testing');

        $this->app->bind('nowUtcTime', function () {

            $nowDate = new \DateTime('now', new \DateTimeZone('UTC'));

            return $nowDate->format('Y-m-d H:i:s');
        });

        if ( $isTesting )
        {
            $this->app->singleton('faker', function () {

                return inst(Faker::class);
            });

            $this->app->bind('collection', function ($app, $args) {

                if ( ! array_key_exists(1, $args) )
                {
                    $args[1] = 0;
                }

                if ( ! array_key_exists(2, $args) )
                {
                    $args[2] = [];
                }

                $modelClass = $args[0];
                $count      = $args[1];
                $attrLists  = $args[2];
                $collection = inst($modelClass::collectionClass());

                for ( $i = 0; $i < $count; $i++ )
                {
                    $model = $this->factory($modelClass)->make($attrLists);

                    $collection->push($model);
                }

                return $collection;
            });

            $this->app->bind('dump', function ($app, $args) {

                array_map(function ($x) {
                    (new \Illuminate\Support\Debug\Dumper)->dump($x);
                }, $args);
            });

            $this->app->bind('lastQuery', function () {

                $logs = app('db')->getQueryLog();
                $log  = array_get($logs, 0, ['query' => '', 'bindings' => []]);
                $sql  = str_replace('?', '%s', $log['query']);

                foreach ( $log['bindings'] as $key => $binding )
                {
                    is_string($binding) ?
                        $log['bindings'][$key] = '"' . $binding . '"' : null;
                }

                return vsprintf($sql, $log['bindings']);
            });
        }
    }

}
