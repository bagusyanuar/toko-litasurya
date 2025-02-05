<?php


namespace App\Domain\Web\Category;


use App\Commons\Request\DTORequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rules\Password;

class DTOCategoryRequest extends DTORequest
{
    /** @var string $name */
    private $name;
    /** @var UploadedFile|null $file */
    private $file;

    protected function rules()
    {
        return [
            'name' => 'required',
        ];
    }

    public function hydrate()
    {
        $name = $this->dtoForm['name'];
        $file = $this->dtoForm['file'];
        $this->setName($name)
            ->setFile($file);
    }

    public function dehydrate()
    {
        return [
            'name' => $this->getName(),
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
