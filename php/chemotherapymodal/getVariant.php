<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require_once('../publicfunc/sql_func.php');


//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();
$Variant=$_POST['Variant'];

$limit=20;
getVariant($Variant,$limit);

//变异型
function getVariant($Variant,$limit){
	global $mysql_obj;
	$result_all = $mysql_obj->selectq("Variant",array("HGVSp","VariantID"),array("HGVSpLIKE"=>$Variant),$limit);

	echo json_encode($result_all);
}

?>