<?php

namespace Lyz\WePayV3\Doc\Payments;

use Lyz\Common\BaseObject;

/**
 * 结算信息
 * Class SettleInfo
 * @package Lyz\WePayV3\Doc\Payments
 */
class SettleInfo extends BaseObject
{
    /**
     * 【是否指定分账】选填
     * 
     * @var boolean
     */
    public $profit_sharing;
}
