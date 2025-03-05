<?php


namespace App\Domain\Web\Auth;


use App\Commons\Request\DTORequest;

class DTOLogin extends DTORequest
{
    private $username;
    private $password;

    protected function rules()
    {
        return [
            'username' => 'required',
            'password' => 'required',
        ];
    }

    public function hydrate()
    {
        $username = $this->dtoForm['username'];
        $password = $this->dtoForm['password'];
        $this->setUsername($username)
            ->setPassword($password);
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
     * @return DTOLogin
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
     * @return DTOLogin
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }


}
