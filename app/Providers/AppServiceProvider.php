<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind('lastQuery', function () {
            $logs = app('db')->getQueryLog();
            $log = array_get($logs, 0, ['query' => '', 'bindings' => []]);
            $sql = str_replace('?', '%s', $log['query']);

            foreach ($log['bindings'] as $key => $binding) {
                is_string($binding) ?
                        $log['bindings'][$key] = '"'.$binding.'"' : null;
            }

            return vsprintf($sql, $log['bindings']);
        });
    }
}
