<?php

namespace Lyz\WePayV3;

use Lyz\WePay\Contracts\Tools;
use Lyz\WePayV3\Contracts\BasicWePay;
use Lyz\WePayV3\Contracts\DecryptAes;
use Lyz\WePayV3\Exceptions\InvalidArgumentException;
use Lyz\WePayV3\Exceptions\InvalidResponseException;
use Lyz\WePayV3\Doc\Payments\PrepayRequest;
use Lyz\WePayV3\Doc\Payments\H5PrepayResponse;
use Lyz\WePayV3\Doc\Payments\NativePrepayResponse;
use Lyz\WePayV3\Doc\Payments\AppPrepayWithRequestPaymentResponse;
use Lyz\WePayV3\Doc\Payments\JsapiPrepayWithRequestPaymentResponse;
use Lyz\WePayV3\Doc\Payments\Notify\PaymentsNotify;
use Lyz\WePayV3\Doc\Payments\Notify\Transaction;

/**
 * 直连商户 | 基础支付接口
 * Class Payments
 * doc: https://pay.weixin.qq.com/wiki/doc/apiv3/apis/chapter3_1_1.shtml
 * @package Lyz\WePayV3
 */
class Payments extends BasicWePay
{
    /**
     * 创建支付订单
     * 
     * @param \Lyz\WePayV3\Doc\Payments\PrepayRequest $prepayRequest 支付订单参数
     * @return \Lyz\WePayV3\Doc\Payments\PrepayResponse
     * @throws \Lyz\WePayV3\Exceptions\ServiceException
     * @throws \Lyz\WePayV3\Exceptions\ValidationException
     * @throws \Lyz\WePayV3\Exceptions\InvalidArgumentException
     * @throws \Lyz\WePayV3\Exceptions\InvalidResponseException
     */
    public function create(PrepayRequest $prepayRequest)
    {
        if ($prepayRequest instanceof \Lyz\WePayV3\Doc\Payments\H5PrepayRequest) {
            $type = 'h5';
        } else if ($prepayRequest instanceof \Lyz\WePayV3\Doc\Payments\AppPrepayRequest) {
            $type = 'app';
        } else if ($prepayRequest instanceof \Lyz\WePayV3\Doc\Payments\JsapiPrepayRequest) {
            $type = 'jsapi';
        } else if ($prepayRequest instanceof \Lyz\WePayV3\Doc\Payments\NativePrepayRequest) {
            $type = 'native';
        } else {
            throw new InvalidArgumentException("Payment type not defined.");
        }

        // 创建预支付码
        $pathinfo = '/v3/pay/transactions/' . $type;
        $result = $this->doPost($pathinfo, $prepayRequest->toArray());

        // h5: h5_url 支付跳转链接，为拉起微信支付收银台的中间页面，可通过访问该url来拉起微信客户端，完成支付，h5_url的有效期为5分钟。
        // native: code_url 二维码链接，此URL用于生成支付二维码，然后提供给用户扫码支付。注意：code_url并非固定值，使用时按照URL格式转成二维码即可。
        // jsapi|app: prepay_id 预支付交易会话标识。用于后续接口调用中使用，该值有效期为2小时
        if (empty($result['h5_url']) && empty($result['code_url']) && empty($result['prepay_id'])) {
            throw new InvalidResponseException(json_encode($result, JSON_UNESCAPED_UNICODE));
        }

        if ($type === 'h5') {
            return H5PrepayResponse::create($result);
        } elseif ($type === 'native') {
            return NativePrepayResponse::create($result);
        }

        // 支付参数签名
        $time = strval(time());
        $nonceStr = Tools::createNoncestr();
        if ($type === 'app') {
            $sign = $this->signBuild(join("\n", [$this->appId, $time, $nonceStr, $result['prepay_id'], '']));
            return AppPrepayWithRequestPaymentResponse::create([
                'appId' => $this->appId,
                'partnerId' => $this->mchId,
                'prepayId' => $result['prepay_id'],
                'package' => 'Sign=WXPay',
                'nonceStr' => $nonceStr,
                'timeStamp' => $time,
                'sign' => $sign
            ]);
        } elseif ($type === 'jsapi') {
            $sign = $this->signBuild(join("\n", [$this->appId, $time, $nonceStr, "prepay_id={$result['prepay_id']}", '']));
            return JsapiPrepayWithRequestPaymentResponse::create([
                'appId' => $this->appId,
                'timestamp' => $time,
                'nonceStr' => $nonceStr,
                'package' => "prepay_id={$result['prepay_id']}",
                'signType' => 'RSA',
                'paySign' => $sign
            ]);
        }
    }

    /**
     * 支付结果通知数据解析
     * 
     * @return \Lyz\WePayV3\Doc\Payments\Notify\PaymentsNotify
     * @throws \Lyz\WePayV3\Exceptions\InvalidArgumentException
     * @throws \Lyz\WePayV3\Exceptions\InvalidDecryptException
     */
    public function notify()
    {
        $data = json_decode(Tools::getRawInput(), true);
        $paymentsNotify = PaymentsNotify::create($data);
        if (empty($paymentsNotify->resource)) {
            throw new InvalidArgumentException('通知资源数据[resource]缺失');
        }

        $aes = new DecryptAes($this->mchKey);
        $paymentsNotify->transaction = Transaction::create($aes->decryptToString(
            $paymentsNotify->resource->associated_data,
            $paymentsNotify->resource->nonce,
            $paymentsNotify->resource->ciphertext
        ));

        return $paymentsNotify;
    }
}
