<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../publicfunc/sql_func.php');
//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();
$DiseaseID = $_POST['DiseaseID'];
	$where = $DiseaseID;
	$result_all = $mysql_obj->deleteq("Disease",$where,"DiseaseID");
echo json_encode($result_all);
?>
