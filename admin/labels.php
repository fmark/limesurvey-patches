<?php
/*
#############################################################
# >>> PHPSurveyor                                           #
#############################################################
# > Author:  Jason Cleeland                                 #
# > E-mail:  jason@cleeland.org                             #
# > Mail:    Box 99, Trades Hall, 54 Victoria St,           #
# >          CARLTON SOUTH 3053, AUSTRALIA                  #
# > Date:    19 April 2003                                  #
#                                                           #
# This set of scripts allows you to develop, publish and    #
# perform data-entry on surveys.                            #
#############################################################
#                                                           #
#    Copyright (C) 2003  Jason Cleeland                     #
#                                                           #
# This program is free software; you can redistribute       #
# it and/or modify it under the terms of the GNU General    #
# Public License Version 2 as published by the Free         #
# Software Foundation.										#
#                                                           #
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
*/


include_once("login_check.php");

if($_SESSION['USER_RIGHT_MANAGE_LABEL'] == 1)
	{

	if (!isset($action)) {$action=returnglobal('action');}
	if (!isset($lid)) {$lid=returnglobal('lid');}
	$labelsoutput= include2var('./scripts/addremove.js');
	
	//DO DATABASE UPDATESTUFF 
	if ($action == "updateset") {updateset($lid);}
	if ($action == "insertlabelset") {$lid=insertlabelset();}
	if ($action == "modlabelsetanswers") {modlabelsetanswers($lid);}
	if ($action == "deletelabelset") {if (deletelabelset($lid)) {$lid=0;}}
	if ($action == "importlabels")
	{
		include("importlabel.php");
		exit;
	}
	

	$labelsoutput.= "<table width='100%' border='0' bgcolor='#DDDDDD'>\n"
                    . "\t<tr>\n"
                    . "\t\t<td>\n"
                    . "\t\t\t<table width='100%' style='border: 1px solid #555555' cellpadding='1' cellspacing='0'>\n"
                    . "\t\t\t<tr bgcolor='#555555'>\n"
                    . "\t\t\t\t<td colspan='2' height='8'>\n"
                    . "\t\t\t\t<font size='1' color='white'><strong>"
	._("Label Sets Administration")."</strong></font></td></tr>\n"
	."<tr bgcolor='#999999'>\n"
	."\t<td>\n"
	."\t<a href='$scriptname' onmouseout=\"hideTooltip()\" onmouseover=\"showTooltip(event,'". _("Return to Survey Administration")."');return false\">" .
			"<img name='Administration' src='$imagefiles/home.png' title='' alt='' align='left'  /></a>"
	."\t<img src='$imagefiles/blank.gif' width='11' height='20' border='0' hspace='0' align='left' alt='' />\n"
	."\t<img src='$imagefiles/seperator.gif' border='0' hspace='0' align='left' alt='' />\n"
	."\t<img src='$imagefiles/blank.gif' width='60' height='20' border='0' hspace='0' align='left' alt='' />\n"
	."\t<img src='$imagefiles/seperator.gif' border='0' hspace='0' align='left' alt='' />\n"
	."\t</td>\n"
	."\t<td align='right' width='620'>\n"
	."<a href=\"#\" onClick=\"showhelp('show')\"" 
	."onmouseout=\"hideTooltip()\"" 
	."onmouseover=\"showTooltip(event,'"._("Show Help")."');return false\">" 
	."<img src='$imagefiles/showhelp.png' name='ShowHelp' title=''" 
	."alt='". _("Show Help")."' align='right'  /></a>"	
	."\t<img src='$imagefiles/blank.gif' width='42' height='20' align='right' hspace='0' border='0'  alt='' />\n"
	."\t<img src='$imagefiles/seperator.gif' align='right' hspace='0' border='0' alt='' />\n"
	."<a href=\"#\" onClick=\"window.open('admin.php?action=newlabelset', '_top')\"" 
	."onmouseout=\"hideTooltip()\"" 
	."onmouseover=\"showTooltip(event,'"._("Add new label set")."');return false\">"
	."<img src='$imagefiles/add.png' align='right' name='AddLabel' title='' alt='". _("Add new label set")."' /></a>\n"	 
	."\t<font class='boxcaption'>"._("Labelsets").": </font>"
	."\t<select class='listboxsurveys' "
	."onChange=\"window.open(this.options[this.selectedIndex].value,'_top')\">\n";
	$labelsets=getlabelsets();
	if (count($labelsets)>0)
	{
		foreach ($labelsets as $lb)
		{
			$labelsoutput.="<option value='admin.php?action=labels&amp;lid={$lb[0]}'";
			if ($lb[0] == $lid) {$labelsoutput.= " selected";}
			$labelsoutput.= ">{$lb[1]}</option>\n";
		}
	}
	$labelsoutput.= "<option value=''";
	if (!isset($lid) || $lid<1) {$labelsoutput.= " selected";}
	$labelsoutput.= ">"._("Please Choose...")."</option>\n";
	
	$labelsoutput.= "\t</select>\n"
	."\t</td>\n"
	."</tr>\n"
	."\t</table>\n";

	if ($action!='labels' || isset($lid))  {$labelsoutput.="<table ><tr><td></td></tr></table>\n";}
    	
	//NEW SET
	if ($action == "newlabelset" || $action == "editlabelset")
	{
		if ($action == "editlabelset")
		{
         	$query = "SELECT label_name,".db_table_name('labelsets').".lid, languages FROM ".db_table_name('labelsets');
			$result=db_execute_assoc($query);
			while ($row=$result->FetchRow()) {$lbname=$row['label_name']; $lblid=$row['lid']; $langids=$row['languages'];}
		}
		$labelsoutput.= "<form style='margin-bottom:0;' method='post' action='admin.php' onsubmit=\"return isEmpty(document.getElementById('label_name'), '".("Error: You have to enter a name for this label set.'").")\">\n"
		."<table width='100%' bgcolor='#DDDDDD'>\n"
		."\t<tr bgcolor='black'>\n"
		."<td colspan='4' align='center'><font color='white'><strong>\n"
		."<input type='image' src='$imagefiles/close.gif' align='right' "
		."onClick=\"window.open('admin.php?action=labels&amp;lid=$lid', '_top')\" />\n";
		if ($action == "newlabelset") {$labelsoutput.= _("Create New Label Set"); $langids="en";}
		else {$labelsoutput.= _("Edit Label Set");}
		$langidsarray=explode(" ",trim($langids)); //Make an array of it
		$labelsoutput.= "</strong></font></td>\n"
		."\t</tr>\n"
		."\t<tr>\n"
		."<td align='right' width='25%'>\n"
		."\t<strong>"._("Set Name").":</strong>"
		."</td>\n"
		."<td>\n"
		."\t<input type='hidden' name='languageids' id='languageids' value='$langids' />"
		."\t<input type='text' id='label_name' name='label_name' value='";
		if (isset($lbname)) {$labelsoutput.= $lbname;}
		$labelsoutput.= "' />\n"
		."</td>\n"
		."\t</tr>\n"
		// Additional languages listbox
    	. "\t<tr><td align='right'><font class='settingcaption'>"._("Languages").":</font></td>\n"
		. "<td><select multiple style='min-width:250px;' size='5' id='additional_languages' name='additional_languages'>";
		foreach ($langidsarray as $langid) 
			{
					$labelsoutput.=  "\t<option id='".$langid."' value='".$langid."'";
					$labelsoutput.= ">".getLanguageNameFromCode($langid)."</option>\n";
			}

			//  Add/Remove Buttons
			$labelsoutput.= "</select></td>"
			. "<td align=left><INPUT type=\"button\" value=\"<< "._('Add')."\" onclick=\"DoAdd()\" ID=\"AddBtn\" /><br /> <INPUT type=\"button\" value=\""._('Remove')." >>\" onclick=\"DoRemove(1,'"._("You cannot remove this items since you need at least one language in a labelset.")."')\" ID=\"RemoveBtn\"  /></td>\n"

			// Available languages listbox
			. "<td align=left width='45%'><select size='5' id='available_languages' name='available_languages'>";
			foreach (getLanguageData() as  $langkey=>$langname)
			{
				if (in_array($langkey,$langidsarray)==false)  // base languag must not be shown here
				{
					$labelsoutput.= "\t<option id='".$langkey."' value='".$langkey."'";
					$labelsoutput.= ">".$langname['description']." - ".$langname['nativedescription']."</option>\n";
				}
			}

		$labelsoutput.= "\t</select></td></tr><tr>\n"
		."<td></td><td></td>\n"
		."<td>\n"
    	."<br /><input type='submit' value='";
		if ($action == "newlabelset") {$labelsoutput.= _("Add");}
		  else {$labelsoutput.= _("Update");}
		$labelsoutput.= "' />\n"
		."<input type='hidden' name='action' value='";
		if ($action == "newlabelset") {$labelsoutput.= "insertlabelset";}
		else {$labelsoutput.= "updateset";}
		$labelsoutput.= "' />\n";
		
        if ($action == "editlabelset") 
        {
            $labelsoutput.= "<input type='hidden' name='lid' value='$lblid' />\n";
        }
		
        $labelsoutput.= "</td>\n"
		."\t</tr>\n";
		$labelsoutput.= "</table></form>\n";
		if ($action == "newlabelset")
		{
			$labelsoutput.= "<form enctype='multipart/form-data' name='importlabels' action='admin.php?action=labels' method='post'>\n"
			."<table width='100%' bgcolor='#DDDDDD'>\n"
			."\t<tr><td colspan='2' align='center'>\n"
			."<strong>OR</strong>\n"
			."\t</td></tr>\n"
			."\t<tr bgcolor='black'>\n"
			."<td colspan='2' align='center'><font color='white'><strong>\n"
			.""._("Import Label Set")."\n"
			."</strong></font></td>\n"
			."\t</tr>\n"
			."\t<tr>\n"
			."<td align='right'><strong>"
			._("Select SQL File:")."</strong></td>\n"
			."<td><input name=\"the_file\" type=\"file\" size=\"35\" />"
			."</td></tr>\n"
			."\t<tr><td></td><td><input type='submit' value='"._("Import Label Set")."' />\n"
			."\t<input type='hidden' name='action' value='importlabels' /></TD>\n"
			."\t</tr></table></form>\n";
		}
	}
	//SET SELECTED
	if (isset($lid) && ($action != "editlabelset") && $lid)
	{
		//CHECK TO SEE IF ANY ACTIVE SURVEYS ARE USING THIS LABELSET (Don't let it be changed if this is the case)
		$query = "SELECT ".db_table_name('surveys_languagesettings').".surveyls_title FROM ".db_table_name('questions').", ".db_table_name('surveys')." , ".db_table_name('surveys_languagesettings')." WHERE ".db_table_name('questions').".sid=".db_table_name('surveys').".sid AND ".db_table_name('surveys').".sid=".db_table_name('surveys_languagesettings').".surveyls_survey_id AND ".db_table_name('questions').".lid=$lid AND ".db_table_name('surveys').".active='Y'";
		$result = db_execute_assoc($query);
		$activeuse=$result->RecordCount();
		while ($row=$result->FetchRow()) {$activesurveys[]=$row['surveyls_title'];}
		//NOW ALSO COUNT UP HOW MANY QUESTIONS ARE USING THIS LABELSET, TO GIVE WARNING ABOUT CHANGES
		$query = "SELECT * FROM ".db_table_name('questions')." WHERE type IN ('F','H') AND lid=$lid";
		$result = db_execute_assoc($query);
		$totaluse=$result->RecordCount();
		while($row=$result->FetchRow())
		{
			$qidarray[]=array("url"=>"$scriptname?sid=".$row['sid']."&amp;gid=".$row['gid']."&amp;qid=".$row['qid'], "title"=>"QID: ".$row['qid']);
		} // while
		//NOW GET THE ANSWERS AND DISPLAY THEM
		$query = "SELECT * FROM ".db_table_name('labelsets')." WHERE lid=$lid";
		$result = db_execute_assoc($query);
		while ($row=$result->FetchRow())
		{
			$labelsoutput.= "\t<table width='100%' align='center' style='border: 1px solid #555555' cellpadding='1' cellspacing='0'>\n"
			."<tr bgcolor='#555555'><td height='4' colspan='2'>"
			."<font size='1' face='verdana' color='white'><strong>"
			._("Label Set").":</strong> {$row['label_name']}</font></td></tr>\n"
			."<tr bgcolor='#999999'>\n"
			."\t<td>\n"
			."\t<input type='image' src='$imagefiles/close.gif' title='"
			._("Close Window")."' align='right' "
			."onClick=\"window.open('admin.php?action=labels', '_top')\" />\n"
			."\t<img src='$imagefiles/blank.gif' width='31' height='20' border='0' hspace='0' align='left' alt='' />\n"
			."\t<img src='$imagefiles/seperator.gif' border='0' hspace='0' align='left' alt='' />\n"
			."\t<img src='$imagefiles/blank.gif' width='60' height='20' border='0' hspace='0' align='left' alt='' />\n"
			."\t<img src='$imagefiles/seperator.gif' border='0' hspace='0' align='left' alt='' />\n"
			."\t<a href='admin.php?action=editlabelset&amp;lid=$lid' onmouseout=\"hideTooltip()\" onmouseover=\"showTooltip(event,'"._("Edit label set")."');return false\">" .
			"<img name='EditLabelsetButton' src='$imagefiles/edit.png' alt='' align='left'  /></a>" 
			."\t<a href='admin.php?action=deletelabelset&amp;lid=$lid' onmouseout=\"hideTooltip()\" onmouseover=\"showTooltip(event,'"._("Delete label set")."');return false\">"
			."<img src='$imagefiles/delete.png' border='0' alt='' title='' align='left' onClick=\"return confirm('"._("Are you sure?")."')\" /></a>\n"
			."\t<a href='dumplabel.php?lid=$lid' onmouseout=\"hideTooltip()\" onmouseover=\"showTooltip(event,'"._("Export Label Set")."');return false\">" .
					"<img src='$imagefiles/exportcsv.png' alt='"._("Export Label Set")."' title='' align='left' /></a>" 
			."\t</td>\n"
			."</tr>\n"
			."\t</table>\n";
		}


		//LABEL ANSWERS  - SHOW THE MASK FOR EDITING THE LABELS 


		$qulabelset = "SELECT * FROM ".db_table_name('labelsets')." WHERE lid=$lid";
		$rslabelset = db_execute_assoc($qulabelset) or die($connect->ErrorMsg());
		$rwlabelset=$rslabelset->FetchRow();
		$lslanguages=explode(" ", trim($rwlabelset['languages'])); 
		
		$labelsoutput.= "\t<table width='100%' align='center' style='border: solid; border-width: 1px; border-color: #555555' cellspacing='0'>\n"
		."<tr bgcolor='#555555' >\n"
		."\t<td colspan='4'><strong><font size='1' face='verdana' color='white'>\n"
		._("Labels")
		."\t</font></strong></td>\n"
		."</tr>\n"
        ."\t<tr><td colspan='4'>\n"        ."<form method='post' action='admin.php'>\n"
	    ."<input type='hidden' name='sortorder' value='{$row['sortorder']}' />\n"
		."<input type='hidden' name='lid' value='$lid' />\n"
		."<input type='hidden' name='action' value='modlabelsetanswers' />\n";
        $labelsoutput.= "<div class='tab-pane' id='tab-pane-1'>";    
        $first=true;
        $sortorderids=''; $codeids='';
		foreach ($lslanguages as $lslanguage)
		{
     		$position=0;
    		$query = "SELECT * FROM ".db_table_name('labels')." WHERE lid=$lid and language='$lslanguage' ORDER BY sortorder, code";
    		$result = db_execute_assoc($query) or die($connect->ErrorMsg());
    		$labelcount = $result->RecordCount();
            $labelsoutput.= "<div class='tab-page'>"
                ."<h2 class='tab'>".getLanguageNameFromCode($lslanguage)."</h2>"
                ."\t<table width='100%' style='border: solid; border-width: 0px; border-color: #555555' cellspacing='0'>\n"
                ."<thead align='center'>"
        		."<tr bgcolor='#BBBBBB'>\n"
        		."\t<td width='25%' align=right><strong><font size='1' face='verdana' >\n"
        		._("Code")
        		."\t</font></strong></td>\n"
        		."\t<td width='35%'><strong><font size='1' face='verdana'>\n"
        		._("Title")
        		."\t</font></strong></td>\n"
        		."\t<td width='25%'><strong><font size='1' face='verdana'>\n"
        		._("Action")
        		."\t</font></strong></td>\n"
        		."\t<td width='15%' align=center><strong><font size='1' face='verdana'>\n"
        		._("Order")
        		."\t</font></strong></td>\n"
        		."</tr></thead>"
                ."<tbody align='center'>";
    		while ($row=$result->FetchRow())
    		{
                $sortorderids=$sortorderids.' '.$row['language'].'_'.$row['sortorder'];
    			if ($first) {$codeids=$codeids.' '.$row['sortorder'];}                 
    			$labelsoutput.= "<tr><td width='25%' align=right>\n";

    			if ($activeuse > 0)
    			{
    				$labelsoutput.= "\t{$row['code']}"
    				."<input type='hidden' name='code_{$row['sortorder']}' value=\"{$row['code']}\" />\n";
    			}
    			elseif (!$first)
    			{   
                    $labelsoutput.= "\t{$row['code']}";
                }
    			else
    			{
    				$labelsoutput.= "\t<input type='text' name='code_{$row['sortorder']}' maxlength='10' size='10' value=\"{$row['code']}\" />\n";
    			}
    			
    			$labelsoutput.= "\t</td>\n"
    			."\t<td width='35%'>\n"
    			."\t<input type='text' name='title_{$row['language']}_{$row['sortorder']}' maxlength='100' size='80' value=\"{$row['title']}\" />\n"
    			."\t</td>\n"
    			."\t<td width='25%'>\n";
    			if ($activeuse == 0)
    			{
    				$labelsoutput.= "\t<input type='submit' name='method' value='"._("Del")."' onclick=\"this.form.sortorder.value='{$row['sortorder']}'\" />\n";
    			}
    			$labelsoutput.= "\t</td>\n"
    			."\t<td>\n";
    			if ($position > 0)
    			{
    				$labelsoutput.= "\t<input type='submit' name='method' value='"._("Up")."' onclick=\"this.form.sortorder.value='{$row['sortorder']}'\" />\n";
    			};
    			if ($position < $labelcount-1)
    			{
    				// Fill the sortorder hiddenfield so we now what field is moved down
                    $labelsoutput.= "\t<input type='submit' name='method' value='"._("Dn")."' onclick=\"this.form.sortorder.value='{$row['sortorder']}'\" />\n";
    			}
    			$labelsoutput.= "\t</td></tr>\n";
    			$position++;
    		}
    	    if ($labelcount>0)  
            {                       
                $labelsoutput.= "\t<tr><td colspan=4><center><input type='submit' name='method' value='"._("Save All")."'  />"
                ."</center></td></tr>\n";
            }

    		$position=sprintf("%05d", $position);
    		if ($activeuse == 0)
    		{   $labelsoutput.= "<tr><td><br /></td></tr><tr><td width='25%' align=right>"
  			    ."<strong>"._('New label').":</strong> <input type='text' maxlength='10' name='insertcode' size='10' id='addnewlabelcode' />\n"
    			."\t</td>\n"
    			."\t<td width='35%'>\n"
    			."\t<input type='text' maxlength='100' name='inserttitle_$lslanguage' size='80' />\n"
    			."\t</td>\n"
    			."\t<td width='25%'>\n"
    			."\t<input type='submit' name='method' value='"._("Add new label")."' />\n"
    			."\t</td>\n"
    			."\t<td>\n"
                ."<script type='text/javascript'>\n"
    			."<!--\n"
    			."document.getElementById('addnewlabelcode').focus();\n"
    			."//-->\n"
    			."</script>\n"
    			."\t</td>\n"
    			."</tr>\n";
    	
    		}
    		else
    		{
    			$labelsoutput.= "<tr>\n"
    			."\t<td colspan='4' align='center'>\n"
    			."<font color='red' size='1'><i><strong>"
    			._("Warning")."</strong>: "._("You cannot change codes, add or delete entries in this label set because it is being used by an active survey.")."</i></strong></font>\n"
    			."\t</td>\n"
    			."</tr>\n";
    		}
        $first=false;
    	$labelsoutput.="</tbody></table>\n";

	    $labelsoutput.=("</div>");
        }	
	$labelsoutput.= "<input type='hidden' name='sortorderids' value='$sortorderids' />\n";
	$labelsoutput.= "<input type='hidden' name='codeids' value='$codeids' />\n";
	$labelsoutput.= "</div>"
	
    	."</form>";
	
	// Here starts the Fix Sort order form
    $labelsoutput.= "</td></tr><tr><td colspan='4'>"
        ."<form style='margin-bottom:0;' action='admin.php?action=labels' method='post'>"
		."<table width='100%' style='border: solid; border-width: 0px; border-color: #555555' cellspacing='0'><tbody align='center'>\n"
		."\t<tr><td width='80%'></td>"
		."<td></td><td><input type='submit' name='method' value='"
		._("Fix Sort")."' /></td>\n"
		."</tr></tbody></table>"
		."\t<input type='hidden' name='lid' value='$lid' />\n"
		."\t<input type='hidden' name='action' value='modlabelsetanswers' />\n"
		."</form>\n";
		if ($totaluse > 0 && $activeuse == 0) //If there are surveys using this labelset, but none are active warn about modifying
		{
			$labelsoutput.= "<tr>\n"
			."\t<td colspan='4' align='center'>\n"
			."<font color='red' size='1'><i><strong>"
			._("Warning")."</strong>: "._("Some surveys currently use this label set. Modifying the codes, adding or deleting entries to this label set may produce undesired results in other surveys.")."</i><br />";
			foreach ($qidarray as $qd) {$labelsoutput.= "[<a href='".$qd['url']."'>".$qd['title']."</a>] ";}
			$labelsoutput.= "</strong></font>\n"
			."\t</td>\n"
			."</tr>\n";
		}
		$labelsoutput.= "\t</table>\n";
	}
	}
else
	{
	$action = "labels";
	include("access_denied.php");
	include("admin.php");	
	}
	
//************************FUNCTIONS********************************
function updateset($lid)
{
	global $dbprefix, $connect; 
	$_POST['label_name'] = sanitize_sql_string($_POST['label_name']);
	$_POST['languageids'] = sanitize_sql_string($_POST['languageids']);
	$query = "UPDATE ".db_table_name('labelsets')." SET label_name='{$_POST['label_name']}', languages='{$_POST['languageids']}' WHERE lid=$lid";
	if (!$result = $connect->Execute($query))
	{
		$labelsoutput.= "<script type=\"text/javascript\">\n<!--\n alert(\""._("Update of Label Set failed")." - ".$query." - ".$connect->ErrorMsg()."\")\n //-->\n</script>\n";
	}
}



function deletelabelset($lid)
// language proof
{
	global $dbprefix, $connect;
	//CHECK THAT THERE ARE NO QUESTIONS THAT RELY ON THIS LID
	$query = "SELECT qid FROM ".db_table_name('questions')." WHERE type IN ('F','H') AND lid=$lid";
	$result = $connect->Execute($query) or die("Error");
	$count = $result->RecordCount();
	if ($count > 0)
	{
		$labelsoutput.= "<script type=\"text/javascript\">\n<!--\n alert(\""._("Couldn't Delete Label Set - There are questions that rely on this. You must delete these questions first.")."\")\n //-->\n</script>\n";
		return false;
	}
	else //There are no dependencies. We can delete this safely
	{
		$query = "DELETE FROM ".db_table_name('labels')." WHERE lid=$lid";
		$result = $connect->Execute($query);
		$query = "DELETE FROM ".db_table_name('labelsets')." WHERE lid=$lid";
		$result = $connect->Execute($query);
		return true;
	}
}



function insertlabelset()
{
	global $dbprefix, $connect;
//	$labelsoutput.= $_POST['languageids'];  For debug purposes
	$_POST['label_name'] = sanitize_sql_string($_POST['label_name']);
	$_POST['languageids'] = sanitize_sql_string($_POST['languageids']);
	$query = "INSERT INTO ".db_table_name('labelsets')." (label_name,languages) VALUES ('{$_POST['label_name']}','{$_POST['languageids']}')";
	if (!$result = $connect->Execute($query))
	{
		$labelsoutput.= "<script type=\"text/javascript\">\n<!--\n alert(\""._("Update of Label Set failed")." - ".$query." - ".$connect->ErrorMsg()."\")\n //-->\n</script>\n";
	}
	else
	{
		return $connect->Insert_ID();
	}
}



function modlabelsetanswers($lid)
{
	global $dbprefix, $connect;
	
	$qulabelset = "SELECT * FROM ".db_table_name('labelsets')." WHERE lid='$lid'";
	$rslabelset = db_execute_assoc($qulabelset) or die($connect->ErrorMsg());
	$rwlabelset=$rslabelset->FetchRow();
	$lslanguages=explode(" ", trim($rwlabelset['languages'])); 
	
	if (get_magic_quotes_gpc() == "0")
	{
		if (isset($_POST['title']))
		{
			$_POST['title'] = addcslashes($_POST['title'], "'");
		}
	}
	if (!isset($_POST['method'])) {
		$_POST['method'] = _("Save");
	}
	switch($_POST['method'])
	{
		case _("Add new label"):
		if (isset($_POST['insertcode']) && $_POST['insertcode']!='')
		{
   			$query = "select max(sortorder) as maxorder from ".db_table_name('labels')." where lid='$lid'";
            $result = $connect->Execute($query);
       		$newsortorder=sprintf("%05d", $result->fields['maxorder']+1);


        	foreach ($lslanguages as $lslanguage)
        	{
    			$query = "INSERT INTO ".db_table_name('labels')." (lid, code, title, sortorder,language) VALUES ($lid, '{$_POST['insertcode']}', '{$_POST['inserttitle_'.$lslanguage]}', '$newsortorder','$lslanguage')";
                if (!$result = $connect->Execute($query))
    			{
    				$labelsoutput.= "<script type=\"text/javascript\">\n<!--\n alert(\"".('Failed to insert label')." - ".$query." - ".$connect->ErrorMsg()."\")\n //-->\n</script>\n";
    			}
			}
		}
		break;
		// Save all labels with one button
		case _("Save All"):
            //Determine autoids by evaluating the hidden field		
            $sortorderids=explode(' ', trim($_POST['sortorderids']));
            $codeids=explode(' ', trim($_POST['codeids']));
            $count=0; 

         	foreach ($sortorderids as $sortorderid)
        	{
        		$langid=substr($sortorderid,0,strpos($sortorderid,'_')); 
        		$orderid=substr($sortorderid,strpos($sortorderid,'_')+1,20);
                $query = "UPDATE ".db_table_name('labels')." SET code='".$_POST['code_'.$codeids[$count]]."', title='{$_POST['title_'.$sortorderid]}' WHERE sortorder=$orderid and language='$langid'";
        		//$labelsoutput.= $query;  DP
        		if (!$result = $connect->Execute($query))
        		{
        			$labelsoutput.= "<script type=\"text/javascript\">\n<!--\n alert(\"".('Failed to update label')." - ".$query." - ".$connect->ErrorMsg()."\")\n //-->\n</script>\n";
    			}
    			$count++;
    			if ($count>count($codeids)-1) {$count=0;}
		    }

		break;

        // Pressing the Up button
		case _("Up"):
		$newsortorder=$_POST['sortorder']-1;
		$oldsortorder=$_POST['sortorder'];
		$cdquery = "UPDATE ".db_table_name('labels')." SET sortorder=-1 WHERE lid=$lid AND sortorder='$newsortorder'";
		$cdresult=$connect->Execute($cdquery) or die($connect->ErrorMsg());
		$cdquery = "UPDATE ".db_table_name('labels')." SET sortorder=$newsortorder WHERE lid=$lid AND sortorder=$oldsortorder";
		$cdresult=$connect->Execute($cdquery) or die($connect->ErrorMsg());
		$cdquery = "UPDATE ".db_table_name('labels')." SET sortorder='$oldsortorder' WHERE lid=$lid AND sortorder=-1";
		$cdresult=$connect->Execute($cdquery) or die($connect->ErrorMsg());
		break;

        // Pressing the Down button
		case _("Dn"):
		$newsortorder=$_POST['sortorder']+1;
		$oldsortorder=$_POST['sortorder'];
		$cdquery = "UPDATE ".db_table_name('labels')." SET sortorder=-1 WHERE lid=$lid AND sortorder='$newsortorder'";
		$cdresult=$connect->Execute($cdquery) or die($connect->ErrorMsg());
		$cdquery = "UPDATE ".db_table_name('labels')." SET sortorder='$newsortorder' WHERE lid=$lid AND sortorder=$oldsortorder";
		$cdresult=$connect->Execute($cdquery) or die($connect->ErrorMsg());
		$cdquery = "UPDATE ".db_table_name('labels')." SET sortorder=$oldsortorder WHERE lid=$lid AND sortorder=-1";
		$cdresult=$connect->Execute($cdquery) or die($connect->ErrorMsg());
		break;
		
		// Delete Button
		case _("Del"):
		$query = "DELETE FROM ".db_table_name('labels')." WHERE lid=$lid AND sortorder='{$_POST['sortorder']}'";
		if (!$result = $connect->Execute($query))
		{
			$labelsoutput.= "<script type=\"text/javascript\">\n<!--\n alert(\"".('Failed to delete label')." - ".$query." - ".$connect->ErrorMsg()."\")\n //-->\n</script>\n";
		}
		break;
		
		// Fix Sortorder button
		case _("Fix Sort"):
		fixorder($lid);
		break;
	}
}


function fixorder($lid) //Function rewrites the sortorder for a group of answers
{
	global $dbprefix, $connect;
	$qulabelset = "SELECT * FROM ".db_table_name('labelsets')." WHERE lid=$lid";
	$rslabelset = db_execute_assoc($qulabelset) or die($connect->ErrorMsg());
	$rwlabelset=$rslabelset->FetchRow();
	$lslanguages=explode(" ", trim($rwlabelset['languages'])); 
	foreach ($lslanguages as $lslanguage)
	{
    	$query = "SELECT lid, code, title FROM ".db_table_name('labels')." WHERE lid=? and language='$lslanguage' ORDER BY sortorder, code";
    	$result = db_execute_num($query, array($lid));
    	$position=0;
    	while ($row=$result->FetchRow())
    	{
    		$position=sprintf("%05d", $position);
    		$query2="UPDATE ".db_table_name('labels')." SET sortorder='$position' WHERE lid=? AND code=? AND title=? AND language='$lslanguage' ";
    		$result2=$connect->Execute($query2, array ($row[0], $row[1], $row[2])) or die ("Couldn't update sortorder<br />$query2<br />".$connect->ErrorMsg());
    		$position++;
    	}
    }	
}




?>
