<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.validate.js') ?>"></script>
<div class="formpage4col">
    <div class="navigation">

    </div>
    <div id="status"></div>
    <div class="outerbox">
        <div class="mainHeading"><h2><?php echo __("Education") ?></h2></div>
        <?php echo message() ?><?php echo message() ?>
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
                <label for="txtEducation"><?php echo __("Education Name") ?> <span class="required">*</span></label>
            </div>
            <div class="centerCol">
                <input id="txtEducation"  name="txtEducation" type="text"  class="formInputText" value="" tabindex="1" />
            </div>
            <div class="centerCol">
                <input id="txtEducationSI"  name="txtEducationSI" type="text"  class="formInputText" value="" tabindex="1" />
            </div>
            <div class="centerCol">
                <input id="txtEducationTA"  name="txtEducationTA" type="text"  class="formInputText" value="" tabindex="1" />
            </div>
            <br class="clear"/>

            <div class="formbuttons">
                <input type="button" class="savebutton" id="btnEdit"
                       value="<?php echo __("Save") ?>" tabindex="2" />
                <input type="button" class="clearbutton" id="btnReset"
                       value="<?php echo __("Reset") ?>" tabindex="3" />
                <input type="button" class="backbutton" id="btnBack" value="<?php echo __("Back") ?>" tabindex="4" />
            </div>
        </form>
    </div>
    <div class="requirednotice"><?php echo __("Fields marked with an asterisk") ?><span class="required"> * </span> <?php echo __("are required") ?></div>

</div>

<script type="text/javascript">

    $(document).ready(function() {

        buttonSecurityCommon(null,"btnEdit",null,null);

        //Validate the form
        $("#frmSave").validate({
            rules: {
                txtEducation: { required: true, specialChars: true,maxlength:100 },
                txtEducationSI: { specialChars: true,maxlength:100 },
                txtEducationTA: { specialChars: true,maxlength:100 }
            },
            messages: {
                txtEducation: { required: "<?php echo __('This field is required.') ?>", specialChars: "<?php echo __('This field contains invalid characters.') ?>",maxlength:"<?php echo __("Maximum 100 Characters") ?>" },
                txtEducationSI: { specialChars: "<?php echo __('This field contains invalid characters.') ?>",maxlength:"<?php echo __("Maximum 100 Characters") ?>" },
                txtEducationTA: { specialChars: "<?php echo __('This field contains invalid characters.') ?>",maxlength:"<?php echo __("Maximum 100 Characters") ?>" }
            },
            errorClass: "errortd",

            submitHandler: function(form) {
                $('#btnEdit').unbind('click').click(function() {return false}).val("<?php echo __('Wait..'); ?>");
                form.submit();
            }
        });

        //When click reset buton
        $("#btnReset").click(function() {
            // hide validation error messages
            $("label.errortd[generated='true']").css('display', 'none');
            document.forms[0].reset('');
        });

        // When click edit button
        $("#btnEdit").click(function() {
            $('#frmSave').submit();
        });

        //When Click back button
        $("#btnBack").click(function() {
            location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/admin/listEducation')) ?>";
        });

    });
</script>
