<?php

namespace Lyz\WePayV3\Doc\Payments\Notify;

use Lyz\Common\BaseObject;

/**
 * 通知资源数据
 * Class PaymentsNotifyResource
 * @package Lyz\WePayV3\Doc\Payments\Notify
 */
class PaymentsNotifyResource extends BaseObject
{
    /**
     * 【加密算法类型】必填
     * 对开启结果数据进行加密的加密算法，目前只支持AEAD_AES_256_GCM
     * 
     * @var string
     */
    public $algorithm;

    /**
     * 【数据密文】必填
     * Base64编码后的开启/停用结果数据密文
     * 
     * @var string
     */
    public $ciphertext;

    /**
     * 【附加数据】必填
     * 
     * @var string
     */
    public $associated_data;

    /**
     * 【原始类型】必填
     * 原始回调类型，为transaction
     * 
     * @var string
     */
    public $original_type;

    /**
     * 【随机串】必填
     * 加密使用的随机串
     * 
     * @var string
     */
    public $nonce;
}
