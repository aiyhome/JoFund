
<?php

//基金详细信息
include_once __DIR__ . '/util/HttpUtils.php';
include_once __DIR__ . '/util/Utils.php';

$_REQUEST['code'] = '161725';
if (!isset($_REQUEST['code'])) {
	echo json_encode(array(
		'code' => 2,
		'msg' => 'missing parameter',
	));
	return;
}
$apiType = 1;
if (isset($_REQUEST['apitype'])) {
	$apiType = int($_REQUEST['apitype']);
}

$fundCode = $_REQUEST['code'];

$timestamp = date("Ymdhis");
$url = sprintf('http://fund.eastmoney.com/pingzhongdata/%s.js?v=%s', $fundCode, $timestamp);
$refer = 'fund.eastmoney.com';
$ret = HttpUtils::post($url, null, $refer);
$data = Utils::parseJsVariable($ret);

$keys = array(
	/*股票仓位测算图*/
	'Data_fundSharesPositions',
	/*单位净值走势 equityReturn-净值回报 unitMoney-每份派送金*/
	// 'Data_netWorthTrend',
	/*累计净值走势*/
	// 'Data_ACWorthTrend',
	/*同类排名走势*/
	'Data_rateInSimilarType',
	/*同类排名百分比*/
	'Data_rateInSimilarPersent',
	/*累计收益率走势*/
	'Data_grandTotal',
);
foreach ($keys as $k) {
	unset($data[$k]);
}
// var_dump($data);
echo json_encode(array(
	'code' => 0,
	'msg' => 'success',
	'data' => $data,
));