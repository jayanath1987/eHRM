<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.autocomplete.js') ?>"></script>
<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.validate.js') ?>"></script>
<link href="<?php echo public_path('../../themes/orange/css/jquery/jquery.autocomplete.css') ?>" rel="stylesheet" type="text/css"/>
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
                    <div>
                        <label for="txtUserEmpID"><?php echo __("Employee") ?><span class="required">*</span></label>
                        <input type="text" value="" class="formInputText" tabindex="5" name="txtEmployee" id="txtEmployee" />
                        <input type="hidden" name="txtEmpId" id="txtEmpId" value="">
                    </div>
                    <br class="clear"/>
                    <input type="hidden" name="isAdmin" value="<?php echo $userType ?>">
                    <label for="txtUserName"><?php echo __("User Name") ?><span class="required">*</span></label>
                    <input type="text" value="" class="formInputText" tabindex="1" name="txtUserName" id="txtUserName"/>
                    <br class="clear"/>

        <!--                    <label for="txtUserPassword"><?php echo __("Password") ?><span class="required">*</span></label>
                            <input type="password" tabindex="2" class="formInputText" name="txtUserPassword" id="txtUserPassword"/>
                            <br class="clear"/>
                            <label for="txtUserConfirmPassword"><?php echo __("Confirm Password") ?><span class="required">*</span></label>
                            <input type="password" tabindex="3" class="formInputText" name="txtUserConfirmPassword" id="txtUserConfirmPassword"/>
                            <br class="clear"/>-->

                    <label for="cmbUserStatus"><?php echo __("Status") ?></label>
                    <select tabindex="4" class="formSelect" name="cmbUserStatus" id="cmbUserStatus">
                        <option value="Enabled"><?php echo __("Enabled") ?></option>
                        <option value="Disabled"><?php echo __("Disabled") ?></option>
                    </select>
                    <br class="clear"/>
                    <label for="lblLevel"><?php echo __("Security Level") ?></label>
            <select tabindex="4" class="formSelect" name="cmbLevel" id="cmbLevel">
                        <option value=""><?php echo __("--Select--"); ?></option>
                        <option value="1"><?php echo __("National Level"); ?></option>
                        <option value="2"><?php echo __("District Level"); ?></option>
                        <option value="3"><?php echo __("Divisional Level"); ?></option>
                        <option value="4"><?php echo __("ESS Level"); ?></option>
            </select>
            <input type="hidden" value="" id="cmbUserEmpID" name="cmbUserEmpID"/>



            <br class="clear"/>


            <label for="cmbUserGroupID"><?php echo __("Capability") ?><span class="required">*</span></label>
            <select class="formSelect"  id="cmbCapbilityName" name="cmbCapbilityName"><span class="required">*</span>
                <option value=""><?php echo __("--Select--"); ?></option>
                <?php
                //Define data columns according culture

                $capeNameCol = ($userCulture == "en") ? "getSm_capability_name" : "getSm_capability_name_" . $userCulture;

                if ($capabilityList) {
                    //$current =$employee->emp_status;
                    foreach ($capabilityList as $cape) {
                        $selected = ($capabilityID == $cape->getSm_capability_id()) ? 'selected="selected"' : '';
                        $capeName = $cape->$capeNameCol() == "" ? $cape->getSm_capability_name() : $cape->$capeNameCol();
                        echo "<option {$selected} value='{$cape->getSm_capability_id()}'>{$capeName}</option>";
                    }
                }
                ?>

            </select>


            <br class="clear"/>

            <div class="formbuttons">
                <input type="button" class="savebutton" id="editBtn"

                       value="<?php echo __("Save") ?>" tabindex="7" />
                <input type="button" class="clearbutton"  id="resetBtn"
                       value="<?php echo __("Reset") ?>" tabindex="8" />
                <input type="button" class="backbutton" id="btnBack"
                       value="<?php echo __("Back") ?>" tabindex="9" />
            </div>
        </form>


    </div>
    <div class="requirednotice"><?php echo preg_replace('/#star/', '<span class="required">*</span>', __("Fields marked with an asterisk #star are required.")); ?>.</div>
</div>

<script type="text/javascript">

    $(document).ready(function() {
		  
        buttonSecurityCommon(null,"editBtn",null,null);

        var data	= <?php echo str_replace('&#039;', "'", $empJson) ?> ;

        //Validate the form
        $("#frmSave").validate({
				
            rules: {
                txtUserName: { required: true, minlength: 5, onlytext : true },
                                        
                txtUserPassword: { required: true, minlength: 4 },
                txtUserConfirmPassword: { required: true,samepwd: true },
                txtEmpId: { required: true },
                cmbCapbilityName: { required: true }
            },
            messages: {
                txtUserName:
                    {
                    required: "<?php echo __("User Name is required") ?>",
                    minlength: "<?php echo __("User Name should be at least five characters long") ?>",
                    onlytext : "<?php echo __("Invalid character in the User Name") ?>"
                },
                txtUserPassword:
                    {
                    required: "<?php echo __("Password is required") ?>",
                    minlength: "<?php echo __("Password should be at least four characters long") ?>"
                },
                txtUserConfirmPassword:
                    {
                    required: "<?php echo __("Confirm Password is required") ?>",
                    samepwd: "<?php echo __("Password not match") ?>"
                },
			 		
                txtEmpId: "<?php echo __("Valid Employee is required") ?>" ,
                cmbCapbilityName: "<?php echo __("This field is required") ?>"
            },

            submitHandler: function(form) {
                $('#editBtn').unbind('click').click(function() {return false}).val("<?php echo __('Wait..'); ?>");
                form.submit();
            }
        });

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
            location.href = "<?php echo url_for("admin/listUser?isAdmin=" . $userType) ?>";
        });

        //Auto complete
        $("#txtEmployee").autocomplete(data, {
            formatItem: function(item) {
                return item.name;
            }
        }).result(function(event, item) {
            $('#txtEmpId').val(item.id);
        });

        //Add custom function to validator
        $.validator.addMethod("samepwd", function(value, element) {
            return (value == $('#txtUserPassword').val());
        });

        $.validator.addMethod("onlytext", function(value, element) {
            var pattern = /^[a-zA-Z0-9\-_.]*$/;
            var regExp = new RegExp(pattern);
            return regExp.test($('#txtUserName').val());

        });

                
    });


</script>
