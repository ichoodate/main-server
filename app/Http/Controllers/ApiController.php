<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use Illuminate\Support\Facades\Input;

abstract class ApiController extends Controller
{
    public static function input($key)
    {
        return Input::get($key, '');
    }
}
