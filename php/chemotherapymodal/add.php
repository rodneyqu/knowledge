<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../publicfunc/sql_func.php');



//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();

$VariantID='';
$Genotype='';
$DiseaseID='';
$DrugID='';

$VariantID=$_POST['VariantID'];
$Genotype=$_POST['Genotype'];
$DiseaseID=$_POST['DiseaseID'];
$DrugID=$_POST['DrugID'];


if(empty($VariantID) || empty($Genotype) || empty($DiseaseID) || empty($DrugID)){
	return false;
}else{
	addNewChemicalTherapy($VariantID,$Genotype,$DiseaseID,$DrugID);
}








// 添加单个新的化学药物治疗
function addNewChemicalTherapy($VariantID,$Genotype,$DiseaseID,$DrugID){
	global $mysql_obj;
	$time=date("Y-m-d",time());
	$CreateDate=$time;
	$LatestUpdateDate=$time;

	$data=array('VariantID'=>$VariantID,'Genotype'=>$Genotype,'DiseaseID'=>$DiseaseID,'DrugID'=>$DrugID,'CreateDate'=>$CreateDate,'LatestUpdateDate'=>$LatestUpdateDate);
	
	$request=$mysql_obj->insertq("ChemTreatment",$data);
	echo json_encode($request);
}



?>
