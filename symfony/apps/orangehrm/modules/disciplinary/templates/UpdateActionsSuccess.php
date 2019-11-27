<?php
if ($lockMode == '1') {
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
            <div class="mainHeading"><h2><?php echo __("Update Disciplinary Sub Types")?></h2></div>
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
                <select  name="cmbActiontype" id="cmbActiontype" class="formSelect" style="width: 150px;" tabindex="4">

		<option value=""><?php echo __("--Select--") ?></option>
			<?php foreach($actiontypes as $types){?>
				<option value="<?php echo $types->getDis_acttype_id()?>"<?php if($dOffence->getDis_acttype_id()==$types->getDis_acttype_id())echo "selected"; ?>><?php if($culture=='en'){$abc = "getDis_acttype_name";}else{$abc = "getDis_acttype_name_".$culture;} if($types->$abc()=="") echo $types->getDis_acttype_name(); else echo $types->$abc();?></option>
			<?php }?>

                </select>
</div>
<br class="clear"/>

<div class="leftCol">
                 <label class="controlLabel" for="txtLocationCode"><?php echo __("Sub Type")?> <span class="required">*</span></label>
</div>
                <div class="centerCol">
                     <input id="txten"  name="txtOffence" type="text"  class="formInputText" value="<?php echo $dOffence->getDis_offence_name(); ?>" tabindex="1" maxlength="100"/>
                </div>
                        <div class="centerCol">
                     <input id="txtsi"  name="txtOffencesi" type="text"  class="formInputText" value="<?php echo $dOffence->getDis_offence_name_si(); ?>" tabindex="1" maxlength="100"/>
                        </div>
                       <div class="centerCol">
                     <input id="txtta"  name="txtOffenceta" type="text"  class="formInputText" value="<?php echo $dOffence->getDis_offence_name_ta(); ?>" tabindex="1" maxlength="100"/>
                       </div>
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
              value="<?php echo __("Back")?>" tabindex="10" />
              </div>
            </form>
        </div>

   </div>
<div class="requirednotice"><?php echo __("Fields marked with an asterisk")?><span class="required"> * </span> <?php   echo __("are required") ?></div>
   <script type="text/javascript">

		$(document).ready(function() {


buttonSecurityCommon(null,null,"editBtn",null);


			$("#frmSave").validate({

				 rules: {
                                        cmbActiontype: {required: true},
				 	txtOffence: { required: true,maxlength: 100 ,specialChars: true},
                                        txtOffencesi: { maxlength: 100 ,specialChars: true},
                                        txtOffenceta: { maxlength: 100 ,specialChars: true}

			 	 },
			 	 messages: {
                                        cmbActiontype: {required: "<?php echo __('This field is required')?>"},
			 		txtOffence:{required: "<?php echo __('This field is required')?>", maxlength: "<?php echo __('Maximum length should be 100 characters')?>",specialChars: "<?php echo __('No invalid characters are allowed')?>"},
                                        txtOffencesi:{maxlength: "<?php echo __('Maximum length should be 100 characters')?>",specialChars: "<?php echo __('No invalid characters are allowed')?>"},
                                        txtOffenceta:{maxlength: "<?php echo __('Maximum length should be 100 characters')?>",specialChars: "<?php echo __('No invalid characters are allowed')?>"}
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

            location.href="<?php echo url_for('disciplinary/UpdateActions?id='.$encrypt->encrypt($dOffence->getDis_offence_id()).'&lock='. $encrypt->encrypt(1)) ?>";
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
					location.href="<?php echo url_for('disciplinary/UpdateActions?id='.$encrypt->encrypt($dOffence->getDis_offence_id()).'&lock='. $encrypt->encrypt(0)) ?>";
				 });

			 //When Click back button
			 $("#btnBack").click(function() {
				 location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/disciplinary/actions')) ?>";
				});

		 });
</script>
