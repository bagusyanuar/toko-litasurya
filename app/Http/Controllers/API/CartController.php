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
            'user_id'         => 'required|exists:users,id',      // Menambahkan validasi untuk user_id
            'transaction_id'  => 'nullable|exists:transactions,id', // Ubah validasi agar nullable
            'customer_id'     => 'required|exists:customers,id',   // Menambahkan validasi untuk customer_id
            'item_id'         => 'required|exists:items,id',       // Menambahkan validasi untuk item_id
            'qty'             => 'required|integer|min:1',
            'price'           => 'required|integer|min:0',
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
            'id'              => $cartId,         // ID cart dengan format baru
            'user_id'         => $request->user_id,      // Menambahkan user_id
            'transaction_id'  => $transaction_id,
            'customer_id'     => $request->customer_id,   // Menambahkan customer_id
            'item_id'         => $request->item_id,
            'qty'             => $request->qty,
            'request_qty'     => $request->qty,
            'price'           => $request->price,
            'total'           => $total,
            'status'          => 'pending',        // Set status default "pending"
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Item added to cart successfully!',
            'data'    => $cart,
        ], 201);
    }
}
