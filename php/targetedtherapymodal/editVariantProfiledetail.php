<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require_once('../publicfunc/sql_func.php');


//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();
$TargetTreatmentMolProfileID=$_POST['TargetTreatmentMolProfileID'];


editMolProfile($TargetTreatmentMolProfileID);

//变异型
function editMolProfile($TargetTreatmentMolProfileID){
	global $mysql_obj;
	$result_all = $mysql_obj->selectq("TargetTreatmentMolProfile",array("MolProfileName","CreateDate","LatestUpdateDate"),array("TargetTreatmentMolProfileID"=>$TargetTreatmentMolProfileID));

	echo json_encode($result_all);
}

?>