<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../publicfunc/sql_func.php');



//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();
$page=$_POST['page']; //当前页
$page=(empty($page))?'1':$page;
$count=$_POST['count'];
$count=(empty($count))?'10':$count;// 每页多少条数据 // 2个数据库 // 以后最好融合成1个库 减少查询db 次数 增加性能
$count=$count;

$ClinicalTrialID='';
$ClinicalTrialID=$_POST['ClinicalTrialID'];


getClinicalTrialList($page,$count,$ClinicalTrialID);

function getClinicalTrialList($page,$count,$ClinicalTrialID){
	global $mysql_obj;
	

	$start=($page-1)*$count;
	
	
		$whereSql=' where tt.ClinicalTrialID = '.$ClinicalTrialID;
	
	$sql="select ct.NCTID,tt.ClinicalTrialID,ttm.MolProfileName,tt.CreateDate,tt.LatestUpdateDate,tt.ClinicalTrialID,tt.TargetTreatmentID,tt.EvidenceType,tt.ResponseType,d.DiseaseName_cn,ttt.TherapyName from TargetTreatment as tt 
join TargetTreatmentIndication as tti
on tt.TargetTreatmentID = tti.TargetTreatmentID
join Disease as d
on tti.DiseaseID = d.DiseaseID
join TargetTreatmentMolProfile as ttm
on tt.TargetTreatmentID = ttm.TargetTreatmentID
join TargetTreatmentTherapy as ttt
on tt.TargetTreatmentID = ttt.TargetTreatmentID
join ClinicalTrial as ct
on ct.ClinicalTrialID = tt.ClinicalTrialID
 ".$whereSql." limit ".$start.",". $count;
	$results=$mysql_obj->querySql($sql);

	$sqlTotal="select count(tt.TargetTreatmentID) as total from TargetTreatment as tt 
join TargetTreatmentIndication as tti
on tt.TargetTreatmentID = tti.TargetTreatmentID
join Disease as d
on tti.DiseaseID = d.DiseaseID
join TargetTreatmentMolProfile as ttm
on tt.TargetTreatmentID = ttm.TargetTreatmentID
join TargetTreatmentTherapy as ttt
on tt.TargetTreatmentID = ttt.TargetTreatmentID
join ClinicalTrial as ct
on ct.ClinicalTrialID = tt.ClinicalTrialID
".$whereSql;
	$total=$mysql_obj->querySql($sqlTotal);
	
	$arr=array();
	$arr['list']=$results;
	$arr['total']=$total['0']['total'];

	echo json_encode($arr);
}

?>