<?php


namespace App\Domain\Mobile\Purchase;


use App\Commons\Request\DTORequest;

class DTOPurchase extends DTORequest
{
    private $customerId;
    /** @var array $carts */
    private $carts;

    protected function rules()
    {
        return [
            'customer_id' => 'required',
            'carts' => 'required|array|min:1',
            'carts.*.item_id' => 'required',
            'carts.*.qty' => 'required|numeric|gt:0',
            'carts.*.price' => 'required|numeric|gt:0',
            'carts.*.total' => 'required|numeric|gt:0',
            'carts.*.unit' => 'required',
        ];
    }

    public function hydrate()
    {
        $customerId = $this->dtoForm['customer_id'];
        $carts = $this->dtoForm['carts'];
        $arrCarts = [];
        foreach ($carts as $cart) {
            $tmp['item_id'] = $cart['item_id'];
            $tmp['price'] = $cart['price'];
            $tmp['qty'] = $cart['qty'];
            $tmp['unit'] = $cart['unit'];
            $tmp['total'] = $cart['total'];
            array_push($arrCarts, $tmp);
        }
        $this->setCustomerId($customerId)
            ->setCarts($arrCarts);
    }

    /**
     * @return mixed
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * @param mixed $customerId
     * @return DTOPurchase
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;
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
     * @return DTOPurchase
     */
    public function setCarts($carts)
    {
        $this->carts = $carts;
        return $this;
    }

}
