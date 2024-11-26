<?php


namespace App\Helpers\FileUpload;


use Illuminate\Http\UploadedFile;

class FileUploadRequest
{
    /** @var $path string */
    private $path;
    /** @var $file UploadedFile */
    private $file;

    /**
     * FileUploadRequest constructor.
     * @param string $path
     * @param UploadedFile $file
     */
    public function __construct($path, UploadedFile $file)
    {
        $this->path = $path;
        $this->file = $file;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     * @return FileUploadRequest
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param UploadedFile $file
     * @return FileUploadRequest
     */
    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }
}
