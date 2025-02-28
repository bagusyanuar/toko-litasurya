<?php


namespace App\Domain\Web\Reward;


use App\Commons\Request\DTORequest;
use Illuminate\Http\UploadedFile;

class DTOMutateReward extends DTORequest
{
    /** @var string $name */
    private $name;

    /** @var UploadedFile|null $image */
    private $image;

    /** @var int $point */
    private $point;

    protected function rules()
    {
        return [
            'name' => 'required',
            'point' => 'required|numeric'
        ];
    }

    public function hydrate()
    {
        $name = $this->dtoForm['name'];
        $image = $this->dtoForm['image'];
        $point = intval(str_replace('.', '',  $this->dtoForm['point']));

        $this->setName($name)
            ->setImage($image)
            ->setPoint($point);
    }

    public function dehydrate()
    {
        return [
            'name' => $this->getName(),
            'image' => $this->getImage(),
            'point' => $this->getPoint(),
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
     * @return DTOMutateReward
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return UploadedFile|null
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param UploadedFile|null $image
     * @return DTOMutateReward
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return int
     */
    public function getPoint()
    {
        return $this->point;
    }

    /**
     * @param int $point
     * @return DTOMutateReward
     */
    public function setPoint($point)
    {
        $this->point = $point;
        return $this;
    }
}
