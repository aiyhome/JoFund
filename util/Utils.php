<?php
/**
 *
 */
class Utils {

	/**
	 * 移动端判断
	 */
	public static function isMobile() {
		// 如果有HTTP_X_WAP_PROFILE则一定是移动设备
		if (isset($_SERVER['HTTP_X_WAP_PROFILE'])) {
			return true;
		}
		// 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
		if (isset($_SERVER['HTTP_VIA'])) {
			// 找不到为flase,否则为true
			return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
		}
		// 枚举遍历判断手机发送的客户端标志,兼容性有待提高
		if (isset($_SERVER['HTTP_USER_AGENT'])) {
			$clientkeywords = array('nokia',
				'sony',
				'ericsson',
				'mot',
				'samsung',
				'htc',
				'sgh',
				'lg',
				'sharp',
				'sie-',
				'philips',
				'panasonic',
				'alcatel',
				'lenovo',
				'iphone',
				'ipod',
				'blackberry',
				'meizu',
				'android',
				'netfront',
				'symbian',
				'ucweb',
				'windowsce',
				'palm',
				'operamini',
				'operamobi',
				'openwave',
				'nexusone',
				'cldc',
				'midp',
				'wap',
				'mobile',
				'ipad',
			);
			// 从HTTP_USER_AGENT中查找手机浏览器的关键字
			if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
				return true;
			}
		}
		// 协议法，因为有可能不准确，放到最后判断
		if (isset($_SERVER['HTTP_ACCEPT'])) {
			// 如果只支持wml并且不支持html那一定是移动设备
			// 如果支持wml和html但是wml在html之前则是移动设备
			if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
				return true;
			}
		}
		return false;
	}

	/**
	 * 判断当前协议是否为HTTPS
	 */
	public static function isHttps() {
		if (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off') {
			return true;
		} elseif (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
			return true;
		} elseif (!empty($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off') {
			return true;
		}
		return false;
	}

	/**
	 *  获取根地址
	 */
	public static function getRootUrl() {
		return (self::isHttps() ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . ':' . $_SERVER["SERVER_PORT"];
	}

	/**
	 * 把jsonp转为json
	 * @param string $jsonp jsonp字符串
	 * @return string
	 */
	public static function jsonpToJson($jsonp) {
		$jsonp = trim($jsonp);
		if (isset($jsonp[0]) && $jsonp[0] !== '[' && $jsonp[0] !== '{') {
			$begin = strpos($jsonp, '(');
			if (false !== $begin) {
				$end = strrpos($jsonp, ')');
				if (false !== $end) {
					$jsonp = substr($jsonp, $begin + 1, $end - $begin - 1);
				}
			}
		}
		return $jsonp;
	}

	/**
	 * 把jsonp转为php数组
	 * @param string $jsonp jsonp字符串
	 * @param boolean $assoc 当该参数为true时，将返回array而非object(std class)
	 * @return array
	 */
	public static function jsonpDecode($jsonp, $assoc = false) {
		$json = self::jsonpToJson($jsonp);
		return json_decode($json, $assoc);
	}

	public static function parseJsVariable($string, $value_decode = false) {
		$pregString = "/(var )?([a-zA-Z_0-9]+)(\['([a-zA-Z_0-9]+)'\])?\s*=\s*([^;]*);/";
		preg_match_all($pregString, $string, $matchs);
		$num = count($matchs['0']);
		$jsVarArray = array();
		// var_dump($matchs);
		for ($i = 0; $i < $num; $i++) {
			$v = $matchs['5'][$i];
			if (array_key_exists($v, $jsVarArray)) //为迭代赋值
			{
				$matchs['5'][$i] = $jsVarArray[$v];
				$v = $matchs['5'][$i];
			}
			if ($v == "{}" || $v == "[]") //定义数组
			{
				$matchs['5'][$i] = array();
				$v = $matchs['5'][$i];
			} else {
				if ($value_decode == true) {
					if (strpos($v, "'") !== false) {
						$v = str_replace("'", '"', $v);
					}
					$v = json_decode($v);
				}
			}
			$k = $matchs['2'][$i];
			if ($matchs['4'][$i]) //数组迭代
			{
				$jsVarArray[$k][$matchs['4'][$i]] = $v;
			} else {
				$jsVarArray[$k] = $v;
			}
		}
		return $jsVarArray;
	}
}