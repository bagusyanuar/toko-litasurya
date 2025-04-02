<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\BaseDrawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SellingReport implements FromCollection, WithHeadings, WithStyles, WithStrictNullComparison, WithTitle, ShouldAutoSize, WithEvents
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
        return new Collection($this->rowValues());
    }

    /**
     * @inheritDoc
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;
                $lastRow = $sheet->getHighestRow();
                $cellRange = 'A4:F' . $lastRow;
                $sheet->getStyle("A4:A".($lastRow-1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('B4:B'.($lastRow-1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('E4:E'.($lastRow-1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('F4:F'.($lastRow-1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
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
                'Selling Report',
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
                ''
            ],
            [
                '',
                '',
                '',
                '',
                '',
                ''
            ],
            [
                'Date',
                'Invoice ID',
                'Store',
                'Sales',
                'Type',
                'Total'
            ],
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow();
        $sheet->mergeCells('A1:F1');
        $sheet->mergeCells('A2:F2');
        $sheet->mergeCells("A{$lastRow}:E{$lastRow}");

        $sheet->getStyle('A1:F1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A2:F2')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1:F1')->getFont()->setSize(12)->setBold(true);
        $sheet->getStyle('A2:F2')->getFont()->setSize(10)->setItalic(true);
        $sheet->getStyle("A{$lastRow}:F{$lastRow}")->getFont()->setSize(12)->setBold(true);
    }

    /**
     * @inheritDoc
     */
    public function title(): string
    {
        // TODO: Implement title() method.
        return "selling_report";
    }

    private function rowValues()
    {
        $results = [];
        foreach ($this->data as $data) {
            $result = [
                Carbon::parse($data->date)->format('d/m/Y'),
                $data->reference_number,
                $data->customer ? $data->customer->name : '-',
                $data->user->sales ? $data->user->sales->name : '-',
                ucfirst($data->type),
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
            '',
            $sumTotal
        ]);
        return $results;
    }
}
