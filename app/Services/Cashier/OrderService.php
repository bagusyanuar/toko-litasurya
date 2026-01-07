<?php

namespace App\Services\Cashier;

use App\Domain\Cashier\Order\OrderSchema;
use App\Commons\Response\ServiceResponse;
use App\Models\Customer;
use App\Models\PointSetting;
use App\Models\Transaction;
use App\UseCase\Cashier\OrderInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderService implements OrderInterface
{
    public function placeOrder(OrderSchema $schema): ServiceResponse
    {
        try {
            DB::beginTransaction();
            $userID = Auth::user()->id;
            $schema->hydrate();

            /** @var DTOCart $cart */
            $total = array_sum(array_map(fn($cart) => $cart->getTotal(), $schema->getCarts()));

            //checking point
            $pointSetting = PointSetting::with([])
                ->where('nominal', '<=', $total)
                ->orderBy('nominal', 'DESC')
                ->first();

            $referenceNumber = 'LS' . date('YmdHis');
            $cashier = Auth::user()->username;
            $dataTransaction = [
                'user_id' => $userID,
                'customer_id' => $schema->getCustomerID(),
                'reference_number' => $referenceNumber,
                'date' => Carbon::now(),
                'total' => $total,
                'status' => 'finish',
                'type' => 'cashier'
            ];
            $transaction = Transaction::create($dataTransaction);

            $carts = [];
            foreach ($schema->getCarts() as $cart) {
                $dataCart = [
                    'user_id' => $userID,
                    'customer_id' => $schema->getCustomerID(),
                    'item_id' => $cart->getItemID(),
                    'request_qty' => $cart->getQty(),
                    'qty' => $cart->getQty(),
                    'price' => $cart->getPrice(),
                    'unit' => $cart->getUnit(),
                    'total' => $cart->getTotal(),
                    'status' => 'finish'
                ];
                array_push($carts, $dataCart);
            }
            $transaction->carts()->createMany($carts);

            $withPoint = false;
            $point = 0;

            if ($schema->getCustomerID() && $pointSetting) {
                $customer = Customer::with([])
                    ->where('id', '=', $schema->getCustomerID())
                    ->first();
                if ($customer) {
                    $withPoint = true;
                    $point = $pointSetting->point;
                    $currentPoint = $customer->point;
                    $newPoint = $currentPoint + $point;
                    $customer->update([
                        'point' => $newPoint
                    ]);
                }
            }

            DB::commit();
            return ServiceResponse::created("successfully place order", [
                'withPoint' => $withPoint,
                'point' => $point,
                'id' => $transaction->id
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }

    public function findByID($orderId): ServiceResponse
    {
        try {
            $data = Transaction::with(['carts.item', 'user'])
                ->where('id', '=', $orderId)
                ->first();
            if (!$data) {
                return ServiceResponse::notFound('transaction not found');
            }
            return ServiceResponse::statusOK('successfully get product', $data);
        } catch (\Throwable $e) {
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }
}
