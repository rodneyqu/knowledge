<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../publicfunc/sql_func.php');



//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();

$TherapyName=$_POST['TherapyName'];
getTargetedTherapy($TherapyName);


function getTargetedTherapy($TherapyName){
	global $mysql_obj;
	
	$limit=20;
	
	

	
	$sql="SELECT TargetTreatmentTherapyID,TherapyName FROM TargetTreatmentTherapy where TherapyName like '%".addslashes($TherapyName)."%' and TargetTreatmentID is null limit ".$limit.";";

	$result_all=$mysql_obj->querySql($sql);
	
	echo json_encode($result_all);
}

?>