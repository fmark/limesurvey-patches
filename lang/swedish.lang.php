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
	#															#
	# This language file kindly provided by Ulrika Olsson		#
	#															#
	# Updated for 0.98rc9 and slightly edited by				#
	# Bj�rn Mildh - bjorn at mildh dot se - 2004-06-30			#
	#															#
	#############################################################
*/
//SINGLE WORDS
define("_YES", "Ja");
define("_NO", "Nej");
define("_UNCERTAIN", "Vet ej");
define("_ADMIN", "Admin");
define("_TOKENS", "Beh�righetskoder");
define("_FEMALE", "Kvinna");
define("_MALE", "Man");
define("_NOANSWER", "Inget svar");
define("_NOTAPPLICABLE", "N/A"); //New for 0.98rc5 (Det finns ingen f�rkortning av Ej till�mpbar)
define("_OTHER", "Annat");
define("_PLEASECHOOSE", "V�lj");
define("_ERROR_PS", "Fel");
define("_COMPLETE", "komplett");
//from questions.php
define("_CONFIRMATION", "Bekr�ftelse");
define("_TOKEN_PS", "Beh�righetskod");
define("_CONTINUE_PS", "Forts�tt");
define("_INCREASE", "�ka"); //NEW WITH 0.98
define("_SAME", "Samma"); //NEW WITH 0.98
define("_DECREASE", "Minska"); //NEW WITH 0.98

//BUTTONS
define("_ACCEPT", "Acceptera");
define("_PREV", "f�reg.");
define("_NEXT", "n�sta");
define("_LAST", "sista");
define("_SUBMIT", "skicka");


//MESSAGES
//From QANDA.PHP
define("_CHOOSEONE", "V�lj ett av de f�ljande");
define("_ENTERCOMMENT", "Skriv din kommentar h�r");
define("_NUMERICAL_PS", "Endast nummer kan skrivas i detta f�lt");
define("_CLEARALL", "L�mna och rensa enk�ten");
define("_MANDATORY", "Denna fr�ga �r obligatorisk");
define("_MANDATORY_PARTS", "Du m�ste fylla i alla delar");
define("_MANDATORY_CHECK", "V�lj minst ett objekt");
define("_MANDATORY_RANK", "Rangordna alla alternativen");
define("_MANDATORY_POPUP", "En eller flera obligatoriska fr�gor har inte besvarats. Du kan inte forts�tta innan de �r besvarade"); //NEW in 0.98rc4
define("_VALIDATION", "This question must be answered correctly"); //NEW in VALIDATION VERSION
define("_VALIDATION_POPUP", "One or more questions have not been answered in a valid manner. You cannot proceed until these answers are valid"); //NEW in VALIDATION VERSION
define("_DATEFORMAT", "Format: ����-MM-DD");
define("_DATEFORMATEG", "(tex: 2004-12-24 f�r Julafton)");
define("_REMOVEITEM", "Ta bort detta objekt");
define("_RANK_1", "Klicka p� ett objekt i listan till v�nster, b�rja med ditt");
define("_RANK_2", "h�gst rankade objekt, upprepa tills ditt l�gst rankade objekt.");
define("_YOURCHOICES", "Dina val");
define("_YOURRANKING", "Din rangordning");
define("_RANK_3", "Klicka p� saxen till h�ger om objektet");
define("_RANK_4", "f�r att ta bort det sist elementet i listan.");
//From INDEX.PHP
define("_NOSID", "Du har inte angett ett id-nummer f�r enk�ten");
define("_CONTACT1", "Var god kontakta");
define("_CONTACT2", "f�r ytterligare assistans");
define("_ANSCLEAR", "Svaren rensade");
define("_RESTART", "Starta om enk�ten");
define("_CLOSEWIN_PS", "St�ng f�nstret");
define("_CONFIRMCLEAR", "�r du s�ker p� att du vill rensa dina svar?");
define("_EXITCLEAR", "L�mna och rensa enk�ten");
//From QUESTION.PHP
define("_BADSUBMIT1", "Kan inte skicka resultaten - det finns inga att skicka.");
define("_BADSUBMIT2", "Detta fel kan uppst� om du redan har skickat dina svar och klickat p� 'uppdatera' p� din webbl�sare. I s� fall s� �r dina svar redan sparade.");
define("_NOTACTIVE1", "Dina enk�tsvar �r inte sparade. Denna enk�t �r inte aktiviverad �nnu.");
define("_CLEARRESP", "Rensa svaren");
define("_THANKS", "Tack");
define("_SURVEYREC", "Dina enk�tsvar �r sparade.");
define("_SURVEYCPL", "Enk�ten klar");
define("_DIDNOTSAVE", "Sparade inte");
define("_DIDNOTSAVE2", "Ett ov�ntat fel har uppst�tt och dina svar kan inte sparas.");
define("_DIDNOTSAVE3", "Dina svar har inte f�rsvunnit, utan de har mailats till enk�tadministrat�ren och kommer att l�ggas in i databasen vid ett senare tillf�lle.");
define("_DNSAVEEMAIL1", "Ett fel uppstod under f�rs�k att spara svaret till enk�t-id");
define("_DNSAVEEMAIL2", "DATA SKALL FYLLAS I");
define("_DNSAVEEMAIL3", "SQL-KOD SOM HAR MISSLYCKATS");
define("_DNSAVEEMAIL4", "FELMEDDELANDE");
define("_DNSAVEEMAIL5", "FEL VID SPARANDET");
define("_SUBMITAGAIN", "F�rs�k att skicka igen");
define("_SURVEYNOEXIST", "Tyv�rr. Det finns ingen matchade enk�t.");
define("_NOTOKEN1", "Detta �r en kontrollerad enk�t. Du beh�ver en giltlig beh�rigetskod f�r att delta");
define("_NOTOKEN2", "Om du har f�tt en beh�righetskod, skriv in den i rutan nedan och forts�tt.");
define("_NOTOKEN3", "Beh�righetskoden som du angett �r antingen ogiltlig eller redan anv�nd.");
define("_NOQUESTIONS", "Denna enk�t har �nnu inga fr�gor och kan inte testas eller f�rdigst�llas.");
define("_FURTHERINFO", "F�r ytterligare information kontakta");
define("_NOTACTIVE", "Denna enk�t �r inte aktiv f�r tillf�llet. Du kan d�rf�r inte spara dina svar.");
define("_SURVEYEXPIRED", "Denna enk�t �r inte l�ngre tillg�nglig."); //NEW for 098rc5

define("_SURVEYCOMPLETE", "Du har redan svarat p� den h�r enk�ten.");

define("_INSTRUCTION_LIST", "V�lj bara en av f�ljande"); //NEW for 098rc3
define("_INSTRUCTION_MULTI", "V�lj vilka som st�mmer"); //NEW for 098rc3

define("_CONFIRMATION_MESSAGE1", "Enk�ten skickad"); //NEW for 098rc5
define("_CONFIRMATION_MESSAGE2", "Ett nytt svar till din enk�t har l�mnats"); //NEW for 098rc5
define("_CONFIRMATION_MESSAGE3", "Se det enskilda svaret genom att klicka h�r:"); //NEW for 098rc5
define("_CONFIRMATION_MESSAGE4", "Se statistik f�r enk�ten genom att klicka h�r:"); //NEW for 098rc5

define("_PRIVACY_MESSAGE", "<b><i>Hantering av personuppgifter. </i></b><br />"
						  ."Den h�r enk�ten �r anonym.<br />"
						  ."De svar p� enk�ten som sparas inneh�ller ingen information som "
						  ."kan identifiera den som svarat utom om denna fr�ga specifikt st�llts "
						  ."i enk�ten. �ven om det kr�vs ett id-nummer f�r att kunna besvara "
						  ."enk�ten sparas inte denna personliga information tillsammans med "
						  ."enk�tsvaret. Id-numret anv�nds endast f�r att avg�ra om du har "
						  ."svarat (eller inte svarat) p� enk�ten och den informationen sparas "
						  ."separat. Det finns inget s�tt att avg�ra vilket id-nummer som h�r "
						  ."ihop med ett visst svar i den h�r enk�ten."); //New for 0.98rc9

define("_THEREAREXQUESTIONS", "Den h�r unders�kningen inneh�ller {NUMBEROFQUESTIONS} fr�gor."); //New for 0.98rc9 Must contain {NUMBEROFQUESTIONS} which gets replaced with a question count.
define("_THEREAREXQUESTIONS_SINGLE", "Det finns 1 fr�ga i enk�ten."); //New for 0.98rc9 - singular version of above

define ("_RG_REGISTER1", "Du m�ste vara registrerad f�r att genomf�ra den h�r enk�ten"); //NEW for 0.98rc9
define ("_RG_REGISTER2", "Du m�ste registrera dig innan du fyller i den h�r enk�ten.<br />\n"
						."Fyll i dina uppgifter nedan och s� skickas en l�nk till "
						."enk�ten till dig med e-post genast."); //NEW for 0.98rc9
define ("_RG_EMAIL", "E-postadress"); //NEW for 0.98rc9
define ("_RG_FIRSTNAME", "F�rnamn"); //NEW for 0.98rc9
define ("_RG_LASTNAME", "Efternamn"); //NEW for 0.98rc9
define ("_RG_INVALIDEMAIL", "E-postadressen du angav �r inte giltig. Var v�nlig f�rs�k igen.");//NEW for 0.98rc9
define ("_RG_USEDEMAIL", "Din e-postadress har redan anm�lts.");//NEW for 0.98rc9
define ("_RG_EMAILSUBJECT", "{SURVEYNAME} Bekr�ftelse p� registrering");//NEW for 0.98rc9
define ("_RG_REGISTRATIONCOMPLETE", "Tack f�r att du registerat dig f�r att genomf�ra den h�r enk�ten.<br /><br />\n"
								   ."Ett e-postmeddelande med dina uppgifter har s�nts till den adress du angav."
								   ."F�lj den bifogade l�nken i e-postmeddelandet f�r att forts�tta.<br /><br />\n"
								   ."Enk�t-ansvarig {ADMINNAME} ({ADMINEMAIL})");//NEW for 0.98rc9

define("_SM_COMPLETED", "<b>Tack!<br /><br />"
	."Du har besvarat alla fr�gor i den h�r enk�ten.</b><br /><br />"
	."Klicka p� ["._SUBMIT."] f�r att slutf�ra och spara dina svar."); //New for 0.98finalRC1 - by Bjorn Mildh
define("_SM_REVIEW", "Om du vill kontrollera dina svar och/eller �ndra dem, "
	."kan du g�ra det genom att klicka p� [<< "._PREV."]-knappen och bl�ddra "
	."genom dina svar."); //New for 0.98finalRC1 - by Bjorn Mildh

//For the "printable" survey
define("_PS_CHOOSEONE", "Please choose <b>only one</b> of the following"); //New for 0.98finalRC1
define("_PS_WRITE", "Please write your answer here"); //New for 0.98finalRC1
define("_PS_CHOOSEANY", "Please choose <b>all</b> that apply"); //New for 0.98finalRC1
define("_PS_CHOOSEANYCOMMENT", "Please choose all that apply and provide a comment"); //New for 0.98finalRC1
define("_PS_EACHITEM", "Please choose the appropriate response for each item"); //New for 0.98finalRC1
define("_PS_WRITEMULTI", "Please write your answer(s) here"); //New for 0.98finalRC1
define("_PS_DATE", "Please enter a date"); //New for 0.98finalRC1
define("_PS_COMMENT", "Make a comment on your choice here"); //New for 0.98finalRC1
define("_PS_RANKING", "Please number each box in order of preference from 1 to"); //New for 0.98finalRC1
define("_PS_SUBMIT", "Submit Your Survey"); //New for 0.98finalRC1
define("_PS_THANKYOU", "Thank you for completing this survey."); //New for 0.98finalRC1
define("_PS_FAXTO", "Please fax your completed survey to:"); //New for 0.98finaclRC1

define("_PS_CON_ONLYANSWER", "Only answer this question"); //New for 0.98finalRC1
define("_PS_CON_IFYOU", "if you answered"); //New for 0.98finalRC1
define("_PS_CON_JOINER", "and"); //New for 0.98finalRC1
define("_PS_CON_TOQUESTION", "to question"); //New for 0.98finalRC1
define("_PS_CON_OR", "or"); //New for 0.98finalRC2
?>
