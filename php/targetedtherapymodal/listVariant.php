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
$TargetTreatmentMolProfileID=$_POST['TargetTreatmentMolProfileID'];


getList($page,$count,$TargetTreatmentMolProfileID);

function getList($page,$count,$TargetTreatmentMolProfileID){
	global $mysql_obj;
	$start=($page-1)*$count;
	$sql="select mv.MolProfileVariantsID,g.Symbol,v.HGVSc,v.HGVSp , p.`MolProfileName`,p.`CreateDate`,p.`LatestUpdateDate` 
from TargetTreatmentMolProfile as p
join MolProfileVariants as mv
on p.TargetTreatmentMolProfileID = mv.TargetTreatmentMolProfileID
join Variant as v
on v.VariantID=mv.VariantID
join Transcript as t
on t.TranscriptID = v.TranscriptID
join Gene as g
on g.GeneID=t.GeneID
where p.TargetTreatmentMolProfileID=".$TargetTreatmentMolProfileID." limit ".$start.",". $count;
	$results=$mysql_obj->querySql($sql);

	$sqlTotal="
select count(*) as total
from TargetTreatmentMolProfile as p
join MolProfileVariants as mv
on p.TargetTreatmentMolProfileID = mv.TargetTreatmentMolProfileID
join Variant as v
on v.VariantID=mv.VariantID
join Transcript as t
on t.TranscriptID = v.TranscriptID
join Gene as g
on g.GeneID=t.GeneID
where p.TargetTreatmentMolProfileID=".$TargetTreatmentMolProfileID;
	$total=$mysql_obj->querySql($sqlTotal);
	
	$arr=array();
	$arr['list']=$results;
	$arr['total']=$total['0']['total'];

	echo json_encode($arr);
}

?>