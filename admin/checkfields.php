<?php
//THE TABLE STRUCTURE, TABLE BY TABLE AND FIELD BY FIELD

$allfields[]=array("answers", "qid", "qid int(11) NOT NULL default '0'");
$allfields[]=array("answers", "code", "code varchar(5) NOT NULL default ''");
$allfields[]=array("answers", "answer", "answer text NOT NULL");
$allfields[]=array("answers", "default", "default char(1) NOT NULL default 'N'");

$allfields[]=array("conditions", "cid", "cid int(11) NOT NULL auto_increment");
$allfields[]=array("conditions", "qid", "qid int(11) NOT NULL default '0'");
$allfields[]=array("conditions", "cfieldname", "cfieldname varchar(50) NOT NULL default ''");
$allfields[]=array("conditions", "method", "method char(2) NOT NULL default ''");
$allfields[]=array("conditions", "value", "value varchar(5) NOT NULL default ''");

$allfields[]=array("groups", "gid", "gid int(11) NOT NULL auto_increment");
$allfields[]=array("groups", "sid", "sid int(11) NOT NULL default '0'");
$allfields[]=array("groups", "group_name", "group_name varchar(100) NOT NULL default ''");
$allfields[]=array("groups", "description", "description text");

$allfields[]=array("questions", "qid", "qid int(11) NOT NULL auto_increment");
$allfields[]=array("questions", "sid", "sid int(11) NOT NULL default '0'");
$allfields[]=array("questions", "gid", "gid int(11) NOT NULL default '0'");
$allfields[]=array("questions", "type", "type char(1) NOT NULL default 'T'");
$allfields[]=array("questions", "title", "title varchar(20) NOT NULL default ''");
$allfields[]=array("questions", "question", "question text NOT NULL");
$allfields[]=array("questions", "help", "help text");
$allfields[]=array("questions", "other", "other char(1) NOT NULL default 'N'");
$allfields[]=array("questions", "mandatory", "mandatory char(1) default NULL");

$allfields[]=array("surveys", "sid", "sid int(11) NOT NULL auto_increment");
$allfields[]=array("surveys", "short_title", "short_title varchar(50) NOT NULL default ''");
$allfields[]=array("surveys", "description", "description text");
$allfields[]=array("surveys", "admin", "admin varchar(20) default NULL");
$allfields[]=array("surveys", "active", "active char(1) NOT NULL default 'N'");
$allfields[]=array("surveys", "welcome", "welcome text");
$allfields[]=array("surveys", "expires", "expires date default NULL");
$allfields[]=array("surveys", "adminemail", "adminemail varchar(100) default NULL");
$allfields[]=array("surveys", "private", "private char(1) default NULL");
$allfields[]=array("surveys", "faxto", "faxto varchar(20) default NULL");
$allfields[]=array("surveys", "format", "format char(1) default NULL");
$allfields[]=array("surveys", "template", "varchar(100) default 'default'");
$allfields[]=array("surveys", "url", "varchar(255) default NULL");
$allfields[]=array("surveys", "urldescrip", "varchar(255) default NULL");


include("config.php");

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
	echo "<br /><B><U>CHECKING $tablename</U></B><br />";
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
				echo "<br /><b>Missing Field!</b> Field $af[1] is missing.";
				echo "<br />";
				$query="ALTER TABLE `$tablename` ADD $af[2]";
				$result=mysql_query($query) or die("Insert field failed.<br />$query<br />".mysql_error());
				echo "Field $af[1] has been added!";
				}
			}
		}
	}
?>