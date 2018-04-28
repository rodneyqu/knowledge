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

$pageNum = $_POST['pageNum'];
$pageSize = $_POST['pageSize'];

$where['DiseaseID'] = $DiseaseID;
$where['DiseaseName_enLIKE'] = $DiseaseName_en;
$where['DiseaseName_cnLIKE'] = $DiseaseName_cn;
$where['ICDID'] = $ICDID;


$result_all = $mysql_obj->getpageq("Disease",$where,$pageNum,$pageSize);

/* if(empty($result_all)){
	$result_all = NULL;
} */
echo json_encode($result_all);
?>
