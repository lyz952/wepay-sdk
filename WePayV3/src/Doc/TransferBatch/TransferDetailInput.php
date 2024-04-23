<?php

namespace Lyz\WePayV3\Doc\TransferBatch;

use Lyz\Common\BaseObject;

/**
 * 转账明细列表项
 * Class TransferDetailInput
 * @package Lyz\WePayV3\Doc\TransferBatch
 */
class TransferDetailInput extends BaseObject
{
    /**
     * 【商家明细单号】必填
     * 商户系统内部区分转账批次单下不同转账明细单的唯一标识，要求此参数只能由数字、大小写字母组成
     *
     * @var string
     */
    public $out_detail_no;

    /**
     * 【转账金额】必填
     * 转账金额单位为“分” 最少 0.1 元
     *
     * @var integer
     */
    public $transfer_amount;

    /**
     * 【转账备注】必填
     * 单条转账备注（微信用户会收到该备注），UTF8编码，最多允许32个字符
     *
     * @var string
     */
    public $transfer_remark;

    /**
     * 【收款用户openid】必填 
     * 商户appid下，某用户的openid
     *
     * @var string
     */
    public $openid;

    /**
     * 【收款用户姓名】选填
     * 收款方真实姓名。支持标准RSA算法和国密算法，公钥由微信侧提供
     * 明细转账金额 <0.3元 时，不允许填写收款用户姓名
     * 明细转账金额 >= 2,000元 时，该笔明细必须填写收款用户姓名
     * 若商户传入收款用户姓名，微信支付会校验用户openID与姓名是否一致，并提供电子回单
     *
     * @var string
     */
    public $user_name;
}
