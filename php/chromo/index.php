<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../publicfunc/sql_func.php');
//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();
$ChrName=$_POST['ChrName'];
$Length=$_POST['Length'];
$ChrID=$_POST['ChrID'];
$where['ChrName'] = $ChrName;
$where['Length'] = $Length;
$where['ChrID'] = $ChrID;
$result_all = $mysql_obj->selectq("Chr",null,$where);

/* if(empty($result_all)){
	$result_all = NULL;
} */
echo json_encode($result_all);
?>
