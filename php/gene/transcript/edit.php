<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../../publicfunc/sql_func.php');
//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();
$TranscriptID = $_POST['TranscriptID'];

$IsCurrentUsedTranscript = $_POST['IsCurrentUsedTranscript'];
$TranscriptName=$_POST['TranscriptName'];

$where['TranscriptID'] = $TranscriptID;

$data['IsCurrentUsedTranscript'] = $IsCurrentUsedTranscript;
$data['TranscriptName'] = $TranscriptName;

$updateGeneID_find = $mysql_obj->selectq("Transcript",array("GeneID"),$where);
if(!empty($updateGeneID_find)){
	$where_update['GeneID'] = $updateGeneID_find['0']['GeneID'];
	$updateTraID_find = $mysql_obj->selectq("Transcript",array("TranscriptID"),$where_update);
	foreach($updateTraID_find as $k =>$v){
		if($update_in){
			$update_in .=  ",'".$v['TranscriptID']."'";
		}else{
			$update_in = "'".$v['TranscriptID']."'";
		}		
	}
	$sql_update_where = "TranscriptID in ({$update_in})";
	$update_otherUsed = ($IsCurrentUsedTranscript == "yes")?"no":"yes";
	$result_update = $mysql_obj->updateq('Transcript',array("IsCurrentUsedTranscript" => $update_otherUsed),$sql_update_where);
	if($result_update){
		$data['LatestUpdateDate'] = date("Y-m-d");
		$result_all = $mysql_obj->updateq("Transcript",$data,$where);
		echo json_encode($result_all);
	}else{
		echo json_encode(false);
		die;
	}
}else{
	echo json_encode(false);
	die;
}

?>
