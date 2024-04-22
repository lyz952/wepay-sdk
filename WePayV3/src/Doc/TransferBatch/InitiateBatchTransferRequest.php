<?php

namespace Lyz\WePayV3\Doc\TransferBatch;

use lyz\common\BaseObject;

/**
 * Class InitiateBatchTransferRequest
 * 发起商家转账接口请求参数
 * @package Lyz\WePayV3\Doc\TransferBatch
 */
class InitiateBatchTransferRequest extends BaseObject
{
    /**
     * 【商户appid】必填
     * 申请商户号的appid或商户号绑定的appid（企业号corpid即为此appid）
     * 
     * @var string
     */
    public $appid;

    /**
     * 【商家批次单号】必填 
     * 商户系统内部的商家批次单号，要求此参数只能由数字、大小写字母组成，在商户系统内部唯一
     *
     * @var string
     */
    public $out_batch_no;

    /**
     * 【批次名称】必填 
     * 该笔批量转账的名称
     *
     * @var string
     */
    public $batch_name;

    /**
     * 【批次备注】必填 
     * 转账说明，UTF8编码，最多允许32个字符
     *
     * @var string
     */
    public $batch_remark;

    /**
     * 【转账总金额】必填 
     * 转账金额单位为“分”。转账总金额必须与批次内所有明细转账金额之和保持一致，否则无法发起转账操作
     *
     * @var string
     */
    public $total_amount;

    /**
     * 【转账总笔数】必填 
     * 一个转账批次单最多发起一千笔转账。转账总笔数必须与批次内所有明细之和保持一致，否则无法发起转账操作
     *
     * @var string
     */
    public $total_num;

    /**
     * 【转账明细列表】必填 
     * 发起批量转账的明细列表，最多一千笔
     *
     * @var \Lyz\WePayV3\Doc\TransferBatch\TransferDetailInput[]
     */
    public $transfer_detail_list;

    /**
     * 【转账场景ID】选填
     * 该批次转账使用的转账场景，如不填写则使用商家的默认场景，如无默认场景可为空，可前往“商家转账到零钱-前往功能”中申请。
     *
     * @var string
     */
    public $transfer_scene_id;

    /**
     * 【通知地址】选填 
     * 异步接收微信支付结果通知的回调地址，通知url必须为公网可访问的url，必须为https，不能携带参数。
     *
     * @var string
     */
    public $notify_url;
}
