<?php

namespace App\Domain\Web\PointRedemption;

use App\Commons\Request\DTORequest;

class DTOMutatePointRedemption extends DTORequest
{
    private $rewardId;
    private $customerId;

    protected function rules()
    {
        return [
            'rewardId' => 'required',
            'customerId' => 'required'
        ];
    }

    public function hydrate()
    {
        $rewardId = $this->dtoForm['rewardId'];
        $customerId = $this->dtoForm['customerId'];

        $this->setRewardId($rewardId)
            ->setCustomerId($customerId);
    }

    /**
     * @return string
     */
    public function getRewardId()
    {
        return $this->rewardId;
    }

    /**
     * @param string $rewardId
     * @return DTOMutatePointRedemption
     */
    public function setRewardId($rewardId)
    {
        $this->rewardId = $rewardId;
        return $this;
    }

    /**
     * @return string
     */
    public function getcustomerId()
    {
        return $this->customerId;
    }

    /**
     * @param string $customerId
     * @return DTOMutatePointRedemption
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;
        return $this;
    }
}
