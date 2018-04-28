<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../publicfunc/sql_func.php');



//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();
$TargetTreatmentTherapyID='';
$TherapyName='';


$TargetTreatmentTherapyID=$_POST['TargetTreatmentTherapyID'];
$TherapyName=$_POST['TherapyName'];


if(empty($TargetTreatmentTherapyID) || empty($TherapyName) ){
	return false;
}else{
	updateTargetedTherapy2($TargetTreatmentTherapyID,$TherapyName);

}
//更新治疗方法名字
function updateTargetedTherapy2($TargetTreatmentTherapyID,$TherapyName){
	global $mysql_obj;
	$where['TargetTreatmentTherapyID'] = $TargetTreatmentTherapyID;

	$data['TherapyName'] = $TherapyName;
	
	$data['LatestUpdateDate'] = date("Y-m-d");

	$result_all = $mysql_obj->selectq("TargetTreatmentTherapy",array('TargetTreatmentTherapyID'),array('TherapyName'=>$TherapyName));

	if(count($result_all)>0){
		echo json_encode('wrong');
		die();
	}

	$result_all = $mysql_obj->updateq("TargetTreatmentTherapy",$data,$where);
	echo json_encode($result_all);
}

?>