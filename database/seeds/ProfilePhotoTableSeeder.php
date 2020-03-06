<?php

namespace Database\Seeds;

use App\Database\Models\User;
use App\Database\Models\ProfilePhoto;
use Illuminate\Database\Seeder;

class ProfilePhotoTableSeeder extends Seeder {

    public function run()
    {
        for ( $k = 0; $k < 100; $k++ )
        {
            for ( $i = 0; $i < 1; $i++ )
            {
                $user  = User::skip($i)->first();
                $width = rand(100, 1920);
                $height = rand(100, 1080);

                $data = 'data:image/jpg;base64,'.base64_encode(file_get_contents('https://picsum.photos/'.$width.'/'.$height));

                ProfilePhoto::create([
                    'user_id' => $user->getKey(),
                    'data'    => $data
                ]);
            }
        }
    }

}
