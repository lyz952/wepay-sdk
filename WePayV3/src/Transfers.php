<?php

namespace Lyz\WePayV3;

use Lyz\WePayV3\Contracts\BasicWePay;
use Lyz\WePayV3\Doc\TransferBatch\InitiateBatchTransferRequest;
use Lyz\WePayV3\Doc\TransferBatch\InitiateBatchTransferResponse;

/**
 * 普通商户商家转账到零钱
 * Class Transfers
 * doc: https://pay.weixin.qq.com/docs/merchant/apis/batch-transfer-to-balance/transfer-batch/initiate-batch-transfer.html
 * @package Lyz\WePayV3
 */
class Transfers extends BasicWePay
{
    /**
     * 发起商家批量转账
     * 
     * @param \Lyz\WePayV3\Doc\TransferBatch\InitiateBatchTransferRequest $initiateBatchTransferRequest
     * @return \Lyz\WePayV3\Doc\TransferBatch\InitiateBatchTransferResponse
     * @throws \Lyz\WePayV3\Exceptions\ServiceException
     * @throws \Lyz\WePayV3\Exceptions\ValidationException
     * @throws \Lyz\WePayV3\Exceptions\InvalidResponseException
     */
    public function batchs(InitiateBatchTransferRequest $initiateBatchTransferRequest)
    {
        if (empty($initiateBatchTransferRequest->appid))
            $initiateBatchTransferRequest->appid = $this->appId;
        if (empty($initiateBatchTransferRequest->total_num)) {
            $initiateBatchTransferRequest->total_num = count($initiateBatchTransferRequest->transfer_detail_list);
        }
        return InitiateBatchTransferResponse::create($this->doPost('/v3/transfer/batches', $initiateBatchTransferRequest->toArray()));
    }
}
