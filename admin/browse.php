<?php
/*
	#############################################################
	# >>> PHP Surveyor  										#
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
$sid = $_GET['sid']; if (!$sid) {$sid = $_POST['sid'];}
$action = $_GET['action']; if (!$action) {$action = $_POST['action'];}
$id = $_GET['id']; if (!$id) {$id = $_POST['id'];}
$limit = $_GET['limit']; if ($limit) {$limit = $_POST['limit'];}

include("config.php");

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");    // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
                                                     // always modified
header("Cache-Control: no-store, no-cache, must-revalidate");  // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");                          // HTTP/1.0

$surveyoptions = browsemenubar();
echo $htmlheader;

echo "<table height='1'><tr><td></td></tr></table>\n";
echo "<table width='99%' align='center' style='border: 1px solid #555555' cellpadding='1' cellspacing='0'>\n";

if (!mysql_selectdb($databasename, $connect)) //DATABASE DOESN'T EXIST OR CAN'T CONNECT
	{
	echo "\t<tr bgcolor='#555555'><td colspan='2' height='4'><font size='1' face='verdana' color='white'><b>"._BROWSERESPONSES."</b></td></tr>\n";
	echo "\t<tr height='22' bgcolor='#CCCCCC'><td align='center'>$setfont\n";
	echo "<b><font color='red'>"._ERROR."</font></b><br />\n";
	echo _ST_NODB1."<br />\n";
	echo _ST_NODB2."<br /><br />\n";
	echo "<input $btstyle type='submit' value='"._GO_ADMIN."' onClick=\"window.open('$scriptname', '_top')\"><br />\n";
	echo "</td></tr></table>\n";
	echo "</body>\n</html>";
	exit;
	}
if (!$sid && !$action) //NO SID OR ACTION PROVIDED
	{
	echo "\t<tr bgcolor='#555555'><td colspan='2' height='4'><font size='1' face='verdana' color='white'><b>"._BROWSERESPONSES."</b></td></tr>\n";
	echo "\t<tr height='22' bgcolor='#CCCCCC'><td align='center'>$setfont\n";
	echo "<b><font color='red'>"._ERROR."</font></b><br />\n";
	echo _BR_NOSID."<br /><br />\n";
	echo "<input $btstyle type='submit' value='"._GO_ADMIN."' onClick=\"window.open('$scriptname', '_top')\"><br />\n";
	echo "</td></tr></table>\n";
	echo "</body>\n</html>";
	exit;
	}

//CHECK IF SURVEY IS ACTIVATED AND EXISTS
$actquery = "SELECT * FROM surveys WHERE sid=$sid";
$actresult = mysql_query($actquery);
$actcount = mysql_num_rows($actresult);
if ($actcount > 0)
	{
	while ($actrow = mysql_fetch_array($actresult))
		{
		$surveytable = "survey_{$actrow['sid']}";
		$surveyname = "{$actrow['short_title']}";
		if ($actrow['active'] == "N") //SURVEY IS NOT ACTIVE YET
			{
			echo "\t<tr bgcolor='#555555'><td colspan='2' height='4'><font size='1' face='verdana' color='white'><b>"._BROWSERESPONSES.": <font color='silver'>$surveyname</b></td></tr>\n";
			echo "\t<tr height='22' bgcolor='#CCCCCC'><td align='center'>$setfont\n";
			echo "<b><font color='red'>"._ERROR."</font></b><br />\n";
			echo _BR_NOTACTIVATED."<br /><br />\n";
			echo "<input $btstyle type='submit' value='"._GO_ADMIN."' onClick=\"window.open('$scriptname?sid=$sid', '_top')\"><br />\n";
			echo "</td></tr></table>\n";
			echo "</body>\n</html>";
			exit;
			}
		}
	}
else //SURVEY MATCHING $SID DOESN'T EXIST
	{
	echo "\t<tr bgcolor='#555555'><td colspan='2' height='4'><font size='1' face='verdana' color='white'><b>"._BROWSERESPONSES."</b></td></tr>\n";
	echo "\t<tr height='22' bgcolor='#CCCCCC'><td align='center'>$setfont\n";
	echo "<b><font color='red'>"._ERROR."</font></b><br />\n";
	echo _BR_NOSURVEY." ($sid)<br /><br />\n";
	echo "<input $btstyle type='submit' value='"._GO_ADMIN."' onClick=\"window.open('$scriptname', '_top')\"><br />\n";
	echo "</td></tr></table>\n";
	echo "</body>\n</html>";
	exit;
	}

//OK. IF WE GOT THIS FAR, THEN THE SURVEY EXISTS AND IT IS ACTIVE, SO LETS GET TO WORK.

if ($action == "id") // Looking at a SINGLE entry
	{
	//SHOW HEADER
	echo "\t<tr bgcolor='#555555'><td colspan='2' height='4'><font size='1' face='verdana' color='white'><b>"._BROWSERESPONSES.": <font color='silver'>$surveyname</b></td></tr>\n";
	if (!$_POST['sql']) {echo "$surveyoptions";} // Don't show options if coming from tokens script
	echo "</table>\n";
	echo "<table height='1'><tr><td></td></tr></table>\n";
	
	//FIRST LETS GET THE NAMES OF THE QUESTIONS AND MATCH THEM TO THE FIELD NAMES FOR THE DATABASE
	$fnquery = "SELECT * FROM questions, groups, surveys WHERE questions.gid=groups.gid AND groups.sid=surveys.sid AND questions.sid='$sid' ORDER BY group_name";
	$fnresult = mysql_query($fnquery);
	$fncount = mysql_num_rows($fnresult);
	//echo "$fnquery<br /><br />\n";
	
	$fnrows = array(); //Create an empty array in case mysql_fetch_array does not return any rows
	while ($fnrow = mysql_fetch_array($fnresult)) {$fnrows[] = $fnrow; $private = $fnrow['private']; $datestamp=$fnrow['datestamp'];} // Get table output into array
	
	// Perform a case insensitive natural sort on group name then question title of a multidimensional array
	usort($fnrows, 'CompareGroupThenTitle');
	
	$fnames[] = array("id", "id", "id");
	
	if ($private == "N") //add token to top ofl ist is survey is not private
		{
		$fnames[] = array("token", "token", "Token ID");		
		}
	if ($datestamp == "Y") //add datetime to list if survey is datestamped
		{
		$fnames[] = array("datestamp", "datestamp", "Date Stamp");
		}
	
	foreach ($fnrows as $fnrow)
		{
		$field = "{$fnrow['sid']}X{$fnrow['gid']}X{$fnrow['qid']}";
		$ftitle = "Grp{$fnrow['gid']}Qst{$fnrow['title']}";
		$fquestion = $fnrow['question'];
		if ($fnrow['type'] == "M" || $fnrow['type'] == "A" || $fnrow['type'] == "B" || $fnrow['type'] == "C" || $fnrow['type'] == "E" || $fnrow['type'] == "P")
			{
			$fnrquery = "SELECT * FROM answers WHERE qid={$fnrow['qid']} ORDER BY sortorder, answer";
			$fnrresult = mysql_query($fnrquery);
			while ($fnrrow = mysql_fetch_array($fnrresult))
				{
				$fnames[] = array("$field{$fnrrow['code']}", "$ftitle ({$fnrrow['code']})", "{$fnrow['question']} ({$fnrrow['answer']})");
				if ($fnrow['type'] == "P") {$fnames[] = array("$field{$fnrrow['code']}"."comment", "$ftitle"."comment", "{$fnrow['question']} (comment)");}
				}
			if ($fnrow['other'] == "Y")
				{
				$fnames[] = array("$field"."other", "$ftitle"."other", "{$fnrow['question']}(other)");
				}
			}
		elseif ($fnrow['type'] == "R")
			{
			$fnrquery = "SELECT * FROM answers WHERE qid={$fnrow['qid']} ORDER BY sortorder, answer";
			$fnrresult = mysql_query($fnrquery);
			$fnrcount = mysql_num_rows($fnrresult);
			for ($i=1; $i<=$fnrcount; $i++)
				{
				$fnames[] = array("$field$i", "$ftitle ($i)", "{$fnrow['question']} ($i)");
				}			
			}
		elseif ($fnrow['type'] == "O")
			{
			$fnames[] = array("$field", "$ftitle", "{$fnrow['question']}");
			$field2 = $field."comment";
			$ftitle2 = $ftitle."[Comment]";
			$longtitle = "{$fnrow['question']}<br />[Comment]";
			$fnames[] = array("$field2", "$ftitle2", "$longtitle");
			}
		else
			{
			$fnames[] = array("$field", "$ftitle", "{$fnrow['question']}");
			}
		//echo "$field | $ftitle | $fquestion<br />\n";
		}

	$nfncount = count($fnames)-1;
	//SHOW INDIVIDUAL RECORD
	$idquery = "SELECT * FROM $surveytable WHERE ";
	if ($_POST['sql'])
		{
		if (get_magic_quotes_gpc) {$idquery .= stripslashes($_POST['sql']);}
		else {$idquery .= "{$_POST['sql']}";}
		}
	else {$idquery .= "id=$id";}
	$idresult = mysql_query($idquery) or die ("Couldn't get entry<br />\n$idquery<br />\n".mysql_error());
	while ($idrow = mysql_fetch_array($idresult)) {$id=$idrow['id'];}
	$next=$id+1;
	$last=$id-1;
	echo "<table width='99%' align='center' style='border: 1px solid #555555' cellpadding='1' cellspacing='0'>\n";
	echo "\t<tr bgcolor='#555555'>\n";
	echo "\t\t<td colspan='2' height='4'><font size='1' face='verdana' color='white'><b>"._VIEWRESPONSE.":</b> $id</td></tr>\n";
	echo "\t<tr bgcolor='#999999'><td colspan='2'>\n";
	echo "\t\t\t<img src='./images/blank.gif' width='31' height='20' border='0' hspace='0' align='left'>\n";
	echo "\t\t\t<img src='./images/seperator.gif' border='0' hspace='0' align='left'>\n";
	echo "\t\t\t<input type='image' align='left' hspace='0' border='0' src='./images/edit.gif' title='"._BR_EDITRESPONSE."' onClick=\"window.open('dataentry.php?action=edit&id=$id&sid=$sid&surveytable=$surveytable','_top')\" />\n";
	echo "\t\t\t<input type='image' align='left' hspace='0' border='0' src='./images/delete.gif' title='"._BR_DELRESPONSE."' onClick=\"window.open('dataentry.php?action=delete&id=$id&sid=$sid&surveytable=$surveytable','_top')\" />\n";
	echo "\t\t\t<img src='./images/blank.gif' width='20' height='20' border='0' hspace='0' align='left'>\n";
	echo "\t\t\t<img src='./images/seperator.gif' border='0' hspace='0' align='left'>\n";
	echo "\t\t\t<img src='./images/blank.gif' width='20' height='20' border='0' hspace='0' align='left'>\n";
	echo "\t\t\t<input type='image' align='left' hspace='0' border='0' src='./images/databack.gif' title='"._D_BACK."' onClick=\"window.open('browse.php?action=id&id=$last&sid=$sid&surveytable=$surveytable','_top')\" />\n";
	echo "\t\t\t<img src='./images/blank.gif' width='13' height='20' border='0' hspace='0' align='left'>\n";
	echo "\t\t\t<input type='image' align='left' hspace='0' border='0' src='./images/dataforward.gif' title='"._D_FORWARD."' onClick=\"window.open('browse.php?action=id&id=$next&sid=$sid&surveytable=$surveytable','_top')\" />\n";
	echo "\t\t</td>\n";
	echo "\t</tr>\n";
	echo "\t<tr><td colspan='2' bgcolor='#CCCCCC' height='1'></td></tr>\n";
	$idresult = mysql_query($idquery) or die ("Couldn't get entry<br />$idquery<br />".mysql_error());
	while ($idrow = mysql_fetch_array($idresult))
		{
		$i=0;
		for ($i; $i<$nfncount+1; $i++)
			{
			echo "\t<tr>\n";
			echo "\t\t<td bgcolor='#EFEFEF' valign='top' align='right' width='33%' style='padding-right: 5px'>$setfont{$fnames[$i][2]}</td>\n";
			echo "\t\t<td valign='top' style='padding-left: 5px'>$setfont";
			echo htmlspecialchars($idrow[$fnames[$i][0]], ENT_QUOTES) . "</td>\n";
			echo "\t</tr>\n";
			echo "\t<tr><td colspan='2' bgcolor='#CCCCCC' height='1'></td></tr>\n";
			}
		}
	echo "</table>\n";
	echo "<table width='99%' align='center'>\n";
	echo "\t<tr>\n";
	echo "\t\t<td $singleborderstyle bgcolor='#EEEEEE' align='center'>\n";
	if ($_POST['sql']) {echo "\t\t\t<input type='submit' $btstyle value='Close Window' onClick=\"window.close();\" />\n";}
	echo "\t\t</td>\n";
	echo "\t</tr>\n";
	echo "</table>\n";
	}



elseif ($action == "all")
	{
	echo "\t<tr bgcolor='#555555'><td colspan='2' height='4'><font size='1' face='verdana' color='white'><b>"._BROWSERESPONSES.":</b> <font color='#EEEEEE'>$surveyname</td></tr>\n";
//	echo "$surveyheader";
	
	
	if (!$_POST['sql'])
		{echo "$surveyoptions";} //don't show options when called from another script with a filter on
	else
		{
		echo "\n<table width='100%' align='center' border='0' bgcolor='#EFEFEF'>\n";
		echo "\t<tr>\n";
		echo "\t\t<td align='center' $singleborderstyle>$setfont\n";
		echo "\t\t\tShowing Filtered Results<br />\n";
		echo "\t\t\t&nbsp;[<a href=\"javascript:window.close()\">Close</a>]";
		echo "\t\t</td>\n";
		echo "\t</tr>\n";
		echo "</table>\n";
		
		}
	echo "</table>\n";
	//FIRST LETS GET THE NAMES OF THE QUESTIONS AND MATCH THEM TO THE FIELD NAMES FOR THE DATABASE
	$fnquery = "SELECT * FROM questions, groups, surveys WHERE questions.gid=groups.gid AND groups.sid=surveys.sid AND questions.sid='$sid' ORDER BY group_name";
	$fnresult = mysql_query($fnquery);
	$fncount = mysql_num_rows($fnresult);
	//echo "$fnquery<br /><br />\n";
	
	$fnrows = array(); //Create an empty array in case mysql_fetch_array does not return any rows
	while ($fnrow = mysql_fetch_assoc($fnresult)) {$fnrows[] = $fnrow; $private = $fnrow['private']; $datestamp=$fnrow['datestamp'];} // Get table output into array
	
	// Perform a case insensitive natural sort on group name then question title of a multidimensional array
	usort($fnrows, 'CompareGroupThenTitle');
	
	if ($private == "N") //Add token to list
		{
		$fnames[] = array("token", "Token", "Token ID", "0");
		}
	if ($datestamp == "Y") //Acd datestamp
		{
		$fnames[] = array("datestamp", "Datestamp", "Date Stamp", "0");
		}
	foreach ($fnrows as $fnrow)
		{
		if ($fnrow['type'] != "M" && $fnrow['type'] != "A" && $fnrow['type'] != "B" && $fnrow['type'] != "C" && $fnrow['type'] != "E" && $fnrow['type'] != "P" && $fnrow['type'] != "O" && $fnrow['type'] != "R")
			{
			$field = "{$fnrow['sid']}X{$fnrow['gid']}X{$fnrow['qid']}";
			$ftitle = "Grp{$fnrow['gid']}Qst{$fnrow['title']}";
			$fquestion = $fnrow['question'];
			$fnames[] = array("$field", "$ftitle", "$fquestion", "{$fnrow['gid']}");
			}
		elseif ($fnrow['type'] == "O")
			{
			$field = "{$fnrow['sid']}X{$fnrow['gid']}X{$fnrow['qid']}";
			$ftitle = "Grp{$fnrow['gid']}Qst{$fnrow['title']}";
			$fquestion = $fnrow['question'];
			$fnames[] = array("$field", "$ftitle", "$fquestion", "{$fnrow['gid']}");
			$field .= "comment";
			$ftitle .= "[comment]";
			$fquestion .= " (comment)";
			$fnames[] = array("$field", "$ftitle", "$fquestion", "{$fnrow['gid']}");
			}
		elseif ($fnrow['type'] == "R")
			{
			$i2query = "SELECT answers.*, questions.other FROM answers, questions WHERE answers.qid=questions.qid AND questions.qid={$fnrow['qid']} AND questions.sid=$sid ORDER BY answers.sortorder, answers.answer";
			$i2result = mysql_query($i2query);
			$i2count = mysql_num_rows($i2result);
			for ($i=1; $i<=$i2count; $i++)
				{
				$field = "{$fnrow['sid']}X{$fnrow['gid']}X{$fnrow['qid']}$i";
				$ftitle = "Grp{$fnrow['qid']}Qst{$fnrow['title']}Opt$i";
				$fnames[] = array("$field", "$ftitle", "{$fnrow['question']}<br />\n[$i]", "{$fnrow['gid']}");
				}
			}
		else
			{
			$i2query = "SELECT answers.*, questions.other FROM answers, questions WHERE answers.qid=questions.qid AND questions.qid={$fnrow['qid']} AND questions.sid=$sid ORDER BY answers.sortorder, answers.answer";
			$i2result = mysql_query($i2query);
			$otherexists = "";
			while ($i2row = mysql_fetch_array($i2result))
				{
				$field = "{$fnrow['sid']}X{$fnrow['gid']}X{$fnrow['qid']}{$i2row['code']}";
				$ftitle = "Grp{$fnrow['gid']}Qst{$fnrow['title']}Opt{$i2row['code']}";
				if ($i2row['other'] == "Y") {$otherexists = "Y";}
				$fnames[] = array("$field", "$ftitle", "{$fnrow['question']}<br />\n[{$i2row['answer']}]", "{$fnrow['gid']}");
				if ($fnrow['type'] == "P") {$fnames[] = array("$field"."comment", "$ftitle", "{$fnrow['question']}<br />\n[{$i2row['answer']}]<br />\n[Comment]", "{$fnrow['gid']}");}
				}
			if ($otherexists == "Y") 
				{
				$field = "{$fnrow['sid']}X{$fnrow['gid']}X{$fnrow['qid']}"."other";
				$ftitle = "Grp{$fnrow['gid']}Qst{$fnrow['title']}OptOther";
				$fnames[] = array("$field", "$ftitle", "{$fnrow['question']}<br />\n[Other]", "{$fnrow['gid']}");
				if ($fnrow['type'] == "P")
					{
					$fnames[] = array("$field"."comment", "$ftitle"."Comment", "{$fnrow['question']}<br />\n[Other]<br />\n[Comment]", "{$fnrow['gid']}");
					}
				}
			}
		//echo "$field | $ftitle | $fquestion<br />\n";
		}
	$fncount = count($fnames);
	
	//NOW LETS CREATE A TABLE WITH THOSE HEADINGS
	if ($fncount < 10) {$cellwidth = "10%";} else {$cellwidth = "100";}
	$tableheader = "\n\n<!-- DATA TABLE -->\n";
	if ($fncount < 10) {$tableheader .= "<table width='100%' border='0' cellpadding='0' cellspacing='1' style='border: 1px solid #555555'>\n";}
	else {$fnwidth = (($fncount-1)*100); $tableheader .= "<table width='$fnwidth' border='0' cellpadding='1' cellspacing='1' style='border: 1px solid #555555'>\n";}
	$tableheader .= "\t<tr bgcolor='#555555' valign='top'>\n";
	$tableheader .= "\t\t<td bgcolor='#333333'><font size='1' color='white' width='$cellwidth'><b>id</b></td>\n";
	foreach ($fnames as $fn)
		{
		if (!$currentgroup)  {$currentgroup = $fn[3]; $gbc = "#555555";}
		if ($currentgroup != $fn[3]) 
			{
			$currentgroup = $fn[3];
			if ($gbc == "#555555") {$gbc = "#666666";}
			else {$gbc = "#555555";}
			}
		$tableheader .= "\t\t<td bgcolor='$gbc'><font size='1' color='white' width='$cellwidth'><b>";
		$tableheader .= "$fn[2]";
		$tableheader .= "</b></td>\n"; 
		}
	$tableheader .= "\t</tr>\n\n";
	
	$start=returnglobal('start');
	$limit=returnglobal('limit');
	if (!isset($limit)) {$limit = 50;}
	if (!isset($start)) {$start = 0;}
		
	//LETS COUNT THE DATA
	$dtquery = "SELECT count(*) FROM $surveytable";
	$dtresult=mysql_query($dtquery);
	while ($dtrow=mysql_fetch_row($dtresult)) {$dtcount=$dtrow[0];}
	
	if ($limit > $dtcount) {$limit=$dtcount;}
	
	//NOW LETS SHOW THE DATA
	if ($_POST['sql'])
		{
		if ($_POST['sql'] == "NULL") {$dtquery = "SELECT * FROM $surveytable ORDER BY id";}
		else {$dtquery = "SELECT * FROM $surveytable WHERE ".stripcslashes($_POST['sql'])." ORDER BY id";}
		}
	else
		{
		$dtquery = "SELECT * FROM $surveytable ORDER BY id";
		}
	if ($limit && !isset($start)) {$dtquery .= " DESC LIMIT $limit";}
	if (isset($start) && isset($limit)) {$dtquery = "SELECT * FROM $surveytable LIMIT $start, $limit";}
	if (!isset($limit)) {$dtquery .= " LIMIT $limit";}
	if (!isset($start)) {$start = 0;}
	$dtresult = mysql_query($dtquery) or die("Couldn't get surveys<br />$dtquery<br />".mysql_error());
	$dtcount2 = mysql_num_rows($dtresult);
	$cells = $fncount+1;

	
	//CONTROL MENUBAR
	$last=$start-$limit;
	$next=$start+$limit;
	$end=$dtcount-$limit;
	if ($end < 0) {$end=0;}
	if ($last <0) {$last=0;}
	if ($next > $dtcount) {$next=$dtcount-$limit;}
	if ($end < 0) {$end=0;}

	echo "<table height='1'><tr><td></td></tr></table>\n";
	echo "<table width='99%' align='center' style='border: 1px solid #555555' cellpadding='1' cellspacing='0'>\n";
	echo "\t<tr bgcolor='#555555'><td colspan='2' height='4'><font size='1' face='verdana' color='white'><b>"._VIEWCONTROL.":</b></td></tr>\n";
	echo "\t<tr bgcolor='#999999'><td align='left'>\n";
	echo "\t\t\t<img src='./images/blank.gif' width='31' height='20' border='0' hspace='0' align='left'>\n";
	echo "\t\t\t<img src='./images/seperator.gif' border='0' hspace='0' align='left'>\n";
	echo "\t\t\t<input type='image' align='left' hspace='0' border='0' src='./images/databegin.gif' title='"._D_BEGIN."' onClick=\"window.open('browse.php?action=all&sid=$sid&start=0&limit=$limit','_top')\" />\n";
	echo "\t\t\t<input type='image' align='left' hspace='0' border='0' src='./images/databack.gif' title='"._D_BACK."' onClick=\"window.open('browse.php?action=all&sid=$sid&surveytable=$surveytable&start=$last&limit=$limit','_top')\" />\n";
	echo "\t\t\t<img src='./images/blank.gif' width='13' height='20' border='0' hspace='0' align='left'>\n";
	echo "\t\t\t<input type='image' align='left' hspace='0' border='0' src='./images/dataforward.gif' title='"._D_FORWARD."' onClick=\"window.open('browse.php?action=all&sid=$sid&surveytable=$surveytable&start=$next&limit=$limit','_top')\" />\n";
	echo "\t\t\t<input type='image' align='left' hspace='0' border='0' src='./images/dataend.gif' title='"._D_END."' onClick=\"window.open('browse.php?action=all&sid=$sid&start=$end&limit=$limit','_top')\" />\n";
	echo "\t\t\t<img src='./images/seperator.gif' border='0' hspace='0' align='left'>\n";
	echo "\t\t</td>\n";
	echo "\t\t<form action='browse.php'>\n";
	echo "\t\t<td align='right'><font size='1' face='verdana'>\n";
	echo "\t\t\t<img src='./images/blank.gif' width='31' height='20' border='0' hspace='0' align='right'>\n";
	echo "\t\t\t"._BR_DISPLAYING."<input type='text' $slstyle size='4' value='$dtcount2' name='limit'>\n";
	echo "\t\t\t"._BR_STARTING."<input type='text' $slstyle size='4' value='$start' name='start'>\n";
	echo "\t\t\t<input type='submit' value='"._BR_SHOW."' $btstyle>\n";
	echo "\t\t</font></td>\n";
	echo "\t\t<input type='hidden' name='sid' value='$sid'>\n";
	echo "\t\t<input type='hidden' name='action' value='all'>\n";
	echo "\t\t</form>\n";
	echo "\t</tr>\n";
	echo "</table>\n";	
	echo "<table height='1'><tr><td></td></tr></table>\n";

	echo $tableheader;
	
	while ($dtrow = mysql_fetch_assoc($dtresult))
		{
		if (!$bgcc) {$bgcc="#EEEEEE";}
		else
			{
			if ($bgcc == "#EEEEEE") {$bgcc = "#CCCCCC";}
			else {$bgcc = "#EEEEEE";}
			}
		echo "\t<tr bgcolor='$bgcc' valign='top'>\n";
		
		echo "\t\t<td align='center'><font size='1'>\n";
		echo "\t\t\t<a href='browse.php?sid=$sid&action=id&id={$dtrow['id']}' title='View this record'>";
		echo "{$dtrow['id']}</a>\n";
		
		$i = 0;
		if ($private == "N")
			{
			$SQL = "Select * FROM tokens_$sid WHERE token='{$dtrow['token']}'";
			$SQLResult = mysql_query($SQL) or die(mysql_error());
			$TokenRow = mysql_fetch_assoc($SQLResult);
			echo "\t\t<td align='center'><font size='1'>\n";
			echo "\t\t<a href='tokens.php?sid=$sid&action=edit&tid={$TokenRow['tid']}' title='Edit this token'>";
			echo "{$dtrow['token']}</a>\n";
			$i++;
			}
		
		for ($i; $i<$fncount; $i++)
			{
			echo "\t\t<td align='center'><font size='1'>";
			echo htmlspecialchars($dtrow[$fnames[$i][0]]);
			echo "</td>\n";
			}
		echo "\t</tr>\n";
		}
	echo "</table>\n<br />\n";
	
	}
else
	{
	echo "\t<tr bgcolor='#555555'><td colspan='2' height='4'><font size='1' face='verdana' color='white'><b>"._BROWSERESPONSES.":</b> <font color='#EEEEEE'>$surveyname</td></tr>\n";
	echo "$surveyoptions";
	$gnquery = "SELECT count(id) FROM $surveytable";
	$gnresult = mysql_query($gnquery);
	while ($gnrow = mysql_fetch_row($gnresult))
		{
		echo "<table width='100%' border='0'>\n";
		echo "\t<tr><td align='center'>$setfont$gnrow[0] entries in this database</td></tr>\n";
		echo "</table>\n";
		}
	}
echo htmlfooter("instructions.html#browse", "Using PHPSurveyors Browse Function");

echo "</td></tr></table>\n";
echo "</body>\n</html>\n";

?>