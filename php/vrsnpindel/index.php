<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../publicfunc/sql_func.php');
//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();
$pageNum = $_POST['pageNum'];
$pageSize = $_POST['pageSize'];
$Symbol = $_POST['Symbol'];//传Symbol搜素
$VariantID = $_POST['VariantID'];
$ChrID=$_POST['ChrID'];
$Position = $_POST['Position'];
$HGVSp = $_POST['HGVSp'];
$HGVSc = $_POST['HGVSc'];
$Impact=$_POST['Impact'];
$Clin_Sig = $_POST['Clin_Sig'];

if(!($Symbol === '') && !($Symbol === null)){
	$find_gid['Symbol'] = $Symbol;
	$Geneid_find = $mysql_obj->selectq("Gene",array("GeneID"),$find_gid);//根据Symbol去Gene表查找Geneid
	if($Geneid_find){
		$Geneid_find = $Geneid_find['0']['GeneID'];
	}else{
		$Geneid_find = "";
	}
	$where_TrID['GeneID'] = $Geneid_find?$Geneid_find:0;//查找到GeneID则继续查找，否则赋0
	if($where_TrID['GeneID'] >0){//查找到GeneID进入逻辑，查找转录本ID
		$where_TrID['IsCurrentUsedTranscript'] = "yes";
		$TrID = $mysql_obj->selectq("Transcript",array("TranscriptID"),$where_TrID);//根据GeneID去Transcript表查找TranscriptID
		if(!empty($TrID)){
			$where['TranscriptID'] = $TrID['0']['TranscriptID'];
		}else{//没查到使用中的转录本赋无效值
			$where['TranscriptID'] = 99999999;//赋值99999999使得下一步搜索失败，返回空值
		}		
	}else{//没查到GeneID最终赋无效值
		$where['TranscriptID'] = 99999999;//赋值99999999使得下一步搜索失败，返回空值
	}
	
}

$where['VariantID'] = $VariantID;
$where['ChrID'] = $ChrID;
$where['Position'] = $Position;
$where['HGVSp'] = $HGVSp;
$where['HGVSc'] = $HGVSc;
$where['Impact'] = $Impact;
$where['Clin_Sig'] = $Clin_Sig;



$result_all = $mysql_obj->getpageq("Variant",$where,$pageNum,$pageSize);

foreach ($result_all['data'] as $k => $v){
	if($v['TranscriptID'] !== NULL){
		$find_symbol['TranscriptID'] = $v['TranscriptID'];
		$TrName_GeneID = $mysql_obj->selectq("Transcript",array("TranscriptName","GeneID"),$find_symbol);//根据TranscriptID去Transcript表查找GeneID跟TranscriptName
		$find_symbol2['GeneID']= $TrName_GeneID['0']['GeneID'];
		$Symbol_v = $mysql_obj->selectq("Gene",array("Symbol"),$find_symbol2);//根据GeneID去Gene表查找Symbol
		$result_all['data'][$k]['TranscriptName'] = $TrName_GeneID['0']['TranscriptName'];
		$result_all['data'][$k]['Symbol'] = $Symbol_v['0']['Symbol']; 
	}else{
		$result_all['data'][$k]['TranscriptName'] = null;
		$result_all['data'][$k]['Symbol'] = null;
	}	
} 

echo json_encode($result_all);
?>
