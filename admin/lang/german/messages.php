<?php
// GERMAN TRANSLATION KINDLY PROVIDED BY DANIEL EGGEL, RALPH KAMPMANN, CARSTEN SCHMITZ
// Last Update: 02/23/2005 Carsten Schmitz
//BUTTON BAR TITLES
define("_ADMINISTRATION", "Administration");
define("_SURVEY", "Befragung");
define("_GROUP", "Gruppe");
define("_QUESTION", "Frage");
define("_ANSWERS", "Antworten");
define("_CONDITIONS", "Bedingungen");
define("_HELP", "Hilfe");
define("_USERCONTROL", "Benutzer-Administration");
define("_ACTIVATE", "Befragung aktivieren");
define("_DEACTIVATE", "Befragung deaktivieren");
define("_CHECKFIELDS", "Datenbankfelder �berpr�fen");
define("_CREATEDB", "Erstelle Datenbank");
define("_CREATESURVEY", "Erstelle Umfrage");
define("_SETUP", "PHPSurveyor Einrichten");
define("_DELETESURVEY", "Umfrage l�schen");
define("_EXPORTQUESTION", "Fragen exportieren");
define("_EXPORTSURVEY", "Umfrage exportieren");
define("_EXPORTLABEL", "Beschriftung-Set exportieren");
define("_IMPORTQUESTION", "Fragen importieren");
define("_IMPORTGROUP", "Gruppen importieren");
define("_IMPORTSURVEY", "Umfrage importieren");
define("_IMPORTLABEL", "Beschriftung-Set importieren");
define("_EXPORTRESULTS", "Antworten exportieren");
define("_BROWSERESPONSES", "Antworten anzeigen");
define("_BROWSESAVED", "Gespeicherte Antworten anzeigen");
define("_STATISTICS", "Statistiken");
define("_VIEWRESPONSE", "Antwort anzeigen");
define("_VIEWCONTROL", "Ansicht der Daten");
define("_DATAENTRY", "Dateneingabe");
define("_TOKENCONTROL", "Probanden Steuerung");
define("_TOKENDBADMIN", "Probanden Datenbank-Administration");
define("_DROPTOKENS", "Probandentabelle l�schen");
define("_EMAILINVITE", "Einladung an Probanden versenden");
define("_EMAILREMIND", "Erinnerung an Probanden versenden");
define("_TOKENIFY", "Probanden erstellen");
define("_UPLOADCSV", "Komma getrennte Datei (CSV) hochladen");
define("_LABELCONTROL", "Beschriftung-Set Administration");
define("_LABELSET", "Beschriftung-Set");
define("_LABELANS", "Antworten");
define("_OPTIONAL", "Optional");

//DROPDOWN HEADINGS
define("_SURVEYS", "Umfragen");
define("_GROUPS", "Gruppen");
define("_QUESTIONS", "Fragen");
define("_QBYQ", "Frage f�r Frage");
define("_GBYG", "Gruppe f�r Gruppe");
define("_SBYS", "Alles auf einer Seite");
define("_LABELSETS", "Beschriftung-Sets");

//BUTTON MOUSEOVERS
//Administration bar
define("_A_HOME_BT", "Haupt-Administrationsseite");
define("_A_SECURITY_BT", "Sicherheitseinstellungen �ndern");
define("_A_BADSECURITY_BT", "Sicherheit aktivieren");
define("_A_CHECKDB_BT", "Datenbank �berpr�fen");
define("_A_DELETE_BT", "Gesamte Umfrage l�schen");
define("_A_ADDSURVEY_BT", "Neue Umfrage erstellen/importieren");
define("_A_HELP_BT", "Hilfe anzeigen");
define("_A_CHECKSETTINGS", "System�bersicht");
define("_A_BACKUPDB_BT", "Datenbank sichern");
define("_A_TEMPLATES_BT", "Vorlagen-Editor");
//Survey bar
define("_S_ACTIVE_BT", "Diese Umfrage ist momentan aktiv.");
define("_S_INACTIVE_BT", "Diese Umfrage ist momentan nicht aktiv.");
define("_S_ACTIVATE_BT", "Diese Umfrage aktivieren");
define("_S_DEACTIVATE_BT", "Diese Umfrage deaktivieren");
define("_S_CANNOTACTIVATE_BT", "Diese Umfrage kann nicht aktiviert werden.");
define("_S_DOSURVEY_BT", "Umfrage ausf�hren/testen");
define("_S_DATAENTRY_BT", "Dateneingabemaske f�r die Umfrage");
define("_S_PRINTABLE_BT", "Druckbare Version der Umfrage");
define("_S_EDIT_BT", "Diese Umfrage bearbeiten");
define("_S_DELETE_BT", "Diese Umfrage l�schen");
define("_S_EXPORT_BT", "Diese Umfrage exportieren");
define("_S_BROWSE_BT", "Ergebnisse dieser Umfrage ansehen");
define("_S_TOKENS_BT", "Probanden aktivieren/bearbeiten f�r diese Umfrage");
define("_S_ADDGROUP_BT", "Neue Gruppe hinzuf�gen");
define("_S_MINIMISE_BT", "Details verstecken f�r diese Umfrage");
define("_S_MAXIMISE_BT", "Details anzeigen f�r diese Umfrage");
define("_S_CLOSE_BT", "Diese Umfrage schliessen");
define("_S_SAVED_BT", "Zeige zwischengespeicherte Antworten"); 
define("_S_ASSESSMENT_BT", "Bewertungsregeln setzen"); 

//Group bar
define("_G_EDIT_BT", "Diese Gruppe bearbeiten");
define("_G_EXPORT_BT", "Diese Gruppe exportieren");
define("_G_DELETE_BT", "Diese Gruppe l�schen");
define("_G_ADDQUESTION_BT", "Neue Frage zu dieser Gruppe hinzuf�gen");
define("_G_MINIMISE_BT", "Details dieser Gruppe verstecken");
define("_G_MAXIMISE_BT", "Details dieser Gruppe anzeigen");
define("_G_CLOSE_BT", "Diese Gruppe schliessen");
//Question bar
define("_Q_EDIT_BT", "Diese Frage bearbeiten");
define("_Q_COPY_BT", "Diese Frage kopieren");
define("_Q_DELETE_BT", "Diese Frage l�schen");
define("_Q_EXPORT_BT", "Diese Frage exportieren");
define("_Q_CONDITIONS_BT", "Bedingungen f�r diese Frage setzten");
define("_Q_ANSWERS_BT", "Antworten hinzuf�gen/bearbeiten f�r diese Frage");
define("_Q_LABELS_BT", "Vordefinierte Beschriftung-Sets hinzuf�gen/bearbeiten");
define("_Q_MINIMISE_BT", "Details verstecken f�r diese Frage");
define("_Q_MAXIMISE_BT", "Details anzeigen f�r diese Frage");
define("_Q_CLOSE_BT", "Diese Frage schliessen");
//Browse Button Bar
define("_B_ADMIN_BT", "Zur Umfragen-Administration zur�ckkehren");
define("_B_SUMMARY_BT", "Zeige Zusammenfassung");
define("_B_ALL_BT", "Zeige Antworten an");
define("_B_LAST_BT", "Zeige die letzten 50 Antworten");
define("_B_STATISTICS_BT", "Zeige Statistiken dieser Antworten an");
define("_B_EXPORT_BT", "Resultate f�r Applikation exportieren");
define("_B_BACKUP_BT", "Backup der Resultate-Tabelle als SQL-Datei");
//Tokens Button Bar
define("_T_ALL_BT", "Zeige Probanden an");
define("_T_ADD_BT", "Neuen Probanden hinzuf�gen");
define("_T_IMPORT_BT", "Import von Probanden von einer CSV-Datei");
define("_T_EXPORT_BT", "Export von Probanden CSV-Datei");
define("_T_INVITE_BT", "Sende E-Mail Einladung");
define("_T_REMIND_BT", "Sende E-Mail Erinnerung");
define("_T_TOKENIFY_BT", "Generiere eindeutige Probanden-Nummer");
define("_T_KILL_BT", "Probanden-Tabelle l�schen");
//Labels Button Bar
define("_L_ADDSET_BT", "Neues Beschriftung-Set hinzuf�gen");
define("_L_EDIT_BT", "Beschriftung-Set bearbeiten");
define("_L_DEL_BT", "Beschriftung-Set l�schen");
//Datacontrols
define("_D_BEGIN", "Zeige ersten..");
define("_D_BACK", "Zeige vorherigen..");
define("_D_FORWARD", "Zeige n�chsten..");
define("_D_END", "Zeige letzten..");

//DATA LABELS
//Surveys
define("_SL_TITLE", "Titel:");
define("_SL_SURVEYURL", "URL dieser Umfrage:");
define("_SL_DESCRIPTION", "Beschreibung:");
define("_SL_WELCOME", "Willkommenstext:");
define("_SL_ADMIN", "Administrator Name:");
define("_SL_EMAIL", "Administrator Email:");
define("_SL_FAXTO", "Faxnummer:");
define("_SL_ANONYMOUS", "Anonym?");
define("_SL_EXPIRES", "Umfrage endet am:");
define("_SL_FORMAT", "Format:");
define("_SL_DATESTAMP", "Zeit-/Datumsstempel?");
define("_SL_TEMPLATE", "Vorlage:");
define("_SL_LANGUAGE", "Sprache:");
define("_SL_LINK", "Link:");
define("_SL_URL", "End-URL:");
define("_SL_URLDESCRIP", "URL-Beschreibung:");
define("_SL_STATUS", "Status:");
define("_SL_SELSQL", "SQL-Datei ausw�hlen:");
define("_SL_USECOOKIES", "Cookies benutzen?");
define("_SL_NOTIFICATION", "Benachrichtigung:");
define("_SL_ALLOWREGISTER", "Offene Registrierung erlauben?");
define("_SL_ATTRIBUTENAMES", "Probanden Schl�ssel:");
define("_SL_EMAILINVITE_SUBJ", "Einladungs-Email Betreff:"); 
define("_SL_EMAILINVITE", "Text der Einladungs-Email:");
define("_SL_EMAILREMIND_SUBJ", "Erinnerungs-Email Betreff:"); 
define("_SL_EMAILREMIND", "Text der Erinnerungs-Email:");
define("_SL_EMAILREGISTER_SUBJ", "Offene Registrierung Email Betreff:");
define("_SL_EMAILREGISTER", "Text der Registrierungs-Email:");
define("_SL_EMAILCONFIRM_SUBJ", "Best�tigungs-Email Betreff:"); 
define("_SL_EMAILCONFIRM", "Text der Best�tigung-Email:");
define("_SL_REPLACEOK", "Der bestehende Text wird ersetzt. Fortfahren?");
define("_SL_ALLOWSAVE", "Zwischenspeichern erlauben?");
define("_SL_AUTONUMBER", "ID Nummern starten bei:");
define("_SL_AUTORELOAD", "URL automatisch laden, wenn die Umfrage abgeschlossen ist?"); 
define("_SL_ALLOWPREV", "[<< Zur�ck] Button zeigen"); 
define("_SL_USE_DEFAULT","Standardwerte setzen");
define("_SL_UPD_SURVEY","Umfrage aktualisieren");

//groups
define("_GL_TITLE", "Titel:");
define("_GL_DESCRIPTION", "Beschreibung:");
//Frages
define("_QL_CODE", "Code:");
define("_QL_QUESTION", "Frage:");
define("_QL_HELP", "Hilfetext:");
define("_QL_VALIDATION", "Validierung:");
define("_QL_TYPE", "Typ:");
define("_QL_GROUP", "Gruppe:");
define("_QL_MANDATORY", "Pflichtangabe:");
define("_QL_OTHER", "'Sonstige:' Angabe m�glich:");
define("_QL_LABELSET", "Beschriftung-Set:");
define("_QL_COPYANS", "Fragen kopieren?");
define("_QL_QUESTIONATTRIBUTES", "Frage-Attribute:"); 
define("_QL_COPYATT", "Attribute kopieren?");
//answers
define("_AL_CODE", "Code");
define("_AL_ANSWER", "Antwort");
define("_AL_DEFAULT", "Vorgew�hlt");
define("_AL_MOVE", "Bewegen");
define("_AL_ACTION", "Aktion");
define("_AL_UP", "Hoch");
define("_AL_DN", "Runter");
define("_AL_SAVE", "Speichern");
define("_AL_DEL", "L�schen");
define("_AL_ADD", "Hinzuf�gen");
define("_AL_FIXSORT", "Sort Check");
define("_AL_SORTALPHA", "Alph. Sortieren"); // Sort Answers Alphabetically
//users
define("_UL_USER", "Benutzer");
define("_UL_PASSWORD", "Passwort");
define("_UL_SECURITY", "Sicherheit");
define("_UL_ACTION", "Aktion");
define("_UL_EDIT", "Bearbeiten");
define("_UL_DEL", "L�schen");
define("_UL_ADD", "Hinzuf�gen");
define("_UL_TURNOFF", "Sicherheit deaktivieren");
//tokens
define("_TL_FIRST", "Vorname");
define("_TL_LAST", "Name");
define("_TL_EMAIL", "E-Mail");
define("_TL_TOKEN", "Token");
define("_TL_INVITE", "Eingeladen?");
define("_TL_DONE", "Ausgef�llt?");
define("_TL_ACTION", "Aktionen");
define("_TL_ATTR1", "Attribute_1");
define("_TL_ATTR2", "Attribute_2");
define("_TL_MPID", "MPID");
//labels
define("_LL_NAME", "Name setzen");
define("_LL_CODE", "Code");
define("_LL_ANSWER", "Titel");
define("_LL_SORTORDER", "Reihenfolge");
define("_LL_ACTION", "Aktion");

//Frage TYPES
define("_5PT", "5 Punkte Auswahl");
define("_DATE", "Datum");
define("_GENDER", "Geschlecht");
define("_LIST", "Liste (Optionsfelder)");
define("_LIST_DROPDOWN", "Liste (Klappbox)"); 
define("_LISTWC", "Liste mit Kommentar");
define("_MULTO", "Mehrfachauswahl");
define("_MULTOC", "Mehrfachauswahl mit Kommentar");
define("_MULTITEXT", "Mehrfache kurze Texte");
define("_NUMERICAL", "Zahleneingabe");
define("_RANK",  "Reihenfolge");
define("_STEXT", "Kurzer freier Text");
define("_LTEXT", "Langer freier Text");
define("_HTEXT", "Ausf�hrlicher Freitext"); 
define("_YESNO", "Ja/Nein");
define("_ARR5",  "Feld (5 Punkte Auswahl)");
define("_ARR10", "Feld (10 Punkte Auswahl)");
define("_ARRYN", "Feld (Ja/Nein/Unsicher)");
define("_ARRMV", "Feld (Zunahme, gleich, Abnahme)");
define("_ARRFL", "Feld (Flexible Beschriftungen)");
define("_ARRFLC","Array (Flexible Beschriftungen) nach Spalte");
define("_SINFL", "Einfach (Flexible Beschriftungen)");
define("_EMAIL", "E-Mail Adresse"); 
define("_BOILERPLATE", "Textbaustein (nur Anzeige)");
define("_LISTFL_DROPDOWN", "Liste (Flexible Beschriftungen) (Klappbox)"); 
define("_LISTFL_RADIO", "Liste (Flexible Beschriftungen) (Optionsfelder)");

//GENERAL WORDS AND PHRASES
define("_AD_YES", "Ja");
define("_AD_NO", "Nein");
define("_AD_CANCEL", "Abbrechen");
define("_AD_CHOOSE", "Bitte ausw�hlen..");
define("_AD_OR", "oder");
define("_ERROR", "Fehler");
define("_SUCCESS", "Erfolgreich");
define("_REQ", "*Pflichtangabe");
define("_ADDS", "Umfrage hinzuf�gen");
define("_ADDG", "Gruppe hinzuf�gen");
define("_ADDQ", "Frage hinzuf�gen");
define("_ADDA", "Frage hinzuf�gen");
define("_COPYQ", "Frage kopieren");
define("_ADDU", "Benutzer hinzuf�gen");
define("_SEARCH", "Suchen");
define("_SAVE", "�nderungen abspeichern");
define("_NONE", "keine"); //as in "Do not display anything"", "or none chosen";
define("_GO_ADMIN", "Zur�ck zur Hauptseite"); //text to display to return/display main administration screen
define("_CONTINUE", "Weiter");
define("_WARNING", "Warnung!");
define("_USERNAME", "Benutzername");
define("_PASSWORD", "Passwort");
define("_DELETE", "L�schen");
define("_CLOSEWIN", "Fenster schliessen");
define("_TOKEN", "Probanden");
define("_DATESTAMP", "Zeitstempel"); //Referring to the datestamp or time response submitted
define("_COMMENT", "Kommentar");
define("_FROM", "Von"); //For emails
define("_SUBJECT", "Betreff"); //For emails
define("_MESSAGE", "Meldung"); //For emails
define("_RELOADING", "Seite wird neu geladen. Bitte warten.");
define("_ADD", "hinzuf�gen");
define("_UPDATE", "aktualisieren");
define("_BROWSE", "Ansehen");
define("_AND", "und");
define("_SQL", "SQL");
define("_PERCENTAGE", "Prozent");
define("_COUNT", "Anzahl");

//Survey STATUS MESSAGES
define("_SS_NOGROUPS", "Anzahl Gruppen in der Umfrage:");
define("_SS_NOQUESTS", "Anzahl Fragen in der Umfrage:");
define("_SS_ANONYMOUS", "Dies ist eine anonyme Umfrage.");
define("_SS_TRACKED", "Diese Umfrage ist nicht anonym.");
define("_SS_DATESTAMPED", "Antworten werden mit einem Zeitstempel versehen.");
define("_SS_COOKIES", "Es werden Cookies f�r die Zugriffskontrolle benutzt.");
define("_SS_QBYQ", "Es wird Frage f�r Frage gestellt.");
define("_SS_GBYG", "Es wird Gruppe f�r Gruppe angezeigt.");
define("_SS_SBYS", "Die ganze Umfrage wird auf einer einzigen Seite angezeigt.");
define("_SS_ACTIVE", "Die Umfrage ist momentan aktiv.");
define("_SS_NOTACTIVE", "Die Umfrage ist momentan nicht aktiv.");
define("_SS_SURVEYTABLE", "Name der Umfrage-Tabelle:");
define("_SS_CANNOTACTIVATE", "Die Umfrage kann noch nicht aktiviert werden.");
define("_SS_ADDGROUPS", "Sie m�ssen Gruppen hinzuf�gen.");
define("_SS_ADDQUESTS", "Sie m�ssen Fragen hinzuf�gen.");
define("_SS_ALLOWREGISTER", "Wenn Zugangsschl�ssel benutzt werden, kann man sich f�r diesen Fragebogen selbst registrieren.");
define("_SS_ALLOWSAVE", "Teilehmer k�nnen teilweise fertiggestellte Umfrage zwischenspeichern."); 

//QUESTION STATUS MESSAGES
define("_QS_MANDATORY", "Pflichtfrage");
define("_QS_OPTIONAL", "Optionale Frage");
define("_QS_NOANSWERS", "Noch keine Antworten definiert");
define("_QS_NOLID", "Sie m�ssen ein Beschriftung-Set f�r diese Frage ausw�hlen");
define("_QS_COPYINFO", "Anmerkung: Sie M�SSEN einen neuen Frage-Code eingeben");

//General Setup Messages
define("_ST_NODB1", "Die angegebene PHPSurveyor Datenbank existiert nicht.");
define("_ST_NODB2", "Entweder wurde die angegebene Datenbank noch nicht erstellt oder es gibt ein anderes Problem beim Zugriff.");
define("_ST_NODB3", "PHPSurveyor kann versuchen diese Datenbank f�r Sie zu erstellen.");
define("_ST_NODB4", "Ihr gew�hlter Datenbankname ist:");
define("_ST_CREATEDB", "Datenbank erstellen");

//USER CONTROL MESSAGES
define("_UC_CREATE", "Standard htaccess Datei erstellen");
define("_UC_NOCREATE", "Konnte htaccess Datei nicht erstellen. Bitte in der Datei config.php die Einstellungen f�r \$homedir �berpr�fen, und die Schreibrechte im Verzeichnis �berpr�fen.");
define("_UC_SEC_DONE", "Sicherheitseinstellung vorgenommen!");
define("_UC_CREATE_DEFAULT", "Erstelle standard Benutzer");
define("_UC_UPDATE_TABLE", "Aktualisiere Benutzer-Tabelle");
define("_UC_HTPASSWD_ERROR", "Beim Erstellen der Datei 'htpasswd' ist ein Fehler aufgetreten.");
define("_UC_HTPASSWD_EXPLAIN", "Falls Sie einen Windows Server benutzen, m�ssen Sie die Datei htpasswd.exe von Apache in das admin Verzeichnis von PHPSurveyor kopieren, damit dies einwandfrei funktioniert. Diese Datei ist im Normalfall unter /apache group/apache/bin/ zu finden.");
define("_UC_SEC_REMOVE", "Sicherheitseinstellungen entfernen");
define("_UC_ALL_REMOVED", "Zugangsdatei (.htaccess), Passwortdatei (htpasswd) und Benutzerdatenbank gel�scht.");
define("_UC_ADD_USER", "Benutzer hinzuf�gen");
define("_UC_ADD_MISSING", "Konnte Benutzer nicht hinzuf�gen. Benutzername und/oder Passwort wurde nicht angegeben.");
define("_UC_DEL_USER", "L�sche Benutzer");
define("_UC_DEL_MISSING", "Konnte Benutzer nicht l�schen. Kein Benutzername angegeben.");
define("_UC_MOD_USER", "�ndere Benutzer");
define("_UC_MOD_MISSING", "Konnte Benutzer nicht ab�ndern. Benutzername und/oder Passwort wurden nicht angegeben.");
define("_UC_TURNON_MESSAGE1", "Sie haben die Sicherheitseinstellungen f�r das Umfrage-System noch nicht initialisiert. Dadurch ist der Administrator-Zugang v�llig ungesch�tzt!</p>\nWenn Sie unten auf 'Sicherheitseinstellungen initialisieren' klicken, werden standardm��ige Apache-Sicherheitseinstellungen zum Admin-Verzeichnis hinzugef�gt. Sie ben�tigen dann den Standard-Benutzernamen und Passwort, um auf die Admin-Seiten zu gelangen.");
define("_UC_TURNON_MESSAGE2", "Nach der Initialisierung der Sicherheitseinstellungen sollten sie unbedingt das Standard-Passwort neu setzen.");
define("_UC_INITIALISE", "Initialisiere Sicherheitseinstellungen");
define("_UC_NOUSERS", "Es sind momentan keine Benutzer angelegt. Wir empfehlen, dass die die Sicherheit ausschalten. Sie k�nnen sie dann wieder einschalten.");
define("_UC_TURNOFF", "Sicherheit ausschalten");

//Activate and deactivate messages
define("_AC_MULTI_NOANSWER", "Diese Frage ist vom Typ 'Mehrere Antworten', hat aber noch keine Antworten definiert.");
define("_AC_NOTYPE", "Diese Frage hat den Frage-Typ nicht gesetzt.");
define("_AC_NOLID", "Diese Frage ben�tigt ein Beschriftung-Set, aber es wurde keines angegeben.");
define("_AC_CON_OUTOFORDER", "Diese Frage hat eine Bedingung. Die Bedingung basiert jedoch auf einer Frage, die im Ablauf NACH dieser Frage kommt.");
define("_AC_FAIL", "Die Umfrage besteht den Test auf Konsistenz nicht.");
define("_AC_PROBS", "Folgende Probleme wurden gefunden:");
define("_AC_CANNOTACTIVATE", "Die Umfrage kann nicht aktiviert werden, solange diese Probleme nicht gel�st sind.");
define("_AC_READCAREFULLY", "Lesen Sie dies sorgf�ltig durch, bevor Sie fortfahren.");
define("_AC_ACTIVATE_MESSAGE1", "Sie sollten eine Umfrage nur aktivieren, wenn Sie ganz sicher sind, dass ihre Fragen komplett sind und keine �nderungen mehr notwendig sind.");
define("_AC_ACTIVATE_MESSAGE2", "Sobald eine Umfrage einmal aktiviert ist, k�nnen Sie nicht mehr:<ul><li>Gruppen hinzuf�gen oder l�schen</li><li>Antworten f�r Mehrfachauswahl-Fragen hinzuf�gen oder l�schen</li><li>Fragen hinzuf�gen oder l�schen</li></ul>");
define("_AC_ACTIVATE_MESSAGE3", "Jedoch k�nnen Sie immer noch:<ul><li>Ihre Frage-Codes, Frage-Text oder Frage-Typ �ndern</li><li>Die Gruppennamen �ndern</li><li>Vordefinierte Antworten hinzuf�gen, �ndern, l�schen (ausser f�r Mehrfachauswahl-Fragen)</li><li>Den Umfrage Namen oder die Beschreibung �ndern.</li></ul>");
define("_AC_ACTIVATE_MESSAGE4", "Sobald Daten in die Umfrage eingegeben wurden und Sie Gruppen oder Fragen noch hinzuf�gen oder l�schen wollen, m�ssen Sie die Umfrage deaktivieren. Dies hat zur Folge, dass alle eingegebenen Daten in eine separate Archiv-Tabelle verschoben werden.");
define("_AC_ACTIVATE", "Aktivieren");
define("_AC_ACTIVATED", "Die Umfrage wurde aktiviert. Die Ergebnis-Tabelle wurde erfolgreich erstellt.");
define("_AC_NOTACTIVATED", "Die Umfrage konnte nicht aktiviert werden.");
define("_AC_NOTPRIVATE", "Dies ist keine anonyme Umfrage, d.h. eine Probanden-Tabelle muss ebenfalls erstellt werden.");
define("_AC_REGISTRATION", "Diese Umfrage erlaubt �ffentliche Registrierungen. Daher muss eine Zugangsschl�ssel-Tabelle angelegt werden.");
define("_AC_CREATETOKENS", "Initialisiere Probanden...");
define("_AC_SURVEYACTIVE", "Diese Umfrage ist jetzt aktiv und Antworten k�nnen erfasst werden.");
define("_AC_DEACTIVATE_MESSAGE1", "In einer aktiven Umfrage wird eine Tabelle erstellt, welche alle Daten-Eingaben aufnimmt.");
define("_AC_DEACTIVATE_MESSAGE2", "Wenn Sie eine Umfrage deaktivieren, werden alle eingegebenen Daten von der Original-Tabelle in eine andere Tabelle verschoben. Wenn Sie dann die Umfrage wieder aktivieren, wird die Original-Tabelle und damit die Umfrage leer sein. <B>Es ist dann nicht mehr m�glich auf die alte Tabelle mit PHPSurveyor zuzugreifen.</B>");
define("_AC_DEACTIVATE_MESSAGE3", "Deaktivierte Umfrage-Daten k�nnen nur durch einen Systemadministrator mit Hilfe eines MySQL-Tools wie beispielsweise PHPMyAdmin eingesehen werden. Falls Ihre Umfrage eine Probandentabelle benutzt, so wird auch diese umbenannt und ist folglich nur mehr einem Systemadministrator zug�nglich.");
define("_AC_DEACTIVATE_MESSAGE4", "Ihre Antworten-Tabelle wird wie folgt umbenannt:");
define("_AC_DEACTIVATE_MESSAGE5", "Sie sollten Ihre Antworten exportieren, bevor Sie die Umfrage deaktivieren. Klicken Sie auf \"Abbrechen\", um zur Hauptseite zur�ckzukehren, ohne diese Umfrage zu deaktivieren.");
define("_AC_DEACTIVATE", "Umfrage deaktivieren");
define("_AC_DEACTIVATED_MESSAGE1", "Die Antworten-Tabelle wurde umbenannt zu: ");
define("_AC_DEACTIVATED_MESSAGE2", "Die Antworten dieser Umfrage sind nicht mehr verf�gbar in PHPSurveyor.");
define("_AC_DEACTIVATED_MESSAGE3", "Sie sollten sich den Namen dieser Tabelle notieren, falls Sie diese Daten sp�ter noch brauchen.");
define("_AC_DEACTIVATED_MESSAGE4", "Die Probanden-Tabelle, die mit dieser Umfrage verkn�pft war, wurde wie folgt umbenannt: ");

//CHECKFIELDS
define("_CF_CHECKTABLES", "�berpr�fe Tabellen");
define("_CF_CHECKFIELDS", "�berpr�fe Felder in den Tabellen");
define("_CF_CHECKING", "�berpr�fe");
define("_CF_TABLECREATED", "Tabelle erstellt");
define("_CF_FIELDCREATED", "Feld erstellt");
define("_CF_OK", "OK");
define("_CFT_PROBLEM", "Einige Tabellen oder Felder scheinen in Ihrer Datenbank zu fehlen.");

//CREATE DATABASE (createdb.php)
define("_CD_DBCREATED", "Datenbank wurde erstellt.");
define("_CD_POPULATE_MESSAGE", "Bitte klicken Sie auf 'Tabellen erstellen' um fortzufahren.");
define("_CD_POPULATE", "Tabellen erstellen");
define("_CD_NOCREATE", "Konnte Datenbank nicht erstellen");
define("_CD_NODBNAME", "Datenbank Information nicht angegeben. Dieses Skript muss von admin.php aufgerufen werden.");

//DATABASE MODIFICATION MESSAGES
define("_DB_FAIL_GROUPNAME", "Gruppe konnte nicht hinzugef�gt werden. Der Gruppenname wurde nicht angegeben.");
define("_DB_FAIL_GROUPUPDATE", "Gruppe konnte nicht aktualisiert werden.");
define("_DB_FAIL_GROUPDELETE", "Gruppe konnte nicht gel�scht werden.");
define("_DB_FAIL_NEWQUESTION", "Frage konnte nicht erstellt werden.");
define("_DB_FAIL_QUESTIONTYPECONDITIONS", "Frage konnte nicht aktualisiert werden. Es gibt Bedingungen in anderen Fragen, welche von den Antworten auf diese Frage abh�ngen - dadurch gibt es Probleme beim �ndern des Typs. Sie m�ssen diese Bedingung l�schen, bevor Sie den Typ dieser Frage �ndern k�nnen.");
define("_DB_FAIL_QUESTIONUPDATE", "Frage konnte nicht aktualisiert werden.");
define("_DB_FAIL_QUESTIONDELCONDITIONS", "Frage konnte nicht gel�scht werden. Es gibt Bedingungen in anderen Fragen, welche von den Antworten auf diese Frage abh�ngen. Sie k�nnen diese Frage nicht l�schen, solange diese Bedingungen nicht entfernt wurden.");
define("_DB_FAIL_QUESTIONDELETE", "Frage konnte nicht gel�scht werden.");
define("_DB_FAIL_NEWANSWERMISSING", "Antwort konnte nicht hinzugef�gt werden. Sie m�ssen einen Code und eine Antwort eingeben.");
define("_DB_FAIL_NEWANSWERDUPLICATE", "Antwort konnte nicht hinzugef�gt werden. Es gibt schon eine Antwort mit diesem Code.");
define("_DB_FAIL_ANSWERUPDATEMISSING", "Antwort konnte nicht aktualisiert werden. Sie m�ssen einen Code f�r diese Frage angeben.");
define("_DB_FAIL_ANSWERUPDATEDUPLICATE", "Antwort konnte nicht aktualisiert werden. Es gibt schon eine Antwort mit diesem Code.");
define("_DB_FAIL_ANSWERUPDATECONDITIONS", "Antwort konnte nicht aktualisiert werden. Sie haben den Antwort Code abge�ndert. Es gibt aber Bedingungen zu anderen Fragen, welche vom Code dieser Frage abh�ngen. Sie m�ssen diese Bedingungen l�schen, bevor Sie diesen Antwort-Code �ndern k�nnen.");
define("_DB_FAIL_ANSWERDELCONDITIONS", "Antwort konnte nicht gel�scht werden. Es gibt Bedingungen zu anderen Fragen, welche vom Code dieser Frage abh�ngen. Sie m�ssen diese Bedingungen l�schen, bevor Sie diesen Antwort-Code �ndern k�nnen.");
define("_DB_FAIL_NEWSURVEY_TITLE", "Umfrage konnte nicht erstellt werden. Bitte geben Sie einen Titel f�r diese Umfrage an.");
define("_DB_FAIL_NEWSURVEY", "Umfrage konnte nicht erstellt werden.");
define("_DB_FAIL_SURVEYUPDATE", "Umfrage konnte nicht aktualisiert werden.");
define("_DB_FAIL_SURVEYDELETE", "Umfrage konnte nicht gel�scht werden.");

//DELETE Umfrage MESSAGES
define("_DS_NOSID", "Sie haben keine Umfrage zum L�schen ausgew�hlt.");
define("_DS_DELMESSAGE1", "Sie sind im Begriff, diese Umfrage zu l�schen...");
define("_DS_DELMESSAGE2", "Damit werden diese Umfrage und alle verkn�pften Gruppen, Fragen, Antworten und Bedingungen gel�scht.");
define("_DS_DELMESSAGE3", "Wir empfehlen Ihnen, bevor Sie die Umfrage l�schen, die Umfrage zu exportieren.");
define("_DS_SURVEYACTIVE", "Diese Umfrage ist aktiv und eine Antworten-Tabelle existiert. Wenn Sie diese Umfrage l�schen, werden auch die Antworten gel�scht. Wir empfehlen Ihnen, dass Sie die Antworten exportieren, bevor Sie die Umfrage l�schen.");
define("_DS_SURVEYTOKENS", "Diese Umfrage hat eine zugeh�rige Probanden-Tabelle. Wenn Sie diese Umfrage l�schen, wird auch die Probandentabelle gel�scht. Wir empfehlen Ihnen, dass Sie die Probanden exportieren, bevor Sie die Umfrage l�schen.");
define("_DS_DELETED", "Diese Umfrage wurde gel�scht.");

//DELETE QUESTION AND GROUP MESSAGES
define("_DG_RUSURE", "Das L�schen dieser Gruppe l�scht auch alle m�glichen Fragen und Antworten, die sie enth�lt. Sind Sie sicher, dass Sie fortfahren m�chten?");
define("_DQ_RUSURE", "Das L�schen dieser Frage l�scht auch alle m�glichen Antworten, die sie umfasst. Sind Sie sicher, dass Sie fortfahren m�chten?");

//EXPORT MESSAGES
define("_EQ_NOQID", "Es wurde keine QID angegeben. Kann Frage nicht exportieren.");
define("_ES_NOSID", "Es wurde keine SID angegeben. Kann Umfrage nicht exportieren.");

//EXPORT RESULTS
define("_EX_FROMSTATS", "Gefiltert vom Statistik Skript");
define("_EX_HEADINGS", "Fragen");
define("_EX_ANSWERS", "Antworten");
define("_EX_FORMAT", "Format");
define("_EX_HEAD_ABBREV", "Abgek�rzte Beschriftungen");
define("_EX_HEAD_FULL", "Vollst�ndige Beschriftungen");
define("_EX_ANS_ABBREV", "Antwort Codes");
define("_EX_ANS_FULL", "Vollst�ndige Antworten");
define("_EX_FORM_WORD", ".doc - Microsoft Word");
define("_EX_FORM_EXCEL", ".xls - Microsoft Excel");
define("_EX_FORM_CSV", ".csv - Komma-Separierte Textdatei");
define("_EX_EXPORTDATA", "Daten exportieren");
define("_EX_COLCONTROLS", "Spalten Kontrolle");
define("_EX_TOKENCONTROLS", "Token Kontrolle");
define("_EX_COLSELECT", "Spalten ausw�hlen");
define("_EX_COLOK", "W�hlen Sie die Spalten, die Sie exportieren wollen. W�hlen Sie KEINE aus, um alle zu exportieren.");
define("_EX_COLNOTOK", "Ihre Umfrage enth�lt mehr als 255 Antwortspalten. Spreadsheet Programme wie Excel importieren max. 255 Spalten. W�hlen Sie die zu exportierenden Spalten aus der unten stehenden Liste.");
define("_EX_TOKENMESSAGE", "Ihre Umfragedaten k�nnen mit den zugeordneten Token exportiert werden. W�hlen Sie zus�tzliche Felder, die mit exportiert werden sollen.");
define("_EX_TOKSELECT", "W�hlen Sie die Token Felder.");

//IMPORT Umfrage MESSAGES
define("_IS_FAILUPLOAD", "Es ist ein Fehler aufgetreten beim Upload ihrer Datei. Grund daf�r k�nnten fehlerhafte Einstellungen der Berechtigungen des admin Ordners sein.");
define("_IS_OKUPLOAD", "Datei erfolgreich hochgeladen.");
define("_IS_READFILE", "Lese Datei..");
define("_IS_WRONGFILE", "Diese Datei ist keine PHPSurveyor-Umfrage-Datei. Import fehlgeschlagen.");
define("_IS_IMPORTSUMMARY", "Umfragen-Import �bersicht");
define("_IS_SUCCESS", "Import der Umfrage abgeschlossen.");
define("_IS_IMPFAILED", "Import dieser Umfrage-Datei fehlgeschlagen.");
define("_IS_FILEFAILS", "Diese Datei enth�lt keine PHPSurveyor-Daten im richtigen Format.");

//IMPORT GRUPPE MESSAGES
define("_IG_IMPORTSUMMARY", "Gruppen-Import �bersicht");
define("_IG_SUCCESS", "Import der Gruppe abgeschlossen.");
define("_IG_IMPFAILED", "Import dieser Gruppen-Datei fehlgeschlagen");
define("_IG_WRONGFILE", "Diese Datei enth�lt keine PHPSurveyor-Daten im richtigen Format.");

//IMPORT Question MESSAGES
define("_IQ_NOSID", "keine SID (Umfrage) angegeben. Kann Frage nicht importieren.");
define("_IQ_NOGID", "keine GID (Gruppe) angegeben. Kann Frage nicht importieren.");
define("_IQ_WRONGFILE", "Diese Datei ist keine PHPSurveyor-Umfrage-Datei. Import fehlgeschlagen.");
define("_IQ_IMPORTSUMMARY", "Fragen-Import �bersicht");
define("_IQ_SUCCESS", "Import der Frage abgeschlossen");

//IMPORT LABELSET MESSAGES
define("_IL_DUPLICATE", "There was a duplicate labelset, so this set was not imported. The duplicate will be used instead.");

//BROWSE RESPONSES MESSAGES
define("_BR_NOSID", "Sie haben keine Befragung zum Anzeigen ausgew�hlt.");
define("_BR_NOTACTIVATED", "Diese Befragung wurde noch nicht aktiviert. Es gibt keine Antworten, die Sie anschauen k�nnten.");
define("_BR_NOSURVEY", "Es gibt keine entsprechende Befragung.");
define("_BR_EDITRESPONSE", "Diesen Eintrag bearbeiten");
define("_BR_DELRESPONSE", "Diesen Eintrag l�schen");
define("_BR_DISPLAYING", "Angezeigte Datens�tze:");
define("_BR_STARTING", "Start von:");
define("_BR_SHOW", "Anzeigen");
define("_DR_RUSURE", "Sind Sie sicher, dass Sie diesen Eintrag l�schen wollen?");

//STATISTICS MESSAGES
define("_ST_FILTERSETTINGS", "Filter Einstellungen");
define("_ST_VIEWALL", "Zusammenfassung aller zur Verf�gung stehenden Felder anzeigen");
define("_ST_SHOWRESULTS", "Statistik anzeigen");
define("_ST_CLEAR", "L�schen");
define("_ST_RESPONECONT", "Antworten enthalten");
define("_ST_NOGREATERTHAN", "Werte gr��er als");
define("_ST_NOLESSTHAN", "Werte kleiner als");
define("_ST_DATEEQUALS", "Datum (YYYY-MM-DD) ist gleich");
define("_ST_ORBETWEEN", "ODER zwischen");
define("_ST_RESULTS", "Ergebnisse");
define("_ST_RESULT", "Ergebnis");
define("_ST_RECORDSRETURNED", "Anzahl der Datens�tze in dieser Abfrage");
define("_ST_TOTALRECORDS", "Gesamtzahl der Datens�tze dieser Umfrage");
define("_ST_PERCENTAGE", "Anteil in Prozent");
define("_ST_FIELDSUMMARY", "Feld Zusammenfassung f�r");
define("_ST_CALCULATION", "Berechnung");
define("_ST_SUM", "Summe"); // Mathematical
define("_ST_STDEV", "Standard Abweichung"); // Mathematical
define("_ST_AVERAGE", "Durchschnitt"); // Mathematical
define("_ST_MIN", "Minimum"); // Mathematical
define("_ST_MAX", "Maximum"); // Mathematical
define("_ST_Q1", "1ter Viertelwert (Q1 unteres Quartil)"); // Mathematical
define("_ST_Q2", "2ter Viertelwert (Mittleres Quartil)"); // Mathematical
define("_ST_Q3", "3ter Viertelwert (Q3 Oberes Quartil)"); // Mathematical
define("_ST_NULLIGNORED", "*0 Werte werden in Berechnungen ausgelassen");
define("_ST_QUARTMETHOD", "*Q1 und Q3 wurden nach der <a href='http://mathforum.org/library/drmath/view/60969.html' target='_blank'>'minitab' Methode</a> berechnet");

//DATA ENTRY MESSAGES
define("_DE_NOMODIFY", "Kann nicht ge�ndert werden.");
define("_DE_UPDATE", "Eintrag aktualisieren");
define("_DE_NOSID", "Sie haben keine Umfrage zur Dateneingabe ausgew�hlt.");
define("_DE_NOEXIST", "Die ausgew�hlte Umfrage existiert nicht.");
define("_DE_NOTACTIVE", "Diese Umfrage ist noch nicht aktiviert. Ihre Antwort kann nicht abgespeichert werden");
define("_DE_INSERT", "Daten einf�gen");
define("_DE_RECORD", "Dem Eintrag wurde folgende Datensatz-ID zugewiesen: ");
define("_DE_ADDANOTHER", "Einen weiteren Datensatz hinzuf�gen");
define("_DE_VIEWTHISONE", "Diesen Datensatz anzeigen");
define("_DE_BROWSE", "Antworten durchsehen");
define("_DE_DELRECORD", "Datensatz gel�scht");
define("_DE_UPDATED", "Datensatz aktualisiert.");
define("_DE_EDITING", "Antwort �ndern");
define("_DE_QUESTIONHELP", "Hilfe zu dieser Frage");
define("_DE_CONDITIONHELP1", "Beantworten Sie diese Frage nur, wenn folgende Bedingungen erf�llt sind:"); 
define("_DE_CONDITIONHELP2", "Die Frage {QUESTION} haben sie mit {ANSWER} beantwortet"); //This will be a tricky one depending on your languages syntax. {ANSWER} is replaced with ALL ANSWERS, seperated by _DE_OR (OR).
define("_DE_AND", "UND");
define("_DE_OR", "ODER");
define("_DE_SAVEENTRY", "Teilweise beantworteten Fragebogen zwischenspeichern");
define("_DE_SAVEID", "Name:"); 
define("_DE_SAVEPW", "Passwort:");
define("_DE_SAVEPWCONFIRM", "Passwort best�tigen:"); 
define("_DE_SAVEEMAIL", "Email:"); 

//TOKEN CONTROL MESSAGES
define("_TC_TOTALCOUNT", "Anzahl Probanden");
define("_TC_NOTOKENCOUNT", "Anzahl Probanden ohne Zugangsschl�ssel");
define("_TC_INVITECOUNT", "Anzahl Eingeladene Probanden");
define("_TC_COMPLETEDCOUNT", "Anzahl ausgef�llte Umfragen");
define("_TC_NOSID", "Sie haben keine Umfrage ausgew�hlt.");
define("_TC_DELTOKENS", "Sie sind im Begriff die Probandentabelle zu l�schen.");
define("_TC_DELTOKENSINFO", "Wenn Sie diese Probandentabelle l�schen, sind keine Zugangsschl�ssel mehr n�tig, um auf die Umfrage zuzugreifen. Wenn Sie fortfahren, wird eine Sicherheitskopie dieser Tabelle erstellt. Der Systemadministrator kann dann auf diese Daten zugreifen.");
define("_TC_DELETETOKENS", "L�sche die Probandentabelle");
define("_TC_TOKENSGONE", "Die Probandentabelle wurde gel�scht, und es sind jetzt keine Zugangsschl�ssel mehr n�tig, um die Umfrage auszuf�llen. Eine Sicherheitskopie dieser Tabelle wurde erstellt. Der Systemadministrator kann auf diese Daten zugreifen.");
define("_TC_NOTINITIALISED", "Die Zugangsschl�ssel wurden f�r diese Umfrage noch nicht initialisiert.");
define("_TC_INITINFO", "Wenn Sie Tokens initialisieren f�r diese Umfrage, wird die Umfrage nur mehr mit einem g�ltigen Token ausf�llbar sein.");
define("_TC_INITQ", "M�chten Sie eine Probandentabelle mit Zugangsschl�sseln f�r diese Umfrage erstellen?");
define("_TC_INITTOKENS", "Zugangsschl�ssel initialisieren");
define("_TC_CREATED", "Es wurde eine Probandentabelle f�r diese Umfrage erstellt.");
define("_TC_DELETEALL", "Alle Probanden-Eintr�ge l�schen.");
define("_TC_DELETEALL_RUSURE", "Sind Sie wirklich sicher, dass Sie ALLE Probanden-Eintr�ge l�schen wollen?");
define("_TC_ALLDELETED", "Alle Probanden-Eintr�ge wurden gel�scht.");
define("_TC_CLEARINVITES", "Setze 'Eingeladen' auf Nein f�r alle Eintr�ge.");
define("_TC_CLEARINV_RUSURE", "Sind sie wirklich sicher, dass Sie f�r ALLE Eintr�ge den Einladungsstatus auf Nein zur�cksetzen m�chten?");
define("_TC_CLEARTOKENS", "Alle Zugangsschl�ssel entfernen");
define("_TC_CLEARTOKENS_RUSURE", "Sind sie wirklich sicher, dass Sie ALLE Zugangsschl�ssel entfernen wollen?");
define("_TC_TOKENSCLEARED", "Alle Zugangsschl�ssel wurden entfernt.");
define("_TC_INVITESCLEARED", "Alle Einladungs-Eintr�ge wurden auf Nein zur�ckgesetzt.");
define("_TC_EDIT", "Proband bearbeiten");
define("_TC_DEL", "Proband l�schen");
define("_TC_DO", "Umfrage ausf�hren");
define("_TC_VIEW", "Antwort anzeigen");
define("_TC_INVITET", "Sende eine Einladungs-E-Mail f�r diesen Eintrag");
define("_TC_REMINDT", "Sende eine Erinnerungs-E-Mail f�r diesen Eintrag");
define("_TC_INVITESUBJECT", "Einladung zur Teilnahme an der Umfrage {SURVEYNAME}"); //Leave {SurveyNAME} for replacement in scripts
define("_TC_REMINDSUBJECT", "Erinnerung zur Teilnahme an der Umfrage {SURVEYNAME}"); //Leave {SurveyNAME} for replacement in scripts
define("_TC_REMINDSTARTAT", "Start mit TID-Nr:");
define("_TC_REMINDTID", "Sende an TID-Nr:");
define("_TC_CREATETOKENSINFO", "Wenn Sie auf Ja klicken, wird f�r alle Probanden ohne eindeutigen Zugangsschl�ssel ein entsprechende Schl�ssel generiert. OK?");
define("_TC_TOKENSCREATED", "{TOKENCOUNT} Zugangsschl�ssel wurden generiert"); //Leave {TOKENCOUNT} for replacement in script with the number of tokens created
define("_TC_TOKENDELETED", "Zugangsschl�ssel wurde gel�scht.");
define("_TC_SORTBY", "Sortieren nach: ");
define("_TC_ADDEDIT", "Proband hinzuf�gen oder bearbeiten");
define("_TC_TOKENCREATEINFO", "Sie k�nnen dieses Feld leer lassen und automatisch eindeutige Zugangsschl�ssel generieren lassen mit 'Generiere eindeutige Zugangsschl�ssel'");
define("_TC_TOKENADDED", "Neuer Proband hinzugef�gt");
define("_TC_TOKENUPDATED", "Proband aktualisiert");
define("_TC_UPLOADINFO", "Die Datei sollte eine Standard CSV-Datei sein (Komma-getrennt und ohne Anf�hrungszeichen). Die erste Zeile sollte Feldnamen enthalten (diese werden entfernt). Die Daten/Felder sollten in folgender Reihenfolge sein: 'vorname, name, email, [token], [attribute1], [attribute2]'.");
define("_TC_UPLOADFAIL", "Hochgeladene Datei nicht gefunden. �berpr�fen Sie Ihre Berechtigung und den Pfad des Upload-Verzeichnisses.");
define("_TC_IMPORT", "Importiere CSV-Datei");
define("_TC_CREATE", "Erstelle Zugangsschl�ssel-Eintr�ge");
define("_TC_TOKENS_CREATED", "{TOKENCOUNT} Eintr�ge erstellt");
define("_TC_NONETOSEND", "Es wurden keine E-Mails versendet, da kein Proband die folgenden Bedingungen erf�llt hat:<UL><LI>E-Mail Adresse vorhanden</LI><LI>Einladung nicht schon versendet</LI><LI>Die Umfrage noch nicht ausgef�llt</LI><LI>Eindeutiger Zugangsschl�ssel zugewiesen</LI></UL>.");
define("_TC_NOREMINDERSTOSEND", "Es wurden keine E-Mails versendet, da kein Proband die folgenden Bedingungen erf�llt hat:<UL><LI>E-Mail Adresse vorhanden</LI><LI>Einladung nicht schon versendet</LI><LI>Die Umfrage noch nicht ausgef�llt</LI><LI>Eindeutiger Zugangsschl�ssel zugewiesen</LI></UL>.");
define("_TC_NOEMAILTEMPLATE", "Vorlage f�r Einladungen nicht gefunden. Diese Datei muss im Standard Vorlagen-Ordner existieren.");
define("_TC_NOREMINDTEMPLATE", "Vorlage f�r Erinnerungen nicht gefunden. Diese Datei muss im Standard Vorlagen-Ordner existieren.");
define("_TC_SENDEMAIL", "Sende Einladungen");
define("_TC_SENDINGEMAILS", "Sende Einladungen...");
define("_TC_SENDINGREMINDERS", "Sende Erinnerungen..");
define("_TC_EMAILSTOGO", "Es sind mehr Mails zu versenden, als auf einmal versendbar sind. Unten klicken um weiter zu senden.");
define("_TC_EMAILSREMAINING", "Es sind noch {EMAILCOUNT} E-Mails zu versenden."); //Leave {EMAILCOUNT} for replacement in script by number of emails remaining
define("_TC_SENDREMIND", "Sende Erinnerungen");
define("_TC_INVITESENTTO", "Einladung versandt an:"); //is followed by token name
define("_TC_REMINDSENTTO", "Erinnerung versandt an:"); //is followed by token name
define("_TC_UPDATEDB", "Zugangsschl�ssel-Tabelle mit neuen Feldern aktualisieren");
define("_TC_EMAILINVITE_SUBJ", "Einladung zur Teilnahme an einer Umfrage"); 
define("_TC_EMAILINVITE", "Hallo {FIRSTNAME},\n\nHiermit m�chten wir Sie zu einer Umfrage einladen.\n\n"
                         ."Der Titel der Umfrage ist \n\"{SURVEYNAME}\"\n\n\"{SURVEYDESCRIPTION}\"\n\n"
                         ."Um an dieser Umfrage teilzunehmen, klicken Sie bitte auf den unten stehenden Link.\n\n Mit freundlichen Gr�ssen,\n\n"
                         ."{ADMINNAME} ({ADMINEMAIL})\n\n"
                         ."----------------------------------------------\n"
                         ."Klicken Sie hier um die Umfrage zu starten:\n"
                         ."{SURVEYURL}");
define("_TC_EMAILREMIND_SUBJ", "Erinnerung an Teilnahme an einer Umfrage");
define("_TC_EMAILREMIND", "Hallo {FIRSTNAME},\n\nVor kurzem haben wir Sie zu einer Umfrage eingeladen.\n\n"
                         ."Zu unserem Bedauern haben wir bemerkt, dass Sie die Umfrage noch nicht ausgef�llt haben. Wir m�chten Ihnen mitteilen, dass die Umfrage noch aktiv ist und w�rden uns freuen, wenn Sie teilnehmen k�nnten.\n\n"
                         ."Der Titel der Umfrage ist \n\"{SURVEYNAME}\"\n\n\"{SURVEYDESCRIPTION}\"\n\n"
                         ."Um an dieser Umfrage teilzunehmen, klicken Sie bitte auf den unten stehenden Link.\n\n Mit freundlichen Gr�ssen,\n\n"
                         ."{ADMINNAME} ({ADMINEMAIL})\n\n"
                         ."----------------------------------------------\n"
                         ."Klicken Sie hier um die Umfrage zu starten:\n"
                         ."{SURVEYURL}");
define("_TC_EMAILREGISTER_SUBJ", "Registrierungsbest�tigung f�r Teilnahmeumfrage");
define("_TC_EMAILREGISTER", "Hallo {FIRSTNAME},\n\n"
                          ."Sie (oder jemand, der Ihre Email benutzt hat) haben sich f�r eine Umfrage "
                          ."mit dem Titel {SURVEYNAME} angemeldet.\n\n"
                          ."Um an dieser Umfrage teilzunehmen, klicken Sie bitte auf den folgenden Link.\n\n"
                          ."{SURVEYURL}\n\n"
                          ."Wenn Sie irgendwelche Fragen zu dieser Umfrage haben oder wenn Sie sich _nicht_ "
                          ."f�r diese Umfrage angemeldet haben und sie glauben, dass Ihnen diese Email irrt�mlicherweise "
                          ."zugeschickt worden ist, kontaktieren Sie bitte {ADMINNAME} unter {ADMINEMAIL}.");
define("_TC_EMAILCONFIRM_SUBJ", "Abschlussbest�tigung einer Umfrage"); 
define("_TC_EMAILCONFIRM", "Hallo {FIRSTNAME},\n\nVielen Dank f�r die Teilnahme an der Umfrage mit dem Titel {SURVEYNAME}. "
                          ."Ihre Antworten wurden bei uns gespeichert.\n\n"
                          ."Wenn Sie irgendwelche Fragen zu dieser Email haben, kontaktieren Sie bitte {ADMINNAME} unter {ADMINEMAIL}.\n\n"
                          ."Mit freundlichen Gr�ssen,\n\n"
                          ."{ADMINNAME}");

//labels.php
define("_LB_NEWSET", "Neues Beschriftung-Set");
define("_LB_EDITSET", "Beschriftung-Set bearbeiten");
define("_LB_FAIL_UPDATESET", "Aktualisieren des Beschriftung-Set fehlgeschlagen");
define("_LB_FAIL_INSERTSET", "Einf�gen eines neuen Beschriftung-Sets fehlgeschlagen");
define("_LB_FAIL_DELSET", "Konnte Beschriftung-Set nicht l�schen - Es gibt Fragen, die auf diesem Beschriftung-Set basieren. Sie m�ssen zuerst diese Fragen l�schen.");
define("_LB_ACTIVEUSE", "Sie k�nnen die Codes nicht �ndern und keine Eintr�ge hinzuf�gen oder l�schen, weil dieses Beschriftung-Set in einer aktiven Umfrage benutzt wird.");
define("_LB_TOTALUSE", "Mindestens eine Umfrage benutzt momentan dieses Beschriftung-Set. �ndern der Codes, Hinzuf�gen oder L�schen von Eintr�gen dieses Beschriftung-Set kann ungewollte Ergebnisse nach sich ziehen.");
//Export Labels
define("_EL_NOLID", "Keine LID angegeben. Kann Beschriftung-Set nicht exportieren.");
//Import Labels
define("_IL_GOLABELADMIN", "Zur�ck zur Beschriftung-Set Administration");

//PHPSurveyor System Summary 
define("_PS_TITLE", "PHPSurveyor System�bersicht");
define("_PS_DBNAME", "Datenbank-Name");
define("_PS_DEFLANG", "Standard Sprache");
define("_PS_CURLANG", "Aktuelle Sprache");
define("_PS_USERS", "Benutzer");
define("_PS_ACTIVESURVEYS", "Aktive Befragungen");
define("_PS_DEACTSURVEYS", "Deaktivierte Befragungen");
define("_PS_ACTIVETOKENS", "Aktive Probanden-Tabellen");
define("_PS_DEACTTOKENS", "Deaktivierte Probanden-Tabellen");
define("_PS_CHECKDBINTEGRITY", "PHPSurveyor Datenintegrit�t �berpr�fen");

//Notification Levels
define("_NT_NONE", "Keine Best�tigung per Email.");
define("_NT_SINGLE", "Normale Best�tigung per Email.");
define("_NT_RESULTS", "Ausf�hrliche Best�tigung per Email mit Ergebnissen.");

//CONDITIONS TRANSLATIONS
define("_CD_CONDITIONDESIGNER", "Bedingungs Designer");
define("_CD_ONLYSHOW", "Zeige die Frage {QID} nur, WENN"); // {QID} is repleaced leave there
define("_CD_AND", "AND");
define("_CD_COPYCONDITIONS", "Bedingung kopieren");
define("_CD_CONDITION", "Bedingung");
define("_CD_ADDCONDITION", "Bedingung hinzuf�gen");
define("_CD_EQUALS", "Ergibt");
define("_CD_COPYRUSURE", "Sind sie sicher, dass sie diese Bedingung zu den gew�hlten Fragen kopieren wollen?");
define("_CD_NODIRECT", "Dieses Script kann nicht direkt gestartet werden.");
define("_CD_NOSID", "Sie haben keine Umfrage ausgew�hlt.");
define("_CD_NOQID", "Sie haben keine Frage ausgew�hlt.");
define("_CD_DIDNOTCOPYQ", "Fragen wurden nicht kopiert");
define("_CD_NOCONDITIONTOCOPY", "Keine Bedingung zum Kopieren ausgew�hlt");
define("_CD_NOQUESTIONTOCOPYTO", "Keine Zielfrage zum Kopieren der Bedingung ausgew�hlt");

//TEMPLATE EDITOR TRANSLATIONS
define("_TP_CREATENEW", "Neue Vorlage erstellen");
define("_TP_NEWTEMPLATECALLED", "Name der neuen Vorlage:");
define("_TP_DEFAULTNEWTEMPLATE", "NeueVorlage"); // (default name for new template)
define("_TP_CANMODIFY", "Diese Vorlage kann bearbeitet werden.");
define("_TP_CANNOTMODIFY", "Diese Vorlage kann nicht bearbeitet werden.");
define("_TP_RENAME", "Vorlage umbenennen");
define("_TP_RENAMETO", "Vorlage umbenennen nach:");
define("_TP_COPY", "Vorlage kopieren");
define("_TP_COPYTO", "Name f�r die Vorlagenkopie:");
define("_TP_COPYOF", "Kopie_von_"); // (prefix to default copy name)
define("_TP_FILECONTROL", "Dateiansicht:");
define("_TP_STANDARDFILES", "Standard-Dateien:");
define("_TP_NOWEDITING", "In Bearbeitung:");
define("_TP_OTHERFILES", "Andere Dateien:");
define("_TP_PREVIEW", "Vorschau:");
define("_TP_DELETEFILE", "L�schen");
define("_TP_UPLOADFILE", "Hochladen");
define("_TP_SCREEN", "Vorlagen in Vorschau:");
define("_TP_WELCOMEPAGE", "Startseite");
define("_TP_QUESTIONPAGE", "Fragen-Seite");
define("_TP_SUBMITPAGE", "Senden-Seite");
define("_TP_COMPLETEDPAGE", "Abschluss-Seite");
define("_TP_CLEARALLPAGE", "Erneut-Seite");
define("_TP_REGISTERPAGE", "Registrierungs-Seite");
define("_TP_EXPORT", "Vorlage exportieren");
define("_TP_LOADPAGE", "Seite laden"); 
define("_TP_SAVEPAGE", "Seite speichern"); 

//Saved Surveys
define("_SV_RESPONSES", "Zwischengespeicherte Antworten:");
define("_SV_IDENTIFIER", "Identifizierung");
define("_SV_RESPONSECOUNT", "Beantwortet");
define("_SV_IP", "IP-Addresse");
define("_SV_DATE", "Datum Gespeichert");
define("_SV_REMIND", "Erinnerung senden");
define("_SV_EDIT", "Bearbeiten");

//VVEXPORT/IMPORT
define("_VV_IMPORTFILE", "VV-Umfrage-Datei importieren");
define("_VV_EXPORTFILE", "VV-Umfrage-Datei exportieren");
define("_VV_FILE", "Datei:");
define("_VV_SURVEYID", "Umfrage ID:");
define("_VV_EXCLUDEID", "Datensatz IDs auslassen?");
define("_VV_INSERT", "Wenn ein importierter Datensatz mit einer bestehenden Datensatz-ID �bereinstimmt:");
define("_VV_INSERT_ERROR", "Fehler anzeigen (und den neuen Datensatz �berspringen).");
define("_VV_INSERT_RENUMBER", "Neue ID dem Datensatz zuweisen.");
define("_VV_INSERT_IGNORE", "Neuen Datensatz ignorieren.");
define("_VV_INSERT_REPLACE", "Alten Datensatz ersetzen.");
define("_VV_DONOTREFRESH", "Achtung:<br />Diese Seite bitte NICHT aktualisieren, da ansonsten die Datei nochmal importiert wird und Duplikate erzeugt werden");
define("_VV_IMPORTNUMBER", "Anzahl Datens�tze importiert:");
define("_VV_ENTRYFAILED", "Import fehlgeschlagen f�r Datensatz");
define("_VV_BECAUSE", "Grund:");
define("_VV_EXPORTDEACTIVATE", "Exportieren, dann Umfrage deaktivieren");
define("_VV_EXPORTONLY", "Nur exportieren und Umfrage aktiv lassen");
define("_VV_RUSURE", "Sofern Sie 'Exportieren, dann Umfrage deaktivieren' ausgew�hlt haben, wird Ihre gegenw�rtige Antwortentabelle umbenannt und es ist nicht einfach diese wiederherzustellen. Sind sie sicher, dass SIe das wollen?");

//ASSESSMENTS
define("_AS_TITLE", "Bewertungen");
define("_AS_DESCRIPTION", "Sofern Sie auf dieser Seite Bewertungen anlegen, werden diese Bewertung am Ende eine Umfrage nach dem Abschicken durchgef�hrt.");
define("_AS_NOSID", "Keine SID angegeben");
define("_AS_SCOPE", "Bereich");
define("_AS_MINIMUM", "Minimum");
define("_AS_MAXIMUM", "Maximum");
define("_AS_GID", "Gruppe");
define("_AS_NAME", "Name/Header");
define("_AS_HEADING", "�berschrift");
define("_AS_MESSAGE", "Nachricht");
define("_AS_URL", "URL");
define("_AS_SCOPE_GROUP", "Gruppe");
define("_AS_SCOPE_TOTAL", "Gesamt");
define("_AS_ACTIONS", "Aktionen");
define("_AS_EDIT", "Bearbeiten");
define("_AS_DELETE", "L�schen");
define("_AS_ADD", "Hinzuf�gen");
define("_AS_UPDATE", "Aktualisieren");

//Question Number regeneration
define("_RE_REGENNUMBER", "Regenerate Question Numbers:"); //NEW for release 0.99dev2
define("_RE_STRAIGHT", "Straight"); //NEW for release 0.99dev2
define("_RE_BYGROUP", "By Group"); //NEW for release 0.99dev2
?>
