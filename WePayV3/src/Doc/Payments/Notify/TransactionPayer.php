<?php

namespace Lyz\WePayV3\Doc\Payments\Notify;

use Lyz\Common\BaseObject;

/**
 * 支付者信息
 * Class TransactionPayer
 * @package Lyz\WePayV3\Doc\Payments\Notify
 */
class TransactionPayer extends BaseObject
{
    /**
     * 【用户标识】必填
     * 用户在直连商户appid下的唯一标识。 
     * 
     * @var string
     */
    public $openid;
}
