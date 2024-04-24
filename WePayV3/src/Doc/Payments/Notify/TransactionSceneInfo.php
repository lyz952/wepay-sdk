<?php

namespace Lyz\WePayV3\Doc\Payments\Notify;

use Lyz\Common\BaseObject;

/**
 * 支付场景信息描述
 * Class TransactionSceneInfo
 * @package Lyz\WePayV3\Doc\Payments\Notify
 */
class TransactionSceneInfo extends BaseObject
{
    /**
     * 【商户端设备号】选填
     * 终端设备号（门店号或收银设备ID）
     * 
     * @var string
     */
    public $device_id;
}
