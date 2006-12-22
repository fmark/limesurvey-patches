<?php
/*
#############################################################
# >>> PHPSurveyor  										#
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


if($_SESSION['USER_RIGHT_CONFIGURATOR'] == 1)
	{
	// THIS FILE CHECKS THE CONSISTENCY OF THE DATABASE, IT LOOKS FOR
	// STRAY QUESTIONS, ANSWERS, CONDITIONS OR GROUPS AND DELETES THEM
	$ok=returnglobal('ok');
	
	if (!isset($ok) || $ok != "Y") // do the check, but don't delete anything
	{
		$integritycheck = "<table><tr><td height='1'></td></tr></table>\n"
		. "<table align='center' bgcolor='#DDDDDD' style='border: 1px solid #555555' "
		. "cellpadding='1' cellspacing='0' width='450'>\n"
		. "\t<tr>\n"
		. "\t\t<td colspan='2' align='center' bgcolor='#BBBBBB'>\n"
		. "\t\t\t<strong>"._("Data Consistency Check<br /><font size='1'>If errors are showing up you might have to execute this script repeatedly. </font>")."</strong>\n"
		. "\t\t</font></td>\n"
		. "\t</tr>\n"
		. "\t<tr><td align='center'>"
		. "<br />\n";
		// Check conditions
		//	$query = "SELECT {$dbprefix}questions.sid, {$dbprefix}conditions.* "
		//			."FROM {$dbprefix}conditions, {$dbprefix}questions "
		//			."WHERE {$dbprefix}conditions.qid={$dbprefix}questions.qid "
		//			."ORDER BY qid, cqid, cfieldname, value";
		$query = "SELECT * FROM {$dbprefix}conditions ORDER BY cid";
		$result = db_execute_assoc($query) or die("Couldn't get list of conditions from database<br />$query<br />".$connect->ErrorMsg());
		while ($row=$result->FetchRow())
		{
			$qquery="SELECT qid FROM {$dbprefix}questions WHERE qid='{$row['qid']}'";
			$qresult=$connect->Execute($qquery) or die ("Couldn't check questions table for qids<br />$qquery<br />".$connect->ErrorMsg());
			$qcount=$qresult->RecordCount();
			if (!$qcount) {$cdelete[]=array("cid"=>$row['cid'], "reason"=>"No matching qid");}
			$qquery = "SELECT qid FROM {$dbprefix}questions WHERE qid='{$row['cqid']}'";
			$qresult=$connect->Execute($qquery) or die ("Couldn't check questions table for qids<br />$qquery<br />".$connect->ErrorMsg());
			$qcount=$qresult->RecordCount();
			if (!$qcount) {$cdelete[]=array("cid"=>$row['cid'], "reason"=>"No matching Cqid");}
			if ($row['cfieldname']) //Only do this if there actually is a "cfieldname"
			{
				list ($surveyid, $gid, $rest) = explode("X", $row['cfieldname']);
				$qquery = "SELECT gid FROM {$dbprefix}groups WHERE gid=$gid";
				$qresult = $connect->Execute($qquery) or die ("Couldn't check conditional group matches<br />$qquery<br />".$connect->ErrorMsg());
				$qcount=$qresult->RecordCount();
				if ($qcount < 1) {$cdelete[]=array("cid"=>$row['cid'], "reason"=>"No matching CFIELDNAME Group! ($gid) ({$row['cfieldname']})");}
			}
			elseif (!$row['cfieldname'])
			{
				$cdelete[]=array("cid"=>$row['cid'], "reason"=>"No \"CFIELDNAME\" field set! ({$row['cfieldname']})");
			}
		}
		if (isset($cdelete) && $cdelete)
		{
			$integritycheck .= "<strong>"._("The following conditions should be deleted").":</strong><br /><font size='1'>\n";
			foreach ($cdelete as $cd) {
				$integritycheck .= "CID: {$cd['cid']} because {$cd['reason']}<br />\n";
			}
			$integritycheck .= "</font><br />\n";
		}
		else
		{
			$integritycheck .= "<strong>"._("All conditions meet consistency standards")."</strong><br />\n";
		}
	
		// Check question_attributes to delete
		$query = "SELECT * FROM {$dbprefix}question_attributes ORDER BY qid";
		$result = db_execute_assoc($query) or die($connect->ErrorMsg());
		while($row = $result->FetchRow())
		{
			$aquery = "SELECT * FROM {$dbprefix}questions WHERE qid = {$row['qid']}";
			$aresult = $connect->Execute($aquery) or die($connect->ErrorMsg());
			$qacount = $aresult->RecordCount();
			if (!$qacount) {
				$qadelete[]=array("qaid"=>$row['qaid'], "attribute"=>$row['attribute'], "reason"=>"No matching qid");
			}
		} // while
		if (isset($qadelete) && $qadelete) {
			$integritycheck .= "<strong>"._("The following question attributes should be deleted").":</strong><br /><font size='1'>\n";
			foreach ($qadelete as $qad) {$integritycheck .= "QAID `{$qad['qaid']}` ATTRIBUTE `{$qad['attribute']}` because `{$qad['reason']}`<br />\n";}
			$integritycheck .= "</font><br />\n";
		}
		else
		{
			$integritycheck .= "<strong>"._("All question_attributes meet consistency standards")."</strong><br />\n";
		}
	
		// Check assessments
		$query = "SELECT * FROM {$dbprefix}assessments WHERE scope='T' ORDER BY sid";
		$result = db_execute_assoc($query) or die ("Couldn't get list of assessments<br />$query<br />".$connect->ErrorMsg());
		while($row = $result->FetchRow())
		{
			$aquery = "SELECT * FROM {$dbprefix}surveys WHERE sid = {$row['sid']}";
			$aresult = db_execute_assoc($aquery) or die("Oh dear - died in assessments surveys:".$aquery ."<br />".$connect->ErrorMsg());
			$acount = $aresult->RecordCount();
			if (!$acount) {
				$assdelete[]=array("id"=>$row['id'], "assessment"=>$row['name'], "reason"=>"No matching survey");
			}
		} // while
	
		$query = "SELECT * FROM {$dbprefix}assessments WHERE scope='G' ORDER BY gid";
		$result = db_execute_assoc($query) or die ("Couldn't get list of assessments<br />$query<br />".$connect->ErrorMsg());
		while($row = $result->FetchRow())
		{
			$aquery = "SELECT * FROM {$dbprefix}groups WHERE gid = {$row['gid']}";
			$aresult = $connect->Execute($aquery) or die("Oh dear - died:".$aquery ."<br />".$connect->ErrorMsg());
			$acount = $aresult->RecordCount();
			if (!$acount) {
				$asgdelete[]=array("id"=>$row['id'], "assessment"=>$row['name'], "reason"=>"No matching group");
			}
		}
	
		if (isset($assdelete) && $assdelete)
		{
			$integritycheck .= "<strong>"._("The following assessments should be deleted").":</strong><br /><font size='1'>\n";
			foreach ($assdelete as $ass) {$integritycheck .= "ID `{$ass['id']}` ASSESSMENT `{$ass['assessment']}` because `{$ass['reason']}`<br />\n";}
			$integritycheck .= "</font><br />\n";
		}
		else
		{
			$integritycheck .= "<strong>"._("All assessments meet consistency standards")."</strong><br />\n";
		}
		if (isset($asgdelete) && $asgdelete)
		{
			$integritycheck .= "<strong>"._("The following assessments should be deleted").":</strong><br /><font size='1'>\n";
			foreach ($asgdelete as $asg) {$integritycheck .= "ID `{$asg['id']}` ASSESSMENT `{$asg['assessment']}` because `{$asg['reason']}`<br />\n";}
			$integritycheck .= "</font><br />\n";
		}
		else
		{
			$integritycheck .= "<strong>"._("All assessments meet consistency standards")."</strong><br />\n";
		}
	
		// Check answers
		$query = "SELECT * FROM {$dbprefix}answers ORDER BY qid";
		$result = db_execute_assoc($query) or die ("Couldn't get list of answers from database<br />$query<br />".$connect->ErrorMsg());
		while ($row=$result->FetchRow())
		{
			//$integritycheck .= "Checking answer {$row['code']} to qid {$row['qid']}<br />\n";
			$qquery="SELECT qid FROM {$dbprefix}questions WHERE qid='{$row['qid']}'";
			$qresult=$connect->Execute($qquery) or die ("Couldn't check questions table for qids from answers<br />$qquery<br />".$connect->ErrorMsg());
			$qcount=$qresult->RecordCount();
			if (!$qcount) {
				$adelete[]=array("qid"=>$row['qid'], "code"=>$row['code'], "reason"=>"No matching question");
			}
			//$integritycheck .= "<br />\n";
		}
		if (isset($adelete) && $adelete)
		{
			$integritycheck .= "<strong>"._("The following answers should be deleted").":</strong><br /><font size='1'>\n";
			foreach ($adelete as $ad) {$integritycheck .= "QID `{$ad['qid']}` CODE `{$ad['code']}` because `{$ad['reason']}`<br />\n";}
			$integritycheck .= "</font><br />\n";
		}
		else
		{
			$integritycheck .= "<strong>"._("All answers meet consistency standards")."</strong><br />\n";
		}
	
		//check questions
		$query = "SELECT * FROM {$dbprefix}questions ORDER BY sid, gid, qid";
		$result = db_execute_assoc($query) or die ("Couldn't get list of questions from database<br />$query<br />".$connect->ErrorMsg());
		while ($row=$result->FetchRow())
		{
			//Make sure group exists
			$qquery="SELECT * FROM {$dbprefix}groups WHERE gid={$row['gid']}";
			$qresult=$connect->Execute($qquery) or die ("Couldn't check groups table for gids from questions<br />$qquery<br />".$connect->ErrorMsg());
			$qcount=$qresult->RecordCount();
			if (!$qcount) {$qdelete[]=array("qid"=>$row['qid'], "reason"=>"No matching Group ({$row['gid']})");}
			//Make sure survey exists
			$qquery="SELECT * FROM {$dbprefix}surveys WHERE sid={$row['sid']}";
			$qresult=$connect->Execute($qquery) or die ("Couldn't check surveys table for sids from questions<br />$qquery<br />".$connect->ErrorMsg());
			$qcount=$qresult->RecordCount();
			if (!$qcount) {
				if (!isset($qdelete) || !in_array($row['qid'], $qdelete)) {$qdelete[]=array("qid"=>$row['qid'], "reason"=>"No matching Survey! ({$row['sid']})");}
			}
		}
		if (isset($qdelete) && $qdelete)
		{
			$integritycheck .= "<strong>"._("The following questions should be deleted").":</strong><br /><font size='1'>\n";
			foreach ($qdelete as $qd) {$integritycheck .= "QID `{$qd['qid']}` because `{$qd['reason']}`<br />\n";}
			$integritycheck .= "</font><br />\n";
		}
		else
		{
			$integritycheck .= "<strong>"._("All questions meet consistency standards")."</strong><br />\n";
		}
		//check groups
		$query = "SELECT * FROM {$dbprefix}groups ORDER BY sid, gid";
		$result=db_execute_assoc($query) or die ("Couldn't get list of groups for checking<br />$query<br />".$connect->ErrorMsg());
		while ($row=$result->FetchRow())
		{
			//make sure survey exists
			$qquery = "SELECT * FROM {$dbprefix}groups WHERE sid={$row['sid']}";
			$qresult=$connect->Execute($qquery) or die("Couldn't check surveys table for gids from groups<br />$qquery<br />".$connect->ErrorMsg());
			$qcount=$qresult->RecordCount();
			if (!$qcount) {$gdelete[]=array($row['gid']);}
		}
		if (isset($gdelete) && $gdelete)
		{
			$integritycheck .= "<strong>"._("The following groups should be deleted").":</strong><br /><font size='1'>\n";
			$integritycheck .= implode(", ", $gdelete);
			$integritycheck .= "</font><br />\n";
		}
		else
		{
			$integritycheck .= "<strong>"._("All groups meet consistency standards")."</strong><br />\n";
		}
		//NOW CHECK FOR STRAY SURVEY RESPONSE TABLES AND TOKENS TABLES
		if (!isset($cdelete) && !isset($adelete) && !isset($qdelete) && !isset($gdelete) && !isset($asgdelete) && !isset($assdelete) && !isset($qadelete)) {
			$integritycheck .= "<br />"._("No database action required");
		} else {
			$integritycheck .= "<br />Should we proceed with the delete?<br />\n";
			$integritycheck .= "<form action='{$_SERVER['PHP_SELF']}' method='POST'>\n";
			if (isset($cdelete)) {
				foreach ($cdelete as $cd) {
					$integritycheck .= "<input type='hidden' name='cdelete[]' value='{$cd['cid']}'>\n";
				}
			}
			if (isset($adelete)) {
				foreach ($adelete as $ad) {
					$integritycheck .= "<input type='hidden' name='adelete[]' value='{$ad['qid']}|{$ad['code']}'>\n";
				}
			}
			if (isset($qdelete)) {
				foreach($qdelete as $qd) {
					$integritycheck .= "<input type='hidden' name='qdelete[]' value='{$qd['qid']}'>\n";
				}
			}
			if (isset($gdelete)) {
				foreach ($gdelete as $gd) {
					$integritycheck .= "<input type='hidden' name='gdelete[]' value='{$gd['gid']}'>\n";
				}
			}
			if (isset($qadelete)) {
				foreach ($qadelete as $qad) {
					$integritycheck .= "<input type='hidden' name='qadelete[]' value='{$qad['qaid']}'\n";
				}
			}
			if (isset($assdelete)) {
				foreach ($assdelete as $ass) {
					$integritycheck .= "<input type='hidden' name='assdelete[]' value='{$ass['id']}'\n";
				}
			}
			if (isset($asgdelete)) {
				foreach ($asgdelete as $asg) {
					$integritycheck .= "<input type='hidden' name='asgdelete[]' value='{$asg['id']}'\n";
				}
			}
			$integritycheck .= "<input type='hidden' name='ok' value='Y'>\n"
			                  ."<input type='submit' value='Yes - Delete Them!'>\n"
			                  ."</form>\n";
		}
		$integritycheck .= "<br /><br /><a href='$scriptname'>"._("Close")."</a><br /><br />\n"
		."</font></td></tr></table>\n"
		."<table><tr><td height='1'></td></tr></table>\n";
	}
	elseif ($ok == "Y")
	{
		$integritycheck .= "<table><tr><td height='1'></td></tr></table>\n"
		. "<table align='center' bgcolor='#DDDDDD' style='border: 1px solid #555555' "
		. "cellpadding='1' cellspacing='0' width='450'>\n"
		. "\t<tr>\n"
		. "\t\t<td colspan='2' align='center' bgcolor='#BBBBBB'>$setfont\n"
		. "\t\t\t<strong>"._("Data Consistency Check<br /><font size='1'>If errors are showing up you might have to execute this script repeatedly. </font>")."</strong>\n"
		. "\t\t</font></td>\n"
		. "\t</tr>\n"
		. "\t<tr><td align='center'>$setfont";
		$cdelete=returnglobal('cdelete');
		$adelete=returnglobal('adelete');
		$qdelete=returnglobal('qdelete');
		$gdelete=returnglobal('gdelete');
		$assdelete=returnglobal('assdelete');
		$asgdelete=returnglobal('asgdelete');
		$qadelete=returnglobal('qadelete');
	
		if (isset($assdelete)) {
			$integritycheck .= "Deleting Assessments:<br /><fontsize='1'>\n";
			foreach ($assdelete as $ass) {
				$integritycheck .= "Deleting ID:".$ass."<br />\n";
				$sql = "DELETE FROM {$dbprefix}assessments WHERE id=$ass";
				$result = $connect->Execute($sql) or die ("Couldn't delete ($sql)<br />".$connect->ErrorMsg());
			}
		}
		if (isset($asgdelete)) {
			$integritycheck .= "Deleting Assessments:<br /><fontsize='1'>\n";
			foreach ($asgdelete as $asg) {
				$integritycheck .= "Deleting ID:".$asg."<br />\n";
				$sql = "DELETE FROM {$dbprefix}assessments WHERE id=$asg";
				$result = $connect->Execute($sql) or die ("Couldn't delete ($sql)<br />".$connect->ErrorMsg());
			}
		}
		if (isset($qadelete)) {
			$integritycheck .= "Deleting Question_Attributes:<br /><fontsize='1'>\n";
			foreach ($qadelete as $qad) {
				$integritycheck .= "Deleting QAID:".$qad."<br />\n";
				$sql = "DELETE FROM {$dbprefix}question_attributes WHERE qaid=$qad";
				$result = $connect->Execute($sql) or die ("Couldn't delete ($sql)<br />".$connect->ErrorMsg());
			}
		}
		if (isset($cdelete)) {
			$integritycheck .= "Deleting Conditions:<br /><font size='1'>\n";
			foreach ($cdelete as $cd) {
				$integritycheck .= "Deleting cid:".$cd."<br />\n";
				$sql = "DELETE FROM {$dbprefix}conditions WHERE cid=$cd";
				$result=$connect->Execute($sql) or die ("Couldn't Delete ($sql)<br />".$connect->ErrorMsg());
			}
			$integritycheck .= "</font><br />\n";
		}
		if (isset($adelete)) {
			$integritycheck .= "Deleting Answers:<br /><font size='1'>\n";
			foreach ($adelete as $ad) {
				list($ad1, $ad2)=explode("|", $ad);
				$integritycheck .= "Deleting answer with qid:".$ad1." and code: ".$ad2."<br />\n";
				$sql = "DELETE FROM {$dbprefix}answers WHERE qid=$ad1 AND code='$ad2'";
				$result=$connect->Execute($sql) or die ("Couldn't Delete ($sql)<br />".$connect->ErrorMsg());
			}
			$integritycheck .= "</font><br />\n";
		}
		if (isset($qdelete)) {
			$integritycheck .= "Deleting Questions:<br /><font size='1'>\n";
			foreach ($qdelete as $qd) {
				$integritycheck .= "Deleting qid:".$qd."<br />\n";
				$sql = "DELETE FROM {$dbprefix}questions WHERE qid=$qd";
				$result=$connect->Execute($sql) or die ("Couldn't Delete ($sql)<br />".$connect->ErrorMsg());
			}
			$integritycheck .= "</font><br />\n";
		}
		if (isset($gdelete)) {
			$integritycheck .= "Deleting Groups:<br /><font size='1'>\n";
			foreach ($gdelete as $gd) {
				$integritycheck .= "Deleting gid:".$gd."<br />\n";
				$sql = "DELETE FROM {$dbprefix}groups WHERE gid=$gd";
				$result=$connect->Execute($sql) or die ("Couldn't Delete ($sql)<br />".$connect->ErrorMsg());
			}
			$integritycheck .= "</font><br />\n";
		}
		$integritycheck .= "Check database again?<br />\n"
		                  ."<a href='dbchecker.php'>Check Again</a><br />\n"
		                  ."<a href='$scriptname'>"._("Close")."</a>"
		                  ."</td></tr></table></body></html>\n";
	}

	}
else
	{
	$action = "dbchecker";
	include("access_denied.php");
	include("admin.php");	
	}
?>
