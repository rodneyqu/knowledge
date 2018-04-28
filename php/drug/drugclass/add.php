<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../../publicfunc/sql_func.php');
//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();

$DrugClassName_en=$_POST['DrugClassName_en'];
$DrugClassName_cn=$_POST['DrugClassName_cn'];
$LatestUpdatedate=$_POST['LatestUpdatedate'];

$data['DrugClassName_en'] = $DrugClassName_en;
$data['DrugClassName_cn'] = $DrugClassName_cn;
$data['CreateDate'] = date("Y-m-d");
$data['LatestUpdateDate'] = $data['CreateDate'] ;

$result_all = $mysql_obj->insertq("DrugClass",$data);

/* if(empty($result_all)){
	$result_all = NULL;
} */
echo json_encode($result_all);
?>
