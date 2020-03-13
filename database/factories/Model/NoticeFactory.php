<?php

namespace Database\Factories\Model;

use App\Database\Models\Notice;
use Database\Factories\ModelFactory;
use Faker\Generator as Faker;

class NoticeFactory extends ModelFactory {

    public static function default()
    {
        return [
            Notice::ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Notice::TYPE
                => inst(Faker::class)->randomElement(Notice::TYPE_VALUES),

            Notice::SUBJECT
                => inst(Faker::class)->text,

            Notice::DESCRIPTION
                => inst(Faker::class)->text,

            Notice::CREATED_AT
                => inst(Faker::class)->dateTimeThisYear->format('Y-m-d H:i:s')
        ];
    }

}
