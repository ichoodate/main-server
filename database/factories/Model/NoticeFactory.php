<?php

namespace Database\Factories\Model;

use App\Models\Notice;
use Database\Factories\ModelFactory;

class NoticeFactory extends ModelFactory
{
    public static function default()
    {
        return [
            Notice::ID => static::faker()->unique()->randomNumber(8),

            Notice::TYPE => static::faker()->randomElement(Notice::TYPE_VALUES),

            Notice::SUBJECT => static::faker()->text,

            Notice::DESCRIPTION => static::faker()->text,

            Notice::CREATED_AT => static::faker()->dateTimeThisYear->format('Y-m-d H:i:s'),
        ];
    }
}
