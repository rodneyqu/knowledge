<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../publicfunc/sql_func.php');



//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();
$ClinicalTrialID='';
$NCTID='';
$Title='';
$Phase='';
$Status='';

$ClinicalTrialID=$_POST['ClinicalTrialID'];
$NCTID=$_POST['NCTID'];
$Title=$_POST['Title'];
$Phase=$_POST['Phase'];
$Status=$_POST['Status'];

if(empty($ClinicalTrialID) || empty($NCTID) || empty($Title) || empty($Phase) || empty($Status)){
	return false;
}else{
	updateClinicalTrial($ClinicalTrialID,$NCTID,$Title,$Phase,$Status);

}

function updateClinicalTrial($ClinicalTrialID,$NCTID,$Title,$Phase,$Status){
	global $mysql_obj;
	$where['ClinicalTrialID'] = $ClinicalTrialID;

	$data['NCTID'] = $NCTID;
	$data['Title'] = $Title;
	$data['Phase'] = $Phase;
	$data['Status'] = $Status;
	$data['LatestUpdateDate'] = date("Y-m-d");

	$result_all = $mysql_obj->updateq("ClinicalTrial",$data,$where);
	echo json_encode($result_all);
}

?>