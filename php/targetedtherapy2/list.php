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
$TherapyName='';
$startDay='';
$overDay='';
$TherapyName=$_POST['TherapyName'];
$startDay=$_POST['startDay'];
$overDay=$_POST['overDay'];


getList($page,$count,$TherapyName,$startDay,$overDay);

function getList($page,$count,$TherapyName,$startDay,$overDay){
	global $mysql_obj;
	$searchArr['TherapyName']=$TherapyName;
	$searchArr['startDay']=$startDay;
	$searchArr['overDay']=$overDay;
	$start=($page-1)*$count;
	foreach($searchArr as $key=>$value){
		if($value!='' ){

			if($i>0){
				if($key=='startDay'){
					$whereSql .= ' or '.$key.' >= "'. $value.'"';
				}elseif($key=='overDay'){
					$whereSql .= ' or '.$key.' <= "'. $value.'"';
				}else{
					$whereSql .= ' or '.$key.' like "%'. $value.'%"';
				}
			}else{
				if($key=='startDay'){
					$whereSql .= $key.' >= "'. $value.'"';
				}elseif($key=='overDay'){
					$whereSql .= $key.' <= "'. $value.'"';
				}else{
					$whereSql .= $key.' like "%'. $value.'%"';
				}
			}
			$i++;	
		}
	}
	if($whereSql){
		$whereSql=' where '.$whereSql;
	}
	$sql="select `TargetTreatmentTherapyID`,`TherapyName`,`CreateDate`,`LatestUpdateDate` from TargetTreatmentTherapy ".$whereSql." limit ".$start.",". $count;
	$results=$mysql_obj->querySql($sql);

	$sqlTotal="select count(TargetTreatmentTherapyID) as total from TargetTreatmentTherapy".$whereSql;
	$total=$mysql_obj->querySql($sqlTotal);
	
	$arr=array();
	$arr['list']=$results;
	$arr['total']=$total['0']['total'];

	echo json_encode($arr);
}

?>