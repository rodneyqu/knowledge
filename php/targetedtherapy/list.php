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
$NCTID='';
$TherapyName='';
$MolProfileName='';
$DiseaseName_cn='';
$ResponseType='';
$EvidenceType='';
$NCTID=$_POST['NCTID'];
$TherapyName=$_POST['TherapyName'];
$MolProfileName=$_POST['MolProfileName'];
$DiseaseName_cn=$_POST['DiseaseName_cn'];
$ResponseType=$_POST['ResponseType'];
$EvidenceType=$_POST['EvidenceType'];

getList($page,$count,$NCTID,$TherapyName,$MolProfileName,$DiseaseName_cn,$ResponseType,$EvidenceType);

function getList($page,$count,$NCTID,$TherapyName,$MolProfileName,$DiseaseName_cn,$ResponseType,$EvidenceType){
	global $mysql_obj;
	$searchArr['ct.NCTID']=$NCTID;
	$searchArr['ttt.TherapyName']=$TherapyName;
	$searchArr['ttm.MolProfileName']=$MolProfileName;
	$searchArr['d.DiseaseName_cn']=$DiseaseName_cn;
	$searchArr['tt.ResponseType']=$ResponseType;
	$searchArr['tt.EvidenceType']=$EvidenceType;
	$start=($page-1)*$count;
	foreach($searchArr as $key=>$value){
		if($value!='' ){

			if($i>0){
				
					$whereSql .= ' or '.$key.' like "%'. $value.'%"';
				
			}else{
				
					$whereSql .= $key.' like "%'. $value.'%"';
				
			}
			$i++;	
		}
	}
	if($whereSql){
		$whereSql=' where '.$whereSql;
	}
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