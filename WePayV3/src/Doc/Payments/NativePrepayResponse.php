<?php

namespace Lyz\WePayV3\Doc\Payments;

/**
 * Native下单接口响应参数
 * Class NativePrepayResponse
 * @package Lyz\WePayV3\Doc\Payments
 */
class NativePrepayResponse extends PrepayResponse
{
    /**
     * 【二维码链接】必填
     * 此URL用于生成支付二维码，然后提供给用户扫码支付。
     * 注意：code_url并非固定值，使用时按照URL格式转成二维码即可。
     * 
     * @var string
     */
    public $code_url;
}
