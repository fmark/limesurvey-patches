<?php
/*
	#############################################################
	# >>> PHPSurveyor  										#
	#############################################################
	# > Author:  Jason Cleeland									#
	# > E-mail:  jason@cleeland.org								#
	# > Mail:    Box 99, Trades Hall, 54 Victoria St,			#
	# >          CARLTON SOUTH 3053, AUSTRALIA
 	# > Date: 	 20 February 2003								#
	#															#
	# This set of scripts allows you to develop, publish and	#
	# perform data-entry on surveys.							#
	#############################################################
	#															#
	#	Copyright (C) 2003  Jason Cleeland						#
	#															#
	# This program is free software; you can redistribute 		#
	# it and/or modify it under the terms of the GNU General 	#
	# Public License as published by the Free Software 			#
	# Foundation; either version 2 of the License, or (at your 	#
	# option) any later version.								#
	#															#
	# This program is distributed in the hope that it will be 	#
	# useful, but WITHOUT ANY WARRANTY; without even the 		#
	# implied warranty of MERCHANTABILITY or FITNESS FOR A 		#
	# PARTICULAR PURPOSE.  See the GNU General Public License 	#
	# for more details.											#
	#															#
	# You should have received a copy of the GNU General 		#
	# Public License along with this program; if not, write to 	#
	# the Free Software Foundation, Inc., 59 Temple Place - 	#
	# Suite 330, Boston, MA  02111-1307, USA.					#
	#############################################################	
*/

//Ensure script is not run directly, avoid path disclosure
if (empty($homedir)) {die ("Cannot run this script directly (dbedit.php)");}

if (call_user_func($auth_function)) {
	switch($dbaction){
		case "addlabelset":
			$lid=addLabelset($dbprefix);
			break;
		case "addattribute": 
			addAttribute($qid, $dbprefix);
			break;
		case "editattribute":
			updateAttribute($qid, $dbprefix);
			break;
		case "deleteattribute":
			delAttribute($qid, $dbprefix);
			break;
		case "deleteassessment":
			delAssessment($surveyid, $dbprefix);
			break;
		case "delsurvey":
			delSurvey($surveyid, $dbprefix);
			break;
		case "delgroup":
			if (delGroup($surveyid, $gid, $dbprefix)) {
			    $gid="";
			};
			break;
		case "addassessment":
			addAssessment($surveyid, $dbprefix);
			break;
		case "editassessment":
			updateAssessment($surveyid, $dbprefix);
			break;
		case "addanswer":
			addAnswer($qid, $dbprefix);
			break;
		case "deleteanswer":
			delAnswer($qid, $dbprefix);
			break;
		case "updateanswers":
			updateAnswer($qid, $dbprefix);
			break;
		case "moveanswer":
			moveAnswer($qid, $dbprefix);		
			break;
		case "editsurvey":
		case "addsurvey":
			$surveyid=editSurvey($surveyid, $dbprefix, $dbaction);
			break;
		case "editgroup":
		case "addgroup":
			$gid=editGroup($surveyid, $gid, $dbprefix, $dbaction);
			break;
		case "delquestion":
			if (delQuestion($surveyid, $qid, $dbprefix)) {
			    $qid = "";
			}
			break;
		case "editquestion":
		case "addquestion":
		case "copyquestion":
			$qid=editQuestion($surveyid, $gid, $qid, $dbprefix, $dbaction);
			break;
		case "renumbergroup":
		case "renumbersurvey":
			renumber($surveyid, $gid, $dbprefix);
			break;
		case "editlabel":
		case "addlabel":
		    editLabel($lid, $dbprefix, $dbaction);
	} // switch
}

function renumber($surveyid, $gid=null, $dbprefix) {
	$question_number=1;
	$gselect="SELECT *
			  FROM {$dbprefix}questions, {$dbprefix}groups
			  WHERE {$dbprefix}questions.gid={$dbprefix}groups.gid
			  AND {$dbprefix}questions.sid=$surveyid\n";
	if (!empty($gid)) {
	    $gselect .= "AND {$dbprefix}questions.gid=$gid\n";
	}
	$gselect .= "ORDER BY group_name, title";
	$gresult=mysql_query($gselect) or die (mysql_error());
	$grows = array(); //Create an empty array in case mysql_fetch_array does not return any rows
	while ($grow = mysql_fetch_array($gresult)) {$grows[] = $grow;} // Get table output into array
	usort($grows, 'CompareGroupThenTitle');
	$count=count($grows);
	$len=strlen($count);
	foreach($grows as $grow) {
		$sortednumber=sprintf("%0{$len}d", $question_number);
		$usql="UPDATE {$dbprefix}questions\n"
			."SET title='".$sortednumber."'\n"
			."WHERE qid=".$grow['qid'];
		//echo "[$usql]";
		$uresult=mysql_query($usql) or die("Error:".mysql_error());
		$question_number++;
	}
}

function addLabelset($dbprefix) {
	$query = "INSERT INTO {$dbprefix}labelsets
			  (`label_name`)
			  VALUES ('".auto_escape($_POST['label_name'])."')";
	$result=mysql_query($query);
	return mysql_insert_id();
}

function editLabel($lid, $dbprefix, $dbaction) {
    switch($dbaction) {
	  case "addlabel":
	    echo "Hi";
		$query = "INSERT INTO {$dbprefix}labels
				  VALUES ('$lid',
				  	      '".auto_escape($_POST['code'])."',
						  '".auto_escape($_POST['title'])."',
						  '".auto_escape($_POST['sortorder'])."')";
		$result = mysql_query($query);
	  	break;
	  case "editlabelset":
	    break;
	}
}

function editSurvey($surveyid, $dbprefix, $dbaction) {
	$tablefields=array("short_title",
					   "description",
					   "admin",
					   "active",
					   "welcome",
					   "expires",
					   "adminemail",
					   "private",
					   "faxto",
					   "format",
					   "template",
					   "url",
					   "urldescrip",
					   "language",
					   "datestamp",
                       "ipaddr",
					   "usecookie",
					   "notification",
					   "allowregister",
					   "attribute1",
					   "attribute2",
					   "email_invite_subj",
					   "email_invite",
					   "email_remind_subj",
					   "email_remind",
					   "email_register_subj",
					   "email_register",
					   "email_confirm_subj",
					   "email_confirm",
					   "allowsave",
					   "autonumber_start",
					   "autoredirect",
					   "allowprev");
	switch ($dbaction) {
		case "editsurvey":
			$query = "UPDATE {$dbprefix}surveys
					  SET ";
			foreach ($tablefields as $tf) {
				if (isset($_POST[$tf])) {
					$querys[] = "$tf = '".auto_escape($_POST[$tf])."'";
				}
			}
			$query .= implode(",\n", $querys);
			$query .= "\nWHERE sid=$surveyid";
			$result = mysql_query($query);
			break;
		case "addsurvey":
			$query = "INSERT INTO {$dbprefix}surveys\n";
			foreach ($tablefields as $tf) {
				if (isset($_POST[$tf])) {
				    $fields[]=$tf;
					$values[]=mysql_escape_string($_POST[$tf]);
				}
			}
			$query .= "(".implode(",\n", $fields).")";
			$query .= "\nVALUES ('";
			$query .= implode("',\n'", $values)."')";
			if ($result = mysql_query($query)) {
				$surveyid = mysql_insert_id();
			} else {
				echo $query."<br />".mysql_error();
			}
			break;
	}
	return $surveyid;
}

function editGroup($surveyid, $gid, $dbprefix, $dbaction) {
	$tablefields=array("sid",
					   "group_name",
					   "description");
	switch($dbaction) {
		case "editgroup":
			$query = "UPDATE {$dbprefix}groups
					  SET ";
			foreach($tablefields as $tf) {
				if (isset($_POST[$tf])) {
				    $querys[]="$tf = '".auto_escape($_POST[$tf])."'";
				}
			}
			$query .= implode(",\n", $querys);
			$query .= "\nWHERE gid=$gid";
			$result = mysql_query($query);
			
			break;
		case "addgroup":
			$query = "INSERT INTO {$dbprefix}groups\n";
			foreach ($tablefields as $tf) {
				if (isset($_POST[$tf])) {
				    $fields[]=$tf;
					$values[]=auto_escape($_POST[$tf]);
				}
			}
			$query .= "(".implode(",\n", $fields).")";
			$query .= "\nVALUES ('";
			$query .= implode("',\n'", $values)."')";
//			echo $query;
			if ($result = mysql_query($query)) {
				$gid = mysql_insert_id();
			} else {
				echo $query."<br />".mysql_error();
			}			
			break;
	}
	return $gid;
}

function delQuestion($surveyid, $qid, $dbprefix) {
	global $databasename;
	if (!is_numeric($qid)) {
	    return FALSE;
	} elseif ($_GET['ok'] == "yes") {
		if (!isActivated($surveyid)) {
			$query = "DELETE FROM {$dbprefix}answers WHERE qid = ".$qid;
			$result = mysql_query($query);
			//2: Delete all conditions to questions in this group
			$query = "DELETE FROM {$dbprefix}conditions WHERE qid = ".$qid;
			$result = mysql_query($query);
			//3: Delete all question_attributes to questions in this group
			$query = "DELETE FROM {$dbprefix}question_attributes WHERE qid = ".$qid;
			$result = mysql_query($query);
			//4: Delete all questions in this group
			$query = "DELETE FROM {$dbprefix}questions WHERE qid = ".$qid;
			$result = mysql_query($query);
			return TRUE;
		}
	}
	return FALSE;
}


function editQuestion($surveyid, $gid, $qid, $dbprefix, $dbaction) {
	$tablefields=array("sid",
					   "gid",
					   "type",
					   "title",
					   "question",
					   "help",
					   "other",
					   "mandatory",
					   "lid",
					   "preg");
	switch($dbaction) {
		case "editquestion":
			$query = "UPDATE {$dbprefix}questions
					  SET ";
			foreach($tablefields as $tf) {
				if (isset($_POST[$tf])) {
				    $querys[]="$tf = '".auto_escape($_POST[$tf])."'";
				}
			}
			$query .= implode(",\n", $querys);
			$query .= "\nWHERE qid=$qid";
//			echo $query;
			$result = mysql_query($query);
			
			break;
		case "copyquestion":
		    $oldqid=$qid;
		case "addquestion":
			$query = "INSERT INTO {$dbprefix}questions\n";
			foreach ($tablefields as $tf) {
				if (isset($_POST[$tf])) {
				    $fields[]=$tf;
					$values[]=auto_escape($_POST[$tf]);
				}
			}
			$query .= "(".implode(",\n", $fields).")";
			$query .= "\nVALUES ('";
			$query .= implode("',\n'", $values)."')";
//			echo $query;
			if ($result = mysql_query($query)) {
					$qid = mysql_insert_id();
				} else {
					echo $query."<br />".mysql_error();
				}
			break;
	}
    if ($dbaction == "copyquestion") { //Also copy the answers and the attributes
		$query="SELECT * FROM {$dbprefix}answers
				WHERE qid=$oldqid";
		$results=mysql_query($query);
		while($row=mysql_fetch_array($results)) {
		  $qinsert="INSERT INTO {$dbprefix}answers
		  			VALUES ('$qid',
							'".auto_escape($row['code'])."',
							'".auto_escape($row['answer'])."',
							'".auto_escape($row['default_value'])."',
							'".auto_escape($row['sortorder'])."')";
		   $qresult=mysql_query($qinsert);
		}
	    $query="SELECT * FROM {$dbprefix}question_attributes
				WHERE qid=$oldqid";
		$results=mysql_query($query);
		while($row=mysql_fetch_array($results)) {
		  $qinsert="INSERT INTO {$dbprefix}question_attributes
		  			VALUES ('',
						    '$qid',
							'".auto_escape($row['attribute'])."',
							'".auto_escape($row['value'])."')";
		  $qresult=mysql_query($qinsert);
		}
    }
	return $qid;
}

function addAttribute($qid, $dbprefix) {
	$query = "INSERT INTO {$dbprefix}question_attributes
			  (qid, attribute, value)
			  VALUES ($qid,
			  '".$_POST['attribute']."',
			  '".$_POST['value']."')";
	$result = mysql_query($query);
}

function delAttribute($qid, $dbprefix) {
	$query = "DELETE FROM {$dbprefix}question_attributes
			  WHERE qid=$qid
			  AND qaid=".$_GET['qaid'];
	$result = mysql_query($query);
}

function updateAttribute($qid, $dbprefix) {
	$query = "UPDATE {$dbprefix}question_attributes
			  SET value='".$_POST['value']."'
			  WHERE qaid=".$_POST['qaid'];
	$result = mysql_query($query);
}

function addAnswer($qid, $dbprefix) {
	$where=array("qid"=>$qid,
				   "code"=>$_POST['code']);
	
	if (matchExists("{$dbprefix}answers", $where) !== true) {
		$query = "INSERT INTO {$dbprefix}answers
				 (qid, code, answer, default_value, sortorder)
				 VALUES ($qid,
				 '".$_POST['code']."',
				 '".mysql_escape_string($_POST['answer'])."',
				 '".$_POST['default_value']."',
				 '".sprintf("%05d", $_POST['sortorder'])."')";
		$result = mysql_query($query);
	} else {
		echo "<script type=\"text/javascript\">\n<!--\n alert(\""._DB_FAIL_NEWANSWERDUPLICATE."\")\n //-->\n</script>\n";
	}
}

function delAssessment($surveyid, $dbprefix) {
	$query = "DELETE FROM {$dbprefix}assessments
			  WHERE id=".$_POST['id']."
			  AND sid=$surveyid";
	$result = mysql_query($query);
}

function updateAssessment($surveyid, $dbprefix) {
	$query = "UPDATE {$dbprefix}assessments
			  SET scope='".$_POST['scope']."',
			  gid=".$_POST['assessment_gid'].",
			  name='".auto_escape($_POST['name'])."',
			  minimum='".$_POST['minimum']."',
			  maximum='".$_POST['maximum']."',
			  message='".auto_escape($_POST['message'])."',
			  link='".auto_escape($_POST['link'])."'
			  WHERE id=".$_POST['id'];
	$result=mysql_query($query);
}

function addAssessment($surveyid, $dbprefix) {
	$query = "INSERT INTO {$dbprefix}assessments
			  (sid, scope, gid, name, minimum, maximum, message, link)
			  VALUES
			  ($surveyid,
			  '".$_POST['scope']."',
			  ".$_POST['assessment_gid'].",
			  '".auto_escape($_POST['name'])."',
			  '".$_POST['minimum']."',
			  '".$_POST['maximum']."',
			  '".auto_escape($_POST['message'])."',
			  '".auto_escape($_POST['link'])."')";
	$result = mysql_query($query);
}

function delAnswer($qid, $dbprefix) {
	$query = "DELETE FROM {$dbprefix}answers
			  WHERE qid=$qid
			  AND code='".returnglobal('code')."'";
	$result = mysql_query($query);
}

function delGroup($surveyid, $gid, $dbprefix) {
	global $databasename;
	if (!is_numeric($gid)) {
	    return _ERROR;
	} elseif ($_GET['ok'] == "yes") {
		if (!isActivated($surveyid)) {
			$query = "SELECT qid FROM {$dbprefix}questions WHERE gid=".$gid;
			$result = mysql_query($query);
			$qids=array();
			while($row = mysql_fetch_row($result)){
				$qids[]=$row[0];
			} // while
			$qids="'".implode("', '",$qids)."'";
			//1: Delete all answers to questions in this group
			$query = "DELETE FROM {$dbprefix}answers WHERE qid IN (".$qids.")";
			$result = mysql_query($query);
			//2: Delete all conditions to questions in this group
			$query = "DELETE FROM {$dbprefix}conditions WHERE qid IN (".$qids.")";
			$result = mysql_query($query);
			//3: Delete all question_attributes to questions in this group
			$query = "DELETE FROM {$dbprefix}question_attributes WHERE qid IN (".$qids.")";
			$result = mysql_query($query);
			//4: Delete all questions in this group
			$query = "DELETE FROM {$dbprefix}questions WHERE qid IN (".$qids.")";
			$result = mysql_query($query);
			//5: Delete Group
			$query = "DELETE FROM {$dbprefix}groups WHERE gid = ".$gid;
			$result = mysql_query($query);
			return TRUE;
		}
	}
	return FALSE;
}

function delSurvey($surveyid, $dbprefix) {
	global $databasename;
	if (!is_numeric($surveyid)) { //make sure it's just a number!
	    return _ERROR." "._DS_NOSID;
	} elseif ($_GET['ok'] == "yes") {
		$result = mysql_list_tables($databasename); //Get a list of table names
		while ($row = mysql_fetch_row($result))
			{
			$tablelist[]=$row[0]; //Put it in an array
		    }
	
		if (in_array("{$dbprefix}survey_$surveyid", $tablelist)) //delete the survey_$surveyid table
			{
			$dsquery = "DROP TABLE `{$dbprefix}survey_$surveyid`";
			$dsresult = mysql_query($dsquery) or die ("Couldn't \"$dsquery\" because <br />".mysql_error());
			}
	
		if (in_array("{$dbprefix}tokens_$surveyid", $tablelist)) //delete the tokens_$surveyid table
			{
			$dsquery = "DROP TABLE `{$dbprefix}tokens_$surveyid`";
			$dsresult = mysql_query($dsquery) or die ("Couldn't \"$dsquery\" because <br />".mysql_error());
			}
		
		$dsquery = "SELECT qid FROM {$dbprefix}questions WHERE sid=$surveyid";
		$dsresult = mysql_query($dsquery) or die ("Couldn't find matching survey to delete<br />$dsquery<br />".mysql_error());
		while ($dsrow = mysql_fetch_array($dsresult))
			{
			$asdel = "DELETE FROM {$dbprefix}answers WHERE qid={$dsrow['qid']}";
			$asres = mysql_query($asdel);
			$cddel = "DELETE FROM {$dbprefix}conditions WHERE qid={$dsrow['qid']}";
			$cdres = mysql_query($cddel) or die ("Delete conditions failed<br />$cddel<br />".mysql_error());
			$qadel = "DELETE FROM {$dbprefix}question_attributes WHERE qid={$dsrow['qid']}";
			$qares = mysql_query($qadel);
			}
		
		$qdel = "DELETE FROM {$dbprefix}questions WHERE sid=$surveyid";
		$qres = mysql_query($qdel);
	
		$scdel = "DELETE FROM {$dbprefix}assessments WHERE sid=$surveyid";
		$scres = mysql_query($scdel);
		
		$gdel = "DELETE FROM {$dbprefix}groups WHERE sid=$surveyid";
		$gres = mysql_query($gdel);
		
		$sdel = "DELETE FROM {$dbprefix}surveys WHERE sid=$surveyid";
		$sres = mysql_query($sdel);		
	} else {
	   echo $_GET['ok'];
	}
}

function updateAnswer($qid, $dbprefix) {
	//echo "Hi";
	//echo "<pre>";print_r($_POST); echo "</pre>";
	//FIRST: Renumber all the existing answers (we can fix if a problem occurs)
	$query = "UPDATE {$dbprefix}answers SET qid=99999999 WHERE qid=$qid";
	$result = mysql_query($query) or die(mysql_error());
	foreach($_POST['code'] as $key=>$code) {
		$where=array("qid"=>$qid,
					 "code"=>$code);
		if (matchExists("{$dbprefix}answers", $where) !== true) {
			$insert="INSERT INTO {$dbprefix}answers
					 (qid, code, answer, default_value, sortorder)
					 VALUES
					 ($qid, '$code', '".auto_escape($_POST['answer'][$key])."', '".$_POST['default_value'][$key]."', '".$_POST['sortorder'][$key]."')";
			$result = mysql_query($insert) or die(mysql_error());
		} else {
			$query = "DELETE FROM {$dbprefix}answers WHERE qid=$qid";
			$result = mysql_query($query) or die(mysql_error());
			$query = "UPDATE {$dbprefix}answers SET qid=$qid WHERE qid=99999999";
			$result = mysql_query($query) or die(mysql_error());
			echo "<script type=\"text/javascript\">\n<!--\n alert(\""._DB_FAIL_ANSWERUPDATEDUPLICATE."\")\n //-->\n</script>\n";
		}
	}
	$query = "DELETE FROM {$dbprefix}answers WHERE qid=99999999";
	$result = mysql_query($query) or die(mysql_error());
}

function moveAnswer($qid, $dbprefix) {
	$newsortorder=sprintf("%05d", $_GET['sortorder']+$_GET['moveorder']);
	$query = "UPDATE {$dbprefix}answers
			  SET sortorder='PEND'
			  WHERE qid=$qid
			  AND sortorder='$newsortorder'";
	$result = mysql_query($query);
	$query = "UPDATE {$dbprefix}answers
			   SET sortorder='$newsortorder'
			   WHERE qid=$qid
			   AND sortorder='".$_GET['sortorder']."'";
	$result = mysql_query($query);
	$query = "UPDATE {$dbprefix}answers
			  SET sortorder='".$_GET['sortorder']."'
			  WHERE qid=$qid
			  AND sortorder='PEND'";
	$result = mysql_query($query);
}

function matchExists($table, $where) {
	//This function will return true if a duplicate entry is found
	//and false if one is not
	//$table = tablename
	//$duplicates = keyed array containing "field"=>"value" where duplicates are being searched for
	//$where = keyed array containing "field"=>"value" for the other conditions of the search
	$query = "SELECT * FROM $table
			  WHERE ";
	foreach ($where as $key=>$val) {
		$wheres[]= "$key = '$val'";
	}
	$query .= implode("\nAND ", $wheres);
	$result = mysql_query($query);
	if (mysql_num_rows($result) > 0) {
	    return true;
	} else {
		return false;
	}
}

function isActivated($surveyid) {
	//This function will return true if a survey is currently active
	//and false if not
	$query = "SELECT active FROM surveys WHERE sid=".$surveyid;
	$result = mysql_query($query);
	while ($row=mysql_fetch_row($result)) {
		if ($row[0] == "Y") {
		    return TRUE;
		}
	}
	return FALSE;
}
?>