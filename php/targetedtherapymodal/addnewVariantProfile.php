<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../publicfunc/sql_func.php');



//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();

$MolProfileName='';



$MolProfileName=$_POST['MolProfileName'];



if(empty($MolProfileName)  ){
	return false;
}else{
	addMolProfile($MolProfileName);
}








// 添加单个新的分子普
function addMolProfile($MolProfileName){
	global $mysql_obj;
	$time=date("Y-m-d",time());
	$CreateDate=$time;
	$LatestUpdateDate=$time;

	$data=array('MolProfileName'=>$MolProfileName,'CreateDate'=>$CreateDate,'LatestUpdateDate'=>$LatestUpdateDate);
	
	$request=$mysql_obj->insertq("TargetTreatmentMolProfile",$data);
	echo json_encode($request);
}



?>
