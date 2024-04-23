<?php

namespace Lyz\WePay\Contracts;

use Lyz\WePay\Exceptions\InvalidArgumentException;
use Lyz\WePay\Exceptions\InvalidResponseException;

/**
 * 微信支付基础类
 * Class BasicWePay
 * @package Lyz\WePay\Contracts
 */
abstract class BasicWePay
{
    /**
     * 接口基础地址
     * @var string
     */
    protected $base = 'https://api.mch.weixin.qq.com';

    /**
     * 实例对象静态缓存
     * @var array
     */
    static $instances = [];

    /**
     * 微信绑定APPID
     * 
     * @var string
     */
    protected $appId = '';

    /**
     * 商户编号
     * 
     * @var string
     */
    protected $mchId = '';

    /**
     * 商户密钥
     * 
     * @var string
     */
    protected $mchKey = '';

    /**
     * 证书pem格式(文件路径)
     * 
     * @var string
     */
    protected $sslCer = '';

    /**
     * 证书密钥pem格式(文件路径)
     * 
     * @var string
     */
    protected $sslKey = '';

    /**
     * constructor.
     * 
     * @param array $options
     *  --- appId
     *  --- mchId
     *  --- mchKey
     *  --- sslCer
     *  --- sslKey
     *  --- CertCache
     */
    public function __construct(array $options = [])
    {
        if (empty($options['appId'])) {
            throw new InvalidArgumentException("Missing Config -- [appId]");
        }
        if (empty($options['mchId'])) {
            throw new InvalidArgumentException("Missing Config -- [mchId]");
        }
        if (empty($options['mchKey'])) {
            throw new InvalidArgumentException("Missing Config -- [mchKey]");
        }
        if (empty($options['sslCer']) || !file_exists($options['sslCer'])) {
            throw new InvalidArgumentException("File Non-Existent -- [apiclient_cert.pem]");
        }
        if (empty($options['sslKey']) || !file_exists($options['sslKey'])) {
            throw new InvalidArgumentException("File Non-Existent -- [apiclient_key.pem]");
        }

        $this->appId = $options['appId'];
        $this->mchId = $options['mchId'];
        $this->mchKey = $options['mchKey'];
        $this->sslCer = $options['sslCer'];
        $this->sslKey = $options['sslKey'];
    }

    /**
     * 静态创建对象
     * 
     * @param array $config
     * @return static
     */
    public static function instance($config)
    {
        $key = md5(get_called_class() . serialize($config));
        if (isset(self::$instances[$key])) return self::$instances[$key];
        return self::$instances[$key] = new static($config);
    }

    /**
     * 生成支付签名
     * 
     * @param array  $data     参与签名的数据
     * @param string $signType 参与签名的类型
     * @param string $buff     参与签名字符串前缀
     * @return string
     */
    public function getPaySign(array $data, $signType = 'MD5', $buff = '')
    {
        // 参数名ASCII码从小到大排序（字典序）
        ksort($data);
        // sign参数不参与签名
        if (isset($data['sign'])) unset($data['sign']);
        foreach ($data as $k => $v) {
            // 参数的值为空不参与签名
            if ('' === $v || null === $v) continue;
            $buff .= "{$k}={$v}&";
        }
        $buff .= ("key=" . $this->mchKey);

        // MD5签名方式
        if (strtoupper($signType) === 'MD5') {
            return strtoupper(md5($buff));
        }

        // HMAC-SHA256签名方式
        return strtoupper(hash_hmac('SHA256', $buff, $this->mchKey));
    }

    /**
     * 以 Post 请求接口
     * 
     * @param string $url  请求地址
     * @param array  $data 接口参数
     * @return array
     * @throws \WeChat\Exceptions\InvalidResponseException
     */
    protected function callPostApi(string $url, array $data)
    {
        $url = $this->base . $url;

        $data['nonce_str'] = Tools::createNoncestr();
        $data['sign'] = $this->getPaySign($data, 'MD5');

        $result = $this->_doRequestCurl($url, Tools::arr2xml($data));
        /*
            return_code:【返回状态码】SUCCESS/FAIL
            return_msg:【返回信息】错误原因
         */
        if ($result['return_code'] !== 'SUCCESS') {
            throw new InvalidResponseException($result['return_msg'], '0');
        }
        return $result;
    }

    /**
     * 网络请求
     * 
     * @param string $url  请求地址
     * @param string $data 请求参数 xml格式
     * @return array
     */
    private function _doRequestCurl($url, $data)
    {
        $curl = curl_init();

        // POST数据设置
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        // 证书文件设置
        curl_setopt($curl, CURLOPT_SSLCERTTYPE, 'PEM');
        curl_setopt($curl, CURLOPT_SSLCERT, $this->sslCer);
        // 证书文件设置
        curl_setopt($curl, CURLOPT_SSLKEYTYPE, 'PEM');
        curl_setopt($curl, CURLOPT_SSLKEY, $this->sslKey);

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_TIMEOUT, 60);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        list($content) = [curl_exec($curl), curl_close($curl)];

        return Tools::xml2arr($content);
    }
}
