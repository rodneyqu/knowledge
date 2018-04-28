<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require_once('../publicfunc/sql_func.php');


//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();
$DrugName_cn=$_POST['DrugName_cn'];
$DrugID=$_POST['DrugID'];
$limit=20;
getDrugNum($DrugName_cn,$DrugID);

//药物编号
function getDrugNum($DrugName_cn,$DrugID,$limit){
	global $mysql_obj;
	if($DrugName_cn){
		$result_all = $mysql_obj->selectq("Drug",array("DrugID","DrugName_cn"),array("DrugName_cnLIKE"=>$DrugName_cn),$limit);
	}
	if($DrugID){
		$result_all = $mysql_obj->selectq("Drug",array("DrugID","DrugName_cn"),array("DrugIDLIKE"=>$DrugID),$limit);

	}
	
	echo json_encode($result_all);

}


?>