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

}
