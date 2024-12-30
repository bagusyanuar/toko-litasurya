<?php

namespace App\Livewire\Features\Category;

use App\Helpers\Alpine\AlpineResponse;
use Livewire\Component;
use Livewire\Attributes\On;

class ModalCategory extends Component
{
    public $name;

    public function getCategory($id)
    {
        sleep(2);
        $this->name = 'coba kategori';
        return AlpineResponse::toResponse(
            true,
            200,
            'Berhasil mendapatkan data kategori',
            $id);
    }
    public function render()
    {
        return view('livewire.features.category.modal-category');
    }
}
