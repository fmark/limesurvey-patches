<?php
/*
	#################################################################
	# >>> PHP Surveyor  										#
	#################################################################
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
	# This language file kindly provided by Fran�ois Tissandier	#
	# and corrected by Pascal Bastien 20/07/2004			#
	# Version 1.2							#
	#															#
	#################################################################
*/
//SINGLE WORDS
define("_YES", "Oui");
define("_NO", "Non");
define("_UNCERTAIN", "Je ne sais pas");
define("_ADMIN", "Administrateur");
define("_TOKENS", "Invitations");
define("_FEMALE", "Femme");
define("_MALE", "Homme");
define("_NOANSWER", "Sans r�ponser");
define("_NOTAPPLICABLE", "N/A"); //New for 0.98rc5
define("_OTHER", "Autre");
define("_PLEASECHOOSE", "Veuillez choisir");
define("_ERROR_PS", "Erreur");
define("_COMPLETE", "Termin�");
define("_INCREASE", "Augmenter"); //NEW WITH 0.98
define("_SAME", "Sans Changement"); //NEW WITH 0.98
define("_DECREASE", "Diminuer"); //NEW WITH 0.98
//from questions.php
define("_CONFIRMATION", "Confirmation");
define("_TOKEN_PS", "Invitation");
define("_CONTINUE_PS", "Continuer");

//BUTTONS
define("_ACCEPT", "Accepter");
define("_PREV", "pr�cedant");
define("_NEXT", "suivant");
define("_LAST", "dernier");
define("_SUBMIT", "envoyer");


//MESSAGES
//From QANDA.PHP
define("_CHOOSEONE", "Veuillez s�lectionner une r�ponse ci-dessous");
define("_ENTERCOMMENT", "Veuillez saisir votre commentaire ici");
define("_NUMERICAL_PS", "Seuls les chiffres sont autoris�s pour ce champ");
define("_CLEARALL", "Sortir et effacer ce questionnaire");
define("_MANDATORY", "Cette question est obligatoire");
define("_MANDATORY_PARTS", "Veuillez Compl�ter toutes les parties SVP");
define("_MANDATORY_CHECK", "Veuillez choisir au moins un �l�ment SVP");
define("_MANDATORY_RANK", "Veuillez classer tous les �l�ments SVP");
define("_MANDATORY_POPUP", "Vous n'avez pas r�pondu � une ou plusieurs questions obligatoires. Vous ne pouvez pas r�pondre au questionnaire tant que vous n'avez r�pondu � celles-ci"); //NEW in 0.98rc4
define("_DATEFORMAT", "Format: AAAA-MM-JJ");
define("_DATEFORMATEG", "(ex: 2003-12-25 pour No�l)");
define("_REMOVEITEM", "Enlever cet �l�ment");
define("_RANK_1", "Cliquez sur un �l�ment dans la liste de gauche ci-dessous.");
define("_RANK_2", "Choisissez l'�l�ment le plus important pour finir par le moins important.");
define("_YOURCHOICES", "Vos choix");
define("_YOURRANKING", "Votre classement");
define("_RANK_3", "Cliquer sur les ciseaux � droite de chaque �l�ment");
define("_RANK_4", "pour enlever le dernier �l�ment de votre classement");
//From INDEX.PHP
define("_NOSID", "Vous n'avez pas fourni d'identifiant de sondage");
define("_CONTACT1", "Veuillez contacter");
define("_CONTACT2", "pour plus d'aide");
define("_ANSCLEAR", "R�ponses effac�es");
define("_RESTART", "Recommencer ce sondage");
define("_CLOSEWIN_PS", "Fermer cette fen�tre");
define("_CONFIRMCLEAR", "Etes-vous s�r de vouloir effacer toutes les r�ponses?");
define("_EXITCLEAR", "Sortir et effacer le questionnaire");
//From QUESTION.PHP
define("_BADSUBMIT1", "Impossible d'envoyer les R�ponses car il n'y en a aucune (vides).");
define("_BADSUBMIT2", "Cette erreur peut se produire si vous avez d�j� envoy� vos r�ponses et actualis� la page de votre naviguateur avec \"Actualiser\". Dans ce cas, vos r�ponses ont d�j� �t� sauv�es.");
define("_NOTACTIVE1", "Vos r�ponses n'ont pas �t� enregistr�es. Ce questionnaire n'est pas encore activ�.");
define("_CLEARRESP", "Effacer les r�ponses");
define("_THANKS", "Merci");
define("_SURVEYREC", "Vos r�ponses ont �t� enregistr�es.");
define("_SURVEYCPL", "Sondage compl�t�");
define("_DIDNOTSAVE", "Non sauvegard�");
define("_DIDNOTSAVE2", "Une erreur non pr�vue s'est produite et vos r�ponses n'ont pas pu �tre sauv�es.");
define("_DIDNOTSAVE3", "Vos r�ponses n'ont pas �t� perdues et ont �t� email�es � l'administrateur du questionnaire qui les saisira ult�rieurement dans la base de donn�es.");
define("_DNSAVEEMAIL1", "Une erreur s'est produit pendant la sauvegarde d'une r�ponse");
define("_DNSAVEEMAIL2", "DONNEES A SAISIR");
define("_DNSAVEEMAIL3", "CODE SQL QUI A ECHOUE");
define("_DNSAVEEMAIL4", "MESSAGE D'ERREUR");
define("_DNSAVEEMAIL5", "ERREUR DE SAUVEGARDE");
define("_SUBMITAGAIN", "Essayez d'envoyer � nouveau");
define("_SURVEYNOEXIST", "D�sol�. Il n'y a pas de sondage correspondant.");
define("_NOTOKEN1", "C'est un sondage priv�. Vous devez avoir une invitation pour y participer.");
define("_NOTOKEN2", "Si vous avez re�u une invitation, saisissez-la dans le champ ci-dessous et cliquez sur Continuer.");
define("_NOTOKEN3", "L'invitation que vous avez re�ue n'est pas valide, ou a d�j� �t� utilis�e.");
define("_NOQUESTIONS", "Ce questionnaire n'a pas encore de questions et ne peut �tre test� ou finalis�.");
define("_FURTHERINFO", "Pour plus d'informations veuillez contacter");
define("_NOTACTIVE", "Ce sondage n'est pas activ�. Vous ne pourrez pas sauver vos r�ponses.");
define("_SURVEYEXPIRED", "Ce questionnaire n'est plus disponible."); //NEW for 098rc5

define("_SURVEYCOMPLETE", "Vous avez d�j� complet� ce questionnaire.");

define("_INSTRUCTION_LIST", "Veuillez s�lectionner seulement une r�ponse ci-dessous"); //NEW for 098rc3
define("_INSTRUCTION_MULTI", "Cochez le (ou les) r�ponses"); //NEW for 098rc3

define("_CONFIRMATION_MESSAGE1", "Questionnaire envoy�"); //NEW for 098rc5
define("_CONFIRMATION_MESSAGE2", "Une nouvelle r�ponse a �t� saisie dans votre questionnaire"); //NEW for 098rc5
define("_CONFIRMATION_MESSAGE3", "Cliquez sur le lien suivant pour voir votre r�ponse personnelle:"); //NEW for 098rc5
define("_CONFIRMATION_MESSAGE4", "Visualiser les Statistiques cliquant ici:"); //NEW for 098rc5

define("_PRIVACY_MESSAGE", "<b><i>Note sur la vie priv�e</i></b><br />"
						  ."Ce questionnaire est anonyme.<br />"
						  ."Les enregistrements conserv�s de votre questionnaire ne contiennent aucune "
						  ."information d'identification � moins bien s�r qu'un question  "
						  ."sur votre identit� ai �t� pos�e dans le questionnaire. Si vous avez r�pondu � "
						  ."un questionnaire utilisant une invitation pour vous permettre d'acc�der au "
						  ."questionnaire, vous pouvez �tre assur�s que cet identifiant. "
						  ."n'est pas conserv� avec vos r�ponses. Il est ger� dans une base de donn�es s�par�e "
						  ."et ne pourra pas �tre mis � jour pour indiquer que vous "
						  ."avez complet� ce questionnaire. Il n'y a aucun moyen pour faire correspondre "
						  ."les invitations avec les r�ponses au questionnaire."); //New for 0.98rc9

define("_THEREAREXQUESTIONS", "Il y a {NUMBEROFQUESTIONS} questions dans ce questionnaire."); //New for 0.98rc9 Must contain {NUMBEROFQUESTIONS} which gets replaced with a question count.
define("_THEREAREXQUESTIONS_SINGLE", "Il y a 1 question dans ce questionnaire."); //New for 0.98rc9 - singular version of above

define ("_RG_REGISTER1", "Vous devez �tre enregistr� pour r�pondre � ce questionnaire"); //NEW for 0.98rc9
define ("_RG_REGISTER2", "Vous devez �tre enregistr� pour ce questionnaire si vous d�sirez y participer.<br />\n"
						."Saisissez vos coordonn�es ci-dessous, et un email contenant le lien pour "
						."participer � ce questionnaire vous sera imm�diatement envoy�."); //NEW for 0.98rc9
define ("_RG_EMAIL", "Addresse Email"); //NEW for 0.98rc9
define ("_RG_FIRSTNAME", "Nom"); //NEW for 0.98rc9
define ("_RG_LASTNAME", "Pr�nom"); //NEW for 0.98rc9
define ("_RG_INVALIDEMAIL", "L'email utilis� n'est pas valide. Veuillez re�ssayer.");//NEW for 0.98rc9
define ("_RG_USEDEMAIL", "L'email utilis� a d�j� �t� enregistr�.");//NEW for 0.98rc9
define ("_RG_EMAILSUBJECT", "Confirmation d'enregistrement de {SURVEYNAME}");//NEW for 0.98rc9
define ("_RG_REGISTRATIONCOMPLETE", "Merci de vous enregistre pour participer � ce questionnaire.<br /><br />\n"
								   ."Un email a �t� envoy� � l'adresse que vous avez fournie dans les d�tails d'acc�s "
								   ."pour ce questionnaire. Veuillez suivre ce lien dans cet email pour participer.<br /><br />\n"
								   ."Administrateur du questionnaire {ADMINNAME} ({ADMINEMAIL})");//NEW for 0.98rc9

define("_SM_COMPLETED", "<b>Thank You<br /><br />"
					   ."You have completed answering the questions in this survey.</b><br /><br />"
					   ."Click on ["._SUBMIT."] now to complete the process and save your answers."); //New for 0.98finalRC1
define("_SM_REVIEW", "If you want to check any of the answers you have made, and/or change them, "
					."you can do that now by clicking on the [<< "._PREV."] button and browsing "
					."through your responses."); //New for 0.98finalRC1

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