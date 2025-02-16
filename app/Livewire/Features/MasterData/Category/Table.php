<?php

namespace App\Livewire\Features\MasterData\Category;

use App\Domain\Web\Category\DTOCategoryFilter;
use App\Helpers\Alpine\AlpineResponse;
use App\Services\Web\CategoryService;
use Illuminate\Database\Eloquent\Model;
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
        return AlpineResponse::toJSON($response);
    }

    public function findByID($id)
    {
        $response = $this->service->findByID($id);
        return AlpineResponse::toJSON($response);
    }

    public function delete($id)
    {
        $response = $this->service->delete($id);
        return AlpineResponse::toJSON($response);
    }

    public function render()
    {
        return view('livewire.features.master-data.category.table');
    }
}
