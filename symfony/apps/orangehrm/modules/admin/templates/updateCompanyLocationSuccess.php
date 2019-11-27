<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.validate.js') ?>"></script>
<div class="formpage">
    <div class="navigation">
        <input type="button" class="backbutton" id="btnBack"
               value="<?php echo __("Back") ?>" tabindex="12" />
    </div>
    <div id="status"></div>
    <div class="outerbox">
        <div class="mainHeading"><h2><?php echo __("Company Info : Locations") ?></h2></div>
        <form name="frmSave" id="frmSave" method="post"  action="">
            <label for="txtLocationCode"><?php echo __("Code") ?><span class="required">*</span></label>
            <span class="formValue"><?php echo $companyLocation->getLocCode() ?></span>
            <br class="clear"/>

            <label for="txtLocationCode"><?php echo __("Name") ?><span class="required">*</span></label>
            <input id="txtName"  name="txtName" type="text"  class="formInputText required" value="<?php echo $companyLocation->getLocName() ?>" tabindex="1" />
            <br class="clear"/>
            <label for="cmbCountry"><?php echo __("Country") ?><span class="required">*</span></label>
            <select id='cmbCountry' name='cmbCountry'  class="formSelect countrySelect" tabindex="2">
                <option value="">--- <?php echo __("--Select--") ?> ---</option>
                <?php foreach ($countryList as $country) {
 ?>
                    <option value="<?php echo $country->getCouCode() ?>" <?php if ($country->getCouCode() == $companyLocation->getLocCountry()) {
                        echo "selected";
                    } ?> ><?php echo $country->name ?></option>
<?php } ?>
            </select>
            <br class="clear"/>
            <label for="txtState"><?php echo __("State / Province") ?></label>
            <input id="txtState"  name="txtState" type="text"  class="formInputText" value="<?php echo $companyLocation->getLocState() ?>" tabindex="3" />
            <br class="clear"/>

            <label for="txtCity"><?php echo __("City") ?></label>
            <input id="txtCity"  name="txtCity" type="text"  class="formInputText" value="<?php echo $companyLocation->getLocCity() ?>" tabindex="4" />
            <br class="clear"/>

            <label for="txtAddress"><?php echo __("Address") ?><span class="required">*</span></label>
            <textarea id='txtAddress' name='txtAddress' class="formTextArea"
                      rows="3" cols="20" tabindex="5"><?php echo $companyLocation->getLocAdd() ?></textarea>
            <br class="clear"/>

            <label for="txtZipCode"><?php echo __("ZIP Code") ?><span class="required">*</span></label>
            <input id="txtZipCode"  name="txtZipCode" type="text"  class="formInputText" value="<?php echo $companyLocation->getLocZip() ?>" tabindex="6" />
            <br class="clear"/>

            <label for="txtPhone"><?php echo __("Phone") ?></label>
            <input id="txtPhone"  name="txtPhone" type="text"  class="formInputText" value="<?php echo $companyLocation->getLocPhone() ?>" tabindex="7" />
            <br class="clear"/>

            <label for="txtFax"><?php echo __("Fax") ?></label>
            <input id="txtFax"  name="txtFax" type="text"  class="formInputText" value="<?php echo $companyLocation->getLocFax() ?>" tabindex="8" />
            <br class="clear"/>

            <label for="txtComments"><?php echo __("Comments") ?></label>
            <textarea id='txtComments' name='txtComments' class="formTextArea"
                      rows="3" cols="20" tabindex="9"><?php echo $companyLocation->getLocComments() ?></textarea>
            <br class="clear"/>

            <div class="formbuttons">
                <input type="button" class="savebutton" id="editBtn"

                       value="<?php echo __("Edit") ?>" tabindex="10" />
                <input type="button" class="clearbutton"  id="resetBtn"
                       value="<?php echo __("Reset") ?>" tabindex="11" />
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

        $.validator.addMethod("phoneNumber", function(value, element) {
            return this.optional(element) || /^[0-9\-\+]+$/i.test(value);
        });
		 	
        //Validate the form
        $("#frmSave").validate({
				
            rules: {
                txtName: { required: true },
                cmbCountry: { required: true },
                txtAddress: { required: true },
                txtZipCode: { required: true },
                txtPhone: { phoneNumber: true },
                txtFax : { phoneNumber: true }
            },
            messages: {
                txtName: "<?php echo __("Name is required") ?>",
                cmbCountry: "<?php echo __("Country is required") ?>",
                txtAddress: "<?php echo __("Address is required") ?>",
                txtZipCode: "<?php echo __("Zip Code is required") ?>",
                txtPhone: "<?php echo __("Invalid Phone number") ?>",
                txtFax: "<?php echo __("Invalid Fax number") ?>"
            },
              submitHandler: function(form) {
                $('#editBtn').unbind('click').click(function() {return false}).val("<?php echo __('Wait..'); ?>");
                form.submit();
            }
        });

        //When click edit button
        $("#editBtn").click(function() {
            if( mode == 'edit')
            {
                $('#editBtn').attr('value', '<?php echo __("Save") ?>');
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
            location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/admin/listCompanylocation')) ?>";
        });
    });
</script>
