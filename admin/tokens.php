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

# TOKENS FILE

//Create global $action variable
$THISOS="";

include("config.php");
if (!isset($action)) {$action=returnglobal('action');}
if (!isset($sid)) {$sid=returnglobal('sid');}
if (!isset($order)) {$order=returnglobal('order');}
if (!isset($limit)) {$limit=returnglobal('limit');}
if (!isset($start)) {$start=returnglobal('start');}
if (!isset($searchstring)) {$searchstring=returnglobal('searchstring');}

sendcacheheaders();

if ($action == "delete") {echo str_replace("<head>\n", "<head>\n<meta http-equiv=\"refresh\" content=\"2;URL={$_SERVER['PHP_SELF']}?action=browse&sid={$_GET['sid']}&start=$start&limit=$limit&order=$order\"", $htmlheader);}
else {echo $htmlheader;}

echo "<script type='text/javascript'>\n"
	."<!--\n"
	."\tfunction showhelp(action)\n"
	."\t\t{\n"
	."\t\tvar name='help';\n"
	."\t\tif (action == \"hide\")\n"
	."\t\t\t{\n"
	."\t\t\tdocument.getElementById(name).style.display='none';\n"
	."\t\t\t}\n"
	."\t\telse if (action == \"show\")\n"
	."\t\t\t{\n"
	."\t\t\tdocument.getElementById(name).style.display='';\n"
	."\t\t\t}\n"
	."\t\t}\n"
	."-->\n"
	."</script>\n";

echo "<table width='100%' border='0' cellpadding='0' cellspacing='0' >\n"
	."\t<tr>\n"
	."\t\t<td valign='top' align='center' bgcolor='#BBBBBB'>\n"
	."\t\t<table height='1' ><tr><td></td></tr></table>\n";

echo "<table width='99%' align='center' style='border: 1px solid #555555' cellpadding='1' cellspacing='0'>\n";

// MAKE SURE THAT THERE IS A SID
if (!isset($sid) || !$sid)
	{
	echo "\t<tr bgcolor='#555555'><td colspan='2' height='4'><font size='1' face='verdana' color='white'><b>"
		._TOKENCONTROL.":</b></td></tr>\n"
		."\t<tr><td align='center'>$setfont<br /><font color='red'><b>"
		._ERROR."</b></font><br />"._TC_NOSID."<br /><br />"
		."<input $btstyle type='submit' value='"
		._GO_ADMIN."' onClick=\"window.open('$scriptname', '_top')\"><br /><br /></td></tr>\n"
		."</table>\n"
		."</body>\n</html>";
	exit;
	}

// MAKE SURE THAT THE SURVEY EXISTS
$chquery = "SELECT * FROM {$dbprefix}surveys WHERE sid=$sid";
$chresult=mysql_query($chquery);
$chcount=mysql_num_rows($chresult);
if (!$chcount)
	{
	echo "\t<tr bgcolor='#555555'><td colspan='2' height='4'><font size='1' face='verdana' color='white'><b>"
		._TOKENCONTROL.":</b></td></tr>\n"
		."\t<tr><td align='center'>$setfont<br /><font color='red'><b>"
		._ERROR."</b></font><br />"._DE_NOEXIST
		."<br /><br />\n\t<input $btstyle type='submit' value='"
		._GO_ADMIN."' onClick=\"window.open('$scriptname', '_top')\"><br /><br /></td></tr>\n"
		."</table>\n"
		."</body>\n</html>";
	exit;
	}

while ($chrow = mysql_fetch_array($chresult))
	{
	echo "\t<tr bgcolor='#555555'><td colspan='2' height='4'><font size='1' face='verdana' color='white'><b>"
		._TOKENCONTROL.":</b> "
		."<font color='silver'>{$chrow['short_title']}</td></tr>\n";
	$surveyprivate = $chrow['private'];
	}

// CHECK TO SEE IF A TOKEN TABLE EXISTS FOR THIS SURVEY
$tkquery = "SELECT * FROM {$dbprefix}tokens_$sid";
if (!$tkresult = mysql_query($tkquery))
	{
	if (!isset($_GET['createtable']) || !$_GET['createtable']) //Initialise Tokens Table
		{
		echo "\t<tr>\n"
			."\t\t<td align='center'>\n"
			."\t\t\t$setfont<br /><font color='red'><b>"._WARNING."</font></b><br />\n"
			."\t\t\t<b>"._TC_NOTINITIALISED."</b><br /><br />\n"
			."\t\t\t"._TC_INITINFO
			."\t\t\t<br /><br />\n"
			."\t\t\t"._TC_INITQ."<br /><br />\n"
			."\t\t\t<input type='submit' $btstyle value='"
			._TC_INITTOKENS."' onClick=\"window.open('tokens.php?sid=$sid&createtable=Y', '_top')\"><br />\n"
			."\t\t\t<input type='submit' $btstyle value='"
			._GO_ADMIN."' onClick=\"window.open('admin.php?sid=$sid', '_top')\"><br /><br />\n"
			."\t\t</td>\n"
			."\t</tr>\n"
			."</table>\n"
			."<table height='1'><tr><td></td></tr></table>\n"
			.htmlfooter("instructions.html", "Information about PHPSurveyor Tokens Functions")
			."</body>\n</html>";
		exit;
		}
	else
		{
		$createtokentable = "CREATE TABLE {$dbprefix}tokens_$sid (\n"
						  . "tid int NOT NULL auto_increment,\n "
						  . "firstname varchar(40) NULL,\n "
						  . "lastname varchar(40) NULL,\n "
						  . "email varchar(100) NULL,\n "
						  . "token varchar(10) NULL,\n "
						  . "sent varchar(1) NULL DEFAULT 'N',\n "
						  . "completed varchar(1) NULL DEFAULT 'N',\n "
						  . "PRIMARY KEY (tid)\n) TYPE=MyISAM;";
		$ctresult = mysql_query($createtokentable) or die ("Completely mucked up<br />$createtokentable<br /><br />".mysql_error());
		echo "\t<tr>\n"
			."\t\t<td align='center'>\n"
			."\t\t\t$setfont<br /><br />\n"
			."\t\t\t"._TC_CREATED." (\"tokens_$sid\")<br /><br />\n"
			."\t\t\t<input type='submit' $btstyle value='"
			._CONTINUE."' onClick=\"window.open('tokens.php?sid=$sid', '_top')\">\n"
			."\t\t</td>\n"
			."\t</tr>\n"
			."</table>\n"
			."<table height='1'><tr><td></td></tr></table>\n"
			.htmlfooter("instructions.html", "Information about PHPSurveyor Tokens Functions")
			."</body>\n</html>";
		exit;
		
		}
	}

// IF WE MADE IT THIS FAR, THEN THERE IS A TOKENS TABLE, SO LETS DEVELOP THE MENU ITEMS
echo "\t<tr bgcolor='#999999'>\n"
	."\t\t<td>\n"
	."\t\t\t<input type='image' src='./images/showhelp.gif' title='"
	._A_HELP_BT."' align='right' hspace='0' border='0' onClick=\"showhelp('show')\">\n"
	."\t\t\t<input type='image' src='./images/home.gif' title='"
	._B_ADMIN_BT."' border='0' align='left' hspace='0' onClick=\"window.open('$scriptname?sid=$sid', '_top')\">\n"
	."\t\t\t<img src='./images/blank.gif' width='11' border='0' hspace='0' align='left'>\n"
	."\t\t\t<img src='./images/seperator.gif' border='0' hspace='0' align='left'>\n"
	."\t\t\t<input type='image' src='./images/summary.gif' title='"
	._B_SUMMARY_BT."' border='0' align='left' hspace='0' onClick=\"window.open('tokens.php?sid=$sid', '_top')\">\n"
	."\t\t\t<input type='image' src='./images/document.gif' title='"
	._T_ALL_BT."' border='0' align='left' hspace='0' onClick=\"window.open('tokens.php?sid=$sid&action=browse', '_top')\">\n"
	."\t\t\t<img src='./images/blank.gif' width='20' border='0' hspace='0' align='left'>\n"
	."\t\t\t<img src='./images/seperator.gif' border='0' hspace='0' align='left'>\n"
	."\t\t\t<input type='image' src='./images/add.gif' title='"
	._T_ADD_BT."' border='0' align='left' hspace='0' onClick=\"window.open('tokens.php?sid=$sid&action=addnew', '_top')\">\n"
	."\t\t\t<input type='image' src='./images/import.gif' title='"
	._T_IMPORT_BT."' border='0' align='left' hspace='0' onClick=\"window.open('tokens.php?sid=$sid&action=import', '_top')\">\n"
	."\t\t\t<img src='./images/seperator.gif' border='0' hspace='0' align='left'>\n"
	."\t\t\t<input type='image' src='./images/invite.gif' title='"
	._T_INVITE_BT."' border='0' align='left' hspace='0' onClick=\"window.open('tokens.php?sid=$sid&action=email', '_top')\">\n"
	."\t\t\t<input type='image' src='./images/remind.gif' title='"
	._T_REMIND_BT."' border='0' align='left' hspace='0' onClick=\"window.open('tokens.php?sid=$sid&action=remind', '_top')\">\n"
	."\t\t\t<img src='./images/seperator.gif' border='0' hspace='0' align='left'>\n"
	."\t\t\t<input type='image' src='./images/tokenify.gif' title='"
	._T_TOKENIFY_BT."' border='0' align='left' hspace='0' onClick=\"window.open('tokens.php?sid=$sid&action=tokenify', '_top')\">\n"
	."\t\t\t<img src='./images/seperator.gif' border='0' hspace='0' align='left'>\n"
	."\t\t\t<input type='image' src='./images/delete.gif' title='"
	._T_KILL_BT."' border='0' align='left' hspace='0' onClick=\"window.open('tokens.php?sid=$sid&action=kill', '_top')\">\n"
	."\t\t</td>\n"
	."\t</tr>\n";

// SEE HOW MANY RECORDS ARE IN THE TOKEN TABLE
$tkcount = mysql_num_rows($tkresult);

echo "\t<tr><td align='center'><br /></td></tr>\n";
// GIVE SOME INFORMATION ABOUT THE TOKENS
echo "\t<tr>\n"
	."\t\t<td align='center'>\n"
	."\t\t\t<table align='center' bgcolor='#DDDDDD' cellpadding='2' style='border: 1px solid #555555'>\n"
	."\t\t\t\t<tr>\n"
	."\t\t\t\t\t<td align='center'>\n"
	."\t\t\t\t\t<b>$setfont "._TC_TOTALCOUNT." $tkcount</b><br />\n";
$tksq = "SELECT count(*) FROM {$dbprefix}tokens_$sid WHERE token IS NULL OR token=''";
$tksr = mysql_query($tksq);
while ($tkr = mysql_fetch_row($tksr))
	{echo "\t\t\t\t\t\t$setfont"._TC_NOTOKENCOUNT." $tkr[0] / $tkcount<br />\n";}
$tksq = "SELECT count(*) FROM {$dbprefix}tokens_$sid WHERE sent='Y'";
$tksr = mysql_query($tksq);
while ($tkr = mysql_fetch_row($tksr))
	{echo "\t\t\t\t\t\t$setfont"._TC_INVITECOUNT." $tkr[0] / $tkcount<br />\n";}
$tksq = "SELECT count(*) FROM {$dbprefix}tokens_$sid WHERE completed='Y'";
$tksr = mysql_query($tksq);
while ($tkr = mysql_fetch_row($tksr))
	{echo "\t\t\t\t\t\t$setfont"._TC_COMPLETEDCOUNT." $tkr[0] / $tkcount\n";}
echo "\t\t\t\t\t</td>\n"
	."\t\t\t\t</tr>\n"
	."\t\t\t</table>\n"
	."\t\t\t<br />\n"
	."\t\t</td>\n"
	."\t</tr>\n"
	."</table>\n"
	."<table height='1'><tr><td></td></tr></table>\n";

echo "<table width='99%' align='center' style='border: 1px solid #555555' cellpadding='1' cellspacing='0'>\n";

#############################################################################################
// NOW FOR VARIOUS ACTIONS:

if ($action == "deleteall")
	{
	$query="DELETE FROM {$dbprefix}tokens_$sid";
	$result=mysql_query($query) or die ("Couldn't update sent field<br />$query<br />".mysql_error());
	echo "<tr><td bgcolor='silver' align='center'><b>$setfont<font color='green'>"._TC_ALLDELETED."</font></font></td></tr>\n";
	$action="";
	}

if ($action == "clearinvites")
	{
	$query="UPDATE {$dbprefix}tokens_$sid SET sent='N'";
	$result=mysql_query($query) or die ("Couldn't update sent field<br />$query<br />".mysql_error());
	echo "<tr><td bgcolor='silver' align='center'><b>$setfont<font color='green'>"._TC_INVITESCLEARED."</font></font></td></tr>\n";
	$action="";
	}

if ($action == "cleartokens")
	{
	$query="UPDATE {$dbprefix}tokens_$sid SET token=''";
	$result=mysql_query($query) or die("Couldn't reset the tokens field<br />$query<br />".mysql_error());
	echo "<tr><td align='center' bgcolor='silver'><b>$setfont<font color='green'>"._TC_TOKENSCLEARED."</font></font></td></tr>\n";
	$action="";
	}

if (!$action)
	{
	echo "\t<tr bgcolor='#555555'><td colspan='2' height='4'><font size='1' face='verdana' color='white'><b>"
		._TOKENDBADMIN.":</b></td></tr>\n"
		."\t<tr>\n"
		."\t\t<td align='center'>\n"
		."\t\t\t<span style='display: block; text-align: left; width: 300'>"
		."\t\t\t$setfont<br />\n"
		."\t\t\t<ul><li><a href='tokens.php?sid=$sid&action=clearinvites' onClick='return confirm(\""
		._TC_CLEARINV_RUSURE."\")'>"._TC_CLEARINVITES."</a></li>\n"
		."\t\t\t<li><a href='tokens.php?sid=$sid&action=cleartokens' onClick='return confirm(\""
		._TC_CLEARTOKENS_RUSURE."\")'>"._TC_CLEARTOKENS."</a></li>\n"
		."\t\t\t<li><a href='tokens.php?sid=$sid&action=deleteall' onClick='return confirm(\""
		._TC_DELETEALL_RUSURE."\")'>"._TC_DELETEALL."</a></li>\n"
		."\t\t\t<li><a href='tokens.php?sid=$sid&action=kill'>"._T_KILL_BT."</a></li></ul>\n"
		."\t\t\t</font>\n"
		."\t\t\t</span>\n"
		."\t\t</td>\n"
		."\t</tr>\n"
		."</table>\n";
	}

if ($action == "browse" || $action == "search")
	{
	if (!isset($limit)) {$limit = 50;}
	if (!isset($start)) {$start = 0;}
	
	if ($limit > $tkcount) {$limit=$tkcount;}
	$next=$start+$limit;
	$last=$start-$limit;
	$end=$tkcount-$limit;
	if ($end < 0) {$end=0;}
	if ($last <0) {$last=0;}
	if ($next >= $tkcount) {$next=$tkcount-$limit;}
	if ($end < 0) {$end=0;}
	
	//ALLOW SELECTION OF NUMBER OF RECORDS SHOWN
	echo "\t<tr bgcolor='#555555'><td colspan='2' height='4'><font size='1' face='verdana' color='white'><b>"
		._VIEWCONTROL.":</b></td></tr>\n"
		."\t<tr bgcolor='#999999'><td align='left'>\n"
		."\t\t\t<img src='./images/blank.gif' width='31' height='20' border='0' hspace='0' align='left'>\n"
		."\t\t\t<img src='./images/seperator.gif' border='0' hspace='0' align='left'>\n"
		."\t\t\t<input type='image' align='left' hspace='0' border='0' src='./images/databegin.gif' title='"
		._D_BEGIN."' onClick=\"window.open('tokens.php?action=browse&sid=$sid&start=0&limit=$limit&order=$order&searchstring=$searchstring','_top')\" />\n"
		."\t\t\t<input type='image' align='left' hspace='0' border='0' src='./images/databack.gif' title='"
		._D_BACK."' onClick=\"window.open('tokens.php?action=browse&sid=$sid&start=$last&limit=$limit&order=$order&searchstring=$searchstring','_top')\" />\n"
		."\t\t\t<img src='./images/blank.gif' width='13' height='20' border='0' hspace='0' align='left'>\n"
		."\t\t\t<input type='image' align='left' hspace='0' border='0' src='./images/dataforward.gif' title='"
		._D_FORWARD."' onClick=\"window.open('tokens.php?action=browse&sid=$sid&start=$next&limit=$limit&order=$order&searchstring=$searchstring','_top')\" />\n"
		."\t\t\t<input type='image' align='left' hspace='0' border='0' src='./images/dataend.gif' title='"
		._D_END."' onClick=\"window.open('tokens.php?action=browse&sid=$sid&start=$end&limit=$limit&order=$order&searchstring=$searchstring','_top')\" />\n"
		."\t\t\t<img src='./images/seperator.gif' border='0' hspace='0' align='left'>\n"
		."\t\t\t<table align='left' cellpadding='0' cellspacing='0' border='0'><tr><form method='post' action='tokens.php'>\n"
		."\t\t\t\t<td>\n"
		."\t\t\t\t\t<input $slstyle type='text' name='searchstring' value='$searchstring'>\n"
		."\t\t\t\t\t<input $btstyle type='submit' value='"._SEARCH."'>\n"
		."\t\t\t\t</td>\n"
		."\t\t\t\t<input type='hidden' name='order' value='$order'>\n"
		."\t\t\t\t<input type='hidden' name='action' value='search'>\n"
		."\t\t\t\t<input type='hidden' name='sid' value='$sid'>\n"
		."\t\t\t</tr></form></table>\n"
		."\t\t</td>\n"
		."\t\t<form action='tokens.php'>\n"
		."\t\t<td align='right'><font size='1' face='verdana'>\n"
		."\t\t\t<img src='./images/blank.gif' width='31' height='20' border='0' hspace='0' align='right'>\n"
		."\t\t\t"._BR_DISPLAYING."<input type='text' $slstyle size='4' value='$limit' name='limit'>\n"
		."\t\t\t"._BR_STARTING."<input type='text' $slstyle size='4' value='$start' name='start'>\n"
		."\t\t\t<input type='submit' value='"._BR_SHOW."' $btstyle>\n"
		."\t\t</font></td>\n"
		."\t\t<input type='hidden' name='sid' value='$sid'>\n"
		."\t\t<input type='hidden' name='action' value='browse'>\n"
		."\t\t<input type='hidden' name='order' value='$order'>\n"
		."\t\t<input type='hidden' name='searchstring' value='$searchstring'>\n"
		."\t\t</form>\n"
		."\t</tr>\n";

	//echo "</table>\n";
	echo "<tr><td colspan='2'>\n"
		."<table width='100%' cellpadding='1' cellspacing='1' align='center' bgcolor='#CCCCCC'>\n";
	//COLUMN HEADINGS
	echo "\t<tr>\n"
		."\t\t<th align='left' valign='top'><a href='tokens.php?sid=$sid&action=browse&order=tid&start=$start&limit=$limit&searchstring=$searchstring'><img src='./images/DownArrow.gif' alt='"
		._TC_SORTBY."ID' border='0' align='left'></a>$setfont"."ID</th>\n"
		."\t\t<th align='left' valign='top'><a href='tokens.php?sid=$sid&action=browse&order=firstname&start=$start&limit=$limit&searchstring=$searchstring'><img src='./images/DownArrow.gif' alt='"
		._TC_SORTBY._TL_FIRST."' border='0' align='left'></a>$setfont"._TL_FIRST."</th>\n"
		."\t\t<th align='left' valign='top'><a href='tokens.php?sid=$sid&action=browse&order=lastname&start=$start&limit=$limit&searchstring=$searchstring'><img src='./images/DownArrow.gif' alt='"
		._TC_SORTBY._TL_LAST."' border='0' align='left'></a>$setfont"._TL_LAST."</th>\n"
		."\t\t<th align='left' valign='top'><a href='tokens.php?sid=$sid&action=browse&order=email&start=$start&limit=$limit&searchstring=$searchstring'><img src='./images/DownArrow.gif' alt='"
		._TC_SORTBY._TL_EMAIL."' border='0' align='left'></a>$setfont"._TL_EMAIL."</th>\n"
		."\t\t<th align='left' valign='top'><a href='tokens.php?sid=$sid&action=browse&order=token&start=$start&limit=$limit&searchstring=$searchstring'><img src='./images/DownArrow.gif' alt='"
		._TC_SORTBY._TL_TOKEN."' border='0' align='left'></a>$setfont"._TL_TOKEN."</th>\n"
		."\t\t<th align='left' valign='top'><a href='tokens.php?sid=$sid&action=browse&order=sent%20desc&start=$start&limit=$limit&searchstring=$searchstring'><img src='./images/DownArrow.gif' alt='"
		._TC_SORTBY._TL_INVITE."' border='0' align='left'></a>$setfont"._TL_INVITE."</th>\n"
		."\t\t<th align='left' valign='top'><a href='tokens.php?sid=$sid&action=browse&order=completed%20desc&start=$start&limit=$limit&searchstring=$searchstring'><img src='./images/DownArrow.gif' alt='"
		._TC_SORTBY._TL_DONE."' border='0' align='left'></a>$setfont"._TL_DONE."</th>\n"
		."\t\t<th align='left' valign='top' colspan='2'>$setfont"._TL_ACTION."</th>\n"
		."\t</tr>\n";
	
	$bquery = "SELECT * FROM {$dbprefix}tokens_$sid";
	if ($searchstring)
		{
		$bquery .= " WHERE firstname LIKE '%$searchstring%' OR lastname LIKE '%$searchstring%' OR email LIKE '%$searchstring%' OR token LIKE '%$searchstring%'";
		}
	if (!isset($order) || !$order) {$bquery .= " ORDER BY tid";}
	else {$bquery .= " ORDER BY $order"; }
	$bquery .= " LIMIT $start, $limit";
	$bresult = mysql_query($bquery) or die ("$bquery<br />".mysql_error());
	$bgc="";
	while ($brow = mysql_fetch_array($bresult))
		{
		$brow['token'] = trim($brow['token']);
		if ($bgc == "#EEEEEE") {$bgc = "#DDDDDD";} else {$bgc = "#EEEEEE";}
		echo "\t<tr bgcolor='$bgc'>\n";
		for ($i=0; $i<=6; $i++)
			{
			echo "\t\t<td>$setfont$brow[$i]</td>\n";
			}
		echo "\t\t<td align='left'>\n"
			."\t\t\t<input style='height: 16; width: 16px; font-size: 8; font-face: verdana' type='submit' value='E' title='"
			._TC_EDIT."' onClick=\"window.open('{$_SERVER['PHP_SELF']}?sid=$sid&action=edit&tid=$brow[0]', '_top')\" />\n"
			."<input style='height: 16; width: 16px; font-size: 8; font-face: verdana' type='submit' value='D' title='"
			._TC_DEL."' onClick=\"window.open('{$_SERVER['PHP_SELF']}?sid=$sid&action=delete&tid=$brow[0]&limit=$limit&start=$start&order=$order', '_top')\" />\n";
		if ($brow['completed'] != "Y" && $brow['token']) {echo "<input style='height: 16; width: 16px; font-size: 8; font-face: verdana' type='submit' value='S' title='"._TC_DO."' onClick=\"window.open('$publicurl/index.php?sid=$sid&token=".trim($brow['token'])."', '_blank')\" />\n";}
		echo "\n\t\t</td>\n";
		if ($brow['completed'] == "Y" && $surveyprivate == "N")
			{
			echo "\t\t<form action='browse.php' method='post' target='_blank'>\n"
				."\t\t<td align='center' valign='top'>\n"
				."\t\t\t<input style='height: 16; width: 16px; font-size: 8; font-face: verdana' type='submit' value='V' title='"
				._TC_VIEW."' />\n"
				."\t\t</td>\n"
				."\t\t<input type='hidden' name='sid' value='$sid' />\n"
				."\t\t<input type='hidden' name='action' value='id' />\n"
				."\t\t<input type='hidden' name='sql' value=\"token='{$brow['token']}'\" />\n"
				."\t\t</form>\n";
			}
		elseif ($brow['completed'] != "Y" && $brow['token'] && $brow['sent'] != "Y")
			{
			echo "\t\t<td align='center' valign='top'>\n"
				."\t\t\t<input style='height: 16; width: 16px; font-size: 8; font-face: verdana' type='submit' value='I' title='"
				._TC_INVITET."' onClick=\"window.open('{$_SERVER['PHP_SELF']}?sid=$sid&action=email&tid=$brow[0]', '_top')\" />"
				."\t\t</td>\n";
			}
		elseif ($brow['completed'] != "Y" && $brow['token'] && $brow['sent'] == "Y")
			{
			echo "\t\t<td align='center' valign='top'>\n"
				."\t\t\t<input style='height: 16; width: 16px; font-size: 8; font-face: verdana' type='submit' value='R' title='"
				._TC_REMINDT."' onClick=\"window.open('{$_SERVER['PHP_SELF']}?sid=$sid&action=remind&tid=$brow[0]', '_top')\" />"
				."\t\t</td>\n";
			}
		else
			{
			echo "\t\t<td>\n"
				."\t\t</td>\n";
			}
		echo "\t</tr>\n";
		}
	echo "</table>\n"
		."</td></tr></table>\n";
	}

if ($action == "kill")
	{
	$date = date('YmdHi');
	echo "\t<tr bgcolor='#555555'><td colspan='2' height='4'><font size='1' face='verdana' color='white'><b>"
		._DROPTOKENS.":</b></td></tr>\n"
		."\t<tr><td colspan='2' align='center'>\n"
		."$setfont<br />\n";
	if (!isset($_GET['ok']) || !$_GET['ok'])
		{
		echo "<span style='display: block; text-align: center; width: 70%'>\n"
			."<font color='red'><b>"._WARNING."</b></font></br>\n"
			._TC_DELTOKENSINFO."<br />\n"
			."( \"old_tokens_{$_GET['sid']}_$date\" )<br /><br />\n"
			."<input type='submit' $btstyle value='"
			._TC_DELETETOKENS."' onClick=\"window.open('tokens.php?sid=$sid&action=kill&ok=surething', '_top')\" /><br />\n"
			."<input type='submit' $btstyle value='"
			._AD_CANCEL."' onClick=\"window.open('tokens.php?sid=$sid', '_top')\" />\n"
			."</span>\n";
		}
	elseif (isset($_GET['ok']) && $_GET['ok'] == "surething")
		{
		$oldtable = "{$dbprefix}tokens_$sid";
		$newtable = "{$dbprefix}old_tokens_{$sid}_$date";
		$deactivatequery = "RENAME TABLE $oldtable TO $newtable";
		$deactivateresult = mysql_query($deactivatequery) or die ("Couldn't deactivate because:<br />\n".mysql_error()."<br /><br />\n<a href='$scriptname?sid=$sid'>Admin</a>\n");
		echo "<span style='display: block; text-align: center; width: 70%'>\n"
			._TC_TOKENSGONE."<br />\n"
			."has been made, and is called \"{$dbprefix}old_tokens_{$_GET['sid']}_$date\". This can be<br />\n"
			."recovered by a systems administrator.<br /><br />\n"
			."<input type='submit' $btstyle value='"
			._GO_ADMIN."' onClick=\"window.open('$scriptname?sid={$_GET['sid']}', '_top')\" />\n"
			."</span>\n";
		}
	echo "</td></tr></table>\n"
		."<table height='1'><tr><td></td></tr></table>\n";

	}	


if (returnglobal('action') == "email")
	{
	echo "\t<tr bgcolor='#555555'><td colspan='2' height='4'><font size='1' face='verdana' color='white'><b>"
		._EMAILINVITE.":</b></td></tr>\n"
		."\t<tr><td colspan='2' align='center'>\n";
	if (!isset($_POST['ok']) || !$_POST['ok'])
		{
		//GET SURVEY DETAILS
		$esquery = "SELECT * FROM {$dbprefix}surveys WHERE sid=$sid";
		$esresult = mysql_query($esquery);
		while ($esrow = mysql_fetch_array($esresult))
			{
			$surveyname = $esrow['short_title'];
			$surveydescription = $esrow['description'];
			$surveyadmin = $esrow['admin'];
			$surveyadminemail = $esrow['adminemail'];
			$surveytemplate = $esrow['template'];
			}
		if (!$surveyadminemail) {$surveyadminemail=$siteadminemail; $surveyadmin=$siteadminname;}
		echo "<table width='100%' align='center' bgcolor='#DDDDDD'>\n"
			."<form method='post'>\n";
		//echo "\t<tr><td colspan='2' bgcolor='#555555' align='center'>$setfont<font color='white'><b>Send Invitation";
		if (isset($_GET['tid']) && $_GET['tid']) {echo " to TokenID No {$_GET['tid']}";}
		echo "</b></td></tr>\n"
			."\t<tr>\n"
			."\t\t<td align='right'>$setfont<b>"._FROM.":</b></td>\n"
			."\t\t<td><input type='text' $slstyle size='50' name='from' value='$surveyadmin <$surveyadminemail>' /></td>\n"
			."\t</tr>\n"
			."\t<tr>\n"
			."\t\t<td align='right'>$setfont<b>"._SUBJECT.":</b></td>\n";
		$subject=str_replace("{SURVEYNAME}", $surveyname, _TC_INVITESUBJECT);
		echo "\t\t<td><input type='text' $slstyle size='50' name='subject' value='$subject' /></td>\n"
			."\t</tr>\n"
			."\t<tr>\n"
			."\t\t<td align='right' valign='top'>$setfont<b>"._MESSAGE.":</b></td>\n"
			."\t\t<td>\n"
			."\t\t\t<textarea name='message' rows='10' cols='80' style='background-color: #EEEFFF; font-family: verdana; font-size: 10; color: #000080'>\n";
		//CHECK THAT INVITATION FILE EXISTS IN SURVEY TEMPLATE FOLDER - IF NOT, GO TO DEFAULT TEMPLATES. IF IT STILL DOESN'T EXIST - CRASH
		if (!is_dir("$publicdir/templates/$surveytemplate")) {$surveytemplate = "default";}
		if (!is_file("$publicdir/templates/$surveytemplate/invitationemail.pstpl"))
			{
			if ($surveytemplate == "default")
				{
				echo "<b><font color='red'>"._ERROR."</b></font><br />\n"
					._TC_NOEMAILTEMPLATE."\n"
					."</td></tr></table>\n";
				exit;
				}
			else
				{
				$surveytemplate = "default";
				if (!is_file("$publicdir/templates/$surveytemplate/invitationemail.pstpl"))
					{
					echo "<b><font color='red'>"._ERROR."</b></font><br />\n"
						._TC_NOEMAILTEMPLATE."\n"
						."</td></tr></table>\n";
					exit;
					}
				}
			}
		foreach(file("$publicdir/templates/$surveytemplate/invitationemail.pstpl") as $op)
			{
			$textarea = $op;
			$textarea = str_replace("{ADMINNAME}", $surveyadmin, $textarea);
			$textarea = str_replace("{ADMINEMAIL}", $surveyadminemail, $textarea);
			$textarea = str_replace("{SURVEYNAME}", $surveyname, $textarea);
			$textarea = str_replace("{SURVEYDESCRIPTION}", $surveydescription, $textarea);
			echo $textarea;
			}
		echo "\t\t\t</textarea>\n"
			."\t\t</td>\n"
			."\t</tr>\n"
			."\t<tr><td></td><td align='left'><input type='submit' $btstyle value='"
			._TC_SENDEMAIL."'></td></tr>\n"
			."\t<input type='hidden' name='ok' value='absolutely' />\n"
			."\t<input type='hidden' name='sid' value='{$_GET['sid']}' />\n"
			."\t<input type='hidden' name='action' value='email' />\n";
		if (isset($_GET['tid']) && $_GET['tid']) {echo "\t<input type='hidden' name='tid' value='{$_GET['tid']}'";}
		echo "</form>\n"
			."</table>\n";
		}
	else
		{
		echo _TC_SENDINGEMAILS;
		if (isset($_POST['tid']) && $_POST['tid']) {echo " ("._TO." TID: {$_POST['tid']})";}
		echo "<br />\n";
		$ctquery = "SELECT firstname FROM {$dbprefix}tokens_{$_POST['sid']} WHERE completed !='Y' AND sent !='Y' AND token !='' AND email != ''";
		if (isset($_POST['tid']) && $_POST['tid']) {$ctquery .= " and tid='{$_POST['tid']}'";}
		echo "<!-- ctquery: $ctquery -->\n";
		$ctresult = mysql_query($ctquery) or die("Database error!<br />\n" . mysql_error());
		$ctcount = mysql_num_rows($ctresult);
		$emquery = "SELECT firstname, lastname, email, token, tid FROM {$dbprefix}tokens_{$_POST['sid']} WHERE completed != 'Y' AND sent != 'Y' AND token !='' AND email != ''";
		if (isset($_POST['tid']) && $_POST['tid']) {$emquery .= " and tid='{$_POST['tid']}'";}
		$emquery .= " LIMIT $maxemails";
		echo "\n\n<!-- emquery: $emquery -->\n\n";
		$emresult = mysql_query($emquery) or die ("Couldn't do query.<br />\n$emquery<br />\n".mysql_error());
		$emcount = mysql_num_rows($emresult);
		$headers = "From: {$_POST['from']}\r\n";
		$headers .= "X-Mailer: $sitename Emailer (PHPSurveyor.sourceforge.net)";  
		$message = strip_tags($_POST['message']);
		$message = str_replace("&quot;", '"', $message);
		if (get_magic_quotes_gpc() != "0")
			{$message = stripcslashes($message);}
		echo "<table width='500px' align='center' bgcolor='#EEEEEE'>\n"
			."\t<tr>\n"
			."\t\t<td><font size='1'>\n";
		if ($emcount > 0)
			{
			while ($emrow = mysql_fetch_array($emresult))
				{
				//$to = $emrow['email'];
				$to = $emrow['email'];
				$sendmessage = $message;
				$sendmessage = str_replace("{FIRSTNAME}", $emrow['firstname'], $sendmessage);
				$sendmessage = str_replace("{LASTNAME}", $emrow['lastname'], $sendmessage);
				$sendmessage = str_replace("{SURVEYURL}", "$publicurl/index.php?sid=$sid&token={$emrow['token']}", $sendmessage);
				mail($to, $_POST['subject'], $sendmessage, $headers);
				$udequery = "UPDATE {$dbprefix}tokens_{$_POST['sid']} SET sent='Y' WHERE tid={$emrow['tid']}";
				$uderesult = mysql_query($udequery) or die ("Couldn't update tokens<br />$udequery<br />".mysql_error());
				echo "["._TC_INVITESENTTO."{$emrow['firstname']} {$emrow['lastname']} ($to)]<br />\n";
				}
			if ($ctcount > $emcount)
				{
				$lefttosend = $ctcount-$maxemails;
				echo "\t\t</td>\n"
					."\t</tr>\n"
					."\t<tr>\n"
					."\t\t<td align='center'>$setfont<b>"._WARNING."</b><br />\n"
					."\t\t\t<form method='post'>\n"
					._TC_EMAILSTOGO."<br /><br />\n";
				echo str_replace("{EMAILCOUNT}", "$lefttosend", _TC_EMAILSREMAINING);
				echo "<br /><br />\n";
				$message = str_replace('"', "&quot;", $message);
				echo "\t\t\t<input type='submit' value='"._CONTINUE."' />\n"
					."\t\t\t<input type='hidden' name='ok' value=\"absolutely\" />\n"
					."\t\t\t<input type='hidden' name='action' value=\"email\" />\n"
					."\t\t\t<input type='hidden' name='sid' value=\"{$_POST['sid']}\" />\n"
					."\t\t\t<input type='hidden' name='from' value=\"{$_POST['from']}\" />\n"
					."\t\t\t<input type='hidden' name='subject' value=\"{$_POST['subject']}\" />\n"
					."\t\t\t<input type='hidden' name='message' value=\"$message\" />\n"
					."\t\t\t</form>\n";
				}
			}
		else
			{
			echo "<center><b>"._WARNING."</b><br />\n"._TC_NONETOSEND."</center>\n";
			}
		echo "\t\t</td>\n";
		
		}
	echo "</td></tr></table>\n";
	}
	
if (returnglobal('action') == "remind")
	{
	echo "\t<tr bgcolor='#555555'><td colspan='2' height='4'><font size='1' face='verdana' color='white'><b>"
		._EMAILREMIND.":</b></td></tr>\n"
		."\t<tr><td colspan='2' align='center'>\n";
	if (!isset($_POST['ok']) || !$_POST['ok'])
		{
		//GET SURVEY DETAILS
		$esquery = "SELECT * FROM {$dbprefix}surveys WHERE sid=$sid";
		$esresult = mysql_query($esquery);
		while ($esrow = mysql_fetch_array($esresult))
			{
			$surveyname = $esrow['short_title'];
			$surveydescription = $esrow['description'];
			$surveyadmin = $esrow['admin'];
			$surveyadminemail = $esrow['adminemail'];
			$surveytemplate = $esrow['template'];
			}
		echo "<table width='100%' align='center' bgcolor='#DDDDDD'>\n"
			."\t<form method='post' action='tokens.php'>\n"
			."\t<tr>\n"
			."\t\t<td align='right' width='150'>$setfont<b>"._FROM.":</td>\n"
			."\t\t<td><input type='text' $slstyle size='50' name='from' value='$surveyadmin <$surveyadminemail>' /></td>\n"
			."\t</tr>\n"
			."\t<tr>\n"
			."\t\t<td align='right' width='150'>$setfont<b>"._SUBJECT.":</td>\n";
		$subject=str_replace("{SURVEYNAME}", $surveyname, _TC_REMINDSUBJECT);
		echo "\t\t<td><input type='text' $slstyle size='50' name='subject' value='$subject' /></td>\n"
			."\t</tr>\n";
		if (!isset($_GET['tid']) || !$_GET['tid'])
			{
			echo "\t<tr>\n"
				."\t\t<td align='right' width='150' valign='top'>$setfont<b>"._TC_REMINDSTARTAT."</b></td>\n"
				."\t\t<td><input type='text' $slstyle size='5' name='last_tid' /></td>\n"
				."\t</tr>\n";
			}
		else
			{
			echo "\t<tr>\n"
				."\t\t<td align='right' width='150' valign='top'>$setfont<b>"._TC_REMINDTID."</b></td>\n"
				."\t\t<td>$setfont{$_GET['tid']}</td>\n"
				."\t</tr>\n";
			}
		echo "\t<tr>\n"
			."\t\t<td align='right' width='150' valign='top'>$setfont<b>"._MESSAGE.":</b></td>\n"
			."\t\t<td>\n"
			."\t\t\t<textarea name='message' rows='10' cols='80' style='background-color: #EEEFFF; font-family: verdana; font-size: 10; color: #000080'>\n";
		//CHECK THAT INVITATION FILE EXISTS IN SURVEY TEMPLATE FOLDER - IF NOT, GO TO DEFAULT TEMPLATES. IF IT STILL DOESN'T EXIST - CRASH
		if (!is_dir("$publicdir/templates/$surveytemplate")) {$surveytemplate = "default";}
		if (!is_file("$publicdir/templates/$surveytemplate/reminderemail.pstpl"))
			{
			if ($surveytemplate == "default")
				{
				echo "<b><font color='red'>"._ERROR."</b></font><br />\n"
					._TC_NOREMINDTEMPLATE."\n";
				exit;
				}
			else
				{
				$surveytemplate = "default";
				if (!is_file("$publicdir/templates/$surveytemplate/reminderemail.pstpl"))
					{
					echo "<b><font color='red'>"._ERROR."</b></font><br />\n"
						._TC_NOREMINDTEMPLATE."\n";
					exit;
					}
				}
			}
		foreach(file("$publicdir/templates/$surveytemplate/reminderemail.pstpl") as $op)
			{
			$textarea = $op;
			$textarea = str_replace("{ADMINNAME}", $surveyadmin, $textarea);
			$textarea = str_replace("{ADMINEMAIL}", $surveyadminemail, $textarea);
			$textarea = str_replace("{SURVEYNAME}", $surveyname, $textarea);
			$textarea = str_replace("{SURVEYDESCRIPTION}", $surveydescription, $textarea);
			echo $textarea;
			}
		echo "\t\t\t</textarea>\n"
			."\t\t</td>\n"
			."\t</tr>\n"
			."\t<tr>\n"
			."\t\t<td></td>\n"
			."\t\t<td align='left'>\n"
			."\t\t\t<input type='submit' $btstyle value='"._TC_SENDREMIND."' />\n"
			."\t\t</td>\n"
			."\t</tr>\n"
			."\t<input type='hidden' name='ok' value='absolutely'>\n"
			."\t<input type='hidden' name='sid' value='{$_GET['sid']}'>\n"
			."\t<input type='hidden' name='action' value='remind'>\n";
		if (isset($_GET['tid']) && $_GET['tid']) {echo "\t<input type='hidden' name='tid' value='{$_GET['tid']}'>\n";}
		echo "\t</form>\n"
			."</table>\n";
		}
	else
		{
		echo _TC_SENDINGREMINDERS;
		if (isset($_POST['last_tid']) && $_POST['last_tid']) {echo " ("._FROM." TID: {$_POST['last_tid']})";}
		if (isset($_POST['tid']) && $_POST['tid']) {echo " ("._TO." TID: {$_POST['tid']})";}
		$ctquery = "SELECT firstname FROM {$dbprefix}tokens_{$_POST['sid']} WHERE completed !='Y' AND sent='Y' AND token !='' AND email != ''";
		if (isset($_POST['last_tid']) && $_POST['last_tid']) {$ctquery .= " AND tid > '{$_POST['last_tid']}'";}
		if (isset($_POST['tid']) && $_POST['tid']) {$ctquery .= " AND tid = '{$_POST['tid']}'";}
		$ctresult = mysql_query($ctquery);
		$ctcount = mysql_num_rows($ctresult);
		$emquery = "SELECT firstname, lastname, email, token, tid FROM {$dbprefix}tokens_{$_POST['sid']} WHERE completed != 'Y' AND sent = 'Y' AND token !='' AND EMAIL !=''";
		if (isset($_POST['last_tid']) && $_POST['last_tid']) {$emquery .= " AND tid > '{$_POST['last_tid']}'";}
		if (isset($_POST['tid']) && $_POST['tid']) {$emquery .= " AND tid = '{$_POST['tid']}'";}
		$emquery .= " ORDER BY tid LIMIT $maxemails";
		$emresult = mysql_query($emquery) or die ("Couldn't do query.<br />$emquery<br />".mysql_error());
		$emcount = mysql_num_rows($emresult);
		$headers = "From: {$_POST['from']}\r\n";
		$headers .= "X-Mailer: $sitename Email Reminder";  
		echo "<table width='500' align='center' bgcolor='#EEEEEE'>\n"
			."\t<tr>\n"
			."\t\t<td><font size='1'>\n";
		$message = strip_tags($_POST['message']);
		$message = str_replace("&quot;", '"', $message);
		if (get_magic_quotes_gpc() != "0")
			{$message = stripcslashes($message);}
		if ($emcount > 0)
			{
			while ($emrow = mysql_fetch_array($emresult))
				{
				$to = $emrow['email'];
				$sendmessage = $message;
				$sendmessage = str_replace("{FIRSTNAME}", $emrow['firstname'], $sendmessage);
				$sendmessage = str_replace("{LASTNAME}", $emrow['lastname'], $sendmessage);
				$sendmessage = str_replace("{SURVEYURL}", "$publicurl/index.php?sid=$sid&token={$emrow['token']}", $sendmessage);
				mail($to, $_POST['subject'], $sendmessage, $headers);
				echo "\t\t\t({$emrow['tid']})["._TC_REMINDSENTTO." {$emrow['firstname']} {$emrow['lastname']}]<br />\n";
				$lasttid = $emrow['tid'];
				}
			if ($ctcount > $emcount)
				{
				$lefttosend = $ctcount-$maxemails;
				echo "\t\t</td>\n"
					."\t</tr>\n"
					."\t<tr><form method='post' action='tokens.php'>\n"
					."\t\t<td align='center'>\n"
					."\t\t\t$setfont<b>"._WARNING."</b><br /><br />\n"
					._TC_EMAILSTOGO."<br /><br />\n"
					.str_replace("{EMAILCOUNT}", $lefttosend, _TC_EMAILSREMAINING)
					."<br />\n"
					."\t\t\t<input type='submit' value='"._CONTINUE."' />\n"
					."\t\t</td>\n"
					."\t<input type='hidden' name='ok' value=\"absolutely\" />\n"
					."\t<input type='hidden' name='action' value=\"remind\" />\n"
					."\t<input type='hidden' name='sid' value=\"{$_POST['sid']}\" />\n"
					."\t<input type='hidden' name='from' value=\"{$_POST['from']}\" />\n"
					."\t<input type='hidden' name='subject' value=\"{$_POST['subject']}\" />\n";
				$message = str_replace('"', "&quot;", $message);
				echo "\t<input type='hidden' name='message' value=\"$message\" />\n"
					."\t<input type='hidden' name='last_tid' value=\"$lasttid\" />\n"
					."\t</form>\n";
				}
			}
		else
			{
			echo "<center><b>"._WARNING."</b><br />\n"
				._TC_NOREMINDERSTOSEND."\n"
				."<br /><br />\n"
				."\t\t</td>\n";
			}
		echo "\t</tr>\n"
			."</table>\n";
		}
	echo "</td></tr></table>\n";
	}

	
if ($action == "tokenify")
	{
	echo "\t<tr bgcolor='#555555'><td colspan='2' height='4'><font size='1' face='verdana' color='white'><b>"._TOKENIFY.":</b></td></tr>\n";
	echo "\t<tr><td align='center'>$setfont<br />\n";
	if (!isset($_GET['ok']) || !$_GET['ok'])
		{
		echo "<br />$setfont"._TC_CREATETOKENSINFO."<br /><br />\n"
			."<input type='submit' $btstyle value='"
			._AD_YES."' onClick=\"window.open('tokens.php?sid=$sid&action=tokenify&ok=Y', '_top')\" />\n"
			."<input type='submit' $btstyle value='"
			._AD_NO."' onClick=\"window.open('tokens.php?sid=$sid', '_top')\" />\n"
			."<br /><br />\n";
		}
	else
		{
		if (phpversion() < "4.2.0")
			{
			srand((double)microtime()*1000000);
			}
		$newtokencount = 0;
		$tkquery = "SELECT * FROM {$dbprefix}tokens_$sid WHERE token IS NULL OR token=''";
		$tkresult = mysql_query($tkquery) or die ("Mucked up!<br />$tkquery<br />".mysql_error());
		while ($tkrow = mysql_fetch_array($tkresult))
			{
			$insert = "NO";
			while ($insert != "OK")
				{
				if ($THISOS == "solaris")
					{
					$nt1=mysql_query("SELECT RAND()");
					while ($row=mysql_fetch_row($nt1)) {$newtoken=(int)(sprintf("%010s", $row[0]*1000000000));}
					}
				else
					{
					$newtoken = sprintf("%010s", rand(1, 10000000000));
					}
				$ntquery = "SELECT * FROM {$dbprefix}tokens_$sid WHERE token='$newtoken'";
				$ntresult = mysql_query($ntquery);
				if (!mysql_num_rows($ntresult)) {$insert = "OK";}
				}
			$itquery = "UPDATE {$dbprefix}tokens_$sid SET token='$newtoken' WHERE tid={$tkrow['tid']}";
			$itresult = mysql_query($itquery);
			$newtokencount++;
			}
		$message=str_replace("{TOKENCOUNT}", $newtokencount, _TC_TOKENSCREATED);
		echo "<br /><b>$message</b><br /><br />\n";
		}
	echo "\t</td></tr></table>\n";
	}


if ($action == "delete")
	{
	$dlquery = "DELETE FROM {$dbprefix}tokens_$sid WHERE tid={$_GET['tid']}";
	$dlresult = mysql_query($dlquery) or die ("Couldn't delete record {$_GET['tid']}<br />".mysql_error());
	echo "\t<tr bgcolor='#555555'><td colspan='2' height='4'><font size='1' face='verdana' color='white'><b>"
		._DELETE."</b></td></tr>\n"
		."\t<tr><td align='center'>$setfont<br />\n"
		."<br /><b>"._TC_TOKENDELETED."</b><br />\n"
		."<font size='1'><i>"._RELOADING."</i><br /><br /></font>\n"
		."\t</td></tr></table>\n";
	}


if ($action == "edit" || $action == "addnew")
	{
	if ($action == "edit")
		{
		$edquery = "SELECT * FROM {$dbprefix}tokens_$sid WHERE tid={$_GET['tid']}";
		$edresult = mysql_query($edquery);
		while($edrow = mysql_fetch_array($edresult))
			{
			//Create variables with the same names as the database column names and fill in the value
			foreach ($edrow as $Key=>$Value) {$$Key = $Value;}
			}
		}
	echo "\t<tr bgcolor='#555555'><td colspan='2' height='4'><font size='1' face='verdana' color='white'><b>"
		._TC_ADDEDIT."</b></td></tr>\n"
		."\t<tr><td align='center'>\n"
		."<table width='100%' bgcolor='#CCCCCC' align='center'>\n"
		."<form method='post' action='tokens.php'>\n"
		."<tr>\n"
		."\t<td align='right' width='20%'>$setfont<b>ID:</b></td><td bgcolor='#EEEEEE'>$setfont Auto</td>\n"
		."</tr>\n"
		."<tr>\n"
		."\t<td align='right' width='20%'>$setfont<b>"._TL_FIRST.":</b></td>\n"
		."\t<td bgcolor='#EEEEEE'>$setfont<input type='text' $slstyle size='30' name='firstname' value='";
	if (isset($firstname)) {echo $firstname;}
	echo "'></td>\n"
		."</tr>\n"
		."<tr>\n"
		."\t<td align='right' width='20%'>$setfont<b>"._TL_LAST.":</b></td>\n"
		."\t<td bgcolor='#EEEEEE'>$setfont<input type='text' $slstyle size='30' name='lastname' value='";
	if (isset($lastname)) {echo $lastname;}
	echo "'></td>\n"
		."</tr>\n"
		."<tr>\n"
		."\t<td align='right' width='20%'>$setfont<b>"._TL_EMAIL.":</b></td>\n"
		."\t<td bgcolor='#EEEEEE'>$setfont<input type='text' $slstyle size='50' name='email' value='";
	if (isset($email)) {echo $email;}
	echo "'></td>\n"
		."</tr>\n"
		."<tr>\n"
		."\t<td align='right' width='20%'>$setfont<b>"._TL_TOKEN.":</b></td>\n"
		."\t<td bgcolor='#EEEEEE'>$setfont<input type='text' size='15' $slstyle name='token' value='";
	if (isset($token)) {echo $token;}
	echo "'>\n";
	if ($action == "addnew")
		{
		echo "\t\t$setfont<font size='1' color='red'>"._TC_TOKENCREATEINFO."</font></font>\n";
		}
	echo "\t</td>\n"
		."</tr>\n"
		."<tr>\n"
		."\t<td align='right' width='20%'>$setfont<b>"._TL_INVITE.":</b></td>\n"
		."\t<td bgcolor='#EEEEEE'>$setfont<input type='text' size='1' $slstyle name='sent' value='";
	if (isset($sent)) {echo $sent;}	
	echo "'></td>\n"
		."</tr>\n"
		."<tr>\n"
		."\t<td align='right' width='20%'>$setfont<b>"._TL_DONE.":</b></td>\n"
		."\t<td bgcolor='#EEEEEE'>$setfont<input type='text' size='1' $slstyle name='completed' value='";
	if (isset($completed)) {echo $completed;}
	echo "'></td>\n"
		."</tr>\n"
		."<tr>\n"
		."\t<td colspan='2' align='center'>";
	switch($action)
		{
		case "edit":
			echo "\t\t<input type='submit' $btstyle name='action' value='"._UPDATE."'>\n"
				."\t\t<input type='hidden' name='tid' value='{$_GET['tid']}'>\n";
			break;
		case "addnew":
			echo "\t\t<input type='submit' $btstyle name='action' value='"._ADD."'>\n";
			break;
		}
	echo "\t\t<input type='hidden' name='sid' value='$sid'>\n"
		."\t</td>\n"
		."</tr>\n</form>\n"
		."</table>\n"
		."</td></tr></table>\n";
	}


if ($action == _UPDATE)
	{
	echo "\t<tr bgcolor='#555555'><td colspan='2' height='4'><font size='1' face='verdana' color='white'><b>"
		._TC_ADDEDIT."</b></td></tr>\n"
		."\t<tr><td align='center'>\n";
	$udquery = "UPDATE {$dbprefix}tokens_$sid SET firstname='{$_POST['firstname']}', lastname='{$_POST['lastname']}', email='{$_POST['email']}', token='{$_POST['token']}', sent='{$_POST['sent']}', completed='{$_POST['completed']}' WHERE tid={$_POST['tid']}";
	$udresult = mysql_query($udquery) or die ("Update record {$_POST['tid']} failed:<br />\n$udquery<br />\n".mysql_error());
	echo "<br />$setfont<font color='green'><b>"._SUCCESS."</b></font><br />\n"
		."<br />"._TC_TOKENUPDATED."<br /><br />\n"
		."<a href='tokens.php?sid=$sid&action=browse'>"._T_ALL_BT."</a><br /><br />\n"
		."\t</td></tr></table>\n";
	}


if ($action == _ADD)
	{
	echo "\t<tr bgcolor='#555555'><td colspan='2' height='4'><font size='1' face='verdana' color='white'><b>"
		._TC_ADDEDIT."</b></td></tr>\n"
		."\t<tr><td align='center'>\n";
	$inquery = "INSERT into {$dbprefix}tokens_$sid \n";
	$inquery .= "(firstname, lastname, email, token, sent, completed) \n";
	$inquery .= "VALUES ('{$_POST['firstname']}', '{$_POST['lastname']}', '{$_POST['email']}', '{$_POST['token']}', '{$_POST['sent']}', '{$_POST['completed']}')";
	$inresult = mysql_query($inquery) or die ("Add new record failed:<br />\n$inquery<br />\n".mysql_error());
	echo "<br />$setfont<font color='green'><b>"._SUCCESS."</b></font><br />\n"
		."<br />"._TC_TOKENADDED."<br /><br />\n"
		."<a href='tokens.php?sid=$sid&action=browse'>"._T_ALL_BT."</a><br />\n"
		."<a href='tokens.php?sid=$sid&action=browse'>"._T_ADD_BT."</a><br /><br />\n"
		."\t</td></tr></table>\n";
	}


if ($action == "import") 
	{
	echo "\t<tr bgcolor='#555555'><td colspan='2' height='4'><font size='1' face='verdana' color='white'><b>"
		._UPLOADCSV."</b></td></tr>\n"
		."\t<tr><td align='center'>\n";
	form();
	echo "<table width='400' bgcolor='#eeeeee'>\n"
		."\t<tr>\n"
		."\t\t<td align='center'>\n"
		."\t\t\t<font size='1'><b>Note:</b><br />\n"
		."\t\t\t"._TC_UPLOADINFO."</i>\n"
		."\t\t</td>\n"
		."\t</tr>\n"
		."</table><br />\n"
		."</td></tr></table>\n";
	}


if ($action == "upload") 
	{
	echo "\t<tr bgcolor='#555555'><td colspan='2' height='4'><font size='1' face='verdana' color='white'><b>"
		._UPLOADCSV."</b></td></tr>\n"
		."\t<tr><td align='center'>\n";
	$the_path = "$homedir";
	$the_file_name = $_FILES['the_file']['name'];
	$the_file = $_FILES['the_file']['tmp_name'];
	$the_full_file_path = $homedir."/".$the_file_name;
	if (!@move_uploaded_file($the_file, $the_full_file_path))
		{
		$errormessage="<b><font color='red'>"._ERROR.":</font> "._TC_UPLOADFAIL."</b>\n";
		form($errormessage);
		}
		else
		{
		echo "<br /><b>"._TC_IMPORT."</b><br />\n<font color='green'>"._SUCCESS."</font><br /><br />\n"
			._TC_CREATE."<br />\n";
		$xz = 0; $xx = 0;
		$handle = fopen($the_full_file_path, "r");
		if ($handle == false) {echo "Failed to open the uploaded file!\n";}
		while (!feof($handle))
			{
			$buffer = fgets($handle, 4096);
			
			//Delete trailing CR from Windows files.
			//Macintosh files end lines with just a CR, which fgets() doesn't handle correctly.
			//It will read the entire file in as one line.
			if (substr($buffer, -1) == "\n") {$buffer = substr($buffer, 0, -1);}
			
			//echo "$xx:".$buffer."<br />\n"; //Debugging info
			$firstname = ""; $lastname = ""; $email = ""; $token = ""; //Clear out values from the last path, in case the next line is missing a value
			if (!$xx)
				{
				//THIS IS THE FIRST LINE. IT IS THE HEADINGS. IGNORE IT
				}
			else
				{
				if (phpversion() >= "4.3.0")
					{
					$line = explode(",", mysql_real_escape_string($buffer));
					}
				else
					{
					$line = explode(",", mysql_escape_string($buffer));
					}
				$elements = count($line); 
				if ($elements > 1)
					{
					$xy = 0;
					foreach($line as $el)
						{
						//echo "[$el]($xy)<br />\n"; //Debugging info
						if ($xy < $elements)
							{
							if ($xy == 0) {$firstname = $el;}
							if ($xy == 1) {$lastname = $el;}
							if ($xy == 2) {$email = $el;}
							if ($xy == 3) {$token = $el;}
							}
						$xy++;
						}
					//CHECK FOR DUPLICATES?
					$iq = "INSERT INTO {$dbprefix}tokens_$sid \n"
						. "(firstname, lastname, email, token) \n"
						. "VALUES ('$firstname', '$lastname', '$email', '$token')";
					//echo "<pre style='text-align: left'>$iq</pre>\n"; //Debugging info
					$ir = mysql_query($iq) or die ("Couldn't insert line<br />\n$buffer<br />\n".mysql_error()."<pre style='text-align: left'>$iq</pre>\n");
					$xz++;
					}
				}
			$xx++;
			}
		echo "<font color='green'>"._SUCCESS."</font><br /><br>\n";
		$message=str_replace("{TOKENCOUNT}", $xz, _TC_TOKENS_CREATED);
		echo "<i>$message</i><br />\n";
		fclose($handle);
		unlink($the_full_file_path);
		}
	echo "</td></tr></table>\n";
	}

//echo "ACTION: $action (POST: {$_POST['action']})<br />THEFILE: $the_file (FILES: {$_FILES['the_file']['tmp_name']})<br />THEFILENAME: $the_file_name (FILES: {$_FILES['the_file']['name']})";
echo "</center>\n"
	."&nbsp;"
	."<table height='1'><tr><td></td></tr></table>\n";

echo "</td>\n"
	.helpscreen()
	."</tr></table>\n";

echo htmlfooter("instructions.html#tokens", "Using PHPSurveyors Tokens Function")
	."</body>\n</html>";


function form($error=false) {
global $sid, $btstyle, $slstyle, $setfont;

	if ($error) {print $error . "<br /><br />\n";}
	
	print "\n<form enctype='multipart/form-data' action='" . $_SERVER['PHP_SELF'] . "' method='post'>\n"
		. "<input type='hidden' name='action' value='upload' />\n"
		. "<input type='hidden' name='sid' value='$sid' />\n"
		. "$setfont Upload a file<br />\n"
		. "<input type='file' $slstyle name='the_file' size='35' /><br />\n"
		. "<input type='submit' $btstyle value='Upload' />\n"
		. "</form>\n\n";

} # END form

function helpscreen()
	{
	global $homeurl, $langdir;
	global $action;
	echo "\t\t<td id='help' width='150' valign='top' style='display: none' bgcolor='#CCCCCC'>\n"
		."\t\t\t<table width='100%'><tr><td><table width='100%' height='100%' align='center' cellspacing='0'>\n"
		."\t\t\t\t<tr>\n"
		."\t\t\t\t\t<td bgcolor='#555555' height='8'>\n"
		."\t\t\t\t\t\t<font color='white' size='1'><b>"._HELP."\n"
		."\t\t\t\t\t</td>\n"
		."\t\t\t\t</tr>\n"
		."\t\t\t\t<tr>\n"
		."\t\t\t\t\t<td align='center' bgcolor='#AAAAAA' style='border-style: solid; border-width: 1; border-color: #555555'>\n"
		."\t\t\t\t\t\t<img src='./images/blank.gif' width='20' hspace='0' border='0' align='left'>\n"
		."\t\t\t\t\t\t<input type='image' src='./images/close.gif' align='right' border='0' hspace='0' onClick=\"showhelp('hide')\">\n"
		."\t\t\t\t\t</td>\n"
		."\t\t\t\t</tr>\n"
		."\t\t\t\t<tr>\n"
		."\t\t\t\t\t<td bgcolor='silver' height='100%' style='border-style: solid; border-width: 1; border-color: #333333'>\n";
	//determine which help document to show
	$helpdoc = "$langdir/tokens.html";
	switch ($action)
		{
		case "browse":
			$helpdoc .= "#Display Tokens";
			break;
		case "email":
			$helpdoc .= "#Email Invitiation";
			break;
		case "addnew":
			$helpdoc .= "#Add new token entry";
			break;
		case "import":
			$helpdoc .= "#Import/Upload CSV File";
			break;
		case "tokenify":
			$helpdoc .= "#Generate Tokens";
			break;
		}
	echo "\t\t\t\t\t\t<iframe width='150' height='400' src='$helpdoc' marginwidth='2' marginheight='2'>\n"
		."\t\t\t\t\t\t</iframe>\n"
		."\t\t\t\t\t</td>"
		."\t\t\t\t</tr>\n"
		."\t\t\t</table></td></tr></table>\n"
		."\t\t</td>\n";
	}
?>