<?php

namespace Lyz\WePayV3\Doc\Payments;

use Lyz\Common\BaseObject;

/**
 * 订单金额
 * Class Amount
 * @package Lyz\WePayV3\Doc\Payments
 */
class Amount extends BaseObject
{
    /**
     * 【总金额】必填
     * 订单总金额，单位为分。
     * 
     * @var int
     */
    public $total;

    /**
     * 【货币类型】选填
     * CNY：人民币，境内商户号仅支持人民币。
     * 
     * @var string
     */
    public $currency;
}
