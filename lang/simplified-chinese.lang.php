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
	# Translation kindly provided by Liang Zhao                 #
	#############################################################
*/
//SINGLE WORDS
define("_YES", "��");
define("_NO", "��");
define("_UNCERTAIN", "��ȷ��");
define("_ADMIN", "����");
define("_TOKENS", "����");
define("_FEMALE", "Ů");
define("_MALE", "��");
define("_NOANSWER", "���ش�");
define("_NOTAPPLICABLE", "������"); //New for 0.98rc5
define("_OTHER", "����");
define("_PLEASECHOOSE", "��ѡ��");
define("_ERROR_PS", "����");
define("_COMPLETE", "���");
define("_INCREASE", "����"); //NEW WITH 0.98
define("_SAME", "��ͬ"); //NEW WITH 0.98
define("_DECREASE", "����"); //NEW WITH 0.98
//from questions.php
define("_CONFIRMATION", "ȷ��");
define("_TOKEN_PS", "����");
define("_CONTINUE_PS", "����");

//BUTTONS
define("_ACCEPT", "����");
define("_PREV", "��һ��");
define("_NEXT", "��һ��");
define("_LAST", "���");
define("_SUBMIT", "�ύ");


//MESSAGES
//From QANDA.PHP
define("_CHOOSEONE", "��ѡ��һ��");
define("_ENTERCOMMENT", "���������");
define("_NUMERICAL_PS", "��һ��ֻ����������");
define("_CLEARALL", "������д�");
define("_MANDATORY", "�������ش�");
define("_MANDATORY_PARTS", "��������в���");
define("_MANDATORY_CHECK", "������ѡ��һ��");
define("_MANDATORY_RANK", "������������Ŀ");
define("_MANDATORY_POPUP", "���ֱش�������δ�ش�������ǲ��ܼ�����"); //NEW in 0.98rc4
define("_DATEFORMAT", "���ڸ�ʽ: YYYY-MM-DD");
define("_DATEFORMATEG", "(��: 2003��ʥ������2003-12-25)");
define("_REMOVEITEM", "ɾ����һ��");
define("_RANK_1", "�����߱���е�ĳһ�������");
define("_RANK_2", "�����ߵ���Ŀ��ʼ��ֱ�����Ĵ����͵���Ŀ��");
define("_YOURCHOICES", "����ѡ��");
define("_YOURRANKING", "���Ĵ��");
define("_RANK_3", "���ÿһ���ұߵļ���");
define("_RANK_4", "ɾ�����ѡ�������һ��");
//From INDEX.PHP
define("_NOSID", "��û���ṩ�ʾ���");
define("_CONTACT1", "����ϵ");
define("_CONTACT2", "�Ի�ý�һ������");
define("_ANSCLEAR", "�𰸱������");
define("_RESTART", "���¿�ʼ�ʾ�");
define("_CLOSEWIN_PS", "�رմ���");
define("_CONFIRMCLEAR", "��ȷ��Ҫ������д���");
define("_EXITCLEAR", "������д𰸲��˳��ʾ�");
//From QUESTION.PHP
define("_BADSUBMIT1", "�����ύ��� - û�����ݿ��ύ��");
define("_BADSUBMIT2", "������Ѿ��ύ�˽���ְ����������'ˢ��'ť�����ܵ��������������������Ļ������Ļش��Ѿ��������ˡ�<br /><br />��������ڻش������м���ֱ���Ϣ����ѡ���������'����'ť��Ȼ��ˢ��ǰһҳ�������һҳ�Ĵ𰸽���ʧ���������𰸻��ڡ�����������������ڷ��������ع�������ġ����ǶԴ�����Ĳ����Ǹ��");
define("_NOTACTIVE1", "���ʾ���δ���ã����Ļش�û�б����档");
define("_CLEARRESP", "�����");
define("_THANKS", "лл");
define("_SURVEYREC", "���Ļش��ѱ����档");
define("_SURVEYCPL", "�ʾ����");
define("_DIDNOTSAVE", "δ����");
define("_DIDNOTSAVE2", "ϵͳ�����޷��������Ļش�");
define("_DIDNOTSAVE3", "���Ļش�û�ж�ʧ�������Ա�e-mail���ʾ������Ա��������Щʱ��¼�뵽���ݿ⡣");
define("_DNSAVEEMAIL1", "����ش����id ");
define("_DNSAVEEMAIL2", "����������");
define("_DNSAVEEMAIL3", "ʧ��SQL���");
define("_DNSAVEEMAIL4", "������Ϣ");
define("_DNSAVEEMAIL5", "�������");
define("_SUBMITAGAIN", "�����ύ");
define("_SURVEYNOEXIST", "�Բ����Ҳ�������ʾ�");
define("_NOTOKEN1", "ֻ�������Ƶ��˲��ܲμӴ��ʾ���顣");
define("_NOTOKEN2", "����������ƣ��뽫�����뵽����ĸ����ڣ��ټ�����");
define("_NOTOKEN3", "���ṩ��������Ч�����ѱ�ʹ�ù��ˡ�");
define("_NOQUESTIONS", "���ʾ�û���κ����⣬���ܲ��Ի�ʹ�á�");
define("_FURTHERINFO", "�й����飬����ϵ");
define("_NOTACTIVE", "���ʾ���δ���ã������ܱ���ش�");
define("_SURVEYEXPIRED", "���ʾ��Ѳ��ٽ��С�");

define("_SURVEYCOMPLETE", "���Ѿ��ش���˴��ʾ�"); //NEW FOR 0.98rc6

define("_INSTRUCTION_LIST", "��ѡ������һ��"); //NEW for 098rc3
define("_INSTRUCTION_MULTI", "ѡ�����к��ʵ�ѡ��"); //NEW for 098rc3

define("_CONFIRMATION_MESSAGE1", "�ʾ����ύ"); //NEW for 098rc5
define("_CONFIRMATION_MESSAGE2", "һ���µĻش�¼�뵽�����ʾ�"); //NEW for 098rc5
define("_CONFIRMATION_MESSAGE3", "�����������Ӳ鿴�����ش�"); //NEW for 098rc5
define("_CONFIRMATION_MESSAGE4", "�������鿴ͳ�ƽ����"); //NEW for 098rc5
?>
