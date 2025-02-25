<?php


namespace App\Domain\Web\Item;


use App\Commons\Request\DTORequest;
use Illuminate\Http\UploadedFile;

class DTOMutateItem extends DTORequest
{
    /** @var string $name */
    private $name;

    /** @var string $categoryID */
    private $categoryID;

    /** @var UploadedFile|null $file */
    private $file;

    /** @var string $description */
    private $description;

    /** @var DTOPriceItem|null $price */
    private $price;

    protected function rules()
    {
        return [
            'name' => 'required',
            'category_id' => 'required',
            'price' => 'required|array|min:1',
            'price.plu' => 'required',
            'price.price' => 'required|numeric',
        ];
    }

    public function hydrate()
    {
        $name = $this->dtoForm['name'];
        $categoryID = $this->dtoForm['category_id'];
        $file = $this->dtoForm['file'];
        $description = $this->dtoForm['description'];
        $price = $this->dtoForm['price'];
        $tmpPrice = null;
        if (is_array($price)) {
            $itemID = $price['item_id'] ?? '';
            $priceListUnit = $price['plu'] ?? null;
            $nominal = $price['price'] ? intval(str_replace('.', '', $price['price'])) : 0;
            $unit = $price['unit'] ?? 'retail';
            $description = $price['description'] ?? '';
            $tmpPrice = new DTOPriceItem(
                $itemID,
                $priceListUnit,
                $nominal,
                $unit,
                $description
            );
        }
        $this->setName($name)
            ->setCategoryID($categoryID)
            ->setDescription($description)
            ->setFile($file)
            ->setPrice($tmpPrice);
    }

    public function dehydrate()
    {
        $price['price_list_unit'] = $this->getPrice()->getPriceListUnit();
        $price['price'] = $this->getPrice()->getPrice();
        $price['unit'] = $this->getPrice()->getUnit();
        $price['description'] = $this->getPrice()->getDescription();
        return [
            'name' => $this->getName(),
            'category_id' => $this->getCategoryID(),
            'description' => $this->getDescription(),
            'file' => $this->getFile(),
            'price' => $price
        ];
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
     * @return DTOMutateItem
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
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
     * @return DTOMutateItem
     */
    public function setCategoryID($categoryID)
    {
        $this->categoryID = $categoryID;
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
     * @return DTOMutateItem
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
     * @return DTOMutateItem
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return DTOPriceItem|null
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param DTOPriceItem|null $price
     * @return DTOMutateItem
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }
}
