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
// A FILE TO IMPORT A DUMPED SURVEY FILE, AND CREATE A NEW SURVEY

echo "<br />\n"
	."<table width='350' align='center' style='border: 1px solid #555555' cellpadding='1' cellspacing='0'>\n"
	."\t<tr bgcolor='#555555'><td colspan='2' height='4'><font size='1' face='verdana' color='white'><b>"
	._IMPORTQUESTION."</b></td></tr>\n"
	."\t<tr height='22' bgcolor='#CCCCCC'><td align='center'>$setfont\n";

$the_full_file_path = $tempdir . "/" . $_FILES['the_file']['name'];

if (!@move_uploaded_file($_FILES['the_file']['tmp_name'], $the_full_file_path))
	{
	echo "<b><font color='red'>"._ERROR."</font></b><br />\n"
		._IS_FAILUPLOAD."<br /><br />\n"
		."<input $btstyle type='submit' value='"
		._GO_ADMIN."' onClick=\"window.open('$scriptname', '_top')\">\n"
		."</td></tr></table>\n"
		."</body>\n</html>\n";
	exit;
	}

// IF WE GOT THIS FAR, THEN THE FILE HAS BEEN UPLOADED SUCCESFULLY

echo "<b><font color='green'>"._SUCCESS."</font></b><br />\n"
	._IS_OKUPLOAD."<br /><br />\n"
	._IS_READFILE."<br />\n";
$handle = fopen($the_full_file_path, "r");
while (!feof($handle))
	{
	//$buffer = fgets($handle, 1024); //Length parameter is required for PHP versions < 4.2.0
	$buffer = fgets($handle, 10240); //To allow for very long survey welcomes (up to 10k)
	$bigarray[] = $buffer;
	}
fclose($handle);

if (!$_POST['sid'])
	{
	echo _IQ_NOSID."<br /><br />\n"
		."<input $btstyle type='submit' value='"
		._GO_ADMIN."' onClick=\"window.open('$scriptname', '_top')\">\n"
		."</td></tr></table>\n"
		."</body>\n</html>\n";
	exit;
	}
if (!$_POST['gid'])
	{
	echo _IQ_NOGID."<br /><br />\n"
		."<input $btstyle type='submit' value='"
		._GO_ADMIN."' onClick=\"window.open('$scriptname', '_top')\">\n"
		."</td></tr></table>\n"
		."</body>\n</html>\n";
	exit;
	}
if (substr($bigarray[1], 0, 24) != "# SURVEYOR QUESTION DUMP")
	{
	echo "<b><font color='red'>"._ERROR."</font></b><br />\n"
		._IQ_WRONGFILE."<br /><br />\n"
		."<input $btstyle type='submit' value='"
		._GO_ADMIN."' onClick=\"window.open('$scriptname?sid=$sid&gid=$gid', '_top')\">\n"
		."</td></tr></table>\n"
		."</body>\n</html>\n";
	exit;
	}

for ($i=0; $i<9; $i++) //skipping the first lines that are not needed
	{
	unset($bigarray[$i]);
	}
$bigarray = array_values($bigarray);

//QUESTIONS
if (array_search("# ANSWERS TABLE\n", $bigarray))
	{
	$stoppoint = array_search("# ANSWERS TABLE\n", $bigarray);
	}
elseif (array_search("# ANSWERS TABLE\r\n", $bigarray))
	{
	$stoppoint = array_search("# ANSWERS TABLE\r\n", $bigarray);
	}
else
	{
	$stoppoint = count($bigarray)-1;
	}
for ($i=0; $i<=$stoppoint+1; $i++)
	{
	if ($i<$stoppoint-2) {$questionarray[] = $bigarray[$i];}
	unset($bigarray[$i]);
	}
$bigarray = array_values($bigarray);

//ANSWERS
if (array_search("# LABELSETS TABLE\n", $bigarray))
	{
	$stoppoint = array_search("# LABELSETS TABLE\n", $bigarray);
	}
elseif (array_search("# LABELSETS TABLE\r\n", $bigarray))
	{
	$stoppoint = array_search("# LABELSETS TABLE\r\n", $bigarray);
	}
else
	{
	$stoppoint = count($bigarray)-1;
	}
for ($i=0; $i<=$stoppoint+1; $i++)
	{
	if ($i<$stoppoint-2) {$answerarray[] = str_replace("`default`", "`default_value`", $bigarray[$i]);}
	unset($bigarray[$i]);
	}
$bigarray = array_values($bigarray);

//LABELSETS
if (array_search("# LABELS TABLE\n", $bigarray))
	{
	$stoppoint = array_search("# LABELS TABLE\n", $bigarray);
	}
elseif (array_search("# LABELS TABLE\r\n", $bigarray))
	{
	$stoppoint = array_search("# LABELS TABLE\r\n", $bigarray);
	}
else
	{
	$stoppoint = count($bigarray)-1;
	}
for ($i=0; $i<=$stoppoint+1; $i++)
	{
	if ($i<$stoppoint-2) {$labelsetsarray[] = $bigarray[$i];}
	unset($bigarray[$i]);
	}
$bigarray = array_values($bigarray);

//ANSWERS
if (array_search("#</pre>\n", $bigarray))
	{
	$stoppoint = array_search("#</pre>\n", $bigarray);
	}
if (array_search("#</pre>\r\n", $bigarray))
	{
	$stoppoint = array_search("#</pre>\r\n", $bigarray);
	}
else
	{
	$stoppoint = count($bigarray)-1;
	}
for ($i=0; $i<$stoppoint; $i++)
	{
	$labelsarray[] = $bigarray[$i];
	//echo "($i)[$stoppoint]An Answer! - {$bigarray[$i]}<br />";
	unset($bigarray[$i]);
	}
$bigarray = array_values($bigarray);


if (isset($questionarray)) {$countquestions = count($questionarray);}
if (isset($answerarray)) {$countanswers = count($answerarray);}
if (isset($labelsetsarray)) {$countlabelsets = count($labelsetsarray);}
if (isset($labelsarray)) {$countlabels = count($labelsarray);}

// GET SURVEY AND GROUP DETAILS
$sid=$_POST['sid'];
$gid=$_POST['gid'];
$newsid=$sid;
$newgid=$gid;

//DO ANY LABELSETS FIRST, SO WE CAN KNOW WHAT THEY'RE NEW LID IS FOR THE QUESTIONS
if (isset($labelsetsarray) && $labelsetsarray)
	{
	foreach ($labelsetsarray as $lsa)
		{
		$fieldorders=convertToArray($lsa, "`, `", "(`", "`)");
		$fieldcontents=convertToArray($lsa, "', '", "('", "')");

		$oldlidpos=array_search("lid", $fieldorders);
		$oldlid=$fieldcontents[$oldlidpos];
		
		$lsainsert = str_replace("'$oldlid'", "''", $lsa);
		$lsainsert = str_replace("INTO labelsets", "INTO {$dbprefix}labelsets", $lsainsert); //db prefix handler
		$lsiresult=mysql_query($lsainsert);
		
		//GET NEW LID
		$nlidquery="SELECT lid FROM {$dbprefix}labelsets ORDER BY lid DESC LIMIT 1";
		$nlidresult=mysql_query($nlidquery);
		while ($nlidrow=mysql_fetch_array($nlidresult)) {$newlid=$nlidrow['lid'];}
		$labelreplacements[]=array($oldlid, $newlid);
		if ($labelsarray)
			{
			foreach ($labelsarray as $la)
				{
				$lfieldorders=convertToArray($la, "`, `", "(`", "`)");
				$lfieldcontents=convertToArray($la, "', '", "('", "')");
	
				$labellidpos=array_search("lid", $lfieldorders);
				$labellid=$lfieldcontents[$labellidpos];
				if ($labellid == $oldlid)
					{
					$lainsert = str_replace("'$labellid'", "'$newlid'", $la);
					$lainsert = str_replace ("INTO labels", "INTO {$dbprefix}labels", $lainsert);
					$liresult=mysql_query($lainsert);
					}
				}
			}
		}
	}

// QUESTIONS, THEN ANSWERS FOR QUESTIONS IN A NESTED FORMAT!
if (isset($questionarray) && $questionarray)
	{
	foreach ($questionarray as $qa)
		{
		$qafieldorders=convertToArray($qa, "`, `", "(`", "`)");
		$qacfieldcontents=convertToArray($qa, "', '", "('", "')");
		$oldsid=$qacfieldcontents[array_search("sid", $qafieldorders)];
		$oldgid=$qacfieldcontents[array_search("gid", $qafieldorders)];
		$oldqid=$qacfieldcontents[array_search("qid", $qafieldorders)];
		$qinsert=str_replace("'$oldqid'", "''", $qa);
		$qinsert=str_replace("'$oldsid'", "'$sid'", $qinsert);
		$qinsert=str_replace("'$oldgid'", "'$gid'", $qinsert);
		
		$qinsert = str_replace("INTO questions", "INTO {$dbprefix}questions", $qinsert);
		
		$qres = mysql_query($qinsert) or die ("<b>"._ERROR.":</b> Failed to insert question<br />\n$qinsert<br />\n".mysql_error());
		//GET NEW QID, AND WHILE WE'RE AT IT - THE TYPE!
		$qidquery = "SELECT qid, lid, type FROM {$dbprefix}questions ORDER BY qid DESC LIMIT 1";
		$qidres = mysql_query($qidquery);
		while ($qrow = mysql_fetch_row($qidres)) {$newqid = $qrow[0]; $oldlid=$qrow[1]; $type=$qrow[2];}

	
		if ($type == "F" || $type == "H")
			{
			foreach ($labelreplacements as $lrp)
				{
				if ($lrp[0] == $oldlid)
					{
					$lrupdate="UPDATE {$dbprefix}questions SET lid='{$lrp[1]}' WHERE qid=$newqid";
					$lrresult=mysql_query($lrupdate);
					}
				}
			}

		$newrank=0;
		//NOW DO NESTED ANSWERS FOR THIS QID
		if (isset($answerarray) && $answerarray)
			{
			foreach ($answerarray as $aa)
				{
				$aafieldorders=convertToArray($aa, "`, `", "(`", "`)");
				$aacfieldcontents=convertToArray($aa, "', '", "('", "')");
				$code=$aacfieldcontents[array_search("code", $aafieldorders)];
				$thisqid=$aacfieldcontents[array_search("qid", $aafieldorders)];
				if ($thisqid == $oldqid)
					{
					$ainsert = str_replace("('$oldqid", "('$newqid", $aa);
					$ainsert = str_replace("INTO answers", "INTO {$dbprefix}answers", $ainsert);
					//$ainsert = substr(trim($ainsert), 0, -1);
					//echo "$ainsert<br />\n";
					$ares = mysql_query($ainsert) or die ("<b>"._ERROR.":</b> Failed to insert answer<br />\n$ainsert<br />\n".mysql_error()."</body>\n</html>");
					if ($type == "A" || $type == "B" || $type == "C" || $type == "M" || $type == "P")
						{
						$fieldnames[]=array($oldsid."X".$oldgid."X".$oldqid.$code, $newsid."X".$newgid."X".$newqid.$code);
						if ($type == "P")
							{
							$fieldnames[]=array($oldsid."X".$oldgid."X".$oldqid.$code."comment", $newsid."X".$newgid."X".$newqid.$code."comment");
							}
						}
					elseif ($type == "R")
						{
						$newrank++;
						}
					}			
				}
			if (($type == "A" || $type == "B" || $type == "C" || $type == "M" || $type == "P") && ($other == "Y"))
				{
				$fieldnames[]=array($oldsid."X".$oldgid."X".$oldqid."other", $newsid."X".$newgid."X".$newqid."other");
				if ($type == "P")
					{
					$fieldnames[]=array($oldsid."X".$oldgid."X".$oldqid."othercomment", $newsid."X".$newgid."X".$newqid."othercomment");
					}
				}
			if ($type == "R" && $newrank >0)
				{
				for ($i=1; $i<=$newrank; $i++)
					{
					$fieldnames[]=array($oldsid."X".$oldgid."X".$oldqid.$i, $newsid."X".$newgid."X".$newqid.$i);
					}
				}
			if ($type != "A" && $type != "B" && $type != "C" && $type != "R" && $type != "M" && $type != "P")
				{
				$fieldnames[]=array($oldsid."X".$oldgid."X".$oldqid, $newsid."X".$newgid."X".$newqid);
				if ($type == "O")
					{
					$fieldnames[]=array($oldsid."X".$oldgid."X".$oldqid."comment", $newsid."X".$newgid."X".$newqid."comment");
					}
				}
			$substitutions[]=array($oldsid, $oldgid, $oldqid, $newsid, $newgid, $newqid);
			}
		}
	}


//We've built two arrays along the way - one containing the old SID, GID and QIDs - and their NEW equivalents
//and one containing the old 'extended fieldname' and its new equivalent.  These are needed to import conditions.


echo "<br />\n<b><font color='green'>"._SUCCESS."</font></b><br />\n"
	."<b><u>"._IQ_IMPORTSUMMARY."</u></b><br />\n"
	."\t<li>"._QUESTIONS.": ";
if (isset($countquestions)) {echo $countquestions;}
echo "</li>\n"
	."\t<li>"._ANSWERS.": ";
if (isset($countanswers)) {echo $countanswers;}
echo "</li><br />\n"
	."\t<li>"._LABELSETS.": ";
if (isset($countlabelsets)) {echo $countlabelsets;}
echo " (";
if (isset($countlabels)) {echo $countlabels;}
echo ")</li></ul><br />\n";

echo "<b>"._IS_SUCCESS."</b><br />\n"
	."<input $btstyle type='submit' value='"
	._GO_ADMIN."' onClick=\"window.open('$scriptname?sid=$sid&gid=$gid&qid=$newqid', '_top')\">\n"
	."</td></tr></table>\n"
	."</body>\n</html>";
	
unlink($the_full_file_path);

function convertToArray($string, $seperator, $start, $end)
	{
	$begin=strpos($string, $start)+strlen($start);
	$len=strpos($string, $end)-$begin;
	$order=substr($string, $begin, $len);
	$orders=explode($seperator, $order);
	
	return $orders;
	}
?>