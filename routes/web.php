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

use App\Http\Middlewares\CastRequestInputMiddleware;
use App\Http\Middlewares\ResponseHeaderSettingMiddleware;
use App\Http\Middlewares\SetAuthUserMiddleware;
use FunctionalCoding\ORM\Eloquent\Http\ServiceParameterMiddleware;
use FunctionalCoding\ORM\Eloquent\Http\ServiceRunMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

$prefix = str_replace('/', DIRECTORY_SEPARATOR, $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR);
$prefix = str_replace($prefix, '', __FILE__);
$prefix = str_replace('routes'.DIRECTORY_SEPARATOR.'web.php', '', $prefix);
$prefix = rtrim($prefix, DIRECTORY_SEPARATOR);
$prefix = str_replace(DIRECTORY_SEPARATOR, '/', $prefix);
$prefix = $_SERVER['DOCUMENT_ROOT'] && Str::startsWith(__FILE__, str_replace('/', DIRECTORY_SEPARATOR, $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR)) ? $prefix : '';

Route::middleware([
    ServiceRunMiddleware::class,
    SetAuthUserMiddleware::class,
    ServiceParameterMiddleware::class,
    CastRequestInputMiddleware::class,
    ResponseHeaderSettingMiddleware::class,
])->prefix($prefix)->group(function () {
    Route::post('auth/sign-in', 'AuthSignInController@store');
    Route::get('auth/sign-out', 'AuthSignOutController@index');
    Route::post('auth/sign-up', 'AuthSignUpController@store');
    Route::get('auth/user', 'AuthUserController@index');
    Route::put('auth/user', 'AuthUserController@update');
    Route::get('balances', 'BalanceController@index');
    Route::get('balances/{id}', 'BalanceController@show');
    Route::get('cards', 'CardController@index');
    Route::get('cards/{id}', 'CardController@show');
    Route::get('card-flips', 'CardFlipController@index');
    Route::post('card-flips', 'CardFlipController@store');
    Route::get('card-flips/{id}', 'CardFlipController@show');
    Route::get('card-groups', 'CardGroupController@index');
    Route::post('card-groups', 'CardGroupController@store');
    Route::get('card-groups/{id}', 'CardGroupController@show');
    Route::get('chatting-contents', 'ChattingContentController@index');
    Route::post('chatting-contents', 'ChattingContentController@store');
    Route::get('chatting-contents/{id}', 'ChattingContentController@show');
    Route::post('face-photos', 'FacePhotoController@store');
    Route::get('face-photos/{id}', 'FacePhotoController@show');
    Route::get('friends', 'FriendController@index');
    Route::post('friends', 'FriendController@store');
    Route::get('friends/{id}', 'FriendController@show');
    Route::delete('friends/{id}', 'FriendController@destroy');

    Route::prefix('keyword')->namespace('Keyword')->group(function () {
        Route::get('age-ranges/{id}', 'AgeRangeController@show');
        Route::get('birth-years', 'BirthYearController@index');
        Route::get('birth-years/{id}', 'BirthYearController@show');
        Route::get('bloods', 'BloodController@index');
        Route::get('bloods/{id}', 'BloodController@show');
        Route::get('bodies', 'BodyController@index');
        Route::get('bodies/{id}', 'BodyController@show');
        Route::get('careers', 'CareerController@index');
        Route::get('careers/{id}', 'CareerController@show');
        Route::get('countries', 'CountryController@index');
        Route::get('countries/{id}', 'CountryController@show');
        Route::get('drinks', 'DrinkController@index');
        Route::get('drinks/{id}', 'DrinkController@show');
        Route::get('education-backgrounds', 'EduBgController@index');
        Route::get('education-backgrounds/{id}', 'EduBgController@show');
        Route::get('hobbies', 'HobbyController@index');
        Route::get('hobbies/{id}', 'HobbyController@show');
        Route::get('languages', 'LanguageController@index');
        Route::get('languages/{id}', 'LanguageController@show');
        Route::get('min-age-ranges', 'MinAgeRangeController@index');
        Route::get('min-stature-ranges', 'MinStatureRangeController@index');
        Route::get('min-weight-ranges', 'MinWeightRangeController@index');
        Route::get('max-age-ranges', 'MaxAgeRangeController@index');
        Route::get('max-stature-ranges', 'MaxStatureRangeController@index');
        Route::get('max-weight-ranges', 'MaxWeightRangeController@index');
        Route::get('nationalities', 'NationalityController@index');
        Route::get('nationalities/{id}', 'NationalityController@show');
        Route::get('religions', 'ReligionController@index');
        Route::get('religions/{id}', 'ReligionController@show');
        Route::get('residences', 'ResidenceController@index');
        Route::get('residences/{id}', 'ResidenceController@show');
        Route::get('smokes', 'SmokeController@index');
        Route::get('smokes/{id}', 'SmokeController@show');
        Route::get('states', 'StateController@index');
        Route::get('states/{id}', 'StateController@show');
        Route::get('statures', 'StatureController@index');
        Route::get('statures/{id}', 'StatureController@show');
        Route::get('stature-ranges/{id}', 'StatureRangeController@show');
        Route::get('weights', 'WeightController@index');
        Route::get('weights/{id}', 'WeightController@show');
        Route::get('weight-ranges/{id}', 'WeightRangeController@show');
    });

    Route::prefix('ideal-type-keyword')->namespace('IdealTypeKeyword')->group(function () {
        Route::post('age-ranges', 'AgeRangeController@store');
        Route::post('careers', 'CareerController@store');
        Route::post('drinks', 'DrinkController@store');
        Route::post('hobbies', 'HobbyController@store');
        Route::post('nationalities', 'NationalityController@store');
        Route::post('religions', 'ReligionController@store');
        Route::post('residences', 'ResidenceController@store');
        Route::post('smokes', 'SmokeController@store');
        Route::post('stature-ranges', 'StatureRangeController@store');
        Route::post('weight-ranges', 'WeightRangeController@store');
    });

    Route::get('ideal-type-keywords', 'IdealTypeKeywordController@index');
    Route::get('invoices', 'InvoiceController@index');
    Route::get('invoices/{id}', 'InvoiceController@show');
    Route::get('localizables', 'LocalizableController@index');
    Route::get('localizables/{id}', 'LocalizableController@show');
    Route::get('notices', 'NoticeController@index');
    Route::post('notices', 'NoticeController@store');
    Route::get('notices/{id}', 'NoticeController@show');
    Route::get('notifications', 'NotificationController@index');
    Route::get('notifications/{id}', 'NotificationController@show');
    Route::get('payments', 'PaymentController@index');
    Route::get('payments/{id}', 'PaymentController@show');
    Route::get('popularities', 'PopularityController@index');
    Route::post('popularities', 'PopularityController@store');
    Route::get('popularities/{id}', 'PopularityController@show');
    Route::get('profile-photos', 'ProfilePhotoController@index');
    Route::post('profile-photos', 'ProfilePhotoController@store');
    Route::get('profile-photos/{id}', 'ProfilePhotoController@show');
    Route::post('pwd-resets', 'PwdResetController@store');
    Route::put('pwd-resets/{id}', 'PwdResetController@update');
    Route::get('roles', 'RoleController@index');
    Route::get('roles/{id}', 'RoleController@show');
    Route::get('subscriptions', 'SubscriptionController@index');
    Route::get('subscriptions/{id}', 'SubscriptionController@show');
    Route::get('tickets', 'TicketController@index');
    Route::post('tickets', 'TicketController@store');
    Route::get('tickets/{id}', 'TicketController@show');
    Route::get('replies', 'ReplyController@index');
    Route::post('replies', 'ReplyController@store');
    Route::get('replies/{id}', 'ReplyController@show');
    Route::get('matching-users', 'MatchingUserController@index');
    Route::get('matching-users/{id}', 'MatchingUserController@show');

    Route::prefix('user-keyword')->namespace('UserKeyword')->group(function () {
        Route::post('careers', 'CareerController@store');
        Route::post('drinks', 'DrinkController@store');
        Route::post('hobbies', 'HobbyController@store');
        Route::post('nationalities', 'NationalityController@store');
        Route::post('religions', 'ReligionController@store');
        Route::post('residences', 'ResidenceController@store');
        Route::post('smokes', 'SmokeController@store');
        Route::post('statures', 'StatureController@store');
        Route::post('weights', 'WeightController@store');
    });

    Route::get('user-keywords', 'UserKeywordController@index');
    Route::get('users/{id}', 'UserController@show');

    // for client preflight request
    Route::options('{a}/{b?}/{c?}/{d?}/{e?}/{f?}', function () {});
});

Route::get('/', function () {
    return view('welcome');
});
