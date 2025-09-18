<?php


namespace App\Services\Web;


use App\Commons\Response\MetaPagination;
use App\Commons\Response\ServiceResponse;
use App\Domain\Web\SellingReturnReport\DTOFilter;
use App\Exports\SellingReturn\Report;
use App\Models\TransactionReturn;
use App\UseCase\Web\SellingReportReturnUseCase;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class SellingReturnReportService implements SellingReportReturnUseCase
{

    public function findAll(DTOFilter $filter): ServiceResponse
    {
        try {
            $filter->hydrateQuery();
            $query = $this->generateQuery($filter);
            $totalRows = $query->count();
            $total = $query->sum('total');
            $offset = ($filter->getPage() - 1) * $filter->getPerPage();
            $query
                ->offset($offset)
                ->limit($filter->getPerPage());
            $metaPagination = new MetaPagination($filter->getPage(), $filter->getPerPage(), $totalRows);
            $meta['pagination'] = $metaPagination->dehydrate();
            $data = $query->get();
            return ServiceResponse::statusOK('successfully get selling return report', [
                'data' => $data,
                'total' => (int)$total
            ], $meta);
        } catch (\Exception $e) {
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }

    public function printToPDF(DTOFilter $filter): ServiceResponse
    {
        // TODO: Implement printToPDF() method.
        try {
            $data = $this->generateQuery($filter)
                ->orderBy('date', 'ASC')
                ->get();
            $dateStart = Carbon::parse($filter->getDateStart())->format('d/m/Y');
            $dateEnd = Carbon::parse($filter->getDateEnd())->format('d/m/Y');
            $pdf = Pdf::loadView('livewire.features.pdf.selling-return-report', [
                'title' => 'Selling Return Report',
                'data' => $data,
                'period' => "{$dateStart} - {$dateEnd}"
            ])
                ->setPaper('a4', 'portrait');
            $pdfBase64 = base64_encode($pdf->output());
            return ServiceResponse::statusOK('successfully export selling return report to pdf', $pdfBase64);
        } catch (\Exception $e) {
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }

    public function printToExcel(DTOFilter $filter): ServiceResponse
    {
        // TODO: Implement printToExcel() method.
        try {
            $data = $this->generateQuery($filter)->get();
            $dateStart = Carbon::parse($filter->getDateStart())->format('d/m/Y');
            $dateEnd = Carbon::parse($filter->getDateEnd())->format('d/m/Y');
            $period = "Period ({$dateStart} - {$dateEnd})";
            $fileContent = Excel::raw(new Report($data, $period), \Maatwebsite\Excel\Excel::XLSX);
            $base64File = base64_encode($fileContent);
            return ServiceResponse::statusOK('successfully export selling return report to excel', [
                'file' => $base64File,
                'file_name' => 'selling_return_report_' . now()->format('Ymd_His') . '.xlsx',
            ]);
        } catch (\Exception $e) {
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }

    public function makeChart($year): ServiceResponse
    {
        try {
            $data = $this->generateQueryChart($year);
            return ServiceResponse::statusOK('successfully get selling return chart', $data);
        } catch (\Throwable $e) {
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }

    private function generateQuery(DTOFilter $filter): Builder
    {
        $filter->hydrateQuery();
        return TransactionReturn::with(['user.sales', 'customer', 'details.item'])
            ->where('status', '=', 'finish')
            ->when($filter->getInvoiceID(), function ($q) use ($filter) {
                /** @var Builder $q */
                return $q->where('reference_number', '=', $filter->getInvoiceID());
            })
            ->when(($filter->getDateStart() && $filter->getDateEnd()), function ($q) use ($filter) {
                /** @var Builder $q */
                return $q->whereBetween('date', [$filter->getDateStart(), $filter->getDateEnd()]);
            })->orderBy('date', 'ASC');
    }

    private function generateQueryChart($year)
    {
        $query = TransactionReturn::select(
            DB::raw('MONTH(date) as month'),
            DB::raw('SUM(total) as total')
        )->whereYear('date', $year)
            ->where('status', '=', 'finish')
            ->groupBy(DB::raw('MONTH(date)'))
            ->pluck('total', 'month');
        return collect(range(1, 12))->mapWithKeys(function ($month) use ($query) {
            return [$month => (int)$query->get($month, 0)];
        });
    }
}
