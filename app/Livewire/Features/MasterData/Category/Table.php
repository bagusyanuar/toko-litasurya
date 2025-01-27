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
            [
                'total_rows' => $response->getMeta()->getTotalRows(),
                'page' => $response->getMeta()->getPage(),
                'per_page' => $response->getMeta()->getPerPage(),
            ]
        );
    }

    public function render()
    {
        return view('livewire.features.master-data.category.table');
    }
}
