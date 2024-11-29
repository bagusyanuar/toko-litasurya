<?php


namespace App\Domain\Web\Item;


class ItemFilter
{
    private $param = '';
    private $page = 1;
    private $perPage = 10;

    /**
     * ItemFilter constructor.
     * @param string $param
     * @param int $page
     * @param int $perPage
     */
    public function __construct($param, $page, $perPage)
    {
        $this->param = $param;
        $this->page = $page;
        $this->perPage = $perPage;
    }

    /**
     * @return string
     */
    public function getParam()
    {
        return $this->param;
    }

    /**
     * @param string $param
     * @return ItemFilter
     */
    public function setParam($param)
    {
        $this->param = $param;
        return $this;
    }

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param int $page
     * @return ItemFilter
     */
    public function setPage($page)
    {
        $this->page = $page;
        return $this;
    }

    /**
     * @return int
     */
    public function getPerPage()
    {
        return $this->perPage;
    }

    /**
     * @param int $perPage
     * @return ItemFilter
     */
    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
        return $this;
    }
}
