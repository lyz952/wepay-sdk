<?php

namespace Lyz\WePayV3\Contracts;

use Lyz\WePayV3\Cert;
use Lyz\WePayV3\Exceptions\InvalidArgumentException;
use Lyz\WePayV3\Exceptions\InvalidResponseException;

/**
 * 微信支付基础类
 * Class BasicWePay
 * @package Lyz\WePayV3\Contracts
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
     * 商户密钥内容
     * 
     * @var string
     */
    protected $certPrivate = '';

    /**
     * 商户公钥内容
     * 
     * @var string
     */
    protected $certPublic = '';

    /**
     * 商户证书序列号 从公钥证书中分析
     * 
     * @var string
     */
    protected $certSerial = '';

    /**
     * 证书缓存类
     * 
     * @var \Lyz\WePayV3\Contracts\CertCache
     */
    protected $CertCache;

    /**
     * constructor.
     * 
     * @param array $options
     *  --- appId
     *  --- mchId
     *  --- mchKey
     *  --- certPublic(文件路径或内容)
     *  --- certPrivate(文件路径或内容)
     *  --- certSerial(不传则从公钥证书分析)
     *  --- CertCache(证书缓存类)
     */
    public function __construct(array $options = [])
    {
        if (empty($options['mchId'])) {
            throw new InvalidArgumentException("Missing Config -- [mchId]");
        }
        if (empty($options['mchKey'])) {
            throw new InvalidArgumentException("Missing Config -- [mchKey]");
        }
        if (empty($options['certPrivate'])) {
            throw new InvalidArgumentException("Missing Config -- [certPrivate]");
        }
        if (empty($options['certPublic'])) {
            throw new InvalidArgumentException("Missing Config -- [certPublic]");
        }

        if (stripos($options['certPublic'], '-----BEGIN CERTIFICATE-----') === false) {
            if (file_exists($options['certPublic'])) {
                $options['certPublic'] = file_get_contents($options['certPublic']);
            } else {
                throw new InvalidArgumentException("File Non-Existent -- [certPublic]");
            }
        }

        if (stripos($options['certPrivate'], '-----BEGIN PRIVATE KEY-----') === false) {
            if (file_exists($options['certPrivate'])) {
                $options['certPrivate'] = file_get_contents($options['certPrivate']);
            } else {
                throw new InvalidArgumentException("File Non-Existent -- [certPrivate]");
            }
        }

        isset($options['appId']) && $this->appId = $options['appId'];
        $this->mchId = $options['mchId'];
        $this->mchKey = $options['mchKey'];
        $this->certPublic = $options['certPublic'];
        $this->certPrivate = $options['certPrivate'];

        if (empty($options['certSerial'])) {
            $info = openssl_x509_parse($this->certPublic);
            if (false === $info || !isset($info['serialNumberHex'])) {
                throw new InvalidArgumentException("Failed to parse certificate public key");
            }
            $this->certSerial = strtoupper($info['serialNumberHex']);
        } else {
            $this->certSerial = $options['certSerial'];
        }

        if (isset($options['CertCache'])) {
            $this->CertCache = $options['CertCache'];
            if (!($this->CertCache instanceof CertCache)) {
                throw new InvalidArgumentException("The CertCache must inherit \Lyz\WePayV3\Contracts\CertCache");
            }
        } else {
            $this->CertCache = new CertCache();
        }
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
     * 获取配置
     *
     * @return array
     */
    public function getConfig()
    {
        return [
            "appId" => $this->appId,
            "mchId" => $this->mchId,
            "mchKey" => $this->mchKey,
            "certPublic" => $this->certPublic,
            "certPrivate" => $this->certPrivate,
            "certSerial" => $this->certSerial,
            "CertCache" => $this->CertCache,
        ];
    }

    /**
     * 发起 GET 请求
     * 
     * @param string $pathinfo 请求路由
     * @param array  $data     请求数据
     * @param bool   $verify   是否验证
     * @return array
     * @throws \Lyz\WePayV3\Exceptions\InvalidResponseException
     */
    public function doGet($pathinfo, $data = [], $verify = true)
    {
        return $this->doRequest('GET', $pathinfo, $data, $verify);
    }

    /**
     * 发起 POST 请求
     * 
     * @param string $pathinfo 请求路由
     * @param array  $data     请求数据
     * @param bool   $verify   是否验证
     * @return array
     * @throws \Lyz\WePayV3\Exceptions\InvalidResponseException
     */
    public function doPost($pathinfo, $data = [], $verify = true)
    {
        return $this->doRequest('POST', $pathinfo, $data, $verify);
    }

    /**
     * 模拟发起请求
     * 
     * @param string $method   请求访问
     * @param string $pathinfo 请求路由
     * @param array  $data     请求数据
     * @param bool   $verify   是否验证
     * @return array
     * @throws \Lyz\WePayV3\Exceptions\InvalidResponseException
     */
    public function doRequest($method, $pathinfo, $data = [], $verify = true)
    {
        $jsondata = json_encode($data, JSON_UNESCAPED_UNICODE);

        list($time, $nonce) = [time(), uniqid() . rand(1000, 9999)];
        $signstr = join("\n", [$method, $pathinfo, $time, $nonce, $jsondata, '']);

        // 生成数据签名TOKEN
        $token = sprintf(
            'mchid="%s",nonce_str="%s",timestamp="%d",serial_no="%s",signature="%s"',
            $this->mchId,
            $nonce,
            $time,
            $this->certSerial,
            $this->signBuild($signstr)
        );

        $arr_url = parse_url($_SERVER['HTTP_HOST']);
        $ua = empty($arr_url['path']) ? 'https://lyz168.com' : $arr_url['path'];

        list($header, $content) = $this->_doRequestCurl($method, $this->base . $pathinfo, [
            'data' => $jsondata,
            // 必须设置 Accept, Content-Type 为 application/json  图片上传API除外
            // User-Agent: 
            // 1.使用HTTP客户端默认的 User-Agent 
            // 2.遵循HTTP协议，使用自身系统和应用的名称和版本等信息，组成自己独有的User-Agent
            'header' => [
                "Accept: application/json",
                "Content-Type: application/json",
                "Authorization: WECHATPAY2-SHA256-RSA2048 {$token}", // Authorization: 认证类型 签名信息
                'User-Agent: ' . $ua,
                // "Accept-Language: zh-CN", // 应答的语种: en,zh-CN,zh-HK,zh-TW
            ],
        ]);

        if ($verify) {
            $headers = [
                // 'timestamp' => '', // Wechatpay-Timestamp 应答时间戳
                // 'nonce' => '',     // Wechatpay-Nonce     应答随机串
                // 'signature' => '', // Wechatpay-Signature 应答签名
                // 'serial' => '',    // Wechatpay-Serial    平台证书序列号
            ];
            foreach (explode("\n", $header) as $line) {
                if (stripos($line, 'Wechatpay') !== false) {
                    list($name, $value) = explode(':', $line);
                    list(, $keys) = explode('wechatpay-', strtolower($name));
                    $headers[$keys] = trim($value);
                }
            }
            try {
                // 顺序不能乱
                $string = join("\n", [$headers['timestamp'], $headers['nonce'], $content, '']);
                if (!$this->signVerify($string, $headers['signature'], $headers['serial'])) {
                    throw new InvalidResponseException("验证响应签名失败", 0, [
                        'headers' => $headers,
                        'content' => $content
                    ]);
                }
            } catch (\Exception $exception) {
                throw new InvalidResponseException($exception->getMessage(), $exception->getCode(), [
                    'headers' => $headers,
                    'content' => $content
                ]);
            }
        }
        return json_decode($content, true);
    }

    /**
     * 网络请求
     * 
     * @param string $method  请求方法
     * @param string $url     请求地址
     * @param array  $options 请求参数 [data, header]
     * @return array [header, content]
     */
    private function _doRequestCurl($method, $url, $options = [])
    {
        $curl = curl_init();
        // POST数据设置
        if (strtolower($method) === 'post') {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $options['data']);
        }
        // CURL头信息设置
        if (!empty($options['header'])) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $options['header']);
        }
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 60);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

        $content = curl_exec($curl);
        $headerSize = curl_getinfo($curl, CURLINFO_HEADER_SIZE);

        curl_close($curl);

        return [substr($content, 0, $headerSize), substr($content, $headerSize)];
    }

    /**
     * 生成数据签名
     * 
     * @param string $data 签名内容
     * @return string
     */
    protected function signBuild($data)
    {
        /*
            签名串一共有五行，每一行为一个参数。行尾以 \n（换行符，ASCII编码值为0x0A）结束，包括最后一行。如果参数本身以\n结束，也需要附加一个\n
                请求方法\n     (GET,POST,PUT)
                URL\n          (获取请求的绝对URL，并去除域名部分得到参与签名的URL。如果请求中有查询参数，URL末尾应附加有'?'和对应的查询字符串。)
                请求时间戳\n   (格林威治时间起至现在的总秒数)
                请求随机串\n   (调用随机数函数生成，将得到的值转换为字符串)
                请求报文主体\n (请求方法为GET时，报文主体为空。
                                当请求方法为POST或PUT时，请使用真实发送的JSON报文。
                                图片上传API，请使用meta对应的JSON报文。)
        */
        // 使用商户私钥对待签名串进行 SHA256 with RSA 签名，并对签名结果进行Base64编码得到签名值
        $pkeyid = openssl_pkey_get_private($this->certPrivate);
        openssl_sign($data, $signature, $pkeyid, 'sha256WithRSAEncryption');
        return base64_encode($signature);
    }

    /**
     * 验证内容签名
     * @param string $data   签名内容
     * @param string $sign   原签名值
     * @param string $serial 证书序号
     * @return int|false
     * @throws \Lyz\WePayV3\Exceptions\LocalCacheException
     * @throws \Lyz\WePayV3\Exceptions\InvalidResponseException
     */
    protected function signVerify($data, $sign, $serial = '')
    {
        $cert = $this->fileCache($serial);
        if (empty($cert)) {
            Cert::instance($this->getConfig())->download();
            $cert = $this->fileCache($serial);
        }
        // $sign 字段值使用 Base64 进行解码，得到应答签名
        return @openssl_verify($data, base64_decode($sign), openssl_x509_read($cert), 'sha256WithRSAEncryption');
    }

    /**
     * 平台证书文件缓存
     * 
     * @param string $name
     * @param null|string $content 为null获取，否则设置
     * @return string
     * @throws \Lyz\WePayV3\Exceptions\LocalCacheException
     */
    protected function fileCache($name, $content = null)
    {
        if (is_null($content)) {
            return base64_decode($this->CertCache->getCache($name) ?: '');
        } else {
            return $this->CertCache->setCache($name, base64_encode($content), 7200);
        }
    }
}
