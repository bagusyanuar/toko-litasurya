<?php


namespace App\Domain\Web\Reward;


use App\Commons\Request\DTORequest;

class DTOFilterReward extends DTORequest
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
}
