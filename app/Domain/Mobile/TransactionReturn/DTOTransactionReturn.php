<?php


namespace App\Domain\Mobile\TransactionReturn;


use App\Commons\Request\DTORequest;

class DTOTransactionReturn extends DTORequest
{
    private $customerID;
    /** @var array $carts */
    private $carts;

    protected function rules()
    {
        return [
            'customer_id' => 'required',
            'carts' => 'required|array|min:1',
            'carts.*.item_id' => 'required',
            'carts.*.qty' => 'required|numeric',
            'carts.*.price' => 'required|numeric',
            'carts.*.total' => 'required|numeric',
            'carts.*.unit' => 'required',
        ];
    }

    public function hydrate()
    {
        $customerID = $this->dtoForm['customer_id'];
        $carts = $this->dtoForm['carts'];
        $this->setCustomerID($customerID)
            ->setCarts($carts);
    }

    /**
     * @return mixed
     */
    public function getCustomerID()
    {
        return $this->customerID;
    }

    /**
     * @param mixed $customerID
     * @return DTOTransactionReturn
     */
    public function setCustomerID($customerID)
    {
        $this->customerID = $customerID;
        return $this;
    }

    /**
     * @return array
     */
    public function getCarts()
    {
        return $this->carts;
    }

    /**
     * @param array $carts
     * @return DTOTransactionReturn
     */
    public function setCarts($carts)
    {
        $this->carts = $carts;
        return $this;
    }
}
