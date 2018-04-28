<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../publicfunc/sql_func.php');



//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();
$TargetTreatmentMolProfileID='';
$MolProfileName='';
$Title='';


$TargetTreatmentMolProfileID=$_POST['TargetTreatmentMolProfileID'];
$MolProfileName=$_POST['MolProfileName'];

if(empty($TargetTreatmentMolProfileID) || empty($MolProfileName) ){
	return false;
}else{
	updateVariantProfile($TargetTreatmentMolProfileID,$MolProfileName);

}

function updateVariantProfile($TargetTreatmentMolProfileID,$MolProfileName){
	global $mysql_obj;
	$where['TargetTreatmentMolProfileID'] = $TargetTreatmentMolProfileID;

	$data['MolProfileName'] = $MolProfileName;
	
	
	$data['LatestUpdateDate'] = date("Y-m-d");


	$result_all = $mysql_obj->selectq("TargetTreatmentMolProfile",array('MolProfileName'),array('MolProfileName'=>$MolProfileName));

	if(count($result_all)>0){
		echo json_encode('wrong');
		die();
	}
	$result_all = $mysql_obj->updateq("TargetTreatmentMolProfile",$data,$where);
	echo json_encode($result_all);
}

?>