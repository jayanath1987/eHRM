
<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.validate.js') ?>"></script>
<div class="formpage4col">
    <div class="navigation">

    </div>
    <div id="status"></div>
    <div class="outerbox">
        <div class="mainHeading"><h2><?php echo __("Education") ?></h2></div>
        <?php echo message(); ?>

        <form name="frmSave" id="frmSave" method="post"  action="">
            <?php echo $form['_csrf_token']; ?>
            <input type="hidden" name="txtID" id="txtID" value="<?php echo $education->edu_code ?>" />

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
                <input id="txtEducation"  name="txtEducation" type="text"  class="formInputText" value="<?php echo $education->edu_name ?>" tabindex="1" />
            </div>
            <div class="centerCol">
                <input id="txtEducationSI"  name="txtEducationSI" type="text"  class="formInputText" value="<?php echo $education->edu_name_si ?>" tabindex="1" />
            </div>
            <div class="centerCol">
                <input id="txtEducationTA"  name="txtEducationTA" type="text"  class="formInputText" value="<?php echo $education->edu_name_ta ?>" tabindex="1" />
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
    <div class="requirednotice"><?php echo __("Fields marked with an asterisk") ?><span class="required"> * </span> <?php echo __("are required") ?></div>

</div>

<script type="text/javascript">

    function getEducation(id){
        $.post("<?php echo url_for('admin/GetEducationById') ?>",
        { id: id },
        function(data){
            setEducationData(data);
        },
        "json"
    );
    }

    function lockEducation(id){
        $.post("<?php echo url_for('admin/lockEducation') ?>",
        { id: id },
        function(data){
            if (data.recordLocked==true) {
                getEducation(id);
                $("#frmSave").data('edit', '1'); // In edit mode
                setEducationAttributes();
            }else {
                alert('Record Locked');
            }
        },
        "json"
    );
    }

    function unlockEducation(id){
        $.post("<?php echo url_for('admin/unlockEducation') ?>",
        { id: id },
        function(data){
            getEducation(id);
            $("#frmSave").data('edit', '0'); // In view mode
            setEducationAttributes();
        },
        "json"
    );
    }

    function setEducationData(data){
        $("#txtEducation").val((data.edu_name==null? '':data.edu_name));
        $("#txtEducationSI").val((data.edu_name_si==null? '':data.edu_name_si));
        $("#txtEducationTA").val((data.edu_name_ta==null? '':data.edu_name_ta));
    }

    function setEducationAttributes() {

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

        // Switch edit mode or submit data when edit/save button is clicked
        $("#btnEdit").click(function() {
            var editMode = $("#frmSave").data('edit');

            if (editMode == 0) {
                lockEducation($('#txtID').val());
                return false;
            }
            else {
                $('#frmSave').submit();
            }
        });

        //When Click back button
        $("#btnBack").click(function() {
            location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/admin/listEducation')) ?>";
        });

        $('#btnReset').click(function() {
            // hide validation error messages
            $("label.errortd[generated='true']").css('display', 'none');

            // 0 - view, 1 - edit, 2 - add
            var editMode = $("#frmSave").data('edit');
            if (editMode == 1) {
                unlockEducation($('#txtID').val());
                return false;
            }
            else {
                document.forms['frmSave'].reset('');
            }
        });

    });
</script>
