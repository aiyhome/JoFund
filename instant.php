<?php

//基金实时信息
include_once __DIR__ . '/util/HttpUtils.php';
include_once __DIR__ . '/util/Utils.php';

if (!isset($_REQUEST['code'])) {
	echo json_encode(array(
		'code' => 2,
		'msg' => 'missing parameter',
	));
	return;
}
$apiType = 3;
if (isset($_REQUEST['apitype'])) {
	$apiType = intval($_REQUEST['apitype']);
}

$fundCode = $_REQUEST['code'];
if (1 == $apiType) {

	$timestamp = date("Ymdhis");
	$url = sprintf('http://fundgz.1234567.com.cn/js/%s.js?v=%s', $fundCode, $timestamp);
	$refer = 'fund.eastmoney.com';
	$params = null;
	$ret = HttpUtils::post($url, $params, $refer);
	$data = Utils::jsonpDecode($ret);
	if (NULL == $data) {
		echo json_encode(array(
			'code' => 1,
			'msg' => 'data is empty!',
			'data' => [],
		));
		return;
	}
	echo json_encode(array(
		'code' => 0,
		'msg' => 'success',
		'data' => $data,
	));
	return;
} elseif (2 == $apiType) {
	// 单位净值详情： http://fund.10jqka.com.cn/161725/json/jsondwjz.json
	// 累计净值详情： http://fund.10jqka.com.cn/%s/json/jsonljjz.json

	$url = sprintf('http://fund.10jqka.com.cn/data/client/myfund/%s', $fundCode);
	$refer = 'fund.10jqka.com.cn';
	$params = null;
	$ret = HttpUtils::post($url, $params, $refer);
	$data = json_decode($ret);
	echo json_encode(array(
		'code' => $data->error->id,
		'msg' => $data->error->msg,
		'data' => isset($data->data[0]) ? $data->data[0] : [],
	));
	return;
} else {
	$isMutilCode = false;
	if (strpos($fundCode, ',') !== false) {
		$isMutilCode = true;
	}
	$deviceId = md5(uniqid());
	$host = 'https://fundmobapi.eastmoney.com';
	// $deviceId = '656c09923c567b89bb44801020bc59ab';
	$url = $host . '/FundMNewApi/FundMNNBasicInformation';
	if ($isMutilCode == false) {
		$params = array(
			'version' => '6.2',
			'plat' => 'Android',
			'appType' => 'ttjj',
			'FCODE' => $fundCode,
			'onFundCache' => 3,
			'keeeeeyparam' => 'FCODE',
			'deviceid' => $deviceId . '%7C%7Ciemi_tluafed_me',
			'igggggnoreburst' => true,
			'product' => 'EFund',
			'MobileKey' => $deviceId . '%7C%7Ciemi_tluafed_me',
		);
		$ret = HttpUtils::post($url, $params);
		// var_dump($ret);
		$data = json_decode($ret);
		if ($data->Datas != NULL) {
			echo json_encode(array(
				'code' => 0,
				'msg' => 'success',
				'data' => $data->Datas,
			));
		} else {
			echo json_encode(array(
				'code' => $data->ErrCode,
				'msg' => $data->ErrMsg ?? 'data is empty!',
				'data' => [],
			));
		}
		return;
	} else {
		$url = $host . '/FundMNewApi/FundMNFInfo';
		$params = array(
			'pageIndex' => 1,
			'pageSize' => 999,
			'appType' => 'ttjj',
			'product' => 'EFund',
			'plat' => 'Android',
			'deviceid' => $deviceId,
			'Version' => 1,
			'Fcodes' => $fundCode, //逗号分隔
		);
		$ret = HttpUtils::post($url, $params);
		$data = json_decode($ret);
		// var_dump($data);
		if ($data->Datas != NULL) {
			echo json_encode(array(
				'code' => 0,
				'msg' => 'success',
				'data' => $data->Datas,
			));
		} else {
			echo json_encode(array(
				'code' => $data->ErrCode,
				'msg' => $data->ErrMsg ?? 'data is empty!',
				'data' => [],
			));
		}
		return;
	}
}
