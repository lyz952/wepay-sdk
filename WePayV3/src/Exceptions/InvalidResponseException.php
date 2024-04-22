<?php

namespace Lyz\WePayV3\Exceptions;

/**
 * 返回异常
 * Class InvalidResponseException
 * @package Lyz\WePayV3\Exceptions
 */
class InvalidResponseException extends \Exception
{
    /**
     * @var array
     */
    public $raw = [];

    /**
     * constructor.
     * 
     * @param string $message
     * @param integer $code
     * @param array $raw
     */
    public function __construct($message, $code = 0, $raw = [])
    {
        parent::__construct($message, intval($code));
        $this->raw = $raw;
    }
}
