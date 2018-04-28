<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../publicfunc/sql_func.php');



//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();

$TargetTreatmentTherapyID='';
$DrugID='';


$TargetTreatmentTherapyID=$_POST['TargetTreatmentTherapyID'];
$DrugID=$_POST['DrugID'];

if(empty($TargetTreatmentTherapyID) || empty($DrugID) ){
	return false;
}else{
	addTherapy($TargetTreatmentTherapyID,$DrugID);
}








// 添加新的靶向治疗方法
function addTherapy($TargetTreatmentTherapyID,$DrugID){
	global $mysql_obj;
	$time=date("Y-m-d",time());
	$CreateDate=$time;
	$LatestUpdateDate=$time;

	$data=array('TargetTreatmentTherapyID'=>$TargetTreatmentTherapyID,
		'DrugID'=>$DrugID,'CreateDate'=>$CreateDate,'LatestUpdateDate'=>$LatestUpdateDate);
	
	$request=$mysql_obj->insertq("TargetTreatmentTherapyDrug",$data);
	/*
	$sql='select last_insert_id();';
	$TargetTreatmentArr=$mysql_obj->querySql($sql);
	$TargetTreatmentID=$TargetTreatmentArr[0]['last_insert_id()'];
	
	$data['TargetTreatmentID']=$TargetTreatmentID;
	$where['TargetTreatmentTherapyID']=$TargetTreatmentTherapyID;
	$request=$mysql_obj->updateq("TargetTreatmentTherapy",$data,$where);
	*/
	echo json_encode($request);
}



?>
