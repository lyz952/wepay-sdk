<?php

namespace Lyz\WePayV3\Doc\Payments;

use Lyz\Common\BaseObject;

/**
 * 商品信息
 * Class GoodsDetail
 * @package Lyz\WePayV3\Doc\Payments
 */
class GoodsDetail extends BaseObject
{
    /**
     * 【商户侧商品编码】必填 string[1,32]
     * 由半角的大小写字母、数字、中划线、下划线中的一种或几种组成。
     * 
     * @var string
     */
    public $merchant_goods_id;

    /**
     * 【微信支付商品编码】选填
     * 微信支付定义的统一商品编号（没有可不传）
     * 
     * @var string
     */
    public $wechatpay_goods_id;

    /**
     * 【商品名称】选填 string[1,256]
     * 商品的实际名称
     * 
     * @var string
     */
    public $goods_name;

    /**
     * 【商品数量】必填
     * 用户购买的数量
     * 
     * @var int
     */
    public $quantity;

    /**
     * 【商品单价】必填
     * 单位为：分。如果商户有优惠，需传输商户优惠后的单价
     * 例如：用户对一笔100元的订单使用了商场发的纸质优惠券100-50，则活动商品的单价应为原单价-50
     * 
     * @var int
     */
    public $unit_price;
}
