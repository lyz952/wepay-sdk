<?php

namespace Lyz\WePayV3\Doc\Payments\Notify;

use Lyz\Common\BaseObject;

/**
 * 商品信息
 * Class PromotionGoodsDetail
 * @package Lyz\WePayV3\Doc\Payments\Notify
 */
class PromotionGoodsDetail extends BaseObject
{
    /**
     * 【商品编码】必填
     * 
     * @var string
     */
    public $goods_id;

    /**
     * 【商品数量】必填
     * 用户购买的数量
     * 
     * @var int
     */
    public $quantity;

    /**
     * 【商品单价】必填
     * 单位为：分
     * 
     * @var int
     */
    public $unit_price;

    /**
     * 【商品优惠金额】必填
     * 
     * @var int
     */
    public $discount_amount;

    /**
     * 【商品备注】选填
     * 
     * @var string
     */
    public $goods_remark;
}
