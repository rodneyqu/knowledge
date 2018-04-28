<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../publicfunc/sql_func.php');



//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();

$NCTID='';
$Title='';
$Phase='';
$Status='';

$NCTID=$_POST['NCTID'];
$Title=$_POST['Title'];
$Phase=$_POST['Phase'];
$Status=$_POST['Status'];


if(empty($NCTID) || empty($Title) || empty($Phase) || empty($Status)){
	return false;
}else{
	addClinicalTrial($NCTID,$Title,$Phase,$Status);
}








// 添加单个新的临床试验
function addClinicalTrial($NCTID,$Title,$Phase,$Status){
	global $mysql_obj;
	$time=date("Y-m-d",time());
	$CreateDate=$time;
	$LatestUpdateDate=$time;

	$data=array('NCTID'=>$NCTID,'Title'=>$Title,'Phase'=>$Phase,'Status'=>$Status,'CreateDate'=>$CreateDate,'LatestUpdateDate'=>$LatestUpdateDate);
	
	$request=$mysql_obj->insertq("ClinicalTrial",$data);
	echo json_encode($request);
}



?>
