<?php


namespace App\Domain\Web\Category;


use App\Commons\Request\DTORequest;
use Illuminate\Http\UploadedFile;

class DTOCategoryRequest extends DTORequest
{
    /** @var string $name */
    private $name;
    /** @var UploadedFile|null $file */
    private $file;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return DTOCategoryRequest
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
     * @return DTOCategoryRequest
     */
    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }
}
