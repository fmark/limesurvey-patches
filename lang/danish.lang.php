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
	#                                                           #
	#     Translation by Mikkel Skovgaard S�rensen              #
	#                                                           #
	#############################################################
*/
//SINGLE WORDS
define("_YES", "Ja");
define("_NO", "Nej");
define("_UNCERTAIN", "Ved ikke");
define("_ADMIN", "Admin");
define("_TOKENS", "N�gler");
define("_FEMALE", "Kvinde");
define("_MALE", "Mand");
define("_NOANSWER", "Intet svar");
define("_NOTAPPLICABLE", "Ved ikke"); //New for 0.98rc5
define("_OTHER", "Andet");
define("_PLEASECHOOSE", "V�lg venligst");
define("_ERROR_PS", "Fejl");
define("_COMPLETE", "gennemf�rt");
define("_INCREASE", "H�v"); //NEW WITH 0.98
define("_SAME", "Samme"); //NEW WITH 0.98
define("_DECREASE", "S�nk"); //NEW WITH 0.98
//from questions.php
define("_CONFIRMATION", "Bekr�ftelse");
define("_TOKEN_PS", "N�gle");
define("_CONTINUE_PS", "Fors�t");

//BUTTONS
define("_ACCEPT", "Accepter");
define("_PREV", "forrige");
define("_NEXT", "n�ste");
define("_LAST", "afslut");
define("_SUBMIT", "afsend");


//MESSAGES
//From QANDA.PHP
define("_CHOOSEONE", "V�lg en af f�lgende");
define("_ENTERCOMMENT", "Skriv dine kommentarer her");
define("_NUMERICAL_PS", "Det felt kan kun indeholde tal/numeriske tegn");
define("_CLEARALL", "Nulstil og forlad unders�gelsen");
define("_MANDATORY", "Dette sp�rgsm�l er obligatorisk");
define("_MANDATORY_PARTS", "Udfyld venligst alle dele");
define("_MANDATORY_CHECK", "Afkryds som minimum en mulighed");
define("_MANDATORY_RANK", "Afgiv venligst en score i alle felter");
define("_MANDATORY_POPUP", "En eller flere felter som skal udfyldes er ikke udfyldt - der kan ikke fors�ttes f�r disse er udfyldt"); //NEW in 0.98rc4
define("_DATEFORMAT", "Datoformat: ����-MM-DD");
define("_DATEFORMATEG", "(eg: 2003-12-24 hvis der skal angives juledag)");
define("_REMOVEITEM", "Fjern denne mulighed");
define("_RANK_1", "Klik p� et emne i listen til venstre, startende med det du");
define("_RANK_2", "vurdere h�jst, og klik derefter nedefter til det lavest vurderede emne.");
define("_YOURCHOICES", "Dine valg");
define("_YOURRANKING", "Din vurdering");
define("_RANK_3", "Klik p� saks ikonet til h�jre for");
define("_RANK_4", "at fjerne det nederst emne p� din vurderingsliste");
//From INDEX.PHP
define("_NOSID", "Der mangler at blive angivet en unders�gelses n�gle/id");
define("_CONTACT1", "Kontakt venligst");
define("_CONTACT2", "for videre assistance");
define("_ANSCLEAR", "Svar gennemf�rt");
define("_RESTART", "Nulstil og start forfra");
define("_CLOSEWIN_PS", "Luk dette vindue");
define("_CONFIRMCLEAR", "Er du sikker p� at du vil nulstille alle dine sp�rgsm�l?");
define("_EXITCLEAR", "Nulstil og forlad unders�gelsen.");
//From QUESTION.PHP
define("_BADSUBMIT1", "Kan ikke gemme besvarelsen - der er ikke noget at gemme.");
define("_BADSUBMIT2", "Denne fejl er opst�et fordi du allerede har gemt dine svar og har trykket p� 'Opdater' i din browser. Dine besvarelser er allerede gemt.<br /><br />Hvis du har f�et denne fejlmeddelse midt i en sp�rgeskema unders�gelse b�r du trykke p� '<- Tilbage' knappen i din browser og tryk p� 'Opdater'. Dermed vil dit forrige svar g� tabt men alle andre tidligere svar er gemt, vi beklager de gener dette m�tte medf�re.");
define("_NOTACTIVE1", "Dine besvarelser er ikke gemt - unders�gelsen er endnu ikke sat igang.");
define("_CLEARRESP", "Nulstil svar");
define("_THANKS", "Tak");
define("_SURVEYREC", "Dine besvarelser er blevet gemt.");
define("_SURVEYCPL", "Unders�gelsen er gennemf�rt");
define("_DIDNOTSAVE", "Kunne ikke gemme");
define("_DIDNOTSAVE2", "Der skete en uventet fejl og dine besvarelser kunne ikke gemmes.");
define("_DIDNOTSAVE3", "Dine besvarelser er ikke g�et tabt - men er sendt til administratoren af unders�gelsen som s� senere tilf�jer disse.");
define("_DNSAVEEMAIL1", "An error occurred saving a response to survey id");
define("_DNSAVEEMAIL2", "DATA TO BE ENTERED");
define("_DNSAVEEMAIL3", "SQL CODE THAT FAILED");
define("_DNSAVEEMAIL4", "ERROR MESSAGE");
define("_DNSAVEEMAIL5", "ERROR SAVING");
define("_SUBMITAGAIN", "Pr�v igen");
define("_SURVEYNOEXIST", "Desv�rre, kunne ikke finde unders�gelses n�gle/id der matcher det valgte.");
define("_NOTOKEN1", "Dette er en lukket unders�gelse og kr�ver at du har en unders�gelses n�gle/id for at deltage.");
define("_NOTOKEN2", "Hvis du har en unders�gelses n�gle/id s� indtast den herunder.");
define("_NOTOKEN3", "Den unders�gelses n�gle/id du har angivet er ugyldig eller er allerede brugt.");
define("_NOQUESTIONS", "Denne unders�gelse har endnu ingen sp�rgsm�l og kan derfor ikke benyttes.");
define("_FURTHERINFO", "For yderligere information kontakt");
define("_NOTACTIVE", "Denne unders�gelse er ikke aktiv og du kan derfor ikke deltage.");
define("_SURVEYEXPIRED", "Denne unders�gelse er ikke l�ngere aktiv og du kan derfor ikke deltage.");

define("_SURVEYCOMPLETE", "Du har allerede gennemf�rt denne unders�gelse."); //NEW FOR 0.98rc6

define("_INSTRUCTION_LIST", "V�lg kun en af nedenst�ende"); //NEW for 098rc3
define("_INSTRUCTION_MULTI", "V�lg alle du er enig i"); //NEW for 098rc3

define("_CONFIRMATION_MESSAGE1", "Unders�gelsen er gemt"); //NEW for 098rc5
define("_CONFIRMATION_MESSAGE2", "Et nyt svar er gemt i unders�gelsen"); //NEW for 098rc5
define("_CONFIRMATION_MESSAGE3", "Klik p� nedenst�ende link for at se de individuelle svar:"); //NEW for 098rc5
define("_CONFIRMATION_MESSAGE4", "Vis statistikken her:"); //NEW for 098rc5
?>
