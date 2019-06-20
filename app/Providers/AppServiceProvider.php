<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            'activity'
                => 'App\Database\Models\Activity',

            'balance'
                => 'App\Database\Models\Balance',

            'card'
                => 'App\Database\Models\Card',

            'card_group'
                => 'App\Database\Models\CardGroup',

            'chatting_content'
                => 'App\Database\Models\ChattingContent',

            'coin'
                => 'App\Database\Models\Coin',

            'face_photo'
                => 'App\Database\Models\FacePhoto',

            'invoice'
                => 'App\Database\Models\Invoice',

            'keyword/age_range'
                => 'App\Database\Models\Keyword\AgeRange',

            'keyword/birth_year'
                => 'App\Database\Models\Keyword\BirthYear',

            'keyword/blood'
                => 'App\Database\Models\Keyword\Blood',

            'keyword/body'
                => 'App\Database\Models\Keyword\Body',

            'keyword/career'
                => 'App\Database\Models\Keyword\Career',

            'keyword/country'
                => 'App\Database\Models\Keyword\Country',

            'keyword/drink'
                => 'App\Database\Models\Keyword\Drink',

            'keyword/edu_bg'
                => 'App\Database\Models\Keyword\EduBg',

            'keyword/hobby'
                => 'App\Database\Models\Keyword\Hobby',

            'keyword/language'
                => 'App\Database\Models\Keyword\Language',

            'keyword/nationality'
                => 'App\Database\Models\Keyword\Nationality',

            'keyword/religion'
                => 'App\Database\Models\Keyword\Religion',

            'keyword/smoke'
                => 'App\Database\Models\Keyword\Smoke',

            'keyword/residence'
                => 'App\Database\Models\Keyword\Residence',

            'keyword/state'
                => 'App\Database\Models\Keyword\State',

            'keyword/stature'
                => 'App\Database\Models\Keyword\Stature',

            'keyword/stature_range'
                => 'App\Database\Models\Keyword\StatureRange',

            'keyword/weight'
                => 'App\Database\Models\Keyword\Weight',

            'keyword/weight_range'
                => 'App\Database\Models\Keyword\WeightRange',

            'match'
                => 'App\Database\Models\Match',

            'notice'
                => 'App\Database\Models\Notice',

            'notification'
                => 'App\Database\Models\Notification',

            'obj'
                => 'App\Database\Models\Obj',

            'payment'
                => 'App\Database\Models\Payment',

            'popularity'
                => 'App\Database\Models\Popularity',

            'profile_photo'
                => 'App\Database\Models\ProfilePhoto',

            'pwd_reset'
                => 'App\Database\Models\PwdReset',

            'reply'
                => 'App\Database\Models\Reply',

            'role'
                => 'App\Database\Models\Role',

            'subscription'
                => 'App\Database\Models\Subscription',

            'ticket'
                => 'App\Database\Models\Ticket',

            'user'
                => 'App\Database\Models\User',

            'user_ideal_type_kwd_pvt'
                => 'App\Database\Models\UserIdealTypeKwdPvt',

            'user_self_kwd_pvt'
                => 'App\Database\Models\UserSelfKwdPvt'
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
