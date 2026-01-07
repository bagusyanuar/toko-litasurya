<?php

namespace App\UseCase\Cashier;

use App\Commons\Response\ServiceResponse;
use App\Domain\Cashier\Order\OrderSchema;

interface OrderInterface
{
    public function placeOrder(OrderSchema $schema): ServiceResponse;
    public function findByID($orderId): ServiceResponse;
}
