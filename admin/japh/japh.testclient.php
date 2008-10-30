<?php
$wsdl = $_REQUEST['wsdl'];
#####################################################################
## Configuration Parameters

//we don't like caching while testing, so we disable it
ini_set("soap.wsdl_cache_enabled", 0);

// errors are ok, but warnings just destroy our layout while they have nothing to say (in this case, sometimes warnings are useful!)
ini_set("error_reporting", "E_ALL & ~E_WARNING");

if($wsdl=='')
{
	// give full uri of the wsdl from the webservice you want to connect to...
	// THIS NEEDS TO BE CHANGED to the webservice you want to connect, localhost is just for testing on one machine...
	// change http to https if you want to use ssl connection to the wsdl...
	$wsdl='https://localhost/limesource/limesurvey/admin/japh/japh.wsdl';
}
//set this to your limesurvey installation path for the "test survey" link to work
$limeUrl='https://localhost/limesource/limesurvey';

//We need authentication for every function, so just write the logindata once for all
$user ="admin";
$pass ="password";

// fixed certificate, if U use some... you need this if you have an own trusted certificate.
// If you dont know what I am taking about, just leave this option untouched.
//$cert='allinone.pem';


##
#####################################################################
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Japh.Service Testclient</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style type='text/css'>
<!--
body {
	background-color: black;
	color: white;
}

div {
	background-color: white;
	color: black;
	padding: 0.2em;
}
a:link{
	color:darkgreen;
	fontweight:bold;
}
a:visited{
	color:darkgreen;
	fontweight:bold;
}
a:hover{
	color:green;
	fontweight:bold;
}
-->
</style>
<?php

// Checkfunction für die soap Klasse und die benötigte libxml version...
function soapCheck ($path2wsdl)
{
	$soapCheck ='<div style="color:white;background-color:black;border: 1px solid green;">';
	if(class_exists(SoapClient))
	{
		$soapCheck .= "<div style='float:left;background:green;color:white;padding:5px;margin-right:5px;'>
						SOAP Erweiterung existiert</div> ";
	}
	else
	{
		$soapCheck .= "<div style='float:left;background:red;color:white;padding:5px;margin-right:5px;'>
						SOAP Erweiterung fehlt!</div> ";
	}
	if(LIBXML_VERSION>=20540)
	{
		$soapCheck .= " <div style='float:left;background:green;color:white;padding:5px;margin-right:5px;'>
						libXML version '".LIBXML_DOTTED_VERSION."' OK</div>";
	}
	else
	{
		$soapCheck .= " <div style='float:left;background:red;color:white;padding:5px;margin-right:5px;'>
						libXML version '".(LIBXML_DOTTED_VERSION )."' nicht OK</div>";
	}
	// Check ob eine wsdl Datei gefunden werden kann
	//$wsdlfile = ;
	
	ini_set("allow_url_fopen", 1);
	if (!fopen($path2wsdl,"r"))
	{
		$soapCheck .= "<div style='float:left;background:red;color:white;padding:5px;'>
						Der Pfad zur WSDL Datei ist nicht korrekt oder die WSDL Datei fehlt!</div>";
	}
	else
	{
		$soapCheck .= "<div style='float:left;background:green;color:white;padding:5px;'>
						WSDL Datei konnte gefunden werden</div>";
	}
	$soapCheck .= "<div style='clear:both;background-color:black;'>
					<form action='".$_SERVER['PHP_SELF']."' method='post'>
					<input type='text' name='wsdl' size='97' value='".$path2wsdl."' />
					<input type='submit' name='validate' value='neu checken!' />
					</form>
					</div></div>";
	return $soapCheck;
}

// We initiate a SOAPclient Object and give the ssl-certificate, if wished:
if(isset($cert) && $cert!="")
{
	ini_set("allow_url_fopen", 1);
	$file = fopen($wsdl,"r");
	if(class_exists(SoapClient) && $file!=FALSE)
	{
		$context["ssl"]["local_cert"] = $cert;
		//		$context["ssl"]["verify_peer"] = TRUE;
		$context["ssl"]["allow_self_signed"] = TRUE;
		//		$context["ssl"]["cafile"] = "D://xampp//htdocs//apache//conf//keys//allinOne.pem";
		//		$context["ssl"]["capath"] = "D://xampp//htdocs//apache//conf//keys";
		$stream_context = stream_context_create($context);

		$client = new SoapClient($wsdl, array('soap_version' => SOAP_1_1,
				'trace' => 1, 
		//'stream_context' => $stream_context,
				'local_cert' => $cert));
	}
}
else
{
	ini_set("allow_url_fopen", 1);
	$file = fopen($wsdl,"r");
	if(class_exists(SoapClient) && $file!=FALSE)
	{
		$client = new SoapClient($wsdl, array('soap_version' => SOAP_1_1,
            'trace' => 1));   
	}
}
if($file!=FALSE)
{
	try
	{	$mods = $client->aAvailableModules($user, "password", "mod");}
	catch (SoapFault $fault)
	{	$mods .= " <br/><br/><b>SOAP Error: ".$fault->faultcode." : ".$fault->faultstring."</b>";}
}
if($file!=FALSE)
{
	try
	{	$cores = $client->aAvailableModules($user, "password", "core");}
	catch (SoapFault $fault)
	{	$cores .= " <br/><br/><b>SOAP Error: ".$fault->faultcode." : ".$fault->faultstring."</b>";}
}

$iVid = $_REQUEST['sid'];
//$sVbes = utf8_encode($sVbes);
//$user = $_REQUEST['user'];
//$pass = $_REQUEST['password'];

// Calling the desired function //XXX
reset($_REQUEST);
while(list($key, $value) = each($_REQUEST))
{
	if(substr($key,0,9)=="impMatrix")
	{
		$iVid = $_REQUEST['sid'];
		// $sMod = $_REQUEST['mod'];
		// $qTitle = $_REQUEST['title'];
		$qText = $_REQUEST['quest'];
		$mandatory = $_REQUEST['mandatory'];
		for($n=1;$n<10;++$n)
		{
			if($_REQUEST['item'.$n]!='')
			{
				if($n==1)
				{
					$items = $_REQUEST['item'.$n];
				}
				else
				{
					$items .= ",".$_REQUEST['item'.$n];
				}
			}
		}

		$qHelp = $_REQUEST['help'];
			
		try
		{

			$sReturn = $client->sImportMatrix($user, $pass, $iVid, "Matrix", $qText, $qHelp, $items,$mandatory);
		}
		catch (SoapFault $fault)
		{
			$sOutput .= " <br/><br/><b>SOAP Error: ".$fault->faultcode." : ".$fault->faultstring."</b>";
		}
		//these are just outputs for testing
		$sOutput .= "<br/><br/><b>Return</b>: ". $sReturn;
	}

	if(substr($key,0,8)=="impQuest")
	{
		$iVid = $_REQUEST['sid'];
		// $sMod = $_REQUEST['mod'];
		$qTitle = $_REQUEST['title'];
		$qText = $_REQUEST['quest'];
		$qHelp = $_REQUEST['help'];
		$mandatory = $_REQUEST['mandatory'];
			
		try
		{

			$sReturn = $client->sImportQuestion($user, $pass, $iVid, "Freitext", $qTitle, $qText, $qHelp,$mandatory);
		}
		catch (SoapFault $fault)
		{
			$sOutput .= " <br/><br/><b>SOAP Error: ".$fault->faultcode." : ".$fault->faultstring."</b>";
		}
		//these are just outputs for testing
		$sOutput .= "<br/><br/><b>Return</b>: ". $sReturn;
	}

	if(substr($key,0,8)=="impGroup")
	{
		$iVid = $_REQUEST['sid'];
		$sMod = $_REQUEST['mod'];
		$user = $_REQUEST['user'];
		try
		{
			$sReturn = $client->sImportGroup($user, $pass, $iVid, $sMod);
		}
		catch (SoapFault $fault)
		{
			$sOutput .= " <br/><br/><b>SOAP Error: ".$fault->faultcode." : ".$fault->faultstring."</b>";
		}
		//these are just outputs for testing
		$sOutput .= "<br/><br/><b>Return</b>: ". $sReturn;
	}

	if(substr($key,0,8)=="activate")
	{
		$iVid = $_REQUEST['sid'];
		$dStart = $_REQUEST['start'];
		$dEnd = $_REQUEST['end'];
		if(isset($dStart) && $dStart!='')
		{
			$sUseStart='Y';
		}
		if(isset($dEnd) && $dEnd!='')
		{
			$sUseEnd='Y';
		}

		try
		{
			$sReturn = $client->sActivateSurvey($user, $pass, $iVid, $sUseStart, $dStart,  $sUseEnd, $dEnd);
		}
		catch (SoapFault $fault)
		{
			$sOutput .= " <br/><br/><b>SOAP Error: ".$fault->faultcode." : ".$fault->faultstring."</b>";
		}
		//these are just outputs for testing
		$sOutput .= "<br/><br/><b>Return</b>: ". $sReturn;
	}

	if(substr($key,0,6)=="submit")
	{
		//$functionToCall = "sCreateSurvey";
		$iVid = $_REQUEST['sid'];
		$sVbes = $_REQUEST['sdes'];
		$sVtit = $_REQUEST['stit'];
		$sVwel = $_REQUEST['sVwel'];
		$sMail = $_REQUEST['sEmail'];
		$sName = $_REQUEST['sName'];
		$sUrl = $_REQUEST['sUrl'];
		$sUbes = $_REQUEST['sUdes'];
		$sVtyp = $_REQUEST['core'];

		try
		{
			$sReturn = $client->sCreateSurvey($user, $pass, $iVid, $sVtit , $sVbes, $sVwel, $sMail, $sName, $sUrl, $sUbes, $sVtyp);
		}
		catch (SoapFault $fault)
		{
			$sOutput .= " <br/><br/><b>SOAP Error: ".$fault->faultcode." : ".$fault->faultstring."</b>";
		}
		//these are just outputs for testing
		$sOutput .= "<br/><br/><b>Return</b>: ". $sReturn;
	}
	if(substr($key,0,6)=="change")
	{
		$table = $_REQUEST['table'];
		$key = $_REQUEST['key'];
		$value = $_REQUEST['value'];
		$where = $_REQUEST['whereKey'];
		//$whereValue = $_REQUEST['whereValue'];
		 
		try
		{
			$sReturn = $client->sChangeSurvey($user, "password", $table, $key, $value, $where );
		}
		catch (SoapFault $fault)
		{
			$sOutput .= " <br/><br/><b>SOAP Error: ".$fault->faultcode." : ".$fault->faultstring."</b>";
		}
		//these are just outputs for testing
		$sOutput .= "<br/><br/><b>Return</b>: ". $sReturn;
	}
	if(substr($key,0,6)=="tokens")
	{
		$sToken = $_REQUEST['token'];
		try
		{
			$sReturn = $client->sInsertToken($user, $pass, $iVid, $sToken );
		}
		catch (SoapFault $fault)
		{
			$sOutput .= " <br/><br/><b>SOAP Error: ".$fault->faultcode." : ".$fault->faultstring."</b>";
		}
		//this are just outputs for testing
		$sOutput .= "<br/><br/><b>Return</b>: ". $sReturn;
	}
	if(substr($key,0,6)=="tokRet")
	{
		//$functionToCall = "sTokenReturn";
		try
		{
			$sReturn = $client->sTokenReturn($user, $pass, $iVid);
		}
		catch (SoapFault $fault)
		{
			$sOutput .= " <br/><br/><b>SOAP Error: ".$fault->faultcode." : ".$fault->faultstring."</b>";
		}
		//this are the return Values
		$sOutput .= "<br/><br/><b>Return</b>: <br/>['iVid'] => ". $sReturn['iVid'] ." <br/> ['return'] => ". $sReturn['return'];
	}
	if(substr($key,0,6)=="insPar")
	{
		$sParticipantData = $_REQUEST['sParticipantData'];
		try
		{
			$sReturn = $client->sInsertParticipants($user, $pass, $iVid, $sParticipantData);
		}
		catch (SoapFault $fault)
		{
			$sOutput .= " <br/><br/><b>SOAP Error: ".$fault->faultcode." : ".$fault->faultstring."</b>";
		}
		//these are just outputs for testing
		$sOutput .= "<br/><br/><b>Return</b>: ". $sReturn;
	}
}
if(isset($sReturn))
{
	$sOutput .="<br/><br/>Dumping <b>request headers</b>:<br/><pre>"
	.$client->__getLastRequestHeaders()."</pre>";

	$sOutput .="Dumping <b>request</b>:<code>".htmlentities($client->__getLastRequest())."</code>";

	$sOutput .="<br/><br/><br/> Dumping <b>response headers</b>:<br/><pre>"
	.$client->__getLastResponseHeaders()."</pre>";
	$sOutput .="<br/>Dumping <b>response</b>:<br/><code>".htmlentities($client->__getLastResponse())."</code>";
	//$resp[] = $client->__getLastResponse();
	// echo $resp['resParam'];
}
?>
</head>
<body>
<?php echo soapCheck($wsdl); ?>
<?php
// we dump the client object functions (which are functions of the server  defined in the wsdl)
if(!isset($sOutput))
{
	echo "<b>Client object functions:</b> <font style='font-size:x-small'>(As given in the wsdl file. Functions could be disabled or else on the serverside. There is no guarantee the functions really have these Params nor that the functions exist on the serverside.)</font><br/>";
	if($file!=FALSE)
	{
		$funcs=$client->__getFunctions();
		
		foreach($funcs as $func)
		{
			echo '<font style="font-size:small;line-height:16pt;" >';
			print_r($func);
			echo '</font><br/>';
		}
	}
}

if(isset($sOutput))
{
	
	echo '<div style="color:white;background-color:black;border: 1px solid white;">';
	echo '<h3>testing output:</h3>';
	if(isset($iVid))
	{
		echo "<a href='{$limeUrl}/index.php?sid=".$iVid."&amp;lang=de&amp;newtest=Y' target='_blank'>test Survey</a>";
	}
	echo $sOutput;
	echo '</div>';
}
?>
<div style='margin-bottom: 5px'>
<h3>sCreateSurvey function</h3>
<form action='<?php echo $_SERVER['PHP_SELF'] ?>' method='post'>
<b><font color='red'>* </font>VeranstaltungsTyp:</b>
<br />
<select name='core' size='1'>
<?php
$aCores = explode(",", $cores);
for($n=0;$n<count($aCores);++$n)
{echo "<option value='".$aCores[$n]."'>".$aCores[$n]."</option>";}
?>
</select> <? //print_r($cores);?> <br />
<b><font color='red'>* </font>VeranstaltungsID / SurveyID (have to be Integer):</b>
<br />
<input type='text' name='sid' size='5' maxlength='5' /> <br />
<b><font color='red'>* </font>Veranstaltungs Titel / Survey Title (used
as part of the welcome message, if welcome Message is left blank):</b> <br />
<input type='text' name='stit' size='30' maxlength='150' /> <br />
<b><font color='red'>* </font>VeranstaltungsBeschreibung /
SurveyDescription (used as part of the welcome message, if welcome
Message is left blank):</b> <br />
<input type='text' name='sdes' size='30' maxlength='150' /> <br />
<b>Willkommenstext / Welcome Message:</b> <br />
<textarea name='sVwel' cols='50' rows='3'></textarea> <br />
<b>Admin Name:</b> <br />
<input type='text' name='sName' size='30' maxlength='150' /> <br />
<b>Admin Email:</b> <br />
<input type='text' name='sEmail' size='30' maxlength='150' /> <br />
<b>End Url:</b> <br />
<input type='text' name='sUrl' size='30' maxlength='150' /> <br />
<b>Url Description:</b> <br />
<input type='text' name='sUdes' size='30' maxlength='150' /> <br />
<input type='submit' name='submit' value='Create Survey!' /></form>
</div>


<div style='float: left;  margin-bottom: 5px'>
<h3>sActivateSurvey function</h3>
<form action='<?php echo $_SERVER['PHP_SELF'] ?>' method='post'><b><font
	color='red'>* </font>VeranstaltungsID / SurveyID (have to be Integer):</b>
<br />
<input type='text' name='sid' size='5' maxlength='5'
	value='<?php echo $iVid ?>' /> <br />
<b>Startdate (YYYY-MM-DD):</b> <br />
<input type='text' name='start' size='30' maxlength='150' /> <br />
<b>Enddate (YYYY-MM-DD):</b> <br />
<input type='text' name='end' size='30' maxlength='150' /> <br />
<input type='submit' name='activate' value='Start Survey!' /></form>
</div>

<div style='float: right;  margin-bottom: 5px'>
<h3>sImportGroup function</h3>
<form action='<?php echo $_SERVER['PHP_SELF'] ?>' method='post'><b><font
	color='red'>* </font>VeranstaltungsID / SurveyID (have to be Integer):</b>
<br />
<input type='text' name='sid' size='5' maxlength='5'
	value='<?php echo $iVid ?>' /> <br />
<b><font color='red'>* </font>Question group to add (INF,BIO,BWL is
there for testing):</b> <br />
<select name='mod' size='1'>
<?php
$aMods = explode(",", $mods);
for($n=0;$n<count($aMods);++$n)
{echo "<option value='".$aMods[$n]."'>".$aMods[$n]."</option>";}
?>
</select> <? //print_r($mods);?> <br />
<input type='submit' name='impGroup' value='add group to survey!' /></form>
</div>

<div
	style='clear: both; float: left; width: 49%;  margin-bottom: 5px'>
<h3>sImportQuestion</h3>
<form action='<?php echo $_SERVER['PHP_SELF'] ?>' method='post'><b><font
	color='red'>* </font>VeranstaltungsID / SurveyID (have to be Integer):</b>
<br />
<input type='text' name='sid' size='5' maxlength='5'
	value='<?php echo $iVid ?>' /> <br />
	<input type='checkbox' name='mandatory' value='Y' /> Mandatory <br />
<b><font color='red'>* </font>Question Title :</b> <br />
<input type='text' name='title' size='30' maxlength='150' /> <br />
<b><font color='red'>* </font>Question:</b> <br />
<textarea name='quest' cols='50' rows='3'></textarea> <br />
<b>Helptext:</b> <br />
<textarea name='help' cols='50' rows='3'></textarea> <br />
<input type='submit' name='impQuest' value='Create Question!' /></form>
</div>

<div
	style='float: right; width: 49%;  margin-bottom: 5px'>
<h3>sImportMatrix</h3>
<form action='<?php echo $_SERVER['PHP_SELF'] ?>' method='post'><b><font
	color='red'>* </font>VeranstaltungsID / SurveyID (have to be Integer):</b>
<br />
<input type='text' name='sid' size='5' maxlength='5'
	value='<?php echo $iVid ?>' /> <br />
	<input type='checkbox' name='mandatory' value='Y' /> Mandatory <br />
<b><font color='red'>* </font>Question :</b> <br />
<textarea name='quest' cols='50' rows='3'></textarea> <br />
<?php
for($n=1;$n<10;++$n)
{
	echo "<b>Item {$n} :</b> <br />",
		 "<input type='text' name='item{$n}' size='50' maxlength='150'/>",
		 "<br />";
}
?> <b>Helptext:</b> <br />
<textarea name='help' cols='50' rows='3'></textarea> <br />
<input type='submit' name='impMatrix' value='Create Question!' /></form>
</div>


<div style='float: left;  margin-bottom: 5px'>
<h3>sChangeSurvey function</h3>
( this is not part of the japh, it just shows the power of it )
<form action='<?php echo $_SERVER['PHP_SELF'] ?>' method='post'><b>Table
to change</b> <br />
<input type='text' name='table' size='30' maxlength='150' /> <br />
<b>Key</b><br />
<input type='text' name='key' size='30' maxlength='150' value='' /> <br />
<b>Value</b> <br />
<input type='text' name='value' size='30' maxlength='150' value='' /> <br />
<b>where Condition</b> <br />
<input type='text' name='whereKey' size='30' maxlength='150' /> <br />
<!-- <b>where Value</b> <br />
<input type='text' name='whereValue' size='30' maxlength='150'/>
<br />--> <input type='submit' name='change' value='Change Survey!' /></form>

</div>
<div style='float:left;  margin-bottom: 5px'><?php 
echo "<h3>sInsertToken function</h3>";
echo "<p>Makes the Survey closed. Means: It's only available to people who have an unused token</p>";
echo "<form action='".$_SERVER['PHP_SELF']."' method='post'>";
echo "<b><font color='red'>* </font>VeranstaltungsID / SurveyID (have to be Integer):</b> <br />";
echo "<input type='text' name='sid' size='5' maxlength='5' value='".$iVid."'/>";
echo "<br />";
echo "<b>Tokens seperated by comma (,) :</b> <br />";
echo "<input type='text' name='token' size='50' maxlength='110'/>";
echo "<br />";
echo "<input type='submit' name='tokens' value='Insert Token!'/>";
echo "</form>";
echo "</div>";


echo "<div style='float:right; margin-bottom:5px'>";
echo "<h3>sTokenReturn function</h3>";
echo "<form action='".$_SERVER['PHP_SELF']."' method='post'>";
echo "<b><font color='red'>* </font>VeranstaltungsID / SurveyID (have to be Integer):</b> <br />";
echo "<input type='text' name='sid' value='".$iVid."' maxlength='5'/><br />";
echo "<input type='submit' name='tokRet' value='Check for unused Tokens!'/>";
echo "</form></div>";

echo "<div style='clear:both;margin-bottom:5px'>";
echo "<h3>sInsertParticipants function</h3>";
echo "<p>Makes the Survey closed. Means: It's only available to people who have an unused token</p>";
echo "<form action='".$_SERVER['PHP_SELF']."' method='post'>";
echo "<b><font color='red'>* </font>VeranstaltungsID / SurveyID (have to be Integer):</b> <br />";
echo "<input type='text' name='sid' size='5' maxlength='5' value='".$iVid."'/>";
echo "<br />";
echo "<b><font color='red'>* </font>Data in this Format [params in square brackets are optional]:<br/> \"FIRSTNAME;LASTNAME;EMAIL[;[ATTRIB1];[ATTRIB2]]::FIRSTNAME;LASTNAME;EMAIL[;[ATTRIB1];[ATTRIB2]]\" and so on :</b> <br />";
echo "<textarea name='sParticipantData' cols='50' rows='3'>";
echo "</textarea> ";
echo "<br />";

echo "<input type='submit' name='insPar' value='Insert Personal Data!'/>";
echo "</form>";
echo "</div>";




//phpinfo();

?>

</body>
</html>
