<?php


//BUTTON BAR TITLES
define("_ADMINISTRATION", "�޲z");
define("_SURVEY", "�ݨ�");
define("_GROUP", "�D�زէO");
define("_QUESTION", "���D");
define("_ANSWERS", "����");
define("_CONDITIONS", "����y��");
define("_HELP", "�D�U����");
define("_USERCONTROL", "�ި�Τ�");
define("_ACTIVATE", "�ҥΰݨ�");
define("_DEACTIVATE", "���ΰݨ�");
define("_CHECKFIELDS", "�ˬd��Ʈw���");
define("_CREATEDB", "�إ߸�Ʈw");
define("_CREATESURVEY", "�إ߰ݨ�"); //New for 0.98rc4
define("_SETUP", "PHPSurveyor �պA");
define("_DELETESURVEY", "�R���ݨ�");
define("_EXPORTQUESTION", "��X�D��");
define("_EXPORTSURVEY", "��X�ݨ�");
define("_EXPORTLABEL", "��X���Ҷ�");
define("_IMPORTQUESTION", "��J�D��");
define("_IMPORTGROUP", "��J�D�زէO"); //New for 0.98rc5
define("_IMPORTSURVEY", "��J�ݨ�");
define("_IMPORTLABEL", "��J���Ҷ�");
define("_EXPORTRESULTS", "��X�^�����G");
define("_BROWSERESPONSES", "�s���^�����G");
define("_STATISTICS", "�ֳt�έp");
define("_VIEWRESPONSE", "�˵��^�����G");
define("_VIEWCONTROL", "��ƪ��˵�����");
define("_DATAENTRY", "��ƿ�J");
define("_TOKENCONTROL", "�ާ@�N�X����");
define("_TOKENDBADMIN", "�ާ@�N�X���޲z�x");
define("_DROPTOKENS", "�R���ާ@�N�X��");
define("_EMAILINVITE", "�q�l�ܽ�");
define("_EMAILREMIND", "�q�l���ܳ�");
define("_TOKENIFY", "�إ߾ާ@�N�X");
define("_UPLOADCSV", "�W��CSV �ɮ�");
define("_LABELCONTROL", "���Ҷ��޲z�x"); //NEW with 0.98rc3
define("_LABELSET", "���Ҷ�"); //NEW with 0.98rc3
define("_LABELANS", "����"); //NEW with 0.98rc3

//DROPDOWN HEADINGS
define("_SURVEYS", "�ݨ�");
define("_GROUPS", "�D�زէO");
define("_QUESTIONS", "���D");
define("_QBYQ", "�v�D�^���ݨ�");
define("_GBYG", "�v�ӲէO�^���ݨ�");
define("_SBYS", "�@���L�^���ݨ�");
define("_LABELSETS", "���Ҷ�"); //New with 0.98rc3

//BUTTON MOUSEOVERS
//administration bar
define("_A_HOME_BT", "�w�]�޲z��");
define("_A_SECURITY_BT", "�ק�w���]�w");
define("_A_BADSECURITY_BT", "�Ұʦw���]�w");
define("_A_CHECKDB_BT", "�ˬd��Ʈw");
define("_A_DELETE_BT", "�R����Ӱݨ�");
define("_A_ADDSURVEY_BT", "�إߩο�J�s�ݨ�");
define("_A_HELP_BT", "��ܨD�U����");
define("_A_CHECKSETTINGS", "�ˬd�]�w");
//Survey bar
define("_S_ACTIVE_BT", "���ݨ��{�w�ҥ�");
define("_S_INACTIVE_BT", "���ݨ��|���ҥ�");
define("_S_ACTIVATE_BT", "�ҥΥ��ݨ�");
define("_S_DEACTIVATE_BT", "���Υ��ݨ�");
define("_S_CANNOTACTIVATE_BT", "����ҥΥ��ݨ�");
define("_S_DOSURVEY_BT", "��g�ݨ�");
define("_S_DATAENTRY_BT", "�ݨ�����ƿ�J�e��");
define("_S_PRINTABLE_BT", "�ݨ����i���L��ܼҦ�");
define("_S_EDIT_BT", "�ק�ثe���ݨ�");
define("_S_DELETE_BT", "�R���ثe���ݨ�");
define("_S_EXPORT_BT", "�鰣���ݨ�");
define("_S_BROWSE_BT", "�s�����ݨ����^�����G");
define("_S_TOKENS_BT", "�ҥ�/�ק糧�ݨ����ާ@�N�X");
define("_S_ADDGROUP_BT", "��s�W���D�زէO�[�J�ݨ���");
define("_S_MINIMISE_BT", "���å��ݨ����ԲӸ��");
define("_S_MAXIMISE_BT", "��ܥ��ݨ����ԲӸ��");
define("_S_CLOSE_BT", "�������ݨ�");
//Group bar
define("_G_EDIT_BT", "�ק�ثe���D�زէO");
define("_G_EXPORT_BT", "��X�ثe���D�زէO"); //New in 0.98rc5
define("_G_DELETE_BT", "�R���ثe���D�زէO");
define("_G_ADDQUESTION_BT", "�s�W�D�ب��D�زէO");
define("_G_MINIMISE_BT", "���å��D�زէO���ԲӸ��");
define("_G_MAXIMISE_BT", "��ܥ��D�زէO���ԲӸ��");
define("_G_CLOSE_BT", "�������D�زէO");
//Question bar
define("_Q_EDIT_BT", "�ק�ثe���D��");
define("_Q_COPY_BT", "�ƻs�ثe���D��"); //New in 0.98rc4
define("_Q_DELETE_BT", "�R���ثe���D��");
define("_Q_EXPORT_BT", "��X���D��");
define("_Q_CONDITIONS_BT", "�����D�س]�w����y��");
define("_Q_ANSWERS_BT", "�ק�/�s�W�D�ت�����");
define("_Q_LABELS_BT", "�ק�/�s�W���Ҷ�");
define("_Q_MINIMISE_BT", "���å��D�ت��ԲӸ��");
define("_Q_MAXIMISE_BT", "��ܥ��D�ت��ԲӸ��");
define("_Q_CLOSE_BT", "�������D��");
//Browse Button Bar
define("_B_ADMIN_BT", "��^�ݨ��޲z");
define("_B_SUMMARY_BT", "���²�����");
define("_B_ALL_BT", "��ܦ^�����G");
define("_B_LAST_BT", "��̪ܳ� 50 �Ӧ^�����G");
define("_B_STATISTICS_BT", "�ھڳo�Ǧ^�����o�έp���");
define("_B_EXPORT_BT", "��X�^�����G�����ε{��");
define("_B_BACKUP_BT", "��^�����G�����ƥ��� SQL ���ɮ׮榡");
//Tokens Button Bar
define("_T_ALL_BT", "��ܾާ@�N�X");
define("_T_ADD_BT", "�s�W�ާ@�N�X");
define("_T_IMPORT_BT", "��JCSV�ɪ��ާ@�N�X");
define("_T_INVITE_BT", "�e�X�q�l�ܽ�");
define("_T_REMIND_BT", "�e�X�q�l����");
define("_T_TOKENIFY_BT", "���;ާ@�N�X");
define("_T_KILL_BT", "�����ާ@�N�X��");

//Labels Button Bar
define("_L_ADDSET_BT", "�s�W���Ҷ�");
define("_L_EDIT_BT", "�ק���Ҷ�");
define("_L_DEL_BT", "�R�����Ҷ�");
//Datacontrols
define("_D_BEGIN", "��̫ܳe..");
define("_D_BACK", "��ܫe�@��..");
define("_D_FORWARD", "��ܤU�@��..");
define("_D_END", "��̫ܳ�..");

//DATA LABELS
//surveys
define("_SL_TITLE", "���D:");
define("_SL_SURVEYURL", "�ݨ��s�� URL:"); //new in 0.98rc5
define("_SL_DESCRIPTION", "����:");
define("_SL_WELCOME", "�w��:");
define("_SL_ADMIN", "�޲z��:");
define("_SL_EMAIL", "�޲z���q�l�a�}:");
define("_SL_FAXTO", "�ǯu��Ǯնǯu��:");
define("_SL_ANONYMOUS", "�n�O���ΦW�覡�^����?");
define("_SL_EXPIRES", "���Ĵ�:");
define("_SL_FORMAT", "�榡:");
define("_SL_DATESTAMP", "�n�إߤ���L����?");
define("_SL_TEMPLATE", "����Ҳ�:");
define("_SL_LANGUAGE", "�y��:");
define("_SL_LINK", "�s��:");
define("_SL_URL", "�����ݨ��᪺�۰ʳs�� URL:");
define("_SL_URLDESCRIP", "URL �s������:");
define("_SL_STATUS", "���A:");
define("_SL_SELSQL", "��� SQL �ɮ�:");
define("_SL_USECOOKIES", "�ϥ� Cookies ��?"); //NEW with 098rc3
define("_SL_NOTIFICATION", "�q��:"); //New with 098rc5
define("_SL_ALLOWREGISTER", "Allow public registration?"); //New with 0.98rc9
define("_SL_ATTRIBUTENAMES", "Token Attribute Names:"); //New with 0.98rc9

//groups
define("_GL_TITLE", "���D:");
define("_GL_DESCRIPTION", "����:");
//questions
define("_QL_CODE", "�s��:");
define("_QL_QUESTION", "�D��:");
define("_QL_HELP", "�D�U����:");
define("_QL_TYPE", "����:");
define("_QL_GROUP", "�D�زէO:");
define("_QL_MANDATORY", "�����@��:");
define("_QL_OTHER", "��L:");
define("_QL_LABELSET", "���Ҷ�:");
define("_QL_COPYANS", "�n�ƻs���׶�?"); //New in 0.98rc3
//answers
define("_AL_CODE", "�s��");
define("_AL_ANSWER", "����");
define("_AL_DEFAULT", "�w�]");
define("_AL_MOVE", "����");
define("_AL_ACTION", "�޲z�ʧ@");
define("_AL_UP", "���W");
define("_AL_DN", "���U");
define("_AL_SAVE", "�x�s");
define("_AL_DEL", "�R��");
define("_AL_ADD", "�s�W");
define("_AL_FIXSORT", "�ץ��Ƨ�");
define("_AL_SORTALPHA", "Sort Alpha"); //New in 0.98rc8 - Sort Answers Alphabetically
//users
define("_UL_USER", "�Τ�");
define("_UL_PASSWORD", "�K�X");
define("_UL_SECURITY", "�w���]�w");
define("_UL_ACTION", "�޲z�ʧ@");
define("_UL_EDIT", "�ק�");
define("_UL_DEL", "�R��");
define("_UL_ADD", "�s�W");
define("_UL_TURNOFF", "�����w���]�w");
//tokens
define("_TL_FIRST", "�W�r");
define("_TL_LAST", "�m��");
define("_TL_EMAIL", "�q�l");
define("_TL_TOKEN", "�ާ@�N�X");
define("_TL_INVITE", "�w�e�X�ܽж�?");
define("_TL_DONE", "�w�����ݨ���?");
define("_TL_ACTION", "�޲z�ʧ@");
define("_TL_ATTR1", "Att_1"); //New for 0.98rc7 (Attribute 1)
define("_TL_ATTR2", "Att_2"); //New for 0.98rc7 (Attribute 2)
define("_TL_MPID", "MPID"); //New for 0.98rc7   (MPID - short for "Master Preferences ID")
//labels
define("_LL_NAME", "�]�w�W�r"); //NEW with 098rc3
define("_LL_CODE", "�s��"); //NEW with 098rc3
define("_LL_ANSWER", "���D"); //NEW with 098rc3
define("_LL_SORTORDER", "�Ƨ�"); //NEW with 098rc3
define("_LL_ACTION", "�޲z�ʧ@"); //New with 098rc3

//QUESTION TYPES
define("_5PT", "5 �������");
define("_DATE", "���");
define("_GENDER", "�ʧO");
define("_LIST", "�C��");
define("_LISTWC", "�C����W���y�\��");
define("_MULTO", "�h�����");
define("_MULTOC", "�h����ܪ��W���y�\��");
define("_MULTITEXT", "�h�����u��");
define("_NUMERICAL", "�ƭ����");
define("_RANK", "�ƦC�ŧO");
define("_STEXT", "�ۥѵu��");
define("_LTEXT", "�ۥѪ���");
define("_YESNO", "�O/�_");
define("_ARR5", "Array (5�������)");
define("_ARR10", "Array (10�������)");
define("_ARRYN", "Array (�O/�_/���֩w)");
define("_ARRMV", "Array (�W�[, ����, ���)");
define("_ARRFL", "Array (�u�ʼ���)"); //Release 0.98rc3
define("_ARRFLC", "Array (Flexible Labels) by Column"); //Release 0.98rc8
define("_SINFL", "Single (�u�ʼ���)"); //(FOR LATER RELEASE)
define("_EMAIL", "�q�l�a�}"); //FOR LATER RELEASE
define("_BOILERPLATE", "�˪��D��"); //New in 0.98rc6

//GENERAL WORDS AND PHRASES
define("_AD_YES", "�O");
define("_AD_NO", "�_");
define("_AD_CANCEL", "����");
define("_AD_CHOOSE", "�п��..");
define("_AD_OR", "��"); //New in 0.98rc4
define("_ERROR", "�X��");
define("_SUCCESS", "���\/");
define("_REQ", "*�������");
define("_ADDS", "�s�W�ݨ�");
define("_ADDG", "�s�W�D�زէO");
define("_ADDQ", "�s�W�D��");
define("_ADDA", "�s�W����"); //New in 0.98rc4
define("_COPYQ", "�ƻs�D��"); //New in 0.98rc4
define("_ADDU", "�s�W�Τ�");
define("_SEARCH", "�j�M"); //New in 0.98rc4
define("_SAVE", "�x�s����");
define("_NONE", "�S��"); //as in "Do not display anything", "or none chosen";
define("_GO_ADMIN", "�D�޲z�e��"); //text to display to return/display main administration screen
define("_CONTINUE", "�~��");
define("_WARNING", "ĵ�i");
define("_USERNAME", "�Τ�W��");
define("_PASSWORD", "�K�X");
define("_DELETE", "�R��");
define("_CLOSEWIN", "��������");
define("_TOKEN", "�ާ@�N�X");
define("_DATESTAMP", "����L��"); //Referring to the datestamp or time response submitted
define("_COMMENT", "���y");
define("_FROM", "��"); //For emails
define("_SUBJECT", "���D"); //For emails
define("_MESSAGE", "����"); //For emails
define("_RELOADING", "��s�e���A�еy��.");
define("_ADD", "�s�W");
define("_UPDATE", "��s");
define("_BROWSE", "�s��"); //New in 098rc5
define("_AND", "and"); //New with 0.98rc8
define("_SQL", "SQL"); //New with 0.98rc8
define("_PERCENTAGE", "Percentage"); //New with 0.98rc8
define("_COUNT", "Count"); //New with 0.98rc8

//SURVEY STATUS MESSAGES (new in 0.98rc3)
define("_SS_NOGROUPS", "�ݨ����D�زէO�ƥ�"); //NEW for release 0.98rc3
define("_SS_NOQUESTS", "�ݨ����D�ؼƥ�:"); //NEW for release 0.98rc3
define("_SS_ANONYMOUS", "���ݨ��O�ĥΰΦW�覡."); //NEW for release 0.98rc3
define("_SS_TRACKED", "���ݨ��ëD�ĥΰΦW�覡."); //NEW for release 0.98rc3
define("_SS_DATESTAMPED", "�^�����ݨ��|�Q�[�W������L��"); //NEW for release 0.98rc3
define("_SS_COOKIES", "���ĥ� cookies ����ݨ����ϥ��v��."); //NEW for release 0.98rc3
define("_SS_QBYQ", "���O�ĥγv�D�^�����覡."); //NEW for release 0.98rc3
define("_SS_GBYG", "���O�ĥγv���D�زէO���^���覡."); //NEW for release 0.98rc3
define("_SS_SBYS", "���O�ĥγ�@�����@���L�^��."); //NEW for release 0.98rc3
define("_SS_ACTIVE", "�ݨ��{�w�ҥ�."); //NEW for release 0.98rc3
define("_SS_NOTACTIVE", "�ݨ��å��ҥ�."); //NEW for release 0.98rc3
define("_SS_SURVEYTABLE", "�ݨ����W�٬O:"); //NEW for release 0.98rc3
define("_SS_CANNOTACTIVATE", "�ݨ��L�k�ҥ�."); //NEW for release 0.98rc3
define("_SS_ADDGROUPS", "�z�ݭn�s�W�D�زէO"); //NEW for release 0.98rc3
define("_SS_ADDQUESTS", "�z�ݭn�s�W�D��"); //NEW for release 0.98rc3
define("_SS_ALLOWREGISTER", "If tokens are used, the public may register for this survey"); //NEW for release 0.98rc9

//QUESTION STATUS MESSAGES (new in 0.98rc4)
define("_QS_MANDATORY", "�����^�������D"); //New for release 0.98rc4
define("_QS_OPTIONAL", "��ܩʦ^�������D"); //New for release 0.98rc4
define("_QS_NOANSWERS", "�z�ݭn�⵪�׷s�W�쥻�D��"); //New for release 0.98rc4
define("_QS_NOLID", "�z�ݭn��ܥ��D�ت����Ҷ�"); //New for release 0.98rc4
define("_QS_COPYINFO", "�`�N�J �z������J�D�ت��s��"); //New for release 0.98rc4

//General Setup Messages
define("_ST_NODB1", "�w�q���ݨ��ƾڮw�ä��s�b");
define("_ST_NODB2", "��]���G�J1.�z��ܪ��ƾڮw�����إ�. 2. �s����Ƶo�ͬG��.");
define("_ST_NODB3", "PHPSurveyor �չϬ��z�إ߼ƾڮw.");
define("_ST_NODB4", "�z��ܪ��ƾڮw�W�٬O:");
define("_ST_CREATEDB", "�إ߼ƾڮw");

//USER CONTROL MESSAGES
define("_UC_CREATE", "�إ߹w�]�� htaccess ��");
define("_UC_NOCREATE", "����إ� htaccess �ɡA���ˬd�z�b\$homedir ��config.php �ɪ��]�w�A�г]�w�ӥؿ����g�J��ƪ��ϥ��v��.");
define("_UC_SEC_DONE", "�{�w�إߦw���]�w!");
define("_UC_CREATE_DEFAULT", "�إ߹w�]���Τ�");
define("_UC_UPDATE_TABLE", "��s�Τ��ƪ�");
define("_UC_HTPASSWD_ERROR", "�L�k���� htpasswd ��");
define("_UC_HTPASSWD_EXPLAIN", "�p�G�z���b�� windows �t�Ϊ����A���A��ĳ�z�ƻs apache htpasswd.exe �ɮר�z��admin ��Ƨ��A�~�ॿ�`�B�楻�\��A�z�i�H�b/apache group/apache/bin/ ���o���ɮ�.");
define("_UC_SEC_REMOVE", "�����w���]�w");
define("_UC_ALL_REMOVED", "�s���ɡB�K�X�ɤΥΤ�ƾڮw���w�Q�R��");
define("_UC_ADD_USER", "�s�W�Τ�");
define("_UC_ADD_MISSING", "����s�W�Τ�A�]���z�������ѷ|���W�٤�/�αK�X.");
define("_UC_DEL_USER", "���b�R���Τ�");
define("_UC_DEL_MISSING", "����R���Τ�A�]���z�������ѥΤ�W��.");
define("_UC_MOD_USER", "���b�ק�Τ�");
define("_UC_MOD_MISSING", "����ק�Τ��ơA�]���z�������ѥΤ�W�٤�/�αK�X");
define("_UC_TURNON_MESSAGE1", "�z�å����ݨ��t�αҰʦw���]�w�A�o��ܰݨ����ϥ��v�������w���O��.</p>\n�p�G�z click �U�C '�Ұʦw���]�w' ���s, �зǪ� APACHE �w���]�w�|�[�i���{���� admin �ؿ����C�M��z�ݭn�ϥιw�]���Τ�W�٤αK�X�A�~�i�H�ϥ��{�����޲z���ο�J�[�]�ݨ������.");
define("_UC_TURNON_MESSAGE2", "��ĳ�z�Ұʦw���t�Ϋ�A���W���w�]���K�X.");
define("_UC_INITIALISE", "�Ұʦw���]�w");
define("_UC_NOUSERS", "�z����ƪ������Τ��ơA��ĳ�z�� '����' �w���]�w��A�y��A���s '�}�Ҧw���]�w' .");
define("_UC_TURNOFF", "�����w���]�w");

//Activate and deactivate messages
define("_AC_MULTI_NOANSWER", "���D�جO�h����ܪ������A����������.");
define("_AC_NOTYPE", "���D�بå��]�w�D�� '����' .");
define("_AC_NOLID", "This question requires a Labelset, but none is set."); //New for 0.98rc8
define("_AC_CON_OUTOFORDER", "���D�ئ�����y�����]�w�A������y���O����D�إX�{�����T���Ǥ~��ͮ�.");
define("_AC_FAIL", "�ݨ�����q�L�t�Ϊ��ˬd");
define("_AC_PROBS", "�w�o�{�H�U�����D:");
define("_AC_CANNOTACTIVATE", "���D���D��o�ѨM�A�_�h�ݨ�����Q�ҥ�");
define("_AC_READCAREFULLY", "�ХJ�Ӿ\Ū����A�~�~����楻�\��.");
define("_AC_ACTIVATE_MESSAGE1", "��z�T�w�ݨ��w���\�[�]�A�S���A�ݭn�ק諸���p�U�A�z�~�i�H�ҥΰݨ�.");
define("_AC_ACTIVATE_MESSAGE2", "�ݨ��@�g�ҥΡA�z�N����A:<ul><li>�s�W�ΧR���D�زէO</li><li>�s�W�β����h��������D������</li><li>�s�W�ΧR���D��</li></ul>");
define("_AC_ACTIVATE_MESSAGE3", "���z���i�H�J<ul><li>�ק� (���) �D�ت��s����r������</li><li>�ק� (���) �z���D�زէO</li><li>�s�W�B�����έק�w�s���D�ص��� (�h������ܪ����װ��~)</li><li>���ݨ����W�٩θɥR����</li></ul>");
define("_AC_ACTIVATE_MESSAGE4", "�ݨ����ƾڤ@�g��J����A�p�G�z�n�s�W�β����D�زէO���D�ءA�z�ݭn���ΰݨ��A�ݨ��ƾڷ|�۰ʷh����M���s�����ɪ���ƪ�.");
define("_AC_ACTIVATE", "�ҥ�");
define("_AC_ACTIVATED", "�w�ҥΰݨ��A�^�����ݨ���ƪ�w���\�إ�.");
define("_AC_NOTACTIVATED", "����ҥΰݨ�.");
define("_AC_NOTPRIVATE", "�o�ëD�ΦW�覡���ݨ��A�]���z�����إ߾ާ@�N�X��.");
define("_AC_CREATETOKENS", "�Ұʾާ@�N�X");
define("_AC_SURVEYACTIVE", "���ݨ��{�w�ҥΡA�^�����ݨ��|���W�O���U��.");
define("_AC_DEACTIVATE_MESSAGE1", "�b�w�ҥΪ��ݨ�, �t�η|�إ߸�ƪ�Ӧs�������J����ưO��.");
define("_AC_DEACTIVATE_MESSAGE2", "��z�����ݨ�����A�b�즳��ƪ�W���ƾڸ�Ƨ��|�Q�����F��z���s�ҥΰݨ�, ��ƪ�N�|�ŪŦp�]�C�o��ܱz���i�H�A�z�L PHPSurveyor �s���o���¦��ƾڤF.");
define("_AC_DEACTIVATE_MESSAGE3", "���ΰݨ����ƾڥu��g�Ѩt�κ޲z���z�LMySQL ���ƾڦs���u��A�Ҧp�Ophpmyadmin �i��s���C�p�G�z���ݨ��ϥξާ@�N�X, ����ƪ��|��W�A�ӥB�u���t�κ޲z���~�i�s�����������.");
define("_AC_DEACTIVATE_MESSAGE4", "�^���ݨ�����ƪ�|�Q��W��:");
define("_AC_DEACTIVATE_MESSAGE5", "�z���ӧ�^�����ݨ���X����r�ɳƥ��A�~���ΰݨ�. Click \"����\" �i��󰱥ΰݨ��A�Ӫ�^�D�޲z�e��.");
define("_AC_DEACTIVATE", "����");
define("_AC_DEACTIVATED_MESSAGE1", "�^���ݨ�����ƪ�w��W��: ");
define("_AC_DEACTIVATED_MESSAGE2", "�^�����ݨ����A��z�LPHPSurveyor�ϥ�.");
define("_AC_DEACTIVATED_MESSAGE3", "�бz�O�U�o��ƪ��W�١A�H�K��ᦳ�ݭn�ɡA�z�i�H�s���o�Ǹ��.");
define("_AC_DEACTIVATED_MESSAGE4", "�s�����ݨ����ާ@�N�X��w�g��W��: ");

//CHECKFIELDS
define("_CF_CHECKTABLES", "���b�ˬd���O�_����");
define("_CF_CHECKFIELDS", "���b�ˬd�Ҧ����O�_����");
define("_CF_CHECKING", "���b�ˬd��");
define("_CF_TABLECREATED", "�w�إߪ��");
define("_CF_FIELDCREATED", "�w�إ����");
define("_CF_OK", "OK");
define("_CFT_PROBLEM", "�ƾڮw���������θ�ƪ���G���s�b.");

//CREATE DATABASE (createdb.php)
define("_CD_DBCREATED", "�w�إ߸�Ʈw.");
define("_CD_POPULATE_MESSAGE", "�� click �U��H�իظ�Ʈw");
define("_CD_POPULATE", "�իظ�Ʈw");
define("_CD_NOCREATE", "����إ߸�Ʈw");
define("_CD_NODBNAME", "�����Ѹ�Ʈw����ơA���{�������z�Ladmin.php ����.");

//DATABASE MODIFICATION MESSAGES
define("_DB_FAIL_GROUPNAME", "���ʤ֤F�������էO�W�١A�]������s�W�D�زէO");
define("_DB_FAIL_GROUPUPDATE", "�����s�D�زէO");
define("_DB_FAIL_GROUPDELETE", "����R���D�زէO");
define("_DB_FAIL_NEWQUESTION", "����إ��D��");
define("_DB_FAIL_QUESTIONTYPECONDITIONS", "�����s�D�ءA�]�������w�����ץ��Q��L�D�إH����y�����]�w��e�ϥΡA�p��������|�y���t�ΥX���C�z�������R������������y���A�~�i�H��糧�D�ت�����.");
define("_DB_FAIL_QUESTIONUPDATE", "�����s�D��");
define("_DB_FAIL_QUESTIONDELCONDITIONS", "����R���D�ءA�]�������Q��L�D�إH����y�����]�w��e�ϥΡC���D����������y���Q�����A�_�h�z�L�k�R�����D��.");
define("_DB_FAIL_QUESTIONDELETE", "����R���D��");
define("_DB_FAIL_NEWANSWERMISSING", "����s�W���סA�]���z�������ѽs���ε���.");
define("_DB_FAIL_NEWANSWERDUPLICATE", "����s�W���סA�]���o�s���w�����רϥ�.");
define("_DB_FAIL_ANSWERUPDATEMISSING", "�����s���סA�z�����@�ִ��ѽs���ε���.");
define("_DB_FAIL_ANSWERUPDATEDUPLICATE", "�����s����, �]���o�s���w�����רϥ�.");
define("_DB_FAIL_ANSWERUPDATECONDITIONS", "�����s���סA�]���z�w��ﵪ�ת��s���A����L�D�ت�����y�����ϥΥ��D�ت��µ��׹������½s���C�z�������R���o�Ǳ���y���A�~�i�H��ﵪ�ת��½s��.");
define("_DB_FAIL_ANSWERDELCONDITIONS", "����R�����סA�]����L�D�ت�����y�����ϥΥ����סC���D�z���R������������y���A�_�h����R���o����.");
define("_DB_FAIL_NEWSURVEY_TITLE", "����إ߰ݨ��A�]�����S���u���D.");
define("_DB_FAIL_NEWSURVEY", "����إ߰ݨ�");
define("_DB_FAIL_SURVEYUPDATE", "�����s�ݨ�");
define("_DB_FAIL_SURVEYDELETE", "����R���ݨ�");

//DELETE SURVEY MESSAGES
define("_DS_NOSID", "�z����ܰݨ��A�ҥH����R���ݨ�.");
define("_DS_DELMESSAGE1", "�z�N�n�R�����ݨ�");
define("_DS_DELMESSAGE2", "���{�Ƿ|�R�����ݨ��Ψ�����������D�زէO�B�D�ص��פά���������y��.");
define("_DS_DELMESSAGE3", "��ĳ�z���b�D�޲z�e����X�ݨ��A�~�R�����ݨ�.");
define("_DS_SURVEYACTIVE", "���ݨ��w�ҥΡA�æ��^�����G�����C�p�G�z�{�b�R���ݨ��A��|��^�����G�����@�֧R���C��ĳ�z��^�������G��X����r�ɡA�~�R�����ݨ�.");
define("_DS_SURVEYTOKENS", "���ݨ��֦��������ާ@�N�X��. �p�G�z�n�R�����ݨ��A�Х��R�����ާ@�N�X��C��ĳ�z����o�Ǿާ@�N�X��i��ƥ��ο�X����r�ɡA�~�R���ݨ�.");
define("_DS_DELETED", "���ݨ��w�Q�R��.");

//DELETE QUESTION AND GROUP MESSAGES
define("_DG_RUSURE", "�R�����D�زէO��|�@�֧R���էO�s�����D�ةM���סC�z�֩w�n�R����?"); //New for 098rc5
define("_DQ_RUSURE", "�R�����D�إ�|�@�֧R�����סC�z�֩w�n�R����?"); //New for 098rc5

//EXPORT MESSAGES
define("_EQ_NOQID", "������ QID �A���ಾ���D��.");
define("_ES_NOSID", "������ SID �A���ಾ���ݨ�");

//EXPORT RESULTS
define("_EX_FROMSTATS", "�̷Ӳέp�{���z����ܪ�����");
define("_EX_HEADINGS", "�D��");
define("_EX_ANSWERS", "����");
define("_EX_FORMAT", "�榡");
define("_EX_HEAD_ABBREV", "�Y�g�����Y���D");
define("_EX_HEAD_FULL", "���㪺���Y���D");
define("_EX_ANS_ABBREV", "���׽s��");
define("_EX_ANS_FULL", "���㵪��");
define("_EX_FORM_WORD", "Microsoft Word");
define("_EX_FORM_EXCEL", "Microsoft Excel");
define("_EX_FORM_CSV", "CSV �r�����j");
define("_EX_EXPORTDATA", "��X�ƾ�");
define("_EX_COLCONTROLS", "Column Control"); //New for 0.98rc7
define("_EX_TOKENCONTROLS", "Token Control"); //New for 0.98rc7
define("_EX_COLSELECT", "Choose columns"); //New for 0.98rc7
define("_EX_COLOK", "Choose the columns you wish to export. Leave all unselected to export all columns."); //New for 0.98rc7
define("_EX_COLNOTOK", "Your survey contains more than 255 columns of responses. Spreadsheet applications such as Excel are limited to loading no more than 255. Select the columns you wish to export in the list below."); //New for 0.98rc7
define("_EX_TOKENMESSAGE", "Your survey can export associated token data with each response. Select any additional fields you would like to export."); //New for 0.98rc7
define("_EX_TOKSELECT", "Choose Token Fields"); //New for 0.98rc7

//IMPORT SURVEY MESSAGES
define("_IS_FAILUPLOAD", "�W���ɮ׮ɥX���A�i��O�z�� admin ��Ƨ����ϥ��v���]�w�X��.");
define("_IS_OKUPLOAD", "�ɮצ��\�W��.");
define("_IS_READFILE", "�ɮ�Ū����.");
define("_IS_WRONGFILE", "���ɤ��O PHPSurveyor ���ݨ��ɡA�]���L�k��J.");
define("_IS_IMPORTSUMMARY", "��J�ݨ���²��");
define("_IS_SUCCESS", "�ݨ���J�u�@�w����.");
define("_IS_IMPFAILED", "�L�k��J���ݨ�");
define("_IS_FILEFAILS", "�ɮפ��� PHPSurveyor ��Ƥ��ŦX���T���榡.");

//IMPORT GROUP MESSAGES
define("_IG_IMPORTSUMMARY", "��J�D�زէO��²��");
define("_IG_SUCCESS", "��J�D�زէO���u�@�w����.");
define("_IG_IMPFAILED", "�L�k��J���D�زէO");
define("_IG_WRONGFILE", "���ɮרëD PHPSurveyor ���D�زէO�ɡA�]���L�k��J.");

//IMPORT QUESTION MESSAGES
define("_IQ_NOSID", "�������� SID (�ݨ�) �A�����J�D��.");
define("_IQ_NOGID", "������ GID (�D�زէO) �A�]���L�k��J�D��.");
define("_IQ_WRONGFILE", "���ɮרëD PHPSurveyor ���D���ɡA�]���L�k��J.");
define("_IQ_IMPORTSUMMARY", "��J�D�ت�²��");
define("_IQ_SUCCESS", "�D�ت���J�w����");

//BROWSE RESPONSES MESSAGES
define("_BR_NOSID", "�z�|����ܰݨ��A�H�P�L�k�s���ݨ����e.");
define("_BR_NOTACTIVATED", "���ݨ��|���Q�ҥ�, �]���L�k�s���^�����G.");
define("_BR_NOSURVEY", "�䤣��k�X���ݨ�.");
define("_BR_EDITRESPONSE", "�ק糧����");
define("_BR_DELRESPONSE", "�R��������");
define("_BR_DISPLAYING", "��ܰO��:");
define("_BR_STARTING", "�ҩl��:");
define("_BR_SHOW", "���");
define("_DR_RUSURE", "�z�֩w�n�R�������ض�?"); //New for 0.98rc6

//STATISTICS MESSAGES
define("_ST_FILTERSETTINGS", "�z����󪺳]�w");
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
define("_DE_NOMODIFY", "����Q�ק�");
define("_DE_UPDATE", "��s����");
define("_DE_NOSID", "�z��������ܰݨ��A�~�i�H��J���.");
define("_DE_NOEXIST", "�z��ܪ��ݨ��ä��s�b");
define("_DE_NOTACTIVE", "���ݨ��|���ҥΡA�]���z���^�������x�s��ݨ��h�C");
define("_DE_INSERT", "���J���");
define("_DE_RECORD", "���ؤ�����H�U���O�� id: ");
define("_DE_ADDANOTHER", "�s�W�t�@���O��");
define("_DE_VIEWTHISONE", "�˵��o���O��");
define("_DE_BROWSE", "�s���^�����G");
define("_DE_DELRECORD", "�O���w�Q�R��");
define("_DE_UPDATED", "�O���w�Q��s.");
define("_DE_EDITING", "�ק�^�����G");
define("_DE_QUESTIONHELP", "���������D���D�U����");
define("_DE_CONDITIONHELP1", "�ŦX����~�i�^�����D��:"); 
define("_DE_CONDITIONHELP2", "���D: {QUESTION}, �z������: {ANSWER}"); //This will be a tricky one depending on your languages syntax. {ANSWER} is replaced with ALL ANSWERS, seperated by _DE_OR (OR).
define("_DE_AND", "��");
define("_DE_OR", "��");

//TOKEN CONTROL MESSAGES
define("_TC_TOTALCOUNT", "�ާ@�N�X�������`��:"); //New in 0.98rc4
define("_TC_NOTOKENCOUNT", "�����ާ@�N�X���`��:"); //New in 0.98rc4
define("_TC_INVITECOUNT", "�w�o�X�ܽЪ��`��:"); //New in 0.98rc4
define("_TC_COMPLETEDCOUNT", "�����ݨ����`��:"); //New in 0.98rc4
define("_TC_NOSID", "�z������ܰݨ�");
define("_TC_DELTOKENS", "���n�R�����ݨ����ާ@�N�X��.");
define("_TC_DELTOKENSINFO", "�p�G�z�R���������ާ@�N�X�A�ݨ��N�|�۰ʶ}�񵹤����ϥΡF�z��i�H�⥻�����ƥ��A���t�κ޲z���N���s���ƥ���檺��ơC");
define("_TC_DELETETOKENS", "�R���ާ@�N�X");
define("_TC_TOKENSGONE", "�ާ@�N�X���ت�w�Q�����A���ݨ����A�ݭn�ާ@�N�X�A�N�i�H�ϥΡC�p�⥻��ƥ��A�t�κ޲z���i�H�s����W����ơC.");
define("_TC_NOTINITIALISED", "���ݨ����ާ@�N�X�w�ҥ�.");
define("_TC_INITINFO", "�p�G�z�ҥΥ��ݨ����ާ@�N�X, �u����o�����ާ@�N�X���Τ�~�i�H�ϥΥ��ݨ�.");
define("_TC_INITQ", "�z�n�����ݨ��إ߾ާ@�N�X���?");
define("_TC_INITTOKENS", "�ҭ��ާ@�N�X");
define("_TC_CREATED", "���ݨ����ާ@�N�X��w�g�إ�.");
define("_TC_DELETEALL", "�R�������ާ@�N�X����");
define("_TC_DELETEALL_RUSURE", "�z�֩w�n�R�������ާ@�N�X���ض�?");
define("_TC_ALLDELETED", "�����ާ@�N�X���ؤw�Q�R��");
define("_TC_CLEARINVITES", "��������س]�w�� '�_' ���o�X�ܽЪ����A");
define("_TC_CLEARINV_RUSURE", "�z�֩w�n������ܽЬ������]�� '�_'�����A��?");
define("_TC_CLEARTOKENS", "�R�������ާ@�N�X");
define("_TC_CLEARTOKENS_RUSURE", "�z�֩w�n�R�������ާ@�N�X��? ");
define("_TC_TOKENSCLEARED", "�����ާ@�N�X���ؤw���\����");
define("_TC_INVITESCLEARED", "�����ܽж��w�]�w���_�����A");
define("_TC_EDIT", "�ק�ާ@�N�X����");
define("_TC_DEL", "�R���ާ@�N�X����");
define("_TC_DO", "��g�ݨ�");
define("_TC_VIEW", "�d�ݦ^�����G");
define("_TC_INVITET", "�e�X�����ت��ܽйq�l");
define("_TC_REMINDT", "�e�X�����ت����ܹq�l");
define("_TC_INVITESUBJECT", "�ѻP {SURVEYNAME}���ܽг�"); //Leave {SURVEYNAME} for replacement in scripts
define("_TC_REMINDSUBJECT", "�ѻP{SURVEYNAME}�����ܳ�"); //Leave {SURVEYNAME} for replacement in scripts
define("_TC_REMINDSTARTAT", "TID ���ҩl�s��:");
define("_TC_REMINDTID", "�e�� TID ���s��:");
define("_TC_CREATETOKENSINFO", "Click  /'�O/' �|���ާ@�N�X��W�����ާ@�N�X���Τ�۰ʲ��;ާ@�N�X�C�z�֩w�n�o�˰���?");
define("_TC_TOKENSCREATED", "�w�إ߾ާ@�N�X {TOKENCOUNT} "); //Leave {TOKENCOUNT} for replacement in script with the number of tokens created
define("_TC_TOKENDELETED", "�w�R���ާ@�N�X.");
define("_TC_SORTBY", "�ƧǪk�J");
define("_TC_ADDEDIT", "�s�W�έק�ާ@�N�X");
define("_TC_TOKENCREATEINFO", "�z�i�H�d�ť����, �ϥ� '�إ߾ާ@�N�X' �Ӧ۰ʫإ߾ާ@�N�X ");
define("_TC_TOKENADDED", "�s�W�ާ@�N�X");
define("_TC_TOKENUPDATED", "��s�ާ@�N�X");
define("_TC_UPLOADINFO", "�ĥμзǪ�CSV �ɮ׮榡 (�r�����j�����) �A�𶷨ϥΤ޸��C����]�A '�W�r, �m��, �q�l�a�}, [�ާ@�N�X]'.");
define("_TC_UPLOADFAIL", "�䤣��W���ɮסA���ˬd�W�ǥؿ����ϥ��v���θ��|�O�_���T?"); //New for 0.98rc5
define("_TC_IMPORT", "��JCSV �ɮ�");
define("_TC_CREATE", "�إ߾ާ@�N�X������");
define("_TC_TOKENS_CREATED", "�إߤF{TOKENCOUNT} ������");
define("_TC_NONETOSEND", "�����X��檺�q�l�a�}�i�H�o�X�A��]�i��O���ŦX�q�l�榡���n�D - ���e������Τ�o�X�ܽСA�S�Ϊ̬O�]���Τ�w�����ݨ��þ֦��ާ@�N�X�C");
define("_TC_NOREMINDERSTOSEND", "�����X��檺�q�l�a�}�i�H�o�X�C�o�O�]�����ŦX�H�U���󪺭n�D - �֦��q�l�a�}�B�ƫe�w�o�X�ܽСA�����|�������ݨ�.");
define("_TC_NOEMAILTEMPLATE", "�䤣���ܽЫH������ҲաA���ɮץ����s�b��w�]������Ҳո�Ƨ���.");
define("_TC_NOREMINDTEMPLATE", "�䤣�촣�ܳ檺����ҲաA���ɮץ����s�b��w�]������Ҳո�Ƨ���.");
define("_TC_SENDEMAIL", "�o�X�ܽ�");
define("_TC_SENDINGEMAILS", "�o�X�ܽ�");
define("_TC_SENDINGREMINDERS", "�e�X���ܳ�");
define("_TC_EMAILSTOGO", "���@��q�l�|���H�X�A�� click �H�U���s�H�X�q�l�C");
define("_TC_EMAILSREMAINING", "�٦� {EMAILCOUNT} �ʹq�l���ݱH�X�C"); //Leave {EMAILCOUNT} for replacement in script by number of emails remaining
define("_TC_SENDREMIND", "�e�X���ܳ�");
define("_TC_INVITESENTTO", "�ܽбH��:"); //is followed by token name
define("_TC_REMINDSENTTO", "���ܳ�H��:"); //is followed by token name
define("_TC_UPDATEDB", "Update tokens table with new fields"); //New for 0.98rc7

//labels.php
define("_LB_NEWSET", "�s�W���Ҷ�");
define("_LB_EDITSET", "�ק���Ҷ�");
define("_LB_FAIL_UPDATESET", "�L�k��s���Ҷ�");
define("_LB_FAIL_INSERTSET", "�L�k���J�s�����Ҷ�");
define("_LB_FAIL_DELSET", "����R�����Ҷ� - �]��������L�D�إ��b�ϥΥ��A�z�������R���o���D�ءA�~�i�R�����Ҷ��C");
define("_LB_ACTIVEUSE", "�z������s���B�s�W�ΧR�����Ҷ������ءA�]������]�ݨ����b�ϥΦ����Ҷ��C");
define("_LB_TOTALUSE", "�����ݨ����b�ϥγo�Ӽ��Ҷ��A�惡���Ҷ��@�X����ק�B�s�W�ΧR���A���|�靈���ݨ��y�����}����G�C");
//Export Labels
define("_EL_NOLID", "�������� LID�A�L�k�M�����Ҷ�.");
//Import Labels
define("_IL_GOLABELADMIN", "��^���Һ޲z�x");

//PHPSurveyor System Summary
define("_PS_TITLE", "PHPSurveyor �t��²��");
define("_PS_DBNAME", "��Ʈw�W��");
define("_PS_DEFLANG", "�w�]���y��");
define("_PS_CURLANG", "�{�ɨϥΪ��y��");
define("_PS_USERS", "�Τ�");
define("_PS_ACTIVESURVEYS", "�ҥΰݨ�");
define("_PS_DEACTSURVEYS", "���ΰݨ�");
define("_PS_ACTIVETOKENS", "�ҥξާ@�N�X��");
define("_PS_DEACTTOKENS", "���ξާ@�N�X��");
define("_PS_CHECKDBINTEGRITY", "Check PHPSurveyor Data Integrity"); //New with 0.98rc8

//Notification Levels
define("_NT_NONE", "�����q�l�q��"); //New with 098rc5
define("_NT_SINGLE", "�򥻹q�l�q��"); //New with 098rc5
define("_NT_RESULTS", "�e�X�q�l�q��/(���W�^�����G)/"); //New with 098rc5

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

?>
