<?php


namespace App\Services\Mobile;


use App\Commons\Response\MetaPagination;
use App\Commons\Response\ServiceResponse;
use App\Domain\Mobile\Purchase\DTOFilter;
use App\Domain\Mobile\Purchase\DTOPurchase;
use App\Models\Transaction;
use App\UseCase\Mobile\PurchaseInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class PurchaseService implements PurchaseInterface
{

    public function create(DTOPurchase $dto): ServiceResponse
    {
        DB::beginTransaction();
        try {
            $userId = auth()->user()->id;
            $validator = $dto->validate();
            if ($validator->fails()) {
                return ServiceResponse::unprocessableEntity($validator->errors()->toArray());
            }
            $dto->hydrate();

            $dataCarts = [];
            foreach ($dto->getCarts() as $cart) {
                $dataCart = [
                    'user_id' => $userId,
                    'customer_id' => $dto->getCustomerId(),
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

            $referenceNumber = 'INV-LS-' . date('YmdHis');
            $total = collect($dto->getCarts())->sum('total');
            $dataTransaction = [
                'user_id' => $userId,
                'customer_id' => $dto->getCustomerId(),
                'reference_number' => $referenceNumber,
                'date' => Carbon::now(),
                'total' => $total,
                'status' => 'pending',
                'type' => 'sales'
            ];

            $transaction = Transaction::create($dataTransaction);
            $transaction->carts()->createMany($dataCarts);
            DB::commit();
            return ServiceResponse::created('successfully create purchase');
        } catch (\Throwable $e) {
            DB::rollBack();
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }

    public function findAll(DTOFilter $filter): ServiceResponse
    {
        try {
            $userId = auth()->user()->id;
            $filter->hydrateQuery();
            $query = Transaction::with(['customer'])
                ->where('user_id', '=', $userId)
                ->when($filter->getParam(), function ($q) use ($filter) {
                    /** @var Builder $q */
                    return $q->whereRelation('customer', 'name', 'LIKE', "%{$filter->getParam()}%");
                })->orderBy('created_at', 'DESC');
            $totalRows = $query->count();
            $offset = ($filter->getPage() - 1) * (int)$filter->getPerPage();
            $query
                ->offset($offset)
                ->limit($filter->getPerPage());
            $metaPagination = new MetaPagination($filter->getPage(), $filter->getPerPage(), $totalRows);
            $meta['pagination'] = $metaPagination->dehydrate();
            $data = $query->get();
            return ServiceResponse::statusOK('successfully get purchases', $data, $meta);
        } catch (\Throwable $e) {
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }

    public function findByID($id): ServiceResponse
    {
        try {
            $data = Transaction::with(['customer', 'carts.item'])
                ->where('id', '=', $id)
                ->first();
            if (!$data) {
                return ServiceResponse::notFound('transaction not found');
            }
            return ServiceResponse::statusOK('successfully get transaction', $data);
        } catch (\Throwable $e) {
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }
}
