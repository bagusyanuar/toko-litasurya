<?php


namespace App\Services\Web;


use App\Commons\Response\MetaPagination;
use App\Commons\Response\ServiceResponse;
use App\Commons\Traits\Eloquent\Finder;
use App\Domain\Web\Cashier\DTOCart;
use App\Domain\Web\Purchasing\DTOFilter;
use App\Domain\Web\Purchasing\DTOOrder;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\PointSetting;
use App\Models\Transaction;
use App\UseCase\Web\PurchasingUseCase;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class PurchasingService implements PurchasingUseCase
{
    use Finder;

    public function findAll(DTOFilter $filter): ServiceResponse
    {
        try {
            $filter->hydrateQuery();
            $query = Transaction::with(['user.sales', 'customer'])
                ->where('type', '=', 'sales')
                ->where('status', '=', 'pending')
                ->when($filter->getStore(), function ($q) use ($filter) {
                    /** @var Builder $q */
                    return $q->where('customer_id', '=', $filter->getStore());
                })->when($filter->getSales(), function ($q) use ($filter) {
                    /** @var Builder $q */
                    return $q->where('user_id', '=', $filter->getSales());
                })->when(($filter->getDateStart() && $filter->getDateEnd()), function ($q) use ($filter) {
                    /** @var Builder $q */
                    return $q->whereBetween('date', [$filter->getDateStart(), $filter->getDateEnd()]);
                });
            $totalRows = $query->count();
            $offset = ($filter->getPage() - 1) * $filter->getPerPage();
            $query
                ->offset($offset)
                ->limit($filter->getPerPage());
            $metaPagination = new MetaPagination($filter->getPage(), $filter->getPerPage(), $totalRows);
            $meta['pagination'] = $metaPagination->dehydrate();
            $data = $query->get();
            return ServiceResponse::statusOK('successfully get purchasing', $data, $meta);
        } catch (\Exception $e) {
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }

    public function findByID($id): ServiceResponse
    {
        return self::getOneByID(Transaction::class, $id, ['relation' => ['carts.item', 'user.sales', 'customer']]);
    }

    public function placeOrder($id, DTOOrder $dto): ServiceResponse
    {
        DB::beginTransaction();
        try {
            $dto->hydrate();
            $transaction = Transaction::with([])
                ->where('reference_number', '=', $dto->getInvoiceID())
                ->first();
            if (!$transaction) {
                return ServiceResponse::notFound('transaction not found');
            }


            /** @var DTOCart $cart */
            $total = array_sum(array_map(fn($cart) => $cart->getTotal(), $dto->getCarts()));


            foreach ($dto->getCarts() as $cart) {
                $dataCart = [
                    'qty' => $cart->getQty(),
                    'price' => $cart->getPrice(),
                    'unit' => $cart->getUnit(),
                    'total' => $cart->getTotal(),
                ];
                Cart::updateOrCreate(
                    [
                        'id' => $cart->getId()
                    ],
                    $dataCart
                );
            }


            $transaction->update([
                'status' => 'finish',
                'total' => $total
            ]);

            //checking point
            $pointSetting = PointSetting::with([])
                ->where('nominal', '<=', $total)
                ->orderBy('nominal', 'DESC')
                ->first();

            $point = 0;
            if ($pointSetting) {
                $customerID = $transaction->customer_id;
                $customer = Customer::with([])
                    ->where('id', '=', $customerID)
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
            DB::commit();;
            return ServiceResponse::statusOK('successfully place order');
        } catch (\Exception $e) {
            DB::rollBack();
            return ServiceResponse::internalServerError($e->getMessage());
        }
    }
}
