<?php


namespace App\Commons\JWT;


class JWTClaims
{
    private $id;
    private $username;

    /**
     * JWTClaims constructor.
     * @param $id
     * @param $username
     */
    public function __construct($id, $username)
    {
        $this->id = $id;
        $this->username = $username;
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
     * @return JWTClaims
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
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
     * @return JWTClaims
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }
}
