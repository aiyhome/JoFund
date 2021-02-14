//基金实时信息

接口1：
    //天天基金接口 当日净值估算不准
    /**
    数据格式:
    {
    "fundcode":"161725",//基金代码
    "name":"招商中证白酒指数(LOF)",//基金名称
    "jzrq":"2021-02-09",//上一个结算日期
    "dwjz":"1.5439",//上一个结算日期的单位净值
    "gsz":"1.6183",//盘中实时净值估算
    "gszzl":"4.82",//日增长率
    "gztime":"2021-02-10 15:00"//最后更新日期
    }
     */


接口2：
    //同花顺旗下爱基金接口
    /**
    数据格式:
    {
    "code":"161725",//基金代码
    "enddate":"2021-02-10",//最后更新日期
    "type":"nohbx",
    "net":"1.6198",//当日单位净值
    "totalnet":"3.2509",//累计净值
    "ranges":"0.2883",//增长值
    "rate":"4.92",//当日增长率
    "net1":"1.5439",//上一个结算日期的单位净值
    "totalnet1":"3.1750",//上一个结算日期增长率
    "enddate1":"2021-02-09",//上一个结算日期
    "mark":"ths",
    "updatetime":"210211020645",
    "hqcode":"161725",
    "name":"招商中证白酒指数",
    "fundtype":"股票型",
    "clrq":"2015-05-27",//成立时间
    "manager":"侯昊",//基金经理
    "orgname":"招商基金管理有限公司",
    "dqlcqx":"-1",
    "dqrq":"",
    "sgstat":"开放",//申购状态
    "shstat":"开放",//赎回状态
    "money":"",
    "sgoldfl":"1",
    "sgfl":"0.1",
    "rgStart":"0001-01-01",
    "rgEnd":"0001-01-01",
    "rcsgStart":"2015-06-05",
    "rcshStart":"2015-06-05",
    "ifnew":0,
    "rgfl":"0.1",
    "rgflold":"1",
    "buy":"1",
    "dt":"1",
    "zkl":"0.1",
    "zdsg":"100",
    "nowyear":"13.54",//今年以来的涨幅
    "week":"9.17",//近1周涨幅
    "month":"5.96",//近1月涨幅
    "tmonth":"37.93",//近3月涨幅
    "year":"167.77",//近1年涨幅
    "hyear":"81.80",//近6月涨幅
    "tyear":"272.47",//近3年涨幅
    "mz":"1.0000",
    "themeList":[//行业标签
    {
    "field_name":"白酒",
    "field_type":"行业",
    "id":"fd9d5b0118d05cddb279d66f915053fa"
    },
    {
    "field_name":"饮料制造",
    "field_type":"行业",
    "id":"5702fbc5c952d50856d9b1b2702c7bc3"
    }],
    "thsqbfl":"0.00",
    "jjgm":"340.16",
    "levelOfRiskCode":"706003",
    "levelOfRisk":"中风险",
    "ifzj":"1",
    "ifgz":"1",
    "iszcg":"0",
    "iszcz":"0",
    "isfof":"0",
    "asset":"568.47",//基金规模
    "fundBanner":[],
    "showType":"1",
    "fastcash":"1",
    "dqlc":0,
    "lcqx":"--",
    "maxStar":"",
    "nowtime":1613111073000
    }
     */

接口3：
    /**
    数据格式：
    {
    "FCODE": "161725", //基金代码
    "SHORTNAME": "招商中证白酒指数(LOF)",//基金名称
    "FTYPE": "股票指数",
    "FEATURE": "020,050,051,054",
    "BFUNDTYPE": "001",
    "FUNDTYPE": "001",
    "RZDF": "4.92",//日增长率
    "DWJZ": "1.6198",//当日单位净值
    "LJJZ": "3.2509",//累计净值
    "SGZT": "开放申购",
    "SHZT": "开放赎回",
    "SOURCERATE": "1.00%",
    "RATE": "0.10%",
    "MINSG": "100",
    "MAXSG": "100000000000",
    "SUBSCRIBETIME": "--",
    "RISKLEVEL": "5",
    "ISBUY": "1",
    "BAGTYPE": "0",
    "CASHBUY": "1",
    "SALETOCASH": "1",
    "STKTOCASH": "1",
    "STKEXCHG": "1",
    "FUNDEXCHG": "1",
    "BUY": true,
    "ISSALES": "1",
    "SALEMARK": "",
    "MINDT": "100",
    "DTZT": "1",
    "REALSGCODE": "--",
    "QDTCODE": "--",
    "BACKCODE": "--",
    "ESTABDATE": "2015-05-27",
    "INDEXCODE": "399997",
    "INDEXNAME": "中证白酒指数",
    "INDEXTEXCH": "2",
    "NEWINDEXTEXCH": "0",
    "RLEVEL_SZ": "--",
    "SHARP1": "3.2746",
    "SHARP2": "2.4777",
    "SHARP3": "1.5569",
    "MAXRETRA1": "18.25",
    "STDDEV1": "30.8058",
    "STDDEV2": "29.479",
    "STDDEV3": "30.6804",
    "SSBCFMDATA": "1",
    "SSBCFDAY": "2021-02-19",
    "CURRENTDAYMARK": "今日",
    "BUYMARK": "--",
    "JJGS": "招商基金",
    "JJGSID": "80036782",
    "TSRQ": "--",
    "TTYPENAME": "",
    "TTYPE": "",
    "FundSubjectURL": "",
    "FBKINDEXCODE": "BK0896",
    "FBKINDEXNAME": "白酒",
    "FSRQ": "2021-02-10",
    "ISSBDATE": "2015-05-12 00:00:00",
    "RGBEGIN": "--",
    "ISSEDATE": "2015-05-22 15:00:00",
    "RGEND": "--",
    "LISTTEXCH": "2",
    "NEWTEXCH": "0",
    "ISLIST": "1",
    "ISLISTTRADE": "1",
    "MINSBSG": "100",
    "MINSBRG": "1000",
    "ENDNAV": "56847417653.17",
    "FEGMRQ": "2021-01-08",
    "ISFNEW": "0",
    "ISAPPOINT": "0",
    "MINRG": "1000",
    "CYCLE": "--",
    "OPESTART": "--",
    "OPEEND": "--",
    "OPEYIELD": "--",
    "FIXINCOME": "--",
    "APPOINTMENT": "",
    "APPOINTMENTURL": "",
    "ISABNORMAL": "0",
    "YZBA": "7个交易日左右",
    "FBYZQ": "一般3个月内",
    "KFSGSH": "基金公司公告为准",
    "LINKZSB": "1",
    "LISTTEXCHMARK": "SZ",
    "ISHAREBONUS": false,
    "PTDT_Y": "84.56",
    "PTDT_TWY": "127.49",
    "PTDT_TRY": "178.67",
    "PTDT_FY": "284.46",
    "MBDT_Y": "77.5",
    "MBDT_TWY": "68.74",
    "MBDT_TRY": "60.7",
    "MBDT_FY": "98.09",
    "YDDT_Y": "53.58",
    "YDDT_TWY": "60.71",
    "YDDT_TRY": "75.19",
    "YDDT_FY": "114.09",
    "DWDT_Y": "54.11",
    "DWDT_TWY": "60.42",
    "DWDT_TRY": "74.14",
    "DWDT_FY": "115.34",
    "ISYYDT": "0",
    "SYL_Z": "9.17",
    "SYRQ": "2021-02-10",
    "COMETHOD": "--",
    "MCOVERDATE": "--",
    "MCOVERDETAIL": "--",
    "COMMENTS": '产品特色：布局白酒领域的指数基金，历史业绩优秀，外资偏爱白酒板块。',
    "TRKERROR": "0.1637",
    "ESTDIFF": "0.0519",
    "HRGRT": '0.80%',
    "HSGRT": '0.10%',
    "BENCH": "中证白酒指数收益率×95%+金融机构人民币活期存款基准利率(税后)×5%',
    "FINSALES": "0",
    }
     */


//基金详细信息

/**
数据格式:
{
"ishb": "false",
"fS_name": "招商中证白酒指数(LOF)", //基金或股票信息
"fS_code": "161725", //基金代码
"fund_sourceRate" = "1.00"; //原费率
"fund_Rate": "0.10"; //现费率
"fund_minsg": "100"; //最小申购金额
"stockCodes": [], //基金持仓股票代码
"zqCodes": "0196401", //基金持仓债券代码
"stockCodesNew": [], //基金持仓股票代码（新市场号）
"zqCodesNew": "1.019640", //基金持仓债券代码（新市场号）
"syl_1n": "167.77", //近一年收益率
"syl_6y": "81.8", //近六月收益率
"syl_3y": "37.92", //近三月收益率
"syl_1y": "5.96", //近一月收益率
"Data_fundSharesPositions": [], //股票仓位测算图
"Data_netWorthTrend": [], // 累计净值走势
"Data_grandTotal": [], //累计收益率走势
"Data_rateInSimilarType": [], //同类排名走势
"Data_rateInSimilarPersent": [], //同类排名百分比
"Data_fluctuationScale": {}, //规模变动 mom-较上期环比
"Data_holderStructure": {
"series": [{}, //持有人结构
"Data_assetAllocation": {}, //资产配置
"Data_performanceEvaluation": {
}, //业绩评价 ['选股能力', '收益率', '抗风险', '稳定性','择时能力']
"Data_currentFundManager": [], //现任基金经理
"Data_buySedemption": {
"series": [],
"categories": []
}, //申购赎回
swithSameType = [], //同类型基金涨幅榜（页面底部通栏）
}
 */