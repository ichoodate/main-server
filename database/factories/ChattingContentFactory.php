<?php

namespace Database\Factories;

use App\Models\ChattingContent;
use App\Models\Matching;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class ChattingContentFactory extends Factory
{
    protected $model = ChattingContent::class;

    public function createAll($data = [], ?Model $parent = null)
    {
        $attrs = Arr::only($data, array_keys((new static())->definition()));
        $model = parent::create($attrs, $parent);
        $data = Arr::add($data, ChattingContent::MATCH, []);
        $match = $data[ChattingContent::MATCH];
        $user = User::find($model->{ChattingContent::WRITER_ID});

        if ($user) {
            $genderId = User::GENDER_MAN == $user->{User::GENDER} ? Matching::MAN_ID : Matching::WOMAN_ID;
        } else {
            $genderId = rand(0, 1) ? Matching::MAN_ID : Matching::WOMAN_ID;
        }

        $match[$genderId] = $model->{ChattingContent::WRITER_ID};

        if (empty(Matching::find($model->{ChattingContent::MATCH_ID}))) {
            $match[Matching::ID] = $model->{ChattingContent::MATCH_ID};
        }

        Matching::factory()->createAll($match);

        return $model;
    }

    public function definition()
    {
        return [
            ChattingContent::MATCH_ID => $this->faker->unique()->randomNumber(8),

            ChattingContent::WRITER_ID => $this->faker->unique()->randomNumber(8),

            ChattingContent::MESSAGE => $this->faker->word,

            ChattingContent::CREATED_AT => $this->faker->dateTimeThisYear->format('Y-m-d H:i:s'),
        ];
    }
}
