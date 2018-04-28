<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../publicfunc/sql_func.php');
//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();
$GeneID = $_POST['GeneID'];
$Symbol=$_POST['Symbol'];
$GeneName=$_POST['GeneName'];
$ChrID = $_POST['ChrID'];
$Location=$_POST['Location'];
$CreateDate=$_POST['CreateDate'];
$LatestUpdateDate=$_POST['LatestUpdateDate'];
$Synonyms=$_POST['Synonyms'];
$pageNum = $_POST['pageNum'];
$pageSize = $_POST['pageSize'];
$where['GeneID'] = $GeneID;
$where['Symbol'] = $Symbol;
$where['GeneNameLIKE'] = $GeneName;
$where['ChrID'] = $ChrID;
$where['Location'] = $Location;
$where['CreateDate'] = $CreateDate;
$where['LatestUpdateDate'] = $LatestUpdateDate;
$where['SynonymsLIKE'] = $Synonyms;

$result_all = $mysql_obj->getpageq("Gene",$where,$pageNum,$pageSize);

/* if(empty($result_all)){
	$result_all = NULL;
} */
echo json_encode($result_all);
?>
