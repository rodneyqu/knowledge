<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../publicfunc/sql_func.php');



//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();
$ChemtreaTmentID='';
$VariantID='';
$Genotype='';
$DiseaseID='';
$DrugID='';

$ChemtreaTmentID=$_POST['ChemtreaTmentID'];
$VariantID=$_POST['VariantID'];
$Genotype=$_POST['Genotype'];
$DiseaseID=$_POST['DiseaseID'];
$DrugID=$_POST['DrugID'];

if(empty($VariantID) || empty($Genotype) || empty($DiseaseID) || empty($DrugID)){
	return false;
}else{
	updateChemotherapyModal($ChemtreaTmentID,$VariantID,$Genotype,$DiseaseID,$DrugID);

}

function updateChemotherapyModal($ChemtreaTmentID,$VariantID,$Genotype,$DiseaseID,$DrugID){
	global $mysql_obj;
	$where['ChemtreaTmentID'] = $ChemtreaTmentID;

	$data['VariantID'] = $VariantID;
	$data['Genotype'] = $Genotype;
	$data['DiseaseID'] = $DiseaseID;
	$data['DrugID'] = $DrugID;
	$data['LatestUpdateDate'] = date("Y-m-d");

	$result_all = $mysql_obj->updateq("ChemTreatment",$data,$where);
	echo json_encode($result_all);
}

?>