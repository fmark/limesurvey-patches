<?php
/*
#############################################################
# >>> PHPSurveyor                                           #
#############################################################
# > Author:  Jason Cleeland                                 #
# > E-mail:  jason@cleeland.org                             #
# > Mail:    Box 99, Trades Hall, 54 Victoria St,           #
# >          CARLTON SOUTH 3053, AUSTRALIA                  #
# > Date:    20 February 2003                               #
#                                                           #
# This set of scripts allows you to develop, publish and    #
# perform data-entry on surveys.                            #
#############################################################
#                                                           #
#   Copyright (C) 2003  Jason Cleeland                      #
#                                                           #
# This program is free software; you can redistribute       #
# it and/or modify it under the terms of the GNU General    #
# Public License as published by the Free Software          #
# Foundation.                                               #
#                                                           #
#                                                           #
# This program is distributed in the hope that it will be   #
# useful, but WITHOUT ANY WARRANTY; without even the        #
# implied warranty of MERCHANTABILITY or FITNESS FOR A      #
# PARTICULAR PURPOSE.  See the GNU General Public License   #
# for more details.                                         #
#                                                           #
# You should have received a copy of the GNU General        #
# Public License along with this program; if not, write to  #
# the Free Software Foundation, Inc., 59 Temple Place -     #
# Suite 330, Boston, MA  02111-1307, USA.                   #
#############################################################
*/
//Exports all responses to a survey in special "Verified Voting" format.


if (!isset($dbprefix)) {die ("Cannot run this script directly");}
include_once("login_check.php");

$sumquery5 = "SELECT b.* FROM {$dbprefix}surveys AS a INNER JOIN {$dbprefix}surveys_rights AS b ON a.sid = b.sid WHERE a.sid=$surveyid AND b.uid = ".$_SESSION['loginID']; //Getting rights for this survey and user
$sumresult5 = db_execute_assoc($sumquery5);
$sumrows5 = $sumresult5->FetchRow();

if ($sumrows5['export'] != "1")
{
	return;
}
if (!$subaction == "export")
{
	$vvoutput = "<br /><form method='post' action='admin.php?action=vvexport&sid=$surveyid'>"
    	."<table align='center' class='outlinetable'>"
        ."<tr><th colspan='2'>".$clang->gT("Export a VV survey file")."</th></tr>"
        ."<tr>"
        ."<td align='right'>".$clang->gT("Export Survey").":</td>"
        ."<td><input type='text' size='10' value='$surveyid' name='sid' readonly='readonly' /></td>"
        ."</tr>"
        ."<tr>"
        ."<td colspan='2' align='center'>"
        ."<input type='submit' value='".$clang->gT("Export Responses")."' />&nbsp;"
        ."<input type='hidden' name='subaction' value='export' />"
        ."</td>"
        ."</tr>"
        ."<tr><td colspan='2' align='center'>[<a href='$scriptname?action=browse&amp;sid=$surveyid'>".$clang->gT("Return to Survey Administration")."</a>]</td></tr>"
        ."</table>";
}
elseif (isset($surveyid) && $surveyid)
{
	//Export is happening
	header("Content-Disposition: attachment; filename=vvexport_$surveyid.csv");
	header("Content-type: text/comma-separated-values; charset=UTF-8");
	Header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	$s="\t";

	$fieldmap=createFieldMap($surveyid, "full");
	$surveytable = "{$dbprefix}survey_$surveyid";

	GetBaseLanguageFromSurveyID($surveyid);

	$fieldnames = array_values($connect->MetaColumnNames($surveytable, true));

	//Create the human friendly first line
	$firstline="";
	$secondline="";
	foreach ($fieldnames as $field)
	{
		$fielddata=arraySearchByKey($field, $fieldmap, "fieldname", 1);
		//$vvoutput .= "<pre>";print_r($fielddata);$vvoutput .= "</pre>";
		if (count($fielddata) < 1) {$firstline.=$field;}
		else
		//{$firstline.=str_replace("\n", " ", str_replace("\t", "   ", strip_tags($fielddata['question'])));}
		{$firstline.=preg_replace('/\s+/',' ',strip_tags($fielddata['question']));}
		$firstline .= $s;
		$secondline .= $field.$s;
	}
	$vvoutput = $firstline."\n";
	$vvoutput .= $secondline."\n";
	$query = "SELECT * FROM $surveytable";
	$result = db_execute_assoc($query) or die("Error:<br />$query<br />".$connect->ErrorMsg());

	while ($row=$result->FetchRow())
	{
		foreach ($fieldnames as $field)
		{
			$value=trim($row[$field]);
			// sunscreen for the value. necessary for the beach.
			// careful about the order of these arrays:
			// lbrace has to be substituted *first*
			$value=str_replace(array("{",
			"\n",
			"\r",
			"\t"),
			array("{lbrace}",
			"{newline}",
			"{cr}",
			"{tab}"),
			$value);
			// one last tweak: excel likes to quote values when it
			// exports as tab-delimited (esp if value contains a comma,
			// oddly enough).  So we're going to encode a leading quote,
			// if it occurs, so that we can tell the difference between
			// strings that "really are" quoted, and those that excel quotes
			// for us.
			$value=preg_replace('/^"/','{quote}',$value);
			// yay!  that nasty sun won't hurt us now!
			$sun[]=$value;
		}
		$beach=implode($s, $sun);
		$vvoutput .= $beach;
		unset($sun);
		$vvoutput .= "\n";
	}

	//$vvoutput .= "<pre>$firstline</pre>";
	//$vvoutput .= "<pre>$secondline</pre>";
	//$vvoutput .= "<pre>"; print_r($fieldnames); $vvoutput .= "</pre>";
	//$vvoutput .= "<pre>"; print_r($fieldmap); $vvoutput .= "</pre>";

}

?>
