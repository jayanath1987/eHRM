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
<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.validate.js') ?>"></script>
<div class="formpage4col" >
    <div class="navigation">

    </div>
    <div id="status"></div>
    <div class="outerbox">
        <div class="mainHeading"><h2><?php echo __("Define EB Exam") ?></h2></div>
        <?php echo message() ?>
        <form name="frmSave" id="frmSave" method="post"  action="<?php echo url_for('admin/saveEbExam'); ?>">
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

            <div class="leftCol">
                <label for="txtLocationCode"><?php echo __("Service Name") ?> <span class="required">*</span></label>
            </div>

            <div class="centerCol">

                <select class="formSelect" <?php //echo $disabled;          ?> id="cmbService" name="cmbService"><span class="required">*</span>
                    <option value=""><?php echo __("--Select--"); ?></option>
                    <?php
                    //Define data columns according culture
                    $ServiceCol = ($userCulture == "en") ? "getService_name" : "getService_name_" . $userCulture;

                    if ($serviceList) {

                        foreach ($serviceList as $service) {

                            $selected = $ebExamGetById->service_code;

                            if ($selected == $service->getService_code()) {
                                $selectedValue = "selected";
                            } else {
                                $selectedValue = "";
                            }
                            $empServiceName = $service->$ServiceCol() == "" ? $service->getService_name() : $service->$ServiceCol();
                            echo "<option {$selectedValue}  value='{$service->getService_code()}'>{$empServiceName}</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <br class="clear"/>
            <div class="leftCol">
                <label for="txtLocationCode"><?php echo __("Grade Name") ?> <span class="required">*</span></label>
            </div>



            <div class="centerCol">
                <input type="hidden" name="txtHiddenEbID" value="<?php echo $ebExamGetById->ebexam_id; ?>" />
                <select class="formSelect" id="cmbGrade" name="cmbGrade"><span class="required">*</span>
                    <option value=""><?php echo __("--Select--"); ?></option>
<?php
                    //Define data columns according culture
                    $empGradeCol = ($userCulture == "en") ? "getGrade_name" : "getGrade_name_" . $userCulture;

                    if ($gradeList) {

                        foreach ($gradeList as $empgradeList) {
                            $selected = $ebExamGetById->grade_code;


                            if ($selected == $empgradeList->getGrade_code()) {
                                $selectedValue = "selected";
                            } else {
                                $selectedValue = "";
                            }
                            $empGradeName = $empgradeList->$empGradeCol() == "" ? $empgradeList->getGrade_name() : $empgradeList->$empGradeCol();
                            echo "<option {$selectedValue}  value='{$empgradeList->getGrade_code()}'>{$empGradeName}</option>";
                        }
                    }
?>
                </select>
            </div>

            <br class="clear"/>
            <div class="leftCol">
                <label for="txtLocationCode"><?php echo __("EB Exam Name") ?> <span class="required">*</span></label>
            </div>

            <div class="centerCol">

                <input id="txtEbexamName"  name="txtEbexamName" type="text"  class="formInputText" value="<?php
                    if (strlen($ebExamGetById->ebexam_name)) {
                        echo $ebExamGetById->ebexam_name;
                    } ?>" maxlength="100" />

            </div>
            <div class="centerCol">

                <input id="txtEbexamNameSi"  name="txtEbexamNameSi" type="text"  class="formInputText" value="<?php
                       if (strlen($ebExamGetById->ebexam_name_si)) {
                           echo $ebExamGetById->ebexam_name_si;
                       }
?>" maxlength="100" />

            </div>
            <div class="centerCol">

                <input id="txtEbexamNameTa"  name="txtEbexamNameTa" type="text"  class="formInputText" value="<?php
                       if (strlen($ebExamGetById->ebexam_name_ta)) {
                           echo $ebExamGetById->ebexam_name_ta;
                       }
?>" maxlength="100" />

            </div>
            <br class="clear"/>
            <div class="leftCol">
                <label for="txtEbexamDesc"><?php echo __("Description") ?></label>
               </div>
               <div class="centerCol">
                   <textarea id="txtEbexamDesc" class="formTextArea" style="width: 400px; height: 75px;" tabindex="1" name="txtEbexamDesc" type="text"><?php
                       if (strlen($ebExamGetById->ebexam_description)) {
                           echo $ebExamGetById->ebexam_description;
                       }
?></textarea>
               </div>

               <br class="clear"/>
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
   <script type="text/javascript">

       $(document).ready(function() {
           buttonSecurityCommon(null,"editBtn",null,null);
<?php if ($mode == 0) { ?>
               $('#editBtn').show();
               buttonSecurityCommon(null,null,"editBtn",null);

               $('#frmSave :input').attr('disabled', true);
               $('#editBtn').removeAttr('disabled');
               $('#btnBack').removeAttr('disabled');
<?php } ?>


           //Validate the form
           $("#frmSave").validate({

               rules: {
                   cmbService: { required: true },
                   cmbGrade: { required: true },
                   txtEbexamName: {required: true,noSpecialCharsOnly: true, maxlength:100 },
                   txtEbexamNameSi: {noSpecialCharsOnly: true, maxlength:100 },
                   txtEbexamNameTa: {noSpecialCharsOnly: true, maxlength:100 },
                   txtEbexamDesc: {noSpecialCharsOnly: true, maxlength:200 }
               },
               messages: {
                   cmbService: { required:"<?php echo __("This field is required") ?>" },
                   cmbGrade: {required:"<?php echo __("This field is required") ?>"},
                   txtEbexamName:{required:"<?php echo __("This field is required") ?>",maxlength:"<?php echo __("Maximum 100 Characters") ?>",noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>"},
                   txtEbexamNameSi:{maxlength:"<?php echo __("Maximum 100 Characters") ?>",noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>"},
                   txtEbexamNameTa:{maxlength:"<?php echo __("Maximum 100 Characters") ?>",noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>"},
                   txtEbexamDesc:{maxlength:"<?php echo __("Maximum 200 Characters") ?>",noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>"}
               },

            submitHandler: function(form) {
                $('#editBtn').unbind('click').click(function() {return false}).val("<?php echo __('Wait..'); ?>");
                form.submit();
            }
           });



           // When click edit button
           $("#frmSave").data('edit', <?php echo $editMode ? '1' : '0' ?>);

           // When click edit button
           $("#editBtn").click(function() {
               var editMode = $("#frmSave").data('edit');
               if (editMode == 1) {
                   // Set lock = 1 when requesting a table lock

                   location.href="<?php echo url_for('admin/saveEbExam?ebExamId=' . $encrypt->encrypt($ebExamGetById->ebexam_id) . '&lock=1') ?>";
               }
               else {

                   $('#frmSave').submit();
               }

           });

           //When click reset buton
           $("#btnClear").click(function() {
               if($("#frmSave").data('edit') != 1){
                   location.href="<?php echo url_for('admin/saveEbExam?ebExamId=' . $encrypt->encrypt($ebExamGetById->ebexam_id) . '&lock=0') ?>";
               }else{
                   document.forms[0].reset('');
               }
           });

           //When Click back button
           $("#btnBack").click(function() {
               location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/admin/listDefineEbexam')) ?>";
        });

    });
</script>


