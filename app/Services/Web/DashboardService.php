<?php


namespace App\Services\Web;


use App\Commons\Response\ServiceResponse;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Transaction;
use App\Usecase\Web\DashboardUseCase;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardService implements DashboardUseCase
{

    public function getStoreCount(): ServiceResponse
    {
        try {
            $data = Customer::with([])
                ->where('type', '=', 'store')
                ->count();
            return ServiceResponse::statusOK('successfully count store', $data);
        } catch (\Exception $e) {
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }

    public function getMemberCount(): ServiceResponse
    {
        try {
            $data = Customer::with([])
                ->where('type', '=', 'personal')
                ->count();
            return ServiceResponse::statusOK('successfully count member', $data);
        } catch (\Exception $e) {
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }

    public function getTotalRevenue(): ServiceResponse
    {
        try {
            $data = Transaction::with([])
                ->where('status', '=', 'finish')
                ->sum('total');
            return ServiceResponse::statusOK('successfully sum total revenue', (int)$data);
        } catch (\Exception $e) {
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }

    public function getProductCount(): ServiceResponse
    {
        try {
            $data = Item::with([])
                ->count();
            return ServiceResponse::statusOK('successfully count product', $data);
        } catch (\Exception $e) {
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }

    public function getSellingChart(): ServiceResponse
    {
        try {
            $currentYear = Carbon::now()->year;
            $query = Transaction::select(
                DB::raw('MONTH(date) as month'),
                DB::raw('SUM(total) as total')
            )->whereYear('date', $currentYear)
                ->where('status', '=', 'finish')
                ->groupBy(DB::raw('MONTH(date)'))
                ->pluck('total', 'month');
            $data = collect(range(1, 12))->mapWithKeys(function ($month) use ($query) {
                return [$month => (int) $query->get($month, 0)];
            });
            return ServiceResponse::statusOK('successfully get selling chart', $data);
        } catch (\Exception $e) {
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }

    public function getLastPurchasing(): ServiceResponse
    {
        try {
            $data = Transaction::with(['carts.item', 'customer'])
                ->where('type' ,'=', 'sales')
                ->orderBy('created_at', 'DESC')
                ->get()->take(5);
            return ServiceResponse::statusOK('successfully get last purchasing', $data);
        }catch (\Exception $e) {
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }
}
