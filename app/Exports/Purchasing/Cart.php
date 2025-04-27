<?php

namespace App\Exports\Purchasing;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class Cart implements FromCollection, WithTitle, WithHeadings, WithStyles, WithStrictNullComparison, ShouldAutoSize, WithEvents
{
    private $data;
    private $period;

    public function __construct($data, $period)
    {
        $this->data = $data;
        $this->period = $period;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        return new Collection($this->rows());
    }

    /**
     * @inheritDoc
     */
    public function registerEvents(): array
    {
        // TODO: Implement registerEvents() method.
        return  [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet;
                $lastRow = $sheet->getHighestRow();
                $cellRange = 'A4:H' . $lastRow;
                $sheet->getStyle("A4:A".($lastRow))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('B4:B'.($lastRow))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('C4:C'.($lastRow))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('E4:E'.($lastRow))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
                $sheet->getStyle('F4:F'.($lastRow))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('G4:G'.($lastRow))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('H4:H'.($lastRow))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
                $sheet->getStyle($cellRange)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => '000000']
                        ],
                    ],
                ]);
            }
        ];
    }

    /**
     * @inheritDoc
     */
    public function headings(): array
    {
        // TODO: Implement headings() method.
        return [
            [
                'Detail Purchasing Report',
                '',
                '',
                '',
                '',
                '',
                '',
                ''
            ],
            [
                $this->period,
                '',
                '',
                '',
                '',
                '',
                '',
                ''
            ],
            [
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                ''
            ],
            [
                'No.',
                'Date',
                'Invoice ID',
                'Product',
                'Price',
                'Qty',
                'Unit',
                'Total'
            ]
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // TODO: Implement styles() method.
        $sheet->mergeCells('A1:H1');
        $sheet->mergeCells('A2:H2');
        $sheet->getStyle('A1:H1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A2:H2')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1:H1')->getFont()->setSize(12)->setBold(true);
        $sheet->getStyle('A2:H2')->getFont()->setSize(10)->setItalic(true);
    }

    /**
     * @inheritDoc
     */
    public function title(): string
    {
        // TODO: Implement title() method.
        return 'Detail Purchasing';
    }

    private function rows()
    {
        $results = [];
        $no = 0;
        foreach ($this->data as $transaction) {
            foreach ($transaction->carts as $key => $cart) {
                $no = $no + 1;
                $product = $cart->item;
                $result = [
                    ($no),
                    Carbon::parse($transaction->date)->format('d/m/Y'),
                    $transaction->reference_number,
                    $product->name,
                    $cart->price,
                    $cart->qty,
                    $cart->unit,
                    $cart->total,
                ];
                array_push($results, $result);
            }
        }
        return $results;
    }
}
