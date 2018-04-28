<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../publicfunc/sql_func.php');



//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();











$TargetTreatmentIDArr=$_POST['TargetTreatmentID'];
$TargetTreatmentID=implode(',',$TargetTreatmentIDArr);
delTargetTreatment($TargetTreatmentID);











// 添加新的靶向治疗方法
function delTargetTreatment($TargetTreatmentID){
	global $mysql_obj;
	$time=date("Y-m-d",time());
	$LatestUpdateDate=$time;



	$sql ='update TargetTreatmentTherapy set TargetTreatmentID =null ,LatestUpdateDate="'.$LatestUpdateDate.'"  where TargetTreatmentID in ('.$TargetTreatmentID.'); ';	
	$mysql_obj->delSql($sql);
	


	

	$sql ='update TargetTreatmentMolProfile set TargetTreatmentID =null ,LatestUpdateDate="'.$LatestUpdateDate.'"  where TargetTreatmentID in ('.$TargetTreatmentID.'); ';	
	$mysql_obj->delSql($sql);


	$sql='delete from TargetTreatmentIndication where TargetTreatmentID in ('.$TargetTreatmentID.'); ';
	
	$mysql_obj->delSql($sql);

	$sql='delete from TargetTreatment where TargetTreatmentID in ('.$TargetTreatmentID.'); ';
	
	$result_all=$mysql_obj->delSql($sql);

	
	



	

	
	//print_r($sql).PHP_EOL;
	
	//die();
	//$mysql_obj->multi_query($sql);

	echo json_encode($result_all);
}



?>
