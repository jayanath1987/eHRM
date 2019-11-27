<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.validate.js') ?>"></script>
<div class="formpage4col" >
    <div id="status"></div>
    <div class="outerbox">
        <div class="mainHeading"><h2><?php echo __("Knowledge Share") ?></h2></div>
        <form name="frmSave" id="frmSave" method="post"  action="">
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
                <label for="txtLocationCode"><?php echo __("Title") ?> <span class="required">*</span></label>
            </div>
            <div class="centerCol">
                <textarea id="txtName"  name="txtName" type="text"  class="formTextArea" value="" tabindex="1" ></textarea>
            </div>

            <div class="centerCol">
                <textarea id="txtNamesi" class="formTextArea"  tabindex="2" name="txtNamesi" type="text"></textarea>

            </div>

            <div class="centerCol">
                <textarea id="txtNameta" class="formTextArea"  tabindex="3" name="txtNameta" type="text"></textarea>

            </div>
            <br class="clear"/>
            <div class="leftCol">
                <label for="txtLocationCode"><?php echo __("Key words (separated using comma , )") ?> <span class="required">*</span></label>
            </div>
            <div class="centerCol">
                <textarea id="txtkeyword"  name="txtkeyword" type="text"  class="formTextArea" value="" tabindex="1" style="height: 200px;"></textarea>
            </div>
            <div class="centerCol">
                <textarea id="txtkeywordsi"  name="txtkeywordsi" type="text"  class="formTextArea" value="" tabindex="1" style="height: 200px;"></textarea>
            </div>
            <div class="centerCol">
                <textarea id="txtkeywordta"  name="txtkeywordta" type="text"  class="formTextArea" value="" tabindex="1" style="height: 200px;"></textarea>
            </div>
            <br class="clear"/>

            <div class="leftCol">
                <label for="txtLocationCode"><?php echo __("Content") ?> <span class="required">*</span></label>
            </div>
            <div class="centerCol">
                <textarea id="txtbody"  name="txtbody" type="text"  class="formTextArea" value="" tabindex="1" style="height: 300px;width: 580px;"></textarea>
            </div>
            <br class="clear"/>


            <div class="formbuttons">
                <input type="button" class="savebutton" id="editBtn"

                       value="<?php echo __("Save") ?>" tabindex="8" />
                <input type="button" class="clearbutton"  id="resetBtn"
                       value="<?php echo __("Reset") ?>" tabindex="9" />
            </div>
        </form>
    </div>
    <div class="requirednotice"><?php echo __("Fields marked with an asterisk") ?><span class="required"> * </span> <?php echo __("are required") ?></div>
    <br class="clear" />
</div>

<script type="text/javascript">

    $(document).ready(function() {
        buttonSecurityCommon("null","editBtn","null","null");


        $("#frmSave").validate({

            rules: {
                txtName: { required: true,noSpecialCharsOnly: true, maxlength:100 },
                txtNamesi: {noSpecialCharsOnly: true, maxlength:100 },
                txtNameta: {noSpecialCharsOnly: true, maxlength:100 },
                txtkeyword: { required: true,noSpecialCharsOnly: true, maxlength:500 },
                txtkeywordsi: {required: true,noSpecialCharsOnly: true, maxlength:500 },
                txtkeywordta: {required: true,noSpecialCharsOnly: true, maxlength:500 },
                txtbody: {noSpecialCharsOnly: true, required: true ,maxlength:30000}
            },
            messages: {
                txtName:{required:"<?php echo __("This is required") ?>",noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>",maxlength:"<?php echo __("Maximum 100 Characters") ?>"},
                txtNamesi:{maxlength:"<?php echo __("Maximum 100 Characters") ?>",noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>"},
                txtNameta:{maxlength:"<?php echo __("Maximum 100 Characters") ?>",noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>"},
                txtkeyword: {required:"<?php echo __("Keywords are required in English") ?>",noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>",maxlength:"<?php echo __("Maximum 500 Characters") ?>"},
                txtkeywordsi: {required:"<?php echo __("Keywords are required in Sinhala") ?>",noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>",maxlength:"<?php echo __("Maximum 500 Characters") ?>"},
                txtkeywordta: {required:"<?php echo __("Keywords are required in Tamil") ?>",noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>",maxlength:"<?php echo __("Maximum 500 Characters") ?>"},
                txtbody:{noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>",required:"<?php echo __("This is required") ?>",maxlength:"<?php echo __("Maximum 30000 Characters") ?>"}
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
            location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/knw/DocumentType')) ?>";
        });

    });
</script>
