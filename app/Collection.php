<?php

namespace App;

class Collection extends \FunctionalCoding\Illuminate\Collection
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
