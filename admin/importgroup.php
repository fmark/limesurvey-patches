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

echo "<br />\n";
echo "<table width='350' align='center' style='border: 1px solid #555555' cellpadding='1' cellspacing='0'>\n";
echo "\t<tr bgcolor='#555555'><td colspan='2' height='4'><font size='1' face='verdana' color='white'><b>"._IMPORTGROUP."</b></td></tr>\n";
echo "\t<tr height='22' bgcolor='#CCCCCC'><td align='center'>$setfont\n";

$the_full_file_path = $tempdir . "/" . $_FILES['the_file']['name'];

if (!@move_uploaded_file($_FILES['the_file']['tmp_name'], $the_full_file_path))
	{
	echo "<b><font color='red'>"._ERROR."</font></b><br />\n";
	echo _IS_FAILUPLOAD."<br /><br />\n";
	echo "<input $btstyle type='submit' value='"._GO_ADMIN."' onClick=\"window.open('$scriptname', '_top')\">\n";
	echo "</td></tr></table>\n";
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
	//$buffer = fgets($handle, 1024); //Length parameter is required for PHP versions < 4.2.0
	$buffer = fgets($handle, 10240); //To allow for very long survey welcomes (up to 10k)
	$bigarray[] = $buffer;
	}
fclose($handle);

if (substr($bigarray[1], 0, 21) != "# SURVEYOR GROUP DUMP")
	{
	echo "<b><font color='red'>"._ERROR."</font></b><br />\n";
	echo _IG_WRONGFILE."<br /><br />\n";
	echo "<input $btstyle type='submit' value='"._GO_ADMIN."' onClick=\"window.open('$scriptname', '_top')\">\n";
	echo "</td></tr></table>\n";
	echo "</body>\n</html>\n";
	unlink($the_full_file_path);
	exit;
	}

for ($i=0; $i<9; $i++)
	{
	unset($bigarray[$i]);
	}
$bigarray = array_values($bigarray);

//GROUPS
if (array_search("# QUESTIONS TABLE\n", $bigarray))
	{
	$stoppoint = array_search("# QUESTIONS TABLE\n", $bigarray);
	}
elseif (array_search("# QUESTIONS TABLE\r\n", $bigarray))
	{
	$stoppoint = array_search("# QUESTIONS TABLE\r\n", $bigarray);
	}
else
	{
	$stoppoint = count($bigarray)-1;
	}
for ($i=0; $i<=$stoppoint+1; $i++)
	{
	if ($i<$stoppoint-2) {$grouparray[] = $bigarray[$i];}
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
if (array_search("# CONDITIONS TABLE\n", $bigarray))
	{
	$stoppoint = array_search("# CONDITIONS TABLE\n", $bigarray);
	}
elseif (array_search("# CONDITIONS TABLE\r\n", $bigarray))
	{
	$stoppoint = array_search("# CONDITIONS TABLE\r\n", $bigarray);
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

//CONDITIONS
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
	$stoppoint = count($bigarray);
	}
for ($i=0; $i<=$stoppoint+1; $i++)
	{
	if ($i<$stoppoint-2) {$conditionsarray[] = $bigarray[$i];}
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

//LABELS
if (array_search("# QUESTION_ATTRIBUTES TABLE\n", $bigarray))
	{
	$stoppoint = array_search("# QUESTION_ATTRIBUTES TABLE\n", $bigarray);
	}
elseif (array_search("# QUESTION_ATTRIBUTES TABLE\r\n", $bigarray))
	{
	$stoppoint = array_search("# QUESTION_ATTRIBUTES TABLE\r\n", $bigarray);
	}
else
	{
	$stoppoint = count($bigarray)-1;
	}
for ($i=0; $i<=$stoppoint+1; $i++)
	{
	if ($i<$stoppoint-2) {$labelsarray[] = $bigarray[$i];}
	unset($bigarray[$i]);
	}
$bigarray = array_values($bigarray);

//LAST LOT (now question_attributes)
if (!isset($noconditions) || $noconditions != "Y")
	{
	$stoppoint = count($bigarray)-1;
	for ($i=0; $i<=$stoppoint+1; $i++)
		{
		if ($i<$stoppoint-1) {$question_attributesarray[] = $bigarray[$i];}
		unset($bigarray[$i]);
		}
	}
$bigarray = array_values($bigarray);

if (isset($grouparray)) {$countgroups = count($grouparray);}
if (isset($questionarray)) {$countquestions = count($questionarray);}
if (isset($answerarray)) {$countanswers = count($answerarray);}
if (isset($conditionsarray)) {$countconditions = count($conditionsarray);}
if (isset($labelsetsarray)) {$countlabelsets = count($labelsetsarray);}
if (isset($labelsarray)) {$countlabels = count($labelsarray);}
if (isset($question_attributesarray)) {$countquestion_attributes = count($question_attributesarray);} else {$countquestion_attributes=0;}

$newsid = $_POST["sid"];

//DO ANY LABELSETS FIRST, SO WE CAN KNOW WHAT THEY'RE NEW LID IS FOR THE QUESTIONS
if (isset($labelsetsarray) && $labelsetsarray) {
	$csarray=buildLabelsetCSArray();
	foreach ($labelsetsarray as $lsa) {
		$fieldorders=convertToArray($lsa, "`, `", "(`", "`)");
		$fieldcontents=convertToArray($lsa, "', '", "('", "')");
		$newfieldcontents=$fieldcontents;
		$oldlidpos=array_search("lid", $fieldorders);
		$oldlid=$fieldcontents[$oldlidpos];
		
		$newfieldcontents[array_search("lid", $fieldorders)]="";
		$newvalues="('".implode("', '", $newfieldcontents)."')";
		$lsainsert = str_replace("('".implode("', '", $fieldcontents)."')", $newvalues, $lsa);
		//$lsainsert = str_replace("'$oldlid'", "''", $lsa);
		$lsainsert = str_replace("INTO labelsets", "INTO {$dbprefix}labelsets", $lsainsert); //db prefix handler
		$lsiresult=mysql_query($lsainsert);
		$newlid=mysql_insert_id();

		if ($labelsarray) {
			foreach ($labelsarray as $la) {
				//GET ORDER OF FIELDS
				$lfieldorders=convertToArray($la, "`, `", "(`", "`)");
				$lfieldcontents=convertToArray($la, "', '", "('", "')");
				$newlfieldcontents=$lfieldcontents;
				$labellidpos=array_search("lid", $lfieldorders);
				$labellid=$lfieldcontents[$labellidpos];
				if ($labellid == $oldlid) {
					$newlfieldcontents[array_search("lid", $lfieldorders)]=$newlid;
					$newlvalues="('".implode("', '", $newlfieldcontents)."')";
					$lainsert = str_replace("('".implode("', '", $lfieldcontents)."')", $newlvalues, $la);
					//$lainsert = str_replace("'$labellid'", "'$newlid'", $la);
					$lainsert = str_replace ("INTO labels", "INTO {$dbprefix}labels", $lainsert);
					$liresult=mysql_query($lainsert);
				}
			}
		}
		
		//CHECK FOR DUPLICATE LABELSETS
		$thisset="";
		$query2 = "SELECT code, title, sortorder
				   FROM {$dbprefix}labels
				   WHERE lid=".$newlid."
				   ORDER BY sortorder, code";
		$result2 = mysql_query($query2) or die("Died querying labelset $lid<br />$query2<br />".mysql_error());
		$numfields=mysql_num_fields($result2);
		while($row2=mysql_fetch_row($result2))
			{
			for ($i=0; $i<=$numfields-1; $i++)
				{
				$thisset .= $row2[$i];
				}
			} // while
		$newcs=dechex(crc32($thisset)*1);
		if (isset($csarray))
			{
			foreach($csarray as $key=>$val)
				{
				if ($val == $newcs)
					{
				    $lsmatch=$key;
					}
				}
			}
		if (isset($lsmatch))
			{
		    //There is a matching labelset. So, we will delete this one and refer
			//to the matched one.
			$query = "DELETE FROM {$dbprefix}labels WHERE lid=$newlid";
			$result=mysql_query($query) or die("Couldn't delete labels<br />$query<br />".mysql_error());
			$query = "DELETE FROM {$dbprefix}labelsets WHERE lid=$newlid";
			$result=mysql_query($query) or die("Couldn't delete labelset<br />$query<br />".mysql_error());
			$newlid=$lsmatch;
			}
		else
			{
			//There isn't a matching labelset, add this checksum to the $csarray array
			$csarray[$newlid]=$newcs;
			}
		//END CHECK FOR DUPLICATES
		$labelreplacements[]=array($oldlid, $newlid);
	}
}

// DO GROUPS, QUESTIONS FOR GROUPS, THEN ANSWERS FOR QUESTIONS IN A NESTED FORMAT!
if (isset($grouparray) && $grouparray) {
	foreach ($grouparray as $ga) {
		//GET ORDER OF FIELDS
		$gafieldorders=convertToArray($ga, "`, `", "(`", "`)");
		$gacfieldcontents=convertToArray($ga, "', '", "('", "')");
		$sid=$gacfieldcontents[array_search("sid", $gafieldorders)];
		$oldsid=$sid;
		$gidpos=array_search("gid", $gafieldorders);
		$gid=$gacfieldcontents[$gidpos];
		//$gid = substr($ga, strpos($ga, "('")+2, (strpos($ga, "',")-(strpos($ga, "('")+2)));
		$ginsert = str_replace("('$gid', '$sid',", "('', '$newsid',", $ga);
		$ginsert = str_replace("INTO groups", "INTO {$dbprefix}groups", $ginsert);
		$oldgid=$gid;
		$gres = mysql_query($ginsert);
		//GET NEW GID
		$gidquery = "SELECT gid FROM {$dbprefix}groups ORDER BY gid DESC LIMIT 1";
		$gidres = mysql_query($gidquery);
		while ($grow = mysql_fetch_row($gidres)) {$newgid = $grow[0];}
		//NOW DO NESTED QUESTIONS FOR THIS GID
		if (isset($questionarray) && $questionarray) {
			foreach ($questionarray as $qa) {
				$qafieldorders=convertToArray($qa, "`, `", "(`", "`)");
				$qacfieldcontents=convertToArray($qa, "', '", "('", "')");
				$newfieldcontents=$qacfieldcontents;
				$thisgid=$qacfieldcontents[array_search("gid", $qafieldorders)];
				if ($thisgid == $gid) {
					$qid = $qacfieldcontents[array_search("qid", $qafieldorders)];
					$newfieldcontents[array_search("qid", $qafieldorders)] = "";
					$newfieldcontents[array_search("sid", $qafieldorders)] = $newsid;
					$newfieldcontents[array_search("gid", $qafieldorders)] = $newgid;
					$oldqid=$qid;
					$newvalues="('".implode("', '", $newfieldcontents)."')";
					$qinsert = str_replace ("('".implode("', '", $qacfieldcontents)."')", $newvalues, $qa);
					$qinsert = str_replace("INTO questions", "INTO {$dbprefix}questions", $qinsert);
					$type = $qacfieldcontents[array_search("type", $qafieldorders)]; //Get the type
					$other = $qacfieldcontents[array_search("other", $qafieldorders)]; //Get 'other';
					$qres = mysql_query($qinsert) or die ("<b>"._ERROR."</b> Failed to insert question<br />\n$qinsert<br />\n".mysql_error()."</body>\n</html>");
					$qidquery = "SELECT qid, lid FROM {$dbprefix}questions ORDER BY qid DESC LIMIT 1"; //Get last question added (finds new qid)
					$qidres = mysql_query($qidquery);
					while ($qrow = mysql_fetch_array($qidres)) {$newqid = $qrow['qid']; $oldlid=$qrow['lid'];}
					if ($type == "F" || $type == "H") {//IF this is a flexible label array, update the lid entry
						foreach ($labelreplacements as $lrp) {
							if ($lrp[0] == $oldlid) {
								$lrupdate="UPDATE {$dbprefix}questions SET lid='{$lrp[1]}' WHERE qid=$newqid";
								$lrresult=mysql_query($lrupdate);
							}
						}
					}
					$newrank=0;
					//NOW DO NESTED ANSWERS FOR THIS QID
					if ($answerarray) {
						foreach ($answerarray as $aa) {
							$aafieldorders=convertToArray($aa, "`, `", "(`", "`)");
							$aacfieldcontents=convertToArray($aa, "', '", "('", "')");
							$newfieldcontents=$aacfieldcontents;
							$code=$aacfieldcontents[array_search("code", $aafieldorders)];
							$thisqid=$aacfieldcontents[array_search("qid", $aafieldorders)];
							if ($thisqid == $qid) {
								$newfieldcontents[array_search("qid", $aafieldorders)]=$newqid;
								$newvalues="('".implode("', '", $newfieldcontents)."')";
								$ainsert = str_replace("('".implode("', '", $aacfieldcontents)."')", $newvalues, $aa);
								//$ainsert = str_replace("'$qid'", "'$newqid'", $aa);
								$ainsert = str_replace("INTO answers", "INTO {$dbprefix}answers", $ainsert);
								$ares = mysql_query($ainsert) or die ("<b>"._ERROR."</b> Failed to insert answer<br />\n$ainsert<br />\n".mysql_error()."</body>\n</html>");
								if ($type == "M" || $type == "P") {
									$fieldnames[]=array("oldcfieldname"=>$oldsid."X".$oldgid."X".$oldqid, 
														"newcfieldname"=>$newsid."X".$newgid."X".$newqid, 
														"oldfieldname"=>$oldsid."X".$oldgid."X".$oldqid.$code, 
														"newfieldname"=>$newsid."X".$newgid."X".$newqid.$code);
									if ($type == "P") {
										$fieldnames[]=array("oldcfieldname"=>$oldsid."X".$oldgid."X".$oldqid.$code."comment", 
															"newcfieldname"=>$newsid."X".$newgid."X".$newqid.$code."comment", 
															"oldfieldname"=>$oldsid."X".$oldgid."X".$oldqid.$code."comment", 
															"newfieldname"=>$newsid."X".$newgid."X".$newqid.$code."comment");
									}
								}
								elseif ($type == "A" || $type == "B" || $type == "C" || $type == "F" || $type == "H") {
									$fieldnames[]=array("oldcfieldname"=>$oldsid."X".$oldgid."X".$oldqid, 
														"newcfieldname"=>$newsid."X".$newgid."X".$newqid, 
														"oldfieldname"=>$oldsid."X".$oldgid."X".$oldqid.$code, 
														"newfieldname"=>$newsid."X".$newgid."X".$newqid.$code);
								}
								elseif ($type == "R") {
									$newrank++;
								}
							}			
						}
						if (($type == "A" || $type == "B" || $type == "C" || $type == "M" || $type == "P") && ($other == "Y")) {
							$fieldnames[]=array("oldcfieldname"=>$oldsid."X".$oldgid."X".$oldqid."other", 
												"newcfieldname"=>$newsid."X".$newgid."X".$newqid."other", 
												"oldfieldname"=>$oldsid."X".$oldgid."X".$oldqid."other", 
												"newfieldname"=>$newsid."X".$newgid."X".$newqid."other");
							if ($type == "P") {
								$fieldnames[]=array("oldcfieldname"=>$oldsid."X".$oldgid."X".$oldqid."othercomment", 
													"newcfieldname"=>$newsid."X".$newgid."X".$newqid."othercomment", 
													"oldfieldname"=>$oldsid."X".$oldgid."X".$oldqid."othercomment", 
													"newfieldname"=>$newsid."X".$newgid."X".$newqid."othercomment");
							}
						}
						if ($type == "R" && $newrank >0) {
							for ($i=1; $i<=$newrank; $i++) {
								$fieldnames[]=array("oldcfieldname"=>$oldsid."X".$oldgid."X".$oldqid.$i, 
													"newcfieldname"=>$newsid."X".$newgid."X".$newqid.$i, 
													"oldfieldname"=>$oldsid."X".$oldgid."X".$oldqid.$i, 
													"newfieldname"=>$newsid."X".$newgid."X".$newqid.$i);
							}
						}
						if ($type != "A" && $type != "B" && $type != "C" && $type != "R" && $type != "M" && $type != "P") {
							$fieldnames[]=array("oldcfieldname"=>$oldsid."X".$oldgid."X".$oldqid, 
												"newcfieldname"=>$newsid."X".$newgid."X".$newqid, 
												"oldfieldname"=>$oldsid."X".$oldgid."X".$oldqid, 
												"newfieldname"=>$newsid."X".$newgid."X".$newqid);
							if ($type == "O") {
								$fieldnames[]=array("oldcfieldname"=>$oldsid."X".$oldgid."X".$oldqid."comment", 
													"newcfieldname"=>$newsid."X".$newgid."X".$newqid."comment", 
													"oldfieldname"=>$oldsid."X".$oldgid."X".$oldqid."comment", 
													"newfieldname"=>$newsid."X".$newgid."X".$newqid."comment");
							}
						}
						$substitutions[]=array($oldsid, $oldgid, $oldqid, $newsid, $newgid, $newqid);
					} else {
						$fieldnames[]=array("oldcfieldname"=>$oldsid."X".$oldgid."X".$oldqid, 
											"newcfieldname"=>$newsid."X".$newgid."X".$newqid, 
											"oldfieldname"=>$oldsid."X".$oldgid."X".$oldqid, 
											"newfieldname"=>$newsid."X".$newgid."X".$newqid);
						$substitutions[]=array($oldsid, $oldgid, $oldqid, $newsid, $newgid, $newqid);
					}
				//echo $oldsid."X".$oldgid."X".$oldqid ."--". $newsid."X".$newgid."X".$newqid."<br />";
				}
			}
		}
	}
}
//We've built two arrays along the way - one containing the old SID, GID and QIDs - and their NEW equivalents
//and one containing the old 'extended fieldname' and its new equivalent.  These are needed to import conditions.

if (isset($question_attributesarray) && $question_attributesarray) {//ONLY DO THIS IF THERE ARE QUESTION_ATTRIBUES
	foreach ($question_attributesarray as $qar) {
		$fieldorders=convertToArray($qar, "`, `", "(`", "`)");
		$fieldcontents=convertToArray($qar, "', '", "('", "')");
		$newfieldcontents=$fieldcontents;
		$oldqid=$fieldcontents[array_search("qid", $fieldorders)];
		foreach ($substitutions as $subs) {
			if ($oldqid==$subs[2]) {$newqid=$subs[5];}
			}
		
		$newfieldcontents[array_search("qid", $fieldorders)]=$newqid;
		$newfieldcontents[array_search("qaid", $fieldorders)]="";
		
		$newvalues="('".implode("', '", $newfieldcontents)."')";
		$insert=str_replace("('".implode("', '", $fieldcontents)."')", $newvalues, $qar);
		$insert=str_replace("INTO question_attributes", "INTO {$dbprefix}question_attributes", $insert);
		$result=mysql_query($insert) or die ("Couldn't insert question_attribute<br />$insert<br />".mysql_error());

		unset($newcqid);
	}
}

if (isset($conditionsarray) && $conditionsarray) {//ONLY DO THIS IF THERE ARE CONDITIONS!
	foreach ($conditionsarray as $car) {
		$fieldorders=convertToArray($car, "`, `", "(`", "`)");
		$fieldcontents=convertToArray($car, "', '", "('", "')");
		$newfieldcontents=$fieldcontents;
		$oldcid=$fieldcontents[array_search("cid", $fieldorders)];
		$oldqid=$fieldcontents[array_search("qid", $fieldorders)];
		$oldcfieldname=$fieldcontents[array_search("cfieldname", $fieldorders)];
		$oldcqid=$fieldcontents[array_search("cqid", $fieldorders)];
		foreach ($substitutions as $subs) {
			if ($oldqid==$subs[2])	{$newqid=$subs[5];}
			if ($oldcqid==$subs[2])	{$newcqid=$subs[5];}
		}
		foreach($fieldnames as $fns) {
			if ($oldcfieldname==$fns['oldcfieldname']) {$newcfieldname=$fns['newcfieldname'];}
		}
		$newfieldcontents[array_search("cid", $fieldorders)]="";
		$newfieldcontents[array_search("qid", $fieldorders)]=$newqid;
		$newfieldcontents[array_search("cfieldname", $fieldorders)]=$newcfieldname;
		$newfieldcontents[array_search("cqid", $fieldorders)]=$newcqid;
		$newvalues="('".implode("', '", $newfieldcontents)."')";
		$insert=str_replace("('".implode("', '", $fieldcontents)."')", $newvalues, $car);
		$insert=str_replace("INTO conditions", "INTO {$dbprefix}conditions", $insert);
		//echo "-- CONDITIONS --<br />$insert<br />\n";
		$result=mysql_query($insert) or die ("Couldn't insert condition<br />$insert<br />".mysql_error());
	}
}

echo "<br />\n<b><font color='green'>"._SUCCESS."</font></b><br />\n"
	."<b><u>"._IG_IMPORTSUMMARY."</u></b><br />\n"
	."<ul>\n\t<li>"._GROUPS.": ";
if (isset($countgroups)) {echo $countgroups;}
echo "</li>\n"
	."\t<li>"._QUESTIONS.": ";
if (isset($countquestions)) {echo $countquestions;}
echo "</li>\n"
	."\t<li>"._ANSWERS.": ";
if (isset($countanswers)) {echo $countanswers;}
echo "</li>\n"
	."\t<li>"._CONDITIONS.": ";
if (isset($countconditions)) {echo $countconditions;}
echo "</li>\n"
	."\t<li>"._LABELSET.": ";
if (isset($countlabelsets)) {echo $countlabelsets;}
echo " ("._LABELANS.": ";
if (isset($countlabels)) {echo $countlabels;}
echo ")</li>\n";
echo "\t<li>"._QL_QUESTIONATTRIBUTES;
if (isset($countquestion_attributes)) {echo " $countquestion_attributes";}
echo ")</li>\n</ul>\n";
echo "<b>"._IG_SUCCESS."</b><br />\n"
	."<input $btstyle type='submit' value='"._GO_ADMIN."' onClick=\"window.open('$scriptname?sid=$newsid', '_top')\">\n"
	."</td></tr></table>\n"
	."</body>\n</html>";

unlink($the_full_file_path);

function convertToArray($string, $seperator, $start, $end) {
	$begin=strpos($string, $start)+strlen($start);
	$len=strpos($string, $end)-$begin;
	$order=substr($string, $begin, $len);
	$orders=explode($seperator, $order);
	return $orders;
}
?>