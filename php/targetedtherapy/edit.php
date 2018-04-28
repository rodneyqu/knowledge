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


editTargetedTherapyDetail($TargetTreatmentID);

function editTargetedTherapyDetail($TargetTreatmentID){
	global $mysql_obj;

	
	$whereSql=' where tt.TargetTreatmentID='.$TargetTreatmentID;
	
	$sql="select ct.NCTID,ttm.TargetTreatmentMolProfileID,ttt.TargetTreatmentTherapyID,d.DiseaseID,ttm.MolProfileName,tt.CreateDate,tt.LatestUpdateDate,tt.ClinicalTrialID,tt.TargetTreatmentID,tt.EvidenceType,tt.ResponseType,d.DiseaseName_cn,ttt.TherapyName from TargetTreatment as tt 
join TargetTreatmentIndication as tti
on tt.TargetTreatmentID = tti.TargetTreatmentID
join Disease as d
on tti.DiseaseID = d.DiseaseID
join TargetTreatmentMolProfile as ttm
on tt.TargetTreatmentID = ttm.TargetTreatmentID
join TargetTreatmentTherapy as ttt
on tt.TargetTreatmentID = ttt.TargetTreatmentID
join ClinicalTrial as ct
on ct.ClinicalTrialID = tt.ClinicalTrialID
 ".$whereSql;
	$results=$mysql_obj->querySql($sql);

	
	
	$arr=array();
	$arr['list']=$results;
	
	echo json_encode($arr);
}

?>