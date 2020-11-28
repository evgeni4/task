<?php

namespace App\Data;
class ErrorDTO
{
    private $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
    return $this->getMessage();
    }
}