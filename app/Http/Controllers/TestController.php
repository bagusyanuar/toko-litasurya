<?php


namespace App\Http\Controllers;


class TestController extends Controller
{
    public function addPurchase()
    {
        try {
            return response()->json([
                'message' => 'success',
                'data' => request()->all()
            ], 200);
        } catch (\Exception $e) {
            return response()->json('internal server error', 500);
        }
    }
}
