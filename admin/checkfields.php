<?php
//THE TABLE STRUCTURE, TABLE BY TABLE AND FIELD BY FIELD
include("config.php");

sendcacheheaders();

//TABLES THAT SHOULD EXIST
$alltables=array("{$dbprefix}surveys", "{$dbprefix}groups", "{$dbprefix}questions", "{$dbprefix}answers", "{$dbprefix}conditions", "{$dbprefix}users", "{$dbprefix}labelsets", "{$dbprefix}labels");

//KEYS
$keyinfo[]=array("{$dbprefix}surveys", "sid");
$keyinfo[]=array("{$dbprefix}groups", "gid");
$keyinfo[]=array("{$dbprefix}questions", "qid");
$keyinfo[]=array("{$dbprefix}conditions", "cid");
$keyinfo[]=array("{$dbprefix}labelsets", "lid");

//FIELDS THAT SHOULD EXIST
$allfields[]=array("{$dbprefix}labelsets", "lid", "lid int(11) NOT NULL auto_increment");
$allfields[]=array("{$dbprefix}labelsets", "label_name", "label_name varchar(100) NOT NULL default ''");

$allfields[]=array("{$dbprefix}labels", "lid", "lid int(11) NOT NULL default '0'");
$allfields[]=array("{$dbprefix}labels", "code", "code varchar(5) NOT NULL default ''");
$allfields[]=array("{$dbprefix}labels", "title", "title varchar(50) NOT NULL default ''");
$allfields[]=array("{$dbprefix}labels", "sortorder", "sortorder varchar(5) NULL");

$allfields[]=array("{$dbprefix}users", "user", "user varchar(20) NOT NULL default ''");
$allfields[]=array("{$dbprefix}users", "password", "password varchar(20) NOT NULL default ''");
$allfields[]=array("{$dbprefix}users", "security", "security varchar(10) NOT NULL default ''");

$allfields[]=array("{$dbprefix}answers", "qid", "qid int(11) NOT NULL default '0'");
$allfields[]=array("{$dbprefix}answers", "code", "code varchar(5) NOT NULL default ''");
$allfields[]=array("{$dbprefix}answers", "answer", "answer text NOT NULL");
$allfields[]=array("{$dbprefix}answers", "default", "`default` char(1) NOT NULL default 'N'");
$allfields[]=array("{$dbprefix}answers", "sortorder", "sortorder varchar(5) NULL");

$allfields[]=array("{$dbprefix}conditions", "cid", "cid int(11) NOT NULL auto_increment");
$allfields[]=array("{$dbprefix}conditions", "qid", "qid int(11) NOT NULL default '0'");
$allfields[]=array("{$dbprefix}conditions", "cqid", "cqid int(11) NOT NULL default '0'");
$allfields[]=array("{$dbprefix}conditions", "cfieldname", "cfieldname varchar(50) NOT NULL default ''");
$allfields[]=array("{$dbprefix}conditions", "method", "method char(2) NOT NULL default ''");
$allfields[]=array("{$dbprefix}conditions", "value", "value varchar(5) NOT NULL default ''");

$allfields[]=array("{$dbprefix}groups", "gid", "gid int(11) NOT NULL auto_increment");
$allfields[]=array("{$dbprefix}groups", "sid", "sid int(11) NOT NULL default '0'");
$allfields[]=array("{$dbprefix}groups", "group_name", "group_name varchar(100) NOT NULL default ''");
$allfields[]=array("{$dbprefix}groups", "description", "description text");

$allfields[]=array("{$dbprefix}questions", "qid", "qid int(11) NOT NULL auto_increment");
$allfields[]=array("{$dbprefix}questions", "sid", "sid int(11) NOT NULL default '0'");
$allfields[]=array("{$dbprefix}questions", "gid", "gid int(11) NOT NULL default '0'");
$allfields[]=array("{$dbprefix}questions", "type", "type char(1) NOT NULL default 'T'");
$allfields[]=array("{$dbprefix}questions", "title", "title varchar(20) NOT NULL default ''");
$allfields[]=array("{$dbprefix}questions", "question", "question text NOT NULL");
$allfields[]=array("{$dbprefix}questions", "help", "help text");
$allfields[]=array("{$dbprefix}questions", "other", "other char(1) NOT NULL default 'N'");
$allfields[]=array("{$dbprefix}questions", "mandatory", "mandatory char(1) default NULL");
$allfields[]=array("{$dbprefix}questions", "lid", "lid int(11) NOT NULL default '0'");

$allfields[]=array("{$dbprefix}surveys", "sid", "sid int(11) NOT NULL auto_increment");
$allfields[]=array("{$dbprefix}surveys", "short_title", "short_title varchar(50) NOT NULL default ''");
$allfields[]=array("{$dbprefix}surveys", "description", "description text");
$allfields[]=array("{$dbprefix}surveys", "admin", "admin varchar(20) default NULL");
$allfields[]=array("{$dbprefix}surveys", "active", "active char(1) NOT NULL default 'N'");
$allfields[]=array("{$dbprefix}surveys", "welcome", "welcome text");
$allfields[]=array("{$dbprefix}surveys", "expires", "expires date default NULL");
$allfields[]=array("{$dbprefix}surveys", "adminemail", "adminemail varchar(100) default NULL");
$allfields[]=array("{$dbprefix}surveys", "private", "private char(1) default NULL");
$allfields[]=array("{$dbprefix}surveys", "faxto", "faxto varchar(20) default NULL");
$allfields[]=array("{$dbprefix}surveys", "format", "format char(1) default NULL");
$allfields[]=array("{$dbprefix}surveys", "template", "template varchar(100) default 'default'");
$allfields[]=array("{$dbprefix}surveys", "url", "url varchar(255) default NULL");
$allfields[]=array("{$dbprefix}surveys", "urldescrip", "urldescrip varchar(255) default NULL");
$allfields[]=array("{$dbprefix}surveys", "language", "language varchar(50) default ''");
$allfields[]=array("{$dbprefix}surveys", "datestamp", "datestamp char(1) default 'N'");
$allfields[]=array("{$dbprefix}surveys", "usecookie", "usecookie char(1) default 'N'");
$allfields[]=array("{$dbprefix}surveys", "notification", "notification char(1) default '0'");

echo $htmlheader;

echo "<br />\n";
echo "<table width='350' align='center' style='border: 1px solid #555555' cellpadding='1' cellspacing='0'>\n";
echo "\t<tr bgcolor='#555555'><td colspan='2' height='4'><font size='1' face='verdana' color='white'><b>"._CHECKFIELDS."</b></td></tr>\n";
echo "\t<tr height='22' bgcolor='#CCCCCC'><td>\n";

echo "$setfont<b>"._CF_CHECKTABLES.":</b><br /><font size='1'>\n";

$result = mysql_list_tables($databasename);
while ($row = mysql_fetch_row($result))
	{
	$tablelist[]=$row[0];
    }
if (!is_array($tablelist))
	{
	$tablelist[]="empty";
	}
foreach ($alltables as $at)
	{
	echo "<b>-></b>"._CF_CHECKING." <b>$at</b>..<br />";
	if (!in_array($at, $tablelist))
		{
		//Create table
		$ctquery="CREATE TABLE `$at` (\n";
		foreach ($allfields as $af)
			{
			if ($af[0] == $at)
				{
				$ctquery .= $af[2].",\n";
				}
			}
		foreach($keyinfo as $ki)
			{
			if ($ki[0] == $at)
				{
				$ctquery .= "PRIMARY KEY ({$ki[1]}),\n";
				}
			}
		$ctquery = substr($ctquery, 0, -2);
		$ctquery .= ")\n";
		$ctquery .= "TYPE=MyISAM\n";
		$ctresult=mysql_query($ctquery) or die ("Couldn't create $at table<br />$ctquery<br />".mysql_error);
		echo "&nbsp;&nbsp;&nbsp;&nbsp;<font color='red'>"._CF_TABLECREATED."! ($at)</font><br />\n";
		}
	else
		{
		echo "&nbsp;&nbsp;&nbsp;&nbsp;<font color='green'>"._CF_OK."</font><br />\n";
		}
	//echo "<br />\n";
	}
echo "<br /></font>\n";


echo "$setfont<b>"._CF_CHECKFIELDS.":</b><br /><font size='1'>\n";

//GET LIST OF TABLES
$tables = mysql_list_tables($databasename);
while ($trow = mysql_fetch_row($tables))
	{
	$tablenames[] = $trow[0];
	}

foreach ($tablenames as $tn)
	{
	if (substr($tn, 0, 3) != "old" && substr($tn, 0, 7) != "survey_" && substr($tn, 0, 3) != "tok")
		{
		checktable($tn);
		}
	}

function checktable($tablename)
	{
	global $databasename, $allfields;
	echo "<b>-></b>"._CF_CHECKING." <b>$tablename</b>..<br />";
	$fields=mysql_list_fields($databasename, $tablename);
	$numfields=mysql_num_fields($fields);
	for ($i=0; $i<$numfields; $i++)
		{
		$fieldnames[]=mysql_field_name($fields, $i);
		}
	foreach ($allfields as $af)
		{
		if ($af[0] == $tablename)
			{
			$thisfieldexists=0;
			foreach($fieldnames as $fn)
				{
				if ($af[1] == $fn)
					{
					$thisfieldexists=1;
					}
				}
			if ($thisfieldexists==0)
				{
				$query="ALTER TABLE `$tablename` ADD $af[2]";
				$result=mysql_query($query) or die("Insert field failed.<br />$query<br />".mysql_error());
				echo "&nbsp;&nbsp;&nbsp;&nbsp;<font color='red'>"._CF_FIELDCREATED."</font> ($af[1]) <br />\n";
				$addedfield="Y";
				}
			}
		}
	if ($addedfield != "Y")
		{
		echo "&nbsp;&nbsp;&nbsp;&nbsp;<font color='green'>"._CF_OK."</font><br />\n";
		}
	}

if ($checkfororphans)
	{
	$query  = "SELECT {$dbprefix}questions.qid as nullqid, {$dbprefix}answers.* "
			. "FROM {$dbprefix}answers "
			. "LEFT JOIN {$dbprefix}questions "
			. "ON {$dbprefix}answers.qid={$dbprefix}questions.qid "
			. "WHERE {$dbprefix}questions.qid IS NULL";
	$result = mysql_query($query) or die("Orphan check failed.<br />$query<br />".mysql_error());
	if ($result)
		{
		echo "<br /><b>Orphan Database Entries</b><br />\n";
		while ($row = mysql_fetch_array($result))
			{
			echo "$setfont ANSWER: ".$row['qid']." - ".$row['code']."<br />\n";
			}
		}
	}

echo "</font></td></tr>\n";
echo "<tr><td align='center' bgcolor='#CCCCCC'>\n";
echo "<input $btstyle type='submit' value='"._GO_ADMIN."' onClick=\"window.open('$scriptname', '_top')\">\n";

echo "</td></tr></table>\n";
echo "<br />\n";
echo htmlfooter("instructions.html", "Using PHPSurveyors Admin Script");

?>