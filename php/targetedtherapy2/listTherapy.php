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

$TargetTreatmentTherapyID=$_POST['TargetTreatmentTherapyID'];
getList($page,$count,$TargetTreatmentTherapyID);

function getList($page,$count,$TargetTreatmentTherapyID){
	global $mysql_obj;
	$start=($page-1)*$count;
	$whereSql=' where t.TargetTreatmentTherapyID ='.$TargetTreatmentTherapyID.' limit '.$start.' , '.$count;
	

	$sql="select t.TargetTreatmentID ,ttd.DrugID,d.DrugName_cn, d.DrugName_en,group_concat(dc.DrugClassName_en)
	as DrugClassName_en,ttd.TargetTreatmentTherapyDrugID,ttd.CreateDate,ttd.LatestUpdateDate
FROM TargetTreatmentTherapy as t
join TargetTreatmentTherapyDrug as ttd
on t.TargetTreatmentTherapyID = ttd.TargetTreatmentTherapyID
join Drug as d
on d.DrugID =ttd.DrugID
join Drug_DrugClass as ddc
on ttd.DrugID =  ddc.DrugID
join DrugClass as dc
on ddc.DrugClassID= dc.DrugClassID".$whereSql;

	$results=$mysql_obj->querySql($sql);
	$sqlTotal="select count(DISTINCT t.TargetTreatmentID) as total
FROM TargetTreatmentTherapy as t
join TargetTreatmentTherapyDrug as ttd
on t.TargetTreatmentTherapyID = ttd.TargetTreatmentTherapyID
join Drug as d
on d.DrugID =ttd.DrugID
join Drug_DrugClass as ddc
on ttd.DrugID =  ddc.DrugID
join DrugClass as dc
on ddc.DrugClassID= dc.DrugClassID".$whereSql;

	$total=$mysql_obj->querySql($sqlTotal);
	
	$arr=array();

	$arr['list']=$results;
	if($total){
		$arr['total']=$total['0']['total'];
	}else{
		$arr['total']=0;
	}
	echo json_encode($arr);
}

?>