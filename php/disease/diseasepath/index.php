<?php
header('content-type:application:json;charset=utf-8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../../publicfunc/sql_func.php');
//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();
$ChildParentID = $_POST['ChildParentID'];
$pageNum = $_POST['pageNum'];
$pageSize = $_POST['pageSize'];

$where['ChildParentID'] = $ChildParentID;
$result_all = $mysql_obj->getpageq("DiseasePath",$where,$pageNum,$pageSize);

foreach ($result_all['data'] as $k => $v){
	$find_Child['DiseaseID'] = $v['ChildDiseaseID'];
	$Child_Name = $mysql_obj->selectq("Disease",array("DiseaseName_cn","DiseaseName_en"),$find_Child);

	$find_Parent['DiseaseID'] = $v['ParentDiseaseID'];
	$Parent_Name = $mysql_obj->selectq("Disease",array("DiseaseName_cn","DiseaseName_en"),$find_Parent);
	
	$result_all['data'][$k]['ChildName_cn'] = $Child_Name['0']['DiseaseName_cn'];
	$result_all['data'][$k]['ChildName_en'] = $Child_Name['0']['DiseaseName_en'];
	$result_all['data'][$k]['ParentName_cn'] = $Parent_Name['0']['DiseaseName_cn'];
	$result_all['data'][$k]['ParentName_en'] = $Parent_Name['0']['DiseaseName_en'];
} 
/* if(empty($result_all)){
	$result_all = NULL;
} */

echo json_encode($result_all);
?>
