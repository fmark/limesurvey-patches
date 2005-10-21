<?php
/*
	#############################################################
	# >>> PHPSurveyor					    					#
	#############################################################
	# > Author:  Jason Cleeland				    				#
	# > E-mail:  jason@cleeland.org				    			#
	# > Mail:    Box 99, Trades Hall, 54 Victoria St,	    	#
	# >          CARLTON SOUTH 3053, AUSTRALIA		    		#
	# > Date: 	 20 February 2003			    				#
	#							    							#
	# This set of scripts allows you to develop, publish and    #
	# perform data-entry on surveys.			    			#
	#############################################################
	#							    							#
	#	Copyright (C) 2003  Jason Cleeland		    			#
	#							    							#
	# This program is free software; you can redistribute 	    #
	# it and/or modify it under the terms of the GNU General    #
	# Public License as published by the Free Software 	    	#
	# Foundation; either version 2 of the License, or (at your  #
	# option) any later version.				    			#
	#							    							#
	# This program is distributed in the hope that it will be   #
	# useful, but WITHOUT ANY WARRANTY; without even the 	    #
	# implied warranty of MERCHANTABILITY or FITNESS FOR A 	    #
	# PARTICULAR PURPOSE.  See the GNU General Public License   #
	# for more details.					    					#
	#							    							#
	# You should have received a copy of the GNU General 	    #
	# Public License along with this program; if not, write to  #
	# the Free Software Foundation, Inc., 59 Temple Place -     #
	# Suite 330, Boston, MA  02111-1307, USA.		    		#
	#############################################################
	#							    							#
	# Slovenian Language File				    				#
	# Created by Gasper Koren [gasper@fdvinfo.net]		 	   	#
	# Web Survey Methodology - http://www.websm.org/	    	#
	#							    							#
	#############################################################
*/
//SINGLE WORDS
define("_YES", "Da");
define("_NO", "Ne");
define("_UNCERTAIN", "Neodločen");
define("_ADMIN", "Admin");
define("_TOKENS", "Gesla");
define("_FEMALE", "Ženski");
define("_MALE", "Moški");
define("_NOANSWER", "Brez odgovora");
define("_NOTAPPLICABLE", "N/A"); //New for 0.98rc5
define("_OTHER", "Drugo");
define("_PLEASECHOOSE", "Prosimo, izberite");
define("_ERROR_PS", "Napaka");
define("_COMPLETE", "Zaključeno");
define("_INCREASE", "Povečalo"); //NEW WITH 0.98
define("_SAME", "Ostalo enako"); //NEW WITH 0.98
define("_DECREASE", "Zmanjšalo"); //NEW WITH 0.98
define("_REQUIRED", "<font color='red'>*</font>"); //NEW WITH 0.99dev01
//from questions.php
define("_CONFIRMATION", "Potrditev");
define("_TOKEN_PS", "Geslo");
define("_CONTINUE_PS", "Nadaljuj");

//BUTTONS
define("_ACCEPT", "Sprejmi");
define("_PREV", "Nazaj");
define("_NEXT", "Naprej");
define("_LAST", "Zadnje");
define("_SUBMIT", "Pošlji podatke");


//MESSAGES
//From QANDA.PHP
define("_CHOOSEONE", "Prosimo, izberite eno izmed naslednjih možnosti");
define("_ENTERCOMMENT", "Prosimo, vpišite svoj komentar");
define("_NUMERICAL_PS", "V to polje lahko vpisujete samo številke");
define("_CLEARALL", "Izhod brez pošiljanja odgovorov");
define("_MANDATORY", "Na to vprašanje morate obvezno odgovoriti");
define("_MANDATORY_PARTS", "Prosimo, odgovorite na vsa vprašanja");
define("_MANDATORY_CHECK", "Prosimo, izberite vsaj eno izmed možnosti");
define("_MANDATORY_RANK", "Prosimo, rangirajte vse");
define("_MANDATORY_POPUP", "Niste odgovorili na eno ali več obveznih vprašanj, zato z anketo ne morete nadaljevati!"); //NEW in 0.98rc4
define("_VALIDATION", "This question must be answered correctly"); //NEW in VALIDATION VERSION
define("_VALIDATION_POPUP", "One or more questions have not been answered in a valid manner. You cannot proceed until these answers are valid"); //NEW in VALIDATION VERSION
define("_DATEFORMAT", "V obliki: LLLL-MM-DD");
define("_DATEFORMATEG", "(npr.: 2004-12-25 za Božič)");
define("_REMOVEITEM", "Odstrani");
define("_RANK_1", "Kliknite na listo na levi strani. Pričnite z najvišje");
define("_RANK_2", "ocenjenim in nadaljujte do najnižje ocenjenega.");
define("_YOURCHOICES", "Vaša izbira");
define("_YOURRANKING", "Vaša ocena");
define("_RANK_3", "Kliknite na škarje na desni,");
define("_RANK_4", "ce želite izbrisati zadnji vnos");
//From INDEX.PHP
define("_NOSID", "Manjka identifikacijska številka ankete!");
define("_CONTACT1", "Prosimo, obrnite se na");
define("_CONTACT2", "za nadaljno pomoč in vprašanja");
define("_ANSCLEAR", "Odgovori so izbrisani");
define("_RESTART", "Ponovno začni z anketo");
define("_CLOSEWIN_PS", "Zapri okno");
define("_CONFIRMCLEAR", "Ali ste prepričani, da želite izbrisati vaše odgovore?");
define("_CONFIRMSAVE", "Are you sure you want to save your responses?");
define("_EXITCLEAR", "Zapusti anketo brez pošiljanja odgovorov");
//From QUESTION.PHP
define("_BADSUBMIT1", "Odgovorov ni mogoče poslati -- odgovorov ni.");
define("_BADSUBMIT2", "Ta napaka se lahko pojavi, če ste že posredovali vaše odgovore in nato pritisnili gumb za osvežitev strani (<i>Refresh</i>). Vaši odgovori so bili v tem primeru že shranjeni.<br /><br />Če se to sporočilo pojavi med anketiranjem, morate pritisniti gumb '<- NAZAJ' ('<- BACK') v vašem brskalniku in nato OSVEŽI/REFRESH. Dokler ne odgovorite na zadnje vprašanje v anketi, so vaši odgovori še vedno dosegljivi. Na podobno težavo lahko naletite tudi, ob preobremenjenosti strežnika. Za težave se vam opravičujemo.");
define("_NOTACTIVE1", "Vaši odgovori se niso zabeležili. Anketa še ni aktivna!");
define("_CLEARRESP", "Izbriši odgovore.");
define("_THANKS", "Hvala lepa");
define("_SURVEYREC", "Vaši odgovori so se shranili!");
define("_SURVEYCPL", "Anketa je končana.");
define("_DIDNOTSAVE", "Ni bilo shranjeno.");
define("_DIDNOTSAVE2", "Prišlo je do nepričakovane napake. Vaših odgovorov ni mogoče shraniti.");
define("_DIDNOTSAVE3", "Vaši odgovori NISO bili izgiubljeni. Poslani so bili administratorju ankete in bodo vključeni v rezultate.");
define("_DNSAVEEMAIL1", "Napaka v identifikacijski številki");
define("_DNSAVEEMAIL2", "Podatki za vnos");
define("_DNSAVEEMAIL3", "Napaka v SQL kodi");
define("_DNSAVEEMAIL4", "SPOROČILO Z NAPAKO");
define("_DNSAVEEMAIL5", "NAPAKA PRI SHRANJEVANJU");
define("_SUBMITAGAIN", "Poskusite ponovno");
define("_SURVEYNOEXIST", "Oprostite. Ta anketa ne obstaja.");
define("_NOTOKEN1", "Ta anketa ni javno dostopna. Za sodelovanje potrebujete geslo.");
define("_NOTOKEN2", "Če vam je bilo geslo posredovano, ga vpišite v spodnje polje in kliknite za nadaljevanje.");
define("_NOTOKEN3", "Geslo, ki ste ga posredovali ni veljavno ali pa je bilo že uporabljeno.");
define("_NOQUESTIONS", "Ta anketa se nima nobenih vprašanj.");
define("_FURTHERINFO", "Za dodatne informacije se obrnite na");
define("_NOTACTIVE", "Ta anketa trenutno ni aktivna. Vaši odgovori ne bodo shranjeni.");
define("_SURVEYEXPIRED", "Anketa je zaključena.");

define("_SURVEYCOMPLETE", "Na to anketo ste že odgovorili."); //NEW FOR 0.98rc6

define("_INSTRUCTION_LIST", "Izberite samo eno izmed možnosti"); //NEW for 098rc3
define("_INSTRUCTION_MULTI", "Možnih je več odgovorov"); //NEW for 098rc3

define("_CONFIRMATION_MESSAGE1", "Anketa je bila poslana"); //NEW for 098rc5
define("_CONFIRMATION_MESSAGE2", "Vaša anketa je dobila nov odgovor"); //NEW for 098rc5
define("_CONFIRMATION_MESSAGE3", "Individualni potatki so vam na voljo tukaj:"); //NEW for 098rc5
define("_CONFIRMATION_MESSAGE4", "Osnovne statistike so vam na voljo tukaj:"); //NEW for 098rc5
define("_CONFIRMATION_MESSAGE5", "Click the following link to edit the individual response:"); //NEW for 0.99stable

define("_PRIVACY_MESSAGE", "<strong><i>Obvestilo o varovanju zasebnosti</i></strong><br />"
						  ."Ta anketa je anonimna.<br />"
						  ."Vaši odgovori na anketna vprašanja, ki se shranjujejo v bazo odgovorov ne vsebujejo "
						  ."nobenih informacij, prek katerih bi vas bilo mogoče identificirati razen v primeru "
						  ."ko so le te del odgovora na anketno vprašanje. Če odgovarjate na anketo, ki "
						  ."za dostop uporablja identifikacijsko geslo, se podatki o geslu ne hranijo "
						  ."skupaj z odgovori na anketna vprašanja. Identifikacijski podatki se hranijo "
						  ."v posebni bazi in služijo zgolj kot informacija, če ste že (oz. še niste) "
						  ."odgovorili na anketo. Gesel v nobenem primeru ni mogoče povezati z "
						  ."odgovori na anketo."); //New for 0.98rc9


define("_THEREAREXQUESTIONS", "V tej anketi je {NUMBEROFQUESTIONS} vprašanj."); //New for 0.98rc9 Must contain {NUMBEROFQUESTIONS} which gets replaced with a question count.
define("_THEREAREXQUESTIONS_SINGLE", "V tej anketi je samo eno vprašanje."); //New for 0.98rc9 - singular version of above

define ("_RG_REGISTER1", "Če želite odgovoriti na anketo, se morate registrirati."); //NEW for 0.98rc9
define ("_RG_REGISTER2", "Če želite sodelovati v anketi se lahko registrirate.<br />\n"
						."Vpišite svoje podatke in veljaven e-mail naslov. Navodila za sodelovanje "
						."boste v kratkem prejeli po elektronski pošti."); //NEW for 0.98rc9
define ("_RG_EMAIL", "E-mail naslov"); //NEW for 0.98rc9
define ("_RG_FIRSTNAME", "Ime"); //NEW for 0.98rc9
define ("_RG_LASTNAME", "Priimek"); //NEW for 0.98rc9
define ("_RG_INVALIDEMAIL", "Ta e-mail naslov ni veljaven. Poskusite znova.");//NEW for 0.98rc9
define ("_RG_USEDEMAIL", "E-mail naslov, ki ste ga vpisali je bil že uporabljen v tej anketi.");//NEW for 0.98rc9
define ("_RG_EMAILSUBJECT", "Potrditev registracije -- {SURVEYNAME}");//NEW for 0.98rc9
define ("_RG_REGISTRATIONCOMPLETE", "Hvala ker ste se prijavili za sodelovanje v anketi.<br /><br />\n"
								   ."Na e-mail naslov, ki ste ga navedli vam je bilo poslano sporočilo z navodili za dostop do ankete. "
								   ."Za nadaljevanje upoštevajte ta navodila.<br /><br />\n"
								   ."Lep pozdrav, {ADMINNAME} ({ADMINEMAIL})");//NEW for 0.98rc9

define("_SM_COMPLETED", "<strong>Najlepša hvala<br /><br />"
					   ."Z odgovarjanjem na anketo ste zaključili.</strong><br /><br />"
					   ."S klikom na ["._SUBMIT."] boste shranili vaše odgovore."); //New for 0.98finalRC1
define("_SM_REVIEW", "Če želite preveriti vaše odgovore ali jih popraviti, "
					."lahko to storite s klikanjem na gumb [<< "._PREV."] ."); //New for 0.98finalRC1


//For the "printable" survey
define("_PS_CHOOSEONE", "Prosimo, izberite  <strong>eno</strong> izmed možnosti:"); //New for 0.98finalRC1
define("_PS_WRITE", "Vpišite vaš odgovor:"); //New for 0.98finalRC1
define("_PS_CHOOSEANY", "Možnih je <strong>več</strong> odgovorov:"); //New for 0.98finalRC1
define("_PS_CHOOSEANYCOMMENT", "Izberite ustrezne odgovore in podajte komentar:"); //New for 0.98finalRC1
define("_PS_EACHITEM", "Izberite primeren odgovor za vsako trditev."); //New for 0.98finalRC1
define("_PS_WRITEMULTI", "Prosimo, vpišite odgovor:"); //New for 0.98finalRC1
define("_PS_DATE", "Prosimo, vpišite datum:"); //New for 0.98finalRC1
define("_PS_COMMENT", "Komentirajte vašo izbiro:"); //New for 0.98finalRC1
define("_PS_RANKING", "Prosimo, oštevičite vsako polje glede na vaše preference od 1 do"); //New for 0.98finalRC1
define("_PS_SUBMIT", "Pošlji anketo."); //New for 0.98finalRC1
define("_PS_THANKYOU", "Najlepša hvala za sodelovanje v anketi."); //New for 0.98finalRC1
define("_PS_FAXTO", "Prosimo, pošljite vašo izpolnjeno anketo po telefaksu na številko:"); //New for 0.98finaclRC1

define("_PS_CON_ONLYANSWER", "Odgoorite samo na to vprašanje"); //New for 0.98finalRC1
define("_PS_CON_IFYOU", "če odgvovorite"); //New for 0.98finalRC1
define("_PS_CON_JOINER", "in"); //New for 0.98finalRC1
define("_PS_CON_TOQUESTION", "na vprašanje"); //New for 0.98finalRC1
define("_PS_CON_OR", "ali"); //New for 0.98finalRC2

//Save Messages
define("_SAVE_AND_RETURN", "Save your responses so far");
define("_SAVEHEADING", "Save Your Unfinished Survey");
define("_RETURNTOSURVEY", "Return To Survey");
define("_SAVENAME", "Name");
define("_SAVEPASSWORD", "Password");
define("_SAVEPASSWORDRPT", "Repeat Password");
define("_SAVE_EMAIL", "Your Email");
define("_SAVEEXPLANATION", "Enter a name and password for this survey and click save below.<br />\n"
				  ."Your survey will be saved using that name and password, and can be "
				  ."completed later by logging in with the same name and password.<br /><br />\n"
				  ."If you give an email address, an email containing the details will be sent "
				  ."to you.");
define("_SAVESUBMIT", "Save Now");
define("_SAVENONAME", "You must supply a name for this saved session.");
define("_SAVENOPASS", "You must supply a password for this saved session.");
define("_SAVENOMATCH", "Your passwords do not match.");
define("_SAVEDUPLICATE", "This name has already been used for this survey. You must use a unique save name.");
define("_SAVETRYAGAIN", "Please try again.");
define("_SAVE_EMAILSUBJECT", "Saved Survey Details");
define("_SAVE_EMAILTEXT", "You, or someone using your email address, have saved "
						 ."a survey in progress. The following details can be used "
						 ."to return to this survey and continue where you left "
						 ."off.");
define("_SAVE_EMAILURL", "Reload your survey by clicking on the following URL:");
define("_SAVE_SUCCEEDED", "Your survey responses have been saved succesfully");
define("_SAVE_FAILED", "An error occurred and your survey responses were not saved.");
define("_SAVE_EMAILSENT", "An email has been sent with details about your saved survey.");

//Load Messages
define("_LOAD_SAVED", "Load unfinished survey");
define("_LOADHEADING", "Load A Previously Saved Survey");
define("_LOADEXPLANATION", "You can load a survey that you have previously saved from this screen.<br />\n"
			  ."Type in the 'name' you used to save the survey, and the password.<br /><br />\n");
define("_LOADNAME", "Saved name");
define("_LOADPASSWORD", "Password");
define("_LOADSUBMIT", "Load Now");
define("_LOADNONAME", "You did not provide a name");
define("_LOADNOPASS", "You did not provide a password");
define("_LOADNOMATCH", "There is no matching saved survey");

define("_ASSESSMENT_HEADING", "Your Assessment");
?>
