<?php


namespace App\Domain\Web\Purchasing;


use App\Commons\Request\DTORequest;
use Carbon\Carbon;

class DTOFilter extends DTORequest
{
    private $param;
    private $page;
    private $perPage;
    private $store;
    private $sales;
    private $dateStart;
    private $dateEnd;

    public function hydrateQuery()
    {
        $param = $this->query['param'] ?? '';
        $page = $this->query['page'] ?? 1;
        $perPage = $this->query['per_page'] ?? 10;
        $store = $this->query['store'] ?? '';
        $sales = $this->query['sales'] ?? '';
        $dateStart = $this->query['dateStart'] ? Carbon::createFromFormat('d/m/Y', $this->query['dateStart'])->format('Y-m-d') : '';
        $dateEnd = $this->query['dateEnd'] ? Carbon::createFromFormat('d/m/Y', $this->query['dateEnd'])->format('Y-m-d') : '';


        $this->setParam($param)
            ->setPage($page)
            ->setPerPage($perPage)
            ->setStore($store)
            ->setSales($sales)
            ->setDateStart($dateStart)
            ->setDateEnd($dateEnd);
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
     * @return DTOFilter
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
     * @return DTOFilter
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
     * @return DTOFilter
     */
    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStore()
    {
        return $this->store;
    }

    /**
     * @param mixed $store
     * @return DTOFilter
     */
    public function setStore($store)
    {
        $this->store = $store;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSales()
    {
        return $this->sales;
    }

    /**
     * @param mixed $sales
     * @return DTOFilter
     */
    public function setSales($sales)
    {
        $this->sales = $sales;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * @param mixed $dateStart
     * @return DTOFilter
     */
    public function setDateStart($dateStart)
    {
        $this->dateStart = $dateStart;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * @param mixed $dateEnd
     * @return DTOFilter
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;
        return $this;
    }

}
