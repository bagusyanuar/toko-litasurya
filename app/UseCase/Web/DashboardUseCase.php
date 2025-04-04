<?php


namespace App\Usecase\Web;


use App\Commons\Response\ServiceResponse;

interface DashboardUseCase
{
    public function getStoreCount(): ServiceResponse;
    public function getMemberCount(): ServiceResponse;
    public function getTotalRevenue(): ServiceResponse;
    public function getProductCount(): ServiceResponse;
    public function getSellingChart(): ServiceResponse;
    public function getLastPurchasing(): ServiceResponse;
    public function getStoreVisit(): ServiceResponse;
    public function getTopProduct(): ServiceResponse;
}
