<?php

namespace App\Livewire\Features\Cashier;

use App\Helpers\Alpine\AlpineResponse;
use App\Services\Web\ItemService;
use Livewire\Component;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;

class Cart extends Component
{
    /** @var ItemService $itemService */
    private $itemService;

    public function boot(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }

    public function getProductByPLU($plu)
    {
        $response = $this->itemService->findByPriceListUnit($plu);
        return AlpineResponse::toJSON($response);
    }

    public function print()
    {
        try {
            $connector = new WindowsPrintConnector("POS-58");
            $printer = new Printer($connector);
            $printer->pulse();
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->text("===== STRUK PEMBELIAN =====\n");
            $printer->cut();
            $printer->close();
            dd("oke");
        }catch (\Exception $e) {
            dd($e->getMessage());
        }


    }

    public function render()
    {
        return view('livewire.features.cashier.cart');
    }
}
