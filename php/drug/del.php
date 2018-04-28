<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../publicfunc/sql_func.php');
//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();
$DrugID = $_POST['DrugID'];
//$VariantID='{"VariantID":["1","2","3"]}';
$where = $DrugID;
$result_all = $mysql_obj->deleteq('Drug',$where,"DrugID");
echo json_encode($result_all);
?>
