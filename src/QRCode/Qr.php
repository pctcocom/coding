<?php
namespace Pctco\Coding\QRCode;
use think\facade\Config;
class Qr{
	private $initialize;
   function __construct(){
      $this->initialize = Config::get('initialize');
		return $this->initialize['resources']['path']['root'];
   }
	/**
	* @name Qr::production();
	* @describe 获取或生成二维码
	* @param mixed 	$url			URL网址
	* @param mixed 	ecc = 'L'	获取二维码ECC级别(错误处理级别)
	*										L (水平) 7%的字码可被修正
	* 										M (水平) 15%的字码可被修正
	* 										Q (水平) 25%的字码可被修正
	* 										H (水平) 30%的字码可被修正
	* @param mixed 	$size = 6	二维码大小设置(每个黑点的像素)
	* @param mixed 	$border = 1	白边宽度(图片外围的白色边框像素)
	* @return String
	**/
	public function production($url,$ecc = 'L',$size = 6,$border = 1){
		$path =
		$this->initialize['resources']['path']['root'].'runtime'.DIRECTORY_SEPARATOR.'composer'.DIRECTORY_SEPARATOR.'pctco'.DIRECTORY_SEPARATOR.'coding'.DIRECTORY_SEPARATOR.'QRCode'.DIRECTORY_SEPARATOR;
		/*------------------------------------------------
		**	配置
		------------------------------------------------*/
		// 生成的PHP Images PNG文件 存放处
		$temp =
		$this->initialize['resources']['path']['root'].
		$this->initialize['resources']['path']['uploads'].
		DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR.'barcode'.DIRECTORY_SEPARATOR;

		// 缓存存储目录
		$cache = $path.'cache'.DIRECTORY_SEPARATOR;
		// 缓存存储目录
		$log = $path.'log'.DIRECTORY_SEPARATOR;


		// use cache - more disk reads but less CPU power, masks and format templates are stored there (是否开启缓存)
		define('QR_CACHEABLE', true);
		// used when QR_CACHEABLE === true (缓存存储目录)
		define('QR_CACHE_DIR',$cache);
		// default error logs dir   (错误日志存储)
		define('QR_LOG_DIR',$log);
		// if true, estimates best mask (spec. default, but extremally slow; set to false to significant performance boost but (propably) worst quality code
		define('QR_FIND_BEST_MASK', true);
		// if false, checks all masks available, otherwise value tells count of masks need to be checked, mask id are got randomly
		define('QR_FIND_FROM_RANDOM', false);
		// when QR_FIND_BEST_MASK === false
		define('QR_DEFAULT_MASK', 2);
		// maximum allowed png image width (in pixels), tune to make sure GD and PHP can handle such big images
		define('QR_PNG_MAXIMUM_SIZE',  1024);



		//Html PNG 位置的前缀(路径)
		include "qrlib.php";

		// 创建目录，如果目录不存在的话 就创建一个
		if(!file_exists($temp)){
			mkdir($temp,0777,true);
		}
		if(!file_exists($cache)){
			mkdir($cache,0777,true);
		}
		if(!file_exists($log)){
			mkdir($log,0777,true);
		}
		$qrcode = new \qrcode;
		$fileName = md5($url.'|'.$ecc.'|'.$size).'.png';
		$rootPath = $temp.$fileName;
      $qrcode->png($url,$rootPath,$ecc,$size,$border);

		// 基准(benchmark)
		// $qrtools = new \qrtools;
		// $qrtools->timeBenchmark();

		return $fileName;

	}

	/**
	* @name reader
	* @describe 识别二维码内容
	* @param mixed 	$qr	二维码图片路径
	* @return String
	**/
	public function reader($qr){
		include(dirname(__FILE__).DIRECTORY_SEPARATOR.'reader/QrReader.php');
		$qrcode = new \QrReader($qr);
		return $qrcode->text();
	}

}
