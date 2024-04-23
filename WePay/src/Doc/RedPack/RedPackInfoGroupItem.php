<?php

namespace Lyz\WePay\Doc\RedPack;

use Lyz\Common\BaseObject;

/**
 * 裂变红包领取列表中一条数据
 * Class RedPackInfoGroupItem
 * @package Lyz\WePay\Doc\RedPack
 */
class RedPackInfoGroupItem extends BaseObject
{
    /**
     * 【领取红包的Openid】必填
     * 领取红包的openid
     * 
     * @var string
     */
    public $openid;

    /**
     * 【金额】必填
     * 领取金额
     * 
     * @var int
     */
    public $amount;

    /**
     * 【接收时间】必填
     * 领取红包的时间
     * 
     * @var string
     */
    public $rcv_time;
}
