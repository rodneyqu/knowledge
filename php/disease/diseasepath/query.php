<?php
header('content-type:application:json;charset=utf-8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../../publicfunc/sql_func.php');
//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();
$ChildParentID_p = $_POST['ChildParentID'];
$DiseaseName_en = $_POST['DiseaseName_en'];
$DiseaseName_cn = $_POST['DiseaseName_cn'];
$pageNum = $_POST['pageNum'];
$pageSize = $_POST['pageSize'];
//先针对收到的DiseaseName进行逻辑处理
$DiseaseID_en_find = array();
$DiseaseID_cn_find = array();
if(!($DiseaseName_en === '') && !($DiseaseName_en === null)){
	$query_en = 1;
	$table = "DiseasePath";
	$ChildDiseaseID_en = "ChildDiseaseID";
	$ParentDiseaseID_en = "ParentDiseaseID";
	$condition_en = $mysql_obj->select_inq('Disease',array("DiseaseID"),array("DiseaseName_enLIKE"=>$DiseaseName_en));
	$DiseaseID_en_find = $mysql_obj->query_inq('DiseasePath',$ChildDiseaseID_en,$condition_en,$ParentDiseaseID_en,$condition_en);
}else{
	$query_en = 0;
}

if(!($DiseaseName_cn === '') && !($DiseaseName_cn === null)){
	$query_cn = 1;
	$table = "DiseasePath";
	$ChildDiseaseID_cn = "ChildDiseaseID";
	$ParentDiseaseID_cn = "ParentDiseaseID";
	$condition_cn = $mysql_obj->select_inq('Disease',array("DiseaseID"),array("DiseaseName_cnLIKE"=>$DiseaseName_cn));
	$DiseaseID_cn_find = $mysql_obj->query_inq('DiseasePath',$ChildDiseaseID_cn,$condition_cn,$ParentDiseaseID_cn,$condition_cn);	
}else{
	$query_cn = 0;
}
	
	if($query_en && $query_cn){
		$DiseaseID_find = array_intersect($DiseaseID_en_find,$DiseaseID_cn_find);
	}elseif($query_en){
		$DiseaseID_find = $DiseaseID_en_find;
	}elseif($query_cn){
		$DiseaseID_find = $DiseaseID_cn_find;
	}else{
		$DiseaseID_find = $mysql_obj->selectq('DiseasePath');
	}
	if(!empty($DiseaseID_find)){
		$result_all = $DiseaseID_find;
		foreach ($result_all as $k => $v){
			$find_Child['DiseaseID'] = $v['ChildDiseaseID'];
			$Child_Name = $mysql_obj->selectq("Disease",array("DiseaseName_cn","DiseaseName_en"),$find_Child);

			$find_Parent['DiseaseID'] = $v['ParentDiseaseID'];
			$Parent_Name = $mysql_obj->selectq("Disease",array("DiseaseName_cn","DiseaseName_en"),$find_Parent);
			
			$result_all[$k]['ChildName_cn'] = $Child_Name['0']['DiseaseName_cn'];
			$result_all[$k]['ChildName_en'] = $Child_Name['0']['DiseaseName_en'];
			$result_all[$k]['ParentName_cn'] = $Parent_Name['0']['DiseaseName_cn'];
			$result_all[$k]['ParentName_en'] = $Parent_Name['0']['DiseaseName_en'];
		} 
			$p = $pageNum?($pageNum-1):0;
			$pageSize = $pageSize?$pageSize:10;
			$count_num = count($result_all);
			$result_all_p = array_chunk($result_all,$pageSize);
			$result =  array('data'=>$result_all_p[$p],'num'=>$count_num);
			echo json_encode($result);
	}else{
		echo false;
	}


?>
