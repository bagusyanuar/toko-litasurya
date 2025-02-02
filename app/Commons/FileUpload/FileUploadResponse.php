<?php


namespace App\Commons\FileUpload;


class FileUploadResponse
{
    /** @var $path string */
    public $path;

    /** @var $fileName string */
    public $fileName;

    /** @var $success boolean */
    public $success;

    /** @var $message string */
    public $message;

    /**
     * FileUploadResponse constructor.
     * @param string $path
     * @param string $fileName
     * @param bool $success
     * @param string $message
     */
    public function __construct($path = '', $fileName = '', $success = false, $message = '')
    {
        $this->path = $path;
        $this->fileName = $fileName;
        $this->success = $success;
        $this->message = $message;
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
     * @return FileUploadResponse
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @param string $fileName
     * @return FileUploadResponse
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return $this->success;
    }

    /**
     * @param bool $success
     * @return FileUploadResponse
     */
    public function setSuccess($success)
    {
        $this->success = $success;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return FileUploadResponse
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }
}
