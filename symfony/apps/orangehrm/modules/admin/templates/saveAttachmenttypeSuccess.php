<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.validate.js') ?>"></script>
<div class="formpage4col" >
    <div class="navigation">
        <input type="button" class="backbutton" id="btnBack"
               value="<?php echo __("Back") ?>" tabindex="10" />
    </div>
    <div id="status"></div>
    <div class="outerbox">
        <div class="mainHeading"><h2><?php echo __("Add Attachmeny Type") ?></h2></div>
        <form name="frmSave" id="frmSave" method="post"  action="<?php echo url_for('admin/saveAttachmenttype'); ?>">
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
                <label for="txtLocationCode"><?php echo __("Attachmeny Type") ?> <span class="required">*</span></label>
            </div>
            <div class="centerCol">

                <input id="txtName"  name="txtName" type="text"  class="formInputText" value="" maxlength="100" />
                <input id="txtGradeId"  name="txtAttachTypeId" type="hidden"  class="formInputText" value="" maxlength="100" />
            </div>

            <div class="centerCol">

                <input id="txtNamesi"  name="txtNamesi" type="text"  class="formInputText" value="" maxlength="100" />
            </div>

            <div class="centerCol">

                <input id="txtNameta"  name="txtNameta" type="text"  class="formInputText" value="" maxlength="100" />
            </div>
            <br class="clear"/>
            <br class="clear"/>
            <div class="formbuttons">
                <input type="button" class="savebutton" id="editBtn"

                       value="<?php echo __("Save") ?>" tabindex="8" />
                <input type="button" class="clearbutton"  id="resetBtn"
                       value="<?php echo __("Reset") ?>" tabindex="9" />
            </div>
        </form>
    </div>

</div>

<script type="text/javascript">

    $(document).ready(function() {




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
            $('#frmSave').submit();

        });

        //When click reset buton
        $("#resetBtn").click(function() {
            document.forms[0].reset('');
        });

        //When Click back button
        $("#btnBack").click(function() {
            location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/admin/listAttachtype')) ?>";
        });

    });
</script>

