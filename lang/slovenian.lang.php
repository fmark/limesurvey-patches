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
define("_CLEARALL", "Izhod brez po�iljanja ankete");
define("_MANDATORY", "Na to vpra�anje morate odgovoriti");
define("_MANDATORY_PARTS", "Prosimo, odgovorite na vsa vpra�anja");
define("_MANDATORY_CHECK", "Prosimo, izberite vsaj eno moznost");
define("_MANDATORY_RANK", "Prosimo, rangirajte vse");
define("_MANDATORY_POPUP", "Niste odgovorili na eno ali ve� obveznih vpra�anj, zato z anketo ne morete nadaljevati!"); //NEW in 0.98rc4
define("_DATEFORMAT", "V obliki: LLLL-MM-DD");
define("_DATEFORMATEG", "(n.p.: 2004-12-25 za Bo�i�)");
define("_REMOVEITEM", "Odstrani");
define("_RANK_1", "Kliknite na listo na levi strani. Pri�nite z najvi�je");
define("_RANK_2", "ocenjenim in nadaljujte do najni�je ocenjenega.");
define("_YOURCHOICES", "Va�a izbira");
define("_YOURRANKING", "Va�a ocena");
define("_RANK_3", "Kliknite na �karje na desni,");
define("_RANK_4", "ce �elite izbrisati zadnji vnos");
//From INDEX.PHP
define("_NOSID", "Niste posredovali identifikacijske �tevilke ankete!");
define("_CONTACT1", "Prosimo, obrnite se na");
define("_CONTACT2", "za nadaljno pomo� in vpra�anja");
define("_ANSCLEAR", "Odgovori so izbrisani");
define("_RESTART", "Ponovno za�ni z anketo");
define("_CLOSEWIN_PS", "Zapri okno");
define("_CONFIRMCLEAR", "Ali ste prepri�ani, da �elite izbrisati va�e odgovore?");
define("_EXITCLEAR", "Zapusti anketo brez po�iljanja podatkov");
//From QUESTION.PHP
define("_BADSUBMIT1", "Rezultatov ni mogo�e poslati -- rezultatov ni.");
define("_BADSUBMIT2", "Ta napaka se lahko pojavi, �e ste �e posredovali va�e rezultate in nato pritisnili gumb za osve�itev strani (<i>Refresh</i>). Va�i odgovori so bili v tem primeru �e shranjeni.<br /><br />�e se to sporo�ilo pojavi med anketiranjem, morate pritisniti gumb '<- NAZAJ' ('<- BACK') v va�em brskalniku in nato OSVE�I/REFRESH. Dokler ne odgovorite na zadnje vpra�anje v anketi, so va�i odgovori �e vedno dosegljivi. Na podobno te�avo lahko naletite tudi, ob preobremenjenosti streznika. Za te�ave se vam opravi�ujemo.");
define("_NOTACTIVE1", "Va�i odgovori se niso zabele�ili. Anketa �e ni aktivna!");
define("_CLEARRESP", "Zbri�i odgovore.");
define("_THANKS", "Hvala lepa");
define("_SURVEYREC", "Vasi odgovori so se shranili!");
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
define("_NOTOKEN3", "Geslo, ki ste ga posredovali ni veljavno ali pa je bilo ze uporabljeno.");
define("_NOQUESTIONS", "Ta anketa se nima nobenih vpra�anj.");
define("_FURTHERINFO", "Za dodatne informacije se obrnite na");
define("_NOTACTIVE", "Ta anketa trenutno ni aktivna. Va�i odgovori ne bodo shranjeni.");
define("_SURVEYEXPIRED", "Anketa je zaklju�ena.");

define("_SURVEYCOMPLETE", "Na to anketo ste ze odgovorili."); //NEW FOR 0.98rc6

define("_INSTRUCTION_LIST", "Izberite samo eno/enega izmed na�tetih"); //NEW for 098rc3
define("_INSTRUCTION_MULTI", "Mo�nih je ve� odgovorov"); //NEW for 098rc3

define("_CONFIRMATION_MESSAGE1", "Anketa je bila poslana"); //NEW for 098rc5
define("_CONFIRMATION_MESSAGE2", "Va�a anketa je dobila nov odgovor"); //NEW for 098rc5
define("_CONFIRMATION_MESSAGE3", "Individualni potatki do vam na voljo tukaj:"); //NEW for 098rc5
define("_CONFIRMATION_MESSAGE4", "Osnovne statistike so vam na voljo tukaj:"); //NEW for 098rc5

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