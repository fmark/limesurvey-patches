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
    # Foundation; either version 2 of the License, or (at your  #
    # option) any later version.                                #
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

Redesigned 7/25/2006 - swales

1.  Save Feature (// --> START NEW FEATURE - SAVE)

	How it used to work
	-------------------
	1. The old save method would save answers to the "survey_x" table only when the submit button was clicked.
	2. If "allow saves" was turned on then answers were temporarily recorded in the "saved" table.

	Why change this feature?
	------------------------
	1. If a user did not complete a survey, ALL their answers were lost since no submit (database insert) was performed.

	2. The old save design did allow for a person to reload their saved survey, but it did not support
	   multiple users working on the same survey at the same time.  Issues included saving only at the end, or
	   when a user clicked the "Save so far" button.  During this save/update ALL the answers were updated, not
	   just the ones modified.  This would cause the 'last one to save' wins issue.  It also did not reload
	   answers between pages (group by group), so if someone else was working on the same survey instance you
	   did not see their updates on your instance.

	Save Feature redesign
	---------------------
	Benefits
	1. Partial survey answers are saved (provided at least Next/Prev/Last/Submit/Save so far clicked at least once).
	2. Multiple users can work on same survey instance at same time.
	3. Each page keeps track of fields modified and only those are updated in database.
	4. Answers are reloaded after each page save, so if other people are changing them the current user will see updates.

	Details.
	1. The answers are saved in the "survey_x" table only.  The "saved" table is no longer used.
	2. The "saved_control" table has new column (srid) that points to the "survey_x" record it corresponds to.
	3. Answers are saved every time you move between pages (Next,Prev,Last,Submit, or Save so far).
	4. Only the fields modified on the page are updated. A new hidden field "modfields" store which fields have changed.
	5. Answered are reloaded from the database after the save so that if some other answers were modified by someone else
	   the updates would be picked up for the current page.  There is still an issue if two people modify the same 
	   answer at the same time.. the 'last one to save' wins.
	6. The survey_x datestamp field is updated every time the record is updated.
	7. Template can now contain {DATESTAMP} to show the last modified date/time.
	8. A new field 'submitdate' has been added to the survey_x table and is written when the submit button is clicked.

	Notes
	-----
	1. A new column SRID has been added to saved_control.
	2. saved table no longer exists.
*/
global $connect;
//First, save the posted data to session 
//Doing this ensures that answers on the current page are saved as well.
//CONVERT POSTED ANSWERS TO SESSION VARIABLES
if (isset($_POST['fieldnames']) && $_POST['fieldnames'])
	{
	$postedfieldnames=explode("|", $_POST['fieldnames']);
	foreach ($postedfieldnames as $pf)
		{
		if (isset($_POST[$pf])) {$_SESSION[$pf] = $_POST[$pf];}
		if (!isset($_POST[$pf])) {$_SESSION[$pf] = "";}
		}

	if ($thissurvey['active'] == "Y") 	// Only save if active
		{
		// SAVE DATA TO SURVEY_X RECORD
		$subquery = createinsertquery();
		if ($result=$connect->Execute($subquery))
			{
			$srid = $connect->Insert_ID();
			}
		if ($srid > 0)
			{
			$_SESSION['srid'] = $srid;
			}
		}
	}

// RECORD submitdate IF SUBMITTED
if ((isset($_POST['move']) && $_POST['move'] == " "._SUBMIT." ") && (isset($_SESSION['srid']) && $_SESSION['srid'] > 0))
	{
	$query = "UPDATE {$thissurvey['tablename']} SET ";
	$query .= "submitdate = '".date("Y-m-d H:i:s")."' ";
	$query .= "WHERE id=" . $_SESSION['srid'];
	$result=$connect->Execute($query) or die("Couldn't update existing saved survey.<br />$query<br />".htmlspecialchars($connect->ErrorMsg()));
	}

// CREATE SAVED CONTROL RECORD USING SAVE FORM INFORMATION
if (isset($_POST['saveprompt']))
	{
	if ($thissurvey['active'] == "Y") 	// Only save if active
		{
		savedcontrol();
		}
	else
		{
		$_SESSION['scid'] = 0;		// If not active set to a dummy value to save form does not continue to show.
		$_SESSION['step']++;		// Moves to next page.
		}
	}

// DISPLAY SAVE FORM
// Displays even if not active just to show how it would look for real
if ($thissurvey['allowsave'] == "Y" && !isset($_SESSION['scid']))
	{
	// prompt to save
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
	//PRESENT OPTIONS SCREEN
	if (isset($errormsg) && $errormsg != "")
		{
		$errormsg .= "<p>"._SAVETRYAGAIN."</p>";
		}
	foreach(file("$thistpl/save.pstpl") as $op)
		{
		echo templatereplace($op);
		}
	//END
	echo "<input type='hidden' name='sid' value='$surveyid'>\n";
	echo "<input type='hidden' name='thisstep' value='0'>\n";
	echo "<input type='hidden' name='token' value='".returnglobal('token')."'>\n";
	echo "<input type='hidden' name='saveprompt' value='Y'>\n";
	echo "</form>";
	
	foreach(file("$thistpl/endpage.pstpl") as $op)
		{
		echo templatereplace($op);
		}
	echo "</html>\n";
	exit;
	}		

function savedcontrol()
{
//This data will be saved to the "saved_control" table with one row per response. 
// - a unique "saved_id" value (autoincremented)
// - the "sid" for this survey
// - the "srid" for the survey_x row id
// - "saved_thisstep" which is the step the user is up to in this survey
// - "saved_ip" which is the ip address of the submitter
// - "saved_date" which is the date ofthe saved response
// - an "identifier" which is like a username
// - a "password"
// - "fieldname" which is the fieldname of the saved response
// - "value" which is the value of the response
//We start by generating the first 5 values which are consistent for all rows.

global $connect, $surveyid, $dbprefix, $thissurvey, $errormsg, $publicurl, $sitename, $timeadjust;

//Check that the required fields have been completed.
$errormsg="";
if (!isset($_POST['savename']) || !$_POST['savename']) {$errormsg.=_SAVENONAME."<br />\n";}
if (!isset($_POST['savepass']) || !$_POST['savepass']) {$errormsg.=_SAVENOPASS."<br />\n";}
if (!isset($_POST['savepass']) && isset($_POST['savepass2']) && $_POST['savepass'] != $_POST['savepass2'])
	{$errormsg.=_SAVENOMATCH."<br />\n";}

if ($errormsg)
	{
	return;
	}
//All the fields are correct. Now make sure there's not already a matching saved item
$query = "SELECT COUNT(*) FROM {$dbprefix}saved_control\n"
		."WHERE sid=$surveyid\n"
		."AND identifier='".$_POST['savename']."'\n"
		."AND access_code='".md5($_POST['savepass'])."'\n";
$result = db_execute_num($query) or die("Error checking for duplicates!<br />$query<br />".htmlspecialchars($connect->ErrorMsg()));
list($count) = $result->FetchRow();
if ($count > 0)
	{
	$errormsg.=_SAVEDUPLICATE."<br />\n";
	return;
	}
else
	{
	if (!isset($_SESSION['srid']))
		{
		// INSERT BLANK RECORD INTO SURVEY_X
		if ($thissurvey['datestamp'] == "Y")
			{
		    	$_SESSION['datestamp']=date("Y-m-d H:i:s");
			}
		// INSERT NEW ROW
		$subquery = "INSERT INTO {$thissurvey['tablename']} "
				."(`id`";
		if ($thissurvey['datestamp'] == "Y")
			{
			$subquery .= ",`datestamp`";
			}
		if ($thissurvey['ipaddr'] == "Y")
			{
			$subquery .= ",`ipaddr`";
			}
		$subquery .=") ";
		$subquery .="VALUES (''";
		if ($thissurvey['datestamp'] == "Y")
			{
			$subquery .= ", '".$_SESSION['datestamp']."'";
			}
		if ($thissurvey['ipaddr'] == "Y")
			{
			$subquery .= ", '".$_SERVER['REMOTE_ADDR']."'";
			}
		$subquery .=")";

		if ($result=$connect->Execute($subquery))
			{
			$srid = $connect->Insert_ID();
			}
		if ($srid > 0)
			{
			// save $srid to session variable only if INSERT was performed
			$_SESSION['srid'] = $srid;
			}
		}
	

	//Create entry in "saved_control"
	$sdata = array("sid"=>$surveyid,
			"srid"=>$_SESSION['srid'],
			"identifier"=>$_POST['savename'],
			"access_code"=>md5($_POST['savepass']),
			"email"=>$_POST['saveemail'],
			"ip"=>$_SERVER['REMOTE_ADDR'],
			"refurl"=>$_SESSION['refurl'],
			"saved_thisstep"=>$_POST['thisstep'],
			"status"=>"S",
			"saved_date"=>date("Y-m-d H:i:s"));


	if ($connect->AutoExecute("{$dbprefix}saved_control", $sdata,'INSERT'))
		{
		$scid = $connect->Insert_ID();
		}

	// save $scid to session variable
	if ($scid > 0)
		{
		$_SESSION['scid'] = $scid;
		}
	$_SESSION['holdname']=$_POST['savename']; //Session variable used to load answers every page.
	$_SESSION['holdpass']=$_POST['savepass']; //Session variable used to load answers every page.
	
	//Email if needed
	if (isset($_POST['saveemail']))
		{
		if (validate_email($_POST['saveemail']))
			{
// --> START ENHANCEMENT
			$subject=_SAVE_EMAILSUBJECT . " - " . $thissurvey['name'];
// <-- END ENHANCEMENT
			$message=_SAVE_EMAILTEXT;
			$message.="\n\n".$thissurvey['name']."\n\n";
			$message.=_SAVENAME.": ".$_POST['savename']."\n";
			$message.=_SAVEPASSWORD.": ".$_POST['savepass']."\n\n";
			$message.=_SAVE_EMAILURL.":\n";
			$message.=$publicurl."/index.php?sid=$surveyid&loadall=reload&scid=".$scid."&loadname=".urlencode($_POST['savename'])."&loadpass=".urlencode($_POST['savepass']);

			if (returnglobal('token')){$message.="&token=".returnglobal('token');}				
			$from=$thissurvey['adminemail'];

			if (MailtextMessage($message, $subject, $_POST['saveemail'], $from, $sitename))
				{
				$emailsent="Y";
				}
			else
				{
				echo "Error: Email failed, this may indicate a PHP Mail Setup problem on your server. Your survey details have still been saved, however you will not get an email with the details. You should note the \"name\" and \"password\" you just used for future reference.";
				}
			}
		}
	$_SESSION['step']++;  //Moves to next page
	}
}

?>