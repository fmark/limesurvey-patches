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
*/
//SINGLE WORDS
define("_YES", "��");
define("_NO", "���");
define("_UNCERTAIN", "�� ������");
define("_ADMIN", "Admin");
define("_TOKENS", "�����");
define("_FEMALE", "�������");
define("_MALE", "�������");
define("_NOANSWER", "��� ������");
define("_NOTAPPLICABLE", "N/A"); //New for 0.98rc5
define("_OTHER", "������");
define("_PLEASECHOOSE", "���������� ��������");
define("_ERROR_PS", "������");
define("_COMPLETE", "���������");
define("_INCREASE", "���������"); //NEW WITH 0.98
define("_SAME", "����� ��"); //NEW WITH 0.98
define("_DECREASE", "���������"); //NEW WITH 0.98
define("_REQUIRED", "<font color='red'>*</font>"); //NEW WITH 0.99dev01
//from questions.php
define("_CONFIRMATION", "�������������");
define("_TOKEN_PS", "�����");
define("_CONTINUE_PS", "����������");

//BUTTONS
define("_ACCEPT", "�������");
define("_PREV", "����.");
define("_NEXT", "����.");
define("_LAST", "���������");
define("_SUBMIT", "���������");


//MESSAGES
//From QANDA.PHP
define("_CHOOSEONE", "���������� �������� ���� �� ��������������");
define("_ENTERCOMMENT", "������� ���������� �����������");
define("_NUMERICAL_PS", "�������� ���� ������ �����");
define("_CLEARALL", "����� � �������� ���������");
define("_MANDATORY", "���� ������ ����������");
define("_MANDATORY_PARTS", "��������� ��� �����");
define("_MANDATORY_CHECK", "�������� ���� �� ����");
define("_MANDATORY_RANK", "������������ ��������");
define("_MANDATORY_POPUP", "���� ��� ��������� ������������ �������� �� ��������. �� �� ������ ���������� ������ ���� �� ��������."); //NEW in 0.98rc4
define("_VALIDATION", "This question must be answered correctly"); //NEW in VALIDATION VERSION
define("_VALIDATION_POPUP", "One or more questions have not been answered in a valid manner. You cannot proceed until these answers are valid"); //NEW in VALIDATION VERSION
define("_DATEFORMAT", "������: ����-MM-��");
define("_DATEFORMATEG", "(����: 2003-12-25 ��� ���������)");
define("_REMOVEITEM", "������� ��-�");
define("_RANK_1", "�������� ������� � ����� ������, ������� �");
define("_RANK_2", "�������� ��������������� � ����������� � ������� ���������������.");
define("_YOURCHOICES", "�� �������");
define("_YOURRANKING", "���� ������������");
define("_RANK_3", "�������� ��  ������� ����� � ��������� � ������ �������");
define("_RANK_4", "����� ������� ��������� ������� � ��������������� ������");
//From INDEX.PHP
define("_NOSID", "�� �� ������� ���������������� ����� ���������");
define("_CONTACT1", "���������� �������������");
define("_CONTACT2", "��� �������������� ������");
define("_ANSCLEAR", "������ �������");
define("_RESTART", "������������� �����");
define("_CLOSEWIN_PS", "������� ����");
define("_CONFIRMCLEAR", "�� ������������� ������ ������� ��� ���� ������?");
define("_CONFIRMSAVE", "Are you sure you want to save your responses?");
define("_EXITCLEAR", "����� � �������� ��������");
//From QUESTION.PHP
define("_BADSUBMIT1", "�� ���� ��������� ���������� - ������ ����������.");
define("_BADSUBMIT2", "��� ������ ��������� ���� �� ��� �������� �� ������� � ������ '��������' � ����� ��������. � ���� ������ ���� ������ ��� ���������.<br /><br />���� �� �������� ��� ��������� � �������� ������, �� �� you ������ ������� '<- �����' � ����� �������� � ����� ��������/������������� ���������� ��������. ����� �� ���������� ������ �� ��������� ��������, ������ ��������� ����������. ��� �������� ��������� ���� web-������ ����������. �� ���������� �� ����� ��������.");
define("_NOTACTIVE1", "���� ������ �� ������� �� ��������. ���� �������� �� �������.");
define("_CLEARRESP", "�������� ������");
define("_THANKS", "�������");
define("_SURVEYREC", "���� ������ ��������.");
define("_SURVEYCPL", "����� ��������");
define("_DIDNOTSAVE", "�� ���������");
define("_DIDNOTSAVE2", "��������� �������������� ������ � ����  ������ �� ����� ���� ���������.");
define("_DIDNOTSAVE3", "Your responses have not been lost and have been emailed to the survey administrator and will be entered into our database at a later point.");
define("_DNSAVEEMAIL1", "��������� ������ ��� ���������� ������ � ���������������");
define("_DNSAVEEMAIL2", "������ ��� �����");
define("_DNSAVEEMAIL3", "SQL ��� ������� �� ��������");
define("_DNSAVEEMAIL4", "��������� �� ������");
define("_DNSAVEEMAIL5", "������ ����������");
define("_SUBMITAGAIN", "���������� ��������� ��������");
define("_SURVEYNOEXIST", "��������. ��� ��������������� ����������.");
define("_NOTOKEN1", "��� ���������� �����. ��� ���������� ���������� ��. ����� ��� �������.");
define("_NOTOKEN2", "���� �� �������� ��. �����, ��, ���������, ������� �� ���� � �������� ����������.");
define("_NOTOKEN3", "��������� ��. ����� ���� ������������ ���� ��� ������������.");
define("_NOQUESTIONS", "� ������ ��� ��� �������� � �� �� ����� ���� �������� ��� �������.");
define("_FURTHERINFO", "��� ��������� ���������� �������������");
define("_NOTACTIVE", "�������� �� �������. �� �� ������� ��������� ������.");
define("_SURVEYEXPIRED", "��� �������� ������ �� ��������.");

define("_SURVEYCOMPLETE", "�� ��� �������� �� ���� �����."); //NEW FOR 0.98rc6

define("_INSTRUCTION_LIST", "�������� ������ ����"); //NEW for 098rc3
define("_INSTRUCTION_MULTI", "�������� ���������"); //NEW for 098rc3

define("_CONFIRMATION_MESSAGE1", "������ ���������"); //NEW for 098rc5
define("_CONFIRMATION_MESSAGE2", "����� ����� �������� � ��������"); //NEW for 098rc5
define("_CONFIRMATION_MESSAGE3", "�������� ��������� ������ ��� �������� �������������� �������:"); //NEW for 098rc5
define("_CONFIRMATION_MESSAGE4", "��� ��������� ���������� ������� �����:"); //NEW for 098rc5

define("_PRIVACY_MESSAGE", "<b><i>��������� � �����������</i></b><br />"
						  ."���� ����� ��������� ���������.<br />"
						  ."������ � ����� ������� �� ����� �� �������� ������� "
						  ."���������������� ���������� � ���, ���� ������������� ������ "
						  ."��������� �� ���������� � ���. ���� �� �������� �� ����� � "
						  ."�������������� ���������������� ��. ���� ��� ������� � ����, "
						  ."�� ������ ���� ������� ��� ��. ����� �� ��������� � ������ ��������."
						  ."��� �������� � ��������� �� � ����������� ������ ��� ��������� ���� "
						  ."��� �� �������� ��� ��� �� ���� �����. "
						  ."�� ���������� ������� ��� ���������� ��. ���� � ������� �� �����."); //New for 0.98rc9


define("_THEREAREXQUESTIONS", "����� {NUMBEROFQUESTIONS} �������� � ���� ������."); //New for 0.98rc9 Must contain {NUMBEROFQUESTIONS} which gets replaced with a question count.
define("_THEREAREXQUESTIONS_SINGLE", "����� 1 ������ � ���� ������."); //New for 0.98rc9 - singular version of above
						  
define ("_RG_REGISTER1", "�� ������ ������������������ ��� ������ �� �����"); //NEW for 0.98rc9
define ("_RG_REGISTER2", "�� ������ ������������������ ��� ������ � ������.<br />\n"
						."������� ���� ������ ����, � email �� ������� �� ����� "
						."��� ������� ����� ����� �������."); //NEW for 0.98rc9
define ("_RG_EMAIL", "Email �����"); //NEW for 0.98rc9
define ("_RG_FIRSTNAME", "���"); //NEW for 0.98rc9
define ("_RG_LASTNAME", "�������"); //NEW for 0.98rc9
define ("_RG_INVALIDEMAIL", "��������� email ����������. ���������� �����.");//NEW for 0.98rc9
define ("_RG_USEDEMAIL", "��������� ���� email ��� ���������������.");//NEW for 0.98rc9
define ("_RG_EMAILSUBJECT", "{SURVEYNAME} ����������� �����������");//NEW for 0.98rc9
define ("_RG_REGISTRATIONCOMPLETE", "���������� �� ����������� ��� ������� � ������.<br /><br />\n"
								   ."Email ���������� �� �����, ������� �� ������� � ������ ��� ������� "
								   ."� ���� ������. ���������� �������� ������ � ������ ��� �����������.<br /><br />\n"
								   ."������������� ������ {ADMINNAME} ({ADMINEMAIL})");//NEW for 0.98rc9

define("_SM_COMPLETED", "<b>���������� ���<br /><br />"
					   ."�� ��������� �������� �� ������� ������.</b><br /><br />"
					   ."������� �� ["._SUBMIT."] ��� ���������� �������� � ���������� �������.");
define("_SM_REVIEW", "���� �� ������ ��������� ���� ������, �/��� �������� ��, "
					."�� ������ ������ �� [<< "._PREV."] ������ � �������� "
					."�� ����� �������.");

//For the "printable" survey
define("_PS_CHOOSEONE", "���������� �������� <b>������ ����</b> �� ��������������"); //New for 0.98finalRC1
define("_PS_WRITE", "���������� �������� ��� ����� �����"); //New for 0.98finalRC1
define("_PS_CHOOSEANY", "���������� �������� <b>���</b> �����������"); //New for 0.98finalRC1
define("_PS_CHOOSEANYCOMMENT", "����������� �������� ��� ��� ������������ � ����� �����������"); //New for 0.98finalRC1
define("_PS_EACHITEM", "����������� �������� ��������������� ����� ��� ������� �� ���������"); //New for 0.98finalRC1
define("_PS_WRITEMULTI", "���������� �������� ��� �����(�) �����"); //New for 0.98finalRC1
define("_PS_DATE", "���������� ������� ����"); //New for 0.98finalRC1
define("_PS_COMMENT", "���������������� ��� ����� �����"); //New for 0.98finalRC1
define("_PS_RANKING", "������������ � ������� ������������ ������ ������� �� 1 ��"); //New for 0.98finalRC1
define("_PS_SUBMIT", "��������� ��� �����"); //New for 0.98finalRC1
define("_PS_THANKYOU", "���������� �� ������� � ������."); //New for 0.98finalRC1
define("_PS_FAXTO", "���������� ��������� ����������� ����� �� �����:"); //New for 0.98finaclRC1

define("_PS_CON_ONLYANSWER", "������ �������� �� ������"); //New for 0.98finalRC1
define("_PS_CON_IFYOU", "��� �� ��������"); //New for 0.98finalRC1
define("_PS_CON_JOINER", "�"); //New for 0.98finalRC1
define("_PS_CON_TOQUESTION", "� �������"); //New for 0.98finalRC1
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

define("_ASSESSMENT_HEADING", "Your Assessment");
?>
