<?php


namespace App\Domain\Web\SalesTeam;


use App\Commons\Request\DTORequest;

class DTOMutate extends DTORequest
{
    private $username;
    private $password;
    private $name;
    private $phone;
    private $address;
    private $mode;

    protected function rules()
    {
        if ($this->getMode() === 'update') {
            return [
                'username' => 'required',
                'name' => 'required',
                'phone' => 'required|numeric',
                'address' => 'required'
            ];
        }
        return [
            'username' => 'required',
            'password' => 'required',
            'name' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required'
        ];
    }

    public function hydrate()
    {
        $username = $this->dtoForm['username'];
        $password = $this->dtoForm['password'];
        $name = $this->dtoForm['name'];
        $phone = $this->dtoForm['phone'];
        $address = $this->dtoForm['address'];
        $this->setUsername($username)
            ->setPassword($password)
            ->setName($name)
            ->setPhone($phone)
            ->setAddress($address);
    }

    public function dehydrate()
    {
        if ($this->getMode() === 'update' && $this->getPassword() === '') {
            return [
                'username' => $this->getUsername(),
                'role' => 'sales',
                'profile' => [
                    'name' => $this->getName(),
                    'phone' => $this->getPhone(),
                    'address' => $this->getAddress()
                ],


            ];
        }
        return [
            'username' => $this->getUsername(),
            'password' => bcrypt($this->getPassword()),
            'role' => 'sales',
            'profile' => [
                'name' => $this->getName(),
                'phone' => $this->getPhone(),
                'address' => $this->getAddress()
            ],
        ];
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     * @return DTOMutate
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     * @return DTOMutate
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
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
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * @param mixed $mode
     * @return DTOMutate
     */
    public function setMode($mode)
    {
        $this->mode = $mode;
        return $this;
    }


}
