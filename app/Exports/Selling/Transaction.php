<?php

namespace App\Exports\Selling;

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

class Transaction implements FromCollection, WithTitle, WithHeadings, WithStyles, WithStrictNullComparison, ShouldAutoSize, WithEvents
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
        return new Collection($this->rows());
    }

    /**
     * @inheritDoc
     */
    public function title(): string
    {
        return 'Transaction';
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
                $cellRange = 'A4:E' . $lastRow;
                $sheet->getStyle("A4:A".($lastRow-1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('B4:B'.($lastRow-1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('C4:C'.($lastRow-1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('E4:E'.($lastRow-1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
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
        return [
            [
                'Selling Report',
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
                ''
            ],
            [
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
                'Customer',
                'Total'
            ],
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow();
        $sheet->mergeCells('A1:E1');
        $sheet->mergeCells('A2:E2');
        $sheet->mergeCells("A{$lastRow}:D{$lastRow}");

        $sheet->getStyle('A1:E1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A2:E2')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1:E1')->getFont()->setSize(12)->setBold(true);
        $sheet->getStyle('A2:E2')->getFont()->setSize(10)->setItalic(true);
        $sheet->getStyle("A{$lastRow}:E{$lastRow}")->getFont()->setSize(12)->setBold(true);
    }

    private function rows()
    {
        $results = [];
        foreach ($this->data as $key => $data) {
            $result = [
                ($key + 1),
                Carbon::parse($data->date)->format('d/m/Y'),
                $data->reference_number,
                $data->customer ? $data->customer->name : '-',
                $data->total,
            ];
            array_push($results, $result);
        }
        $sumTotal = $this->data->sum('total');
        array_push($results, [
            'Total Selling',
            '',
            '',
            '',
            $sumTotal
        ]);
        return $results;
    }
}
