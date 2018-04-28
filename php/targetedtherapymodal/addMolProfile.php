<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../publicfunc/sql_func.php');



//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();

$TargetTreatmentMolProfileID='';

$VariantID='';

$TargetTreatmentMolProfileID=$_POST['TargetTreatmentMolProfileID'];
$VariantID=$_POST['VariantID'];


if(empty($TargetTreatmentMolProfileID) || empty($VariantID) ){
	return false;
}else{
	addMolProfile($TargetTreatmentMolProfileID,$VariantID);
}








// 添加新的变异
function addMolProfile($TargetTreatmentMolProfileID,$VariantID){
	global $mysql_obj;
	$time=date("Y-m-d",time());
	$CreateDate=$time;
	$LatestUpdateDate=$time;

	$data=array('TargetTreatmentMolProfileID'=>$TargetTreatmentMolProfileID,'VariantID'=>$VariantID,'CreateDate'=>$CreateDate,'LatestUpdateDate'=>$LatestUpdateDate);
	
	$request=$mysql_obj->insertq("MolProfileVariants",$data);
	echo json_encode($request);
}



?>
