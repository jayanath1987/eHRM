<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.validate.js') ?>"></script>
<div class="formpage4col">
    <div class="navigation">

    </div>
    <div id="status"></div>
    <div class="outerbox">
        <div class="mainHeading"><h2><?php echo __("Languages") ?></h2></div>
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
                <label for="txtLanguage"><?php echo __("Language Name") ?> <span class="required">*</span></label>
            </div>
            <div class="centerCol">
                <input id="txtLanguage"  name="txtLanguage" type="text" maxlength="100" class="formInputText" value="" tabindex="1" />
            </div>
            <div class="centerCol">
                <input id="txtLanguageSI"  name="txtLanguageSI" type="text" maxlength="100"  class="formInputText" value="" tabindex="1" />
            </div>
            <div class="centerCol">
                <input id="txtLanguageTA"  name="txtLanguageTA" type="text" maxlength="100"  class="formInputText" value="" tabindex="1" />
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
    <div class="requirednotice"><?php echo preg_replace('/#star/', '<span class="required">*</span>', __("Fields marked with an asterisk #star are required")); ?>.</div>
</div>

<script type="text/javascript">

    $(document).ready(function() {
        buttonSecurityCommon(null,"btnEdit",null,null);
        //Validate the form
        $("#frmSave").validate({
            rules: {
                txtLanguage: { maxlength: 100,required: true, noSpecialChars: true },
                txtLanguageSI: { maxlength: 100,noSpecialChars: true },
                txtLanguageTA: { maxlength: 100,noSpecialChars: true }
            },
            messages: {
                txtLanguage: { maxlength: "<?php echo __('Maximum length should be 100 characters') ?>",required: "<?php echo __('This field is required.') ?>", noSpecialChars: "<?php echo __('This field contains invalid characters.') ?>" },
                txtLanguageSI: { maxlength: "<?php echo __('Maximum length should be 100 characters') ?>",noSpecialChars: "<?php echo __('This field contains invalid characters.') ?>" },
                txtLanguageTA: { maxlength: "<?php echo __('Maximum length should be 100 characters') ?>",noSpecialChars: "<?php echo __('This field contains invalid characters.') ?>" }
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
            location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/admin/listLanguage')) ?>";
        });

    });
</script>
