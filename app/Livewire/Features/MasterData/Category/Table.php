<?php

namespace App\Livewire\Features\MasterData\Category;

use App\Domain\Web\Category\DTOCategoryFilter;
use App\Helpers\Alpine\AlpineResponse;
use App\Services\Web\CategoryService;
use Livewire\Component;

class Table extends Component
{
    /** @var CategoryService $service */
    protected $service;


    public function boot(CategoryService $categoryService)
    {
        $this->service = $categoryService;
    }

    public function findAll($param, $page, $perPage)
    {
        $filter = new DTOCategoryFilter($param, $page, $perPage);
        $response = $this->service->findAll($filter);
        if (!$response->isSuccess()) {
            return AlpineResponse::toResponse(
                false,
                500,
                $response->getMessage()
                );
        }
        return AlpineResponse::toResponse(
            true,
            200,
            'success',
            $response->getData(),
            $response->getMeta()
        );
    }

    public function delete($id)
    {
        $response = $this->service->delete($id);
        if (!$response->isSuccess()) {
            return AlpineResponse::toResponse(
                false,
                500,
                $response->getMessage()
            );
        }
        return AlpineResponse::toResponse(
            true,
            200,
            'success',
            $response->getData(),
            $response->getMeta()
        );
    }

    public function render()
    {
        return view('livewire.features.master-data.category.table');
    }
}
