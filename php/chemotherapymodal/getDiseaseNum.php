<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require_once('../publicfunc/sql_func.php');



//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();
$DiseaseID=$_POST['DiseaseID'];
$DiseaseName_cn=$_POST['DiseaseName_cn'];

$limit=20;
getDiseaseNum($DiseaseID,$DiseaseName_cn,$limit);

//疾病编号
function getDiseaseNum($DiseaseID,$DiseaseName_cn,$limit){
	global $mysql_obj;
	if($DiseaseID){
	$result_all = $mysql_obj->selectq("Disease",array("DiseaseID","DiseaseName_cn"),array("DiseaseIDLIKE"=>$DiseaseID),$limit);
	}
	if($DiseaseName_cn){
	$result_all = $mysql_obj->selectq("Disease",array("DiseaseID","DiseaseName_cn"),array("DiseaseName_cnLIKE"=>$DiseaseName_cn),$limit);
	}

	echo json_encode($result_all);
}

?>