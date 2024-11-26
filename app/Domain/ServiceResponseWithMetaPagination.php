<?php


namespace App\Domain;


class ServiceResponseWithMetaPagination
{
    /**
     * @var bool $success
     */
    private $success = true;

    /**
     * @var string $message
     */
    private $message = '';

    /**
     * @var mixed $data
     */
    private $data = null;

    /**
     * @var MetaPagination $meta
     */
    private $meta = null;

    /**
     * @var int $code
     */
    public $code = 200;

    /**
     * ServiceResponseWithMetaPagination constructor.
     * @param bool $success
     * @param string $message
     * @param mixed $data
     * @param MetaPagination $meta
     * @param int $code
     */
    public function __construct($success = true, $message = '', $data = null, MetaPagination $meta = null, $code = 200)
    {
        $this->success = $success;
        $this->message = $message;
        $this->data = $data;
        $this->meta = $meta;
        $this->code = $code;
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
     * @return ServiceResponseWithMetaPagination
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
     * @return ServiceResponseWithMetaPagination
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     * @return ServiceResponseWithMetaPagination
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return MetaPagination
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * @param MetaPagination $meta
     * @return ServiceResponseWithMetaPagination
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
     * @return ServiceResponseWithMetaPagination
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }
}
