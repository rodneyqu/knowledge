<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../../publicfunc/sql_func.php');
//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();
$ChildDiseaseID=$_POST['ChildDiseaseID'];
$ParentDiseaseID=$_POST['ParentDiseaseID'];
$data['ChildDiseaseID'] = $ChildDiseaseID;
$data['ParentDiseaseID'] = $ParentDiseaseID;

$result_all = $mysql_obj->insertq("DiseasePath",$data);

/* if(empty($result_all)){
	$result_all = NULL;
} */
echo json_encode($result_all);
?>
