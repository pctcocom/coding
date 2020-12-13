# coding

```
use Pctco\Coding\Skip32\Skip;

/**
* @name encrypt
* @describe 加密 传入需要加密的整数
* @param mixed $key  字符串  参考 rivate static function key arry key
* @param mixed $int  需要加密整数  最大数值 4294967295
* @return int
**/
Skip::en('member',1234);

/**
* @name decrypt
* @describe 解密 传入加密后的 字符串
* @param mixed $key  字符串  参考 rivate static function key arry key
* @param mixed $int  需要解密整数 最大数值 4294967295
* @return int
**/
Skip::de('member',1234);
```


```
use Pctco\Coding\RandomString;

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
RandomString::random(5,0);

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
RandomString::only(5,32,0);
```
