<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// class A {

//     public $prop1;

//     public function __construct($arg1)
//     {
//         $this->prop1 = $arg1;
//     }
// }

// Route::get('/', function () {

//     dd(
//         new A('val1'),
//         app(A::class, ['arg1' => 'val1']),
//         inst(A::class, ['val1'])
//     );

//     return view('welcome');
// });
Route::middleware(['App\Http\Middleware\Api'])->group(function () {

    Route::resource('card/activities', 'Api\CardActivityApiController')->only(['index']);
});
