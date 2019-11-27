<?php
if ($mode == '1') {
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
<link href="../../themes/orange/css/style.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?php echo public_path('../../scripts/time.js') ?>"></script>

<div class="formpage4col" >
    <div class="navigation">
    </div>
    <div id="status"></div>
    <div class="outerbox">
        <div class="mainHeading"><h2><?php echo __("Job Role") ?></h2></div>
        <?php echo message() ?>
        <form name="frmSave" id="frmSave" method="post"  action="" >

            <div class="leftCol">
                &nbsp;
            </div>
            <div class="centerCol">
                <label class="languageBar"><?php echo __("English") ?></label>
            </div>
            <div class="centerCol">
                <label class="languageBar"><?php echo __("Sinhala") ?></label>
            </div>
            <div class="centerCol">
                <label class="languageBar"><?php echo __("Tamil") ?></label>
            </div>
            <br class="clear"/>
            <div class="leftCol"> <label class="controlLabel" for="txtLocationCode"><?php echo __("Designation") ?> <span class="required"> * </span></label></div>
            <div class="centerCol"><select name="cmbDesignation" class="formSelect" style="width: 150px;" tabindex="4">
                    <option value=""><?php echo __("--Select--") ?></option>
                    <?php foreach ($Designation as $DesignationDetail) {
                        ?>
                        <option value="<?php echo $DesignationDetail->getId() ?>" <?php
                    if ($DesignationDetail->getId() == $JobRoleFetch->getJobtit_code()) {
                        echo "selected=selected";
                    }
                        ?>><?php
                                if ($myCulture == 'en') {
                                    $abcd = "getName";
                                } else {
                                    $abcd = "getName_" . $myCulture;
                                }
                                if ($DesignationDetail->$abcd() == "") {
                                    echo $DesignationDetail->getName();
                                } else {
                                    echo $DesignationDetail->$abcd();
                                }
                                ?></option>
<?php } ?>
                </select></div>

            <br class="clear"/>
            <div class="leftCol"> <label class="controlLabel" for="txtLocationCode"><?php echo __("Level") ?> <span class="required"> * </span></label></div>
            <div class="centerCol"><select name="cmbLevel" class="formSelect" style="width: 150px;" tabindex="4">
                    <option value=""><?php echo __("--Select--") ?></option>
                    <?php foreach ($Level as $LevelDetail) {
                        ?>
                        <option value="<?php echo $LevelDetail->getLevel_code() ?>" <?php
                            if ($LevelDetail->getLevel_code() == $JobRoleFetch->getLevel_code()) {
                                echo "selected=selected";
                            }
                        ?> ><?php
                                if ($myCulture == 'en') {
                                    $abcd = "getLevel_name";
                                } else {
                                    $abcd = "getLevel_name_" . $myCulture;
                                }
                                if ($LevelDetail->$abcd() == "") {
                                    echo $LevelDetail->getLevel_name();
                                } else {
                                    echo $LevelDetail->$abcd();
                                }
                                ?></option>
<?php } ?>
                </select></div>

            <br class="clear"/>
            <div class="leftCol"> <label class="controlLabel" for="txtLocationCode"><?php echo __("Service") ?> <span class="required"> * </span></label></div>
            <div class="centerCol"><select id="cmbService" name="cmbService" class="formSelect" style="width: 150px;" tabindex="4">
                    <option value=""><?php echo __("--Select--") ?></option>
                                <?php foreach ($Service as $ServiceDetail) { ?>
                        <option value="<?php echo $ServiceDetail->getService_code() ?>" <?php
                                if ($ServiceDetail->getService_code() == $JobRoleFetch->getService_code()) {
                                    echo "selected=selected";
                                }
                                    ?> ><?php
                                if ($myCulture == 'en') {
                                    $abcd = "getService_name";
                                } else {
                                    $abcd = "getService_name_" . $myCulture;
                                }
                                if ($ServiceDetail->$abcd() == "") {
                                    echo $ServiceDetail->getService_name();
                                } else {
                                    echo $ServiceDetail->$abcd();
                                }
                                ?></option>
<?php } ?>
                </select></div>



            <br class="clear"/>

            <div class="leftCol">
                <label for="txtLocationCode"><?php echo __("Job Role") ?><span class="required"> * </span></label>
                <input name="txtbtid" type="hidden" value=""/>
            </div>
            <div class="centerCol">
                <textarea id="txtName" class="formTextArea" tabindex="1" name="txtName" type="text"><?php echo $JobRoleFetch->getJrl_name() ?></textarea>
            </div>
            <div class="centerCol">
                <textarea id="txtNamesi" class="formTextArea" tabindex="2" name="txtNamesi" type="text"><?php echo $JobRoleFetch->getJrl_name_si() ?></textarea>
            </div>
            <div class="centerCol">
                <textarea id="txtNameta" class="formTextArea" tabindex="3" name="txtNameta" type="text"><?php echo $JobRoleFetch->getJrl_name_ta() ?></textarea>
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
                       value="<?php echo __("Back") ?>" tabindex="18"  onclick="goBack();"/>
            </div>
        </form>
    </div>
    <div class="requirednotice"><?php echo __("Fields marked with an asterisk") ?><span class="required"> * </span> <?php echo __("are required") ?></div>
    <br class="clear" />
</div>


<script type="text/javascript">

    $(document).ready(function() {
        buttonSecurityCommon(null,"editBtn",null,null);
                            
<?php if ($mode == 0) { ?>
                                                        
            $("#editBtn").show();
            buttonSecurityCommon(null,null,"editBtn",null);
            $('#frmSave :input').attr('disabled', true);
            $('#editBtn').removeAttr('disabled');
            $('#btnBack').removeAttr('disabled');
                     
<?php } ?>


        //Validate the form
        $("#frmSave").validate({

            rules: {
                cmbDesignation: { required: true },
                cmbLevel: { required: true },
                cmbService: { required: true },
                txtName: { required: true,noSpecialCharsOnly: true, maxlength:200 },
                txtNamesi: {maxlength:200,noSpecialCharsOnly: true },
                txtNameta: { maxlength:200,noSpecialCharsOnly: true }
            },
            messages: {
                cmbDesignation:"<?php echo __("This field is required.") ?>",
                cmbLevel:"<?php echo __("This field is required.") ?>",    
                cmbService:"<?php echo __("This field is required.") ?>",  
                txtName: {required:"<?php echo __("This field is required.") ?>",maxlength:"<?php echo __("Maximum 200 Characters") ?>",noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>"},
                txtNamesi:{maxlength:"<?php echo __("Maximum 200 Characters") ?>",noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>"},
                txtNameta:{maxlength:"<?php echo __("Maximum 200 Characters") ?>",noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>"}

            },
            submitHandler: function(form) {
                $('#editBtn').unbind('click').click(function() {return false}).val("<?php echo __('Wait..'); ?>");
                form.submit();
            }
        });

                           
        $("#frmSave").data('edit', <?php echo $editMode ? '1' : '0' ?>);
        // When click edit button
        $("#editBtn").click(function() {
            var editMode = $("#frmSave").data('edit');
            if (editMode == 1) {
                // Set lock = 1 when requesting a table lock
                location.href="<?php echo url_for('admin/SaveJobRole?id=' . $encrypt->encrypt($JobRoleFetch->getJrl_id()) . '&lock=' . $encrypt->encrypt(1)) ?>";
            }
            else {

                $('#frmSave').submit();
            }
        });

        //When click reset buton
        $("#resetBtn").click(function() {
            //document.forms[0].reset('');
            location.href="<?php echo url_for('admin/SaveJobRole?id=' . $encrypt->encrypt($JobRoleFetch->getJrl_id()) . '&lock=' . $encrypt->encrypt(0)) ?>";
        });

        //When Click back button
        $("#btnBack").click(function() {
            location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/admin/JobRole')) ?>";
        });

    });
</script>
