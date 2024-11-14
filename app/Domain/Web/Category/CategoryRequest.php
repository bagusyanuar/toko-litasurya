<?php


namespace App\Domain\Web\Category;

use Illuminate\Http\UploadedFile;

class CategoryRequest
{
    private $name;
    private $file = null;

    /**
     * CategoryRequest constructor.
     * @param $name
     * @param UploadedFile $file
     */
    public function __construct($name, $file = null)
    {
        $this->name = $name;
        $this->file = $file;
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
     * @return UploadedFile|null
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param UploadedFile|null $file
     * @return CategoryRequest
     */
    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }
}
