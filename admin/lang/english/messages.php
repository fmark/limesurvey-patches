<?php


//BUTTON BAR TITLES
define(_ADMINISTRATION, "Administration");
define(_SURVEY, "Survey");
define(_GROUP, "Group");
define(_QUESTION, "Question");
define(_ANSWERS, "Answers");
define(_CONDITIONS, "Conditions");
define(_HELP, "Help");
define(_USERCONTROL, "User Control");
define(_ACTIVATE, "Activate Survey");
define(_DEACTIVATE, "Deactivate Survey");
define(_CHECKFIELDS, "Check Database Fields");
define(_CREATEDB, "Create Database");
define(_SETUP, "PHPSurveyor Setup");
define(_DELETESURVEY, "Delete Survey");
define(_EXPORTQUESTION, "Export Question");
define(_EXPORTSURVEY, "Export Survey");
define(_IMPORTQUESTION, "Import Question");
define(_IMPORTSURVEY, "Import Survey");
define(_IMPORTQUESTION, "Import Question");
define(_EXPORTRESULTS, "Export Responses");
define(_BROWSERESPONSES, "Browse Responses");
define(_STATISTICS, "Quick Statistics");
define(_VIEWRESPONSE, "View Response");
define(_VIEWCONTROL, "Data View Control");
define(_DATAENTRY, "Data Entry");

//DROPDOWN HEADINGS
define(_SURVEYS, "Surveys");
define(_GROUPS, "Groups");
define(_QUESTIONS, "Questions");

//BUTTON MOUSEOVERS
//administration bar
define(_A_HOME_BT, "Default Administration Page");
define(_A_SECURITY_BT, "Modify Security Settings");
define(_A_BADSECURITY_BT, "Activate Security");
define(_A_CHECKDB_BT, "Check Database");
define(_A_DELETE_BT, "Delete Entire Survey");
define(_A_ADDSURVEY_BT, "Create or Import New Survey");
define(_A_HELP_BT, "Show Help");
//Survey bar
define(_S_ACTIVE_BT, "This survey is currently active");
define(_S_INACTIVE_BT, "This survey is not currently active");
define(_S_ACTIVATE_BT, "Activate this Survey");
define(_S_DEACTIVATE_BT, "De-activate this Survey");
define(_S_CANNOTACTIVATE_BT, "Cannot Activate this Survey");
define(_S_DOSURVEY_BT, "Do Survey");
define(_S_DATAENTRY_BT, "Dataentry Screen for Survey");
define(_S_PRINTABLE_BT, "Printable Version of Survey");
define(_S_EDIT_BT, "Edit Current Survey");
define(_S_DELETE_BT, "Delete Current Survey");
define(_S_EXPORT_BT, "Export this Survey");
define(_S_BROWSE_BT, "Browse Responses for this Survey");
define(_S_TOKENS_BT, "Activate/Edit Tokens for this Survey");
define(_S_ADDGROUP_BT, "Add New Group to Survey");
define(_S_MINIMISE_BT, "Hide Details of this Survey");
define(_S_MAXIMISE_BT, "Show Details of this Survey");
define(_S_CLOSE_BT, "Close this Survey");
//Group bar
define(_G_EDIT_BT, "Edit Current Group");
define(_G_DELETE_BT, "Delete Current Group");
define(_G_ADDQUESTION_BT, "Add New Question to Group");
define(_G_MINIMISE_BT, "Hide Details of this Group");
define(_G_MAXIMISE_BT, "Show Details of this Group");
define(_G_CLOSE_BT, "Close this Group");
//Question bar
define(_Q_EDIT_BT, "Edit Current Question");
define(_Q_DELETE_BT, "Delete Current Question");
define(_Q_EXPORT_BT, "Export this Question");
define(_Q_CONDITIONS_BT, "Set Conditions for this Question");
define(_Q_ANSWERS_BT, "Edit/Add Answers for this Question");
define(_Q_LABELS_BT, "Edit/Add Labels to this Question");
define(_Q_MINIMISE_BT, "Hide Details of this Question");
define(_Q_MAXIMISE_BT, "Show Details of this Question");
define(_Q_CLOSE_BT, "Close this Question");
//Browse Button Bar
define(_B_ADMIN_BT, "Return to Survey Administration");
define(_B_SUMMARY_BT, "Show summary information");
define(_B_ALL_BT, "Display all responses");
define(_B_LAST_BT, "Display last 50 responses");
define(_B_STATISTICS_BT, "Get statistics from these responses");
define(_B_EXPORT_BT, "Export Results to Application");
define(_B_BACKUP_BT, "Backup results table as SQL file");
//Datacontrols
define(_D_BEGIN, "Show start..");
define(_D_BACK, "Show last..");
define(_D_FORWARD, "Show next..");
define(_D_END, "Show last..");

//DATA LABELS
//surveys
define(_SL_TITLE, "Title:");
define(_SL_DESCRIPTION, "Description:");
define(_SL_WELCOME, "Welcome:");
define(_SL_ADMIN, "Administrator:");
define(_SL_EMAIL, "Admin Email:");
define(_SL_FAXTO, "Fax To:");
define(_SL_ANONYMOUS, "Anonymous?");
define(_SL_EXPIRES, "Expires:");
define(_SL_FORMAT, "Format:");
define(_SL_DATESTAMP, "Date Stamp?");
define(_SL_TEMPLATE, "Template:");
define(_SL_LANGUAGE, "Language:");
define(_SL_LINK, "Link:");
define(_SL_URL, "End URL:");
define(_SL_URLDESCRIP, "URL Descrip:");
define(_SL_STATUS, "Status:");
define(_SL_SELSQL, "Select SQL File:");
//groups
define(_GL_TITLE, "Title:");
define(_GL_DESCRIPTION, "Description:");
//questions
define(_QL_CODE, "Code:");
define(_QL_QUESTION, "Question:");
define(_QL_HELP, "Help:");
define(_QL_TYPE, "Type:");
define(_QL_GROUP, "Group:");
define(_QL_MANDATORY, "Mandatory:");
define(_QL_OTHER, "Other:");
//answers
define(_AL_CODE, "Code");
define(_AL_ANSWER, "Answer");
define(_AL_DEFAULT, "Default");
define(_AL_MOVE, "Move");
define(_AL_ACTION, "Action");
define(_AL_UP, "Up");
define(_AL_DN, "Dn");
define(_AL_SAVE, "Save");
define(_AL_DEL, "Del");
define(_AL_ADD, "Add");
define(_AL_FIXSORT, "Fix Sort");
//users
define(_UL_USER, "User");
define(_UL_PASSWORD, "Password");
define(_UL_SECURITY, "Security");
define(_UL_ACTION, "Action");
define(_UL_EDIT, "Edit");
define(_UL_DEL, "Delete");
define(_UL_ADD, "Add");
define(_UL_TURNOFF, "Turn Off Security");


//QUESTION TYPES
define(_5PT, "5 Point Choice");
define(_DATE, "Date");
define(_GENDER, "Gender");
define(_LIST, "List");
define(_LISTWC, "List With Comment");
define(_MULTO, "Multiple Options");
define(_MULTOC, "Multiple Options with Comments");
define(_NUMERICAL, "Numerical Input");
define(_RANK, "Ranking");
define(_STEXT, "Short free text");
define(_LTEXT, "Long free text");
define(_YESNO, "Yes/No");
define(_ARR5, "Array (5 Point Choice)");
define(_ARR10, "Array (10 Point Choice)");
define(_ARRYN, "Array (Yes/No/Uncertain)");
define(_ARRMV, "Array (Increase, Same, Decrease)");
define(_ARRFL, "Array (Flexible Labels)"); //(FOR LATER RELEASE)
define(_SINFL, "Single (Flexible Labels)"); //(FOR LATER RELEASE)
define(_EMAIL, "Email Address"); //FOR LATER RELEASE

//GENERAL WORDS AND PHRASES
define(_YES, "Yes");
define(_NO, "No");
define(_CANCEL, "Cancel");
define(_ERROR, "Error");
define(_SUCCESS, "Success");
define(_REQ, "*Required");
define(_ADDS, "Add Survey");
define(_ADDG, "Add Group");
define(_ADDQ, "Add Question");
define(_ADDU, "Add User");
define(_SAVE, "Save Changes");
define(_CHOOSE, "Please Choose..");
define(_NONE, "None"); //as in "Do not display anything, or none chosen";
define(_GO_ADMIN, "Main Admin Screen"); //text to display to return/display main administration screen
define(_CONTINUE, "Continue");
define(_WARNING, "Warning");
define(_USERNAME, "User name");
define(_PASSWORD, "Password");
define(_DELETE, "Delete");
define(_CLOSEWIN, "Close Window");

//General Setup Messages
define(_ST_NODB1, "The defined surveyor database does not exist");
define(_ST_NODB2, "Either your selected database has not yet been created or there is a problem accessing it.");
define(_ST_NODB3, "PHPSurveyor can attempt to create this database for you.");
define(_ST_NODB4, "Your selected database name is:");
define(_ST_CREATEDB, "Create Database");

//USER CONTROL MESSAGES
define(_UC_CREATE, "Creating default htaccess file");
define(_UC_NOCREATE, "Couldn't create htaccess file. Check your config.php for \$homedir setting, and that you have write permission in the correct directory.");
define(_UC_SEC_DONE, "Security Levels are now set up!");
define(_UC_CREATE_DEFAULT, "Creating default users");
define(_UC_UPDATE_TABLE, "Updating users table");
define(_UC_HTPASSWD_ERROR, "Error occurred creating htpasswd file");
define(_UC_HTPASSWD_EXPLAIN, "If you are using a windows server it is recommended that you copy the apache htpasswd.exe file into your admin folder for this function to work properly. This file is usually found in /apache group/apache/bin/");
define(_UC_SEC_REMOVE, "Removing security settings");
define(_UC_ALL_REMOVED, "Access file, password file and user database deleted");
define(_UC_ADD_USER, "Adding User");
define(_UC_ADD_MISSING, "Could not add user. Username and/or password were not supplied");
define(_UC_DEL_USER, "Deleting User");
define(_UC_DEL_MISSING, "Could not delete user. Username was not supplied.");
define(_UC_MOD_USER, "Modifying User");
define(_UC_MOD_MISSING, "Could not modify user. Username and/or password were not supplied");
define(_UC_TURNON_MESSAGE1, "You have not yet initialised security settings for your survey system and subsequently there are no restrictions on access.</p>\nIf you click on the 'initialise security' button below, standard APACHE security settings will be added to the administration directory of this script. You will then need to use the default access username and password to access the administration and data entry scripts.");
define(_UC_TURNON_MESSAGE2, "It is highly recommended that once your security system has been initialised you change this default password.");
define(_UC_INITIALISE, "Initialise Security");
define(_UC_NOUSERS, "No users exist in your table. We recommend you 'turn off' security. You can then 'turn it on' again.");
define(_UC_TURNOFF, "Turn Off Security");

//Activate and deactivate messages
define(_AC_MULTI_NOANSWER, "This question is a multiple answer type question but has no answers.");
define(_AC_NOTYPE, "This question does not have a question 'type' set.");
define(_AC_CON_OUTOFORDER, "This question has a condition set, however the condition is based on a question that appears after it.");
define(_AC_FAIL, "Survey does not pass consistency check");
define(_AC_PROBS, "The following problems have been found:");
define(_AC_CANNOTACTIVATE, "The survey cannot be activated until these problems have been resolved");
define(_AC_READCAREFULLY, "READ THIS CAREFULLY BEFORE PROCEEDING");
define(_AC_ACTIVATE_MESSAGE1, "You should only activate a survey when you are absolutely certain that your survey setup is finished and will not need changing.");
define(_AC_ACTIVATE_MESSAGE2, "Once a survey is activated you can no longer:<ul><li>Add or delete groups</li><li>Add or remove answers to Multiple Answer questions</li><li>Add or delete questions</li></ul>");
define(_AC_ACTIVATE_MESSAGE3, "However you can still:<ul><li>Edit (change) your questions code, text or type</li><li>Edit (change) your group names</li><li>Add, Remove or Edit pre-defined question answers (except for Multi-answer questions)</li><li>Change survey name or description</li></ul>");
define(_AC_ACTIVATE_MESSAGE4, "Once data has been entered into this survey, if you want to add or remove groups or questions, you will need to de-activate this survey, which will move all data that has already been entered into a seperate archived table.");
define(_AC_ACTIVATE, "Activate");
define(_AC_ACTIVATED, "Survey has been activated. Results table has been succesfully created.");
define(_AC_NOTACTIVATED, "Survey could not be actived.");
define(_AC_NOTPRIVATE, "This is not an anonymous survey. A token table must also be created.");
define(_AC_CREATETOKENS, "Initialise Tokens");
define(_AC_SURVEYACTIVE, "This survey is now active, and responses can be recorded.");
define(_AC_DEACTIVATE_MESSAGE1, "In an active survey, a table is created to store all the data-entry records.");
define(_AC_DEACTIVATE_MESSAGE2, "When you de-activate a survey all the data entered in the original table will be moved elsewhere, and when you activate the survey again, the table will be empty. You will not be able to access this data using PHPSurveyor any more.");
define(_AC_DEACTIVATE_MESSAGE3, "De-activated survey data can only be accessed by system administrators using a MySQL data access tool like phpmyadmin. If your survey uses tokens, this table will also be renamed and will only be accessible by system administrators.");
define(_AC_DEACTIVATE_MESSAGE4, "Your responses table will be renamed to:");
define(_AC_DEACTIVATE_MESSAGE5, "You should export your responses before de-activating. Click \"Cancel\" to return to the main admin screen without de-activating this survey.");
define(_AC_DEACTIVATE, "De-Activate");
define(_AC_DEACTIVATED_MESSAGE1, "The responses table has been renamed to: ");
define(_AC_DEACTIVATED_MESSAGE2, "The responses to this survey are no longer available using PHPSurveyor.");
define(_AC_DEACTIVATED_MESSAGE3, "You should note the name of this table in case you need to access this information later.");
define(_AC_DEACTIVATED_MESSAGE4, "The tokens table associated with this survey has been renamed to: ");

//CHECKFIELDS
define(_CF_CHECKTABLES, "Checking to ensure all tables exist");
define(_CF_CHECKFIELDS, "Checking to ensure all fields exist");
define(_CF_CHECKING, "Checking");
define(_CF_TABLECREATED, "Table Created");
define(_CF_FIELDCREATED, "Field Created");
define(_CF_OK, "OK");
define(_CFT_PROBLEM, "It appears as if some tables or fields are missing from your database.");

//CREATE DATABASE (createdb.php)
define(_CD_DBCREATED, "Database has been created.");
define(_CD_POPULATE_MESSAGE, "Please click below to populate the database");
define(_CD_POPULATE, "Populate Database");
define(_CD_NOCREATE, "Could not create database");
define(_CD_NODBNAME, "Database Information not provided. This script must be run from admin.php only.");

//DATABASE MODIFICATION MESSAGES
define(_DB_FAIL_GROUPNAME, "Group could not be added. It is missing the mandatory group name");
define(_DB_FAIL_GROUPUPDATE, "Group could not be updated");
define(_DB_FAIL_GROUPDELETE, "Group could not be deleted");
define(_DB_FAIL_NEWQUESTION, "Question could not be created.");
define(_DB_FAIL_QUESTIONTYPECONDITIONS, "Question could not be updated. There are conditions for other questions that rely on the answers to this question and changing the type will cause problems. You must delete these conditions before you can change the type of this question.");
define(_DB_FAIL_QUESTIONUPDATE, "Question could not be updated");
define(_DB_FAIL_QUESTIONDELCONDITIONS, "Question could not be deleted. There are conditions for other questions that rely on this question. You cannot delete this question until those conditions are removed");
define(_DB_FAIL_QUESTIONDELETE, "Question could not be deleted");
define(_DB_FAIL_NEWANSWERMISSING, "Answer could not be added. You must include both a Code and an Answer");
define(_DB_FAIL_NEWANSWERDUPLICATE, "Answer could not be added. There is already an answer with this code");
define(_DB_FAIL_ANSWERUPDATEMISSING, "Answer could not be updated. You must include both a Code and an Answer");
define(_DB_FAIL_ANSWERUPDATEDUPLICATE, "Answer could not be updated. There is already an answer with this code");
define(_DB_FAIL_ANSWERUPDATECONDITIONS, "Answer could not be updated. You have changed the answer code, but there are conditions to other questions which are dependant upon the old answer code to this question. You must delete these conditions before you can change the code to this answer.");
define(_DB_FAIL_ANSWERDELCONDITIONS, "Answer could not be deleted. There are conditions for other questions that rely on this answer. You cannot delete this answer until those conditions are removed");
define(_DB_FAIL_NEWSURVEY_TITLE, "Survey could not be created because it did not have a short title");
define(_DB_FAIL_NEWSURVEY, "Survey could not be created");
define(_DB_FAIL_SURVEYUPDATE, "Survey could not be updated");
define(_DB_FAIL_SURVEYDELETE, "Survey could not be deleted");

//DELETE SURVEY MESSAGES
define(_DS_NOSID, "You have not selected a survey to delete");
define(_DS_DELMESSAGE1, "You are about to delete this survey");
define(_DS_DELMESSAGE2, "This process will delete this survey, and all related groups, questions answers and conditions.");
define(_DS_DELMESSAGE3, "We recommend that before you delete this survey you export the entire survey from the main administration screen.");
define(_DS_SURVEYACTIVE, "This survey is active and a responses table exists. If you delete this survey, these responses will be deleted. We recommend that you export the responses before deleting this survey.");
define(_DS_SURVEYTOKENS, "This survey has an associated tokens table. If you delete this survey this tokens table will be deleted. We recommend that you export or backup these tokens before deleting this survey.");
define(_DS_DELETED, "This survey has been deleted.");

//EXPORT MESSAGES
define(_EQ_NOQID, "No QID has been provided. Cannot dump question.");
define(_ES_NOSID, "No SID has been provided. Cannot dump survey");

//EXPORT RESULTS
define(_EX_FROMSTATS, "Filtered from Statistics Script");
define(_EX_HEADINGS, "Questions");
define(_EX_ANSWERS, "Answers");
define(_EX_FORMAT, "Format");
define(_EX_HEAD_ABBREV, "Abbreviated headings");
define(_EX_HEAD_FULL, "Full headings");
define(_EX_ANS_ABBREV, "Answer Codes");
define(_EX_ANS_FULL, "Full Answers");
define(_EX_FORM_WORD, "Microsoft Word");
define(_EX_FORM_EXCEL, "Microsoft Excel");
define(_EX_FORM_CSV, "CSV Comma Delimited");
define(_EX_EXPORTDATA, "Export Data");

//IMPORT SURVEY MESSAGES
define(_IS_FAILUPLOAD, "An error occurred uploading your file. This may be caused by incorrect permissions in your admin folder.");
define(_IS_OKUPLOAD, "File upload succeeded.");
define(_IS_READFILE, "Reading file..");
define(_IS_WRONGFILE, "This file is not a PHPSurveyor survey file. Import failed.");
define(_IS_IMPORTSUMMARY, "Survey Import Summary");
define(_IS_SUCCESS, "Import of Survey is completed.");
define(_IS_IMPFAILED, "Import of this survey file failed");
define(_IS_FILEFAILS, "File does not contain PHPSurveyor data in the correct format.");

//IMPORT QUESTION MESSAGES
define(_IQ_NOSID, "No SID (Survey) has been provided. Cannot import question.");
define(_IQ_NOGID, "No GID (Group) has been provided. Cannot import question");
define(_IQ_WRONGFILE, "This file is not a PHPSurveyor question file. Import failed.");
define(_IQ_IMPORTSUMMARY, "Question Import Summary");
define(_IQ_SUCCESS, "Import of Question is completed");

//BROWSE RESPONSES MESSAGES
define(_BR_NOSID, "You have not selected a survey to browse.");
define(_BR_NOTACTIVATED, "This survey has not been activated. There are no results to browse.");
define(_BR_NOSURVEY, "There is no matching survey.");
define(_BR_EDITRESPONSE, "Edit this entry");
define(_BR_DELRESPONSE, "Delete this entry");
define(_BR_DISPLAYING, "Records Displayed:");
define(_BR_STARTING, "Starting From:");
define(_BR_SHOW, "Show");

//STATISTICS MESSAGES
define(_ST_FILTERSETTINGS, "Filter Settings");

//DATA ENTRY MESSAGES
define(_DE_NOMODIFY, "Cannot be modified");
define(_DE_UPDATE, "Update Entry");
define(_DE_NOSID, "You have not selected a survey for data-entry.");
define(_DE_NOEXIST, "The survey you selected does not exist");
define(_DE_NOTACTIVE, "This survey is not yet active. Your response cannot be saved");
define(_DE_INSERT, "Inserting Data");
define(_DE_RECORD, "The entry was assigned the following record id: ");
define(_DE_ADDANOTHER, "Add Another Record");
define(_DE_VIEWTHISONE, "View This Record");
define(_DE_BROWSE, "Browse Responses");
define(_DE_DELRECORD, "Record Deleted");
define(_DE_UPDATED, "Record has been updated.");


?>