<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.validate.js') ?>"></script>
<div class="formpage4col" >
    <div id="status"></div>
    <div class="outerbox">
        <div class="mainHeading"><h2><?php echo __("Knowledge Share") ?></h2></div>
        <form name="frmSave" id="frmSave" method="post"  action="">

            <div class="leftCol">
                <label for="txtLocationCode"><?php echo __("Title") ?></label>
            </div>
            <div class="centerCol">
                <textarea id="txtName"  name="txtName" type="text"  class="formTextArea" value="" tabindex="1" ><?php echo $benifittypelist->getKnw_atd_title() ?></textarea>
            </div>
            <br class="clear"/>
            <div class="leftCol">
                <label for="txtLocationCode"><?php echo __("Content") ?></label>
            </div>
            <div class="centerCol">
                <textarea id="txtName"  name="txtbody" type="text"  class="formTextArea" value="" tabindex="1" style="height: 300px;width: 600px;"><?php echo $benifittypelist->KNWAttachment->getKnw_att_article() ?></textarea>
            </div>


            <br class="clear"/>
            <br class="clear"/>



        </form>
    </div>

</div>

<script type="text/javascript">

    $(document).ready(function() {
        $('#frmSave :input').attr('disabled', true);


        //Validate the form
        $("#frmSave").validate({

            rules: {
                txtName: { required: true,noSpecialCharsOnly: true, maxlength:100 },
                txtNamesi: {noSpecialCharsOnly: true, maxlength:100 },
                txtNameta: {noSpecialCharsOnly: true, maxlength:100 },
                txtkeyword: { required: true,noSpecialCharsOnly: true, maxlength:500 },
                txtkeywordsi: {required: true,noSpecialCharsOnly: true, maxlength:500 },
                txtkeywordta: {required: true,noSpecialCharsOnly: true, maxlength:500 },
                txtbody: {noSpecialCharsOnly: true, required: true }
            },
            messages: {
                txtName: {required:"<?php echo __("Title is required in English") ?>",maxlength:"<?php echo __("Maximum 100 Characters") ?>",noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>"},
                txtNamesi:{maxlength:"<?php echo __("Maximum 100 Characters") ?>",noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>"},
                txtNameta:{maxlength:"<?php echo __("Maximum 100 Characters") ?>",noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>"},
                txtkeyword: {required:"<?php echo __("Title is required in English") ?>",maxlength:"<?php echo __("Maximum 500 Characters") ?>",noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>"},
                txtkeywordsi: {required:"<?php echo __("Title is required in Sinhala") ?>",maxlength:"<?php echo __("Maximum 500 Characters") ?>",noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>"},
                txtkeywordta: {required:"<?php echo __("Title is required in Tamil") ?>",maxlength:"<?php echo __("Maximum 500 Characters") ?>",noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>"},
                txtbody:{noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>",required:"<?php echo __("This is required ") ?>"}
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
