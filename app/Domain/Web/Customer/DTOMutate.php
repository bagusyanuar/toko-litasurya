<?php


namespace App\Domain\Web\Customer;


use App\Commons\Request\DTORequest;

class DTOMutate extends DTORequest
{
    private $name;
    private $type;
    private $phone;
    private $address;
    private $point;

    protected function rules()
    {
        return [
            'name' => 'required',
            'type' => 'required',
        ];
    }

    public function hydrate()
    {
        $name = $this->dtoForm['name'];
        $type = $this->dtoForm['type'];
        $phone = $this->dtoForm['phone'];
        $address = $this->dtoForm['address'];
        $point = $this->dtoForm['point'];

        $this->setName($name)
            ->setPhone($phone)
            ->setType($type)
            ->setAddress($address)
            ->setPoint($point);
    }

    public function dehydrate()
    {
        return [
            'name' => $this->getName(),
            'type' => $this->getType(),
            'phone' => $this->getPhone(),
            'address' => $this->getAddress(),
            'point' => $this->getPoint()
        ];
    }
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return DTOMutate
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @return DTOMutate
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     * @return DTOMutate
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     * @return DTOMutate
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPoint()
    {
        return $this->point;
    }

    /**
     * @param mixed $point
     * @return DTOMutate
     */
    public function setPoint($point)
    {
        $this->point = $point;
        return $this;
    }
}
