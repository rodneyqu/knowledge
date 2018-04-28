<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require_once('../publicfunc/sql_func.php');


//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();

getDrugNameCn();

//药物中文名称
function getDrugNameCn(){
	global $mysql_obj;
	$result_all = $mysql_obj->selectq("Drug",array("DrugName_cn"));

	
	echo json_encode($result_all);

}

?>