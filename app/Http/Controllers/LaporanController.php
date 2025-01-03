<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\PDF;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function cetakLaporanGlobal(PDF $pdf)
    {
        $data = [
            'startDate' => '2025-01-01',
            'endDate' => '2025-01-31',
            'transactions' => [
                (object)[
                    'no_trans' => 'TRX123',
                    'tanggal' => '2025-01-05',
                    'nama_customer' => 'John Doe',
                    'points' => 100,
                    'cara_pembayaran' => 'Cash',
                    'total' => 50000
                ],
                (object)[
                    'no_trans' => 'TRX124',
                    'tanggal' => '2025-01-06',
                    'nama_customer' => 'Jane Doe',
                    'points' => 150,
                    'cara_pembayaran' => 'Card',
                    'total' => 75000
                ],
            ],
            'totalKeseluruhan' => 125000,
        ];

        $pdf = $pdf->loadView('components.laporan_pdf.cassier_global_report', $data);
        return $pdf->stream('cassier_global_report.pdf');
    }

    public function cetakLaporanDetail(PDF $pdf)
    {
        $data = [
            'startDate' => '2025-01-01',
            'endDate' => '2025-01-31',
            'transactions' => [
                (object)[
                    'no_trans' => 'TRX123',
                    'tanggal' => '2025-01-05',
                    'nama_customer' => 'John Doe',
                    'items' => [
                        (object)[
                            'nama_barang' => 'Item A',
                            'unit' => 'PCS',
                            'harga' => 10000,
                            'qty' => 2,
                            'subtotal' => 20000,
                        ],
                        (object)[
                            'nama_barang' => 'Item B',
                            'unit' => 'PCS',
                            'harga' => 15000,
                            'qty' => 2,
                            'subtotal' => 30000,
                        ],
                    ]
                ],
            ],
            'totalKeseluruhan' => 50000,
        ];

        $pdf = $pdf->loadView('components.laporan_pdf.cassier_detail_report', $data);
        return $pdf->stream('cassier_detail_global_report.pdf');
    }

    public function cetakLaporanGlobalDetail(PDF $pdf)
    {
        // Data Dummy untuk Items
        $items = [
            ['nama_barang' => 'Barang A', 'unit' => 'pcs', 'harga' => 5000],
            ['nama_barang' => 'Barang B', 'unit' => 'pcs', 'harga' => 10000],
            ['nama_barang' => 'Barang C', 'unit' => 'pcs', 'harga' => 15000],
            ['nama_barang' => 'Barang D', 'unit' => 'pcs', 'harga' => 20000],
        ];

        // Data Dummy untuk Transactions
        $transactions = collect([
            (object)[
                'no_trans' => 'T0001',
                'tanggal' => Carbon::create('2025', '01', '01'),
                'nama_customer' => 'Customer A',
                'points' => 10,
                'cara_pembayaran' => 'Cash',
                'total' => 35000,
                'items' => collect([
                    (object) ['nama_barang' => $items[0]['nama_barang'], 'unit' => $items[0]['unit'], 'harga' => $items[0]['harga'], 'qty' => 1, 'sub_total' => 5000],
                    (object) ['nama_barang' => $items[1]['nama_barang'], 'unit' => $items[1]['unit'], 'harga' => $items[1]['harga'], 'qty' => 2, 'sub_total' => 20000],
                    (object) ['nama_barang' => $items[2]['nama_barang'], 'unit' => $items[2]['unit'], 'harga' => $items[2]['harga'], 'qty' => 1, 'sub_total' => 10000]
                ])
            ],
            (object)[
                'no_trans' => 'T0002',
                'tanggal' => Carbon::create('2025', '01', '02'),
                'nama_customer' => 'Customer B',
                'points' => 15,
                'cara_pembayaran' => 'Credit',
                'total' => 40000,
                'items' => collect([
                    (object) ['nama_barang' => $items[0]['nama_barang'], 'unit' => $items[0]['unit'], 'harga' => $items[0]['harga'], 'qty' => 2, 'sub_total' => 10000],
                    (object) ['nama_barang' => $items[3]['nama_barang'], 'unit' => $items[3]['unit'], 'harga' => $items[3]['harga'], 'qty' => 1, 'sub_total' => 20000],
                    (object) ['nama_barang' => $items[2]['nama_barang'], 'unit' => $items[2]['unit'], 'harga' => $items[2]['harga'], 'qty' => 1, 'sub_total' => 10000]
                ])
            ],
            (object)[
                'no_trans' => 'T0003',
                'tanggal' => Carbon::create('2025', '01', '02'),
                'nama_customer' => 'Customer C',
                'points' => 20,
                'cara_pembayaran' => 'Debit',
                'total' => 25000,
                'items' => collect([
                    (object) ['nama_barang' => $items[1]['nama_barang'], 'unit' => $items[1]['unit'], 'harga' => $items[1]['harga'], 'qty' => 1, 'sub_total' => 10000],
                    (object) ['nama_barang' => $items[3]['nama_barang'], 'unit' => $items[3]['unit'], 'harga' => $items[3]['harga'], 'qty' => 1, 'sub_total' => 20000]
                ])
            ],
        ]);

        // Kelompokkan transaksi berdasarkan tanggal
        $transactionsByDate = $transactions->groupBy(function ($transaction) {
            return $transaction->tanggal->format('d M Y');
        });

        $pdf = $pdf->loadView('components.laporan_pdf.cassier_detail_global_report', [
            'transactionsByDate' => $transactionsByDate,
            'startDate' => '01 January 2025',
            'endDate' => '02 January 2025'
        ]);
        return $pdf->stream('cassier_detail_global_report.pdf');
    }
}
