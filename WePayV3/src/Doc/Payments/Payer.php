<?php

namespace Lyz\WePayV3\Doc\Payments;

use Lyz\Common\BaseObject;

/**
 * 支付者信息
 * Class Payer
 * @package Lyz\WePayV3\Doc\Payments
 */
class Payer extends BaseObject
{
    /**
     * 【用户标识】必填
     * 用户在直连商户appid下的唯一标识。 
     * 
     * @var string
     */
    public $openid;
}
