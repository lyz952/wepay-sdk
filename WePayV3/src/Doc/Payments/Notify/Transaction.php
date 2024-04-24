<?php

namespace Lyz\WePayV3\Doc\Payments\Notify;

use Lyz\Common\BaseObject;

/**
 * 支付成功通知参数
 * Class Transaction
 * @package Lyz\WePayV3\Doc\Payments\Notify
 */
class Transaction extends BaseObject
{
    /**
     * 【公众号ID】必填
     * 直连商户申请的公众号或移动应用appid。
     * 
     * @var string
     */
    public $appid;

    /**
     * 【商户号】必填
     * 
     * @var string
     */
    public $mchid;

    /**
     * 【商户订单号】必填 string[6,32]
     * 商户系统内部订单号，只能是数字、大小写字母_-*且在同一个商户号下唯一
     *
     * @var string
     */
    public $out_trade_no;

    /**
     * 【微信支付订单号】必填
     * 微信支付系统生成的订单号。
     *
     * @var string
     */
    public $transaction_id;

    /**
     * 【交易类型】必填
     * 枚举值：
     * JSAPI：公众号支付
     * NATIVE：扫码支付
     * APP：APP支付
     * MICROPAY：付款码支付
     * MWEB：H5支付
     * FACEPAY：刷脸支付
     *
     * @var string
     */
    public $trade_type;

    /**
     * 【交易状态】必填
     * 枚举值：
     * SUCCESS：支付成功
     * REFUND：转入退款
     * NOTPAY：未支付
     * CLOSED：已关闭
     * REVOKED：已撤销（付款码支付）
     * USERPAYING：用户支付中（付款码支付）
     * PAYERROR：支付失败(其他原因，如银行返回失败)
     *
     * @var string
     */
    public $trade_state;

    /**
     * 【交易状态描述】必填
     *
     * @var string
     */
    public $trade_state_desc;

    /**
     * 【付款银行】必填
     * 银行类型，采用字符串类型的银行标识。银行标识请参考《银行类型对照表》
     * https://pay.weixin.qq.com/docs/merchant/development/chart/bank-type.html
     *
     * @var string
     */
    public $bank_type;

    /**
     * 【附加数据】选填
     * 附加数据，在查询API和支付通知中原样返回，可作为自定义参数使用，实际情况下只有支付完成状态才会返回该字段。
     *
     * @var string
     */
    public $attach;

    /**
     * 【支付完成时间】必填
     * 支付完成时间，遵循rfc3339标准格式，格式为yyyy-MM-DDTHH:mm:ss+TIMEZONE，yyyy-MM-DD表示年月日，T出现在字符串中，表示time元素的开头，HH:mm:ss表示时分秒，TIMEZONE表示时区（+08:00表示东八区时间，领先UTC 8小时，即北京时间）。
     * 例如：2015-05-20T13:29:35+08:00表示，北京时间2015年5月20日 13点29分35秒。
     *
     * @var string
     */
    public $success_time;

    /**
     * 【支付者】必填
     *
     * @var \Lyz\WePayV3\Doc\Payments\Notify\TransactionPayer
     */
    public $payer;

    /**
     * 【订单金额】必填
     *
     * @var \Lyz\WePayV3\Doc\Payments\Notify\TransactionAmount
     */
    public $amount;

    /**
     * 【场景信息】选填
     *
     * @var \Lyz\WePayV3\Doc\Payments\Notify\TransactionSceneInfo
     */
    public $scene_info;

    /**
     * 【优惠功能】选填
     * 享受优惠时返回该字段
     *
     * @var \Lyz\WePayV3\Doc\Payments\Notify\PromotionDetail[]
     */
    public $promotion_detail;
}
