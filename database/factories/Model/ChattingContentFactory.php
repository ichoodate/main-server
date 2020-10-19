<?php

namespace Database\Factories\Model;

use App\Database\Models\ChattingContent;
use Database\Factories\ModelFactory;

class ChattingContentFactory extends ModelFactory {

    public static function default()
    {
        return [
            ChattingContent::ID
                => static::faker()->unique()->randomNumber(8),

            ChattingContent::MATCH_ID
                => static::faker()->unique()->randomNumber(8),

            ChattingContent::WRITER_ID
                => static::faker()->unique()->randomNumber(8),

            ChattingContent::MESSAGE
                => static::faker()->word,

            ChattingContent::CREATED_AT
                => static::faker()->dateTimeThisYear->format('Y-m-d H:i:s')
        ];
    }

}
