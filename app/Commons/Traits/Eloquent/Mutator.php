<?php


namespace App\Commons\Traits\Eloquent;


use App\Commons\FileUpload\FileUpload;
use App\Commons\Request\DTORequest;
use App\Commons\Response\ServiceResponse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

trait Mutator
{
    /** @var Model $mutatorModel */
    private $mutatorModel;

    public static function mutateTo($class, DTORequest $dto, $config = []): ServiceResponse
    {
        try {
            $type = 'create';
            if (array_key_exists('type', $config)) {
                $type = $config['type'];
            }
            $self = new self();
            $validationResult = $self->validate($dto);
            if ($validationResult instanceof ServiceResponse) {
                return $validationResult;
            }
            /** @var Model $model */
            $model = app($class);
            $data = $dto->dehydrate();
            if (array_key_exists('upload', $config)) {
                $uploadResult = $self->upload($dto, $config, function ($column, $fileName) use (&$data) {
                    $data[$column] = $fileName;
                });
                if ($uploadResult instanceof ServiceResponse) {
                    return $uploadResult;
                }
            }
            $model::create($data);
            return ServiceResponse::created("successfully create");
        } catch (\Exception $e) {
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }

    /**
     * @param DTORequest $dto
     * @return ServiceResponse|null
     */
    private function validate(DTORequest $dto)
    {
        $validator = $dto->validate();
        if ($validator->fails()) {
            return ServiceResponse::unprocessableEntity($validator->errors()->toArray());
        }
        $dto->hydrate();
        return null;
    }

    private function upload(DTORequest $dto, $config, callable $callback)
    {
        $key = $config['upload']['key'];
        $path = $config['upload']['path'];
        $column = $config['upload']['column'];
        if (method_exists($dto, $key)) {
            $file = call_user_func([$dto, $key]);
            if ($file && $file instanceof UploadedFile) {
                $fileUploadService = new FileUpload($file, $path);
                $fileUploadResponse = $fileUploadService->upload();
                if (!$fileUploadResponse->isSuccess()) {
                    return ServiceResponse::internalServerError('failed to upload');
                }
                $fileName = $fileUploadResponse->getFileName();
                $callback($column, $fileName);
            }
        }
        return null;
    }
}
