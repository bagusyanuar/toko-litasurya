<?php


namespace App\Domain;


class ServiceResponse
{
    private $success = true;
    private $message = '';
    private $data = null;
    private $meta = null;
    public $code = 200;

    /**
     * ServiceResponse constructor.
     * @param int $code
     * @param bool $success
     * @param string $message
     * @param null $data
     * @param null $meta
     */
    public function __construct($code = 200, $success = true, $message = '', $data = null, $meta = null)
    {
        $this->code = $code;
        $this->success = $success;
        $this->message = $message;
        $this->data = $data;
        $this->meta = $meta;
    }

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return $this->success;
    }

    /**
     * @param bool $success
     * @return ServiceResponse
     */
    public function setSuccess($success)
    {
        $this->success = $success;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return ServiceResponse
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return null
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param null $data
     * @return ServiceResponse
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return null
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * @param null $meta
     * @return ServiceResponse
     */
    public function setMeta($meta)
    {
        $this->meta = $meta;
        return $this;
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param int $code
     * @return ServiceResponse
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }
}
