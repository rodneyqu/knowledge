<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../publicfunc/sql_func.php');



//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();

$TherapyName='';



$TherapyName=$_POST['TherapyName'];

if(empty($TherapyName)  ){
	return false;
}else{
	addTargetedTherapy($TherapyName);
}








// 添加新的靶向治疗方法
function addTargetedTherapy($TherapyName){
	global $mysql_obj;
	$time=date("Y-m-d",time());
	$CreateDate=$time;
	$LatestUpdateDate=$time;

	$data=array('TherapyName'=>$TherapyName,'CreateDate'=>$CreateDate,'LatestUpdateDate'=>$LatestUpdateDate);
	
	$request=$mysql_obj->insertq("TargetTreatmentTherapy",$data);
	echo json_encode($request);
}



?>
