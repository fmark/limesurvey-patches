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
if (!isset($dbprefix)) {die ("Cannot run this script directly");}

if ($action == "listsurveys" && isset($_SESSION['loginID']))
{
	$query = "SELECT a.* FROM ".db_table_name('surveys')." AS a INNER JOIN ".db_table_name('surveys_rights')." AS b ON a.sid = b.sid WHERE b.uid = ".$_SESSION['loginID'];
	//$query = "SELECT * FROM ".db_table_name('surveys');
	$result = db_execute_assoc($query) or die($connect->ErrorMsg());

	if($result->RecordCount() > 0) {
		$listsurveys= "<br><table  align='center' bgcolor='#DDDDDD' style='border: 1px solid #555555' "
		. "cellpadding='1' cellspacing='0' width='600'>
				  <tr bgcolor='#BBBBBB'>
				    <td height=\"22\"><strong>"._("Survey")."</strong></td>
				    <td><strong>"._("Date Created")."</strong></td>
				    <td><strong>"._("Visibility")."</strong></td>
				    <td><strong>"._("Status")."</strong></td>
				    <td colspan=\"3\"><strong>"._("Action")."</strong></td>
				  </tr>" ; 

		while($rows = $result->FetchRow())
		{
			if($rows['private']=="Y")
			{
				$visibility=_("Private") ;
			}
			else $visibility =_("Public") ;
			if($rows['active']=="Y")
			{
				$status=_("Active") ;
			}
			else $status =_("Non Active") ;

			$datecreated=$rows['datecreated'] ;

			$listsurveys.="<tr>
					    <td><a href='".$scriptname."?sid=".$rows['sid']."'>".$rows['short_title']."</a></td>".
					    "<td>".$datecreated."</td>".
					    "<td>".$visibility."</td>" .
					    "<td>".$status."</td>".
					    "<td>&nbsp;</td>
					    <td>&nbsp;</td>
					    <td>&nbsp;</td>
					  </tr>" ; 
		}
		if($_SESSION['USER_RIGHT_CREATE_SURVEY'])
			{
		$listsurveys.="<tr bgcolor='#BBBBBB'>
				    <td><a href='".$scriptname."?action=newsurvey'><img border=0 src='".$imagefiles."/add.png' onmouseout=\"hideTooltip()\" " .
				    "onmouseover=\"showTooltip(event,'"._("Create Survey")."');return false\">" .
				    "</a></td>
				    <td>&nbsp;</td>
				    <td>&nbsp;</td>
				    <td colspan=\"4\">&nbsp;</td>
				  </tr>";
			}
		$listsurveys.="</table></br>" ; 
	}
	else $listsurveys="<br /><strong> No Surveys in this Installation </strong><br /><br />" ;
}

if (($action == "checksettings" || $action == "changelang") && isset($_SESSION['loginID']))
{
	//GET NUMBER OF SURVEYS
	$query = "SELECT sid FROM ".db_table_name('surveys');
	$result = $connect->Execute($query);
	$surveycount=$result->RecordCount();
	$query = "SELECT sid FROM ".db_table_name('surveys')." WHERE active='Y'";
	$result = $connect->Execute($query);
	$activesurveycount=$result->RecordCount();
	$query = "SELECT user FROM ".db_table_name('users');
	$result = $connect->Execute($query);
	$usercount = $result->RecordCount();
	$tablelist = $connect->MetaTables();
	foreach ($tablelist as $table)
	{
		$stlength=strlen($dbprefix).strlen("old");
		if (substr($table, 0, $stlength+strlen("_tokens")) == $dbprefix."old_tokens")
		{
			$oldtokenlist[]=$table;
		}
		elseif (substr($table, 0, strlen($dbprefix) + strlen("tokens")) == $dbprefix."tokens")
		{
			$tokenlist[]=$table;
		}
		elseif (substr($table, 0, $stlength) == $dbprefix."old")
		{
			$oldresultslist[]=$table;
		}
	}
	if(isset($oldresultslist) && is_array($oldresultslist))
	{$deactivatedsurveys=count($oldresultslist);} else {$deactivatedsurveys=0;}
	if(isset($oldtokenlist) && is_array($oldtokenlist))
	{$deactivatedtokens=count($oldtokenlist);} else {$deactivatedtokens=0;}
	if(isset($tokenlist) && is_array($tokenlist))
	{$activetokens=count($tokenlist);} else {$activetokens=0;}
	$cssummary = "<table><tr><td height='1'></td></tr></table>\n"
				. "<form action='$scriptname'>"
				. "<table align='center' bgcolor='#DDDDDD' style='border: 1px solid #555555' "
				. "cellpadding='1' cellspacing='0' width='600'>\n"
				. "\t<tr>\n"
				. "\t\t<td colspan='2' align='center' bgcolor='#BBBBBB'>$setfont\n"
				. "\t\t\t<strong>"._("PHPSurveyor System Summary")."</strong>\n"
				. "\t\t</font></td>\n"
				. "\t</tr>\n";
	// Database name & default language
	$cssummary .= "\t<tr>\n"
				. "\t\t<td width='50%' align='right'>$setfont\n"
				. "\t\t\t<strong>"._("Database Name").":</strong></font>\n"
				. "\t\t</td><td>$setfont\n"
				. "\t\t\t$databasename\n"
				. "\t\t</font></td>\n"
				. "\t</tr>\n"
				. "\t<tr>\n"
				. "\t\t<td align='right'>$setfont\n"
				. "\t\t\t<strong>"._("Default Language").":</strong></font>\n"
				. "\t\t</td><td>$setfont\n"
				. "\t\t\t".getLanguageNameFromCode($defaultlang)."\n"
				. "\t\t</font></td>\n"
				. "\t</tr>\n";		
	// Current language
	$cssummary .=  "\t<tr>\n"
				. "\t\t<td align='right' >$setfont\n"
				. "\t\t\t<strong>"._("Current Language").":</strong>\n"
				. "\t\t</font></td><td>$setfont\n"
				. "\t\t\t<select name='lang' onChange='form.submit()'>\n";
  	foreach (getlanguagedata() as $langkey=>$languagekind)
		{
		$cssummary .= "\t\t\t\t<option value='$langkey'";
		if ($langkey == $_SESSION['adminlang']) {$cssummary .= " selected";}
		$cssummary .= ">".$languagekind['description']." - ".$languagekind['nativedescription']."</option>\n";
		}
	$cssummary .= "\t\t\t</select>\n"
				. "\t\t\t<input type='hidden' name='action' value='changelang'>\n"
				. "\t\t</font></td>\n"
				. "\t</tr>\n";
	// Other infos
	$cssummary .=  "\t<tr>\n"
				. "\t\t<td align='right'>$setfont\n"
				. "\t\t\t<strong>"._("Users").":</strong>\n"
				. "\t\t</font></td><td>$setfont\n"
				. "\t\t\t$usercount\n"
				. "\t\t</font></td>\n"
				. "\t</tr>\n"
				. "\t<tr>\n"
				. "\t\t<td align='right'>$setfont\n"
				. "\t\t\t<strong>"._("Surveys").":</strong>\n"
				. "\t\t</font></td><td>$setfont\n"
				. "\t\t\t$surveycount\n"
				. "\t\t</font></td>\n"
				. "\t</tr>\n"
				. "\t<tr>\n"
				. "\t\t<td align='right'>$setfont\n"
				. "\t\t\t<strong>"._("Active Surveys").":</strong>\n"
				. "\t\t</font></td><td>$setfont\n"
				. "\t\t\t$activesurveycount\n"
				. "\t\t</font></td>\n"
				. "\t</tr>\n"
				. "\t<tr>\n"
				. "\t\t<td align='right'>$setfont\n"
				. "\t\t\t<strong>"._("De-activated Surveys").":</strong>\n"
				. "\t\t</font></td><td>$setfont\n"
				. "\t\t\t$deactivatedsurveys\n"
				. "\t\t</font></td>\n"
				. "\t</tr>\n"
				. "\t<tr>\n"
				. "\t\t<td align='right'>$setfont\n"
				. "\t\t\t<strong>"._("Active Token Tables").":</strong>\n"
				. "\t\t</font></td><td>$setfont\n"
				. "\t\t\t$activetokens\n"
				. "\t\t</font></td>\n"
				. "\t</tr>\n"
				. "\t<tr>\n"
				. "\t\t<td align='right'>$setfont\n"
				. "\t\t\t<strong>"._("De-activated Token Tables").":</strong></font>\n"
				. "\t\t</td><td>$setfont\n"
				. "\t\t\t$deactivatedtokens\n"
				. "\t\t</font></td>\n"
				. "\t</tr>\n";
	
	$cssummary .=  "</table></form>\n"
				. "<table><tr><td height='1'></td></tr></table>\n";
	}

if ($surveyid)
{
	$query = "SELECT * FROM ".db_table_name('surveys_rights')." WHERE  sid = {$surveyid} AND uid = ".$_SESSION['loginID'] ." LIMIT 1";
	$result = $connect->Execute($query);
	if($result->RecordCount() > 0)
		{
		$surveysummary = "<script type='text/javascript'>\n"
		. "<!--\n"
		. "\tfunction showdetails(action)\n"
		. "\t\t{\n"
		. "\t\tif (action == \"hides\")\n"
		. "\t\t\t{\n"
		. "\t\t\tfor (i=0; i<=11; i++)\n"
		. "\t\t\t\t{\n"
		. "\t\t\t\tvar name='surveydetails'+i;\n"
		. "\t\t\t\tdocument.getElementById(name).style.display='none';\n"
		. "\t\t\t\t}\n"
		. "\t\t\t}\n"
		. "\t\telse if (action == \"shows\")\n"
		. "\t\t\t{\n"
		. "\t\t\tfor (i=0; i<=11; i++)\n"
		. "\t\t\t\t{\n"
		. "\t\t\t\tvar name='surveydetails'+i;\n"
		. "\t\t\t\tdocument.getElementById(name).style.display='';\n"
		. "\t\t\t\t}\n"
		. "\t\t\t}\n"
		. "\t\telse if (action == \"hideg\")\n"
		. "\t\t\t{\n"
		. "\t\t\tfor (i=20; i<=21; i++)\n"
		. "\t\t\t\t{\n"
		. "\t\t\t\tvar name='surveydetails'+i;\n"
		. "\t\t\t\tdocument.getElementById(name).style.display='none';\n"
		. "\t\t\t\t}\n"
		. "\t\t\t}\n"
		. "\t\telse if (action == \"showg\")\n"
		. "\t\t\t{\n"
		. "\t\t\tfor (i=20; i<=21; i++)\n"
		. "\t\t\t\t{\n"
		. "\t\t\t\tvar name='surveydetails'+i;\n"
		. "\t\t\t\tdocument.getElementById(name).style.display='';\n"
		. "\t\t\t\t}\n"
		. "\t\t\t}\n"
		. "\t\telse if (action == \"hideq\")\n"
		. "\t\t\t{\n"
		. "\t\t\tfor (i=30; i<=37; i++)\n"
		. "\t\t\t\t{\n"
		. "\t\t\t\tvar name='surveydetails'+i;\n"
		. "\t\t\t\tdocument.getElementById(name).style.display='none';\n"
		. "\t\t\t\t}\n"
		. "\t\t\t}\n"
		. "\t\telse if (action == \"showq\")\n"
		. "\t\t\t{\n"
		. "\t\t\tfor (i=30; i<=37; i++)\n"
		. "\t\t\t\t{\n"
		. "\t\t\t\tvar name='surveydetails'+i;\n"
		. "\t\t\t\tdocument.getElementById(name).style.display='';\n"
		. "\t\t\t\t}\n"
		. "\t\t\t}\n"
		. "\t\t}\n"
		. "-->\n"
		. "</script>\n";
		
		$sumquery5 = "SELECT b.* FROM {$dbprefix}surveys AS a INNER JOIN {$dbprefix}surveys_rights AS b ON a.sid = b.sid WHERE a.sid=$surveyid AND b.uid = ".$_SESSION['loginID']; //Getting rights for this survey and user
		$sumquery3 = "SELECT * FROM ".db_table_name('questions')." WHERE sid=$surveyid"; //Getting a count of questions for this survey
		//$sumresult5 = $connect->Execute($sumquery5) or die($connect->ErrorMsg());		
		$sumresult5 = db_execute_assoc($sumquery5);
		$sumrows5 = $sumresult5->FetchRow();
		
		$sumquery3 = "SELECT * FROM {$dbprefix}questions WHERE sid=$surveyid"; //Getting a count of questions for this survey
		$sumresult3 = $connect->Execute($sumquery3);
		$sumcount3 = $sumresult3->RecordCount();
		$sumquery2 = "SELECT * FROM ".db_table_name('groups')." WHERE sid=$surveyid"; //Getting a count of groups for this survey
		$sumresult2 = $connect->Execute($sumquery2);
		$sumcount2 = $sumresult2->RecordCount();
		$sumquery1 = "SELECT * FROM ".db_table_name('surveys')." WHERE sid=$surveyid LIMIT 1"; //Getting data for this survey
		$sumresult1 = db_execute_assoc($sumquery1);
		$surveysummary .= "<table width='100%' align='center' bgcolor='#DDDDDD' border='0'>\n";
					
		$s1row = $sumresult1->FetchRow();
		
		$s1row = array_map('htmlspecialchars', $s1row);
		$activated = $s1row['active'];
		//BUTTON BAR
		$surveysummary .= "\t<tr>\n"
		. "\t\t<td colspan='2'>\n"
		. "\t\t\t<table width='100%' style='border: 1px solid #555555' cellpadding='1' cellspacing='0'>\n"
		. "\t\t\t\t<tr bgcolor='#555555'><td colspan='2' height='4'>"
		. "$setfont<font size='1' face='verdana' color='white'><strong>"._("Survey")."</strong> "
		. "<font color='silver'>{$s1row['short_title']}</font></font></font></td></tr>\n"
		. "\t\t\t\t<tr bgcolor='#999999'><td align='right' height='22'>\n";
		if ($activated == "N" && $sumcount3>0)
		{
			$surveysummary .= "\t\t\t\t\t<img src='$imagefiles/inactive.png' "
			. "title='' alt='"._("This survey is not currently active")."' border='0' hspace='0' align='left'"
			. "onmouseout=\"hideTooltip()\""
			. "onmouseover=\"showTooltip(event,'"._("This survey is not currently active")."');return false\">\n";
			if($sumrows5['activate_survey'])
				{			
				$surveysummary .= "<a href=\"#\" onClick=\"window.open('$scriptname?action=activate&amp;sid=$surveyid', '_top')\""
				. "onmouseout=\"hideTooltip()\""
				. "onmouseover=\"showTooltip(event,'"._("Activate this Survey")."');return false\">" .
				"<img src='$imagefiles/activate.png' name='ActivateSurvey' title='' alt='"._("Activate this Survey")."' align='left'></a>\n" ;
				}
			else
				{
				$surveysummary .= "\t\t\t\t\t<img src='$imagefiles/blank.gif' alt='' width='14' align='left' border='0' hspace='0'>\n";
				}
		}
		elseif ($activated == "Y")
		{
			if (($s1row['useexpiry']=='Y') && ($s1row['expires'] < date("Y-m-d")))
			{
				$surveysummary .= "\t\t\t\t\t<img src='$imagefiles/expired.png' title='' "
				. "alt='"._("This survey is active but expired.")."' align='left'"
				. "onmouseout=\"hideTooltip()\""
				. "onmouseover=\"showTooltip(event,'"._("This survey is active but expired")."');return false\">\n";
			}
			else
			{
				$surveysummary .= "\t\t\t\t\t<img src='$imagefiles/active.png' title='' "
				. "alt='"._("This survey is currently active")."' align='left'"
				. "onmouseout=\"hideTooltip()\""
				. "onmouseover=\"showTooltip(event,'"._("This survey is currently active")."');return false\">\n";
			}
			if($sumrows5['activate_survey'])
				{	
				$surveysummary .= "<a href=\"#\" onClick=\"window.open('$scriptname?action=deactivate&amp;sid=$surveyid', '_top')\""
				. "onmouseout=\"hideTooltip()\""
				. "onmouseover=\"showTooltip(event,'"._("De-activate this Survey")."');return false\">" .
				"<img src='$imagefiles/deactivate.png' name='DeactivateSurvey' "
				. "alt='"._("De-activate this Survey")."' title='' align='left'></a>\n" ;
				}
			else
				{
				$surveysummary .= "\t\t\t\t\t<img src='$imagefiles/blank.gif' alt='' width='14' align='left' border='0' hspace='0'>\n";
				}
		}
		elseif ($activated == "N")
		{
			$surveysummary .= "\t\t\t\t\t<img src='$imagefiles/inactive.png' title='"._("This survey is not currently active")."' "
			. "alt='"._("This survey is not currently active")."' border='0' hspace='0' align='left'>\n"
			. "\t\t\t\t\t<img src='$imagefiles/blank.gif' width='14' title='"._("Cannot Activate this Survey")."' "
			. "alt='"._("Cannot Activate this Survey")."' border='0' align='left' hspace='0'>\n";
		}

        $surveysummary .= "\t\t\t\t\t<img src='$imagefiles/seperator.gif' alt='' align='left' border='0' hspace='0'>\n";		
		// survey rights
		
		if($s1row['creator_id'] == $_SESSION['loginID'])
			{	
			$surveysummary .= "\t\t\t\t\t<a href=\"#\" onClick=\"window.open('$scriptname?action=surveysecurity&sid=$surveyid', '_top')\"" .
							"onmouseout=\"hideTooltip()\"" 
							. "onmouseover=\"showTooltip(event,'"._("Survey Security Settings")."');return false\">" .
							 "<img src='$imagefiles/survey_security.png' name='SurveySecurity'"
							." title='' alt='"._("Survey Security Settings")."'  align='left'></a>";
			}
		else
			{
			$surveysummary .= "\t\t\t\t\t<img src='$imagefiles/blank.gif' alt='' width='40' align='left' border='0' hspace='0'>\n";
			}
		$surveysummary .= "<a href=\"#\" onclick=\"window.open('".$publicurl."/index.php?sid=$surveyid&amp;newtest=Y', '_blank')\""
						. "onmouseout=\"hideTooltip()\"" 
						. "onmouseover=\"showTooltip(event,'"._("Do Survey")."');return false\">" 
						."<img accesskey='d' src='$imagefiles/do.png' title='' "
						. "name='DoSurvey' align='left' alt='"._("Do Survey")."'></a>";
			
		if($sumrows5['browse_response'])
			{		 
			$surveysummary .= "<a href=\"#\" onclick=\"window.open('".$homeurl."/dataentry.php?sid=$surveyid', '_blank')\"" 
							. "onmouseout=\"hideTooltip()\"" 
							. "onmouseover=\"showTooltip(event,'"._("Dataentry Screen for Survey")."');return false\">" 
							. "<img src='$imagefiles/dataentry.png' title='' align='left' alt='"._("Dataentry Screen for Survey")."'"
							. "name='DoDataentry'></a>\n";
			}
		else
			{
			$surveysummary .= "\t\t\t\t\t<img src='$imagefiles/blank.gif' alt='' width='40' align='left' border='0' hspace='0'>\n";
			}
		$surveysummary .= "<a href=\"#\" onclick=\"window.open('".$homeurl."/printablesurvey.php?sid=$surveyid', '_blank')\""
						. "onmouseout=\"hideTooltip()\"" 
						. "onmouseover=\"showTooltip(event,'"._("Printable Version of Survey")."');return false\">\n"
						. "<img src='$imagefiles/print.png' title='' name='ShowPrintableSurvey' align='left' alt='"._("Printable Version of Survey")."'>"
						."</a>"
						. "\t\t\t\t\t<img src='$imagefiles/seperator.gif' alt='' align='left' border='0' hspace='0'>\n";
		if($sumrows5['edit_survey_property'])
			{
			$surveysummary .= "<a href=\"#\" onclick=\"window.open('$scriptname?action=editsurvey&amp;sid=$surveyid', '_top')\"" 
							. "onmouseout=\"hideTooltip()\"" 
							. "onmouseover=\"showTooltip(event,'"._("Edit Current Survey")."');return false\">" .
							"<img src='$imagefiles/edit.png' title=''name='EditSurvey' align='left' alt='"._("Edit Current Survey")."'></a>" ;
			}
		else
			{
			$surveysummary .= "\t\t\t\t\t<img src='$imagefiles/blank.gif' alt='' width='40' align='left' border='0' hspace='0'>\n";
			}
		if($activated!="Y" && getGroupSum($surveyid)>1 && $sumrows5['define_questions'])
			{
			$surveysummary .= "<a href=\"#\" onclick=\"window.open('$scriptname?action=ordergroups&amp;sid=$surveyid', '_top')\""
						. "onmouseout=\"hideTooltip()\"" 
						. "onmouseover=\"showTooltip(event,'"._("Order the groups in that Survey")."');return false\">" .
						"<img src='$imagefiles/reorder.png' title='' alt='"._("Order the groups in that Survey")."' align='left' name='ordergroups'></a>" ; 
			}
		else
			{
			$surveysummary .= "\t\t\t\t\t<img src='$imagefiles/blank.gif' alt='' width='40' align='left' border='0' hspace='0'>\n";
			}

		if ($sumcount3 == 0 && $sumcount2 == 0 && $sumrows5['delete_survey'])
			{			
			$surveysummary .= "<a href=\"#\" onclick=\"window.open('$scriptname?action=delsurvey&amp;sid=$surveyid', '_top')\""
			. "onmouseout=\"hideTooltip()\""
			. "onmouseover=\"showTooltip(event,'". _("Delete Current Survey")."');return false\">\n" .
			"<img src='$imagefiles/delete.png' title='' align='left' name='DeleteWholeSurvey'></a>" ;
			}
		else
			{
			$surveysummary .= "\t\t\t\t\t<img src='$imagefiles/blank.gif' alt='' width='40' align='left' border='0' hspace='0'>\n";
			}
			
		if ($sumrows5['export'])
			{
			$surveysummary .= "<a href=\"#\" onclick=\"window.open('".$homeurl."/dumpsurvey.php?sid=$surveyid', '_top')\""
			. "onmouseout=\"hideTooltip()\""
			. "onmouseover=\"showTooltip(event,'". _("Export this Survey")."');return false\">" .
			"<img src='$imagefiles/exportsql.png' title='' alt='". _("Export this Survey")."' align='left' name='ExportSurvey'></a>" ;
			}
		else
			{
			$surveysummary .= "\t\t\t\t\t<img src='$imagefiles/blank.gif' alt='' width='40' align='left' border='0' hspace='0'>\n";
			}
			
		// ***********************
		//$actsurquery = "SELECT edit_survey_property FROM {$dbprefix}surveys_rights WHERE sid=$surveyid AND uid = ".$_SESSION['loginID']; //Getting rights for this survey
		////$actsurresult = $connect->Execute($actsurquery) or die($connect->ErrorMsg());		
		//$actsurresult = &db_execute_assoc($actsurquery);
		//$actsurrows = $actsurresult->FetchRow();
		
		//if($actsurrows['edit_survey_property'])
		if ($sumrows5['edit_survey_property'])
			{
			$surveysummary .= "\t\t\t\t\t<img src='$imagefiles/seperator.gif' alt='' align='left' border='0' hspace='0'>\n"
			. "<a href=\"#\" onclick=\"window.open('".$homeurl."/assessments.php?sid=$surveyid', '_top')\""
			. "onmouseout=\"hideTooltip()\""
			. "onmouseover=\"showTooltip(event,'". _("Set Assessment Rules")."');return false\">" .
			"<img src='$imagefiles/assessments.png' title='' alt='". _("Set Assessment Rules")."' align='left' name='SurveyAssessment'></a>\n" ;
			}
		else
			{
			$surveysummary .= "\t\t\t\t\t<img src='$imagefiles/blank.gif' alt='' width='40' align='left' border='0' hspace='0'>\n";
			}
				
		if ($activated == "Y" && $sumrows5['browse_response'])
		{
			$surveysummary .= "\t\t\t\t\t<img src='$imagefiles/seperator.gif' alt='' align='left' border='0' hspace='0'>\n"
			. "<a href=\"#\" onclick=\"window.open('".$homeurl."/browse.php?sid=$surveyid', '_top')\""
			. "onmouseout=\"hideTooltip()\""
			. "onmouseover=\"showTooltip(event,'"._("Browse Responses for this Survey")."');return false\">" .
			"<img src='$imagefiles/browse.png' title=''align='left' name='BrowseSurveyResults' alt='"._("Browse Responses for this Survey")."'></a>\n"
			. "\t\t\t\t\t<img src='$imagefiles/seperator.gif' alt='' align='left' border='0' hspace='0'>\n";
			if ($s1row['allowsave'] == "Y")
			{
				$surveysummary .= "<a href=\"#\" onclick=\"window.open('".$homeurl."/saved.php?sid=$surveyid', '_top')\""
				. "onmouseout=\"hideTooltip()\""
				. "onmouseover=\"showTooltip(event,'"._("View Saved but not submitted Responses")."');return false\">"
				. "<img src='$imagefiles/saved.png' title='' align='left'  name='BrowseSaved' alt='"._("View Saved but not submitted Responses")."'></a>"
				. "\t\t\t\t\t<img src='$imagefiles/seperator.gif' alt='' align='left' border='0' hspace='0'>\n";
			}
			$surveysummary .="<a href=\"#\" onclick=\"window.open('$homeurl/tokens.php?sid=$surveyid', '_top')\""
			. "onmouseout=\"hideTooltip()\""
			. "onmouseover=\"showTooltip(event,'"._("Activate/Edit Tokens for this Survey")."');return false\">" .
			"<img src='$imagefiles/tokens.png' title='' align='left'  name='TokensControl' alt='"._("Activate/Edit Tokens for this Survey")."'></a>\n" ;
		}
		$surveysummary .= "\t\t\t\t\t<img src='$imagefiles/seperator.gif' alt='' align='left' border='0' hspace='0'>\n"
		. "\t\t\t\t</td>\n"
		. "\t\t\t\t<td align='right' valign='middle' width='400'>\n";
		if (!$gid)
		{
			$surveysummary .= "\t\t\t\t\t<input type='image' src='$imagefiles/close.gif' title='". _("Close this Survey")."' alt='". _("Close this Survey")."' align='right'  name='CloseSurveyWindow' "
			. "onclick=\"window.open('$scriptname', '_top')\">\n";
		}
		else
		{
			$surveysummary .= "\t\t\t\t\t<img src='$imagefiles/blank.gif' width='21' align='right' "
			. "border='0' hspace='0' alt=''>\n";
		}
		$surveysummary .= "\t\t\t\t\t<input type='image' src='$imagefiles/plus.gif' title='". _("Show Details of this Survey")."' alt='". _("Show Details of this Survey")."' name='MaximiseSurveyWindow' "
		. "align='right' onclick='showdetails(\"shows\")'>\n"
		. "\t\t\t\t\t<input type='image' src='$imagefiles/minus.gif' title='". _("Hide Details of this Survey")."' alt='". _("Hide Details of this Survey")."' name='MinimiseSurveyWindow' "
		. "align='right' onclick='showdetails(\"hides\")'>\n"
		. "\t\t\t\t\t<img src='$imagefiles/blank.gif' align='right' border='0' width='18'>\n"
		. "\t\t\t\t\t<img src='$imagefiles/seperator.gif' align='right' border='0' "
		. "alt='' hspace='0'>\n";
		if ($activated == "Y")
		{
			$surveysummary .= "<img src='$imagefiles/blank.gif' alt='' width='40' align='right' border='0' hspace='0'>\n";
		}
		elseif($sumrows5['define_questions'])
		{
			$surveysummary .= "<a href=\"#\" onClick=\"window.open('$scriptname?action=addgroup&amp;sid=$surveyid', '_top')\""
			. "onmouseout=\"hideTooltip()\""
			. "onmouseover=\"showTooltip(event,'"._("Add New Group to Survey")."');return false\"> " .
			"<img src='$imagefiles/add.png' title='' alt=''align='right'  name='AddNewGroup'></a>\n" ;
		}
		$surveysummary .= "<font class=\"boxcaption\">"._("Groups").":</font>"
		. "\t\t<select class=\"listboxgroups\" name='groupselect' "
		. "onChange=\"window.open(this.options[this.selectedIndex].value,'_top')\">\n";
		if (getgrouplist($gid))
		{
			$surveysummary .= getgrouplist($gid);
		}
		else
		{
			$surveysummary .= "<option>"._("None")."</option>\n";
		}
		$surveysummary .= "</select>\n"
		. "\t\t\t\t</td>"
		. "</tr>\n"
		. "\t\t\t</table>\n"
		. "\t\t</td>\n"
		. "\t</tr>\n";
		
		//SURVEY SUMMARY
		if ($gid || $qid || $action=="surveysecurity" || $action=="surveyrights" || $action=="addsurveysecurity" || $action=="setsurveysecurity" || $action=="delsurveysecurity" || $action=="editsurvey" || $action=="addgroup" || $action=="ordergroups") {$showstyle="style='display: none'";}
		if (!isset($showstyle)) {$showstyle="";}
		$surveysummary .= "\t<tr $showstyle id='surveydetails0'><td align='right' valign='top' width='15%'>"
		. "$setfont<strong>"._("Title:")."</strong></font></td>\n"
		. "\t<td>$setfont<font color='#000080'><strong>{$s1row['short_title']} "
		. "(ID {$s1row['sid']})</strong></font></font></td></tr>\n";
		$surveysummary2 = "\t<tr $showstyle id='surveydetails1'><td width='80'></td>"
		. "<td>$setfont<font size='1' color='#000080'>\n";
		if ($s1row['private'] != "N") {$surveysummary2 .= _("This survey is anonymous.")."<br />\n";}
		else {$surveysummary2 .= _("This survey is NOT anonymous.")."<br />\n";}
		if ($s1row['format'] == "S") {$surveysummary2 .= _("It is presented question by question.")."<br />\n";}
		elseif ($s1row['format'] == "G") {$surveysummary2 .= _("It is presented group by group.")."<br />\n";}
		else {$surveysummary2 .= _("It is presented on one single page.")."<br />\n";}
		if ($s1row['datestamp'] == "Y") {$surveysummary2 .= _("Responses will be date stamped")."<br />\n";}
		if ($s1row['ipaddr'] == "Y") {$surveysummary2 .= _("IP Addresses will be logged")."<br />\n";}
		if ($s1row['refurl'] == "Y") {$surveysummary2 .= _("Referer-URL")."<br />\n";}
		if ($s1row['usecookie'] == "Y") {$surveysummary2 .= _("It uses cookies for access control.")."<br />\n";}
		if ($s1row['allowregister'] == "Y") {$surveysummary2 .= _("If tokens are used, the public may register for this survey")."<br />\n";}
		if ($s1row['allowsave'] == "Y") {$surveysummary2 .= _("Participants can save partially finished surveys")."<br />\n";}
		switch ($s1row['notification'])
		{
			case 0:
			$surveysummary2 .= _("No email notification")."<br />\n";
			break;
			case 1:
			$surveysummary2 .= _("Basic email notification")."<br />\n";
			break;
			case 2:
			$surveysummary2 .= _("Detailed email notification with result codes")."<br />\n";
			break;
		}
		
		if($sumrows5['edit_survey_property'])
			{		
			$surveysummary2 .= _("Regenerate Question Numbers:")
			. " [<a href='$scriptname?action=renumberquestions&amp;sid=$surveyid&amp;style=straight' "
			. "onClick='return confirm(\"Are you sure?\")' "
			. ">"._("Straight")."</a>] "
			. "[<a href='$scriptname?action=renumberquestions&amp;sid=$surveyid&amp;style=bygroup' "
			. "onClick='return confirm(\"Are you sure?\")' "
			. ">"._("By Group")."</a>]";
			$surveysummary2 .= "</font></font></td></tr>\n";
			}
		$surveysummary .= "\t<tr $showstyle id='surveydetails11'>"
		. "<td align='right' valign='top'>$setfont<strong>"
		. _("Survey URL:") . "</strong></font></td>\n";
		$tmp_url = $GLOBALS['publicurl'] . '/index.php?sid=' . $s1row['sid'];
		$surveysummary .= "\t\t<td>$setfont <a href='$tmp_url' target='_blank'>$tmp_url</a>"
		. "</font></td></tr>\n"
		. "\t<tr $showstyle id='surveydetails2'><td align='right' valign='top'>$setfont<strong>"
		. _("Description:")."</strong></font></td>\n\t\t<td>";
		if (trim($s1row['description'])!='') {$surveysummary .= "$setfont {$s1row['description']}</font>";}
		$surveysummary .= "</td></tr>\n"
		. "\t<tr $showstyle id='surveydetails3'>\n"
		. "\t\t<td align='right' valign='top'>$setfont<strong>"
		. _("Welcome:")."</strong></font></td>\n"
		. "\t\t<td>$setfont {$s1row['welcome']}</font></td></tr>\n"
		. "\t<tr $showstyle id='surveydetails4'><td align='right' valign='top'>$setfont<strong>"
		. _("Administrator:")."</strong></font></td>\n"
		. "\t\t<td>$setfont {$s1row['admin']} ({$s1row['adminemail']})</font></td></tr>\n"
		. "\t<tr $showstyle id='surveydetails5'><td align='right' valign='top'>$setfont<strong>"
		. _("Fax To:")."</strong></font></td>\n\t\t<td>";
		if (trim($s1row['faxto'])!='') {$surveysummary .= "$setfont {$s1row['faxto']}</font>";}
		$surveysummary .= "</td></tr>\n"
		. "\t<tr $showstyle id='surveydetails6'><td align='right' valign='top'>$setfont<strong>"
		. _("Expiry Date:")."</strong></font></td>\n";
		if ($s1row['useexpiry']== "Y")
		{
			$expdate=$s1row['expires'];
		}
		else
		{
			$expdate="-";
		}
		$surveysummary .= "\t<td>$setfont$expdate</font></td></tr>\n"
		. "\t<tr $showstyle id='surveydetails7'><td align='right' valign='top'>$setfont<strong>"
		. _("Template:")."</strong></font></td>\n"
		. "\t\t<td>$setfont {$s1row['template']}</font></td></tr>\n"
		. "\t<tr $showstyle id='surveydetails8'><td align='right' valign='top'>$setfont<strong>"
		. _("Language:")."</strong></font></td>\n";
		if (!$s1row['language']) {$language=getLanguageNameFromCode($currentadminlang);} else {$language=getLanguageNameFromCode($s1row['language']);}
		if ($s1row['urldescrip']==""){$s1row['urldescrip']=$s1row['url'];}
		$surveysummary .= "\t\t<td>$setfont$language</font></td></tr>\n"
		. "\t<tr $showstyle id='surveydetails9'><td align='right' valign='top'>$setfont<strong>"
		. _("Exit Link:")."</strong></font></td>\n"
		. "\t\t<td>";
		if ($s1row['url']!="") {$surveysummary .="$setfont <a href=\"{$s1row['url']}\" title=\"{$s1row['url']}\">{$s1row['urldescrip']}</a></font>";}
		$surveysummary .="</td></tr>\n";								
		$surveysummary .= "\t<tr $showstyle id='surveydetails10'><td align='right' valign='top'>$setfont<strong>"
		. _("Status:")."</strong></font></td>\n"
		. "\t<td valign='top'>$setfont"
		. "<font size='1'>"._("Number of groups in survey:")." $sumcount2<br />\n"
		. _("Number of questions in survey:")." $sumcount3<br />\n";
		if ($activated == "N" && $sumcount3 > 0)
		{
			$surveysummary .= _("Survey is not currently active.")."<br />\n";
		}
		elseif ($activated == "Y")
		{
			$surveysummary .= _("Survey is currently active.")."<br />\n"
			. _("Survey table name is:")." 'survey_$surveyid'<br />";
		}
		else
		{
			$surveysummary .= _("Survey cannot be activated yet.")."<br />\n";
			if ($sumcount2 == 0 && $sumrows5['define_questions'])
			{
				$surveysummary .= "\t<font color='green'>["._("You need to add groups")."]</font><br />";
			}
			if ($sumcount3 == 0 && $sumrows5['define_questions'])
			{
				$surveysummary .= "\t<font color='green'>["._("You need to add questions")."]</font>";
			}
		}
		$surveysummary .= "</font></font></td></tr>\n"
		. $surveysummary2
		. "</table>\n";
		
		//*******************************
		
		}
	else
		{
		include("access_denied.php");
		}
}

if ($gid)
{
	$sumquery4 = "SELECT * FROM ".db_table_name('questions')." WHERE sid=$surveyid AND gid=$gid"; //Getting a count of questions for this survey
	$sumresult4 = $connect->Execute($sumquery4);
	$sumcount4 = $sumresult4->RecordCount();
	$grpquery ="SELECT * FROM ".db_table_name('groups')." WHERE gid=$gid ORDER BY {$dbprefix}groups.group_order";
	$grpresult = db_execute_assoc($grpquery);
	$groupsummary = "<table width='100%' align='center' bgcolor='#DDDDDD' border='0'>\n";
	while ($grow = $grpresult->FetchRow())
	{
		$grow = array_map('htmlspecialchars', $grow);
		$groupsummary .= "\t<tr>\n"
		. "\t\t<td colspan='2'>\n"
		. "\t\t\t<table width='100%' style='border: 1px solid #555555' cellpadding='1' cellspacing='0'>\n"
		. "\t\t\t\t<tr bgcolor='#555555'><td colspan='2' height='4'>"
		. "<font size='1' face='verdana' color='white'><strong>"._("Group")."</strong> "
		. "<font color='silver'>{$grow['group_name']}</font></font></td></tr>\n"
		. "\t\t\t\t<tr bgcolor='#AAAAAA'>\n"
		. "\t\t\t\t\t<td>\n"
		. "\t\t\t\t\t<img src='$imagefiles/blank.gif' alt='' width='55' height='20' border='0' hspace='0' align='left'>\n"
		. "\t\t\t\t\t<img src='$imagefiles/seperator.gif' alt='' border='0' hspace='0' align='left'>\n"
		. "\t\t\t\t\t<img src='$imagefiles/blank.gif' alt='' width='175' height='20' border='0' hspace='0' align='left'>\n"
		. "\t\t\t\t\t<img src='$imagefiles/seperator.gif' alt='' border='0' hspace='0' align='left'>\n";
		
		if($sumrows5['define_questions'])
			{		
			$groupsummary .=  "<a href=\"#\" onclick=\"window.open('$scriptname?action=editgroup&amp;sid=$surveyid&amp;gid=$gid','_top')\""
							. "onmouseout=\"hideTooltip()\""
							. "onmouseover=\"showTooltip(event,'". _("Edit Current Group")."');return false\">" .
							"<img src='$imagefiles/edit.png' title='' alt='' name='EditGroup' align='left'></a>\n" ;
			}
		else
			{
			$groupsummary .= "\t\t\t\t\t<img src='$imagefiles/blank.gif' alt='' width='40' align='left' border='0' hspace='0'>\n";
			}
			
		if ((($sumcount4 == 0 && $activated != "Y") || $activated != "Y") && $sumrows5['define_questions'])
		{
			$groupsummary .= "\t\t\t\t\t<a href='$scriptname?action=delgroup&amp;sid=$surveyid&amp;gid=$gid' onclick=\"return confirm('"._("Deleting this group will also delete any questions and answers it contains. Are you sure you want to continue?")."')\""
			. "onmouseout=\"hideTooltip()\""
			. "onmouseover=\"showTooltip(event,'". _("Delete Current Group")."');return false\">"
			. "<img src='$imagefiles/delete.png' alt='' name='DeleteWholeGroup' title='' align='left' border='0' hspace='0'></a>";
		}
		else
		{
			$groupsummary .= "\t\t\t\t\t<img src='$imagefiles/blank.gif' alt='' width='40' align='left' border='0' hspace='0'>\n";
		}
		if(($activated!="Y" && getQuestionSum($surveyid)>1) && $sumrows5['define_questions'])
		{
			$groupsummary .= "<a href='$scriptname?action=orderquestions&amp;sid=$surveyid&amp;gid=$gid' onmouseout=\"hideTooltip()\""
			. "onmouseover=\"showTooltip(event,'"._("Reorder the questions of this group")."');return false\">"
			. "<img src='$imagefiles/reorder.png' title='' alt=''name='ReorderQuestions' align='left'></a>" ;
		}
		else
		{
			$groupsummary .= "\t\t\t\t\t<img src='$imagefiles/blank.gif' alt='' width='40' align='left' border='0' hspace='0'>\n";
		}
		if($sumrows5['export'])
			{
		
			$groupsummary .="<a href='dumpgroup.php?sid=$surveyid&amp;gid=$gid' onmouseout=\"hideTooltip()\""
							. "onmouseover=\"showTooltip(event,'"._("Export Current Group")."');return false\">" .
							"<img src='$imagefiles/exportsql.png' title='' alt=''name='ExportGroup' align='left'></a>";
			}
		else
			{
			$groupsummary .= "\t\t\t\t\t<img src='$imagefiles/blank.gif' alt='' width='40' align='left' border='0' hspace='0'>\n";
			}	
			
		$groupsummary .= "\t\t\t\t\t<img src='$imagefiles/seperator.gif' alt='' border='0' hspace='0' align='left'>\n"
						. "\t\t\t\t\t</td>\n"
						. "\t\t\t\t\t<td align='right' width='400'>\n";
		
		if (!$qid)
		{
			$groupsummary .= "\t\t\t\t\t<input type='image' src='$imagefiles/close.gif' title='"
			. _("Close this Group")."' alt='". _("Close this Group")."' align='right'  name='CloseSurveyWindow' "
			. "onclick=\"window.open('$scriptname?sid=$surveyid', '_top')\">\n";
		}
		else
		{
			$groupsummary .= "\t\t\t\t\t<img src='$imagefiles/blank.gif' alt='' width='40' align='right' border='0' hspace='0'>\n";
		}
		$groupsummary .= "\t\t\t\t\t<input type='image' src='$imagefiles/plus.gif' title='"
		. _("Show Details of this Group")."' alt='". _("Show Details of this Group")."' name='MaximiseGroupWindow' "
		. "align='right'  onclick='showdetails(\"showg\")'>"
		. "\t\t\t\t\t<input type='image' src='$imagefiles/minus.gif' title='"
		. _("Hide Details of this Group")."' alt='". _("Hide Details of this Group")."' name='MinimiseGroupWindow' "
		. "align='right'  onclick='showdetails(\"hideg\")'>\n"
		. "\t\t\t\t\t<img src='$imagefiles/blank.gif' alt='' align='right' border='0' width='20' height='20'>\n"
		. "\t\t\t\t\t<img src='$imagefiles/seperator.gif' alt='' align='right' border='0' hspace='0'>\n";
		if ($activated == "Y")
		{
			$groupsummary .= "\t\t\t\t\t<img src='$imagefiles/blank.gif' alt='' width='40' border='0' hspace='0' align='right'>\n";
		}
		elseif($sumrows5['define_questions'])
		{
			$groupsummary .= "<a href='$scriptname?action=addquestion&amp;sid=$surveyid&amp;gid=$gid'"
			."onmouseout=\"hideTooltip()\""
			."onmouseover=\"showTooltip(event,'"._("Add New Question to Group")."');return false\">" .
			"<img src='$imagefiles/add.png' title='' alt='' " .
			"align='right' name='AddNewQuestion' onClick=\"window.open('', '_top')\"></a>\n";
		}
		$groupsummary .= "\t\t\t\t\t<font class=\"boxcaption\">"._("Questions").":</font>&nbsp;<select class=\"listboxquestions\" name='qid' "
		. "onChange=\"window.open(this.options[this.selectedIndex].value, '_top')\">\n"
		. getquestions()
		. "\t\t\t\t\t</select>\n"
		. "\t\t\t\t</td></tr>\n"
		. "\t\t\t</table>\n"
		. "\t\t</td>\n"
		. "\t</tr>\n";
		if ($qid) {$gshowstyle="style='display: none'";}
		else	  {$gshowstyle="";}

		$groupsummary .= "\t<tr $gshowstyle id='surveydetails20'><td width='20%' align='right'>$setfont<strong>"
		. _("Title:")."</strong></font></td>\n"
		. "\t<td>"
		. "$setfont{$grow['group_name']} ({$grow['gid']})</font></td></tr>\n"
		. "\t<tr $gshowstyle id='surveydetails21'><td valign='top' align='right'>$setfont<strong>"
		. _("Description:")."</strong></font></td>\n\t<td>";
		if (trim($grow['description'])!='') {$groupsummary .="$setfont{$grow['description']}</font>";}
		$groupsummary .= "</td></tr>\n";
	}
	$groupsummary .= "\n</table>\n";
}

if ($qid)
{
	//Show Question Details
	$qrq = "SELECT * FROM ".db_table_name('answers')." WHERE qid=$qid ORDER BY sortorder, answer";
	$qrr = $connect->Execute($qrq);
	$qct = $qrr->RecordCount();
	$qrquery = "SELECT * FROM ".db_table_name('questions')." WHERE gid=$gid AND sid=$surveyid AND qid=$qid";
	$qrresult = db_execute_assoc($qrquery) or die($qrquery."<br />".$connect->ErrorMsg());
	$questionsummary = "<table width='100%' align='center' bgcolor='#EEEEEE' border='0'>\n";
	while ($qrrow = $qrresult->FetchRow())
	{
		$qrrow = array_map('htmlspecialchars', $qrrow);
		$questionsummary .= "\t<tr>\n"
		. "\t\t<td colspan='2'>\n"
		. "\t\t\t<table width='100%' style='border: 1px solid #555555' cellpadding='1' cellspacing='0'>\n"
		. "\t\t\t\t<tr bgcolor='#555555'><td colspan='2' height='4'><font size='1' face='verdana' color='white'><strong>"
		. _("Question")."</strong> <font color='silver'>{$qrrow['question']}</font></font></td></tr>\n"
		. "\t\t\t\t<tr bgcolor='#AAAAAA'>\n"
		. "\t\t\t\t\t<td>\n"
		. "\t\t\t\t\t<img src='$imagefiles/blank.gif' alt='' width='55' height='20' border='0' hspace='0' align='left'>\n"
		. "\t\t\t\t\t<img src='$imagefiles/seperator.gif' alt='' border='0' hspace='0' align='left'>\n"
		. "\t\t\t\t\t<img src='$imagefiles/blank.gif' alt='' width='175' height='20' border='0' hspace='0' align='left'>\n"
		. "\t\t\t\t\t<img src='$imagefiles/seperator.gif' alt='' border='0' hspace='0' align='left'>\n";
		
		if($sumrows5['define_questions'])
			{
			$questionsummary .= "<a href='$scriptname?action=editquestion&amp;sid=$surveyid&amp;gid=$gid&amp;qid=$qid'" .
			"onmouseout=\"hideTooltip()\""
			."onmouseover=\"showTooltip(event,'". _("Edit Current Question")."');return false\">" .
			"<img src='$imagefiles/edit.png' title='' alt='' align='left' name='EditQuestion'></a>\n" ;
			}
		else
			{
			$questionsummary .= "\t\t\t\t\t<img src='$imagefiles/blank.gif' alt='' width='40' align='left' border='0' hspace='0'>\n";
			}

		if ((($qct == 0 && $activated != "Y") || $activated != "Y") && $sumrows5['define_questions'])
		{
			$questionsummary .= "\t\t\t\t\t<a href='$scriptname?action=delquestion&amp;sid=$surveyid&amp;gid=$gid&amp;qid=$qid'" .
			"onclick=\"return confirm('"._("Deleting this question will also delete any answers it includes. Are you sure you want to continue?")."')\""
			. "onmouseout=\"hideTooltip()\""
			. "onmouseover=\"showTooltip(event,'"._("Delete Current Question")."');return false\">"
			. "<img src='$imagefiles/delete.png' name='DeleteWholeQuestion' alt= '' title='' "
			."align='left' border='0' hspace='0'></a>\n";
		}
		else {$questionsummary .= "\t\t\t\t\t<img src='$imagefiles/blank.gif' alt='' width='40' align='left' border='0' hspace='0'>\n";}
		$questionsummary .= "\t\t\t\t\t<img src='$imagefiles/blank.gif' alt='' width='40' align='left' border='0' hspace='0'>\n";
		
		if($sumrows5['export'])
			{
			$questionsummary .= "<a href='dumpquestion.php?qid=$qid' onmouseout=\"hideTooltip()\""
			. "onmouseover=\"showTooltip(event,'"._("Export this Question")."');return false\">" .
			"<img src='$imagefiles/exportsql.png' title=''"
			. "alt=''align='left' name='ExportQuestion'></a>\n";
			}
		else
			{
			$questionsummary .= "\t\t\t\t\t<img src='$imagefiles/blank.gif' alt='' width='40' align='left' border='0' hspace='0'>\n";
			}
		$questionsummary .= "\t\t\t\t\t<img src='$imagefiles/seperator.gif' alt='' border='0' hspace='0' align='left'>\n";
		
		if($sumrows5['define_questions'])
			{
			$questionsummary .= "<a href='$scriptname?action=copyquestion&amp;sid=$surveyid&amp;gid=$gid&amp;qid=$qid'" .
			"onmouseout=\"hideTooltip()\""
			. "onmouseover=\"showTooltip(event,'". _("Copy Current Question")."');return false\">" .
			"<img src='$imagefiles/copy.png' title=''alt='' align='left' name='CopyQuestion'></a>\n"
			. "\t\t\t\t\t<img src='$imagefiles/seperator.gif' alt='' border='0' hspace='0' align='left'>\n";
			}
		else
			{
			$questionsummary .= "\t\t\t\t\t<img src='$imagefiles/blank.gif' alt='' width='40' align='left' border='0' hspace='0'>\n";
			}
		if($sumrows5['define_questions'])
			{
			$questionsummary .= "<a href='#' onClick=\"window.open('".$homeurl."/conditions.php?sid=$surveyid&amp;qid=$qid', 'conditions', 'menubar=no, location=no, status=no, height=475, width=560, scrollbars=yes, resizable=yes, left=50, top=50')\""
			. "onmouseout=\"hideTooltip()\""
			. "onmouseover=\"showTooltip(event,'"._("Set Conditions for this Question")."');return false\">"
			. "<img src='$imagefiles/conditions.png' title='' alt='' align='left' name='SetQuestionConditions'></a>\n"
			. "\t\t\t\t\t<img src='$imagefiles/seperator.gif' alt='' border='0' hspace='0' align='left'>\n";
			}
		else
			{
			$questionsummary .= "\t\t\t\t\t<img src='$imagefiles/blank.gif' alt='' width='40' align='left' border='0' hspace='0'>\n";
			}
		if ($qrrow['type'] == "O" || $qrrow['type'] == "L" || $qrrow['type'] == "!" || $qrrow['type'] == "!" || $qrrow['type'] == "M" || $qrrow['type'] == "Q" || $qrrow['type']=="A" || $qrrow['type'] == "B" || $qrrow['type'] == "C" || $qrrow['type'] == "E" || $qrrow['type'] == "F" || $qrrow['type'] == "H" || $qrrow['type'] == "P" || $qrrow['type'] == "R")
		{
			$questionsummary .= "\t\t\t\t\t" .
			"<a href='".$scriptname."?sid=$surveyid&amp;gid=$gid&amp;qid=$qid&amp;viewanswer=Y'" .
			"onmouseout=\"hideTooltip()\""
			. "onmouseover=\"showTooltip(event,'"._("Edit/Add Answers for this Question")."');return false\">" .
			"<img src='$imagefiles/answers.png' title='' align='left' name='ViewAnswers'></a>\n" ;
		}
		$questionsummary .= "\t\t\t\t\t</td>\n"
		. "\t\t\t\t\t<td align='right' width='400' valign='top'>\n"
		. "\t\t\t\t\t<input type='image' src='$imagefiles/close.gif' title='"
		. _("Close this Question")."' alt='". _("Close this Question")."' align='right' name='CloseQuestionWindow' "
		. "onclick=\"window.open('$scriptname?sid=$surveyid&amp;gid=$gid', '_top')\">\n"
		. "\t\t\t\t\t<input type='image' src='$imagefiles/plus.gif' title='"
		. _("Show Details of this Question")."'  alt='". _("Show Details of this Question")."'align='right'  name='MaximiseQuestionWindow' "
		. "onclick='showdetails(\"showq\")'>"
		. "\t\t\t\t\t<input type='image' src='$imagefiles/minus.gif' title='"
		. _("Hide Details of this Question")."'  alt='". _("Hide Details of this Question")."'align='right'  name='MinimiseQuestionWindow' "
		. "onclick='showdetails(\"hideq\")'>\n"
		. "\t\t\t\t</td></tr>\n"
		. "\t\t\t</table>\n"
		. "\t\t</td>\n"
		. "\t</tr>\n";
		if (returnglobal('viewanswer'))	{$qshowstyle = "style='display: none'";}
		else							{$qshowstyle = "";}
		$questionsummary .= "\t<tr $qshowstyle id='surveydetails30'><td width='20%' align='right'>$setfont<strong>"
		. _("Code:")."</strong></font></td>\n"
		. "\t<td>$setfont{$qrrow['title']}";
		if ($qrrow['mandatory'] == "Y") {$questionsummary .= ": (<i>"._("Mandatory Question")."</i>)";}
		else {$questionsummary .= ": (<i>"._("Optional Question")."</i>)";}
		$questionsummary .= "</font></td></tr>\n"
		. "\t<tr $qshowstyle id='surveydetails31'><td align='right' valign='top'>$setfont<strong>"
		. _("Question:")."</strong></font></td>\n\t<td>$setfont{$qrrow['question']}</font></td></tr>\n"
		. "\t<tr $qshowstyle id='surveydetails32'><td align='right' valign='top'>$setfont<strong>"
		. _("Help:")."</strong></font></td>\n\t<td>";
		if (trim($qrrow['help'])!=''){$questionsummary .= "$setfont{$qrrow['help']}</font>";}
		$questionsummary .= "</td></tr>\n";
		if ($qrrow['preg'])
		{
			$questionsummary .= "\t<tr $qshowstyle id='surveydetails33'><td align='right' valign='top'>$setfont<strong>"
			. _("Validation:")."</strong></font></td>\n\t<td>$setfont{$qrrow['preg']}"
			. "</font></td></tr>\n";
		}
		$qtypes = getqtypelist("", "array"); //qtypes = array(type code=>type description)
		$questionsummary .= "\t<tr $qshowstyle id='surveydetails34'><td align='right' valign='top'>$setfont<strong>"
		._("Type:")."</strong></font></td>\n\t<td>$setfont{$qtypes[$qrrow['type']]}";
		if ($qrrow['type'] == "F" ||$qrrow['type'] == "H")
		{
			$questionsummary .= " (LID: {$qrrow['lid']}) "
			. "<input align='top' type='image' src='$imagefiles/labels.png' title='"
			. _("Edit/Add Label Sets")."' height='15' width='15' hspace='0' name='EditThisLabelSet' "
			. "onClick=\"window.open('labels.php?lid={$qrrow['lid']}', '_blank')\">\n";
		}
		$questionsummary .="</font></td></tr>\n";
		if ($qct == 0 && ($qrrow['type'] == "O" || $qrrow['type'] == "L" || $qrrow['type'] == "!" || $qrrow['type'] == "M" || $qrrow['type'] == "Q" || $qrrow['type'] == "A" || $qrrow['type'] == "B" || $qrrow['type'] == "C" || $qrrow['type'] == "E" || $qrrow['type'] == "P" || $qrrow['type'] == "R" || $qrrow['type'] == "F" ||$qrrow['type'] == "H"))
		{
			$questionsummary .= "\t\t<tr $qshowstyle id='surveydetails35'><td></td><td>"
			. "<font face='verdana' size='1' color='green'>"
			. _("Warning").": ". _("You need to add answers to this question")." "
			. "<input type='image' src='$imagefiles/answers.png' title='"
			. _("Edit/Add Answers for this Question")."' border='0' hspace='0' name='EditThisQuestionAnswers'"
			. "onClick=\"window.open('".$scriptname."?sid=$surveyid&amp;gid=$gid&amp;qid=$qid&amp;viewanswer=Y', '_top')\"></font></td></tr>\n";
		}
		if (!$qrrow['lid'] && ($qrrow['type'] == "F" ||$qrrow['type'] == "H"))
		{
			$questionsummary .= "\t\t<tr $qshowstyle id='surveydetails36'><td></td>"
			. "<td><font face='verdana' size='1' color='green'>"
			. _("Warning").": "._("You need to choose a Label Set for this question")."</font></td></tr>\n";
		}
		if ($qrrow['type'] == "M" or $qrrow['type'] == "P")
		{
			$questionsummary .= "\t<tr $qshowstyle id='surveydetails37'>"
			. "<td align='right' valign='top'>$setfont<strong>"
			. _("Other:")."</strong></font></td>\n"
			. "\t<td>$setfont{$qrrow['other']}</td></tr>\n";
		}
		if ($qrrow['type'] == "J" || $qrrow['type'] == "I")
		{
			if ($action == "insertCSV")
			{
				$questionsummary .= "\t\t<tr $qshowstyle id='surveydetails37'><td></td><td>"
				. "<font face='verdana' size='2' color='green'><b>
							 ". _("Upload completed")."</font></b></td></tr>\n";
			}
			elseif ($action == "editquestion" || $action == "copyquestion")
			{
				$questionsummary .= " ";
			}
			elseif ($action == "insertnewquestion" || ($action == "updatequestion" && $change == "0"))
			{
				upload();
			}
		}
		$qid_attributes=getQuestionAttributes($qid);
	}
	$questionsummary .= "</table>\n";
}

if (returnglobal('viewanswer'))
{
	echo keycontroljs();
	$qquery = "SELECT type FROM ".db_table_name('questions')." WHERE qid=$qid";
	$qresult = db_execute_assoc($qquery);
	while ($qrow=$qresult->FetchRow()) {$qtype=$qrow['type'];}
	if (!isset($_POST['ansaction']))
	{
		//check if any nulls exist. If they do, redo the sortorders
		$caquery="SELECT * FROM ".db_table_name('answers')." WHERE qid=$qid AND sortorder is null";
		$caresult=$connect->Execute($caquery);
		$cacount=$caresult->RecordCount();
		if ($cacount)
		{
			fixsortorder($qid);
		}
	}
	$vasummary  = "<table width='100%' align='center' border='0' bgcolor='#EEEEEE'>\n"
	. "<tr bgcolor='#555555'><td colspan='5'><font size='1' color='white'><strong>"
	. _("Answers")."</strong></font></td></tr>\n";
	$cdquery = "SELECT * FROM {$dbprefix}answers WHERE qid=$qid ORDER BY sortorder, answer";
	$cdresult = db_execute_assoc($cdquery);
	$cdcount = $cdresult->RecordCount();
	$vasummary .= "\t<tr><th width='10%'>$setfont"._("Code")."</font></th><th width='50%'>$setfont"._("Answer")."</font></th>"
	. "<th width='10%'>$setfont"._("Default")."</font></th><th width='15%'>$setfont"._("Action")."</font></th>"
	. "<th>$setfont"._("Move")."</font></th></tr>\n";
	$position=0;
	while ($cdrow = $cdresult->FetchRow())
	{
		$cdrow['code'] = htmlspecialchars($cdrow['code']);
		$position=sprintf("%05d", $position);
		if ($cdrow['sortorder'] || $cdrow['sortorder'] == "0") {$position=$cdrow['sortorder'];}
		$vasummary .= "\t<tr><td colspan='5'><form style='margin-bottom:0;' action='".$scriptname."' method='post'>\n";
		$vasummary .= "\t<table width='100%' cellspacing='0' cellpadding='0'><tr><td align='center' width='10%'>";
		if (($activated == "Y" && ($qtype == "L" || $qtype == "!")) || ($activated == "N"))
		{
			$vasummary .="<input name='code' type='text' value=\"{$cdrow['code']}\" maxlength='5' size='5' "
			."onKeyPress=\"return goodchars(event,'1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWZYZ_-')\""
			.">";
		}
		else
		{
			$vasummary .= "$setfont<font size='1'>{$cdrow['code']}"
			. "<input type='hidden' name='code' value=\"{$cdrow['code']}\">";
		}
		$vasummary .="</td>\n";
		$cdrow['answer']=htmlspecialchars($cdrow['answer']);  // So HTML-Code can be used in answers
		$cdrow['default_value'] = htmlspecialchars($cdrow['default_value']);
		$vasummary .= "\t\t<td align='center' width='50%'><input name='answer' "
		. "type='text' value=\"{$cdrow['answer']}\" size='50'>\n"
		. "\t\t<input name='sortorder' type='hidden' value=\"$position\"></td>"
		. "\t\t<td align='center' width='10%'>";
		if (($activated == "Y" && ($qtype == "L" || $qtype =="!")) || ($activated == "N"))
		{
			$vasummary .= "\t\t\t<select name='default' >\n"
			. "\t\t\t\t<option value='Y'";
			if ($cdrow['default_value'] == "Y") {$vasummary .= " selected";};
			$vasummary .= ">"._("Yes")."</option>\n"
			. "\t\t\t\t<option value='N'";
			if ($cdrow['default_value'] != "Y") {$vasummary .= " selected";};
			$vasummary .= ">"._("No")."</option>\n"
			. "\t\t\t</select></td>\n";
		}
		else
		{
			$vasummary .= "$setfont<font size='1'>{$cdrow['default_value']}"
			. "<input type='hidden' name='default' value=\"{$cdrow['default_value']}\">";
		}
		if (($activated == "Y" && ($qtype == "L" || $qtype == "!")) || ($activated == "N"))
		{
			$vasummary .= "\t\t<td align='center' width='15%'>\n"
			. "\t\t\t<input name='ansaction' type='submit' value='"._("Save")."'>"
			. "<input name='ansaction' type='submit' value='"._("Del")."'>\n"
			. "\t\t</td>\n";
		}
		else
		{
			$vasummary .= "\t\t<td align='center' width='15%'><input name='ansaction' "
			. "type='submit' value='"._("Save")."'></td>\n";
		}
		$vasummary .= "\t\t<td align='center'>";
		if ($position > 0) {$vasummary .= "<input name='ansaction' type='submit' value='"._("Up")."'>";}
		else {$vasummary .= "&nbsp;&nbsp;&nbsp;&nbsp;";}
		if ($position < $cdcount-1) {$vasummary .= "<input name='ansaction' type='submit' value='"._("Dn")."'>";}
		else {$vasummary .= "&nbsp;&nbsp;&nbsp;&nbsp;";}
		$vasummary .= "\t\t\n";
		$vasummary .= "\t<input type='hidden' name='oldcode' value=\"{$cdrow['code']}\">\n"
		. "\t<input type='hidden' name='oldanswer' value=\"{$cdrow['answer']}\">\n"
		. "\t<input type='hidden' name='olddefault' value=\"{$cdrow['default_value']}\">\n"
		. "\t<input type='hidden' name='sid' value='$surveyid'>\n"
		. "\t<input type='hidden' name='gid' value='$gid'>\n"
		. "\t<input type='hidden' name='qid' value='$qid'>\n"
		. "\t<input type='hidden' name='viewanswer' value='Y'>\n"
		. "\t<input type='hidden' name='action' value='modanswer'>\n"
		. "\t</td></table></form></tr>\n";
		$position++;
	}
	if (($activated == "Y" && ($qtype == "L" || $qtype == "!")) || ($activated == "N"))
	{
		$position=sprintf("%05d", $position);
		$vasummary .= "\t<tr><td colspan='5'><form style='margin-bottom:0;' action='".$scriptname."' method='post'>\n"
		. "\t<table width='100%'><tr><td align='center' width='10%'><input name='code' type='text' size='5' maxlength='5' "
		. "id='addanswercode' "
		. "onKeyPress=\"return goodchars(event,'1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWZYZ_-')\">"
		. "</td>\n"
		. "\t\t<td align='center' width='50%'><input name='answer' type='text' size='50'>\n"
		. "\t\t<input name='sortorder' type='hidden' value='$position'></td>\n"
		. "\t\t<td align='center' width='10%'>"
		. "\t\t\t<select name='default' >\n"
		. "\t\t\t\t<option value='Y'>"._("Yes")."</option>\n"
		. "\t\t\t\t<option value='N' selected>"._("No")."</option>\n"
		. "\t\t\t</select></td>\n"
		. "\t\t<td align='center' width='15%'><input name='ansaction' type='submit' value='"._("Add")."'></td>\n"
		. "\t\t<td>\n"
		. "\t<input type='hidden' name='sid' value='$surveyid'>\n"
		. "\t<input type='hidden' name='gid' value='$gid'>\n"
		. "\t<input type='hidden' name='qid' value='$qid'>\n"
		. "\t<input type='hidden' name='action' value='modanswer'>\n"
		. "\t<input type='hidden' name='viewanswer' value='Y'>\n";
		$vasummary .= "<script type='text/javascript' language='javascript'>\n"
		. "<!--\n"
		. "document.getElementById('addanswercode').focus();\n"
		. "//-->\n"
		. "</script>\n"
		. "\t</td></table></form></tr>\n";
	}
	if ($cdcount > 0)
	{
		$vasummary .= "<tr><td colspan='3'></td><td align='center'>"
		. "<form style='margin-bottom:0;' action='".$scriptname."' method='post'>"
		. "<input type='submit' name='ansaction' value='"._("Sort Alpha")."'>\n"
		. "\t<input type='hidden' name='sid' value='$surveyid'>\n"
		. "\t<input type='hidden' name='gid' value='$gid'>\n"
		. "\t<input type='hidden' name='qid' value='$qid'>\n"
		. "\t<input type='hidden' name='action' value='modanswer'>\n"
		. "\t<input type='hidden' name='viewanswer' value='Y'></form>\n</td>"
		. "\t<td align='center'>\n"
		. "\t<form style='margin-bottom:0;' action='".$scriptname."' method='post'>"
		. "<input type='submit' name='ansaction' value='"._("Fix Sort")."'>\n"
		. "\t<input type='hidden' name='sid' value='$surveyid'>\n"
		. "\t<input type='hidden' name='gid' value='$gid'>\n"
		. "\t<input type='hidden' name='qid' value='$qid'>\n"
		. "\t<input type='hidden' name='action' value='modanswer'>\n"
		. "\t<input type='hidden' name='viewanswer' value='Y'>\n"
		. "</form></td>\n";
	}

	$vasummary .= "</table>\n";

	}

// check data for login
if(isset($_POST['user']) && isset($_POST['password']) || ($action == "forgotpass"))	// added by Dennis
	{
	include("usercontrol.php");
	}
	
// login form
if(!isset($_SESSION['loginID']) && $action != "forgotpass" && $action != "login")	// added by Dennis
	{
	
	if($action == "forgotpassword")
		{
		$loginsummary = "<form name='forgot' id='forgot' method='post' action='$rooturl/admin/admin.php' ><br /><strong>"._("You have to enter user name and email.")."</strong><br />	<br />		
							<table>
								<tr>
									<td><p>"._("Username")."</p></td>
									<td><input name='user' type='text' id='user' size='40' maxlength='40' value=''></td>
								</tr>
								<tr>
									<td><p>"._("Email")."</p></td>
									<td><input name='email' id='email' type='text' size='40' maxlength='40' value=''></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td><input type='hidden' name='action' value='forgotpass'>
									<input class='action' type='submit' value='Check data'><br />&nbsp;\n</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td><a href='$scriptname'>"._("Main Admin Screen")."</a></td>
								</tr>
							</table>						
						</form>";	
		}
	else
		{		
		$loginsummary = $loginfailed . "<form name='login' id='login' method='post' action='$rooturl/admin/admin.php' ><br /><strong>"._("You have to login first.")."</strong><br />	<br />		
							<table>
								<tr>
									<td><p>"._("Username")."</p></td>
									<td><input name='user' type='text' id='user' size='40' maxlength='40' value=''></td>
								</tr>
								<tr>
									<td><p>"._("Password")."</p></td>
									<td><input name='password' id='password' type='password' size='40' maxlength='40'></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td><input type='hidden' name='action' value='login'>
									<input class='action' type='submit' value='Login'><br />&nbsp;\n</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td><a href='$scriptname?action=forgotpassword'>"._("Forgot Your Password?")."</a><br />&nbsp;\n</td>
								</tr>
							</table>
						</form>";
	
		// Language selection
		$loginsummary .=  "\t<form name='language' id='language' method='post' action='$rooturl/admin/admin.php' >"
						. "\t<table><tr>\n"
						. "\t\t<td align='center' >$setfont\n"
						. "\t\t\t<strong>"._("Current Language").":</strong>\n"
						. "\t\t</font></td><td>$setfont\n"
						. "\t\t\t<select name='lang' onChange='form.submit()'>\n";
		foreach (getlanguagedata() as $langkey=>$languagekind)
			{
			$loginsummary .= "\t\t\t\t<option value='$langkey'";
			if ($langkey == $_SESSION['adminlang']) {$loginsummary .= " selected";}
			$loginsummary .= ">".$languagekind['description']." - ".$languagekind['nativedescription']."</option>\n";
			}
		$loginsummary .= "\t\t\t</select>\n"
						. "\t\t\t<input type='hidden' name='action' value='changelang'>\n"
						. "\t\t</font></td>\n"
						. "\t</tr>\n"
						. "</table>"						
						. "</form>";
		}		
	}

// logout user
if ($action == "logoutuser" && isset($_SESSION['loginID']))
	{
	$action = "logout";
	include("usercontrol.php");
	}
	
if ($action == "adduser" || $action=="deluser" || $action == "moduser" || $action == "userrights")
{
	include("usercontrol.php");
}

if ($action == "modifyuser")
	{
	if($_SESSION['loginID'] == $_POST['uid'])
		{
		$usersummary = "<table width='100%' border='0'>\n\t<tr><td colspan='3' bgcolor='black' align='center'>\n"
					 . "\t\t<strong>$setfont<font color='white'>"._("Modifying User")."</td></tr>\n"
						 . "\t<tr>\n"
						 . "\t\t<th>$setfont"._("Username")."</th>\n"
						 . "\t\t<th>$setfont"._("Email")."</font></th>\n"
						 . "\t\t<th>$setfont"._("Password")."</font></th>\n"
						 . "\t</tr>\n";
		$muq = "SELECT a.user, DECODE(a.password, '{$codeString}') AS decpassword, a.email, a.uid, b.user AS parent FROM ".db_table_name('users')." AS a LEFT JOIN ".db_table_name('users')." AS b ON a.parent_id = b.uid WHERE a.uid='{$_POST['uid']}' LIMIT 1";	//	added by Dennis
		//echo($muq);
		
		$mur = db_execute_assoc($muq);
		$usersummary .= "\t<tr><form action='$scriptname' method='post'>";
		while ($mrw = $mur->FetchRow())
			{
			$mrw = array_map('htmlspecialchars', $mrw);
			$decodeString = "DECODE(a.password, '{$codeString}')";	//	added by Dennis
			$usersummary .= "\t<td align='center'>$setfont<strong>{$mrw['user']}</strong></font>\n"
						  . "\t<td align='center'>\n\t\t<input type='text' name='email' value=\"{$mrw['email']}\"></td>\n"	
						  . "\t\t<input type='hidden' name='user' value=\"{$mrw['user']}\"></td>\n"
						  . "\t\t<input type='hidden' name='uid' value=\"{$mrw['uid']}\"></td>\n";	// added by Dennis
			$usersummary .= "\t<td align='center'>\n\t\t<input type='text' name='pass' value=\"{$mrw['decpassword']}\"></td>\n";
			}		
		$usersummary .= "\t</tr>\n\t<tr><td colspan='3' align='center'>\n"
					  . "\t\t<input type='submit' value='"._("Update")."'>\n"
					  . "<input type='hidden' name='action' value='moduser'></td></tr>\n"
					  . "</form></table>\n";
		}  
	else
		{			
		include("access_denied.php");			
		}
}

if ($action == "setuserrights")
	{
	if($_SESSION['loginID'] != $_POST['uid'])
		{	
		$usersummary = "<table width='100%' border='0'>\n\t<tr><td colspan='8' bgcolor='black' align='center'>\n"
					 . "\t\t<strong>$setfont<font color='white'>"._("Set User Rights").": ".$_POST['user']."</td></tr>\n";
						
		if($_SESSION['USER_RIGHT_CREATE_SURVEY']) {
			$usersummary .= "\t\t<th align='center'>create survey</th>\n";
		}
		if($_SESSION['USER_RIGHT_CONFIGURATOR']) {
			$usersummary .= "\t\t<th align='center'>configurator</th>\n";
		}
		if($_SESSION['USER_RIGHT_CREATE_USER']) {
			$usersummary .= "\t\t<th align='center'>create user</th>\n";
		}
		if($_SESSION['USER_RIGHT_DELETE_USER']) {
			$usersummary .= "\t\t<th align='center'>delete user</th>\n";
		}
		if($_SESSION['USER_RIGHT_PULL_UP_USER']) {
			$usersummary .= "\t\t<th align='center'>pull up user</th>\n";
		}
		if($_SESSION['USER_RIGHT_PUSH_DOWN_USER']) {
			$usersummary .= "\t\t<th align='center'>push down user</th>\n";
		}
		if($_SESSION['USER_RIGHT_MANAGE_TEMPLATE']) {
			$usersummary .= "\t\t<th align='center'>manage template</th>\n";
		}
		if($_SESSION['USER_RIGHT_MANAGE_LABEL']) {
			$usersummary .= "\t\t<th align='center'>manage label</th>\n";
		}
		
		foreach ($_SESSION['userlist'] as $usr)
			{
			if ($usr['uid'] == $_POST['uid'])
				{
				$usersummary .="\t\t<th></th>\n\t</tr>\n"
				."\t<tr><form method='post' action='$scriptname'></tr>"
							  ."<form action='$scriptname' method='post'>\n";
				//content
				if($_SESSION['USER_RIGHT_CREATE_SURVEY']) {
					$usersummary .= "\t\t<td align='center'><input type=\"checkbox\" name=\"create_survey\" value=\"create_survey\"";
					if($usr['create_survey']) {
						$usersummary .= " checked ";
					}
					$usersummary .="></td>\n";
				}
				if($_SESSION['USER_RIGHT_CONFIGURATOR']) {
					$usersummary .= "\t\t<td align='center'><input type=\"checkbox\" name=\"configurator\" value=\"configurator\"";
					if($usr['configurator']) {
						$usersummary .= " checked ";
					}
					$usersummary .="></td>\n";
				}
				if($_SESSION['USER_RIGHT_CREATE_USER']) {
					$usersummary .= "\t\t<td align='center'><input type=\"checkbox\" name=\"create_user\" value=\"create_user\"";
					if($usr['create_user']) {
						$usersummary .= " checked ";
					}
					$usersummary .="></td>\n";
				}
				if($_SESSION['USER_RIGHT_DELETE_USER']) {
					$usersummary .= "\t\t<td align='center'><input type=\"checkbox\" name=\"delete_user\" value=\"delete_user\"";
					if($usr['delete_user']) {
						$usersummary .= " checked ";
					}
					$usersummary .="></td>\n";
				}
				if($_SESSION['USER_RIGHT_PULL_UP_USER']) {
					$usersummary .= "\t\t<td align='center'><input type=\"checkbox\" name=\"pull_up_user\" value=\"pull_up_user\"";
					if($usr['pull_up_user']) {
						$usersummary .= " checked ";
					}
					$usersummary .="></td>\n";
				}
				if($_SESSION['USER_RIGHT_PUSH_DOWN_USER']) {
					$usersummary .= "\t\t<td align='center'><input type=\"checkbox\" name=\"push_down_user\" value=\"push_down_user\"";
					if($usr['push_down_user']) {
						$usersummary .= " checked ";
					}
					$usersummary .="></td>\n";
				}
				if($_SESSION['USER_RIGHT_MANAGE_TEMPLATE']) {
					$usersummary .= "\t\t<td align='center'><input type=\"checkbox\" name=\"manage_template\" value=\"manage_template\"";
					if($usr['manage_template']) {
						$usersummary .= " checked ";
					}
					$usersummary .="></td>\n";
				}
				if($_SESSION['USER_RIGHT_MANAGE_LABEL']) {
					$usersummary .= "\t\t<td align='center'><input type=\"checkbox\" name=\"manage_label\" value=\"manage_label\"";
					if($usr['manage_label']) {
						$usersummary .= " checked ";
					}
					$usersummary .="></td>\n";
				}

				$usersummary .= "\t\t\t<tr><form method='post' action='$scriptname'></tr>"	// added by Dennis
							  ."\t\n\t<tr><td colspan='8' align='center'>"
							  ."<input type='submit' value='"._("Save Now")."'>"
							  ."<input type='hidden' name='action' value='userrights'>"
							  ."<input type='hidden' name='uid' value='{$_POST['uid']}'></td></tr>"
							  ."</form>"
							  . "</table>\n";
				continue;
				}					  
			}
		}
	else
		{			
		include("access_denied.php");			
		}
	}

if ($action == "editusers")
	{	
	if(isset($_SESSION['loginID']))
		{
		$usersummary = "<table rules='rows' width='100%'>\n"
					 . "\t\t\t\t<tr bgcolor='#555555'><td colspan='5' height='4'>"
					 . "<font size='1' face='verdana' color='white'><strong>"._("User Control")."</strong></font></td></tr>\n"
					 . "\t<tr>\n"
					 . "\t\t<th>$setfont"._("Username")."</font></th>\n"
					 . "\t\t<th>$setfont"._("Email")."</font></th>\n"
					 . "\t\t<th>$setfont"._("Password")."</font></th>\n"
					 //. "\t\t<th>$setfont"._("Level")."</font></th>\n"
					 . "\t\t<th>$setfont"._("Creator")."</font></th>\n"
					 . "\t\t<th>$setfont"._("Action")."</font></th>\n"
					 . "\t</tr>\n";
		
		//$userlist = getuserlist();
		$_SESSION['userlist'] = getuserlistforuser($_SESSION['loginID'], 0, NULL);
		$ui = count($_SESSION['userlist']);
		
		$usrhimself = $_SESSION['userlist'][0];
		unset($_SESSION['userlist'][0]);		
		
		//	sort
		$sortArray = array();		
		
		foreach($_SESSION['userlist'] as $key => $array) {
			$sortArray[$key] = $array[0];
		}				
		array_multisort($sortArray, $_SESSION['userlist']); // by user name
			
		//	output users			
		$usersummary .= "\t<tr>\n"
					  . "\t<td align='center'><strong>$setfont{$usrhimself['user']}</font></strong></td>\n"
					  . "\t<td align='center'><strong>$setfont{$usrhimself['email']}</font></strong></td>\n";
			
		$usersummary .=  "\t\t<td align='center'><strong>$setfont{$usrhimself['password']}</font></strong></td>\n";
		
		if($usrhimself['parent']!=0) {
			$usersummary .= "\t\t<td align='center'><strong>$setfont{$usrhimself['parent']}</font></strong></td>\n"
						  . "\t\t<td align='center'>\n";
			}
		else
			{
			$usersummary .= "\t\t<td align='center'><strong>$setfont---</font></strong></td>\n"
				  		. "\t\t<td align='center'>\n";
			}
		$usersummary .= "\t\t\t<form method='post' action='$scriptname'>"
					  ."<input type='submit' value='"._("Edit")."'>"
					  ."<input type='hidden' name='action' value='modifyuser'>"
					  ."<input type='hidden' name='uid' value='{$usrhimself['uid']}'>"
					  ."</form>";			
				
		// users are allowed to delete all successor users (but the admin not himself) 
		if ($usrhimself['parent_id'] != 0 && ($_SESSION['USER_RIGHT_DELETE_USER'] == 1 || ($usrhimself['uid'] == $_SESSION['loginID'])))				
			{
			$usersummary .= "\t\t\t<form method='post' action='$scriptname?action=deluser'>"
						  ."<input type='submit' value='"._("Delete")."' onClick='return confirm(\""._("Are you sure you want to delete this entry.")."\")'>"
						  ."<input type='hidden' name='action' value='deluser'>"
						  ."<input type='hidden' name='user' value='{$usrhimself['user']}'>"
						  ."<input type='hidden' name='uid' value='{$usrhimself['uid']}'>"
						  ."</form>";
			}				

		$usersummary .= "\t\t</td>\n"
					  . "\t</tr>\n";
		
		// empty row
		if(!empty($_SESSION['userlist']))
			$usersummary .= "\t<tr>\n\t<td height=\"20\" colspan=\"6\" style=\"border-left:1px solid #000000; border-top:1px solid #000000; border-bottom:1px solid #000000;\" align='center'></td>\n\t</tr>";
						 
		// other users
		foreach ($_SESSION['userlist'] as $usr)
			{
			$usersummary .= "\t<tr>\n"
						  . "\t<td align='center'>$setfont{$usr['user']}</font></td>\n"
						  . "\t<td align='center'>$setfont{$usr['email']}</font></td>\n";
			
			// passwords of other users will not be displayed				
			$usersummary .=  "\t\t<td align='center'>$setfont******</font></td>\n";
			
			$usersummary .= //"\t\t<td align='center'>$setfont{$usr['level']}</font></td>\n"							  
						  "\t\t<td align='center'>$setfont{$usr['parent']}</font></td>\n"
						  . "\t\t<td align='center'>\n";
				
			// users are allowed to delete all successor users (but the admin not himself) 
			if ($usr['parent_id'] != 0 && ($_SESSION['USER_RIGHT_DELETE_USER'] == 1 || ($usr['uid'] == $_SESSION['loginID'])))				
				{
				$usersummary .= "\t\t\t<form method='post' action='$scriptname?action=deluser'>"
							  ."<input type='submit' value='"._("Delete")."' onClick='return confirm(\""._("Are you sure you want to delete this entry.")."\")'>"
							  ."<input type='hidden' name='action' value='deluser'>"
							  ."<input type='hidden' name='user' value='{$usr['user']}'>"
							  ."<input type='hidden' name='uid' value='{$usr['uid']}'>"
							  ."</form>";
				}				
			
			$usersummary .= "\t\t\t<form method='post' action='$scriptname'>"
						  ."<input type='submit' value='"._("Set User Rights")."'>"
						  ."<input type='hidden' name='action' value='setuserrights'>"
						  ."<input type='hidden' name='user' value='{$usr['user']}'>"
						  ."<input type='hidden' name='uid' value='{$usr['uid']}'>"
						  ."</form>";					
			
			$usersummary .= "\t\t</td>\n"
						  . "\t</tr>\n";
			}
		if($_SESSION['USER_RIGHT_CREATE_USER'] == 1)
			{
			$usersummary .= "\t\t<form action='$scriptname' method='post'>\n"
						  . "\t\t<tr>\n"
						  . "\t\t<td align='center'><input type='text' name='new_user'></td>\n"
						  . "\t\t<td align='center'><input type='text' name='new_email'></td>\n"
						  . "\t\t<td align='center'><input type='submit' value='"._("Add User")."'>"
						  . "<input type='hidden' name='action' value='adduser'></td>\n"
						  . "\t</tr>\n";
			}
		}
	}
	
if ($action == "addusergroup")
	{	
	if(isset($_SESSION['loginID']))
		{
		$usersummary = "<form action='$scriptname' method='post'>\n"
				. "<table width='100%' border='0'>\n\t<tr><td colspan='3' bgcolor='black' align='center'>\n"
				. "\t\t<strong>$setfont<font color='white'>"._("Add Group")."</td></tr>\n"
				. "<tr>"
				. "<th>"._("Name"). "</th>"
				. "<th>". _("Description"). "</th>"
				. "<th>". _("Action"). "</th>"
				. "</tr>"
				. "<tr>"
				. "<td align='center'><input type='text' name='group_name'></td>"
				. "<td align='center'><input type='text' name='group_description'></td>"
				. "<td align='center'><input type='hidden' name='action' value='usergroupindb'>"
				. "<input type='submit' value="._("Add")."></td>"
				. "</tr>"
				. "</table>"
				. "</form>\n";
		}
	}
	
if ($action == "delusergroup")
	{
	$usersummary = "<br /><strong>"._("Deleting User Group")."</strong><br />\n";
		
	if(isset($_POST['ugid']) && $_POST['ugid'] > -1)
		{
		$query = "SELECT ugid, name, creator_id FROM ".db_table_name('user_groups')." WHERE ugid = ".$_POST['ugid']." AND creator_id = ".$_SESSION['loginID']." LIMIT 1";
		$result = db_execute_assoc($query);
		if($result->RecordCount() > 0)
			{
			$row = $result->FetchRow();
			
			$remquery = "DELETE FROM ".db_table_name('user_groups')." WHERE ugid = {$ugid} AND creator_id = {$_SESSION['loginID']}";
			if($connect->Execute($remquery))
				{
				$usersummary .= "<br />"._("Group Name").": {$row['name']}<br />\n";								
				}
			else
				{
				$usersummary .= "<br />"._("Could not delete user group.")."<br />\n";
				}
			}
		else
			{
			include("access_denied.php");
			}
		}
		else
			{
			$usersummary .= "<br />"._("Could not delete user group. No group selected.")."<br />\n";
			}
	$usersummary .= "<br /><a href='$scriptname?action=editusergroups'>"._("Continue")."</a><br />&nbsp;\n";
	}
	
if ($action == "usergroupindb") {
	$usersummary = "<br /><strong>"._("Add User Group")."</strong><br />\n";
		
	$group_name = $_POST['group_name'];
	$group_description = $_POST['group_description'];
	if(isset($group_name) && strlen($group_name) > 0)
		{
		$ugid = addUserGroupInDB($group_name, $group_description);
		if($ugid > 0) 
			{
			$usersummary .= "<br />"._("Group Name").": {$group_name}<br />\n";
		
			if(isset($group_description) && strlen($group_description) > 0)
				{
				$usersummary .= _("Description: ").$group_description."<br />\n";
				}
			
			$usersummary .= "<br /><a href='$scriptname?action=editusergroups&amp;ugid={$ugid}'>"._("Continue")."</a><br />&nbsp;\n";
			} 
		else 
			{
			$usersummary .= "<br /><strong>"._("Failed to add Group!")."</strong><br />\n"
							. _("Group already exists!")."<br />\n"
							. "<br /><a href='$scriptname?action=editusergroups'>"._("Continue")."</a><br />&nbsp;\n";
			}		
		}
	else 
		{						
		$usersummary .= "<br /><strong>"._("Failed to add Group!")."</strong><br />\n"
						. _("Group name was not supplied!")."<br />\n"
						. "<br /><a href='$scriptname?action=addusergroup'>"._("Continue")."</a><br />&nbsp;\n";
		}	
	}
	
if ($action == "editusergroups")
	{	
	if(isset($_SESSION['loginID']))
		{
		$usersummary .= "<table width='100%' border='0'>\n"
						. "\t\t\t\t<tr valign='middle' bgcolor='#555555'><td colspan='3' height='4'>"
						. "<font size='1' face='verdana' color='white'><strong>"._("Group Control")."</strong></font></td></tr>\n"
					 	. "\t\t<tr>\n"						
						. "\t\t\t\t\t<td align='center' valign='middle'>"
						. "\t\t<font class=\"boxcaption\">"._("User Groups").":</font>"
						. "\t\t<form method='get'>\n"
	                    . "\t\t\t\t\t\t<input name='sid' type='hidden' value='12'>"
						. "\t\t\t<select name='ugid' class=\"listboxusergroups\""
						
	                    . "onChange=\"window.open('$scriptname?action=editusergroups&amp;ugid=', this.options[this.selectedIndex].value,'_top')\">\n"
	                    //. "onChange=\"window.open(this.options[this.selectedIndex].value,'_top')\">\n"
	                    
						. getusergrouplist()
	                    . "\t\t\t</select>\n"
						. "\t\t</form>"
						
	                    . "\t\t\t\t</td>\n"
						. "\t\t\t\t\t<td align='center' valign='middle'>\n"
						. "\t\t\t\t\t<form action='$scriptname' method='GET'>\n"
						. "\t\t\t\t\t\t<input type='submit' value='"._("Add new group")."'>\n"
						. "\t\t\t\t\t\t<input type='hidden' name='action' value='addusergroup'>\n"
						. "\t\t\t\t\t</form>\n"									
						. "\t\t\t\t\t\t<form method='post' action='$scriptname?action=delusergroup'>"		
						. "\t\t\t\t\t\t<input type='submit' value='"._("Delete")."' onClick='return confirm(\""._("Are you sure you want to delete this entry.")."\")'>"
						. "\t\t\t\t\t\t<input name='ugid' type='hidden' value='{$ugid}'>"
						. "\t\t\t\t\t</from>"
							
						. "\t\t\t\t\t</td>\n"
						. "\t</tr>"
						. "\t</table>\n";
								
		if(isset($_GET['ugid']))
			{
			$query = "SELECT ugid, name, creator_id FROM ".db_table_name('user_groups')." WHERE ugid = ".$_GET['ugid']." AND creator_id = ".$_SESSION['loginID']." LIMIT 1";
			$result = db_execute_assoc($query);
			if($result->RecordCount() > 0)
				{				
				$ugid = $_GET['ugid'];
				$eguquery = "SELECT * FROM ".db_table_name("user_in_groups")." AS a INNER JOIN ".db_table_name("users")." AS b ON a.uid = b.uid WHERE ugid = " . $ugid;
				$eguresult = db_execute_assoc($eguquery);
				$usersummary .= "<table rules='rows' width='100%' border='1'>\n"
							 . "\t<tr>\n"
							 . "\t\t<th>$setfont"._("Username")."</font></th>\n"
							 . "\t\t<th>$setfont"._("Email")."</font></th>\n"
							 . "\t\t<th>$setfont"._("Action")."</font></th>\n"
							 . "\t</tr>\n";
						 
				while ($egurow = $eguresult->FetchRow())
					{		
					//	output users			
					$usersummary .= "\t<tr>\n"
								  . "\t<td align='center'><strong>$setfont{$egurow['user']}</font></strong></td>\n";
					$usersummary .= "\t<td align='center'><strong>$setfont{$egurow['email']}</font></strong></td>\n";
					$usersummary .= "\t\t<td align='center'>\n";
					
					$usersummary .= "\t\t\t<form method='post' action='$scriptname?action=deleteuserfromgroup'>";
					if($_SESSION['loginID'] != $egurow['uid'])
						{
						
						$usersummary .= "<input type='submit' value='"._("Delete")."' onClick='return confirm(\""._("Are you sure you want to delete this entry.")."\")'>"
									." <input type='hidden' name='user' value='{$egurow['user']}'>"
									." <input name='uid' type='hidden' value='{$egurow['uid']}'>"
									." <input name='ugid' type='hidden' value='{$ugid}'>";
						}
					$usersummary .= "</form>"
									. "\t\t</td>\n"
								  . "\t</tr>\n";		
					}			
				$usersummary .= "\t\t<form action='$scriptname?ugid={$ugid}' method='post'>\n"
					. "\t\t<tr><td colspan='2'></td>\n"				
					. "\t\t\t\t\t<td align='center'>"
					. "\t\t\t\t\t<select name='uid' class=\"listboxusergroups\">\n"
					. getgroupuserlist()
					. "\t\t\t\t\t</select>\n"
					. "<input type='submit' value='"._("Add User")."'>"
					. "<input type='hidden' name='action' value='addusertogroup'></td></form>\n"
					. "</td></tr></form>\n";
				}			
			else
				{
				include("access_denied.php");
				}
			}
		}
	}
	
if($action == "deleteuserfromgroup") {
	$usersummary = "<br /><strong>"._("Delete User")."</strong><br />\n";		
	if(deleteUserFromGroup($_POST['uid'], $_POST['ugid']) == 1)
		{
		$usersummary .= "<br />"._("Username").": {$_POST['user']}<br />\n";
		}
	else
		{
		$usersummary .= "<br />"._("Could not delete user. User was not supplied.")."<br />\n";
		}	
	$usersummary .= "<br /><a href='$scriptname?action=editusergroups&amp;ugid=".$_POST['ugid']."'>"._("Continue")."</a><br />&nbsp;\n";		
}

if ($action == "addquestion")
	{
	
	if($sumrows5['define_questions'])
		{				
		$newquestion =  "\t<form action='$scriptname' name='addnewquestion' method='post'>\n"
		. "<table width='100%' border='0'>\n\n"
		. "\t<tr>\n"
		. "\t\t<td colspan='2' bgcolor='black' align='center'>"
		. "\t\t<strong>$setfont<font color='white'>"._("Add Question")."\n"
		. "\t\t</font></font></strong></td>\n"
		. "\t</tr>\n"
		. "\t<tr>\n"
		. "\t\t<td align='right'  width='35%'>$setfont<strong>"._("Code:")."</strong></font></td>\n"
		. "\t\t<td><input type='text' size='20' name='title'>"
		. "<font color='red' face='verdana' size='1'>"._("Required")."</font></td></tr>\n"
		. "\t<tr>\n"
		. "\t\t<td align='right' width='35%'>$setfont<strong>"._("Question:")."</strong></font></td>\n"
		. "\t\t<td><textarea cols='50' rows='3' name='question'></textarea></td>\n"
		. "\t</tr>\n"
		. "\t<tr>\n"
		. "\t\t<td align='right' width='35%'>$setfont<strong>"._("Help:")."</strong></font></td>\n"
		. "\t\t<td><textarea cols='50' rows='3' name='help'></textarea></td>\n"
		. "\t</tr>\n"
		. "\t<tr>\n"
		. "\t\t<td align='right' width='35%'>$setfont<strong>"._("Type:")."</strong></font></td>\n"
		. "\t\t<td><select name='type' id='question_type' "
		. "onchange='OtherSelection(this.options[this.selectedIndex].value);'>\n"
		. "$qtypeselect"
		. "\t\t</select></td>\n"
		. "\t</tr>\n";
	
		$newquestion .= "\t<tr id='Validation'>\n"
		. "\t\t<td align='right'>$setfont<strong>"._("Validation:")."</strong></font></td>\n"
		. "\t\t<td>$setfont\n"
		. "\t\t<input type='text' name='preg' size=50></font>\n"
		. "\t\t</td>\n"
		. "\t</tr>\n";
	
		$newquestion .= "\t<tr id='LabelSets' style='display: none'>\n"
		. "\t\t<td align='right'>$setfont<strong>"._("Label Set:")."</strong></font></td>\n"
		. "\t\t<td>$setfont\n"
		. "\t\t<select name='lid' >\n";
		$labelsets=getlabelsets();
		if (count($labelsets)>0)
		{
			$newquestion .= "\t\t\t<option value=''>"._("Please Choose...")."</option>\n";
			foreach ($labelsets as $lb)
			{
				$newquestion .= "\t\t\t<option value='{$lb[0]}'>{$lb[1]}</option>\n";
			}
		}
		$newquestion .= "\t\t</select>\n"
		. "\t\t</font></td>\n"
		. "\t</tr>\n";
	
		$newquestion .= "\t<tr id='OtherSelection' style='display: none'>\n"
		. "\t\t<td align='right'>$setfont<strong>"._("Other:")."</strong></font></td>\n"
		. "\t\t<td>$setfont\n"
		. "\t\t\t<label for='OY'>"._("Yes")."</label>"
		. "<input id='OY' type='radio' name='other' value='Y' />&nbsp;&nbsp;\n"
		. "\t\t\t<label for='ON'>"._("No")."</label>"
		. "<input id='ON' type='radio' name='other' value='N' checked />\n"
		. "\t\t</font></td>\n"
		. "\t</tr>\n";
	
		$newquestion .= "\t<tr id='MandatorySelection'>\n"
		. "\t\t<td align='right'>$setfont<strong>"._("Mandatory:")."</strong></font></td>\n"
		. "\t\t<td>$setfont\n"
		. "\t\t\t<label for='MY'>"._("Yes")."</label>"
		. "<input id='MY' type='radio' name='mandatory' value='Y' />&nbsp;&nbsp;\n"
		. "\t\t\t<label for='MN'>"._("No")."</label>"
		. "<input id='MN' type='radio' name='mandatory' value='N' checked />\n"
		. "\t\t</font></td>\n"
		. "\t</tr>\n";
	
		//Question attributes
		$qattributes=questionAttributes();
	
		$newquestion .= "\t<tr id='QTattributes'>
							<td align='right'>{$setfont}<strong>"._("Question Attributes:")."</strong></font></td>
							<td><select id='QTlist' name='attribute_name' >
							</select>
							<input type='text' id='QTtext' name='attribute_value' ></td></tr>\n";
		$newquestion .= "\t<tr>\n"
		. "\t\t<td colspan='2' align='center'>";
	
		if (isset($eqrow)) {$newquestion .= questionjavascript($eqrow['type'], $qattributes);}
		else {$newquestion .= questionjavascript('', $qattributes);}
	
		$newquestion .= "<input type='submit' value='"
		. _("Add Question")."' />\n"
		. "\t\n"
		. "\t<input type='hidden' name='action' value='insertnewquestion' />\n"
		. "\t<input type='hidden' name='sid' value='$surveyid' />\n"
		. "\t<input type='hidden' name='gid' value='$gid' />\n"
		. "</td></tr></table>\n"
		. "\t</form>\n"
		. "\t<form enctype='multipart/form-data' name='importquestion' action='$scriptname' method='post' onsubmit=\"return validatefilename(this);\">\n"
		. "<table width='100%' border='0' >\n\t"
		. "<tr><td colspan='2' align='center'>$setfont<strong>"._("OR")."</strong></font></td></tr>\n"
		. "<tr><td colspan='2' bgcolor='black' align='center'>\n"
		. "\t\t<strong>$setfont<font color='white'>"._("Import Question")."</font></font></strong></td></tr>\n\t<tr>"
		. "\t\t<td align='right' width='35%'>$setfont<strong>"._("Select SQL File:")."</strong></font></td>\n"
		. "\t\t<td><input name=\"the_file\" type=\"file\" size=\"50\"></td></tr>\n"
		. "\t<tr><td colspan='2' align='center'><input type='submit' "
		. "value='"._("Import Question")."'>\n"
		. "\t<input type='hidden' name='action' value='importquestion'>\n"
		. "\t<input type='hidden' name='sid' value='$surveyid'>\n"
		. "\t<input type='hidden' name='gid' value='$gid'>\n"
		. "\t</td></tr></table></form>\n\n";
		
		}
	else
		{
		include("access_denied.php");
		}	
	}

if ($action == "copyquestion")
	{
	//if($sumrows5['define_questions'])
	
	
	$eqquery = "SELECT * FROM {$dbprefix}questions WHERE sid=$surveyid AND gid=$gid AND qid=$qid";
	$eqresult = db_execute_assoc($eqquery);
	$qattributes=questionAttributes();
	while ($eqrow = $eqresult->FetchRow())
		{
		$eqrow = array_map('htmlspecialchars', $eqrow);
		$editquestion = "<form action='$scriptname' name='editquestion' method='post'>\n<table width='100%' border='0'>\n"
		. "\t<tr>\n"
		. "\t\t<td colspan='2' bgcolor='black' align='center'>\n"
		. "\t\t\t$setfont<font color='white'><strong>"._("Copy Question")."</strong><br />"._("Note: You MUST enter a new question code")."</font></font>\n"
		. "\t\t</td>\n"
		. "\t</tr>\n"
		. "\t<tr>\n"
		. "\t\t<td align='right'>$setfont<strong>"._("Code:")."</strong></font></td>\n"
		. "\t\t<td><input type='text' size='20' name='title' value='' /></td>\n"
		. "\t</tr>\n"
		. "\t<tr>\n"
		. "\t\t<td align='right' valign='top'>$setfont<strong>"._("Question:")."</strong></font></td>\n"
		. "\t\t<td><textarea cols='50' rows='4' name='question'>{$eqrow['question']}</textarea></td>\n"
		. "\t</tr>\n"
		. "\t<tr>\n"
		. "\t\t<td align='right' valign='top'>$setfont<strong>"._("Help:")."</strong></font></td>\n"
		. "\t\t<td><textarea cols='50' rows='4' name='help'>{$eqrow['help']}</textarea></td>\n"
		. "\t</tr>\n"
		. "\t<tr>\n"
		. "\t\t<td align='right'>$setfont<strong>"._("Type:")."</strong></font></td>\n"
		. "\t\t<td><select name='type' onchange='OtherSelection(this.options[this.selectedIndex].value);'>\n"
		. getqtypelist($eqrow['type'])
		. "\t\t</select></td>\n"
		. "\t</tr>\n";

		$editquestion .= "\t<tr id='Validation'>\n"
		. "\t\t<td align='right'>$setfont<strong>"._("Validation:")."</strong></font></td>\n"
		. "\t\t<td>$setfont\n"
		. "\t\t<input type='text' name='preg' size=50 value=\"".$eqrow['preg']."\">\n"
		. "\t\t</font></td>\n"
		. "\t</tr>\n";

		$editquestion .= "\t<tr id='LabelSets' style='display: none'>\n"
		. "\t\t<td align='right'>$setfont<strong>"._("Label Set:")."</strong></font></td>\n"
		. "\t\t<td>$setfont\n"
		. "\t\t<select name='lid' >\n";
		$labelsets=getlabelsets();
		if (count($labelsets)>0)
			{
			if (!$eqrow['lid'])
				{
				$editquestion .= "\t\t\t<option value=''>"._("Please Choose...")."</option>\n";
			}
			foreach ($labelsets as $lb)
				{
				$editquestion .= "\t\t\t<option value='{$lb[0]}'";
				if ($eqrow['lid'] == $lb[0]) {$editquestion .= " selected";}
				$editquestion .= ">{$lb[1]}</option>\n";
				}
			}
		$editquestion .= "\t\t</select>\n"
		. "\t\t</font></td>\n"
		. "\t</tr>\n"
		. "\t<tr>\n"
		. "\t\t<td align='right'>$setfont<strong>"._("Group:")."</strong></font></td>\n"
		. "\t\t<td><select name='gid'>\n"
		. getgrouplist3($eqrow['gid'])
		. "\t\t\t</select></td>\n"
		. "\t</tr>\n";

		$editquestion .= "\t<tr id='OtherSelection' style='display: none'>\n"
		. "\t\t<td align='right'>$setfont<strong>"._("Other:")."</strong></font></td>\n";

		$editquestion .= "\t\t<td>$setfont\n"
		. "\t\t\t"._("Yes")." <input type='radio' name='other' value='Y'";
		if ($eqrow['other'] == "Y") {$editquestion .= " checked";}
		$editquestion .= " />&nbsp;&nbsp;\n"
		. "\t\t\t"._("No")." <input type='radio' name='other' value='N'";
		if ($eqrow['other'] == "N") {$editquestion .= " checked";}
		$editquestion .= " />\n"
		. "\t\t</font></td>\n"
		. "\t</tr>\n";

		$editquestion .= "\t<tr id='MandatorySelection'>\n"
		. "\t\t<td align='right'>$setfont<strong>"._("Mandatory:")."</strong></font></td>\n"
		. "\t\t<td>$setfont\n"
		. "\t\t\t"._("Yes")." <input type='radio' name='mandatory' value='Y'";
		if ($eqrow['mandatory'] == "Y") {$editquestion .= " checked";}
		$editquestion .= " />&nbsp;&nbsp;\n"
		. "\t\t\t"._("No")." <input type='radio' name='mandatory' value='N'";
		if ($eqrow['mandatory'] != "Y") {$editquestion .= " checked";}
		$editquestion .= " />\n"
		. "\t\t</font></td>\n"
		. "\t</tr>\n"
		. "\t<tr>\n"
		. "\t\t<td align='right'>";

		$editquestion .= questionjavascript($eqrow['type'], $qattributes);

		if ($eqrow['type'] == "J" || $eqrow['type'] == "I")
			{
			$editquestion .= "\t<tr>\n"
			. "\t\t<input type='hidden' name='copyanswers' value='Y'>\n"
			. "\t\t<td colspan='2' align='center'><input type='submit' value='"._("Copy Question")."'></td>\n"
			. "\t\t<input type='hidden' name='action' value='copynewquestion'>\n"
			. "\t\t<input type='hidden' name='sid' value='$sid' />\n"
			. "\t\t<input type='hidden' name='oldqid' value='$qid' />\n"
			. "\t\t<input type='hidden' name='gid' value='$gid' />\n"
			. "\t</form></tr>\n"
			. "</table>\n";
			} 
		else
			{

			$editquestion .= "$setfont<strong>"._("Copy Answers?")."</strong></font></td>\n"
			. "\t\t<td>$setfont<input type='checkbox' checked name='copyanswers' value='Y' />"
			. "</font></td>\n"
			. "\t</tr>\n"
			. "\t<tr>\n"
			. "\t\t<td align='right'>$setfont<strong>"._("Copy Attributes?")."</strong></font></td>\n"
			. "\t\t<td>$setfont<input type='checkbox' checked name='copyattributes' value='Y' />"
			. "</font></td>\n"
			. "\t</tr>\n"
			. "\t<tr>\n"
			. "\t\t<td colspan='2' align='center'><input type='submit' value='"._("Copy Question")."'>\n"
			. "\t\t<input type='hidden' name='action' value='copynewquestion'>\n"
			. "\t\t<input type='hidden' name='sid' value='$surveyid' />\n"
			. "\t\t<input type='hidden' name='oldqid' value='$qid' />\n"
			. "\t</td></tr>\n"
			. "</table>\n</form>\n";
			}
		}
	}

if ($action == "editquestion" || $action == "editattribute" || $action == "delattribute" || $action == "addattribute")
	{
	$eqquery = "SELECT * FROM {$dbprefix}questions WHERE sid=$surveyid AND gid=$gid AND qid=$qid";
	$eqresult = db_execute_assoc($eqquery);
	while ($eqrow = $eqresult->FetchRow())
		{
		$eqrow  = array_map('htmlspecialchars', $eqrow);
		$editquestion = "<tr><td>\n"
		."<table width='100%' border='0' bgcolor='#EEEEEE'><tr>"
		. "<td colspan='3' bgcolor='black' align='center'>"
		. "\t\t\t$setfont<font color='white'><strong>"._("Edit Question")." $qid</strong></font></font>\n"
		. "\t\t</td>\n"
		. "\t</tr>\n"
		. "\t<tr>\n"
		. "\t\t<td valign='top'><form action='$scriptname' name='editquestion' method='post'><table width='100%' border='0'>\n"
		. "\t<tr>\n"
		. "\t\t<td align='right'>$setfont<strong>"._("Code:")."</strong></font></td>\n"
		. "\t\t<td><input type='text' size='20' name='title' value=\"{$eqrow['title']}\"></td>\n"
		. "\t</tr>\n"
		. "\t<tr>\n"
		. "\t\t<td align='right' valign='top'>$setfont<strong>"._("Question:")."</strong></font></td>\n"
		. "\t\t<td><textarea cols='50' rows='4' name='question'>{$eqrow['question']}</textarea></td>\n"
		. "\t</tr>\n"
		. "\t<tr>\n"
		. "\t\t<td align='right' valign='top'>$setfont<strong>"._("Help:")."</strong></font></td>\n"
		. "\t\t<td><textarea cols='50' rows='4' name='help'>{$eqrow['help']}</textarea></td>\n"
		. "\t</tr>\n";
		//question type:
		$editquestion .= "\t<tr>\n"
		. "\t\t<td align='right'>$setfont<strong>"._("Type:")."</strong></font></td>\n";
		if ($activated != "Y")
			{
			$editquestion .= "\t\t<td><select id='question_type' name='type' "
			. "onchange='OtherSelection(this.options[this.selectedIndex].value);'>\n"
			. getqtypelist($eqrow['type'])
			. "\t\t</select></td>\n";
			}
		else
			{
			$editquestion .= "\t\t<td>{$setfont}[{$eqrow['type']}] - "._("Cannot be modified")." - "._("Survey is currently active.")."\n"
			. "\t\t\t<input type='hidden' name='type' id='question_type' value='{$eqrow['type']}'>\n"
			. "\t\t</font></td>\n";
			}

		$editquestion .= "\t<tr id='Validation'>\n"
		. "\t\t<td align='right'>$setfont<strong>"._("Validation:")."</strong></font></td>\n"
		. "\t\t<td>$setfont\n"
		. "\t\t<input type='text' name='preg' size=50 value=\"".$eqrow['preg']."\">\n"
		. "\t\t</font></td>\n"
		. "\t</tr>\n";

		$editquestion  .="\t<tr id='LabelSets' style='display: none'>\n"
		. "\t\t<td align='right'>$setfont<strong>"._("Label Set:")."</strong></font></td>\n"
		. "\t\t<td>$setfont\n";
		if ($activated != "Y")
			{
			$editquestion .= "\t\t<select name='lid' >\n";
			$labelsets=getlabelsets();
			if (count($labelsets)>0)
				{
				if (!$eqrow['lid'])
					{
					$editquestion .= "\t\t\t<option value=''>"._("Please Choose...")."</option>\n";
					}
				foreach ($labelsets as $lb)
					{
					$editquestion .= "\t\t\t<option value='{$lb[0]}'";
					if ($eqrow['lid'] == $lb[0]) {$editquestion .= " selected";}
					$editquestion .= ">{$lb[1]}</option>\n";
					}
				}
			$editquestion .= "\t\t</select>\n";
			}
		else
			{
			$editquestion .= "[{$eqrow['lid']}] - "._("Cannot be modified")." - "._("Survey is currently active.")."\n"
			. "\t\t\t<input type='hidden' name='lid' value=\"{$eqrow['lid']}\">\n";
			}
		$editquestion .= "\t\t</font></td>\n"
		. "\t</tr>\n"
		. "\t<tr>\n"
		. "\t<td align='right'>$setfont<strong>"._("Group:")."</strong></font></td>\n"
		. "\t\t<td><select name='gid'>\n"
		. getgrouplist3($eqrow['gid'])
		. "\t\t</select></td>\n"
		. "\t</tr>\n";
		$editquestion .= "\t<tr id='OtherSelection'>\n"
		. "\t\t<td align='right'>$setfont<strong>"._("Other:")."</strong></font></td>\n";
		if ($activated != "Y")
			{
			$editquestion .= "\t\t<td>$setfont\n"
			. "\t\t\t<label for='OY'>"._("Yes")."</label><input id='OY' type='radio' name='other' value='Y'";
			if ($eqrow['other'] == "Y") {$editquestion .= " checked";}
			$editquestion .= " />&nbsp;&nbsp;\n"
			. "\t\t\t<label for='ON'>"._("No")."</label><input id='ON' type='radio' name='other' value='N'";
			if ($eqrow['other'] == "N") {$editquestion .= " checked";}
			$editquestion .= " />\n"
			. "\t\t</font></td>\n";
			}
		else
			{
			$editquestion .= "<td>$setfont [{$eqrow['other']}] - "._("Cannot be modified")." - "._("Survey is currently active.")."\n"
			. "\t\t\t<input type='hidden' name='other' value=\"{$eqrow['other']}\"></font></td>\n";
			}
		$editquestion .= "\t</tr>\n";

		$editquestion .= "\t<tr id='MandatorySelection'>\n"
		. "\t\t<td align='right'>$setfont<strong>"._("Mandatory:")."</strong></font></td>\n"
		. "\t\t<td>$setfont\n"
		. "\t\t\t<label for='MY'>"._("Yes")."</label><input id='MY' type='radio' name='mandatory' value='Y'";
		if ($eqrow['mandatory'] == "Y") {$editquestion .= " checked";}
		$editquestion .= " />&nbsp;&nbsp;\n"
		. "\t\t\t<label for='MN'>"._("No")."</label><input id='MN' type='radio' name='mandatory' value='N'";
		if ($eqrow['mandatory'] != "Y") {$editquestion .= " checked";}
		$editquestion .= " />\n"
		. "\t\t</font></td>\n"
		. "\t</tr>\n";
		$qattributes=questionAttributes();

		$editquestion .= "\t<tr>\n"
		. "\t\t<td colspan='2' align='center'>"
		. "<input type='submit' value='"._("Update Question")."'>\n"
		. "\t<input type='hidden' name='action' value='updatequestion'>\n"
		. "\t<input type='hidden' name='sid' value='$surveyid'>\n"
		. "\t<input type='hidden' name='qid' value='$qid'>\n"
		. "\t</td></tr>\n"
		. "</table></form></td><td>\n";
		}

	$qidattributes=getQuestionAttributes($qid);
	$editquestion .= "\t\t\t<td valign='top' width='35%'><table width='100%' border='0' cellspacing='0'>
					   <tr>
					    <td colspan='2' align='center'>
						  <form action='$scriptname' method='post'><table class='outlinetable' cellspacing='0' width='90%'>
						  <tr id='QTattributes'>
						    <th colspan='4'>{$setfont}"._("Question Attributes:")."</font></th>
   					      </tr>
						  <tr><th colspan='4' height='5'></th></tr>
                          <tr>  			  
						  <td nowrap width='50%' ><select id='QTlist' name='attribute_name' >
						  </select></td><td align='center' width='20%'><input type='text' id='QTtext' size='6' name='attribute_value' ></td>
						  <td align='center'><input type='submit' value='"._("Add")."' >
						  <input type='hidden' name='action' value='addattribute'>
						  <input type='hidden' name='sid' value='$surveyid'>
					      <input type='hidden' name='qid' value='$qid'>
					      <input type='hidden' name='gid' value='$gid'></td></tr>
					      <tr><th colspan='4' height='10'></th></tr>\n";
	$editquestion .= "\t\t\t</table></form>\n";
	foreach ($qidattributes as $qa)
		{
		$editquestion .= "\t\t\t<table class='outlinetable' width='90%' border='0' cellspacing='0'>"
		."<tr><td width='85%'>"
		."<form action='$scriptname' method='post'>"
		."<table width='100%'><tr><td width='65%'>"
		.$qa['attribute']."</td>
					   <td align='center' width='25%'><input type='text' name='attribute_value' size='5' value='"
		.$qa['value']."' /></td>
					   <td ><input type='submit' value='"
		._("Save")."' />
					   <input type='hidden' name='action' value='editattribute'>\n
					   <input type='hidden' name='sid' value='$surveyid'>\n
					   <input type='hidden' name='gid' value='$gid'>\n
					   <input type='hidden' name='qid' value='$qid'>\n
					   <input type='hidden' name='qaid' value='".$qa['qaid']."'>\n"
		."\t\t\t</td></tr></table></form></td><td>
					   <form action='$scriptname' method='post'><table width='100%'><tr><td width='5%'>
					   <input type='submit' value='"
		._("Delete")."' />"
		. "\t<input type='hidden' name='action' value='delattribute'>\n"
		. "\t<input type='hidden' name='sid' value='$surveyid'>\n"
		. "\t<input type='hidden' name='qid' value='$qid'>\n"
		. "\t<input type='hidden' name='gid' value='$gid'>\n"
		. "\t<input type='hidden' name='qaid' value='".$qa['qaid']."'>\n"
		. "</td></tr></table>\n"
		. "</form>\n</table>";
		}
	$editquestion .= "</td></tr></table></table>\n";
	$editquestion .= questionjavascript($eqrow['type'], $qattributes);
	}
	
//Constructing the drag and drop interface here...
if($action == "orderquestions")
{
	$oqquery = "SELECT * FROM {$dbprefix}questions WHERE sid=$surveyid AND gid=$gid order by question_order";
	$oqresult = db_execute_assoc($oqquery);
	$orderquestions ="<p align='left'>";
	$orderquestions="<ul id='arrangableNodes'>";
	while($oqrow = $oqresult->FetchRow())
	{
		$oqrow = array_map('htmlspecialchars',$oqrow) ;
		$orderquestions.= "<li id='".$oqrow['qid']."'>".$oqrow['question']."</li>";
	}

	$orderquestions .="</ul>" ;
	$orderquestions .="<a href=\"#\" onclick=\"saveArrangableNodes();return false\" class=\"saveOrderbtn\">&nbsp;"._("Save Order")."&nbsp;</a>";

	$orderquestions .="<div id=\"movableNode\"><ul></ul></div>
			   		   <div id=\"arrDestInditcator\"><img src='".$imagefiles."/insert.gif'></div>
        			   <div id=\"arrDebug\"></div>"; 					 
	//    $orderquestions .="<a href='javascript:testjs()'>test</a>" ;
	$orderquestions .= "<form action='$scriptname' name='orderquestions' method='post'>
						<input type='hidden' name='hiddenNodeIds'>
						<input type='hidden' name='action' value='reorderquestions'> 
						<input type='hidden' name='gid' value='$gid'>
						<input type='hidden' name='sid' value='$surveyid'>
						</form>" ; 
	$orderquestions .="</p>" ;

}

if ($action == "addgroup")
{
	if($sumrows5['define_questions'])
		{

		$newgroup = "<tr><td><form action='$scriptname' name='addnewgroup' method='post'><table width='100%' border='0'>\n\t<tr><td colspan='2' bgcolor='black' align='center'>\n"
		. "\t\t<strong>$setfont<font color='white'>"._("Add Group")."</font></font></strong></td></tr>\n"
		. "\t<tr>\n"
		. "\t\t<td align='right'>$setfont<strong>"._("Title:")."</strong></font></td>\n"
		. "\t\t<td><input type='text' size='50' name='group_name'><font color='red' face='verdana' size='1'>"._("Required")."</font></td></tr>\n"
		. "\t<tr><td align='right'>$setfont<strong>"._("Description:")."</strong>("._("Optional").")</font></td>\n"
		. "\t\t<td><textarea cols='50' rows='4' name='description'></textarea></td></tr>\n"
		. "\t<tr><td colspan='2' align='center'><input type='submit' value='"._("Add Group")."'>\n"
		. "\t<input type='hidden' name='action' value='insertnewgroup'>\n"
		. "\t<input type='hidden' name='sid' value='$surveyid'>\n"
		. "\t</td></table>\n"
		. "</form></td></tr>\n"
		. "<tr><td align='center'>$setfont<strong>"._("OR")."</strong></font></td></tr>\n"
		. "<tr><td><form enctype='multipart/form-data' name='importgroup' action='$scriptname' method='post' onsubmit=\"return validatefilename(this);\">"
		. "<table width='100%' border='0'>\n\t<tr><td colspan='2' bgcolor='black' align='center'>\n"
		. "\t\t<strong>$setfont<font color='white'>"._("Import Group")."</font></font></strong></td></tr>\n\t<tr>"
		. "\t\n"
		. "\t\t<td align='right'>$setfont<strong>"._("Select SQL File:")."</strong></font></td>\n"
		. "\t\t<td><input name=\"the_file\" type=\"file\" size=\"35\"></td></tr>\n"
		. "\t<tr><td colspan='2' align='center'><input type='submit' value='"._("Import Group")."'>\n"
		. "\t<input type='hidden' name='action' value='importgroup'>\n"
		. "\t<input type='hidden' name='sid' value='$surveyid'>\n"
		. "\t</td></tr>\n</table></form>\n";
	
		}
	else
		{
		include("access_denied.php");
		}
}

if ($action == "editgroup")
{
	if($sumrows5['edit_survey_property'])
		{	
		$egquery = "SELECT * FROM {$dbprefix}groups WHERE sid=$surveyid AND gid=$gid";
		$egresult = db_execute_assoc($egquery);
		while ($esrow = $egresult->FetchRow())
			{
			$esrow = array_map('htmlspecialchars', $esrow);
			$editgroup =  "<form action='$scriptname' name='editgroup' method='post'>"
			. "<table width='100%' border='0'>\n\t<tr><td colspan='2' bgcolor='black' align='center'>\n"
			. "\t\t<strong>$setfont<font color='white'>"._("Edit Group for Survey ID")."($surveyid)</font></font></strong></td></tr>\n"
			. "\t<tr>\n"
			. "\t\t<td align='right' width='20%'>$setfont<strong>"._("Title:")."</strong></font></td>\n"
			. "\t\t<td><input type='text' size='50' name='group_name' value=\"{$esrow['group_name']}\"></td></tr>\n"
			. "\t<tr><td align='right'>$setfont<strong>"._("Description:")."</strong>(optional)</font></td>\n"
			. "\t\t<td><textarea cols='50' rows='4' name='description'>{$esrow['description']}</textarea></td></tr>\n"
			. "\t<tr><td colspan='2' align='center'><input type='submit' value='"._("Update Group")."'>\n"
			. "\t<input type='hidden' name='action' value='updategroup'>\n"
			. "\t<input type='hidden' name='sid' value='$surveyid'>\n"
			. "\t<input type='hidden' name='gid' value='$gid'>\n"
			. "\t</td></tr>\n"
			. "</table>\n"
			. "\t</form>\n";
			}
		}
	else
		{
		include("access_denied.php");
		}
}

if($action == "addusertogroup")
	{
	$addsummary = "<br /><strong>"._("Add User")."</strong><br />\n";
		
	$query = "SELECT ugid, creator_id FROM ".db_table_name('user_groups')." WHERE ugid = ".$_GET['ugid']." AND creator_id = ".$_SESSION['loginID']." AND creator_id != ".$_POST['uid'];
	$result = db_execute_assoc($query);
	if($result->RecordCount() > 0)
		{
		if($_POST['uid'] > 0)
			{		
			$isrquery = "INSERT INTO {$dbprefix}user_in_groups VALUES(".$_GET['ugid'].",". $_POST['uid'].")";
			$isrresult = $connect->Execute($isrquery);
			
			if($isrresult)
				{
				$addsummary .= "<br />"._("User added.")."<br />\n";
				}
			else
				{
				// Username already exists.
				$addsummary .= "<br /><strong>"._("Failed to add User.")."</strong><br />\n" . " " . _("Username already exists.")."<br />\n";		
				}
			$addsummary .= "<br /><a href='$scriptname?action=editusergroups&amp;ugid=".$_GET['ugid']."'>"._("Continue")."</a><br />&nbsp;\n";
		}
		else
			{
				$addsummary .= "<br /><strong>"._("Failed to add User.")."</strong><br />\n" . " " . _("No Username selected.")."<br />\n";		
				$addsummary .= "<br /><a href='$scriptname?action=editusergroups&amp;ugid=".$_GET['ugid']."'>"._("Continue")."</a><br />&nbsp;\n";		
			}
		}
	else
		{			
		include("access_denied.php");
		}	
	}
	
// *************************************************
// Survey Rights End	****************************
// *************************************************

if($action == "addsurveysecurity")
	{
	$addsummary = "<br /><strong>"._("Add User")."</strong><br />\n";
		
	$query = "SELECT sid, creator_id FROM ".db_table_name('surveys')." WHERE sid = {$surveyid} AND creator_id = ".$_SESSION['loginID']." AND creator_id != ".$_POST['uid'];
	$result = db_execute_assoc($query);
	if($result->RecordCount() > 0)
		{		
		if($_POST['uid'] > 0){
		
			$isrquery = "INSERT INTO {$dbprefix}surveys_rights VALUES($surveyid,". $_POST['uid'].",0,0,0,0,0,0)";
			$isrresult = $connect->Execute($isrquery);
			
			if($isrresult)
				{
				$addsummary .= "<br />"._("User added.")."<br />\n";
				}
			else
				{
				// Username already exists.
				$addsummary .= "<br /><strong>"._("Failed to add User.")."</strong><br />\n" . " " . _("Username already exists.")."<br />\n";		
				}
			
	
			$addsummary .= "<br /><form method='post' action='$scriptname?sid={$surveyid}'>"
						 ."<input type='submit' value='"._("Set Survey Rights")."'>"
						 ."<input type='hidden' name='action' value='setsurveysecurity'>"
						 //."<input type='hidden' name='user' value='{$_POST['user']}'>"
						 ."<input type='hidden' name='uid' value='{$_POST['uid']}'>"
						 ."</form>\n";
			$addsummary .= "<br /><a href='$scriptname?action=surveysecurity&sid={$surveyid}'>"._("Continue")."</a><br />&nbsp;\n";
		}
		else
			{
				$addsummary .= "<br /><strong>"._("Failed to add User.")."</strong><br />\n" . " " . _("No Username selected.")."<br />\n";		
				$addsummary .= "<br /><a href='$scriptname?action=surveysecurity&sid={$surveyid}'>"._("Continue")."</a><br />&nbsp;\n";		
			}
		}
	else
		{			
		include("access_denied.php");
		}	
	}
	
if($action == "delsurveysecurity"){
	{	
	$addsummary = "<br /><strong>"._("Deleting User")."</strong><br />\n";
		
	$query = "SELECT sid, creator_id FROM ".db_table_name('surveys')." WHERE sid = {$surveyid} AND creator_id = ".$_SESSION['loginID']." AND creator_id != ".$_POST['uid'];
	$result = db_execute_assoc($query);
	if($result->RecordCount() > 0)
		{
		if (isset($_POST['uid']))
			{
			$dquery="DELETE FROM {$dbprefix}surveys_rights WHERE uid={$_POST['uid']} AND sid={$surveyid}";	//	added by Dennis
			$dresult=$connect->Execute($dquery);
			
			$addsummary .= "<br />"._("Username").": {$_POST['user']}<br />\n";								
			}
		else
			{
			$addsummary .= "<br />"._("Could not delete user. User was not supplied.")."<br />\n";
			}		
		}		
	else
		{			
		include("access_denied.php");
		}
	$addsummary .= "<br /><br /><a href='$scriptname?sid={$surveyid}&action=surveysecurity'>"._("Continue")."</a><br />&nbsp;\n";	
	}
}

if($action == "setsurveysecurity")
	{
	$query = "SELECT sid, creator_id FROM ".db_table_name('surveys')." WHERE sid = {$surveyid} AND creator_id = ".$_SESSION['loginID']." AND creator_id != ".$_POST['uid'];
	$result = db_execute_assoc($query);
	if($result->RecordCount() > 0)
		{		
		$query2 = "SELECT uid, edit_survey_property, define_questions, browse_response, export, delete_survey, activate_survey FROM ".db_table_name('surveys_rights')." WHERE sid = {$surveyid} AND uid = ".$_POST['uid'];
		$result2 = db_execute_assoc($query2);

		if($result2->RecordCount() > 0)
			{			
			$resul2row = $result2->FetchRow();			
			
			$usersummary = "<table width='100%' border='0'>\n\t<tr><td colspan='6' bgcolor='black' align='center'>\n"
						 //. "\t\t<strong>$setfont<font color='white'>"._("Set Survey Rights").": ".$_POST['user']."</td></tr>\n";
						 . "\t\t<strong>$setfont<font color='white'>"._("Set Survey Rights")."</td></tr>\n";
										
			$usersummary .= "\t\t<th align='center'>Edit Survey Property</th>\n"
						  . "\t\t<th align='center'>Define Questions</th>\n"
						  . "\t\t<th align='center'>Browse Response</th>\n"
						  . "\t\t<th align='center'>Export</th>\n"
						  . "\t\t<th align='center'>Delete Survey</th>\n"
						  . "\t\t<th align='center'>Activate Survey</th>\n"
						  . "\t\t<th></th>\n\t</tr>\n"						 
						  . "<form action='$scriptname?sid={$surveyid}' method='post'>\n";
			
			//content
			$usersummary .= "\t\t<td align='center'><input type=\"checkbox\" name=\"edit_survey_property\" value=\"edit_survey_property\"";
			if($resul2row['edit_survey_property']) {
				$usersummary .= " checked ";
			}
			$usersummary .="></td>\n";
			$usersummary .= "\t\t<td align='center'><input type=\"checkbox\" name=\"define_questions\" value=\"define_questions\"";
			if($resul2row['define_questions']) {
				$usersummary .= " checked ";
			}
			$usersummary .="></td>\n";
			$usersummary .= "\t\t<td align='center'><input type=\"checkbox\" name=\"browse_response\" value=\"browse_response\"";
			if($resul2row['browse_response']) {
				$usersummary .= " checked ";
			}
			$usersummary .="></td>\n";
			$usersummary .= "\t\t<td align='center'><input type=\"checkbox\" name=\"export\" value=\"export\"";
			if($resul2row['export']) {
				$usersummary .= " checked ";
			}
			$usersummary .="></td>\n";
			$usersummary .= "\t\t<td align='center'><input type=\"checkbox\" name=\"delete_survey\" value=\"delete_survey\"";
			if($resul2row['delete_survey']) {
				$usersummary .= " checked ";
			}
			$usersummary .="></td>\n";
			$usersummary .= "\t\t<td align='center'><input type=\"checkbox\" name=\"activate_survey\" value=\"activate_survey\"";
			if($resul2row['activate_survey']) {
				$usersummary .= " checked ";
			}
			$usersummary .="></td>\n";

			$usersummary .= "\t\n\t<tr><td colspan='6' align='center'>"
						  ."<input type='submit' value='"._("Save Now")."'>"
						  ."<input type='hidden' name='action' value='surveyrights'>"
						  ."<input type='hidden' name='uid' value='{$_POST['uid']}'></td></tr>"
						  ."</form>"
						  . "</table>\n";
			}
		}
	else
		{
		include("access_denied.php");	
		}
	}

if($action == "surveysecurity")
	{
	$query = "SELECT sid FROM ".db_table_name('surveys')." WHERE sid = {$surveyid} AND creator_id = ".$_SESSION['loginID'];
	$result = db_execute_assoc($query);
	if($result->RecordCount() > 0)
		{
		$query2 = "SELECT a.uid, b.user FROM ".db_table_name('surveys_rights')."AS a INNER JOIN ".db_table_name('users')." AS b ON a.uid = b.uid WHERE a.sid = {$surveyid} AND b.uid != ".$_SESSION['loginID'];
		//$query2 = "SELECT uid FROM ".db_table_name('surveys_rights')." WHERE sid = {$surveyid} AND uid != ".$_SESSION['loginID'];
		$result2 = db_execute_assoc($query2);
		$surveysecurity = "<table width='100%' rules='rows' border='0'>\n\t<tr><td colspan='2' bgcolor='black' align='center'>\n"
						 . "\t\t<strong>$setfont<font color='white'>"._("Survey Security")."</td></tr>\n"
						 . "\t<tr>\n" 
						 . "\t\t<th>$setfont"._("Username")."</th>\n"
						 . "\t\t<th>$setfont"._("Action")."</font></th>\n"
						 . "\t</tr>\n";
		if($result2->RecordCount() > 0)
			{
		//	output users
			while ($resul2row = $result2->FetchRow())
				{
				$surveysecurity .= "\t<tr>\n"
								. "\t<td align='center'>$setfont{$resul2row['user']}</font></td>\n"
								. "\t\t<td align='center'>\n";
						
				$surveysecurity .= "<form method='post' action='$scriptname?sid={$surveyid}'>"
								  ."<input type='submit' value='"._("Delete")."' onClick='return confirm(\""._("Are you sure you want to delete this entry.")."\")'>"
								  ."<input type='hidden' name='action' value='delsurveysecurity'>"
								  ."<input type='hidden' name='user' value='{$resul2row['user']}'>"
								  ."<input type='hidden' name='uid' value='{$resul2row['uid']}'>"
								  ."</form></font>";
								
				$surveysecurity .= "<form method='post' action='$scriptname?sid={$surveyid}'>"
								  ."<input type='submit' value='"._("Set Survey Rights")."'>"
								  ."<input type='hidden' name='action' value='setsurveysecurity'>"
								  ."<input type='hidden' name='user' value='{$resul2row['user']}'>"
								  ."<input type='hidden' name='uid' value='{$resul2row['uid']}'>"
								  ."</form>\n";
				
				$surveysecurity .= "\t\t</td>\n"
								. "\t</tr>\n";								
				}				
			}			
		$surveysecurity .= "\t\t<form action='$scriptname?sid={$surveyid}' method='post'>\n"
						. "\t\t<tr>\n"
						
						. "\t\t\t\t\t<td align='center'>"
	                    . "\t\t\t\t\t<select name='uid' class=\"listboxsurveys\">\n"
	                    //. $surveyuserselect
	                    . getsurveyuserlist()
	                    . "\t\t\t\t\t</select>\n"
	                    . "\t\t\t\t</td>\n"
						
						. "\t\t<td align='center'><input type='submit' value='"._("Add User")."'>"
						. "<input type='hidden' name='action' value='addsurveysecurity'></td></form>\n"
						. "\t</tr>\n"
						. "\t</table>\n";			
		}
	else
		{
		include("access_denied.php");
		}
	}

elseif ($action == "surveyrights")
	{	
	$addsummary = "<br /><strong>"._("Set Survey Rights")."</strong><br />\n";
	
	$query = "SELECT sid, creator_id FROM ".db_table_name('surveys')." WHERE sid = {$surveyid} AND creator_id = ".$_SESSION['loginID']." AND creator_id != ".$_POST['uid'];
	$result = db_execute_assoc($query);
	if($result->RecordCount() > 0)
		{			
		$rights = array();
		
		if(isset($_POST['edit_survey_property']))$rights['edit_survey_property']=1;	else $rights['edit_survey_property']=0;
		if(isset($_POST['define_questions']))$rights['define_questions']=1;			else $rights['define_questions']=0;
		if(isset($_POST['browse_response']))$rights['browse_response']=1;			else $rights['browse_response']=0;
		if(isset($_POST['export']))$rights['export']=1;								else $rights['export']=0;
		if(isset($_POST['delete_survey']))$rights['delete_survey']=1;				else $rights['delete_survey']=0;
		if(isset($_POST['activate_survey']))$rights['activate_survey']=1;			else $rights['activate_survey']=0;
	
		setsurveyrights($_POST['uid'], $rights);
		$addsummary .= "<br />"._("Update survey rights successful.")."<br />\n"; 						
		$addsummary .= "<br /><br /><a href='$scriptname?sid={$surveyid}&action=surveysecurity'>"._("Continue")."</a><br />&nbsp;\n";
		}
	else
		{
		include("access_denied.php");
		}
	}
	// *************************************************
	// Survey Rights End	****************************
	// *************************************************


// Editing the survey
if ($action == "editsurvey")
{
	if($sumrows5['edit_survey_property'])
		{	
		$esquery = "SELECT * FROM {$dbprefix}surveys WHERE sid=$surveyid";
		$esresult = db_execute_assoc($esquery);
		while ($esrow = $esresult->FetchRow())
		{
			$esrow = array_map('htmlspecialchars', $esrow);
			$editsurvey = "<form name='addnewsurvey' action='$scriptname' method='post'>\n<table width='100%' border='0'>\n\t<tr><td colspan='2' bgcolor='black' align='center'>"
			. "\t\t<font class='settingcaption'><font color='white'>"._("Edit Survey")."</font></font></td></tr>\n"
			. "\t<tr>"
			. "\t\t<td align='right' width='25%'><font class='settingcaption'>"._("Title:")."</font></td>\n"
			. "\t\t<td><input type='text' size='50' name='short_title' value=\"{$esrow['short_title']}\"></td></tr>\n"
			. "\t<tr><td align='right' valign='top'><font class='settingcaption'>"._("Description:")."</font></td>\n"
			. "\t\t<td><textarea cols='50' rows='5' name='description'>{$esrow['description']}</textarea></td></tr>\n"
			. "\t<tr><td align='right' valign='top'><font class='settingcaption'>"._("Welcome:")."</font></td>\n"
			. "\t\t<td><textarea cols='50' rows='5' name='welcome'>".str_replace("<br />", "\n", $esrow['welcome'])."</textarea></td></tr>\n"
			. "\t<tr><td align='right'><font class='settingcaption'>"._("Administrator:")."</font></td>\n"
			. "\t\t<td><input type='text' size='50' name='admin' value=\"{$esrow['admin']}\"></td></tr>\n"
			. "\t<tr><td align='right'><font class='settingcaption'>"._("Admin Email:")."</font></td>\n"
			. "\t\t<td><input type='text' size='50' name='adminemail' value=\"{$esrow['adminemail']}\"></td></tr>\n"
			. "\t<tr><td align='right'><font class='settingcaption'>"._("Fax To:")."</font></td>\n"
			. "\t\t<td><input type='text' size='50' name='faxto' value=\"{$esrow['faxto']}\"></td></tr>\n";
			$editsurvey .= "\t<tr><td align='right'><font class='settingcaption'>"._("Format:")."</font></td>\n"
			. "\t\t<td><select name='format'>\n"
			. "\t\t\t<option value='S'";
			if ($esrow['format'] == "S" || !$esrow['format']) {$editsurvey .= " selected";}
			$editsurvey .= ">"._("Question by Question")."</option>\n"
			. "\t\t\t<option value='G'";
			if ($esrow['format'] == "G") {$editsurvey .= " selected";}
			$editsurvey .= ">"._("Group by Group")."</option>\n"
			. "\t\t\t<option value='A'";
			if ($esrow['format'] == "A") {$editsurvey .= " selected";}
			$editsurvey .= ">"._("All in one")."</option>\n"
			. "\t\t</select></td>\n"
			. "\t</tr>\n";
			//TEMPLATES
			$editsurvey .= "\t<tr><td align='right'><font class='settingcaption'>"._("Template:")."</font></td>\n"
			. "\t\t<td><select name='template'>\n";
			foreach (gettemplatelist() as $tname)
			{
				$editsurvey .= "\t\t\t<option value='$tname'";
				if ($esrow['template'] && htmlspecialchars($tname) == $esrow['template']) {$editsurvey .= " selected";}
				elseif (!$esrow['template'] && $tname == "default") {$editsurvey .= " selected";}
				$editsurvey .= ">$tname</option>\n";
			}
			$editsurvey .= "\t\t</select></td>\n"
			. "\t</tr>\n";
			//COOKIES
			$editsurvey .= "\t<tr><td align='right'><font class='settingcaption'>"._("Use Cookies?")."</font></td>\n"
			. "\t\t<td><select name='usecookie'>\n"
			. "\t\t\t<option value='Y'";
			if ($esrow['usecookie'] == "Y") {$editsurvey .= " selected";}
			$editsurvey .= ">"._("Yes")."</option>\n"
			. "\t\t\t<option value='N'";
			if ($esrow['usecookie'] != "Y") {$editsurvey .= " selected";}
			$editsurvey .= ">"._("No")."</option>\n"
			. "\t\t</select></td>\n"
			. "\t</tr>\n";
			//ALLOW SAVES
			$editsurvey .= "\t<tr><td align='right'><font class='settingcaption'>"._("Allow Saves?")."</font></td>\n"
			. "\t\t<td><select name='allowsave'>\n"
			. "\t\t\t<option value='Y'";
			if (!$esrow['allowsave'] || $esrow['allowsave'] == "Y") {$editsurvey .= " selected";}
			$editsurvey .= ">"._("Yes")."</option>\n"
			. "\t\t<option value='N'";
			if ($esrow['allowsave'] == "N") {$editsurvey .= " selected";}
			$editsurvey .= ">"._("No")."</option>\n"
			. "\t\t</select></td>\n"
			. "\t</tr>\n";
			//ALLOW PREV
			$editsurvey .= "\t<tr><td align='right'><font class='settingcaption'>"._("Show [<< Prev] button")."</font></td>\n"
			. "\t\t<td><select name='allowprev'>\n"
			. "\t\t\t<option value='Y'";
			if (!isset($esrow['allowprev']) || !$esrow['allowprev'] || $esrow['allowprev'] == "Y") {$editsurvey .= " selected";}
			$editsurvey .= ">"._("Yes")."</option>\n"
			. "\t\t<option value='N'";
			if (isset($esrow['allowprev']) && $esrow['allowprev'] == "N") {$editsurvey .= " selected";}
			$editsurvey .= ">"._("No")."</option>\n"
			. "\t\t</select></td>\n"
			. "\t</tr>\n";
			//NOTIFICATION
			$editsurvey .= "\t<tr><td align='right'><font class='settingcaption'>"._("Admin Notification:")."</font></td>\n"
			. "\t\t<td><select name='notification'>\n"
			. getNotificationlist($esrow['notification'])
			. "\t\t</select></td>\n"
			. "\t</tr>\n";
			//ANONYMOUS
			$editsurvey .= "\t<tr><td align='right'><font class='settingcaption'>"._("Anonymous?")."</font></td>\n";
			if ($esrow['active'] == "Y")
			{
				$editsurvey .= "\t\t<td>\n\t\t\t<font class='settingcaption'>";
				if ($esrow['private'] == "N") {$editsurvey .= " This survey is not anonymous";}
				else {$editsurvey .= "This survey is anonymous";}
				$editsurvey .= "<font size='1' color='red'>&nbsp;(Cannot be changed)\n"
				. "\t\t</font></font>\n";
				$editsurvey .= "<input type='hidden' name='private' value=\"{$esrow['private']}\"></td>\n";
			}
			else
			{
				$editsurvey .= "\t\t<td><select name='private'>\n"
				. "\t\t\t<option value='Y'";
				if ($esrow['private'] == "Y") {$editsurvey .= " selected";}
				$editsurvey .= ">"._("Yes")."</option>\n"
				. "\t\t\t<option value='N'";
				if ($esrow['private'] != "Y") {$editsurvey .= " selected";}
				$editsurvey .= ">"._("No")."</option>\n"
				. "</select>\n\t\t</td>\n";
			}
			$editsurvey .= "</tr>\n";
			$editsurvey .= "<tr><td align='right'><script type='text/javascript'>\n"
			. "<!--\n"
			. "function fillin(tofield, fromfield)\n"
			. "\t{\n"
			. "\t\tif (confirm(\""._("This will replace the existing text. Continue?")."\")) {\n"
			. "\t\t\tdocument.getElementById(tofield).value = document.getElementById(fromfield).value\n"
			. "\t\t}\n"
			. "\t}\n"
			. "--></script>\n";
			$editsurvey .= "\t<font class='settingcaption'>"._("Invitation Email Subject:")."</font></td>\n"
			. "\t\t<td><input type='text' size='54' name='email_invite_subj' id='email_invite_subj' value=\"{$esrow['email_invite_subj']}\">\n"
			. "\t\t<input type='hidden' name='email_invite_subj_default' id='email_invite_subj_default' value='".html_escape(_("Invitation to participate in survey"))."'>\n"
			. "\t\t<input type='button' value='"._("Use default")."' onClick='javascript: fillin(\"email_invite_subj\",\"email_invite_subj_default\")'>\n"
			. "\t</td></tr>\n";
			$editsurvey .= "\t<tr><td align='right'><font class='settingcaption'>"._("Invitation Email:")."</font></td>\n"
			. "\t\t<td><textarea cols=50 rows=5 name='email_invite' id='email_invite'>{$esrow['email_invite']}</textarea>\n"
			. "\t\t<input type='hidden' name='email_invite_default' id='email_invite_default' value='".html_escape(_("Dear {FIRSTNAME},\n\nYou have been invited to participate in a survey.\n\nThe survey is titled:\n\"{SURVEYNAME}\"\n\n\"{SURVEYDESCRIPTION}\"\n\nTo participate, please click on the link below.\n\nSincerely,\n\n{ADMINNAME} ({ADMINEMAIL})\n\n----------------------------------------------\nClick here to do the survey:\n{SURVEYURL}"))."'>\n"
			. "\t\t<input type='button' value='"._("Use default")."' onClick='javascript: fillin(\"email_invite\",\"email_invite_default\")'>\n"
			. "\t</td></tr>\n";
			$editsurvey .= "\t<tr><td align='right'><font class='settingcaption'>"._("Email Reminder Subject:")."</font></td>\n"
			. "\t\t<td><input type='text' size='54' name='email_remind_subj' id='email_remind_subj' value=\"{$esrow['email_remind_subj']}\">\n"
			. "\t\t<input type='hidden' name='email_remind_subj_default' id='email_remind_subj_default' value='".html_escape(_("Reminder to participate in survey"))."'>\n"
			. "\t\t<input type='button' value='"._("Use default")."' onClick='javascript: fillin(\"email_remind_subj\",\"email_remind_subj_default\")'>\n"
			. "\t</td></tr>\n";
			$editsurvey .= "\t<tr><td align='right'><font class='settingcaption'>"._("Email Reminder:")."</font></td>\n"
			. "\t\t<td><textarea cols=50 rows=5 name='email_remind' id='email_remind'>{$esrow['email_remind']}</textarea>\n"
			. "\t\t<input type='hidden' name='email_remind_default' id='email_remind_default' value='".html_escape(_("Dear {FIRSTNAME},\n\nRecently we invited you to participate in a survey.\n\nWe note that you have not yet completed the survey, and wish to remind you that the survey is still available should you wish to take part.\n\nThe survey is titled:\n\"{SURVEYNAME}\"\n\n\"{SURVEYDESCRIPTION}\"\n\nTo participate, please click on the link below.\n\nSincerely,\n\n{ADMINNAME} ({ADMINEMAIL})\n\n----------------------------------------------\nClick here to do the survey:\n{SURVEYURL}"))."'>\n"
			. "\t\t<input type='button' value='"._("Use default")."' onClick='javascript: fillin(\"email_remind\",\"email_remind_default\")'>\n"
			. "\t</td></tr>\n";
			$editsurvey .= "\t<tr><td align='right'><font class='settingcaption'>"._("Confirmation Email Subject")."</font></td>\n"
			. "\t\t<td><input type='text' size='54' name='email_confirm_subj' id='email_confirm_subj' value=\"{$esrow['email_confirm_subj']}\">\n"
			. "\t\t<input type='hidden' name='email_confirm_subj_default' id='email_confirm_subj_default' value='".html_escape(_("Confirmation of completed survey"))."'>\n"
			. "\t\t<input type='button' value='"._("Use default")."' onClick='javascript: fillin(\"email_confirm_subj\",\"email_confirm_subj_default\")'>\n"
			. "\t</td></tr>\n";
			$editsurvey .= "\t<tr><td align='right'><font class='settingcaption'>"._("Confirmation Email")."</font></td>\n"
			. "\t\t<td><textarea cols=50 rows=5 name='email_confirm' id='email_confirm'>{$esrow['email_confirm']}</textarea>\n"
			. "\t\t<input type='hidden' name='email_confirm_default' id='email_confirm_default' value='".html_escape(_("Dear {FIRSTNAME},\n\nThis email is to confirm that you have completed the survey titled {SURVEYNAME} and your response has been saved. Thank you for participating.\n\nIf you have any further questions about this email, please contact {ADMINNAME} on {ADMINEMAIL}.\n\nSincerely,\n\n{ADMINNAME}"))."'>\n"
			. "\t\t<input type='button' value='"._("Use default")."' onClick='javascript: fillin(\"email_confirm\",\"email_confirm_default\")'>\n"
			. "\t</td></tr>\n";
			$editsurvey .= "\t<tr><td align='right'><font class='settingcaption'>"._("Allow public registration?")."</font></td>\n"
			. "\t\t<td><select name='allowregister'>\n"
			. "\t\t\t<option value='Y'";
			if ($esrow['allowregister'] == "Y") {$editsurvey .= " selected";}
			$editsurvey .= ">"._("Yes")."</option>\n"
			. "\t\t\t<option value='N'";
			if ($esrow['allowregister'] != "Y") {$editsurvey .= " selected";}
			$editsurvey .= ">"._("No")."</option>\n"
			. "\t\t</select></td>\n\t</tr>\n";
			$editsurvey .= "\t<tr><td align='right'><font class='settingcaption'>"._("Public registration Email Subject:")."</font></td>\n"
			. "\t\t<td><input type='text' size='54' name='email_register_subj' id='email_register_subj' value=\"{$esrow['email_register_subj']}\">\n"
			. "\t\t<input type='hidden' name='email_register_subj_default' id='email_register_subj_default' value='".html_escape(_("Survey Registration Confirmation"))."'>\n"
			. "\t\t<input type='button' value='"._("Use default")."' onClick='javascript:  fillin(\"email_register_subj\",\"email_register_subj_default\")'>\n"
			. "\t</td></tr>\n";
			$editsurvey .= "\t<tr><td align='right'><font class='settingcaption'>"._("Public registration Email:")."</font></td>\n"
			. "\t\t<td><textarea cols=50 rows=5 name='email_register' id='email_register'>{$esrow['email_register']}</textarea>\n"
			. "\t\t<input type='hidden' name='email_register_default' id='email_register_default' value='".html_escape(_("Dear {FIRSTNAME},\n\nYou, or someone using your email address, have registered to participate in an online survey titled {SURVEYNAME}.\n\nTo complete this survey, click on the following URL:\n\n{SURVEYURL}\n\nIf you have any questions about this survey, or if you did not register to participate and believe this email is in error, please contact {ADMINNAME} at {ADMINEMAIL}."))."'>\n"
			. "\t\t<input type='button' value='"._("Use default")."' onClick='javascript:  fillin(\"email_register\",\"email_register_default\")'>\n"
			. "\t</td></tr>\n";
			$editsurvey .= "\t<tr><td align='right' valign='top'><font class='settingcaption'>"._("Token Attribute Names:")."</font></td>\n"
			. "\t\t<td><font class='settingcaption'><input type='text' size='25' name='attribute1'"
			. " value=\"{$esrow['attribute1']}\">("._("Attribute 1").")<br />"
			. "<input type='text' size='25' name='attribute2'"
			. " value=\"{$esrow['attribute2']}\">("._("Attribute 2").")</font></td>\n\t</tr>\n";
			$editsurvey .= "\t<tr><td align='right'><font class='settingcaption'>"._("Date Stamp?")."</font></td>\n";
	
			if ($esrow['active'] == "Y")
			{
				$editsurvey .= "\t\t<td>\n\t\t\t<font class='settingcaption'>";
				if ($esrow['datestamp'] != "Y") {$editsurvey .= " Responses will not be date stamped.";}
				else {$editsurvey .= "Responses will be date stamped";}
				$editsurvey .= "<font size='1' color='red'>&nbsp;(Cannot be changed)\n"
				. "\t\t</font></font>\n";
				$editsurvey .= "<input type='hidden' name='datestamp' value=\"{$esrow['datestamp']}\"></td>\n";
			}
			else
			{
				$editsurvey .= "\t\t<td><select name='datestamp'>\n"
				. "\t\t\t<option value='Y'";
				if ($esrow['datestamp'] == "Y") {$editsurvey .= " selected";}
				$editsurvey .= ">"._("Yes")."</option>\n"
				. "\t\t\t<option value='N'";
				if ($esrow['datestamp'] != "Y") {$editsurvey .= " selected";}
				$editsurvey .= ">"._("No")."</option>\n"
				. "</select>\n\t\t</td>\n";
			}
			$editsurvey .= "</tr>\n";
	
			$editsurvey .= "\t<tr><td align='right'><font class='settingcaption'>"._("Save IP Address?")."</font></td>\n";
	
			if ($esrow['active'] == "Y")
			{
				$editsurvey .= "\t\t<td>\n\t\t\t<font class='settingcaption'>";
				if ($esrow['ipaddr'] != "Y") {$editsurvey .= " Responses will not have the IP address logged.";}
				else {$editsurvey .= "Responses will have the IP address logged";}
				$editsurvey .= "<font size='1' color='red'>&nbsp;(Cannot be changed)\n"
				. "\t\t</font></font>\n";
				$editsurvey .= "<input type='hidden' name='ipaddr' value='".$esrow['ipaddr']."'>\n</td>";
			}
			else
			{
				$editsurvey .= "\t\t<td><select name='ipaddr'>\n"
				. "\t\t\t<option value='Y'";
				if ($esrow['ipaddr'] == "Y") {$editsurvey .= " selected";}
				$editsurvey .= ">"._("Yes")."</option>\n"
				. "\t\t\t<option value='N'";
				if ($esrow['ipaddr'] != "Y") {$editsurvey .= " selected";}
				$editsurvey .= ">"._("No")."</option>\n"
				. "</select>\n\t\t</td>\n";
			}
	
			// begin REF URL Block
			$editsurvey .= "\t<tr><td align='right'><font class='settingcaption'>"._("Save Referring URL?")."</font></td>\n";
	
			if ($esrow['active'] == "Y")
			{
				$editsurvey .= "\t\t<td>\n\t\t\t<font class='settingcaption'>";
				if ($esrow['refurl'] != "Y") {$editsurvey .= " Responses will not have their referring URL logged.";}
				else {$editsurvey .= "Responses will have their referring URL logged.";}
				$editsurvey .= "<font size='1' color='red'>&nbsp;(Cannot be changed)\n"
				. "\t\t</font></font>\n";
				$editsurvey .= "<input type='hidden' name='refurl' value='".$esrow['refurl']."'>\n</td>";
			}
			else
			{
				$editsurvey .= "\t\t<td><select name='refurl'>\n"
				. "\t\t\t<option value='Y'";
				if ($esrow['refurl'] == "Y") {$editsurvey .= " selected";}
				$editsurvey .= ">"._("Yes")."</option>\n"
				. "\t\t\t<option value='N'";
				if ($esrow['refurl'] != "Y") {$editsurvey .= " selected";}
				$editsurvey .= ">"._("No")."</option>\n"
				. "</select>\n\t\t</td>\n";
			}
			// BENBUN - END REF URL Block
			$editsurvey .= "\t<tr><td align='right'><font class='settingcaption'>"._("Language:")."</font></td>\n"
			. "\t\t<td><select name='language'>\n";
	
	
			// First check what languages are available - if the one set in db is not available leave found as false
			$found=false;
			foreach (getLanguageData() as  $langkey2=>$langname)
			{
				if ($esrow['language'] && $esrow['language'] == htmlspecialchars($langkey2))       {   $found=true;   }
			}
	
			foreach (getLanguageData() as  $langkey2=>$langname)
			{
				$editsurvey .= "\t\t\t<option value='".$langkey2."'";
				if ($found && $esrow['language'] && $esrow['language'] == $langkey2)
				{
					$editsurvey .= " selected";
				}
				// if language has been renamed then default to DefaultLanguage
				elseif (!$found && $langkey2='en')
				{
					{$editsurvey .= " selected";}
				}
				$editsurvey .= ">".$langname['description']." - ".$langname['nativedescription']."</option>\n";
			}
	
			$editsurvey .= "\t\t</select></td>\n"
			. "\t</tr>\n"
			. "\t<tr><td align='right'><font class='settingcaption'>"._("Expires?")."</font></td>\n"
			. "\t\t\t<td><select name='useexpiry'><option value='Y'";
			if (isset($esrow['useexpiry']) && $esrow['useexpiry'] == "Y") {$editsurvey .= " selected";}
			$editsurvey .= ">"._("Yes")."</option>\n"
			. "\t\t\t<option value='N'";
			if (!isset($esrow['useexpiry']) || $esrow['useexpiry'] != "Y") {$editsurvey .= " selected";}
			$editsurvey .= ">"._("No")."</option></select></td></tr><tr><td align='right'><font class='settingcaption'>"._("Expiry Date:")."</font></td>\n"
			. "\t\t<td><input type='text' id='f_date_b' size='12' name='expires' value=\"{$esrow['expires']}\"><button type='reset' id='f_trigger_b'>...</button></td></tr>\n"
			. "\t<tr><td align='right'><font class='settingcaption'>"._("End URL:")."</font></td>\n"
			. "\t\t<td><input type='text' size='50' name='url' value=\"{$esrow['url']}\"></td></tr>\n"
			. "\t<tr><td align='right'><font class='settingcaption'>"._("URL Description:")."</font></td>\n"
			. "\t\t<td><input type='text' size='50' name='urldescrip' value=\"{$esrow['urldescrip']}\"></td></tr>\n"
			. "\t<tr><td align='right'><font class='settingcaption'>"._("Automatically load URL when survey complete?")."</font></td>\n"
			. "\t\t<td><select name='autoredirect'>";
			$editsurvey .= "\t\t\t<option value='Y'";
			if (isset($esrow['autoredirect']) && $esrow['autoredirect'] == "Y") {$editsurvey .= " selected";}
			$editsurvey .= ">"._("Yes")."</option>\n";
			$editsurvey .= "\t\t\t<option value='N'";
			if (!isset($esrow['autoredirect']) || $esrow['autoredirect'] != "Y") {$editsurvey .= " selected";}
			$editsurvey .= ">"._("No")."</option>\n"
			. "</select></td></tr>";
	
			$editsurvey .= "\t<tr><td colspan='2' align='center'><input type='submit' class='standardbtn' value='"._("Update survey")."'>\n"
			. "\t<input type='hidden' name='action' value='updatesurvey'>\n"
			. "\t<input type='hidden' name='sid' value=\"{$esrow['sid']}\">\n"
			. "\t</td></tr>\n"
			. "</table></form>\n";
	
			// Here we do the setup the date javascript
			$editsurvey .= "<script type=\"text/javascript\">\n"
			. "Calendar.setup({\n"
			. "inputField     :    \"f_date_b\",\n"     // id of the input field
			. "ifFormat       :    \"%Y-%m-%d\",\n"     // format of the input field
			. "showsTime      :    false,\n"            // will display a time selector
			. "button         :    \"f_trigger_b\",\n"  // trigger for the calendar (button ID)
			. "singleClick    :    true,\n"             // double-click mode
			. "step           :    1\n"                 // show all years in drop-down boxes (instead of every other year as default)
			. "});\n"
			. "</script>\n";
		}
		
		}
	else
		{
		include("access_denied.php");
		}
		
}
if ($action == "ordergroups")
{
	if($sumrows5['edit_survey_property'])
		{		
		$ordergroups = "<ul id='arrangableNodes'>";
		//Get the groups from this survey
		$ogquery = "SELECT * FROM {$dbprefix}groups WHERE sid=$surveyid order by group_order,group_name" ;
		$ogresult = db_execute_assoc($ogquery) or die($connect->ErrorMsg());
		while($ogrows = $ogresult->FetchRow())
		{
			$ordergroups.="<li id='".$ogrows['gid']."'>".$ogrows['group_name']."</li>\n" ;
		}
		$ordergroups.="</ul>" ;
	
		$ordergroups .="<a href=\"#\" onclick=\"saveArrangableNodes();return false\" class=\"saveOrderbtn\">&nbsp;"._("Save Order")."&nbsp;</a>" ;
		$ordergroups .="<div id=\"movableNode\"><ul></ul></div>
						   <div id=\"arrDestInditcator\"><img src='".$imagefiles."/insert.gif'></div>
						   <div id=\"arrDebug\"></div>" ; 					 
		//    $orderquestions .="<a href='javascript:testjs()'>test</a>" ;
		$ordergroups .= "<form action='$scriptname' name='ordergroups' method='post'>
							<input type='hidden' name='hiddenNodeIds'>
							<input type='hidden' name='action' value='reordergroups'> 
							<input type='hidden' name='sid' value='$surveyid'>
							</form>" ; 
		$ordergroups .="</p>" ;
		}
	else
		{
		include("access_denied.php");
		}
}
if ($action == "uploadf")
{
	if (!isset($tempdir))
	{
		$the_path = $homedir;
	}
	else
	{
		$the_path = $tempdir;
	}
	$the_file_name = $_FILES['the_file']['name'];
	$the_file = $_FILES['the_file']['tmp_name'];
	$the_full_file_path = $the_path."/".$the_file_name;
	switch($_FILES['the_file']['error'])
	{
		case UPLOAD_ERR_INI_SIZE:
		upload();
		$editcsv .="<b><font color='red'>"._("Error").":</font> "._("The uploaded file is bigger than the upload_max_filesize directive in php.ini")."</b>\n";
		break;
		case UPLOAD_ERR_PARTIAL:
		upload();
		$editcsv .="<b><font color='red'>"._("Error").":</font> "._("The file was only partially uploaded")."</b>\n";
		break;
		case UPLOAD_ERR_NO_FILE:
		upload();
		$editcsv .="<b><font color='red'>"._("Error").":</font> "._("No file was uploaded")."</b>\n";
		break;
		case UPLOAD_ERR_OK:
		control();
		break;
		default:
		$editcsv .="<b><font color='red'>"._("Error").":</font> "._("Error on file transfer. You must select a CSV file")."</b>\n";
	}
}

if ($action == "newsurvey") // && isset($_SESSION['loginID']))	wird durch das Recht abgefangen
	{
	if($_SESSION['USER_RIGHT_CREATE_SURVEY'])
		{
		
		$newsurvey  = "<form name='addnewsurvey' action='$scriptname' method='post'>\n<table width='100%' border='0'>\n\t<tr><td colspan='2' bgcolor='black' align='center'>\n"
		. "\t\t<font class='settingcaption'><font color='white'>"._("Create Survey")."</font></font></td></tr>\n"
		. "\t<tr>\n"
		. "\t\t<td align='right' width='25%'><font class='settingcaption'>"._("Title:")."</font></td>\n"
		. "\t\t<td><input type='text' size='50' name='short_title'></td></tr>\n"
		. "\t<tr><td align='right'><font class='settingcaption'>"._("Description:")."</font>	</td>\n"
		. "\t\t<td><textarea cols='50' rows='5' name='description'></textarea></td></tr>\n"
		. "\t<tr><td align='right'><font class='settingcaption'>"._("Welcome:")."</font></td>\n"
		. "\t\t<td><textarea cols='50' rows='5' name='welcome'></textarea></td></tr>\n"
		. "\t<tr><td align='right'><font class='settingcaption'>"._("Administrator:")."</font></td>\n"
		. "\t\t<td><input type='text' size='50' name='admin'></td></tr>\n"
		. "\t<tr><td align='right'><font class='settingcaption'>"._("Admin Email:")."</font></td>\n"
		. "\t\t<td><input type='text' size='50' name='adminemail'></td></tr>\n";
		$newsurvey .= "\t<tr><td align='right'><font class='settingcaption'>"._("Fax To:")."</font></td>\n"
		. "\t\t<td><input type='text' size='50' name='faxto'></td></tr>\n";
		$newsurvey .= "\t<tr><td align='right'><font class='settingcaption'>"._("Format:")."</font></td>\n"
		. "\t\t<td><select name='format'>\n"
		. "\t\t\t<option value='S' selected>"._("Question by Question")."</option>\n"
		. "\t\t\t<option value='G'>"._("Group by Group")."</option>\n"
		. "\t\t\t<option value='A'>"._("All in one")."</option>\n"
		. "\t\t</select></td>\n"
		. "\t</tr>\n";
		$newsurvey .= "\t<tr><td align='right'><font class='settingcaption'>"._("Template:")."</font></td>\n"
		. "\t\t<td><select name='template'>\n";
		foreach (gettemplatelist() as $tname)
		{
			$newsurvey .= "\t\t\t<option value='$tname'";
			if (isset($esrow) && $esrow['template'] && $tname == $esrow['template']) {$newsurvey .= " selected";}
			elseif ((!isset($esrow) || !$esrow['template']) && $tname == "default") {$newsurvey .= " selected";}
			$newsurvey .= ">$tname</option>\n";
		}
		$newsurvey .= "\t\t</select></td>\n"
		. "\t</tr>\n";
		//COOKIES
		$newsurvey .= "\t<tr><td align='right'><font class='settingcaption'>"._("Use Cookies?")."</font></td>\n"
		. "\t\t<td><select name='usecookie'>\n"
		. "\t\t\t<option value='Y'";
		if (isset($esrow) && $esrow['usecookie'] == "Y") {$newsurvey .= " selected";}
		$newsurvey .= ">"._("Yes")."</option>\n"
		. "\t\t\t<option value='N'";
		if (isset($esrow) && $esrow['usecookie'] != "Y" || !isset($esrow)) {$newsurvey .= " selected";}
		$newsurvey .= ">"._("No")."</option>\n"
		. "\t\t</select></td>\n"
		. "\t</tr>\n";
		//ALLOW SAVES
		$newsurvey .= "\t<tr><td align='right'><font class='settingcaption'>"._("Allow Saves?")."</font></td>\n"
		. "\t\t<td><select name='allowsave'>\n"
		. "\t\t\t<option value='Y'";
		if (!isset($esrow['allowsave']) || !$esrow['allowsave'] || $esrow['allowsave'] == "Y") {$newsurvey .= " selected";}
		$newsurvey .= ">"._("Yes")."</option>\n"
		. "\t\t<option value='N'";
		if (isset($esrow['allowsave']) && $esrow['allowsave'] == "N") {$newsurvey .= " selected";}
		$newsurvey .= ">"._("No")."</option>\n"
		. "\t\t</select></td>\n"
		. "\t</tr>\n";
		//ALLOW PREV
		$newsurvey .= "\t<tr><td align='right'><font class='settingcaption'>"._("Show [<< Prev] button")."</font></td>\n"
		. "\t\t<td><select name='allowprev'>\n"
		. "\t\t\t<option value='Y'";
		if (!isset($esrow['allowprev']) || !$esrow['allowprev'] || $esrow['allowprev'] == "Y") {$newsurvey .= " selected";}
		$newsurvey .= ">"._("Yes")."</option>\n"
		. "\t\t<option value='N'";
		if (isset($esrow['allowprev']) && $esrow['allowprev'] == "N") {$newsurvey .= " selected";}
		$newsurvey .= ">"._("No")."</option>\n"
		. "\t\t</select></td>\n"
		. "\t</tr>\n";
		//NOTIFICATIONS
		$newsurvey .= "\t<tr><td align='right'><font class='settingcaption'>"._("Admin Notification:")."</font></td>\n"
		. "\t\t<td><select name='notification'>\n"
		. getNotificationlist(0)
		. "\t\t</select></td>\n"
		. "\t</tr>\n";
		$newsurvey .= "\t<tr><td align='right'><font class='settingcaption'>"._("Anonymous?")."</font></td>\n"
		. "\t\t<td><select name='private'>\n"
		. "\t\t\t<option value='Y' selected>"._("Yes")."</option>\n"
		. "\t\t\t<option value='N'>"._("No")."</option>\n"
		. "\t\t</select></td>\n\t</tr>\n";
		$newsurvey .= "\t<tr><td align='right'><font class='settingcaption'>"._("Invitation Email Subject:")."</font></td>\n"
		. "\t\t<td><input type='text' size='54' name='email_invite_subj' value='".html_escape(_("Invitation to participate in survey"))."'>\n"
		. "\t</td></tr>\n";
		$newsurvey .= "\t<tr><td align='right'><font class='settingcaption'>"._("Invitation Email:")."</font></td>\n"
		. "\t\t<td><textarea cols=50 rows=5 name='email_invite'>"._("Dear {FIRSTNAME},\n\nYou have been invited to participate in a survey.\n\nThe survey is titled:\n\"{SURVEYNAME}\"\n\n\"{SURVEYDESCRIPTION}\"\n\nTo participate, please click on the link below.\n\nSincerely,\n\n{ADMINNAME} ({ADMINEMAIL})\n\n----------------------------------------------\nClick here to do the survey:\n{SURVEYURL}")."</textarea>\n"
		. "\t</td></tr>\n";
		$newsurvey .= "\t<tr><td align='right'><font class='settingcaption'>"._("Email Reminder Subject:")."</font></td>\n"
		. "\t\t<td><input type='text' size='54' name='email_remind_subj' value='".html_escape(_("Reminder to participate in survey"))."'>\n"
		. "\t</td></tr>\n";
		$newsurvey .= "\t<tr><td align='right'><font class='settingcaption'>"._("Email Reminder:")."</font></td>\n"
		. "\t\t<td><textarea cols=50 rows=5 name='email_remind'>"._("Dear {FIRSTNAME},\n\nRecently we invited you to participate in a survey.\n\nWe note that you have not yet completed the survey, and wish to remind you that the survey is still available should you wish to take part.\n\nThe survey is titled:\n\"{SURVEYNAME}\"\n\n\"{SURVEYDESCRIPTION}\"\n\nTo participate, please click on the link below.\n\nSincerely,\n\n{ADMINNAME} ({ADMINEMAIL})\n\n----------------------------------------------\nClick here to do the survey:\n{SURVEYURL}")."</textarea>\n"
		. "\t</td></tr>\n";
		$newsurvey .= "\t<tr><td align='right'><font class='settingcaption'>"._("Confirmation Email Subject")."</font></td>\n"
		. "\t\t<td><input type='text' size='54' name='email_confirm_subj' value='".html_escape(_("Confirmation of completed survey"))."'>\n"
		. "\t</td></tr>\n";
		$newsurvey .= "\t<tr><td align='right'><font class='settingcaption'>"._("Confirmation Email")."</font></td>\n"
		. "\t\t<td><textarea cols=50 rows=5 name='email_confirm'>"._("Dear {FIRSTNAME},\n\nThis email is to confirm that you have completed the survey titled {SURVEYNAME} and your response has been saved. Thank you for participating.\n\nIf you have any further questions about this email, please contact {ADMINNAME} on {ADMINEMAIL}.\n\nSincerely,\n\n{ADMINNAME}")."</textarea>\n"
		. "\t</td></tr>\n";
		$newsurvey .= "\t<tr><td align='right'><font class='settingcaption'>"._("Allow public registration?")."</font></td>\n"
		. "\t\t<td><select name='allowregister'>\n"
		. "\t\t\t<option value='Y'>"._("Yes")."</option>\n"
		. "\t\t\t<option value='N' selected>"._("No")."</option>\n"
		. "\t\t</select></td>\n\t</tr>\n";
		$newsurvey .= "\t<tr><td align='right'><font class='settingcaption'>"._("Public registration Email Subject:")."</font></td>\n"
		. "\t\t<td><input type='text' size='54' name='email_register_subj' value='".html_escape(_("Survey Registration Confirmation"))."'>\n"
		. "\t</td></tr>\n";
		$newsurvey .= "\t<tr><td align='right'><font class='settingcaption'>"._("Public registration Email:")."</font></td>\n"
		. "\t\t<td><textarea cols=50 rows=5 name='email_register'>"._("Dear {FIRSTNAME},\n\nYou, or someone using your email address, have registered to participate in an online survey titled {SURVEYNAME}.\n\nTo complete this survey, click on the following URL:\n\n{SURVEYURL}\n\nIf you have any questions about this survey, or if you did not register to participate and believe this email is in error, please contact {ADMINNAME} at {ADMINEMAIL}.")."</textarea>\n"
		. "\t</td></tr>\n";
		$newsurvey .= "\t<tr><td align='right' valign='top'><font class='settingcaption'>"._("Token Attribute Names:")."</font></td>\n"
		. "\t\t<td><font class='settingcaption'><input type='text' size='25' name='attribute1'>("._("Attribute 1").")<br />"
		. "<input type='text' size='25' name='attribute2'>("._("Attribute 2").")</font></td>\n\t</tr>\n";
		$newsurvey .= "\t<tr><td align='right'><font class='settingcaption'>"._("Date Stamp?")."</font></td>\n"
		. "\t\t<td><select name='datestamp'>\n"
		. "\t\t\t<option value='Y'>"._("Yes")."</option>\n"
		. "\t\t\t<option value='N' selected>"._("No")."</option>\n"
		. "\t\t</select></td>\n\t</tr>\n";
		// IP Address
		$newsurvey .= "\t<tr><td align='right'><font class='settingcaption'>"._("Save IP Address?")."</font></td>\n"
		. "\t\t<td><select name='ipaddr'>\n"                                . "\t\t\t<option value='Y'>"._("Yes")."</option>\n"
		. "\t\t\t<option value='N' selected>"._("No")."</option>\n"
		. "\t\t</select></td>\n\t</tr>\n";
		// Referring URL
		$newsurvey .= "\t<tr><td align='right'><font class='settingcaption'>"._("Save Referring URL?")."</font></td>\n"
		. "\t\t<td><select name='refurl'>\n"                                . "\t\t\t<option value='Y'>"._("Yes")."</option>\n"
		. "\t\t\t<option value='N' selected>"._("No")."</option>\n"
		. "\t\t</select></td>\n\t</tr>\n";
		//Survey Language
		$newsurvey .= "\t<tr><td align='right'><font class='settingcaption'>"._("Language:")."</font></td>\n"
		. "\t\t<td><select name='language'>\n";
	
	
		foreach (getLanguageData() as  $langkey2=>$langname)
		{
			$newsurvey .= "\t\t\t<option value='".$langkey2."'";
			if ($defaultlang == $langkey2) {$newsurvey .= " selected";}
			$newsurvey .= ">".$langname['description']." - ".$langname['nativedescription']."</option>\n";
		}
	
		$newsurvey .= "\t\t</select></td>\n"
		. "\t</tr>\n";
		$newsurvey .= "\t<tr><td align='right'><font class='settingcaption'>"._("Expires?")."</font></td>\n"
		. "\t\t\t<td><select name='useexpiry'><option value='Y'>"._("Yes")."</option>\n"
		. "\t\t\t<option value='N' selected>"._("No")."</option></select></td></tr>\n"
		. "<tr><td align='right'><font class='settingcaption'>"._("Expiry Date:")."</font></td>\n"
		. "\t\t<td><input type='text' id='f_date_b' size='12' name='expires' value='"
		. date("Y-m-d")."'><button type='reset' id='f_trigger_b'>...</button>"
		. "<font size='1'> Date Format: YYYY-MM-DD</font></td></tr>\n"
		. "\t<tr><td align='right'><font class='settingcaption'>"._("End URL:")."</font></td>\n"
		. "\t\t<td><input type='text' size='50' name='url' value='http://";
		if (isset($esrow)) {$newsurvey .= $esrow['url'];}
		$newsurvey .= "'></td></tr>\n"
		. "\t<tr><td align='right'><font class='settingcaption'>"._("URL Description:")."</font></td>\n"
		. "\t\t<td><input type='text' size='50' name='urldescrip' value='";
		if (isset($esrow)) {$newsurvey .= $esrow['urldescrip'];}
		$newsurvey .= "'></td></tr>\n"
		. "\t<tr><td align='right'><font class='settingcaption'>"._("Automatically load URL when survey complete?")."</font></td>\n"
		. "\t\t<td><select name='autoredirect'>\n"
		. "\t\t\t<option value='Y'>"._("Yes")."</option>\n"
		. "\t\t\t<option value='N' selected>"._("No")."</option>\n"
		. "</select></td></tr>"
		. "\t<tr><td colspan='2' align='center'><input type='submit' value='"._("Create Survey")."'>\n"
		. "\t<input type='hidden' name='action' value='insertnewsurvey'></td>\n"
		. "\t</tr>\n"
		. "</table></form>\n";
		$newsurvey .= "<center><font class='settingcaption'>"._("OR")."</font></center>\n";
		$newsurvey .= "<form enctype='multipart/form-data' name='importsurvey' action='$scriptname' method='post' onsubmit=\"return validatefilename(this);\">\n"
		. "<table width='100%' border='0'>\n"
		. "<tr><td colspan='2' bgcolor='black' align='center'>\n"
		. "\t\t<font class='settingcaption'><font color='white'>"._("Import Survey")."</font></font></td></tr>\n\t<tr>"
		. "\t\t<td align='right'><font class='settingcaption'>"._("Select SQL File:")."</font></td>\n"
		. "\t\t<td><input name=\"the_file\" type=\"file\" size=\"35\"></td></tr>\n"
		. "\t<tr><td colspan='2' align='center'><input type='submit' value='"._("Import Survey")."'>\n"
		. "\t<input type='hidden' name='action' value='importsurvey'></TD>\n"
		. "\t</tr>\n</table></form>\n";
		// Here we do setup the date javascript
		$newsurvey .= "<script type=\"text/javascript\">\n"
		. "Calendar.setup({\n"
		. "inputField     :    \"f_date_b\",\n"    // id of the input field
		. "ifFormat       :    \"%Y-%m-%d\",\n"   // format of the input field
		. "showsTime      :    false,\n"                    // will display a time selector
		. "button         :    \"f_trigger_b\",\n"         // trigger for the calendar (button ID)
		. "singleClick    :    true,\n"                   // double-click mode
		. "step           :    1\n"                        // show all years in drop-down boxes (instead of every other year as default)
		. "});\n"
		. "</script>\n";	
		}
	else
		{
		include("access_denied.php");
		}
	}

	function replacenewline ($texttoreplace)
	{
		$texttoreplace = str_replace( "\n", '<br />', $texttoreplace);
		//  $texttoreplace = htmlentities( $texttoreplace, ENT_QUOTES, UTF-8);
		$new_str = '';

		for($i = 0; $i < strlen($texttoreplace); $i++) {
			$new_str .= '\x' . dechex(ord(substr($texttoreplace, $i, 1)));
		}

		return $new_str;
	}

	function questionjavascript($type, $qattributes)
	{
		$newquestion = "<script type='text/javascript'>\n"
		. "<!--\n";
		$jc=0;
		$newquestion .= "\t\t\tvar qtypes = new Array();\n";
		$newquestion .= "\t\t\tvar qnames = new Array();\n\n";
		foreach ($qattributes as $key=>$val)
		{
			foreach ($val as $vl)
			{
				$newquestion .= "\t\t\tqtypes[$jc]='".$key."';\n";
				$newquestion .= "\t\t\tqnames[$jc]='".$vl['name']."';\n";
				$jc++;
			}
		}
		$newquestion .= "\t\t\t function buildQTlist(type)
				{
				document.getElementById('QTattributes').style.display='none';
				for (var i=document.getElementById('QTlist').options.length-1; i>=0; i--)
					{
					document.getElementById('QTlist').options[i] = null;
					}
				for (var i=0;i<qtypes.length;i++)
					{
					if (qtypes[i] == type)
						{
						document.getElementById('QTattributes').style.display='';
						document.getElementById('QTlist').options[document.getElementById('QTlist').options.length] = new Option(qnames[i], qnames[i]);
						}
					}
				}";
		$newquestion .="\nfunction OtherSelection(QuestionType)\n"
		. "\t{\n"
		. "if (QuestionType == '') {QuestionType=document.getElementById('question_type').value;}\n"
		. "\tif (QuestionType == 'M' || QuestionType == 'P' || QuestionType == 'L' || QuestionType == '!')\n"
		. "\t\t{\n"
		. "\t\tdocument.getElementById('OtherSelection').style.display = '';\n"
		. "\t\tdocument.getElementById('LabelSets').style.display = 'none';\n"
		. "\t\tdocument.getElementById('Validation').style.display = 'none';\n"
		. "\t\t}\n"
		. "\telse if (QuestionType == 'F' || QuestionType == 'H' || QuestionType == 'W' || QuestionType == 'Z')\n"
		. "\t\t{\n"
		. "\t\tdocument.getElementById('LabelSets').style.display = '';\n"
		. "\t\tdocument.getElementById('OtherSelection').style.display = 'none';\n"
		. "\t\tdocument.getElementById('Validation').style.display = 'none';\n"
		. "\t\t}\n"
		. "\telse if (QuestionType == 'S' || QuestionType == 'T' || QuestionType == 'U' || QuestionType == 'N' || QuestionType=='')\n"
		. "\t\t{\n"
		. "\t\tdocument.getElementById('Validation').style.display = '';\n"
		. "\t\tdocument.getElementById('OtherSelection').style.display ='none';\n"
		. "\t\tdocument.getElementById('ON').checked = true;\n"
		. "\t\tdocument.getElementById('LabelSets').style.display='none';\n"
		. "\t\t}\n"
		. "\telse\n"
		. "\t\t{\n"
		. "\t\tdocument.getElementById('LabelSets').style.display = 'none';\n"
		. "\t\tdocument.getElementById('OtherSelection').style.display = 'none';\n"
		. "\t\tdocument.getElementById('ON').checked = true;\n"
		. "\t\tdocument.getElementById('Validation').style.display = 'none';\n"
		//. "\t\tdocument.addnewquestion.other[1].checked = true;\n"
		. "\t\t}\n"
		. "\tbuildQTlist(QuestionType);\n"
		. "\t}\n"
		. "\tOtherSelection('$type');\n"
		. "-->\n"
		. "</script>\n";

		return $newquestion;
	}


	function upload()
	{
		global $questionsummary, $sid, $qid, $gid;
		$questionsummary .= "\t\t<tr $qshowstyle id='surveydetails37'><td></td><td>"
		. "<font face='verdana' size='1' color='green'>"
		. _("Warning").": ". _("You need to upload the file")." "
		. "\n$setfont<form enctype='multipart/form-data' action='" . $_SERVER['PHP_SELF'] . "' method='post'>\n"
		. "<input type='hidden' name='action' value='uploadf' />\n"
		. "<input type='hidden' name='sid' value='$sid' />\n"
		. "<input type='hidden' name='gid' value='$gid' />\n"
		. "<input type='hidden' name='qid' value='$qid' />\n"
		. "<font face='verdana' size='2' color='green'><b>"
		. _("You must upload a CSV file")."</font><br />\n"
		. "<input type='file' name='the_file' size='35' /><br />\n"
		. "<input type='submit' value='"._("Upload CSV file")."' />\n"
		. "</form></font>\n\n";
	}

	function control()
	{
		global $editcsv, $questionsummary, $sid, $qid, $gid;
		$info = pathinfo($_FILES['the_file']['name']);
		$ext = $info['extension'] ;
		if ($ext != "csv")
		{
			upload();
			$editcsv .="<b><font color='red'>"._("Error").":</font> "._("It is impossible to upload a file other than CSV type")."</b>\n";
			$questionsummary .= "</table>\n";
		}
		else
		{
			copy($_FILES['the_file']['tmp_name'],".\\".$_FILES['the_file']['name']);
			unlink($_FILES['the_file']['tmp_name']);
			$lines = file($_FILES['the_file']['name']);
			$result = count($lines);
			if ($result <= 1)
			{
				upload();
				$editcsv .="<b><font color='red'>"._("Error").":</font> "._("It is impossible to upload an empty file")."</b>\n";
				$questionsummary .= "</table>\n";
			}
			else
			{
				$editcsv  = "<table width='100%' align='center' border='0'>\n"
				. "<tr bgcolor='#555555'><td colspan='2'><font color='white'><b>"
				. _("Uploading CSV file")."</b></td></tr>\n";
				$editcsv .= "<tr><th>$setfont"._("Visualization:")."</font></th><th>$setfont"._("Select the field number you would like to use for your answers:")."</font></th>"
				. "</tr>\n";
				$ricorpv = substr_count($lines[0],";");
				$ricorv = substr_count($lines[0],",");
				if ($ricorpv > $ricorv)
				{
					$vettoreriga = explode(";",$lines[0]);
					$elem = ";";
				}
				else
				{
					$vettoreriga = explode(",",$lines[0]);
					$elem = ",";
				}
				$editcsv .= "<tr><form action='".$scriptname."' method='post'>\n"
				. "<td align = 'center'><select name=\"$K\">\n";
				$band = 0;
				foreach ($lines as $K => $v)
				{
					if ($band == 1)
					{
						$editcsv .= "<option value=$lines[$K]>$lines[$K]</option>\n";
					}
					$band = 1;
				}
				$svettore = implode("^", $lines);
				$editcsv .= "</select></td>\n";
				$svettore = htmlspecialchars($svettore, ENT_QUOTES);
				$editcsv.="<input type='hidden' name='sid' value='$sid'>\n"
				. "\t<input type='hidden' name='gid' value='$gid'>\n"
				. "\t<input type='hidden' name='qid' value='$qid'>\n"
				. "\t<input type='hidden' name='elem' value='$elem'>\n"
				. "\t<input type='hidden' name='svettore' value='".$svettore."'>\n";

				$editcsv.="\t\t\t<td align = 'center'><select name='numcol'>\n";
				$numerocampo = 0;
				foreach ($vettoreriga as $K => $v)
				{
					$numerocampo = $numerocampo + 1;
					$editcsv .= "\t\t<option value=$numerocampo>$numerocampo</option>\n";
				}
				$editcsv .= "</select></td>\n"
				. "\t<input type='hidden' name='filev' value='$fp'>\n"
				. "\t<input type='hidden' name='action' value='insertCSV'>\n"
				. "\t<tr><td align='right'><input type='submit' value='"
				._("Continue")."'></td>\n";
			}
		}
	}

?>
