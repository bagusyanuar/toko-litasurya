<?php


namespace App\Http\Controllers;


use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function addPurchase()
    {
        DB::beginTransaction();
        try {
            $body = request()->json()->all();
            $carts = $body['carts'];
            $customerID = $body['customer_id'];
            $userID = "115f8c30-2b34-4f23-8beb-70f783a2424c";
            $referenceNumber = 'INV-LS-' . date('YmdHis');
            $total = collect($carts)->sum('total');
            $dataCarts = [];
            foreach ($carts as $cart) {
                $dataCart = [
                    'user_id' => $userID,
                    'customer_id' => $customerID,
                    'item_id' => $cart['item_id'],
                    'request_qty' => $cart['qty'],
                    'qty' => $cart['qty'],
                    'price' => $cart['price'],
                    'unit' => $cart['unit'],
                    'total' => $cart['total'],
                    'status' => 'pending'
                ];
                array_push($dataCarts, $dataCart);
            }
            $dataTransaction = [
                'user_id' => $userID,
                'customer_id' => $customerID,
                'reference_number' => $referenceNumber,
                'date' => Carbon::now(),
                'total' => $total,
                'status' => 'pending',
                'type' => 'sales'
            ];

            $transaction = Transaction::create($dataTransaction);
            $transaction->carts()->createMany($dataCarts);
            DB::commit();
            return response()->json([
                'message' => 'success',
                'data' => $body
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(), 500);
        }
    }
}
