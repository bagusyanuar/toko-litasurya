<?php


namespace App\Http\Controllers;


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
            foreach ($carts as $cart) {

            }
            DB::commit();
            return response()->json([
                'message' => 'success',
                'data' => $body
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(), 500);
        }
    }
}
