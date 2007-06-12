<?php
/*
#############################################################
# >>> LimeSurvey  								    		#
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
//SESSIONCONTROL.PHP FILE MANAGES ADMIN SESSIONS. 
//Ensure script is not run directly, avoid path disclosure

if (!isset($dbprefix)) {die ("Cannot run this script directly");}

session_name("LimeSurveyAdmin");
if (session_id() == "") session_start();
//LANGUAGE ISSUES
// if changelang is called from the login page, then there is no userId 
//  ==> thus we just change the login form lang: no user profile update
// if changelang is called from another form (after login) then update user lang
// when a loginlang is specified at login time, the user profile is updated in usercontrol.php 
if (returnglobal('action') == "changelang" && (!isset($login) || !$login ))	
	{
	$_SESSION['adminlang']=returnglobal('lang');
	// if user is logged in update language in database
	if(isset($_SESSION['loginID']))
		{
		$uquery = "UPDATE {$dbprefix}users SET lang='{$_SESSION['adminlang']}' WHERE uid={$_SESSION['loginID']}";	//		added by Dennis
		$uresult = $connect->Execute($uquery);
		}
	}
elseif (!isset($_SESSION['adminlang']) || $_SESSION['adminlang']=='' )
	{
	$_SESSION['adminlang']=$defaultlang;
	}
// OLD LANGUAGE SETTING
//SetInterfaceLanguage($_SESSION['adminlang']);

// Construct the language class, and set the language.
require_once($rootdir.'/classes/core/language.php');
$clang = new limesurvey_lang($_SESSION['adminlang']);

// get user rights
if(isset($_SESSION['loginID'])) {GetSessionUserRights($_SESSION['loginID']);}
	


function GetSessionUserRights($loginID)
{
	global $dbprefix,$connect; 
	$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
    $squery = "SELECT create_survey, configurator, create_user, delete_user, move_user, manage_template, manage_label FROM {$dbprefix}users WHERE uid=$loginID";	//		added by Dennis
	$sresult = $connect->Execute($squery);
	if(@$fields = $sresult->FetchRow())
		{
		$_SESSION['USER_RIGHT_CREATE_SURVEY'] = $fields['create_survey'];
		$_SESSION['USER_RIGHT_CONFIGURATOR'] = $fields['configurator'];
		$_SESSION['USER_RIGHT_CREATE_USER'] = $fields['create_user'];
		$_SESSION['USER_RIGHT_DELETE_USER'] = $fields['delete_user'];
		$_SESSION['USER_RIGHT_MOVE_USER'] = $fields['move_user'];
		$_SESSION['USER_RIGHT_MANAGE_TEMPLATE'] = $fields['manage_template'];
		$_SESSION['USER_RIGHT_MANAGE_LABEL'] = $fields['manage_label'];
		}
}


	
?>
