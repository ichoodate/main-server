<?php

namespace App\Database;

class Collection extends \Illuminate\Extend\Collection
{
    public function sortByIds($ids)
    {
        $result = new static();

        foreach ($ids as $id) {
            $item = $this->find($id) ?: null;

            $result->push($item);
        }

        return $result;
    }
}
