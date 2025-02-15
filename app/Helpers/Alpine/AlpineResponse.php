<?php


namespace App\Helpers\Alpine;


use App\Commons\Response\ServiceResponse;

class AlpineResponse
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
     * AlpineResponse constructor.
     * @param bool $success
     * @param int $status
     * @param string $message
     * @param mixed|null $data
     * @param mixed|null $meta
     */
    public function __construct($success = true, $status = 200, $message = '', $data = null, $meta = null)
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
     * @return AlpineResponse
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
     * @return AlpineResponse
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
     * @return AlpineResponse
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
     * @return AlpineResponse
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
     * @return AlpineResponse
     */
    public function setMeta($meta)
    {
        $this->meta = $meta;
        return $this;
    }

    public static function toResponse($success = true, $status = 200, $message = '', $data = null, $meta = null)
    {
        return [
            'success' => $success,
            'status' => $status,
            'message' => $message,
            'data' => $data,
            'meta' => $meta
        ];
    }

    public static function toJSON(ServiceResponse $serviceResponse): array
    {
        return [
            'success' => $serviceResponse->isSuccess(),
            'status' => $serviceResponse->getStatus(),
            'message' => $serviceResponse->getMessage(),
            'data' => $serviceResponse->getData(),
            'meta' => $serviceResponse->getMeta()
        ];
    }


}
