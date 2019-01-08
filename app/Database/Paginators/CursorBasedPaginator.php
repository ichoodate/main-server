<?php

namespace App\Database\Paginators;

use App\Http\Requests\IndexApiRequest;

class CursorBasedPaginator {

    protected $items;

    protected $direction;

    public function __construct($items, $direction, $options)
    {
        $this->items     = $items;
        $this->direction = $direction;
        $this->options   = $options;
    }

    public function links($url)
    {
        $links = [];

        foreach ( [
            IndexApiRequest::DIRECTION_PREV,
            IndexApiRequest::DIRECTION_NEXT
        ] as $name )
        {
            $params = [];

            if (
                ( $name == IndexApiRequest::DIRECTION_PREV &&
                    $this->direction == IndexApiRequest::DIRECTION_PREV ) ||
                ( $name == IndexApiRequest::DIRECTION_NEXT &&
                    $this->direction == IndexApiRequest::DIRECTION_NEXT )
            )
            {
                $params[IndexApiRequest::POINT_ID]
                    = $this->items->last()->getKey();
            }

            if (
                ( $name == IndexApiRequest::DIRECTION_PREV &&
                    $this->direction == IndexApiRequest::DIRECTION_NEXT ) ||
                ( $name == IndexApiRequest::DIRECTION_NEXT &&
                    $this->direction == IndexApiRequest::DIRECTION_PREV )
            )
            {
                $params[IndexApiRequest::POINT_ID]
                    = $this->items->first()->getKey();
            }

            $params[IndexApiRequest::DIRECTION] = $this->direction;
            $params[IndexApiRequest::WHERES] = $this->wheres;
            $params[IndexApiRequest::ORDERS] = $this->orders;
            $params[IndexApiRequest::GROUPS] = $this->groups;

            $links[$name] = $url . '?' . http_build_query($params);
        }

        return $links;
    }

}
