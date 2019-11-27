<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.validate.js') ?>"></script>
<div class="formpage4col">
    <div class="navigation">
        <?php echo message() ?>
    </div>
    <div id="status"></div>
    <div class="outerbox">
        <div class="mainHeading"><h2><?php echo __("Change Password") ?></h2></div>
        <form name="frmSave" id="frmSave" method="post"  action="">

            <div class="leftCol">
                <label class="controlLabel" for="txtLocationCode"><?php echo __("Current Password") ?> <span class="required">*</span></label>
            </div>
            <div class="centerCol">
                <input  id="txtCurrentPwd"  name="txtCurrentPwd" type="password"  class="formInputText" value="" tabindex="1" maxlength="30"/>
            </div>
            <br class="clear"/>
            <div class="leftCol">
                <label class="controlLabel" for="txtLocationCode"><?php echo __("New Password") ?> <span class="required">*</span></label>
            </div>
            <div class="centerCol">
                <input  id="txtNewPwd" name="txtNewPwd" type="password"  class="formInputText" value="" tabindex="1" maxlength="30"/>
            </div>
            <br class="clear"/>
            <div class="leftCol">
                <label class="controlLabel" for="txtLocationCode"><?php echo __("Confirm Password") ?> <span class="required">*</span></label>
            </div>
            <div class="centerCol">
                <input id="txtConfirmNewPwd"  name="txtConfirmNewPwd" type="password"  class="formInputText" value="" tabindex="1" maxlength="30"/>
            </div>
            <br class="clear"/>
            <div class="formbuttons">
                <input type="button" class="savebutton" id="editBtn"

                       value="<?php echo __("Edit") ?>" tabindex="8" />
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

                txtCurrentPwd: { required: true,maxlength: 75 },
                txtNewPwd: { required: true,maxlength: 75},
                txtConfirmNewPwd: { required: true,maxlength: 75 }

            },
            messages: {
                txtCurrentPwd:{required:"<?php echo __('This field is required') ?>",maxlength: "<?php echo __('Maximum length should be 75 characters') ?>"},
                txtNewPwd:{required:"<?php echo __('This field is required') ?>",maxlength: "<?php echo __('Maximum length should be 75 characters') ?>"},
                txtConfirmNewPwd:{required:"<?php echo __('This field is required') ?>",maxlength: "<?php echo __('Maximum length should be 75 characters') ?>"}

            }
        });

        var mode	=	'edit';

        //Disable all fields
        $('#frmSave :input').attr('disabled', true);
        $('#editBtn').removeAttr('disabled');
        $("#editBtn").click(function() {

            if( mode == 'edit')
            {


                $('#editBtn').attr('value', '<?php echo __("Save") ?>');
                $('#frmSave :input').removeAttr('disabled');
                mode = 'save';

            }
            else
            {
               
                if($('#txtNewPwd').val()!=$('#txtConfirmNewPwd').val()){

                    alert("<?php echo __('New password does not match please Type again') ?>");
                
                }else{
                    $('#frmSave').submit();
                }

            }
        });

        //When click reset buton
        $("#resetBtn").click(function() {
            document.forms[0].reset('');
        });

        //When Click back button
        $("#btnBack").click(function() {
            location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/training/defineinstitute')) ?>";
        });

    });
</script>
