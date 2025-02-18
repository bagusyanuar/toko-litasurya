<?php


namespace App\Domain\Web\Item;


class DTOPriceItem
{
    /** @var string $itemID */
    private $itemID;

    /** @var string $priceListUnit */
    private $priceListUnit;

    /** @var int $price */
    private $price;

    /** @var string $unit */
    private $unit;

    /** @var string $description */
    private $description;

    /**
     * DTOPriceItem constructor.
     * @param string $itemID
     * @param string $priceListUnit
     * @param int $price
     * @param string $unit
     * @param string $description
     */
    public function __construct($itemID, $priceListUnit, $price, $unit, $description)
    {
        $this->itemID = $itemID;
        $this->priceListUnit = $priceListUnit;
        $this->price = $price;
        $this->unit = $unit;
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getItemID()
    {
        return $this->itemID;
    }

    /**
     * @param string $itemID
     * @return DTOPriceItem
     */
    public function setItemID($itemID)
    {
        $this->itemID = $itemID;
        return $this;
    }

    /**
     * @return string
     */
    public function getPriceListUnit()
    {
        return $this->priceListUnit;
    }

    /**
     * @param string $priceListUnit
     * @return DTOPriceItem
     */
    public function setPriceListUnit($priceListUnit)
    {
        $this->priceListUnit = $priceListUnit;
        return $this;
    }

    /**
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param int $price
     * @return DTOPriceItem
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @param string $unit
     * @return DTOPriceItem
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return DTOPriceItem
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
}
