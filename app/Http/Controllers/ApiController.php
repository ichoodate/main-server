<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Service;
use Illuminate\Support\Facades\Input;

abstract class ApiController extends Controller {

    public static function input($key)
    {
        return Input::get($key, '');
    }

    public static function servicify($arr)
    {
        $arr   = array_add($arr, 1, []);
        $arr   = array_add($arr, 2, []);
        $class = $arr[0];
        $data  = $arr[1];
        $names = $arr[2];

        foreach ( $data as $key => $value )
        {
            if ( $value === '')
            {
                unset($data[$key]);
            }
        }

        return inst($class, [$data, $names]);
    }

}
