<?php


namespace App\Commons\Traits\Eloquent;


use App\Commons\Request\DTORequest;
use App\Commons\Response\MetaPagination;
use App\Commons\Response\ServiceResponse;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\AssignOp\Mod;

trait Finder
{
    /** @var Model $finderModel */
    private $finderModel;

    /** @var Builder $finderBuilder */
    private $finderBuilder;

    /** @var MetaPagination $finderPagination */
    private $finderPagination;

    /** @var mixed|null $finderData */
    private $finderData;

    public static function make($class): self
    {
        $self = new self();
        /** @var Model $finderModel */
        $finderModel = app($class);
        $builder = $finderModel::with([]);
        $self->setFinderModel($finderModel)
            ->setFinderBuilder($builder);
        return $self;
    }

    public static function findFrom($class, $config = []): ServiceResponse
    {
        try {
            $relations = [];
            if (array_key_exists('relations', $config)) {
                $relations = $config['relations'];
            }
            $self = new self();
            /** @var Model $model */
            $model = app($class);
            $builder = $model::with($relations);
            $meta = null;
            $templateMessage = $self->getTemplateMessage($config);
            $self->createFilter($config, function ($key, $dispatcher) use ($builder) {
                $builder->when($key, $dispatcher);
            });
            $self->createPagination($config, $builder, function ($pagination) use (&$meta) {
                $meta['pagination'] = $pagination;
            });
            $data = $builder->get();
            return ServiceResponse::statusOK(
                "successfully get {$templateMessage}",
                $data,
                $meta
            );
        } catch (\Exception $e) {
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }

    public static function findOneFrom($class, $id, $config = []): ServiceResponse
    {
        try {
            $self = new self();
            /** @var Model $model */
            $model = app($class);
            $data = $model::find($id);
            $templateMessage = $self->getTemplateMessage($config);
            if (!$data) {
                return ServiceResponse::notFound("{$templateMessage} not found");
            }
            return ServiceResponse::statusOK("successfully get {$templateMessage}", $data);
        } catch (\Exception $e) {
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }


    public static function queryLike($column, $value)
    {
        return function ($query) use ($column, $value) {
            /** @var Builder $query */
            return $query->where($column, 'LIKE', $value);
        };
    }

    public static function queryIs($column, $value)
    {
        return function ($query) use ($column, $value) {
            /** @var Builder $query */
            return $query->where($column, '=', $value);
        };
    }

    public static function filterQueryLikeBy($key, $column, $value)
    {
        return [
            'key' => $key,
            'dispatcher' => self::queryLike($column, $value)
        ];
    }

    public static function filterQueryIs($key, $column, $value)
    {
        return [
            'key' => $key,
            'dispatcher' => self::queryIs($column, $value)
        ];
    }

    public static function useBasicConfig($templateMessage = 'items', $relations = [], $page = 1, $perPage = 10, $filters = [])
    {
        return [
            'template_message' => $templateMessage,
            'pagination' => ['page' => $page, 'per_page' => $perPage],
            'filter' => $filters,
            'relations' => $relations
        ];
    }

    private function getTemplateMessage($config)
    {
        if (array_key_exists('template_message', $config)) {
            return $config['template_message'];
        }
        return "items";
    }

    private function createFilter($config, callable $callback)
    {
        if (array_key_exists('filter', $config)) {
            $filters = $config['filter'];
            if (is_array($filters)) {
                foreach ($filters as $filter) {
                    $key = $filter['key'];
                    $dispatcher = $filter['dispatcher'];
                    $callback($key, $dispatcher);
                }
            }
        }
    }

    private function createPagination($config, Builder $builder, callable $callback)
    {
        if (array_key_exists('pagination', $config)) {
            $pagination = $config['pagination'];
            $page = 1;
            $perPage = 10;

            if (array_key_exists('page', $pagination)) {
                $page = $pagination['page'];
            }

            if (array_key_exists('per_page', $pagination)) {
                $perPage = $pagination['per_page'];
            }

            $totalRows = $builder->count();
            $offset = ($page - 1) * $perPage;
            $builder
                ->offset($offset)
                ->limit($perPage);

            if ($page > 1 && count($builder->get()) <= 0) {
                $page = $page - 1;
                $offset = ($page - 1) * $perPage;
                $builder
                    ->offset($offset)
                    ->limit($perPage);
            }

            $metaPagination = new MetaPagination($page, $perPage, $totalRows);
            $callback($metaPagination->dehydrate());
        }
    }

    public function paginate($page, $perPage)
    {
        $totalRows = $this->finderBuilder->count();
        $offset = ($page - 1) * $perPage;
        $this->finderBuilder
            ->offset($offset)
            ->limit($perPage);
        if ($page > 1 && count($this->finderBuilder->get()) <= 0) {
            $page = $page - 1;
            $offset = ($page - 1) * $perPage;
            $this->finderBuilder
                ->offset($offset)
                ->limit($perPage);
        }
        dd($this->finderBuilder->toSql());
        $this->pagination = new MetaPagination($page, $perPage, $totalRows);
        return $this;
    }

    public function toServiceResponse($templateMessage = 'items'): ServiceResponse
    {
        $data = $this->finderBuilder->get();
        return ServiceResponse::statusOK(
            "successfully get {$templateMessage}",
        );
    }

    /**
     * @param $class
     * @param $id
     * @param array $config
     * @return ServiceResponse
     */
    public static function getOneByID($class, $id, $config = [])
    {
        try {
            $self = new self();
            /** @var Model $model */

            $relation = [];
            if (array_key_exists('relation', $config)) {
                $relation = $config['relation'];
            }
            $model = app($class);
            $data = $model::with($relation)
                ->where('id', '=', $id)
                ->first();

            $templateMessage = $self->getTemplateMessage($config);
            if (!$data) {
                return ServiceResponse::notFound("{$templateMessage} not found");
            }

            if (!$data) {
                return ServiceResponse::notFound("{$templateMessage} not found");
            }

            return ServiceResponse::statusOK("successfully get {$templateMessage}", $data);
        } catch (\Exception $e) {
            return ServiceResponse::notFound($e->getMessage());
        }
    }

    /**
     * @return Model
     */
    public function getFinderModel()
    {
        return $this->finderModel;
    }

    /**
     * @param Model $finderModel
     * @return Finder
     */
    public function setFinderModel($finderModel)
    {
        $this->finderModel = $finderModel;
        return $this;
    }

    /**
     * @return Builder
     */
    public function getFinderBuilder()
    {
        return $this->finderBuilder;
    }

    /**
     * @param Builder $finderBuilder
     * @return Finder
     */
    public function setFinderBuilder($finderBuilder)
    {
        $this->finderBuilder = $finderBuilder;
        return $this;
    }

    /**
     * @return MetaPagination
     */
    public function getFinderPagination()
    {
        return $this->finderPagination;
    }

    /**
     * @param MetaPagination $finderPagination
     * @return Finder
     */
    public function setFinderPagination($finderPagination)
    {
        $this->finderPagination = $finderPagination;
        return $this;
    }

    /**
     * @return mixed|null
     */
    public function getFinderData()
    {
        return $this->finderData;
    }

    /**
     * @param mixed|null $finderData
     * @return Finder
     */
    public function setFinderData($finderData)
    {
        $this->finderData = $finderData;
        return $this;
    }
}
