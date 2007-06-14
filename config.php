<?php
/*
    #############################################################
    # >>> LimeSurvey                                           #
    #############################################################
    # > Author:  Jason Cleeland                                 #
    # > E-mail:  jason@cleeland.org                             #
    # > Mail:    Box 99, Trades Hall, 54 Victoria St,           #
    # >          CARLTON SOUTH 3053, AUSTRALIA                  #
    # > Date:    20 February 2003                               #
    #                                                           #
    # This set of scripts allows you to develop, publish and    #
    # perform data-entry on surveys.                            #
    #############################################################
    #                                                           #
    #   Copyright (C) 2003  Jason Cleeland                      #
    #                                                           #
    # This program is free software; you can redistribute       #
    # it and/or modify it under the terms of the GNU General    #
    # Public License as published by the Free Software          #
    # Foundation.                                               #
    #                                                           #
    #                                                           #
    # This program is distributed in the hope that it will be   #
    # useful, but WITHOUT ANY WARRANTY; without even the        #
    # implied warranty of MERCHANTABILITY or FITNESS FOR A      #
    # PARTICULAR PURPOSE.  See the GNU General Public License   #
    # for more details.                                         #
    #                                                           #
    # You should have received a copy of the GNU General        #
    # Public License along with this program; if not, write to  #
    # the Free Software Foundation, Inc., 59 Temple Place -     #
    # Suite 330, Boston, MA  02111-1307, USA.                   #
    #############################################################
*/

// === Basic Setup

$databasetype       =   "mysql";       // ADOdb database driver - either mysql or odbc_mssql
$databaselocation   =   "localhost";   // Network location of your Database - for odbc_mssql use the mssql servername, not localhost or IP
$databaseport       =   "default";     // The port of your Database - if you use a standard port leave on default
$databasename       =   "limesurvey";  // The name of the database that we will create
$databaseuser       =   "root";        // The name of a user with rights to create db (or if db already exists, then rights within that db)
$databasepass       =   "";            // Password of db user
$dbprefix           =   "lime_";       // A global prefix that can be added to all LimeSurvey tables. Use this if you are sharing
                                       // a database with other applications. Suggested prefix is "lime_"
$databasetabletype  =   "myISAM";	   // Storage engine mysql should use when creating survey results tables and token tables (if mysql is used). If available, InnoDB is recommended. Default is myISAM.

// FILE LOCATIONS
$rooturl            =   "http://{$_SERVER['SERVER_NAME']}/limesurvey"; //The root web url for your limesurvey installation.

$rootdir            =   dirname(__FILE__); // This is the physical disk location for your limesurvey installation. Normally you don't have to touch this setting.
                                           // If you use IIS then you MUST enter the complete rootdir e.g. : $rootDir="C:\Inetpub\wwwroot\limesurvey"!
                                           // Some IIS installations also require to use forward slashes instead of backslashes, e.g.  $rootDir="C:/Inetpub/wwwroot/limesurvey"!
                                           // If you use OS/2 this must be the complete rootdir with FORWARD slashes e.g.: $rootDir="c:/limesurvey";!

$rootsymlinked      =   0;  // if your root document dir is symlinked LimeSurvey might have problems to find out the dir
                            // If you notice that labels are not being translated like "_ADMINISTRATION_" instead of "Administration"
                            // then try setting this to 1 .

// === Advanced Setup

    //The following url and dir locations do not need to be modified unless you have a non-standard
    //LimeSurvey installation. Do not change unless you know what you are doing.
    $homeurl        =   "$rooturl/admin"; // The website location (url) of the admin scripts
    $publicurl      =   "$rooturl";       // The public website location (url) of the public survey script
    $tempurl        =   "$rooturl/tmp";
    $imagefiles     =   "$rooturl/images"; //Location of button bar files for admin script
    $homedir        =   "$rootdir/admin"; // The physical disk location of the admin scripts
    $publicdir      =   "$rootdir";       // The physical disk location of the public scripts
    $tempdir        =   "$rootdir/tmp";   // The physical location where LimeSurvey can store temporary files
                                          // Note: For OS/2 the $tempdir may need to be defined as an actual directory
                                          // example: "x:/limesurvey/tmp". We don't know why.

// Site Info
$sitename           =   "LimeSurvey";     // The official name of the site (appears in the Window title)
$scriptname         =   "admin.php";      // The name of the admin script
$accesscontrol      =   1;                // Set this to 0 for no access control
$defaultuser        =   "admin";          // This is the default username when LimeSurvey is installed
$defaultpass        =   "password";       // This is the default password for the default user when LimeSurvey is installed

// Site Settings
$lwcdropdowns       =   "R";              // SHOW LISTS WITH COMMENT in Public Survey as Radio Buttons (R) or Dropdown List (L)
$dropdownthreshold  =   "25";             // The number of answers to a list type question before it switches from Radio Buttons to List
                                          // Only applicable, of course, if you have chosen "R" for $dropdowns and/or $lwcdropdowns
$repeatheadings     =   "25";             // The number of answers to show before repeating the headings in array (flexible) questions. Set to 0 to turn this feature off
$minrepeatheadings  =   3;                // The minimum number of remaing answers that are required before repeating the headings in array (flexible) questions.
$defaultlang        =   "en";             // The default language to use - the available languages are the directory names in the /locale dir - for example de = German

$timeadjust         =   0;                // Number of hours to adjust between your webserver local time and your own local time (for datestamping responses)
$allowexportalldb   =   1;                // 0 will only export prefixed tables when doing a database dump. If set to 1 ALL tables in the database will be exported
$allowmandbackwards =   1;                // Allow moving backwards (ie: << prev) through survey if a mandatory question
                                          // has not been answered. 1=Allow, 0=Deny
$deletenonvalues    =   1;                // By default, LimeSurvey does not save responses to conditional questions that haven't been answered/shown. To have LimeSurvey save these responses change this value to 0.
$shownoanswer       =   1;                // Show "no answer" for non mandatory questions
$admintheme         =  "default";         // This setting specifys the directory where the admin finds it theme/css style files, e.g. setting 'default' points to /admin/styles/default



$debug              =   0;      // Switch this to 1 if you are looking for errors
$sessionlifetime    =   3600;   // How long until a survey session expires in seconds

// Email Settings
// These settings determine how LimeSurvey will send emails

$siteadminemail     =   "your@email.org"; // The default email address of the site administrator
$siteadminname      =   "Your Name";      // The name of the site administrator

$emailmethod        =   "mail";           // The following values can be used:
									      // mail      -  use internal PHP Mailer
                                          // sendmail  -  use Sendmail Mailer
                                          // smtp      -  use SMTP relaying

$emailsmtphost      =   "localhost";      // Sets the SMTP host. All hosts must be separated by a semicolon.
                                          // You can also specify a different port for each host by using
                                          // this format: [hostname:port] (e.g. "smtp1.example.com:25;smtp2.example.com").

$emailsmtpuser      =   "";               // SMTP authorisation username - only set this if your server requires authorization - if you set it you HAVE to set a password too
$emailsmtppassword  =   "";               // SMTP authorisation password - empty password is not allowed

$maxemails          =   50;               // The maximum number of emails to send in one go (this is to prevent your mail server or script from timeouting when sending mass mail)

// JPGRAPH Settings
// To use jpgraph you must install and set up jpgraph, available from http://www.aditus.nu/jpgraph/
// LimeSurvey has been tested using version 1.13. Documentation for this is available at the
// jpgraph website. LimeSurvey cannot assist in the setting up of this system.
// To use JPGraph adjust the next two lines, and adjust the location as suites.
$usejpgraph         =   0; //Set to 1 to enable
$jpgraphdir         =   "/var/apache/htdocs/jpgraph"; //The location of the jpgraph class (where jpgraph.php is)
                                                      // If you use IIS then you MUST enter the complete rootdir e.g. : $rootDir="C:\\Inetpub\\wwwroot\\jpgraph"
$jpgraphfont        =   "FF_ARIAL"; //The font to use with graphs. A failsafe setting would be "FF_FONT1"
$jpgraphfontdir     =   "";         //On debian based systems, the fonts aren't in the old font dir of XFree86 : (/usr/X11R6/lib/X11/fonts/truetype/)
                                    //To have beautiful fonts with JpGraph it might be necessary to set this to a new path , for example: /usr/share/fonts/truetype/msttcorefonts/

// CMS Integration Settings
// Set $embedded to true and specify the header and footer functions if the survey is to be displayed embedded in a CMS
$embedded = false;
$embedded_inc = "";             // path to the header to include if any
$embedded_headerfunc = "";      // e.g. COM_siteHeader for geeklog
$embedded_footerfunc = "";      // e.g. COM_siteFooter for geeklog

// Enable or Disable Ldap feature
$enableLdap = false;

// Experimental parameters, only change if you know what you're doing
//
// $filterout_incomplete_answers
//  * default behaviour of phpsv regarding answer records with no submitdate
//  * can be overwritten by module parameters
//         ("Filter-Out incomplete answers" checkbox when implemented)
$filterout_incomplete_answers = true;


//DO NOT CHANGE BELOW HERE --------------------

require_once(dirname(__FILE__).'/common.php');
?>
