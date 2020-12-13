<?php
namespace Pctco\Coding;
class RandomString{
   /**
   * @access 生成随机字符串
   * @param mixed    $length [生成的长度]
   * @param mixed    $type   [生成的类型]
                              -1 = 数字+大小写字母+特殊字符
                              0 = 数字+大写字母；
                              1 = 数字；
                              2 = 小写字母；
                              3 = 大写字母；
                              4 = 特殊字符；
   * @return string
   **/
   public static function random($length = 5, $type = 0){
      $arr = array(
         1 => "0123456789",
         2 => "abcdefghijklmnopqrstuvwxyz",
         3 => "ABCDEFGHIJKLMNOPQRSTUVWXYZ",
         4 => "~@#$%^&*(){}[]|"
      );
      if($type == 0) {
         array_pop($arr);
         $string = implode("",$arr);
      }else if($type == "-1") {
         $string = implode("",$arr);
      }else{
         $string = $arr[$type];
      }
      $count = strlen($string) - 1;
      $code = '';
      for($i = 0; $i < $length; $i++){
         $str[$i] = $string[rand(0, $count)];
         $code .= $str[$i];
      }
      return $code;
   }
   /**
   * @access 生成唯一字符串
   * @param mixed    $type   [字符串的类型]
                              0 = 存数字字符串；
                              1 = 小写字母字符串；
                              2 = 大写字母字符串；
                              3 = 大小写数字字符串；
                              4 = 字符；
                              5 = 数字，小写，大写，字符混合
   * @param mixed    $length [字符串的长度]
   * @param mixed    $time   [是否带时间 1 = 带，0 = 不带]
   * @return string
   **/
	public static function only($type = 0,$length = 18,$time=0){
		$str = $time == 0 ? '':date('YmdHis',time());
	    switch ($type) {
	        case 0:
	            for((int)$i = 0;$i <= $length;$i++){
	                if(mb_strlen($str) == $length){
	                    $str = $str;
	                }else{
	                    $str .= rand(0,9);
	                }
	            }
	            break;
	        case 1:
	            for((int)$i = 0;$i <= $length;$i++){
	                if(mb_strlen($str) == $length){
	                    $str = $str;
	                }else{
	                    $rand = "qwertyuioplkjhgfdsazxcvbnm";
	                    $str .= $rand{mt_rand(0,26)};
	                }
	            }
	            break;
	        case 2:
	            for((int)$i = 0;$i <= $length;$i++){
	                if(mb_strlen($str) == $length){
	                    $str = $str;
	                }else{
	                    $rand = "QWERTYUIOPLKJHGFDSAZXCVBNM";
	                    $str .= $rand{mt_rand(0,26)};
	                }
	            }
	            break;
	        case 3:
	            for((int)$i = 0;$i <= $length;$i++){
	                if(mb_strlen($str) == $length){
	                    $str = $str;
	                }else{
	                    $rand = "123456789qwertyuioplkjhgfdsazxcvbnmQWERTYUIOPLKJHGFDSAZXCVBNM";
	                    $str .= $rand{mt_rand(0,35)};
	                }
	            }
	            break;
	        case 4:
	            for((int)$i = 0;$i <= $length;$i++){
	                if(mb_strlen($str) == $length){
	                    $str = $str;
	                }else{
	                    $rand = "!@#$%^&*()_+=-~`";
	                    $str .= $rand{mt_rand(0,17)};
	                }
	            }
	            break;
	        case 5:
	            for((int)$i = 0;$i <= $length;$i++){
	                if(mb_strlen($str) == $length){
	                    $str = $str;
	                }else{
	                    $rand = "123456789qwertyuioplkjhgfdsazxcvbnmQWERTYUIOPLKJHGFDSAZXCVBNM!@#$%^&*()_+=-~`";
	                    $str .= $rand{mt_rand(0,52)};
	                }
	            }
	            break;
	    }
	    return $str;
	}
}
