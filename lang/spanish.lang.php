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
	# This language file kindly provided by Luis M. Martinez	#
	#															#
	#############################################################
*/
//SINGLE WORDS
define("_YES", "S�");
define("_NO", "No");
define("_UNCERTAIN", "Dudoso");
define("_ADMIN", "Admin");
define("_TOKENS", "Tokens");
define("_FEMALE", "Femenino");
define("_MALE", "Masculino");
define("_NOANSWER", "Sin respuesta");
define("_NOTAPPLICABLE", "N/A"); //New for 0.98rc5
define("_OTHER", "Otro");
define("_PLEASECHOOSE", "Favor de elegir");
define("_ERROR_PS", "Error");
define("_COMPLETE", "completo");
define("_INCREASE", "Aumento"); //NEW WITH 0.98 BABELFISH TRANSLATION
define("_SAME", "Iguales"); //NEW WITH 0.98 BABELFISH TRANSLATION
define("_DECREASE", "Disminuci�n"); //NEW WITH 0.98 BABELFISH TRANSLATION
//from questions.php
define("_CONFIRMATION", "Confirmaci�n");
define("_TOKEN_PS", "Token");
define("_CONTINUE_PS", "Continuar");

//BUTTONS
define("_ACCEPT", "Aceptar");
define("_PREV", "anterior");
define("_NEXT", "sig");
define("_LAST", "�ltimo");
define("_SUBMIT", "enviar");


//MESSAGES
//From QANDA.PHP
define("_CHOOSEONE", "Favor de elijir uno de los siguientes");
define("_ENTERCOMMENT", "Favor de teclear su comentario aqu�");
define("_NUMERICAL_PS", "S�lo se aceptan n�meros en este campo");
define("_CLEARALL", "Salir y Limpiar Encuesta");
define("_MANDATORY", "Esta pregunta es requerida");
define("_MANDATORY_PARTS", "Favor de completar todas las partes");
define("_MANDATORY_CHECK", "Favor de seleccionar al menos un elemento");
define("_MANDATORY_RANK", "Favor de clasificar todos los elementos");
define("_MANDATORY_POPUP", "Unas o m�s preguntas obligatorias no se han contestado. Usted no puede proceder hasta que se han terminado �stos"); //NEW in 0.98rc4
define("_DATEFORMAT", "Formato: AAAA-MM-DD");
define("_DATEFORMATEG", "(pej: 2003-12-25 para Navidad)");
define("_REMOVEITEM", "Eliminar este elemento");
define("_RANK_1", "Haga click en un elemento de la lista de la izquierda, empezando por el");
define("_RANK_2", "elemento con m�s alta clasificaci�n hasta llegar al elemento con m�s baja clasificaci�n.");
define("_YOURCHOICES", "Sus Opciones");
define("_YOURRANKING", "Su Clasificaci�n");
define("_RANK_3", "Haga click en las tijeras de la derecha de cada elemento");
define("_RANK_4", "para eliminar la �ltima captura de su lista clasificada");
//From INDEX.PHP
define("_NOSID", "No ha proporcionado un n�mero identificador de encuesta");
define("_CONTACT1", "Favor de contactar a");
define("_CONTACT2", "para m�s asistencia");
define("_ANSCLEAR", "Respuestas quitadas");
define("_RESTART", "Reiniciar la Encuesta");
define("_CLOSEWIN_PS", "Cerrar esta Ventana");
define("_CONFIRMCLEAR", "�Est� seguro de eliminar todas sus respuestas?");
define("_EXITCLEAR", "Salir y Limpiar la Encuesta");
//From QUESTION.PHP
define("_BADSUBMIT1", "No se pueden enviar los resultados - no hay resultados por enviar.");
define("_BADSUBMIT2", "Este error puede ocurrir si envi� sus respuestas y presion� 'renovar' en su navegador. En este caso, sus respuestas ya fueron guardadas.");
define("_NOTACTIVE1", "Sus respuestas no han sido guardadas porque la Encuesta no ha sido activada a�n.");
define("_CLEARRESP", "Inicializar Respuestas");
define("_THANKS", "Gracias");
define("_SURVEYREC", "Sus respuestas han sido guardadas.");
define("_SURVEYCPL", "Encuesta Completada");
define("_DIDNOTSAVE", "No se guard�");
define("_DIDNOTSAVE2", "Ha ocurrido un error inesperado y sus respuestas no han podido ser guardadas.");
define("_DIDNOTSAVE3", "Sus respuestas no se han perdido y han sido enviadas por correo electr�nico al administrador de la encuesta para ser capturadas en nuestra base de datos posteriormente.");
define("_DNSAVEEMAIL1", "Ha sucedido un error al guardar una respuesta de la encuesta identificada con");
define("_DNSAVEEMAIL2", "DATOS PARA SER CAPTURADOS");
define("_DNSAVEEMAIL3", "EL CODIGO SQL HA FALLADO");
define("_DNSAVEEMAIL4", "MENSAJE DE ERROR");
define("_DNSAVEEMAIL5", "ERROR GUARDANDO");
define("_SUBMITAGAIN", "Reintente enviar otra vez");
define("_SURVEYNOEXIST", "Lo sentimos. No hay encuestas que coincidan.");
define("_NOTOKEN1", "Esta encuesta tiene control de acceso. Necesita un token v�lido para participar.");
define("_NOTOKEN2", "Si se le ha proporcionado un token, favor de teclearlo en la caja de abajo y hacer click en continuar.");
define("_NOTOKEN3", "El token que se le ha proporcionado no es v�lido o ya fue usado.");
define("_NOQUESTIONS", "Esta encuesta todav�a no tiene preguntas y no puede ser probada ni completada.");
define("_FURTHERINFO", "Para m�s informaci�n contactar a");
define("_NOTACTIVE", "Esta encuesta no est� activa. No podr� guardar sus respuestas.");
define("_SURVEYEXPIRED", "This survey is no longer available."); //NEW for 098rc5

define("_SURVEYCOMPLETE", "Usted ha terminado ya este examen.");

define("_INSTRUCTION_LIST", "Elija solamente uno del siguiente"); //NEW for 098rc3
define("_INSTRUCTION_MULTI", "Compruebe cualquiera que se aplica"); //NEW for 098rc3

define("_CONFIRMATION_MESSAGE1", "Examen Sometido"); //NEW for 098rc5
define("_CONFIRMATION_MESSAGE2", "Una nueva respuesta fue incorporada para su examen"); //NEW for 098rc5
define("_CONFIRMATION_MESSAGE3", "Chasque el acoplamiento siguiente para ver la respuesta individual:"); //NEW for 098rc5
define("_CONFIRMATION_MESSAGE4", "Estad�stica de la visi�n chascando aqu�:"); //NEW for 098rc5

define ("_RG_REGISTER1", "You must be registered to complete this survey"); //NEW for 0.98rc9
define ("_RG_REGISTER2", "You may register for this survey if you wish to take part.<br />\n"
						."Enter your details below, and an email containing the link to "
						."participate in this survey will be sent immediately."); //NEW for 0.98rc9
define ("_RG_EMAIL", "Email Address"); //NEW for 0.98rc9
define ("_RG_FIRSTNAME", "First Name"); //NEW for 0.98rc9
define ("_RG_LASTNAME", "Last Name"); //NEW for 0.98rc9
define ("_RG_INVALIDEMAIL", "The email you used is not valid. Please try again.");//NEW for 0.98rc9
define ("_RG_USEDEMAIL", "The email you used has already been registered.");//NEW for 0.98rc9
define ("_RG_EMAILINVITATION", "Dear {FIRSTNAME},\n\n"
							  ."You, or someone using your email address, have registered to\n"
							  ."participate in an online survey titled {SURVEYNAME}.\n\n"
							  ."To complete this survey, click on the following URL:\n\n"
							  ."{SURVEYURL}\n\n"
							  ."If you have any questions about this survey, or if you\n"
							  ."did not register to participate and believe this email\n"
							  ."is in error, please contact {ADMINNAME} at {ADMINEMAIL}.");//NEW for 0.98rc9
define ("_RG_EMAILSUBJECT", "{SURVEYNAME} Registration Confirmation");//NEW for 0.98rc9
define ("_RG_REGISTRATIONCOMPLETE", "Thank you for registering to participate in this survey.<br /><br />\n"
								   ."An email has been sent to the address you provided with access details"
								   ."for this survey. Please follow the link in that email to proceed.<br /><br />\n"
								   ."Survey Administrator {ADMINNAME} ({ADMINEMAIL})");//NEW for 0.98rc9

?>
