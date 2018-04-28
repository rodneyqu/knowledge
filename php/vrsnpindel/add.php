<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../publicfunc/sql_func.php');
//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();

$ChrID=$_POST['ChrID'];//这里ChrID有外键约束
$Position = $_POST['Position'];
$REF_base=$_POST['REF_base'];
$ALT_base=$_POST['ALT_base'];
$Symbol = $_POST['Symbol'];
$HGVSp = $_POST['HGVSp'];
$HGVSc = $_POST['HGVSc'];
$Impact=$_POST['Impact'];
$Clin_Sig = $_POST['Clin_Sig'];

if(!($Symbol === '') && !($Symbol === null)){
	$find_gid['Symbol'] = $Symbol;
	$Geneid_find = $mysql_obj->selectq("Gene",array("GeneID"),$find_gid);//根据Symbol去Gene表查找Geneid
	if($Geneid_find){
		$Geneid_find = $Geneid_find['0']['GeneID'];
		$find_TrID['GeneID'] = $Geneid_find;
		$find_TrID['IsCurrentUsedTranscript'] = "yes";
		$TrID_find = $mysql_obj->selectq("Transcript",array("TranscriptID"),$find_TrID);//根据GeneID去Gene表查找TranscriptID
		if($TrID_find){
			$data['TranscriptID'] = (int)$TrID_find['0']['TranscriptID'];
		}else{
			echo 0;
			die;
		}
	}else{
		echo 0;
		die;
	}
}
$data['ChrID'] = (int)$ChrID;
$data['Position'] = (int)$Position;
$data['REF_base'] = $REF_base;
$data['ALT_base'] = $ALT_base;
$data['HGVSp'] = $HGVSp;
$data['HGVSc'] = $HGVSc;
$data['Impact'] = $Impact;
$data['Clin_Sig'] = $Clin_Sig;

$data['CreateDate'] = date("Y-m-d");
$data['LatestUpdateDate'] = $data['CreateDate'];


$result_all = $mysql_obj->insertq("Variant",$data);

/* if(empty($result_all)){
	$result_all = NULL;
} */
echo json_encode($result_all);
?>
