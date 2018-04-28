<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require_once('../publicfunc/sql_func.php');


//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();
$Symbol=$_POST['Symbol'];

$limit=30;
//Symbol 

getHgvsp($Symbol,$limit);


function getHgvsp($Symbol,$limit){
	global $mysql_obj;
	
	$sql="select v.HGVSc, v.HGVSp, v.VariantID 
from Variant as v
join
(select g.Symbol, g.GeneID ,t.TranscriptID 
from Gene as g
join Transcript as t
on g.GeneID=t.GeneID 
where Symbol = '".$Symbol."'
) as b
on b.TranscriptID= v.TranscriptID limit ".$limit;

	$results=$mysql_obj->querySql($sql);

	
	$arr=array();
	$arr['list']=$results;
	
	echo json_encode($arr);
}
?>