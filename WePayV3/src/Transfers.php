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
     * @param \Lyz\WePayV3\Doc\TransferBatch\InitiateBatchTransferRequest $body
     * @return \Lyz\WePayV3\Doc\TransferBatch\InitiateBatchTransferResponse
     * @throws \Lyz\WePayV3\Exceptions\InvalidResponseException
     */
    public function batchs(InitiateBatchTransferRequest $body)
    {
        /*
            {
                'appid': 'wxf636efh567hg4356',              
                'out_batch_no': 'plfk2020042013',  
                'batch_name': '提现',   
                'batch_remark': '提现',  
                'total_amount': 100,     
                'total_num': 1,       
                'transfer_detail_list': [
                    [
                        'out_detail_no': 'x23zy545Bd5436', 
                        'transfer_amount': 100,   
                        'transfer_remark': '提现', 
                        'openid': 'o-MYE42l80oelYMDE34nYD456Xoy',             
                        'user_name': '757b340b45ebef5467rter35gf464344v3542sdf4t6re4tb4f54ty45t4yyry45',
                    ]
                ],
                'transfer_scene_id': '1000', 
                'notify_url': 'https://www.weixin.qq.com/wxpay/pay.php',
            }
        */
        return InitiateBatchTransferResponse::create($this->doPost('POST', '/v3/transfer/batches', json_encode($body->toArray(), JSON_UNESCAPED_UNICODE), true));
        /*
            success
            {
                "out_batch_no" : "plfk2020042013",
                "batch_id": "1310004020001013828056420230",
                "create_time": "2023-03-30T11:20:08+08:00",
                "batch_status" : "ACCEPTED"
            }
            error
            {
                "code": "INVALID_REQUEST",
                "message": "此IP地址不允许调用该接口\t"
            }
         */
    }
}
