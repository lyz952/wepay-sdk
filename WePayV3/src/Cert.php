<?php

namespace Lyz\WePayV3;

use Lyz\WePayV3\Contracts\BasicWePay;
use Lyz\WePayV3\Contracts\DecryptAes;
use Lyz\WePayV3\Exceptions\InvalidResponseException;

/**
 * 平台证书管理
 * Class Cert
 * @package Lyz\WePayV3
 */
class Cert extends BasicWePay
{
    /**
     * 商户平台下载证书
     * @return void
     * @throws \Lyz\WePayV3\Exceptions\InvalidResponseException
     */
    public function download()
    {
        try {
            // decryptToString 证书解密
            $aes = new DecryptAes($this->mchKey);
            $result = $this->doGet('/v3/certificates');
            /*
                200 OK
                {
                    "data": [
                        {
                            "serial_no": "5157F09EFDC096DE15EBE81A47057A7232F1B8E1",
                            "effective_time ": "2018-06-08T10:34:56+08:00",
                            "expire_time ": "2018-12-08T10:34:56+08:00",
                            "encrypt_certificate": {
                                "algorithm": "AEAD_AES_256_GCM",
                                "nonce": "61f9c719728a",
                                "associated_data": "certificate",
                                "ciphertext": "sRvt… "
                            }
                        },
                        {
                            "serial_no": "50062CE505775F070CAB06E697F1BBD1AD4F4D87",
                            "effective_time ": "2018-12-07T10:34:56+08:00",
                            "expire_time ": "2020-12-07T10:34:56+08:00",
                            "encrypt_certificate": {
                                "algorithm":"AEAD_AES_256_GCM",
                                "nonce":"35f9c719727b",
                                "associated_data": "certificate",
                                "ciphertext": "aBvt… "
                            }
                        }
                    ]
                }
            */
            foreach ($result['data'] as $vo) {
                $this->fileCache(
                    $vo['serial_no'],
                    $aes->decryptToString(
                        $vo['encrypt_certificate']['associated_data'],
                        $vo['encrypt_certificate']['nonce'],
                        $vo['encrypt_certificate']['ciphertext']
                    )
                );
            }
        } catch (\Exception $exception) {
            throw new InvalidResponseException($exception->getMessage(), $exception->getCode());
        }
    }
}
