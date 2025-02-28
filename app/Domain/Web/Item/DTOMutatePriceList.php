<?php


namespace App\Domain\Web\Item;


use App\Commons\Request\DTORequest;

class DTOMutatePriceList extends DTORequest
{
    private $itemID;
    private $priceListUnit;
    private $price;
    private $unit;
    private $description;

    protected function rules()
    {
        return [
            'item_id' => 'required',
            'price' => 'required|numeric',
            'unit' => 'required'
        ];
    }

    public function hydrate()
    {

        $itemID = $this->dtoForm['item_id'];
        $priceListUnit = (!$this->dtoForm['plu'] || $this->dtoForm === '') ? null : $this->dtoForm['plu'];
        $nominal = $this->dtoForm['price'] ? intval(str_replace('.', '',  $this->dtoForm['price'])) : 0;
        $unit = $this->dtoForm['unit'];
        $description = $price['description'] ?? '';

        $this->setItemID($itemID)
            ->setPriceListUnit($priceListUnit)
            ->setDescription($description)
            ->setUnit($unit)
            ->setPrice($nominal);
    }

    public function dehydrate()
    {
        return [
            'item_id' => $this->getItemID(),
            'price_list_unit' => $this->getPriceListUnit(),
            'price' => $this->getPrice(),
            'unit' => $this->getUnit(),
            'description' => $this->getDescription()
        ];
    }

    /**
     * @return mixed
     */
    public function getItemID()
    {
        return $this->itemID;
    }

    /**
     * @param mixed $itemID
     * @return DTOMutatePriceList
     */
    public function setItemID($itemID)
    {
        $this->itemID = $itemID;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPriceListUnit()
    {
        return $this->priceListUnit;
    }

    /**
     * @param mixed $priceListUnit
     * @return DTOMutatePriceList
     */
    public function setPriceListUnit($priceListUnit)
    {
        $this->priceListUnit = $priceListUnit;
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
     * @return DTOMutatePriceList
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
     * @return DTOMutatePriceList
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return DTOMutatePriceList
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }


}
