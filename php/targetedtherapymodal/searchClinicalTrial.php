<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../publicfunc/sql_func.php');



//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();

$NCTID='';
$Title='';
$Phase='';
$Status='';

$NCTID=$_POST['NCTID'];
$Title=$_POST['Title'];
$Phase=$_POST['Phase'];
$Status=$_POST['Status'];



$searchArr['NCTID']=$NCTID;
$searchArr['Title']=$Title;
$searchArr['Phase']=$Phase;
$searchArr['Status']=$Status;


search($searchArr);

function search($searchArr=array()){
	global $mysql_obj;
	$page=$_POST['page']; //当前页
	$page=(empty($page))?'1':$page;
	$count=$_POST['count'];
	$count=(empty($count))?'10':$count;// 每页多少条数据 // 2个数据库 // 以后最好融合成1个库 减少查询db 次数 增加性能
	$count=$count;
	$start=($page-1)*$count;
	$i=0;
	foreach($searchArr as $key=>$value){
		if($value!='' ){

			if($i>0){
				$whereSql .= ' or '.$key.' like "%'. $value.'%"';
			}else{
				$whereSql .= $key.' like "%'. $value.'%"';
			}
			$i++;	
		}
	}
	
	$sql="select `ClinicalTrialID`, `NCTID`,`Title`,`Phase`,`Status`,`CreateDate`,`LatestUpdateDate` from ClinicalTrial  where " .$whereSql. " limit ".$start." , ".$count;

	$results=$mysql_obj->querySql($sql);
	$arr=array();
	$arr['list']=$results;

	$totalSql="select count(ClinicalTrialID) as total from ClinicalTrial where " .$whereSql;
	$total=$mysql_obj->querySql($totalSql);
	$arr['total']=$total['0']['total'];
	echo json_encode($arr);

}


?>
