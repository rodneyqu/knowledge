<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../publicfunc/sql_func.php');



//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();




$TargetTreatmentID='';

$TargetTreatmentID=$_POST['TargetTreatmentID'];
$ClinicalTrialID=$_POST['ClinicalTrialID'];
$DiseaseID=$_POST['DiseaseID'];
$ResponseType=$_POST['ResponseType'];
$EvidenceType=$_POST['EvidenceType'];
$TargetTreatmentTherapyID=$_POST['TargetTreatmentTherapyID'];
$TargetTreatmentMolProfileID=$_POST['TargetTreatmentMolProfileID'];




if(empty($TargetTreatmentID) ||  empty($DiseaseID) || empty($ResponseType) || empty($EvidenceType) || empty($TargetTreatmentTherapyID) || empty($TargetTreatmentMolProfileID) ){
	return false;
}else{
	updateTargetTreatment($TargetTreatmentID,$DiseaseID,$ResponseType,$EvidenceType,$TargetTreatmentTherapyID,$TargetTreatmentMolProfileID);
}








// 添加新的靶向治疗方法
function updateTargetTreatment($TargetTreatmentID,$DiseaseID,$ResponseType,$EvidenceType,$TargetTreatmentTherapyID,$TargetTreatmentMolProfileID){
	global $mysql_obj;
	$time=date("Y-m-d",time());
	$CreateDate=$time;
	$LatestUpdateDate=$time;

	$data=array(
		'ResponseType'=>$ResponseType,
		'EvidenceType'=>$EvidenceType,
		'LatestUpdateDate'=>$LatestUpdateDate);
	$where['TargetTreatmentID']=$TargetTreatmentID;
	
	$request=$mysql_obj->updateq('TargetTreatment',$data,$where);


	
	
	$TargetTreatmentIndicationData=array('TargetTreatmentID'=>$TargetTreatmentID,'DiseaseID'=>$DiseaseID,'CreateDate'=>$CreateDate,'LatestUpdateDate'=>$LatestUpdateDate);


	
	unset($data);
	$data['DiseaseID']=$DiseaseID;
	$data['LatestUpdateDate']=$LatestUpdateDate;


	$request=$mysql_obj->updateq('TargetTreatmentIndication',$data,$where);
	unset($where);
	unset($data);



	$sql ='update TargetTreatmentTherapy set TargetTreatmentID =null ,LatestUpdateDate="'.$LatestUpdateDate.'"  where TargetTreatmentID='.$TargetTreatmentID.';';
	
	$mysql_obj->querySql($sql);
	
	$sql ='update TargetTreatmentTherapy set TargetTreatmentID ='.$TargetTreatmentID.' ,LatestUpdateDate="'.$LatestUpdateDate.'" where TargetTreatmentTherapyID='.$TargetTreatmentTherapyID.';';
	$mysql_obj->querySql($sql);

	

	$sql ='update TargetTreatmentMolProfile set TargetTreatmentID =null ,LatestUpdateDate="'.$LatestUpdateDate.'"  where TargetTreatmentID='.$TargetTreatmentID.';';
	$mysql_obj->querySql($sql);

	$sql ='update TargetTreatmentMolProfile set TargetTreatmentID ='.$TargetTreatmentID.' ,LatestUpdateDate="'.$LatestUpdateDate.'" where TargetTreatmentMolProfileID='.$TargetTreatmentMolProfileID.';';
	$mysql_obj->querySql($sql);

	//print_r($sql).PHP_EOL;
	
	//die();
	//$mysql_obj->multi_query($sql);

	echo json_encode($request);
}



?>
