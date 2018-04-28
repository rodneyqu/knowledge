<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../publicfunc/sql_func.php');
//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();
$ChrID=$_POST['ChrID'];
$ChrName=$_POST['ChrName'];
$Length=$_POST['Length'];
$AssemblyVersion=$_POST['AssemblyVersion'];
//$CreateDate = $_POST['CreateDate'];

	$where['ChrID'] = $ChrID;
	$data['ChrName'] = $ChrName;
	$data['Length'] = $Length;
	$data['AssemblyVersion'] = $AssemblyVersion;
//	$data['CreateDate'] = $CreateDate;
	
	$data['LatestUpdateDate'] =  date("Y-m-d");
	
	$result_all = $mysql_obj->updateq("Chr",$data,$where);
echo json_encode($result_all);
?>
