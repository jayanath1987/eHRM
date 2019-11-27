<?php
if ($lockMode=='1') {
        $editMode = false;
        $disabled = '';
    } else {
        $editMode = true;
        $disabled = 'disabled="disabled"';
    }

$encrypt = new EncryptionHandler();

?>
<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.validate.js')?>"></script>
 <div class="formpage4col">
        <div class="navigation">
        	
                
        </div>
        <div id="status"></div>
        <div class="outerbox">
            <div class="mainHeading"><h2><?php echo __("New Disciplinary Action Type Define")?></h2></div>
            <?php echo message()?>
            	<form name="frmSave" id="frmSave" method="post"  action="">

                    <div class="leftCol">
                    &nbsp;
                </div>
                <div class="centerCol">
                    <label class="languageBar"><?php echo __("English")?></label>
                </div>
                <div class="centerCol">
                    <label class="languageBar"><?php echo __("Sinhala")?></label>
                </div>
                <div class="centerCol">
                    <label class="languageBar"><?php echo __("Tamil")?></label>
                </div>
                <br class="clear"/>

<div class="leftCol">
                 <label class="controlLabel" for="txtLocationCode"><?php echo __("Disciplinary Type")?> <span class="required">*</span></label>
</div>
                <div class="centerCol">
                     <input id="txten"  name="txtTypeen" type="text"  class="formInputText" value="<?php echo $dActiontype->getDis_acttype_name(); ?>" tabindex="1" maxlength="100"/>
                </div>
                        <div class="centerCol">
                     <input id="txtsi"  name="txtTypesi" type="text"  class="formInputText" value="<?php echo $dActiontype->getDis_acttype_name_si(); ?>" tabindex="1" maxlength="100"/>
                        </div>
                       <div class="centerCol">
                     <input id="txtta"  name="txtTypeta" type="text"  class="formInputText" value="<?php echo $dActiontype->getDis_acttype_name_ta(); ?>" tabindex="1" maxlength="100"/>
                       </div>
                     <br class="clear"/>
                 <div class="formbuttons">
        <input type="button" class="<?php echo $editMode ? 'editbutton' : 'savebutton';?>" name="EditMain" id="editBtn"
        	value="<?php echo $editMode ? __("Edit") : __("Save");?>"
        	title="<?php echo $editMode ? __("Edit") : __("Save");?>"
        	onmouseover="moverButton(this);" onmouseout="moutButton(this);"/>
        <input type="reset" class="clearbutton" id="btnClear" tabindex="5"
                onmouseover="moverButton(this);" onmouseout="moutButton(this);"	<?php echo $disabled;?>
                value="<?php echo __("Reset");?>" />
        <input type="button" class="backbutton" id="btnBack"
              value="<?php echo __("Back")?>" tabindex="10" />
            </div>
            </form>
        </div>

   </div>
<div class="requirednotice"><?php echo __("Fields marked with an asterisk")?><span class="required"> * </span> <?php   echo __("are required") ?></div>
   <script type="text/javascript">

		$(document).ready(function() {


buttonSecurityCommon(null,null,"editBtn",null);

			$.validator.addMethod("SpecialChars", function(value, element) {
            return this.optional(element) || /^[^0-9@\*\!#\$%\^&()~`\+=]+$/i.test(value);
            });

			//Validate the form
			 $("#frmSave").validate({

				 rules: {
				 	txtTypeen: { required: true,maxlength: 100 ,noSpecialCharsOnly: true},
                                        txtTypesi: { maxlength: 100 ,noSpecialCharsOnly: true},
                                        txtTypeta: { maxlength: 100 ,noSpecialCharsOnly: true}

			 	 },
			 	 messages: {
			 		txtTypeen:{required: "<?php echo __('This field is required')?>", maxlength: "<?php echo __('Maximum length should be 100 characters')?>",noSpecialCharsOnly: "<?php echo __('No invalid characters are allowed')?>"},
                                        txtTypesi:{maxlength: "<?php echo __('Maximum length should be 100 characters')?>",noSpecialCharsOnly: "<?php echo __('No invalid characters are allowed')?>"},
                                        txtTypeta:{maxlength: "<?php echo __('Maximum length should be 100 characters')?>",noSpecialCharsOnly: "<?php echo __('No invalid characters are allowed')?>"}

			 	 },
                                    submitHandler: function(form) {
                                    $('#editBtn').unbind('click').click(function() {return false}).val("<?php echo __('Wait..'); ?>");
                                    form.submit();
                              }
			 });
                         <?php  if($editMode == true){ ?>
                $('#frmSave :input').attr('disabled', true);
                  $('#editBtn').removeAttr('disabled');
                   $('#btnBack').removeAttr('disabled');
                  <?php } ?>

		 // When click edit button
                                $("#frmSave").data('edit', <?php echo $editMode ? '1' : '0' ?>);

                                $("#editBtn").click(function() {

                                    var editMode = $("#frmSave").data('edit');

                                    if (editMode == 1) {
                                        // Set lock = 1 when requesting a table lock

            location.href="<?php echo url_for('disciplinary/UpdateActiontype?id='.$encrypt->encrypt($dActiontype->getDis_acttype_id()).'&lock='. $encrypt->encrypt(1)) ?>";
                                    }
                                    else {

                                        $('#frmSave').submit();
                                    }


                                });


			//When click reset buton
				$("#resetBtn").click(function() {
					document.forms[0].reset('');
				 });
                        //When click reset buton
				$("#btnClear").click(function() {
					location.href="<?php echo url_for('disciplinary/UpdateActiontype?id='.$encrypt->encrypt($dActiontype->getDis_acttype_id()).'&lock='. $encrypt->encrypt(0)) ?>";
				 });



			 //When Click back button
			 $("#btnBack").click(function() {
				 location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/disciplinary/actiontype')) ?>";
				});

		 });
</script>
