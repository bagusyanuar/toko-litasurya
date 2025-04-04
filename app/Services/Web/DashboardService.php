<?php


namespace App\Services\Web;


use App\Commons\Response\ServiceResponse;
use App\Models\Customer;
use App\Models\Item;
use App\Models\SalesTeamVisit;
use App\Models\Transaction;
use App\Usecase\Web\DashboardUseCase;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
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

    public function getStoreVisit(): ServiceResponse
    {
        try {
            $data = SalesTeamVisit::with(['sales', 'store'])
                ->orderBy('created_at', 'DESC')
                ->get()->take(5);
            return ServiceResponse::statusOK('successfully get store visit', $data);
        }catch (\Exception $e) {
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }

    public function getTopProduct(): ServiceResponse
    {
        try {
            $currentYear = Carbon::now()->year;
            $data = DB::table('items')
                ->leftJoin('carts', 'items.id', '=', 'carts.item_id')
                ->leftJoin('transactions', 'carts.transaction_id', '=', 'transactions.id')
                ->where(function ($query) use ($currentYear) {
                    /** @var $query Builder */
                    $query->whereYear('transactions.date', $currentYear)
                        ->orWhereNull('transactions.date'); // biar produk yang belum punya transaksi tetap masuk
                })
                ->select('items.id', 'items.name', DB::raw('COALESCE(SUM(carts.qty), 0) as total_sold'))
                ->groupBy('items.id', 'items.name')
                ->orderByDesc('total_sold')
                ->limit(5)
                ->get();
            return ServiceResponse::statusOK('successfully get top 5 products', $data);
        }catch (\Exception $e) {
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }
}
