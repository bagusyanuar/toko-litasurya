<?php


namespace App\Domain\Web\Category;


class CategoryRequest
{
    private $name;
    private $image = null;

    /**
     * CategoryRequest constructor.
     * @param $name
     * @param null $image
     */
    public function __construct($name, $image)
    {
        $this->name = $name;
        $this->image = $image;
    }


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return CategoryRequest
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return null
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param null $image
     * @return CategoryRequest
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }


}
