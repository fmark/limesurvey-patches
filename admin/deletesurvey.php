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
if (isset($_GET['sid'])) {$surveyid = $_GET['sid'];}
if (isset($_GET['ok'])) {$ok = $_GET['ok'];}

require_once("config.php");

sendcacheheaders();                      // HTTP/1.0

echo $htmlheader;

echo "<br />\n";
echo "<table width='350' align='center' style='border: 1px solid #555555' cellpadding='1' cellspacing='0'>\n";
echo "\t<tr bgcolor='#555555'><td colspan='2' height='4'><font size='1' face='verdana' color='white'><b>"._DELETESURVEY."</b></td></tr>\n";
echo "\t<tr height='22' bgcolor='#CCCCCC'><td align='center'>$setfont\n";

if (!isset($surveyid) || !$surveyid)
	{
	echo "<br /><font color='red'><b>"._ERROR."</b></font><br />\n";
	echo _DS_NOSID."<br /><br />\n";
	echo "<input type='submit' $btstyle value='"._GO_ADMIN."' onClick=\"window.open('$scriptname', '_top')\">\n";
	echo "</td></tr></table>\n";
	echo "</body>\n</html>";
	exit;
	}

if (!isset($ok) || !$ok)
	{
	$result = mysql_list_tables($databasename);
	while ($row = mysql_fetch_row($result))
		{
		$tablelist[]=$row[0];
	    }

	echo "<table width='100%' align='center'>\n";
	echo "\t<tr>\n";
	echo "\t\t<td align='center'>$setfont<br />\n";
	echo "\t\t\t<font color='red'><b>"._WARNING."</b></font><br />\n";
	echo "\t\t\t<b>"._DS_DELMESSAGE1." ($surveyid)</b><br /><br />\n";
	echo "\t\t\t"._DS_DELMESSAGE2."<br /><br />\n";
	echo "\t\t\t"._DS_DELMESSAGE3."\n";

	if (in_array("{$dbprefix}survey_$surveyid", $tablelist))
		{
		echo "\t\t\t<br /><br />\n"._DS_SURVEYACTIVE."<br /><br />\n";
		}
	
	if (in_array("{$dbprefix}tokens_$surveyid", $tablelist))
		{
		echo "\t\t\t"._DS_SURVEYTOKENS."<br /><br />\n";
		}

	echo "\t\t</td>\n";
	echo "\t</tr>\n";
	echo "\t<tr>\n";
	echo "\t\t<td align='center'><br />\n";
	echo "\t\t\t<input type='submit' $btstyle style='width:100' value='"._AD_CANCEL."' onClick=\"window.open('admin.php?sid=$surveyid', '_top')\" /><br />\n";
	echo "\t\t\t<input type='submit' $btstyle style='width:100' value='"._DELETE."' onClick=\"window.open('{$_SERVER['PHP_SELF']}?sid=$surveyid&ok=Y','_top')\" />\n";
	echo "\t\t</td>\n";
	echo "\t</tr>\n";
	echo "</table>\n";
	}

else //delete the survey
	{
	$result = mysql_list_tables($databasename);
	while ($row = mysql_fetch_row($result))
		{
		$tablelist[]=$row[0];
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
	
	echo "<table width='100%' align='center'>\n";
	echo "\t<tr>\n";
	echo "\t\t<td align='center'>$setfont<br />\n";
	echo "\t\t\t<b>"._DS_DELETED."<br /><br />\n";
	echo "\t\t\t<input type='submit' $btstyle value='"._GO_ADMIN."' onClick=\"window.open('$scriptname', '_top')\">\n";
	echo "\t\t</td>\n";
	echo "\t</tr>\n";
	echo "</table>\n";
	}
echo "</td></tr></table>\n";
echo "</body>\n</html>";

?>