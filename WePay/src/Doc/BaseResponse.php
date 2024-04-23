<?php

namespace Lyz\WePay\Doc;

use Lyz\Common\BaseObject;

/**
 * 应答参数
 * Class BaseResponse
 * @package Lyz\WePay\Doc
 */
class BaseResponse extends BaseObject
{
    /**
     * 【业务结果】必填 
     * SUCCESS/FAIL
     *
     * @var string
     */
    public $result_code;

    /**
     * 【错误代码】选填
     * 错误码信息
     *
     * @var string
     */
    public $err_code;

    /**
     * 【错误代码描述】选填
     * 结果信息描述
     *
     * @var string
     */
    public $err_code_des;
}
