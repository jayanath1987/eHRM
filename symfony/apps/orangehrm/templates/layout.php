<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_title() ?>

        <link href="<?php echo public_path('../../themes/orange/css/style.css') ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo public_path('../../themes/orange/css/message.css') ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo public_path('../../themes/orange/css/jquery/jquery-ui.css') ?>" rel="stylesheet" type="text/css"/>
        <!--[if lte IE 6]>
	<link href="<?php echo public_path('../../themes/orange/css/IE6_style.css') ?>" rel="stylesheet" type="text/css"/>
	<![endif]-->
        <!--[if IE]>
	<link href="<?php echo public_path('../../themes/orange/css/IE_style.css') ?>" rel="stylesheet" type="text/css"/>
	<![endif]-->
        <script type="text/javascript" src="<?php echo public_path('../../themes/orange/scripts/style.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo public_path('../../scripts/archive.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.js') ?>"></script>
        <script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.validate.js') ?>"></script>
        <script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.form.js') ?>"></script>
        <script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.tablesorter.js') ?>"></script>
        <script type="text/javascript" src="<?php echo public_path('../../scripts/time.js') ?>"></script>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" ></meta>
        <meta http-equiv="X-UA-Compatible" content="IE=8" />
        <meta http-equiv="Pragma" content="no-cache"/>
        <meta http-equiv="Cache-Control" content="no-cache"></meta>

        <?php echo javascript_include_tag('orangehrm.validate.js'); ?>


    </head>
    <body>
        <?php
        $encrypt = new EncryptionHandler();
        ?>
        <?php
        $requestUrl = explode("/", $_SERVER['REQUEST_URI']);
        $RequestUrl = $_SERVER['REQUEST_URI'];

        /* Default set $flag to 0 */
        $flag = 0;

        $findme = "symfony";
        $pos = strpos($RequestUrl, $findme);
        $rest = substr($RequestUrl, $pos);

        /* $rest  will out put ex:- symfony/web/index.php/pim/list */
        $new = $rest;

        /* get the current module and action */
        $explodeed = explode("/", $rest);
        $currentModule = $explodeed[3];
        $currentAction = $explodeed[4];
        $RequestUrl = "./" . $explodeed[0] . "/" . $explodeed[1] . "/" . $explodeed[2] . "/" . $explodeed[3] . "/" . $explodeed[4];


//        die($RequestUrl);

        if ($sf_params->get('action') == "listUser") {

            $_SESSION['currentMenuID'] = "13001";
           
            
        } else {
            $query = "SELECT * FROM  hs_hr_sm_mnuitem WHERE  sm_mnuitem_webpage_url LIKE  '{$RequestUrl}'";
            $conn = Doctrine_Manager::getInstance()->connection();
            $stmt = $conn->prepare($query);
            $stmt->execute();

            while ($row = $stmt->fetch()) {

                $_SESSION['currentMenuID'] = $row['sm_mnuitem_id'];
            }
        }
        ?>
        <table style="background-color:white; border: 2px solid #FAD163; width: 98%; margin-left: 15px; margin-bottom: 3px;">
            <tr>
                <td>
                    <?php 
                    $Culture = $_SESSION['symfony/user/sfUser/culture'];
                    $defaultDao = new DefaultDao();
                    $path = $defaultDao->get_breadcrumb($_SESSION['currentMenuID'], "{$Culture}");

                    if($path){
                    foreach ($path as $path1) {
                        $pathVal = null;
                        $pathVal.="<img src=" . public_path('images/rarrow.jpg') . " width='20px' height='10px' alt='' /> " . $path1;
                    }}
                    echo $pathVal;
                    ?>
                </td>
            </tr>
        </table>
        <?php if ($sf_params->get('module') == "pim" && $_SESSION['PIM_EMPID'] != "" && $sf_params->get('action') != "addEmployee" && $sf_params->get('action') != "searchEmployee") { ?>
            <table style="background-color:white; border: 2px solid #FAD163; width: 98%; margin-left: 15px; margin-bottom: 3px;">
                <tr>
                    <td rowspan="2">

                        <span id="Currentimage">
                            <img id="currentImage" style="width:50px; height:50px; padding-left:5px; padding-bottom: 0px; border:none;" alt="Employee Photo"
                                 src="<?php echo url_for("pim/viewPhoto?id=" . $encrypt->encrypt($_SESSION['PIM_EMPID'])); ?>" />

                        </span>


                    </td>
                    <td>

                        <?php
                        $Culture = $_SESSION['symfony/user/sfUser/culture'];
                        $ESSDao = new ESSDao();
                        try{
                           
//                            die($_SESSION['PIM_EMPID']);
                        $Employee = $ESSDao->readEmployee($_SESSION['PIM_EMPID']);
                        if($Employee){
                        if ($Culture == "en") {
                            $EName = "getEmp_display_name";
                        } else {
                            $EName = "getEmp_display_name_" . $Culture;
                        }
                        if ($Employee->$EName() == null) {
                            $empName = $Employee->getEmp_display_name();
                        } else {
                            $empName = $Employee->$EName();
                        }
                        }
                        else{
                            throw new Exception("no permission",500);
                        }
                        }catch(Exception $e){
                           
                            sfContext::getInstance()->getController()->redirect("default/PermissionDenind");
                        }
                        ?>
                        <b><?php echo __('Name') ?> </b>  : <?php echo $empName; ?>
                    </td>
                    <td style="">
                        <b><?php echo __('Employee Id') ?></b>  : <?php echo $Employee->employeeId; ?>
                    </td>
                    <td>
                        <b><?php echo __('NIC No') ?></b>  : <?php echo $Employee->emp_nic_no; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php
                        if ($Culture == "en") {
                            $jobName = "name";
                        } else {
                            $jobName = "name_" . $Culture;
                        }
                        if ($Employee->jobTitle->$jobName == null) {
                            $joblanName = $Employee->jobTitle->name;
                        } else {
                            $joblanName = $Employee->jobTitle->$jobName;
                        }
                        ?>
                        <b><?php echo __('Designation') ?></b>  : <?php echo $joblanName; ?>
                    </td>
                    <td>

                        <?php
                        if ($Culture == "en") {
                            $unitName = "title";
                        } else {
                            $unitName = "title_" . $Culture;
                        }
                        if ($Employee->subDivision->$unitName == null) {
                            $UnitName = $Employee->subDivision->title;
                        } else {
                            $UnitName = $Employee->subDivision->$unitName;
                        }
                        ?>
                        <b><?php echo __('Work Station/Division') ?></b>  : <?php echo $UnitName; ?>
                    </td>
                    <td>

                        <?php
                        if ($Culture == "en") {
                            $unitName = "title";
                        } else {
                            $unitName = "title_" . $Culture;
                        }
                        if ($Employee->subDivision->$unitName == null) {
                            $UnitName = $Employee->subDivision->title;
                        } else {
                            $UnitName = $Employee->subDivision->$unitName;
                        }
                        ?>
                        <b><?php echo __('Appointment Date') ?></b>  : <?php echo $Employee->emp_public_app_date; ?>
                    </td>

                </tr>
            </table>


        <?php } ?>

        <?php echo $sf_content ?>


        <div align="center" style="margin-top: 5px;"><img src="<?php echo public_path('images/icta.png') ?>" alt="" /></div>
        <div align="center">Copyright © 2011 Information and Communication Technology Agency of Sri Lanka. All rights reserved.</div>
        <script type="text/javascript">
            //<![CDATA[	    

            if (document.getElementById && document.createElement) {
                roundBorder('outerbox');
            }

            function buttonSecurityCommon(addButtonHide,saveButton,editButton,deleteButton){

                var saveButton=saveButton;
                var editButton=editButton;
                var deleteButton=deleteButton;
                var addButtonHide=addButtonHide;

                $.ajax({
                    type: "POST",
                    async:false,
                    url: "<?php echo url_for('default/ButtonSecurityCommon') ?>",
                    data: {

                    },
                    dataType: "json",
                    success: function(data){
                        if(data.save==0){
                            $("#"+saveButton).hide();
                        }
                        if(data.add==0){
                            $("#"+addButtonHide).hide();
                        }
                        if(data.edit==0){
                            $("#"+editButton).hide();
                        }
                        if(data.deleteb==0){
                            $(".deleteLinks").each(function()
                            {
                                $(this).hide();
                            });
                            $("#"+deleteButton).hide();
                        }

                    }
                });



            }
            function buttonSecurityCommonMultiple(addclassName,saveclassName,editclassName,deleteclassName){
                if(addclassName!=""){
                    var addclassName=addclassName;
                }else{
                    var addclassName="xxx";
                }
                if(saveclassName!=null){
                    var saveclassName=saveclassName;
                }else{
                    var saveclassName="xxx";
                }
                if(editclassName!=null){
                    var editclassName=editclassName;
                }else{
                    var editclassName="xxx";
                }

                if(deleteclassName!=null){
                    var deleteclassName=deleteclassName;
                }else{
                    var deleteclassName="xxx";
                }
        
        
        
        
                $.ajax({
                    type: "POST",
                    async:false,
                    url: "<?php echo url_for('default/ButtonSecurityCommon') ?>",
                    data: {

                    },
                    dataType: "json",
                    success: function(data){
                        if(data.save==0){
                            $("."+saveclassName).each(function()
                            {
                                $(this).hide();
                            });
                        }
                        if(data.add==0){
                            $("."+addclassName).each(function()
                            {
                                $(this).hide();
                            });
                        }
                        if(data.edit==0){
                            $("."+editclassName).each(function()
                            {
                                $(this).hide();
                            });
                        }
                        if(data.deleteb==0){
                            $("."+deleteclassName).each(function()
                            {
                                $(this).hide();
                            });
                                                
                        }

                    }
                });

            }

            //]]>	
        </script>    
    </body>
</html>
