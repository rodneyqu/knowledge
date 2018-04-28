<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../../publicfunc/sql_func.php');
//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();

$GeneID = $_POST['GeneID'];
$TranscriptID = $_POST['TranscriptID'];
$where['GeneID'] = $GeneID;
$where['TranscriptID'] = $TranscriptID;
 $result_all = $mysql_obj->getpageq("Transcript",$where);
 foreach ($result_all['data'] as $k => $v){
	$find_symbol['GeneID'] = $v['GeneID'];
	$Symbol_Gname_find = $mysql_obj->selectq("Gene",array("Symbol","GeneName"),$find_symbol);//根据TranscriptID去Transcript表查找GeneID跟TranscriptName

	$Symbol_find = $Symbol_Gname_find['0']['Symbol'];
	$GeneName_find= $Symbol_Gname_find['0']['GeneName'];
	
	$result_all['data'][$k]['GeneName'] = $GeneName_find;
	$result_all['data'][$k]['Symbol'] = $Symbol_find;
} 


echo json_encode($result_all);
?>
