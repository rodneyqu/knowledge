<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../../publicfunc/sql_func.php');
//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();
$ChildParentID = $_POST['ChildParentID'];

$ChildDiseaseID=$_POST['ChildDiseaseID'];
$ParentDiseaseID=$_POST['ParentDiseaseID'];


$where['ChildParentID'] = $ChildParentID;

$data['ChildDiseaseID'] = $ChildDiseaseID;
$data['ParentDiseaseID'] = $ParentDiseaseID;

$result_all = $mysql_obj->updateq("DiseasePath",$data,$where);

/* if(empty($result_all)){
	$result_all = NULL;
} */
echo json_encode($result_all);
?>
