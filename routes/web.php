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
use App\Database\Models\Card;
use App\Database\Models\Obj;
use App\Database\Models\User;
use App\Http\Controllers\Api\AuthSignInController;
use Database\Factories\Models\UserFactory;
use Illuminate\Support\Facades\DB;

Route::prefix('api')->group(function () {

    Route::middleware([
        'App\Http\Middleware\ParameterCasting',
        'App\Http\Middleware\Api',
        'App\Http\Middleware\CrossOriginAll'
    ])->group(function () {

        Route::resource(
            'activities',
            'Api\ActivityController'
        )->only(['show']);

        Route::resource(
            'auth/sign-in',
            'Api\AuthSignInController'
        )->only(['store']);

        Route::resource(
            'auth/sign-out',
            'Api\AuthSignOutController'
        )->only(['index', 'store']);

        Route::resource(
            'auth/sign-up',
            'Api\AuthSignUpController'
        )->only(['store']);

        Route::resource(
            'auth/user',
            'Api\AuthUserController'
        )->only(['index']);

        Route::resource(
            'balances',
            'Api\BalanceController'
        )->only(['index', 'show']);

        Route::resource(
            'cards',
            'Api\CardController'
        )->only(['index', 'show']);

        Route::resource(
            'cards/{card}/activities',
            'Api\CardActivityController'
        )->only(['store']);

        Route::resource(
            'card-groups',
            'Api\CardGroupController'
        )->only(['index', 'store', 'show']);

        Route::resource(
            'face-photos',
            'Api\FacePhotoController'
        )->only(['index', 'store', 'show']);

        Route::resource(
            'keyword/age-ranges',
            'Api\Keyword\AgeRangeController'
        )->only(['show']);

        Route::resource(
            'keyword/birth-years',
            'Api\Keyword\BirthYearController'
        )->only(['index', 'show']);

        Route::resource(
            'keyword/bloods',
            'Api\Keyword\BloodController'
        )->only(['index', 'show']);

        Route::resource(
            'keyword/bodies',
            'Api\Keyword\BodyController'
        )->only(['index', 'show']);

        Route::resource(
            'keyword/careers',
            'Api\Keyword\CareerController'
        )->only(['index', 'show']);

        Route::resource(
            'keyword/countries',
            'Api\Keyword\CountryController'
        )->only(['index', 'show']);

        Route::resource(
            'keyword/drinks',
            'Api\Keyword\DrinkController'
        )->only(['index', 'show']);

        Route::resource(
            'keyword/education-backgrounds',
            'Api\Keyword\EduBgController'
        )->only(['index', 'show']);

        Route::resource(
            'keyword/hobbies',
            'Api\Keyword\HobbyController'
        )->only(['index', 'show']);

        Route::resource(
            'keyword/languages',
            'Api\Keyword\LanguageController'
        )->only(['index', 'show']);

        Route::resource(
            'keyword/nationalities',
            'Api\Keyword\NationalityController'
        )->only(['show']);

        Route::resource(
            'keyword/min-age-ranges',
            'Api\Keyword\MinAgeRangeController'
        )->only(['index']);

        Route::resource(
            'keyword/min-stature-ranges',
            'Api\Keyword\MinStatureRangeController'
        )->only(['index']);

        Route::resource(
            'keyword/min-weight-ranges',
            'Api\Keyword\MinWeightRangeController'
        )->only(['index']);

        Route::resource(
            'keyword/max-age-ranges',
            'Api\Keyword\MaxAgeRangeController'
        )->only(['index']);

        Route::resource(
            'keyword/max-stature-ranges',
            'Api\Keyword\MaxStatureRangeController'
        )->only(['index']);

        Route::resource(
            'keyword/max-weight-ranges',
            'Api\Keyword\MaxWeightRangeController'
        )->only(['index']);

        Route::resource(
            'keyword/religions',
            'Api\Keyword\ReligionController'
        )->only(['index', 'show']);

        Route::resource(
            'keyword/residences',
            'Api\Keyword\ResidenceController'
        )->only(['show']);

        Route::resource(
            'keyword/smokes',
            'Api\Keyword\SmokeController'
        )->only(['index', 'show']);

        Route::resource(
            'keyword/states',
            'Api\Keyword\StateController'
        )->only(['index', 'show']);

        Route::resource(
            'keyword/stature',
            'Api\Keyword\StatureController'
        )->only(['index', 'show']);

        Route::resource(
            'keyword/stature-range',
            'Api\Keyword\StatureRangeController'
        )->only(['index', 'show']);

        Route::resource(
            'ideal-type-keyword/age-ranges',
            'Api\IdealTypeKeyword\AgeRangeController'
        )->only(['store']);

        Route::resource(
            'ideal-type-keyword/careers',
            'Api\IdealTypeKeyword\CareerController'
        )->only(['store']);

        Route::resource(
            'ideal-type-keyword/drinks',
            'Api\IdealTypeKeyword\DrinkController'
        )->only(['store']);

        Route::resource(
            'ideal-type-keyword/hobbies',
            'Api\IdealTypeKeyword\HobbyController'
        )->only(['store']);

        Route::resource(
            'ideal-type-keyword/nationalities',
            'Api\IdealTypeKeyword\NationalityController'
        )->only(['store']);

        Route::resource(
            'ideal-type-keyword/religions',
            'Api\IdealTypeKeyword\ReligionController'
        )->only(['store']);

        Route::resource(
            'ideal-type-keyword/residences',
            'Api\IdealTypeKeyword\ResidenceController'
        )->only(['store']);

        Route::resource(
            'ideal-type-keyword/smokes',
            'Api\IdealTypeKeyword\SmokeController'
        )->only(['store']);

        Route::resource(
            'ideal-type-keyword/stature-ranges',
            'Api\IdealTypeKeyword\StatureRangeController'
        )->only(['store']);

        Route::resource(
            'ideal-type-keyword/weight-ranges',
            'Api\IdealTypeKeyword\WeightRangeController'
        )->only(['store']);

        Route::resource(
            'ideal-type-keywords',
            'Api\IdealTypeKeywordController'
        )->only(['index']);

        Route::resource(
            'invoices',
            'Api\InvoiceController'
        )->only(['index', 'show']);

        Route::resource(
            'matches/{match}/chatting-contents',
            'Api\MatchChattingContentController'
        )->only(['index', 'store']);

        Route::resource(
            'notices',
            'Api\NoticeController'
        )->only(['index', 'show', 'store']);

        Route::resource(
            'notifications',
            'Api\NotificationController'
        )->only(['index', 'show']);

        Route::resource(
            'payments',
            'Api\PaymentController'
        )->only(['index', 'show']);

        Route::resource(
            'profile-photos',
            'Api\ProfilePhotoController'
        )->only(['index', 'show', 'store']);

        Route::resource(
            'pwd-resets',
            'Api\PwdResetController'
        )->only(['store', 'update']);

        Route::resource(
            'roles',
            'Api\RoleController'
        )->only(['index', 'show']);

        Route::resource(
            'self-keyword/careers',
            'Api\SelfKeyword\CareerController'
        )->only(['store']);

        Route::resource(
            'self-keyword/drinks',
            'Api\SelfKeyword\DrinkController'
        )->only(['store']);

        Route::resource(
            'self-keyword/hobbies',
            'Api\SelfKeyword\HobbyController'
        )->only(['store']);

        Route::resource(
            'self-keyword/nationalities',
            'Api\SelfKeyword\NationalityController'
        )->only(['store']);

        Route::resource(
            'self-keyword/religions',
            'Api\SelfKeyword\ReligionController'
        )->only(['store']);

        Route::resource(
            'self-keyword/residences',
            'Api\SelfKeyword\ResidenceController'
        )->only(['store']);

        Route::resource(
            'self-keyword/smokes',
            'Api\SelfKeyword\SmokeController'
        )->only(['store']);

        Route::resource(
            'self-keyword/statures',
            'Api\SelfKeyword\StatureController'
        )->only(['store']);

        Route::resource(
            'self-keyword/weights',
            'Api\SelfKeyword\WeightController'
        )->only(['store']);

        Route::resource(
            'self-keywords',
            'Api\SelfKeywordController'
        )->only(['index']);

        Route::resource(
            'subscriptions',
            'Api\SubscriptionController'
        )->only(['index', 'show']);

        Route::resource(
            'tickets',
            'Api\TicketController'
        )->only(['index', 'show']);

        Route::resource(
            'tickets/{ticket}/replies',
            'Api\TicketReplyController'
        )->only(['index', 'store']);

        Route::resource(
            'users/{user}/self-keywords',
            'Api\UserSelfKeywordController'
        )->only(['index']);

        Route::resource(
            'users/{user}/profile-photos',
            'Api\UserProfilePhotoController'
        )->only(['index']);
    });
});

Route::get('/query', function () {

    $obj = Obj::take(1)->get();
    $obj->load('concrete');
});
