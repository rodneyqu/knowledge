<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
require('../../publicfunc/sql_func.php');
//use publicfunc\sqlfunc as sqlfunc;
$mysql_obj = new sqlfunc();
$GeneID=$_POST['GeneID'];
$TranscriptName=$_POST['TranscriptName'];
$IsCurrentUsedTranscript = $_POST['IsCurrentUsedTranscript'];

if($IsCurrentUsedTranscript == "yes"){
	$find_TraID['GeneID'] = $GeneID;
	$find_TraID['IsCurrentUsedTranscript'] = "yes";
	$TraID_find = $$updateGeneID_find = $mysql_obj->selectq("Transcript",array("TranscriptID"),$find_TraID);
	if(!empty($TraID_find)){
		echo json_encode("statuswrong");
		die;
	}
}

$data['GeneID'] = $GeneID;
$data['TranscriptName'] = $TranscriptName;
$data['IsCurrentUsedTranscript'] = $IsCurrentUsedTranscript;
$data['CreateDate'] = date("Y-m-d");
$data['LatestUpdateDate'] = $data['CreateDate'] ;

$result_all = $mysql_obj->insertq("Transcript",$data);

/* if(empty($result_all)){
	$result_all = NULL;
} */
echo json_encode($result_all);
?>
