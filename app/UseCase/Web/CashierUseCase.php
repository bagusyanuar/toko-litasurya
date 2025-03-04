<?php


namespace App\Usecase\Web;


use App\Commons\Response\ServiceResponse;

interface CashierUseCase
{
    public function addToCart(): ServiceResponse;
}
