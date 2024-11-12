<?php


namespace App\Helpers\Pagination;


class Paginate
{
    public static function paginate($totalRecords, $perPage, $currentPage ,$maxPageRange = 5): PaginationResponse {
        $totalPage = ceil($totalRecords / $perPage);
        $halfRange = floor($maxPageRange / 2);
        $startPage = max(1, $currentPage - $halfRange);
        $endPage = min($totalPage, $currentPage + $halfRange);

        if (($endPage - $startPage + 1) < $maxPageRange) {
            if ($startPage == 1) {
                $endPage = min($totalPage, $startPage + $maxPageRange - 1);
            } elseif ($endPage == $totalPage) {
                $startPage = max(1, $endPage - $maxPageRange + 1);
            }
        }

        if ($totalRecords <= 0) {
            $pageRange = [];
        } else {
            $pageRange = range($startPage, $endPage);
        }
        return new PaginationResponse($totalPage, $pageRange);
    }
}
