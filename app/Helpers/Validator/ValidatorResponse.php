<?php


namespace App\Helpers\Validator;


use Illuminate\Support\MessageBag;

class ValidatorResponse
{
    /** @var $success boolean */
    private $success;
    /** @var $message MessageBag */
    private $message;

    /**
     * ValidatorResponse constructor.
     * @param bool $success
     * @param MessageBag $message
     */
    public function __construct($success, MessageBag $message)
    {
        $this->success = $success;
        $this->message = $message;
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
     * @return ValidatorResponse
     */
    public function setSuccess($success)
    {
        $this->success = $success;
        return $this;
    }

    /**
     * @return MessageBag
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param MessageBag $message
     * @return ValidatorResponse
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }
}
