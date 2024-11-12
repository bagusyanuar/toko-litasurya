<?php


namespace App\Helpers\Pagination;


class PaginationResponse
{
    private $totalPage;
    private $pageRange;

    /**
     * PaginationResponse constructor.
     * @param $totalPage
     * @param $pageRange
     */
    public function __construct($totalPage, $pageRange)
    {
        $this->totalPage = $totalPage;
        $this->pageRange = $pageRange;
    }

    /**
     * @return mixed
     */
    public function getTotalPage()
    {
        return $this->totalPage;
    }

    /**
     * @param mixed $totalPage
     * @return PaginationResponse
     */
    public function setTotalPage($totalPage)
    {
        $this->totalPage = $totalPage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPageRange()
    {
        return $this->pageRange;
    }

    /**
     * @param mixed $pageRange
     * @return PaginationResponse
     */
    public function setPageRange($pageRange)
    {
        $this->pageRange = $pageRange;
        return $this;
    }
}
