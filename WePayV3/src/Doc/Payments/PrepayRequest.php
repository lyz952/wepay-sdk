<?php

namespace Lyz\WePayV3\Doc\Payments;

use Lyz\Common\BaseObject;

/**
 * 直连商户|基础支付接口请求参数
 * Class PrepayRequest
 * @package Lyz\WePayV3\Doc\Payments
 */
class PrepayRequest extends BaseObject
{
    /**
     * 【公众号ID】必填
     * 直连商户申请的公众号或移动应用appid。
     * 
     * @var string
     */
    public $appid;

    /**
     * 【直连商户号】必填
     * 直连商户的商户号，由微信支付生成并下发。
     * 
     * @var string
     */
    public $mchid;

    /**
     * 【商品描述】必填 string[1,127]
     *
     * @var string
     */
    public $description;

    /**
     * 【商户订单号】必填 string[6,32]
     * 商户系统内部订单号，只能是数字、大小写字母_-*且在同一个商户号下唯一
     *
     * @var string
     */
    public $out_trade_no;

    /**
     * 【交易结束时间】选填 
     * 订单失效时间，遵循rfc3339标准格式，格式为yyyy-MM-DDTHH:mm:ss+TIMEZONE，
     * yyyy-MM-DD表示年月日，T出现在字符串中，表示time元素的开头，HH:mm:ss表示时分秒，TIMEZONE表示时区（+08:00表示东八区时间，领先UTC8小时，即北京时间）。
     * 例如：2015-05-20T13:29:35+08:00表示，北京时间2015年5月20日 13点29分35秒。
     *
     * @var string
     */
    public $time_expire;

    /**
     * 【附加数据】选填 string[1,128]
     * 附加数据，在查询API和支付通知中原样返回，可作为自定义参数使用，实际情况下只有支付完成状态才会返回该字段。
     *
     * @var string
     */
    public $attach;

    /**
     * 【通知地址】必填 
     * 异步接收微信支付结果通知的回调地址，通知url必须为外网可访问的url，不能携带参数。
     * 公网域名必须为https，如果是走专线接入，使用专线NAT IP或者私有回调域名可使用http
     *
     * @var string
     */
    public $notify_url;

    /**
     * 【订单优惠标记】选填
     * 商品标记，代金券或立减优惠功能的参数。
     *
     * @var string
     */
    public $goods_tag;

    /**
     * 【电子发票入口开放标识】选填
     *  传入true时，支付成功消息和支付详情页将出现开票入口。需要在微信支付商户平台或微信公众平台开通电子发票功能，传此字段才可生效。
     *  true：是
     *  false：否
     *
     * @var boolean
     */
    public $support_fapiao;

    /**
     * 【订单金额】必填
     *
     * @var \Lyz\WePayV3\Doc\Payments\Amount
     */
    public $amount;

    /**
     * 【优惠功能】选填
     *
     * @var \Lyz\WePayV3\Doc\Payments\Detail
     */
    public $detail;

    /**
     * 【场景信息】选填
     *
     * @var \Lyz\WePayV3\Doc\Payments\SceneInfo
     */
    public $scene_info;

    /**
     * 【结算信息】选填
     *
     * @var \Lyz\WePayV3\Doc\Payments\SettleInfo
     */
    public $settle_info;
}
