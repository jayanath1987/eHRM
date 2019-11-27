<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.validate.js') ?>"></script>
<div class="formpage">
    <div class="navigation">
        <input type="button" class="backbutton" id="btnBack"
               value="<?php echo __("Back") ?>" tabindex="5" />
    </div>
    <div id="status"></div>
    <?php echo message() ?>
    <div class="outerbox">
        <div class="mainHeading"><h2><?php echo __("Memberships : Membership") ?></h2></div>
        <form name="frmSave" id="frmSave" method="post"  action="">
            <?php echo $form['_csrf_token']; ?>
            <label for="txtSkillName"><?php echo __("Code") ?> </label>
            <span class="formValue"><?php echo $membership->getMembshipCode() ?></span>
            <br class="clear"/>
            <label for="txtSkillName"><?php echo __("Name") ?> <span class="required">*</span></label>
            <input id="txtMembershipInfoDesc"  name="txtMembershipInfoDesc" type="text"  class="formInputText" value="<?php echo $membership->getMembshipName() ?>" tabindex="1" />
            <br class="clear"/>
            <label for="txtSkillDesc"><?php echo __("Membership Type") ?> <span class="required">*</span> </label>
            <select name="selMembershipType" id="selMembershipType" class="formSelect" tabindex="2">
                <option value="" selected="selected">Select Membership</option>
                <?php foreach ($listMembershipType as $membershipType) {
 ?>
                    <option value="<?php echo $membershipType->getMembtypeCode() ?>"<?php if ($membership->getMembtypeCode() == $membershipType->getMembtypeCode()) {
                        echo "selected";
                    } ?> ><?php echo $membershipType->getMembtypeName() ?></option>
<?php } ?>
            </select>
            <br class="clear"/>
            <div class="formbuttons">
                <input type="button" class="savebutton" id="editBtn"

                       value="<?php echo __("Edit") ?>" tabindex="3" />
                <input type="button" class="clearbutton" id="resetBtn"
                       value="<?php echo __("Reset") ?>" tabindex="4" />
            </div>
        </form>
    </div>
    <div class="requirednotice"><?php echo preg_replace('/#star/', '<span class="required">*</span>', __("Fields marked with an asterisk #star are required.")); ?>.</div>
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
                txtMembershipInfoDesc: { required: true },
                selMembershipType: { required: true }
				 	
            },
            messages: {
                txtMembershipInfoDesc: "<?php echo __("Name is required") ?>",
                selMembershipType:"<?php echo __("Membership Type is required") ?>"
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


        //When click reset buton
        $("#resetBtn").click(function() {
            document.forms[0].reset('');
        });

        //When Click back button
        $("#btnBack").click(function() {
            location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/admin/listMembership')) ?>";
        });
				
    });
</script>
