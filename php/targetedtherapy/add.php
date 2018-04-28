<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../publicfunc/sql_func.php');



//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();

$TherapyName='';



$ClinicalTrialID=$_POST['ClinicalTrialID'];
$DiseaseID=$_POST['DiseaseID'];
$ResponseType=$_POST['ResponseType'];
$EvidenceType=$_POST['EvidenceType'];
$TargetTreatmentTherapyID=$_POST['TargetTreatmentTherapyID'];
$TargetTreatmentMolProfileID=$_POST['TargetTreatmentMolProfileID'];




if(empty($ClinicalTrialID)  ){
	return false;
}else{
	addTargetTreatment($ClinicalTrialID,$DiseaseID,$ResponseType,$EvidenceType,$TargetTreatmentTherapyID,$TargetTreatmentMolProfileID);
}








// 添加新的靶向治疗方法
function addTargetTreatment($ClinicalTrialID,$DiseaseID,$ResponseType,$EvidenceType,$TargetTreatmentTherapyID,$TargetTreatmentMolProfileID){
	global $mysql_obj;
	$time=date("Y-m-d",time());
	$CreateDate=$time;
	$LatestUpdateDate=$time;

	$data=array('ClinicalTrialID'=>$ClinicalTrialID,
		'ResponseType'=>$ResponseType,
		'EvidenceType'=>$EvidenceType,
		'CreateDate'=>$CreateDate,
		'LatestUpdateDate'=>$LatestUpdateDate);
	
	$request=$mysql_obj->insertq("TargetTreatment",$data);
	$sql='select last_insert_id();';
	$TargetTreatmentArr=$mysql_obj->querySql($sql);
	
	$TargetTreatmentID=$TargetTreatmentArr[0]['last_insert_id()'];
	
	//$TargetTreatmentIndicationData=array('TargetTreatmentID'=>$TargetTreatmentID,'DiseaseID'=>$DiseaseID,'CreateDate'=>$CreateDate,'LatestUpdateDate'=>$LatestUpdateDate);
	//$request=$mysql_obj->insertq("TargetTreatmentIndication",$TargetTreatmentIndicationData);
	$sql="insert into TargetTreatmentIndication (TargetTreatmentID,DiseaseID,CreateDate,LatestUpdateDate)
	 values(".$TargetTreatmentID.",".$DiseaseID.",'".$CreateDate."','".$LatestUpdateDate."')";
	// echo $sql;die();
	 $mysql_obj->querySql($sql);
	$TargetTreatmentTherapyData=array('TargetTreatmentID'=>$TargetTreatmentID,'LatestUpdateDate'=>$LatestUpdateDate);
	$where['TargetTreatmentTherapyID'] = $TargetTreatmentTherapyID;


	$request=$mysql_obj->updateq("TargetTreatmentTherapy",$TargetTreatmentTherapyData,$where);

	$TargetTreatmentMolProfileData=array('TargetTreatmentID'=>$TargetTreatmentID,'LatestUpdateDate'=>$LatestUpdateDate);
	unset($where);
	$where['TargetTreatmentMolProfileID'] = $TargetTreatmentMolProfileID;

	
	$request=$mysql_obj->updateq("TargetTreatmentMolProfile",$TargetTreatmentMolProfileData,$where);


	echo json_encode($request);
}



?>
