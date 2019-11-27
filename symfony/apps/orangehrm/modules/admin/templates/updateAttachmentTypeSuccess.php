<?php
if ($lockMode == '1') {
    $editMode = false;
    $disabled = '';
} else {
    $editMode = true;
    $disabled = 'disabled="disabled"';
}
?>
<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.validate.js') ?>"></script>
<div class="formpage4col" >
    <div class="navigation">
        <input type="button" class="backbutton" id="btnBack"
               value="<?php echo __("Back") ?>" tabindex="10" />
               <?php echo message() ?>
    </div>
    <div id="status"></div>
    <div class="outerbox">

        <div class="mainHeading"><h2><?php echo __("Update Attachment Type") ?></h2></div>
        <form name="frmSave" id="frmSave" method="post"  action="">
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
            <div class="leftCol">
                <label for="txtLocationCode"><?php echo __("Class Name") ?> <span class="required">*</span></label>
            </div>
            <div class="centerCol">

                <input id="txtName"  name="txtName" type="text"  class="formInputText" value="<?php echo $attachType->eattach_type_name ?>" maxlength="100" />
                <input id="txtGradeId"  name="id1" type="hidden"  class="formInputText" value="<?php echo $attachType->eattach_type_id ?>" maxlength="100" />
            </div>

            <div class="centerCol">

                <input id="txtNamesi"  name="txtNamesi" type="text"  class="formInputText" value="<?php echo $attachType->eattach_type_name_si ?>" maxlength="100" />
            </div>

            <div class="centerCol">

                <input id="txtNameta"  name="txtNameta" type="text"  class="formInputText" value="<?php echo $attachType->eattach_type_name_ta ?>" maxlength="100" />
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
            </div>
        </form>
    </div>

</div>

<script type="text/javascript">

    $(document).ready(function() {


<?php if ($editMode == true) { ?>
            $('#frmSave :input').attr('disabled', true);
            $('#editBtn').removeAttr('disabled');
<?php } ?>

        //Validate the form
        $("#frmSave").validate({

            rules: {
                txtName: { required: true,noSpecialCharsOnly: true, maxlength:100 },
                txtNamesi: {noSpecialCharsOnly: true, maxlength:100 },
                txtNameta: {noSpecialCharsOnly: true, maxlength:100 }
            },
            messages: {
                txtName: {required:"<?php echo __("This field is required") ?>",maxlength:"<?php echo __("Maximum 100 Characters") ?>",noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>"},
                txtNamesi:{maxlength:"<?php echo __("Maximum 100 Characters") ?>",noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>"},
                txtNameta:{maxlength:"<?php echo __("Maximum 100 Characters") ?>",noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>"}

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

                location.href="<?php echo url_for('admin/updateAttachmentType?id=' . $attachType->eattach_type_id . '&lock=1') ?>";
            }
            else {

                $('#frmSave').submit();
            }

        });

        //When click reset buton
        $("#btnClear").click(function() {
            location.href="<?php echo url_for('admin/updateAttachmentType?id=' . $attachType->eattach_type_id . '&lock=0') ?>";
        });

        //When Click back button
        $("#btnBack").click(function() {
            location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/admin/listAttachtype')) ?>";
        });

    });
</script>

