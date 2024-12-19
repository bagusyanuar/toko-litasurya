<?php


namespace App\Helpers\Alpine;


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

    /**
     * AlpineResponse constructor.
     * @param bool $success
     * @param int $status
     * @param string $message
     * @param mixed|null $data
     */
    public function __construct($success = true, $status = 200, $message = '', $data = null)
    {
        $this->success = $success;
        $this->status = $status;
        $this->message = $message;
        $this->data = $data;
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

    public static function toResponse($success = true, $status = 200, $message = '', $data = null)
    {
        return [
            'success' => $success,
            'status' => $status,
            'message' => $message,
            'data' => $data
        ];
    }
}
