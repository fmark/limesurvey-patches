<?php
// SPANISH TRANSLATION PROVIDED BY JOSE LUIS RAMIREZ

//BUTTON BAR TITLES
define("_ADMINISTRATION", "Administraci&oacute;n");
define("_SURVEY", "Encuesta");
define("_GROUP", "Grupo");
define("_QUESTION", "Pregunta");
define("_ANSWERS", "Respuestas");
define("_CONDITIONS", "Condiciones");
define("_HELP", "Ayuda");
define("_USERCONTROL", "Control de Usuarios");
define("_ACTIVATE", "Activar Encuesta");
define("_DEACTIVATE", "Desactivar Encuesta");
define("_CHECKFIELDS", "Revisar Campos de la Base de Datos");
define("_CREATEDB", "Crear Base de Datos");
define("_CREATESURVEY", "Crear Encuesta"); //New for 0.98rc4
define("_SETUP", "Configuraci&oacute;n de PHPSurveyor");
define("_DELETESURVEY", "Eliminar Encuesta");
define("_EXPORTQUESTION", "Exportar Pregunta");
define("_EXPORTSURVEY", "Exportar Encuesta");
define("_EXPORTLABEL", "Exportar Etiquetas");
define("_IMPORTQUESTION", "Importar Pregunta");
define("_IMPORTGROUP", "Import Group"); //New for 0.98rc5
define("_IMPORTSURVEY", "Importar Encuesta");
define("_IMPORTLABEL", "Importar Etiquetas");
define("_EXPORTRESULTS", "Exportar Respuestas");
define("_BROWSERESPONSES", "Navegar Respuestas");
define("_BROWSESAVED", "Browse Saved Responses");
define("_STATISTICS", "Estad&iacute;sticas R&aacute;pidas");
define("_VIEWRESPONSE", "Ver Respuesta");
define("_VIEWCONTROL", "Vista de Control de Datos");
define("_DATAENTRY", "Entrada de Datos");
define("_TOKENCONTROL", "Control de Tokens");
define("_TOKENDBADMIN", "Opciones de la Base de Datos de los Tokens");
define("_DROPTOKENS", "Eliminar Tabla de Tokens");
define("_EMAILINVITE", "Enviar Invitaci&oacute;n (email)");
define("_EMAILREMIND", "Enviar Recordatorio (email)");
define("_TOKENIFY", "Crear Tokens");
define("_UPLOADCSV", "Subir Archivo CSV");
define("_LABELCONTROL", "Administraci&oacute;n de Etiquetas"); //NEW with 0.98rc3
define("_LABELSET", "Conjunto de Etiquetas"); //NEW with 0.98rc3
define("_LABELANS", "Etiquetas"); //NEW with 0.98rc3
define("_OPTIONAL", "Optional"); //NEW with 0.98finalRC1

//DROPDOWN HEADINGS
define("_SURVEYS", "Encuestas");
define("_GROUPS", "Grupos");
define("_QUESTIONS", "Preguntas");
define("_QBYQ", "Pregunta por Pregunta");
define("_GBYG", "Grupo por Grupo");
define("_SBYS", "Todos en Uno");
define("_LABELSETS", "Etiquetas"); //New with 0.98rc3

//BUTTON MOUSEOVERS
//administration bar
define("_A_HOME_BT", "Inicio de P&aacute;gina de Administraci&oacute;n");
define("_A_SECURITY_BT", "Modificar Opciones de Seguridad");
define("_A_BADSECURITY_BT", "Activar Seguridad");
define("_A_CHECKDB_BT", "Revisar la Base de Datos");
define("_A_DELETE_BT", "Borrar la Encuesta");
define("_A_ADDSURVEY_BT", "Crear o Importar una Nueva Encuesta");
define("_A_HELP_BT", "Mostrar Ayuda");
define("_A_CHECKSETTINGS", "Revisar Opciones del Sistema");
define("_A_BACKUPDB_BT", "Backup Entire Database"); //New for 0.98rc10
define("_A_TEMPLATES_BT", "Template Editor"); //New for 0.98rc9
//Survey bar
define("_S_ACTIVE_BT", "Esta encuesta est&aacute; actualmente activa");
define("_S_INACTIVE_BT", "Esta encuesta actualmente NO est&aacute; activa");
define("_S_ACTIVATE_BT", "Activar esta Encuesta");
define("_S_DEACTIVATE_BT", "Desactivar esta Encuesta");
define("_S_CANNOTACTIVATE_BT", "No se puede activar esta Encuesta");
define("_S_DOSURVEY_BT", "Contestar la Encuesta");
define("_S_DATAENTRY_BT", "Pantalla de Entrada de Datos para la Encuesta");
define("_S_PRINTABLE_BT", "Versi&oacute;n Imprimible de la Encuesta");
define("_S_EDIT_BT", "Modificar Encuesta Seleccionada");
define("_S_DELETE_BT", "Borrar Encuesta Seleccionada");
define("_S_EXPORT_BT", "Exportar esta Encuesta");
define("_S_BROWSE_BT", "Navegar las Respuestas para esta Encuesta");
define("_S_TOKENS_BT", "Activar/Modificar Tokens para esta Encuesta");
define("_S_ADDGROUP_BT", "Agregar Nuevo Grupo a la Encuesta");
define("_S_MINIMISE_BT", "Ocultar Detalles de esta Encuesta");
define("_S_MAXIMISE_BT", "Mostrar Detalles de esta Encuesta");
define("_S_CLOSE_BT", "Cerrar esta Encuesta");
define("_S_SAVED_BT", "View Saved but not submitted Responses"); //New in 0.99dev01
define("_S_ASSESSMENT_BT", "Set assessment rules"); //New in  0.99dev01
//Group bar
define("_G_EDIT_BT", "Modificar Grupo Seleccionado");
define("_G_EXPORT_BT", "Export Current Group"); //New in 0.98rc5
define("_G_DELETE_BT", "Borrar Grupo Seleccionado");
define("_G_ADDQUESTION_BT", "Agregar Nueva Pregunta al Grupo");
define("_G_MINIMISE_BT", "Ocultar Detalles de este Grupo");
define("_G_MAXIMISE_BT", "Mostrar Detalles de este Grupo");
define("_G_CLOSE_BT", "Cerrar este Grupo");
//Question bar
define("_Q_EDIT_BT", "Modificar Pregunta Seleccionada");
define("_Q_COPY_BT", "Copiar Pregunta Seleccionada"); //New in 0.98rc4
define("_Q_DELETE_BT", "Borrar Pregunta Seleccionada");
define("_Q_EXPORT_BT", "Exportar esta Pregunta");
define("_Q_CONDITIONS_BT", "Establecer Condiciones para esta Pregunta");
define("_Q_ANSWERS_BT", "Modificar/Agregar Respuestas para esta Pregunta");
define("_Q_LABELS_BT", "Modificar/Agregar Etiquetas");
define("_Q_MINIMISE_BT", "Ocultar Detalles para esta Pregunta");
define("_Q_MAXIMISE_BT", "Mostrar Detalles para esta Pregunta");
define("_Q_CLOSE_BT", "Cerrar esta Pregunta");
//Browse Button Bar
define("_B_ADMIN_BT", "Regresar a la Administraci&oacute; de Encuestas");
define("_B_SUMMARY_BT", "Mostrar informaci&oacute;n");
define("_B_ALL_BT", "Mostrar Todas las Contestaciones");
define("_B_LAST_BT", "Mostrar &Uacute;ltimas 50 Contestaciones");
define("_B_STATISTICS_BT", "Generar estad&iacute;sticas a partir de estas contestaciones");
define("_B_EXPORT_BT", "Exportar Resultados a alguna Aplicaci&oacute;n");
define("_B_BACKUP_BT", "Respaldar la tabla de resultados como archivo SQL");
//Tokens Button Bar
define("_T_ALL_BT", "Mostrar Tokens");
define("_T_ADD_BT", "Agregar un nuevo Token");
define("_T_IMPORT_BT", "Importar Tokens desde Archivo CSV");
define("_T_EXPORT_BT", "Export Tokens to CSV file"); //New for 0.98rc7
define("_T_INVITE_BT", "Enviar Invitaci&oacute;n (email)");
define("_T_REMIND_BT", "Enviar Recordatorio (email)");
define("_T_TOKENIFY_BT", "Generar Tokens");
define("_T_KILL_BT", "Borrar Tabla de Tokens");
//Labels Button Bar
define("_L_ADDSET_BT", "Agregar Etiquetas");
define("_L_EDIT_BT", "Modificar Etiquetas");
define("_L_DEL_BT", "Borrar Etiquetas");
//Datacontrols
define("_D_BEGIN", "Mostrar inicio..");
define("_D_BACK", "Mostrar anterior");
define("_D_FORWARD", "Mostrar siguiente..");
define("_D_END", "Mostrar &uacute;ltima..");

//DATA LABELS
//surveys
define("_SL_TITLE", "T&iacute;tulo:");
define("_SL_SURVEYURL", "Encuesta URL:"); //new in 0.98rc5
define("_SL_DESCRIPTION", "Descripci&oacute;n:");
define("_SL_WELCOME", "Bienvenida:");
define("_SL_ADMIN", "Administrador:");
define("_SL_EMAIL", "Correo electr&oacute;nico del Admin:");
define("_SL_FAXTO", "# Fax:");
define("_SL_ANONYMOUS", "&iquest;An&oacute;nimo?");
define("_SL_EXPIRES", "Expiraci&oacute;n:");
define("_SL_FORMAT", "Formato:");
define("_SL_DATESTAMP", "&iquest;Estampar con Fecha?");
define("_SL_TEMPLATE", "Plantilla:");
define("_SL_LANGUAGE", "Idioma:");
define("_SL_LINK", "Liga:");
define("_SL_URL", "URL de salida:");
define("_SL_URLDESCRIP", "Texto del URL:");
define("_SL_STATUS", "Est&aacute;tus:");
define("_SL_SELSQL", "Seleccionar Archivo SQL:");
define("_SL_USECOOKIES", "&iquest;Utilizar Cookies?"); //NEW with 098rc3
define("_SL_NOTIFICATION", "Notification:"); //New with 098rc5
define("_SL_ALLOWREGISTER", "Allow public registration?"); //New with 0.98rc9
define("_SL_ATTRIBUTENAMES", "Token Attribute Names:"); //New with 0.98rc9
define("_SL_EMAILINVITE", "Invitation Email:"); //New with 0.98rc9
define("_SL_EMAILREMIND", "Email Reminder:"); //New with 0.98rc9
define("_SL_EMAILREGISTER", "Public registration Email:"); //New with 0.98rc9
define("_SL_EMAILCONFIRM", "Confirmation Email"); //New with 0.98rc9
define("_SL_REPLACEOK", "This will replace the existing text. Continue?"); //New with 0.98rc9
define("_SL_ALLOWSAVE", "Allow Saves?"); //New with 0.99dev01
define("_SL_AUTONUMBER", "Start ID numbers at:"); //New with 0.99dev01
define("_SL_AUTORELOAD", "Automatically load URL when survey complete?"); //New with 0.99dev01

//groups
define("_GL_TITLE", "T&iacute;tulo:");
define("_GL_DESCRIPTION", "Descripci&oacute;n:");
define("_GL_OPTIONAL", "(opcional)");
define("_GL_UPDATEGROUP", "Actualizar Grupo");
define("_GL_EDITQUESTION", "Modificar Pregunta");
define("_GL_EDITGROUP", "Editar Grupo para la Encuesta con ");
define("_GL_UPDATEQUESTION", "Actualizar Pregunta");
//questions
define("_QL_CODE", "C&oacute;digo:");
define("_QL_QUESTION", "Pregunta:");
define("_QL_VALIDATION", "Validation:"); //New in VALIDATION VERSION
define("_QL_HELP", "Ayuda:");
define("_QL_TYPE", "Tipo:");
define("_QL_GROUP", "Grupo:");
define("_QL_MANDATORY", "Requerida:");
define("_QL_OTHER", "Otro:");
define("_QL_LABELSET", "Etiquetas:");
define("_QL_COPYANS", "&iquest;Copiar Respuestas?"); //New in 0.98rc3
define("_QL_QUESTIONATTRIBUTES", "Question Attributes:"); //New in 0.99dev01
define("_QL_COPYATT", "Copy Attributes?"); //New in 0.99dev01
//answers
define("_AL_CODE", "C&oacute;digo");
define("_AL_ANSWER", "Respuesta");
define("_AL_DEFAULT", "Default");
define("_AL_MOVE", "Mover");
define("_AL_ACTION", "Acci&oacute;n");
define("_AL_UP", "Arriba");
define("_AL_DN", "Abajo");
define("_AL_SAVE", "Guardar");
define("_AL_DEL", "Borrar");
define("_AL_ADD", "Agregar");
define("_AL_FIXSORT", "Corregir Orden");
define("_AL_SORTALPHA", "Sort Alpha"); //New in 0.98rc8 - Sort Answers Alphabetically
//users
define("_UL_USER", "Usuario");
define("_UL_PASSWORD", "Contrase&ntilde;a");
define("_UL_SECURITY", "Seguridad");
define("_UL_ACTION", "Acci&oacute;n");
define("_UL_EDIT", "Modificar");
define("_UL_DEL", "Borrar");
define("_UL_ADD", "Agregar");
define("_UL_TURNOFF", "Desactivar Seguridad");
//tokens
define("_TL_FIRST", "Nombre");
define("_TL_LAST", "Apellidos");
define("_TL_LASTMOTHERS", "Apellido Materno");
define("_TL_LASTFATHERS", "Apellido Paterno");
define("_TL_EMAIL", "Email");
define("_TL_TOKEN", "Token");
define("_TL_INVITE", "&iquest;Invitaci&oacute;n enviada?");
define("_TL_DONE", "&iquest;Completada?");
define("_TL_ACTION", "Acci&oacute;nes");
define("_TL_ATTR1", "Attribute_1"); //New for 0.98rc7
define("_TL_ATTR2", "Attribute_2"); //New for 0.98rc7
define("_TL_MPID", "MPID"); //New for 0.98rc7
//labels
define("_LL_NAME", "Nombre del Conjunto"); //NEW with 098rc3
define("_LL_CODE", "C&oacute;digo"); //NEW with 098rc3
define("_LL_ANSWER", "T&iacute;tulo"); //NEW with 098rc3
define("_LL_SORTORDER", "Orden"); //NEW with 098rc3
define("_LL_ACTION", "Acci&oacute;n"); //New with 098rc3

//QUESTION TYPES
define("_5PT", "Elegir entre 5 Puntos");
define("_DATE", "Fecha");
define("_GENDER", "G&eacute;nero");
define("_LIST", "Lista (Radio)"); //Changed with 0.99dev01
define("_LIST_DROPDOWN", "Lista (Dropdown)"); //New with 0.99dev01
define("_LISTWC", "Lista con Comentarios");
define("_MULTO", "Opci&oacute;n M&uacute;ltiple");
define("_MULTOC", "Opci&oacute;n M&uacute;ltiple con Comentarios");
define("_MULTITEXT", "M&uacute;ltiples Textos Cortos");
define("_NUMERICAL", "Entrada Num&eacute;rica");
define("_RANK", "Ordenar/Fila");
define("_STEXT", "Texto corto");
define("_LTEXT", "Texto largo");
define("_HTEXT", "Huge free text"); //New with 0.99dev01
define("_YESNO", "Si/No");
define("_ARR5",  "Arreglo (Elegir entre 5 Puntos)");
define("_ARR10", "Arreglo (Elegir entre 10 Puntos)");
define("_ARRYN", "Arreglo (Si/No/Incierto)");
define("_ARRMV", "Arreglo (Ampliar, Mantener, Reducir)");
define("_ARRFL", "Arreglo (Etiquetas Flexibles)"); //Release 0.98rc3
define("_ARRFLC", "Array (Flexible Labels) by Column"); //Release 0.98rc8
define("_SINFL", "Sencillo (Etiquetas Flexibles)"); //(FOR LATER RELEASE)
define("_EMAIL", "Correo electr&oacute;nico"); //FOR LATER RELEASE
define("_BOILERPLATE", "Boilerplate Question"); //New in 0.98rc6
define("_LISTFL_DROPDOWN", "List (Flexible Labels) (Dropdown)"); //New in 0.99dev01
define("_LISTFL_RADIO", "List (Flexible Labels) (Radio)"); //New in 0.99dev01

//GENERAL WORDS AND PHRASES
define("_AD_YES", "Si");
define("_AD_NO", "No");
define("_AD_CANCEL", "Cancelar");
define("_AD_CHOOSE", "Elegir..");
define("_AD_OR", "o"); //New in 0.98rc4
define("_ERROR", "Error");
define("_SUCCESS", "&Eacute;xito");
define("_REQ", "*Requerido");
define("_ADDS", "Agregar Encuesta");
define("_ADDG", "Agregar Grupo");
define("_ADDQ", "Agregar Pregunta");
define("_ADDA", "Agregar Respuesta"); //New in 0.98rc4
define("_COPYQ", "Copiar Pregunta"); //New in 0.98rc4
define("_ADDU", "Agregar Usuario");
define("_SEARCH", "Buscar"); //New in 0.98rc4
define("_SAVE", "Salvar Cambios");
define("_NONE", "Ninguno"); //as in "Do not display anything", "or none chosen";
define("_GO_ADMIN", "Pantalla de Administraci&oacute;n Principal"); //text to display to return/display main administration screen
define("_CONTINUE", "Continuar");
define("_WARNING", "Advertencia");
define("_USERNAME", "Nombre de Usuario");
define("_PASSWORD", "Contrase�a");
define("_DELETE", "Borrar");
define("_CLOSEWIN", "Cerrar Ventana");
define("_TOKEN", "Token");
define("_DATESTAMP", "Fecha"); //Referring to the datestamp or time response submitted
define("_COMMENT", "Comentario");
define("_FROM", "De"); //For emails
define("_SUBJECT", "Asunto"); //For emails
define("_MESSAGE", "Mensaje"); //For emails
define("_RELOADING", "Recargando la pantalla. Favor de esperar.");
define("_ADD", "Agregar");
define("_UPDATE", "Actualizar");
define("_BROWSE", "Browse"); //New in 098rc5
define("_AND", "and"); //New with 0.98rc8
define("_SQL", "SQL"); //New with 0.98rc8
define("_PERCENTAGE", "Percentage"); //New with 0.98rc8
define("_COUNT", "Count"); //New with 0.98rc8

//SURVEY STATUS MESSAGES (new in 0.98rc3)
define("_SS_NOGROUPS", "N&uacute;mero de grupos en la encuesta:"); //NEW for release 0.98rc3
define("_SS_NOQUESTS", "N&uacute;mero de preguntas en la encuesta:"); //NEW for release 0.98rc3
define("_SS_ANONYMOUS", "Esta encuesta es an&oacute;nima."); //NEW for release 0.98rc3
define("_SS_TRACKED", "Esta encuesta NO es an&oacute;nima."); //NEW for release 0.98rc3
define("_SS_DATESTAMPED", "Las respuestas tendr&aacute;n estampado de fecha"); //NEW for release 0.98rc3
define("_SS_COOKIES", "Utiliza \"cookies\" para el control de acceso."); //NEW for release 0.98rc3
define("_SS_QBYQ", "Es presentado pregunta por pregunta."); //NEW for release 0.98rc3
define("_SS_GBYG", "Es presentado grupo por grupo."); //NEW for release 0.98rc3
define("_SS_SBYS", "Es presentado en una sola p&aacute;guna."); //NEW for release 0.98rc3
define("_SS_ACTIVE", "La encuesta est&aacute; activa."); //NEW for release 0.98rc3
define("_SS_NOTACTIVE", "La encuesta NO est&aacute; activa."); //NEW for release 0.98rc3
define("_SS_SURVEYTABLE", "La nombre de la tabla de la encuesta es:"); //NEW for release 0.98rc3
define("_SS_CANNOTACTIVATE", "La encuesta no puede ser activada a&uacute;n."); //NEW for release 0.98rc3
define("_SS_ADDGROUPS", "Necesitas agregar grupos"); //NEW for release 0.98rc3
define("_SS_ADDQUESTS", "Necesitas agregar preguntas"); //NEW for release 0.98rc3
define("_SS_ALLOWREGISTER", "If tokens are used, the public may register for this survey"); //NEW for release 0.98rc9
define("_SS_ALLOWSAVE", "Participants can save partially finished surveys"); //NEW for release 0.99dev01

//QUESTION STATUS MESSAGES (new in 0.98rc4)
define("_QS_MANDATORY", "Pregunta obligatoria"); //New for release 0.98rc4
define("_QS_OPTIONAL", "Pregunta opcional"); //New for release 0.98rc4
define("_QS_NOANSWERS", "Necesitas agregar respuestas a esta pregunta"); //New for release 0.98rc4
define("_QS_NOLID", "Necesitas seleccionar un conjunto de etiquetas para esta pregunta"); //New for release 0.98rc4
define("_QS_COPYINFO", "Nota: Debes introducir un c&oacute;digo de pregunta nuevo"); //New for release 0.98rc4

//General Setup Messages
define("_ST_NODB1", "La base de datos del sistema no existe");
define("_ST_NODB2", "O la base de datos seleccionada no ha sido creada o hay problemas para accesarla.");
define("_ST_NODB3", "PHPSurveyor puede intentar crear la base de datos por t&iacute;.");
define("_ST_NODB4", "El nombre de la base de datos seleccionada es:");
define("_ST_CREATEDB", "Crear la Base de Datos");

//USER CONTROL MESSAGES
define("_UC_CREATE", "Creando archivo .htaccess default");
define("_UC_NOCREATE", "No se pudo crear el archivo .htaccess Revisar el valor de \$homedir en el archivo config.php, y que tengas permisos de escritura.");
define("_UC_SEC_DONE", "&iexcl;Se han establecido los niveles de seguridad!");
define("_UC_CREATE_DEFAULT", "Creando usuarios default");
define("_UC_UPDATE_TABLE", "Actualizando tabla de usuarios");
define("_UC_HTPASSWD_ERROR", "Ocurri&oacute; un error al crear el archivo .htpasswd");
define("_UC_HTPASSWD_EXPLAIN", "Si est&aacute;s utilizando un servidor Windows es recomendado que copies el archivo htpasswd.exe de apache al directorio admin para que esta funci&oacute;n funcione correctamente.");
define("_UC_SEC_REMOVE", "Removiendo opciones de seguridad");
define("_UC_ALL_REMOVED", "Archivo de acceso, de contrase&ntilde;as y base de datos de usuarios borrados");
define("_UC_ADD_USER", "Agregando Usuario");
define("_UC_ADD_MISSING", "No se pudo agregar el usuario. Faltaron Nombre de Usuario y/o Contrase&ntilde;a");
define("_UC_DEL_USER", "Borrando el Usuario");
define("_UC_DEL_MISSING", "No se pudo borrar el usuario. Falt&oacute; el Nombre de Usuario.");
define("_UC_MOD_USER", "Modificando el Usuario");
define("_UC_MOD_MISSING", "No se pudo modificar el usuario. Faltaron Nombre de Usuario y/o Contrase&ntilde;a");
define("_UC_TURNON_MESSAGE1", "A&uacute;n no has inicializado las opciones de seguridad para el sistema de encuestas y subsecuentemente no hay restricciones de acceso .</p>\nSi das clic en el bot&oacute;n de 'Inicializar Seguridad' de abajo, opciones est&aacute;ndar de seguridad de APACHE ser&aacute;n agregadas al directorio de administraci&oacute;n del sistema. Y entonces necesitar&aacute;s utilizar los valores default de nombre de usuario y contrase&ntilde;a para accesar la pantalla de administraci&oacute;n.");
define("_UC_TURNON_MESSAGE2", "Es recomendado que una vez que hayas inicializado el sistema de seguridad cambies la contrase&ntilde;a default.");
define("_UC_INITIALISE", "Inicializar Seguridad");
define("_UC_NOUSERS", "No existen usuarios en tu tabla. Se recomienda desacrivar la seguridad. Para luego activarla nuevamente.");
define("_UC_TURNOFF", "Desactivar Seguridad");

//Activate and deactivate messages
define("_AC_MULTI_NOANSWER", "Esta pregunta  es de m&uacute;tiples respuestas pero a&uacute;n no tiene respuestas asignadas a &eacute;l");
define("_AC_NOTYPE", "Esta pregunta a&uacute;n no tiene asignado el 'tipo' de pregunta.");
define("_AC_NOLID", "This question requires a Labelset, but none is set."); //New for 0.98rc8
define("_AC_CON_OUTOFORDER", "Esta pregunta tiene asignada una condifi&oacute;n, pero esta condici&oacute;n est&aacute; basada en una pregunta que aparece despu&eacute;s de ella..");
define("_AC_FAIL", "La encuesta no pasa la revisi&oacute;n de consistencia");
define("_AC_PROBS", "Se han encontrado los siguientes problemas:");
define("_AC_CANNOTACTIVATE", "La encuesta no podr&aacute; ser activada hasta que se hayan resuelto todos los problemas");
define("_AC_READCAREFULLY", "LEE CUIDADOSAMENTE ESTO ANTES DE CONTINUAR");
define("_AC_ACTIVATE_MESSAGE1", "Debes activar una encuesta solo cuando est&eacute;s absolutamente seguro(a) que la configuraci&oacute;n de la encuesta es la correcta y que no habr&aacute; m&aacute;s cambios.");
define("_AC_ACTIVATE_MESSAGE2", "Una vez que la encuesta es activada no podr&aacute;s:<ul><li>Agregar o borrar Grupos</li><li>Agregar o borrar respuestas a preguntas de Opci&oacute;n M&uacute;ltiple</li><li>Agregar o borrar preguntas</li></ul>");
define("_AC_ACTIVATE_MESSAGE3", "Aunque a&uacute;n podr&aacute;s:<ul><li>Modificar los c&oacute;digos de las preguntas, texto o tipo</li><li>Modificar los nombres de los grupos</li><li>Agregar, borrar o modificar respuestas de respuestas predefinidas (exceptuando preguntas de m&uacute;ltiples respuestas)</li><li>Change survey name or description</li></ul>");
define("_AC_ACTIVATE_MESSAGE4", "Si deseas agregar o borra grupos o preguntas una vez que la encuesta ya haya sido contestada por lo menos una vez, deber&aacute;s desactivar la encuesta, lo cual mover&aacute; toda la informaci&oacute;n ya existente a otra tabla para ser archivada.");
define("_AC_ACTIVATE", "Activar");
define("_AC_ACTIVATED", "La encuesta ha sido activada. La tabla de resultados ha sido creada con &eacute;xito.");
define("_AC_NOTACTIVATED", "La encuesta no pudo ser activada.");
define("_AC_NOTPRIVATE", "Esta no es una encuesta an&oacute;nima. Se debe crear una tabla de tokens.");
define("_AC_REGISTRATION", "This survey allows public registration. A token table must also be created.");
define("_AC_CREATETOKENS", "Inicializar los Tokens");
define("_AC_SURVEYACTIVE", "La encuesta ha sido activada, y ahora las respuestas pueden ser almacenadas.");
define("_AC_DEACTIVATE_MESSAGE1", "En una encuesta activa, una tabla es creada para el almacenamiento de las contestaciones.");
define("_AC_DEACTIVATE_MESSAGE2", "Cuando desactivas una encuesta TODOS los datos que fueron introducidos en la tabla original ser&aacute;n movidos a otra tabla, y cuando se vuelva a activar nuevamente la encuesta, la tabla estar&aacute; vac&iacute;a. Ya no tendr� acceso a estos datos por medio de PHPSurveyor.");
define("_AC_DEACTIVATE_MESSAGE3", "Los datos de una encuesta que ha sido desactivada solo pueden ser accesados por un usuario con acceso a la base de datos. Si tu encuesta utiliza tokens, esta tabla tambi&eacute;n ser&aacute; renombrada y s&oacute;lo ser&aacute; accesible a los administradores del sistema.");
define("_AC_DEACTIVATE_MESSAGE4", "La tabla de contestaciones ser&aacute; renombrada a:");
define("_AC_DEACTIVATE_MESSAGE5", "Se sugiere que exportes las contestaciones antes de desactivar la encuesta. Da clic en \"Cancelar\" para regresar a la pantalla de administraci&oacute;n sin desactivar la encuesta.");
define("_AC_DEACTIVATE", "Desactivar");
define("_AC_DEACTIVATED_MESSAGE1", "La tabla de contestaciones ha sido renombrada a: ");
define("_AC_DEACTIVATED_MESSAGE2", "Las contestaciones a esta encuesta ya no est&aacute;n disponibles a PHPSurveyor.");
define("_AC_DEACTIVATED_MESSAGE3", "Anote el nombre de esta tabla en caso que desee accesarla posteriormente.");
define("_AC_DEACTIVATED_MESSAGE4", "La tabla de tokens asociada a esta encuesta a sido renombrada a: ");

//CHECKFIELDS
define("_CF_CHECKTABLES", "Verificando que todas las tablas existan");
define("_CF_CHECKFIELDS", "Verificando que todos los campos existan");
define("_CF_CHECKING", "Verificando");
define("_CF_TABLECREATED", "Tabla Creada");
define("_CF_FIELDCREATED", "Campo Creado");
define("_CF_OK", "OK");
define("_CFT_PROBLEM", "Parece como si faltaran algunas tablas o campos en la base de datos.");

//CREATE DATABASE (createdb.php)
define("_CD_DBCREATED", "La Base de Datos ha sido creada.");
define("_CD_POPULATE_MESSAGE", "Haz clic para rellenar la base de datos");
define("_CD_POPULATE", "Rellenar Base de Datos");
define("_CD_NOCREATE", "No se pudo crear la base de datos");
define("_CD_NODBNAME", "La informaci&oacute;n para accesar a la base de datos no se ha dado. Este script debe ser ejecutado desde el admin.php solamente.");

//DATABASE MODIFICATION MESSAGES
define("_DB_FAIL_GROUPNAME", "No se pudo agregar el grupo. Falta el nombre del grupo.");
define("_DB_FAIL_GROUPUPDATE", "No se pudo actualizar el grupo.");
define("_DB_FAIL_GROUPDELETE", "No se pudo borrar el grupo.");
define("_DB_FAIL_NEWQUESTION", "No se pudo crear la pregunta.");
define("_DB_FAIL_QUESTIONTYPECONDITIONS", "No se pudo actualizar la pregunta. Hay condiciones en otras preguntas que dependen de las respuestas a esta pregunta y cambiando su tipo causaran problemas. Debes eliminar las condiciones antes de que puedas cambiar el tipo de esta pregunta.");
define("_DB_FAIL_QUESTIONUPDATE", "No se pudo actualizar la pregunta");
define("_DB_FAIL_QUESTIONDELCONDITIONS", "No se pudo borrar la pregunta. Hay condiciones en otras preguntas que dependen de esta pregunta. No podr�s borrar esta pregunta hasta que se quiten estas condiciones.");
define("_DB_FAIL_QUESTIONDELETE", "No se pudo borrar la pregunta.");
define("_DB_FAIL_NEWANSWERMISSING", "No se pudo agregar la respuesta. Debes incluir el C�digo y una Respuesta.");
define("_DB_FAIL_NEWANSWERDUPLICATE", "No se pudo agregar la respuesta. Ya existe una respuesta con este c�digo.");
define("_DB_FAIL_ANSWERUPDATEMISSING", "No se pudo actualizar la respuesta. Debes incluir el C�digo y una Respuesta.");
define("_DB_FAIL_ANSWERUPDATEDUPLICATE", "No se pudo actualizar la respuesta. Ya existe una respuesta con este c�digo.");
define("_DB_FAIL_ANSWERUPDATECONDITIONS", "No se pudo agregar la respuesta. Has cambiado su c�digo, pero hay condiciones en otras preguntas que dependen del c�digo anterior. Debes borrar las condiciones antes de poder cambiar el c�digo a esta respuesta.");
define("_DB_FAIL_ANSWERDELCONDITIONS", "No se pudo borrar la respuesta. Hay condiciones en otras preguntas que dependen de esta respuesta. No puede borrar esta respuesta hasta que se quiten estas condiciones.");
define("_DB_FAIL_NEWSURVEY_TITLE", "No se pudo crear la encuesta porque no ten�a el t�tulo corto.");
define("_DB_FAIL_NEWSURVEY", "No se pudo crear la encuesta.");
define("_DB_FAIL_SURVEYUPDATE", "No se pudo actualizar la encuesta.");
define("_DB_FAIL_SURVEYDELETE", "No se pudo borrar la encuesta.");

//DELETE SURVEY MESSAGES
define("_DS_NOSID", "No seleccionaste cual encuesta borrar.");
define("_DS_DELMESSAGE1", "Est&aacute;s a punto de borrar esta encuesta.");
define("_DS_DELMESSAGE2", "Este proceso borrar&aacute; esta encuesta, junto con todos los grupos, preguntas, respuestas y condiciones relacionadas.");
define("_DS_DELMESSAGE3", "Se recomienda que antes de borrar esta encuesta exportes la encuesta entera desde la p&aacute;gina de administraci&oacute;n.");
define("_DS_SURVEYACTIVE", "Esta encuesta est&aacute; activa y existe una tabla de contestaciones. Si la borras, estas contestaciones ser&aacute;n borradas. Recomendamos que las exportes antes de borrar la encuesta.");
define("_DS_SURVEYTOKENS", "Esta encuesta est&aacute; activa y existe una tabla de tokens. Si la borras, estos tokens ser&aacute;n borrados. Recomendamos que las exportes antes de borrar la encuesta.");
define("_DS_DELETED", "Se ha borrado la encuesta.");

//DELETE QUESTION AND GROUP MESSAGES
define("_DG_RUSURE", "Suprimir a este grupo tambi�n suprimir� cualesquiera preguntas y respuesta que contenga. �Es usted seguro usted desea continuar?"); //New for 098rc5
define("_DQ_RUSURE", "Suprimir esta pregunta tambi�n suprimir� cualquier respuesta que incluya. Est� usted seguro usted desea continuar?"); //New for 098rc5

//EXPORT MESSAGES
define("_EQ_NOQID", "No se indic&oacute; un QID. No se pueden exportar las preguntas.");
define("_ES_NOSID", "No se indic&oacute; un SID. No se pudo exportar la encuesta");

//EXPORT RESULTS
define("_EX_FROMSTATS", "Filtrado del Script de Estad&iacute;sticas");
define("_EX_HEADINGS", "Preguntas");
define("_EX_ANSWERS", "Respuestas");
define("_EX_FORMAT", "Formato");
define("_EX_HEAD_ABBREV", "Cabeceras Abreviadas");
define("_EX_HEAD_FULL", "Cabeceras Completas");
define("_EX_ANS_ABBREV", "C&oacute;digos de las Respuestas");
define("_EX_ANS_FULL", "Respuestas Completas");
define("_EX_FORM_WORD", "Microsoft Word");
define("_EX_FORM_EXCEL", "Microsoft Excel");
define("_EX_FORM_CSV", "CSV Delimitado por Comas");
define("_EX_EXPORTDATA", "Exportar los Datos");
define("_EX_COLCONTROLS", "Column Control"); //New for 0.98rc7
define("_EX_TOKENCONTROLS", "Token Control"); //New for 0.98rc7
define("_EX_COLSELECT", "Choose columns"); //New for 0.98rc7
define("_EX_COLOK", "Choose the columns you wish to export. Leave all unselected to export all columns."); //New for 0.98rc7
define("_EX_COLNOTOK", "Your survey contains more than 255 columns of responses. Spreadsheet applications such as Excel are limited to loading no more than 255. Select the columns you wish to export in the list below."); //New for 0.98rc7
define("_EX_TOKENMESSAGE", "Your survey can export associated token data with each response. Select any additional fields you would like to export."); //New for 0.98rc7
define("_EX_TOKSELECT", "Choose Token Fields"); //New for 0.98rc7

//IMPORT SURVEY MESSAGES
define("_IS_FAILUPLOAD", "Ha ocurrido un error al subir el archivo. Puede ser causado porque el directorio de administraci&oacute;n tenga permisos incorrectos.");
define("_IS_OKUPLOAD", "Se subi&oacute; el archivo con &eacute;xito.");
define("_IS_READFILE", "Leyendo el archivo..");
define("_IS_WRONGFILE", "El formato del archivo no es de PHPSurveyor. La importaci&oacute;n fall&oacute;.");
define("_IS_IMPORTSUMMARY", "Resumen de la Importaci&oacute;n de la Encuesta");
define("_IS_SUCCESS", "Se complet&oacute; con &eacute;xito la importaci&oacute;n de la encuesta.");
define("_IS_IMPFAILED", "La importaci&oacute;n de la encuesta fall&oacute;.");
define("_IS_FILEFAILS", "El archivo no contiene un formato PHPSurveyor v�lido.");

//IMPORT GROUP MESSAGES
define("_IG_IMPORTSUMMARY", "Resumen de la Importaci&oacute;n de la Grupo");
define("_IG_SUCCESS", "Se complet&oacute; con &eacute;xito la importaci&oacute;n de la grupo.");
define("_IG_IMPFAILED", "La importaci&oacute;n de la grupo fall&oacute;.");
define("_IG_WRONGFILE", "El archivo no contiene un formato PHPSurveyor v�lido.");

//IMPORT QUESTION MESSAGES
define("_IQ_NOSID", "No se indic&oacute; un SID (Encuesta). No se pudo importar la pregunta.");
define("_IQ_NOGID", "No se indic&oacute; un GID (Grupo). No se pudo importar la pregunta");
define("_IQ_WRONGFILE", "Este archivo no es un archivo de pregunta PHPSurveypr v&aacute;lido. Fall&oacute; la importaci&oacute;n.");
define("_IQ_IMPORTSUMMARY", "Resumen de la Importaci&oacute;n de la Pregunta");
define("_IQ_SUCCESS", "Se complet&oacute; con &eacute;xito la importaci&oacute;n de la pregunta");

//IMPORT LABELSET MESSAGES
define("_IL_DUPLICATE", "There was a duplicate labelset, so this set was not imported. The duplicate will be used instead.");

//BROWSE RESPONSES MESSAGES
define("_BR_NOSID", "No has elegido una encuesta para navegar.");
define("_BR_NOTACTIVATED", "Esta encuesta no ha sido activada. No hay resultados que navegar.");
define("_BR_NOSURVEY", "No se encontr&oacute; ninguna encuesta.");
define("_BR_EDITRESPONSE", "Editar esta entrada");
define("_BR_DELRESPONSE", "Eliminar esta entrada");
define("_BR_DISPLAYING", "Registros Desplegados:");
define("_BR_STARTING", "Empezando desde:");
define("_BR_SHOW", "Mostrar");
define("_DR_RUSURE", "Are you sure you want to delete this entry?"); //New for 0.98rc6

//STATISTICS MESSAGES
define("_ST_FILTERSETTINGS", "Opciones del Filtro");
define("_ST_VIEWALL", "View summary of all available fields"); //New with 0.98rc8
define("_ST_SHOWRESULTS", "View Stats"); //New with 0.98rc8
define("_ST_CLEAR", "Clear"); //New with 0.98rc8
define("_ST_RESPONECONT", "Responses Containing"); //New with 0.98rc8
define("_ST_NOGREATERTHAN", "Number greater than"); //New with 0.98rc8
define("_ST_NOLESSTHAN", "Number Less Than"); //New with 0.98rc8
define("_ST_DATEEQUALS", "Date (YYYY-MM-DD) equals"); //New with 0.98rc8
define("_ST_ORBETWEEN", "OR between"); //New with 0.98rc8
define("_ST_RESULTS", "Results"); //New with 0.98rc8 (Plural)
define("_ST_RESULT", "Result"); //New with 0.98rc8 (Singular)
define("_ST_RECORDSRETURNED", "No of records in this query"); //New with 0.98rc8
define("_ST_TOTALRECORDS", "Total records in survey"); //New with 0.98rc8
define("_ST_PERCENTAGE", "Percentage of total"); //New with 0.98rc8
define("_ST_FIELDSUMMARY", "Field Summary for"); //New with 0.98rc8
define("_ST_CALCULATION", "Calculation"); //New with 0.98rc8
define("_ST_SUM", "Sum"); //New with 0.98rc8 - Mathematical
define("_ST_STDEV", "Standard Deviation"); //New with 0.98rc8 - Mathematical
define("_ST_AVERAGE", "Average"); //New with 0.98rc8 - Mathematical
define("_ST_MIN", "Minimum"); //New with 0.98rc8 - Mathematical
define("_ST_MAX", "Maximum"); //New with 0.98rc8 - Mathematical
define("_ST_Q1", "1st Quartile (Q1)"); //New with 0.98rc8 - Mathematical
define("_ST_Q2", "2nd Quartile (Median)"); //New with 0.98rc8 - Mathematical
define("_ST_Q3", "3rd Quartile (Q3)"); //New with 0.98rc8 - Mathematical
define("_ST_NULLIGNORED", "*Null values are ignored in calculations"); //New with 0.98rc8
define("_ST_QUARTMETHOD", "*Q1 and Q3 calculated using <a href='http://mathforum.org/library/drmath/view/60969.html' target='_blank'>minitab method</a>"); //New with 0.98rc8

//DATA ENTRY MESSAGES
define("_DE_NOMODIFY", "No puede ser modificado");
define("_DE_UPDATE", "Actualizar Entrada");
define("_DE_NOSID", "No has seleccionado una encuesta para la cual realzar la entrada de datos.");
define("_DE_NOEXIST", "La encuesta que seleccionaste no existe");
define("_DE_NOTACTIVE", "Esta encuesta no ha sido activada. Tus respuestas no ser&aacute;n almacenadas.");
define("_DE_INSERT", "Almacenando los Datos");
define("_DE_RECORD", "A la entrada se le asign&oacute; el siguiente id: ");
define("_DE_ADDANOTHER", "Agregar Otro Registro");
define("_DE_VIEWTHISONE", "Ver Este Registro");
define("_DE_BROWSE", "Navegar Contestaciones");
define("_DE_DELRECORD", "Registro Borrado");
define("_DE_UPDATED", "El registro ha sido actualizado.");
define("_DE_EDITING", "Modificando Contestaci&oacute;n");
define("_DE_QUESTIONHELP", "Ayuda sobre esta pregunta");
define("_DE_CONDITIONHELP1", "Contesta esta pregunta solo bajo las siguientes condiciones:");
define("_DE_CONDITIONHELP2", "a la pregunta {QUESTION}, contestaste {ANSWER}"); //This will be a tricky one depending on your languages syntax. {ANSWER} is replaced with ALL ANSWERS, seperated by _DE_OR (OR).
define("_DE_AND", "Y");
define("_DE_OR", "O");
define("_DE_SAVEENTRY", "Save as a partially completed survey"); //New in 0.99dev01
define("_DE_SAVEID", "Identifier:"); //New in 0.99dev01
define("_DE_SAVEPW", "Password:"); //New in 0.99dev01
define("_DE_SAVEPWCONFIRM", "Confirm Password:"); //New in 0.99dev01
define("_DE_SAVEEMAIL", "Email:"); //New in 0.99dev01

//TOKEN CONTROL MESSAGES
define("_TC_TOTALCOUNT", "N&uacute;mero de Registros en la tabla de Tokens:"); //New in 0.98rc4
define("_TC_NOTOKENCOUNT", "Total Sin Token &Uacute;nico:"); //New in 0.98rc4
define("_TC_INVITECOUNT", "Total de Invitaciones Enviadas:"); //New in 0.98rc4
define("_TC_COMPLETEDCOUNT", "Total de Encuestas Completadas:"); //New in 0.98rc4
define("_TC_NOSID", "No has seleccionado una encuesta");
define("_TC_DELTOKENS", "A punto de borrar la tabla de tokens para esta encuesta.");
define("_TC_DELTOKENSINFO", "Si borras esta tabla de tokens, ya no ser&aacute; requerido el uso de tokens para accesar esta encuesta. Se har&aacute; un respaldo de esta tabla si procede. Solo el administrador del sistema tendr&aacute; acceso a esta tabla.");
define("_TC_DELETETOKENS", "Borrar Tokens");
define("_TC_TOKENSGONE", "La tabla de tokens ha sido borrada y los tokens ya no son requeridos para accesar esta encuesta. Una copia de esta tabla ha sido creada y solo el administrador del sistema podr&aacute; accesarla.");
define("_TC_NOTINITIALISED", "No se han inicializado tokens para esta encuesta.");
define("_TC_INITINFO", "Si inicializas tokens para esta encuesta, esta solo ser&aacute; accesible a usuarios que tengan asignados un token.");
define("_TC_INITQ", "&iquest;Desea crear una tabla de tokens para esta encuesta?");
define("_TC_INITTOKENS", "Inicializar Tokens");
define("_TC_CREATED", "Se ha creado una tabla de tokens para esta encuesta.");
define("_TC_DELETEALL", "Borrar todos los tokens");
define("_TC_DELETEALL_RUSURE", "&iquest;Est&aacute; seguro(a) de querer borrar TODOS los tokens?");
define("_TC_ALLDELETED", "Se han borrado todos los tokens");
define("_TC_CLEARINVITES", "Aplicar 'N' a todos los registros con invitaci&oacute;n enviada");
define("_TC_CLEARINV_RUSURE", "&iquest;Est&aacute; seguro(a) de inicializar todas las invitaciones a NO?");
define("_TC_CLEARTOKENS", "Borrar todos los tokens con n&uacute;mero &uacute;nico");
define("_TC_CLEARTOKENS_RUSURE", "&iquest;Est&aacute; seguro de querer borrar todos los tokens con n&uacute;meros &uacute;nicos?");
define("_TC_TOKENSCLEARED", "Todos los tokens con n&uacute;mero &uacute;nico han sido borrados");
define("_TC_INVITESCLEARED", "Todas las entradas con invitaci&oacute;n han sido puestas a N");
define("_TC_EDIT", "Modificar Token");
define("_TC_DEL", "Borrar Token");
define("_TC_DO", "Realizar Encuesta");
define("_TC_VIEW", "Ver Contestaci&oacute;n");
define("_TC_INVITET", "Enviar invitaci&oacute;n (email) a esta entrada");
define("_TC_REMINDT", "Enviar recordatorio (email) a esta entrada");
define("_TC_INVITESUBJECT", "Invitaci&oacute;n para participar en la encuesta {SURVEYNAME}"); //Leave {SURVEYNAME} for replacement in scripts
define("_TC_REMINDSUBJECT", "Recordatorio para participar en la encuesta {SURVEYNAME}"); //Leave {SURVEYNAME} for replacement in scripts
define("_TC_REMINDSTARTAT", "Iniciar en el TID N&uacute;m:");
define("_TC_REMINDTID", "Enviando al TID N&uacute;m:");
define("_TC_CREATETOKENSINFO", "Dando clic a 'Si' generar&aacute; tokens para todos aquellos que esten en la lista y que no se le haya generado un token. &iquest;Es esto correcto?");
define("_TC_TOKENSCREATED", "{TOKENCOUNT} tokens han sido creados."); //Leave {TOKENCOUNT} for replacement in script with the number of tokens created
define("_TC_TOKENDELETED", "Se ha borrado el token.");
define("_TC_SORTBY", "Ordenar por: ");
define("_TC_ADDEDIT", "Agregar o Modificar Token");
define("_TC_TOKENCREATEINFO", "Puedes dejar en blanco esto, y automaticamente generar tokens utilizando 'Crear Tokens'");
define("_TC_TOKENADDED", "Nuevo Token Agregado");
define("_TC_TOKENUPDATED", "Token Actualizado");
define("_TC_UPLOADINFO", "El archivo debe ser CSV est&aacute;ndar (delimitado por comas) sin comillas. La primera l&iacute;nea debe contener la informaci&oacute;n de la cabecera (que ser&aacute; eliminada). Los datos deben estar ordenados como 'nombre, apellido, correo electr&oacute;nico, [token], [attribute1], [attribute2]'.");
define("_TC_UPLOADFAIL", "Archivo del upload no encontrado. Compruebe sus permisos y trayectoria para saber si hay el directorio del upload"); //New for 0.98rc5 (babelfish translation)
define("_TC_IMPORT", "Importando Archivo CSV");
define("_TC_CREATE", "Creando Tokens");
define("_TC_TOKENS_CREATED", "{TOKENCOUNT} Tokens Creados");
define("_TC_NONETOSEND", "No hubo correos electr&oacute;nicos elegibles para enviar. Esto fue causado porque los criterios no se satisficieron - tener direcciones de correo electr&oacute;nico, no haber enviado inivitaciones anteriormente, haber completado la encuesta y tener asignado un token.");
define("_TC_NOREMINDERSTOSEND", "No hubo correos electr&oacute;nicos elegibles para enviar. Esto fue causado porque los criterios no se satisficieron - teniendo la direcci&oacute;n de correo eletr&oacute;nico, haber enviado una invitaci&oacute;n, pero no haber completado la encuesta a&uacute;n.");
define("_TC_NOEMAILTEMPLATE", "No se encontr&oacute; la plantilla para la invitaci&oacute;n. Este archivo debe existir dentro del directorio de plantillas.");
define("_TC_NOREMINDTEMPLATE", "No se encontr&oacute; la plantilla para el recordatorio. Este archivo debe existir dentro del directorio de plantillas.");
define("_TC_SENDEMAIL", "Enviar Invitaciones");
define("_TC_SENDINGEMAILS", "Enviando Invitaciones");
define("_TC_SENDINGREMINDERS", "Enviando Recordatorios");
define("_TC_EMAILSTOGO", "Hay m&aacute;s correos pendientes de ser enviados que pueden ser enviados en un s&oacute;lo viaje. Para continuar enviando da clic abajo.");
define("_TC_EMAILSREMAINING", "Hay {EMAILCOUNT} correos que no han sido enviados."); //Leave {EMAILCOUNT} for replacement in script by number of emails remaining
define("_TC_SENDREMIND", "Enviar Recordatorios");
define("_TC_INVITESENTTO", "Invitaci&oacute;n Enviada a:"); //is followed by token name
define("_TC_REMINDSENTTO", "Recordatorio Enviado a:"); //is followed by token name
define("_TC_UPDATEDB", "Update tokens table with new fields"); //New for 0.98rc7
define("_TC_EMAILINVITE", "Dear {FIRSTNAME},\n\nYou have been invited to participate in a survey.\n\n"
						 ."The survey is titled:\n\"{SURVEYNAME}\"\n\n\"{SURVEYDESCRIPTION}\"\n\n"
						 ."To participate, please click on the link below.\n\nSincerely,\n\n"
						 ."{ADMINNAME} ({ADMINEMAIL})\n\n"
						 ."----------------------------------------------\n"
						 ."Click here to do the survey:\n"
						 ."{SURVEYURL}"); //New for 0.98rc9 - default Email Invitation
define("_TC_EMAILREMIND", "Dear {FIRSTNAME},\n\nRecently we invited you to participate in a survey.\n\n"
						 ."We note that you have not yet completed the survey, and wish to remind you that the survey is still available should you wish to take part.\n\n"
						 ."The survey is titled:\n\"{SURVEYNAME}\"\n\n\"{SURVEYDESCRIPTION}\"\n\n"
						 ."To participate, please click on the link below.\n\nSincerely,\n\n"
						 ."{ADMINNAME} ({ADMINEMAIL})\n\n"
						 ."----------------------------------------------\n"
						 ."Click here to do the survey:\n"
						 ."{SURVEYURL}"); //New for 0.98rc9 - default Email Reminder
define("_TC_EMAILREGISTER", "Dear {FIRSTNAME},\n\n"
						  ."You, or someone using your email address, have registered to "
						  ."participate in an online survey titled {SURVEYNAME}.\n\n"
						  ."To complete this survey, click on the following URL:\n\n"
						  ."{SURVEYURL}\n\n"
						  ."If you have any questions about this survey, or if you "
						  ."did not register to participate and believe this email "
						  ."is in error, please contact {ADMINNAME} at {ADMINEMAIL}.");//NEW for 0.98rc9
define("_TC_EMAILCONFIRM", "Dear {FIRSTNAME},\n\nThis email is to confirm that you have completed the survey titled {SURVEYNAME} "
						  ."and your response has been saved. Thank you for participating.\n\n"
						  ."If you have any further questions about this email, please contact {ADMINNAME} on {ADMINEMAIL}.\n\n"
						  ."Sincerely,\n\n"
						  ."{ADMINNAME}"); //New for 0.98rc9 - Confirmation Email

//labels.php
define("_LB_NEWSET", "Crear Nuevo Conjunto de Etiquetas");
define("_LB_EDITSET", "Modificar Conjunto de Etiquetas");
define("_LB_FAIL_UPDATESET", "No se pudo actualizar el conjunto de etiquetas");
define("_LB_FAIL_INSERTSET", "No se pudo agregar el nuevo conjunto de etiquetas");
define("_LB_FAIL_DELSET", "No se pudo borrar el conjunto de etiquetas - Hay preguntas que dependen de ellas. Debe borrar estas preguntas primero antes de poder continuar.");
define("_LB_ACTIVEUSE", "No puedes cambiar los c&oacute;digos, agregar o borrar entradas a este conjunto de etiquetas porque est&aacute; siendo utilizado por una encuesta activa.");
define("_LB_TOTALUSE", "Algunas encuestas est&aacute;n utilizando este conjunto de etiquetas. El modificar los c&oacute;digos, agregar o borrar entradas a este conjunto puede producir resultados indeseados.");
//Export Labels
define("_EL_NOLID", "No se indic&oacute; el LID. No se puede exportar el conjunto de etiquetas.");
//Import Labels
define("_IL_GOLABELADMIN", "Regresar a la Administraci&oacute;n de Etiquetas");

//PHPSurveyor System Summary
define("_PS_TITLE", "Res&uacute;men de PHPSurveyor");
define("_PS_DBNAME", "Nombre de la Base de Datos");
define("_PS_DEFLANG", "Idioma Default");
define("_PS_CURLANG", "Idioma Actual");
define("_PS_USERS", "Usuarios");
define("_PS_ACTIVESURVEYS", "Encuestas Activas");
define("_PS_DEACTSURVEYS", "Encuestas Desactivadas");
define("_PS_ACTIVETOKENS", "Tablas de Tokens Activadas");
define("_PS_DEACTTOKENS", "Tablas de Tokens Desactivadas");
define("_PS_CHECKDBINTEGRITY", "Check PHPSurveyor Data Integrity"); //New with 0.98rc8

//Notification Levels
define("_NT_NONE", "Ninguna notificaci�n del email"); //New with 098rc5
define("_NT_SINGLE", "Notificaci�n b�sica del email"); //New with 098rc5
define("_NT_RESULTS", "Env�e la notificaci�n del email con c�digos del resultado"); //New with 098rc5

//CONDITIONS TRANSLATIONS
define("_CD_CONDITIONDESIGNER", "Condition Designer"); //New with 098rc9
define("_CD_ONLYSHOW", "Only show question {QID} IF"); //New with 098rc9 - {QID} is repleaced leave there
define("_CD_AND", "AND"); //New with 098rc9
define("_CD_COPYCONDITIONS", "Copy Conditions"); //New with 098rc9
define("_CD_CONDITION", "Condition"); //New with 098rc9
define("_CD_ADDCONDITION", "Add Condition"); //New with 098rc9
define("_CD_EQUALS", "Equals"); //New with 098rc9
define("_CD_COPYRUSURE", "Are you sure you want to copy these condition(s) to the questions you have selected?"); //New with 098rc9
define("_CD_NODIRECT", "You cannot run this script directly."); //New with 098rc9
define("_CD_NOSID", "You have not selected a Survey."); //New with 098rc9
define("_CD_NOQID", "You have not selected a Question."); //New with 098rc9
define("_CD_DIDNOTCOPYQ", "Did not copy questions"); //New with 098rc9
define("_CD_NOCONDITIONTOCOPY", "No condition selected to copy from"); //New with 098rc9
define("_CD_NOQUESTIONTOCOPYTO", "No question selected to copy condition to"); //New with 098rc9

//TEMPLATE EDITOR TRANSLATIONS
define("_TP_CREATENEW", "Create new template"); //New with 098rc9
define("_TP_NEWTEMPLATECALLED", "Create new template called:"); //New with 098rc9
define("_TP_DEFAULTNEWTEMPLATE", "NewTemplate"); //New with 098rc9 (default name for new template)
define("_TP_CANMODIFY", "This template can be modified"); //New with 098rc9
define("_TP_CANNOTMODIFY", "This template cannot be modified"); //New with 098rc9
define("_TP_RENAME", "Rename this template");  //New with 098rc9
define("_TP_RENAMETO", "Rename this template to:"); //New with 098rc9
define("_TP_COPY", "Make a copy of this template");  //New with 098rc9
define("_TP_COPYTO", "Create a copy of this template called:"); //New with 098rc9
define("_TP_COPYOF", "copy_of_"); //New with 098rc9 (prefix to default copy name)
define("_TP_FILECONTROL", "File Control:"); //New with 098rc9
define("_TP_STANDARDFILES", "Standard Files:");  //New with 098rc9
define("_TP_NOWEDITING", "Now editing:");  //New with 098rc9
define("_TP_OTHERFILES", "Other Files:"); //New with 098rc9
define("_TP_PREVIEW", "Preview:"); //New with 098rc9
define("_TP_DELETEFILE", "Delete"); //New with 098rc9
define("_TP_UPLOADFILE", "Upload"); //New with 098rc9
define("_TP_SCREEN", "Screen:"); //New with 098rc9
define("_TP_WELCOMEPAGE", "Welcome Page"); //New with 098rc9
define("_TP_QUESTIONPAGE", "Question Page"); //New with 098rc9
define("_TP_SUBMITPAGE", "Submit Page");
define("_TP_COMPLETEDPAGE", "Completed Page"); //New with 098rc9
define("_TP_CLEARALLPAGE", "Clear All Page"); //New with 098rc9
define("_TP_REGISTERPAGE", "Register Page"); //New with 098finalRC1
define("_TP_EXPORT", "Export Template"); //New with 098rc10
define("_TP_LOADPAGE", "Load Page"); //New with 0.99dev01
define("_TP_SAVEPAGE", "Save Page"); //New with 0.99dev01

//Saved Surveys
define("_SV_RESPONSES", "Saved Responses:");
define("_SV_IDENTIFIER", "Identifier");
define("_SV_RESPONSECOUNT", "Answered");
define("_SV_IP", "IP Address");
define("_SV_DATE", "Date Saved");
define("_SV_REMIND", "Remind");
define("_SV_EDIT", "Edit");

//VVEXPORT/IMPORT
define("_VV_IMPORTFILE", "Import a VV survey file");
define("_VV_EXPORTFILE", "Export a VV survey file");
define("_VV_FILE", "File:");
define("_VV_SURVEYID", "Survey ID:");
define("_VV_EXCLUDEID", "Exclude record IDs?");
define("_VV_INSERT", "When an imported record matches an existing record ID:");
define("_VV_INSERT_ERROR", "Report an error (and skip the new record).");
define("_VV_INSERT_RENUMBER", "Renumber the new record.");
define("_VV_INSERT_IGNORE", "Ignore the new record.");
define("_VV_INSERT_REPLACE", "Replace the existing record.");
define("_VV_DONOTREFRESH", "Important Note:<br />Do NOT refresh this page, as this will import the file again and produce duplicates");
define("_VV_IMPORTNUMBER", "Total records imported:");
define("_VV_ENTRYFAILED", "Import Failed on Record");
define("_VV_BECAUSE", "because");
define("_VV_EXPORTDEACTIVATE", "Export, then de-activate survey");
define("_VV_EXPORTONLY", "Export but leave survey active");
define("_VV_RUSURE", "If you have chosen to export and de-activate, this will rename your current responses table and it will not be easy to restore it. Are you sure?");

//ASSESSMENTS
define("_AS_TITLE", "Assessments");
define("_AS_DESCRIPTION", "If you create any assessments in this page, for the currently selected survey, the assessment will be performed at the end of the survey after submission");
define("_AS_NOSID", "No SID Provided");
define("_AS_SCOPE", "Scope");
define("_AS_MINIMUM", "Minimum");
define("_AS_MAXIMUM", "Maximum");
define("_AS_GID", "Group");
define("_AS_NAME", "Name/Header");
define("_AS_HEADING", "Heading");
define("_AS_MESSAGE", "Message");
define("_AS_URL", "URL");
define("_AS_SCOPE_GROUP", "Group");
define("_AS_SCOPE_TOTAL", "Total");
define("_AS_ACTIONS", "Actions");
define("_AS_EDIT", "Edit");
define("_AS_DELETE", "Delete");
define("_AS_ADD", "Add");
define("_AS_UPDATE", "Update");
?>
