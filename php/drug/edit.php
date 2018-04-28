<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../publicfunc/sql_func.php');
//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();

$DrugID=$_POST['DrugID'];
if(($DrugID === '' )|| ($DrugID === null)){//DrugID不能为空
	echo 0;
	die;
}
$find_exits_DrugID['DrugID'] = $DrugID;
$find_exits = $mysql_obj->selectq("Drug",array("DrugID"),$find_exits_DrugID);
//var_dump($find_exits);
if(empty($find_exits)){//DrugID必须存在
	echo 0;
	die;
}
$DrugName_en=$_POST['DrugName_en'];
$DrugName_cn = $_POST['DrugName_cn'];
$FDAStatus=$_POST['FDAStatus'];
$CFDAStatus=$_POST['CFDAStatus'];

	$where['DrugID'] = $DrugID;
	$data['DrugName_en'] = $DrugName_en;
	$data['DrugName_cn'] = $DrugName_cn;
	$data['FDAStatus'] = $FDAStatus;
	$data['CFDAStatus'] = $CFDAStatus;
	
	$data['LatestUpdateDate'] = date("Y-m-d");
	
	$result_all = $mysql_obj->updateq("Drug",$data,$where);
echo json_encode($result_all);
?>
