
<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.validate.js') ?>"></script>
<div class="formpage4col">
    <div class="navigation">

    </div>
    <div id="status"></div>
    <div class="outerbox">
        <div class="mainHeading"><h2><?php echo __("Languages") ?></h2></div>
        <?php echo message(); ?>

        <form name="frmSave" id="frmSave" method="post"  action="">
            <?php echo $form['_csrf_token']; ?>
            <input type="hidden" name="txtID" id="txtID" value="<?php echo $language->lang_code ?>" />

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
                <input id="txtLanguage"  name="txtLanguage" type="text"  class="formInputText" value="<?php echo $language->getLangName() ?>" tabindex="1" maxlength="100" />
            </div>
            <div class="centerCol">
                <input id="txtLanguageSI"  name="txtLanguageSI" type="text"  class="formInputText" value="<?php echo $language->getLangNameSI() ?>" maxlength="100" tabindex="1" />
            </div>
            <div class="centerCol">
                <input id="txtLanguageTA"  name="txtLanguageTA" type="text"  class="formInputText" value="<?php echo $language->getLangNameTA() ?>" maxlength="100" tabindex="1" />
            </div>
            <br class="clear"/>

            <div class="formbuttons">
                <input type="button" class="savebutton" id="btnEdit"
                       value="<?php echo __("Edit") ?>" tabindex="2" />
                <input type="button" class="clearbutton" id="btnReset"
                       value="<?php echo __("Reset") ?>" tabindex="3" />
                <input type="button" class="backbutton" id="btnBack" value="<?php echo __("Back") ?>" tabindex="4" />
            </div>
        </form>
    </div>
    <div class="requirednotice"><?php echo preg_replace('/#star/', '<span class="required">*</span>', __("Fields marked with an asterisk #star are required")); ?>.</div>
</div>

<script type="text/javascript">

    function getLanguage(id){
        $.post("<?php echo url_for('admin/GetLanguageById') ?>",
        { id: id },
        function(data){
            setLanguageData(data);
        },
        "json"
    );
    }

    function lockLanguage(id){
        $.post("<?php echo url_for('admin/lockLanguage') ?>",
        { id: id },
        function(data){
            if (data.recordLocked==true) {
                getLanguage(id);
                $("#frmSave").data('edit', '1'); // In edit mode
                setLanguageAttributes();
            }else {
                alert('Record Locked');
            }
        },
        "json"
    );
    }

    function unlockLanguage(id){
        $.post("<?php echo url_for('admin/unlockLanguage') ?>",
        { id: id },
        function(data){
            getLanguage(id);
            $("#frmSave").data('edit', '0'); // In view mode
            setLanguageAttributes();
        },
        "json"
    );
    }

    function setLanguageData(data){
        $("#txtLanguage").val(data.lang_name);
        $("#txtLanguageSI").val(data.lang_name_si);
        $("#txtLanguageTA").val(data.lang_name_ta);
    }

    function setLanguageAttributes() {

        var editMode = $("#frmSave").data('edit');
        if (editMode == 0) {
            $('#frmSave :input').attr('disabled','disabled');
            $('#btnEdit').removeAttr('disabled');
            $('#btnBack').removeAttr('disabled');

            $("#btnEdit").attr('value',"<?php echo __("Edit"); ?>");
            $("#btnEdit").attr('title',"<?php echo __("Edit"); ?>");
        }
        else {
            $('#frmSave :input').removeAttr('disabled');

            $("#btnEdit").attr('value',"<?php echo __("Save"); ?>");
            $("#btnEdit").attr('title',"<?php echo __("Save"); ?>");
        }
    }

    $(document).ready(function() {
    
        buttonSecurityCommon(null,null,"btnEdit",null);
        //Disable all fields
        $('#frmSave :input').attr('disabled', true);
        $('#btnEdit').removeAttr('disabled');
        $('#btnBack').removeAttr('disabled');
        $("#frmSave").data('edit', '0'); // In view mode

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

        // Switch edit mode or submit data when edit/save button is clicked
        $("#btnEdit").click(function() {
            var editMode = $("#frmSave").data('edit');
        
            if (editMode == 0) {
                lockLanguage($('#txtID').val());
                return false;
            }
            else {
                $('#frmSave').submit();
            }
        });

        //When Click back button
        $("#btnBack").click(function() {
            location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/admin/listLanguage')) ?>";
        });

        $('#btnReset').click(function() {
            // hide validation error messages
            $("label.errortd[generated='true']").css('display', 'none');

            // 0 - view, 1 - edit, 2 - add
            var editMode = $("#frmSave").data('edit');
            if (editMode == 1) {
                unlockLanguage($('#txtID').val());
                return false;
            }
            else {
                document.forms['frmSave'].reset('');
            }
        });
				
    });
</script>
