<?php
include_once __DIR__ . '/Utils.php';

class HttpUtils {
	const userAgentArray = array(
		'mobile' => array(
			// iOS 13.5.1 14.0 beta with safari
			'Mozilla/5.0 (iPhone; CPU iPhone OS 13_5_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.1.1 Mobile/15E148 Safari/604.1',
			'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.',
			// iOS with qq micromsg
			'Mozilla/5.0 (iPhone; CPU iPhone OS 13_5_1 like Mac OS X) AppleWebKit/602.1.50 (KHTML like Gecko) Mobile/14A456 QQ/6.5.7.408 V1_IPH_SQ_6.5.7_1_APP_A Pixel/750 Core/UIWebView NetType/4G Mem/103',
			'Mozilla/5.0 (iPhone; CPU iPhone OS 13_5_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 MicroMessenger/7.0.15(0x17000f27) NetType/WIFI Language/zh',
			// Android -> Huawei Xiaomi
			'Mozilla/5.0 (Linux; Android 9; PCT-AL10) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.64 HuaweiBrowser/10.0.3.311 Mobile Safari/537.36',
			'Mozilla/5.0 (Linux; U; Android 9; zh-cn; Redmi Note 8 Build/PKQ1.190616.001) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/71.0.3578.141 Mobile Safari/537.36 XiaoMi/MiuiBrowser/12.5.22',
			// Android + qq micromsg
			'Mozilla/5.0 (Linux; Android 10; YAL-AL00 Build/HUAWEIYAL-AL00; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/78.0.3904.62 XWEB/2581 MMWEBSDK/200801 Mobile Safari/537.36 MMWEBID/3027 MicroMessenger/7.0.18.1740(0x27001235) Process/toolsmp WeChat/arm64 NetType/WIFI Language/zh_CN ABI/arm64',
			'Mozilla/5.0 (Linux; U; Android 8.1.0; zh-cn; BKK-AL10 Build/HONORBKK-AL10) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/66.0.3359.126 MQQBrowser/10.6 Mobile Safari/537.36',
		),
		'pc' => array(
			// macOS 10.15.6  Firefox / Chrome / Safari
			'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:80.0) Gecko/20100101 Firefox/80.0',
			'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.30 Safari/537.36',
			'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_6) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.1.2 Safari/605.1.15',
			// Windows 10 Firefox / Chrome / Edge
			'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:80.0) Gecko/20100101 Firefox/80.0',
			'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.30 Safari/537.36',
			'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/13.10586',
		),
	);

	static private function getFakeUserAgent() {
		if (Utils::isMobile()) {
			return array_rand(self::userAgentArray['mobile']);
		}
		$data = self::userAgentArray['pc'];
		return $data[array_rand($data)];
	}

	static private function getFakeRequstIp() {
		$data = array(
			119.120 . '.' . rand(1, 255) . '.' . rand(1, 255),
			124.174 . '.' . rand(1, 255) . '.' . rand(1, 255),
			116.249 . '.' . rand(1, 255) . '.' . rand(1, 255),
			118.125 . '.' . rand(1, 255) . '.' . rand(1, 255),
			42.175 . '.' . rand(1, 255) . '.' . rand(1, 255),
			124.162 . '.' . rand(1, 255) . '.' . rand(1, 255),
			211.167 . '.' . rand(1, 255) . '.' . rand(1, 255),
			58.206 . '.' . rand(1, 255) . '.' . rand(1, 255),
			117.24 . '.' . rand(1, 255) . '.' . rand(1, 255),
			203.93 . '.' . rand(1, 255) . '.' . rand(1, 255),
		);
		//随机获取一个IP地址
		return 'https://' . $data[array_rand($data)] . ':80';
	}

	static private function buildQuery($query) {
		if (!$query) {
			return null;
		}
		//将要 参数 排序
		ksort($query);
		//重新组装参数
		$params = array();
		foreach ($query as $key => $value) {
			$params[] = $key . '=' . $value;
		}
		$data = implode('&', $params);
		return $data;
	}

	static public function fakeCurl($url, $params = null, $refer = null, $method_type = 'POST') {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		if (!is_null($refer)) {
			curl_setopt($ch, CURLOPT_REFERER, $refer);
		}

		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		//能保存cookie
		curl_setopt($ch, CURLOPT_COOKIESESSION, true);
		//伪造用户浏览器

		$userAgent = self::getFakeUserAgent();
		curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
		//伪造请求IP,可以为要请求的网站ip
		$ip = self::getFakeRequstIp();
		// curl_setopt($ch, CURLOPT_PROXY, $ip);
		//CURLOPT_RETURNTRANSFER 为true，它就将使用PHP curl获取页面内容或提交数据，作为变量储存，而不是直接输出。
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		//------------------------------------------
		$data_string = '';
		if ($params != null) {
			$data_string = self::buildQuery($params);
		}
		if ($method_type == 'POST') {
			//使用post方式请求
			curl_setopt($ch, CURLOPT_POST, 1);
			//用来支持cookie
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		} else {
			$url .= '?' . $data_string;
		}
		// print($url . "\n");
		//--------------------------------------------

		//设置要请求的url
		curl_setopt($ch, CURLOPT_URL, $url);
		//执行请求并获取放回数据
		$ret = curl_exec($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$curlErrorCode = curl_errno($ch);
		curl_close($ch);
		// echo $httpCode . ',' . $curlErrorCode . "\n";
		return $ret;
	}

	static public function post($url, $params = null, $refer = null) {
		return self::fakeCurl($url, $params, $refer, 'POST');
	}

	static public function get($url, $params = null, $refer = null) {
		return self::fakeCurl($url, $params, $refer, 'GET');
	}
}
