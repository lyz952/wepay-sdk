<?php

namespace Lyz\WePayV3\Doc\Payments\Notify;

use Lyz\Common\BaseObject;

/**
 * 支付通知参数
 * Class PaymentsNotify
 * @package Lyz\WePayV3\Doc\Payments\Notify
 */
class PaymentsNotify extends BaseObject
{
    /**
     * 【通知ID】必填
     * 通知的唯一ID
     * 
     * @var string
     */
    public $id;

    /**
     * 【通知创建时间】必填
     * 通知创建的时间，遵循rfc3339标准格式，格式为yyyy-MM-DDTHH:mm:ss+TIMEZONE，yyyy-MM-DD表示年月日，T出现在字符串中，表示time元素的开头，HH:mm:ss.表示时分秒，TIMEZONE表示时区（+08:00表示东八区时间，领先UTC 8小时，即北京时间）。
     * 例如：2015-05-20T13:29:35+08:00表示北京时间2015年05月20日13点29分35秒。
     * 
     * @var string
     */
    public $create_time;

    /**
     * 【通知类型】必填
     * 通知的类型，支付成功通知的类型为 TRANSACTION.SUCCESS
     * 
     * @var string
     */
    public $event_type;

    /**
     * 【通知数据类型】必填
     * 通知的资源数据类型，支付成功通知为encrypt-resource
     * 
     * @var string
     */
    public $resource_type;

    /**
     * 【通知数据】必填
     * 
     * @var \Lyz\WePayV3\Doc\Payments\Notify\PaymentsNotifyResource
     */
    public $resource;

    /**
     * 【回调摘要】必填
     * 
     * @var string
     */
    public $summary;

    /**
     * 【通知数据解析结果】必填
     * 
     * @var \Lyz\WePayV3\Doc\Payments\Notify\Transaction
     */
    public $transaction;
}
