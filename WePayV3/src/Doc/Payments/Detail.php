<?php

namespace Lyz\WePayV3\Doc\Payments;

use Lyz\Common\BaseObject;

/**
 * 优惠功能
 * Class Detail
 * @package Lyz\WePayV3\Doc\Payments
 */
class Detail extends BaseObject
{
    /**
     * 【订单原价】选填
     * 1、商户侧一张小票订单可能被分多次支付，订单原价用于记录整张小票的交易金额。
     * 2、当订单原价与支付金额不相等，则不享受优惠。
     * 3、该字段主要用于防止同一张小票分多次支付，以享受多次优惠的情况，正常支付订单不必上传此参数。
     * 
     * @var int
     */
    public $cost_price;

    /**
     * 【商家小票ID】选填 string[1,32]
     * 
     * @var string
     */
    public $invoice_id;

    /**
     * 【单品列表】选填
     * 条目个数限制：【1，6000】
     * 
     * @var \Lyz\WePayV3\Doc\Payments\GoodsDetail[]
     */
    public $goods_detail;
}
