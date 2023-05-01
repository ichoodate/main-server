<?php

namespace Database\Seeds;

use App\Models\FacePhoto;
use App\Models\User;
use Database\DatabaseSeeder;

class FacePhotoSeeder extends DatabaseSeeder
{
    public function run()
    {
        ini_set('user_agent', 'Mozilla/4.0 (compatible; MSIE 6.0)');
        $data = 'data:image/jpeg;base64,'.base64_encode(file_get_contents('https://picsum.photos/400/400'));

        for ($userId = 1; $userId <= User::count(); ++$userId) {
            $photo = FacePhoto::select(FacePhoto::ID)->where('user_id', $userId)->first();

            if (empty($photo)) {
                FacePhoto::factory()->create([
                    'user_id' => $userId,
                    'data' => $data,
                ]);
            }
        }
    }
}
