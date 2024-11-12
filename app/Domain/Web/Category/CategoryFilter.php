<?php


namespace App\Domain\Web\Category;


class CategoryFilter
{

    private $param = '';
    private $page = 1;
    private $perPage = 10;

    /**
     * CategoryFilter constructor.
     * @param string $param
     * @param int $page
     * @param int $perPage
     */
    public function __construct($param = '', $page = 1, $perPage = 10)
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
     * @return CategoryFilter
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
     * @return CategoryFilter
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
     * @return CategoryFilter
     */
    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
        return $this;
    }
}
