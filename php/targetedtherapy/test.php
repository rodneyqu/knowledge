<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
//require_once('../publicfunc/Database_Connect.php');

require('../publicfunc/sql_func.php');

/*

$sql="select ct.NCTID,tt.ClinicalTrialID,ttm.MolProfileName,tt.CreateDate,tt.LatestUpdateDate,tt.ClinicalTrialID,tt.TargetTreatmentID,tt.EvidenceType,tt.ResponseType,d.DiseaseName_cn,ttt.TherapyName from TargetTreatment as tt 
join TargetTreatmentIndication as tti
on tt.TargetTreatmentID = tti.TargetTreatmentID
join Disease as d
on tti.DiseaseID = d.DiseaseID
join TargetTreatmentMolProfile as ttm
on tt.TargetTreatmentID = ttm.TargetTreatmentID
join TargetTreatmentTherapy as ttt
on tt.TargetTreatmentID = ttt.TargetTreatmentID
join ClinicalTrial as ct
on ct.ClinicalTrialID = tt.ClinicalTrialID";


$results=$mysql_link->multi_query($sql);
print_r($results);
*/
//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();

$sql ='SELECT * FROM Employee limit 10;';
$arr=array('LastName','FirstName','Email','Password');
$test=$mysql_obj->multi_query($sql);
print_r($test);
?>
