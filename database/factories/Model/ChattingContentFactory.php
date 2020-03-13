<?php

namespace Database\Factories\Model;

use App\Database\Models\ChattingContent;
use Database\Factories\ModelFactory;
use Faker\Generator as Faker;

class ChattingContentFactory extends ModelFactory {

    public static function default()
    {
        return [
            ChattingContent::ID
                => inst(Faker::class)->unique()->randomNumber(8),

            ChattingContent::MATCH_ID
                => inst(Faker::class)->unique()->randomNumber(8),

            ChattingContent::WRITER_ID
                => inst(Faker::class)->unique()->randomNumber(8),

            ChattingContent::MESSAGE
                => inst(Faker::class)->word,

            ChattingContent::CREATED_AT
                => inst(Faker::class)->dateTimeThisYear->format('Y-m-d H:i:s')
        ];
    }

}
