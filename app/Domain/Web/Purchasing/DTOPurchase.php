<?php


namespace App\Domain\Web\Purchasing;


use App\Commons\Request\DTORequest;

class DTOPurchase extends DTORequest
{
    private $id;
    /** @var array $carts */
    private $carts;

    public function hydrate()
    {
        $id = $this->dtoForm['id'];
        $carts = $this->dtoForm['carts'] ?? [];
        $arrCarts = [];
        foreach ($carts as $cart) {
            $tmp['id'] = $cart['id'];
            $tmp['qty'] = $cart['qty'] !== '' ? intval(str_replace('.', '', $cart['qty'])) : 0;
            $tmp['total'] = $cart['total'];
            array_push($arrCarts, $tmp);
        }
        $this->setId($id)
            ->setCarts($arrCarts);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return DTOPurchase
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return array
     */
    public function getCarts()
    {
        return $this->carts;
    }

    /**
     * @param array $carts
     * @return DTOPurchase
     */
    public function setCarts($carts)
    {
        $this->carts = $carts;
        return $this;
    }


}
