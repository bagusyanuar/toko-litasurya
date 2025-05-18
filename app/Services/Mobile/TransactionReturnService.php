<?php


namespace App\Services\Mobile;


use App\Commons\Response\ServiceResponse;
use App\Domain\Mobile\TransactionReturn\DTOTransactionReturn;
use App\Models\TransactionReturn;
use App\Usecase\Mobile\TransactionReturnUseCase;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TransactionReturnService implements TransactionReturnUseCase
{

    public function create(DTOTransactionReturn $dto): ServiceResponse
    {
        try {
            DB::beginTransaction();
            $userId = auth()->user()->id;
            $validator = $dto->validate();
            if ($validator->fails()) {
                return ServiceResponse::unprocessableEntity($validator->errors()->toArray());
            }
            $dto->hydrate();

            $carts = collect($dto->getCarts());
            $total = $carts->sum('total');
            $dataTransaction = [
                'user_id' => $userId,
                'customer_id' => $dto->getCustomerID(),
                'date' => Carbon::now(),
                'reference_number' => 'RTN/' . date('YmdHis'),
                'total' => $total,
                'status' => 'pending',
            ];
            $transactionReturn = TransactionReturn::create($dataTransaction);
            $dataCarts = [];
            foreach ($carts as $cart) {
                $tmp['transaction_return_id'] = $transactionReturn->id;
                $tmp['item_id'] = $cart['item_id'];
                $tmp['qty'] = $cart['qty'];
                $tmp['price'] = $cart['price'];
                $tmp['total'] = $cart['total'];
                $tmp['unit'] = $cart['unit'];
                array_push($dataCarts, $tmp);
            }
            $transactionReturn->details()->createMany($dataCarts);
            DB::commit();
            return ServiceResponse::created('successfully create transaction return');
        } catch (\Throwable $e) {
            DB::rollBack();
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }
}
