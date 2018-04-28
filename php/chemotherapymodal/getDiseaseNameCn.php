<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require_once('../publicfunc/sql_func.php');


//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();

getDiseaseNameCn();

//疾病中文名称
function getDiseaseNameCn(){
	global $mysql_obj;
	$result_all = $mysql_obj->selectq("Disease",array("DiseaseName_cn"));

	
	echo json_encode($result_all);
}
?>