<?php

namespace App\Exports\SellingReturn;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class Report implements WithMultipleSheets
{
    use Exportable;
    private $data;
    private $period;

    public function __construct($data, $period)
    {
        $this->data = $data;
        $this->period = $period;
    }

    /**
     * @inheritDoc
     */
    public function sheets(): array
    {
        // TODO: Implement sheets() method.
        return [
            new Transaction($this->data, $this->period),
            new Cart($this->data, $this->period)
        ];
    }
}
