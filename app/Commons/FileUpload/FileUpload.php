<?php


namespace App\Commons\FileUpload;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Ramsey\Uuid\Uuid;

class FileUpload
{
    /** @var $file UploadedFile */
    private $file;

    /** @var $path string */
    private $path;

    /**
     * FileUpload constructor.
     * @param UploadedFile $file
     * @param string $path
     */
    public function __construct(UploadedFile $file, $path)
    {
        $this->file = $file;
        $this->path = $path;
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
     * @return FileUpload
     */
    public function setFile($file)
    {
        $this->file = $file;
        return $this;
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
     * @return FileUpload
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    public function upload(): FileUploadResponse
    {
        $response = new FileUploadResponse();
        try {
            $fileName = '';
            $uploadedPath = '';
            $path = $this->getPath();
            $file = $this->getFile();
            $storage_path = public_path($path);
            if (!File::exists($storage_path)) {
                File::makeDirectory($storage_path, 0755, true);
            }

            if ($file instanceof UploadedFile) {
                $extension = $file->getClientOriginalExtension();
                $image = Uuid::uuid4()->toString() . '.' . $extension;
                $fileName = '/' . $path . '/' . $image;
                $targetPath = $storage_path . '/' . $image;
                $tempPath = $file->getRealPath();
                $uploadedPath = $targetPath;
                File::move($tempPath, $targetPath);
            }

            $response->setSuccess(true)
                ->setMessage('successfully upload file')
                ->setPath($uploadedPath)
                ->setFileName($fileName);
        }catch (\Exception $e) {
            $response->setSuccess(false)
                ->setMessage($e->getMessage());
        }
        return $response;
    }
}
