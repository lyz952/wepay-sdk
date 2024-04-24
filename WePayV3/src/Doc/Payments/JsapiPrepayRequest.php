<?php

namespace Lyz\WePayV3\Doc\Payments;

/**
 * JSAPI下单接口请求参数
 * Class JsapiPrepayRequest
 * @package Lyz\WePayV3\Doc\Payments
 */
class JsapiPrepayRequest extends PrepayRequest
{
    /**
     * 【支付者】必填
     *
     * @var \Lyz\WePayV3\Doc\Payments\Payer
     */
    public $payer;
}
