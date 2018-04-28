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
$RefID = $_POST['RefID'];//论文id

$Year = $_POST['Year'];//年份
$Title = $_POST['Title'];//标题like
$Journal=$_POST['Journal'];//期刊
$PubmedID = $_POST['PubmedID'];//PubmedID
	$LastName = $_POST['LastName']?$_POST['LastName']:"";
	$MiddleName  = $_POST['MiddleName']?$_POST['LastName']:"";
	$FirstName = $_POST['FirstName']?$_POST['LastName']:"";
	$where1['LastName'] = $LastName;
	$where1['MiddleName'] = $MiddleName;
	$where1['FirstName'] = $FirstName;
	if((!($LastName === "")) || (!($MiddleName === "")) || (!($FirstName === ""))){//提交时输入了姓名条件
		$authorID_find = $mysql_obj->select_inq('Author',array("AuthorID"),$where1);//生成条件语句
		$table_in = "reference_author";
		$key1 = "AuthorID";
		$RefID_find = $mysql_obj->query_inq($table_in,$key1,$authorID_find,null,null,array("RefID"));//查找到RefID
		if(!empty($RefID_find)){
			$where2['Year'] = $Year;
			$where2['TitleLIKE'] = $Title;
			$where2['JournalLIKE'] = $Journal;
			$where2['PubmedID'] = $PubmedID;
			
			$condition_refid = "";
			foreach ($RefID_find as $k => $v){
				if($condition_refid !== ""){
					$condition_refid .= ',"'.$v['RefID'].'"';
				}else{
					$condition_refid .= '"'.$v['RefID'].'"';
				}			
			}
			$condition_refid2 = "(".$condition_refid.")";//生成条件语句
			$result_all = $mysql_obj->getpage_inq("Reference","RefID",$condition_refid2,null,$where2,$pageNum,$pageSize);
		}else {
			echo "";
			die;
		}
	}else{//未提交姓名条件
		$where['RefID'] = $RefID;
		$where['Year'] = $Year;
		$where['TitleLIKE'] = $Title;//标题模糊查询
		$where['JournalLIKE'] = $Journal;//期刊模糊查询
		$where['PubmedID'] = $PubmedID;
		$result_all = $mysql_obj->getpageq("Reference",$where,$pageNum,$pageSize);
	}
	

foreach ($result_all['data'] as $k => $v){
	$find_authorID['RefID'] = $v['RefID'];
	$AuthorID_find= $mysql_obj->selectq("Reference_Author",array("AuthorID"),$find_authorID);//根据DrugID去Drug_DrugClass表查找DrugClassID
	if(!empty($AuthorID_find)){
		foreach($AuthorID_find as $m =>$n){
			$find_Author['AuthorID'] = $n['AuthorID'];
			//$find_DrugClassName['DrugClassID']= $find_DrugClassName['DrugClassID']?$find_DrugClassName['DrugClassID']:99999999;
			$Author_find = $mysql_obj->selectq("Author",array("LastName","MiddleName","FirstName"),$find_Author);
			$Author_name[] = $Author_find[0]['FirstName']." ".$Author_find[0]['MiddleName']." ".$Author_find[0]['LastName'];
			//$AuthorName_find[] = $Author_find[0][DrugClassName_en];
		}
	}
	$result_all['data'][$k]['Author_name'] = $Author_name?$Author_name:"";
	unset($Author_name);
} 

echo json_encode($result_all);
?>
