<?php
/*
	#############################################################
	# >>> PHPSurveyor  									    	#
	#############################################################
	# > Author:  Jason Cleeland									#
	# > E-mail:  jason@cleeland.org								#
	# > Mail:    Box 99, Trades Hall, 54 Victoria St,			#
	# >          CARLTON SOUTH 3053, AUSTRALIA                  #
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
require_once(dirname(__FILE__).'/../config.php');

if (!isset($surveyid)) {$surveyid=returnglobal('sid');}
if (!isset($gid)) {$gid=returnglobal('gid');}
if (!isset($qid)) {$qid=returnglobal('qid');}
if (!isset($lid)) {$lid=returnglobal('lid');}
if (!isset($code)) {$code=returnglobal('code');}
if (!isset($action)) {$action=returnglobal('action');}
if (!isset($ok)) {$ok=returnglobal('ok');}
if (!isset($user)) {$user=returnglobal('user');}
if (!isset($pass)) {$pass=returnglobal('pass');}
if (!isset($dbaction)) {$dbaction=returnglobal('dbaction');}

sendcacheheaders();

//SOME SETTINGS - TO PUT INTO CONFIG.PHP EVENTUALLY
$navigation['dropdownaction']	=	"onMouseOver";
$navigation['defaultqdisplay']	=	0;

$auth_function = "is_authorised";

//TRANSLATIONS:
define("_SN_TITLE", "Survey Navigator");
define("_NEVER", "Never");
define("_SN_OPTIONS", "Options");
define("_SN_ACTIONS", "Actions");
define("_SN_OTHER", "Other");
define("_SN_QUICKDISPLAY", "Brief");
define("_SN_EXCLUDE", "Exclude");
define("_SN_GROUPS", "Groups");
define("_SN_QUESTIONS", "Questions");
define("_SN_SV_GENERAL", "General");
define("_SN_SV_EXTRA", "Extra");
define("_SN_SV_EMAIL", "Email");
define("_SN_SV_MISC", "Miscellaneous");
define("_SN_CANNOTCHANGE_SURVEYACTIVE", "<i><font color='red'>Cannot change in active survey</font></i>");
define("_SN_ACTIVESURVEYOPTIONS", "Active Survey Options");
define("_SN_ACTIVEQUESTIONOPTIONS", "Active Question Options");
define("_SN_RESULTS", "Summary of Current Results");
define("_SN_RECORDS", "Records");
define("_Q_PREVIEWQUESTION", "View a preview of this question");
define("_Q_VIEWSUMMARY", "View Summary for this Question");
define("_PR_HEADING", "Preview");
define("_IMPORT", "Import");
define("_CREATE", "Create"); 
define("_AUTHENTICATION_BT", "Authentication");
define("_SYSTEM_BT", "System Summary");
define("_G_RENUMBER_BT", "Renumber Questions in Group");
define("_G_RENUMBERGROUPWARNING", "This will consecutively renumber all questions in this group. Are you sure you want to continue?");
define("_S_RENUMBER_BT", "Renumber Questions in Survey");
define("_S_RENUMBERSURVEYWARNING", "This will consecutively renumber all questions in this survey. Are you sure you want to continue?");

//This overrides the common.php setting until this gets merged back..
$htmlheader = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">\n"
			. "<html>\n<head>\n"
			. "<title>$sitename</title>\n"
            . "<meta http-equiv=\"content-type\" content=\"text/html; charset=UTF-8\">\n"
			. "<meta http-equiv=\"content-script-type\" content=\"text/javascript\">\n"
			. "<meta http-equiv=\"Content-Style-Type\" content=\"text/css\">\n"
			. "<link href=\"$homeurl/phpsurveyor.css\" rel=\"stylesheet\" type=\"text/css\">\n"
			. "<script src=\"$homeurl/classes/TreeMenu/TreeMenu.js\" language=\"JavaScript\" type=\"text/javascript\"></script>\n"
			. "</head>\n<body>\n";
//			. "<table width='100%' align='center' bgcolor='#000000'>\n"
//			. "\t<tr>\n"
//			. "\t\t<td align='center'>\n"
//			. "\t\t\t$setfont<font color='white' size='4'><strong>$sitename</strong></font></font>\n"
//			. "\t\t</td>\n"
//			. "\t</tr>\n"
//			. "</table>\n";
$scriptname = "index.php";

echo $htmlheader;

echo "<script type='text/javascript'>
	  <!--
	    function showhelp(action) {
		 var name='help';
		 if (action == \"hide\") {
		  document.getElementById(name).style.display='none';
		 } else if (action == \"show\") {
		  document.getElementById(name).style.display='';
		 }
		}
		function rusurelink(rusuremessage,rusurelink) {
		 if (confirm(rusuremessage) == true) {
		  window.open(rusurelink, \"_top\");
		 } else {
		  alert(\"Cancelled\");
		 }
		}
	  //-->
	  </script>\n";

// CHECK IF FIRST USE - ie Database Exists!
if (!$database_exists)
	{
	echo "<br />\n"
		."<table width='350' align='center' style='border: 1px solid #555555' cellpadding='1' cellspacing='0'>\n"
		."\t<tr bgcolor='#555555'><td colspan='2' height='4'><font size='1' face='verdana' color='white'><strong>"
		._SETUP."</strong></td></tr>\n"
		."\t<tr bgcolor='#CCCCCC'><td align='center'>$setfont\n"
		."<strong><font color='red'>"
		._ERROR."<br />\n"
		._ST_NODB1."</font></strong><br /><br />\n"
		._ST_NODB2."<br />\n"
		._ST_NODB3."<br /><br />\n"
		._ST_NODB4." $databasename<br />\n"
		."<br /><input $btstyle type='submit' value='"
		._ST_CREATEDB."' onClick='location.href=\"createdb.php\"' /></center>\n"
		."</td></tr></table>\n"
		."</body>\n</html>\n";
	exit;
	}
else
	{
	//DB EXISTS, CHECK FOR APPROPRIATE TABLES
	checkfortables();
	}


if ($action == "activate")
	{
	include("activate.php");
	exit;
	}
if ($action == "deactivate")
	{
	include("deactivate.php");
	exit;
	}

if ($action == "importsurvey" && (isset($_POST['ok']) && $_POST['ok'] == "yes"))
	{
	include("importsurvey.php");
	exit;
	}
if ($action == "importgroup" && (isset($_POST['ok']) && $_POST['ok'] == "yes"))
	{
	include("importgroup.php");
	exit;
	}
if ($action == "importquestion" && (isset($_POST['ok']) && $_POST['ok'] == "yes"))
	{
	include("importquestion.php");
	exit;
	}

//CHECK THAT SURVEYS MARKED AS ACTIVE ACTUALLY HAVE MATCHING TABLES
checkactivations();


//VARIOUS DATABASE OPTIONS/ACTIONS PERFORMED HERE
//if ($action == "delsurvey" || $action == "delgroup" || $action == "delgroupall" || 
//	$action=="delquestion" || $action=="delquestionall" || $action == "insertnewsurvey" || 
//	$action == "copynewquestion" || $action == "insertnewgroup" || 
//	$action == "insertnewquestion" || $action == "updatesurvey" || $action=="updategroup" || 
//	$action=="updatequestion" || $action == "modanswer" || $action == "renumberquestions" ||
//	$action == "delattribute" || $action == "addattribute" || $action == "editattribute")
//	{
//	include("database.php");
//	}


// WE DRAW THE PRETTY SCREEN HERE

//include("html.php"); 


//$cellstyle = "style='border: 1px inset #000080'";
echo "<table width='100%' border='0' cellpadding='0' cellspacing='0'>\n"
	."\t<tr>\n"
	."\t\t<td valign='top' align='center' bgcolor='#BBBBBB'>\n";
	//."\t\t\t<font size='2'>\n";

echo adminmenu();

if (isset($dbaction) && $dbaction != "") {
    //Database modifications to occur
	include("dbedit.php");
}

//Creates new "mastertable" that includes navigator
include("navigator.php");
echo "<table width='100%' cellspacing='0' cellpadding='0'>
	<tr><td valign='top' bgcolor='#CCCCCC' width='10%'>";
surveyNavigator($surveyid, $gid, $qid);
echo "</td><td valign='top' bgcolor='#DDDDDD' width='90%'>";

echo javadropdown($surveyid, $gid, $qid);
if (!empty($surveyid) && call_user_func($auth_function) 
	&& $action != "delsurvey" && $dbaction != "delsurvey"
	) {
	surveyDetails($surveyid, $gid, $qid);
}

if (!empty($gid) && call_user_func($auth_function)
	&& $action != "delgroup" && $dbaction != "delgroup") 
   {groupDetails($surveyid, $gid, $qid);}
if (!empty($qid) && call_user_func($auth_function)
	&& $action != "delquestion" && $dbaction != "delquestion") 
	{questionDetails($surveyid, $gid, $qid, $action);}

if (isset($action) && call_user_func($auth_function)) {
    switch($action) {
		case "editsurvey":
		case "addsurvey":
			surveyEdit($surveyid);
			break;
		case "importsurvey":
			surveyImport();
			break;
		case "delsurvey":
			surveyDel($surveyid);
			break;
		case "delgroup":
			groupDel($surveyid, $gid);
			break;
		case "editgroup":
		case "addgroup":
			groupEdit($surveyid, $gid);
			break;
		case "delquestion":
			questionDel($surveyid, $gid, $qid);
			break;
		case "editquestion":
		case "addquestion":
		case "copyquestion";
			questionEdit($surveyid, $gid, $qid);
			break;
		case "showlabelsets":
			labelsetDetails($lid);
			break;
		case "addlabel":
			labelAdd();
			break;
		case "showsummary":
			if(!empty($qid)) {
				questionResultSummary($surveyid, $gid, $qid);
			}
			break;
		case "showattributes":
			if (!empty($qid)) {
			    attributeDetails($surveyid, $gid, $qid);
			}
			break;
		case "showanswers":
			if (!empty($qid)) {
			    answerDetails($surveyid, $gid, $qid);
			}
			break;
		case "showassessments":
			if (!empty($surveyid)) {
			    assessmentDetails($surveyid);
			}
			break;
		case "checksettings":
		case "changelang":
			checksettings($dbprefix);
			break;
		case "showpreview":
			showPreview($surveyid, $gid, $qid);
			break;
	}
}

echo "\t\t</td>\n";

helpscreen();

echo "\t</tr>\n";
echo "</table>\n";

//Closes off master table that includes new navigator
echo "</td></tr></table>";
//

echo footer("$langdir/instructions.html", "Using PHPSurveyors Admin Script");

function helpscreen()
	{
	global $homeurl, $langdir, $setfont, $imagefiles;
	global $surveyid, $gid, $qid, $action;
	echo "\t\t<td id='help' width='150' valign='top' style='display: none' bgcolor='#CCCCCC'>\n"
		."\t\t\t<table width='100%'><tr><td>"
		."<table width='100%' align='center' cellspacing='0'>\n"
		."\t\t\t\t<tr>\n"
		."\t\t\t\t\t<td bgcolor='#555555' height='8'>\n"
		."\t\t\t\t\t\t$setfont<font color='white' size='1'><strong>"
		._HELP."</strong>\n"
		."\t\t\t\t\t</font></font></td>\n"
		."\t\t\t\t</tr>\n"
		."\t\t\t\t<tr>\n"
		."\t\t\t\t\t<td align='center' bgcolor='#AAAAAA' style='border-style: solid; border-width: 1; border-color: #555555'>\n"
		."\t\t\t\t\t\t<img src='$imagefiles/blank.gif' width='20' hspace='0' border='0' align='left' alt=''>\n"
		."\t\t\t\t\t\t<input type='image' src='$imagefiles/close.gif' name='CloseHelp' align='right' onClick=\"showhelp('hide')\">\n"
		."\t\t\t\t\t</td>\n"
		."\t\t\t\t</tr>\n"
		."\t\t\t\t<tr>\n"
		."\t\t\t\t\t<td bgcolor='silver' height='100%' style='border-style: solid; border-width: 1; border-color: #333333'>\n";
	//determine which help document to show
	if (!$surveyid && $action != "editusers")
		{
		$helpdoc = "$langdir/admin.html";
		}
	elseif (!$surveyid && $action=="editusers")
		{
		$helpdoc = "$langdir/users.html";
		}
	elseif ($surveyid && !$gid)
		{
		$helpdoc = "$langdir/survey.html";
		}
	elseif ($surveyid && $gid && !$qid)
		{
		$helpdoc = "$langdir/group.html";
		}
	//elseif ($surveyid && $gid && $qid && !$_GET['viewanswer'] && !$_POST['viewanswer'])
	elseif ($surveyid && $gid && $qid && !returnglobal('viewanswer'))
		{
		$helpdoc = "$langdir/question.html";
		}
	elseif ($surveyid && $gid && $qid && (returnglobal('viewanswer')))
		{
		$helpdoc = "$langdir/answer.html";
		}
	echo "\t\t\t\t\t\t<iframe width='150' height='400' src='$helpdoc' marginwidth='2' marginheight='2'>\n"
		."\t\t\t\t\t\t</iframe>\n"
		."\t\t\t\t\t</td>"
		."\t\t\t\t</tr>\n"
		."\t\t\t</table></td></tr></table>\n"
		."\t\t</td>\n";
	}

function multiStringSearch($needle, $haystack, $method = "full") {
	//Function returns true if any of the strings found in the needle array
	//exist in the haystack. $method determines whether the needle is merely
	//a "part" of the haystack (like a sql "%something%" search, or if it must
	//be a full match. Values: "full" or "partial"
	if ($method != "partial") {$method="full";}
	foreach ($needle as $item) {
		if ($method == "partial") {
		    if (ereg($item, $haystack)) {
		        return true;
		    }
		}
		if ($method == "full") {
		    if ($item == $haystack) {
		        return true;
		    }
		}
	}
	return false;
}

function adminmenu() {
	global $accesscontrol, $homedir, $scriptname, $surveyid, $setfont, $imagefiles, $navigation;
	echo "		<table width='100%' border='0' bgcolor='#DDDDDD'>
		  <tr>
		   <td>
		    <table style='margin:0;' width='100%' align='center' cellspacing='0' cellpadding='0' border='0'>
			 <tr>
			  <td width='250' align='center'>
			   <a href='http://www.phpsurveyor.org' target='_blank'><img src='{$imagefiles}/phpslogo.png' border='0' hspace='0' vspace='0' alt='PHPSurveyor Logo'></a>
			  </td>
			  <td valign='top'>
			   <table align='center' width='100%' cellspacing='0' cellpadding='0'>
			    <tr>
				 <td height='26' valign='bottom'>
			      <img src='{$imagefiles}/showhelp.png' align='right' alt='Show Help'>
			      <img src='$imagefiles/blank.gif' width='5' height='1' alt=''>
			      <a href='$scriptname' title='"._A_HOME_BT."'><img src='{$imagefiles}/home.png' alt='"._A_HOME_BT."' border='0'></a>
				 </td>
				</tr>
				<tr>
			     <td valign='bottom' class='headingtable' height='24' bgcolor='#999999'>
			      <img src='{$imagefiles}/admincrnr.png' border='0' align='left' hspace='0' vspace='0' alt=''>
			      <a href='#' ".$navigation['dropdownaction']."=\"return dropdownmenu(this, event, system, '165px')\"><img src='$imagefiles/down.gif' border='0' hspace='0' alt='"._SN_OPTIONS."'>"._SN_OPTIONS."</a>
			      <a href='#' ".$navigation['dropdownaction']."=\"return dropdownmenu(this, event, systemdb, '240px')\"><img src='$imagefiles/down.gif' border='0' hspace='0' alt='"._SN_ACTIONS."'>"._SN_ACTIONS."</a>
			      <a href='#' ".$navigation['dropdownaction']."=\"return dropdownmenu(this, event, systemother, '220px')\"><img src='$imagefiles/down.gif' border='0' hspace='0' alt='"._SN_OTHER."'>"._SN_OTHER."</a>
			      <img src='{$imagefiles}/blank.gif' width='20' height='1' border='0' alt=''>
			     </td>
			    </tr>
			   </table>
			  </td>
			 </tr>
			</table>";
}

function footer($url, $explanation)
	{
	global $versionnumber, $setfont, $imagefiles;
	$htmlfooter = "<table width='100%' align='center' bgcolor='#5E6F86'>\n"
				. "\t<tr>\n"
				. "\t\t<td align='center' valign='middle' height='20'>\n"
				. "\t\t\t$setfont<font color='white' size='1'>\n"
				. "\t\t\t<img align='right' alt='Help - $explanation' src='$imagefiles/help.gif' "
				. "onClick=\"window.open('$url')\" onMouseOver=\"document.body.style.cursor='pointer'\" "
				. "onMouseOut=\"document.body.style.cursor='auto'\">\n"
				. "\t\t\t<img align='left' alt='Help - $explanation' src='$imagefiles/help.gif' "
				. "onClick=\"window.open('$url')\" onMouseOver=\"document.body.style.cursor='pointer'\" "
				. "onMouseOut=\"document.body.style.cursor='auto'\">\n"
				. "<font color='white' size='1'>This is an experimental interface - Do NOT use this for production!<BR> We do NOT give you support on issues you might have after using this interface. If you experience problems please use the <a href='admin.php'>normal interface.</a></font><br> \n"
				. "Ver $versionnumber\n"
				. "\t\t</font></font></td>\n"
				. "\t</tr>\n"
				. "</table>\n"
				. "</table>\n"
				. "</body>\n</html>";
	return $htmlfooter;
	}

function is_authorised() {
	return true;
}
?>
