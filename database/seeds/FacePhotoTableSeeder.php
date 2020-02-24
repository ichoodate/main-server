<?php

namespace Database\Seeds;

use App\Database\Models\User;
use App\Database\Models\FacePhoto;
use Illuminate\Database\Seeder;

class FacePhotoTableSeeder extends Seeder {

    public function run()
    {
        for ( $i = 0; $i < User::count(); $i++ )
        {
            $user  = User::skip($i)->first();
            $photo = FacePhoto::where('user_id', $user->getKey())->first();

            if ( empty($photo) )
            {
                $data = 'data:image/jpg;base64,'.base64_encode(file_get_contents('https://picsum.photos/400/400'));

                FacePhoto::create([
                    'user_id' => $user->getKey(),
                    'data'    => $data
                ]);
            }
        }
    }

}
