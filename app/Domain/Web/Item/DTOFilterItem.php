<?php


namespace App\Domain\Web\Item;


use App\Commons\Request\DTORequest;

class DTOFilterItem extends DTORequest
{
    private $param;
    private $page;
    private $perPage;

    /**
     * DTOFilterItem constructor.
     * @param $param
     * @param $page
     * @param $perPage
     */
    public function __construct($param = '', $page = 1, $perPage = 10)
    {
        $this->param = $param;
        $this->page = $page;
        $this->perPage = $perPage;
    }


    public function hydrateQuery()
    {
        $param = $this->query['param'] ?? '';
        $page = $this->query['page'] ?? 1;
        $perPage = $this->query['per_page'] ?? 10;
        $this->setParam($param)
            ->setPage($page)
            ->setPerPage($perPage);
    }

    /**
     * @return mixed
     */
    public function getParam()
    {
        return $this->param;
    }

    /**
     * @param mixed $param
     * @return DTOFilterItem
     */
    public function setParam($param)
    {
        $this->param = $param;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param mixed $page
     * @return DTOFilterItem
     */
    public function setPage($page)
    {
        $this->page = $page;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPerPage()
    {
        return $this->perPage;
    }

    /**
     * @param mixed $perPage
     * @return DTOFilterItem
     */
    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
        return $this;
    }
}
