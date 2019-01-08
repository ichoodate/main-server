<?php

namespace Database\Seeds;

use App\Database\Models\Profilable;

class ProfilableTableSeeder extends TableSeeder {

    public function run()
    {

        // DB::transaction(function ()
        // {
        //     foreach( range(1, 1000) as $index)
        //     {
        //         Profilable::firstOrCreate([
        //             'user_id'      => 1,
        //             'keyword_id'   => rand(29,59),
        //             'keyword_type' => 'appearance'
        //         ]);
        //         Profilable::firstOrCreate([
        //             'user_id'      => $index,
        //             'keyword_id'   => rand(60,420),
        //             'keyword_type' => 'birth'
        //         ]);
        //         Profilable::firstOrCreate([
        //             'user_id'      => $index,
        //             'keyword_id'   => rand(421,521),
        //             'keyword_type' => 'career'
        //         ]);
        //         Profilable::firstOrCreate([
        //             'user_id'      => $index,
        //             'keyword_id'   => rand(522,571),
        //             'keyword_type' => 'character'
        //         ]);
        //         Profilable::firstOrCreate([
        //             'user_id'      => $index,
        //             'keyword_id'   => rand(572,1572),
        //             'keyword_type' => 'company'
        //         ]);
        //         Profilable::firstOrCreate([
        //             'user_id'      => $index,
        //             'keyword_id'   => rand(1573,1583),
        //             'keyword_type' => 'country'
        //         ]);
        //         Profilable::firstOrCreate([
        //             'user_id'      => $index,
        //             'keyword_id'   => rand(1583,251583),
        //             'keyword_type' => 'name'
        //         ]);
        //         Profilable::firstOrCreate([
        //             'user_id'      => $index,
        //             'keyword_id'   => rand(251584,501583),
        //             'keyword_type' => 'nickname'
        //         ]);
        //         Profilable::firstOrCreate([
        //             'user_id'      => $index,
        //             'keyword_id'   => rand(501584,501784),
        //             'keyword_type' => 'stature'
        //         ]);
        //         Profilable::firstOrCreate([
        //             'user_id'      => $index,
        //             'keyword_id'   => rand(501785,501984),
        //             'keyword_type' => 'hobby'
        //         ]);
        //         Profilable::firstOrCreate([
        //             'user_id'      => $index,
        //             'keyword_id'   => rand(501985,501986),
        //             'keyword_type' => 'smoke'
        //         ]);
        //         Profilable::firstOrCreate([
        //             'user_id'      => $index,
        //             'keyword_id'   => rand(1,10),
        //             'keyword_type' => 'address'
        //         ]);
        //         Profilable::firstOrCreate([
        //             'user_id'      => $index,
        //             'keyword_id'   => rand(11,18),
        //             'keyword_type' => 'body'
        //         ]);
        //         Profilable::firstOrCreate([
        //             'user_id'      => $index,
        //             'keyword_id'   => 19+($index%2),
        //             'keyword_type' => 'gender'
        //         ]);
        //         Profilable::firstOrCreate([
        //             'user_id'      => $index,
        //             'keyword_id'   => rand(21,24),
        //             'keyword_type' => 'religion'
        //         ]);
        //         Profilable::firstOrCreate([
        //             'user_id'      => $index,
        //             'keyword_id'   => rand(25,28),
        //             'keyword_type' => 'drink'
        //         ]);
        //     }
        // });

    }

}
