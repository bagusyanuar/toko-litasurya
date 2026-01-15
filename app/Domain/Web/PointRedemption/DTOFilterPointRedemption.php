<?php

namespace App\Domain\Web\PointRedemption;

use App\Commons\Request\DTORequest;
use Carbon\Carbon;

class DTOFilterPointRedemption extends DTORequest
{
    private $param;
    private $page;
    private $perPage;
    private $dateStart;
    private $dateEnd;

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
        $dateStart = $this->query['dateStart'] ? Carbon::createFromFormat('d/m/Y', $this->query['dateStart'])->format('Y-m-d') : '';
        $dateEnd = $this->query['dateEnd'] ? Carbon::createFromFormat('d/m/Y', $this->query['dateEnd'])->format('Y-m-d') : '';
        $this->setParam($param)
            ->setPage($page)
            ->setPerPage($perPage)
            ->setDateStart($dateStart)
            ->setDateEnd($dateEnd);
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
     * @return DTOFilterReward
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
     * @return DTOFilterReward
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
     * @return DTOFilterReward
     */
    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
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
     * @return DTOFilterReward
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
     * @return DTOFilterReward
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;
        return $this;
    }
}
