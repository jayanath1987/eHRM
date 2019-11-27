<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery-ui.min.js') ?>"></script>
<link href="<?php echo public_path('../../themes/orange/css/jquery/jquery-ui.css') ?>" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.validate.js') ?>"></script>
<link href="../../themes/orange/css/style.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?php echo public_path('../../scripts/time.js') ?>"></script>

<div class="formpage4col" >
    <div class="navigation">

    </div>
    <div id="status"></div>
    <div class="outerbox">
        <div class="mainHeading"><h2><?php echo __("Add Attachment Documents") ?></h2></div>
        <form name="frmSave" id="frmSave" method="post"  action="" enctype="multipart/form-data">

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
                    <option value=""><?php echo __("--Select--") ?></option>
                    <?php foreach ($Doctype as $promotionftype) {
                        if ($promotionftype->getKnw_doc_id() != 1) {
 ?>
                            <option value="<?php echo $promotionftype->getKnw_doc_id() ?>"><?php
                            //echo $promotionftype->getPrm_method_comment_en()
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
<?php }
                    } ?>
                </select></div>
            <br class="clear"/>


            <div class="leftCol">
                <label for="txtLocationCode"><?php echo __("Document Title Name") ?> </label>
                <input name="txtbtid" type="hidden" value=""/>
            </div>
            <div class="centerCol">
                <textarea id="txtName" class="formTextArea" tabindex="1" name="txtName" type="text"></textarea>
            </div>
            <div class="centerCol">
                <textarea id="txtNamesi" class="formTextArea" tabindex="2" name="txtNamesi" type="text"></textarea>
            </div>
            <div class="centerCol">
                <textarea id="txtNameta" class="formTextArea" tabindex="3" name="txtNameta" type="text"></textarea>
            </div>
            <br class="clear"/>
            <div class="leftCol">
                <label for="txtLocationCode"><?php echo __("Key words (separated using , )") ?> </label>
                <input name="txtbtid" type="hidden" value=""/>
            </div>
            <div class="centerCol">
                <textarea id="txtkeyword" class="formTextArea" tabindex="1" name="txtkeyword" type="text" style="height: 250px;"></textarea>
            </div>
            <div class="centerCol">
                <textarea id="txtkeywordsi" class="formTextArea" tabindex="2" name="txtkeywordsi" type="text" style="height: 250px;"></textarea>
            </div>
            <div class="centerCol">
                <textarea id="txtkeywordta" class="formTextArea" tabindex="3" name="txtkeywordta" type="text" style="height: 250px;"></textarea>
            </div>
            <br class="clear"/>
            <div class="leftCol"><label  class="controlLabel" for="txtLocationCode" ><?php echo __("Upload Document") ?> </label></div>
                <div class="centerCol"><INPUT TYPE="file" class="formInputText" VALUE="Upload" name="txtletter" /></div>
                <?php //if (!$editMode) {
// ?><label style="margin-left :80px;"><a href="#" onclick="popupimage(link='<?php echo url_for('knw/imagepop?id='); ?><?php //echo $benifittypelist->getKnw_atd_id().'?did='.$benifittypelist->getKnw_doc_id(); ?>')"><?php
//                            $kk = $prm->readattach($benifittypelist->getKnw_atd_id(),$benifittypelist->getKnw_doc_id());
//                            foreach ($kk as $rowa) {
//                                if ($rowa['count'] == 1) {
//                                    echo __("View");
//                                }
//                                } ?></a>  <a id="deletelink" onclick="return deletelink();"  href="<?php // echo url_for('knw/deletepop?id='); ?><?php //echo $benifittypelist->getKnw_atd_id().'?did='.$benifittypelist->getKnw_doc_id(); ?>"> <?php
//                            $kk = $prm->readattach($benifittypelist->getKnw_atd_id(),$benifittypelist->getKnw_doc_id());
//                            foreach ($kk as $rowa) {
//                                if ($rowa['count'] == 1) {
//                                    echo __("Delete");
//                                }
//                            }
//
                ?> </a></label> <?php //}  ?>
            <br class="clear"/>
            <div class="leftCol"><label class="controlLabel" for="txtLocationCode"><?php echo __("Publish Date") ?> </label></div>
            <div class="centerCol"><input id="datepicker" type="text" class="formInputText" name="effdate" value="<?php //echo $benifittypelist->getKnw_atd_update_date()  ?>"></div>
            <div style="display: none;" class="demo-description"></div>
            <br class="clear"/>

            <div class="formbuttons">
                <input type="button" class="savebutton" id="editBtn"

                       value="<?php echo __("Save") ?>" tabindex="8" />
                <input type="button" class="clearbutton"  id="resetBtn"
                       value="<?php echo __("Reset") ?>" tabindex="9" />
                <input type="button" class="backbutton" id="btnBack"
                       value="<?php echo __("Back") ?>" tabindex="10" />
            </div>
        </form>
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

                        $(document).ready(function() {
                            buttonSecurityCommon("null","editBtn","null","null");
                            jQuery.validator.addMethod("orange_date",
                            function(value, element, params) {

                                //var hint = params[0];
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
                                    txtletter: { required: true },
                                    txtdoctype: { required: true },
                                    effdate: { required: true ,orange_date:true},
                                    txtName: { required: true,noSpecialCharsOnly: true, maxlength:100 },
                                    txtNamesi: {maxlength:100,noSpecialCharsOnly: true },
                                    txtNameta: { maxlength:100,noSpecialCharsOnly: true },
                                    txtkeyword: {required: true,noSpecialCharsOnly: true, maxlength:500 },
                                    txtkeywordsi: {required: true,noSpecialCharsOnly: true, maxlength:500 },
                                    txtkeywordta: {required: true,noSpecialCharsOnly: true, maxlength:500 }
                                },
                                messages: {
                                    txtletter:"<?php echo __("Attachment Required") ?>",
                                    txtdoctype:"<?php echo __("Document Type Required") ?>",
                                    effdate: {required:"<?php echo __("Please Enter Date") ?>",orange_date: "<?php echo __("Please specify valid date") ?>"},
                                    txtName: {required:"<?php echo __("Document Type is required in English") ?>",maxlength:"<?php echo __("Maximum 100 Characters") ?>",noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>"},
                                    txtNamesi:{maxlength:"<?php echo __("Maximum 100 Characters") ?>",noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>"},
                                    txtNameta:{maxlength:"<?php echo __("Maximum 100 Characters") ?>",noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>"},
                                    txtkeyword: {required:"<?php echo __("Keywords are required in English") ?>",maxlength:"<?php echo __("Maximum 500 Characters") ?>",noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>"},
                                    txtkeywordsi: {required:"<?php echo __("Keywords are required in Sinhala") ?>",maxlength:"<?php echo __("Maximum 500 Characters") ?>",noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>"},
                                    txtkeywordta: {required:"<?php echo __("Keywords are required in Tamil") ?>",maxlength:"<?php echo __("Maximum 500 Characters") ?>",noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>"}


                                }
                            });

                            $("#datepicker").datepicker({ dateFormat: '<?php echo $inputDate; ?>' });

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
                                location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/knw/Attachment')) ?>";
        });

    });
</script>
