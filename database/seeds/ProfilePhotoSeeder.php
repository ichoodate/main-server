<?php

namespace Database\Seeds;

use App\Models\ProfilePhoto;
use App\Models\User;
use Database\DatabaseSeeder;

class ProfilePhotoSeeder extends DatabaseSeeder
{
    public function run()
    {
        ini_set('user_agent', 'Mozilla/4.0 (compatible; MSIE 6.0)');
        $minData = 'data:image/jpeg;base64,'.base64_encode(file_get_contents('https://picsum.photos/100/100'));

        for ($userId = 1; $userId <= User::count(); ++$userId) {
            if (1 == $userId) {
                foreach (range(1, 30) as $i) {
                    var_dump(static::class, $userId, $i);
                    $width = rand(100, 1920);
                    $height = rand(100, 1080);
                    $data = 'data:image/jpeg;base64,'.base64_encode(file_get_contents('https://picsum.photos/'.$width.'/'.$height));
                    ProfilePhoto::factory()->create([
                        'user_id' => $userId,
                        'data' => $data,
                    ]);
                }
            } else {
                var_dump(static::class, $userId);
                ProfilePhoto::factory()->create([
                    'user_id' => $userId,
                    'data' => $minData,
                ]);
            }
        }
    }
}
