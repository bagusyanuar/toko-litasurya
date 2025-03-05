<?php


namespace App\Commons\Response;


class ServiceResponse
{
    /** @var bool $success */
    private $success;

    /** @var int $status */
    private $status;

    /** @var string $message */
    private $message;

    /** @var mixed|null $data */
    private $data;

    /** @var mixed|null $meta */
    private $meta;

    /**
     * ServiceResponse constructor.
     * @param bool $success
     * @param int $status
     * @param string $message
     * @param mixed|null $data
     * @param mixed|null $meta
     */
    public function __construct(
        $success = false,
        $status = 500,
        $message = 'internal server error',
        $data = null,
        $meta = null
    )
    {
        $this->success = $success;
        $this->status = $status;
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
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     * @return ServiceResponse
     */
    public function setStatus($status)
    {
        $this->status = $status;
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
     * @return mixed|null
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed|null $data
     * @return ServiceResponse
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return mixed|null
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * @param mixed|null $meta
     * @return ServiceResponse
     */
    public function setMeta($meta)
    {
        $this->meta = $meta;
        return $this;
    }

    public static function success($message, $data = null, $meta = null, $status = 200): self
    {
        return new self(true, $status, $message, $data, $meta);
    }

    public static function failed($message, $data = null, $meta = null, $status = 500): self
    {
        return new self(false, $status, $message, $data, $meta);
    }

    public static function statusOK($message = 'success', $data = null, $meta = null): self
    {
        return new self(true, 200, $message, $data, $meta);
    }

    public static function created($message = '', $data = null): self
    {
        $msg = $message ? $message : 'successfully created';
        return new self(true, 201, $msg, $data, null);
    }

    public static function notFound($message = ''): self
    {
        $msg = $message ? $message : 'item not found';
        return new self(false, 404, $msg, null, null);
    }

    public static function internalServerError($message = ''): self
    {
        $msg = $message ? 'internal server error (' . $message . ')' : 'internal server error';
        return new self(false, 500, $msg, null, null);
    }

    public static function unprocessableEntity($data = null, $message = ''): self
    {
        $msg = $message ? 'Unprocessable Entity (' . $message . ')' : 'Unprocessable Entity';
        return new self(false, 422, $msg, $data, null);
    }

    public static function unauthorized($data = null, $message = ''): self
    {
        $msg = $message ? $message : 'unauthorized';
        return new self(false, 401, $msg, $data, null);
    }


}
