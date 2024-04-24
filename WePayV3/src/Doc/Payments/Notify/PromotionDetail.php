<?php

namespace Lyz\WePayV3\Doc\Payments\Notify;

use Lyz\Common\BaseObject;

/**
 * 优惠功能
 * Class PromotionDetail
 * @package Lyz\WePayV3\Doc\Payments\Notify
 */
class PromotionDetail extends BaseObject
{
    /**
     * 【券ID】必填
     * 
     * @var string
     */
    public $coupon_id;

    /**
     * 【优惠名称】选填
     * 
     * @var string
     */
    public $name;

    /**
     * 【优惠范围】选填
     * GLOBAL：全场代金券
     * SINGLE：单品优惠
     * 
     * @var string
     */
    public $scope;

    /**
     * 【优惠类型】选填
     * CASH：充值型代金券
     * NOCASH：免充值型代金券
     * 
     * @var string
     */
    public $type;

    /**
     * 【优惠券面额】必填
     * 
     * @var string
     */
    public $amount;

    /**
     * 【活动ID】选填
     * 
     * @var string
     */
    public $stock_id;

    /**
     * 【微信出资】选填
     * 单位为分
     * 
     * @var int
     */
    public $wechatpay_contribute;

    /**
     * 【商户出资】选填
     * 单位为分
     * 
     * @var int
     */
    public $merchant_contribute;

    /**
     * 【其他出资】选填
     * 单位为分
     * 
     * @var int
     */
    public $other_contribute;

    /**
     * 【货币类型】选填
     * CNY：人民币，境内商户号仅支持人民币。
     * 
     * @var string
     */
    public $currency;

    /**
     * 【单品列表】选填
     * 
     * @var \Lyz\WePayV3\Doc\Payments\Notify\PromotionGoodsDetail[]
     */
    public $goods_detail;
}
