<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CustomerController extends Controller
{
    /**
     * Get all customers with type "toko".
     *
     * @return JsonResponse
     */
    public function getTokoCustomers(): JsonResponse
    {
        $customers = Customer::where('type', 'toko')->get();

        return response()->json([
            'success' => true,
            'data' => $customers
        ]);
    }
}
