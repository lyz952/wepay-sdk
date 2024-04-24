<?php

namespace Lyz\WePayV3\Doc\Payments;

use Lyz\Common\BaseObject;

/**
 * 场景信息
 * Class SceneInfo
 * @package Lyz\WePayV3\Doc\Payments
 */
class SceneInfo extends BaseObject
{
    /**
     * 【用户终端IP】必填
     * 用户的客户端IP，支持IPv4和IPv6两种格式的IP地址。
     * 
     * @var int
     */
    public $payer_client_ip;

    /**
     * 【商户端设备号】选填 string[1,32]
     * 门店号或收银设备ID
     * 
     * @var string
     */
    public $device_id;

    /**
     * 【商户门店信息】选填
     * 
     * @var \Lyz\WePayV3\Doc\Payments\StoreInfo
     */
    public $store_info;
}
