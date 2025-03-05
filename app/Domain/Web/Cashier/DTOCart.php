<?php


namespace App\Domain\Web\Cashier;


use App\Commons\Request\DTORequest;

class DTOCart extends DTORequest
{
    private $itemID;
    private $qty;
    private $price;
    private $unit;
    private $total;

    /**
     * @return mixed
     */
    public function getItemID()
    {
        return $this->itemID;
    }

    /**
     * @param mixed $itemID
     * @return DTOCart
     */
    public function setItemID($itemID)
    {
        $this->itemID = $itemID;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getQty()
    {
        return $this->qty;
    }

    /**
     * @param mixed $qty
     * @return DTOCart
     */
    public function setQty($qty)
    {
        $this->qty = $qty;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     * @return DTOCart
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @param mixed $unit
     * @return DTOCart
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param mixed $total
     * @return DTOCart
     */
    public function setTotal($total)
    {
        $this->total = $total;
        return $this;
    }
}
