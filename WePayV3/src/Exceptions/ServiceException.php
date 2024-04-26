<?php

namespace Lyz\WePayV3\Exceptions;

/**
 * 发送HTTP请求成功，返回异常时抛出
 * Class ServiceException
 * @package Lyz\WePayV3\Exceptions
 */
class ServiceException extends InvalidResponseException
{
    /**
     * @var array
     */
    public $raw = [];

    /**
     * constructor.
     * 
     * @param integer $http_code HTTP状态码
     * @param array   $content   响应数据
     */
    public function __construct($http_code, $content)
    {
        $this->raw = $content;
        if (!isset($this->raw['code'])) {
            $this->raw['code'] = 'UNKNOWN ERROR';
        }
        if (!isset($this->raw['message'])) {
            $this->raw['message'] = '未知错误';
        }

        parent::__construct($this->raw['message'], intval($http_code), $this->raw);
    }

    /**
     * 获取详细错误码
     *
     * @return void
     */
    public function getErrCode()
    {
        return $this->raw['code'];
    }
}
