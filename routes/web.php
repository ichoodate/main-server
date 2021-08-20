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

use App\Http\Middlewares\RequestInputValueCastingMiddleware;
use App\Http\Middlewares\ServiceParameterSettingMiddleware;
use App\Http\Middlewares\ServiceRunMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

$prefix = str_replace('/', DIRECTORY_SEPARATOR, $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR);
$prefix = str_replace($prefix, '', __FILE__);
$prefix = str_replace('routes'.DIRECTORY_SEPARATOR.'web.php', '', $prefix);
$prefix = rtrim($prefix, DIRECTORY_SEPARATOR);
$prefix = str_replace(DIRECTORY_SEPARATOR, '/', $prefix);
$prefix = $_SERVER['DOCUMENT_ROOT'] && Str::startsWith(__FILE__, str_replace('/', DIRECTORY_SEPARATOR, $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR)) ? $prefix : '';

Route::prefix($prefix)->group(function () {
    Route::middleware([
        ServiceRunMiddleware::class,
        ServiceParameterSettingMiddleware::class,
        RequestInputValueCastingMiddleware::class,
    ])->group(function () {
        Route::resource(
            'auth/sign-in',
            'AuthSignInController'
        )->only(['store']);

        Route::resource(
            'auth/sign-out',
            'AuthSignOutController'
        )->only(['index', 'store']);

        Route::resource(
            'auth/sign-up',
            'AuthSignUpController'
        )->only(['store']);

        Route::get(
            'auth/user',
            'AuthUserController@index'
        );

        Route::patch(
            'auth/user',
            'AuthUserController@update'
        );

        Route::resource(
            'balances',
            'BalanceController'
        )->only(['index', 'show']);

        Route::resource(
            'cards',
            'CardController'
        )->only(['index', 'show']);

        Route::resource(
            'card-flips',
            'CardFlipController'
        )->only(['show', 'store']);

        Route::resource(
            'card-groups',
            'CardGroupController'
        )->only(['index', 'store', 'show']);

        Route::resource(
            'chatting-contents',
            'ChattingContentController'
        )->only(['index', 'store']);

        Route::resource(
            'face-photos',
            'FacePhotoController'
        )->only(['store', 'show']);

        Route::resource(
            'friends',
            'FriendController'
        )->only(['store']);

        Route::resource(
            'keyword/age-ranges',
            'Keyword\AgeRangeController'
        )->only(['show']);

        Route::resource(
            'keyword/birth-years',
            'Keyword\BirthYearController'
        )->only(['index', 'show']);

        Route::resource(
            'keyword/bloods',
            'Keyword\BloodController'
        )->only(['index', 'show']);

        Route::resource(
            'keyword/bodies',
            'Keyword\BodyController'
        )->only(['index', 'show']);

        Route::resource(
            'keyword/careers',
            'Keyword\CareerController'
        )->only(['index', 'show']);

        Route::resource(
            'keyword/countries',
            'Keyword\CountryController'
        )->only(['index', 'show']);

        Route::resource(
            'keyword/drinks',
            'Keyword\DrinkController'
        )->only(['index', 'show']);

        Route::resource(
            'keyword/education-backgrounds',
            'Keyword\EduBgController'
        )->only(['index', 'show']);

        Route::resource(
            'keyword/hobbies',
            'Keyword\HobbyController'
        )->only(['index', 'show']);

        Route::resource(
            'keyword/languages',
            'Keyword\LanguageController'
        )->only(['index', 'show']);

        Route::resource(
            'keyword/min-age-ranges',
            'Keyword\MinAgeRangeController'
        )->only(['index']);

        Route::resource(
            'keyword/min-stature-ranges',
            'Keyword\MinStatureRangeController'
        )->only(['index']);

        Route::resource(
            'keyword/min-weight-ranges',
            'Keyword\MinWeightRangeController'
        )->only(['index']);

        Route::resource(
            'keyword/max-age-ranges',
            'Keyword\MaxAgeRangeController'
        )->only(['index']);

        Route::resource(
            'keyword/max-stature-ranges',
            'Keyword\MaxStatureRangeController'
        )->only(['index']);

        Route::resource(
            'keyword/max-weight-ranges',
            'Keyword\MaxWeightRangeController'
        )->only(['index']);

        Route::resource(
            'keyword/nationalities',
            'Keyword\NationalityController'
        )->only(['show']);

        Route::resource(
            'keyword/religions',
            'Keyword\ReligionController'
        )->only(['index', 'show']);

        Route::resource(
            'keyword/residences',
            'Keyword\ResidenceController'
        )->only(['show']);

        Route::resource(
            'keyword/smokes',
            'Keyword\SmokeController'
        )->only(['index', 'show']);

        Route::resource(
            'keyword/states',
            'Keyword\StateController'
        )->only(['index', 'show']);

        Route::resource(
            'keyword/statures',
            'Keyword\StatureController'
        )->only(['index', 'show']);

        Route::resource(
            'keyword/stature-ranges',
            'Keyword\StatureRangeController'
        )->only(['show']);

        Route::resource(
            'keyword/weights',
            'Keyword\WeightController'
        )->only(['index', 'show']);

        Route::resource(
            'keyword/weight-ranges',
            'Keyword\WeightRangeController'
        )->only(['show']);

        Route::resource(
            'ideal-type-keyword/age-ranges',
            'IdealTypeKeyword\AgeRangeController'
        )->only(['store']);

        Route::resource(
            'ideal-type-keyword/careers',
            'IdealTypeKeyword\CareerController'
        )->only(['store']);

        Route::resource(
            'ideal-type-keyword/drinks',
            'IdealTypeKeyword\DrinkController'
        )->only(['store']);

        Route::resource(
            'ideal-type-keyword/hobbies',
            'IdealTypeKeyword\HobbyController'
        )->only(['store']);

        Route::resource(
            'ideal-type-keyword/nationalities',
            'IdealTypeKeyword\NationalityController'
        )->only(['store']);

        Route::resource(
            'ideal-type-keyword/religions',
            'IdealTypeKeyword\ReligionController'
        )->only(['store']);

        Route::resource(
            'ideal-type-keyword/residences',
            'IdealTypeKeyword\ResidenceController'
        )->only(['store']);

        Route::resource(
            'ideal-type-keyword/smokes',
            'IdealTypeKeyword\SmokeController'
        )->only(['store']);

        Route::resource(
            'ideal-type-keyword/stature-ranges',
            'IdealTypeKeyword\StatureRangeController'
        )->only(['store']);

        Route::resource(
            'ideal-type-keyword/weight-ranges',
            'IdealTypeKeyword\WeightRangeController'
        )->only(['store']);

        Route::resource(
            'ideal-type-keywords',
            'IdealTypeKeywordController'
        )->only(['index']);

        Route::resource(
            'invoices',
            'InvoiceController'
        )->only(['index', 'show']);

        Route::resource(
            'notices',
            'NoticeController'
        )->only(['index', 'show', 'store']);

        Route::resource(
            'notifications',
            'NotificationController'
        )->only(['index', 'show']);

        Route::resource(
            'payments',
            'PaymentController'
        )->only(['index', 'show']);

        Route::resource(
            'popularities',
            'PopularityController'
        )->only(['index', 'show', 'store']);

        Route::resource(
            'profile-photos',
            'ProfilePhotoController'
        )->only(['index', 'show', 'store']);

        Route::resource(
            'pwd-resets',
            'PwdResetController'
        )->only(['store', 'update']);

        Route::resource(
            'roles',
            'RoleController'
        )->only(['index', 'show']);

        Route::resource(
            'self-keyword/careers',
            'SelfKeyword\CareerController'
        )->only(['store']);

        Route::resource(
            'self-keyword/drinks',
            'SelfKeyword\DrinkController'
        )->only(['store']);

        Route::resource(
            'self-keyword/hobbies',
            'SelfKeyword\HobbyController'
        )->only(['store']);

        Route::resource(
            'self-keyword/nationalities',
            'SelfKeyword\NationalityController'
        )->only(['store']);

        Route::resource(
            'self-keyword/religions',
            'SelfKeyword\ReligionController'
        )->only(['store']);

        Route::resource(
            'self-keyword/residences',
            'SelfKeyword\ResidenceController'
        )->only(['store']);

        Route::resource(
            'self-keyword/smokes',
            'SelfKeyword\SmokeController'
        )->only(['store']);

        Route::resource(
            'self-keyword/statures',
            'SelfKeyword\StatureController'
        )->only(['store']);

        Route::resource(
            'self-keyword/weights',
            'SelfKeyword\WeightController'
        )->only(['store']);

        Route::resource(
            'self-keywords',
            'SelfKeywordController'
        )->only(['index']);

        Route::resource(
            'subscriptions',
            'SubscriptionController'
        )->only(['index', 'show']);

        Route::resource(
            'tickets',
            'TicketController'
        )->only(['index', 'show']);

        Route::resource(
            'tickets/{ticket}/replies',
            'TicketReplyController'
        )->only(['index', 'store']);

        Route::resource(
            'matching-users',
            'MatchingUserController'
        )->only(['index', 'show']);

        Route::resource(
            'users/{user}/self-keywords',
            'UserSelfKeywordController'
        )->only(['index']);

        Route::resource(
            'users/{user}/profile-photos',
            'UserProfilePhotoController'
        )->only(['index']);
    });
});

Route::get('/', function () {
    return view('welcome');
});
