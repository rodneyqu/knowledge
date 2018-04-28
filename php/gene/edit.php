<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../publicfunc/sql_func.php');
//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();
$GeneID = $_POST['GeneID'];

$GeneName=$_POST['GeneName'];
$ChrID = $_POST['ChrID'];
$Location=$_POST['Location'];
$Synonyms=$_POST['Synonyms'];

$where['GeneID'] = $GeneID;

$data['GeneName'] = $GeneName;
$data['ChrID'] = $ChrID;
$data['Location'] = $Location;
$data['Synonyms'] = $Synonyms;

$data['LatestUpdateDate'] = date("Y-m-d");
$result_all = $mysql_obj->updateq("Gene",$data,$where);

/* if(empty($result_all)){
	$result_all = NULL;
} */
echo json_encode($result_all);
?>
