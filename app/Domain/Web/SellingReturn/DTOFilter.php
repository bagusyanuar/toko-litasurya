<?php


namespace App\Domain\Web\SellingReturn;


use App\Commons\Request\DTORequest;
use Carbon\Carbon;

class DTOFilter extends DTORequest
{
    private $page;
    private $perPage;

    public function hydrateQuery()
    {
        $page = $this->query['page'] ?? 1;
        $perPage = $this->query['per_page'] ?? 10;
        $this
            ->setPage($page)
            ->setPerPage($perPage);
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


}
