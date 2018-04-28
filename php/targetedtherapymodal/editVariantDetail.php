<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require_once('../publicfunc/sql_func.php');


//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();
$MolProfileVariantsID=$_POST['MolProfileVariantsID'];


editVariantDetailProfile($MolProfileVariantsID);

//变异型
function editVariantDetailProfile($MolProfileVariantsID){
	global $mysql_obj;
	$sql="select mv.VariantID,mv.MolProfileVariantsID,g.Symbol,v.HGVSc,v.HGVSp , p.`MolProfileName`,p.`CreateDate`,p.`LatestUpdateDate` 
from TargetTreatmentMolProfile as p
join MolProfileVariants as mv
on p.TargetTreatmentMolProfileID = mv.TargetTreatmentMolProfileID
join Variant as v
on v.VariantID=mv.VariantID
join Transcript as t
on t.TranscriptID = v.TranscriptID
join Gene as g
on g.GeneID=t.GeneID
where mv.MolProfileVariantsID=".$MolProfileVariantsID;
	$results=$mysql_obj->querySql($sql);
	
	$arr=array();
	$arr['list']=$results;
	echo json_encode($arr);
}

?>