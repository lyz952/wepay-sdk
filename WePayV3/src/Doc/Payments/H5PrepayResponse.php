<?php

namespace Lyz\WePayV3\Doc\Payments;

/**
 * H5下单接口响应参数
 * Class H5PrepayResponse
 * @package Lyz\WePayV3\Doc\Payments
 */
class H5PrepayResponse extends PrepayResponse
{
    /**
     * 【支付跳转链接】必填
     * h5_url为拉起微信支付收银台的中间页面，可通过访问该url来拉起微信客户端，完成支付，h5_url的有效期为5分钟。
     * 
     * @var string
     */
    public $h5_url;
}
