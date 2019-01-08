<?php

namespace App\Database\Paginators;

use App\Http\Requests\IndexApiRequest;

class LengthBasedPaginator  {

    protected $total;

    protected $lastPage;

    public function __construct($items, $total, $perPage, $currentPage)
    {
        $this->items       = $items;
        $this->total       = $total;
        $this->perPage     = $perPage;
        $this->currentPage = $currentPage;
        $this->lastPage    = (int) ceil($total / $perPage);
    }

    public function links()
    {
        $links = [];
        $pages = [];

        if ( $this->currentPage > 1 )
        {
            $pages[IndexApiRequest::DIRECTION_PREV] = $this->currentPage - 1;
        }

        if ( $this->currentPage < $this->lastPage )
        {
            $pages[IndexApiRequest::DIRECTION_NEXT] = $this->currentPage + 1;
        }

        foreach ( $pages as $name => $pageNumber )
        {
            $params[IndexApiRequest::PAGE]     = $pageNumber;
            $params[IndexApiRequest::PER_PAGE] = $this->perPage;
            $params[IndexApiRequest::WHERES]   = $this->wheres;
            $params[IndexApiRequest::ORDERS]   = $this->orders;
            $params[IndexApiRequest::GROUPS]   = $this->groups;

            $links[$name] = $this->items->link($params);
        }

        return $links;
    }

}
