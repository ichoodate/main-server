<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\Http\Controller;

abstract class ApiController extends Controller {

    public function get($key)
    {
        return Input::get($key, new \stdClass);
    }

}
