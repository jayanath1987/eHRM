<?php
if ($lockMode == '1') {
    $editMode = false;
    $disabled = '';
} else {
    $editMode = true;
    $disabled = 'disabled="disabled"';
}
?>
<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery-ui.min.js') ?>"></script>
<link href="<?php echo public_path('../../themes/orange/css/jquery/jquery-ui.css') ?>" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.validate.js') ?>"></script>
<link href="../../themes/orange/css/style.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?php echo public_path('../../scripts/time.js') ?>"></script>
<div class="formpage4col">
    <div class="navigation">


    </div>
    <div id="status"></div>
    <div class="outerbox">
        <div class="mainHeading"><h2><?php echo __("Edit Attachment Documents") ?></h2></div>
        <form name="frmSave" id="frmSave" method="post"  action="" enctype="multipart/form-data" >
            <?php echo message() ?>
            <?php echo $form['_csrf_token']; ?>
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

            <div class="leftCol"> <label class="controlLabel" for="txtLocationCode"><?php echo __("Document Type") ?>  </label></div>
            <div class="centerCol"><select name="txtdoctype" class="formSelect" style="width: 150px;" tabindex="4">

                    <option>   <?php echo __("--Select--") ?></option>
                    <?php foreach ($Doctype as $promotionftype) {
 ?>
                        <option value="<?php echo $benifittypelist->getKnw_doc_id(); ?>" <?php if ($benifittypelist->getKnw_doc_id() == $promotionftype->getKnw_doc_id()) {
                            echo"selected";
                        } ?>>
                        <?php
                        if ($myCulture == 'en') {
                            $abcd = "getKnw_doc_name";
                        } else {
                            $abcd = "getKnw_doc_name_" . $myCulture;
                        }
                        if ($promotionftype->$abcd() == "") {
                            echo $promotionftype->getKnw_doc_name();
                        } else {
                            echo $promotionftype->$abcd();
                        }
                        ?></option>
<?php } ?>
                </select></div>
            <br class="clear"/>


            <div class="leftCol">
                <label for="txtLocationCode"><?php echo __("Document Title Name") ?> </label>
                <input name="txtbtid" type="hidden" value="<?php echo $benifittypelist->getKnw_doc_id() ?>"/>
            </div>
            <div class="centerCol">
                <textarea id="txtJobTitleDesc" class="formTextArea" tabindex="1" name="txtName" type="text"><?php echo $benifittypelist->getKnw_atd_title() ?></textarea>
            </div>
            <div class="centerCol">
                <textarea id="txtJobTitleDesc" class="formTextArea" tabindex="2" name="txtNamesi" type="text"><?php echo $benifittypelist->getKnw_atd_title_si() ?></textarea>
            </div>
            <div class="centerCol">
                <textarea id="txtJobTitleComments" class="formTextArea" tabindex="3" name="txtNameta" type="text"><?php echo $benifittypelist->getKnw_atd_title_ta() ?></textarea>
            </div>
            <br class="clear"/>
            <div class="leftCol">
                <label for="txtLocationCode"><?php echo __("Key words (separated using , )") ?> </label>
                <input name="txtbtid" type="hidden" value="<?php echo $benifittypelist->getKnw_doc_id() ?>"/>
            </div>
            <div class="centerCol">
                <textarea id="txtJobTitleDesc" class="formTextArea" tabindex="1" name="txtkeyword" type="text" style="height: 250px;"><?php echo $benifittypelist->getKnw_atd_keyword() ?></textarea>
            </div>
            <div class="centerCol">
                <textarea id="txtJobTitleDesc" class="formTextArea" tabindex="2" name="txtkeywordsi" type="text" style="height: 250px;"><?php echo $benifittypelist->getKnw_atd_keyword_si() ?></textarea>
            </div>
            <div class="centerCol">
                <textarea id="txtJobTitleComments" class="formTextArea" tabindex="3" name="txtkeywordta" type="text" style="height: 250px;"><?php echo $benifittypelist->getKnw_atd_keyword_ta() ?></textarea>
                    </div>
                    <br class="clear"/>
                    <div class="leftCol"><label  class="controlLabel" for="txtLocationCode" ><?php echo __("Upload Document") ?> </label></div>
                    <div class="centerCol"><INPUT TYPE="file" class="formInputText" VALUE="Upload" name="txtletter" id="txtletter" /></div>

            <?php if (!$editMode) {
 ?><label style="margin-left :10px;">
<?php
                        $kk = $prm->readattach($benifittypelist->getKnw_atd_id(), $benifittypelist->getKnw_doc_id());
                        foreach ($kk as $rowa) {
                            if ($rowa['count'] == 1) {
                                $abc = abc;
                                $kk2 = $prm->readAttachment2($benifittypelist->getKnw_atd_id(), $benifittypelist->getKnw_doc_id());
                                if ($kk2[0]['count'] == 1) {
                                    $efg = 1 ?>
                                    <a href="#" onclick="popupimage1(link='<?php echo url_for('knw/imagepop?id='); ?><?php echo $benifittypelist->getKnw_atd_id() . '?did=' . $benifittypelist->getKnw_doc_id(); ?>')"><?php echo __("Attachment"); ?></a>
                                    <a id="deletelink" onclick="return deletelink();"  href="<?php echo url_for('knw/deletepop?id='); ?><?php echo $benifittypelist->getKnw_atd_id() . '?did=' . $benifittypelist->getKnw_doc_id(); ?>"><?php echo __("Delete"); ?></a><?php
                                }
                                $kk3 = $prm->readAttachment3($benifittypelist->getKnw_atd_id(), $benifittypelist->getKnw_doc_id());
                                if ($kk3[0]['count'] == 1) {
?>
                                    <a href="#" onclick="popupimage(link='<?php echo url_for('knw/readArticle?id='); ?><?php echo $benifittypelist->getKnw_atd_id() . '?did=' . $benifittypelist->getKnw_doc_id(); ?>')"><?php echo __("view"); ?></a><?php
                                }
                            }
                        }
                    }
?></label>

                <br class="clear"/>
                <div class="leftCol"><label class="controlLabel" for="txtLocationCode"><?php echo __("Update Date") ?> </label></div>
                <div class="centerCol"><input id="datepicker" type="text" class="formInputText" name="effdate" value="<?php echo LocaleUtil::getInstance()->formatDate($benifittypelist->getKnw_atd_update_date()) ?>"></div>
                <div style="display: none;" class="demo-description"></div>
                <br class="clear"/>
            </form>



            <div class="formbuttons">
                <input type="button" class="<?php echo $editMode ? 'editbutton' : 'savebutton'; ?>" name="EditMain" id="editBtn"
                       value="<?php echo $editMode ? __("Edit") : __("Save"); ?>"
                       title="<?php echo $editMode ? __("Edit") : __("Save"); ?>"
                       onmouseover="moverButton(this);" onmouseout="moutButton(this);"/>
                <input type="reset" class="clearbutton" id="btnClear" tabindex="5"
                       onmouseover="moverButton(this);" onmouseout="moutButton(this);"	<?php echo $disabled; ?>
                       value="<?php echo __("Reset"); ?>" />
                                <input type="button" class="backbutton" id="btnBack"
                                       value="<?php echo __("Back") ?>" tabindex="18"  onclick="goBack();"/>
                            </div>

                        </div>
                        <div class="requirednotice"><?php echo __("Fields marked with an asterisk") ?><span class="required"> * </span> <?php echo __("are required") ?></div>
                        <br class="clear" />
                    </div>

<?php
                    require_once '../../lib/common/LocaleUtil.php';
                    $sysConf = OrangeConfig::getInstance()->getSysConf();
                    $sysConf = new sysConf();
                    $inputDate = $sysConf->dateInputHint;
                    $format = LocaleUtil::convertToXpDateFormat($sysConf->getDateFormat());

//$format=$sysConf->dateFormat;
?>

                    <script type="text/javascript">

                        function deletelink(){
                            var conf= "<?php echo $conf; ?>";
                            answer = confirm("<?php echo __("Do you really want to Delete?") ?>");

                            if (answer !=0)
                            {

                                return true;

                            }
                            else{
                                return false;
                            }

                        }
                        function popupimage(link){
                            window.open(link, "myWindow",
                            "top=100 left=25 status = 1, height = 450, width = 950, resizable = 0" )
                        }
                        function popupimage1(link){
                            window.open(link, "myWindow",
                            " status = 1, height = 300, width = 300, resizable = 0" )
                        }
                        $(document).ready(function() {
                            buttonSecurityCommon("null","null","editBtn","null");
<?php if ($editMode == true) { ?>
                                                  $('#frmSave :input').attr('disabled', true);
                                                  $('#editBtn').removeAttr('disabled');
                                                  $('#btnBack').removeAttr('disabled');
<?php } ?>


                                           jQuery.validator.addMethod("orange_date",
                                           function(value, element, params) {

                                               var format = params[0];

                                               // date is not required
                                               if (value == '') {

                                                   return true;
                                               }
                                               var d = strToDate(value, "<?php echo $format ?>");


                                               return (d != false);

                                           }, ""
                                       );
                                           //Validate the form
                                           $("#frmSave").validate({

                                               rules: {


                                                   effdate: { required: true ,orange_date:true},
                                                   txtName: { required: true,noSpecialCharsOnly: true, maxlength:200 },
                                                   txtNamesi: {maxlength:200,noSpecialCharsOnly: true },
                                                   txtNameta: { maxlength:200,noSpecialCharsOnly: true },
                                                   txtkeyword: {required: true,noSpecialCharsOnly: true, maxlength:500 },
                                                   txtkeywordsi: {required: true,noSpecialCharsOnly: true, maxlength:500 },
                                                   txtkeywordta: {required: true,noSpecialCharsOnly: true, maxlength:500 }
                                               },
                                               messages: {


                                                   effdate: {required:"<?php echo __("Please Enter Date") ?>",orange_date: "<?php echo __("Please specify valid date") ?>"},
                                                   txtName: {required:"<?php echo __("Document Type is required in English") ?>",maxlength:"<?php echo __("Maximum 100 Characters") ?>",noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>"},
                                                   txtNamesi:{maxlength:"<?php echo __("Maximum 100 Characters") ?>",noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>"},
                                                   txtNameta:{maxlength:"<?php echo __("Maximum 100 Characters") ?>",noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>"},
                                                   txtkeyword: {required:"<?php echo __("Keywords are required in English") ?>",maxlength:"<?php echo __("Maximum 500 Characters") ?>",noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>"},
                                                   txtkeywordsi: {required:"<?php echo __("Keywords are required in Sinhala") ?>",maxlength:"<?php echo __("Maximum 500 Characters") ?>",noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>"},
                                                   txtkeywordta: {required:"<?php echo __("Keywords are is required in Tamil") ?>",maxlength:"<?php echo __("Maximum 500 Characters") ?>",noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>"}



                                               }
                                           });

                                           $("#datepicker").datepicker({ dateFormat: '<?php echo $inputDate; ?>' });


                                           // When click edit button
                                           $("#frmSave").data('edit', <?php echo $editMode ? '1' : '0' ?>);

                                           $("#editBtn").click(function() {

                                               var editMode = $("#frmSave").data('edit');
                                               if (editMode == 1) {
                                                   // Set lock = 1 when requesting a table lock

                                                   location.href="<?php echo url_for('knw/UpdateAttachment?id=' . $benifittypelist->getKnw_atd_id() . '&did=' . $benifittypelist->getKnw_doc_id() . '&lock=1') ?>";
                                               }
                                               else {
                                                   var abc = "<?php echo $abc ?>";
                                                   var abc1 = $("#txtletter").val();
                                                   var abcd = "<?php echo $efg ?>"
                                                   if((abc== "")&&(abc1== "")&&(abcd == "")){
                                                       alert("<?php echo __("Attachment Required") ?>");
                                                       return false;
                                                   }
                                                   else{
                                                       $('#frmSave').submit();
                                                   }
                                               }


                                           });

                                           //When Click back button
                                           $("#btnBack").click(function() {
                                               location.href = "<?php echo url_for('knw/Attachment') ?>";
                                           });

                                           //When click reset buton
                                           $("#btnClear").click(function() {
                                               // Set lock = 0 when resetting table lock
                                               location.href="<?php echo url_for('knw/UpdateAttachment?id=' . $benifittypelist->getKnw_atd_id() . '&did=' . $benifittypelist->getKnw_doc_id() . '&lock=1') ?>";
                       });
                   });
</script>
