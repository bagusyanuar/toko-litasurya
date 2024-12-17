<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Transaction;
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


            // Simpan data transaksi
            $transaction = Transaction::create([
                'id' => $idTrans,
                'customer_id' => $request->customer_id,
                'reference_number' => $referenceNumber,
                'date' => now(),
                'total' => $request->total,
            ]);

            // Simpan data cart
            foreach ($request->cart_items as $item) {
                Cart::create([
                    'id' => Str::uuid()->toString(),
                    'transaction_id' => $idTrans,
                    'item_id' => $item['item_id'],
                    'qty' => $item['qty'],
                    'price' => $item['price'],
                    'total' => $item['total'],
                    'unit' => $item['unit'],
                ]);
            }
            DB::commit();
            return response()->json(['message' => 'Transaksi berhasil disimpan.', 'transaction_id' => $idTrans], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Gagal menyimpan transaksi.', 'error' => $e->getMessage()], 500);
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
