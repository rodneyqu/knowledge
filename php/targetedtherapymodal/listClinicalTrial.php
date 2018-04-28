<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../publicfunc/sql_func.php');



//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();
$page=$_POST['page']; //当前页
$page=(empty($page))?'1':$page;
$count=$_POST['count'];
$count=(empty($count))?'10':$count;// 每页多少条数据 // 2个数据库 // 以后最好融合成1个库 减少查询db 次数 增加性能
$count=$count;
getList($page,$count);

function getList($page,$count){
	global $mysql_obj;
	$start=($page-1)*$count;
	$sql="select `ClinicalTrialID`, `NCTID`,`Title`,`Phase`,`Status`,`CreateDate`,`LatestUpdateDate` from ClinicalTrial limit ".$start.",". $count;
	$results=$mysql_obj->querySql($sql);

	$sqlTotal="select count(ClinicalTrialID) as total from ClinicalTrial";
	$total=$mysql_obj->querySql($sqlTotal);
	
	$arr=array();
	$arr['list']=$results;
	$arr['total']=$total['0']['total'];

	echo json_encode($arr);
}

?>