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
	#							    							#
	# Hungarian Language File				    				#
	# Created by David Selmeczi 						    	#
	#							    							#
	#############################################################
*/
//SINGLE WORDS
define("_YES", "Igen");
define("_NO", "Nem");
define("_UNCERTAIN", "Nem tudom");
define("_ADMIN", "Admin");
define("_TOKENS", "K�dok");
define("_FEMALE", "N�");
define("_MALE", "F�rfi");
define("_NOANSWER", "Nincs v�lasz");
define("_NOTAPPLICABLE", "???"); //New for 0.98rc5
define("_OTHER", "M�s");
define("_PLEASECHOOSE", "K�rem v�lasszon");
define("_ERROR_PS", "Hiba");
define("_COMPLETE", "teljes");
define("_INCREASE", "N�vel"); //NEW WITH 0.98
define("_SAME", "Ugyanaz"); //NEW WITH 0.98
define("_DECREASE", "Cs�kkent"); //NEW WITH 0.98
//from questions.php
define("_CONFIRMATION", "Meger�s�t�s");
define("_TOKEN_PS", "K�d");
define("_CONTINUE_PS", "Folytat�s");

//BUTTONS
define("_ACCEPT", "Elfogadom");
define("_PREV", "el�z�");
define("_NEXT", "k�vetkez�");
define("_LAST", "utols�");
define("_SUBMIT", "Elk�ld�m");


//MESSAGES
//From QANDA.PHP
define("_CHOOSEONE", "K�rem v�lsszon egyet az al�bbiak k�z�l");
define("_ENTERCOMMENT", "Az �n megjegyz�se ehhez");
define("_NUMERICAL_PS", "Ebbe a mez�be csak sz�mokat �rhat");
define("_CLEARALL", "Kil�p�s �s a k�rd��v t�rl�se");
define("_MANDATORY", "Erre a k�rd�sre k�telez� v�lszolni");
define("_MANDATORY_PARTS", "K�rem t�lts�n ki mindent");
define("_MANDATORY_CHECK", "Jel�lj�n be legal�bb egy v�lszt");
define("_MANDATORY_RANK", "Rangsorolja az �sszeset");
define("_MANDATORY_POPUP", "Legal�bb egy k�telez�en kit�ltend� k�rd�sre nem v�lszolt. Addig nem l�phet tov�bb, am�g ezeket nem t�lti ki!"); //NEW in 0.98rc4
define("_DATEFORMAT", "D�tum form�tum: ����-HH-NN");
define("_DATEFORMATEG", "(pl: kar�csony napja: 2003-12-25)");
define("_REMOVEITEM", "E t�tel elt�vol�t�sa");
define("_RANK_1", "A bal oldali list�ban kattintson el�sz�r a legfontosabbra,");
define("_RANK_2", "majd sorban a legkev�sb� fontosig az �sszesre");
define("_YOURCHOICES", "Lehet�s�gek");
define("_YOURRANKING", "Az �n rangsora");
define("_RANK_3", "Egy t�tel elt�vol�t�s�hoz kattintson a mellette tal�lhat�");
define("_RANK_4", "oll�ra. �gy az utols� t�tel leker�l a list�r�l");
//From INDEX.PHP
define("_NOSID", "Nem adott meg k�rd��v-azonos�t�t");
define("_CONTACT1", "A tov�bbi teend�k �gy�ben vegye fel a kapcsolatot:");
define("_CONTACT2", "");
define("_ANSCLEAR", "A v�laszok t�r�lve");
define("_RESTART", "A k�rd��v �jrakezd�se");
define("_CLOSEWIN_PS", "Ablak bez�r�sa");
define("_CONFIRMCLEAR", "Biztosan t�r�lni akarja a v�laszait?");
define("_EXITCLEAR", "Kil�p�s �s a k�rd��v t�rl�se");
//From QUESTION.PHP
define("_BADSUBMIT1", "Nem tudom elk�ldeni az eredm�nyeket, mert nincsenek v�laszok.");
define("_BADSUBMIT2", "Ez a hiba akkor fordul el�, ha m�r elk�ldte a v�laszait �s ut�na megnyomta a 'Friss�t�s' gombot a b�ng�sz�n. Ebben az esetben a v�laszai m�r el vannak k�ldve.<br /><br />Ha viszont ezt a hib�t a k�rd��v kit�lt�se k�zben kapta, akkor nyomja meg a b�ng�sz� '<- VISSZA/BACK' gombj�t, �s az �gy megjelen� oldalt friss�tse. �gy az utols� oldal v�laszait elveszti, de minden el�z� megmarad. Ez a hiba akkor szokott el�fordulni, ha a szerver t�l van terhelve. Eln�z�st k�r�nk a kellemetlens�g�rt.");
define("_NOTACTIVE1", "Your survey responses have not been recorded. This survey is not yet active.");
define("_CLEARRESP", "V�laszok t�rl�se");
define("_THANKS", "K�sz�nj�k");
define("_SURVEYREC", "V�laszait r�gz�tett�k");
define("_SURVEYCPL", "V�ge a k�rd��vnek");
define("_DIDNOTSAVE", "Nem siker�lt elmenteni");
define("_DIDNOTSAVE2", "V�ratlan hiba k�vetkezett be, v�laszait nem siker�lt r�gz�teni.");
define("_DIDNOTSAVE3", "De a bevitt adatok nem vesztek el, hanem emailben tov�bb�tottuk a rendszer karbantart�j�nak, aki k�s�bb ezeket be fogja vinni az adatb�zisba.");
define("_DNSAVEEMAIL1", "Hiba l�pett fel a k�vetkez� k�rd��v r�gz�t�sekor:");
define("_DNSAVEEMAIL2", "DATA TO BE ENTERED");
define("_DNSAVEEMAIL3", "SQL CODE THAT FAILED");
define("_DNSAVEEMAIL4", "ERROR MESSAGE");
define("_DNSAVEEMAIL5", "ERROR SAVING");
define("_SUBMITAGAIN", "Pr�b�lja meg �jra elk�ldeni");
define("_SURVEYNOEXIST", "Nincs ilyen k�rd��v.");
define("_NOTOKEN1", "Ez a k�rd��v z�rtk�r�, a felm�r�sben val� r�szv�telehez egy k�dra van sz�ks�ge.");
define("_NOTOKEN2", "Ha kapott ilyen k�dot, �rja be az al�bbi mez�be, majd kattintson a 'Tov�bb' gombra.");
define("_NOTOKEN3", "A megadott k�d �rv�nytelen vagy m�r valaki felhaszn�lta egy k�rd��v kit�lt�s�hez.");
define("_NOQUESTIONS", "Ez a k�rd��v egyel�re nem tartalmaz k�rd�seket, ez�rt nem lehet kipr�b�lni vagy kit�lteni.");
define("_FURTHERINFO", "Tov�bbi inform�ci�:");
define("_NOTACTIVE", "Ez a k�rd��v egyel�re nem akt�v, ez�rt a v�laszokat nem lehet elmenteni.");
define("_SURVEYEXPIRED", "Ez a k�rd��v m�r lej�rt, nem lehet kit�lteni.");

define("_SURVEYCOMPLETE", "A k�rd��vet m�r kit�lt�tte egyszer"); //NEW FOR 0.98rc6

define("_INSTRUCTION_LIST", "V�lasszon egyet az al�bbiak k�z�l"); //NEW for 098rc3
define("_INSTRUCTION_MULTI", "V�lasszon ki egyet vagy t�bbet az al�bbiak k�z�l"); //NEW for 098rc3

define("_CONFIRMATION_MESSAGE1", "Kit�lt�tt k�rd��v �rkezett"); //NEW for 098rc5
define("_CONFIRMATION_MESSAGE2", "V�laszok �rkeztek a k�vetkez� k�rd��vhez"); //NEW for 098rc5
define("_CONFIRMATION_MESSAGE3", "Kattintson ide e k�rd��v megtekint�s�hez:"); //NEW for 098rc5
define("_CONFIRMATION_MESSAGE4", "Itt tekintheti meg a statisztik�kat:"); //NEW for 098rc5
?>
