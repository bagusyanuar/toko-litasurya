<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil parameter pencarian dan page dari request
        $search = $request->input('search');
        $page = $request->input('page', 1);
        $perPage = 10; // Jumlah data per halaman

        // Query transaksi
        $query = Transaction::query();

        // Jika ada parameter pencarian
        if ($search) {
            $query->where('reference_number', 'like', '%' . $search . '%')
                ->orWhere('customer_id', 'like', '%' . $search . '%');
        }

        // Ambil data transaksi dengan paginasi
        $transactions = $query->with('customer')  // Memuat relasi customer
            ->orderBy('date', 'desc')
            ->paginate($perPage, ['*'], 'page', $page);

        // Mengembalikan response dalam format JSON
        return response()->json($transactions);
    }

    public function show($id)
    {
        // Ambil transaksi berdasarkan ID dan sertakan customer dan cart
        $transactionDetail = Transaction::with('carts.item.prices', 'customer')->find($id);

        if (!$transactionDetail) {
            return response()->json(['message' => 'Transaksi tidak ditemukan.'], 404);
        }

        return response()->json($transactionDetail);
    }

    public function uploadCart(Request $request)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|string',
            'total' => 'required|numeric|min:0',
            'cart_items' => 'required|array',
            'cart_items.*.item_id' => 'required|string',
            'cart_items.*.qty' => 'required|integer|min:1',
            'cart_items.*.price' => 'required|numeric|min:0',
            'cart_items.*.total' => 'required|numeric|min:0',
            'cart_items.*.unit' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $referenceNumber = $this->generateReferenceNumber();
        $idTrans = $this->generateIdTrans();

        DB::beginTransaction();

        try {
            // Simpan data transaksi dengan status "pending"
            $transaction = Transaction::create([
                'id' => $idTrans,
                'user_id' => $request->user_id,         // Menambahkan user_id
                'customer_id' => $request->customer_id,
                'reference_number' => $referenceNumber,
                'date' => now(),
                'total' => $request->total,
                'status' => 'pending',                  // Set status default "pending"
            ]);

            // Simpan data cart
            foreach ($request->cart_items as $item) {
                Cart::create([
                    'id' => Str::uuid()->toString(),
                    'transaction_id' => $idTrans,
                    'item_id' => $item['item_id'],
                    'qty' => $item['qty'],
                    'request_qty' => $item['qty'],
                    'price' => $item['price'],
                    'total' => $item['total'],
                    'unit' => $item['unit'],
                    'customer_id' => $request->customer_id,
                    'status' => "pending",
                ]);
            }
            DB::commit();
            return response()->json(['message' => 'Transaksi berhasil disimpan.', 'transaction_id' => $idTrans], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Gagal menyimpan transaksi.', 'error' => $e->getMessage()], 500);
        }
    }

    public function markAsComplete($id)
    {
        try {
            // Temukan transaksi berdasarkan ID
            $transaction = Transaction::findOrFail($id);

            // Cek apakah status saat ini adalah "Pesanan Diproses"
            if ($transaction->status === 'Pesanan Diproses') {
                // Ubah status menjadi "Pesanan Selesai"
                $transaction->status = 'Pesanan Selesai';
                $transaction->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Status transaksi berhasil diubah menjadi Pesanan Selesai.',
                    'data' => $transaction,
                ], 200);
            }

            return response()->json([
                'success' => false,
                'message' => 'Transaksi tidak dapat diubah. Status saat ini bukan Pesanan Diproses.',
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengubah status transaksi.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Menghitung total transaksi berdasarkan user_id dan hari ini
     *
     * @param  string  $user_id
     * @return \Illuminate\Http\Response
     */
    public function getTotalTransactionsToday($user_id)
    {
        try {
            // Mendapatkan tanggal hari ini
            $today = Carbon::today()->toDateString(); // Format YYYY-MM-DD

            // Mengambil total transaksi berdasarkan user_id dan tanggal hari ini
            $totalTransactionsToday = Transaction::where('user_id', $user_id)
                ->whereDate('date', $today) // Filter berdasarkan tanggal hari ini
                ->sum('total'); // Ganti 'amount' dengan kolom yang sesuai jika berbeda

            return response()->json([
                'status' => 'success',
                'data' => [
                    'user_id' => $user_id,
                    'total_transactions_today' => $totalTransactionsToday,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan dalam menghitung transaksi hari ini.',
            ], 500);
        }
    }

    function generateReferenceNumber(): string
    {
        $uuid = str_replace('-', '', Str::uuid()->toString());
        $date = now()->format('Ymd');
        return "SLS{$date}{$uuid}";
    }

    function generateIdTrans(): string
    {
        $uuid = str_replace('-', '', Str::uuid()->toString());
        return "{$uuid}";
    }
}
