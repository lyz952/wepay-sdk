<?php

namespace Lyz\WePayV3\Doc\Payments;

/**
 * Jsapi下单接口响应参数和调起支付API请求参数
 * Class JsapiPrepayWithRequestPaymentResponse
 * @package Lyz\WePayV3\Doc\Payments
 */
class JsapiPrepayWithRequestPaymentResponse extends PrepayResponse
{
    /**
     * 【公众号APPID】必填
     * 
     * @var string
     */
    public $appId;

    /**
     * 【时间戳】必填
     * 时间戳，标准北京时间，时区为东八区，自1970年1月1日 0点0分0秒以来的秒数。注意：部分系统取到的值为毫秒级，需要转换成秒(10位数字)。
     * 
     * @var string
     */
    public $timeStamp;

    /**
     * 【随机字符串】必填 string[1,32]
     * 
     * @var string
     */
    public $nonceStr;

    /**
     * 【订单详情扩展字符串】必填
     * JSAPI下单接口返回的prepay_id参数值，提交格式如：prepay_id=***
     * 
     * @var string
     */
    public $package;

    /**
     * 【签名方式】必填
     * 签名类型，默认为RSA，仅支持RSA。
     * 
     * @var string
     */
    public $signType;

    /**
     * 【签名】必填
     * 签名，使用字段appId、timeStamp、nonceStr、package计算得出的签名值
     * 
     * @var string
     */
    public $paySign;
}
