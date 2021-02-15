<?php
// 获取净值估算图
// $_REQUEST['code'] = '005968';
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
// 天天基金 当日净值估算图
$url1 = sprintf('http://j4.dfcfw.com/charts/pic6/%s.png?v=%s', $fundCode, $timestamp);
// 新浪基金 近期走势图
$url2 = sprintf('https://image.sinajs.cn/newchart/v5/fund/nav/ss/%s.gif?v=%s', $fundCode, $timestamp);
// 爱基金 详情页面
// $detailUrl = sprintf('https://fund.10jqka.com.cn/public/ifundout/dist/detail.html#/%s', $fundCode);
// 天天基金 详情页面
$detailUrl = sprintf('https://h5.1234567.com.cn/app/fund-details/?fCode=%s', $fundCode);

echo json_encode(array(
	'code' => 0,
	'msg' => 'success',
	'data' => array(
		'current' => $url1,
		'history' => $url2,
		'detail' => $detailUrl,
	),
));