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
define("_NOTAPPLICABLE", "N/A"); //New for 0.98rc5
define("_OTHER", "Annat");
define("_PLEASECHOOSE", "V�lj");
define("_ERROR_PS", "Fel");
define("_COMPLETE", "complete");
//from questions.php
define("_CONFIRMATION", "Bekr�ftelse");
define("_TOKEN_PS", "Beh�righetskod");
define("_CONTINUE_PS", "Forts�tt");
define("_INCREASE", "Increase"); //NEW WITH 0.98
define("_SAME", "Same"); //NEW WITH 0.98
define("_DECREASE", "Decrease"); //NEW WITH 0.98

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
define("_MANDATORY_PARTS", "Var god, fyll i alla delar");
define("_MANDATORY_CHECK", "V�lj minst ett objekt");
define("_MANDATORY_RANK", "Rangordna alla alternativen");
define("_MANDATORY_POPUP", "One or more mandatory questions have not been answered. You cannot proceed until these have been completed"); //NEW in 0.98rc4
define("_DATEFORMAT", "Format: ����-MM-DD");
define("_DATEFORMATEG", "(tex: 2003-12-24 f�r Julafton)");
define("_REMOVEITEM", "Ta bort detta objekt");
define("_RANK_1", "Klicka p� ett objekt i listan till v�nster, b�rja med ditt");
define("_RANK_2", "h�gst rankade objekt, upprepa tills ditt l�gst rankade objekt.");
define("_YOURCHOICES", "Dina val");
define("_YOURRANKING", "Din rangordning");
define("_RANK_3", "Klicka p� saxen till h�ger om objektet");
define("_RANK_4", "f�r att ta bort det sist elementet i listan.");
//From INDEX.PHP
define("_NOSID", "Du har inte angett ett identifikationsnummer f�r enk�ten");
define("_CONTACT1", "Var god kontakta");
define("_CONTACT2", "f�r ytterligare assistans");
define("_ANSCLEAR", "Svaren rensade");
define("_RESTART", "Starta om enk�ten");
define("_CLOSEWIN_PS", "St�ng f�nstret");
define("_CONFIRMCLEAR", "�r du s�ker p� att du vill rensa dina svar?");
define("_EXITCLEAR", "L�mna och rensa enk�ten");
//From QUESTION.PHP
define("_BADSUBMIT1", "Kan inte skicka resultaten - det finns inga att skicka.");
define("_BADSUBMIT2", "Detta fel kan uppst� om du redan har skickat dina svar och klickat p� 'uppdatera' p� din bl�ddrare. I s� fall s� �r dina svar redan sparade.");
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
define("_SURVEYEXPIRED", "This survey is no longer available."); //NEW for 098rc5

define("_SURVEYCOMPLETE", "You have already completed this survey.");

define("_INSTRUCTION_LIST", "Choose only one of the following"); //NEW for 098rc3
define("_INSTRUCTION_MULTI", "Check any that apply"); //NEW for 098rc3

define("_CONFIRMATION_MESSAGE1", "Survey Submitted"); //NEW for 098rc5
define("_CONFIRMATION_MESSAGE2", "A new response was entered for your survey"); //NEW for 098rc5
define("_CONFIRMATION_MESSAGE3", "Click the following link to see the individual response:"); //NEW for 098rc5
define("_CONFIRMATION_MESSAGE4", "View statistics by clicking here:"); //NEW for 098rc5

define("_PRIVACY_MESSAGE", "<b><i>A Note On Privacy</i></b><br />"
						  ."This survey is anonymous.<br />"
						  ."The record kept of your survey responses does not contain any "
						  ."identifying information about you unless a specific question "
						  ."in the survey has asked for this. If you have responded to a "
						  ."survey that used an identifying token to allow you to access "
						  ."the survey, you can rest assured that the identifying token "
						  ."is not kept with your responses. It is managed in a seperate "
						  ."database, and will only be updated to indicate that you have "
						  ."(or haven't) completed this survey. There is no way of matching "
						  ."identification tokens with survey responses in this survey."); //New for 0.98rc9

define("_THEREAREXQUESTIONS", "There are {NUMBEROFQUESTIONS} questions in this survey."); //New for 0.98rc9 Must contain {NUMBEROFQUESTIONS} which gets replaced with a question count.
define("_THEREAREXQUESTIONS_SINGLE", "There is 1 question in this survey."); //New for 0.98rc9 - singular version of above

define ("_RG_REGISTER1", "You must be registered to complete this survey"); //NEW for 0.98rc9
define ("_RG_REGISTER2", "You may register for this survey if you wish to take part.<br />\n"
						."Enter your details below, and an email containing the link to "
						."participate in this survey will be sent immediately."); //NEW for 0.98rc9
define ("_RG_EMAIL", "Email Address"); //NEW for 0.98rc9
define ("_RG_FIRSTNAME", "First Name"); //NEW for 0.98rc9
define ("_RG_LASTNAME", "Last Name"); //NEW for 0.98rc9
define ("_RG_INVALIDEMAIL", "The email you used is not valid. Please try again.");//NEW for 0.98rc9
define ("_RG_USEDEMAIL", "The email you used has already been registered.");//NEW for 0.98rc9
define ("_RG_EMAILSUBJECT", "{SURVEYNAME} Registration Confirmation");//NEW for 0.98rc9
define ("_RG_REGISTRATIONCOMPLETE", "Thank you for registering to participate in this survey.<br /><br />\n"
								   ."An email has been sent to the address you provided with access details "
								   ."for this survey. Please follow the link in that email to proceed.<br /><br />\n"
								   ."Survey Administrator {ADMINNAME} ({ADMINEMAIL})");//NEW for 0.98rc9

define("_SM_COMPLETED", "<b>Thank You<br /><br />"
					   ."You have completed answering the questions in this survey.</b><br /><br />"
					   ."Click on ["._SUBMIT."] now to complete the process and save your answers."); //New for 0.98finalRC1
define("_SM_REVIEW", "If you want to check any of the answers you have made, and/or change them, "
					."you can do that now by clicking on the [<< "._PREV."] button and browsing "
					."through your responses."); //New for 0.98finalRC1
?>
