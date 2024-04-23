<?php

namespace Lyz\WePay;

use Lyz\WePay\Contracts\BasicWePay;
use Lyz\WePay\Doc\RedPack\RedPackInfo;
use Lyz\WePay\Doc\RedPack\RedPackRequest;
use Lyz\WePay\Doc\RedPack\RedPackResponse;
use Lyz\WePay\Doc\RedPack\GroupRedPackRequest;
use Lyz\WePay\Doc\RedPack\GroupRedPackResponse;

/**
 * 微信红包支持
 * Class Redpack
 * doc: https://pay.weixin.qq.com/wiki/doc/api/tools/cash_coupon_sl.php?chapter=13_1
 * @package Lyz\WePay
 */
class Redpack extends BasicWePay
{
    /**
     * 发放普通红包
     * 
     * @param \Lyz\WePay\Doc\RedPack\RedPackRequest $redPackRequest
     * @return \Lyz\WePay\Doc\RedPack\RedPackResponse
     * @throws \Lyz\WePay\Exceptions\InvalidResponseException
     */
    public function create(RedPackRequest $redPackRequest)
    {
        $redPackRequest->mch_id = $this->mchId;
        $redPackRequest->wxappid = $this->appId;
        return RedPackResponse::create($this->callPostApi('/mmpaymkttransfers/sendredpack', $redPackRequest->toArray()));
    }

    /**
     * 发放裂变红包
     * 
     * @param \Lyz\WePay\Doc\RedPack\GroupRedPackRequest $groupRedPackRequest
     * @return \Lyz\WePay\Doc\RedPack\GroupRedPackResponse
     * @throws \Lyz\WePay\Exceptions\InvalidResponseException
     */
    public function groups(GroupRedPackRequest $groupRedPackRequest)
    {
        $groupRedPackRequest->mch_id = $this->mchId;
        $groupRedPackRequest->wxappid = $this->appId;
        return GroupRedPackResponse::create($this->callPostApi('/mmpaymkttransfers/sendgroupredpack', $groupRedPackRequest->toArray()));
    }

    /**
     * 查询红包记录
     * 
     * @param string $mchBillno 商户发放红包的商户订单号
     * @return \Lyz\WePay\Doc\RedPack\RedPackInfo
     * @throws \WeChat\Exceptions\InvalidResponseException
     */
    public function query($mchBillno)
    {
        return RedPackInfo::create($this->callPostApi('/mmpaymkttransfers/gethbinfo', [
            'mch_billno' => $mchBillno, // 商户订单号
            'mch_id' => $this->mchId,
            'appid' => $this->appId,
            'bill_type' => 'MCHT', // MCHT:通过商户订单号获取红包信息。
        ]));
    }
}
