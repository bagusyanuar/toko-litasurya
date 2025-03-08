<?php


namespace App\Services\Web;


use App\Commons\Invoice\InvoiceService;
use App\Commons\Response\ServiceResponse;
use App\Domain\Web\Cashier\DTOCart;
use App\Domain\Web\Cashier\DTOSubmit;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\PointSetting;
use App\Models\Transaction;
use App\Usecase\Web\CashierUseCase;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CashierService implements CashierUseCase
{

    public function submitOrder(DTOSubmit $dto): ServiceResponse
    {
        DB::beginTransaction();
        try {
            $userID = auth()->user()->id;
            $dto->hydrate();
            /** @var DTOCart $cart */
            $total = array_sum(array_map(fn($cart) => $cart->getTotal(), $dto->getCarts()));

            //checking point
            $pointSetting = PointSetting::with([])
                ->where('nominal', '<=', $total)
                ->orderBy('nominal', 'DESC')
                ->first();

            $referenceNumber = 'INV-LS-' . date('YmdHis');
            $cashier = auth()->user()->username;
            $dataTransaction = [
                'user_id' => $userID,
                'customer_id' => $dto->getCustomerID(),
                'reference_number' => 'INV-LS-' . date('YmdHis'),
                'date' => Carbon::now(),
                'total' => $total,
                'status' => 'finish',
                'type' => 'cashier'
            ];
            $transaction = Transaction::create($dataTransaction);
            $carts = [];
            foreach ($dto->getCarts() as $cart) {
                $dataCart = [
                    'user_id' => $userID,
                    'customer_id' => $dto->getCustomerID(),
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
            if ($dto->getCustomerID() && $pointSetting) {
                $customer = Customer::with([])
                    ->where('id', '=', $dto->getCustomerID())
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

            $dataPrint = [
                'invoice_id' => $referenceNumber,
                'cashier' => $cashier,
                'carts' => $carts
            ];
            InvoiceService::printInvoice($transaction->id);
            DB::commit();
            return ServiceResponse::created('successfully create order', [
                'withPoint' => $withPoint,
                'point' => $point
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }
}
