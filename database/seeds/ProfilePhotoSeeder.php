<?php

namespace Database\Seeds;

use App\Models\ProfilePhoto;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProfilePhotoSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < User::count(); ++$i) {
            var_dump(static::class, $i);
            $user = User::skip($i)->first();
            $width = rand(100, 1920);
            $height = rand(100, 1080);

            $data = 'data:image/jpeg;base64,'.base64_encode(file_get_contents('https://picsum.photos/'.$width.'/'.$height));

            ProfilePhoto::create([
                'user_id' => $user->getKey(),
                'data' => $data,
            ]);
        }
    }
}
