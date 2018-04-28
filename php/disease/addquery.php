<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../publicfunc/sql_func.php');
//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();


$DiseaseID = $_POST['DiseaseID'];
$DiseaseName_en=$_POST['DiseaseName_en'];
$DiseaseName_cn=$_POST['DiseaseName_cn'];

$a = !isset($DiseaseID);
$b = !isset($DiseaseName_en);
$c = !isset($DiseaseName_cn);
if(($a || ($DiseaseID === "")) &&($b || ($DiseaseName_en === ""))&&($c || ($DiseaseName_cn === ""))){
	echo "false";
	die;
}

$pageNum = 1;
$pageSize = 20;

$where['DiseaseIDLIKE'] = $DiseaseID;
$where['DiseaseName_enLIKE'] = $DiseaseName_en;
$where['DiseaseName_cnLIKE'] = $DiseaseName_cn;




$result_all = $mysql_obj->getpageq("Disease",$where,$pageNum,$pageSize);

/* if(empty($result_all)){
	$result_all = NULL;
} */
echo json_encode($result_all);
?>
