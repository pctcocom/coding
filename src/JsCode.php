<?php
namespace Pctco\Coding;
use think\facade\Config;
class JsCode{
   /**
   * @name decode
   * @describe 解密代码  (结合 extend/coding.js 使用)
   * @param mixed $str 想要解密的字符串
   * @return string
   **/
   public static function decode($str){
      $staticchars = Config::get('initialize.code.js');
      $decodechars = "";
      for($i=1;$i<strlen($str);){
         $num0 = strpos($staticchars, $str[$i]);
         if($num0 !== false){
            $num1 = ($num0+59)%62;
            $code = $staticchars[$num1];
         }else{
            $code = $str[$i];
         }
         $decodechars .= $code;
         $i+=3;
      }
      return $decodechars;
   }
}
