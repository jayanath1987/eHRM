<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">


    <?php
    /**
     * OrangeHRM is a comprehensive Human Resource Management (HRM) System that captures
     * all the essential functionalities required for any enterprise.
     * Copyright (C) 2006 OrangeHRM Inc., http://www.orangehrm.com
     *
     * OrangeHRM is free software; you can redistribute it and/or modify it under the terms of
     * the GNU General Public License as published by the Free Software Foundation; either
     * version 2 of the License, or (at your option) any later version.
     *
     * OrangeHRM is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
     * without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
     * See the GNU General Public License for more details.
     *
     * You should have received a copy of the GNU General Public License along with this program;
     * if not, write to the Free Software Foundation, Inc., 51 Franklin Street, Fifth Floor,
     * Boston, MA  02110-1301, USA
     */
    ob_start();

    define('ROOT_PATH', dirname(__FILE__));
    include_once('CAS.php');


    if (!is_file(ROOT_PATH . '/lib/confs/Conf.php')) {
        header('Location: ./install.php');
        exit();
    }

    session_start();
    if (!isset($_SESSION['fname'])) {

        header("Location: ./login.php");
        exit();
    }

    if (isset($_GET['ACT']) && $_GET['ACT'] == 'logout') {
        session_destroy();
        setcookie('Loggedin', '', time() - 3600, '/');
        header("Location: ./login.php");
        exit();
    }




    require_once ROOT_PATH . '/lib/common/CommonFunctions.php';
    require_once ROOT_PATH . '/lib/common/Config.php';

    require_once ROOT_PATH . '/symfony/apps/orangehrm/lib/EncryptionHandler.php';
    require_once ROOT_PATH . '/lib/models/eimadmin/Login.php';
    require_once ROOT_PATH . '/MenuBuilder.php';

    $encrypt = new EncryptionHandler();

    $_SESSION['path'] = ROOT_PATH;
    ?>
    <?php
    require_once ROOT_PATH . '/lib/common/Language.php';
    require_once ROOT_PATH . '/lib/common/menu/MenuItem.php';

    $lan = new Language();

    require_once ROOT_PATH . '/language/default/lang_default_full.php';

    require_once($lan->getLangPath("full.php"));

    if ($_SESSION['language'] == 'en') {
        require_once ROOT_PATH . '/language/en/lang_en_custom.php';
        $langVariable = $lang_index_ChangePassword;
        $logoutVariable = $lang_index_Logout;
        $welconmvariable = $lang_index_WelcomeMes;
        $loggedEmpName = $_SESSION['emp_name'];
    }
    if ($_SESSION['language'] == 'si') {
        require_once ROOT_PATH . '/language/si/lang_si_custom.php';
        $langVariable = $lang_index_ChangePassword_si;
        $logoutVariable = $lang_index_Logout_si;
        $welconmvariable = $lang_index_WelcomeMes_si;
        $loggedEmpName = $_SESSION['emp_name_si'];
    }
    if ($_SESSION['language'] == 'ta') {
        require_once ROOT_PATH . '/language/ta/lang_ta_custom.php';
        $langVariable = $lang_index_ChangePassword_ta;
        $logoutVariable = $lang_index_Logout_ta;
        $welconmvariable = $lang_index_WelcomeMes_ta;
        $loggedEmpName = $_SESSION['emp_name_ta'];
    }

    if (isset($_SESSION['ladpUser']) && $_SESSION['ladpUser'] && $_SESSION['isAdmin'] != "Yes") {
        $optionMenu = array();
    } else {
        
    }
    $user = $encrypt->encrypt($_SESSION['user']);

    $optionMenu[] = new MenuItem("changepassword", $langVariable, "./symfony/web/index.php/admin/changepassword?id={$user}");
    $optionMenu[] = new MenuItem("logout", $logoutVariable, "logout.php");
    ?>
    <head>

        <title>eHRM</title>
        <?php $styleSheet = CommonFunctions::getTheme(); ?>        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=8" />
        <link rel="stylesheet" type="text/css" href="index.css"/>
        <link href="themes/<?php echo $styleSheet; ?>/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="favicon.ico" rel="icon" type="image/gif"/>
        <script type="text/javaScript" src="scripts/archive.js"></script>
        <!--*****************css & javascript for new menu ********************-->
        <link rel='stylesheet' type='text/css' href='quickmenu_styles.css'/>        
        <script type='text/javascript' src='scripts/jquery/jquery.min.js'></script>
        <script type='text/javascript' src='quickmenu.js'></script>     
         
        <script type='text/javascript'>       
            var count=0;
            var counter = 0
            
            function get_cookie ( cookie_name )
            {
                var results = document.cookie.match ( '(^|;) ?' + cookie_name + '=([^;]*)(;|$)' );

                if ( results )
                    return ( unescape ( results[2] ) );
                else
                    return null;
            }
            function set_cookie ( name, value, exp_y, exp_m, exp_d, path, domain, secure )
            {
                var cookie_string = name + "=" + escape ( value );

                if ( exp_y )
                {
                    var expires = new Date ( exp_y, exp_m, exp_d );
                    cookie_string += "; expires=" + expires.toGMTString();
                }

                if ( path )
                    cookie_string += "; path=" + escape ( path );

                if ( domain )
                    cookie_string += "; domain=" + escape ( domain );

                if ( secure )
                    cookie_string += "; secure";

                document.cookie = cookie_string;
            }
            function IfarmeOnload(){
                


                if (counter == 0) {
                    //                    document.getElementById('rightMenu').contentWindow.location.reload();
                    counter = 1;

                    
                }
                defaultFontsize();
            }

            function defaultFontsize(){
            
           
                

                var h2currentValue = get_cookie ( "h2cookie" );
              

                var otherElecurrentValue= get_cookie ( "otherElecookie" );
               
                if(h2currentValue>0){
                    if(h2currentValue<=24){

                        
                        jQuery("#rightMenu").contents().find('h2').css({



                            'font-size' : h2currentValue  + 'px'

                        });
                    }
                }
                jQuery("#rightMenu").contents().find("form,table.data-table tbody td a,table, td,a:link, a:visited,body").each(function(){
                    


                    if(otherElecurrentValue<=20){
                                            
                        jQuery(this).css({

                            'font-size' : otherElecurrentValue + 'px'
                            
                        });
                    }

                });
                
            }

        </script>
        <!--******************************************************************-->
        <?php
        if ($_SESSION['user'] != "USR001") {
            $home = './symfony/web/index.php/ESS/index';
        } else {
            $home = './symfony/web/index.php/pim/list';
        }
        ?>
    </head>

    <body onbeforeunload="doUnload();">

        <!-- new header   -->

        <div class="header_div" style="min-width:1000px;">
<!--            <div style="float: left;"><img src="images/orangehr_logo.jpg" alt="" /></div>-->
            <div class="gov_div">
                <a href="http://www.gov.lk" target="_blank"><img style="border:none;" src="images/gov.png" height="31px" alt="" title="Gov.lk" /></a>
            </div>  
            <div class="language_div">




                <a href="javascript:void(0)"><img id="increaseFont" style="border:none;" src="images/txt_large.jpg" alt="<?php echo $lang_custom['increase'] ?>" title="<?php echo $lang_custom['increase'] ?>" /></a>
                <a href="javascript:void(0)"><img id="resetFont" style="border:none;" src="images/txt_meduim.jpg" alt="<?php echo $lang_custom['reset'] ?>" title="<?php echo $lang_custom['reset'] ?>" /></a>
                <a href="javascript:void(0)"><img id="decreaseFont" style="border:none;" src="images/txt_min.jpg" alt="<?php echo $lang_custom['decrease'] ?>" title="<?php echo $lang_custom['decrease'] ?>" /></a>

                <?php if ($_SESSION['language'] == "si") {
                    ?>
                    <a href="#" onClick="changeLanguage1('./symfony/web/index.php/default/index?ln=en'); return false;" ><img src="images/en.jpg" alt="<?php echo $lang_custom['english']; ?>" title="<?php echo $lang_custom['english']; ?>" style="border:none"/></a>&nbsp;
                    <a href="#" onClick="changeLanguage1('./symfony/web/index.php/default/index?ln=ta'); return false;"><img src="images/ta.jpg" alt="<?php echo $lang_custom['tamil']; ?>" title="<?php echo $lang_custom['tamil']; ?>" style="border:none" /></a>&nbsp;
                    <a href="javascript:void(0);"><img src="images/sinhala_font.png"  style="border:none" onclick="javascript:window.open('http://siyabas.lk/sinhala_how_to_install.html')" alt="<?php echo $lang_custom['takesinhala']; ?>" title="<?php echo $lang_custom['takesinhala']; ?>"/></a>&nbsp;
                    <a href="javascript:void(0);"><img style="border:none" onclick="javascript:window.open('http://siyabas.lk/tamil_how_to_install_in_english.html')" src="images/tamil_font.png" alt="<?php echo $lang_custom['taketamil']; ?>" title="<?php echo $lang_custom['taketamil']; ?>" /></a>&nbsp;


                    <?php
                } else if ($_SESSION['language'] == "ta") {
                    ?>
                    <a href="#" onClick="changeLanguage1('./symfony/web/index.php/default/index?ln=en'); return false;"><img src="images/en.jpg" alt="<?php echo $lang_custom['english']; ?>" title="<?php echo $lang_custom['english']; ?>" style="border:none"/></a>&nbsp;
                    <a href="#" onClick="changeLanguage1('./symfony/web/index.php/default/index?ln=si'); return false;"><img src="images/si.jpg" alt="<?php echo $lang_custom['sinhala']; ?>" title="<?php echo $lang_custom['sinhala']; ?>" style="border:none"/></a>&nbsp;
                    <a href="javascript:void(0);"><img src="images/sinhala_font.png" style="border:none" onclick="javascript:window.open('http://siyabas.lk/sinhala_how_to_install.html')" alt="<?php echo $lang_custom['takesinhala']; ?>" title="<?php echo $lang_custom['takesinhala']; ?>" /></a>&nbsp;
                    <a href="javascript:void(0);"><img style="border:none" onclick="javascript:window.open('http://siyabas.lk/tamil_how_to_install_in_english.html')" src="images/tamil_font.png" alt="<?php echo $lang_custom['taketamil']; ?>" title="<?php echo $lang_custom['taketamil']; ?>" /></a>&nbsp;

                    <?php
                } else {
                    ?>
                    <a href="#" onClick="changeLanguage1('./symfony/web/index.php/default/index?ln=si'); return false;"><img src="images/si.jpg" alt="<?php echo $lang_custom['sinhala']; ?>" title="<?php echo $lang_custom['sinhala']; ?>"  style="border:none"/></a>&nbsp;
                    <a href="#" onClick="changeLanguage1('./symfony/web/index.php/default/index?ln=ta'); return false;"><img src="images/ta.jpg" alt="<?php echo $lang_custom['tamil']; ?>" title="<?php echo $lang_custom['tamil']; ?>" style="border:none"/></a>&nbsp;
                    <a href="javascript:void(0);"><img src="images/sinhala_font.png" style="border:none" onclick="javascript:window.open('http://siyabas.lk/sinhala_how_to_install.html')" alt="<?php echo $lang_custom['takesinhala']; ?>" title="<?php echo $lang_custom['takesinhala']; ?>"  /></a>&nbsp;
                    <a href="javascript:void(0);"><img style="border:none" onclick="javascript:window.open('http://siyabas.lk/tamil_how_to_install_in_english.html')" src="images/tamil_font.png" alt="<?php echo $lang_custom['taketamil']; ?>" title="<?php echo $lang_custom['taketamil']; ?>" /></a>&nbsp;

                    <?php
                }
                ?>


            </div>
            <?php
            $login = new Login();
            $rset = $login->getCompanyRoot();

//    
            ?>

            <div class="bannerbackground">
                <div class="esamurdiBanner" ></div>
               <!--    <img src="imagetrs/SASL-Logo.png" alt="" border="none"/>
				 --> 
            </div>
            <!--            <div style="float: left;" ><h3 style="margin: 0px;">eHrm</h3></div>-->
            <!--   <div style="position:relative;left: 335px;top:-65px;width: 350px;">
               </div>
            -->
        </div>

        <div class="topLinks_div">
            <div>
                <img src="images/toplink.jpg" width="18" height="39" />
            </div>
            <?php
            $welcomeMessage = $welconmvariable;
            if ($loggedEmpName == "") {
                $loggedEmpName = $_SESSION['emp_name'];
                if ($loggedEmpName == "") {
                    $loggedEmpName = $_SESSION['fname'];
                }
            }
            $welcomeMessage.=" " . $loggedEmpName;
            ?>
            <div class="toplinks_text_div"> <?php echo $welcomeMessage; ?> | <?php
            if ($optionMenu) {
                $numOfmenu = count($optionMenu);
                $i = 0;
                foreach ($optionMenu as $optionItem) {

                    $i = $i + 1;
                    ?>
                        <?php
                        if ($optionItem->getLink() == "logout.php") {
                            $target = "";
                            ?>
                            <a href="<?php echo $optionItem->getLink(); ?>" id="<?php echo $optionItem->getLink(); ?>" target="<?php echo $target; ?>"    style="color: #fff; font-family:Tahoma, Geneva, sans-serif;
                               font-size:11px;text-decoration:none;" onblur="setOnFoucs();">

                                <?php echo $optionItem->getMenuText(); ?>
                            </a>
                            <?php
                        } else {
                            $target = "rightMenu";
                            ?>
                            <a href="<?php echo $optionItem->getLink(); ?>" id="<?php echo $optionItem->getLink(); ?>" target="<?php echo $target; ?>"    style="color: #fff; font-family:Tahoma, Geneva, sans-serif;
                               font-size:11px;text-decoration:none;">

                                <?php echo $optionItem->getMenuText(); ?>
                            </a>
                            <?php
                        }
                        ?>

                        <?php
                        if ($numOfmenu != $i) {
                            echo "|";
                        }
                    }
                }
                ?> </div>

        </div>



        <!-- end new header   -->



        <script type="text/javascript">



function doUnload()
{
myWindow=window.open("logout.php", "myWindow","status = 1, height = 300, width = 300, resizable = 0" );
myWindow.close(); 
alert('Thank you for using CommonHRM. You will be logged out shortly.');

}
  
              function changeLanguage1(url){
                  //alert("");
                  if (confirm("If there any unsaved data they will be lost. Are you sure want to chanage the Language ?")) {//if yes
                      changeLanguage(url);
                      return true;
                    }
                    else { // if no
                        return false;
                    }
                  
              }


            function changeLanguage(url){ 

                var day;
                $.ajax({
                    type: "POST",
                    async:false,
                    url: url,
                    data: { day: day },
                    dataType: "json",
                    success: function(data){
                        set_cookie ( "iframeURL", document.getElementById('rightMenu').contentWindow.location.href );
                        window.location.href="./index.php?var=lang";
                    }
                });

                
                                

            }
            var counter = 0;
            
            function setOnFoucs(){
                $("#rightMenu").get(0).focus();
            }
            function changeLang() {

                if (counter == 0) {
                    document.getElementById('rightMenu').contentWindow.location.reload();
                    counter = 1;
                }
            }        

        </script>




        <!-- new menu--->

        <div class="navigation_menu">


            <?php
            $menu = new MenuBuilder();
            echo $menu->get_menu_html();            
            ?>



            <script language="JavaScript">
                qm_create(0,true,0,0,'all',false,false,false,false);
                   
               
                       
                jQuery(document).ready(function($) {
                    // Code that uses jQuery's $ can follow here.

                    var lang="<?php
            if ((isset($_GET['var']))) {
                echo $_GET['var'];
            }
            ?>";
                      
                    if(lang!="" && get_cookie ( "iframeURL" )){
                        var test=get_cookie ( "iframeURL" );
                        set_cookie ( "iframeURL", "" );
                        document.getElementById('rightMenu').contentWindow.location.href=test;
                    }
                    
                    $('iframe').contents().find('body').css({"min-height": "100", "overflow" : "hidden"});
                    setInterval( "$('iframe').height($('iframe').contents().find('body').height() + 20)", 1 );
                


                    $('#increaseFont').click(function() {


                        var oldfh2=parseFloat($("#rightMenu").contents().find('h2').css('font-size'));



                        if(oldfh2<24){
                            var newh2=oldfh2 + 2;

                            set_cookie ( "h2cookie", newh2 );

                            $("#rightMenu").contents().find('h2').css({

                                'font-size' : oldfh2 + 2 + 'px'

                            });
                            $("#style").contents().find('jattendance').css({

                                'height' : '300px'

                            });
                        }





                        $("#rightMenu").contents().find("form,table.data-table tbody td a,table, td,a:link, a:visited,body").each(function(){
                            var oldf = parseFloat( jQuery(this).css('font-size') );
                            var oldl = parseFloat( jQuery(this).css('line-height') );


                            if(oldf<=18){

                                var  newotherEleValue=oldf+2;

                                set_cookie ( "otherElecookie", newotherEleValue );

                                jQuery(this).css({

                                    'font-size' : oldf + 2 + 'px'

                                });
                            }

                        });



                    });

                    $('#resetFont').click(function() {

                        count=0;
                        $("#rightMenu").contents().find("form,h2,table.data-table tbody td a,table, td,a:link, a:visited,body").each(function(){
                            var oldf = parseFloat( jQuery(this).css('font-size') );
                            var oldl = parseFloat( jQuery(this).css('line-height') );
                            jQuery(this).css({
                                'font-size' : '12px'
                                //'line-height' : '12px'
                            });
                            $("#rightMenu").contents().find('h2').css({
                                'font-size' : '18px'
                                //'line-height' : '18px'
                            });


                        });
                        set_cookie ( "otherElecookie", '12' );
                        set_cookie ( "h2cookie", '18');

                    });

                    $('#decreaseFont').click(function() {

                        var oldfhh=parseFloat($("#rightMenu").contents().find('h2').css('font-size'));

                        if(oldfhh>14){
                            var newh2=oldfhh - 2;

                            set_cookie ( "h2cookie", newh2 );

                            $("#rightMenu").contents().find('h2').css({


                                'font-size' : oldfhh - 2 + 'px'
                                //'line-height' : oldl + 2 + 'px'
                            });
                        }
                        $("#rightMenu").contents().find("form,table.data-table tbody td a,table, td,a:link, a:visited,body").each(function(){
                            var oldf = parseFloat( jQuery(this).css('font-size') );



                            if(oldf>=10){

                                var  newotherEleValue=oldf-2;

                                set_cookie ( "otherElecookie", newotherEleValue );
                                jQuery(this).css({
                                    'font-size' : oldf - 2 + 'px'
                                    //'line-height' : oldl - 2 + 'px'
                                });
                            }
                        });


                    });

            
$(window).bind('beforeunload', function() 
{ 
    if(event.clientY < 0) {
        window.location.href ="logout.php";
        
        //alert('Thank you for using eSamurdhi HRM system. You will be logged out shortly.');
        window.close();
    }
} 
);

                            
                });

            </script>
            <!-- Create Menu Settings: (Menu ID, Is Vertical, Show Timer, Hide Timer, On Click (options: 'all' * 'all-always-open' * 'main' * 'lev2'), Right to Left, Horizontal Subs, Flush Left, Flush Top) -->
        


        </div>

        <!--*************-->
        <div>

        </div>
        <div id="main-content1" style="position:absolute;float:none;top:80px;margin-left:170px;width: 920px;">
            <iframe onload="IfarmeOnload();"  style="display:block; margin-left:none;  margin-right:none; width: 100%; height: auto;" src="<?php echo $home; ?>" id="rightMenu" name="rightMenu"   frameborder="0"></iframe>

        </div>


    </body>

</html>
<?php ob_end_flush(); ?>
