<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../../publicfunc/sql_func.php');
//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();

$DrugClassID=$_POST['DrugClassID'];
if(($DrugClassID === '' )|| ($DrugClassID === null)){//DrugClassID不能为空
	echo 0;
	die;
}
$find_exits_DrugID['DrugClassID'] = $DrugClassID;
$find_exits = $mysql_obj->selectq("DrugClass",array("DrugClassID"),$find_exits_DrugID);
//var_dump($find_exits);
if(empty($find_exits)){//DrugID必须存在
	echo 0;
	die;
}
$DrugClassName_en=$_POST['DrugClassName_en'];
$DrugClassName_cn=$_POST['DrugClassName_cn'];

	$where['DrugClassID'] = $DrugClassID;
	
	$data['DrugClassName_en'] = $DrugClassName_en;
	$data['DrugClassName_cn'] = $DrugClassName_cn;
	$data['LatestUpdateDate'] = date("Y-m-d");
	
	$result_all = $mysql_obj->updateq("DrugClass",$data,$where);
echo json_encode($result_all);
?>
