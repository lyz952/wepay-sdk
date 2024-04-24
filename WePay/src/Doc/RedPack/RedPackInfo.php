<?php

namespace Lyz\WePay\Doc\RedPack;

use Lyz\WePay\Doc\BasicResponse;

/**
 * 查询红包记录接口应答参数
 * Class RedPackInfo
 * @package Lyz\WePay\Doc\RedPack
 */
class RedPackInfo extends BasicResponse
{
    /**
     * 【业务结果】必填 
     * SUCCESS/FAIL
     * 非红包发放结果标识，红包发放是否成功需要查看status字段来判断
     *
     * @var string
     */
    public $result_code;

    /**
     * 【商户订单号】必填
     * 商户使用查询API填写的商户单号的原路返回
     *
     * @var string
     */
    public $mch_billno;

    /**
     * 【商户号】必填 
     * 微信支付分配的商户号
     *
     * @var string
     */
    public $mch_id;

    /**
     * 【红包单号】必填 
     * 使用 API 发放现金红包时返回的红包单号
     *
     * @var string
     */
    public $detail_id;

    /**
     * 【红包状态】必填 
     * SENDING:发放中
     * SENT:已发放待领取
     * FAILED:发放失败
     * RECEIVED:已领取
     * RFUND_ING:退款中
     * REFUND:已退款
     *
     * @var string
     */
    public $status;

    /**
     * 【发放类型】必填 
     * API:通过API接口发放
     * UPLOAD:通过上传文件方式发放
     * ACTIVITY:通过活动方式发放
     * 
     * @var string
     */
    public $send_type;

    /**
     * 【红包类型】必填
     * GROUP:裂变红包
     * NORMAL:普通红包
     *
     * @var string
     */
    public $hb_type;

    /**
     * 【红包个数】必填
     * 红包个数
     *
     * @var int
     */
    public $total_num;

    /**
     * 【红包金额】必填
     * 红包总金额（单位分）
     *
     * @var int
     */
    public $total_amount;

    /**
     * 【失败原因】选填 
     * 发送失败原因
     *
     * @var int
     */
    public $reason;

    /**
     * 【红包发送】必填
     * 红包的发送时间时间
     * 
     * @var string
     */
    public $send_time;

    /**
     * 【红包退款】选填 
     * 红包的退款时间（如果其未领取的退款）时间
     * 
     * @var string
     */
    public $refund_time;

    /**
     * 【红包退款金额】选填 
     * 红包退款金额
     * @var int	
     */
    public $refund_amount;

    /**
     * 【祝福语】选填 
     * 祝福语
     * 
     * @var string
     */
    public $wishing;

    /**
     * 【活动描述】选填 
     * 活动描述，低版本微信可见
     * 
     * @var string
     */
    public $remark;

    /**
     * 【活动名称】选填 
     * 发红包的活动名称
     * 
     * @var string
     */
    public $act_name;

    /**
     * 【裂变红包领取列表】选填 
     * 裂变红包的领取列表 
     * 
     * @var \Lyz\WePay\Doc\RedPack\RedPackInfoGroupItem[]
     */
    public $hblist;
}
