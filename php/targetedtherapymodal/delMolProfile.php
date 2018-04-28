<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../publicfunc/sql_func.php');



//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();
$TargetTreatmentMolProfileArr=$_POST['TargetTreatmentMolProfileID'];
$TargetTreatmentMolProfileID=implode(',',$TargetTreatmentMolProfileArr);
	delMolProfile($TargetTreatmentMolProfileID);


function delMolProfile($TargetTreatmentMolProfileID){
	global $mysql_obj;
	
	$sql='delete  a,b from
	TargetTreatmentMolProfile as a
	left join 
	MolProfileVariants as b
	on a.TargetTreatmentMolProfileID=b.TargetTreatmentMolProfileID
	where a.TargetTreatmentMolProfileID in ('.$TargetTreatmentMolProfileID.')';
	
	$result_all = $mysql_obj->delSql($sql);
	echo json_encode($result_all);
}

?>