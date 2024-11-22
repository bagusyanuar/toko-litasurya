<?php


namespace App\Helpers\FileUpload;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Ramsey\Uuid\Uuid;

class FileUpload
{
    public function upload(FileUploadRequest $fileUploadRequest): FileUploadResponse
    {
        $response = new FileUploadResponse('','', false, 'unknown error');
        try {
            $fileName = '';
            $uploadedPath = '';
            $path = $fileUploadRequest->getPath();
            $file = $fileUploadRequest->getFile();
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
            $response->setMessage($e->getMessage());
        }
        return $response;
    }
}
