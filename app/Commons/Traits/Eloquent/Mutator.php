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
                    if ($fileName) {
                        $data[$column] = $fileName;
                    } else {
                        $data = Arr::except($data, $column);
                    }
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
                $self->mutateUpdate($entity, $data, $config);
            } else {
                $self->mutateCreate($model, $data, $config);
            }
            DB::commit();
            if ($type === 'update') {
                return ServiceResponse::statusOK("successfully update {$templateMessage}");
            }
            return ServiceResponse::created("successfully create {$templateMessage}");
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
                $newDataChild = [];
                foreach ($dataChild as $datumChild) {
                    $newChild = array_merge($datumChild, [$config['child']['foreign'] => $parent->id]);
                    array_push($newDataChild, $newChild);
                }
                $parent->{$target}()->createMany($newDataChild);
            } else {
                $parent->{$target}()->create($dataChild);
            }
        } else {
            $model::create($data);
        }
    }

    private function mutateUpdate(Model $model, $data, $config)
    {
        if (array_key_exists('child', $config)) {
            $target = $config['child']['target'];
            $keyChild = $config['child']['data'];
            $type = $config['child']['type'];
            $dataChild = $data[$keyChild];
            $model->update($data);
            if ($type === 'multiple') {
                $model->{$target}()->delete();
                if (is_array($dataChild)) {
                    foreach ($dataChild as $datumChild) {
                        $model->{$target}()->create($datumChild);
                    }
                }
            } else {
                $model->{$target}()->delete();
                $model->{$target}()->create($dataChild);
            }
        } else {
            $model->update($data);
        }
    }

    public static function removeFrom($class, $config = []): ServiceResponse
    {
        DB::beginTransaction();
        try {
            $id = $config['key'];
            $self = new self();
            $templateMessage = $self->getTemplateMutatorMessage($config);
            /** @var Model $model */
            $model = app($class);
            $entity = $model::find($id);
            if (!$entity) {
                return ServiceResponse::notFound("{$templateMessage} not found");
            }
            if (array_key_exists('children', $config)) {
                $children = $config['children'];
                foreach ($children as $child) {
                    $entity->{$child}()->delete();
                }
            }
            $entity->delete();
            DB::commit();
            return ServiceResponse::statusOK("successfully delete {$templateMessage}");
        } catch (\Exception $e) {
            DB::rollBack();
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
        $fileName = '';
        if (method_exists($dto, $key)) {
            $file = call_user_func([$dto, $key]);
            if ($file && $file instanceof UploadedFile) {
                $fileUploadService = new FileUpload($file, $path);
                $fileUploadResponse = $fileUploadService->upload();
                if (!$fileUploadResponse->isSuccess()) {
                    return ServiceResponse::internalServerError('failed to upload');
                }
                $fileName = $fileUploadResponse->getFileName();
            }
            $callback($column, $fileName);
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
