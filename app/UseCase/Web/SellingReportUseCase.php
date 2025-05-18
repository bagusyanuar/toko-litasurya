<?php


namespace App\UseCase\Web;


use App\Commons\Response\ServiceResponse;
use App\Domain\Web\SellingReport\DTOFilter;

interface SellingReportUseCase
{
    public function findAll(DTOFilter $filter): ServiceResponse;
    public function printToPDF(DTOFilter $filter): ServiceResponse;
    public function printToExcel(DTOFilter $filter): ServiceResponse;
    public function makeChart($year): ServiceResponse;
}
