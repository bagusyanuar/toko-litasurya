<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use Carbon\Carbon;

class CartController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'transaction_id' => 'nullable|exists:transactions,id', // Ubah validasi agar nullable
            'item_id'        => 'required',
            'qty'            => 'required|integer|min:1',
            'price'          => 'required|integer|min:0',
        ]);

        // Periksa apakah transaction_id ada atau tidak
        $transaction_id = $request->transaction_id ? $request->transaction_id : null;

        // Hitung total
        $total = $request->qty * $request->price;

        // Membuat ID Cart menggunakan format crt-TahunBulanTanggalNomorUrut
        $date = Carbon::now()->format('Ymd'); // Format: 20241205 (tahun, bulan, tanggal)
        $lastCart = Cart::where('id', 'like', 'crt-' . $date . '%')->orderBy('id', 'desc')->first(); // Cari ID terakhir untuk hari ini

        // Tentukan nomor urut, jika tidak ada cart sebelumnya maka mulai dari 1
        $serialNumber = $lastCart ? (intval(substr($lastCart->id, 12)) + 1) : 1;
        $serialNumber = str_pad($serialNumber, 5, '0', STR_PAD_LEFT); // Nomor urut dengan 5 digit

        // Membuat ID baru
        $cartId = 'crt-' . $date . $serialNumber; // Format ID: crt-2024120500001

        // Simpan data ke tabel carts
        $cart = Cart::create([
            'id'              => $cartId, // ID cart dengan format baru
            'transaction_id'  => $transaction_id,
            'item_id'         => $request->item_id,
            'qty'             => $request->qty,
            'price'           => $request->price,
            'total'           => $total,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Item added to cart successfully!',
            'data'    => $cart,
        ], 201);
    }
}
