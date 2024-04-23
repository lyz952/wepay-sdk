<?php

namespace Lyz\WePay\Doc\RedPack;

use Lyz\WePay\Doc\BaseResponse;

/**
 * 发放普通红包接口应答参数
 * Class RedPackResponse
 * @package Lyz\WePay\Doc\RedPack
 */
class RedPackResponse extends BaseResponse
{
    /**
     * 【业务结果】必填 
     * SUCCESS/FAIL
     * 注意：当状态为FAIL时，存在业务结果未明确的情况。
     * 所以如果状态是FAIL，请务必再请求一次查询接口[请务必关注错误代码（err_code字段），通过查询得到的红包状态确认此次发放的结果。]，以确认此次发放的结果。
     *
     * @var string
     */
    public $result_code;

    /**
     * 【错误代码】选填
     * 错误码信息
     * 注意：出现未明确的错误码（SYSTEMERROR等）时，请务必用原商户订单号重试，或者再请求一次查询接口以确认此次发放的结果。
     *
     * @var string
     */
    public $err_code;

    /**
     * 【商户订单号】必填
     * 商户订单号（每个订单号必须唯一）
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
     * 【公众账号appid】必填
     * 微信为发放红包商户分配的公众账号ID
     *
     * @var string
     */
    public $wxappid;

    /**
     * 【用户openid】必填
     * 接受收红包的用户，用户在wxappid下的openid
     *
     * @var string
     */
    public $re_openid;

    /**
     * 【付款金额】必填 
     * 付款金额，单位分
     *
     * @var int
     */
    public $total_amount;

    /**
     * 【微信单号】必填
     * 红包订单的微信单号
     *
     * @var string
     */
    public $send_listid;
}
