<?php
// 获取净值估算图
$_REQUEST['code'] = '005968';
if (!isset($_REQUEST['code'])) {
	echo json_encode(array(
		'code' => 2,
		'msg' => 'missing parameter',
	));
	return;
}
$apiType = 1;
if (isset($_REQUEST['api_type'])) {
	$apiType = int($_REQUEST['api_type']);
}

$fundCode = $_REQUEST['code'];
$timestamp = date("Ymdhis");
// 当日净值估算图
$url1 = sprintf('http://j4.dfcfw.com/charts/pic6/%s.png?v=%s', $fundCode, $timestamp);
// 近期走势图
$url2 = sprintf('https://image.sinajs.cn/newchart/v5/fund/nav/ss/%s.gif?v=%s', $fundCode, $timestamp);
echo json_encode(array(
	'code' => 0,
	'msg' => 'success',
	'data' => array(
		'current' => $url1,
		'history' => $url2,
	),
));