<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.validate.js') ?>"></script>


<div class="formpage4col">
    <div id="status"></div>
    <div class="outerbox">
        <div class="mainHeading" id="mainHeading"><h2><?php echo __("Company Info : General") ?></h2></div>
        <?php echo message() ?>
        <form name="frmGenInfo" id="frmGenInfo" method="post" onsubmit="" action="">

            <?php echo $form['_csrf_token']; ?>

            <input type="hidden" name="txtCode" value="<?php echo $company->getComCode() ?>" />

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
                <label for="txtCompanyName"><?php echo __("Company Name") ?><span class="required">*</span></label>
            </div>
            <div class="centerCol">
                <input id="txtCompanyName" name="txtCompanyName" type="text"
                       class="formInputText required"
                       value="<?php echo $companyStructure->getTitle() ?>" maxlength="200" tabindex="1"/>
            </div>
            <div class="centerCol">
                <input id="txtCompanyNameSI" name="txtCompanyNameSI" type="text" class="formInputText"
                       value="<?php echo $companyStructure->getTitleSI() ?>" maxlength="200" tabindex="1"/>
            </div>
            <div class="centerCol">
                <input id="txtCompanyNameTA" name="txtCompanyNameTA" type="text" class="formInputText"
                       value="<?php echo $companyStructure->getTitleTA() ?>" maxlength="200" tabindex="1"/>
            </div>
            <br class="clear"/>

            <div class="leftCol">
                <label for="txtUnitHead"><?php echo __("Company Head") ?></label>
            </div>
            <input id="txtUnitHead" value="<?php echo $employeeName ?>" readonly="readonly" type="text" name="txtUnitHead" class="formInputText" style="width:300px;"/>
            <input type="hidden" name="txtUnitHeadEmpId" id="txtUnitHeadEmpId" value="<?php echo $companyStructure->getEmpNumber() ?>"/>
            <input class="button" type="button" value="..." id="empSearchPopBtn" tabindex="2" style="margin-top:10px;margin-left:10px;" />
            <br class="clear"/>

            <div class="leftCol">
                <label for="txtAddress"><?php echo __("Address") ?></label>
            </div>
            <div class="centerCol">
                <textarea id='txtAddress' name='txtAddress'  class="formTextArea"
                          rows="3" cols="20" tabindex="3" ><?php echo $companyStructure->getAddress() ?></textarea>
            </div>
            <div class="centerCol">
                <textarea id='txtAddressSI' name='txtAddressSI'  class="formTextArea"
                          rows="3" cols="20" tabindex="3" ><?php echo $companyStructure->getAddressSI() ?></textarea>
            </div>
            <div class="centerCol">
                <textarea id='txtAddressTA' name='txtAddressTA'  class="formTextArea"
                          rows="3" cols="20" tabindex="3" ><?php echo $companyStructure->getAddressTA() ?></textarea>
            </div>
            <br class="clear"/>

            <div class="leftCol">
                <label for="cmbCountry"><?php echo __("Country") ?></label>
            </div>
            <div class="centerCol">
                <select id='cmbCountry' name='cmbCountry'  class="formSelect countrySelect" tabindex="4">
                    <option value="0">--- <?php echo __("--Select--") ?> ---</option>
                    <?php foreach ($countryList as $country) {
 ?>
                        <option value="<?php echo $country->cou_code ?>" <?php if ($company->getCountry() == $country->cou_code) {
 ?>selected="selected"<?php } ?>><?php if ($country->$countryName == "")
                            echo $country->cou_name; else
                            echo $country->$countryName; ?></option>
<?php } ?>
                </select>
            </div>
            <br class="clear"/>

            <div class="leftCol">
                <label for="txtPhoneIntercom"><?php echo __("Telephone (Intercom)") ?></label>
            </div>
            <div class="centerCol">
                <input id='txtPhoneIntercom' name='txtPhoneIntercom' type="text"  class="formInputText"
                       value="<?php echo $companyStructure->getPhoneIntercom() ?>" maxlength="30" tabindex="5"/>
            </div>
            <div class="centerCol">
                <label for="txtPhoneVIP"><?php echo __("Telephone (VIP)") ?></label>
            </div>
            <div class="centerCol">
                <input id='txtPhoneVIP' name='txtPhoneVIP' type="text"  class="formInputText"
                       value="<?php echo $companyStructure->getPhoneVIP() ?>" maxlength="30" tabindex="5"/>
            </div>
            <br class="clear"/>

            <div class="leftCol">
                <label for="txtPhoneDirectLine"><?php echo __("Telephone (Direct Line)") ?></label>
            </div>
            <div class="centerCol">
                <input id='txtPhoneDirectLine' name='txtPhoneDirectLine' type="text"  class="formInputText"
                       value="<?php echo $companyStructure->getPhoneDirectLine() ?>" maxlength="30" tabindex="5"/>
            </div>

            <div class="centerCol">
                <label for="txtPhoneExtension"><?php echo __("Telephone (Extension)") ?></label>
            </div>
            <div class="centerCol">
                <input id='txtPhoneExtension' name='txtPhoneExtension' type="text"  class="formInputText"
                       value="<?php echo $companyStructure->getPhoneExtension() ?>" maxlength="30" tabindex="5"/>
            </div>
            <br class="clear"/>

            <div class="leftCol">
                <label for="txtFax"><?php echo __("Fax") ?></label>
            </div>
            <div class="centerCol">
                <input id="txtFax" name="txtFax" type="text"   class="formInputText"
                       value="<?php echo $companyStructure->getFax() ?>" maxlength="30" tabindex="6"/>
            </div>
            <br class="clear"/>

            <div class="leftCol">
                <label for="txtEmail"><?php echo __("Email") ?></label>
            </div>
            <div class="centerCol">
                <input type="text" name="txtEmail" id="txtEmail" class="formInputText" style="width:300px;"
                       value="<?php echo $companyStructure->getEmail() ?>" maxlength="100" tabindex="7"/>
            </div>
            <br class="clear"/>

            <div class="leftCol">
                <label for="txtURL"><?php echo __("URL") ?></label>
            </div>
            <div class="centerCol">
                <input type="text" name="txtURL" id="txtURL" class="formInputText" style="width:300px;"
                       value="<?php echo $companyStructure->getURL() ?>" maxlength="200" tabindex="7"/>
            </div>
            <br class="clear"/>

            <div class="formbuttons" >

                <input type="button" class="editbutton" id="btnEdit"
                       onmouseover="moverButton(this);" onmouseout="moutButton(this);"
                       value="<?php echo __("Edit") ?>" tabindex="8" />
                <input type="button" class="clearbutton"   id="btnReset"
                       onmouseover="moverButton(this);" onmouseout="moutButton(this);"
                       value="<?php echo __("Reset") ?>" tabindex="9" />

            </div>
            <div class="requirednotice"><?php echo __("Fields marked with an asterisk") ?><span class="required"> * </span> <?php echo __("are required") ?></div>
        </form>
    </div>

    <div class="requirednotice"></div>
</div>

<script type="text/javascript" language="javascript" >

    
    function SelectEmployee(data){
        myArr = data.split('|');
        $("#txtUnitHeadEmpId").val(myArr[0]);
        $("#txtUnitHead").val(myArr[1]);
    }

    function getCompanyDetails(id){
        $.post("<?php echo url_for('admin/GetCompanyDetailsById') ?>",
        { id: id },
        function(data){
            setCompanyDetails(data);
        },
        "json"
    );
    }

    function lockCompanyDetails(id){
        $.post("<?php echo url_for('admin/lockCompanyDetails') ?>",
        { id: id },
        function(data){
            if (data.recordLocked==true) {
                getCompanyDetails(id);
                $("#frmGenInfo").data('edit', '1'); // In edit mode
                setCompanyDetailsAttributes();
            }else {
                alert("<?php echo __("Record Locked.") ?>");
            }
        },
        "json"
    );
    }

    function unlockCompanyDetails(id){
        $.post("<?php echo url_for('admin/unlockCompanyDetails') ?>",
        { id: id },
        function(data){
            getCompanyDetails(id);
            $("#frmGenInfo").data('edit', '0'); // In view mode
            setCompanyDetailsAttributes();
        },
        "json"
    );
    }

    function setCompanyDetails(data){

        $("#txtCompanyName").val((data.title==null)? '':data.title);
        $("#txtCompanyNameSI").val((data.title_si==null)? '' :data.title_si);
        $("#txtCompanyNameTA").val((data.title_ta==null)? '' :data.title_ta);
        $("#txtUnitHeadEmpId").val((data.emp_number==null)? '' :data.emp_number);
        $("#txtAddress").val((data.address==null)? '': data.address);
        $("#txtAddressSI").val((data.address_si==null)? '':data.address_si);
        $("#txtAddressTA").val((data.address_ta==null)? '':data.address_ta);
        $("#txtPhoneIntercom").val((data.phone_intercom==null)? '' :data.phone_intercom);
        $("#txtPhoneVIP").val((data.phone_vip==null)? '' :data.phone_vip);
        $("#txtPhoneDirectLine").val((data.phone_direct_line==null)? '':data.phone_direct_line);
        $("#txtPhoneExtension").val((data.phone_extension==null)? '' :data.phone_extension);
        $("#txtFax").val((data.fax==null)?'' :data.fax);
        $("#txtEmail").val((data.email==null)? '' :data.email);
        $("#txtURL").val((data.url==null)? '':data.url);
    }

    function setCompanyDetailsAttributes() {

        var editMode = $("#frmGenInfo").data('edit');
        if (editMode == 0) {
            $('#frmGenInfo :input').attr('disabled','disabled');
            $('#btnEdit').removeAttr('disabled');

            $("#btnEdit").attr('value',"<?php echo __("Edit"); ?>");
            $("#btnEdit").attr('title',"<?php echo __("Edit"); ?>");
        }
        else {
            $('#frmGenInfo :input').removeAttr('disabled');

            $("#btnEdit").attr('value',"<?php echo __("Save"); ?>");
            $("#btnEdit").attr('title',"<?php echo __("Save"); ?>");
        }
    }

    $(document).ready(function()
    {
        buttonSecurityCommon(null,null,"btnEdit",null);
        
        $("#frmGenInfo").data('edit', '0'); // In view mode
        setCompanyDetailsAttributes();

        // hide validation error messages
        $("label.errortd[generated='true']").css('display', 'none');

        // Switch edit mode or submit data when edit/save button is clicked
        $("#btnEdit").click(function() {

            var editMode = $("#frmGenInfo").data('edit');
            if (editMode == 0) {
                lockCompanyDetails('1');
                return false;
            }
            else {
                $('#frmGenInfo').submit();
            }
        });

        $('#btnReset').click(function() {
            // hide validation error messages
            $("label.errortd[generated='true']").css('display', 'none');

            // 0 - view, 1 - edit, 2 - add
            var editMode = $("#frmGenInfo").data('edit');
            if (editMode == 1) {
                unlockCompanyDetails('1');
                location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/admin/companygeninfo')) ?>";
                return false;
            }
            else {
                document.forms['frmGenInfo'].reset('');
            }
        });
		
        //When click employee selection button
        $('#empSearchPopBtn').click(function() {
         //   var popup=window.open('<?php //echo public_path('../../symfony/web/index.php/pim/searchEmployee?type=single&amp;method=SelectEmployee'); ?>','Locations','height=450,width=800,resizable=1,scrollbars=1');
         var popup=window.open('<?php echo public_path('../../symfony/web/index.php/pim/searchEmployee?type=single&method=SelectEmployee'); ?>','Locations','height=450,width=800,resizable=1,scrollbars=1');
            if(!popup.opener) popup.opener=self;
            popup.focus();
        });   	
	
        $("#frmGenInfo").validate({
            rules: {
                txtCompanyName: { required: true, noSpecialCharsOnly: true,maxlength: 200 },
                txtCompanyNameSI: { noSpecialCharsOnly: true,maxlength: 200 },
                txtCompanyNameTA: { noSpecialCharsOnly: true,maxlength: 200 },
                txtAddress : {noSpecialCharsOnly: true,maxlength: 200 },
                txtAddressSI : {noSpecialCharsOnly: true,maxlength: 200 },
                txtAddressTA : {noSpecialCharsOnly: true,maxlength: 200 },
                txtPhoneIntercom: { phone: true },
                txtPhoneVIP: { phone: true },
                txtPhoneDirectLine: { phone: true },
                txtPhoneExtension: { phone: true },
                txtFax : { phone: true },
                txtEmail: { email: true },
                txtURL: {url: true}
            },
            messages: {
                txtCompanyName: { required: "<?php echo __('This field is required.') ?>", noSpecialCharsOnly: "<?php echo __('Special Characters are not allowed') ?>",maxlength:"<?php echo __("Maximum 200 Characters") ?>" },
                txtCompanyNameSI: { noSpecialCharsOnly: "<?php echo __('Special Characters are not allowed') ?>",maxlength:"<?php echo __("Maximum 200 Characters") ?>" },
                txtCompanyNameTA: { noSpecialCharsOnly: "<?php echo __('Special Characters are not allowed') ?>",maxlength:"<?php echo __("Maximum 200 Characters") ?>" },
                txtAddress: { maxlength:"<?php echo __("Maximum 200 Characters") ?>" , noSpecialCharsOnly: "<?php echo __('Special Characters are not allowed') ?>" },
                txtAddressSI: { maxlength:"<?php echo __("Maximum 200 Characters") ?>" , noSpecialCharsOnly: "<?php echo __('Special Characters are not allowed') ?>" },
                txtAddressTA: { maxlength:"<?php echo __("Maximum 200 Characters") ?>" , noSpecialCharsOnly: "<?php echo __('Special Characters are not allowed') ?>" },
                txtPhoneIntercom: "<?php echo __("Invalid Telephone (Intercom) number") ?>",
                txtPhoneVIP: "<?php echo __("Invalid Telephone (VIP) number") ?>",
                txtPhoneDirectLine: "<?php echo __("Invalid Telephone (Direct Line) number") ?>",
                txtPhoneExtension: "<?php echo __("Invalid Telephone (Extension) number") ?>",
                txtFax: "<?php echo __("Invalid Fax number") ?>",
                txtEmail: "<?php echo __("Invalid E-Mail"); ?>",
                txtURL: "<?php echo __("Invalid URL"); ?>"
            },
            errorClass: "errortd",
                             submitHandler: function(form) {
                             $('#btnEdit').unbind('click').click(function() {return false}).val("<?php echo __('Wait..'); ?>");
                             form.submit();
            }
        });
    });

</script>