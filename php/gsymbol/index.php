<?php
header('content-type:application:json;charset=utf8');
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers:x-requested-with,content-type');
require('../publicfunc/sql_func.php');
//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();
$Symbol=addslashes($_POST['Symbol']);
if(!isset($Symbol) || ($Symbol === "")){
  $sql = "select Symbol from Gene limit 0,20";
}else{
  $sql = "select Symbol from Gene where Symbol like '%{$Symbol}%' ORDER BY LENGTH(replace(Symbol,'{$Symbol}','')) limit 0,20;";
}
$result_all = $mysql_obj->querySql($sql);
foreach($result_all as $k => $v){
	$result[]=$v['Symbol']; 
}
echo json_encode($result);
?>
