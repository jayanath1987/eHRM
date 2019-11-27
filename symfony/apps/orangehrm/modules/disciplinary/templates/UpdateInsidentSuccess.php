<?php
if ($lockMode == '1') {
    $editMode = false;
    $disabled = '';
} else {
    $editMode = true;
    $disabled = 'disabled="disabled"';
}
$encrypt = new EncryptionHandler();
?>
<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery-ui.min.js') ?>"></script>
<link href="<?php echo public_path('../../themes/orange/css/jquery/jquery-ui.css') ?>" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.validate.js') ?>"></script>
<script type="text/javascript" src="<?php echo public_path('../../scripts/time.js') ?>"></script>
<link href="../../themes/orange/css/style.css" rel="stylesheet" type="text/css"/>

<div class="formpage4col">
    <div class="navigation">

    </div>
    <div id="status"></div>
    <div class="outerbox">
        <div class="mainHeading"><h2><?php echo __("preliminary investigation") ?></h2></div>
        <?php echo message() ?>
        <form enctype="multipart/form-data" name="frmSave" id="frmSave" method="post"  action="">
            <div class="leftCol">
                <label class="controlLabel" for="txtLocationCode"><?php echo __("Reported Date") ?> <span class="required">*</span></label>
            </div>
            <div class="centerCol">
                <input type="text" class="formInputText" name="txtIncidentReportDate" id="txtIncidentReportDate" value="<?php echo LocaleUtil::getInstance()->formatDate($currentIncident->dis_inc_reporteddate) ?>" />

            </div>
            <div class="leftCol">
                <label class="controlLabel" for="txtLocationCode"><?php echo __("Reported Time") ?></label>
            </div>
            <?php
            $time = $currentIncident->dis_inc_reportedtime;
            $fromtimeexpand = explode(':', $time);
            $fromtimehrs = $fromtimeexpand[0];
            $fromtimemins = $fromtimeexpand[1];
            ?>
            <div class="centerCol">
                <select name="cmbIncidentReportHH" id="cmbIncidentReportHH" class="formSelect" style="width: 50px;" tabindex="4">

                    <option value="-1" <?php if ($fromtimehrs == "")
                echo "selected" ?>><?php echo __("HH"); ?></option>
                    <option value="00" <?php if ($fromtimehrs == "00")
                                echo "selected" ?>><?php echo __("00") ?></option>
                    <option value="01" <?php if ($fromtimehrs == "01")
                                echo "selected" ?>><?php echo __("01") ?></option>
                    <option value="02" <?php if ($fromtimehrs == "02")
                                echo "selected" ?>><?php echo __("02") ?></option>
                    <option value="03" <?php if ($fromtimehrs == "03")
                                echo "selected" ?>><?php echo __("03") ?></option>
                    <option value="04" <?php if ($fromtimehrs == "04")
                                echo "selected" ?>><?php echo __("04") ?></option>
                    <option value="05" <?php if ($fromtimehrs == "05")
                                echo "selected" ?>><?php echo __("05") ?></option>
                    <option value="06" <?php if ($fromtimehrs == "06")
                                echo "selected" ?>><?php echo __("06") ?></option>
                    <option value="07" <?php if ($fromtimehrs == "07")
                                echo "selected" ?>><?php echo __("07") ?></option>
                    <option value="08" <?php if ($fromtimehrs == "08")
                                echo "selected" ?>><?php echo __("08") ?></option>
                    <option value="09" <?php if ($fromtimehrs == "09")
                                echo "selected" ?>><?php echo __("09") ?></option>
                    <option value="10" <?php if ($fromtimehrs == "10")
                                echo "selected" ?>><?php echo __("10") ?></option>
                    <option value="11" <?php if ($fromtimehrs == "11")
                                echo "selected" ?>><?php echo __("11") ?></option>
                    <option value="12" <?php if ($fromtimehrs == "12")
                                echo "selected" ?>><?php echo __("12") ?></option>
                    <option value="13" <?php if ($fromtimehrs == "13")
                                echo "selected" ?>><?php echo __("13") ?></option>
                    <option value="14" <?php if ($fromtimehrs == "14")
                                echo "selected" ?>><?php echo __("14") ?></option>
                    <option value="15" <?php if ($fromtimehrs == "15")
                                echo "selected" ?>><?php echo __("15") ?></option>
                    <option value="16" <?php if ($fromtimehrs == "16")
                                echo "selected" ?>><?php echo __("16") ?></option>
                    <option value="17" <?php if ($fromtimehrs == "17")
                                echo "selected" ?>><?php echo __("17") ?></option>
                    <option value="18" <?php if ($fromtimehrs == "18")
                                echo "selected" ?>><?php echo __("18") ?></option>
                    <option value="19" <?php if ($fromtimehrs == "19")
                                echo "selected" ?>><?php echo __("19") ?></option>
                    <option value="20" <?php if ($fromtimehrs == "20")
                                echo "selected" ?>><?php echo __("20") ?></option>
                    <option value="21" <?php if ($fromtimehrs == "21")
                                echo "selected" ?>><?php echo __("21") ?></option>
                    <option value="22" <?php if ($fromtimehrs == "22")
                                echo "selected" ?>><?php echo __("22") ?></option>
                    <option value="23" <?php if ($fromtimehrs == "23")
                                echo "selected" ?>><?php echo __("23") ?></option>



                </select>



                <select name="cmbIncidentReportMM" id="cmbIncidentReportMM" class="formSelect" style="width: 50px;" tabindex="4">

                    <option value="-1" <?php if ($fromtimemins == "")
                                echo "selected" ?>><?php echo __("MM"); ?></option>
                    <option value="00" <?php if ($fromtimemins == "00")
                                echo "selected" ?>><?php echo __("00") ?></option>
                    <option value="05" <?php if ($fromtimemins == "05")
                                echo "selected" ?>><?php echo __("05") ?></option>
                    <option value="10" <?php if ($fromtimemins == "10")
                                echo "selected" ?>><?php echo __("10") ?></option>
                    <option value="15" <?php if ($fromtimemins == "15")
                                echo "selected" ?>><?php echo __("15") ?></option>
                    <option value="20" <?php if ($fromtimemins == "20")
                                echo "selected" ?>><?php echo __("20") ?></option>
                    <option value="25" <?php if ($fromtimemins == "25")
                                echo "selected" ?>><?php echo __("25") ?></option>
                    <option value="30" <?php if ($fromtimemins == "30")
                                echo "selected" ?>><?php echo __("30") ?></option>
                    <option value="35" <?php if ($fromtimemins == "35")
                                echo "selected" ?>><?php echo __("35") ?></option>
                    <option value="40" <?php if ($fromtimemins == "40")
                                echo "selected" ?>><?php echo __("40") ?></option>
                    <option value="45" <?php if ($fromtimemins == "45")
                                echo "selected" ?>><?php echo __("45") ?></option>
                    <option value="50" <?php if ($fromtimemins == "50")
                                echo "selected" ?>><?php echo __("50") ?></option>
                    <option value="55" <?php if ($fromtimemins == "55")
                                echo "selected" ?>><?php echo __("55") ?></option>


                </select>
            </div>
            <br class="clear"/>
            <div class="leftCol">
                <label class="controlLabel" for="txtLocationCode"><?php echo __("Incident From Date") ?> <span class="required">*</span></label>
            </div>
            <div class="centerCol">
                <input type="text" class="formInputText" name="txtIncidentDate" id="txtIncidentDate" value="<?php echo LocaleUtil::getInstance()->formatDate($currentIncident->dis_inc_date) ?>" />

            </div>
            <div class="leftCol">
                <label class="controlLabel" for="txtLocationCode"><?php echo __("Incident From Time") ?></label>
            </div>
            <?php
            $time = $currentIncident->dis_inc_time;
            $fromtimeexpand = explode(':', $time);
            $fromtimehrs = $fromtimeexpand[0];
            $fromtimemins = $fromtimeexpand[1];
            ?>
            <div class="centerCol">
                <select name="cmbHH" id="cmbHH" class="formSelect" style="width: 50px;" tabindex="4">

                    <option value="-1" <?php if ($fromtimehrs == "")
                echo "selected" ?>><?php echo __("HH"); ?></option>
                    <option value="00" <?php if ($fromtimehrs == "00")
                                echo "selected" ?>><?php echo __("00") ?></option>
                    <option value="01" <?php if ($fromtimehrs == "01")
                                echo "selected" ?>><?php echo __("01") ?></option>
                    <option value="02" <?php if ($fromtimehrs == "02")
                                echo "selected" ?>><?php echo __("02") ?></option>
                    <option value="03" <?php if ($fromtimehrs == "03")
                                echo "selected" ?>><?php echo __("03") ?></option>
                    <option value="04" <?php if ($fromtimehrs == "04")
                                echo "selected" ?>><?php echo __("04") ?></option>
                    <option value="05" <?php if ($fromtimehrs == "05")
                                echo "selected" ?>><?php echo __("05") ?></option>
                    <option value="06" <?php if ($fromtimehrs == "06")
                                echo "selected" ?>><?php echo __("06") ?></option>
                    <option value="07" <?php if ($fromtimehrs == "07")
                                echo "selected" ?>><?php echo __("07") ?></option>
                    <option value="08" <?php if ($fromtimehrs == "08")
                                echo "selected" ?>><?php echo __("08") ?></option>
                    <option value="09" <?php if ($fromtimehrs == "09")
                                echo "selected" ?>><?php echo __("09") ?></option>
                    <option value="10" <?php if ($fromtimehrs == "10")
                                echo "selected" ?>><?php echo __("10") ?></option>
                    <option value="11" <?php if ($fromtimehrs == "11")
                                echo "selected" ?>><?php echo __("11") ?></option>
                    <option value="12" <?php if ($fromtimehrs == "12")
                                echo "selected" ?>><?php echo __("12") ?></option>
                    <option value="13" <?php if ($fromtimehrs == "13")
                                echo "selected" ?>><?php echo __("13") ?></option>
                    <option value="14" <?php if ($fromtimehrs == "14")
                                echo "selected" ?>><?php echo __("14") ?></option>
                    <option value="15" <?php if ($fromtimehrs == "15")
                                echo "selected" ?>><?php echo __("15") ?></option>
                    <option value="16" <?php if ($fromtimehrs == "16")
                                echo "selected" ?>><?php echo __("16") ?></option>
                    <option value="17" <?php if ($fromtimehrs == "17")
                                echo "selected" ?>><?php echo __("17") ?></option>
                    <option value="18" <?php if ($fromtimehrs == "18")
                                echo "selected" ?>><?php echo __("18") ?></option>
                    <option value="19" <?php if ($fromtimehrs == "19")
                                echo "selected" ?>><?php echo __("19") ?></option>
                    <option value="20" <?php if ($fromtimehrs == "20")
                                echo "selected" ?>><?php echo __("20") ?></option>
                    <option value="21" <?php if ($fromtimehrs == "21")
                                echo "selected" ?>><?php echo __("21") ?></option>
                    <option value="22" <?php if ($fromtimehrs == "22")
                                echo "selected" ?>><?php echo __("22") ?></option>
                    <option value="23" <?php if ($fromtimehrs == "23")
                                echo "selected" ?>><?php echo __("23") ?></option>



                </select>



                <select name="cmbMM" id="timeto" class="formSelect" style="width: 50px;" tabindex="4">

                    <option value="-1" <?php if ($fromtimemins == "")
                                echo "selected" ?>><?php echo __("MM"); ?></option>
                    <option value="00" <?php if ($fromtimemins == "00")
                                echo "selected" ?>><?php echo __("00") ?></option>
                    <option value="05" <?php if ($fromtimemins == "05")
                                echo "selected" ?>><?php echo __("05") ?></option>
                    <option value="10" <?php if ($fromtimemins == "10")
                                echo "selected" ?>><?php echo __("10") ?></option>
                    <option value="15" <?php if ($fromtimemins == "15")
                                echo "selected" ?>><?php echo __("15") ?></option>
                    <option value="20" <?php if ($fromtimemins == "20")
                                echo "selected" ?>><?php echo __("20") ?></option>
                    <option value="25" <?php if ($fromtimemins == "25")
                                echo "selected" ?>><?php echo __("25") ?></option>
                    <option value="30" <?php if ($fromtimemins == "30")
                                echo "selected" ?>><?php echo __("30") ?></option>
                    <option value="35" <?php if ($fromtimemins == "35")
                                echo "selected" ?>><?php echo __("35") ?></option>
                    <option value="40" <?php if ($fromtimemins == "40")
                                echo "selected" ?>><?php echo __("40") ?></option>
                    <option value="45" <?php if ($fromtimemins == "45")
                                echo "selected" ?>><?php echo __("45") ?></option>
                    <option value="50" <?php if ($fromtimemins == "50")
                                echo "selected" ?>><?php echo __("50") ?></option>
                    <option value="55" <?php if ($fromtimemins == "55")
                                echo "selected" ?>><?php echo __("55") ?></option>


                </select>
            </div>
            <br class="clear"/>
            <div class="leftCol">
                <label class="controlLabel" for="txtLocationCode"><?php echo __("Incident To Date") ?> <span class="required">*</span></label>
            </div>
            <div class="centerCol">
                <input type="text" class="formInputText" name="txtIncidentToDate" id="txtIncidentToDate" value="<?php echo LocaleUtil::getInstance()->formatDate($currentIncident->dis_inc_todate) ?>" />

            </div>
            <div class="leftCol">
                <label class="controlLabel" for="txtLocationCode"><?php echo __("Incident To Time") ?></label>
            </div>
            <?php
            $time = $currentIncident->dis_inc_totime;
            $fromtimeexpand = explode(':', $time);
            $fromtimehrs = $fromtimeexpand[0];
            $fromtimemins = $fromtimeexpand[1];
            ?>
            <div class="centerCol">
                <select name="cmbIncidentToHH" id="cmbIncidentToHH" class="formSelect" style="width: 50px;" tabindex="4">

                    <option value="-1" <?php if ($fromtimehrs == "")
                echo "selected" ?>><?php echo __("HH"); ?></option>
                    <option value="00" <?php if ($fromtimehrs == "00")
                                echo "selected" ?>><?php echo __("00") ?></option>
                    <option value="01" <?php if ($fromtimehrs == "01")
                                echo "selected" ?>><?php echo __("01") ?></option>
                    <option value="02" <?php if ($fromtimehrs == "02")
                                echo "selected" ?>><?php echo __("02") ?></option>
                    <option value="03" <?php if ($fromtimehrs == "03")
                                echo "selected" ?>><?php echo __("03") ?></option>
                    <option value="04" <?php if ($fromtimehrs == "04")
                                echo "selected" ?>><?php echo __("04") ?></option>
                    <option value="05" <?php if ($fromtimehrs == "05")
                                echo "selected" ?>><?php echo __("05") ?></option>
                    <option value="06" <?php if ($fromtimehrs == "06")
                                echo "selected" ?>><?php echo __("06") ?></option>
                    <option value="07" <?php if ($fromtimehrs == "07")
                                echo "selected" ?>><?php echo __("07") ?></option>
                    <option value="08" <?php if ($fromtimehrs == "08")
                                echo "selected" ?>><?php echo __("08") ?></option>
                    <option value="09" <?php if ($fromtimehrs == "09")
                                echo "selected" ?>><?php echo __("09") ?></option>
                    <option value="10" <?php if ($fromtimehrs == "10")
                                echo "selected" ?>><?php echo __("10") ?></option>
                    <option value="11" <?php if ($fromtimehrs == "11")
                                echo "selected" ?>><?php echo __("11") ?></option>
                    <option value="12" <?php if ($fromtimehrs == "12")
                                echo "selected" ?>><?php echo __("12") ?></option>
                    <option value="13" <?php if ($fromtimehrs == "13")
                                echo "selected" ?>><?php echo __("13") ?></option>
                    <option value="14" <?php if ($fromtimehrs == "14")
                                echo "selected" ?>><?php echo __("14") ?></option>
                    <option value="15" <?php if ($fromtimehrs == "15")
                                echo "selected" ?>><?php echo __("15") ?></option>
                    <option value="16" <?php if ($fromtimehrs == "16")
                                echo "selected" ?>><?php echo __("16") ?></option>
                    <option value="17" <?php if ($fromtimehrs == "17")
                                echo "selected" ?>><?php echo __("17") ?></option>
                    <option value="18" <?php if ($fromtimehrs == "18")
                                echo "selected" ?>><?php echo __("18") ?></option>
                    <option value="19" <?php if ($fromtimehrs == "19")
                                echo "selected" ?>><?php echo __("19") ?></option>
                    <option value="20" <?php if ($fromtimehrs == "20")
                                echo "selected" ?>><?php echo __("20") ?></option>
                    <option value="21" <?php if ($fromtimehrs == "21")
                                echo "selected" ?>><?php echo __("21") ?></option>
                    <option value="22" <?php if ($fromtimehrs == "22")
                                echo "selected" ?>><?php echo __("22") ?></option>
                    <option value="23" <?php if ($fromtimehrs == "23")
                                echo "selected" ?>><?php echo __("23") ?></option>



                </select>



                <select name="cmbIncidentToMM" id="cmbIncidentToMM" class="formSelect" style="width: 50px;" tabindex="4">

                    <option value="-1" <?php if ($fromtimemins == "")
                                echo "selected" ?>><?php echo __("MM"); ?></option>
                    <option value="00" <?php if ($fromtimemins == "00")
                                echo "selected" ?>><?php echo __("00") ?></option>
                    <option value="05" <?php if ($fromtimemins == "05")
                                echo "selected" ?>><?php echo __("05") ?></option>
                    <option value="10" <?php if ($fromtimemins == "10")
                                echo "selected" ?>><?php echo __("10") ?></option>
                    <option value="15" <?php if ($fromtimemins == "15")
                                echo "selected" ?>><?php echo __("15") ?></option>
                    <option value="20" <?php if ($fromtimemins == "20")
                                echo "selected" ?>><?php echo __("20") ?></option>
                    <option value="25" <?php if ($fromtimemins == "25")
                                echo "selected" ?>><?php echo __("25") ?></option>
                    <option value="30" <?php if ($fromtimemins == "30")
                                echo "selected" ?>><?php echo __("30") ?></option>
                    <option value="35" <?php if ($fromtimemins == "35")
                                echo "selected" ?>><?php echo __("35") ?></option>
                    <option value="40" <?php if ($fromtimemins == "40")
                                echo "selected" ?>><?php echo __("40") ?></option>
                    <option value="45" <?php if ($fromtimemins == "45")
                                echo "selected" ?>><?php echo __("45") ?></option>
                    <option value="50" <?php if ($fromtimemins == "50")
                                echo "selected" ?>><?php echo __("50") ?></option>
                    <option value="55" <?php if ($fromtimemins == "55")
                                echo "selected" ?>><?php echo __("55") ?></option>


                </select>
            </div>

            <br class="clear"/>







            <div class="leftCol">
                <label class="controlLabel" for="txtLocationCode"><?php echo __("Incident Type") ?> <span class="required">*</span></label>
            </div>
            <div class="centerCol">
                <script language="javascript">

                    var scriptAr = new Array(); // initializing the javascript array
<?php
//In the below lines we get the values of the php array one by one and update it in the script array.


foreach ($selctedList as $key => $value) {
    print "scriptAr.push(\"$value\" );";  //This line updates the script array with new entry
}
?>

                </script>


                <select name="cmbActiontype" id="cmbActiontype" class="formSelect" style="width: 150px;" tabindex="4" onchange="LoadOffence(this.value,scriptAr);">
                    <option value=""><?php echo __("--Select--") ?></option>
                    <?php foreach ($actiontypes as $types) { ?>
                        <option value="<?php echo $types->dis_acttype_id ?>" <?php
                    if ($types->dis_acttype_id == $currentIncident->dis_acttype_id) {
                        echo "selected";
                    }
                        ?>><?php
                            if ($culture == 'en') {
                                $abc = "dis_acttype_name";
                            } else {
                                $abc = "dis_acttype_name_" . $culture;
                            } if ($types->$abc == "") {
                                echo $types->dis_acttype_name;
                            } else {
                                echo $types->$abc;
                            }
                        ?></option>
                    <?php } ?>

                </select>
            </div>
            <br class="clear"/>

            <div class="leftCol">
                <label class="controlLabel" for="txtLocationCode"><?php echo __("Incident Sub Type") ?> <span class="required">*</span></label>
            </div>

            <div class="centerCol" id="master" >
                <?php
                if (strlen($offenceList)) {

                    echo $sf_data->getRaw('offenceList');
                }
                ?>
            </div>
            <br class="clear"/>
            <br class="clear"/>

            <div class="leftCol">
                <label class="controlLabel" for="txtLocationCode"><?php echo __("Incident") ?> <span class="required">*</span></label>
            </div>
            <div class="centerCol">
                <textarea class="formTextArea" id="txtIncident"  name="txtIncident" rows="8" cols="25"><?php echo $currentIncident->dis_inc_incident ?></textarea>
            </div>
            <div class="centerCol">
                <textarea class="formTextArea" id="txtIncidentSi"  name="txtIncidentSi" rows="8" cols="25"><?php echo $currentIncident->dis_inc_incident_si ?></textarea>
            </div>
            <div class="centerCol">
                <textarea class="formTextArea" id="txtIncidentTa"  name="txtIncidentTa" rows="8" cols="25"><?php echo $currentIncident->dis_inc_incident_ta ?></textarea>
            </div>
            <br class="clear"/>
            <br class="clear"/>

            <div class="leftCol">
                <label class="controlLabel" for="txtLocationCode"><?php echo __("Employee Involved") ?> </label>
            </div>
            <div class="centerCol">

            </div>
            <div id="employeeGrid" class="centerCol" style="margin-left:10px; margin-top: 8px; width: 610px; border-style:  solid; border-color: #FAD163">
                <div style="background-color:#FAD163; vertical-align: top;">

                    <label class="languageBar" style="width:610px;padding-left:2px; margin-bottom: 0px; padding-top:2px;padding-bottom: 1px; background-color:#FAD163; margin-top: 0px;  color:#444444;">




                        <div style="width:150px; display:inline-block; vertical-align: top;"><b><?php echo __("Emp Name") ?></b></div>


                        <div style="width:100px; display:inline-block; vertical-align: top;"><b><?php echo __("Designation") ?></b></div>


                        <div style="width:110px; display:inline-block; vertical-align: top;"><b><?php echo __("Section") ?></b></div>


                        <div style="width:75px; display:inline-block; vertical-align: top;"><b><?php echo __("History") ?></b></div>

                        <div style="width:50px; display:inline-block; vertical-align: top;"><b><?php echo __("Major / Minor") ?></b></div>

                        <div style="width:95px; display:inline-block; vertical-align: top;"><b><?php echo __("Final Action") ?></b></div>
                    </label>


                </div>
                <br class="clear"/>
                <div id="master">
                    <?php
                    if (strlen($childDiv)) {

                        echo $sf_data->getRaw('childDiv');
                    }
                    ?>

                </div>
                <br class="clear"/>
            </div>
            <br class="clear"/>
            <div class="leftCol">
                <label class="controlLabel"  for="txtLocationCode"><?php echo __("") ?> </label>

            </div>


            <br class="clear"/>
            <div class="leftCol">
                <label class="controlLabel" for="txtLocationCode"><?php echo __("Investigation / Audit Feedback") ?> </label>
            </div>
            <div class="centerCol">
                <textarea class="formTextArea" id="txtInvestigationAuditFB"  name="txtInvestigationAuditFB" rows="6" cols="25" style="width:400px;"><?php echo $currentIncident->dis_inc_investigation_auditfb; ?></textarea>

            </div>


            <br class="clear"/>
            <br class="clear"/>
            <hr style="background-color:#FAD163; color: #FAD163; border-style: none; " >
            <div class="leftCol">
                <label class="controlLabel"  ><?php echo __("Incident Major/Minor") ?><span class="required">*</span> </label>

            </div>
            <div class="centerCol" style="width:150px;">
                <select name="optInvolveType" id="optInvolveType"  class="formSelect" style="width: 100px;">
                    <option value="0" <?php
                    if ($currentIncident->dis_inc_major_mionor_flg == null) {
                        echo "selected";
                    } if ($currentIncident->dis_inc_major_mionor_flg == "0")
                        echo "selected"
                        ?>><?php echo __("Minor Incident"); ?></option>
                    <option value="1" <?php if ($currentIncident->dis_inc_major_mionor_flg == "1")
                                echo "selected" ?>><?php echo __("Major Incident") ?></option>
                </select>        
            </div>
            <br class="clear"/>
            <div id="divminor">
                <div class="leftCol">
                    <label class="controlLabel"  ><?php echo __("") ?> </label>

                </div>
                <div class="centerCol" style="width:150px; margin-top: 10px;">

                    <input type="radio" name="optChargesheetExplanation" style="margin-top: 0px;" class="formCheckbox" value="0" <?php
                            if ($currentIncident->dis_inc_ifchargesheetissued_flg == "0") {
                                echo "checked";
                            }
                    ?> />&nbsp;<?php echo __("Charge Sheet") ?>
                </div>
                <div class="centerCol" style="width:150px; margin-top: 10px;">
                    <input type="radio" name="optChargesheetExplanation" style="margin-top: 0px;" class="formCheckbox" value="1" <?php
                           if ($currentIncident->dis_inc_ifchargesheetissued_flg == "1") {
                               echo "checked";
                           }
                    ?> />&nbsp;<?php echo __("Explanation") ?>
                </div>

                <br class="clear"/>
                <div id="divchargesheet">

                    <div class="leftCol">
                        <label class="controlLabel" for="txtLocationCode"><?php echo __("Charge Sheet") ?><span class="required">*</span></label>
                    </div>
                    <div class="centerCol">

                        <INPUT TYPE="file" class="formInputText" VALUE="Upload" name="upCasefile" id="upCasefile">
                        <INPUT TYPE="hidden" class="formInputText" VALUE="<?php echo $fileName ?>" name="fileName" id="fileName">
                    </div>
                    <div class="centerCol" style="padding-left:65px;">
                        <?php ?>
                        <?php
                        $encryptObj = new EncryptionHandler();
                        ?>
                        <?php if ($isChargeSheet > 0) { ?>
                            <label>
                                <a href="#" onclick="popupimage(link='<?php echo url_for('disciplinary/ImagePopup?id='); ?><?php echo $encryptObj->encrypt($chargeSheet[0]->getDis_attach_id()) ?>')"><?php
                        if (strlen($chargeSheet[0]->getDis_attach_name())
                        ) {
                            $view = 1;
                            echo __("View");
                        }
                            ?></a>

                                <a href="#" id="deletelink" onclick="return deletelink(<?php echo $chargeSheet[0]->getDis_inc_id() ?>,'c')" >  <?php echo __("Delete"); ?> </a>
                            <?php } ?>
                        </label>
                        <?php // }      ?>
                    </div>

                    <br class="clear"/>
                    <div class="leftCol">
                        <label class="controlLabel" for="txtLocationCode"><?php echo __("Summary") ?> </label>
                    </div>
                    <div class="centerCol">
                        <textarea class="formTextArea"  name="txtPrimSummary" id="txtPrimSummary" rows="6" cols="25" style="width:400px;"><?php echo $currentIncident->dis_inc_chargesheet_comment; ?></textarea>



                    </div>
                    <br class="clear"/>




                    <div class="leftCol">
                        <label class="controlLabel"  for="txtLocationCode"><?php echo __("Case Closed") ?><span class="required">*</span></label>

                    </div>

                    <div class="centerCol">

                        <?php if ($currentIncident->dis_inc_isclosed == 0) { ?>
                            <input type="checkbox" name="chkcaseclose" id="chkcaseclose" class="formCheckbox" value="1"/>
                        <?php } else { ?>
                            <input type="checkbox" name="chkcaseclose" id="chkcaseclose" class="formCheckbox" value="1" <?php echo 'checked'; ?>/>
                            <?php
                        }
                        ?>
                    </div>
                    <br class="clear"/>


                    <div id="divcaseclose">

                        <div class="leftCol">
                            <label class="controlLabel" for="txtLocationCode"><?php echo __("Comment") ?> </label>
                        </div>
                        <div class="centerCol">
                            <textarea class="formTextArea" id="txtAcomment"  name="txtAcomment" rows="6" cols="25" style="width:400px;" ><?php echo $currentIncident->dis_inc_caseclosed_comment; ?> </textarea>
                        </div>
                    </div>

                </div>
                <div id="divexplanation">

                    <div class="leftCol">
                        <label class="controlLabel" for="txtLocationCode"><?php echo __("Summary") ?> </label>
                    </div>
                    <div class="centerCol">
                        <textarea class="formTextArea"  name="txtPrimSummary1" id="txtPrimSummary1" rows="6" cols="25" style="width:400px;"><?php echo $currentIncident->dis_inc_chargesheet_comment; ?></textarea>
                    </div>
                    <br class="clear"/>
                    <div class="leftCol">
                        <label class="controlLabel"  for="txtLocationCode"><?php echo __("Case Closed") ?><span class="required">*</span></label>

                    </div>
                    <div class="centerCol">

                        <?php if ($currentIncident->dis_inc_isclosed == 0) { ?>
                            <input type="checkbox" name="chkcaseclose_1" id="chkcaseclose_1" class="formCheckbox" value="1"/>
                        <?php } else { ?>
                            <input type="checkbox" name="chkcaseclose_1" id="chkcaseclose_1" class="formCheckbox" value="1" <?php echo 'checked'; ?>/>
                            <?php
                        }
                        ?>
                    </div>
                    <br class="clear"/>


                    <div id="divcaseclose_1">

                        <div class="leftCol">
                            <label class="controlLabel" for="txtLocationCode"><?php echo __("Comment") ?> </label>
                        </div>
                        <div class="centerCol">
                            <textarea class="formTextArea" id="txtAcomment1"  name="txtAcomment1" rows="6" cols="25" style="width:400px;" ><?php echo $currentIncident->dis_inc_caseclosed_comment; ?> </textarea>
                        </div>
                    </div>
                    <br class="clear"/>
                </div>
            </div>



            <div id="divmajor">
                <div class="leftCol">
                    <label class="controlLabel"  ><?php echo __("") ?> </label>

                </div>
                <div class="centerCol" style="width:175px; margin-top: 10px;">
                    <input type="radio" name="optactionType" style="margin-top: 0px;" class="formCheckbox" value="0" <?php if ($currentIncident->dis_inc_furtheraction_flg == "1")
                            echo "checked" ?> />&nbsp;<?php echo __("Further Actions Required") ?>
                </div>
                <div class="centerCol" style="width:150px; margin-top: 10px;">
                    <input type="radio" name="optactionType" style="margin-top: 0px;" class="formCheckbox" value="1" <?php if ($currentIncident->dis_inc_intedicted_flg == "1")
                               echo "checked" ?> />&nbsp;<?php echo __("If Interdicted") ?>
                </div>

                <br class="clear"/>
                <div class="leftCol">
                    <label class="controlLabel" for="txtLocationCode"><?php echo __("Comments") ?> </label>
                </div>
                <div class="centerCol">
                    <textarea class="formTextArea"  name="txtFutherInterdictedComment" id="txtFutherInterdictedComment" rows="6" cols="25" style="width:400px;"><?php echo $currentIncident->dis_inc_intedicted_comment; ?></textarea>



                </div>


            </div>

            <br class="clear"/>

            <div class="formbuttons">
                <input type="button" class="<?php echo $editMode ? 'editbutton' : 'savebutton'; ?>" name="EditMain" id="editBtn"
                       value="<?php echo $editMode ? __("Edit") : __("Save"); ?>"
                       title="<?php echo $editMode ? __("Edit") : __("Save"); ?>"
                       onmouseover="moverButton(this);" onmouseout="moutButton(this);"/>
                <input type="reset" class="clearbutton" id="btnClear" tabindex="5"
                       onmouseover="moverButton(this);" onmouseout="moutButton(this);"	<?php echo $disabled; ?>
                       value="<?php echo __("Reset"); ?>" />
                <input type="button" class="backbutton" id="btnBack"
                       value="<?php echo __("Back") ?>" tabindex="10" />
            </div>
        </form>
    </div>

</div>
<div class="requirednotice"><?php echo __("Fields marked with an asterisk") ?><span class="required"> * </span> <?php echo __("are required") ?></div>
<?php
require_once '../../lib/common/LocaleUtil.php';
$sysConf = OrangeConfig::getInstance()->getSysConf();
$sysConf = new sysConf();
$inputDate = $sysConf->dateInputHint;
$format = LocaleUtil::convertToXpDateFormat($sysConf->getDateFormat());
?>

<script type="text/javascript">
    function templateview() {

        if ($("#optInvolveType").val()==0) {
            $('#divminor').show();
            $('#divmajor').hide();

        }
        else{
            $('#divmajor').show();
            $('#divminor').hide();
        }

                                                      
        if ($('input[name=optChargesheetExplanation]:checked').val()==0) {
            $('#divchargesheet').show();
            $('#divexplanation').hide();
            $('#txtPrimSummary').show();
        }
        else{
            $('#divexplanation').show();
            $('#divchargesheet').hide();
            $('#txtPrimSummary').show();
        }

                                                   
        if ($('#chkcaseclose').attr("checked")) {
            $('#divcaseclose').show();
        }else{
            $('#divcaseclose').hide();
        }

        if ($('#chkcaseclose').attr("checked")) {
            $('#divcaseclose_1').show();
        }else{
            $('#divcaseclose_1').hide();
        }
                                                       
    }
    var courseId="";
    var empIDMaster
    var myArray2= new Array();
    var i;

    function selectReportBy(data){
                                            
        myArr=new Array();
        lol=new Array();
        myArr = data.split('|');

        $("#txtReportedEmpId").val(myArr[0]);
        $("#txtEmpname").val(myArr[1]);
    }
    function SelectEmployee(data){

        myArr=new Array();
        lol=new Array();
        myArr = data.split('|');


        addtoGrid(myArr);
    }


    function addtoGrid(empid){
                                          

        var arraycp=new Array();

        var arraycp = $.merge([], myArray2);

        var items= new Array();
        for(i=0;i<empid.length;i++){

            items[i]=empid[i];
        }

        var u=1;
                                            
        $.each(items,function(key, value){
                                                

            if(jQuery.inArray(value, arraycp)!=-1)
            {

                // ie of array index find bug sloved here//
                if(!Array.indexOf){
                    Array.prototype.indexOf = function(obj){
                        for(var i=0; i<this.length; i++){
                            if(this[i]==obj){
                                return i;
                            }
                        }
                        return -1;
                    }
                }

                var idx = arraycp.indexOf(value);
                                                    
                if(idx!=-1) arraycp.splice(idx, 1); // Remove it if really found!
                //alert("user already there");

                u=0;
                                                   
            }
            else{

                arraycp.push(value);

                                                    


            }


        }


    );

        $.each(myArray2,function(key, value){
                                                

            if(jQuery.inArray(value, arraycp)!=-1)
            {

                // ie of array index find bug sloved here//
                if(!Array.indexOf){
                    Array.prototype.indexOf = function(obj){
                        for(var i=0; i<this.length; i++){
                            if(this[i]==obj){
                                return i;
                            }
                        }
                        return -1;
                    }
                }

                var idx = arraycp.indexOf(value); // Find the index
                if(idx!=-1) arraycp.splice(idx, 1); // Remove it if really found!
                                                    
                u=0;
                                                    

            }
            else{

                                                   




            }


        }


    );
        $.each(arraycp,function(key, value){
            myArray2.push(value);
        }


    );
                                           
        if(u==0){
                                                
        }
        var courseId1=$('#courseid').val();
        $.post(

        "<?php echo url_for('disciplinary/LoadGrid') ?>", //Ajax file



        { 'empid[]' : arraycp },  // create an object will all values

        //function that is c    alled when server returns a value.
        function(data){
                                                
            var childDiv="";
            var testDiv="";
            var participated="";
            var testDiv="";
            var approved="";
            var comment="";
            var delete1="";
            var rowstart="";
            var rowend="";
            var childdiv="";

            i="<?php echo $i + 1; ?>";
            $.each(data, function(key, value) {
                //i=Number($('#hiddeni').val())+1;


                var word=value.split("|");



                childdiv="<div id='row_"+i+"' style='padding-top:0px;'>";
                childdiv+="<div class='centerCol' id='master' style='width:150px;'>";
                childdiv+="<div id='child' style='height:35px; padding-left:3px; padding-bottom:3px;'>"+word[1]+"</div>";
                childdiv+="</div>";

                childdiv+="<div class='centerCol' id='master' style='width:100px;'>";
                childdiv+="<div id='child' style='height:35px; padding-left:3px; padding-bottom:3px;'>"+word[2]+"</div>";
                childdiv+="</div>";

                childdiv+="<div class='centerCol' id='master' style='width:110px;'>";
                childdiv+="<div id='child' style='height:35px; padding-left:3px; padding-bottom:3px;'>"+word[3]+"</div>";
                childdiv+="<div id='employeename' style=' padding-bottom:5px;'><input type='hidden' name='hiddenEmpNumber[]' value="+word[4]+" ></div>";
                childdiv+="</div>";

                childdiv+="<div class='centerCol' id='master' style='width:75px;'>";
                childdiv+="<div id='child' style='height:35px; padding-left:3px; padding-bottom:3px;'>history</div>";
                childdiv+="</div>";
                                                    
                childdiv+="<div class='centerCol' id='master' style='width:90px;'>";
                childdiv+="<div id='child' style='height:35px; padding-left:3px; padding-bottom:3px;'><a href='#' style='width:50px;' onclick='deleteCRow("+i+","+word[4]+")'><?php echo __('Remove') ?></a></div>";
                childdiv+="</div>";

                childdiv+="<div class='centerCol' id='master' style='width:95px;'>";
                childdiv+="<div id='child' style='height:35px; padding-left:3px; padding-bottom:3px;'></div>";
                childdiv+="</div>";
                childdiv+="</div>";

                i++;
                //
                $('#employeeGrid').append(childdiv);
                //
                $('#hiddeni').val(i);

            });

            //$("#datehiddne1").val(data.message);
        },

        //How you want the data formated when it is returned from the server.
        "json"

    );


    }
    function deleteCRow(id,value){

        answer = confirm("<?php echo __("Do you really want to Delete?") ?>");

        if (answer !=0)
        {

            $("#row_"+id).remove();
            removeByValue(myArray2, value);

            i--;

        }
        else{
            return false;
        }

    }
    function removeByValue(arr, val) {
        for(var i=0; i<arr.length; i++) {
            if(arr[i] == val) {

                arr.splice(i, 1);

                break;

            }
        }
    }
    function deleteSavedRow(id,value,insiId){


        answer = confirm("<?php echo __("Do you really want to Delete?") ?>");

        if (answer !=0)
        {

            $.post(

            "<?php echo url_for('disciplinary/deleteSavedRow') ?>", //Ajax file

            { value : value ,insiId : insiId  },  // create an object will all values

            //function that is called when server returns a value.
            function(data){
                if(data){
                    $("#row_"+id).remove();
                    removeByValue(myArray2, value);

                    i--;
                }
            },
            "json"

        );



        }
        else{
            return false;
        }



    }

    function deletelink(){
        var disable='<?php echo $disabled; ?>';
        if(disable==''){
            answer = confirm("<?php echo __("Do you really want to Delete?") ?>");

            if (answer !=0)
            {
                location.href = "<?php echo url_for('disciplinary/Deleteimage?id=') . $inc_id ?>?type=c";
                                               
            }
            else{
                return false;
            }
        }

    }

    function popupimage(link){
        window.open(link, "myWindow",
        "status = 1, height = 300, width = 300, resizable = 0" )
    }

    function LoadOffence(id,offList){


        var atype=$('#cmbActiontype').val();


        if(atype!=""){
            $.post(

            "<?php echo url_for('disciplinary/Loadoffence') ?>", //Ajax file

            { atype : atype, offList : offList },  // create an object will all values

            //function that is called when server returns a value.
            function(data){

                $('#master').html(data.List);




            },
            "json"

        );
        }
    }
    $(document).ready(function() {
        buttonSecurityCommon(null,null,"editBtn",null);
        var scriptAr = new Array(); // initializing the javascript array
<?php
//In the below lines we get the values of the php array one by one and update it in the script array.


foreach ($selctedList as $key => $value) {
    print "scriptAr.push(\"$value\");";  //This line updates the script array with new entry
}
?>
        LoadOffence("<?php echo $currentIncident->dis_acttype_id ?>",scriptAr);

                                                       
        $('#divminor').hide();
        $('#divmajor').hide();
        $('#divchargesheet').hide();
        $('#divexplanation').hide();
        $('#divcaseclose').hide();
        //        $('#divcaseclose1').hide();
        templateview();

        $("#optInvolveType").change(function(){
            if ($(this).val()==0) {
                $('#divminor').show();
                $('#divmajor').hide();
                $("input[name='optChargesheetExplanation']").attr('checked',false);
                $("input[name='optactionType']").attr('checked',false);
                $("#txtPrimSummary").val("");
                $("#txtAcomment").val("");
                $("#chkcaseclose").attr('checked',false);
                $("#txtFutherInterdictedComment").val("");
            }
            else{
                $('#divmajor').show();
                $('#divminor').hide();
                $("input[name='optChargesheetExplanation']").attr('checked',false);
                $("input[name='optactionType']").attr('checked',false);
                $("#txtPrimSummary").val("");
                $("#txtAcomment").val("");
                $("#chkcaseclose").attr('checked',false);
                $("#txtFutherInterdictedComment").val("");
            }

        });
        $("input[name='optChargesheetExplanation']").change(function(){
            if ($(this).val()==0) {
                $('#divchargesheet').show();
                $('#divexplanation').hide();
                $('#txtPrimSummary').val("");
            }
            else{
                $('#divexplanation').show();
                $('#divchargesheet').hide();
                $('#txtPrimSummary1').val("");
                $('#txtPrimSummary').val("");
                $("#txtAcomment1").val("");
                $("#txtAcomment").val("");
                $("#chkcaseclose").attr('checked',false);
            }

        });
        $("input[name='chkcaseclose']").change(function(){
            if ($(this).attr("checked")) {
                $('#divcaseclose').show();
                $("#txtAcomment").val("")
            }else{
                $('#divcaseclose').hide();
                $("#txtAcomment").val("")
            }
        });

        $("input[name='chkcaseclose_1']").change(function(){
            if ($(this).attr("checked")) {
                $('#divcaseclose_1').show();
                $("#txtAcomment1").val("")
            }else{
                $('#divcaseclose_1').hide();
                $("#txtAcomment1").val("")
            }
        });

        $("input[name='optactionType']").change(function(){
            if ($(this).attr("checked")) {
                $('#txtFutherInterdictedComment').val("");
            }
        });

        $('#btnAddEmployee').click(function() {

            var popup=window.open('<?php echo public_path('../../symfony/web/index.php/pim/searchEmployee?type=multiple&method=SelectEmployee'); ?>','Locations','height=450,width=800,resizable=1,scrollbars=1');


            if(!popup.opener) popup.opener=self;
            popup.focus();
        });


        var incidentId="<?php echo $inc_id ?>";


        if(incidentId!=""){
            $.post(

            "<?php echo url_for('disciplinary/GetListedEmpids') ?>", //Ajax file

            { incidentId : incidentId },  // create an object will all values

            //function that is called when server returns a value.
            function(data){

                $.each(data, function(key, value) {
                    myArray2.push(value);

                });

            },

            //How you want the data formated when it is returned from the server.
            "json"

        );

        }


        $("#txtIncidentDate").datepicker({ dateFormat: '<?php echo $inputDate ?>' });
        $("#dateProDate").datepicker({ dateFormat: '<?php echo $inputDate ?>' });





        $('#empRepPopBtn').click(function() {
            var popup=window.open('<?php echo public_path('../../symfony/web/index.php/pim/searchEmployee?type=single&method=selectReportBy'); ?>','Locations','height=450,width=800,resizable=1,scrollbars=1');

            
            if(!popup.opener) popup.opener=self;
            popup.focus();
        });



        jQuery.validator.addMethod("orange_date",
        function(value, element, params) {

                                              
            var format = params[0];

            // date is not required
            if (value == '') {

                return true;
            }
            var d = strToDate(value, "<?php echo $format ?>");


            return (d != false);

        }, ""
    );
        $("#frmSave").validate({


            rules: {
                txtIncidentReportDate: {required: true,orange_date: function(){ return ['<?php echo $dateHint; ?>','<?php echo $format; ?>']}},
                txtIncidentDate: {required: true,orange_date: function(){ return ['<?php echo $dateHint; ?>','<?php echo $format; ?>']}},
                txtIncidentToDate: {required: true,orange_date: function(){ return ['<?php echo $dateHint; ?>','<?php echo $format; ?>']}},
                cmbActiontype: {required: true},
                txtIncident: { required: true,maxlength: 200,noSpecialCharsOnly: true},
                txtIncidentSi: { maxlength: 200,noSpecialCharsOnly: true},
                txtIncidentTa: { maxlength: 200,noSpecialCharsOnly: true},
                txtFinActTknDate:{required: true,orange_date: true},
                txtInqueryOfficer: {required: true,maxlength: 100,noSpecialCharsOnly: true},
                txtProsecOfficer: {required: true,maxlength: 100,noSpecialCharsOnly: true},
                txtDefOfficer: {required: true,maxlength: 100,noSpecialCharsOnly: true},
                txtFinalActionTknby: {required: true,maxlength: 100,noSpecialCharsOnly: true},
                txtAcomment: {maxlength: 200,noSpecialCharsOnly: true},
                txtPrimSummary: {maxlength: 200,noSpecialCharsOnly: true},
                txtInvestigationAuditFB: {maxlength: 200,noSpecialCharsOnly: true},
                txtPrimSummary1: {maxlength: 200,noSpecialCharsOnly: true},
                txtFutherInterdictedComment: {maxlength: 200,noSpecialCharsOnly: true},
                txtAcomment:{maxlength: 200,noSpecialCharsOnly: true},
                optInvolveType: {required: true}

            },
            messages: {
                txtIncidentReportDate: {required: "<?php echo __('This field is required') ?>",orange_date: '<?php echo __("Invalid date."); ?>'},
                txtIncidentDate: {required: "<?php echo __('This field is required') ?>",orange_date: '<?php echo __("Invalid date."); ?>'},
                txtIncidentToDate: {required: "<?php echo __('This field is required') ?>",orange_date: '<?php echo __("Invalid date."); ?>'},
                cmbActiontype: {required: "<?php echo __('This field is required') ?>"},
                txtIncident: {required: "<?php echo __('This field is required') ?>",maxlength: "<?php echo __('Maximum length should be 200 characters') ?>",noSpecialCharsOnly: "<?php echo __('No invalid characters are allowed') ?>"},
                txtIncidentSi: {maxlength: "<?php echo __('Maximum length should be 200 characters') ?>",noSpecialCharsOnly: "<?php echo __('No invalid characters are allowed') ?>"},
                txtIncidentTa: {maxlength: "<?php echo __('Maximum length should be 200 characters') ?>",noSpecialCharsOnly: "<?php echo __('No invalid characters are allowed') ?>"},                                                   
                txtFinActTknDate: {required: "<?php echo __('This field is required') ?>",orange_date: "<?php echo __("Please specify valid  date"); ?>"},
                txtInqueryOfficer: {required: "<?php echo __('This field is required') ?>",maxlength: "<?php echo __('Maximum length should be 100 characters') ?>",noSpecialCharsOnly: "<?php echo __('No invalid characters are allowed') ?>"},
                txtProsecOfficer: {required: "<?php echo __('This field is required') ?>",maxlength: "<?php echo __('Maximum length should be 100 characters') ?>",noSpecialCharsOnly: "<?php echo __('No invalid characters are allowed') ?>"},
                txtDefOfficer: {required: "<?php echo __('This field is required') ?>",maxlength: "<?php echo __('Maximum length should be 100 characters') ?>",noSpecialCharsOnly: "<?php echo __('No invalid characters are allowed') ?>"},
                txtFinalActionTknby: {required: "<?php echo __('This field is required') ?>",maxlength: "<?php echo __('Maximum length should be 100 characters') ?>",noSpecialCharsOnly: "<?php echo __('No invalid characters are allowed') ?>"},
                txtAcomment: {maxlength: "<?php echo __('Maximum length should be 200 characters') ?>",noSpecialCharsOnly: "<?php echo __('No invalid characters are allowed') ?>"},
                txtPrimSummary: {maxlength: "<?php echo __('Maximum length should be 200 characters') ?>",noSpecialCharsOnly: "<?php echo __('No invalid characters are allowed') ?>"},
                txtInvestigationAuditFB: {maxlength: "<?php echo __('Maximum length should be 200 characters') ?>",noSpecialCharsOnly: "<?php echo __('No invalid characters are allowed') ?>"},
                txtPrimSummary1: {maxlength: "<?php echo __('Maximum length should be 200 characters') ?>",noSpecialCharsOnly: "<?php echo __('No invalid characters are allowed') ?>"},
                txtFutherInterdictedComment: {maxlength: "<?php echo __('Maximum length should be 200 characters') ?>",noSpecialCharsOnly: "<?php echo __('No invalid characters are allowed') ?>"},
                txtAcomment: {maxlength: "<?php echo __('Maximum length should be 200 characters') ?>",noSpecialCharsOnly: "<?php echo __('No invalid characters are allowed') ?>"},
                optInvolveType:{required: "<?php echo __('This field is required') ?>"}

            },
            submitHandler: function(form) {
                $('#editBtn').unbind('click').click(function() {return false}).val("<?php echo __('Wait..'); ?>");
                form.submit();
            }
        });
                                        
<?php if ($editMode == true) { ?>
            $('#frmSave :input').attr('disabled', true);
            $('#editBtn').removeAttr('disabled');
            $('#btnBack').removeAttr('disabled');
<?php } ?>

        // When click edit button
        $("#frmSave").data('edit', <?php echo $editMode ? '1' : '0' ?>);

        $("#editBtn").click(function() {

                                                
            var editMode = $("#frmSave").data('edit');
                                                
            if (editMode == 1) {
                                                                                         
                                                
                location.href="<?php echo url_for('disciplinary/UpdateInsident?id=' . $encrypt->encrypt($currentIncident->dis_inc_id) . '&lock=' . $encrypt->encrypt(1)) ?>";
            }
            else {
                var n = $("input[name='checkList[]']:checked").length;                                                       
                if(n>0){
                    if($("input[name='optChargesheetExplanation']")[0].checked == true)
                    {
                        var pic="<?php echo $chargeSheet[0]->getDis_inc_id(); ?>"
                        var view="<?php echo $view ?>";
                        if(($("#upCasefile").val() == '') && (pic == '') &&(view == '' ) ){
                            alert("<?php echo __("Charge Sheet cannot be blank.") ?>");
                            return false;
                        } 
                        if($('#chkcaseclose').attr("checked")==false){
                            alert("<?php echo __("Please Checked Case Close.") ?>");
                            return false;
                        }
                    }else if($("input[name='optChargesheetExplanation']")[1].checked == true){
                     if($('#chkcaseclose_1').attr("checked")==false){
                            alert("<?php echo __("Please Checked Case Close.") ?>");
                            return false;
                        }
                    }
                    
                      var error=0;  
                      $("select.cmbmajmin").each(function(){
                                                   if((this).value==""){
                                                      alert('<?php echo __("Major/Minor field is required.") ?>'); 
                                                      error=1;  
                                               }                                                       

                                                });
                     $("select.selectfa").each(function(){
                                                   if((this).value==""){
                                                      alert('<?php echo __("Final Action field is required.") ?>'); 
                                                      error=1;
                                                } 

                                                });                           
                    if(error==1){
                      return false;
                    }else{
                    
                    $('#frmSave').submit();
                    }                                                                                          
                }
                else{
                    alert("<?php echo __("Incident type and Incident sub type should be selected.") ?>");
                                                
                }
                                                
            }


        });
        //When click reset buton
        $("#resetBtn").click(function() {
            document.forms[0].reset('');
        });
        //When click reset buton
        $("#btnClear").click(function() {
            location.href="<?php echo url_for('disciplinary/UpdateInsident?id=' . $encrypt->encrypt($currentIncident->dis_inc_id) . '&lock=' . $encrypt->encrypt(0)) ?>";
        });

        //When Click back button
        $("#btnBack").click(function() {
            location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/disciplinary/IncidentSummary')) ?>";
        });

       

    });
    function getCFA(cid,name){ 
        var instiname=$('#instName').val();

        $.post(

        "<?php echo url_for('disciplinary/AjaxloadFinalActions') ?>", //Ajax file

        { cid: cid },  // create an object will all values

        //function that is called when server returns a value.
        function(data){



            var selectbox="<select class='selectfa' name='cmbFinalAction[]' id='cmbFinalAction[]' class='formSelect' style='width: 95px; margin-top:0px;' >";
            selectbox=selectbox +"<option value=''><?php echo __('--Select--') ?></option>";

            $.each(data, function(key, value) {

                selectbox=selectbox +"<option value="+key+">"+value+"</option>";
            });
            selectbox=selectbox +"</select>";


            $('#CFA_'+name).html(selectbox);



        },

        //How you want the data formated when it is returned from the server.
        "json"

    );
    }
    function disHistoryPopup(empId){
        var encryptemp;
        $.ajax({
            type: "POST",
            async:false,
            url: "<?php echo url_for('disciplinary/AjaxEncryption') ?>",
            data: { empId: empId },
            dataType: "json",
            success: function(data){encryptemp = data;}
        });
    
    
        window.open( "<?php echo url_for('disciplinary/empDisHistory?empId=') ?>"+encryptemp, "myWindow", "status = 1, height = 300, width = 825, resizable = 0" );
    }
</script>

