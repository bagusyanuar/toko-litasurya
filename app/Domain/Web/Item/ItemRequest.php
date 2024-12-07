<?php


namespace App\Domain\Web\Item;


use Illuminate\Http\UploadedFile;

class ItemRequest
{
    /** @var string $categoryID */
    private $categoryID;

    /** @var string $name */
    private $name;

    /** @var UploadedFile|null $file */
    private $file = null;

    /** @var string $description */
    private $description;

    /** @var ItemPriceRequest[] $prices */
    private $prices;

    /**
     * ItemRequest constructor.
     * @param string $categoryID
     * @param string $name
     * @param UploadedFile|null $file
     * @param string $description
     * @param array $prices
     */
    public function __construct($categoryID = '', $name = '', UploadedFile $file = null, $description = '', $prices = [])
    {
        $this->categoryID = $categoryID;
        $this->name = $name;
        $this->file = $file;
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getCategoryID()
    {
        return $this->categoryID;
    }

    /**
     * @param string $categoryID
     * @return ItemRequest
     */
    public function setCategoryID($categoryID)
    {
        $this->categoryID = $categoryID;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return ItemRequest
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return UploadedFile|null
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param UploadedFile|null $file
     * @return ItemRequest
     */
    public function setFile($file)
    {
        $this->file = $file;
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
     * @return ItemRequest
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return ItemPriceRequest[]
     */
    public function getPrices()
    {
        return $this->prices;
    }

    /**
     * @param ItemPriceRequest[] $prices
     * @return ItemRequest
     */
    public function setPrices($prices)
    {
        $this->prices = $prices;
        return $this;
    }
}
