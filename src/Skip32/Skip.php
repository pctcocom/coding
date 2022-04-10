<?php
namespace Pctco\Coding\Skip32;
use Pctco\Coding\Skip32\Skip32;
use Pctco\Coding\Skip32\Skip32Cipher;
use think\facade\Config;
class Skip{
   /** 
    ** 目前 Skip 最大值是加密到  4294967295  （已解决现在可以无限加密）
    */
   private static $MaxNumber = 4294967295;
   /** 
    ** 目前最大值  4294967295 的填充
    */
   private static $MaxNumberLength = '0000000000';
   /**
   * @name encrypt
   * @describe 加密 传入需要加密的整数
   * @param mixed $key  字符串  参考 rivate static function key arry key
   * @param mixed $int  需要加密整数
   * @return int
   **/
   private static function key($key){
      $array = Config::get('initialize.safety.skip');
      return $array[$key];
   }
   public static function en($key,$int){
      $key = self::key($key);

      // 溢出（无法在进行加密计算时启动）：当遇到超大值时选择填补机制
      $multiple = (int)$int/self::$MaxNumber;
      if ($multiple > 1) {
         // 获取倍数
         $multiple = (int)ceil($multiple);

         // 假设想要加密的数字是：4294967295*20 + 10;  $e = e20;
         $e = '00000'.(string)($multiple - 1).'00000';

         // 溢出：10
         $overflow = self::$MaxNumber - abs(self::$MaxNumber*$multiple - $int);
         // 加密溢出
         $env = Skip32::encrypt($key,$overflow);
         
         // 填充0：如果加密后不到10个数字,则填充到10个数字
         $env = substr_replace(self::$MaxNumberLength,$env,-strlen($env));

         return $e.$env;
      }else{
         return Skip32::encrypt($key,$int);
      }
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

      // 溢出超过值 4294967295 处理
      if (strlen($int) > 10) {
         // EN Number
         $en = substr($int,-10);
         // 溢出的倍数
         $overflow = substr($int,5,-15);
         return $overflow*self::$MaxNumber + Skip32::decrypt($key,$en);
      }else{
         return Skip32::decrypt($key,$int);
      }
   }

}
