<?php
/*
	#############################################################
	# >>> PHP Surveyor  										#
	#############################################################
	# > Author:  Jason Cleeland								
	# > E-mail:  jason@cleeland.org							
	# > Mail:    Box 99, Trades Hall, 54 Victoria St,		
	# > Translated by: Mark Yeung (kaisuny@yahoo.com) of    www.pstudy.net	
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
*/
//SINGLE WORDS
define("_YES", "�O");
define("_NO", "�_");
define("_UNCERTAIN", "�L�N��");
define("_ADMIN", "�޲z");
define("_TOKENS", "�N��");
define("_FEMALE", "�k");
define("_MALE", "�k");
define("_NOANSWER", "�����^��");
define("_NOTAPPLICABLE", "���A��"); //New for 0.98rc5
define("_OTHER", "��L");
define("_PLEASECHOOSE", "�п��");
define("_ERROR_PS", "�X��");
define("_COMPLETE", "����");
define("_INCREASE", "�W�["); //NEW WITH 0.98
define("_SAME", "�ۦP"); //NEW WITH 0.98
define("_DECREASE", "�U��"); //NEW WITH 0.98
define("_REQUIRED", "<font color='red'>*</font>"); //NEW WITH 0.99dev01
//from questions.php
define("_CONFIRMATION", "�T�{");
define("_TOKEN_PS", "�ާ@�N�X");
define("_CONTINUE_PS", "�~��");

//BUTTONS
define("_ACCEPT", "����");
define("_PREV", "�W�@�D");
define("_NEXT", "�U�@�D");
define("_LAST", "����");
define("_SUBMIT", "�e�X");


//MESSAGES
//From QANDA.PHP
define("_CHOOSEONE", "�п��");
define("_ENTERCOMMENT", "�п�J���y");
define("_NUMERICAL_PS", "����쭭��J�ƭ�");
define("_CLEARALL", "�M���ݨ����e�����}");
define("_MANDATORY", "���D�����^��");
define("_MANDATORY_PARTS", "�Ц^�������ݨ����e");
define("_MANDATORY_CHECK", "�Цb���إ��_");
define("_MANDATORY_RANK", "�Ь��Ҧ����رƧ�");
define("_MANDATORY_POPUP", "�|�������D�إ������@���A�Ч�����~�~���g�ݨ�侤U���D��"); //NEW in 0.98rc4
define("_VALIDATION", "This question must be answered correctly"); //NEW in VALIDATION VERSION
define("_VALIDATION_POPUP", "One or more questions have not been answered in a valid manner. You cannot proceed until these answers are valid"); //NEW in VALIDATION VERSION
define("_DATEFORMAT", "����榡: YYYY-MM-DD");
define("_DATEFORMATEG", "(��: 2003-12-25 �O�t�ϸ`)");
define("_REMOVEITEM", "��������");
define("_RANK_1", "Click ����C���@�Ӷ���, �}�l�z��");
define("_RANK_2", "�̰��ƦW������, ����ƦW���̧C��m.");
define("_YOURCHOICES", "�z�����");
define("_YOURRANKING", "�z���ƦW");
define("_RANK_3", "Click �k�趵�خǪ��ŤM");
define("_RANK_4", "�����ƦW���̫�@�Ӷ���");
//From INDEX.PHP
define("_NOSID", "�z�����Ѱݨ��s��");
define("_CONTACT1", "���p��");
define("_CONTACT2", "�i�@�B��U");
define("_ANSCLEAR", "���׳Q�M��");
define("_RESTART", "���s�}�l�ݨ�");
define("_CLOSEWIN_PS", "����������");
define("_CONFIRMCLEAR", "�z�֩w�n�M�������ݨ����e��?");
define("_CONFIRMSAVE", "Are you sure you want to save your responses?");
define("_EXITCLEAR", "���}�βM���ݨ�");
//From QUESTION.PHP
define("_BADSUBMIT1", "����e�X�ݨ����G - �����H�^���ݨ�.");
define("_BADSUBMIT2", "�Ӳz�z�w�����ΰe�X�ݨ�<br /><br />�p�G�z�O�b��g�ݨ������X�{���T���A�Ы��s������ '<- ��^' ��Ϋ�[���s��z]���s�W�@�����C�o���p�i��O�]���t�θ귽�����y���������D���e�����A�惡�ڭ̷P���ѡC");
//define("_BADSUBMIT2", "�z�w�����ΰe�X�ݨ�.");
define("_NOTACTIVE1", "�ѩ󥻰ݨ��w���ΡA�ҥH�z���ݨ����Q�x�s.");
define("_CLEARRESP", "�M���ݨ����e");
define("_THANKS", "�h��");
define("_SURVEYREC", "�z���ݨ����e�w�Q�x�s.");
define("_SURVEYCPL", "�ݨ�����");
define("_DIDNOTSAVE", "���Q�x�s");
define("_DIDNOTSAVE2", "�t�ΥX���A�L�k�x�s�������ݨ�.");
define("_DIDNOTSAVE3", "�z�������ݨ��w�e����ާ@�i�@�B�B�z.");
define("_DNSAVEEMAIL1", "�L�k�x�s�쥻�ݨ� id");
define("_DNSAVEEMAIL2", "����J�ƾ�");
define("_DNSAVEEMAIL3", "SQL CODE �X��");
define("_DNSAVEEMAIL4", "�T���X��");
define("_DNSAVEEMAIL5", "�x�s�X��");
define("_SUBMITAGAIN", "���զA�e�X�ݨ�");
define("_SURVEYNOEXIST", "�藍�_�I�䤣��������ݨ�.");
define("_NOTOKEN1", "���ݨ�����֦��N�����H�h�~�i�H�@��.");
define("_NOTOKEN2", "�p�G�z�w�֦��N���A�п�J����椺�A�A�~��@��.");
define("_NOTOKEN3", "�z���Ѫ��N���L�ġA�Τw�Q�ϥ�.");
define("_NOQUESTIONS", "���ݨ������D�ءA�ҥH�z�L�k�����@��.");
define("_FURTHERINFO", "�p���d�ݡA���p��");
define("_NOTACTIVE", "���ݨ��w����. �z�����x�s�ݨ�.");
define("_SURVEYEXPIRED", "���ݨ��w����.");

define("_SURVEYCOMPLETE", "�z�w�������^��"); //NEW FOR 0.98rc6

define("_INSTRUCTION_LIST", "�п�ܤ@��"); //NEW for 098rc3
define("_INSTRUCTION_MULTI", "�i��h�ӵ���"); //NEW for 098rc3

define("_CONFIRMATION_MESSAGE1", "�w�e�X�ݨ�"); //NEW for 098rc5
define("_CONFIRMATION_MESSAGE2", "���߱z�I�z����@���觹�����ݨ�"); //NEW for 098rc5
define("_CONFIRMATION_MESSAGE3", "Click �o�s���d�ݭӧO���ݨ����e:"); //NEW for 098rc5
define("_CONFIRMATION_MESSAGE4", "Click �o�̬d�ݲέp���:"); //NEW for 098rc5

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

//For the "printable" survey
define("_PS_CHOOSEONE", "Please choose <b>only one</b> of the following:"); //New for 0.98finalRC1
define("_PS_WRITE", "Please write your answer here:"); //New for 0.98finalRC1
define("_PS_CHOOSEANY", "Please choose <b>all</b> that apply:"); //New for 0.98finalRC1
define("_PS_CHOOSEANYCOMMENT", "Please choose all that apply and provide a comment:"); //New for 0.98finalRC1
define("_PS_EACHITEM", "Please choose the appropriate response for each item:"); //New for 0.98finalRC1
define("_PS_WRITEMULTI", "Please write your answer(s) here:"); //New for 0.98finalRC1
define("_PS_DATE", "Please enter a date:"); //New for 0.98finalRC1
define("_PS_COMMENT", "Make a comment on your choice here:"); //New for 0.98finalRC1
define("_PS_RANKING", "Please number each box in order of preference from 1 to"); //New for 0.98finalRC1
define("_PS_SUBMIT", "Submit Your Survey."); //New for 0.98finalRC1
define("_PS_THANKYOU", "Thank you for completing this survey."); //New for 0.98finalRC1
define("_PS_FAXTO", "Please fax your completed survey to:"); //New for 0.98finaclRC1

define("_PS_CON_ONLYANSWER", "Only answer this question"); //New for 0.98finalRC1
define("_PS_CON_IFYOU", "if you answered"); //New for 0.98finalRC1
define("_PS_CON_JOINER", "and"); //New for 0.98finalRC1
define("_PS_CON_TOQUESTION", "to question"); //New for 0.98finalRC1
define("_PS_CON_OR", "or"); //New for 0.98finalRC2

//Save Messages
define("_SAVE_AND_RETURN", "Save your responses so far");
define("_SAVEHEADING", "Save Your Unfinished Survey");
define("_RETURNTOSURVEY", "Return To Survey");
define("_SAVENAME", "Name");
define("_SAVEPASSWORD", "Password");
define("_SAVEPASSWORDRPT", "Repeat Password");
define("_SAVE_EMAIL", "Your Email");
define("_SAVEEXPLANATION", "Enter a name and password for this survey and click save below.<br />\n"
				  ."Your survey will be saved using that name and password, and can be "
				  ."completed later by logging in with the same name and password.<br /><br />\n"
				  ."If you give an email address, an email containing the details will be sent "
				  ."to you.");
define("_SAVESUBMIT", "Save Now");
define("_SAVENONAME", "You must supply a name for this saved session.");
define("_SAVENOPASS", "You must supply a password for this saved session.");
define("_SAVENOMATCH", "Your passwords do not match.");
define("_SAVEDUPLICATE", "This name has already been used for this survey. You must use a unique save name.");
define("_SAVETRYAGAIN", "Please try again.");
define("_SAVE_EMAILSUBJECT", "Saved Survey Details");
define("_SAVE_EMAILTEXT", "You, or someone using your email address, have saved "
						 ."a survey in progress. The following details can be used "
						 ."to return to this survey and continue where you left "
						 ."off.");
define("_SAVE_EMAILURL", "Reload your survey by clicking on the following URL:");
define("_SAVE_SUCCEEDED", "Your survey responses have been saved succesfully");
define("_SAVE_FAILED", "An error occurred and your survey responses were not saved.");
define("_SAVE_EMAILSENT", "An email has been sent with details about your saved survey.");

//Load Messages
define("_LOAD_SAVED", "Load unfinished survey");
define("_LOADHEADING", "Load A Previously Saved Survey");
define("_LOADEXPLANATION", "You can load a survey that you have previously saved from this screen.<br />\n"
			  ."Type in the 'name' you used to save the survey, and the password.<br /><br />\n");
define("_LOADNAME", "Saved name");
define("_LOADPASSWORD", "Password");
define("_LOADSUBMIT", "Load Now");
define("_LOADNONAME", "You did not provide a name");
define("_LOADNOPASS", "You did not provide a password");
define("_LOADNOMATCH", "There is no matching saved survey");
?>
