<?php
/*
#############################################################
# >>> PHPSurveyor  										    #
#############################################################
# > Author:  Jason Cleeland									#
# > E-mail:  jason@cleeland.org								#
# > Mail:    Box 99, Trades Hall, 54 Victoria St,			#
# >          CARLTON SOUTH 3053, AUSTRALIA					#
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
# Public License Version 2 as published by the Free         #
# Software Foundation.										#
#															#
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

if (!isset($surveyid)) {$surveyid=returnglobal('sid');}
if (!isset($action)) {$action=returnglobal('action');}

include_once("login_check.php");

$actsurquery = "SELECT edit_survey_property FROM {$dbprefix}surveys_rights WHERE sid=$surveyid AND uid = ".$_SESSION['loginID']; //Getting rights for this survey
$actsurresult = $connect->Execute($actsurquery) or die($connect->ErrorMsg());		
$actsurrows = $actsurresult->FetchRow();

if($actsurrows['edit_survey_property']){

	if ($action == "assessmentadd") {
		$inserttable=$dbprefix."assessments";
		$query = $connect->GetInsertSQL($inserttable, array(
		'sid' => $surveyid,
		'scope' => $_POST['scope'],
		'gid' => $_POST['gid'],
		'minimum' => $_POST['minimum'],
		'maximum' => $_POST['maximum'],
		'name' => $_POST['name'],
		'message' => $_POST['message'],
		'link' => $_POST['link'] ));
		$result=$connect->Execute($query) or die("Error inserting<br />$query<br />".$connect->ErrorMsg());
	} elseif ($action == "assessmentupdate") {
		$query = "UPDATE {$dbprefix}assessments
				  SET scope='".$_POST['scope']."',
				  gid=".$_POST['gid'].",
				  minimum='".$_POST['minimum']."',
				  maximum='".$_POST['maximum']."',
				  name='".db_quote($_POST['name'])."',
				  message='".db_quote($_POST['message'])."',
				  link='".db_quote($_POST['link'])."'
				  WHERE id=".$_POST['id'];
		$result = $connect->Execute($query) or die("Error updating<br />$query<br />".$connect->ErrorMsg());
	} elseif ($action == "assessmentdelete") {
		$query = "DELETE FROM {$dbprefix}assessments
				  WHERE id=".$_POST['id'];
		$result=$connect->Execute($query);
	}
	
    $assessmentsoutput=  "<table width='100%' border='0' bgcolor='#DDDDDD'>\n"
        . "\t<tr>\n"
        . "\t\t<td>\n"
        . "\t\t\t<table width='100%' style='border: 1px solid #555555' cellpadding='1' cellspacing='0'>\n"
        . "\t\t\t<tr bgcolor='#555555'>\n"
        . "\t\t\t\t<td colspan='2' height='8'>\n"
        . "\t\t\t\t\t<font size='1' color='white'><strong>".$clang->gT("Assessments")."</strong></font></td></tr>\n";
	
	$assessmentsoutput.= "\t<tr bgcolor='#999999'>\n"
	. "\t\t<td>\n"
	. "\t\t\t<a href=\"#\" onClick=\"window.open('$scriptname?sid=$surveyid', '_top')\" onmouseout=\"hideTooltip()\" onmouseover=\"showTooltip(event,'".$clang->gT("Return to Survey Administration", "js")."');return false\">" .
			"<img name='Administration' src='$imagefiles/home.png' title='' alt='' align='left'  /></a>\n"
	. "\t\t\t<img src='$imagefiles/blank.gif' alt='' width='11' border='0' hspace='0' align='left' />\n"
	. "\t\t\t<img src='$imagefiles/seperator.gif' alt='' border='0' hspace='0' align='left' />\n"
	. "\t\t</td>\n"
	. "\t</tr>\n";
	$assessmentsoutput.= "</table>";
	
	if ($surveyid == "") {
		$assessmentsoutput.= $clang->gT("No SID Provided");
		exit;
	}
	
	$assessments=getAssessments($surveyid);
	//$assessmentsoutput.= "<pre>";print_r($assessments);echo "</pre>";
	$groups=getGroups($surveyid);
	$groupselect="<select name='gid'>\n";
	foreach($groups as $group) {
		$groupselect.="<option value='".$group['gid']."'>".$group['group_name']."</option>\n";
	}
	$groupselect .="</select>\n";
	$headings=array($clang->gT("Scope"), $clang->gT("Group"), $clang->gT("Minimum"), $clang->gT("Maximum"), $clang->gT("Heading"), $clang->gT("Message"), $clang->gT("URL"));
	$inputs=array("<select name='scope'><option value='T'>".$clang->gT("Total")."</option><option value='G'>".$clang->gT("Group")."</option></select>",
	$groupselect,
	"<input type='text' name='minimum' />",
	"<input type='text' name='maximum' />",
	"<input type='text' name='name' />",
	"<textarea name='message'></textarea />",
	"<input type='text' name='link' />");
	$actiontitle=$clang->gT("Add");
	$actionvalue="assessmentadd";
	$thisid="";
	
	if ($action == "assessmentedit") {
		$query = "SELECT * FROM {$dbprefix}assessments WHERE id=".$_POST['id'];
		$results = db_execute_assoc($query);
		while($row=$results->FetchRow()) {
			$editdata=$row;
		}
		$scopeselect = "<select name='scope'><option ";
		if ($editdata['scope'] == "T") {$scopeselect .= "selected ";}
		$scopeselect .= "value='T'>".$clang->gT("Total")."</option><option value='G'";
		if ($editdata['scope'] == "G") {$scopeselect .= " selected";}
		$scopeselect .= "'>".$clang->gT("Group")."</option></select>";
		$groupselect=str_replace("'".$editdata['gid']."'", "'".$editdata['gid']."' selected", $groupselect);
		$inputs=array($scopeselect,
		$groupselect,
		"<input type='text' name='minimum' value='".$editdata['minimum']."' />",
		"<input type='text' name='maximum' value='".$editdata['maximum']."' />",
		"<input type='text' name='name' value='".htmlentities(stripslashes($editdata['name']), ENT_QUOTES)."' />",
		"<textarea name='message'>".htmlentities(stripslashes($editdata['message']), ENT_QUOTES)."</textarea>",
		"<input type='text' name='link' value='".$editdata['link']."' />");
		$actiontitle=$clang->gT("Edit");
		$actionvalue="assessmentupdate";
		$thisid=$editdata['id'];
	}
	//$assessmentsoutput.= "<pre>"; print_r($edits); $assessmentsoutput.= "</pre>";
	//PRESENT THE PAGE
	
	$assessmentsoutput.= "<br /><table align='center' class='outlinetable' cellspacing='0' width='90%'>
		<tr><th>".$clang->gT("If you create any assessments in this page, for the currently selected survey, the assessment will be performed at the end of the survey after submission")."</th></tr>
		<tr><td>";
	$assessmentsoutput.= "<table cellspacing='1' align='center' width='90%'>
		<tr><th>ID</th><th>SID</th>\n";
	foreach ($headings as $head) {
		$assessmentsoutput.= "<th>$head</th>\n";
	}
	$assessmentsoutput.= "<th>".$clang->gT("Actions")."</th>";
	$assessmentsoutput.= "</tr>\n";
	foreach($assessments as $assess) {
		$assessmentsoutput.= "<tr>\n";
		foreach($assess as $as) {
			$assessmentsoutput.= "<td>".stripslashes($as)."</td>\n";
		}
		$assessmentsoutput.= "<td>
			   <table width='100%'>
				<tr><td align='center'><form method='post' action='$scriptname?sid=$surveyid'>
				 <input type='submit' value='".$clang->gT("Edit")."' />
				 <input type='hidden' name='action' value='assessmentedit' />
				 <input type='hidden' name='id' value='".$assess['id']."' />
				 </form></td>
				 <td align='center'><form method='post' action='$scriptname?sid=$surveyid'>
				 <input type='submit' value='".$clang->gT("Delete")."' onClick='return confirm(\"".$clang->gT("Are you sure you want to delete this entry.")."\")' />
				 <input type='hidden' name='action' value='assessmentdelete' />
				 <input type='hidden' name='id' value='".$assess['id']."' />
				 </form>
				 </td>
				</tr>
			   </table>
			  </td>\n";
		$assessmentsoutput.= "</tr>\n";
	}
	$assessmentsoutput.= "</table>";
	$assessmentsoutput.= "<br /><form method='post' action='$scriptname?sid=$surveyid'><table align='center' cellspacing='1'>\n";
	$assessmentsoutput.= "<tr><th colspan='2'>$actiontitle</th></tr>\n";
	$i=0;
	
	foreach ($headings as $head) {
		$assessmentsoutput.= "<tr><th>$head</th><td>".$inputs[$i]."</td></tr>\n";
		$i++;
	}
	$assessmentsoutput.= "<tr><th colspan='2' align='center'><input type='submit' value='$actiontitle' />\n";
	$assessmentsoutput.= "<input type='hidden' name='sid' value='$surveyid' />\n"
	."<input type='hidden' name='action' value='$actionvalue' />\n"
	."<input type='hidden' name='id' value='$thisid' />\n"
	."</th></tr>\n"
	."</table></form></table><br /></table>\n";
	}
else
	{
	$action = "assessment";
	include("access_denied.php");
	include("admin.php");
	}
	
function getAssessments($surveyid) {
	global $dbprefix, $connect;
	$query = "SELECT id, sid, scope, gid, minimum, maximum, name, message, link
			  FROM {$dbprefix}assessments
			  WHERE sid=$surveyid
			  ORDER BY scope, gid";
	$result=db_execute_assoc($query) or die("Error getting assessments<br />$query<br />".$connect->ErrorMsg());
	$output=array();
	while($row=$result->FetchRow()) {
		$output[]=$row;
	}
	return $output;
}

function getGroups($surveyid) {
	global $dbprefix, $connect;
	$query = "SELECT gid, group_name
			  FROM {$dbprefix}groups
			  WHERE sid=$surveyid
			  ORDER BY group_order";
	$result = db_execute_assoc($query) or die("Error getting groups<br />$query<br />".$connect->ErrorMsg());
	$output=array();
	while($row=$result->FetchRow()) {
		$output[]=$row;
	}
	return $output;
}
?>
