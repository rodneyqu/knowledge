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
getList($page,$count);

function getList($page,$count){
	global $mysql_obj;
	$start=($page-1)*$count;
	$sql="select b.ChemtreaTmentID,b.DrugName_cn,b.VariantID,b.DrugID,b.DiseaseName_cn,b.Genotype,b.LatestUpdateDate ,a.Symbol,a.HGVSp
from 
(
select gene.GeneID,gene.Symbol,geneTranscript.HGVSp,geneTranscript.VariantID from
Gene as gene
join  
(select transcript.GeneID,variant.VariantID,variant.TranscriptID,variant.HGVSp from Variant as variant
join Transcript as transcript
on variant.TranscriptID=transcript.TranscriptID) as geneTranscript
on geneTranscript.GeneID = gene.GeneID
) as a
join 
(
select  one.ChemtreaTmentID,drug.DrugName_cn,one.VariantID,one.DrugID,one.DiseaseName_cn,one.Genotype,one.LatestUpdateDate
from Drug as drug
join (select disease.DiseaseName_cn ,chemtreatment.ChemtreaTmentID,chemtreatment.Genotype, chemtreatment.VariantID,chemtreatment.DrugID,chemtreatment.DiseaseID,
chemtreatment.LatestUpdateDate 
from ChemTreatment as chemtreatment
join Disease as disease 
on chemtreatment.DiseaseID = disease.DiseaseID) as one
on drug.DrugID= one.DrugID
) as b
on b.VariantID=a.VariantID limit ".$start.",". $count;
	$results=$mysql_obj->querySql($sql);

	$sqlTotal="select count(*) as total from ChemTreatment";
	$total=$mysql_obj->querySql($sqlTotal);
	
	$arr=array();
	$arr['list']=$results;
	$arr['total']=$total['0']['total'];

	echo json_encode($arr);
}

?>