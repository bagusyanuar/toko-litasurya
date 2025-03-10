<?php


namespace App\Domain\Web\Purchasing;


use App\Commons\Request\DTORequest;
use App\Domain\Web\Cashier\DTOCart;

class DTOOrder extends DTORequest
{
    private $invoiceID;

    /** @var DTOCart[] $carts */
    private $carts;

    public function hydrate()
    {
        $invoiceID = $this->dtoForm['invoice_id'];
        /** @var DTOCart[] $arrCart */
        $arrCart = [];
        if (is_array($this->dtoForm['carts'])) {
            foreach ($this->dtoForm['carts'] as $cart) {
                $dtoCart = new DTOCart();
                $id = $cart['id'];
                $itemID = $cart['item_id'];
                $unit = $cart['unit'];
                $qty = intval($cart['qty']);
                $price = intval($cart['price']);
                $total = $qty * $price;
                $dtoCart->setItemID($itemID)
                    ->setId($id)
                    ->setQty($qty)
                    ->setPrice($price)
                    ->setTotal($total)
                    ->setUnit($unit);
                array_push($arrCart, $dtoCart);
            }
        }
        $this->setInvoiceID($invoiceID)
            ->setCarts($arrCart);
    }

    /**
     * @return mixed
     */
    public function getInvoiceID()
    {
        return $this->invoiceID;
    }

    /**
     * @param mixed $invoiceID
     * @return DTOOrder
     */
    public function setInvoiceID($invoiceID)
    {
        $this->invoiceID = $invoiceID;
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
     * @return DTOOrder
     */
    public function setCarts($carts)
    {
        $this->carts = $carts;
        return $this;
    }
}
