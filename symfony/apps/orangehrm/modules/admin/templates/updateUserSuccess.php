<?php
if ($lockMode == '1') {
    $editMode = false;
    $disabled = '';
} else {
    $editMode = true;
    $disabled = 'disabled="disabled"';
}
?>
<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.autocomplete.js') ?>"></script>
<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.validate.js') ?>"></script>
<link href="<?php echo public_path('../../themes/orange/css/jquery/jquery.autocomplete.css') ?>" rel="stylesheet" type="text/css"/>
<script type="text/javascript">
 
  
</script>
<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.validate.js') ?>"></script>
<div class="formpage2col" style="width: 650px;">
    <div class="navigation">

    </div>
    <div id="status"></div>
    <div class="outerbox">
        <div class="mainHeading">
            <h2>

                <?php echo __("Users") ?>

            </h2>
        </div>
        <?php echo message() ?>
                <form name="frmSave" id="frmSave" method="post"  action="">
            <?php echo $form['_csrf_token']; ?>
                <input type="hidden" name="isAdmin" value="<?php echo $userType ?>">
                <label for="txtUserName"><?php echo __("Code") ?><span class="required">*</span></label>
                <span class="formValue"><?php echo $user->getId() ?></span>
                <br class="clear"/>
                <div>
                    <label for="txtUserEmpID"><?php echo __("Employee") ?><span class="required">*</span></label>
                    <input tabindex="3" type="text" value="<?php echo $user->getEmployee()->getFirstName() . ' ' . $user->getEmployee()->getLastName() ?>" class="formInputText" tabindex="4" name="txtEmployee" id="txtEmployee" readonly="readonly" />
                    <input type="hidden" name="txtEmpId" id="txtEmpId" value="<?php echo $user->getEmployee()->getEmpNumber() ?>">
                </div>
                <br class="clear"/>
                <label for="txtUserName"><?php echo __("User login ID") ?><span class="required">*</span></label>
                <input type="text" value="<?php echo $user->getUserName() ?>" class="formInputText" tabindex="1" name="txtUserName" id="txtUserName" readonly="readonly"/>
                <br class="clear"/>


                <label for="cmbUserStatus"><?php echo __("Status") ?></label>
                <select tabindex="2" class="formSelect" name="cmbUserStatus" id="cmbUserStatus">
                    <option value="Enabled" <?php
                if ($user->getStatus() == 'Enabled') {
                    echo "selected";
                }
            ?>><?php echo __("Enabled") ?></option>
                <option value="Disabled" <?php
                if ($user->getStatus() == 'Disabled') {
                    echo "selected";
                }
            ?>><?php echo __("Disabled") ?></option>
            </select>

            <input type="hidden" value="" id="cmbUserEmpID" name="cmbUserEmpID"/>
            <br class="clear"/>

            <label for="lblLevel"><?php echo __("Security Level") ?></label>

            <select tabindex="4" class="formSelect" name="cmbLevel" id="cmbLevel">
                        <option value=""><?php echo __("--Select--"); ?></option>
                        <option value="1" <?php if($user->def_level ==1) echo "selected"; ?>><?php echo __("National Level"); ?></option>
                        <option value="2"<?php if($user->def_level ==2) echo "selected"; ?>><?php echo __("District Level"); ?></option>
                        <option value="3"<?php if($user->def_level ==3) echo "selected"; ?>><?php echo __("Divisional Level"); ?></option>
                        <option value="4"<?php if($user->def_level ==4) echo "selected"; ?>><?php echo __("ESS Level"); ?></option>
            </select>

       

            <br class="clear"/>


            <label for="cmbUserGroupID"><?php echo __("Capability") ?><span class="required">*</span></label>
            <select class="formSelect"  id="cmbCapbilityName" name="cmbCapbilityName"><span class="required">*</span>
                <option value=""><?php echo __("--Select--"); ?></option>
                <?php
                //Define data columns according culture

                $capeNameCol = ($userCulture == "en") ? "getSm_capability_name" : "getSm_capability_name_" . $userCulture;

                if ($capabilityList) {
                    foreach ($capabilityList as $cape) {
                        $selected = ($user->getSm_capability_id() == $cape->getSm_capability_id()) ? 'selected="selected"' : '';
                        $capeName = $cape->$capeNameCol() == "" ? $cape->getSm_capability_name() : $cape->$capeNameCol();
                        echo "<option {$selected} value='{$cape->getSm_capability_id()}'>{$capeName}</option>";
                    }
                }
                ?>

            </select>
            <br class="clear"/>

            <div class="formbuttons">
                <input type="button" class="<?php echo $editMode ? 'editbutton' : 'savebutton'; ?>" name="EditMain" id="editBtn"
                       value="<?php echo $editMode ? __("Edit") : __("Save"); ?>"
                       title="<?php echo $editMode ? __("Edit") : __("Save"); ?>"
                       onmouseover="moverButton(this);" onmouseout="moutButton(this);"/>
                <input type="reset" class="clearbutton" id="btnClear" tabindex="5"
                       onmouseover="moverButton(this);" onmouseout="moutButton(this);"	<?php echo $disabled; ?>
                       value="<?php echo __("Reset"); ?>" />
                <input type="button" class="backbutton" id="btnBack"
                       value="<?php echo __("Back") ?>" tabindex="8" />
            </div>
        </form>


    </div>
    <div class="requirednotice"><?php echo preg_replace('/#star/', '<span class="required">*</span>', __("Fields marked with an asterisk #star are required.")); ?>.</div>
</div>

<script type="text/javascript">

    $(document).ready(function() {
		  
        buttonSecurityCommon(null,null,"editBtn",null);

<?php if ($editMode == true) { ?>
            $('#frmSave :input').attr('disabled', true);
            $('#editBtn').removeAttr('disabled');
            $('#btnBack').removeAttr('disabled');
<?php } ?>

        //var data	= <?php //echo str_replace('&#039;', "'", $empJson) ?> ;
			


        // When click edit button
        $("#frmSave").data('edit', <?php echo $editMode ? '1' : '0' ?>);

        $("#editBtn").click(function() {

            var editMode = $("#frmSave").data('edit');

            if (editMode == 1) {
                // Set lock = 1 when requesting a table lock

                location.href="<?php echo url_for('admin/updateUser?lock=1&id=' . $user->getId()); ?>";
            }
            else {

                $('#frmSave').submit();
            }


        });


        //Disable all fields
			
			
        //Validate the form
        $("#frmSave").validate({

            rules: {
                txtUserName: { required: true, minlength: 5},
                cmbCapbilityName: { required: true },
                cmbUserStatus: { required: true },
                cmbLevel:{ required: true }
            },
            messages: {
                txtUserName:
                    {
                    required: "<?php echo __("User Name is required") ?>",
                    minlength: "<?php echo __("User Name should be at least five characters long") ?>"
                },
                cmbCapbilityName: "<?php echo __("This field is required.") ?>",
                cmbUserStatus: { required: "<?php echo __("This field is required.") ?>" },
                cmbLevel:{required: "<?php echo __("This field is required.") ?>"}

            },
            submitHandler: function(form) {
                $('#editBtn').unbind('click').click(function() {return false}).val("<?php echo __('Wait..'); ?>");
                form.submit();
            }
        });

			

        //When click reset buton
        $("#btnClear").click(function() {
            location.href="<?php echo url_for('admin/updateUser?lock=0&id=' . $user->getId()); ?>";
        });
				 
        //When Click back button
        $("#btnBack").click(function() {
            location.href = "<?php echo url_for("admin/listUser") ?>";
        });

        //Auto complete
        $("#txtEmployee").autocomplete(data, {
            formatItem: function(item) {
                return item.name;
            }
        }).result(function(event, item) {
            $('#txtEmpId').val(item.id);
        });
			
			
			  
    });
</script>
