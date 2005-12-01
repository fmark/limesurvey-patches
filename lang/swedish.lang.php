<?php
/*
    #############################################################
    # >>> PHPSurveyor                                           #
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
    # Foundation; either version 2 of the License, or (at your  #
    # option) any later version.                                #
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
    #                                                           #
    # This language file kindly provided by Ulrika Olsson       #
    #                                                           #
    # Updated for 0.98rc9 and higher by                         #
    # Björn Mildh - bjorn at mildh dot se - 2005-03-05          #
    #                                                           #
    #############################################################
*/
//SINGLE WORDS
define("_YES", "Ja");
define("_NO", "Nej");
define("_UNCERTAIN", "Vet ej");
define("_ADMIN", "Admin");
define("_TOKENS", "Beh&ouml;righetskoder");
define("_FEMALE", "Kvinna");
define("_MALE", "Man");
define("_NOANSWER", "Inget svar");
define("_NOTAPPLICABLE", "N/A"); //New for 0.98rc5 (Det finns ingen f&ouml;rkortning av Ej tillämpbar)
define("_OTHER", "Annat");
define("_PLEASECHOOSE", "Välj");
define("_ERROR_PS", "Fel");
define("_COMPLETE", "komplett");
define("_INCREASE", "&Ouml;ka"); //NEW WITH 0.98
define("_SAME", "Samma"); //NEW WITH 0.98
define("_DECREASE", "Minska"); //NEW WITH 0.98
define("_REQUIRED", "<font color='red'>*</font>"); //NEW WITH 0.99dev01
//from questions.php
define("_CONFIRMATION", "Bekräftelse");
define("_TOKEN_PS", "Beh&ouml;righetskod");
define("_CONTINUE_PS", "Fortsätt");

//BUTTONS
define("_ACCEPT", "Acceptera");
define("_PREV", "föreg.");
define("_NEXT", "nästa");
define("_LAST", "sista");
define("_SUBMIT", "skicka");


//MESSAGES
//From QANDA.PHP
define("_CHOOSEONE", "Välj ett av de f&ouml;ljande");
define("_ENTERCOMMENT", "Skriv din kommentar här");
define("_NUMERICAL_PS", "Endast nummer kan skrivas i detta fält");
define("_CLEARALL", "Lämna och rensa enkäten");
define("_MANDATORY", "Denna fråga är obligatorisk");
define("_MANDATORY_PARTS", "Du måste fylla i alla delar");
define("_MANDATORY_CHECK", "Välj minst ett objekt");
define("_MANDATORY_RANK", "Rangordna alla alternativen");
define("_MANDATORY_POPUP", "En eller flera obligatoriska frågor har inte besvarats. Du kan inte fortsätta innan de är besvarade"); //NEW in 0.98rc4
define("_VALIDATION", "Den här frågan måste besvaras korrekt"); //NEW in VALIDATION VERSION
define("_VALIDATION_POPUP", "En eller flera frågor har inte besvarats på rätt sätt. Du kan inte fortsätta fürrän dessa svar är korrekta"); //NEW in VALIDATION VERSION
define("_DATEFORMAT", "Format: åååå-MM-DD");
define("_DATEFORMATEG", "(tex: 2004-12-24 f&ouml;r Julafton)");
define("_REMOVEITEM", "Ta bort detta objekt");
define("_RANK_1", "Klicka på ett objekt i listan till vänster, b&ouml;rja med ditt");
define("_RANK_2", "h&ouml;gst rankade objekt, upprepa tills ditt lägst rankade objekt.");
define("_YOURCHOICES", "Dina val");
define("_YOURRANKING", "Din rangordning");
define("_RANK_3", "Klicka på saxen till h&ouml;ger om objektet");
define("_RANK_4", "f&ouml;r att ta bort det sist elementet i listan.");
//From INDEX.PHP
define("_NOSID", "Du har inte angett ett id-nummer f&ouml;r enkäten");
define("_CONTACT1", "Var god kontakta");
define("_CONTACT2", "f&ouml;r ytterligare assistans");
define("_ANSCLEAR", "Svaren rensade");
define("_RESTART", "Starta om enkäten");
define("_CLOSEWIN_PS", "Stäng f&ouml;nstret");
define("_CONFIRMCLEAR", "är du säker på att du vill rensa dina svar?");
define("_CONFIRMSAVE", "är du säker på att du vill spara dina svar?");
define("_EXITCLEAR", "Lämna och rensa enkäten");
//From QUESTION.PHP
define("_BADSUBMIT1", "Kan inte skicka resultaten - det finns inga att skicka.");
define("_BADSUBMIT2", "Detta fel kan uppstå om du redan har skickat dina svar och klickat på 'uppdatera' på din webbläsare. I så fall så är dina svar redan sparade.");
define("_NOTACTIVE1", "Dina enkätsvar är inte sparade. Denna enkät är inte aktiviverad ännu.");
define("_CLEARRESP", "Rensa svaren");
define("_THANKS", "Tack");
define("_SURVEYREC", "Dina enkätsvar är sparade.");
define("_SURVEYCPL", "Enkäten klar");
define("_DIDNOTSAVE", "Sparade inte");
define("_DIDNOTSAVE2", "Ett oväntat fel har uppstått och dina svar kan inte sparas.");
define("_DIDNOTSAVE3", "Dina svar har inte f&ouml;rsvunnit, utan de har mailats till enkätadministrat&ouml;ren och kommer att läggas in i databasen vid ett senare tillfälle.");
define("_DNSAVEEMAIL1", "Ett fel uppstod under f&ouml;rs&ouml;k att spara svaret till enkät-id");
define("_DNSAVEEMAIL2", "Data skall fyllas i");
define("_DNSAVEEMAIL3", "Sql-kod som har misslyckats");
define("_DNSAVEEMAIL4", "Felmeddelande");
define("_DNSAVEEMAIL5", "Fel vid sparandet");
define("_SUBMITAGAIN", "F&ouml;rs&ouml;k att skicka igen");
define("_SURVEYNOEXIST", "Tyvärr. Det finns ingen matchade enkät.");
define("_NOTOKEN1", "Detta är en kontrollerad enkät. Du beh&ouml;ver en giltlig beh&ouml;rigetskod f&ouml;r att delta");
define("_NOTOKEN2", "Om du har fått en beh&ouml;righetskod, skriv in den i rutan nedan och fortsätt.");
define("_NOTOKEN3", "Beh&ouml;righetskoden som du angett är antingen ogiltlig eller redan använd.");
define("_NOQUESTIONS", "Denna enkät har ännu inga frågor och kan inte testas eller färdigställas.");
define("_FURTHERINFO", "F&ouml;r ytterligare information kontakta");
define("_NOTACTIVE", "Denna enkät är inte aktiv f&ouml;r tillfället. Du kan därf&ouml;r inte spara dina svar.");
define("_SURVEYEXPIRED", "Denna enkät är inte längre tillgänglig."); //NEW for 098rc5

define("_SURVEYCOMPLETE", "Du har redan svarat på den här enkäten.");

define("_INSTRUCTION_LIST", "Välj bara en av f&ouml;ljande"); //NEW for 098rc3
define("_INSTRUCTION_MULTI", "Välj vilka som stämmer"); //NEW for 098rc3

define("_CONFIRMATION_MESSAGE1", "Enkäten skickad"); //NEW for 098rc5
define("_CONFIRMATION_MESSAGE2", "Ett nytt svar till din enkät har lämnats"); //NEW for 098rc5
define("_CONFIRMATION_MESSAGE3", "Se det enskilda svaret genom att klicka här:"); //NEW for 098rc5
define("_CONFIRMATION_MESSAGE4", "Se statistik f&ouml;r enkäten genom att klicka här:"); //NEW for 098rc5
define("_CONFIRMATION_MESSAGE5", "Click the following link to edit the individual response:"); //NEW for 0.99stable

define("_PRIVACY_MESSAGE", "<strong><i>Hantering av personuppgifter. </i></strong><br />"
                          ."Den här enkäten är anonym.<br />"
                          ."De svar på enkäten som sparas innehåller ingen information som "
                          ."kan identifiera den som svarat utom om denna fråga specifikt ställts "
                          ."i enkäten. även om det krävs ett id-nummer f&ouml;r att kunna besvara "
                          ."enkäten sparas inte denna personliga information tillsammans med "
                          ."enkätsvaret. Id-numret används endast f&ouml;r att avg&ouml;ra om du har "
                          ."svarat (eller inte svarat) på enkäten och den informationen sparas "
                          ."separat. Det finns inget sätt att avg&ouml;ra vilket id-nummer som h&ouml;r "
                          ."ihop med ett visst svar i den här enkäten."); //New for 0.98rc9


define("_THEREAREXQUESTIONS", "Den här unders&ouml;kningen innehåller {NUMBEROFQUESTIONS} frågor."); //New for 0.98rc9 Must contain {NUMBEROFQUESTIONS} which gets replaced with a question count.
define("_THEREAREXQUESTIONS_SINGLE", "Det finns 1 fråga i enkäten."); //New for 0.98rc9 - singular version of above

define ("_RG_REGISTER1", "Du måste vara registrerad f&ouml;r att genomf&ouml;ra den här enkäten"); //NEW for 0.98rc9
define ("_RG_REGISTER2", "Du måste registrera dig innan du fyller i den här enkäten.<br />\n"
                        ."Fyll i dina uppgifter nedan och så skickas en länk till "
                        ."enkäten till dig med e-post genast."); //NEW for 0.98rc9
define ("_RG_EMAIL", "E-postadress"); //NEW for 0.98rc9
define ("_RG_FIRSTNAME", "F&ouml;rnamn"); //NEW for 0.98rc9
define ("_RG_LASTNAME", "Efternamn"); //NEW for 0.98rc9
define ("_RG_INVALIDEMAIL", "E-postadressen du angav är inte giltig. Var vänlig f&ouml;rs&ouml;k igen.");//NEW for 0.98rc9
define ("_RG_USEDEMAIL", "Din e-postadress har redan anmälts.");//NEW for 0.98rc9
define ("_RG_EMAILSUBJECT", "{SURVEYNAME} Bekräftelse på registrering");//NEW for 0.98rc9
define ("_RG_REGISTRATIONCOMPLETE", "Tack f&ouml;r att du registerat dig f&ouml;r att genomf&ouml;ra den här enkäten.<br /><br />\n"
                                   ."Ett e-postmeddelande med dina uppgifter har sänts till den adress du angav."
                                   ."F&ouml;lj den bifogade länken i e-postmeddelandet f&ouml;r att fortsätta.<br /><br />\n"
                                   ."Enkät-ansvarig {ADMINNAME} ({ADMINEMAIL})");//NEW for 0.98rc9

define("_SM_COMPLETED", "<strong>Tack!<br /><br />"
    ."Du har besvarat alla frågor i den här enkäten.</strong><br /><br />"
    ."Klicka på ["._SUBMIT."] f&ouml;r att slutf&ouml;ra och spara dina svar."); //New for 0.98finalRC1 - by Bjorn Mildh
define("_SM_REVIEW", "Om du vill kontrollera dina svar och/eller ändra dem, "
    ."kan du g&ouml;ra det genom att klicka på [<< "._PREV."]-knappen och bläddra "
    ."genom dina svar."); //New for 0.98finalRC1 - by Bjorn Mildh

//For the "printable" survey
define("_PS_CHOOSEONE", "Välj <strong>endast en</strong> av f&ouml;ljande:"); //New for 0.98finalRC1
define("_PS_WRITE", "Skriv ditt svar här:"); //New for 0.98finalRC1
define("_PS_CHOOSEANY", "Välj <strong>alla</strong> som stämmer:"); //New for 0.98finalRC1
define("_PS_CHOOSEANYCOMMENT", "Välj alla som stämmer och skriv en kommentar:"); //New for 0.98finalRC1
define("_PS_EACHITEM", "Välj det korrekta svaret f&ouml;r varje punkt:"); //New for 0.98finalRC1
define("_PS_WRITEMULTI", "Skriv ditt/dina svar här:"); //New for 0.98finalRC1
define("_PS_DATE", "Fyll i datum:"); //New for 0.98finalRC1
define("_PS_COMMENT", "Kommentera dina val här:"); //New for 0.98finalRC1
define("_PS_RANKING", "Rangordna i varje ruta med ett nummer från 1 till"); //New for 0.98finalRC1
define("_PS_SUBMIT", "Lämna in din enkät."); //New for 0.98finalRC1
define("_PS_THANKYOU", "Tack f&ouml;r att du svarat på denna enkät."); //New for 0.98finalRC1
define("_PS_FAXTO", "Faxa den ifyllda enkäten till:"); //New for 0.98finaclRC1

define("_PS_CON_ONLYANSWER", "Svara bara på denna fråga"); //New for 0.98finalRC1
define("_PS_CON_IFYOU", "om du svarat"); //New for 0.98finalRC1
define("_PS_CON_JOINER", "och"); //New for 0.98finalRC1
define("_PS_CON_TOQUESTION", "på fråga"); //New for 0.98finalRC1
define("_PS_CON_OR", "eller"); //New for 0.98finalRC2

//Save Messages
define("_SAVE_AND_RETURN", "Spara dina svar så här långt");
define("_SAVEHEADING", "Spara din oavslutade enkät");
define("_RETURNTOSURVEY", "Tillbaka till enkäten");
define("_SAVENAME", "Namn");
define("_SAVEPASSWORD", "L&ouml;senord");
define("_SAVEPASSWORDRPT", "Upprepa l&ouml;senord");
define("_SAVE_EMAIL", "Din e-postadress");
define("_SAVEEXPLANATION", "Fyll i namn och l&ouml;senord f&ouml;r den här enkäten och klicka nedan.<br />\n"
                  ."Din enkät kommer att sparas med hjälp av det namnet och l&ouml;senordet och du kan "
                  ."senare fortsätta fylla i den genom att logga in med samma namn och l&ouml;senord.<br /><br />\n"
                  ."Om du anger en e-postadress skickas uppgifterna till dig med e-post "
                  ."på den adressen.");
define("_SAVESUBMIT", "Spara nu");
define("_SAVENONAME", "Du måste ange ett namn f&ouml;r den här omgången svar.");
define("_SAVENOPASS", "Du måste ange ett l&ouml;senord f&ouml;r den här omgången svar.");
define("_SAVENOMATCH", "L&ouml;senorden st&ouml;mmer inte &ouml;verens.");
define("_SAVEDUPLICATE", "Det här namnet har redan använts f&ouml;r denna enkät. Du måste ange ett unikt namn när du sparar.");
define("_SAVETRYAGAIN", "Var vänlig f&ouml;rs&ouml;k igen.");
define("_SAVE_EMAILSUBJECT", "Sparade enkätsvar");
define("_SAVE_EMAILTEXT", "Du, eller någon annan som angett din e-postadress, har sparat "
                         ."en oavslutad enkät. F&ouml;ljande uppgifter kan användas "
                         ."f&ouml;r att återvända till enkäten och fortsätta där du "
                         ."lämnade den.");
define("_SAVE_EMAILURL", "Uppdatera din enkät genom att klicka på f&ouml;ljande länk:");
define("_SAVE_SUCCEEDED", "Dina enkätsvar har sparats");
define("_SAVE_FAILED", "Ett fel uppstod och dina enkätsvar har inte sparats.");
define("_SAVE_EMAILSENT", "Ett e-postmeddelande med detaljer om din sparade enkät har skickats.");

//Load Messages
define("_LOAD_SAVED", "&Ouml;ppna ofullständigt besvarad enkät");
define("_LOADHEADING", "&Ouml;ppnar tidigare sparad enkät");
define("_LOADEXPLANATION", "Du kan &ouml;ppna en enkät som du tidigare sparat från denna sida.<br />\n"
              ."Fyll i samma 'namn' och 'l&ouml;senord' som du använde f&ouml;r att spara enkäten.<br /><br />\n");
define("_LOADNAME", "Sparat namn");
define("_LOADPASSWORD", "L&ouml;senord");
define("_LOADSUBMIT", "&Ouml;ppna nu");
define("_LOADNONAME", "Du angav inget namn");
define("_LOADNOPASS", "Du angav inget l&ouml;senord");
define("_LOADNOMATCH", "Det finns ingen enkät som stämmer &ouml;verens");

define("_ASSESSMENT_HEADING", "Din uppskattning");
?>
