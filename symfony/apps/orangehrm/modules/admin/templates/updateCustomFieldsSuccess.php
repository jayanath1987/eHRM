<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.validate.js') ?>"></script>
<div class="formpage">
    <div class="navigation">
        <input type="button" class="backbutton" id="btnBack"
               value="<?php echo __("Back") ?>" tabindex="6" />
    </div>
    <div id="status"></div>
    <?php echo message() ?>
    <div class="outerbox">
        <div class="mainHeading"><h2><?php echo __("Custom Fields") ?></h2></div>
        <form name="frmSave" id="frmSave" method="post"  action="">
            <?php echo $form['_csrf_token']; ?>
            <label for="cmbCustomerId"><?php echo __("Field Number") ?> </label>
            <input id="Id" type="hidden" value="<?php echo $customFields->getFieldNum() ?>" name="Id"/>
            <span class="formValue"><?php echo $customFields->getFieldNum() ?></span>

            <br class="clear"/>
            <label for="txtName"><?php echo __("Field Name") ?> <span class="required">*</span></label>
            <input id="txtName"  name="txtName" type="text"  class="formInputText"  tabindex="1" value="<?php echo $customFields->getName() ?>" />
            <br class="clear"/>
            <label for="cmbCustomerId"><?php echo __("Type") ?><span class="required">*</span></label>
            <select tabindex="2" class="formSelect" id="cmbType" name="cmbType">
                <option value="0" <?php if ($customFields->getType() == 0) {
                echo 'selected';
            } ?>><?php echo __("String") ?></option>
                <option value="1" <?php if ($customFields->getType() == 1) {
                echo 'selected';
            } ?>><?php echo __("Drop Down") ?></option>
            </select>
            <br class="clear"/>
            <div class="<?php if ($customFields->getType() == 0) {
                echo 'hide';
            } else {
                echo 'show';
            } ?>" id="selectOptions">
                <label for="txtExtra">Select Options <span class="required">*</span>
                </label>
                <input type="text" value="<?php echo $customFields->getExtraData() ?>" class="formInputText" tabindex="3" name="txtExtra" id="txtExtra" />
                <div class="fieldHint">Enter allowed options separated by commas</div>
            </div>
            <br class="clear"/>
            <div class="formbuttons">
                <input type="button" class="savebutton" id="editBtn" value="<?php echo __("Edit") ?>" tabindex="4" />
                <input type="button" class="clearbutton" id="resetBtn"
                       value="<?php echo __("Reset") ?>" tabindex="5" />
            </div>
        </form>
    </div>

</div>

<script type="text/javascript">

    $(document).ready(function() {
        var mode	=	'edit';
			
        //Disable all fields
        $('#frmSave :input').attr('disabled', true);
        $('#editBtn').removeAttr('disabled');
			
        //Validate the form
        $("#frmSave").validate({
				
            rules: {
                txtName: { required: true }
				 	
            },
            messages: {
                txtName: "<?php echo __("Field Name is required") ?>"
			 		
            },
              submitHandler: function(form) {
                $('#editBtn').unbind('click').click(function() {return false}).val("<?php echo __('Wait..'); ?>");
                form.submit();
            }
        });
			 
        //When Changing drop down
        $("#cmbType").change(function() {
            if( $("#cmbType").val() == 0)
            {
                $("#selectOptions").hide();
            }else
            {
                $("#selectOptions").show();
            }
				
        });
				
        // When click edit button
        $("#editBtn").click(function() {
            if( mode == 'edit')
            {
                $('#editBtn').attr('value', 'Save');
                $('#frmSave :input').removeAttr('disabled');
                mode = 'save';
            }else
            {
                $('#frmSave').submit();
            }
        });

        //When click reset buton
        $("#resetBtn").click(function() {
            document.forms[0].reset('');
        });

        //When Click back button
        $("#btnBack").click(function() {
            location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/admin/listCustomFields')) ?>";
        });
				
    });
</script>
