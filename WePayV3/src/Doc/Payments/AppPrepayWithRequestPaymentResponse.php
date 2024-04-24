<?php

namespace Lyz\WePayV3\Doc\Payments;

/**
 * App下单接口响应参数和调起支付API请求参数
 * Class AppPrepayWithRequestPaymentResponse
 * @package Lyz\WePayV3\Doc\Payments
 */
class AppPrepayWithRequestPaymentResponse extends PrepayResponse
{
    /**
     * 【应用ID】必填
     * 微信开放平台审核通过的移动应用appid 
     * 
     * @var string
     */
    public $appId;

    /**
     * 【商户号】必填
     * 请填写商户号mchid对应的值。
     * 
     * @var string
     */
    public $partnerid;

    /**
     * 【预支付交易会话ID】必填
     * 微信返回的支付交易会话ID，该值有效期为2小时。
     * 
     * @var string
     */
    public $prepayid;

    /**
     * 【订单详情扩展字符串】必填
     * 暂填写固定值Sign=WXPay
     * 
     * @var string
     */
    public $package;

    /**
     * 【随机字符串】必填 string[1,32]
     * 
     * @var string
     */
    public $nonceStr;

    /**
     * 【时间戳】必填
     * 时间戳，标准北京时间，时区为东八区，自1970年1月1日 0点0分0秒以来的秒数。注意：部分系统取到的值为毫秒级，需要转换成秒(10位数字)。
     * 
     * @var string
     */
    public $timeStamp;

    /**
     * 【签名】必填
     * 签名，使用字段appId、timeStamp、nonceStr、prepayid计算得出的签名值
     * 注意：取值RSA格式
     * 
     * @var string
     */
    public $paySign;
}
