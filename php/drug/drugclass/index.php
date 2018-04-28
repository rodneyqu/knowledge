<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../../publicfunc/sql_func.php');
//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();
$pageNum = $_POST['pageNum'];
$pageSize = $_POST['pageSize'];
$DrugClassID=$_POST['DrugClassID'];

$DrugClassName_en=$_POST['DrugClassName_en'];
$DrugClassName_cn=$_POST['DrugClassName_cn'];
$Createdate=$_POST['Createdate'];
$LatestUpdatedate=$_POST['LatestUpdatedate'];

$where['DrugClassID'] = $DrugClassID;
$where['DrugClassName_en'] = $DrugClassName_en;
$where['DrugClassName_cn'] = $DrugClassName_cn;
$where['Createdate'] = $Createdate;
$where['LatestUpdatedate'] = $LatestUpdatedate;

$result_all = $mysql_obj->getpageq("DrugClass",$where,$pageNum,$pageSize);

/* if(empty($result_all)){
	$result_all = NULL;
} */
echo json_encode($result_all);
?>
