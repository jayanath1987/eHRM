<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.validate.js') ?>"></script>
<div class="formpage">
    <div class="navigation">
        <input type="button" class="backbutton" id="btnBack"
               value="<?php echo __("Back") ?>" tabindex="4" />
    </div>
    <div id="status"></div>
    <div class="outerbox">
        <div class="mainHeading"><h2><?php echo __("Nationality & Race : Nationality") ?></h2></div>
        <form name="frmSave" id="frmSave" method="post"  action="">
            <?php echo $form['_csrf_token']; ?>
            <label for="txtSkillName"><?php echo __("Code") ?> </label>
            <span class="formValue"><?php echo $nationality->getNatCode() ?></span>
            <input id="Id" type="hidden" value="<?php echo $nationality->getNatCode() ?>" name="Id"/>
            <br class="clear"/>

            <label for="txtSkillName"><?php echo __("Name") ?> <span class="required">*</span></label>
            <input id="txtNationalityInfoDesc"  name="txtNationalityInfoDesc" type="text"  class="formInputText" value="<?php echo $nationality->getNatName() ?>" tabindex="1" />
            <br class="clear"/>

            <div class="formbuttons">
                <input type="button" class="savebutton" id="editBtn"

                       value="<?php echo __("Edit") ?>" tabindex="2" />
                <input type="button" class="clearbutton" id="resetBtn"
                       value="<?php echo __("Reset") ?>" tabindex="3" />
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
                txtNationalityInfoDesc: { required: true }
				
				 	
            },
            messages: {
                txtNationalityInfoDesc: "<?php echo __("Name is required") ?>"
			 		
            },
              submitHandler: function(form) {
                $('#editBtn').unbind('click').click(function() {return false}).val("<?php echo __('Wait..'); ?>");
                form.submit();
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

        //When Click back button
        $("#btnBack").click(function() {
            location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/admin/listNationality')) ?>";
        });

        //When click reset buton
        $("#resetBtn").click(function() {
            document.forms[0].reset('');
        });
				
    });
</script>
