<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../publicfunc/sql_func.php');



//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();
$ChemtreaTmentID=$_POST['ChemtreaTmentID'];

getUpdateList($ChemtreaTmentID);

function getUpdateList($ChemtreaTmentID){
	global $mysql_obj;
	
	$sql="select b.ChemtreaTmentID,b.DrugName_cn,b.VariantID,b.DrugID,b.DiseaseName_cn,b.Genotype,b.LatestUpdateDate ,a.Symbol,a.HGVSp,b.DiseaseID
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
select  one.ChemtreaTmentID,drug.DrugName_cn,one.VariantID,one.DrugID,one.DiseaseName_cn,one.Genotype,one.LatestUpdateDate,one.DiseaseID
from Drug as drug
join (select disease.DiseaseName_cn ,chemtreatment.ChemtreaTmentID,chemtreatment.Genotype, chemtreatment.VariantID,chemtreatment.DrugID,chemtreatment.DiseaseID,
chemtreatment.LatestUpdateDate 
from ChemTreatment as chemtreatment
join Disease as disease 
on chemtreatment.DiseaseID = disease.DiseaseID) as one
on drug.DrugID= one.DrugID
) as b
on b.VariantID=a.VariantID where ChemtreaTmentID =".$ChemtreaTmentID;
	$results=$mysql_obj->querySql($sql);
	
	$arr=array();
	$arr['list']=$results;
	
	echo json_encode($arr);
}

?>