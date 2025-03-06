<?php


namespace App\Domain\Web\Admin;


use App\Commons\Request\DTORequest;

class DTOMutate extends DTORequest
{
    private $username;
    private $password;
    private $mode;

    protected function rules()
    {
        if ($this->getMode() === 'update') {
            return [
                'username' => 'required',
            ];
        }
        return [
            'username' => 'required',
            'password' => 'required'
        ];
    }

    public function hydrate()
    {
        $username = $this->dtoForm['username'];
        $password = $this->dtoForm['password'];
        $this->setUsername($username)
            ->setPassword($password);
    }

    public function dehydrate()
    {
        if ($this->getMode() === 'update' && $this->getPassword() === '') {
            return [
                'username' => $this->getUsername(),
                'role' => 'admin'
            ];
        }
        return [
            'username' => $this->getUsername(),
            'password' => bcrypt($this->getPassword()),
            'role' => 'admin'
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
