<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../publicfunc/sql_func.php');



//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();
$ClinicalTrialIDArr=$_POST['ClinicalTrialID'];
$ClinicalTrialID=implode(',',$ClinicalTrialIDArr);
	delList($ClinicalTrialID);


function delList($ClinicalTrialID){
	global $mysql_obj;
	
	$sql='delete from ClinicalTrial where ClinicalTrialID in ('.$ClinicalTrialID.'); ';
	
	$result_all = $mysql_obj->delSql($sql);
	echo json_encode($result_all);
}

?>