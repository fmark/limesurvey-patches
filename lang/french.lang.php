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
	# This language file kindly provided by Fran�ois Tissandier	#
	#															#
	#############################################################
*/
//SINGLE WORDS
define("_YES", "Oui");
define("_NO", "Non");
define("_UNCERTAIN", "Je ne sais pas");
define("_ADMIN", "Administrateur");
define("_TOKENS", "Invitations");
define("_FEMALE", "Femme");
define("_MALE", "Homme");
define("_NOANSWER", "Pas de r�ponse");
define("_OTHER", "Autre");
define("_PLEASECHOOSE", "Choisissez s'il vous pla�t");
define("_ERROR", "Erreur");
define("_COMPLETE", "Termin�");
define("_INCREASE", "Augmentation"); //NEW WITH 0.98 BABELFISH TRANSLATION
define("_SAME", "M�mes"); //NEW WITH 0.98 BABELFISH TRANSLATION
define("_DECREASE", "Diminution"); //NEW WITH 0.98 BABELFISH TRANSLATION
//from questions.php
define("_CONFIRMATION", "Confirmation");
define("_TOKEN", "Invitation");
define("_CONTINUE", "Continuer");

//BUTTONS
define("_ACCEPT", "Accepter");
define("_PREV", "Pr�c�dent");
define("_NEXT", "Suivant");
define("_LAST", "Dernier");
define("_SUBMIT", "Envoyer");


//MESSAGES
//From QANDA.PHP
define("_CHOOSEONE", "Choisissez une des r�ponses suivantes SVP");
define("_ENTERCOMMENT", "Ajoutez votre commentaire ici SVP");
define("_NUMERICAL", "Seuls les chiffres sont autoris�s pour ce champ");
define("_CLEARALL", "Sortir et effacer ce sondage");
define("_MANDATORY", "Cette question est obligatoire");
define("_MANDATORY_PARTS", "Compl�tez toutes les parties SVP");
define("_MANDATORY_CHECK", "Veuillez choisir au moins un �l�ment SVP");
define("_MANDATORY_RANK", "Veuillez classer tous les �l�ments SVP");
define("_MANDATORY_POPUP", "Une ou plusieurs questions obligatoires n'ont pas �t� r�pondues. Vous ne pouvez pas proc�der jusqu'� ce que ceux-ci aient �t� accomplis"); //NEW in 0.98rc4
define("_DATEFORMAT", "Format: AAAA-MM-JJ");
define("_DATEFORMATEG", "(ex: 2003-12-25 pour No�l)");
define("_REMOVEITEM", "Enlever cet �l�ment");
define("_RANK_1", "Cliquez sur un �l�ment dans la liste de gauche, en commen�ant par");
define("_RANK_2", "l'�l�ment le plus important pour finir par le moins important.");
define("_YOURCHOICES", "Vos choix");
define("_YOURRANKING", "Votre classement");
define("_RANK_3", "Cliquez sur les ciseaux � droite de chaque �l�ment");
define("_RANK_4", "pour enlever le dernier �l�ment de votre classement");
//From INDEX.PHP
define("_NOSID", "Vous n'avez pas fourni d'identifiant de sondage");
define("_CONTACT1", "Veuillez contacter");
define("_CONTACT2", "pour avoir plus d'aide");
define("_ANSCLEAR", "R�ponses effac�es");
define("_RESTART", "Recommencer ce sondage");
define("_CLOSEWIN", "Fermer cette fen�tre");
define("_CONFIRMCLEAR", "Etes-vous s�r de vouloir effacer toutes les r�ponses?");
define("_EXITCLEAR", "Sortir et effacer le sondage");
//From QUESTION.PHP
define("_BADSUBMIT1", "R�ponses non envoy�es car vides.");
define("_BADSUBMIT2", "Cette erreur peut se produire si vous avez d�j� envoy� vos r�ponses et press� le bouton \"Rafra�chir\" de votre naviguateur. Dans ce cas, vos r�ponses ont d�j� �t� sauv�es.");
define("_NOTACTIVE1", "Vos r�ponses n'ont pas �t� enregistr�es. Ce sondage n'est pas encore actif.");
define("_CLEARRESP", "Effacer les r�ponses");
define("_THANKS", "Merci");
define("_SURVEYREC", "Vos r�ponses ont �t� enregistr�es.");
define("_SURVEYCPL", "Sondage compl�t�");
define("_DIDNOTSAVE", "Non sauvegard�");
define("_DIDNOTSAVE2", "Une erreur non pr�vue s'est produite et vos r�ponses n'ont pas pu �tre sauv�es.");
define("_DIDNOTSAVE3", "Vos r�ponses n'ont pas �t� perdues et ont �t� email�es � l'administrateur du sondage qui les entrera dans la base de donn�es ult�rieurement.");
define("_DNSAVEEMAIL1", "Une erreur s'est produit pendant la sauvegarde d'une r�ponse");
define("_DNSAVEEMAIL2", "DONNEES A ENTRER");
define("_DNSAVEEMAIL3", "CODE SQL QUI A ECHOUE");
define("_DNSAVEEMAIL4", "MESSAGE D'ERREUR");
define("_DNSAVEEMAIL5", "ERREUR DE SAUVEGARDE");
define("_SUBMITAGAIN", "Essayez d'envoyer � nouveau");
define("_SURVEYNOEXIST", "D�sol�. Il n'y a pas de sondage correspondant.");
define("_NOTOKEN1", "C'est un sondage priv�. Vous devez avoir une invitation pour y participer.");
define("_NOTOKEN2", "Si vous avez re�u une invitation, entrez la dans le champ ci-dessous et cliquez sur Continuer.");
define("_NOTOKEN3", "L'invitation que vous avez re�ue n'est pas valide, ou a d�j� �t� utilis�e.");
define("_NOQUESTIONS", "Ce sondage n'a plus de questions et ne peut �tre test� ou finalis�.");
define("_FURTHERINFO", "Pour plus d'informations veuillez contacter");
define("_NOTACTIVE", "Ce sondage n'est pas actif. Vous ne pourrez pas sauver vos r�ponses.");

define("_SURVEYCOMPLETE", "Vous avez d�j� accompli cet aper�u.");

define("_INSTRUCTION_LIST", "Choisissez seulement un du suivant"); //NEW for 098rc3
define("_INSTRUCTION_MULTI", "En v�rifiez qui s'appliquent"); //NEW for 098rc3

define("_CONFIRMATION_MESSAGE1", "L'Aper�u A soumis"); //NEW for 098rc5
define("_CONFIRMATION_MESSAGE2", "Une nouvelle r�ponse a �t� �crite pour votre aper�u"); //NEW for 098rc5
define("_CONFIRMATION_MESSAGE3", "Cliquetez le lien suivant pour voir la r�ponse individuelle:"); //NEW for 098rc5
define("_CONFIRMATION_MESSAGE4", "Statistiques de vue en cliquetant ici:"); //NEW for 098rc5
?>