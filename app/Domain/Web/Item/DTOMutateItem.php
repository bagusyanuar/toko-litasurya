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

    /** @var DTOPriceItem[] */
    private $pricing;

    protected function rules()
    {
        return [
            'name' => 'required',
            'category_id' => 'required',
        ];
    }

    public function hydrate()
    {
        $name = $this->dtoForm['name'];
        $categoryID = $this->dtoForm['category_id'];
        $file = $this->dtoForm['file'];
        $description = $this->dtoForm['description'];
        $pricing = $this->dtoForm['pricing'];

        /** @var DTOPriceItem[] $arrPricing */
        $arrPricing = [];

        if (is_array($pricing)) {
            foreach ($pricing as $data) {
                $itemID = $data['item_id'];
                $priceListUnit = $data['price_list_unit'];
                $price = $data['price'];
                $unit = $data['unit'];
                $description = $data['description'];
                $price = new DTOPriceItem(
                    $itemID,
                    $priceListUnit,
                    $price,
                    $unit,
                    $description
                );
                array_push($arrPricing, $price);
            }
        }
        $this->setName($name)
            ->setCategoryID($categoryID)
            ->setDescription($description)
            ->setFile($file)
            ->setPricing($arrPricing);
    }

    public function dehydrate()
    {
        return [
            'name' => $this->getName(),
            'category_id' => $this->getCategoryID(),
            'description' => $this->getDescription(),
            'file' => $this->getFile()
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
     * @return DTOPriceItem[]
     */
    public function getPricing()
    {
        return $this->pricing;
    }

    /**
     * @param DTOPriceItem[] $pricing
     * @return DTOMutateItem
     */
    public function setPricing($pricing)
    {
        $this->pricing = $pricing;
        return $this;
    }
}
