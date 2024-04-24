<?php

namespace Lyz\WePayV3\Doc;

use Lyz\Common\BaseObject;

/**
 * 公共应答参数
 * Class BasicResponse
 * doc: https://pay.weixin.qq.com/docs/merchant/development/interface-rules/basic-rules.html#%E9%94%99%E8%AF%AF%E4%BF%A1%E6%81%AF
 * @package Lyz\WePayV3\Doc
 */
class BasicResponse extends BaseObject
{
    /**
     * 【详细错误码】必填 
     *
     * @var string
     */
    public $code;

    /**
     * 【错误描述】必填 
     * 使用易理解的文字表示错误的原因
     *
     * @var string
     */
    public $message;
}
