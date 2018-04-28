<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../publicfunc/sql_func.php');
//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();





$DrugName_en=$_POST['DrugName_en'];
$DrugName_cn = $_POST['DrugName_cn'];
$FDAStatus=$_POST['FDAStatus'];
$CFDAStatus=$_POST['CFDAStatus'];
//$DrugClassName_en = $_POST['DrugClassName_en'];

/* if(!($DrugClassName_en === '') && !($DrugClassName_en === null)){
	$find_DrugClassID['DrugClassName_en'] = $DrugClassName_en;
	$DrugClassID_find = $mysql_obj->selectq("DrugClass",array("DrugClassID"),$find_DrugClassID);//根据Symbol去Gene表查找Geneid
	if($DrugClassID_find){
		$DrugClassID_find = $DrugClassID_find['0']['DrugClassID'];
		$data_DC['DrugID'] = $DrugID;
		$data_DC['DrugClassID'] = $DrugClassID_find;
		$result_DC = $mysql_obj->insertq("Drug_DrugClass",$data_DC);
		if(!$result_DC){//插入药物跟类别对应关系失败
			echo 0;
			die;
		}
	}else{//类别未找到
		echo 0;
		die;
	}
} */

$data['DrugName_en'] = $DrugName_en;
$data['DrugName_cn'] = $DrugName_cn;
$data['FDAStatus'] = $FDAStatus;
$data['CFDAStatus'] = $CFDAStatus;
$data['CreateDate'] = date("Y-m-d");
$data['LatestUpdateDate'] = $data['CreateDate'] ;

$result_all = $mysql_obj->insertq("Drug",$data);

/* if(empty($result_all)){
	$result_all = NULL;
} */
echo json_encode($result_all);
?>
