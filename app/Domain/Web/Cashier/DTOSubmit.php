<?php


namespace App\Domain\Web\Cashier;


use App\Commons\Request\DTORequest;

class DTOSubmit extends DTORequest
{
    private $customerID;

    /** @var DTOCart[] $carts */
    private $carts;

    public function hydrate()
    {

        $customerID = $this->dtoForm['customer_id'] !== '' ? $this->dtoForm['customer_id'] : null;
        /** @var DTOCart[] $arrCart */
        $arrCart = [];
        if (is_array($this->dtoForm['carts'])) {
            foreach ($this->dtoForm['carts'] as $cart) {
                $dtoCart = new DTOCart();
                $itemID = $cart['itemID'];
                $unit = $cart['unit'];
                $qty = intval($cart['qty']);
                $price = intval($cart['price']);
                $total = $qty * $price;
                $dtoCart->setItemID($itemID)
                    ->setQty($qty)
                    ->setPrice($price)
                    ->setTotal($total)
                    ->setUnit($unit);
                array_push($arrCart, $dtoCart);
            }
        }
        $this->setCustomerID($customerID)
            ->setCarts($arrCart);
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
     * @return DTOSubmit
     */
    public function setCustomerID($customerID)
    {
        $this->customerID = $customerID;
        return $this;
    }

    /**
     * @return DTOCart[]
     */
    public function getCarts()
    {
        return $this->carts;
    }

    /**
     * @param DTOCart[] $carts
     * @return DTOSubmit
     */
    public function setCarts($carts)
    {
        $this->carts = $carts;
        return $this;
    }
}
