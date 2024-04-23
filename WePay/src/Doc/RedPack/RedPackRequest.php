<?php

namespace Lyz\WePay\Doc\RedPack;

use Lyz\Common\BaseObject;

/**
 * 发放普通红包接口请求参数
 * Class RedPackRequest
 * @package Lyz\WePay\Doc\RedPack
 */
class RedPackRequest extends BaseObject
{
    /**
     * 【商户订单号】必填 String(28)
     * 商户订单号（每个订单号必须唯一。取值范围：0~9，a~z，A~Z）
     * 建议组成：mch_id+yyyymmdd+10位一天内不能重复的数字
     * 接口根据商户订单号支持重入，如出现超时可再调用。
     * 
     * @var string
     */
    public $mch_billno;

    /**
     * 【商户号】必填 
     * 微信支付分配的商户号
     *
     * @var string
     */
    public $mch_id;

    /**
     * 【子商户号】选填 
     * 微信支付分配的子商户号，服务商模式下必填
     *
     * @var string
     */
    public $sub_mch_id;

    /**
     * 【公众账号appid】必填 
     * 微信分配的公众账号ID（企业号corpid即为此appId）。接口传入的所有appid应该为公众号的appid（在mp.weixin.qq.com申请的），不能为APP的appid（在open.weixin.qq.com申请的）。
     * 校验规则：
     * 1、该appid需要与接口传入中的re_openid有对应关系；
     * 2、该appid需要与发放红包商户号有绑定关系，若未绑定，可参考该指引完成绑定（商家商户号与AppID账号关联管理）
     *
     * @var string
     */
    public $wxappid;

    /**
     * 【触达用户appid】必填 
     * 服务商模式下触达用户时的appid(可填服务商自己的appid或子商户的appid)，服务商模式下必填，
     * 服务商模式下填入的子商户appid必须在微信支付商户平台中先录入，否则会校验不过。
     *
     * @var string
     */
    public $msgappid;

    /**
     * 【商户名称】必填 String(32)
     * 红包发送者名称
     *
     * @var string
     */
    public $send_name;

    /**
     * 【用户openid】必填 
     * 接受红包的用户
     * 用户在wxappid下的openid，服务商模式下可填入msgappid下的openid。
     *
     * @var string
     */
    public $re_openid;

    /**
     * 【付款金额】必填 
     * 付款金额，单位分
     *
     * @var int
     */
    public $total_amount;

    /**
     * 【红包发放总人数】必填 
     * 红包发放总人数
     * total_num=1
     *
     * @var int
     */
    public $notify_url;

    /**
     * 【红包祝福语】必填 String(128)
     * 红包祝福语
     *
     * @var string
     */
    public $wishing;

    /**
     * 【Ip地址】必填
     * 调用接口的机器Ip地址
     *
     * @var string
     */
    public $client_ip;

    /**
     * 【活动名称】必填 String(32)
     * 活动名称
     *
     * @var string
     */
    public $act_name;

    /**
     * 【备注】必填 String(256)
     * 备注信息
     *
     * @var string
     */
    public $remark;

    /**
     * 【场景id】选填
     * 发放红包使用场景，红包金额大于200或者小于1元时必传
     * PRODUCT_1:商品促销
     * PRODUCT_2:抽奖
     * PRODUCT_3:虚拟物品兑奖 
     * PRODUCT_4:企业内部福利
     * PRODUCT_5:渠道分润
     * PRODUCT_6:保险回馈
     * PRODUCT_7:彩票派奖
     * PRODUCT_8:税务刮奖
     *
     * @var string
     */
    public $scene_id;

    /**
     * 【活动信息】选填 String(128)
     * posttime:用户操作的时间戳
     * mobile:业务系统账号的手机号，国家代码-手机号。不需要+号
     * deviceid :mac 地址或者设备唯一标识 
     * clientversion :用户操作的客户端版本
     * 把值为非空的信息用key=value进行拼接，再进行urlencode
     * urlencode(posttime=xx&mobile=xx&deviceid=xx)
     *
     * @var string
     */
    public $risk_info;
}
