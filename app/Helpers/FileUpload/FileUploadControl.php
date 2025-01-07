<?php


namespace App\Helpers\FileUpload;

use Illuminate\Http\UploadedFile;

class FileUploadControl
{
    public static function upload($targetPath, UploadedFile $file, callable $onError) {
        $imageName = null;
        if ($file) {
            $fileUploadService = new FileUpload();
            $fileUploadRequest = new FileUploadRequest($targetPath, $file);
            $fileUploadResponse = $fileUploadService->upload($fileUploadRequest);
            if (!$fileUploadResponse->isSuccess()) {
                return $onError($fileUploadResponse->message);
            }
            $imageName = $fileUploadResponse->getFileName();
        }
       return $imageName;
    }
}
