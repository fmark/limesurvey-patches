<?php
// PORTUGUESE TRANSLATION PROVIDED BY ROSAURA GAZZOLA/JOB L�CIO VIEIRA

//BUTTON BAR TITLES
define("_ADMINISTRATION", "Administra��o");
define("_SURVEY", "Question�rio");
define("_GROUP", "Grupo");
define("_QUESTION", "Pergunta");
define("_ANSWERS", "Respostas");
define("_CONDITIONS", "Condi��es");
define("_HELP", "Ajuda");
define("_USERCONTROL", "Controle de Usu�rios");
define("_ACTIVATE", "Ativar question�rio");
define("_DEACTIVATE", "Desativar question�rio");
define("_CHECKFIELDS", "Revisar base de dados");
define("_CREATEDB", "Criar base de dados");
define("_CREATESURVEY", "Criar question�rio"); //New for 0.98rc4
define("_SETUP", "Configura��o do PHPSurveyor");
define("_DELETESURVEY", "Eliminar question�rio");
define("_EXPORTQUESTION", "Exportar pergunta");
define("_EXPORTSURVEY", "Exportar question�rio");
define("_EXPORTLABEL", "Exportar etiquetas");
define("_IMPORTQUESTION", "Importar pergunta");
define("_IMPORTGROUP", "Importar grupo"); //New for 0.98rc5
define("_IMPORTSURVEY", "Importar question�rio");
define("_IMPORTLABEL", "Importar etiquetas");
define("_EXPORTRESULTS", "Exportar respostas");
define("_BROWSERESPONSES", "Navegar pelas respostas");
define("_BROWSESAVED", "Browse Saved Responses");
define("_STATISTICS", "Estat�sticas r�pidas");
define("_VIEWRESPONSE", "Ver resposta");
define("_VIEWCONTROL", "Controle de dados");
define("_DATAENTRY", "Entrada de dados");
define("_TOKENCONTROL", "Controle de senhas");
define("_TOKENDBADMIN", "Op��es das senhas");
define("_DROPTOKENS", "Eliminar tabela de senhas");
define("_EMAILINVITE", "Enviar e-mail (E-mail)");
define("_EMAILREMIND", "Reenviar e-mail (E-mail)");
define("_TOKENIFY", "Criar senhas");
define("_UPLOADCSV", "Carregar arquivo CSV");
define("_LABELCONTROL", "Administra��o de etiquetas"); //NEW with 0.98rc3
define("_LABELSET", "Conjunto de etiquetas"); //NEW with 0.98rc3
define("_LABELANS", "Etiquetas"); //NEW with 0.98rc3
define("_OPTIONAL", "Optional"); //NEW with 0.98finalRC1

//DROPDOWN HEADINGS
define("_SURVEYS", "Question�rios");
define("_GROUPS", "Grupos");
define("_QUESTIONS", "Perguntas");
define("_QBYQ", "Pergunta por pergunta");
define("_GBYG", "Grupo por grupo");
define("_SBYS", "Todos em um");
define("_LABELSETS", "Etiquetas"); //New with 0.98rc3

//BUTTON MOUSEOVERS
//administration bar
define("_A_HOME_BT", "P�gina Administra��o");
define("_A_SECURITY_BT", "Modificar op��es de seguran�a");
define("_A_BADSECURITY_BT", "Ativar seguran�a");
define("_A_CHECKDB_BT", "Revisar base de dados");
define("_A_DELETE_BT", "Eliminar question�rio");
define("_A_ADDSURVEY_BT", "Criar ou importar novo question�rio");
define("_A_HELP_BT", "Mostrar ajuda");
define("_A_CHECKSETTINGS", "Revisar op��es do sistema");
define("_A_BACKUPDB_BT", "Backup Entire Database"); //New for 0.98rc10
define("_A_TEMPLATES_BT", "Template Editor"); //New for 0.98rc9
//Survey bar
define("_S_ACTIVE_BT", "Este question�rio est� ativo");
define("_S_INACTIVE_BT", "Este question�rio n�o est� ativo");
define("_S_ACTIVATE_BT", "Ativar question�rio");
define("_S_DEACTIVATE_BT", "Desativar question�rio");
define("_S_CANNOTACTIVATE_BT", "N�o � poss�vel ativar este question�rio");
define("_S_DOSURVEY_BT", "Responder question�rio");
define("_S_DATAENTRY_BT", "Entrada de dados para o question�rio");
define("_S_PRINTABLE_BT", "Vers�o para imprimir");
define("_S_EDIT_BT", "Modificar question�rio selecionado");
define("_S_DELETE_BT", "Eliminar question�rio selecionado");
define("_S_EXPORT_BT", "Exportar question�rio");
define("_S_BROWSE_BT", "Navegar pelas respostas do question�rio");
define("_S_TOKENS_BT", "Ativar/modificar senhas para este question�rio");
define("_S_ADDGROUP_BT", "Adicionar novo grupo ao question�rio");
define("_S_MINIMISE_BT", "Ocultar detalhes deste question�rio");
define("_S_MAXIMISE_BT", "Mostrar detalhes deste question�rio");
define("_S_CLOSE_BT", "Fechar question�rio");
define("_S_SAVED_BT", "View Saved but not submitted Responses"); //New in 0.99dev01
define("_S_ASSESSMENT_BT", "Set assessment rules"); //New in  0.99dev01
//Group bar
define("_G_EDIT_BT", "Modificar grupo selecionado");
define("_G_EXPORT_BT", "Exportar este grupo"); //New in 0.98rc5
define("_G_DELETE_BT", "Eliminar grupo selecionado");
define("_G_ADDQUESTION_BT", "Adicionar nova pergunta ao grupo");
define("_G_MINIMISE_BT", "Ocultar detalhes deste grupo");
define("_G_MAXIMISE_BT", "Mostrar detalhes deste grupo");
define("_G_CLOSE_BT", "Fechar este grupo");
//Question bar
define("_Q_EDIT_BT", "Modificar pergunta selecionada");
define("_Q_COPY_BT", "Copiar pergunta selecionada"); //New in 0.98rc4
define("_Q_DELETE_BT", "Eliminar pergunta selecionada");
define("_Q_EXPORT_BT", "Exportar Pergunta");
define("_Q_CONDITIONS_BT", "Estabelecer condi��es para esta pergunta");
define("_Q_ANSWERS_BT", "Modificar/adicionar respostas para esta pergunta");
define("_Q_LABELS_BT", "Modificar/adicionar etiquetas");
define("_Q_MINIMISE_BT", "Ocultar detalhes desta pergunta");
define("_Q_MAXIMISE_BT", "Mostrar detalhes desta pergunta");
define("_Q_CLOSE_BT", "Fechar esta pergunta");
//Browse Button Bar
define("_B_ADMIN_BT", "Voltar � administra��o do question�rio");
define("_B_SUMMARY_BT", "Mostrar informa��es");
define("_B_ALL_BT", "Mostrar todas respostas");
define("_B_LAST_BT", "Mostrar as �ltimas 50 respostas");
define("_B_STATISTICS_BT", "Gerar estat�sticas a partir dessas respostas");
define("_B_EXPORT_BT", "Exportar resultados para alguma aplica��o");
define("_B_BACKUP_BT", "Exportar a tabela de resultados como arquivo SQL");
//Tokens Button Bar
define("_T_ALL_BT", "Mostrar senhas");
define("_T_ADD_BT", "Adicionar uma nova senha");
define("_T_IMPORT_BT", "Importar senhas do arquivo CSV");
define("_T_EXPORT_BT", "Exportar senhas para arquivo CSV"); //New for 0.98rc7
define("_T_INVITE_BT", "Enviar e-mail (E-mail)");
define("_T_REMIND_BT", "Reenviar e-mail (E-mail)");
define("_T_TOKENIFY_BT", "Gerar senhas");
define("_T_KILL_BT", "Apagar tabela de senhas");
//Labels Button Bar
define("_L_ADDSET_BT", "Adicionar etiquetas");
define("_L_EDIT_BT", "Modificar etiquetas");
define("_L_DEL_BT", "Apagar etiquetas");
//Datacontrols
define("_D_BEGIN", "Mostrar in�cio");
define("_D_BACK", "Mostrar anterior");
define("_D_FORWARD", "Mostrar seguinte");
define("_D_END", "Mostrar �ltima");

//DATA LABELS
//surveys
define("_SL_TITLE", "T�tulo:");
define("_SL_SURVEYURL", "Question�rio URL:"); //new in 0.98rc5
define("_SL_DESCRIPTION", "Descri��o:");
define("_SL_WELCOME", "Bem-vinda:");
define("_SL_ADMIN", "Administrador:");
define("_SL_EMAIL", "Correio eletr�nico do administrador:");
define("_SL_FAXTO", "N�mero de Fax:");
define("_SL_ANONYMOUS", "An�nimo?");
define("_SL_EXPIRES", "Expira:");
define("_SL_FORMAT", "Formato:");
define("_SL_DATESTAMP", "Colocar data?");
define("_SL_TEMPLATE", "Planilha:");
define("_SL_LANGUAGE", "Idioma:");
define("_SL_LINK", "Link:");
define("_SL_URL", "URL de sa�da:");
define("_SL_URLDESCRIP", "Descri��o da URL:");
define("_SL_STATUS", "Status:");
define("_SL_SELSQL", "Selecionar arquivo SQL:");
define("_SL_USECOOKIES", "Utilizar cookies?"); //NEW with 098rc3
define("_SL_NOTIFICATION", "Notifica��o:"); //New with 098rc5
define("_SL_ALLOWREGISTER", "Allow public registration?"); //New with 0.98rc9
define("_SL_ATTRIBUTENAMES", "Token Attribute Names:"); //New with 0.98rc9
define("_SL_EMAILINVITE_SUBJ", "Invitation Email Subject:"); //New with 0.99dev01
define("_SL_EMAILINVITE", "Invitation Email:"); //New with 0.98rc9
define("_SL_EMAILREMIND_SUBJ", "Email Reminder Subject:"); //New with 0.99dev01
define("_SL_EMAILREMIND", "Email Reminder:"); //New with 0.98rc9
define("_SL_EMAILREGISTER_SUBJ", "Public registration Email Subject:"); //New with 0.99dev01
define("_SL_EMAILREGISTER", "Public registration Email:"); //New with 0.98rc9
define("_SL_EMAILCONFIRM_SUBJ", "Confirmation Email Subject"); //New with 0.99dev01
define("_SL_EMAILCONFIRM", "Confirmation Email"); //New with 0.98rc9
define("_SL_REPLACEOK", "This will replace the existing text. Continue?"); //New with 0.98rc9
define("_SL_ALLOWSAVE", "Allow Saves?"); //New with 0.99dev01
define("_SL_AUTONUMBER", "Start ID numbers at:"); //New with 0.99dev01
define("_SL_AUTORELOAD", "Automatically load URL when survey complete?"); //New with 0.99dev01
define("_SL_ALLOWPREV", "Show [<< Prev] button"); //New with 0.99dev01
define("_SL_USE_DEFAULT","Use default");
define("_SL_UPD_SURVEY","Update survey");

//groups
define("_GL_TITLE", "T�tulo:");
define("_GL_DESCRIPTION", "Descri��o:");
define("_GL_EDITGROUP", "Editar grupo para o question�rio com");
define("_GL_UPDATEGROUP", "Atualizar grupo");



//questions
define("_QL_EDITQUESTION", "Modificar pergunta");
define("_QL_UPDATEQUESTION", "Atualizar pergunta");
define("_QL_CODE", "C�digo:");
define("_QL_QUESTION", "Pergunta:");
define("_QL_VALIDATION", "Validation:"); //New in VALIDATION VERSION
define("_QL_HELP", "Ajuda:");
define("_QL_TYPE", "Tipo:");
define("_QL_GROUP", "Grupo:");
define("_QL_MANDATORY", "Obrigat�ria:");
define("_QL_OTHER", "Outro:");
define("_QL_LABELSET", "Etiquetas:");
define("_QL_COPYANS", "Copiar respostas?"); //New in 0.98rc3
define("_QL_QUESTIONATTRIBUTES", "Question Attributes:"); //New in 0.99dev01
define("_QL_COPYATT", "Copy Attributes?"); //New in 0.99dev01
//answers
define("_AL_CODE", "C�digo");
define("_AL_ANSWER", "Resposta");
define("_AL_DEFAULT", "Padr�o");
define("_AL_MOVE", "Mover");
define("_AL_ACTION", "A��o");
define("_AL_UP", "Acima");
define("_AL_DN", "Abaixo");
define("_AL_SAVE", "Guardar");
define("_AL_DEL", "Apagar");
define("_AL_ADD", "Adicionar");
define("_AL_FIXSORT", "Corrigir Ordem");
define("_AL_SORTALPHA", "Ordenar alfabeticamente"); //New in 0.98rc8 - Sort Answers Alphabetically
//users
define("_UL_USER", "Usu�rio");
define("_UL_PASSWORD", "Senha");
define("_UL_SECURITY", "Seguran�a");
define("_UL_ACTION", "A��o");
define("_UL_EDIT", "Modificar");
define("_UL_DEL", "Apagar");
define("_UL_ADD", "Adicionar");
define("_UL_TURNOFF", "Desativar seguran�a");
//tokens
define("_TL_FIRST", "Nome");
define("_TL_LAST", "Sobrenomes");
define("_TL_EMAIL", "E-mail");
define("_TL_TOKEN", "Senha");
define("_TL_INVITE", "Convite enviado?");
define("_TL_DONE", "Completo?");
define("_TL_ACTION", "A��es");
define("_TL_ATTR1", "Atributo_1"); //New for 0.98rc7
define("_TL_ATTR2", "Atributo_2"); //New for 0.98rc7


define("_TL_MPID", "MPID"); //New for 0.98rc7
//labels
define("_LL_NAME", "Nome do conjunto"); //NEW with 098rc3
define("_LL_CODE", "C�digo"); //NEW with 098rc3
define("_LL_ANSWER", "T�tulo"); //NEW with 098rc3
define("_LL_SORTORDER", "Ordem"); //NEW with 098rc3
define("_LL_ACTION", "A��o"); //New with 098rc3

//QUESTION TYPES
define("_5PT", "Escolher entre 5 Pontos");
define("_DATE", "Data");
define("_GENDER", "G�nero");
define("_LIST", "Lista");
define("_LIST_DROPDOWN", "Lista (Dropdown)"); //New with 0.99dev01
define("_LISTWC", "Lista com coment�rios");
define("_MULTO", "M�ltiplas op��es");
define("_MULTOC", "M�ltiplas op��es com coment�rios");
define("_MULTITEXT", "V�rios textos curtos");
define("_NUMERICAL", "Entrada num�rica");
define("_RANK", "Ordenar/Fila");
define("_STEXT", "Texto curto");
define("_LTEXT", "Texto longo");
define("_HTEXT", "Huge free text"); //New with 0.99dev01
define("_YESNO", "Sim/N�o");
define("_ARR5",  "Arranjo (Escolher entre 5 Pontos)");
define("_ARR10", "Arranjo (Escolher entre 10 Pontos)");
define("_ARRYN", "Arranjo (Sim/N�o/Duvidoso)");
define("_ARRMV", "Arranjo (Ampliar, Manter, Reduzir)");
define("_ARRFL", "Arranjo (Etiquetas Flex�veis)"); //Release 0.98rc3
define("_ARRFLC", "Arranjo (Etiquetas Flex�veis por Coluna"); //Release 0.98rc8
define("_SINFL", "Simples (Etiquetas Flex�veis)"); //(FOR LATER RELEASE)
define("_EMAIL", "Correio Eletr�nico"); //FOR LATER RELEASE
define("_BOILERPLATE", "Quest�o Boilerplate"); //New in 0.98rc6
define("_LISTFL_DROPDOWN", "List (Flexible Labels) (Dropdown)"); //New in 0.99dev01
define("_LISTFL_RADIO", "List (Flexible Labels) (Radio)"); //New in 0.99dev01

//GENERAL WORDS AND PHRASES
define("_AD_YES", "Sim");
define("_AD_NO", "N�o");
define("_AD_CANCEL", "Cancelar");
define("_AD_CHOOSE", "Escolher...");
define("_AD_OR", "ou"); //New in 0.98rc4
define("_ERROR", "Erro");
define("_SUCCESS", "�xito");
define("_REQ", "Obrigat�ria");
define("_ADDS", "Adicionar question�rio");
define("_ADDG", "Adicionar grupo");
define("_ADDQ", "Adicionar pergunta");
define("_ADDA", "Adicionar resposta"); //New in 0.98rc4
define("_COPYQ", "Copiar pergunta"); //New in 0.98rc4
define("_ADDU", "Adicionar usu�rio");
define("_SEARCH", "Buscar"); //New in 0.98rc4
define("_SAVE", "Guardar mudan�as");
define("_NONE", "Nenhum"); //as in "Do not display anything", "or none chosen";
define("_GO_ADMIN", "Administra��o Principal"); //text to display to return/display main administration screen
define("_CONTINUE", "Continuar");
define("_WARNING", "Advert�ncia");
define("_USERNAME", "Nome do Usu�rio");
define("_PASSWORD", "Senha");
define("_DELETE", "Apagar");
define("_CLOSEWIN", "Fechar Janela");
define("_TOKEN", "Senha");
define("_DATESTAMP", "Data"); //Referring to the datestamp or time response submitted
define("_COMMENT", "Coment�rio");
define("_FROM", "De:"); //For emails
define("_SUBJECT", "Assunto:"); //For emails
define("_MESSAGE", "Mensagem:"); //For emails
define("_RELOADING", "Carregando.... Favor esperar.");
define("_ADD", "Adicionar");
define("_UPDATE", "Atualizar");
define("_BROWSE", "Navegador"); //New in 098rc5
define("_AND", "e"); //New with 0.98rc8
define("_SQL", "SQL"); //New with 0.98rc8
define("_PERCENTAGE", "Percentagem"); //New with 0.98rc8
define("_COUNT", "Contagem"); //New with 0.98rc8

//SURVEY STATUS MESSAGES (new in 0.98rc3)
define("_SS_NOGROUPS", "N�mero de grupos do question�rio:"); //NEW for release 0.98rc3
define("_SS_NOQUESTS", "N�mero de perguntas do question�rio:"); //NEW for release 0.98rc3
define("_SS_ANONYMOUS", "Este question�rio � an�nimo."); //NEW for release 0.98rc3
define("_SS_TRACKED", "Este question�rio N�O � an�nimo."); //NEW for release 0.98rc3
define("_SS_DATESTAMPED", "As respostas conter�o a data"); //NEW for release 0.98rc3
define("_SS_COOKIES", "Utiliza \"cookies\" para o controle de acesso."); //NEW for release 0.98rc3
define("_SS_QBYQ", "Mostrar pergunta por pergunta."); //NEW for release 0.98rc3
define("_SS_GBYG", "Mostrar grupo por grupo."); //NEW for release 0.98rc3
define("_SS_SBYS", "Mostrar numa p�gina."); //NEW for release 0.98rc3
define("_SS_ACTIVE", "O question�rio est� ativo."); //NEW for release 0.98rc3
define("_SS_NOTACTIVE", "O question�rio N�O est� ativo."); //NEW for release 0.98rc3
define("_SS_SURVEYTABLE", "O nome da tabela do question�rio �:"); //NEW for release 0.98rc3
define("_SS_CANNOTACTIVATE", "O question�rio ainda n�o pode ser ativado."); //NEW for release 0.98rc3
define("_SS_ADDGROUPS", "� necess�rio adicionar grupos"); //NEW for release 0.98rc3
define("_SS_ADDQUESTS", "� necess�rio adicionar perguntas"); //NEW for release 0.98rc3
define("_SS_ALLOWREGISTER", "If tokens are used, the public may register for this survey"); //NEW for release 0.98rc9
define("_SS_ALLOWSAVE", "Participants can save partially finished surveys"); //NEW for release 0.99dev01

//QUESTION STATUS MESSAGES (new in 0.98rc4)
define("_QS_MANDATORY", "Pergunta obrigat�ria"); //New for release 0.98rc4
define("_QS_OPTIONAL", "Pergunta opcional"); //New for release 0.98rc4
define("_QS_NOANSWERS", "� necess�rio colocar respostas para esta pergunta"); //New for release 0.98rc4
define("_QS_NOLID", "� necess�rio selecionar um conjunto de etiquetas para esta pergunta"); //New for release 0.98rc4
define("_QS_COPYINFO", "Nota: introduza um c�digo de pergunta novo"); //New for release 0.98rc4

//General Setup Messages
define("_ST_NODB1", "A base de dados do sistema n�o existe");
define("_ST_NODB2", "A base de dados selecionada n�o foi criada ou h� problemas para acess�-la.");
define("_ST_NODB3", "PHPSurveyor pode tentar criar a base de dados.");
define("_ST_NODB4", "O nome da base de dados selecionada �:");
define("_ST_CREATEDB", "Criar base de dados");

//USER CONTROL MESSAGES
define("_UC_CREATE", "Criando arquivo .htaccess default");
define("_UC_NOCREATE", "N�o foi poss�vel criar o arquivo .htaccess Revisar o valor de \$homedir no arquivo config.php com permiss�o de grava��o.");
define("_UC_SEC_DONE", "Foram criados os n�veis de seguran�a!");
define("_UC_CREATE_DEFAULT", "Criando usu�rios");
define("_UC_UPDATE_TABLE", "Atualizando tabela de usu�rios");
define("_UC_HTPASSWD_ERROR", "Ocorreu um erro ao criar o arquivo .htpasswd");
define("_UC_HTPASSWD_EXPLAIN", "Para servidores Windows � recomendado copiar o arquivo htpasswd.exe do apache para o diret�rio admin, para funcionar corretamente.");
define("_UC_SEC_REMOVE", "Removendo op��es de seguran�a");
define("_UC_ALL_REMOVED", "Arquivo de acesso, de senhas e base de dados de usu�rios apagados");
define("_UC_ADD_USER", "Adicionando Usu�rio");
define("_UC_ADD_MISSING", "N�o foi poss�vel adicionar o usu�rio. Faltou Nome do Usu�rio e/ou Senha");
define("_UC_DEL_USER", "Apagando o Usu�rio");
define("_UC_DEL_MISSING", "N�o foi poss�vel apagar o usu�rio. Faltou Nome do Usu�rio.");
define("_UC_MOD_USER", "Modificando o Usu�rio");
define("_UC_MOD_MISSING", "N�o foi poss�vel mudar o usu�rio. Faltaram Nome do Usu�rio e/ou Senha");
define("_UC_TURNON_MESSAGE1", "N�o foram iniciadas as op��es de seguran�a para o sistema de question�rios e como conseq��ncia n�o h� restri��es de acesso. Clique no bot�o 'Iniciar Seguran�a', op��es standard de seguran�a do APACHE ser�o adicionadas ao diret�rio de administra��o do sistema. Utilizar� os valores padr�es de nome do usu�rio e senha para acessar a tela de administra��o.");
define("_UC_TURNON_MESSAGE2", "� recomend�vel ap�s iniciar o sistema de seguran�a, mudar a senha.");
define("_UC_INITIALISE", "Iniciar Seguran�a");
define("_UC_NOUSERS", "N�o existem usu�rios em sua tabela. � recomend�vel desativar a seguran�a, para logo ativ�-la novamente.");
define("_UC_TURNOFF", "Desativar Seguran�a");

//Activate and deactivate messages
define("_AC_MULTI_NOANSWER", "Esta pergunta  � de m�ltiplas respostas por�m ainda n�o tem respostas definidas para ela");
define("_AC_NOTYPE", "Esta pergunta ainda n�o tem designado o 'tipo' de pergunta.");
define("_AC_NOLID", "Esta quest�o requer uma etiqueta, por�m nenhuma foi designada."); //New for 0.98rc8
define("_AC_CON_OUTOFORDER", "Esta pergunta est� associada a uma condi��o, por�m esta condi��o est� baseada numa pergunta que aparece depois dela..");
define("_AC_FAIL", "O question�rio n�o passou pela revis�o de consist�ncia");
define("_AC_PROBS", "Foram encontrados os seguintes problemas:");
define("_AC_CANNOTACTIVATE", "O question�rio n�o poder� ser ativado at� que sejam resolvidos todos problemas");
define("_AC_READCAREFULLY", "LEIA CUIDADOSAMENTE ANTES DE PROSSEGUIR");
define("_AC_ACTIVATE_MESSAGE1", "Ative um question�rio somente quando estiver absolutamente seguro(a) de que a configura��o do question�rio est� correta e que n�o haver� mais mudan�as.");
define("_AC_ACTIVATE_MESSAGE2", "Ap�s a ativa��o do question�rio voc� n�o poder�: Adicionar ou apagar Grupos. Adicionar ou apagar respostas a perguntas de M�ltiplas Op��es. Adicionar ou apagar perguntas");
define("_AC_ACTIVATE_MESSAGE3", "Por�m, poder�: Modificar os c�digos das perguntas, texto ou tipo. Modificar os nomes dos grupos. Adicionar, apagar ou modificar respostas pr�-definidas (exceto perguntas de m�ltiplas respostas). Modificar o nome ou descri��o do question�rio");
define("_AC_ACTIVATE_MESSAGE4", "Se deseja adicionar ou apagar grupos ou perguntas uma vez que o question�rio j� tenha sido respondido pelo menos uma vez, dever� desativar o question�rio, com o que, mover� toda informa��o j� existente a outra tabela para ser arquivada.")
define("_AC_ACTIVATE", "Ativar");
define("_AC_ACTIVATED", "O question�rio foi ativado. A tabela de resultados foi criada com �xito.");
define("_AC_NOTACTIVATED", "O question�rio n�o pode ser ativado.");
define("_AC_NOTPRIVATE", "Este question�rio n�o � an�nimo. Deve-se criar uma tabela de senhas.");
define("_AC_REGISTRATION", "This survey allows public registration. A token table must also be created.");
define("_AC_CREATETOKENS", "Iniciar Senhas");
define("_AC_SURVEYACTIVE", "O question�rio foi ativado e agora as respostas podem ser armazenadas.");
define("_AC_DEACTIVATE_MESSAGE1", "Num question�rio ativo, � criada uma tabela para armazenar as respostas.");
define("_AC_DEACTIVATE_MESSAGE2", "Ao desativar um question�rio, TODOS DADOS que foram introduzidos na tabela original ser�o movidos para outra tabela. Quando voltar a ativar novamente o question�rio, a tabela estar� vazia. O acesso aos dados atrav�s do PHPSurveyor ser� perdido.");
define("_AC_DEACTIVATE_MESSAGE3", "Os dados de um question�rio que n�o foi desativado, somente podem ser acessados por um usu�rio com acesso � base de dados. Caso esse question�rio utilize senhas, esta tabela tamb�m ser� renomeada e somente estar� acess�vel aos administradores do sistema.");
define("_AC_DEACTIVATE_MESSAGE4", "A tabela de respostas ser� renomeada para:");
define("_AC_DEACTIVATE_MESSAGE5", "Exporte as respostas antes de desativar o question�rio. Clique em \"Cancelar\" para voltar a tela de administra��o sem desativar o question�rio.");
define("_AC_DEACTIVATE", "Desativar");
define("_AC_DEACTIVATED_MESSAGE1", "A tabela de respostas foi renomeada para: ");
define("_AC_DEACTIVATED_MESSAGE2", "As respostas ao question�rio j� n�o est�o dispon�veis no PHPSurveyor.");
define("_AC_DEACTIVATED_MESSAGE3", "Anote o nome desta tabela, caso deseje acess�-la posteriormente.");
define("_AC_DEACTIVATED_MESSAGE4", "A tabela de senhas associada a este question�rio foi renomeada para: ");

//CHECKFIELDS
define("_CF_CHECKTABLES", "Verificando a exist�ncia de todas tabelas");
define("_CF_CHECKFIELDS", "Verificando a exist�ncia de todos campos");
define("_CF_CHECKING", "Verificando");
define("_CF_TABLECREATED", "Tabela Criada");
define("_CF_FIELDCREATED", "Campo Criado");
define("_CF_OK", "OK");
define("_CFT_PROBLEM", "Verifique a aus�ncia de tabelas ou campos na base de dados.");

//CREATE DATABASE (createdb.php)
define("_CD_DBCREATED", "A Base de Dados foi criada.");
define("_CD_POPULATE_MESSAGE", "Clique para preencher a base de dados");
define("_CD_POPULATE", "Preencher Base de Dados");
define("_CD_NOCREATE", "N�o foi poss�vel criar a base de dados");
define("_CD_NODBNAME", "A informa��o para acessar a base de dados n�o foi fornecida. Este script deve ser executado somente no admin.php.");

//DATABASE MODIFICATION MESSAGES
define("_DB_FAIL_GROUPNAME", "N�o foi poss�vel adicionar o grupo. Falta o nome do grupo.");
define("_DB_FAIL_GROUPUPDATE", "N�o foi poss�vel atualizar o grupo.");
define("_DB_FAIL_GROUPDELETE", "N�o foi poss�vel apagar o grupo.");
define("_DB_FAIL_NEWQUESTION", "N�o foi poss�vel criar a pergunta.");
define("_DB_FAIL_QUESTIONTYPECONDITIONS", "N�o foi poss�vel atualizar a pergunta. H� condi��es em outras perguntas que dependem das respostas dadas. Mudando seu tipo causar� problemas. Para mudar esse tipo de pergunta, dever� eliminar as condi��es.");
define("_DB_FAIL_QUESTIONUPDATE", "N�o foi poss�vel atualizar a pergunta");
define("_DB_FAIL_QUESTIONDELCONDITIONS", "N�o foi poss�vel apagar a pergunta. H� condi��es em outras perguntas que dependem desta. Esta pergunta n�o poder� ser apagada at� retirar estas condi��es.");
define("_DB_FAIL_QUESTIONDELETE", "N�o foi poss�vel apagar a pergunta.");
define("_DB_FAIL_NEWANSWERMISSING", "N�o foi poss�vel adicionar a resposta. � necess�rio incluir o C�digo e uma Resposta.");
define("_DB_FAIL_NEWANSWERDUPLICATE", "N�o foi poss�vel adicionar a resposta. J� existe uma resposta com este c�digo.");
define("_DB_FAIL_ANSWERUPDATEMISSING", "N�o foi poss�vel atualizar a resposta. � necess�rio incluir o C�digo e uma Resposta.");
define("_DB_FAIL_ANSWERUPDATEDUPLICATE", "N�o foi poss�vel atualizar a resposta. J� existe uma resposta com este c�digo.");
define("_DB_FAIL_ANSWERUPDATECONDITIONS", "N�o foi poss�vel adicionar a resposta. O c�digo foi modificado, por�m h� condi��es em outras perguntas que dependem do c�digo anterior. Apagar as condi��es antes de modificar o c�digo desta resposta.");
define("_DB_FAIL_ANSWERDELCONDITIONS", "N�o foi poss�vel apagar a resposta. H� condi��es em outras perguntas que dependem desta resposta. A resposta n�o pode ser apagada at� que se retirem estas condi��es.");
define("_DB_FAIL_NEWSURVEY_TITLE", "N�o foi poss�vel criar o question�rio porque n�o havia o t�tulo curto.");
define("_DB_FAIL_NEWSURVEY", "N�o foi poss�vel criar o question�rio.");
define("_DB_FAIL_SURVEYUPDATE", "N�o foi poss�vel atualizar o question�rio.");
define("_DB_FAIL_SURVEYDELETE", "N�o foi poss�vel apagar o question�rio.");

//DELETE SURVEY MESSAGES
define("_DS_NOSID", "N�o foi selecionado question�rio para exclus�o.");
define("_DS_DELMESSAGE1", "Este question�rio ser� exclu�do.");
define("_DS_DELMESSAGE2", "Este processo excluir� o question�rio, junto com todos grupos, perguntas, respostas e condi��es relacionadas.");
define("_DS_DELMESSAGE3", "� recomend�vel que antes de excluir este question�rio, exporte-o inteiro desde a p�gina de administra��o.");
define("_DS_SURVEYACTIVE", "Este question�rio est� ativo e existe uma tabela de respostas. Caso exclua o question�rio, estas respostas ser�o perdidas. Recomenda-se export�-las antes da exclus�o do question�rio.");
define("_DS_SURVEYTOKENS", "Este question�rio est� ativo e existe uma tabela de senhas. Caso seja exclu�do, estas senhas ser�o perdidas. Recomenda-se export�-las antes da exclus�o do question�rio.");
define("_DS_DELETED", "O question�rio foi exclu�do.");

//DELETE QUESTION AND GROUP MESSAGES
define("_DG_RUSURE", "Exluir este grupo tamb�m exluir� qualquer pergunta e resposta que contenha. Est� seguro que deseja continuar?"); //New for 098rc5
define("_DQ_RUSURE", "Excluir esta pergunta tamb�m excluir� qualquer resposta que contenha. Est� seguro que deseja continuar?"); //New for 098rc5

//EXPORT MESSAGES
define("_EQ_NOQID", "N�o foi indicado um QID. N�o foi poss�vel exportar as perguntas.");
define("_ES_NOSID", "N�o foi indicado um SID. N�o foi poss�vel exportar o question�rio");

//EXPORT RESULTS
define("_EX_FROMSTATS", "Filtrado do Script de Estat�sticas");
define("_EX_HEADINGS", "Perguntas");
define("_EX_ANSWERS", "Respostas");
define("_EX_FORMAT", "Formato");
define("_EX_HEAD_ABBREV", "Cabe�alho Abreviado");
define("_EX_HEAD_FULL", "Cabe�alho Completo");
define("_EX_ANS_ABBREV", "C�digos das Respostas");
define("_EX_ANS_FULL", "Respostas Completas");
define("_EX_FORM_WORD", "Microsoft Word");
define("_EX_FORM_EXCEL", "Microsoft Excel");
define("_EX_FORM_CSV", "CSV Delimitado por V�rgulas");
define("_EX_EXPORTDATA", "Exportar Dados");
define("_EX_COLCONTROLS", "Controle da Coluna"); //New for 0.98rc7
define("_EX_TOKENCONTROLS", "Controle da Senha"); //New for 0.98rc7
define("_EX_COLSELECT", "Selecione colunas"); //New for 0.98rc7
define("_EX_COLOK", "Selecione as colunas que desejas exportar. Sem sele��o, exportar� todas colunas."); //New for 0.98rc7
define("_EX_COLNOTOK", "Seu question�rio cont�m mais do que 255 colunas de respostas. Aplica��es de folha de c�lculo como Excel se limitam a carregar n�o mais que 255. Selecione as colunas que deseja exportar na lista abaixo."); //New for 0.98rc7
define("_EX_TOKENMESSAGE", "Seu question�rio pode exportar cada resposta associada a senha. Selecione um campo que gostaria de exportar."); //New for 0.98rc7
define("_EX_TOKSELECT", "Escolha Campos de Senha"); //New for 0.98rc7

//IMPORT SURVEY MESSAGES
define("_IS_FAILUPLOAD", "Ocorreu um erro ao carregar o arquivo. Pode ser sido causado porque o diret�rio de administra��o tem permiss�es incorretas.");
define("_IS_OKUPLOAD", "Carregou o arquivo com �xito.");
define("_IS_READFILE", "Lendo o arquivo..");
define("_IS_WRONGFILE", "O formato do arquivo n�o � do PHPSurveyor. A importa��o falhou.");
define("_IS_IMPORTSUMMARY", "Resumo da Importa��o do question�rio");
define("_IS_SUCCESS", "A importa��o do question�rio foi realizada com �xito.");
define("_IS_IMPFAILED", "A importa��o do question�rio falhou.");
define("_IS_FILEFAILS", "O arquivo n�o cont�m um formato PHPSurveyor v�lido.");

//IMPORT GROUP MESSAGES
define("_IG_IMPORTSUMMARY", "Resumo da importa��o do Grupo");
define("_IG_SUCCESS", "Foi realizada com �xito a importa��o do grupo.");
define("_IG_IMPFAILED", "A importa��o do grupo falhou.");
define("_IG_WRONGFILE", "O arquivo n�o cont�m um formato PHPSurveyor v�lido.");

//IMPORT QUESTION MESSAGES
define("_IQ_NOSID", "N�o foi indicado um SID (question�rio). N�o foi poss�vel importar a pergunta.");
define("_IQ_NOGID", "N�o foi indicado um GID (Grupo). N�o foi poss�vel importar a pergunta");
define("_IQ_WRONGFILE", "Este arquivo n�o � um arquivo de pergunta PHPSurveyor v�lido. Falhou a importa��o.");
define("_IQ_IMPORTSUMMARY", "Resumo da Importa��o da Pergunta");
define("_IQ_SUCCESS", "Foi completada com �xito a importa��o da pergunta");

//IMPORT LABELSET MESSAGES
define("_IL_DUPLICATE", "There was a duplicate labelset, so this set was not imported. The duplicate will be used instead.");

//BROWSE RESPONSES MESSAGES
define("_BR_NOSID", "N�o foi selecionado um question�rio para navegar.");
define("_BR_NOTACTIVATED", "Este question�rio n�o foi ativado. N�o h� resultados para navegar.");
define("_BR_NOSURVEY", "N�o foi encontrado nenhum question�rio.");
define("_BR_EDITRESPONSE", "Editar esta entrada");
define("_BR_DELRESPONSE", "Eliminar esta entrada");
define("_BR_DISPLAYING", "Registros exibidos:");
define("_BR_STARTING", "Come�ando desde:");
define("_BR_SHOW", "Mostrar");
define("_DR_RUSURE", "Est� certo(a) de apagar esta entrada?"); //New for 0.98rc6

//STATISTICS MESSAGES
define("_ST_FILTERSETTINGS", "Op��es do Filtro");
define("_ST_VIEWALL", "Resumo de todos campos dispon�veis"); //New with 0.98rc8
define("_ST_SHOWRESULTS", "Ver Estat�stica"); //New with 0.98rc8
define("_ST_CLEAR", "Limpar"); //New with 0.98rc8
define("_ST_RESPONECONT", "Respostas Contendo"); //New with 0.98rc8
define("_ST_NOGREATERTHAN", "N�mero maior do que"); //New with 0.98rc8
define("_ST_NOLESSTHAN", "N�mero menor do que"); //New with 0.98rc8
define("_ST_DATEEQUALS", "Data (AAAA-MM-DD)"); //New with 0.98rc8
define("_ST_ORBETWEEN", "OU entre"); //New with 0.98rc8
define("_ST_RESULTS", "Resultados"); //New with 0.98rc8 (Plural)
define("_ST_RESULT", "Resultado"); //New with 0.98rc8 (Singular)
define("_ST_RECORDSRETURNED", "N�mero de perguntas neste question�rio"); //New with 0.98rc8
define("_ST_TOTALRECORDS", "Total respostas no question�rio"); //New with 0.98rc8
define("_ST_PERCENTAGE", "Percentagem do total"); //New with 0.98rc8
define("_ST_FIELDSUMMARY", "Campo Resumido para"); //New with 0.98rc8
define("_ST_CALCULATION", "Calcular"); //New with 0.98rc8
define("_ST_SUM", "Soma"); //New with 0.98rc8 - Mathematical
define("_ST_STDEV", "Desvio Padr�o"); //New with 0.98rc8 - Mathematical
define("_ST_AVERAGE", "M�dia"); //New with 0.98rc8 - Mathematical
define("_ST_MIN", "M�nimo"); //New with 0.98rc8 - Mathematical
define("_ST_MAX", "M�ximo"); //New with 0.98rc8 - Mathematical
define("_ST_Q1", "primeiro Quartil (Q1)"); //New with 0.98rc8 - Mathematical
define("_ST_Q2", "segundo Quartil (Mediana)"); //New with 0.98rc8 - Mathematical
define("_ST_Q3", "terceiro Quartil (Q3)"); //New with 0.98rc8 - Mathematical
define("_ST_NULLIGNORED", "*valores nulos s�o ignorados nos c�lculos"); //New with 0.98rc8
define("_ST_QUARTMETHOD", "*Q1 e Q3 calculados usando <a href='http://mathforum.org/library/drmath/view/60969.html' target='_blank'>minitab method</a>"); //New with 0.98rc8

//DATA ENTRY MESSAGES
define("_DE_NOMODIFY", "N�o pode ser modificado");
define("_DE_UPDATE", "Atualizar Entrada");
define("_DE_NOSID", "N�o selecionou um question�rio para o qual realizar a entrada de dados.");
define("_DE_NOEXIST", "O question�rio que selecionou n�o existe");
define("_DE_NOTACTIVE", "Este question�rio n�o foi ativado. Suas respostas n�o ser�o armazenadas.");
define("_DE_INSERT", "Guardando Dados");
define("_DE_RECORD", "Na entrada foi dado o seguinte id: ");
define("_DE_ADDANOTHER", "Adicionar Outro Registro");
define("_DE_VIEWTHISONE", "Ver Este Registro");
define("_DE_BROWSE", "Navegar pelas Respostas");
define("_DE_DELRECORD", "Registro Apagado");
define("_DE_UPDATED", "O registro foi atualizado.");
define("_DE_EDITING", "Modificando Resposta");
define("_DE_QUESTIONHELP", "Ajuda sobre esta pergunta");
define("_DE_CONDITIONHELP1", "Responda esta pergunta somente sob as seguintes condi��es:");
define("_DE_CONDITIONHELP2", "Para a pergunta {QUESTION}, a resposta foi {ANSWER}"); //Poder� haver problemas, dependendo da sintaxe da linguagem. {ANSWER} ser� substitu�do por todas as repostas separadas por _DE_OR (OU).
define("_DE_AND", "E");
define("_DE_OR", "OU");
define("_DE_SAVEENTRY", "Save as a partially completed survey"); //New in 0.99dev01
define("_DE_SAVEID", "Identifier:"); //New in 0.99dev01
define("_DE_SAVEPW", "Password:"); //New in 0.99dev01
define("_DE_SAVEPWCONFIRM", "Confirm Password:"); //New in 0.99dev01
define("_DE_SAVEEMAIL", "Email:"); //New in 0.99dev01

//TOKEN CONTROL MESSAGES
define("_TC_TOTALCOUNT", "N�mero de Registros na tabela de Senhas:"); //New in 0.98rc4
define("_TC_NOTOKENCOUNT", "Total Sem Senha �nica:"); //New in 0.98rc4
define("_TC_INVITECOUNT", "Total de Convites Enviados:"); //New in 0.98rc4
define("_TC_COMPLETEDCOUNT", "Total de Question�rios Respondidos:"); //New in 0.98rc4
define("_TC_NOSID", "N�o foi selecionado um question�rio");
define("_TC_DELTOKENS", "Ser� exclu�da a tabela de senhas para este question�rio.");
define("_TC_DELTOKENSINFO", "Se a tabela de senhas foi exclu�da, n�o ser� obrigat�rio o uso de senhas para acessar este question�rio. Se far� uma c�pia desta tabela, se necess�rio. Somente o administrador do sistema ter� acesso a tabela.");
define("_TC_DELETETOKENS", "Apagar Senhas");
define("_TC_TOKENSGONE", "A tabela de senhas foi apagada e as senhas j� n�o s�o obrigat�rias para acessar este question�rio. Uma c�pia desta tabela foi criada e somente o administrador do sistema poder� acess�-la.");
define("_TC_NOTINITIALISED", "N�o h� senhas para este question�rio.");
define("_TC_INITINFO", "Se forem colocadas senhas para este question�rio, esta somente estar� acess�vel a usu�rios que tenham uma senha designada.");
define("_TC_INITQ", "Deseja criar uma tabela de senhas para este question�rio?");
define("_TC_INITTOKENS", "Iniciar Senhas");
define("_TC_CREATED", "Foi criada uma tabela de senhas para este question�rio.");
define("_TC_DELETEALL", "Apagar todas senhas");
define("_TC_DELETEALL_RUSURE", "Est�s certo(a) que deseja apagar TODOS as senhas?");
define("_TC_ALLDELETED", "Todas as senhas foram apagadas");
define("_TC_CLEARINVITES", "Aplicar 'N' a todos registros com convite enviado");
define("_TC_CLEARINV_RUSURE", "Est� certo(a) de iniciar o envio de todos os convites ou N�O?");
define("_TC_CLEARTOKENS", "Apagar todas as senhas com n�mero �nico");
define("_TC_CLEARTOKENS_RUSURE", "Tem certeza que deseja excluir todas senhas com n�meros �nicos?");
define("_TC_TOKENSCLEARED", "Todas senhas com n�mero �nico foram exclu�das");
define("_TC_INVITESCLEARED", "Todas entradas com convite foram marcadas com N");
define("_TC_EDIT", "Modificar Senha");
define("_TC_DEL", "Apagar Senha");
define("_TC_DO", "Responder Question�rio");
define("_TC_VIEW", "Ver Resposta");
define("_TC_INVITET", "Enviar e-mail para esta entrada");
define("_TC_REMINDT", "Reenviar e-mail para esta entrada");
define("_TC_INVITESUBJECT", "Convite para participar do question�rio {SURVEYNAME}"); //Leave {SURVEYNAME} for replacement in scripts
define("_TC_REMINDSUBJECT", "Lembrete para participar do question�rio {SURVEYNAME}"); //Leave {SURVEYNAME} for replacement in scripts
define("_TC_REMINDSTARTAT", "Iniciar no TID ");
define("_TC_REMINDTID", "Enviando ao TID ");
define("_TC_CREATETOKENSINFO", "Clicando em 'Sim' gerar� senhas para todos aqueles que estejam na lista. Est� correto?");
define("_TC_TOKENSCREATED", "{TOKENCOUNT} foram criadas senhas."); 
define("_TC_TOKENDELETED", "Senha apagada.");
define("_TC_SORTBY", "Ordenar por: ");
define("_TC_ADDEDIT", "Adicionar ou Modificar Senha");
define("_TC_TOKENCREATEINFO", "Deixe esse campo em branco e selecione 'Criar Senhas' para cri�-las automaticamente");
define("_TC_TOKENADDED", "Nova Senha Adicionada");
define("_TC_TOKENUPDATED", "Senha Atualizada");
define("_TC_UPLOADINFO", "O arquivo deve ser CSV standard (delimitado por v�rgulas) sem aspas. A primeira linha deve conter a informa��o do cabe�alho (que ser� eliminada). Os dados devem estar ordenados como 'nome, sobrenome, correio eletr�nico, [senha], [attribute1], [attribute2]'.");
define("_TC_UPLOADFAIL", "Arquivo de carga n�o encontrado. Comprove suas permiss�es e trajet�ria para saber se existe o diret�rio de carga"); //New for 0.98rc5 (babelfish translation)
define("_TC_IMPORT", "Importando Archivo CSV");
define("_TC_CREATE", "Criando Senhas");
define("_TC_TOKENS_CREATED", "{TOKENCOUNT} Senhas Criadas");
define("_TC_NONETOSEND", "N�o h� correios eletr�nicos eleg�veis para enviar. Isto foi causado porque os crit�rios n�o foram satisfeitos - ter endere�o de correio eletr�nico, n�o haver enviado convites anteriormente, haver completado o question�rio e ter designado uma senha.");
define("_TC_NOREMINDERSTOSEND", "N�o houve correios eletr�nicos eleg�veis para enviar. Isto foi devido aos crit�rios que n�o foram satisfeitos - tendo a dire��o de correio eletr�nico, haver enviado um convite, por�m n�o haver ainda completado o question�rio.");
define("_TC_NOEMAILTEMPLATE", "N�o foi encontrada a planilha para o convite. Este arquivo deve existir dentro do diret�rio de planilhas.");
define("_TC_NOREMINDTEMPLATE", "N�o foi encontrada a planilha para o lembrete. Este arquivo deve existir dentro do diret�rio de planilhas.");
define("_TC_SENDEMAIL", "Enviar e-mail");
define("_TC_SENDINGEMAILS", "Reenviando e-mail");
define("_TC_SENDINGREMINDERS", "Enviando Lembretes");
define("_TC_EMAILSTOGO", "H� mais correios pendentes de ser enviados que podem ser enviados de uma vez. Para continuar enviando clique abaixo.");
define("_TC_EMAILSREMAINING", "Existem {EMAILCOUNT} correios que n�o foram enviados."); //Leave {EMAILCOUNT} for replacement in script by number of emails remaining
define("_TC_SENDREMIND", "Enviar Lembretes");
define("_TC_INVITESENTTO", "E-mail Enviado a:"); //is followed by token name
define("_TC_REMINDSENTTO", "Lembrete Enviado a:"); //is followed by token name
define("_TC_UPDATEDB", "Descarregar tabela de senhas com novos campos"); //New for 0.98rc7
define("_TC_EMAILINVITE_SUBJ", "Invitation to participate in survey"); //New for 0.99dev01
define("_TC_EMAILINVITE", "Dear {FIRSTNAME},\n\nYou have been invited to participate in a survey.\n\n"
						 ."The survey is titled:\n\"{SURVEYNAME}\"\n\n\"{SURVEYDESCRIPTION}\"\n\n"
						 ."To participate, please click on the link below.\n\nSincerely,\n\n"
						 ."{ADMINNAME} ({ADMINEMAIL})\n\n"
						 ."----------------------------------------------\n"
						 ."Click here to do the survey:\n"
						 ."{SURVEYURL}"); //New for 0.98rc9 - default Email Invitation
define("_TC_EMAILREMIND_SUBJ", "Reminder to participate in survey"); //New for 0.99dev01
define("_TC_EMAILREMIND", "Dear {FIRSTNAME},\n\nRecently we invited you to participate in a survey.\n\n"
						 ."We note that you have not yet completed the survey, and wish to remind you that the survey is still available should you wish to take part.\n\n"
						 ."The survey is titled:\n\"{SURVEYNAME}\"\n\n\"{SURVEYDESCRIPTION}\"\n\n"
						 ."To participate, please click on the link below.\n\nSincerely,\n\n"
						 ."{ADMINNAME} ({ADMINEMAIL})\n\n"
						 ."----------------------------------------------\n"
						 ."Click here to do the survey:\n"
						 ."{SURVEYURL}"); //New for 0.98rc9 - default Email Reminder
define("_TC_EMAILREGISTER_SUBJ", "Survey Registration Confirmation"); //New for 0.99dev01
define("_TC_EMAILREGISTER", "Dear {FIRSTNAME},\n\n"
						  ."You, or someone using your email address, have registered to "
						  ."participate in an online survey titled {SURVEYNAME}.\n\n"
						  ."To complete this survey, click on the following URL:\n\n"
						  ."{SURVEYURL}\n\n"
						  ."If you have any questions about this survey, or if you "
						  ."did not register to participate and believe this email "
						  ."is in error, please contact {ADMINNAME} at {ADMINEMAIL}.");//NEW for 0.98rc9
define("_TC_EMAILCONFIRM_SUBJ", "Confirmation of completed survey"); //New for 0.99dev01
define("_TC_EMAILCONFIRM", "Dear {FIRSTNAME},\n\nThis email is to confirm that you have completed the survey titled {SURVEYNAME} "
						  ."and your response has been saved. Thank you for participating.\n\n"
						  ."If you have any further questions about this email, please contact {ADMINNAME} on {ADMINEMAIL}.\n\n"
						  ."Sincerely,\n\n"
						  ."{ADMINNAME}"); //New for 0.98rc9 - Confirmation Email

//labels.php
define("_LB_NEWSET", "Criar Novo Conjunto de Etiquetas");
define("_LB_EDITSET", "Modificar Conjunto de Etiquetas");
define("_LB_FAIL_UPDATESET", "N�o foi poss�vel atualizar o conjunto de etiquetas");
define("_LB_FAIL_INSERTSET", "N�o foi poss�vel adicionar o novo conjunto de etiquetas");
define("_LB_FAIL_DELSET", "N�o foi poss�vel apagar o conjunto de etiquetas - Existem perguntas que dependem delas. Deve apagar estas perguntas antes de prosseguir.");
define("_LB_ACTIVEUSE", "N�o podes mudar os c�digos, adicionar ou apagar entradas neste conjunto de etiquetas porque est�o sendo utilizadas por um question�rio ativo.");
define("_LB_TOTALUSE", "Alguns question�rios est�o utilizando este conjunto de etiquetas. Se modificar os c�digos, adicionar ou apagar entradas neste conjunto poder� produzir resultados indesejados.");
//Export Labels
define("_EL_NOLID", "N�o foi indicado o LID. N�o � poss�vel exportar o conjunto de etiquetas.");
//Import Labels
define("_IL_GOLABELADMIN", "Voltar para a Administra��o de Etiquetas");

//PHPSurveyor System Summary
define("_PS_TITLE", "Resumo do PHPSurveyor");
define("_PS_DBNAME", "Nome da Base de Dados");
define("_PS_DEFLANG", "Idioma padr�o");
define("_PS_CURLANG", "Idioma Atual");
define("_PS_USERS", "Usu�rios");
define("_PS_ACTIVESURVEYS", "Question�rios Ativos");
define("_PS_DEACTSURVEYS", "Question�rios Desativados");
define("_PS_ACTIVETOKENS", "Tablas de Senhas Ativadas");
define("_PS_DEACTTOKENS", "Tabelas de Senhas Desativadas");
define("_PS_CHECKDBINTEGRITY", "Cheque a integridade dos dados do Question�rio"); //New with 0.98rc8

//Notification Levels
define("_NT_NONE", "Nenhuma notifica��o de e-mail"); //New with 098rc5
define("_NT_SINGLE", "Notifica��o b�sica de e-mail"); //New with 098rc5
define("_NT_RESULTS", "Envie a notifica��o de e-mail com c�digos do resultado"); //New with 098rc5

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

//Question Number regeneration
define("_RE_REGENNUMBER", "Regenerate Question Numbers:"); //NEW for release 0.99dev2
define("_RE_STRAIGHT", "Straight"); //NEW for release 0.99dev2
define("_RE_BYGROUP", "By Group"); //NEW for release 0.99dev2
?>