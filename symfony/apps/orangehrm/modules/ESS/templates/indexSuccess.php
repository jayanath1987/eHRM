<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery-ui.min.js') ?>"></script>
<link href="<?php echo public_path('../../themes/orange/css/jquery/jquery-ui.css') ?>" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.validate.js') ?>"></script>
<link href="<?php echo public_path('../../themes/orange/css/style.css') ?>" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?php echo public_path('../../scripts/time.js') ?>"></script>
<script type="text/javascript" src="<?php echo public_path('../../scripts/paging.js') ?>"></script>
<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.simplemodal.js') ?>"></script>
<script type="text/javascript" src="<?php echo public_path('../../scripts/paginator.js') ?>"></script>
<style type="text/css">
.active
{
color:#FFF8C6;
background-color:#FFE87C;
border: solid 1px #AF7817;
padding:1px 1px;
margin:1px;
text-decoration:none;
}
.inactive
{
color:#000000;
cursor:default;
text-decoration:none;
border: solid 1px #FFF8C6;
padding:1px 1px;
margin:1px;

}
div.formpage4col select{
width: 50px;
}
.paginator{

    padding-left: 50px;

}

    .gridheader{
        background-image : url(../../images/gridheader_rep.jpg);
        background-repeat: repeat-x;
        margin-left: 10px;
        margin-right: 10px;
        margin-top: 10px;

        height:20px;

    }

    .mainHeading{
        font-size: 16px;
        font-weight: bold;
    }

</style>
<?php
$encrypt = new EncryptionHandler();
?>
<div id="dialog" title="<?php echo __("Notice Description"); ?>">
    <div id="test">


    </div>
</div>

    <div id="status"><?php echo message(); ?></div>
    <div class="outerbox">
        <div class="mainHeading"  ><?php
echo __("Hi, ");

if ($Culture == "en") {
    $EName = "getEmp_display_name";
} else {
    $EName = "getEmp_display_name_" . $Culture;
}
if ($Employee->$EName() == null) {
    echo $Employee->getEmp_display_name();
} else {
    echo $Employee->$EName();
}
?></div> <?php
            $encrypt = new EncryptionHandler();
?>
        <form name="frmSave" id="frmSave" method="post"  action="">
            <div id="top1" style="">
                <div id="photo" style="float: left">
                    <span id="Currentimage">
                        <img id="currentImage" style="width:90px; height:100px; padding: 25px;" alt="Employee Photo"
                             src="<?php echo url_for("pim/viewPhoto?id=" . $encrypt->encrypt($Employee->empNumber)); ?>" /><br />
                        <span id="imageHint" style="padding-left:10px;">
                        </span>
                    </span>
                </div >
                <div id="EmpDetailHeader" style="float: right;">
                    <br class="clear"/>
                    <div style="font-size: medium">
<?php
            if ($Culture == "en") {
                $EName = "getEmp_display_name";
            } else {
                $EName = "getEmp_display_name_" . $Culture;
            }
            if ($Employee->$EName() == null) {
                echo $Employee->getEmp_display_name();
            } else {
                echo $Employee->$EName();
            }
?>
                    </div>
                    <br class="clear" style="padding-top: 5px;"/>
<?php echo __("Employee ID ") . " &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp " . $Employee->getEmployee_id(); ?>
                    <br class="clear" style="padding-top: 5px;"/>
                    <hr width="600"/>

                    <div style="padding-top: 5px;">
                        <label style="width: 250px;padding-left: 0px; "><?php
            echo __("Designation") . " &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp ";
            if ($Culture == "en") {

                $EJob = "getJobtit_name";
            } else {
                $EJob = "getJobtit_name_" . $Culture;
            }
            if ($Employee->jobTitle->$EJob() == null) {
                echo $Employee->jobTitle->getJobtit_name();
            } else {
                echo $Employee->jobTitle->$EJob();
            }
?></label>

                        <label style="width: 250px; "><?php echo __("Division") . " &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp " . $Employee->subDivision->getTitle(); ?></label>
                    </div>
                </div>



                <br class="clear"/>
            </div>
            <div id="body1" >
                <div style="padding-right: 5px; padding-left: 5px;">
                    <div class="outerbox" style="margin-left: 5px; margin-top:5px; ">
                        <div class="mainHeading"><?php echo __("My Profile"); ?></div>
                        <div id="divmyprof" >
                            <div >


                                <label style="width: 170px;"><?php echo __("Address"); ?></label>
                                <label style="width: 400px;"><?php
                            if ($Culture == "en") {
                                $EContact1 = "con_per_addLine1";
                            } else {
                                $EContact1 = "con_per_addLine1_" . $Culture;
                            }
                            if ($Employee->$EName() == null) {
                                echo $Employee->EmpContact->con_per_addLine1;
                                if ($Employee->EmpContact->con_per_addLine1 != null) {
                                    echo(", ");
                                }
                            } else {
                                echo $Employee->EmpContact->$EContact1;
                                if ($Employee->EmpContact->$EContact1 != null) {
                                    echo(", ");
                                }
                            }

                            if ($Culture == "en") {
                                $EContact2 = "con_per_addLine2";
                            } else {
                                $EContact2 = "con_per_addLine2_" . $Culture;
                            }
                            if ($Employee->$EName() == null) {
                                echo $Employee->EmpContact->con_per_addLine2;
                                if ($Employee->EmpContact->con_per_addLine2 != null) {
                                    echo(", ");
                                }
                            } else {
                                echo $Employee->EmpContact->$EContact2;
                                if ($Employee->EmpContact->$EContact2 != null) {
                                    echo(", ");
                                }
                            }

                            if ($Culture == "en") {
                                $EContact3 = "con_per_del_postoffice";
                            } else {
                                $EContact3 = "con_per_del_postoffice_" . $Culture;
                            }
                            if ($Employee->$EName() == null) {
                                echo $Employee->EmpContact->con_per_del_postoffice;
                                if ($Employee->EmpContact->con_per_del_postoffice != null) {
                                    echo(". ");
                                }
                            } else {
                                echo $Employee->EmpContact->$EContact3;
                                if ($Employee->EmpContact->$EContact3 != null) {
                                    echo(". ");
                                }
                            }

                            echo $Employee->EmpContact->con_per_postal_code ?></label>
                            </div>
                            <div style="clear: both;"> </div>

                            <div style="float: left;width: 350px;">
                                <label style="width: 170px;"><?php echo __("Office Telephone"); ?></label><label style="width: 150px;"><?php echo $Employee->EmpContact->con_off_direct ?></label>
                                <label style="width: 170px;"><?php echo __("Official E-Mail Address"); ?></label><label style="width: 150px;"><?php echo $Employee->EmpContact->con_off_email ?></label>
                                <label style="width: 170px;"><?php echo __("Work Experience"); ?></label><label style="width: 150px;"><?php
                                    $date1 = $Employee->getEmp_com_date();

                                    $date2 = strtotime(date("YYmd"));

                                    $date1 = new DateTime($date1);
                                    $date2 = new DateTime($date2);
                                    $interval = $date1->diff($date2);
                                    echo $interval->y . " ";
                                    if ($interval->y > 1) {
                                        echo __("Years") . ",";
                                    } else {
                                        echo __("Year") . ",";
                                    }
                                    echo $interval->m . " ";
                                    if ($interval->m > 1) {
                                        echo __("Months") . ",";
                                    } else {
                                        echo __("Month") . ",";
                                    }
                                    echo $interval->d . " ";
                                    if ($interval->d > 1) {
                                        echo __("Days") . ".";
                                    } else {
                                        echo __("Day") . ".";
                                    }
?></label>
                            </div>
                            <div style="float: right;width: 300px;">
                                <label style="width: 150px;"><?php echo __("Personal Telephone"); ?></label><label style="width: 120px;"><?php echo $Employee->EmpContact->con_per_phone ?></label>
                                <label style="width: 150px;"><?php echo __("NIC Number"); ?></label><label style="width: 120px;"><?php echo $Employee->emp_nic_no ?></label>
                                <label style="width: 150px;"><?php echo __("Appointment date"); ?></label><label style="width: 120px;"><?php echo $Employee->emp_public_app_date; ?></label>
                            </div>
                            <div style="clear: both;"> </div>
                        </div>

                    </div>
                </div>
                <br class="clear"/>

               
             
<!--                        <div class="outerbox" style="margin-left: 10px; margin-right: 10px;float:left;width: 375px;">-->
                            <div class="outerbox" style="margin-left: 10px;margin-right: 14px;float:left;width: 375px;">
                            <div class="mainHeading"><?php echo __("Approvals"); ?></div>
                            <div class="maincontent" style="height:160px;">
                                <div style="margin: 5px;">
                                                                 

                                    
                                <?php 
                                $row = 0;
                                if($apSummary){
                                foreach ($apSummary as $approveList) {
                                    //die(print_r($approveList));
                                    $cssClass = ($row % 2) ? '#f7f7f7' : '#edebeb';
                                    $row = $row + 1;
                                    ?>
                                            
                                    <?php
                                    if ($culture == "en") {
                                        $feild = "name";
                                    } else {
                                        $feild = "module_name_" . $culture;
                                    }
                                    ?>
                                            
 <?php            

            if ($culture == "en") {
                $feil = "wfmod_name";
            } else {
                $feil = "wfmod_name_" . $culture;
            }
            ?>
                                                    
                                <div style="height: 18px; width:70%;float: left;background-color: <?php echo $cssClass; ?>" id="<?php echo $approveList['wfmod_view_name']; ?>"><a style="padding-left: 10px;" href="<?php echo url_for("workflow/ApprovalSummary") ?>" >
                                                <?php echo $approveList[$feil]; ?>  
                                                        
                                            </a></div>
                                <div style="height: 18px; width:30%;float: right;background-color: <?php echo $cssClass; ?>"><?php echo $approveList['COUNT(wfmod_name)']; ?> <?php echo __("Pending ") ?></div>
                                <br class="clear">    
                                                    
                                            <?php }}  ?>
                                
                                <?php $cssClass = ($row % 2) ? '#f7f7f7' : '#edebeb';
                                    $row = $row + 1; 
                                    
                                    
                                    ?>
                                <?php if($PendingLeave > 0){?>
                                <div style="height: 18px; width:70%;float: left;background-color: <?php echo $cssClass; ?>" id="<?php echo $approveList['wfmod_view_name']; ?>"><a style="padding-left: 10px;" href="<?php echo url_for("Leave/LeaveSearch?emp=".$subordinateEmpno."&type=1"); ?>" >
                                                <?php echo __("Leave"); ?>  

                                            </a></div>
                                <div style="height: 18px; width:30%;float: right;background-color: <?php echo $cssClass; ?>"><?php echo $PendingLeave; ?> <?php echo __("Pending ") ?></div>
                                <br class="clear">  
                                <?php } ?>    
<!--                                <?php if($PendingEvlFT > 0){?>
                                <div style="height: 18px; width:50%;float: left;background-color: <?php echo $cssClass; ?>" id="<?php echo $approveList['wfmod_view_name']; ?>"><a style="padding-left: 10px;" href="<?php echo url_for("evaluation/FTApproveSearch?emp=".$defsubordin."&type=1"); ?>" >
                                                <?php echo __("Evaluation Function\Task"); ?>  

                                            </a></div>
                                <div style="height: 18px; width:50%;float: right;background-color: <?php echo $cssClass; ?>"><?php echo $PendingEvlFT; ?> <?php echo __("Pending ") ?></div>
                                <br class="clear">  
                                <?php } ?>  -->
                                <?php if($PendingEvaluationforSupervisor > 0){?>
                                <div style="height: 18px; width:70%;float: left;background-color: <?php echo $cssClass; ?>" id="<?php echo $approveList['wfmod_view_name']; ?>"><a style="padding-left: 10px;" href="<?php echo url_for("evaluation/DefineEmployeeEvaluation?emp=".$SupervisorEvl."&type=0"); ?>" >
                                                <?php echo __("Evaluate as a Supervisor"); ?>  

                                            </a></div>
                                <div style="height: 18px; width:30%;float: right;background-color: <?php echo $cssClass; ?>"><?php echo $PendingEvaluationforSupervisor; ?> <?php echo __("Pending ") ?></div>
                                <br class="clear">  
                                <?php } ?>
                                <?php $cssClass = ($row % 2) ? '#f7f7f7' : '#edebeb';
                                    $row = $row + 1;                                    
                                    
                                    ?>
                                <?php if($PendingEvaluationforModerator > 0){?>
                                <div style="height: 18px; width:70%;float: left;background-color: <?php echo $cssClass; ?>" id="<?php echo $approveList['wfmod_view_name']; ?>"><a style="padding-left: 10px;" href="<?php echo url_for("evaluation/DefineEmployeeEvaluation?emp=".$Moderatorsubordin."&type=1"); ?>" >
                                                <?php echo __("Evaluate as a Moderator"); ?>  

                                            </a></div>
                                <div style="height: 18px; width:30%;float: right;background-color: <?php echo $cssClass; ?>"><?php echo $PendingEvaluationforModerator; ?> <?php echo __("Pending ") ?></div>
                                <br class="clear">  
                                <?php } ?>
                                
                                <?php $cssClass = ($row % 2) ? '#f7f7f7' : '#edebeb';
                                    $row = $row + 1;                                    
                                    
                                    ?>
                                <?php if($employeePendingTrainingCount > 0){?>
                                <div style="height: 18px; width:70%;float: left;background-color: <?php echo $cssClass; ?>" id="<?php echo $approveList['wfmod_view_name']; ?>"><a style="padding-left: 10px;" href="<?php echo url_for("training/Adminapp"); ?>" >
                                                <?php echo __("Traning"); ?>  

                                            </a></div>
                                <div style="height: 18px; width:30%;float: right;background-color: <?php echo $cssClass; ?>"><?php echo $employeePendingTrainingCount; ?> <?php echo __("Pending ") ?></div>
                                <br class="clear">  
                                <?php } ?>
                                
                                
                                <?php $cssClass = ($row % 2) ? '#f7f7f7' : '#edebeb';
                                    $row = $row + 1;                                    
                                    
                                    ?>
                                <?php if($employeeNotificationlCount > 0){?>
                                <div style="height: 18px; width:70%;float: left;background-color: <?php echo $cssClass; ?>" id="<?php echo $approveList['wfmod_view_name']; ?>"><a style="padding-left: 10px;" href="<?php echo url_for("default/ListNotification?emp=".$Employee->empNumber."&type=1"); ?>" >
                                                <?php echo __("Approved Notifications"); ?>  

                                            </a></div>
                                <div style="height: 18px; width:30%;float: right;background-color: <?php echo $cssClass; ?>"><?php echo $employeeNotificationlCount; ?> <?php echo __("Approved ") ?></div>
                                <br class="clear">  
                                <?php } ?>
                                </div>
           
                                            </div>
                                            </div>
<!--                   


-->                       
                            
                                    <div class="outerbox" style="margin-left: 10px;margin-right: 14px;float:right;width: 375px;">
                                        <div class="mainHeading"><?php echo __("Notices"); ?></div>
                                        <div id="noticescontent" style="height: 150px;">
                                           
                                            <table id="results2" name="results2" style="margin:5px; width: 97%;" cellpadding="0" cellspacing="0" class="data-table">
                                                <thead>
                                                    
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $row = 0;
                                                    if($notices!= null){
                                                    foreach ($notices as $Notice) {
                                                        $cssClass = ($row % 2) ? '#f7f7f7' : '#edebeb';
                                                        $row = $row + 1;
                                                        ?>
                                                
                                                        <tr style="background-color:<?php echo $cssClass ?>" >
                                                            
                                                            <td class="" style="text-indent: 5px">                                                        
                                                                <a href="#" onclick="setDescription('<?php
                                                    if ($Culture == 'en') {
                                                        $abc="notice_desc";
                                                        $retun=$Notice->$abc;
                                                        $retun.="<br/><br/><br/> Writen By : ".$Notice->Employee->emp_display_name;
                                                        $retun.="<br/> Date : ".$Notice->create_date.",   Time : ".$Notice->create_time;
                                                        
                                                    } else {
                                                        $abc = "notice_desc_" . $Culture;

                                                        if ($Notice->$abc == null) {
                                                            $retun=$Notice->notice_desc;
                                                        } else {
                                                            $retun=$Notice->$abc;
                                                        }
                                                    }
                                                     
                                                     echo $retun;   ?>');" >
                                                                       <?php
                                                                       if ($Culture == 'en') {
                                                                           echo $Notice->notice_name;
                                                                           ?>
                                                                    <script type="text/javascript">
                                                                    $("#dialog").attr("title","<?php echo $Notice->notice_name; ?>");
                                                                    </script>
                                                                           <?php
                                                                       } else {
                                                                           $abc = "notice_name_" . $Culture;

                                                                           if ($Notice->$abc == null) {
                                                                               echo $Notice->notice_name;
                                                                           } else {
                                                                               echo $Notice->$abc;
                                                                           }
                                                                       }
                                                                       ?></a>
                                                            </td>
                                                                
                                                        </tr>
                                                    <?php }} ?>
                                                </tbody>
                                            </table>
                                            <div style='text-align: right; padding-right: 15px;' name='pageNavPosition2' id='pageNavPosition2'></div>
                                                
                                                
                                                
                                            <script type="text/javascript">
                                                var pager2 = new Pager2('results2', 5);
                                                pager2.init();
                                                pager2.showPageNav('pager2', 'pageNavPosition2','<?php echo $culture; ?>');
                                                pager2.showPage(1);
                                            </script>
                                                
                                        </div>
                                    </div>
                                        
                              


                                <div style="clear: both;"> </div>

                                
                                
<!--                           <div class="outerbox" style="padding-top: 10px; margin-left: 10px; margin-right: 10px;float:left;width: 375px;">     -->
                            <div class="outerbox" style="padding-top: 5px; margin-left: 10px;margin-right: 14px;float:left;width: 375px;">
                            <div class="mainHeading"><?php echo __("My Attendance"); ?></div>
                            <div style="height: 160px; overflow: auto">
                                <table style="margin-top: 10px; margin-left: 10px; margin-right: 10px; width: 325px;" cellpadding="0" cellspacing="0" class="data-table">
                                    <thead>
                                        <tr>

                                            <td class="gridheader"  scope="col" style="text-indent: 10px; width: 60px; background-color: #E0B662; text-align: center">
<?php echo __('Date') ?>
                                            </td>
                                            <td class="gridheader" scope="col" style="width: 40px; background-color: #E0B662; text-align: center">
<?php echo __('In') ?>
                                            </td>
                                            <td class="gridheader"scope="col" style="width: 40px; background-color: #E0B662;text-align: center">
<?php echo __('Out') ?>
                                            </td>
                                            <td class="gridheader" scope="col" style="width: 40px; background-color: #E0B662;text-align: center">
<?php echo __('L.In') ?>
                                            </td>
                                            <td class="gridheader" scope="col" style="width: 40px; background-color: #E0B662;text-align: center">
<?php echo __('E.Out') ?>
                                            </td>
                                            <td class="gridheader" scope="col" style="width: 40px; background-color: #E0B662;text-align: center">
<?php echo __('Working Hours') ?>
                                            </td>                                            

                                        </tr>
                                    </thead>
                                    <tbody>
<?php
                                    $row = 0;
                                    foreach ($attendance as $promotion) {

                                        //die(print_r($promotion));
                                        $cssClass = ($row % 2) ? '#edebeb' : '#f7f7f7';
                                        $row = $row + 1;
?>              <?php
                                        $dd = $promotion->getAtn_date();
                                        $timeStamp = strtotime($dd); //find Day
                                        $day = getdate($timeStamp);
                                        $cday = $day['weekday'];
?>
                                        <?php
                                        foreach ($recordday as $RD) {
                                            $var = '0';
                                            if ($RD['adt_day'] == $day['weekday']) {
                                                if ($RD['dt_id'] == "3") {
                                        ?>
                                                    <tr class="" style="background-color:khaki">
<?php } else if ($RD['dt_id'] == "4") {
?>
                                                <tr class="" style="background-color: wheat;">
<?php } else {
?>
                                            <?php
                                                    foreach ($leaveholiday as $HD) {
                                                        if ($HD['leave_holiday_date'] == $promotion->getAtn_date()) {
                                            ?>
                                                        <tr class="" style="background-color: sandybrown" >
                                            <?php
                                                            $var = "1";
                                                        }
                                                    } ?>
<?php if ($var != "1") { ?>
                                                    <tr style="background-color:<?php echo $cssClass ?>" >
                                            <?php
                                                    }
                                                }
                                            }
                                        }
                                            ?>


                                            <td class="" style="text-indent: 5px">
<?php echo $promotion->getAtn_date(); ?>
                                            </td>
                                            <td class="" style="text-align: center"><?php
                                        $pieces = explode(":", $promotion->getAtn_intime());
                                        echo $pieces[0] . ":" . $pieces[1];
?>

                                            </td>
                                            <td class=""style="text-align: center" >
                                                <?php
                                                $pieces = explode(":", $promotion->getAtn_outtime());
                                                echo $pieces[0] . ":" . $pieces[1];
                                                ?>

                                            </td>
                                            <td class="" style="text-align: center">
                                                <div id="late_<?php echo $row ?>">
                                                    <?php
                                                    $pieces = explode(":", $promotion->getAtn_latetime());
                                                    echo $pieces[0] . ":" . $pieces[1];
                                                    ?>
                                                </div>
                                            </td>
                                            <td class="" style="text-align: center">
                                                <div id="early_<?php echo $row ?>">
                                                    <?php
                                                    $pieces = explode(":", $promotion->getAtn_earlydeptime());
                                                    echo $pieces[0] . ":" . $pieces[1];
                                                    ?>
                                                </div>
                                            </td>
                                             <td class="" style="text-align: center">
                                                <div id="early_<?php echo $row ?>">
                                                    <?php
                                                    $datetime1 = new DateTime($promotion->getAtn_intime());
                                                    $datetime2 = new DateTime($promotion->getAtn_outtime());
                                                    $interval = $datetime1->diff($datetime2);
                                                    
                                                    $hours   = $interval->format('%h');
                                                    $minutes = $interval->format('%i');
                                                    if($hours < 10){
                                                        $hours="0".$hours;
                                                    }
                                                    if($minutes < 10){
                                                        $minutes="0".$minutes;
                                                    }
                                                    
                                                    echo $hours .":".$minutes;
                                                    
                                                    ?>
                                                </div>
                                            </td>

                                        </tr>
<?php } ?>
                                            </tbody>
                                        </table>

                                    </div >
                           </div>
                                    

<!--                           <div class="outerbox" style="margin-left: 10px; margin-right: 10px;float:left;width: 375px;">     
                            <div class="mainHeading"><?php echo __("Policy Documents"); ?></div>                                
<div id="appcontent" style="height: 150px;" >


                                <table class="gridheader" style="width: 345px; border-spacing: inherit; ">
                                    <tr>
                                        <td style="width: 200px; height: 20px;text-indent: 10px; font-weight: bold"><?php echo __("Module") ?></td><td style="text-align: center; font-weight: bold"><?php echo __("Request Count") ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-indent: 10px; background-color: #f7f7f7"><?php echo __("Disciplinary") ?></td><td style="background-color: #f7f7f7; text-align: center; "><?php echo $PendingDisciplinary; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-indent: 10px; background-color: #edebeb"><?php echo __("Leave") ?></td><td style="background-color: #edebeb; text-align: center;"><?php echo $PendingLeave; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-indent: 10px;background-color: #f7f7f7"><?php echo __("Training") ?></td><td style="background-color: #f7f7f7; text-align: center;"><?php echo $PendingTraining; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-indent: 10px;background-color: #edebeb"><?php echo __("Transfer") ?></td><td style="background-color: #edebeb; text-align: center;"><?php echo $PendingTransfer; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-indent: 10px; background-color: #f7f7f7"><?php echo __("Promotion") ?></td><td style="background-color: #f7f7f7; text-align: center;"><?php echo $PendingPromotion; ?></td>
                                    </tr>
                                </table>



                            </div>
                        </div>
                    </div>-->
    
    
                    <div class="outerbox" style="padding-top: 5px; margin-left: 10px;margin-right: 14px;float:right;width: 375px;">
<!--                    <div id="policydoc" style="padding-right: 15px; padding-top: 5px; padding-left: 5px;  padding-bottom: 5px; float: right; height: 200px; width: 374px; ">-->

<!--                        <div class="outerbox" style=" margin-left: 5px; margin-right: 5px;">-->
                            <div class="mainHeading"><?php echo __("Policy Documents"); ?></div>
                            <div style="height: 150px;">
                                <div class="gridheader" style="padding-left:10px;padding-top: 5px; font-weight:bold; height: 20px;" ><?php echo __("Documents") ?></div>


                                <style type="text/css">
                                    .pg-normal {
                                        color: black;
                                        font-weight: normal;
                                        text-decoration: none;
                                        cursor: pointer;
                                    }
                                    .pg-selected {
                                        color: black;
                                        font-weight: bold;
                                        text-decoration: underline;
                                        cursor: pointer;
                                    }
                                </style>

<?php
//define('ROOT_PATH', '/uploads/UExcel/');
                                    $scriptPath = ROOT_PATH;
                                    $SS = $scriptPath . '/symfony/web/uploads/UExcel/';
//die(print_r($scriptPath));
// $dir = realpath('/var/www/commonhrm/symfony/web/uploads/UExcel/');

                                    $dir = realpath($SS);
                                    $dh = opendir($dir); ?>
                                    <table id="results" name="results" style="width: 370px; padding-right: 5px;" cellpadding="0" cellspacing="0">

                                        <tr>
                                            <th></th>
                                            <th></th>
                                        </tr>
<?php
                                    $row = 1;
                                    while (($file = readdir($dh)) !== false) {
                                        $cssClass = ($row % 2) ? '#f7f7f7' : '#edebeb';
                                        $row = $row + 1;



                                        if ($file == ".") {
                                            
                                        } else if ($file == "..") {
                                            
                                        } else if ($file == ".svn") {
                                            
                                        } else {
?>
                                            <tr >
                                                <td ><div style="margin-left: 10px;margin-right: 10px; height: 20px; background-color: <?php echo $cssClass ?>"><label style="margin-top: 2px; width: 200px;" name="field-name" value="rec<?php echo $row ?>"><?php echo "<a href=" . "../../uploads/UExcel/";
                                            echo $file . ">$file</>"; ?></label></div></td>
                                            </tr>
<?php
                                        }
                                    }
                                    closedir($dh);
?>

                                </table>
                               <div style='text-align: right; padding-right: 15px;'  name='pageNavPosition' id='pageNavPosition'></div> 



                                <script type="text/javascript">
                                    var pager = new Pager('results', 5);
                                    pager.init();
                                    pager.showPageNav('pager', 'pageNavPosition');
                                    pager.showPage(1);
                                </script>



<!--                            </div>  -->
                        </div>
                    </div>
  
      <div style="clear: both;"> </div>                          
                       
                    </div>



                    <br class="clear"/>
                     <style type="text/css">
                                    .pg-normal {
                                        color: black;
                                        font-weight: normal;
                                        text-decoration: none;
                                        cursor: pointer;
                                    }
                                    .pg-selected {
                                        color: black;
                                        font-weight: bold;
                                        text-decoration: underline;
                                        cursor: pointer;
                                    }
                                </style>        
                </form>
            </div>

      

<?php
                                                require_once '../../lib/common/LocaleUtil.php';
                                                $sysConf = OrangeConfig::getInstance()->getSysConf();
                                                $sysConf = new sysConf();
                                                $inputDate = $sysConf->dateInputHint;
                                                $format = LocaleUtil::convertToXpDateFormat($sysConf->getDateFormat());
?>
                                                <script type="text/javascript">
             var pagination = 0;

            //Pagination variable
            itemsPerPage = 5;
            paginatorStyle = 2;
            function setDescription(val){
                $("#test").empty();
                $("#test").append(val);
                jQuery('#dialog').dialog('open');
                return false;
            }
            
            jQuery("#dialog").dialog({

                bgiframe: true, autoOpen: false, position: 'center', minWidth:500, maxWidth:500, modal: true
            });
                                                    var BrowserDetect = {
                                                        init: function () {
                                                            this.browser = this.searchString(this.dataBrowser) || "An unknown browser";
                                                            this.version = this.searchVersion(navigator.userAgent)
                                                                || this.searchVersion(navigator.appVersion)
                                                                || "an unknown version";
                                                            this.OS = this.searchString(this.dataOS) || "an unknown OS";
                                                        },
                                                        searchString: function (data) {
                                                            for (var i=0;i<data.length;i++) {
                                                                var dataString = data[i].string;
                                                                var dataProp = data[i].prop;
                                                                this.versionSearchString = data[i].versionSearch || data[i].identity;
                                                                if (dataString) {
                                                                    if (dataString.indexOf(data[i].subString) != -1)
                                                                        return data[i].identity;
                                                                }
                                                                else if (dataProp)
                                                                    return data[i].identity;
                                                            }
                                                        },
                                                        searchVersion: function (dataString) {
                                                            var index = dataString.indexOf(this.versionSearchString);
                                                            if (index == -1) return;
                                                            return parseFloat(dataString.substring(index+this.versionSearchString.length+1));
                                                        },
                                                        dataBrowser: [
                                                            {
                                                                string: navigator.userAgent,
                                                                subString: "Chrome",
                                                                identity: "Chrome"
                                                            },
                                                            { string: navigator.userAgent,
                                                                subString: "OmniWeb",
                                                                versionSearch: "OmniWeb/",
                                                                identity: "OmniWeb"
                                                            },
                                                            {
                                                                string: navigator.vendor,
                                                                subString: "Apple",
                                                                identity: "Safari",
                                                                versionSearch: "Version"
                                                            },
                                                            {
                                                                prop: window.opera,
                                                                identity: "Opera"
                                                            },
                                                            {
                                                                string: navigator.vendor,
                                                                subString: "iCab",
                                                                identity: "iCab"
                                                            },
                                                            {
                                                                string: navigator.vendor,
                                                                subString: "KDE",
                                                                identity: "Konqueror"
                                                            },
                                                            {
                                                                string: navigator.userAgent,
                                                                subString: "Firefox",
                                                                identity: "Firefox"
                                                            },
                                                            {
                                                                string: navigator.vendor,
                                                                subString: "Camino",
                                                                identity: "Camino"
                                                            },
                                                            { // for newer Netscapes (6+)
                                                                string: navigator.userAgent,
                                                                subString: "Netscape",
                                                                identity: "Netscape"
                                                            },
                                                            {
                                                                string: navigator.userAgent,
                                                                subString: "MSIE",
                                                                identity: "Explorer",
                                                                versionSearch: "MSIE"
                                                            },
                                                            {
                                                                string: navigator.userAgent,
                                                                subString: "Gecko",
                                                                identity: "Mozilla",
                                                                versionSearch: "rv"
                                                            },
                                                            { // for older Netscapes (4-)
                                                                string: navigator.userAgent,
                                                                subString: "Mozilla",
                                                                identity: "Netscape",
                                                                versionSearch: "Mozilla"
                                                            }
                                                        ],
                                                        dataOS : [
                                                            {
                                                                string: navigator.platform,
                                                                subString: "Win",
                                                                identity: "Windows"
                                                            },
                                                            {
                                                                string: navigator.platform,
                                                                subString: "Mac",
                                                                identity: "Mac"
                                                            },
                                                            {
                                                                string: navigator.userAgent,
                                                                subString: "iPhone",
                                                                identity: "iPhone/iPod"
                                                            },
                                                            {
                                                                string: navigator.platform,
                                                                subString: "Linux",
                                                                identity: "Linux"
                                                            }
                                                        ]

                                                    };
                                                    BrowserDetect.init();
                                                    if(BrowserDetect.browser=="Firefox"){
                                                        $('#appcontent').css({"height": "160"});
                                                        $('#noticescontent').css({"height": "160"});
                                                    }
                                                    
                                                    
                                                    
                                                    //alert(BrowserDetect.browser);
                                                    //alert(BrowserDetect.version);
                                                    //alert(BrowserDetect.OS);
                                                    $(document).ready(function() {
                                                        //$("#foryourapprove").draggable({ containment: 'parent' });
                                                        //$("#policydoc").draggable({ containment: 'parent' });
                                                        //$("#notice").draggable({ containment: 'parent' });
                                                        //$("#myattendance").draggable({ containment: 'parent' });
                                                        $('#dialog').hide();
                                                        $("#firstpane p.menu_head").click(function()
                                                        {
                                                            $(this).css({backgroundImage:"url(down.png)"}).next("div.menu_body").slideToggle(300).siblings("div.menu_body").slideUp("slow");
                                                            $(this).siblings().css({backgroundImage:"url(left.png)"});
                                                        });




                                                        jQuery.validator.addMethod("orange_date",
                                                        function(value, element, params) {

                                                            //var hint = params[0];
                                                            var format = params[0];

                                                            // date is not required
                                                            if (value == '') {

                                                                return true;
                                                            }
                                                            var d = strToDate(value, "<?php echo $format ?>");


                                                            return (d != false);

                                                        }, ""
                                                    );

                                                        //Validate the form
                                                        $("#frmSave").validate({

                                                            rules: {
                                                                txtName: { required: true,noSpecialCharsOnly: true, maxlength:100 },
                                                                txtNamesi: {noSpecialCharsOnly: true, maxlength:100 },
                                                                txtNameta: {noSpecialCharsOnly: true, maxlength:100 },
                                                                txtLeaveStartDate: { required: true ,orange_date:true},
                                                                cmbHalfDay: { required: true },
                                                                cmbannual: { required: true }
                                                            },
                                                            messages: {
                                                                txtName: {required:"<?php echo __("Holiday is required in English") ?>",maxlength:"<?php echo __("Maximum 100 Characters") ?>",noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>"},
                                                                txtNamesi:{maxlength:"<?php echo __("Maximum 100 Characters") ?>",noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>"},
                                                                txtNameta:{maxlength:"<?php echo __("Maximum 100 Characters") ?>",noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>"},
                                                                txtLeaveStartDate:{ required:"<?php echo __("This is required ") ?>",orange_date: "<?php echo __("Please specify valid date") ?>"},
                                                                cmbHalfDay: "<?php echo __("This is required ") ?>",
                                                                cmbannual: "<?php echo __("This is required ") ?>"
                                                            }
                                                        });

                                                        // When click edit button
                                                        $("#editBtn").click(function() {
                                                            $('#frmSave').submit();
                                                        });

                                                        //When click reset buton
                                                        $("#resetBtn").click(function() {
                                                            document.forms[0].reset('');
                                                        });

                                                        //When Click back button
                                                        $("#btnBack").click(function() {
                                                            location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/Leave/Holyday')) ?>";
        });


        $("#txtLeaveStartDate").datepicker({ dateFormat:'yy-mm-dd' });
    });
</script>
