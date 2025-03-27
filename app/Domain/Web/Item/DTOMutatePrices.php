<?php


namespace App\Domain\Web\Item;


use App\Commons\Request\DTORequest;

class DTOMutatePrices extends DTORequest
{
    private $itemID;
    /** @var array $prices */
    private $prices;

    public function hydrate()
    {
        $itemID = $this->dtoForm['item_id'];
        $arrPrices = $this->dtoForm['prices'] ?? [];
        $prices = [];
        foreach ($arrPrices as $price) {
            $item['id'] = $price['item_price_id'] !== '' ? $price['item_price_id'] : null;
            $item['plu'] = $price['plu'] !== '' ? $price['plu'] : null;
            $item['price'] = $price['price'] !== '' ? intval(str_replace('.', '',  $price['price'])) : 0;
            $item['unit'] = $price['unit'];
            array_push($prices, $item);
        }
        $this->setItemID($itemID)
            ->setPrices($prices);
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
     * @return DTOMutatePrices
     */
    public function setItemID($itemID)
    {
        $this->itemID = $itemID;
        return $this;
    }

    /**
     * @return array
     */
    public function getPrices()
    {
        return $this->prices;
    }

    /**
     * @param array $prices
     * @return DTOMutatePrices
     */
    public function setPrices($prices)
    {
        $this->prices = $prices;
        return $this;
    }
}
