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

    /**
     * Get detail of a customer with type "toko" by ID.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function getTokoCustomerById(int $id): JsonResponse
    {
        // Cari customer dengan type "toko" dan id tertentu
        $customer = Customer::where('type', 'toko')->find($id);

        // Cek jika customer tidak ditemukan
        if (!$customer) {
            return response()->json([
                'success' => false,
                'message' => 'Customer not found or not a toko type.'
            ], 404);
        }

        // Jika ditemukan, kembalikan data customer
        return response()->json([
            'success' => true,
            'data' => $customer
        ]);
    }
}
