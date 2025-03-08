<?php


namespace App\Commons\Invoice;


use App\Models\Transaction;
use Carbon\Carbon;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;

class InvoiceService
{
    private static function wrapText($text, $width)
    {
        return explode("\n", wordwrap($text, $width, "\n", true));
    }

    public static function printInvoice($transactionID)
    {
        $transaction = Transaction::with(['carts.item', 'user'])
            ->where('id', '=', $transactionID)
            ->first();
        if ($transaction) {
            $invoiceID = $transaction->reference_number;
            $time = Carbon::now()->format('Y-m-d H:i:s');
            $cashier = $transaction->user->username;

            $carts = $transaction->carts;
            $connector = new WindowsPrintConnector("POS-58");
            $printer = new Printer($connector);
//        $printer->pulse();
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->setEmphasis(true);
            $printer->setTextSize(1, 1);
            $printer->text("TOKO LITA SURYA\n");
            $printer->setEmphasis(false);
            $printer->setFont(Printer::FONT_B);
            $printer->text("Jl. veteran No. 123\n");
            $printer->text("Telp: 08123456789\n");
            $printer->text(str_repeat("-", 42) . "\n");

            $printer->setJustification(Printer::JUSTIFY_LEFT);
            $printer->text("No. Nota: {$invoiceID}\n");
            $printer->text("Waktu: {$time}\n");
            $printer->text("Kasir: {$cashier}\n");

            $printer->setFont(Printer::FONT_B);
            $printer->text(str_repeat("-", 42) . "\n");
            $printer->setJustification(Printer::JUSTIFY_LEFT);
            $printer->text(str_pad("Barang", 22) . str_pad("Qty", 4) . str_pad("Harga", 8) . "Total\n");
            $printer->text(str_repeat("-", 42) . "\n");

            // Data Transaksi
            $items = [];

            foreach ($carts as $cart) {
                $tmp['name'] = $cart->item->name;
                $tmp['qty'] = $cart->qty;
                $tmp['price'] = $cart->price;
                array_push($items, $tmp);
            }

            $total = 0;
            foreach ($items as $item) {
                $subtotal = $item["qty"] * $item["price"];
                $total += $subtotal;

                // Bungkus nama barang jika lebih panjang dari 22 karakter
                $wrappedLines = self::wrapText($item["name"], 22);

                foreach ($wrappedLines as $index => $line) {
                    if ($index == 0) {
                        // Baris pertama cetak lengkap
                        $printer->text(str_pad($line, 22) . str_pad($item["qty"], 4) . str_pad(number_format($item["price"], 0, ',', '.'), 8) . number_format($subtotal, 0, ',', '.') . "\n");
                    } else {
                        // Baris berikutnya hanya nama barang
                        $printer->text(str_pad($line, 22) . "\n");
                    }
                }
            }
            $finalTotal = $transaction->total;

            $printer->text(str_repeat("-", 42) . "\n");
            $printer->setJustification(Printer::JUSTIFY_RIGHT);
            $printer->setEmphasis(true);
            $printer->text("Sub Total: Rp " . number_format($total, 0, ',', '.') . "\n");
            $printer->text("Diskon: Rp " . number_format(0, 0, ',', '.') . "\n");
            $printer->text("Total: Rp " . number_format($finalTotal, 0, ',', '.') . "\n");
            $printer->setEmphasis(false);
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->text(str_repeat("-", 42) . "\n");
            $printer->text("TERIMA KASIH\n");
            $printer->text("Selamat Berbelanja Kembali\n");
            $printer->cut();
            $printer->close();
        }
    }
}
