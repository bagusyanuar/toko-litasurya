<?php


namespace App\Commons\Traits\Eloquent;


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
     * @param string $templateMessage
     * @return ServiceResponse
     */
    public static function getOneByID($class, $id, $templateMessage = 'item')
    {
        try {
            /** @var Model $model */
            $model = app($class);
            $data = $model::find($id);
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
