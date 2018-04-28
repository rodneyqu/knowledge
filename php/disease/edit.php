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
$ICDID = $_POST['ICDID'];

$where['DiseaseID'] = $DiseaseID;

$data['DiseaseName_en'] = $DiseaseName_en;
$data['DiseaseName_cn'] = $DiseaseName_cn;
$data['ICDID'] = $ICDID;
$data['LatestUpdateDate'] = date("Y-m-d");

$result_all = $mysql_obj->updateq("Disease",$data,$where);

/* if(empty($result_all)){
	$result_all = NULL;
} */
echo json_encode($result_all);
?>
