<?php


namespace App\Usecase\Web;


use App\Commons\Response\ServiceResponse;
use App\Domain\Web\PurchasingReport\DTOFilter;

interface PurchasingReportUseCase
{
    public function findAll(DTOFilter $filter): ServiceResponse;
    public function printToPDF(DTOFilter $filter): ServiceResponse;
    public function printToExcel(DTOFilter $filter): ServiceResponse;
    public function makeChart($year): ServiceResponse;
}
