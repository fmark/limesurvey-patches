<?php
/*
	#############################################################
	# >>> PHP Surveyor  										#
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

require_once("./admin/config.php");
if (!isset($surveyid)) {$surveyid=returnglobal('sid');}
if (!isset($thistpl)) {die ("Error!");}
sendcacheheaders();
echo "<html>\n";
foreach(file("$thistpl/startpage.pstpl") as $op)
	{
	echo templatereplace($op);
	}
echo "\n\n<!-- JAVASCRIPT FOR CONDITIONAL QUESTIONS -->\n"
	."\t<script type='text/javascript'>\n"
	."\t<!--\n"
	."\t\tfunction checkconditions(value, name, type)\n"
	."\t\t\t{\n"
	."\t\t\t}\n"
	."\t//-->\n"
	."\t</script>\n\n";

echo "<form method='post' action='index.php'>\n";
foreach(file("$thistpl/load.pstpl") as $op)
	{
	echo templatereplace($op);
	}
//PRESENT OPTIONS SCREEN (Replace with Template Later)
//END
echo "<input type='hidden' name='PHPSESSID' value='".session_id()."'>\n";
echo "<input type='hidden' name='sid' value='$surveyid'>\n";
echo "<input type='hidden' name='loadall' value='reload'>\n";
echo "</form>";

foreach(file("$thistpl/endpage.pstpl") as $op)
	{
	echo templatereplace($op);
	}
echo "</html>\n";
exit;
?>