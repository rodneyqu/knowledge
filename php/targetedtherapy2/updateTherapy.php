<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../publicfunc/sql_func.php');



//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();
$TargetTreatmentTherapyDrugID='';
$DrugID='';


$TargetTreatmentTherapyDrugID=$_POST['TargetTreatmentTherapyDrugID'];
$DrugID=$_POST['DrugID'];


if(empty($TargetTreatmentTherapyDrugID) || empty($DrugID) ){
	return false;
}else{
	updateTherapy($TargetTreatmentTherapyDrugID,$DrugID);

}
//更新治疗药物
function updateTherapy($TargetTreatmentTherapyDrugID,$DrugID){
	global $mysql_obj;
	$where['TargetTreatmentTherapyDrugID'] = $TargetTreatmentTherapyDrugID;
	$data['DrugID'] = $DrugID;
	
	$data['LatestUpdateDate'] = date("Y-m-d");
	/*
	$result_all = $mysql_obj->selectq("TargetTreatmentTherapyDrug",array('TargetTreatmentTherapyID'),array('DrugID'=>$DrugID));

	if(count($result_all)>0){
		echo json_encode('wrong');
		die();
	}
	*/
	$result_all = $mysql_obj->updateq("TargetTreatmentTherapyDrug",$data,$where);
	echo json_encode($result_all);
}

?>