<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../publicfunc/sql_func.php');



//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();
$ChemtreaTmentArr=$_POST['ChemtreaTmentID'];
$ChemtreaTmentID=implode(',',$ChemtreaTmentArr);
	delList($ChemtreaTmentID);


function delList($ChemtreaTmentID){
	global $mysql_obj;
	
	$sql='delete from ChemTreatment where ChemtreaTmentID in ('.$ChemtreaTmentID.'); ';
	
	$result_all = $mysql_obj->delSql($sql);
	echo json_encode($result_all);
}

?>