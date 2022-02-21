<?php
namespace Pctco\Coding\CryptoJS;
/** 
 ** cryptoJS AES
 *? @date 22/02/16 13:07
 *  @author http://github.com/bymagnum/cryptoJS_php
 */
class AES{
    /** 
     ** 加密
     *? @date 22/02/16 12:53
     *  @param String $data 想要加密的数据
     *  @param String $passphrase 加密密钥
     *! @return String
     */
    public static function encrypt($data, $passphrase, $salt = null) {
        $salt = $salt ?: openssl_random_pseudo_bytes(8);
        list($key, $iv) = self::evpkdf($passphrase, $salt);
        $ct = openssl_encrypt($data, 'aes-256-cbc', $key, true, $iv);
        return self::encode($ct, $salt);
    }
    /** 
     ** 解密
     *? @date 22/02/16 12:53
     *  @param String $base64 想要解密的数据
     *  @param String $passphrase 解密密钥
     *! @return 
     */
    public static function decrypt($base64, $passphrase) {
        list($ct, $salt) = self::decode($base64);
        list($key, $iv) = self::evpkdf($passphrase, $salt);
        $data = openssl_decrypt($ct, 'aes-256-cbc', $key, true, $iv);
        return $data;
    }		
    
    public static function evpkdf($passphrase, $salt) {
        $salted = '';
        $dx = '';
        while (strlen($salted) < 48) {
            $dx = md5($dx . $passphrase . $salt, true);
            $salted .= $dx;
        }
        $key = substr($salted, 0, 32);
        $iv = substr($salted, 32, 16);
        return [$key, $iv];
    }		
    
    public static function decode($base64) {
        $data = base64_decode($base64);
        if (substr($data, 0, 8) !== "Salted__") {
            return;
        }
        $salt = substr($data, 8, 8);
        $ct = substr($data, 16);
        return [$ct, $salt];
    }

    public static function encode($ct, $salt) {
        return base64_encode("Salted__" . $salt . $ct);
    }
}
