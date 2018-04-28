<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../publicfunc/sql_func.php');



//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();
$TargetTreatmentTherapyID='';



$TargetTreatmentTherapyID=$_POST['TargetTreatmentTherapyID'];

if(empty($TargetTreatmentTherapyID) ){
	return false;
}else{
	editTargetedTherapy2($TargetTreatmentTherapyID);

}

function editTargetedTherapy2($TargetTreatmentTherapyID){
	global $mysql_obj;
	$where['TargetTreatmentTherapyID'] = $TargetTreatmentTherapyID;

	
	
	$data['LatestUpdateDate'] = date("Y-m-d");

	$result_all = $mysql_obj->selectq("TargetTreatmentTherapy",
		array("TargetTreatmentTherapyID",
		"TherapyName",
		"CreateDate",
		"LatestUpdateDate"),$where);

	
	echo json_encode($result_all);
}

?>