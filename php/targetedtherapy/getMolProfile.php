<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../publicfunc/sql_func.php');



//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();

$MolProfileName=$_POST['MolProfileName'];
getMolProfile($MolProfileName);


function getMolProfile($MolProfileName){
	global $mysql_obj;

	$limit=20;
	


	$sql="SELECT TargetTreatmentMolProfileID,MolProfileName FROM TargetTreatmentMolProfile where MolProfileName like '%".addslashes($MolProfileName)."%' and TargetTreatmentID is null limit ".$limit.";";

	$result_all=$mysql_obj->querySql($sql);
	
	echo json_encode($result_all);
}
?>