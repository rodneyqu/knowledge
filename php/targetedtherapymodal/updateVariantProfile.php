<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../publicfunc/sql_func.php');



//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();
$MolProfileVariantsID='';
$VariantID='';


$MolProfileVariantsID=$_POST['MolProfileVariantsID'];
$VariantID=$_POST['VariantID'];

if(empty($MolProfileVariantsID) || empty($VariantID) ){
	return false;
}else{
	updateVariantProfile($MolProfileVariantsID,$VariantID);

}

function updateVariantProfile($MolProfileVariantsID,$VariantID){
	global $mysql_obj;
	$where['MolProfileVariantsID'] = $MolProfileVariantsID;

	$data['VariantID']=$VariantID;
	
	$data['LatestUpdateDate'] = date("Y-m-d");

	$result_all = $mysql_obj->selectq("MolProfileVariants",array('VariantID'),array('VariantID'=>$VariantID));

	if(count($result_all)>0){
		echo json_encode('wrong');
		die();
	}

	$result_all = $mysql_obj->updateq("MolProfileVariants",$data,$where);
	echo json_encode($result_all);
}

?>