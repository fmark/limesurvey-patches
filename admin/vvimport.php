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

require_once("config.php");

if (!isset($sid)) {$sid=returnglobal('sid');}
if (!isset($action)) {$action=returnglobal('action');}
if (!isset($noid)) {$noid=returnglobal('noid');}

if ($action != "upload") 
	{
    //PRESENT FORM
	echo $htmlheader;
	
	//Make sure that the survey is active
	$result = mysql_list_tables($databasename);
	while ($row = mysql_fetch_row($result))
		{
		$tablelist[]=$row[0];
	    }
	if (in_array("survey_$sid", $tablelist))
		{
		echo "<br /><table class='outlinetable' align='center'>
		<form enctype='multipart/form-data' method='post'>
		<tr><th colspan=2>"._VV_IMPORTFILE."</th></tr>
		<tr><td>"._VV_FILE."</td><td><input type='file' name='the_file'></td></tr>
		<tr><td>"._VV_SURVEYID."</td><td><input type='text' size=2 name='sid' value='$sid' readonly></td></tr>
		<tr><td>"._VV_EXCLUDEID."</td><td><input type='checkbox' name='noid' value='noid' checked></td></tr>
		<tr><td>&nbsp;</td><td><input type='submit' value='"._TP_UPLOADFILE."'></td></tr>
		<input type='hidden' name='action' value='upload'>
		</form>
		</table>";
		}
	else
		{
		echo "<br /><table class='outlinetable' align='center'>
		<tr><th colspan=2>Import a VV survey file</th></tr>
		<tr><td colspan='2' align='center'>
		<b>Cannot import</b><br /><br />
		This survey is not active. You must activate the survey before attempting to import a VVexport file.<br /><br />
		[<a href='$scriptname?sid=4'>"._B_ADMIN_BT."</a>]
		</td></tr>
		</table>";		
		}
	

	}
else
	{
	echo $htmlheader;
	echo "<br /><table class='outlinetable' align='center'>
		<tr><th>Upload</th></tr>
		<tr><td align='center'>";
	$the_full_file_path = $tempdir . "/" . $_FILES['the_file']['name'];
	
	if (!@move_uploaded_file($_FILES['the_file']['tmp_name'], $the_full_file_path))
		{
		echo "<b><font color='red'>"._ERROR."</font></b><br />\n";
		echo _IS_FAILUPLOAD."<br /><br />\n";
		//echo "<input $btstyle type='submit' value='"._GO_ADMIN."' onClick=\"window.open('$scriptname', '_top')\">\n";
		echo "</font></td></tr></table>\n";
		echo "</body>\n</html>\n";
		exit;
		}
	// IF WE GOT THIS FAR, THEN THE FILE HAS BEEN UPLOADED SUCCESFULLY
	
	echo "<b><font color='green'>"._SUCCESS."</font></b><br />\n";
	echo _IS_OKUPLOAD."<br /><br />\n";
	echo _IS_READFILE."<br />\n";
	$handle = fopen($the_full_file_path, "r");
	while (!feof($handle))
		{
		$buffer = fgets($handle, 20480); //To allow for very long lines (up to 10k)
		$bigarray[] = $buffer;
		}
	fclose($handle);
	
	$surveytable = "survey_$sid";
	
	unlink($the_full_file_path); //delete the uploaded file
	unset($bigarray[0]); //delete the first line
	
	$fieldnames=explode("\t", trim($bigarray[1]));
	$fieldcount=count($fieldnames)-1;
	if (trim($fieldnames[$fieldcount]) == "") //Get rid of a blank entry at the end
		{
	    unset($fieldnames[$fieldcount]);
		$fieldcount--;
		}
	if ($noid == "noid") {unset($fieldnames[0]);}

	$fldlist = mysql_list_fields($databasename, $surveytable);
	$columns = mysql_num_fields($fldlist);
	for ($i = 0; $i < $columns; $i++)
		{
		$realfieldnames[] = mysql_field_name($fldlist, $i);
		}
	if ($noid == "noid") {unset($realfieldnames[0]);}
	unset($bigarray[1]); //delete the second line
	
//	echo "<tr><td valign='top'><b>Import Fields:<pre>"; print_r($fieldnames); echo "</pre></td>";
//	echo "<td valign='top'><b>Actual Fields:<pre>"; print_r($realfieldnames); echo '</pre></td></tr>';
	
	//See if any fields in the import file don't exist in the active survey
	$missing = array_diff($fieldnames, $realfieldnames);
	if (is_array($missing) && count($missing) > 0)	
		{
		foreach ($missing as $key=>$val)
			{
			$donotimport[]=$key;
			unset($fieldnames[$key]);
			}
		}
	$importcount=0;
	$recordcount=0;
	foreach($bigarray as $row)
		{
		if (trim($row) != "")
			{
			$recordcount++;
			$fieldvalues=explode("\t", mysql_escape_string(str_replace("\n", "", $row)), $fieldcount+1);
			if (isset($donotimport)) //remove any fields which no longer exist
				{
				foreach ($donotimport as $not)
					{
				    unset($fieldvalues[$not]);
					}
				}
			if ($noid == "noid") {unset($fieldvalues[0]);}
			$insert = "INSERT INTO $surveytable\n";
			$insert .= "(".implode(", ", $fieldnames).")\n";
			$insert .= "VALUES\n";
			$insert .= "('".implode("', '", $fieldvalues)."')\n";
			
			if (!$result = mysql_query($insert)) 
				{
				echo "<table align='center' class='outlintable'>
				      <tr><td>"._VV_ENTRYFAILED." $recordcount "._VV_BECAUSE." [".mysql_error()."]
					  </td></tr></table>\n";
			    }
			else
				{
				$importcount++;
				}

			}
		}
	
	if ($noid == "noid")
		{
		echo "<br /><i><b><font color='red'>"._VV_DONOTREFRESH."</font></b></i><br /><br />";
		}
	echo _VV_IMPORTNUMBER." ".$importcount."<br /><br />";
	echo "[<a href='browse.php?sid=$sid'>"._BROWSERESPONSES."</a>]";
	echo "</td></tr></table>";
	}
?>