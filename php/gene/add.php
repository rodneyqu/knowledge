<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../publicfunc/sql_func.php');
//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();
$Symbol=$_POST['Symbol'];
$GeneName=$_POST['GeneName'];
$ChrID = $_POST['ChrID'];
$Location=$_POST['Location'];
$Synonyms=$_POST['Synonyms'];

$data['Symbol'] = $Symbol;
$data['GeneName'] = $GeneName;
$data['ChrID'] = (int)$ChrID;
$data['Location'] = $Location;
$data['Synonyms'] = $Synonyms;
$data['CreateDate'] = date("Y-m-d");
$data['LatestUpdateDate'] = $data['CreateDate'] ;

$result_all = $mysql_obj->insertq("Gene",$data);

/* if(empty($result_all)){
	$result_all = NULL;
} */
echo json_encode($result_all);
?>
