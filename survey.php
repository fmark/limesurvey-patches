<?php
/*
	#############################################################
	# >>> PHPSurveyor	  										#
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

if (empty($homedir)) {die ("Cannot run this script directly");}

//Move current step
if (!isset($_SESSION['step'])) {$_SESSION['step']=0;}

// --> START BUG FIX
if (!isset($_POST['thisstep'])) {$_POST['thisstep'] = "";}
// <-- END BUG FIX

if (isset($_POST['move']) && $_POST['move'] == " << "._PREV." ") {$_SESSION['step'] = $_POST['thisstep']-1;}
if (isset($_POST['move']) && $_POST['move'] == " "._NEXT." >> ") {$_SESSION['step'] = $_POST['thisstep']+1;}
if (isset($_POST['move']) && $_POST['move'] == " "._LAST." ") {$_SESSION['step'] = $_POST['thisstep']+1;}

// --> START NEW FEATURE - SAVE
// So SAVE YOUR RESPONSES SO FAR stays on same page
if (isset($_POST['saveall']) && $_POST['saveall'] == _SAVE_AND_RETURN) {$_SESSION['step']=$_POST['thisstep'];}
// <-- END NEW FEATURE - SAVE


//CHECK IF ALL MANDATORY QUESTIONS HAVE BEEN ANSWERED
//CHECK IF ALL CONDITIONAL MANDATORY QUESTIONS THAT APPLY HAVE BEEN ANSWERED
$notanswered=addtoarray_single(checkmandatorys(),checkconditionalmandatorys());

//CHECK PREGS
$notvalidated=checkpregs();

//SUBMIT
if ((isset($_POST['move']) && $_POST['move'] == " "._SUBMIT." ") && (!isset($notanswered) || !$notanswered) && (!isset($notvalidated) && !$notvalidated))
	{
	if ($thissurvey['private'] == "Y")
		{
		$privacy="";
		foreach (file("$thistpl/privacy.pstpl") as $op)
			{
			$privacy .= templatereplace($op);
			}
		}
	if ($thissurvey['refurl'] == "Y")
		{
		if (!in_array("refurl", $_SESSION['insertarray'])) //Only add this if it doesn't already exist
			{
		    $_SESSION['insertarray'][] = "refurl";
			}
		$_SESSION['refurl'] = $_SESSION['refurl'];
		}


	//COMMIT CHANGES TO DATABASE
	if ($thissurvey['active'] != "Y")
		{
		sendcacheheaders();
		doHeader();
		foreach(file("$thistpl/startpage.pstpl") as $op)
			{
			echo templatereplace($op);
			}

		//Check for assessments
		$assessments = doAssessment($surveyid);
		if ($assessments)
			{
			foreach(file("$thistpl/assessment.pstpl") as $op)
				{
				echo templatereplace($op);
				}
			}

		$completed = "<br /><strong><font size='2' color='red'>"._DIDNOTSAVE."</strong></font><br /><br />\n\n"
				   . _NOTACTIVE1."<br /><br />\n"
				   . "<a href='{$_SERVER['PHP_SELF']}?sid=$surveyid&amp;move=clearall'>"._CLEARRESP."</a><br /><br />\n"
				   . "<font size='1'>$subquery</font>\n";
		}
	else
		{

			if ($thissurvey['usecookie'] == "Y" && $tokensexist != 1)
				{
				$cookiename="PHPSID".returnglobal('sid')."STATUS";
				setcookie("$cookiename", "COMPLETE", time() + 31536000); //365 days
				}
			
			$content='';
			
			//Start to print the final page
			foreach(file("$thistpl/startpage.pstpl") as $op)
				{
				$content .= templatereplace($op);
				}
			
			//Check for assessments
			$assessments = doAssessment($surveyid);
			if ($assessments)
				{
				foreach(file("$thistpl/assessment.pstpl") as $op)
					{
					$content .= templatereplace($op);
					}
				}
	
			//Create text for use in later print section
			$completed = "<br /><strong><font size='2'><font color='green'>"
					   . _THANKS."</strong></font><br /><br />\n\n"
					   . _SURVEYREC."<br />\n"
					   . "<a href='javascript:window.close()'>"
					   . _CLOSEWIN_PS."</a></font><br /><br />\n";
			
			//Update the token if needed and send a confirmation email
			if (isset($_POST['token']) && $_POST['token'])
				{
				submittokens();
				}
			
			//Send notification to survey administrator //Thanks to Jeff Clement http://jclement.ca
			if ($thissurvey['sendnotification'] > 0 && $thissurvey['adminemail']) 
				{
				sendsubmitnotification($thissurvey['sendnotification']);
				}

			session_unset();
			session_destroy();

			sendcacheheaders();
			if (!$embedded && isset($thissurvey['autoredirect']) && $thissurvey['autoredirect'] == "Y" && $thissurvey['url'])
				{
			    //Automatically redirect the page to the "url" setting for the survey
				session_write_close();
				header("Location: {$thissurvey['url']}");
			    }

			doHeader();
			echo $content;

		}
	
	foreach(file("$thistpl/completed.pstpl") as $op)
		{
		echo templatereplace($op);
		}
	
	echo "\n<br />\n";
	foreach(file("$thistpl/endpage.pstpl") as $op)
		{
		echo templatereplace($op);
		}
	exit;
	}

//LAST PHASE
if (isset($_POST['move']) && $_POST['move'] == " "._LAST." " && (!isset($notanswered) && !$notanswered) && (!isset($notvalidated) && !$notvalidated))
	{
	//READ TEMPLATES, INSERT DATA AND PRESENT PAGE
	sendcacheheaders();
	doHeader();
	foreach(file("$thistpl/startpage.pstpl") as $op)
		{
		echo templatereplace($op);
		}
	echo "\n<form method='post' action='{$_SERVER['PHP_SELF']}' id='phpsurveyor' name='phpsurveyor'>\n"
		."\n\n<!-- START THE SURVEY -->\n";
	foreach(file("$thistpl/survey.pstpl") as $op)
		{
		echo "\t\t".templatereplace($op);
		}
	//READ SUBMIT TEMPLATE
	foreach(file("$thistpl/submit.pstpl") as $op)
		{
		echo "\t\t\t".templatereplace($op);
		}
	
	$navigator = surveymover();
	echo "\n\n<!-- PRESENT THE NAVIGATOR -->\n";
	foreach(file("$thistpl/navigator.pstpl") as $op)
		{
		echo "\t\t".templatereplace($op);
		}
	echo "\n";
	foreach(file("$thistpl/endpage.pstpl") as $op)
		{
		echo templatereplace($op);
		}
	echo "\n"
		."\n<input type='hidden' name='thisstep' value='{$_SESSION['step']}' id='thisstep'>\n"
		."\n<input type='hidden' name='sid' value='$surveyid' id='sid'>\n"
		."\n<input type='hidden' name='token' value='$token' id='token'>\n"
		."\n</form>\n";
		doFooter();
	exit;
	}

//SEE IF $surveyid EXISTS
if ($surveyexists <1)
	{
	sendcacheheaders();
	doHeader();
	//SURVEY DOES NOT EXIST. POLITELY EXIT.
	foreach(file("$thistpl/startpage.pstpl") as $op)
		{
		echo templatereplace($op);
		}
	echo "\t<center><br />\n"
		."\t"._SURVEYNOEXIST."<br />&nbsp;\n";	
	foreach(file("$thistpl/endpage.pstpl") as $op)
		{
		echo templatereplace($op);
		}
	exit;
	}

//RUN THIS IF THIS IS THE FIRST TIME
if (!isset($_SESSION['step']) || !$_SESSION['step'])
	{
	$totalquestions = buildsurveysession();
// --> START NEW FEATURE - SAVE
	// Now shows welcome message and next page will be Save page if Allow Saves is on
	sendcacheheaders();
	doHeader();
	foreach(file("$thistpl/startpage.pstpl") as $op)
		{
		echo templatereplace($op);
		}
	echo "\n<form method='post' action='{$_SERVER['PHP_SELF']}' id='phpsurveyor' name='phpsurveyor'>\n";
	
	echo "\n\n<!-- START THE SURVEY -->\n";

	foreach(file("$thistpl/welcome.pstpl") as $op)
		{
		echo "\t\t\t".templatereplace($op);
		}
	echo "\n";
	$navigator = surveymover();
	foreach(file("$thistpl/navigator.pstpl") as $op)
		{
		echo templatereplace($op);
		}
	if ($thissurvey['active'] != "Y") 
		{
		echo "\t\t<center><font color='red' size='2'>"._NOTACTIVE."</font></center>\n";
		}
	echo "\n<input type='hidden' name='sid' value='$surveyid' id='sid'>\n";
	echo "\n<input type='hidden' name='token' value='$token' id='token'>\n";
	echo "\n</form>\n";
	foreach(file("$thistpl/endpage.pstpl") as $op)
		{
		echo templatereplace($op);
		}
	doFooter();
	exit;
// <-- END NEW FEATURE - SAVE
	}

//******************************************************************************************************
//PRESENT SURVEY
//******************************************************************************************************

//GET GROUP DETAILS
require_once("qanda.php");
$mandatorys=array();
$mandatoryfns=array();
$conmandatorys=array();
$conmandatoryfns=array();
$conditions=array();
$inputnames=array();
foreach ($_SESSION['grouplist'] as $gl)
	{
	$gid=$gl[0];
	foreach ($_SESSION['fieldarray'] as $ia)
		{
		if ($ia[5] == $gid)
			{
			list($plus_qanda, $plus_inputnames)=retrieveAnswers($ia);
			if ($plus_qanda)
				{
					$qanda[]=$plus_qanda;
				}
			if ($plus_inputnames)
				{
				$inputnames = addtoarray_single($inputnames, $plus_inputnames);
				}
	
			//Display the "mandatory" popup if necessary
			if (isset($notanswered)) 
				{
				list($mandatorypopup, $popup)=mandatory_popup($ia, $notanswered);
				}
			
			if (isset($notvalidated))
				{
				list($validationpopup, $vpopup)=validation_popup($ia, $notvalidated);
				}
			
			//Get list of mandatory questions
			list($plusman, $pluscon)=create_mandatorylist($ia);
			if ($plusman !== null)
				{
			    list($plus_man, $plus_manfns)=$plusman;
				$mandatorys=addtoarray_single($mandatorys, $plus_man);
				$mandatoryfns=addtoarray_single($mandatoryfns, $plus_manfns);
				}
			if ($pluscon !== null)
				{
			    list($plus_conman, $plus_conmanfns)=$pluscon;
				$conmandatorys=addtoarray_single($conmandatorys, $plus_conman);
				$conmandatoryfns=addtoarray_single($conmandatoryfns, $plus_conmanfns);
				}
			
			//Build an array containing the conditions that apply for this page
			$plus_conditions=retrieveConditionInfo($ia); //Returns false if no conditions
			if ($plus_conditions)
				{
				$conditions = addtoarray_single($conditions, $plus_conditions);
				}
			} 
		}
	}

//READ TEMPLATES, INSERT DATA AND PRESENT PAGE
sendcacheheaders();
doHeader();
if(isset($popup)) {echo $popup;}
if(isset($vpopup)) {echo $vpopup;}
foreach(file("$thistpl/startpage.pstpl") as $op)
	{
	echo templatereplace($op);
	}
echo "\n<form method='post' action='{$_SERVER['PHP_SELF']}' id='phpsurveyor' name='phpsurveyor'>\n";
//PUT LIST OF FIELDS INTO HIDDEN FORM ELEMENT
echo "\n\n<!-- INPUT NAMES -->\n"
	."\t<input type='hidden' name='fieldnames' id='fieldnames' value='"
	.implode("|", $inputnames)
	."'>\n";

// --> START NEW FEATURE - SAVE
// Used to keep track of the fields modified, so only those are updated during save
echo "\t<input type='hidden' name='modfields' value='";

// Debug - uncomment if you want to see the value of modfields on the next page source (to see what was modified)
//         however doing so will cause the save routine to save all fields that have ever been modified whether
//	   they are on the current page or not.  Recommend just using this for debugging.
//if (isset($_POST['modfields']) && $_POST['modfields']) {
//	$inputmodfields=explode("|", $_POST['modfields']);
//	echo implode("|", $inputmodfields);
//}

echo "' id='modfields'>\n";
echo "\n";
echo "\n\n<!-- JAVASCRIPT FOR MODIFIED QUESTIONS -->\n";
echo "\t<script type='text/javascript'>\n";
echo "\t<!--\n";
echo "\t\tfunction modfield(name)\n";
echo "\t\t\t{\n";
echo "\t\t\t\ttemp=document.getElementById('modfields').value;\n";
echo "\t\t\t\tif (temp=='') {\n";
echo "\t\t\t\t\tdocument.getElementById('modfields').value=name;\n";
echo "\t\t\t\t}\n";
echo "\t\t\t\telse {\n";
echo "\t\t\t\t\tmyarray=temp.split('|');\n";
echo "\t\t\t\t\tif (!inArray(name, myarray)) {\n";
echo "\t\t\t\t\t\tmyarray.push(name);\n";
echo "\t\t\t\t\t\tdocument.getElementById('modfields').value=myarray.join('|');\n";
echo "\t\t\t\t\t}\n";
echo "\t\t\t\t}\n";
echo "\t\t\t}\n";
echo "\n";
echo "\t\tfunction inArray(needle, haystack)\n";
echo "\t\t\t{\n";
echo "\t\t\t\tfor (h in haystack) {\n";
echo "\t\t\t\t\tif (haystack[h] == needle) {\n";
echo "\t\t\t\t\t\treturn true;\n";
echo "\t\t\t\t\t}\n";
echo "\t\t\t\t}\n";
echo "\t\t\treturn false;\n";
echo "\t\t\t} \n";
echo "\t//-->\n";
echo "\t</script>\n\n";
// <-- END NEW FEATURE - SAVE

foreach(file("$thistpl/welcome.pstpl") as $op)
	{
	echo templatereplace($op);
	}

echo "\n\n<!-- JAVASCRIPT FOR CONDITIONAL QUESTIONS -->\n"
	."\t<script type='text/javascript'>\n"
	."\t<!--\n"
	."\t\tfunction checkconditions(value, name, type)\n"
	."\t\t\t{\n";
if (isset($conditions) && is_array($conditions))
	{
	if (!isset($endzone)) {$endzone="";}
	echo "\t\t\tif (type == 'radio' || type == 'select-one')\n"
		."\t\t\t\t{\n"
		."\t\t\t\tvar hiddenformname='java'+name;\n"
		."\t\t\t\tdocument.getElementById(hiddenformname).value=value;\n"
		."\t\t\t\t}\n"
		."\t\t\tif (type == 'checkbox')\n"
		."\t\t\t\t{\n"
		."\t\t\t\tvar hiddenformname='java'+name;\n"
		."\t\t\t\tvar chkname='answer'+name;\n"
		."\t\t\t\tif (document.getElementById(chkname).checked) {\n"
		."\t\t\t\t\tdocument.getElementById(hiddenformname).value='Y';}\n"
		."\t\t\t\telse {\n"
		."\t\t\t\t\tdocument.getElementById(hiddenformname).value='';}\n"
		."\t\t\t\t}\n";
	$java="";
	$cqcount=1;
	foreach ($conditions as $cd)
		{
		if ((isset($oldq) && $oldq != $cd[0]) || !isset($oldq)) //New if statement
			{
			$java .= $endzone;
			$endzone = "";
			$cqcount=1;
			$java .= "\n\t\t\tif ((";
			}
		if (!isset($oldcq) || !$oldcq) {$oldcq = $cd[2];}
		if ($cd[4] == "L") //Just in case the dropdown threshold is being applied, check number of answers here
			{
			$cccquery="SELECT code FROM {$dbprefix}answers WHERE qid={$cd[1]}";
			$cccresult=$connect->Execute($cccquery);
			$cccount=$cccresult->RecordCount();
			}
		if ($cd[4] == "R") 	{$idname="fvalue_".$cd[1].substr($cd[2], strlen($cd[2])-1,1);}
		elseif ($cd[4] == "5" || $cd[4] == "A" || $cd[4] == "B" || $cd[4] == "C" || $cd[4] == "E" || $cd[4] == "F" || $cd[4] == "G" || $cd[4] == "Y" || ($cd[4] == "L" && $cccount <= $dropdownthreshold))
							{$idname="java$cd[2]";}
		elseif ($cd[4] == "M" || $cd[4] == "P")
							{$idname="java$cd[2]$cd[3]";}
		else				{$idname="java".$cd[2];}
		if ($cqcount > 1 && $oldcq ==$cd[2]) {$java .= " || ";}
		elseif ($cqcount >1 && $oldcq != $cd[2]) {$java .= ") && (";}
		if ($cd[3] == '') 
			{
			$java .= "document.getElementById('$idname').value == ' ' || !document.getElementById('$idname').value";
			}
		elseif($cd[4] == "M" || $cd[4] == "P")
			{
			$java .= "document.getElementById('$idname').value == 'Y'";
			}
		else 
			{
			$java .= "document.getElementById('$idname').value == '$cd[3]'";
			}
		if ((isset($oldq) && $oldq != $cd[0]) || !isset($oldq))//Close if statement
			{
			$endzone = "))\n"
					 . "\t\t\t\t{\n"
					 . "\t\t\t\tdocument.getElementById('question$cd[0]').style.display='';\n"
					 . "\t\t\t\tdocument.getElementById('display$cd[0]').value='on';\n"
					 . "\t\t\t\t}\n"
					 . "\t\t\telse\n"
					 . "\t\t\t\t{\n"
					 . "\t\t\t\tdocument.getElementById('question$cd[0]').style.display='none';\n"
					 . "\t\t\t\tdocument.getElementById('display$cd[0]').value='';\n"
					 . "\t\t\t\t}\n";
			$cqcount++;
			}
		$oldq = $cd[0]; //Update oldq for next loop
		$oldcq = $cd[2];  //Update oldcq for next loop
		}
	$java .= $endzone;
	}
echo $java;
echo "\t\t\t}\n"
	."\t//-->\n"
	."\t</script>\n\n";

foreach ($_SESSION['grouplist'] as $gl)
	{
	$gid=$gl[0];
	$groupname=$gl[1];
	$groupdescription=$gl[2];
	echo "\n\n<!-- START THE GROUP -->\n";
	foreach(file("$thistpl/startgroup.pstpl") as $op)
		{
		echo "\t".templatereplace($op);
		}
	echo "\n";
	
	if ($groupdescription)
		{
		foreach(file("$thistpl/groupdescription.pstpl") as $op)
			{
			echo "\t\t".templatereplace($op);
			}
		}
	echo "\n";
	
	echo "\n\n<!-- PRESENT THE QUESTIONS -->\n";
	if (is_array($qanda))
		{
		foreach ($qanda as $qa)
			{
			if ($gl[0] == $qa[6])
				{
				echo "\n\t<!-- NEW QUESTION -->\n";
				echo "\t\t\t\t<div id='question$qa[4]'";
				if ($qa[3] != "Y") {echo ">\n";} else {echo " style='display: none'>\n";}
				$question="<label for='$qa[7]'>" . $qa[0] . "</label>";
				$answer=$qa[1];
				$help=$qa[2];
				$questioncode=$qa[5];
				foreach(file("$thistpl/question.pstpl") as $op)
					{
					echo "\t\t\t\t\t".templatereplace($op)."\n";
					}
				echo "\t\t\t\t</div>\n";
				}
			}
		}

	echo "\n\n<!-- END THE GROUP -->\n";
	foreach(file("$thistpl/endgroup.pstpl") as $op)
		{
		echo "\t\t\t\t".templatereplace($op);
		}
	echo "\n";
	}
//echo "&nbsp;\n";
$navigator = surveymover();
echo "\n\n<!-- PRESENT THE NAVIGATOR -->\n";
foreach(file("$thistpl/navigator.pstpl") as $op)
	{
	echo "\t\t".templatereplace($op);
	}
echo "\n";

if ($thissurvey['active'] != "Y") {echo "\t\t<center><font color='red' size='2'>"._NOTACTIVE."</font></center>\n";}

	
if (is_array($conditions)) //if conditions exist, create hidden inputs for previously answered questions
	{
	foreach (array_keys($_SESSION) as $SESak)
		{
		if (in_array($SESak, $_SESSION['insertarray']))
			{
			echo "<input type='hidden' name='java$SESak' id='java$SESak' value='" . $_SESSION[$SESak] . "'>\n";
			}
		}
	}
//SOME STUFF FOR MANDATORY QUESTIONS
if (remove_nulls_from_array($mandatorys))
	{
	$mandatory=implode("|", remove_nulls_from_array($mandatorys));
	echo "<input type='hidden' name='mandatory' value='$mandatory' id='mandatory'>\n";
	}
if (remove_nulls_from_array($conmandatorys))
	{
	$conmandatory=implode("|", remove_nulls_from_array($conmandatorys));
	echo "<input type='hidden' name='conmandatory' value='$conmandatory' id='conmandatory'>\n";
	}
if (remove_nulls_from_array($mandatoryfns))
	{
	$mandatoryfn=implode("|", remove_nulls_from_array($mandatoryfns));
	echo "<input type='hidden' name='mandatoryfn' value='$mandatoryfn' id='mandatoryfn'>\n";
	}
if (remove_nulls_from_array($conmandatoryfns))
	{
	$conmandatoryfn=implode("|", remove_nulls_from_array($conmandatoryfns));
	echo "<input type='hidden' name='conmandatoryfn' value='$conmandatoryfn' id='conmandatoryfn'>\n";
	}

echo "<input type='hidden' name='thisstep' value='{$_SESSION['step']}' id='thisstep'>\n"
	."<input type='hidden' name='sid' value='$surveyid' id='sid'>\n"
	."<input type='hidden' name='token' value='$token' id='token'>\n"
	."</form>\n";
	foreach(file("$thistpl/endpage.pstpl") as $op)
	{
	echo templatereplace($op);
	}
echo "\n";
	doFooter();

?>
