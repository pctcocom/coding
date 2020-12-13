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
