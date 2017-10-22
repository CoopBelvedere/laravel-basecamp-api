<?php

namespace Belvedere\Basecamp;

use Illuminate\Support\Collection;

class IndexCollection extends Collection
{
    /**
     * The next page link of the resource collection.
     *
     * @var string
     */
    protected $nextPage;

    /**
     * The total number of resources.
     *
     * @var int
     */
    protected $total;

    /**
     * Set the pagination.
     *
     * @param  string  $link
     * @param  int     $total
     * @return void
     */
    public function setPagination($link, $total)
    {
        $this->nextPage = $link;
        $this->total = $total;
    }

    /**
     * Get the next page.
     *
     * @return string
     */
    public function nextPage()
    {
        return $this->nextPage;
    }

    /**
     * Get the total.
     *
     * @return int
     */
    public function total()
    {
        return $this->total;
    }
}
