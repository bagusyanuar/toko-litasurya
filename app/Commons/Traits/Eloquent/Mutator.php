<?php


namespace App\Commons\Traits\Eloquent;


use App\Commons\FileUpload\FileUpload;
use App\Commons\Request\DTORequest;
use App\Commons\Response\ServiceResponse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

trait Mutator
{
    /** @var Model $mutatorModel */
    private $mutatorModel;

    public static function mutateTo($class, DTORequest $dto, $config = []): ServiceResponse
    {
        DB::beginTransaction();
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
            $templateMessage = $self->getTemplateMutatorMessage($config);
            if ($type === 'update') {
                $id = $config['key'];
                $entity = $model::find($id);
                if (!$entity) {
                    return ServiceResponse::notFound("{$templateMessage} not found");
                }
                $entity->update($data);
            } else {
                $self->mutateCreate($model, $data, $config);
            }
            DB::commit();
            return ServiceResponse::created("successfully update {$templateMessage}");
        } catch (\Exception $e) {
            DB::rollBack();
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }

    private function mutateCreate(Model $model, $data, $config)
    {
        if (array_key_exists('child', $config)) {
            $target = $config['child']['target'];
            $keyChild = $config['child']['data'];
            $type = $config['child']['type'];
            $dataChild = $data[$keyChild];
            $parent = $model::create($data);
            if ($type === 'multiple') {
                $parent->{$target}()->createMany($dataChild);
            } else {
                $parent->{$target}()->create($dataChild);
            }
        } else {
            $model::create($data);
        }

    }

    public static function removeFrom($class, $config = []): ServiceResponse
    {
        try {
            $id = $config['key'];
            $self = new self();
            $templateMessage = $self->getTemplateMutatorMessage($config);
            /** @var Model $model */
            $model = app($class);
            $model::destroy($id);
            return ServiceResponse::statusOK("successfully delete {$templateMessage}");
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

    private function getTemplateMutatorMessage($config)
    {
        if (array_key_exists('template_message', $config)) {
            return $config['template_message'];
        }
        return "";
    }


}
