<?php

namespace Database\Factories\Model;

use App\Database\Models\ChattingContent;
use Faker\Generator as Faker;

class ChattingContentFactory extends ModelFactory {

    public static function default()
    {
        return [
            ChattingContent::ID
                => inst(Faker::class)->unique()->randomNumber(),

            ChattingContent::MATCH_ID
                => inst(Faker::class)->unique()->randomNumber(),

            ChattingContent::WRITER_ID
                => inst(Faker::class)->unique()->randomNumber(),

            ChattingContent::MESSAGE
                => inst(Faker::class)->text,

            ChattingContent::CREATED_AT
                => inst(Faker::class)->dateTimeThisYear->format('Y-m-d H:i:s')
        ];
    }

}
