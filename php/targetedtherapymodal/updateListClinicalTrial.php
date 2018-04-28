<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../publicfunc/sql_func.php');



//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();
$ClinicalTrialID=$_POST['ClinicalTrialID'];

getUpdateList($ClinicalTrialID);

function getUpdateList($ClinicalTrialID){
	global $mysql_obj;
	
	$sql="select ClinicalTrialID, NCTID,Title,Phase,Status,CreateDate,LatestUpdateDate from ClinicalTrial where ClinicalTrialID =".$ClinicalTrialID;
	$results=$mysql_obj->querySql($sql);
	
	$arr=array();
	$arr['list']=$results;
	
	echo json_encode($arr);
}

?>