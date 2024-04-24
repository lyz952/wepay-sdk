<?php

namespace Lyz\WePayV3\Doc\Payments;

use Lyz\Common\BaseObject;

/**
 * 商户门店信息
 * Class StoreInfo
 * @package Lyz\WePayV3\Doc\Payments
 */
class StoreInfo extends BaseObject
{
    /**
     * 【门店编号】必填 string[1,32]
     * 商户侧门店编号
     * 
     * @var int
     */
    public $id;

    /**
     * 【门店名称】选填 string[1,256]
     * 商户侧门店名称
     * 
     * @var string
     */
    public $name;

    /**
     * 【地区编码】选填
     * 
     * @var string
     */
    public $area_code;

    /**
     * 【详细地址】选填
     * 详细的商户门店地址
     * 
     * @var string
     */
    public $address;
}
