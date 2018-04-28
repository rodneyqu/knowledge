<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../publicfunc/sql_func.php');



//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();

$ClinicalTrialID='';

$EvidenceType='';
$NCTID=$_POST['ClinicalTrialID'];
$ResponseType=$_POST['ResponseType'];
$EvidenceType=$_POST['EvidenceType'];
$DiseaseID=$_POST['DiseaseID'];

$TherapyName=$_POST['TherapyName'];


if(empty($ClinicalTrialID) || empty($ResponseType) || empty($EvidenceType) ){
	return false;
}else{
	addTargetedTheraypy($ClinicalTrialID,$ResponseType,$EvidenceType,$DiseaseID,$TherapyName);
}








// 添加单个新的靶向治疗
function addTargetedTheraypy($ClinicalTrialID,$ResponseType,$DiseaseID,$TherapyName){
	global $mysql_obj;
	$time=date("Y-m-d",time());
	$CreateDate=$time;
	$LatestUpdateDate=$time;

	$data=array('ClinicalTrialID'=>$ClinicalTrialID,
		'ResponseType'=>$ResponseType,
		'EvidenceType'=>$EvidenceType,
		'DiseaseID'=>$DiseaseID,
		'CreateDate'=>$CreateDate,
		'TherapyName'=>$TherapyName,
		'LatestUpdateDate'=>$LatestUpdateDate);
	
	$request=$mysql_obj->insertq("TargetTreatment",$data);
	echo json_encode($request);
}



?>
