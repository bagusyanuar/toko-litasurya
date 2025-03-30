<?php


namespace App\Domain\Web\Schedule;


use App\Commons\Request\DTORequest;

class DTOMutate extends DTORequest
{
    private $salesTeamID;
    private $routeID;
    private $day;

    public function hydrate()
    {
        $salesTeamID = $this->dtoForm['salesTeamID'];
        $routeID = $this->dtoForm['routeID'];
        $day = $this->dtoForm['day'];

        $this->setDay($day)
            ->setRouteID($routeID)
            ->setSalesTeamID($salesTeamID);
    }

    /**
     * @return mixed
     */
    public function getRouteID()
    {
        return $this->routeID;
    }

    /**
     * @param mixed $routeID
     * @return DTOMutate
     */
    public function setRouteID($routeID)
    {
        $this->routeID = $routeID;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSalesTeamID()
    {
        return $this->salesTeamID;
    }

    /**
     * @param mixed $salesTeamID
     * @return DTOMutate
     */
    public function setSalesTeamID($salesTeamID)
    {
        $this->salesTeamID = $salesTeamID;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * @param mixed $day
     * @return DTOMutate
     */
    public function setDay($day)
    {
        $this->day = $day;
        return $this;
    }

}
