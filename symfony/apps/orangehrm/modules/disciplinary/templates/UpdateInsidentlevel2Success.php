<?php
if ($lockMode == '1') {
    $editMode = false;
    $disabled = '';
} else {
    $editMode = true;
    $disabled = 'disabled="disabled"';
}
$encrypt = new EncryptionHandler();
?><?php $disabled1 = 'disabled'; ?>
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
        <div class="mainHeading"><h2><?php echo __("Inquiry Summary") ?></h2></div>

        <?php echo message() ?>
        <form enctype="multipart/form-data" name="frmSave" id="frmSave" method="post"  action="">

            <div class="leftCol">
                <label class="controlLabel" for="txtLocationCode"><?php echo __("Reported Date") ?> <span class="required">*</span></label>
            </div>
            <div class="centerCol">
                <input type="text" class="formInputText" name="txtIncidentReportDate" id="txtIncidentReportDate" value="<?php echo LocaleUtil::getInstance()->formatDate($currentIncident->dis_inc_reporteddate) ?>" <?php echo $disabled1; ?> />

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
                <select name="cmbIncidentReportHH" id="cmbIncidentReportHH" class="formSelect" style="width: 50px;" tabindex="4" <?php echo $disabled1; ?>>

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



                <select name="cmbIncidentReportMM" id="cmbIncidentReportMM" class="formSelect" style="width: 50px;" tabindex="4" <?php echo $disabled1; ?>>

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
                <input type="text" class="formInputText" name="txtIncidentDate" id="txtIncidentDate" value="<?php echo LocaleUtil::getInstance()->formatDate($currentIncident->dis_inc_date) ?>" <?php echo $disabled1; ?> />

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
                <select name="cmbHH" id="cmbHH" class="formSelect" style="width: 50px;" tabindex="4" <?php echo $disabled1; ?>>

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



                <select name="cmbMM" id="timeto" class="formSelect" style="width: 50px;" tabindex="4" <?php echo $disabled1; ?>>

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
                <input type="text" class="formInputText" name="txtIncidentToDate" id="txtIncidentToDate" value="<?php echo LocaleUtil::getInstance()->formatDate($currentIncident->dis_inc_todate) ?>" <?php echo $disabled1; ?> />

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
                <select name="cmbIncidentToHH" id="cmbIncidentToHH" class="formSelect" style="width: 50px;" tabindex="4" <?php echo $disabled1; ?>>

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



                <select name="cmbIncidentToMM" id="cmbIncidentToMM" class="formSelect" style="width: 50px;" tabindex="4" <?php echo $disabled1; ?>>

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
    print "scriptAr.push(\"$value\");";  //This line updates the script array with new entry
}
?>

                </script>


                <select name="cmbActiontype" id="cmbActiontype" class="formSelect" style="width: 150px;" tabindex="4" onchange="LoadOffence(this.value,scriptAr);" <?php echo $disabled1; ?>>

                    <option value=""><?php echo __("--Select--") ?></option>
                    <?php foreach ($actiontypes as $types) { ?>
                        <option value="<?php echo $types->dis_acttype_id ?>" <?php if ($types->dis_acttype_id == $currentIncident->dis_acttype_id)
                        echo "selected" ?> <?php echo $disabled1; ?> ><?php
                            if ($culture == 'en') {
                                $abc = "dis_acttype_name";
                            } else {
                                $abc = "dis_acttype_name_" . $culture;
                            } if ($types->$abc == "")
                                echo $types->dis_acttype_name; else
                                echo $types->$abc;
                        ?></option>
                    <?php } ?>

                </select>
            </div>
            <br class="clear"/>

            <div class="leftCol">
                <label class="controlLabel" for="txtLocationCode"><?php echo __("Incident Sub Type") ?> <span class="required">*</span></label>
            </div>

            <div class="centerCol" id="master"  >
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
                <textarea class="formTextArea" id="txtIncident"  name="txtIncident" rows="8" cols="25" <?php echo $disabled1; ?> ><?php echo $currentIncident->dis_inc_incident ?></textarea>
            </div>
            <div class="centerCol">
                <textarea class="formTextArea" id="txtIncidentSi"  name="txtIncidentSi" rows="8" cols="25" <?php echo $disabled1; ?> ><?php echo $currentIncident->dis_inc_incident_si ?></textarea>
            </div>
            <div class="centerCol">
                <textarea class="formTextArea" id="txtIncidentTa"  name="txtIncidentTa" rows="8" cols="25" <?php echo $disabled1; ?> ><?php echo $currentIncident->dis_inc_incident_ta ?></textarea>
            </div>
            <br class="clear"/>
            <br class="clear"/>
            <hr style="background-color:#FAD163; color: #FAD163; border-style: none; " >
            <br class="clear"/>
            <div class="leftCol">
                <label class="controlLabel" for="txtLocationCode"><?php echo __("Employee Involved") ?> </label>
            </div>

            <div class="centerCol">

            </div>
            <br/>
            <div class="leftCol">
                <label class="controlLabel" for="txtLocationCode"><?php echo __("") ?> </label>
            </div>
            <div id="employeeGrid" class="leftCol" style="margin-left:10px; margin-top: 8px; width: 750px; border-style:  solid; border-color: #FAD163">
                <div style="background-color:#FAD163; vertical-align: top;">

                    <label class="languageBar" style="width:750px;padding-left:2px; margin-bottom: 0px; padding-top:2px;padding-bottom: 1px; background-color:#FAD163; margin-top: 0px;  color:#444444;">


                        <div style="width:175px; display:inline-block; vertical-align: top;"><b><?php echo __("Emp Name") ?></b></div>


                        <div style="width:130px; display:inline-block; vertical-align: top;"><b><?php echo __("Designation") ?></b></div>


                        <div style="width:110px; display:inline-block; vertical-align: top;"><b><?php echo __("section") ?></b></div>


                        <div style="width:65px; display:inline-block; vertical-align: top;"><b><?php echo __("History Information") ?></b></div>

                        <div style="width:65px; display:inline-block; vertical-align: top;"><b><?php echo __("Type") ?></b></div>
                        <div style="width:75px; display:inline-block; vertical-align: top;"><b><?php echo __("Final Action") ?></b></div>
                        <div style="width:20px; display:inline-block; vertical-align: top;"></div>
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
                <textarea class="formTextArea" id="txtInvestigationAuditFB"  name="txtInvestigationAuditFB" rows="6" cols="25" style="width:400px;" <?php echo $disabled1; ?> ><?php echo $currentIncident->dis_inc_investigation_auditfb; ?></textarea>

            </div>
            <br class="clear"/>



            <hr style="background-color:#FAD163; color: #FAD163; border-style: none; " >
            <br class="clear"/>
            <div class="leftCol">
                <label class="controlLabel" for="txtLocationCode"><?php echo __("Inquiry Officer name") ?><span class="required">*</span> </label>
            </div>
            <div class="centerCol">
                <input type="text" class="formInputText" name="txtInqueryOfficer" id="txtInqueryOfficer" value="<?php echo $currentIncident->dis_inc_inq_officer; ?>" />
            </div>
            <br class="clear"/>

            <div class="leftCol">
                <label class="controlLabel" for="txtLocationCode"><?php echo __("Prosecuting Officer name ") ?><span class="required">*</span></label>
            </div>
            <div class="centerCol">
                <input type="text" class="formInputText" name="txtProsecOfficer" id="txtProsecOfficer" value="<?php echo $currentIncident->dis_inc_pro_officer; ?>" />
            </div>
            <br class="clear"/>
            <div class="leftCol">
                <label class="controlLabel" for="txtLocationCode"><?php echo __("Defending Officer name ") ?><span class="required">*</span> </label>
            </div>
            <div class="centerCol">
                <input type="text" class="formInputText" name="txtdefenOfficer" id="txtdefenOfficer" value="<?php echo $currentIncident->dis_inc_defe_officer; ?>" />
            </div>

            <br class="clear"/>

            <div class="leftCol">
                <label class="controlLabel" for="txtLocationCode"><?php echo __("Comments Inquiry") ?> </label>
            </div>
            <div class="centerCol">
                <textarea class="formTextArea" id="txtCommentsInquery"  name="txtCommentsInquery" rows="6" cols="25" style="width:400px;"><?php echo $currentIncident->dis_inc_inquery_comment; ?></textarea>
            </div>


            <br class="clear"/>                
            <div class="leftCol">
                <label class="controlLabel" for="txtLocationCode"><?php echo __("Case File Produced Date ") ?> </label>
            </div>
            <div class="centerCol">
                <input type="text" class="formInputText" name="txtFileDate" id="txtFileDate" value="<?php echo LocaleUtil::getInstance()->formatDate($currentIncident->dis_inc_filedate) ?>" />

            </div>
            <br class="clear"/>
            <div class="leftCol">
                <label class="controlLabel" for="txtLocationCode"><?php echo __("Case File") ?> </label>
            </div>
            <div class="centerCol">

                <INPUT TYPE="file" class="formInputText" VALUE="Upload" name="upCasefile" id="upCasefile">
                <INPUT TYPE="hidden" class="formInputText" VALUE="<?php echo $fileName ?>" name="fileName" id="fileName">



            </div>
            <div class="centerCol" style="padding-left:65px;">

                <?php
                $encryptObj = new EncryptionHandler();
                ?>
                <?php if ($isChargeSheet > 0) { ?>
                    <label>
                        <a href="#" onclick="popupimage(link='<?php echo url_for('disciplinary/ImagePopup?id='); ?><?php echo $encryptObj->encrypt($chargeSheet[0]->getDis_attach_id()) ?>')"><?php
                if (strlen($chargeSheet[0]->getDis_attach_name())
                )
                    echo __("View");
                ?></a>

                        <a href="#" id="deletelink" onclick="return deletelink(<?php echo $chargeSheet[0]->getDis_inc_id() ?>,'c')">  <?php echo __("Delete"); ?> </a>
                <?php } ?>
                </label>
<?php // }    ?>
            </div>

            <br class="clear"/>

            <div class="leftCol">
                <label class="controlLabel"  for="txtLocationCode"><?php echo __("Case Finalized") ?> </label>

            </div>

            <div class="centerCol" style="width:50px;">
                <input type="checkbox" name="optactionType" class="formCheckbox" value="1"  <?php if ($currentIncident->dis_inc_isclosed == 1)
    echo "checked" ?>/>
            </div>


            <br class="clear"/>
            <div class="leftCol">
                <label class="controlLabel" for="txtLocationCode"><?php echo __("Final Action Taken By ") ?> <span class="required">*</span></label>
            </div>
            <div class="centerCol">
                <input type="text" class="formInputText" name="txtFinalActionTknby" id="txtFinalActionTknby" value="<?php echo $currentIncident->dis_inc_finact_tknby; ?>" maxlength="100" />
            </div>
            <br class="clear"/>
            <div class="leftCol">
                <label class="controlLabel" for="txtLocationCode"><?php echo __("Final Action Taken") ?> </label>
            </div>
            <div class="centerCol">


                <select name="cmbFinalActionTkn" id="cmbFinalActionTkn" class="formSelect" style="width: 150px;" tabindex="4" >

                    <option value=""><?php echo __("--Select--") ?></option>
                    <?php foreach ($FinalActionType as $types) { ?>
                        <option value="<?php echo $types->dis_fna_code ?>" <?php
                            if ($types->dis_fna_code == $currentIncident->dis_fna_code) {
                                echo "selected";
                            }
                        ?>><?php
                                if ($culture == 'en') {
                                    $abc = "dis_fna_name";
                                } else {
                                    $abc = "dis_fna_name_" . $culture;
                                } if ($types->$abc == "")
                                    echo $types->dis_fna_name;
                                else
                                    echo $types->$abc;
                                ?></option>
<?php } ?>

                </select>

            </div>
            <br class="clear"/>

            <div class="leftCol">
                <label class="controlLabel" for="txtLocationCode"><?php echo __("Final Action Taken Date ") ?> </label>
            </div>
            <div class="centerCol">
                <input type="text" class="formInputText" name="txtFinActTknDate" id="txtFinActTknDate" value="<?php echo LocaleUtil::getInstance()->formatDate($currentIncident->dis_inc_finact_tkndate) ?>" />
            </div>
            <br class="clear"/>

            <div class="leftCol">
                <label class="controlLabel" for="txtLocationCode"><?php echo __("Comment") ?> </label>
            </div>
            <div class="centerCol">
                <textarea class="formTextArea" id="txtFinalActionComments"  name="txtFinalActionComments" rows="6" cols="25" style="width:400px;"><?php echo $currentIncident->dis_inc_finalaction_comment; ?></textarea>
            </div>





            <br class="clear"/>
            <br class="clear"/>
            <hr style="background-color:#FAD163; color: #FAD163; border-style: none; " >
            <br class="clear"/>
            <div class="leftCol" style="width: 50px;">
                <input type="checkbox" name="chkappeal" id="chkappeal" class="formCheckbox" value="1" <?php
if ($currentIncident->dis_inc_appeal_flg == 1) {
    echo "checked";
}
?> />
            </div>
            <div class="centerCol">
                <label class="controlLabel" for="txtLocationCode"><?php echo __("If Appeal"); ?></label>
            </div>

            <br class="clear"/>
            <div id="DivAppeal">
                <div class="leftCol">
                    <label class="controlLabel" for="txtLocationCode"><?php echo __("Appeal Date") ?> </label>
                </div>
                <div class="centerCol">
                    <input type="text" class="formInputText" name="txtAppealDate" id="txtAppealDate" value="<?php echo LocaleUtil::getInstance()->formatDate($currentIncident->dis_inc_appeal_date) ?>" />
                </div>
                <br class="clear"/>

                <br class="clear"/>

                <div class="leftCol">
                    <label class="controlLabel" for="txtLocationCode"><?php echo __("Comments Appeal Board") ?> </label>
                </div>
                <div class="centerCol">
                    <textarea class="formTextArea" id="txtAppealBoardComments"  name="txtAppealBoardComments" rows="6" cols="25" style="width:400px;"><?php echo $currentIncident->dis_inc_appeal_board_comment; ?></textarea>
                </div>

                <br class="clear"/>

                <div class="leftCol">
                    <label class="controlLabel" for="txtLocationCode"><?php echo __("Comments From Labour Tribunal or Labour Commissioner or Amusement Human Rights") ?> </label>
                </div>
                <div class="centerCol">
                    <textarea class="formTextArea" id="txtAppealLabourComment"  name="txtAppealLabourComment" rows="6" cols="25" style="width:400px;"><?php echo $currentIncident->dis_inc_appeal_labour_comment; ?></textarea>
                </div>

                <br class="clear"/>
            </div>
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

    var courseId="";
    var empIDMaster;
    var myArray2= new Array();
    var i;
                                        
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
                                                    


                var word=value.split("|");



                childdiv="<div id='row_"+i+"' style='padding-top:0px;'>";
                childdiv+="<div class='centerCol' id='master' style='width:175px;'>";
                childdiv+="<div id='child' style='height:35px; padding-left:3px; padding-bottom:3px;'>"+word[1]+"</div>";
                childdiv+="</div>";
                childdiv+="<div class='centerCol' id='master' style='width:130px;'>";
                childdiv+="<div id='child' style='height:35px; padding-left:3px; padding-bottom:3px;'>"+word[2]+"</div>";
                childdiv+="</div>";
                childdiv+="<div class='centerCol' id='master' style='width:120px;'>";
                childdiv+="<div id='child' style='height:35px; padding-left:3px; padding-bottom:3px;'>"+word[3]+"</div>";
                childdiv+="<div id='employeename' style=' padding-bottom:5px;'></div>";
                childdiv+="</div>";
                childdiv+="<div class='centerCol' id='master' style='width:65px;'>";
                childdiv+="<div id='child' style='height:35px; padding-left:3px; padding-bottom:3px;'>history</div>";
                childdiv+="</div>";
                childdiv+="<div class='centerCol' id='master' style='width:65px;'>";
                childdiv+="<div id='child' style='height:35px; padding-left:3px; padding-bottom:3px;'><select style='width:50px;' name='cmbType_"+word[4]+"'><option value=1><?php echo __('Major') ?></option><option value=0><?php echo __('Minor') ?></option></select></div>";
                childdiv+="</div>";
                childdiv+="<div class='centerCol' id='master' style='width:60px;'>";
                childdiv+="<div id='child' style='height:35px; padding-left:3px; padding-bottom:3px;'><input type='text' style='width:100px;' name='txtFinalCom_"+word[4]+"' /></div>";
                childdiv+="</div>";
                childdiv+="<div class='centerCol' id='master' style='width:20px;'>";
                childdiv+="<div id='child' style='height:35px; padding-left:63px; padding-bottom:3px;'><input type='hidden' name='hiddenEmpNumber[]' value="+word[4]+" /><a href='#'  onclick='deleteCRow("+i+","+word[4]+")'><?php echo __('Remove') ?></a></div>";
                childdiv+="</div>";
                childdiv+="</div>";

                i++;
                                                    
                $('#employeeGrid').append(childdiv);
                                                    
                $('#hiddeni').val(i);

            });

                                                
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
            location.href = "<?php echo url_for('disciplinary/DeleteimageInquery?id=') . $inc_id ?>?type=d";

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
        atype="<?php echo $currentIncident->dis_acttype_id ?>";
                                           

                                            

        if(atype!=""){

            $.ajax({
                type: "POST",
                asyn:false,
                url: "<?php echo url_for('disciplinary/Loadoffence') ?>",
                data: { atype : atype, offList : offList, Active: "<?php echo $disabled1; ?>" },
                dataType: "json",
                success: function(data){


                    $('#master').html(data.List);




                }
            });
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

                                            
        $('#DivAppeal').hide();
                                           
        if ($('#chkappeal').attr("checked")) {
            $('#DivAppeal').show();
        }else{
            $('#DivAppeal').hide();
        }

        $("input[name='chkappeal']").change(function(){
            if ($(this).attr("checked")) {
                $('#DivAppeal').show();
            }else{
                $('#DivAppeal').hide();
            }
        });

        $('#btnAddEmployee').click(function() {

            var popup=window.open('<?php echo public_path('../../symfony/web/index.php/pim/searchEmployee?type=multiple&method=SelectEmployee'); ?>','Locations','height=450,width=800,resizable=1,scrollbars=1');


            if(!popup.opener) popup.opener=self;
            popup.focus();
        });


        var incidentId="<?php echo $inc_id ?>";
                                           

        if(incidentId!=""){

            $.ajax({
                type: "POST",
                asyn:false,
                url: "<?php echo url_for('disciplinary/GetListedEmpids') ?>",
                data: { incidentId : incidentId },
                dataType: "json",
                success: function(data){
                    $.each(data, function(key, value) {
                        myArray2.push(value);

                    });
                }
            });

        }


        $("#txtIncidentDate").datepicker({ dateFormat: '<?php echo $inputDate ?>' });
        $("#txtFinActTknDate").datepicker({ dateFormat: '<?php echo $inputDate ?>' });
        $("#txtFileDate").datepicker({ dateFormat: '<?php echo $inputDate ?>' });
                                             
        $("#dateProDate").datepicker({ dateFormat: '<?php echo $inputDate ?>' });
        $("#txtAppealDate").datepicker({ dateFormat: '<?php echo $inputDate ?>' });




                                            


        $('#empRepPopBtn').click(function() {
            var popup=window.open('<?php echo public_path('../../templates/hrfunct/emppop.php?reqcode=REP&Disp=1'); ?>','Locations','height=450,width=800,resizable=1,scrollbars=1');
            if(!popup.opener) popup.opener=self;
            popup.focus();
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
        $("#frmSave").validate({


            rules: {
                cmbActiontype: {required: true},
                txtEmpname: { required: true, maxlength: 75},
                txtFileDate: {orange_date: true},
                txtIncident: { required: true,maxlength: 200,noSpecialCharsOnly: true},
                txtIncidentSi: { maxlength: 200,noSpecialCharsOnly: true},
                txtIncidentTa: { maxlength: 200,noSpecialCharsOnly: true},
                                                    
                txtInqueryOfficer: {required: true,maxlength: 100,noSpecialCharsOnly: true},
                txtProsecOfficer: {required: true,maxlength: 100,noSpecialCharsOnly: true},
                txtdefenOfficer: {required: true,maxlength: 100,noSpecialCharsOnly: true},
                txtFinalActionTknby: {required: true,maxlength: 100,noSpecialCharsOnly: true},
                txtAcomment: {maxlength: 200,noSpecialCharsOnly: true},
                txtPreComment:{maxlength: 200,noSpecialCharsOnly: true},
                txtFinalActionTkn: {maxlength: 50,noSpecialCharsOnly: true},
                txtCommentsInquery: {maxlength: 200,noSpecialCharsOnly: true},
                txtFinalActionComments: {maxlength: 200,noSpecialCharsOnly: true},
                txtAppealBoardComments: {maxlength: 200,noSpecialCharsOnly: true},
                txtAppealLabourComment: {maxlength: 200,noSpecialCharsOnly: true},
                txtFinActTknDate: {orange_date: true}


            },
            messages: {
                cmbActiontype: {required: "<?php echo __('This field is required') ?>"},
                txtEmpname: {required: "<?php echo __('This field is required') ?>",maxlength: "<?php echo __('Maximum length should be 75 characters') ?>"},
                txtFileDate: {orange_date: "<?php echo __("Please specify valid  date"); ?>"},
                txtIncident: {required: "<?php echo __('This field is required') ?>",maxlength: "<?php echo __('Maximum length should be 200 characters') ?>",noSpecialCharsOnly: "<?php echo __('No invalid characters are allowed') ?>"},
                txtIncidentSi: {maxlength: "<?php echo __('Maximum length should be 200 characters') ?>",noSpecialCharsOnly: "<?php echo __('No invalid characters are allowed') ?>"},
                txtIncidentTa: {maxlength: "<?php echo __('Maximum length should be 200 characters') ?>",noSpecialCharsOnly: "<?php echo __('No invalid characters are allowed') ?>"},
                                                    
                txtInqueryOfficer: {required: "<?php echo __('This field is required') ?>",maxlength: "<?php echo __('Maximum length should be 100 characters') ?>",noSpecialCharsOnly: "<?php echo __('No invalid characters are allowed') ?>"},
                txtProsecOfficer: {required: "<?php echo __('This field is required') ?>",maxlength: "<?php echo __('Maximum length should be 100 characters') ?>",noSpecialCharsOnly: "<?php echo __('No invalid characters are allowed') ?>"},
                txtdefenOfficer: {required: "<?php echo __('This field is required') ?>",maxlength: "<?php echo __('Maximum length should be 100 characters') ?>",noSpecialCharsOnly: "<?php echo __('No invalid characters are allowed') ?>"},
                txtFinalActionTknby: {required: "<?php echo __('This field is required') ?>",maxlength: "<?php echo __('Maximum length should be 100 characters') ?>",noSpecialCharsOnly: "<?php echo __('No invalid characters are allowed') ?>"},
                txtAcomment: {maxlength: "<?php echo __('Maximum length should be 200 characters') ?>",noSpecialCharsOnly: "<?php echo __('No invalid characters are allowed') ?>"},
                txtPreComment:{maxlength: "<?php echo __('Maximum length should be 200 characters') ?>",noSpecialCharsOnly: "<?php echo __('No invalid characters are allowed') ?>"},
                txtFinalActionTkn:{maxlength: "<?php echo __('Maximum length should be 50 characters') ?>",noSpecialCharsOnly: "<?php echo __('No invalid characters are allowed') ?>"},
                txtCommentsInquery:{maxlength: "<?php echo __('Maximum length should be 200 characters') ?>",noSpecialCharsOnly: "<?php echo __('No invalid characters are allowed') ?>"},
                txtFinalActionComments:{maxlength: "<?php echo __('Maximum length should be 200 characters') ?>",noSpecialCharsOnly: "<?php echo __('No invalid characters are allowed') ?>"},
                txtAppealBoardComments:{maxlength: "<?php echo __('Maximum length should be 200 characters') ?>",noSpecialCharsOnly: "<?php echo __('No invalid characters are allowed') ?>"},
                txtAppealLabourComment:{maxlength: "<?php echo __('Maximum length should be 200 characters') ?>",noSpecialCharsOnly: "<?php echo __('No invalid characters are allowed') ?>"},
                txtFinActTknDate: {orange_date: "<?php echo __("Please specify valid  date"); ?>"}



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
                                                                                         
                                                
                location.href="<?php echo url_for('disciplinary/UpdateInsidentlevel2?id=' . $encrypt->encrypt($currentIncident->dis_inc_id) . '&lock=' . $encrypt->encrypt(1)) ?>";
            }
            else {
                var n = $("input[name='checkList[]']:checked").length;
                                                
                                                
                if(n>0){
                                                                    
                    $('#frmSave').submit();
                                                                            
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
            location.href="<?php echo url_for('disciplinary/UpdateInsidentlevel2?id=' . $encrypt->encrypt($currentIncident->dis_inc_id) . '&lock=' . $encrypt->encrypt(0)) ?>";
        });

        //When Click back button
        $("#btnBack").click(function() {
            location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/disciplinary/PendingInqSummary')) ?>";
        });
        $("#master").attr("disable", true);
        //$("div#master td:first").text("New title")


    });
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

