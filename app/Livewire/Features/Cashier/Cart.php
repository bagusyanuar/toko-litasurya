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
//            $invoiceID = "INV-LS-20250308062615";
//            $connector = new WindowsPrintConnector("POS-58");
//            $printer = new Printer($connector);
//            $printer->pulse();
//            $printer->setJustification(Printer::JUSTIFY_CENTER);
//            $printer->text("Toko Lita Surya\n");
//            $printer->text("Jl. Veteran No. 14\n");
//            $printer->text("(Telp: 0895712888490)\n");
//            $printer->text(str_repeat("=", 32) . "\n");
//            $printer->setJustification(Printer::JUSTIFY_LEFT);
//            $printer->selectPrintMode(Printer::MODE_FONT_B);
//            $printer->text("No. nota : {$invoiceID}");
//
//
//            $printer->cut();
//            $printer->close();
            dd("oke");
        } catch (\Exception $e) {
            dd($e->getMessage());
        }


    }

    public function render()
    {
        return view('livewire.features.cashier.cart');
    }
}
