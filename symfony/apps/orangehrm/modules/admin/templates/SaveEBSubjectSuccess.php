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
        <div class="mainHeading"><h2><?php echo __("EB Subject Name") ?></h2></div>
        <?php echo message() ?>
        <form name="frmSave" id="frmSave" method="post"  action="<?php echo url_for('admin/SaveEBSubject'); ?>">
            <input type="hidden" id="txtHiddenETID" name="txtHiddenETID" value="<?php echo $EducationType->ebs_id ?>"/>
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
                <label for="txtLocationCode"><?php echo __("EB Subject Name") ?> <span class="required">*</span></label>
            </div>

            <div class="centerCol">

                <input id="txtEducationTypeName"  name="txtEducationTypeName" type="text"  class="formInputText" value="<?php
                    if (strlen($EducationType->ebs_name)) {
                        echo $EducationType->ebs_name;
                    } ?>" maxlength="100" />

            </div>
            <div class="centerCol">

                <input id="txtEducationTypeNameSi"  name="txtEducationTypeNameSi" type="text"  class="formInputText" value="<?php
                       if (strlen($EducationType->ebs_name_si)) {
                           echo $EducationType->ebs_name_si;
                       }
?>" maxlength="100" />

            </div>
            <div class="centerCol">

                <input id="txtEducationTypeNameTa"  name="txtEducationTypeNameTa" type="text"  class="formInputText" value="<?php
                       if (strlen($EducationType->ebs_name_ta)) {
                           echo $EducationType->ebs_name_ta;
                       }
?>" maxlength="100" />

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
                   txtEducationTypeName: {required: true,noSpecialCharsOnly: true, maxlength:100 },
                   txtEducationTypeNameSi: {noSpecialCharsOnly: true, maxlength:100 },
                   txtEducationTypeNameTa: {noSpecialCharsOnly: true, maxlength:100 }
               },
               messages: {
                   txtEducationTypeName:{required:"<?php echo __("This field is required") ?>",maxlength:"<?php echo __("Maximum 100 Characters") ?>",noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>"},
                   txtEducationTypeNameSi:{maxlength:"<?php echo __("Maximum 100 Characters") ?>",noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>"},
                   txtEducationTypeNameTa:{maxlength:"<?php echo __("Maximum 100 Characters") ?>",noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>"}
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

                   location.href="<?php echo url_for('admin/SaveEBSubject?ETId=' . $encrypt->encrypt($EducationType->ebs_id) . '&lock=1') ?>";
               }
               else {

                   $('#frmSave').submit();
               }

           });

           //When click reset buton
           $("#btnClear").click(function() {
               if($("#frmSave").data('edit') != 1){
                   location.href="<?php echo url_for('admin/SaveEBSubject?ETId=' . $encrypt->encrypt($EducationType->ebs_id) . '&lock=0') ?>";
               }else{
                   document.forms[0].reset('');
               }
           });

           //When Click back button
           $("#btnBack").click(function() {
               location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/admin/EBSubject')) ?>";
        });

    });
</script>


