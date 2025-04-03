<?php


namespace App\Services\Web;


use App\Commons\Response\ServiceResponse;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Transaction;
use App\Usecase\Web\DashboardUseCase;

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
}
