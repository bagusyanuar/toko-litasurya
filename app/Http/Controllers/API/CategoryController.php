<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            // Ambil semua kategori dari database
            $categories = Category::all();

            // Cek jika data kosong
            if ($categories->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No categories found.',
                    'data' => []
                ], 404); // 404: Not Found
            }

            // Kembalikan data jika ada
            return response()->json([
                'success' => true,
                'message' => 'Categories retrieved successfully.',
                'data' => $categories,
            ], 200); // 200: OK

        } catch (\Throwable $e) {
            // Tangani error yang tidak terduga
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while retrieving categories.',
                'error' => $e->getMessage() // Untuk debugging, jangan tampilkan di produksi
            ], 500); // 500: Internal Server Error
        }
    }

    public function getCart($transaction_id)
    {
        // Ambil data cart berdasarkan transaction_id
        $carts = Cart::where('transaction_id', $transaction_id)->get();

        // Cek apakah ada data cart
        if ($carts->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No items found in the cart for this transaction.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $carts,
        ], 200);
    }
}
