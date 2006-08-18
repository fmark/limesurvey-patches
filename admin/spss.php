<?php
require_once(dirname(__FILE__).'/../config.php');
if (!isset($imagefiles)) {$imagefiles="./images";}
if (!isset($surveyid)) {$surveyid=returnglobal('sid');}
if (!isset($style)) {$style=returnglobal('style');}
if (!isset($answers)) {$answers=returnglobal('answers');}
if (!isset($type)) {$type=returnglobal('type');}

if (empty($surveyid)) {die("Cannot run this script directly");}
#Get all legitimate question ids

header("Content-Type: application/octetstream");
header("Content-Disposition: ".
(strpos($_SERVER["HTTP_USER_AGENT"],"MSIE 5.5")?""
:"attachment; ").
"filename=survey.sps");//sav");


sendcacheheaders();
$query = "SELECT DISTINCT qid FROM ".db_table_name("questions")." WHERE sid=$surveyid"; //GET LIST OF LEGIT QIDs FOR TESTING LATER
$result=$connect->Execute($query) or die("Couldn't count fields<br />$query<br />".$connect->ErrorMsg());
$num_results = $result->RecordCount();
# Build array that has to be returned
$fieldmap=createFieldMap($surveyid);
#See if tokens are being used
$tablelist = $connect->MetaTables() or die ("Error getting table list<br />".$connect->ErrorMsg());
foreach ($tablelist as $tbl)
{
	if ($tbl == "{$dbprefix}tokens_$surveyid") {$tokensexist =  1;}
}

#Lookup the names of the attributes
$query="SELECT sid, attribute1, attribute2, private FROM {$dbprefix}surveys WHERE sid=$surveyid";
$result=db_execute_assoc($query) or die("Couldn't count fields<br />$query<br />".$connect->ErrorMsg());
$num_results = $result->RecordCount();
$num_fields = $num_results;
# Build array that has to be returned
for ($i=0; $i < $num_results; $i++) {
	$row = $result->FetchRow();
	if ($row["attribute1"]) {$attr1_name = $row["attribute1"];} else {$attr1_name=_TL_ATTR1;}
	if ($row["attribute2"]) {$attr2_name = $row["attribute2"];} else {$attr2_name=_TL_ATTR2;}
	$surveyprivate=$row['private'];
}

$fieldno=0;

if (isset($tokensexist) && $tokensexist == 1 && $surveyprivate == "N") {
	$query="SHOW COLUMNS FROM ".db_table_name("tokens_$surveyid");
	$result=db_execute_num($query) or die("Couldn't count fields in tokens<br />$query<br />".$connect->ErrorMsg());
	while ($row=$result->FetchRow()) {
		$token_fields[]=$row[0];
	}
	if (in_array("firstname", $token_fields)) {
		$fields[$fieldno++]=array("id"=>"fname","name"=>_TL_FIRST,"code"=>"", "qid"=>0,"type"=>"A40" );
	}
	if (in_array("lastname", $token_fields)) {
		$fields[$fieldno++]=array("id"=>"lname","name"=>_TL_LAST,"code"=>"", "qid"=>0,"type"=>"A40" );
	}
	if (in_array("email", $token_fields)) {
		$fields[$fieldno++]=array("id"=>"email","name"=>_TL_EMAIL,"code"=>"", "qid"=>0,"type"=>"A100");
	}
	if (in_array("attribute_1", $token_fields)) {
		$fields[$fieldno++]=array("id"=>"attr1","name"=>$attr1_name,"code"=>"", "qid"=>0,"type"=>"A100");
	}
	if (in_array("attribute_2", $token_fields)) {
		$fields[$fieldno++]=array("id"=>"attr2","name"=>$attr2_name,"code"=>"", "qid"=>0,"type"=>"A100");
	}
} else {
	$fields=array();
}

$fieldno=1;
$tempArray = array();
$query="SHOW COLUMNS FROM ".db_table_name("survey_$surveyid");
$result=db_execute_assoc($query) or die("Couldn't count fields<br />$query<br />".$connect->ErrorMsg());
$num_results = $result->RecordCount();
$num_fields = $num_results;
# Build array that has to be returned
for ($i=0; $i < $num_results; $i++) {
	$row = $result->FetchRow();
	#Conditions for SPSS fields:
	# - Length may not be longer than 8 characters
	# - Name may not begin with a digit
	$fieldname = $row["Field"];

	#Rename 'datestamp' to stamp
	if ($fieldname =="datestamp") {
		$fieldname = "stamp";
	}

	#Determine field type
	if ($fieldname=="stamp"){
		$fieldtype = "DATETIME20.0";
	} else {
		if (isset($fieldname) && $fieldname != "")
		{
			# Determine the SPSS Variable Type
			$val_query="SELECT $fieldname FROM {$dbprefix}survey_$surveyid";
			$val_result=db_execute_assoc($query) or die("Couldn't count fields<br />$query<br />".$connect->ErrorMsg());
			$val_size = 0;
			$teststring="";
			while ($val_row = $val_result->FetchRow())
			{
				if ($val_row[$fieldname] != "-oth-") $teststring .= $val_row[$fieldname];
				if ($val_size < strlen($val_row[$fieldname])) $val_size = strlen($val_row[$fieldname]);
			}
			if (is_numeric($teststring))
			{
				$fieldtype = "N".$val_size;
			} elseif ($val_size < 9)
			{
				$fieldtype = "A8";
			} elseif ($val_size >= 255)
			{
				$fieldtype = "A255";
			}else
			{
				$fieldtype = "A".$val_size;
			}
		}
	}
	#Get qid (question id)
	$code="";
	if ($fieldname == "id" OR $fieldname=="token" OR $fieldname=="stamp" OR $fieldname=="attribute_1" OR $fieldname=="attribute_2"){
		$qid = 0;
	}else{
		//GET FIELD DATA
		$fielddata=arraySearchByKey($fieldname, $fieldmap, "fieldname", 1);
		$qid=$fielddata['qid'];
		$ftype=$fielddata['type'];
		$fsid=$fielddata['sid'];
		$fgid=$fielddata['gid'];
		$code=$fielddata['aid'];
	}
	$tempArray=array($fieldno++ =>array("id"=>"d".$fieldno,"name"=>substr($fieldname, 0, 8),"qid"=>$qid, "code"=>$code, "type"=>"$fieldtype", "sql_name"=>$row["Field"]));
	$fields = $fields + $tempArray;
}

reset($fields);
while (list($k, $v)=each($fields)) {
	if ($v['type']=="ASIZE") {
		if (array_key_exists('sql_name', $v)) {
			$query="SELECT MAX(CHAR_LENGTH(".$v['sql_name'].")) AS maxc FROM {$dbprefix}survey_$surveyid";
			$result=mysql_query($query) or die("Couldn't count fields<br />$query<br />".mysql_error());
			$row = mysql_fetch_array($result);
			$fields[$k]['type']="A".(
			$row['maxc']>0?(
			$row['maxc']>60?60:$row['maxc']
			):1);
		}
	}
}

/*
FILE TYPE NESTED RECORD=1(A).
- RECORD TYPE 'Y'.
- DATA LIST / Year 3-6.

- RECORD TYPE 'R'.
- DATA LIST / Region 3-13 (A).

- RECORD TYPE 'P'.
- DATA LIST / SalesRep 3-13 (A) Sales 20-23.
END FILE TYPE.

BEGIN DATA
Y 2002
R Chicago
P Jones            900
P Gregory          400
R Baton Rouge
P Rodriguez        300
P Smith            333
P Grau             100
END DATA.
EXECUTE.

*/
echo "NEW FILE.\n";
echo "FILE TYPE NESTED RECORD=1(A).\n";

$i=0;
foreach ($fields as $field){
	if ($i % 20 == 0) echo "- RECORD TYPE '".chr(65+intval($i/20))."'.\n- DATA LIST LIST / i".intval($i/20)."(A1) ";
	echo $field["id"];
	echo "(".$field["type"].") ";
	$i++;
	//if ($i % 25 == 0) echo "\n   /";
	if ($i % 20 == 0) echo ".\n\n";
}

if ($i % 20 != 0) echo ".\n";
echo "END FILE TYPE.\n\n";
//echo ".";
//minni echo "<br>";
//echo "\n\n\n";

//echo "*Begin data\n";
echo "BEGIN DATA\n";//minni"<br>";

if (isset($tokensexist) && $tokensexist == 1 && $surveyprivate == "N") {
	$query="SELECT `{$dbprefix}tokens_$surveyid`.`firstname`   ,
	       `{$dbprefix}tokens_$surveyid`.`lastname`    ,
	       `{$dbprefix}tokens_$surveyid`.`email`";
	if (in_array("attribute_1", $token_fields)) {
		$query .= ",\n		`{$dbprefix}tokens_$surveyid`.`attribute_1`";
	}
	if (in_array("attribute_2", $token_fields)) {
		$query .= ",\n		`{$dbprefix}tokens_$surveyid`.`attribute_2`";
	}
	$query .= ",\n	       `{$dbprefix}survey_$surveyid`.*
	FROM `{$dbprefix}survey_$surveyid`
	LEFT JOIN `{$dbprefix}tokens_$surveyid` ON `{$dbprefix}survey_$surveyid`.`token` = `{$dbprefix}tokens_$surveyid`.`token`";
} else {
	$query = "SELECT `{$dbprefix}survey_$surveyid`.*
	FROM `{$dbprefix}survey_$surveyid`";
}


$result=db_execute_num($query) or die("Couldn't get results<br />$query<br />".$connect->ErrorMsg());
$num_results = $result->RecordCount();
$num_fields = $result->FieldCount();
for ($i=0; $i < $num_results; $i++) {
	$row = $result->FetchRow();
	$fieldno = 0;
	while ($fieldno < $num_fields){
		if ($fieldno % 20 == 0) echo chr(65+intval($fieldno/20))." ";
		//if ($i==0) { echo "Field: $fieldno - Dati: ";var_dump($fields[$fieldno]);echo "\n"; }
		if ($fields[$fieldno]["type"]=="DATETIME20.0"){
			#convert mysql  datestamp (yyyy-mm-dd hh:mm:ss) to SPSS datetime (dd-mmm-yyyy hh:mm:ss) format
			list( $year, $month, $day, $hour, $minute, $second ) = split( '([^0-9])', $row[$fieldno] );
			echo "'".date("d-m-Y H:i:s", mktime( $hour, $minute, $second, $month, $day, $year ) )."' ";
		}else {
			$strTmp=substr(strip_tags_full($row[$fieldno]), 0, 59);
			//if ($strTmp=='') $strTmp='.';
			echo "'$strTmp' ";
		}
		$fieldno++;
		if ($fieldno % 20 == 0) echo "\n";
	}
	if ($fieldno % 20 != 0) echo "\n";
	//echo "\n";//minni"<br>";
	#Conditions for SPSS fields:
	# - Length may not be longer than 8 charac
}
echo "END DATA.\nEXECUTE.\n\n";//minni<br>";

echo "*Define Variable Properties.\n";//minni"<br>";
foreach ($fields as $field){
	if (	$field["id"] == "fname" OR
	$field["id"]=="lname" OR
	$field["id"]=="email" OR
	$field["id"]=="attr1" OR
	$field["id"]=="attr2"){
		echo "VARIABLE LABELS ".$field["id"]." '".substr(strip_tags_full($field["name"]), 0, 59)."'.\n";//minni"<br>";
	} elseif ($field["name"]=="id") {
		echo "VARIABLE LABELS ".$field["id"]." 'Record ID'.\n";//minni"<br>";
	} elseif ($field["name"]=="stamp") {
		echo "VARIABLE LABELS ".$field["id"]." 'Completion Date'.\n";//minni"<br>";
	}else{
		#If a split question
		if ($field["code"] != ""){
			#Lookup the question
			$query = "SELECT `{$dbprefix}questions`.`question`, `{$dbprefix}questions`.`title` FROM {$dbprefix}questions WHERE ((`{$dbprefix}questions`.`sid` =".$surveyid.") AND (`{$dbprefix}questions`.`qid` =".$field["qid"]."))";
			#echo $query;
			$result=db_execute_assoc($query) or die("Couldn't count fields<br />$query<br />".$connect->ErrorMsg());
			$num_results = $result->RecordCount();
			$num_fields = $num_results;
			if ($num_results >0){
				# Build array that has to be returned
				for ($i=0; $i < $num_results; $i++) {
					$row = mysql_fetch_array($result);
					$question_text = $row["question"];
					$question_title = $row["title"];
				}
			}
			#Lookup the answer
			$query = "SELECT `{$dbprefix}answers`.`answer` FROM {$dbprefix}answers WHERE ((`{$dbprefix}answers`.`qid` =".$field["qid"].") AND (`{$dbprefix}answers`.`code` ='".$field["code"]."'))";
			$result=db_execute_assoc($query) or die("Couldn't lookup answer<br />$query<br />".$connect->ErrorMsg());
			$num_results = $result->RecordCount();
			$num_fields = $num_results;
			if ($num_results >0){
				# Build array that has to be returned
				for ($i=0; $i < $num_results; $i++) {
					$row = $result->FetchRow();
					echo "VARIABLE LABELS ".$field["id"]." '".substr(strip_tags_full($question_title), 0, 59)." - ".substr(strip_tags_full($row["answer"]), 0, 59)."'.\n";//minni"<br>";
				}
			}
			if (substr($field['sql_name'], -5)=='other') {
				echo "VARIABLE LABELS ".$field["id"]." '".
				substr(strip_tags_full($question_text), 0, 59)." - OTHER'.\n";
			}
		}else{
			$test=explode ("X", $field["name"]);
			$query = "SELECT `{$dbprefix}questions`.`question` FROM {$dbprefix}questions WHERE ((`{$dbprefix}questions`.`sid` =".$surveyid.") AND (`{$dbprefix}questions`.`qid` =".$field["qid"]."))";
			$result=db_execute_assoc($query) or die("Couldn't count fields<br />$query<br />".mysql_error());
			$row = $result->FetchRow();
			echo "VARIABLE LABELS ".$field["id"]." '".
			substr(strip_tags_full($row["question"]), 0, 59)."'.\n";
		}
	}
}

// Create our Value Labels!
echo "*Define Value labels.\n";
reset($fields);
foreach ($fields as $field){
	if ($field["qid"]!=0)
	{
		$query = "SELECT `{$dbprefix}answers`.`code`, `{$dbprefix}answers`.`answer`, `{$dbprefix}questions`.`type` FROM {$dbprefix}answers, {$dbprefix}questions WHERE (`{$dbprefix}answers`.`qid` = ".$field["qid"].") and (`{$dbprefix}questions`.`qid` = ".$field["qid"].")";
		$result=db_execute_assoc($query) or die("Couldn't lookup value labels<br />$query<br />".$connect->ErrorMsg());
		$num_results = $result->RecordCount();
		if ($num_results > 0)
		{
			$displayvaluelabel = 0;
			# Build array that has to be returned
			for ($i=0; $i < $num_results; $i++) {
				$row = $result->FetchRow();
				if ($row['type'] != "T" && $row['type'] != "S" && $row['type'] != "U" && $row['type'] != "A" && $row['type'] != "B")
				{
					if ($displayvaluelabel == 0) echo "VALUE LABELS ".$field["id"]."\n";
					if ($displayvaluelabel == 0) $displayvaluelabel = 1;
					if ($i == ($num_results-1))
					{ //substr($fieldname, 0, 8)
						echo $row["code"]." \"".strip_tags_full(substr($row["answer"],0,59))."\".\n"; // put .
					} else {
						echo $row["code"]." \"".strip_tags_full(substr($row["answer"],0,59))."\"\n";
					}
				}
			}
		}
	}
}

?>
