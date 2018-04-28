<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../publicfunc/sql_func.php');



//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();
$TargetTreatmentTherapyID='';



$TargetTreatmentTherapyDrugID=$_POST['TargetTreatmentTherapyDrugID'];

if(empty($TargetTreatmentTherapyDrugID) ){
	return false;
}else{
	editTherapy($TargetTreatmentTherapyDrugID);

}

function editTherapy($TargetTreatmentTherapyDrugID){
	global $mysql_obj;
	$sql="select t.TargetTreatmentID ,ttd.DrugID,d.DrugName_cn, d.DrugName_en,dc.DrugClassName_cn,dc.DrugClassName_en,ttd.TargetTreatmentTherapyDrugID,t.TargetTreatmentTherapyID
FROM TargetTreatmentTherapy as t
join TargetTreatmentTherapyDrug as ttd
on t.TargetTreatmentTherapyID = ttd.TargetTreatmentTherapyID
join Drug as d
on d.DrugID =ttd.DrugID
join Drug_DrugClass as ddc
on ttd.DrugID =  ddc.DrugID
join DrugClass as dc
on ddc.DrugClassID= dc.DrugClassID where ttd.TargetTreatmentTherapyDrugID=".$TargetTreatmentTherapyDrugID;

	
	$results=$mysql_obj->querySql($sql);

	
	$arr=array();
	$arr['list']=$results;
	$arr['total']=$total['0']['total'];
	echo json_encode($arr);
}

?>