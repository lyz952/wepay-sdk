<?php

namespace Lyz\WePayV3\Contracts;

use Lyz\WePayV3\Exceptions\LocalCacheException;

/**
 * 证书缓存
 * Class CertCache
 * @package Lyz\WePayV3\Contracts
 */
class CertCache
{
    /**
     * @var string 缓存路径 需拥有读写权限
     */
    public $cache_path;

    /**
     * constructor.
     * 
     * @param string $cache_path
     */
    public function __construct($cache_path = '')
    {
        $this->cache_path = $cache_path ?: (dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'Cache' . DIRECTORY_SEPARATOR);
    }

    /**
     * 写入缓存
     * 
     * @param string $name    缓存名称
     * @param string $value   缓存内容
     * @param int    $expired 缓存时间(0表示永久缓存)
     * @return string 路径
     * @throws \Lyz\WePayV3\Exceptions\LocalCacheException
     */
    public function setCache($name, $value = '', $expired = 3600)
    {
        $file = $this->_getCacheName($name);
        $data = [
            'name' => $name,
            'value' => $value,
            'expired' => $expired === 0 ? 0 : time() + intval($expired)
        ];
        if (!file_put_contents($file, serialize($data))) {
            throw new LocalCacheException('local cache error.', '0');
        }
        return $file;
    }

    /**
     * 获取缓存内容
     * 
     * @param string $name 缓存名称
     * @return null|mixed
     */
    public function getCache($name)
    {
        $file = $this->_getCacheName($name);
        if (file_exists($file) && is_file($file) && ($content = file_get_contents($file))) {
            $data = unserialize($content);
            if (isset($data['expired']) && (intval($data['expired']) === 0 || intval($data['expired']) >= time())) {
                return $data['value'];
            }
            $this->delCache($name);
        }
        return null;
    }

    /**
     * 移除缓存文件
     * 
     * @param string $name 缓存名称
     * @return boolean
     */
    public function delCache($name)
    {
        $file = $this->_getCacheName($name);
        return !file_exists($file) || @unlink($file);
    }

    /**
     * 获取缓存文件路径
     * 
     * @param string $name
     * @return string
     */
    private function _getCacheName($name)
    {
        $this->cache_path = rtrim($this->cache_path, '/\\') . DIRECTORY_SEPARATOR;
        file_exists($this->cache_path) || mkdir($this->cache_path, 0755, true);
        return $this->cache_path . $name;
    }
}
