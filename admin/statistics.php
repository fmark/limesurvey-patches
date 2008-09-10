<?php
/*
* LimeSurvey
* Copyright (C) 2007 The LimeSurvey Project Team / Carsten Schmitz
* All rights reserved.
* License: GNU/GPL License v2 or later, see LICENSE.php
* LimeSurvey is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
* 
* $Id$
* 
* Edits bei Mazi marked as "MM" (2008-07-29)
* 
*/

/* 
 * We need this later:
 *  1 - Array (Flexible Labels) Dual Scale ),
	5 - 5 Point Choice 
	A - Array (5 Point Choice) 
	B - Array (10 Point Choice) 
	C - Array (Yes/No/Uncertain) 
	D - Date 
	E - Array (Increase, Same, Decrease) 
	F - Array (Flexible Labels) 
	G - Gender 
	H - Array (Flexible Labels) by Column 
	I - Language Switch 
	K - Multiple Numerical Input 
	L - List (Radio) 
	M - Multiple Options 
	N - Numerical Input 
	O - List With Comment 
	P - Multiple Options With Comments 
	Q - Multiple Short Text 
	R - Ranking 
	S - Short Free Text 
	T - Long Free Text 
	U - Huge Free Text 
	W - List (Flexible Labels) (Dropdown) 
	X - Boilerplate Question 
	Y - Yes/No 
	Z - List (Flexible Labels) (Radio) 
	! - List (Dropdown)
 */

//TODO: - Use real question and answer title and cut them off after X chars. 
//		- Use tooltipps to show additional information like whole question/answer text


//MM: This setting will be put into config-defaults.php later
$showaggregateddata = 0;


//don't call this script directly!
if (isset($_REQUEST['jpgraphdir'])) {die('You cannot start this script directly');}

//some includes, the progressbar is used to show a progressbar while generating the graphs
include_once("login_check.php");
require_once('classes/core/class.progressbar.php');

//we collect all the output within this variable
$statisticsoutput ='';

//for creating graphs we need some more scripts which are included here
if ($usejpgraph == 1 && isset($jpgraphdir)) //JPGRAPH CODING SUBMITTED BY Pieterjan Heyse
{
  if (isset($jpgraphfontdir) && $jpgraphfontdir!="")
  {
  DEFINE("TTF_DIR",$jpgraphfontdir); // url of fonts files
  }
	require_once ("$jpgraphdir/jpgraph.php");
	require_once ("$jpgraphdir/jpgraph_pie.php");
	require_once ("$jpgraphdir/jpgraph_pie3d.php");
	require_once ("$jpgraphdir/jpgraph_bar.php");


	//$currentuser is created as prefix for jpgraph files
	if (isset($_SERVER['REDIRECT_REMOTE_USER']))
	{
		$currentuser=$_SERVER['REDIRECT_REMOTE_USER'];
	}
	elseif (session_id())
	{
		$currentuser=substr(session_id(), 0, 15);
	}
	else
	{
		$currentuser="standard";
	}
}

// This gets all the 'to be shown questions' from the POST and puts these into an array 
$summary=returnglobal('summary');

//if $summary isn't an array we create one
if (isset($summary) && !is_array($summary)) {
	$summary = explode("+", $summary);
}

//no survey ID? -> come and get one
if (!isset($surveyid)) {$surveyid=returnglobal('sid');}

//still no survey ID -> error
if (!$surveyid)
{
	//need to have a survey id
	$statisticsoutput .= "<center>You have not selected a survey!</center>";
	exit;
}

// Set language for questions and labels to base language of this survey
$language = GetBaseLanguageFromSurveyID($surveyid);

//Delete any stats files from the temp directory that aren't from today.
deleteNotPattern($tempdir, "STATS_*.png","STATS_".date("d")."*.png");

//hide/show the filter
//filtersettings by default aren't shown when showing the results
$statisticsoutput .= "\t<script type='text/javascript'>
      <!--
       function hide(element) {
        document.getElementById(element).style.display='none';
       }
       function show(element) {
        document.getElementById(element).style.display='';
       }
      //-->
      </script>\n";


//Get the menubar with all icons for available statistic options
$statisticsoutput .= browsemenubar($clang->gT("Quick Statistics"))
//second row below options -> filter settings headline
."<table width='99%' align='center' style='border: 1px solid #555555' cellpadding='1'"
." cellspacing='0'>\n"
."<tr><td align='center' class='settingcaption' height='22'>"
."<input type='image' src='$imagefiles/plus.gif' align='right' onclick='show(\"filtersettings\")' /><input type='image' src='$imagefiles/minus.gif' align='right' onclick='hide(\"filtersettings\")' />"
."<font size='2'><strong>".$clang->gT("Filter Settings")."</strong></font>"
."</td></tr>\n"
."</table>\n"

//we need a form which can pass the selected data later
."<form method='post' name='formbuilder' action='$scriptname?action=statistics'>\n"

//table which holds all the filter forms
."<table width='99%' align='center' style='border: 1px solid #555555' cellpadding='1' cellspacing='0'>\n";


//Select public language file
$query = "SELECT datestamp FROM {$dbprefix}surveys WHERE sid=$surveyid";
$result = db_execute_assoc($query) or safe_die("Error selecting language: <br />".$query."<br />".$connect->ErrorMsg());       

/*
 * check if there is a datestamp available for this survey
 * yes -> $datestamp="Y"
 * no -> $datestamp="N"
 */
while ($row=$result->FetchRow()) {$datestamp=$row['datestamp'];}



		// 1: Get list of questions from survey
		
/*
 * We want to have the following data
 * a) "questions" -> all table namens, e.g.
 * qid
 * sid
 * gid
 * type
 * title
 * question
 * preg
 * help
 * other
 * mandatory
 * lid
 * lid1
 * question_order
 * language
 * 
 * b) "groups" -> group_name + group_order * 
 */
$query = "SELECT ".db_table_name("questions").".*, group_name, group_order\n"
."FROM ".db_table_name("questions").", ".db_table_name("groups")."\n"
."WHERE ".db_table_name("groups").".gid=".db_table_name("questions").".gid\n"
."AND ".db_table_name("groups").".language='".$language."'\n"
."AND ".db_table_name("questions").".language='".$language."'\n"
."AND ".db_table_name("questions").".sid=$surveyid";
$result = db_execute_assoc($query) or safe_die("Couldn't do it!<br />$query<br />".$connect->ErrorMsg());

//store all the data in $rows
$rows = $result->GetRows();

//SORT IN NATURAL ORDER!
usort($rows, 'CompareGroupThenTitle');

//put the question information into the filter array
foreach ($rows as $row)
{
	//store some column names in $filters array
	$filters[]=array($row['qid'],
	$row['gid'],
	$row['type'],
	$row['title'],
	$row['group_name'],
	strip_tags($row['question']),
	$row['lid'],
    $row['lid1']);
}

//var_dump($filters);
// SHOW ID FIELD

//some more output: I = filter by ID
$statisticsoutput .= "\t\t<tr><td align='center'>
       <table cellspacing='0' cellpadding='0' width='100%' id='filtersettings'><tr><td>
        <table align='center'><tr>\n";

$myfield = "id";
$myfield2=$myfield."G";	//greater than field
$myfield3=$myfield."L";	//less than field
$myfield4=$myfield."=";	//equals field
$statisticsoutput .= "<td align='center'><strong>".$clang->gT("ID")."</strong><br />";
$statisticsoutput .= "\t\t\t\t\t<font size='1'>".$clang->gT("Number greater than").":<br />\n"
."\t\t\t\t\t<input type='text' name='$myfield2' value='";
if (isset($_POST[$myfield2])){$statisticsoutput .= $_POST[$myfield2];}
$statisticsoutput .= "' onkeypress=\"return goodchars(event,'0123456789')\" /><br />\n"
."\t\t\t\t\t".$clang->gT("Number Less Than").":<br />\n"
."\t\t\t\t\t<input type='text' name='$myfield3' value='";
if (isset($_POST[$myfield3])) {$statisticsoutput .= $_POST[$myfield3];}
$statisticsoutput .= "' onkeypress=\"return goodchars(event,'0123456789')\" /><br />\n";
$statisticsoutput .= "\t\t\t\t\t=<br />
            <input type='text' name='$myfield4' value='";
if (isset($_POST[$myfield4])) {$statisticsoutput .= $_POST[$myfield4];}
$statisticsoutput .= "' onkeypress=\"return goodchars(event,'0123456789')\" /><br /></font></td>\n";
$allfields[]=$myfield2;
$allfields[]=$myfield3;
$allfields[]=$myfield4;

//if the survey contains timestamps you can filter by timestamp, too
if (isset($datestamp) && $datestamp == "Y") {
	$myfield = "datestamp";		//timestamp equals
	$myfield2 = "datestampG";	//timestamp greater than
	$myfield3 = "datestampL";	//timestamp less than
	$myfield2="$myfield";
	$myfield3="$myfield2=";
	$myfield4="$myfield2<"; 
	$myfield5="$myfield2>";
	
	$statisticsoutput .= "<td width='40'></td>";
	$statisticsoutput .= "\t\t\t\t<td align='center' valign='top'><strong>".$clang->gT("Datestamp")."</strong>"
	."<br />\n"
	."\t\t\t\t\t<font size='1'>".$clang->gT("Date (YYYY-MM-DD) equals").":<br />\n"
	."\t\t\t\t\t<input name='$myfield3' type='text' value='";
	if (isset($_POST[$myfield3])) {$statisticsoutput .= $_POST[$myfield3];}
	$statisticsoutput .= "' /><br />\n"
	."\t\t\t\t\t&nbsp;&nbsp;".$clang->gT("OR between").":<br />\n"
	."\t\t\t\t\t<input name='$myfield4' value='";
	if (isset($_POST[$myfield4])) {$statisticsoutput .= $_POST[$myfield4];}
	$statisticsoutput .= "' type='text' /> ".$clang->gT("and")." <input  name='$myfield5' value='";
	if (isset($_POST[$myfield5])) {$statisticsoutput .= $_POST[$myfield5];}
	$statisticsoutput .= "' type='text' /></font></td>\n";
	$allfields[]=$myfield2;
	$allfields[]=$myfield3;
	$allfields[]=$myfield4;
	$allfields[]=$myfield5;
}
$statisticsoutput .= "</tr></table></td></tr>";	//close table with filter by ID or timestamp forms




		// 2: Get answers for each question
		
//is there a currentgroup set?
if (!isset($currentgroup)) {$currentgroup="";}

/*
 * let's go through the filter array which contains
 * 	['qid'],
	['gid'],
	['type'],
	['title'],
	['group_name'],
	['question'],
	['lid'],
    ['lid1']);
 */
foreach ($filters as $flt)
{
	//does gid equal $currentgroup?
	if ($flt[1] != $currentgroup)	
	{   
		//If the groupname has changed, start a new row
		if ($currentgroup)
		{
			//if we've already drawn a table for a group, and we're changing - close off table
			$statisticsoutput .= "\n\t\t\t\t<!-- --></tr>\n\t\t\t</table></td></tr>\n";
		}
		
		$statisticsoutput .= "\t\t<tr><td align='center' class='settingcaption'>\n"
		
		//use current groupname and groupid as heading 
		."\t\t<font size='1'><strong>$flt[4]</strong> (".$clang->gT("Group")." $flt[1])</font></td></tr>\n\t\t"
		."<tr><td align='center'>\n"
		."\t\t\t<table align='center' width='70%' class='statisticstable'><tr>\n";
		
		//counter which is used to adapt layout depending on counter #
		$counter=0;
	}
	
	//we don't want more than 4 questions in a row
	if (isset($counter) && $counter == 4) {$statisticsoutput .= "\t\t\t\t</tr>\n\t\t\t\t<tr>"; $counter=0;}
	
	/*
	 * remember: $flt is structured like this
	 *  ['qid'],
		['gid'],
		['type'],
		['title'],
		['group_name'],
		['question'],
		['lid'],
	    ['lid1']);
	 */

	//SGQ identifier
	$myfield = "{$surveyid}X{$flt[1]}X{$flt[0]}";
	
	//full question title
	$niceqtext = FlattenText($flt[5]);
	
	/*
	 * Check question type: This question types will be used (all others are separated in the if clause)
	 *  5 - 5 Point Choice 
		G - Gender  
		I - Language Switch 
		L - List (Radio) 
		M - Multiple Options 
		N - Numerical Input 
		O - List With Comment 
		P - Multiple Options With Comments 
		Y - Yes/No 
		! - List (Dropdown) )
	 */
	if ($flt[2] != "A" && $flt[2] != "B" && $flt[2] != "C" && $flt[2] != "E" && 
	    $flt[2] != "F" && $flt[2] != "H" && $flt[2] != "T" && $flt[2] != "U" && 
		$flt[2] != "S" && $flt[2] != "D" && $flt[2] != "R" && $flt[2] != "Q" && $flt[2] != "1" && 
		$flt[2] != "X" && $flt[2] != "W" && $flt[2] != "Z" && $flt[2] != "K") //Have to make an exception for these types!
	{
		$statisticsoutput .= "\t\t\t\t<td align='center'>"
		."<strong>$flt[3]&nbsp;"; //Heading (Question No)
		
		//multiple options:
		if ($flt[2] == "M" || $flt[2] == "P") {$myfield = "M$myfield";}
		
		//numerical input will get special treatment (arihtmetic mean, standard derivation, ...)
		if ($flt[2] == "N") {$myfield = "N$myfield";}
		$statisticsoutput .= "<input type='checkbox' class='checkboxbtn' name='summary[]' value='$myfield'";
		
		/*
		 * one of these conditions has to be true
		 * 1. SGQ can be found within the summary array
		 * 2. M-SGQ can be found within the summary array (M = multiple options)
		 * 3. N-SGQ can be found within the summary array (N = numerical input)
		 * 
		 * Always remember that we just have very few question types that are checked here
		 * due to the if ouside this section!
		 * 
		 * Auto-check the question types mentioned above
		 */
		if (isset($summary) && (array_search("{$surveyid}X{$flt[1]}X{$flt[0]}", $summary) !== FALSE  || array_search("M{$surveyid}X{$flt[1]}X{$flt[0]}", $summary) !== FALSE || array_search("N{$surveyid}X{$flt[1]}X{$flt[0]}", $summary) !== FALSE))
		{$statisticsoutput .= " checked='checked'";}
		
		//show speaker symbol which contains full question text
		$statisticsoutput .= " />&nbsp;".showSpeaker($niceqtext)."</strong>"
		."<br />\n";
		
		//numerical question type -> add some HTML to the output
		if ($flt[2] == "N") {$statisticsoutput .= "</font>";}
		if ($flt[2] != "N") {$statisticsoutput .= "\t\t\t\t<select name='";}
		
		//multiple options ("M"/"P") -> add "M" to output 
		if ($flt[2] == "M" || $flt[2] == "P") {$statisticsoutput .= "M";}
		
		//numerical -> add SGQ to output
		if ($flt[2] != "N") {$statisticsoutput .= "{$surveyid}X{$flt[1]}X{$flt[0]}[]' multiple='multiple'>\n";}
		
		//Add the field name into the allfields array, which is used later to know which are the available fields for selection
		$allfields[]=$myfield;
		
	}	//end if -> filter certain question types

	$statisticsoutput .= "\t\t\t\t\t<!-- QUESTION TYPE = $flt[2] -->\n";
	/////////////////////////////////////////////////////////////////////////////////////////////////
	//This section presents the filter list, in various different ways depending on the question type
	/////////////////////////////////////////////////////////////////////////////////////////////////
	
	//let's switch through the question type for each question
	switch ($flt[2])
	{
		case "K": // Multiple Numerical
		$statisticsoutput .= "\t\t\t\t\t</tr>\n\t\t\t\t\t<tr>\n";
		
		//get answers
		$query = "SELECT code, answer FROM ".db_table_name("answers")." WHERE qid='$flt[0]' AND language = '{$language}' ORDER BY sortorder, answer";
		$result = db_execute_num($query) or safe_die ("Couldn't get answers!<br />$query<br />".$connect->ErrorMsg());
		
		//counter is used for layout
		$counter2=0;
		
		//go through all the (multiple) answers
		while ($row=$result->FetchRow())
		{
			/*
			 * filter form for numerical input
			 * - checkbox
			 * - greater than
			 * - less than
			 */
		    $myfield1="K".$myfield.$row[0];
		    $myfield2="K{$myfield}".$row[0]."G";
		    $myfield3="K{$myfield}".$row[0]."L";
			if ($counter2 == 4) {$statisticsoutput .= "\t\t\t\t</tr>\n\t\t\t\t<tr>\n"; $counter2=0;}
			//question short code
			$statisticsoutput .= "\t\t\t\t<td align='center' valign='top'><strong>$flt[3]-".$row[0]."</strong>";
			//checkbox
			$statisticsoutput .= "<input type='checkbox' class='checkboxbtn' name='summary[]' value='$myfield1'";
			//check SGQA -> do we want to pre-check the checkbox?
			if (isset($summary) && (array_search("K{$surveyid}X{$flt[1]}X{$flt[0]}{$row[0]}", $summary) !== FALSE))
			{$statisticsoutput .= " checked='checked'";}
			$statisticsoutput .= " />&nbsp;&nbsp;";
			//show speaker
		    $statisticsoutput .= showSpeaker(FlattenText($row[1]))."<br />\n";
		    //input fields
		    $statisticsoutput .= "\t\t\t\t\t<font size='1'>".$clang->gT("Number greater than").":</font><br />\n"
		    ."\t\t\t\t\t<input type='text' name='$myfield2' value='";
		    if (isset($_POST[$myfield2])){$statisticsoutput .= $_POST[$myfield2];}
		    //check number input using JS
		    $statisticsoutput .= "' onkeypress=\"return goodchars(event,'0123456789.,')\" /><br />\n"
		    ."\t\t\t\t\t".$clang->gT("Number Less Than").":<br />\n"
		    ."\t\t\t\t\t<input type='text' name='$myfield3' value='";
		    if (isset($_POST[$myfield3])) {$statisticsoutput .= $_POST[$myfield3];}
		    $statisticsoutput .= "' onkeypress=\"return goodchars(event,'0123456789.,')\" /><br />\n";
			
		    //we added 1 form -> increase counter
		    $counter2++;
			
			//add fields to array which contains all fields names
			$allfields[]=$myfield1;
		    $allfields[]=$myfield2;
		    $allfields[]=$myfield3;
		}
		break;
		
		
		
		case "Q": // Multiple Short Text
			
		//new section
		$statisticsoutput .= "\t\t\t\t</tr>\n\t\t\t\t<tr>\n";
		
		//get answers
		$query = "SELECT code, answer FROM ".db_table_name("answers")." WHERE qid='$flt[0]' AND language='{$language}' ORDER BY sortorder, answer";
		$result = db_execute_num($query) or safe_die ("Couldn't get answers!<br />$query<br />".$connect->ErrorMsg());
		$counter2=0;
		
		//loop through all answers
		while ($row = $result->FetchRow())
		{
			//collecting data for output, for details see above (question type "N")
			
			//we have one input field for each answer
			$myfield2 = "Q".$myfield."$row[0]";
			if ($counter2 == 4) {$statisticsoutput .= "\t\t\t\t</tr>\n\t\t\t\t<tr>\n"; $counter2=0;}
			
			$statisticsoutput .= "\t\t\t\t<td align='center' valign='top'><strong>$flt[3]-".$row[0]."</strong></font>";
			$statisticsoutput .= "<input type='checkbox' class='checkboxbtn' name='summary[]' value='$myfield2'";
			if (isset($summary) && (array_search("Q{$surveyid}X{$flt[1]}X{$flt[0]}{$row[0]}", $summary) !== FALSE))
			{$statisticsoutput .= " checked='checked'";}
			
			$statisticsoutput .= " />&nbsp;&nbsp;";
		    $statisticsoutput .= showSpeaker(FlattenText($row[1]))
			."<br />\n"
			."\t\t\t\t\t<font size='1'>".$clang->gT("Responses Containing").":</font><br />\n"
			."\t\t\t\t\t<input type='text' name='$myfield2' value='";
			if (isset($_POST[$myfield2]))
			{$statisticsoutput .= $_POST[$myfield2];}
			
			$statisticsoutput .= "' />";
			$counter2++;
			$allfields[]=$myfield2;
		}
		$statisticsoutput .= "\t\t\t\t</tr>\n\t\t\t\t<tr>\n";
		$counter=0;
		break;
		
		
		
		/*
		 * all "free text" types (T, U, S)  get the same prefix ("T")
		 */
		case "T": // Long free text
		case "U": // Huge free text
			
		$myfield2="T$myfield";
		$statisticsoutput .= "\t\t\t\t<td align='center' valign='top'>"
		."<strong>$flt[3]</strong></font>";
		$statisticsoutput .= "<input type='checkbox' class='checkboxbtn' name='summary[]' value='$myfield2'";
		if (isset($summary) && (array_search("T{$surveyid}X{$flt[1]}X{$flt[0]}", $summary) !== FALSE))
		{$statisticsoutput .= " checked='checked'";}
		
		$statisticsoutput .= " />&nbsp;"
		."&nbsp;".showSpeaker($niceqtext)
		."<br />\n"
		."\t\t\t\t\t<font size='1'>".$clang->gT("Responses Containing").":</font><br />\n"
		."\t\t\t\t\t<textarea name='$myfield2' rows='3' cols='80'>";
		
		if (isset($_POST[$myfield2])) {$statisticsoutput .= $_POST[$myfield2];}
		
		$statisticsoutput .= "</textarea>";
		$allfields[]=$myfield2;
		break;
		
		
		
		case "S": // Short free text
			
		$myfield2="T$myfield";
		$statisticsoutput .= "\t\t\t\t<td align='center' valign='top'>"
		."<strong>$flt[3]</strong>";
		$statisticsoutput .= "<input type='checkbox' class='checkboxbtn' name='summary[]' value='$myfield2'";
		
		if (isset($summary) && (array_search("T{$surveyid}X{$flt[1]}X{$flt[0]}", $summary) !== FALSE))
		{$statisticsoutput .= " checked='checked'";}
		
		$statisticsoutput .= " />&nbsp;"
		."&nbsp;".showSpeaker($niceqtext)
		."<br />\n"
		."\t\t\t\t\t<font size='1'>".$clang->gT("Responses Containing").":</font><br />\n"
		."\t\t\t\t\t<input type='text' name='$myfield2' value='";
		
		if (isset($_POST[$myfield2])) {$statisticsoutput .= $_POST[$myfield2];}
		
		$statisticsoutput .= "' />";
		$allfields[]=$myfield2;
		break;
		
		
		
		case "N": // Numerical
		
		//textfields for greater and less than X
		$myfield2="{$myfield}G";
		$myfield3="{$myfield}L";
		$statisticsoutput .= "\t\t\t\t\t<font size='1'>".$clang->gT("Number greater than").":</font><br />\n"
		."\t\t\t\t\t<input type='text' name='$myfield2' value='";
		
		if (isset($_POST[$myfield2])){$statisticsoutput .= $_POST[$myfield2];}
		
		$statisticsoutput .= "' onkeypress=\"return goodchars(event,'0123456789.,')\" /><br />\n"
		."\t\t\t\t\t".$clang->gT("Number Less Than").":<br />\n"
		."\t\t\t\t\t<input type='text' name='$myfield3' value='";
		
		if (isset($_POST[$myfield3])) {$statisticsoutput .= $_POST[$myfield3];}
		
		//only numeriacl input allowed -> check using JS
		$statisticsoutput .= "' onkeypress=\"return goodchars(event,'0123456789.,')\" /><br />\n";
		
		//put field names into array
		$allfields[]=$myfield2;
		$allfields[]=$myfield3;
		
		break;
		
		
		
		case "D": // Date
		
		/*
		 * - input name
		 * - date equals
		 * - date less than
		 * - date greater than
		 */
		$myfield2="D$myfield";
		$myfield3="$myfield2=";
		$myfield4="$myfield2<"; 
        $myfield5="$myfield2>";
		$statisticsoutput .= "\t\t\t\t<td align='center' valign='top'><strong>$flt[3]</strong>"
		."&nbsp;".showSpeaker($niceqtext)
		."<br />\n"
		."\t\t\t\t\t<font size='1'>".$clang->gT("Date (YYYY-MM-DD) equals").":<br />\n"
		."\t\t\t\t\t<input name='$myfield3' type='text' value='";
		
		if (isset($_POST[$myfield3])) {$statisticsoutput .= $_POST[$myfield3];}
		
		$statisticsoutput .= "' /><br />\n"
		."\t\t\t\t\t&nbsp;&nbsp;".$clang->gT("OR between").":<br />\n"
		."\t\t\t\t\t<input name='$myfield4' value='";
		
		if (isset($_POST[$myfield4])) {$statisticsoutput .= $_POST[$myfield4];}
		
		$statisticsoutput .= "' type='text' /> "
		                   .$clang->gT("and")." <input  name='$myfield5' value='";
		
		if (isset($_POST[$myfield5])) {$statisticsoutput .= $_POST[$myfield5];}
		
		$statisticsoutput .= "' type='text' /></font>\n";
        $allfields[]=$myfield3;
        $allfields[]=$myfield4;
        $allfields[]=$myfield5;
		break;
		
		
		
		case "5": // 5 point choice
			
		//we need a list of 5 entries
		for ($i=1; $i<=5; $i++)
		{
			$statisticsoutput .= "\t\t\t\t\t<option value='$i'";
			
			//pre-select values which were marked before
			if (isset($_POST[$myfield]) && is_array($_POST[$myfield]) && in_array($i, $_POST[$myfield]))
			{$statisticsoutput .= " selected";}
			
			$statisticsoutput .= ">$i</option>\n";
		}
		
		//End the select which starts before the CASE statement (around line 383)
		$statisticsoutput .="\t\t\t\t</select></font>\n";
		break;
		
		
		
		case "G": // Gender
		$statisticsoutput .= "\t\t\t\t\t<option value='F'";
		
		//pre-select values which were marked before
		if (isset($_POST[$myfield]) && is_array($_POST[$myfield]) && in_array("F", $_POST[$myfield])) {$statisticsoutput .= " selected";}
		
		$statisticsoutput .= ">".$clang->gT("Female")."</option>\n";
		$statisticsoutput .= "\t\t\t\t\t<option value='M'";
		
		//pre-select values which were marked before
		if (isset($_POST[$myfield]) && is_array($_POST[$myfield]) && in_array("M", $_POST[$myfield])) {$statisticsoutput .= " selected";}
		
		$statisticsoutput .= ">".$clang->gT("Male")."</option>\n\t\t\t\t</select></font>\n";
		break;
		
		
		
		case "Y": // Yes\No
		$statisticsoutput .= "\t\t\t\t\t<option value='Y'";
		
		//pre-select values which were marked before
		if (isset($_POST[$myfield]) && is_array($_POST[$myfield]) && in_array("Y", $_POST[$myfield])) {$statisticsoutput .= " selected";}
		
		$statisticsoutput .= ">".$clang->gT("Yes")."</option>\n"
		."\t\t\t\t\t<option value='N'";
		
		//pre-select values which were marked before
		if (isset($_POST[$myfield]) && is_array($_POST[$myfield]) && in_array("N", $_POST[$myfield])) {$statisticsoutput .= " selected";}
		
		$statisticsoutput .= ">".$clang->gT("No")."</option></select></font>\n";
		break;
		

		
		case "I": // Language
		$survlangs = GetAdditionalLanguagesFromSurveyID($surveyid);
		$survlangs[] = GetBaseLanguageFromSurveyID($surveyid);
		foreach ($survlangs  as $availlang)
		{
			$statisticsoutput .= "\t\t\t\t\t<option value='".$availlang."'";
			
			//pre-select values which were marked before
			if (isset($_POST[$myfield]) && is_array($_POST[$myfield]) && in_array($availlang, $_POST[$myfield])) 
				{$statisticsoutput .= " selected";}
				
			$statisticsoutput .= ">".getLanguageNameFromCode($availlang,false)."</option>\n";
		}
		break;
		
		
		
		//----------------------- ARRAYS --------------------------
		
		case "A": // ARRAY OF 5 POINT CHOICE QUESTIONS			
			
		$statisticsoutput .= "\t\t\t\t</tr>\n\t\t\t\t<tr>\n";
		
		//get answers
		$query = "SELECT code, answer FROM ".db_table_name("answers")." WHERE qid='$flt[0]' AND language='{$language}' ORDER BY sortorder, answer";
		$result = db_execute_num($query) or safe_die ("Couldn't get answers!<br />$query<br />".$connect->ErrorMsg());
		$counter2=0;
		
		//check all the results
		while ($row=$result->FetchRow())
		{
			$myfield2 = $myfield.$row[0];
			$statisticsoutput .= "<!-- $myfield2 - ";
			
			if (isset($_POST[$myfield2])) {$statisticsoutput .= $_POST[$myfield2];}
			
			$statisticsoutput .= " -->\n";
			
			if ($counter2 == 4) {$statisticsoutput .= "\t\t\t\t</tr>\n\t\t\t\t<tr>\n"; $counter2=0;}

			$statisticsoutput .= "\t\t\t\t<td align='center'><b>$flt[3] ($row[0])</b>"
			."<input type='checkbox' class='checkboxbtn' name='summary[]' value='$myfield2'";
			
			//pre-check
			if (isset($summary) && array_search($myfield2, $summary)!== FALSE) {$statisticsoutput .= " checked='checked'";}
			
			$statisticsoutput .= " />&nbsp;"
			.showSpeaker($niceqtext." ".str_replace("'", "`", $row[1]))
			."<br />\n"
			."\t\t\t\t<select name='{$surveyid}X{$flt[1]}X{$flt[0]}{$row[0]}[]' multiple='multiple'>\n";
			
			//there are always exactly 5 values which have to be listed
			for ($i=1; $i<=5; $i++)
			{
				$statisticsoutput .= "\t\t\t\t\t<option value='$i'";
				
				//pre-select
				if (isset($_POST[$myfield2]) && is_array($_POST[$myfield2]) && in_array($i, $_POST[$myfield2])) {$statisticsoutput .= " selected";}
				if (isset($_POST[$myfield2]) && $_POST[$myfield2] == $i) {$statisticsoutput .= " selected";}
				
				$statisticsoutput .= ">$i</option>\n";
			}
			
			$statisticsoutput .= "\t\t\t\t</select>\n\t\t\t\t</font></td>\n";
			$counter2++;
			
			//add this to all the other fields
			$allfields[]=$myfield2;
		}
		
		$statisticsoutput .= "\t\t\t\t</tr>\n\t\t\t\t<tr>\n";
		$counter=0;
		break;
		
		
		
		//just like above only a different loop
		case "B": // ARRAY OF 10 POINT CHOICE QUESTIONS
		$statisticsoutput .= "\t\t\t\t</tr>\n\t\t\t\t<tr>\n";
		$query = "SELECT code, answer FROM ".db_table_name("answers")." WHERE qid='$flt[0]' AND language='{$language}' ORDER BY sortorder, answer";
		$result = db_execute_num($query) or safe_die ("Couldn't get answers!<br />$query<br />".$connect->ErrorMsg());
		$counter2=0;
		while ($row=$result->FetchRow())
		{
			$myfield2 = $myfield . "$row[0]";
			$statisticsoutput .= "<!-- $myfield2 - ";
			
			if (isset($_POST[$myfield2])) {$statisticsoutput .= $_POST[$myfield2];}
			
			$statisticsoutput .= " -->\n";
			
			if ($counter2 == 4) {$statisticsoutput .= "\t\t\t\t</tr>\n\t\t\t\t<tr>\n"; $counter2=0;}

			$statisticsoutput .= "\t\t\t\t<td align='center'><b>$flt[3] ($row[0])</b>"; //heading
			$statisticsoutput .= "<input type='checkbox' class='checkboxbtn' name='summary[]' value='$myfield2'";
			
			if (isset($summary) && array_search($myfield2, $summary)!== FALSE) {$statisticsoutput .= " checked='checked'";}
			
			$statisticsoutput .= " />&nbsp;"
			.showSpeaker($niceqtext." ".str_replace("'", "`", $row[1]))
			."<br />\n"
			."\t\t\t\t<select name='{$surveyid}X{$flt[1]}X{$flt[0]}{$row[0]}[]' multiple='multiple'>\n";
			
			//here wo loop through 10 entries to create a larger output form
			for ($i=1; $i<=10; $i++)
			{
				$statisticsoutput .= "\t\t\t\t\t<option value='$i'";
				if (isset($_POST[$myfield2]) && is_array($_POST[$myfield2]) && in_array($i, $_POST[$myfield2])) {$statisticsoutput .= " selected";}
				if (isset($_POST[$myfield2]) && $_POST[$myfield2] == $i) {$statisticsoutput .= " selected";}
				$statisticsoutput .= ">$i</option>\n";
			}
			
			$statisticsoutput .= "\t\t\t\t</select>\n\t\t\t\t</td>\n";
			$counter2++;
			$allfields[]=$myfield2;
		}
		
		$statisticsoutput .= "\t\t\t\t</tr>\n\t\t\t\t<tr>\n";
		$counter=0;
		break;
		
		
		
		case "C": // ARRAY OF YES\No\$clang->gT("Uncertain") QUESTIONS
		$statisticsoutput .= "\t\t\t\t</tr>\n\t\t\t\t<tr>\n";
		
		//get answers
		$query = "SELECT code, answer FROM ".db_table_name("answers")." WHERE qid='$flt[0]' AND language='{$language}' ORDER BY sortorder, answer";
		$result = db_execute_num($query) or safe_die ("Couldn't get answers!<br />$query<br />".$connect->ErrorMsg());
		$counter2=0;
		
		//loop answers
		while ($row=$result->FetchRow())
		{
			$myfield2 = $myfield . "$row[0]";
			$statisticsoutput .= "<!-- $myfield2 - ";
			
			if (isset($_POST[$myfield2])) {$statisticsoutput .= $_POST[$myfield2];}
			
			$statisticsoutput .= " -->\n";
			
			if ($counter2 == 4) {$statisticsoutput .= "\t\t\t\t</tr>\n\t\t\t\t<tr>\n"; $counter2=0;}
			
			$statisticsoutput .= "\t\t\t\t<td align='center'><b>$flt[3] ($row[0])</b>"
			."<input type='checkbox' class='checkboxbtn' name='summary[]' value='$myfield2'";
			
			if (isset($summary) && array_search($myfield2, $summary)!== FALSE)
			{$statisticsoutput .= " checked='checked'";}
			
			$statisticsoutput .= " />&nbsp;"
			.showSpeaker($niceqtext." ".str_replace("'", "`", $row[1]))
			."<br />\n"
			."\t\t\t\t<select name='{$surveyid}X{$flt[1]}X{$flt[0]}{$row[0]}[]' multiple='multiple'>\n"
			."\t\t\t\t\t<option value='Y'";
			
			//pre-select "yes"
			if (isset($_POST[$myfield2]) && is_array($_POST[$myfield2]) && in_array("Y", $_POST[$myfield2])) {$statisticsoutput .= " selected";}
			
			$statisticsoutput .= ">".$clang->gT("Yes")."</option>\n"
			."\t\t\t\t\t<option value='U'";
			
			//pre-select "uncertain"
			if (isset($_POST[$myfield2]) && is_array($_POST[$myfield2]) && in_array("U", $_POST[$myfield2])) {$statisticsoutput .= " selected";}
			
			$statisticsoutput .= ">".$clang->gT("Uncertain")."</option>\n"
			."\t\t\t\t\t<option value='N'";
			
			//pre-select "no"
			if (isset($_POST[$myfield2]) && is_array($_POST[$myfield2]) && in_array("N", $_POST[$myfield2])) {$statisticsoutput .= " selected";}
			
			$statisticsoutput .= ">".$clang->gT("No")."</option>\n"
			."\t\t\t\t</select>\n\t\t\t\t</td>\n";
			$counter2++;
			
			//add to array
			$allfields[]=$myfield2;
		}
		
		$statisticsoutput .= "\t\t\t\t</tr>\n\t\t\t\t<tr>\n";
		$counter=0;
		break;
		
		
		
		//similiar to the above one
		case "E": // ARRAY OF Increase/Same/Decrease QUESTIONS
		$statisticsoutput .= "\t\t\t\t</tr>\n\t\t\t\t<tr>\n";
		
		$query = "SELECT code, answer FROM ".db_table_name("answers")." WHERE qid='$flt[0]' AND language='{$language}' ORDER BY sortorder, answer";
		$result = db_execute_num($query) or safe_die ("Couldn't get answers!<br />$query<br />".$connect->ErrorMsg());
		$counter2=0;
		
		while ($row=$result->FetchRow())
		{
			$myfield2 = $myfield . "$row[0]";
			$statisticsoutput .= "<!-- $myfield2 - ";
			
			if (isset($_POST[$myfield2])) {$statisticsoutput .= $_POST[$myfield2];}
			
			$statisticsoutput .= " -->\n";
			
			if ($counter2 == 4) {$statisticsoutput .= "\t\t\t\t</tr>\n\t\t\t\t<tr>\n"; $counter2=0;}
			
			$statisticsoutput .= "\t\t\t\t<td align='center'><b>$flt[3] ($row[0])</b>"
			."<input type='checkbox' class='checkboxbtn' name='summary[]' value='$myfield2'";
			
			if (isset($summary) && array_search($myfield2, $summary)!== FALSE) {$statisticsoutput .= " checked='checked'";}
			
			$statisticsoutput .= " />&nbsp;"
			.showSpeaker($niceqtext." ".str_replace("'", "`", $row[1]))
			."<br />\n"
			."\t\t\t\t<select name='{$surveyid}X{$flt[1]}X{$flt[0]}{$row[0]}[]' multiple='multiple'>\n"
			."\t\t\t\t\t<option value='I'";
			
			if (isset($_POST[$myfield2]) && is_array($_POST[$myfield2]) && in_array("I", $_POST[$myfield2])) {$statisticsoutput .= " selected";}
			
			$statisticsoutput .= ">".$clang->gT("Increase")."</option>\n"
			."\t\t\t\t\t<option value='S'";
			
			if (isset($_POST[$myfield]) && is_array($_POST[$myfield2]) && in_array("S", $_POST[$myfield2])) {$statisticsoutput .= " selected";}
			
			$statisticsoutput .= ">".$clang->gT("Same")."</option>\n"
			."\t\t\t\t\t<option value='D'";
			
			if (isset($_POST[$myfield]) && is_array($_POST[$myfield2]) && in_array("D", $_POST[$myfield2])) {$statisticsoutput .= " selected";}
			
			$statisticsoutput .= ">".$clang->gT("Decrease")."</option>\n"
			."\t\t\t\t</select>\n\t\t\t\t</td>\n";
			$counter2++;
			$allfields[]=$myfield2;		
		}
		
		$statisticsoutput .= "\t\t\t\t</tr>\n\t\t\t\t<tr>\n";
		$counter=0;
		break;
		
		
		
		/*
		 * For question type "F" and "H" you can use labels. 
		 * The only difference is that the labels are applied to column heading 
		 * or rows respectively
		 */
		case "F": // ARRAY OF Flexible QUESTIONS
		case "H": // ARRAY OF Flexible Questions (By Column)
		$statisticsoutput .= "\t\t\t\t</tr>\n\t\t\t\t<tr>\n";
		
		//Get answers. We always use the answer code because the label might be too long elsewise 
		$query = "SELECT code, answer FROM ".db_table_name("answers")." WHERE qid='$flt[0]' AND language='{$language}' ORDER BY sortorder, answer";
		$result = db_execute_num($query) or safe_die ("Couldn't get answers!<br />$query<br />".$connect->ErrorMsg());
		$counter2=0;
		
		//check all the answers
		while ($row=$result->FetchRow())
		{
			$myfield2 = $myfield . "$row[0]";
			$statisticsoutput .= "<!-- $myfield2 - ";
			
			if (isset($_POST[$myfield2])) {$statisticsoutput .= $_POST[$myfield2];}
			
			$statisticsoutput .= " -->\n";
			
			if ($counter2 == 4) {$statisticsoutput .= "\t\t\t\t</tr>\n\t\t\t\t<tr>\n"; $counter2=0;}
			
			$statisticsoutput .= "\t\t\t\t<td align='center'><b>$flt[3] ($row[0])</b>"
			."<input type='checkbox' class='checkboxbtn' name='summary[]' value='$myfield2'";
			
			if (isset($summary) && array_search($myfield2, $summary)!== FALSE) {$statisticsoutput .= " checked='checked'";}
			
			$statisticsoutput .= " />&nbsp;"
			.showSpeaker($niceqtext." ".str_replace("'", "`", $row[1]))
			."<br />\n";
			
			/*
			 * when hoovering the speaker symbol we show the whole question
			 * 
			 * flt[6] is the label ID
			 * 
			 * table "labels" contains
			 * - lid
			 * - code
			 * - title
			 * - sortorder
			 * - language
			 */
			$fquery = "SELECT * FROM ".db_table_name("labels")." WHERE lid={$flt[6]} AND language='{$language}' ORDER BY sortorder, code";
			$fresult = db_execute_assoc($fquery);
			
			//for debugging only:
			//$statisticsoutput .= $fquery;			
			
			//creating form
			$statisticsoutput .= "\t\t\t\t<select name='{$surveyid}X{$flt[1]}X{$flt[0]}{$row[0]}[]' multiple='multiple'>\n";
			
			//loop through all possible answers
			while ($frow = $fresult->FetchRow())
			{
				$statisticsoutput .= "\t\t\t\t\t<option value='{$frow['code']}'";
				
				//pre-select
				if (isset($_POST[$myfield2]) && is_array($_POST[$myfield2]) && in_array($frow['code'], $_POST[$myfield2])) {$statisticsoutput .= " selected";}
				
				$statisticsoutput .= ">({$frow['code']}) ".strip_tags($frow['title'])."</option>\n";
			}
			
			$statisticsoutput .= "\t\t\t\t</select>\n\t\t\t\t</td>\n";
			$counter2++;
			
			//add fields to main array
			$allfields[]=$myfield2;
		}
		
		$statisticsoutput .= "\t\t\t\t<td>\n";
		$counter=0;
		break;
		
		
		
		case "R": //RANKING
			
		$statisticsoutput .= "\t\t\t\t</tr>\n\t\t\t\t<tr>\n";
		
		//get some answers
		$query = "SELECT code, answer FROM ".db_table_name("answers")." WHERE qid='$flt[0]' AND language='{$language}' ORDER BY sortorder, answer";
		$result = db_execute_assoc($query) or safe_die ("Couldn't get answers!<br />$query<br />".$connect->ErrorMsg());
		
		//get number of answers
		$count = $result->RecordCount();
		
		//lets put the answer code and text into the answers array
		while ($row = $result->FetchRow())
		{
			$answers[]=array($row['code'], $row['answer']);
		}
		
		$counter2=0;
		
		//loop through all answers. if there are 3 items to rate there will be 3 statistics
		for ($i=1; $i<=$count; $i++)
		{
			//adjust layout depending on counter
			if ($counter2 == 4) {$statisticsoutput .= "\t\t\t\t</tr>\n\t\t\t\t<tr>\n"; $counter=0;}
			
			//myfield is the SGQ identifier
			//myfield2 is just used as comment in HTML like "R40X34X1721-1"
			$myfield2 = "R" . $myfield . $i . "-" . strlen($i);
			$myfield3 = $myfield . $i;
			$statisticsoutput .= "<!-- $myfield2 - ";
						
			if (isset($_POST[$myfield2])) {$statisticsoutput .= $_POST[$myfield2];}
			
			$statisticsoutput .= " -->\n"
			."\t\t\t\t<td align='center'><b>$flt[3] ($i)</b>"
			."<input type='checkbox' class='checkboxbtn' name='summary[]' value='$myfield2'";
			
			//pre-check
			if (isset($summary) && array_search($myfield2, $summary) !== FALSE) {$statisticsoutput .= " checked='checked'";}
			
			$statisticsoutput .= " />&nbsp;"
			.showSpeaker($niceqtext." ".str_replace("'", "`", $row[1]))
			."<br />\n"
			."\t\t\t\t<select name='{$surveyid}X{$flt[1]}X{$flt[0]}{$i}[]' multiple='multiple'>\n";
			
			//output lists of ranking items
			foreach ($answers as $ans)
			{
				$statisticsoutput .= "\t\t\t\t\t<option value='$ans[0]'";
				
				//pre-select
				if (isset($_POST[$myfield3]) && is_array($_POST[$myfield3]) && in_array("$ans[0]", $_POST[$myfield3])) {$statisticsoutput .= " selected";}
				
				$statisticsoutput .= ">$ans[1]</option>\n";
			}
			
			$statisticsoutput .= "\t\t\t\t</select>\n\t\t\t\t</font></td>\n";
			$counter2++;
			
			//add averything to main array
			$allfields[]=$myfield2;
		}
		
		$statisticsoutput .= "\t\t\t\t</tr>\n\t\t\t\t<tr>\n";
		
		//Link to rankwinner script - awaiting completion - probably never gonna happen. Mystery creator.
		//          $statisticsoutput .= "\t\t\t\t</tr>\n\t\t\t\t<tr bgcolor='#DDDDDD'>\n"
		//              ."<td colspan=$count align=center>"
		//              ."<input type='button' value='Show Rank Summary' onclick=\"window.open('rankwinner.php?sid=$surveyid&amp;qid=$flt[0]', '_blank', 'toolbar=no, directories=no, location=no, status=yes, menubar=no, resizable=no, scrollbars=no, width=400, height=300, left=100, top=100')\">"
		//              ."</td></tr>\n\t\t\t\t<tr>\n";
		$counter=0;
		unset($answers);
		break;
		
		
		
		//Boilerplate questions are only used to put some text between other questions -> no analysis needed
		case "X": //This is a boilerplate question and it has no business in this script
                $statisticsoutput .= "\t\t\t\t<td></td>";
		break;
		
		
		
		//Dropdown and radio lists
		case "W":
		case "Z":
			
		$statisticsoutput .= "\t\t\t\t<td align='center'>"
		."<strong>$flt[3]&nbsp;"; //Heading (Question No)
		$statisticsoutput .= "<input type='checkbox' class='checkboxbtn' name='summary[]' value='$myfield'";
		
		//pre-check
		if (isset($summary) && (array_search("{$surveyid}X{$flt[1]}X{$flt[0]}", $summary) !== FALSE  || array_search("M{$surveyid}X{$flt[1]}X{$flt[0]}", $summary) !== FALSE || array_search("N{$surveyid}X{$flt[1]}X{$flt[0]}", $summary) !== FALSE))
		{$statisticsoutput .= " checked='checked'";}
		
		$statisticsoutput .= " />&nbsp;"
		.showSpeaker($niceqtext)."</strong>"
		."<br />\n";
		$statisticsoutput .= "\t\t\t\t<select name='{$surveyid}X{$flt[1]}X{$flt[0]}[]' multiple='multiple'>\n";
		$allfields[]=$myfield;
		
		//get labels (code and title)
		$query = "SELECT code, title FROM ".db_table_name("labels")." WHERE lid={$flt[6]} AND language='{$language}' ORDER BY sortorder";
		$result = db_execute_num($query) or safe_die("Couldn't get answers!<br />$query<br />".$connect->ErrorMsg());
		
		//loop through all the labels
		while($row=$result->FetchRow())
		{
			$statisticsoutput .= "\t\t\t\t\t\t<option value='{$row[0]}'";
			
			//pre-check
			if (isset($_POST[$myfield]) && is_array($_POST[$myfield]) && in_array($row[0], $_POST[$myfield])) {$statisticsoutput .= " selected";}
			
			$statisticsoutput .= ">({$row[0]}) ".strip_tags($row[1])."</option>\n";
            
		} // while
		
		$statisticsoutput .= "\t\t\t\t</select>\n\t\t\t\t</td>\n";
		break;
		
		
		
        case "1": // MULTI SCALE
        $statisticsoutput .= "\t\t\t\t</tr>\n\t\t\t\t<tr>\n";
        
        //multi/dual scale is like two mixed questions of the same type so we loop twice
        for ($i=0; $i<=1; $i++) 
        {
        	//get answers
            $query = "SELECT code, answer FROM ".db_table_name("answers")." WHERE qid='$flt[0]' AND language='{$language}' ORDER BY sortorder, answer";
            $result = db_execute_num($query) or safe_die ("Couldn't get answers!<br />$query<br />".$connect->ErrorMsg());
            $counter2=0;
            
            //loop through answers
            while ($row=$result->FetchRow())
            {
            	//myfield2 = answer code. there are two answer to this question type (->add $i)
                $myfield2 = $myfield . "$row[0]#".$i;
                $statisticsoutput .= "<!-- $myfield2 - ";
                
                if (isset($_POST[$myfield2])) {$statisticsoutput .= $_POST[$myfield2];}
                $statisticsoutput .= " -->\n";
                
                //some layout adaptions
                if ($counter2 == 4) {$statisticsoutput .= "\t\t\t\t</tr>\n\t\t\t\t<tr>\n"; $counter2=0;}
                
                $statisticsoutput .= "\t\t\t\t<td align='center'><b>$flt[3] Label ".(1+$i)."($row[0])</b>"
                    ."<input type='checkbox' class='checkboxbtn' name='summary[]' value='$myfield2'";
                
                //pre-check
                if (isset($summary) && array_search($myfield2, $summary)!== FALSE) {$statisticsoutput .= " checked='checked'";}

                
                $statisticsoutput .= " />&nbsp;"
                    .showSpeaker($niceqtext." ".str_replace("'", "`", $row[1]))
                    ."<br />\n";
                
                /*
                 * get labels. remember that there are two labels used -> add $i 
                 * $flt[6] contains the "normal" label-id and fltd[7] = second label
                 * 
                 * table "labels" contains
                 * - lid
                 * - code
                 * - title
                 * - sortorder
                 * - language
                 */
                $fquery = "SELECT * FROM ".db_table_name("labels")." WHERE lid={$flt[6+$i]} AND language='{$language}' ORDER BY sortorder, code";
                $fresult = db_execute_assoc($fquery);
                
                //this is for debugging only
                //$statisticsoutput .= $fquery;
                
                $statisticsoutput .= "\t\t\t\t<select name='{$surveyid}X{$flt[1]}X{$flt[0]}{$row[0]}#{$i}[]' multiple='multiple'>\n";
                
                
                //Testweise die dual scale frage hinzufügen und anschauen, wie der filterscreen aussieht
                
                //for every item which should be rated we have two filter forms (remember: we have 2 labesets)
                //if you want to rate 3 items you'll have 6 (3*2) forms
                while ($frow = $fresult->FetchRow())
                {
                    $statisticsoutput .= "\t\t\t\t\t<option value='{$frow['code']}'";
                    
                    //pre-check
                    if (isset($_POST[$myfield2]) && is_array($_POST[$myfield2]) && in_array($frow['code'], $_POST[$myfield2])) {$statisticsoutput .= " selected";}
                    
                    $statisticsoutput .= ">({$frow['code']}) ".strip_tags($frow['title'])."</option>\n";
                    
                }
                
                $statisticsoutput .= "\t\t\t\t</select>\n\t\t\t\t</td>\n";
                $counter2++;
                $allfields[]=$myfield2;
                
            }
            
            $statisticsoutput .= "\t\t\t\t<td>\n";
            
        }
        
        $counter=0;
        break;
        
        
        
        /*
         * This question types use the default settings:
         * 	L - List (Radio) 
			M - Multiple Options 
			O - List With Comment 
			P - Multiple Options With Comments 
			! - List (Dropdown) 
         */
		default:
			
		//get answers
		$query = "SELECT code, answer FROM ".db_table_name("answers")." WHERE qid='$flt[0]' AND language='{$language}' ORDER BY sortorder, answer";
		$result = db_execute_num($query) or safe_die("Couldn't get answers!<br />$query<br />".$connect->ErrorMsg());
		
		//loop through answers
		while ($row=$result->FetchRow())
		{
			$statisticsoutput .= "\t\t\t\t\t\t<option value='{$row[0]}'";
			
			//pre-check
			if (isset($_POST[$myfield]) && is_array($_POST[$myfield]) && in_array($row[0], $_POST[$myfield])) {$statisticsoutput .= " selected";}
			
			$statisticsoutput .= ">$row[1]</option>\n";
		}
		
		$statisticsoutput .= "\t\t\t\t</select>\n\t\t\t\t</td>\n";
		break;
		
	}	//end switch -> check question types and create filter forms
	
	$currentgroup=$flt[1];
	
	if (!isset($counter)) {$counter=0;}
	$counter++;
}

//complete output
$statisticsoutput .= "\n\t\t\t\t</tr>\n";

//array allfields contains question codes
if (isset($allfields))
{
	//connect all array elements using "+"
	$allfield=implode("+", $allfields);
}

//pre-selection of filter forms
if (incompleteAnsFilterstate() === true)
{
	$selecthide="selected='selected'";
	$selectshow="";
}
else
{
	$selecthide="";
	$selectshow="selected='selected'";
}

//add last lines to filter forms
$statisticsoutput .= "\t\t\t</table>\n"
."\t\t</td></tr>\n"
."\t\t<tr><td align='center' class='settingcaption'>\n"
."\t\t<font size='1'>&nbsp;</font></td></tr>\n"
."\t\t\t\t<tr><td align='center'><input type='radio' class='radiobtn' id='viewsummaryall' name='summary' value='$allfield'"
." /><label for='viewsummaryall'>".$clang->gT("View summary of all available fields")."</label></td></tr>\n"
."\t\t<tr><td align='center' class='settingcaption'>\n"
."\t\t<font size='1'>&nbsp;</font></td></tr>\n"
."\t\t\t\t<tr><td align='center'>".$clang->gT("Filter incomplete answers:")."<select name='filterinc'>\n"
."\t\t\t\t\t<option value='filter' $selecthide>".$clang->gT("Enabled")."</option>\n"
."\t\t\t\t\t<option value='show' $selectshow>".$clang->gT("Disabled")."</option>\n"
."\t\t\t\t</select></td></tr>\n"
."\t\t\t\t<tr><td align='center'>";

//this fixes bug #2470
$statisticsoutput.="<input type='checkbox' id='noncompleted' name='noncompleted' ";
if (isset($_POST['noncompleted'])) {$statisticsoutput .= "checked='checked'";}
$statisticsoutput.=" /><label for='noncompleted'>".$clang->gT("Don't consider NON completed responses")."</label></td></tr>\n";


//only show option to show graphs if jpgraph is enabled
if (isset($usejpgraph) && $usejpgraph == 1)
{
	$statisticsoutput .= "\t\t\t\t<tr><td align='center'><input type='checkbox' id='usegraph' name='usegraph' checked='checked'/><label for='usergraph'>".$clang->gT("Show Graphs")."</label></font></td></tr>\n";
}

//very last lines of output
$statisticsoutput .= "\t\t<tr><td align='center'>\n\t\t\t<br />\n"
."\t\t\t<input type='submit' value='".$clang->gT("View Stats")."' />\n"
."\t\t\t<input type='button' value='".$clang->gT("Clear")."' onclick=\"window.open('$scriptname?action=statistics&amp;sid=$surveyid', '_top')\" />\n"
."\t\t<br />&nbsp;\n"
."\t\t<input type='hidden' name='sid' value='$surveyid' />\n"
."\t\t<input type='hidden' name='display' value='stats' />\n"
."\t</td></tr>\n"
."</table>\n"
."</td></tr></table>\n"
."\t</form>\n";

// ----------------------------------- END FILTER FORM ---------------------------------------


// DISPLAY RESULTS
if (isset($_POST['display']) && $_POST['display'])
{
	// Create progress bar which is shown while creating the results
	$prb = new ProgressBar();
	$prb->pedding = 2;	// Bar Pedding
	$prb->brd_color = "#404040 #dfdfdf #dfdfdf #404040";	// Bar Border Color

	$prb->setFrame();	// set ProgressBar Frame
	$prb->frame['left'] = 50;	// Frame position from left
	$prb->frame['top'] = 	80;	// Frame position from top
	$prb->addLabel('text','txt1',$clang->gT("Please wait ..."));	// add Text as Label 'txt1' and value 'Please wait'
	$prb->addLabel('percent','pct1');	// add Percent as Label 'pct1'
	$prb->addButton('btn1',$clang->gT('Go Back'),'?action=statistics&amp;sid='.$surveyid);	// add Button as Label 'btn1' and action '?restart=1'

	//progress bar starts with 35%
	$process_status = 35;
	$prb->show();	// show the ProgressBar
	
	//don't show any output, we just want to watch the bar growing
	$statisticsoutput .= "<script type='text/javascript'>
    <!--
     hide('filtersettings');
    //-->
    </script>\n";
	
	// 1: Get list of questions with answers chosen
	//"Getting Questions and Answers ..." is shown above the bar
	$prb->setLabelValue('txt1',$clang->gT('Getting Questions and Answers ...'));
	$prb->moveStep(5);
	
	// creates array of post variable names
	for (reset($_POST); $key=key($_POST); next($_POST)) { $postvars[]=$key;}

	/*
	 * Iterate through postvars to create "nice" data for SQL later.
	 * 
	 * Remember there might be some filters applied which have to be put into an SQL statement
	 */
	foreach ($postvars as $pv)
	{
		//Only do this if there is actually a value for the $pv
		if (in_array($pv, $allfields)) 
		{
			$firstletter=substr($pv,0,1);
			
			/*
			 * check for some question types:
			 * M = Multiple Options
			 * T - Long Free Text 
			 * Q - Multiple Short Text 
			 * D - Date 
			 * N - Numerical Input 
			 * K - Multiple Numerical Input 
			 */
			if ($pv != "sid" && $pv != "display" && $firstletter != "M" && $firstletter != "T" && 
			    $firstletter != "Q" && $firstletter != "D" && $firstletter != "N" && $firstletter != "K" &&
				$pv != "summary" && substr($pv, 0, 2) != "id" && substr($pv, 0, 9) != "datestamp") //pull out just the fieldnames
			{
				//put together some SQL here
				$thisquestion = db_quote_id($pv)." IN (";
				
				foreach ($_POST[$pv] as $condition)
				{
					$thisquestion .= "'$condition', ";
				}
				
				$thisquestion = substr($thisquestion, 0, -2)
				. ")";
				
				//we collect all the to be selected data in this array
				$selects[]=$thisquestion;
			}
			
			//M - Multiple Options 
			elseif (substr($pv, 0, 1) == "M")
			{
				//create a list out of the $pv array
				list($lsid, $lgid, $lqid) = explode("X", $pv);
				
				$aquery="SELECT code FROM ".db_table_name("answers")." WHERE qid=$lqid AND language='{$language}' ORDER BY sortorder, answer";
				$aresult=db_execute_num($aquery) or safe_die ("Couldn't get answers<br />$aquery<br />".$connect->ErrorMsg());
				
				// go through every possible answer
				while ($arow=$aresult->FetchRow()) 
				{
					// only add condition if answer has been chosen
					if (in_array($arow[0], $_POST[$pv])) 
					{
						$mselects[]=db_quote_id(substr($pv, 1, strlen($pv)).$arow[0])." = 'Y'";
					}
				}
				if ($mselects)
				{
					$thismulti=implode(" OR ", $mselects);
					$selects[]="($thismulti)";
				}
			}
			
			//N - Numerical Input 
			//K - Multiple Numerical Input 
			elseif (substr($pv, 0, 1) == "N" || substr($pv, 0, 1) == "K")
			{
				//value greater than
				if (substr($pv, strlen($pv)-1, 1) == "G" && $_POST[$pv] != "")
				{					
					$selects[]=db_quote_id(substr($pv, 1, -1))." > ".sanitize_int($_POST[$pv]);
				}
				
				//value less than
				if (substr($pv, strlen($pv)-1, 1) == "L" && $_POST[$pv] != "")
				{
                    $selects[]=db_quote_id(substr($pv, 1, -1))." < ".sanitize_int($_POST[$pv]);
				}
			}
			
			//"id" is a built in field, the unique database id key of each response row
			elseif (substr($pv, 0, 2) == "id")
			{
				if (substr($pv, strlen($pv)-1, 1) == "G" && $_POST[$pv] != "")
				{
                    $selects[]=db_quote_id(substr($pv, 0, -1))." > '".$_POST[$pv]."'";
				}
				if (substr($pv, strlen($pv)-1, 1) == "L" && $_POST[$pv] != "")
				{
                    $selects[]=db_quote_id(substr($pv, 0, -1))." < '".$_POST[$pv]."'";
				}
				if (substr($pv, strlen($pv)-1, 1) == "=" && $_POST[$pv] != "")
				{
                    $selects[]=db_quote_id(substr($pv, 0, -1))." = '".$_POST[$pv]."'";
				}
			}
			
			//T - Long Free Text 
			//Q - Multiple Short Text 
			elseif ((substr($pv, 0, 1) == "T" || substr($pv, 0, 1) == "Q" ) && $_POST[$pv] != "")
			{
                $selects[]=db_quote_id(substr($pv, 1, strlen($pv)))." like '%".$_POST[$pv]."%'";
			}
			
			//D - Date 
			elseif (substr($pv, 0, 1) == "D" && $_POST[$pv] != "")
			{
				//Date equals
				if (substr($pv, -1, 1) == "=")
				{
                    $selects[]=db_quote_id(substr($pv, 1, strlen($pv)-2))." = '".$_POST[$pv]."'";
				}
				else
				{
					//date less than
					if (substr($pv, -1, 1) == "<")
					{
						$selects[]= db_quote_id(substr($pv, 1, strlen($pv)-2)) . " > '".$_POST[$pv]."'";
					}
					
					//date greater than
					if (substr($pv, -1, 1) == ">")
					{
                        $selects[]= db_quote_id(substr($pv, 1, strlen($pv)-2)) . " < '".$_POST[$pv]."'";
					}
				}
			}
			
			//check for datestamp of given answer
			elseif (substr($pv, 0, 9) == "datestamp")
			{
				//timestamp equals
				if (substr($pv, -1, 1) == "=" && !empty($_POST[$pv]))
				{
					$selects[] = db_quote_id('datestamp')." = '".$_POST[$pv]."'";
				}
				else
				{
					//timestamp less than
					if (substr($pv, -1, 1) == "<" && !empty($_POST[$pv]))
					{
						$selects[]= db_quote_id('datestamp')." > '".$_POST[$pv]."'";
					}
					
					//timestamp greater than
					if (substr($pv, -1, 1) == ">" && !empty($_POST[$pv]))
					{
						$selects[]= db_quote_id('datestamp')." < '".$_POST[$pv]."'";
					}
				}
			}
		} 
		
		else 
		{
			$statisticsoutput .= "<!-- $pv DOES NOT EXIST IN ARRAY -->";
		}
		
	}	//end foreach -> loop through filter options to create SQL
	
	
	
	
	
	// 2: Do SQL query
	//"Getting Result Count ..." is shown above the progress bar
	$prb->setLabelValue('txt1',$clang->gT('Getting Result Count ...'));
	$prb->moveStep(35);
	
	//count number of answers
	$query = "SELECT count(*) FROM ".db_table_name("survey_$surveyid");
	
	//if incompleted answers should be filtert submitdate has to be not null
	if (incompleteAnsFilterstate() === true) {$query .= " WHERE submitdate is not null";}
	$result = db_execute_num($query) or safe_die ("Couldn't get total<br />$query<br />".$connect->ErrorMsg());
	
	//$total = total number of answers
	while ($row=$result->FetchRow()) {$total=$row[0];}
	
	//are there any filters that have to be taken care of?
	if (isset($selects) && $selects)
	{
		//filter incomplete answers?
		if (incompleteAnsFilterstate() === true) {$query .= " AND ";}		
		
		else {$query .= " WHERE ";}
		
		//add filter criteria to SQL
		$query .= implode(" AND ", $selects);
	}
	
	//$_POST['sql'] is a post field that is sent from the statistics script to the export script in order
	// to export just those results filtered by this statistics script. It can also be passed to the statistics
	// script to filter from external scripts.
	elseif (!empty($_POST['sql']) && !isset($_POST['id=']))
	{
		$newsql=substr($_POST['sql'], strpos($_POST['sql'], "WHERE")+5, strlen($_POST['sql']));
		
		//for debugging only
		//$query = $_POST['sql'];
		
		//filter incomplete answers?
		if (incompleteAnsFilterstate() === true) {$query .= " AND ".$newsql;}

		else {$query .= " WHERE ".$newsql;}
	}
	
	//get me some data Scotty
	$result=db_execute_num($query) or safe_die("Couldn't get results<br />$query<br />".$connect->ErrorMsg());
	
	//put all results into $results
	while ($row=$result->FetchRow()) {$results=$row[0];}

	
	
	
	
	// 3: Present results including option to view those rows
	
	//put everything into this table
	
	//show some main data at the beginnung
	$statisticsoutput .= "<br />\n<table align='center' width='95%' border='1'  "
	."cellpadding='2' cellspacing='0' >\n"
	."\t<tr><td colspan='2' align='center'><strong>"
	.$clang->gT("Results")."</strong></td></tr>\n"
	."\t<tr><td colspan='2' align='center'>"
	.""
	."<strong>".$clang->gT("No of records in this query").": $results </strong><br />\n\t\t"
	.$clang->gT("Total records in survey").": $total<br />\n";
	
	//only calculate percentage of $total is set
	if ($total)
	{
		$percent=sprintf("%01.2f", ($results/$total)*100);
		$statisticsoutput .= $clang->gT("Percentage of total")
		.": $percent%<br />";
	}
	$statisticsoutput .= "\n\t\t</td></tr>\n";
	
	//put everything from $selects array into a string connected by AND
	if (isset ($selects) && $selects) {$sql=implode(" AND ", $selects);}	
	
	elseif (!empty($newsql)) {$sql = $newsql;}
	
	if (!isset($sql) || !$sql) {$sql="NULL";}
	
	//only continue if we have something to output
	if ($results > 0)
	{
		//add two buttons to browse results and export results
		$statisticsoutput .= "\t<tr>"
		."\t\t<td align='right' width='50%'><form action='$scriptname?action=browse' method='post' target='_blank'>\n"
		."\t\t<input type='submit' value='".$clang->gT("Browse")."'  />\n"
		."\t\t\t<input type='hidden' name='sid' value='$surveyid' />\n"
		."\t\t\t<input type='hidden' name='sql' value=\"$sql\" />\n"
		."\t\t\t<input type='hidden' name='subaction' value='all' />\n"
		."\t\t</form></td>\n"
		."\t\t<td width='50%'><form action='$scriptname?action=exportresults' method='post' target='_blank'>\n"
		."\t\t<input type='submit' value='".$clang->gT("Export")."'  />\n"
		."\t\t\t<input type='hidden' name='sid' value='$surveyid' />\n"
		."\t\t\t<input type='hidden' name='sql' value=\"$sql\" />\n";
		
		
		//Add the fieldnames
		if (isset($summary) && $summary)
		{
			//The summary array contains the fields that have been selected from the filter screen
			//  to be displayed in the results page. So we're iterating through them one at a time
			foreach($summary as $viewfields)
			{
				//We're checking the first letter of each of the selected-to-be-displayed fields
				//  in order to deal with the special types (usually those with multiple files per question)
				switch(substr($viewfields, 0, 1))
				{
					/*
					 * some special treatment for
					 * 
					 * N - Numerical Input 
					 * T - Long Free Text 
					 * K - Multiple Numerical Input 
					 */
					case "N":
					case "T":
					case "K":
					
					// Now we remove the first character from the fieldname, and so are left
					//   with just the actual SGQ code for this field/answer.
					$field = substr($viewfields, 1, strlen($viewfields)-1);
					$statisticsoutput .= "\t\t\t<input type='hidden' name='summary[]' value='$field' />\n";
					break;
					
					
					//M - Multiple Options 
					case "M":
					
					//create a SGQ identifier
					list($lsid, $lgid, $lqid) = explode("X", substr($viewfields, 1, strlen($viewfields)-1));
					
					//we need all the answer codes. 
					//there might be more than one because it's a multiple options question
					$aquery="SELECT code FROM ".db_table_name("answers")." WHERE qid=$lqid AND language='{$language}' ORDER BY sortorder, answer";
					$aresult=db_execute_num($aquery) or safe_die ("Couldn't get answers<br />$aquery<br />".$connect->ErrorMsg());
					
					// go through every possible answer
					while ($arow=$aresult->FetchRow()) 
					{
						$field = substr($viewfields, 1, strlen($viewfields)-1).$arow[0];
						$statisticsoutput .= "\t\t\t<input type='hidden' name='summary[]' value='$field' />\n";
					}
					
					//check data of "other" field
					$aquery = "SELECT other FROM ".db_table_name("questions")." WHERE qid=$lqid AND language='{$language}'";
					$aresult = db_execute_num($aquery);					
					
					while($arow = $aresult->FetchRow())
					{
						//"other" answer set?
						if ($arow[0] == "Y") {
							
							//some debugging output
							//$statisticsoutput .= $arow[0];
							
							$field = substr($viewfields, 1, strlen($viewfields)-1)."other";
							$statisticsoutput .= "\t\t\t<input type='hidden' name='summary[]' value='$field' />\n";
						}
						
					} // while
					
					break;
					
					//default treatment for all the other question types
					default:
					$field = $viewfields;
					$statisticsoutput .= "\t\t\t<input type='hidden' name='summary[]' value='$field' />\n";
					break;
				}
				
			}	//end foreach
			
		}	//end if (summary)

		//close form
		$statisticsoutput .= "\t\t</form></td>\n\t</tr>\n";
	
	}	//end if (results available?)

	//close table
	$statisticsoutput .= "</table><br />\n";
}

//push progress bar from 35 to 40
$process_status = 40;







//Show Summary results
if (isset($summary) && $summary)
{
	//"Generating Summaries ..." is shown above the progress bar
	$prb->setLabelValue('txt1',$clang->gT('Generating Summaries ...'));
	$prb->moveStep($process_status);
	
	//check if jpgraph is available
	if ($usejpgraph == 1 && isset($jpgraphdir)) //JPGRAPH CODING SUBMITTED BY Pieterjan Heyse
	{
		//Delete any old temp image files
		deletePattern($tempdir, "STATS_".date("d")."X".$currentuser."X".$surveyid."X"."*.png");
	}

	//let's run through the survey
	$runthrough=$summary;

	//START Chop up fieldname and find matching questions
	
	//GET LIST OF LEGIT QIDs FOR TESTING LATER	
	$lq = "SELECT DISTINCT qid FROM ".db_table_name("questions")." WHERE sid=$surveyid"; 
	$lr = db_execute_assoc($lq);
	
	//loop through the IDs
	while ($lw = $lr->FetchRow())
	{
		//this creates an array of question id's'
		$legitqids[] = $lw['qid']; 
	}
	
	//loop through all selected questions
	foreach ($runthrough as $rt)
	{
		//update progress bar
		if ($process_status < 100) $process_status++;		
		$prb->moveStep($process_status);
		
		
		// 1. Get answers for question ##############################################################
		
		//M - Multiple Options, therefore multiple fields
		if (substr($rt, 0, 1) == "M") 
		{
			//get SGQ data
			list($qsid, $qgid, $qqid) = explode("X", substr($rt, 1, strlen($rt)), 3);
			
			//select details for this question
			$nquery = "SELECT title, type, question, lid, other FROM ".db_table_name("questions")." WHERE language='{$language}' and qid='$qqid'";
			$nresult = db_execute_num($nquery) or safe_die ("Couldn't get question<br />$nquery<br />".$connect->ErrorMsg());
			
			//loop through question data
			while ($nrow=$nresult->FetchRow())
			{
				$qtitle=$nrow[0];
				$qtype=$nrow[1];
				$qquestion=strip_tags($nrow[2]);
				$qlid=$nrow[3];
				$qother=$nrow[4];
			}

			//1. Get list of answers
			$query="SELECT code, answer FROM ".db_table_name("answers")." WHERE qid='$qqid' AND language='{$language}' ORDER BY sortorder, answer";
			$result=db_execute_num($query) or safe_die("Couldn't get list of answers for multitype<br />$query<br />".$connect->ErrorMsg());
			
			//loop through multiple answers
			while ($row=$result->FetchRow())
			{
				$mfield=substr($rt, 1, strlen($rt))."$row[0]";
				
				//create an array containing answer code, answer and fieldname(??)
				$alist[]=array("$row[0]", "$row[1]", $mfield);
			}
			
			//check "other" field. is it set?
			if ($qother == "Y")
			{
				$mfield=substr($rt, 1, strlen($rt))."other";
				
				//create an array containing answer code, answer and fieldname(??)
				$alist[]=array($clang->gT("Other"), $clang->gT("Other"), $mfield);
			}
		}
		
		
		//S - Short Free Text 
		//T - Long Free Text 		
		elseif (substr($rt, 0, 1) == "T" || substr($rt, 0, 1) == "S") //Short and long text
		{
			//get SGQ data
			list($qsid, $qgid, $qqid) = explode("X", substr($rt, 1, strlen($rt)), 3);
			
			//get question data
			$nquery = "SELECT title, type, question, other FROM ".db_table_name("questions")." WHERE qid='$qqid' AND language='{$language}'";
			$nresult = db_execute_num($nquery) or safe_die("Couldn't get text question<br />$nquery<br />".$connect->ErrorMsg());
			
			//loop through question data
			while ($nrow=$nresult->FetchRow())
			{
				$qtitle=strip_tags($nrow[0]); 
				$qtype=$nrow[1];
				$qquestion=strip_tags($nrow[2]);
			}			
			
			$mfield=substr($rt, 1, strlen($rt));
			
			//Text questions either have an answer, or they don't. There's no other way of quantising the results.
			// So, instead of building an array of predefined answers like we do with lists & other types,
			// we instead create two "types" of possible answer - either there is a response.. or there isn't.
			// This question type then can provide a % of the question answered in the summary.
			$alist[]=array("Answers", $clang->gT("Answer"), $mfield);
			$alist[]=array("NoAnswer", $clang->gT("No answer"), $mfield);
		}
		
		
		//Multiple short text
		elseif (substr($rt, 0, 1) == "Q") 
		{
			//get SGQ data
			list($qsid, $qgid, $qqid) = explode("X", substr($rt, 1, strlen($rt)), 3);
            
			//separating another ID
			$tmpqid=substr($qqid, 0, strlen($qqid)-1);
            
			//check if we have legid QIDs. if not create them by substringing
			while (!in_array ($tmpqid,$legitqids)) $tmpqid=substr($tmpqid, 0, strlen($tmpqid)-1); 
            
			//length of QID
			$qidlength=strlen($tmpqid);
			
			//we somehow get the answer code (see SQL later) from the $qqid 
            $qaid=substr($qqid, $qidlength, strlen($qqid)-$qidlength);
			
            //get some question data
            $nquery = "SELECT title, type, question, other FROM ".db_table_name("questions")." WHERE qid='".substr($qqid, 0, $qidlength)."' AND language='{$language}'";
			$nresult = db_execute_num($nquery) or safe_die("Couldn't get text question<br />$nquery<br />".$connect->ErrorMsg());
			
			//more substrings
			$count = substr($qqid, strlen($qqid)-1);
			
			//loop through question data
			while ($nrow=$nresult->FetchRow())
			{
				$qtitle=strip_tags($nrow[0]).'-'.$count; 
				$qtype=$nrow[1];
				$qquestion=strip_tags($nrow[2]);
			}
			
			//get answers
		    $qquery = "SELECT code, answer FROM ".db_table_name("answers")." WHERE qid='$qqid' AND code='$qaid' AND language='{$language}' ORDER BY sortorder, answer";
		    $qresult=db_execute_num($qquery) or safe_die ("Couldn't get answer details (Array 5p Q)<br />$qquery<br />".$connect->ErrorMsg());
		    
		    //loop through answer data
		    while ($qrow=$qresult->FetchRow())
	    	{
	    		//store each answer here
		    	$atext=$qrow[1];
		    }
		    
		    //add this to the question title
		    $qtitle .= " [$atext]";
		    
		    //even more substrings...
			$mfield=substr($rt, 1, strlen($rt));
			
			//Text questions either have an answer, or they don't. There's no other way of quantising the results.
			// So, instead of building an array of predefined answers like we do with lists & other types,
			// we instead create two "types" of possible answer - either there is a response.. or there isn't.
			// This question type then can provide a % of the question answered in the summary.
			$alist[]=array("Answers", $clang->gT("Answer"), $mfield);
			$alist[]=array("NoAnswer", $clang->gT("No answer"), $mfield);
		}
		
		
		//RANKING OPTION THEREFORE CONFUSING
		elseif (substr($rt, 0, 1) == "R") 
		{
			//getting the needed IDs somehow
			$lengthofnumeral=substr($rt, strpos($rt, "-")+1, 1);
			list($qsid, $qgid, $qqid) = explode("X", substr($rt, 1, strpos($rt, "-")-($lengthofnumeral+1)), 3);
			
			//get question data
			$nquery = "SELECT title, type, question FROM ".db_table_name("questions")." WHERE qid='$qqid' AND language='{$language}'";
			$nresult = db_execute_num($nquery) or safe_die ("Couldn't get question<br />$nquery<br />".$connect->ErrorMsg());
			
			//loop through question data
			while ($nrow=$nresult->FetchRow())
			{
				$qtitle=strip_tags($nrow[0]). " [".substr($rt, strpos($rt, "-")-($lengthofnumeral), $lengthofnumeral)."]";
				$qtype=$nrow[1];
				$qquestion=strip_tags($nrow[2]). "[".$clang->gT("Ranking")." ".substr($rt, strpos($rt, "-")-($lengthofnumeral), $lengthofnumeral)."]";
			}
			
			//get answers
			$query="SELECT code, answer FROM ".db_table_name("answers")." WHERE qid='$qqid' AND language='{$language}' ORDER BY sortorder, answer";
			$result=db_execute_num($query) or safe_die("Couldn't get list of answers for multitype<br />$query<br />".$connect->ErrorMsg());
			
			//loop through answers
			while ($row=$result->FetchRow())
			{
				//create an array containing answer code, answer and fieldname(??)
				$mfield=substr($rt, 1, strpos($rt, "-")-1);
				$alist[]=array("$row[0]", "$row[1]", $mfield);
			}
		}	
		
		//N = numerical input
		//K = multiple numerical input
		elseif (substr($rt, 0, 1) == "N" || substr($rt, 0, 1) == "K") //NUMERICAL TYPE
		{
			//check last character, greater/less/equals don't need special treatment
			if (substr($rt, -1) == "G" ||  substr($rt, -1) == "L" || substr($rt, -1) == "=")
			{
				//DO NOTHING
			}
			else
			{
				//create SGQ identifier
		        list($qsid, $qgid, $qqid) = explode("X", $rt, 3);
				
		        //multiple numerical input
			    if(substr($rt, 0, 1) == "K")
			    { 
			    	// This is a multiple numerical question so we need to strip of the answer id to find the question title
                    $tmpqid=substr($qqid, 0, strlen($qqid)-1);
                    
                    //did we get a valid ID?
                    while (!in_array ($tmpqid,$legitqids)) 
                    $tmpqid=substr($tmpqid, 0, strlen($tmpqid)-1); 
                    
                    //check lenght of ID
                    $qidlength=strlen($tmpqid);
                    
                    //get answer ID from qid
                    $qaid=substr($qqid, $qidlength, strlen($qqid)-$qidlength);
                    
                    //get question details from DB
			        $nquery = "SELECT title, type, question, qid, lid 
							   FROM ".db_table_name("questions")." 
							   WHERE qid='".substr($qqid, 0, $qidlength)."' 
							   AND language='{$language}'";
			        $nresult = db_execute_num($nquery) or safe_die("Couldn't get text question<br />$nquery<br />".$connect->ErrorMsg());
				} 
				
				//probably question type "N" = numerical input
				else 
				{
					//we can use the qqid without any editing
				    $nquery = "SELECT title, type, question, qid, lid FROM ".db_table_name("questions")." WHERE qid='$qqid' AND language='{$language}'";
				    $nresult = db_execute_num($nquery) or safe_die ("Couldn't get question<br />$nquery<br />".$connect->ErrorMsg());
				}
				
				//loop through results
				while ($nrow=$nresult->FetchRow()) 
				{				
				    $qtitle=strip_tags($nrow[0]); //clean up title
					$qtype=$nrow[1]; 
					$qquestion=strip_tags($nrow[2]); //clean up question
					$qiqid=$nrow[3]; 
					$qlid=$nrow[4];
				}
				
				//Get answer texts for multiple numerical
				if(substr($rt, 0, 1) == "K")
				{
					//get answer data
				    $qquery = "SELECT code, answer FROM ".db_table_name("answers")." WHERE qid='$qiqid' AND code='$qaid' AND language='{$language}' ORDER BY sortorder, answer";
				    $qresult=db_execute_num($qquery) or safe_die ("Couldn't get answer details (Array 5p Q)<br />$qquery<br />".$connect->ErrorMsg());
				    
				    //handle answer
				    while ($qrow=$qresult->FetchRow())
			    	{
				    	$atext=$qrow[1];
				    }
				    //put single items in brackets at output
				    $qtitle .= " [$atext]";
				}
				
				//outputting headline
				$statisticsoutput .= "<br />\n<table align='center' width='95%' border='1'  cellpadding='2' cellspacing='0' >\n"
				."\t<tr><td colspan='2' align='center'><strong>".$clang->gT("Field Summary for")." $qtitle:</strong>"
				."</td></tr>\n"
				."\t<tr><td colspan='2' align='center'><strong>$qquestion</strong></td></tr>\n"
				."\t<tr>\n\t\t<td width='50%' align='center' ><strong>"
				.$clang->gT("Calculation")."</strong></td>\n"
				."\t\t<td width='50%' align='center' ><strong>"
				.$clang->gT("Result")."</strong></td>\n"
				."\t</tr>\n";
				
				//this field is queried using mathematical functions
				$fieldname=substr($rt, 1, strlen($rt));
				
				//special treatment for MS SQL databases
                if ($connect->databaseType == 'odbc_mssql')
                { 
                	//standard deviation
                	$query = "SELECT STDEVP(".db_quote_id($fieldname)."*1) as stdev"; 
                }
                    
                //other databases (MySQL, Postgres)
                else
                { 
                	//standard deviation
                	$query = "SELECT STDDEV(".db_quote_id($fieldname).") as stdev"; 
                }

                //sum
				$query .= ", SUM(".db_quote_id($fieldname)."*1) as sum";
				
				//average
				$query .= ", AVG(".db_quote_id($fieldname)."*1) as average";
				
				//min
				$query .= ", MIN(".db_quote_id($fieldname)."*1) as minimum";
				
				//max
				$query .= ", MAX(".db_quote_id($fieldname)."*1) as maximum";
                //Only select responses where there is an actual number response, ignore nulls and empties (if these are included, they are treated as zeroes, and distort the deviation/mean calculations)
                
				//special treatment for MS SQL databases
				if ($connect->databaseType == 'odbc_mssql')
                { 
                	//no NULL/empty values please
                	$query .= " FROM ".db_table_name("survey_$surveyid")." WHERE ".db_quote_id($fieldname)." IS NOT NULL AND (".db_quote_id($fieldname)." NOT LIKE ' ')"; 
                }
                
                //other databases (MySQL, Postgres)
                else
                { 
                	//no NULL/empty values please
                	$query .= " FROM ".db_table_name("survey_$surveyid")." WHERE ".db_quote_id($fieldname)." IS NOT NULL AND (".db_quote_id($fieldname)." != ' ')"; 
                }
				
                //filter incomplete answers if set
                if (incompleteAnsFilterstate() === true) {$query .= " AND submitdate is not null";}
				
                //$sql was set somewhere before
                if ($sql != "NULL") {$query .= " AND $sql";}
				
                //execute query
                $result=db_execute_assoc($query) or safe_die("Couldn't do maths testing<br />$query<br />".$connect->ErrorMsg());
				
                //get calculated data
                while ($row=$result->FetchRow())
				{
					//put translation of mean and calculated data into $showem array
					$showem[]=array($clang->gT("Sum"), $row['sum']);
					$showem[]=array($clang->gT("Standard Deviation"), $row['stdev']);
					$showem[]=array($clang->gT("Average"), $row['average']);
					$showem[]=array($clang->gT("Minimum"), $row['minimum']);
					
					//Display the maximum and minimum figures after the quartiles for neatness
					$maximum=$row['maximum']; 
					$minimum=$row['minimum'];
				}


				
				//CALCULATE QUARTILES
				
				//get data
				$query ="SELECT ".db_quote_id($fieldname)." FROM ".db_table_name("survey_$surveyid")." WHERE ".db_quote_id($fieldname)." IS NOT null AND ".db_quote_id($fieldname)." != ' '";
				
				//filtering enabled?
				if (incompleteAnsFilterstate() === true) {$query .= " AND submitdate is not null";}
				
				//if $sql values have been passed to the statistics script from another script, incorporate them
				if ($sql != "NULL") {$query .= " AND $sql";}
				
				//execute query
				$result=$connect->Execute($query) or safe_die("Disaster during median calculation<br />$query<br />".$connect->ErrorMsg());
				
				//same query begin as above?!?
				//XXX what's the difference between $query and $querystarter?
				$querystarter="SELECT ".db_quote_id($fieldname)." FROM ".db_table_name("survey_$surveyid")." WHERE ".db_quote_id($fieldname)." IS NOT null AND ".db_quote_id($fieldname)." != ' '";
				
				//filtering enabled?
				if (incompleteAnsFilterstate() === true) {$querystarter .= " AND submitdate is not null";}                     
				
				//if $sql values have been passed to the statistics script from another script, incorporate them
				if ($sql != "NULL") {$querystarter .= " AND $sql";}
				
				//we just count the number of records returned
				$medcount=$result->RecordCount();

				//put the total number of records at the beginning of this array
				array_unshift($showem, array($clang->gT("Count"), $medcount));

				
				//no more comment from Mazi regarding the calculation
				
				// Calculating only makes sense with more than one result
				if ($medcount>1)   
				{
					//1ST QUARTILE (Q1)
					$q1=(1/4)*($medcount+1);
					$q1b=(int)((1/4)*($medcount+1));
					$q1c=$q1b-1;
					$q1diff=$q1-$q1b;
					$total=0;
					
					// fix if there are too few values to evaluate.
					if ($q1c<1) {$q1c=1;$lastnumber=0;}  
					
					if ($q1 != $q1b)
					{
						//ODD NUMBER
						$query = $querystarter . " ORDER BY ".db_quote_id($fieldname)."*1 ";
						$result=db_select_limit_assoc($query, $q1c, 2) or safe_die("1st Quartile query failed<br />".$connect->ErrorMsg());
						
						while ($row=$result->FetchRow())
						{
							if ($total == 0)    {$total=$total-$row[$fieldname];}
							
							else                {$total=$total+$row[$fieldname];}
							
							$lastnumber=$row[$fieldname];
						}
						
						$q1total=$lastnumber-(1-($total*$q1diff));
						
						if ($q1total < $minimum) {$q1total=$minimum;}
						
						$showem[]=array($clang->gT("1st Quartile (Q1)"), $q1total);
					}
					else
					{
						//EVEN NUMBER
						$query = $querystarter . " ORDER BY ".db_quote_id($fieldname)."*1 ";
						$result=db_select_limit_assoc($query,1, $q1c) or safe_die ("1st Quartile query failed<br />".$connect->ErrorMsg());
						
						while ($row=$result->FetchRow()) 
						{
							$showem[]=array("1st Quartile (Q1)", $row[$fieldname]);
						}
					}					
					
					$total=0;
					
					
					//MEDIAN (Q2)
					$median=(1/2)*($medcount+1);
					$medianb=(int)((1/2)*($medcount+1));
					$medianc=$medianb-1;
					$mediandiff=$median-$medianb;
					
					if ($median != (int)((($medcount+1)/2)-1))
					{
						//remainder
						$query = $querystarter . " ORDER BY ".db_quote_id($fieldname)."*1 ";
						$result=db_select_limit_assoc($query,2, $medianc) or safe_die("What a complete mess with the remainder<br />$query<br />".$connect->ErrorMsg());
						
						while
						(
							$row=$result->FetchRow()) {$total=$total+$row[$fieldname];
						}
						
						$showem[]=array($clang->gT("2nd Quartile (Median)"), $total/2);
					}
					
					else
					{
						//EVEN NUMBER
						$query = $querystarter . " ORDER BY ".db_quote_id($fieldname)."*1 ";
						$result=db_select_limit_assoc($query,1, $medianc) or safe_die("What a complete mess<br />$query<br />".$connect->ErrorMsg());
						
						while ($row=$result->FetchRow()) 
						{
							$showem[]=array("Median Value", $row[$fieldname]);
						}
					}
					
					$total=0;
					
					
					//3RD QUARTILE (Q3)
					$q3=(3/4)*($medcount+1);
					$q3b=(int)((3/4)*($medcount+1));
					$q3c=$q3b-1;
					$q3diff=$q3-$q3b;
					
					if ($q3 != $q3b)
					{
						$query = $querystarter . " ORDER BY ".db_quote_id($fieldname)."*1 ";
						$result = db_select_limit_assoc($query,2,$q3c) or safe_die("3rd Quartile query failed<br />".$connect->ErrorMsg());
						
						$lastnumber='';
						
						while ($row=$result->FetchRow())
						{
							if ($total == 0)    {$total=$total-$row[$fieldname];}
							
							else                {$total=$total+$row[$fieldname];}
							
							if (!$lastnumber) {$lastnumber=$row[$fieldname];}
						}
						$q3total=$lastnumber+($total*$q3diff);
						
						if ($q3total < $maximum) {$q1total=$maximum;}
						
						$showem[]=array($clang->gT("3rd Quartile (Q3)"), $q3total);
					}
					
					else
					{
						$query = $querystarter . " ORDER BY ".db_quote_id($fieldname)."*1";
						$result = db_select_limit_assoc($query,1, $q3c) or safe_die("3rd Quartile even query failed<br />".$connect->ErrorMsg());
						
						while ($row=$result->FetchRow()) 
						{
							$showem[]=array("3rd Quartile (Q3)", $row[$fieldname]);
						}
					}
					
					$total=0;
					
					$showem[]=array($clang->gT("Maximum"), $maximum);
					
					//output results
					foreach ($showem as $shw)
					{
						$statisticsoutput .= "\t<tr>\n"
						."\t\t<td align='center' >$shw[0]</td>\n"
						."\t\t<td align='center' >$shw[1]</td>\n"
						."\t</tr>\n";
					}
					
					//footer of question type "N"
					$statisticsoutput .= "\t<tr>\n"
					."\t\t<td colspan='3' align='center' bgcolor='#EEEEEE'>\n"
					."\t\t\t<font size='1'>".$clang->gT("Null values are ignored in calculations")."<br />\n"
					."\t\t\t".sprintf($clang->gT("Q1 and Q3 calculated using %s"), "<a href='http://mathforum.org/library/drmath/view/60969.html' target='_blank'>".$clang->gT("minitab method")."</a>")
					."</font>\n"
					."\t\t</td>\n"
					."\t</tr>\n</table>\n";
					
					//clean up
					unset($showem);
					
				}	//end if (enough results?)
				
				//not enough (<1) results for calculation
				else
				{
					//output
					$statisticsoutput .= "\t<tr>\n"
					."\t\t<td align='center'  colspan='3'>".$clang->gT("Not enough values for calculation")."</td>\n"
					."\t</tr>\n</table>\n";
					unset($showem);
				}
				
			}	//end else -> check last character, greater/less/equals don't need special treatment
			
		}	//end else-if -> multiple numerical types
		
		//is there some "id", "datestamp" or "D" within the type?
 		elseif (substr($rt, 0, 2) == "id" || substr($rt, 0, 9) == "datestamp" || (substr($rt, 0, 1) == "D"))
		{
			//don't do anything
		}
		
		
		// NICE SIMPLE SINGLE OPTION ANSWERS
		else 
		{
			//get database fields for this survey
			$fieldmap=createFieldMap($surveyid, "full");
			
			//search for key
			$fielddata=arraySearchByKey($rt, $fieldmap, "fieldname", 1);
			
			//get SGQA IDs
			$qsid=$fielddata['sid'];
			$qgid=$fielddata['gid'];
			$qqid=$fielddata['qid'];
			$qanswer=$fielddata['aid'];
			
			//question type
            $qtype=$fielddata['type'];
            
            //question string
            $qastring=$fielddata['question'];
            
            //question ID
			$rqid=$qqid;
			
			//get question data
			$nquery = "SELECT title, type, question, qid, lid, lid1, other FROM ".db_table_name("questions")." WHERE qid='{$rqid}' AND language='{$language}'";
			$nresult = db_execute_num($nquery) or safe_die ("Couldn't get question<br />$nquery<br />".$connect->ErrorMsg());
			
			//loop though question data
			while ($nrow=$nresult->FetchRow())
			{
				$qtitle=strip_tags($nrow[0]);
				$qtype=$nrow[1];
				$qquestion=strip_tags($nrow[2]);
				$qiqid=$nrow[3];
				$qlid=$nrow[4];
                $qlid1=$nrow[5];
				$qother=$nrow[6];
			}
			
			//put data into array
			$alist[]=array("", $clang->gT("No answer"));
			
			//check question types
			switch($qtype)
			{

				//XXX MM: Here I will have to do some modifications
				
				//Array of 5 point choices (several items to rank!)
				case "A": 
				
				//get data
				$qquery = "SELECT code, answer FROM ".db_table_name("answers")." WHERE qid='$qiqid' AND code='$qanswer' AND language='{$language}' ORDER BY sortorder, answer";
				$qresult=db_execute_num($qquery) or safe_die ("Couldn't get answer details (Array 5p Q)<br />$qquery<br />".$connect->ErrorMsg());
				
				//loop through results
				while ($qrow=$qresult->FetchRow())
				{
					//5-point array
					for ($i=1; $i<=5; $i++)
					{
						//add data
						$alist[]=array("$i", "$i");
					}
					//add counter
					$atext=$qrow[1];
				}
				
				//list IDs and answer codes in brackets
				$qquestion .= "<br />\n[".$atext."]";
				$qtitle .= "($qanswer)";
				break;
				
				
				
				//Array of 10 point choices
				//same as above just with 10 items
				case "B": 
				$qquery = "SELECT code, answer FROM ".db_table_name("answers")." WHERE qid='$qiqid' AND code='$qanswer' AND language='{$language}' ORDER BY sortorder, answer";
				$qresult=db_execute_num($qquery) or safe_die ("Couldn't get answer details (Array 10p Q)<br />$qquery<br />".$connect->ErrorMsg());
				while ($qrow=$qresult->FetchRow())
				{
					for ($i=1; $i<=10; $i++)
					{
						$alist[]=array("$i", "$i");
					}
					$atext=$qrow[1];
				}
				
				$qquestion .= "<br />\n[".$atext."]";
				$qtitle .= "($qanswer)";
				break;
				
				
				
				//Array of Yes/No/$clang->gT("Uncertain")
				case "C": 
				$qquery = "SELECT code, answer FROM ".db_table_name("answers")." WHERE qid='$qiqid' AND code='$qanswer' AND language='{$language}' ORDER BY sortorder, answer";
				$qresult=db_execute_num($qquery) or safe_die ("Couldn't get answer details<br />$qquery<br />".$connect->ErrorMsg());
				
				//loop thorugh results
				while ($qrow=$qresult->FetchRow())
				{
					//add results
					$alist[]=array("Y", $clang->gT("Yes"));
					$alist[]=array("N", $clang->gT("No"));
					$alist[]=array("U", $clang->gT("Uncertain"));
					$atext=$qrow[1];
				}
				//output
				$qquestion .= "<br />\n[".$atext."]";
				$qtitle .= "($qanswer)";
				break;
				
				
				
				//Array of Yes/No/$clang->gT("Uncertain")
				//same as above
				case "E": 
				$qquery = "SELECT code, answer FROM ".db_table_name("answers")." WHERE qid='$qiqid' AND code='$qanswer' AND language='{$language}' ORDER BY sortorder, answer";
				$qresult=db_execute_num($qquery) or safe_die ("Couldn't get answer details<br />$qquery<br />".$connect->ErrorMsg());
				while ($qrow=$qresult->FetchRow())
				{
					$alist[]=array("I", $clang->gT("Increase"));
					$alist[]=array("S", $clang->gT("Same"));
					$alist[]=array("D", $clang->gT("Decrease"));
					$atext=$qrow[1];
				}
				$qquestion .= "<br />\n[".$atext."]";
				$qtitle .= "($qanswer)";
				break;
				
				
				
				case "F": //Array of Flexible
				case "H": //Array of Flexible by Column
				$qquery = "SELECT code, answer FROM ".db_table_name("answers")." WHERE qid='$qiqid' AND code='$qanswer' AND language='{$language}' ORDER BY sortorder, answer";
				$qresult=db_execute_num($qquery) or safe_die ("Couldn't get answer details<br />$qquery<br />".$connect->ErrorMsg());
				
				//loop through answers
				while ($qrow=$qresult->FetchRow())
				{
					//this question type uses its own labels
					$fquery = "SELECT * FROM ".db_table_name("labels")." WHERE lid='{$qlid}' AND language='{$language}'ORDER BY sortorder, code";
					$fresult = db_execute_assoc($fquery);
					
					//add code and title to results for outputting them later
					while ($frow=$fresult->FetchRow())
					{
						$alist[]=array($frow['code'], strip_tags($frow['title']));
					}
					
					//counter
					$atext=$qrow[1];
				}
				
				//output
				$qquestion .= "<br />\n[".$atext."]";
				$qtitle .= "($qanswer)";
				break;
				
				
				
				case "G": //Gender
				$alist[]=array("F", $clang->gT("Female"));
				$alist[]=array("M", $clang->gT("Male"));
				break;
				
				
				
				case "Y": //Yes\No
				$alist[]=array("Y", $clang->gT("Yes"));
				$alist[]=array("N", $clang->gT("No"));
				break;
				
				
				
				case "I": //Language
				// Using previously defined $survlangs array of language codes
				foreach ($survlangs as $availlang)
				{
					$alist[]=array($availlang, getLanguageNameFromCode($availlang,false));
				}
				break;
				
				
				
				case "5": //5 Point (just 1 item to rank!)
				for ($i=1; $i<=5; $i++)
				{
					$alist[]=array("$i", "$i");
				}
				break;


			
				case "W":	//List felixble labels (dropdown)
					
				case "Z":	//List flexible labels (radio)
					
				//get labels
				$fquery = "SELECT * FROM ".db_table_name("labels")." WHERE lid='{$qlid}' AND language='{$language}' ORDER BY sortorder, code";
				$fresult = db_execute_assoc($fquery);
				
				//put label code and label title into array
				while ($frow=$fresult->FetchRow())
				{
					$alist[]=array($frow['code'], strip_tags($frow['title']));
				}
				
				//does "other" field exist?
				if ($qother == "Y")
				{
					$alist[]=array($clang->gT("Other"),$clang->gT("Other"),$fielddata['fieldname'].'other');
				}
				break;
				
				
				
				
                case "1":	//array flexible labels (dual scale)
                	
                //get question attributes
                $qidattributes=getQuestionAttributes($qqid);
                
                //check last character -> label 1
                if (substr($rt,-1,1) == 0)
                {
                    //get label 1
                    $fquery = "SELECT * FROM ".db_table_name("labels")." WHERE lid='{$qlid}' AND language='{$language}' ORDER BY sortorder, code";
                    
                    //header available?
                    if ($dsheaderA=arraySearchByKey("dualscale_headerA", $qidattributes, "attribute", 1))
                    {
                    	//output
                        $labelheader= "[".$dsheaderA['value']."]";
                    }
                    
                    //no header
                    else
                    {
                        $labelheader ='';
                    }
                    
                    //output
                    $labelno = "Label 1";
                }
                
                //label 2
                else 
                {
                    //get label 2
                    $fquery = "SELECT * FROM ".db_table_name("labels")." WHERE lid='{$qlid1}' AND language='{$language}' ORDER BY sortorder, code";
                    
                    //header available?
                    if ($dsheaderB=arraySearchByKey("dualscale_headerB", $qidattributes, "attribute", 1))
                    {
                    	//output
                        $labelheader= "[" . $dsheaderB['value'] . "]";
                    }

                    //no header
                    else
                    {
                        $labelheader ='';
                    }
                    
                    //output
                    $labelno = "Label 2";
                }
                
                //get data
                $fresult = db_execute_assoc($fquery);
                
                //put label code and label title into array
                while ($frow=$fresult->FetchRow())
                {
                    $alist[]=array($frow['code'], strip_tags($frow['title']));
                }
                
                //adapt title and question
                $qtitle = $qtitle." [".$qanswer."][".$labelno."]";
                $qquestion  = $qastring .$labelheader;
                break;
                
                
                
                
				default:	//default handling
				
				//get answer code and title
				$qquery = "SELECT code, answer FROM ".db_table_name("answers")." WHERE qid='$qqid' AND language='{$language}' ORDER BY sortorder, answer";
				$qresult = db_execute_num($qquery) or safe_die ("Couldn't get answers list<br />$qquery<br />".$connect->ErrorMsg());
				
				//put answer code and title into array
				while ($qrow=$qresult->FetchRow())
				{
					$alist[]=array("$qrow[0]", "$qrow[1]");
				}
				
				//handling for "other" field for list radio or list drowpdown
				if (($qtype == "L" || $qtype == "!") && $qother == "Y")
				{
					//add "other"
					$alist[]=array($clang->gT("Other"),$clang->gT("Other"),$fielddata['fieldname'].'other');
				}
				
			}	//end switch question type
			
		}	//end else -> single option answers 

		//foreach ($alist as $al) {$statisticsoutput .= "$al[0] - $al[1]<br />";} //debugging line
		//foreach ($fvalues as $fv) {$statisticsoutput .= "$fv | ";} //debugging line
		
		
		
		
		
		//2. Collect and Display results #######################################################################
		if (isset($alist) && $alist) //Make sure there really is an answerlist, and if so:
		{
			//output
			$statisticsoutput .= "<table width='95%' align='center' border='1'  cellpadding='2' cellspacing='0' class='statisticstable'>\n"
			."\t<tr><td colspan='3' align='center'><strong>"
			
			//headline
			.$clang->gT("Field Summary for")." $qtitle:</strong>"
			."</td></tr>\n"
			."\t<tr><td colspan='3' align='center'><strong>"
			
			//question title
			."$qquestion</strong></td></tr>\n"
			."\t<tr>\n\t\t<td width='50%' align='center' >"
			
			//three columns
			."<strong>".$clang->gT("Answer")."</strong></td>\n"
			."\t\t<td width='25%' align='center' >"
			."<strong>".$clang->gT("Count")."</strong></td>\n"
			."\t\t<td width='25%' align='center' >"
			."<strong>".$clang->gT("Percentage")."</strong></td>\n"
			."\t</tr>\n";
            
			// this will count the answers considered completed
			$TotalCompleted = 0;    
			
			//loop thorugh the array which contains all answer data
			foreach ($alist as $al)
			{
				//picks out alist that come from the multiple list above
				if (isset($al[2]) && $al[2]) 
				{
					//handling for "other" option
					if ($al[1] == $clang->gT("Other"))
					{
						//get data
						$query = "SELECT count(*) FROM ".db_table_name("survey_$surveyid")." WHERE ";
						$query .= ($connect->databaseType == "mysql")?  db_quote_id($al[2])." != ''" : "NOT (".db_quote_id($al[2])." LIKE '')";
					}
					
					/*
					 * text questions:
					 * 
					 * U = huge free text
					 * T = long free text
					 * S = short free text
					 * Q = multiple short text
					 */
					elseif ($qtype == "U" || $qtype == "T" || $qtype == "S" || $qtype == "Q")
					{
						//free text answers
						if($al[0]=="Answers")
						{
							$query = "SELECT count(*) FROM ".db_table_name("survey_$surveyid")." WHERE ";
                            $query .= ($connect->databaseType == "mysql")?  db_quote_id($al[2])." != ''" : "NOT (".db_quote_id($al[2])." LIKE '')";
						}
						//"no answer" handling
						elseif($al[0]=="NoAnswer")
						{
							$query = "SELECT count(*) FROM ".db_table_name("survey_$surveyid")." WHERE (".db_quote_id($al[2])." IS NULL OR ";
                            $query .= ($connect->databaseType == "mysql")?  db_quote_id($al[2])." = '')" : " (".db_quote_id($al[2])." LIKE ''))";
						}
					}
					// all other question types
					else
					{
						$query = "SELECT count(*) FROM ".db_table_name("survey_$surveyid")." WHERE ".db_quote_id($al[2])." =";
						
						//ranking question?
						if (substr($rt, 0, 1) == "R")
						{
							$query .= " '$al[0]'";
						}
						else
						{
							$query .= " 'Y'";
						}
					}
					
				}	//end if -> alist set
				
				else
				{ 
					//get more data                          
					$query = "SELECT count(*) FROM ".db_table_name("survey_$surveyid")." WHERE ".db_quote_id($rt)." = '$al[0]'";
				}
				
				//check filter option
				if (incompleteAnsFilterstate() === true) {$query .= " AND submitdate is not null";}                     
				
				//check for any "sql" that has been passed from another script
				if ($sql != "NULL") {$query .= " AND $sql";}
				
				//get data
				$result=db_execute_num($query) or safe_die ("Couldn't do count of values<br />$query<br />".$connect->ErrorMsg());
				
				// $statisticsoutput .= "\n<!-- ($sql): $query -->\n\n";
                
				// this just extracts the data, after we present
				while ($row=$result->FetchRow())                   
				{
					//increase counter
                    $TotalCompleted += $row[0];
                    
                    //"no answer" handling
					if ($al[0] == "")
					{$fname=$clang->gT("No answer");}
					
					//"other" handling				
					//"Answers" means that we show an option to list answer to "other" text field
					elseif ($al[0] == $clang->gT("Other") || $al[0] == "Answers")
					{$fname="$al[1] <input type='submit' value='".$clang->gT("Browse")."' onclick=\"window.open('admin.php?action=listcolumn&sid=$surveyid&amp;column=$al[2]&amp;sql=".urlencode($sql)."', 'results', 'width=460, height=500, left=50, top=50, resizable=yes, scrollbars=yes, menubar=no, status=no, location=no, toolbar=no')\" />";}
					
					/*
					 * text questions:
					 * 
					 * U = huge free text
					 * T = long free text
					 * S = short free text
					 * Q = multiple short text
					 */
					elseif ($qtype == "S" || $qtype == "U" || $qtype == "T" || $qtype == "Q")
					{
						//show free text answers
						if ($al[0] == "Answers")
						{
							$fname= "$al[1] <input type='submit' value='"
							. $clang->gT("Browse")."' onclick=\"window.open('admin.php?action=listcolumn&sid=$surveyid&amp;column=$al[2]&amp;sql="
							. urlencode($sql)."', 'results', 'width=460, height=500, left=50, top=50, resizable=yes, scrollbars=yes, menubar=no, status=no, location=no, toolbar=no')\" />";
						}
						elseif ($al[0] == "NoAnswer")
						{
							$fname= "$al[1]";
						}
					}
					
					
					//MM: check if aggregated results should be shown
					elseif ($showaggregateddata == 1 && isset($showaggregateddata))
					{
						//text for answer column is always needed
						$fname="$al[1] ($al[0])";
						
						//MM: at the beginning only these question type are supported
						if($qtype == "5" || $qtype == "A")
						{					
							//put non-edited data in here because $row will be edited later
							$grawdata[]=$row[0];
							
							//keep in mind that we already added data (will be checked later)
							$justadded = true;							
							
							//we need a counter because we want to sum up certain values
							//reset counter if 5 items have passed
							if(!isset($testcounter) || $testcounter >= 4)
							{
								$testcounter = 0;
							}
							else
							{
								$testcounter++;
							}							
							
							//beside the known percentage value a new aggregated value should be shown
							//therefore this item is marked in a certain way
							
							if($testcounter == 0 )	//add 300 to original value
							{													
								//HACK: add three times the total number of results to the value
								//This way we get a 300 + X percentage which can be checked later
								$row[0] += (3*$results);
							}
							
							//the third value should be shown twice later -> mark it
							if($testcounter == 2)	//add 400 to original value
							{
								//HACK: add four times the total number of results to the value
								//This way there should be a 400 + X percentage which can be checked later
								$row[0] += (4*$results);
							}
							
							//the last value aggregates the data of item 4 + item 5 later
							if($testcounter == 4 )	//add 200 to original value
							{							
								//HACK: add two times the total number of results to the value
								//This way there should be a 200 + X percentage which can be checked later
								$row[0] += (2*$results);
							}
							
						}	//end if -> question type = "5"/"A"
											
					}	//end if -> show aggregated data
					
					//handling what's left
					else
					{
						//answer text
						$fname="$al[1] ($al[0])";
					}
					
					//are there some results to play with?
					if ($results > 0)
					{
						//calculate percentage
						$gdata[] = ($row[0]/$results)*100;
					} 
					//no results
					else
					{
						//no data!
                        $gdata[] = "N/A";
					}
					
					//only add this if we don't handle question type "5"/"A"
					if(!isset($justadded))
					{
						//put absolute data into array
						$grawdata[]=$row[0];
						
					}
					else
					{
						//unset to handle "no answer" data correctly
						unset($justadded);
					}
					
					//put question title and code into array
                    $label[]=$fname;
                    
                    //put only the code into the array
					$justcode[]=$al[0];
					
					//edit labels and put them into antoher array
                    $lbl[] = wordwrap(strip_tags($fname), 20, "\n");
                    
                }	//end while -> loop through results
                
			}	//end foreach -> loop through answer data

			//no filtering of incomplete answers and no multiple option questions
            if ((incompleteAnsFilterstate() === false) and ($qtype != "M") and ($qtype != "P"))
            {
            	//is the checkbox "Don't consider NON completed responses (only works when Filter incomplete answers is Disable)" checked?
                if (isset($_POST["noncompleted"]) and ($_POST["noncompleted"] == "on"))
                {
                	//counter
                    $i=0;
                    
                    while (isset($gdata[$i]))
                    {
                    	//we want to have some "real" data here
                        if ($gdata[$i] != "N/A") 
                        {
                        	//calculate percentage
                        	$gdata[$i] = ($grawdata[$i]/$TotalCompleted)*100; 
                        }
                        
                        //increase counter
                        $i++;
                        
					}	//end while (data available)
					
				}	//end if -> noncompleted checked
			
				//noncompleted is NOT checked
	            else
	            {
	            	//calculate total number of incompleted records
	                $TotalIncomplete = $results - $TotalCompleted;
	                
	                //output
	                $fname=$clang->gT("Non completed");
	                
	                //we need some data
	                if ($results > 0)
	                {
	                	//calculate percentage
	                    $gdata[] = ($TotalIncomplete/$results)*100;
	                } 
	                
	                //no data :(
	                else
	                {
	                    $gdata[] = "N/A";
	                }
	                
	                //put data of incompleted records into array
	                $grawdata[]=$TotalIncomplete;
	                
	                //put question title ("Not completed") into array
	                $label[]= $fname;
	                
	                //put the code ("Not completed") into the array
	                $justcode[]=$fname;
	                
	                //edit labels and put them into antoher array
	                $lbl[] = wordwrap(strip_tags($fname), 20, "\n");
	                
	            }	//end else -> noncompleted NOT checked
	            
            }	//end if -> no filtering of incomplete answers and no multiple option questions
            
            
            //counter
            $i=0;
            
            //loop through all available answers
            while (isset($gdata[$i]))
            {
            	/*
            	 * there are 3 colums:
            	 * 
            	 * 1 (50%) = answer (title and code in brackets)
            	 * 2 (25%) = count (absolute)
            	 * 3 (25%) = percentage
            	 */
                $statisticsoutput .= "\t<tr>\n\t\t<td width='50%' align='center' >" . $label[$i] ."\n"
                ."\t\t</td>\n"
                
                //output absolute number of records
                ."\t\t<td width='25%' align='center' >" . $grawdata[$i] . "\n";
                
                
                //XXX $vp isn't used anywhere else?!? clean up?
			                //data available?
			                if ($results > 0) 
			                {	
			                	//calculate percentage and limit result to 2 internal decimal places
			                	$vp=sprintf("%01.2f", ($row[0]/$results)*100)."%";
			                } 
			                else 
			                {
			                	$vp="N/A";
			                }
                
                //MM: edited output format...
                
                //no data
                if ($gdata[$i] == "N/A") 
                {
                	//MM new (moved from above)
                	$statisticsoutput .= "\t\t</td><td width='25%' align='center' >";
                	
                	//percentage = 0
                    $statisticsoutput .= $gdata[$i];
                    $gdata[$i] = 0;
                }
                
                //data available
                else
                {                        	
                	//MM: check if data should be aggregated
                	if($showaggregateddata == 1 && isset($showaggregateddata))
                	{
                		//cope with "normal" data of this question type
                		//nothing special to do here, just adjust output
	                	if($gdata[$i] <= 100)
	                	{
	                		//MM new (moved)
	                		$statisticsoutput .= "\t\t</td><td width='25%' align='center' >";
	                		
	                		//output percentage
	                		$statisticsoutput .= sprintf("%01.2f", $gdata[$i]) . "%";
	                		$statisticsoutput .= "\t\t</td><td>";
	                	}
	                	
	                	//middle value -> just show results twice
	                	if($gdata[$i] >= 400)
	                	{         		
	                		//remove "400" which was added before
	                		//to get the original percentage
	                		$gdata[$i] -= 400;	                		
	                		
	                		//output percentage
	                		$statisticsoutput .= "\t\t</td><td width='12%' align='center' >";
	                		$statisticsoutput .= sprintf("%01.2f", $gdata[$i]) . "%";
							
							//output again (no real aggregation here)
	                		$statisticsoutput .= "\t\t</td><td width='12%' align='right' >";
	                		$statisticsoutput .= sprintf("%01.2f", $gdata[$i])."%";
	                	}
	                	
	                	//FIRST value -> add percentage of item 1 + item 2
	                	if($gdata[$i] >= 300 && $gdata[$i] < 400)
	                	{   
	                		//remove "300" which was added before
	                		$gdata[$i] -= 300;
	                		
	                		//calculate aggregated data
	                		$index = $i + 1;
	                		
	                		//percentage of item 1 + item 2
	                		$aggregatedgdata = $gdata[$i] + $gdata[$index];
	                		
	                		//output percentage
	                		//MM new (moved)
	                		$statisticsoutput .= "\t\t</td><td width='12%' align='center' >";
	                		$statisticsoutput .= sprintf("%01.2f", $gdata[$i]) . "%";
							
	                		//output aggregated data
	                		$statisticsoutput .= "\t\t</td><td width='12%' align='right' >";
	                		$statisticsoutput .= sprintf("%01.2f", $aggregatedgdata)."%";
	                	}
	                	
	                	//LAST value -> add item 4 + item 5
	                	if($gdata[$i] > 100 && $gdata[$i] < 300)
	                	{	                		
	                		//remove "200" which was added before
	                		$gdata[$i] -= 200;
	                		
	                		//calculate aggregated data
	                		$index = $i - 1;
	                		
	                		//item 4 + item 5
	                		$aggregatedgdata = $gdata[$i] + $gdata[$index];
	                		
	                		//MM new (moved)
	                		$statisticsoutput .= "\t\t</td><td width='12%' align='center' >";
	                		$statisticsoutput .= sprintf("%01.2f", $gdata[$i]) . "%";
							
	                		//output aggregated data
	                		$statisticsoutput .= "\t\t</td><td width='12%' align='right' >";
	                		$statisticsoutput .= sprintf("%01.2f", $aggregatedgdata)."%";
	                	}
	                	
                	}	//end if -> show aggregated data
                	
                	//don't show aggregated data
                	else
                	{                		
                		//output percentage 
	                	$statisticsoutput .= "\t\t</td><td width='25%' align='center' >";
                		$statisticsoutput .= sprintf("%01.2f", $gdata[$i]) . "%";
                	}
                	                	                	
                }	//end else -> $gdata[$i] != "N/A"                    
                
                //end output per line
                $statisticsoutput .= "\t\t</td>\n\t</tr>\n";
                
                //increase counter
                $i++;
            }

			if ($usejpgraph == 1 && isset($_POST['usegraph']) && array_sum($gdata)>0) //JPGRAPH CODING ORIGINALLY SUBMITTED BY Pieterjan Heyse
			{
				$graph = "";
				$p1 = "";
				//                  $statisticsoutput .= "<pre>";
				//                  $statisticsoutput .= "GDATA:\n";
				//                  print_r($gdata);
				//                  $statisticsoutput .= "GRAWDATA\n";
				//                  print_r($grawdata);
				//                  $statisticsoutput .= "LABEL\n";
				//                  print_r($label);
				//                  $statisticsoutput .= "JUSTCODE\n";
				//                  print_r($justcode);
				//                  $statisticsoutput .= "LBL\n";
				//                  print_r($lbl);
				//                  $statisticsoutput .= "</pre>";
				//First, lets delete any earlier graphs from the tmp directory
				//$gdata and $lbl are arrays built at the end of the last section
				//that contain the values, and labels for the data we are about
				//to send to jpgraph.
				if ($qtype == "M" || $qtype == "P") { //Bar Graph
					$graph = new Graph(640,320,'png');
					$graph->SetScale("textint");
					$graph->img->SetMargin(50,50,50,50);
					$graph->xaxis->SetTickLabels($justcode);
					$graph->xaxis->SetFont(constant($jpgraphfont), FS_NORMAL, 8);
					$graph->xaxis->SetColor("black");
				//	$graph->xaxis->title->Set($clang->gT("Code"));
					$graph->xaxis->title->SetFont(constant($jpgraphfont), FS_BOLD, 9);
					$graph->xaxis->title->SetColor("black");
					$graph->yaxis->SetFont(constant($jpgraphfont), FS_NORMAL, 8);
					$graph->yaxis->SetColor("black");
					$graph->yaxis->title->Set($clang->gT("Count")." / $results");
					$graph->yaxis->title->SetFont(constant($jpgraphfont), FS_BOLD, 9);
					$graph->yaxis->title->SetColor("black");
					//$graph->Set90AndMargin();
				} else { //Pie Charts
				
                    $i = 0;
                    foreach ($gdata as $data)
                    {
                        if ($data != 0){$i++;}
                    }	
					$totallines=$i;
					if ($totallines>15) {
						$gheight=320+(6.7*($totallines-15));
						$fontsize=7;
						$legendtop=0.01;
						$setcentrey=0.5/(($gheight/320));
					} else {
						$gheight=320;
						$fontsize=8;
						$legendtop=0.07;
						$setcentrey=0.5;
					}
					$graph = new PieGraph(680,$gheight,'png');
					$graph->legend->SetFont(constant($jpgraphfont), FS_NORMAL, $fontsize);
					$graph->legend->SetPos(0.015, $legendtop, 'right', 'top');
					$graph->legend->SetFillColor("white");
					global $jpgraph_antialiasing;
					if ($jpgraph_antialiasing == 1) $graph->SetAntiAliasing();
				}
				$graph->title->SetColor("black");
				$graph->SetMarginColor("#FFFFFF");
				// Set A title for the plot
				// $graph->title->Set($qquestion); //disabled: printing titles is only a good solution if question texts are short
				$graph->title->SetFont(constant($jpgraphfont),FS_BOLD,12);
				// Create pie plot
				if ($qtype == "M" || $qtype == "P") { //Bar Graph
					$p1 = new BarPlot($grawdata);
					$p1->SetWidth(0.8);
					$p1->SetValuePos("center");
					$p1->SetFillColor("#4f81bd");
					if (!in_array(0, $grawdata)) { //don't show shadows if any of the values are 0 - jpgraph bug
						$p1->SetShadow();
					}
					$p1->value->Show();
					$p1->value->SetFont(constant($jpgraphfont),FS_BOLD,8);
					$p1->value->SetColor("#FFFFFF");
				} else { //Pie Chart
                    // this block is to remove the items with value == 0
                    $i = 0;
                    while (isset ($gdata[$i]))
                    {
                        if ($gdata[$i] == 0)
                        {
                           array_splice ($gdata, $i, 1);
                           array_splice ($lbl, $i, 1);
                        }
                        else
                        {$i++;}
                    }
                
                    //create new 3D pie chart
					$p1 = new PiePlot3d($gdata);
					
					//debugging
					//                        $statisticsoutput .= "<pre>";print_r($lbl);$statisticsoutput .= "</pre>";
					//                        $statisticsoutput .= "<pre>";print_r($gdata);$statisticsoutput .= "</pre>";
					
					//MM: color theme (see http://doc.async.com.br/jpgraph/html/4020pieplot.html#7_2_4)
					$p1->SetTheme("earth");					
					
					$p1->SetLegends($lbl);
					$p1->SetSize(200);
					$p1->SetCenter(0.375,$setcentrey);
					
					//black
					$p1->value->SetColor("#000000");
					$p1->value->SetFont(constant($jpgraphfont),FS_NORMAL,12);
					
					//XXX can this be deleted?
					// Set how many pixels each slice should explode
					//$p1->Explode(array(0,15,15,25,15));
					
				}	//end else -> pie charts

				//introduce new counter
				if (!isset($ci)) {$ci=0;}
				
				//increase counter, start value -> 1
				$ci++;
				
				//add graph
				$graph->Add($p1);
				
				//filename of chart image
				$gfilename="STATS_".date("d")."X".$currentuser."X".$surveyid."X".$ci.date("His").".png";
				
				//create graph
				$graph->Stroke($tempdir."/".$gfilename);
				
				//add graph to output
				$statisticsoutput .= "<tr><td colspan='3' style=\"text-align:center\"><img src=\"$tempurl/".$gfilename."\" border='1'></td></tr>";
				
			}	//end if -> jpgraph enabled
			
			//close table/output
			$statisticsoutput .= "</table>";
			
		}	//end if -> collect and display results
		
		//delete data
		unset($gdata);
		unset($grawdata);
        unset($label);
		unset($lbl);
		unset($justcode);
		unset ($alist);		
		
	}	// end foreach -> loop through all questions
	
	//output
    $statisticsoutput .= "<br />&nbsp\n";
    
}	//end if -> show summary results


//done! set progress bar to 100%
if (isset($prb))
{
	$prb->setLabelValue('txt1',$clang->gT('Completed'));
	$prb->moveStep(100);
	$prb->hide();
}


//delete old images
function deletePattern($dir, $pattern = "")
{
	$deleted = false;
	$pattern = str_replace(array("\*","\?"), array(".*","."), preg_quote($pattern));
	if (substr($dir,-1) != "/") $dir.= "/";
	if (is_dir($dir))
	{
		$d = opendir($dir);
		while ($file = readdir($d))
		{
			if (is_file($dir.$file) && ereg("^".$pattern."$", $file))
			{
				if (unlink($dir.$file))
				{
					$deleted[] = $file;
				}
			}
		}
		closedir($d);
		return $deleted;
	}
	else return 0;
}


//delete old images (which aren't from today?)
function deleteNotPattern($dir, $matchpattern, $pattern = "")
{
	$deleted = false;
	$pattern = str_replace(array("\*","\?"), array(".*","."), preg_quote($pattern));
	$matchpattern = str_replace(array("\*","\?"), array(".*","."), preg_quote($matchpattern));
	if (substr($dir,-1) != "/") $dir.= "/";
	if (is_dir($dir))
	{
		$d = opendir($dir);
		while ($file = readdir($d))
		{
			if (is_file($dir.$file) && ereg("^".$matchpattern."$", $file) && !ereg("^".$pattern."$", $file))
			{
				if (unlink($dir.$file))
				{
					$deleted[] = $file;
				}
			}
		}
		closedir($d);
		return $deleted;
	}
	else return 0;
}


//show whole question title using tooltip for speaker symbol
function showSpeaker($hinttext)
{
  global $imagefiles, $clang;
  $reshtml= "<img src='$imagefiles/speaker.png' align='bottom' alt='$hinttext' title='$hinttext' "
           ." onclick=\"alert('".$clang->gT("Question","js").": $hinttext')\" />";
  return $reshtml; 
}

?>
