<?php

namespace Database;

use App\Models\Obj;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public $queue = [];

    public function add($model)
    {
        array_push($this->queue, $model);

        if (100 > count($this->queue)) {
            return;
        }

        $this->flush();
    }

    public function flush()
    {
        $modelLists = collect($this->queue)->groupBy(function ($model) {
            return get_class($model);
        })->all();

        foreach ($modelLists as $modelClass => $modelList) {
            if ($modelList[0]->parents) {
                foreach (array_keys($modelList[0]->parents) as $rel) {
                    $parentList = [];
                    foreach ($modelList as $model) {
                        $sameParent = null;
                        foreach ($parentList as $parent) {
                            if ($parent->getAttributes() == $model->parents[$rel]->getAttributes()) {
                                $sameParent = $parent;
                            }
                        }
                        if (empty($sameParent)) {
                            array_push($parentList, $model->parents[$rel]);
                        } else {
                            $model->parents = array_merge(
                                $model->parents,
                                [$rel => $sameParent]
                            );
                        }
                    }
                    $this->saveMany($parentList);
                }
            }
            foreach ($modelList as $i => $model) {
                if ($model->parents) {
                    foreach ($model->parents as $rel => $parent) {
                        $model->{$rel} = $parent->getKey();
                    }
                }
                $model->offsetUnset('parents');
                $modelList[$i] = $model;
            }
            $this->saveMany($modelList->all());
        }

        $this->queue = [];
    }

    public function getChunk($modelClass, $index)
    {
        return $modelClass::query()
            ->whereIn(
                $modelClass::ID,
                $modelClass::select($modelClass::ID)
                    ->skip($index * 1000)
                    ->limit(1000)
                    ->get()->pluck($modelClass::ID)
            )
            ->get()->all()
        ;
    }

    public function run()
    {
        foreach ([
            \Database\Seeds\UserSeeder::class,
            \Database\Seeds\CardGroupSeeder::class,
            \Database\Seeds\CardSeeder::class,
            \Database\Seeds\CardFlipSeeder::class,
            \Database\Seeds\FriendSeeder::class,
            \Database\Seeds\ChattingContentSeeder::class,
            \Database\Seeds\FacePhotoSeeder::class,
            \Database\Seeds\ProfilePhotoSeeder::class,
            \Database\Seeds\Keyword\AgeRangeSeeder::class,
            \Database\Seeds\Keyword\BirthYearSeeder::class,
            \Database\Seeds\Keyword\BloodSeeder::class,
            \Database\Seeds\Keyword\BodySeeder::class,
            \Database\Seeds\Keyword\CareerSeeder::class,
            \Database\Seeds\Keyword\CountrySeeder::class,
            \Database\Seeds\Keyword\DrinkSeeder::class,
            \Database\Seeds\Keyword\HobbySeeder::class,
            \Database\Seeds\Keyword\LanguageSeeder::class,
            \Database\Seeds\Keyword\NationalitySeeder::class,
            \Database\Seeds\Keyword\ReligionSeeder::class,
            \Database\Seeds\Keyword\SmokeSeeder::class,
            \Database\Seeds\Keyword\StateSeeder::class,
            \Database\Seeds\Keyword\ResidenceSeeder::class, // after state
            \Database\Seeds\Keyword\StatureRangeSeeder::class,
            \Database\Seeds\Keyword\StatureSeeder::class,
            \Database\Seeds\Keyword\WeightRangeSeeder::class,
            \Database\Seeds\Keyword\WeightSeeder::class,
            \Database\Seeds\UserKeywordSeeder::class,
            \Database\Seeds\IdealTypeKeywordSeeder::class,
        ] as $seederClass) {
            $this->call($seederClass);
        }
    }

    public function saveMany(array $modelList)
    {
        $modelList = array_filter($modelList, function ($fff) {
            return !$fff->exists;
        });
        if (empty($modelList)) {
            return [];
        }
        $modelClass = get_class($modelList[0]);
        $modelType = (new $modelClass())->getModelType();
        $objAttrs = array_fill(0, count($modelList), [Obj::TYPE => $modelType]);
        $id = Obj::orderBy(Obj::ID, 'desc')->first()->getKey();
        foreach ($objAttrs as $i => $objAttr) {
            $objAttrs[$i][Obj::ID] = ++$id;
        }

        Obj::insert($objAttrs);

        foreach ($objAttrs as $i => $objAttr) {
            $modelList[$i]->id = $objAttr[Obj::ID];
            $modelList[$i] = $modelList[$i]->toArray();
        }
        $modelClass::insert($modelList);

        return $modelList;
    }
}
