<?php

namespace Lyz\WePayV3\Doc\Payments\Notify;

use Lyz\Common\BaseObject;

/**
 * 订单金额
 * Class TransactionAmount
 * @package Lyz\WePayV3\Doc\Payments\Notify
 */
class TransactionAmount extends BaseObject
{
    /**
     * 【总金额】必填
     * 订单总金额，单位为分。
     * 
     * @var int
     */
    public $total;

    /**
     * 【用户支付金额】必填
     * 用户支付金额，单位为分。
     * 
     * @var int
     */
    public $payer_total;

    /**
     * 【货币类型】必填
     * CNY：人民币，境内商户号仅支持人民币。
     * 
     * @var string
     */
    public $currency;

    /**
     * 【用户支付币种】必填
     * 
     * @var string
     */
    public $payer_currency;
}
