<?php
/*
	#############################################################
	# >>> PHP Surveyor					    					#
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
define("_UNCERTAIN", "Neodlo�en");
define("_ADMIN", "Admin");
define("_TOKENS", "Gesla");
define("_FEMALE", "�enski");
define("_MALE", "Mo�ki");
define("_NOANSWER", "Brez odgovora");
define("_NOTAPPLICABLE", "N/A"); //New for 0.98rc5
define("_OTHER", "Drugo");
define("_PLEASECHOOSE", "Prosimo, izberite");
define("_ERROR_PS", "Napaka");
define("_COMPLETE", "Zaklju�eno");
define("_INCREASE", "Pove�alo"); //NEW WITH 0.98
define("_SAME", "Ostalo enako"); //NEW WITH 0.98
define("_DECREASE", "Zmanj�alo"); //NEW WITH 0.98
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
define("_SUBMIT", "Po�lji podatke");


//MESSAGES
//From QANDA.PHP
define("_CHOOSEONE", "Prosimo, izberite eno izmed naslednjih mo�nosti");
define("_ENTERCOMMENT", "Prosimo, vpi�ite svoj komentar");
define("_NUMERICAL_PS", "V to polje lahko vpisujete samo �tevilke");
define("_CLEARALL", "Izhod brez po�iljanja odgovorov");
define("_MANDATORY", "Na to vpra�anje morate obvezno odgovoriti");
define("_MANDATORY_PARTS", "Prosimo, odgovorite na vsa vpra�anja");
define("_MANDATORY_CHECK", "Prosimo, izberite vsaj eno izmed mo�nosti");
define("_MANDATORY_RANK", "Prosimo, rangirajte vse");
define("_MANDATORY_POPUP", "Niste odgovorili na eno ali ve� obveznih vpra�anj, zato z anketo ne morete nadaljevati!"); //NEW in 0.98rc4
define("_VALIDATION", "This question must be answered correctly"); //NEW in VALIDATION VERSION
define("_VALIDATION_POPUP", "One or more questions have not been answered in a valid manner. You cannot proceed until these answers are valid"); //NEW in VALIDATION VERSION
define("_DATEFORMAT", "V obliki: LLLL-MM-DD");
define("_DATEFORMATEG", "(npr.: 2004-12-25 za Bo�i�)");
define("_REMOVEITEM", "Odstrani");
define("_RANK_1", "Kliknite na listo na levi strani. Pri�nite z najvi�je");
define("_RANK_2", "ocenjenim in nadaljujte do najni�je ocenjenega.");
define("_YOURCHOICES", "Va�a izbira");
define("_YOURRANKING", "Va�a ocena");
define("_RANK_3", "Kliknite na �karje na desni,");
define("_RANK_4", "ce �elite izbrisati zadnji vnos");
//From INDEX.PHP
define("_NOSID", "Manjka identifikacijska �tevilka ankete!");
define("_CONTACT1", "Prosimo, obrnite se na");
define("_CONTACT2", "za nadaljno pomo� in vpra�anja");
define("_ANSCLEAR", "Odgovori so izbrisani");
define("_RESTART", "Ponovno za�ni z anketo");
define("_CLOSEWIN_PS", "Zapri okno");
define("_CONFIRMCLEAR", "Ali ste prepri�ani, da �elite izbrisati va�e odgovore?");
define("_CONFIRMSAVE", "Are you sure you want to save your responses?");
define("_EXITCLEAR", "Zapusti anketo brez po�iljanja odgovorov");
//From QUESTION.PHP
define("_BADSUBMIT1", "Odgovorov ni mogo�e poslati -- odgovorov ni.");
define("_BADSUBMIT2", "Ta napaka se lahko pojavi, �e ste �e posredovali va�e odgovore in nato pritisnili gumb za osve�itev strani (<i>Refresh</i>). Va�i odgovori so bili v tem primeru �e shranjeni.<br /><br />�e se to sporo�ilo pojavi med anketiranjem, morate pritisniti gumb '<- NAZAJ' ('<- BACK') v va�em brskalniku in nato OSVE�I/REFRESH. Dokler ne odgovorite na zadnje vpra�anje v anketi, so va�i odgovori �e vedno dosegljivi. Na podobno te�avo lahko naletite tudi, ob preobremenjenosti stre�nika. Za te�ave se vam opravi�ujemo.");
define("_NOTACTIVE1", "Va�i odgovori se niso zabele�ili. Anketa �e ni aktivna!");
define("_CLEARRESP", "Izbri�i odgovore.");
define("_THANKS", "Hvala lepa");
define("_SURVEYREC", "Va�i odgovori so se shranili!");
define("_SURVEYCPL", "Anketa je kon�ana.");
define("_DIDNOTSAVE", "Ni bilo shranjeno.");
define("_DIDNOTSAVE2", "Pri�lo je do nepri�akovane napake. Va�ih odgovorov ni mogo�e shraniti.");
define("_DIDNOTSAVE3", "Va�i odgovori NISO bili izgiubljeni. Poslani so bili administratorju ankete in bodo vklju�eni v rezultate.");
define("_DNSAVEEMAIL1", "Napaka v identifikacijski �tevilki");
define("_DNSAVEEMAIL2", "Podatki za vnos");
define("_DNSAVEEMAIL3", "Napaka v SQL kodi");
define("_DNSAVEEMAIL4", "SPORO�ILO Z NAPAKO");
define("_DNSAVEEMAIL5", "NAPAKA PRI SHRANJEVANJU");
define("_SUBMITAGAIN", "Poskusite ponovno");
define("_SURVEYNOEXIST", "Oprostite. Ta anketa ne obstaja.");
define("_NOTOKEN1", "Ta anketa ni javno dostopna. Za sodelovanje potrebujete geslo.");
define("_NOTOKEN2", "�e vam je bilo geslo posredovano, ga vpi�ite v spodnje polje in kliknite za nadaljevanje.");
define("_NOTOKEN3", "Geslo, ki ste ga posredovali ni veljavno ali pa je bilo �e uporabljeno.");
define("_NOQUESTIONS", "Ta anketa se nima nobenih vpra�anj.");
define("_FURTHERINFO", "Za dodatne informacije se obrnite na");
define("_NOTACTIVE", "Ta anketa trenutno ni aktivna. Va�i odgovori ne bodo shranjeni.");
define("_SURVEYEXPIRED", "Anketa je zaklju�ena.");

define("_SURVEYCOMPLETE", "Na to anketo ste �e odgovorili."); //NEW FOR 0.98rc6

define("_INSTRUCTION_LIST", "Izberite samo eno izmed mo�nosti"); //NEW for 098rc3
define("_INSTRUCTION_MULTI", "Mo�nih je ve� odgovorov"); //NEW for 098rc3

define("_CONFIRMATION_MESSAGE1", "Anketa je bila poslana"); //NEW for 098rc5
define("_CONFIRMATION_MESSAGE2", "Va�a anketa je dobila nov odgovor"); //NEW for 098rc5
define("_CONFIRMATION_MESSAGE3", "Individualni potatki so vam na voljo tukaj:"); //NEW for 098rc5
define("_CONFIRMATION_MESSAGE4", "Osnovne statistike so vam na voljo tukaj:"); //NEW for 098rc5

define("_PRIVACY_MESSAGE", "<b><i>Obvestilo o varovanju zasebnosti</i></b><br />"
						  ."Ta anketa je anonimna.<br />"
						  ."Va�i odgovori na anketna vpra�anja, ki se shranjujejo v bazo odgovorov ne vsebujejo "
						  ."nobenih informacij, prek katerih bi vas bilo mogo�e identificirati razen v primeru "
						  ."ko so le te del odgovora na anketno vpra�anje. �e odgovarjate na anketo, ki "
						  ."za dostop uporablja identifikacijsko geslo, se podatki o geslu ne hranijo "
						  ."skupaj z odgovori na anketna vpra�anja. Identifikacijski podatki se hranijo "
						  ."v posebni bazi in slu�ijo zgolj kot informacija, �e ste �e (oz. �e niste) "
						  ."odgovorili na anketo. Gesel v nobenem primeru ni mogo�e povezati z "
						  ."odgovori na anketo."); //New for 0.98rc9

define("_THEREAREXQUESTIONS", "V tej anketi je {NUMBEROFQUESTIONS} vpra�anj."); //New for 0.98rc9 Must contain {NUMBEROFQUESTIONS} which gets replaced with a question count.
define("_THEREAREXQUESTIONS_SINGLE", "V tej anketi je samo eno vpra�anje."); //New for 0.98rc9 - singular version of above

define ("_RG_REGISTER1", "�e �elite odgovoriti na anketo, se morate registrirati."); //NEW for 0.98rc9
define ("_RG_REGISTER2", "�e �elite sodelovati v anketi se lahko registrirate.<br />\n"
						."Vpi�ite svoje podatke in veljaven e-mail naslov. Navodila za sodelovanje "
						."boste v kratkem prejeli po elektronski po�ti."); //NEW for 0.98rc9
define ("_RG_EMAIL", "E-mail naslov"); //NEW for 0.98rc9
define ("_RG_FIRSTNAME", "Ime"); //NEW for 0.98rc9
define ("_RG_LASTNAME", "Priimek"); //NEW for 0.98rc9
define ("_RG_INVALIDEMAIL", "Ta e-mail naslov ni veljaven. Poskusite znova.");//NEW for 0.98rc9
define ("_RG_USEDEMAIL", "E-mail naslov, ki ste ga vpisali je bil �e uporabljen v tej anketi.");//NEW for 0.98rc9
define ("_RG_EMAILSUBJECT", "Potrditev registracije -- {SURVEYNAME}");//NEW for 0.98rc9
define ("_RG_REGISTRATIONCOMPLETE", "Hvala ker ste se prijavili za sodelovanje v anketi.<br /><br />\n"
								   ."Na e-mail naslov, ki ste ga navedli vam je bilo poslano sporo�ilo z navodili za dostop do ankete. "
								   ."Za nadaljevanje upo�tevajte ta navodila.<br /><br />\n"
								   ."Lep pozdrav, {ADMINNAME} ({ADMINEMAIL})");//NEW for 0.98rc9

define("_SM_COMPLETED", "<b>Najlep�a hvala<br /><br />"
					   ."Z odgovarjanjem na anketo ste zaklju�ili.</b><br /><br />"
					   ."S klikom na ["._SUBMIT."] boste shranili va�e odgovore."); //New for 0.98finalRC1
define("_SM_REVIEW", "�e �elite preveriti va�e odgovore ali jih popraviti, "
					."lahko to storite s klikanjem na gumb [<< "._PREV."] ."); //New for 0.98finalRC1
//For the "printable" survey
define("_PS_CHOOSEONE", "Prosimo, izberite  <b>eno</b> izmed mo�nosti:"); //New for 0.98finalRC1
define("_PS_WRITE", "Vpi�ite va� odgovor:"); //New for 0.98finalRC1
define("_PS_CHOOSEANY", "Mo�nih je <b>ve�</b> odgovorov:"); //New for 0.98finalRC1
define("_PS_CHOOSEANYCOMMENT", "Izberite ustrezne odgovore in podajte komentar:"); //New for 0.98finalRC1
define("_PS_EACHITEM", "Izberite primeren odgovor za vsako trditev."); //New for 0.98finalRC1
define("_PS_WRITEMULTI", "Prosimo, vpi�ite odgovor:"); //New for 0.98finalRC1
define("_PS_DATE", "Prosimo, vpi�ite datum:"); //New for 0.98finalRC1
define("_PS_COMMENT", "Komentirajte va�o izbiro:"); //New for 0.98finalRC1
define("_PS_RANKING", "Prosimo, o�tevi�ite vsako polje glede na va�e preference od 1 do"); //New for 0.98finalRC1
define("_PS_SUBMIT", "Po�lji anketo."); //New for 0.98finalRC1
define("_PS_THANKYOU", "Najlep�a hvala za sodelovanje v anketi."); //New for 0.98finalRC1
define("_PS_FAXTO", "Prosimo, po�ljite va�o izpolnjeno anketo po telefaksu na �tevilko:"); //New for 0.98finaclRC1

define("_PS_CON_ONLYANSWER", "Odgoorite samo na to vpra�anje"); //New for 0.98finalRC1
define("_PS_CON_IFYOU", "�e odgvovorite"); //New for 0.98finalRC1
define("_PS_CON_JOINER", "in"); //New for 0.98finalRC1
define("_PS_CON_TOQUESTION", "na vpra�anje"); //New for 0.98finalRC1
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
?>
