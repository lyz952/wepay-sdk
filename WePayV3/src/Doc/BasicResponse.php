<?php

namespace Lyz\WePayV3\Doc;

use Lyz\Common\BaseObject;

/**
 * 公共应答参数
 * Class BasicResponse
 * doc: https://pay.weixin.qq.com/docs/merchant/development/interface-rules/basic-rules.html#%E9%94%99%E8%AF%AF%E4%BF%A1%E6%81%AF
 * @package Lyz\WePayV3\Doc
 */
class BasicResponse extends BaseObject
{
    /**
     * 【HTTP状态码】必填
     * 处理成功的请求，如果有应答的消息体将返回200，若没有应答的消息体将返回204；
     * 已经被成功接受待处理的请求，将返回202；
     * 请求处理失败时，如缺少必要的入参、支付时余额不足，将会返回4xx范围内的错误码；
     * 请求处理时发生了微信支付侧的服务系统错误，将返回500/501/503的状态码。这种情况比较少见。
     *
     * @var int
     */
    public $http_code;

    /**
     * 【详细错误码】必填
     *
     * @var string
     */
    public $code;

    /**
     * 【错误描述】必填
     * 使用易理解的文字表示错误的原因
     *
     * @var string
     */
    public $message;

    /**
     * 请求是否成功
     *
     * @return boolean
     */
    public function isSuccess()
    {
        return $this->http_code >= 200 && $this->http_code <= 300;
    }

    /**
     * 获取详细错误码
     *
     * @return string
     */
    public function getErrCode()
    {
        return $this->code;
    }

    /**
     * 获取错误描述
     *
     * @return string
     */
    public function getErrMessage()
    {
        return $this->message;
    }
}
