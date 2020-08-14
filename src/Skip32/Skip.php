<?php
namespace Pctco\Coding;
use Pctco\Coding\Skip32;
use Pctco\Coding\Skip32Cipher;
class Skip{
   /**
   * @name key
   * @describe 加密和解密字符串
   * @param mixed $key array key   key只能又 0123456789abcdef0123 组成
   * @return string
   **/
   private static function key($key){
      $array = [
         'member'   =>   '01a2b3c456d78e9f0123',
         'jurisdiction'   =>   '012345a67b8cd9e0f123'
      ];
      return $array[$key];
   }
   /**
   * @name encrypt
   * @describe 加密 传入需要加密的整数
   * @param mixed $key  字符串  参考 rivate static function key arry key
   * @param mixed $int  需要加密整数  最大数值 4294967295
   * @return int
   **/
   public static function en($key,$int){
      $key = self::key($key);
      return Skip32::encrypt($key,$int);
   }
   /**
   * @name decrypt
   * @describe 解密 传入加密后的 字符串
   * @param mixed $key  字符串  参考 rivate static function key arry key
   * @param mixed $int  需要解密整数 最大数值 4294967295
   * @return int
   **/
   public static function de($key,$int){
      $key = self::key($key);
      return Skip32::decrypt($key,$int);
   }

}