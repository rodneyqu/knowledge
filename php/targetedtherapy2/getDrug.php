<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../publicfunc/sql_func.php');



//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();
$DrugName_cn=$_POST['DrugName_cn'];
$DrugName_en=$_POST['DrugName_en'];
$DrugClassName_cn=$_POST['DrugClassName_cn'];


getDrug($DrugName_cn,$DrugName_en,$DrugClassName_cn);


function getDrug($DrugName_cn,$DrugName_en,$DrugClassName_cn){
	global $mysql_obj;
	$searchArr['d.DrugName_cn']=$DrugName_cn;
	$searchArr['d.DrugName_en']=$DrugName_en;
	$searchArr['dc.DrugClassName_cn']=$DrugClassName_cn;
	foreach($searchArr as $key=>$value){
		if($value!='' ){

			if($i>0){
				
					$whereSql .= ' or '.$key.' like "%'. $value.'%"';
				
			}else{
				
					$whereSql .= $key.' like "%'. $value.'%"';
				
			}
			$i++;	
		}
	}
	if($whereSql){
		$whereSql=' where '.$whereSql.' limit 20' ;
	}
	$sql="select d.DrugName_cn, d.DrugName_en,dc.DrugClassName_en,d.DrugID
from Drug as d
join Drug_DrugClass as ddc
on d.DrugID =  ddc.DrugID
join DrugClass as dc
on ddc.DrugClassID= dc.DrugClassID".$whereSql;

	$results=$mysql_obj->querySql($sql);
	$arr=array();
	$arr['list']=$results;
	$arr['total']=$total['0']['total'];
	echo json_encode($arr);

}

?>
