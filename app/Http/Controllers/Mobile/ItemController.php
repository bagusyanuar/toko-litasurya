<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        try {
            // Ambil parameter sort_by dan sort_order dari request, jika ada
            $sortBy = $request->input('sort_by', 'name'); // Default sort by 'name'
            $sortOrder = $request->input('sort_order', 'asc'); // Default sort order 'asc'
            $categoryId = $request->input('category_id'); // Filter berdasarkan kategori
            $search = $request->input('search'); // Pencarian berdasarkan nama

            // Validasi parameter sort_by agar hanya bisa di field yang diizinkan
            $allowedSortFields = ['name', 'price', 'created_at']; // Sesuaikan dengan field yang diinginkan
            if (!in_array($sortBy, $allowedSortFields)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid sort field.',
                ], 400); // 400 untuk parameter yang salah
            }

            // Validasi sort_order
            if (!in_array(strtolower($sortOrder), ['asc', 'desc'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid sort order.',
                ], 400); // 400 untuk order yang salah
            }

            // Query data item
            $query = Item::with(['category', 'prices']);

            // Filter kategori jika parameter category_id diberikan
            if ($categoryId) {
                $query->where('category_id', $categoryId);
            }

            // Filter pencarian berdasarkan nama jika parameter search diberikan
            if ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            }

            // Tambahkan sorting
            $query->orderBy($sortBy, $sortOrder);

            // Ambil data dengan pagination
            $items = $query->paginate(12);

            // Cek apakah ada data yang ditemukan
            if ($items->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No items found.',
                    'data' => []
                ], 200); // 404 untuk data tidak ditemukan
            }

            // Kembalikan response dalam format JSON dengan data item dan pagination
            return response()->json([
                'success' => true,
                'message' => 'Items retrieved successfully',
                'data' => $items->items(), // Mengambil data item per halaman
                'pagination' => [
                    'current_page' => $items->currentPage(),
                    'total_pages' => $items->lastPage(),
                    'total_items' => $items->total(),
                    'next_page_url' => $items->nextPageUrl(),
                    'prev_page_url' => $items->previousPageUrl(),
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong: ' . $e->getMessage(),
            ], 500); // 500 untuk error server
        }
    }

    public function show($id)
    {
        try {
            // Cari item berdasarkan ID
            $item = Item::with(['category', 'prices']) // Termasuk relasi kategori (jika ada)
                ->find($id);

            // Jika item tidak ditemukan, kembalikan response 404
            if (!$item) {
                return response()->json([
                    'success' => false,
                    'message' => 'Item not found',
                ], 404);
            }

            // Kembalikan response sukses dengan detail item
            return response()->json([
                'success' => true,
                'message' => 'Item retrieved successfully',
                'data' => $item,
            ], 200);
        } catch (\Exception $e) {
            // Tangani kesalahan
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong: ' . $e->getMessage(),
            ], 500);
        }
    }
}
