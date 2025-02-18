<?php


namespace App\Services;


use App\Commons\Response\MetaPagination;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CustomService
{
    /** @var Model $model */
    protected $model;

    /** @var Builder $builder */
    protected $builder;

    /** @var MetaPagination $pagination */
    protected $pagination;

    /**
     * @return Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param string $model
     * @return CustomService
     */
    public function setModel($model)
    {
        $this->model = app($model);
        return $this;
    }

    /**
     * @param string $model
     * @param array $relations
     * @return CustomService
     */
    public function queryFrom($model, $relations = [])
    {
        $this->model = app($model);
        $this->builder = $this->model::with($relations);
        return $this;
    }

    public function filters($params = [])
    {
        foreach ($params as $param) {
            $this->builder = $this->builder
                ->when($param['key'], $param['dispatcher']);
        }
        return $this;
    }

    /**
     * @param $page
     * @param $perPage
     * @param bool $forceBack
     * @return Collection
     */
    public function paginate($page, $perPage)
    {
        $totalRows = $this->builder->count();
        $offset = ($page - 1) * $perPage;
        $data = $this->builder
            ->offset($offset)
            ->limit($perPage)
            ->get();
        if ($page > 1 && count($data) <= 0) {
            $page = $page - 1;
            $offset = ($page - 1) * $perPage;
            $data = $this->builder
                ->offset($offset)
                ->limit($perPage)
                ->get();
        }
        $this->pagination = new MetaPagination($page, $perPage, $totalRows);
        return $data;
    }

}
