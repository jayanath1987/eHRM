<?php
if ($mode == '1') {
    $editMode = false;
    $disabled = '';
} else {
    $editMode = true;
    $disabled = 'disabled="disabled"';
}
$encrypt = new EncryptionHandler();
?>
<?php
require_once ROOT_PATH . '/lib/common/LocaleUtil.php';
?>
<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery-ui.min.js') ?>"></script>
<link href="<?php echo public_path('../../themes/orange/css/jquery/jquery-ui.css') ?>" rel="stylesheet" type="text/css"/>

<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.validate.js') ?>"></script>
<script type="text/javascript" src="<?php echo public_path('../../scripts/time.js') ?>"></script>
<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery.placeholder.js') ?>"></script>
<script type="text/javascript" src="<?php echo public_path('../../scripts/paginator.js') ?>"></script>
<?php
$sysConf = OrangeConfig::getInstance()->getSysConf();
$inputDate = $sysConf->getDateInputHint();
$dateDisplayHint = $sysConf->dateDisplayHint;
$format = LocaleUtil::convertToXpDateFormat($sysConf->getDateFormat());
?>
<div class="formpage4col" >
    <div class="navigation">
        <style type="text/css">
            div.formpage4col input[type="text"]{
                width: 180px;
            }
            div.formpage4col select{
                width: 50px;
            }
            .paginator{
                padding-left: 100px;
            }
        </style>

    </div>
    <div id="status"></div>
    <div class="outerbox">
        <?php if ($mode == '1') {
        ?>
            <div class="mainHeading"><h2><?php echo __("Define Notice") ?></h2></div>
        <?php echo message(); ?>
        <?php } else {
        ?>
            <div class="mainHeading"><h2><?php echo __("Edit Notice") ?></h2></div>
        <?php echo message(); ?>
        <?php } ?>
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
                <label for="txtLocationCode"><?php echo __("Notice Title") ?> <span class="required">*</span></label>
            </div>
            <div class="centerCol">
                <input id="txtName"  name="txtName" type="text"  class="formInputText" value="<?php echo $disAct->notice_name; ?>" maxlength="50" />
            </div>


            <div class="centerCol">
                <input id="txtNamesi"  name="txtNamesi" type="text"  class="formInputText"  value="<?php echo $disAct->notice_name_si; ?>" maxlength="50" />
            </div>
            <div class="centerCol">

                <input id="txtNameta"  name="txtNameta" type="text"  class="formInputText"  value="<?php echo $disAct->notice_name_ta; ?>" maxlength="50" />
            </div>
            <input type="hidden" name="txtHiddenID" value="<?php echo $disAct->notice_code; ?>" />
            <br class="clear"/>

            <div class="leftCol">
                <label class="controlLabel" for="txtLocationCode"><?php echo __("Description") ?> <span class="required">*</span></label>
            </div>
            <div class="centerCol">
                <textarea id='txtDes' name='txtDes'  class="formTextArea"
                          rows="5" cols="20"  ><?php echo $disAct->notice_desc; ?></textarea>
            </div>
            <div class="centerCol">
                <textarea id='txtDesSi' name='txtDesSi'  class="formTextArea"
                          rows="5" cols="20"  ><?php echo $disAct->notice_desc_si; ?></textarea>
            </div>
            <div class="centerCol">
                <textarea id='txtDesTa' name='txtDesTa'  class="formTextArea"
                          rows="5" cols="20"  ><?php echo $disAct->notice_desc_ta; ?></textarea>
            </div>
            <br class="clear"/>

            <div class="leftCol">
                <label class="controlLabel" for="txtcomment"><?php echo __("Date from") ?><span class="required">*</span></label>
            </div>
            <div class="centerCol">

                <input id="fromdate" type="text" class="formInputText" value="<?php echo $disAct->from_date ?>" placeholder="<?php echo $dateDisplayHint; ?>" name="fromdate">

                <div style="display: none;" class="demo-description"></div>
            </div>


            <div class="centerCol">
                <label class="controlLabel" for="txtcomment"><?php echo __("Date To") ?><span class="required">*</span></label>
            </div>
            <div class="centerCol">

                <input id="todate" type="text" class="formInputText" value="<?php echo $disAct->to_date ?>" placeholder="<?php echo $dateDisplayHint; ?>" name="todate">

                <div style="display: none;" class="demo-description"></div>
            </div>

<!--            <br class="clear"/>
            
            <div class="leftCol">
                <label class="controlLabel" for="txtcomment"><?php echo __("Send an E-mail") ?><span class="required">*</span></label>
            </div>
            <div class="centerCol">

                <input id="chkEmail"  name="chkEmail" type="checkbox"  class="formInputText" value="1"  <?php;
            if ($disAct->email_flg == "1") {
                echo "checked";
               
            } ?>
                 >      
                            
            </div>
            <br class="clear"/>
            
            <div class="leftCol">
                <label class="controlLabel" for="txtcomment"><?php echo __("Send a SMS") ?><span class="required">*</span></label>
            </div>
            <div class="centerCol">

            <input id="chkSMS"  name="chkSMS" type="checkbox"  class="formInputText" value="1"  <?php;
            if ($disAct->sms_flg == "1") {
                echo "checked";
               
            } ?>
             >      
            </div>  
             <div class="centerCol">
                <label class="controlLabel" for="txtcomment"><?php echo __("SMS Text") ?><span class="required">*</span></label>
            </div>
            <div class="centerCol">

                <input id="txtsmstext" type="text" class="formInputText" value="<?php echo $disAct->sms_text ?>" name="txtsmstext" maxlength="150">

                <div style="display: none;" class="demo-description"></div>
            </div>-->

            <br class="clear"/>
            
            
              <div class="leftCol">
                    <label id="lblemp" class="controlLabel" for="txtLocationCode"><?php echo __("Add Employee") ?> <span class="required">*</span></label>
                </div>
                            
                <div class="centerCol" style="padding-top: 8px;">
                    <input class="button" type="button" value="..." id="empRepPopBtn" name="empRepPopBtn" <?php echo $disabled; ?> /><br>
                    <input  type="hidden" name="txtEmpId" id="txtEmpId" value="<?php echo $etid; ?>"/>
                </div>
            <br class="clear"/>
                <div id="employeeGrid1" class="centerCol" style="margin-left:10px; margin-top: 8px; width: 380px; border-style:  solid; border-color: #FAD163; ">
                    <div style="">
                        <div class="centerCol" style='width:100px; background-color:#FAD163;'>
                            <label class="languageBar" style="padding-left:2px; padding-top:2px;padding-bottom: 1px; background-color:#FAD163; margin-top: 0px;  color:#444444;"><?php echo __("Emp Id") ?></label>
                        </div>
                        <div class="centerCol" style='width:220px;  background-color:#FAD163;'>
                            <label class="languageBar" style="padding-left:2px; padding-top:2px;padding-bottom: 1px; background-color:#FAD163; margin-top: 0px; color:#444444; text-align:inherit"><?php echo __("Employee Name") ?></label>
                        </div>
                        <div class="centerCol" style='width:60px;   background-color:#FAD163;'>
                            <label class="languageBar" style="width:50px; padding-left: 0px; padding-top:2px;padding-bottom: 1px; background-color:#FAD163; margin-top: 0px; color:#444444; text-align:inherit"><?php echo __("Remove") ?></label>
                        </div>

                    </div>
                    <br class="clear"/>
                    <div id="tohide" >
                    

                    </div>
                    <br class="clear"/>
                   
                </div>
            
             <br class="clear"/>
            
            
            
            <div class="formbuttons">
                <input type="button" class="<?php echo $editMode ? 'editbutton' : 'savebutton'; ?>" name="EditMain" id="editBtn"
                       value="<?php echo $editMode ? __("Edit") : __("Save"); ?>"
                       title="<?php echo $editMode ? __("Edit") : __("Save"); ?>"
                       onmouseover="moverButton(this);" onmouseout="moutButton(this);"/>
                <input type="reset" class="clearbutton" id="btnClear" tabindex="5"
                       onmouseover="moverButton(this);" onmouseout="moutButton(this);"<?php echo $disabled; ?>
                       value="<?php echo __("Reset"); ?>" />
                <input type="button" class="backbutton" id="btnBack"
                       value="<?php echo __("Back") ?>" tabindex="10" />
            </div>
        </form>
    </div>
    <div class="requirednotice"><?php echo __("Fields marked with an asterisk") ?><span class="required"> * </span> <?php echo __("are required") ?></div>
    <br class="clear" />
</div>


        <script type="text/javascript">
var myArray2= new Array();
 var myArray2= new Array();
            var empstatArray= new Array();
            var k;
            var pagination = 0;
            var existemp= new Array();

            //Pagination variable
            itemsPerPage = 20;
            paginatorStyle = 2;
            paginatorPosition = 'both';
            enableGoToPage = true;
            currentPage = 1;
            
                    function getData(){


///        myArray2=new Array();   
        $.ajax({
            type: "POST",
            async:false,
            url: "<?php echo url_for('admin/CurrentEmployee') ?>",
            data: { EVid: "<?php echo $disAct->notice_code ?>" },
            dataType: "json",
            success: function(data){ 
                
                    if(data!=null){

                    var childdiv="";
                    var i=0;
                    $.each(data, function(key, value) {
                        var word=value.split("|");
                            childdiv="<div class='pagin' id='row_"+word[2]+"' style='padding-top:5px; '>";
                                    childdiv+="<div class='centerCol' id='master' style='width:100px;'>";
                                    childdiv+="<div id='employeename' style='height:30px; padding-left:3px;'>"+word[0]+"</div>";
                                    childdiv+="</div>";

                                    childdiv+="<div class='centerCol' id='master' style='width:220px;'>";
                                    childdiv+="<div id='employeename' style='height:30px; padding-left:3px;'>"+word[1]+"</div>";
                                    childdiv+="</div>";


                                    childdiv+="<div class='centerCol' id='master' style='width:60px;'>";
                                    childdiv+="<div id='employeename' style='height:30px; padding-left:3px;'><a href='#' style='width:50px;' onclick='deleteCRow("+i+","+word[2]+")'><?php echo __('Remove') ?></a><input type='hidden' name='hiddenEmpNumber[]' value="+word[2]+" ></div>";
                                    childdiv+="</div>";
                                    childdiv+="</div>";

                                    $('#tohide').append(childdiv);


                        
                        });


                    $(function () {

                       if(pagination > 1){
                       $("#tohide").depagination();
                       }
                        $("#tohide").pagination();
                    });
                    


                         
                    }else{
                    for(var t=0; t<=k; t++){
                        $("#row_"+t).remove();
                    }
                    
                    if(pagination >= 1){
                       $("#tohide").depagination();
                       }

                    }
                    
                }
                
        });

            $('#bulkemp').show();


                                         

            }

            
            
            function SelectEmployee(data){

                myArr=new Array();
                lol=new Array();
                myArr = data.split('|');

                addtoGrid(myArr);
                if(myArr != null){
                }
            }

            function addtoGrid(empid){

                var arraycp=new Array();

                var arraycp = $.merge([], myArray2);

                var items= new Array();
                for(i=0;i<empid.length;i++){

                    items[i]=empid[i];
                }

                var u=1;
                $.each(items,function(key, value){

                    if(jQuery.inArray(value, arraycp)!=-1)
                    {

                        // ie of array index find bug sloved here//
                        if(!Array.indexOf){
                            Array.prototype.indexOf = function(obj){
                                for(var i=0; i<this.length; i++){
                                    if(this[i]==obj){
                                        return i;
                                    }
                                }
                                return -1;
                            }
                        }

                        var idx = arraycp.indexOf(value);
                        if(idx!=-1) arraycp.splice(idx, 1); // Remove it if really found!
                        u=0;

                    }
                    else{

                        arraycp.push(value);

                    }


                }


            );

                $.each(myArray2,function(key, value){
                    if(jQuery.inArray(value, arraycp)!=-1)
                    {

                        // ie of array index find bug sloved here//
                        if(!Array.indexOf){
                            Array.prototype.indexOf = function(obj){
                                for(var i=0; i<this.length; i++){
                                    if(this[i]==obj){
                                        return i;
                                    }
                                }
                                return -1;
                            }
                        }

                        var idx = arraycp.indexOf(value); // Find the index
                        if(idx!=-1) arraycp.splice(idx, 1); // Remove it if really found!
                        u=0;

                    }
                    else{


                    }


                }


            );
                $.each(arraycp,function(key, value){
                    myArray2.push(value);
                }


            );if(u==0){

                }
                var courseId1=$('#courseid').val();
                $.post(

                "<?php echo url_for('pim/LoadGrid') ?>", //Ajax file



                { 'empid[]' : arraycp },  // create an object will all values

                //function that is c    alled when server returns a value.
                function(data){
                    //alert(data);

                    //var childDiv;
                    var childdiv="";
                    var i=0;

                    $.each(data, function(key, value) {
                        var word=value.split("|");

                                    childdiv="<div style = 'width:380px; height:30px;' class='pagin' id='row_"+word[2]+"' style='padding-top:5px; '>";
                                    childdiv+="<div class='centerCol' id='master' style='width:100px;'>";
                                    childdiv+="<div id='employeename' style='height:30px; padding-left:3px;'>"+word[0]+"</div>";
                                    childdiv+="</div>";

                                    childdiv+="<div class='centerCol' id='master' style='width:220px;'>";
                                    childdiv+="<div id='employeename' style='height:30px; padding-left:3px;'>"+word[1]+"</div>";
                                    childdiv+="</div>";
 

                                    childdiv+="<div class='centerCol' id='master' style='width:60px;'>";
                                    childdiv+="<div id='employeename' style='height:30px; padding-left:3px;'><a href='#' style='width:50px;' onclick='deleteCRow("+i+","+word[2]+")'><?php echo __('Remove') ?></a><input type='hidden' name='hiddenEmpNumber[]' value="+word[2]+" ></div>";
                                    childdiv+="</div>";
                                    childdiv+="</div>";
                                    //

                                    $('#tohide').append(childdiv);


                        k=i;
                        i++;
                    });
                    pagination++;


$('.paginator').remove();

                    $(function () {

                       if(pagination > 1){
                       $("#tohide").depagination();
                       }
                        $("#tohide").pagination();
                    });

                },

                //How you want the data formated when it is returned from the server.
                "json"

            );


            }
            function removeByValue(arr, val) {
                for(var i=0; i<arr.length; i++) {
                    if(arr[i] == val) {

                        arr.splice(i, 1);

                        break;

                    }
                }
            }
            function deleteCRow(id,value){

                answer = confirm("<?php echo __("Do you really want to Delete?") ?>");

                if (answer !=0)
                {

                    $("#row_"+value).remove();
                    removeByValue(myArray2, value);

                    $('#hiddeni').val(Number($('#hiddeni').val())-1);
                    

//            $.ajax({
//            type: "POST",
//            async:false,
//            url: "<?php //echo url_for('performance/AjaxDeleteAssignEmployee') ?>",
//            data: { EVid: $('#cmbbtype').val() , ETid: $('#cmbEtype').val() , Empno:value },
//            dataType: "json",
//            success: function(data){
//            }
//            });
                    $(function () {
                        $("#tohide").depagination();
                        $("#tohide").pagination();
                    });

                }
                else{
                    return false;
                }

            }

            
            
            $(document).ready(function() {  
                $("#txtName").focus();
                $("#fromdate").placeholder();
                $("#todate").placeholder();
                buttonSecurityCommon(null,"editBtn",null,null);

                $("#fromdate").datepicker({ dateFormat: '<?php echo $inputDate; ?>',onClose: function(dateText, inst) {
                        $('#fromdate').focus();
                        $('#fromdate').blur();


                    } });
                $("#todate").datepicker({ dateFormat: '<?php echo $inputDate; ?>',onClose: function(dateText, inst) {
                        $('#todate').focus();
                        $('#todate').blur();

                    } });
                
                $('#empRepPopBtn').click(function() {
                   
                var popup=window.open("<?php echo public_path('../../symfony/web/index.php/pim/searchEmployee?type=multiple&method=SelectEmployee') ?>",'Locations','height=450,width=800,resizable=1,scrollbars=1');
                
                if(!popup.opener) popup.opener=self;
                    popup.focus();
                });

<?php if($disAct->notice_code){ ?>
getData();
<?php } ?>

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


                jQuery.validator.addMethod("dateValidation",
                function(value, element) {
                    var hint = '<?php echo $inputDate; ?>';
                    var format = '<?php echo $format; ?>';
                    var fromdate = strToDate($('#fromdate').val(), format)
                    var todate = strToDate($('#todate').val(), format);

                    if (fromdate && todate && (fromdate > todate)) {
                        return false;
                    }
                    return true;
                }, ""
            );

<?php if ($mode == 0) { ?>
                    $("#editBtn").show();
                    buttonSecurityCommon(null,null,"editBtn",null);
                    $('#frmSave :input').attr('disabled', true);
                    $('#editBtn').removeAttr('disabled');
                    $('#btnBack').removeAttr('disabled');
<?php } ?>

                //Validate the fo9990rm
                $("#frmSave").validate({

                    rules: {
                        txtName:{required: true,maxlength:50},
                        txtNamesi:{maxlength:50},
                        txtNameta:{maxlength:50},
                        txtDes:{required: true,maxlength:500},
                        txtDesSi:{maxlength:500},
                        txtDesTa:{maxlength:500},
                        fromdate:{required:true,orange_date:true,dateValidation:true},
                        todate:{required:true,orange_date:true,dateValidation:true}

                    },
                    messages: {                        
                        txtName:{required: "<?php echo __("Notice Name is required") ?>",maxlength: "<?php echo __("Maximum length should be 50 characters") ?>"},
                        txtDes:{required:"<?php echo __("This field is required.") ?>",maxlength:"<?php echo __("Maximum 500 Characters") ?>"},
                        txtDesSi:{maxlength:"<?php echo __("Maximum 500 Characters") ?>"},
                        txtDesTa: {maxlength:"<?php echo __("Maximum 500 Characters") ?>"},
                        fromdate: {required:"<?php echo __("Start Date is required") ?>",orange_date:"<?php echo __("Please specify valid  date"); ?>",dateValidation:"<?php echo __("Please specify valid  date") ?>",yearValidation:"<?php echo __("Date is not in the Training Year") ?>"},
                        todate: {required:"<?php echo __("End Date is required") ?>",orange_date:"<?php echo __("Please specify valid  date"); ?>",dateValidation: "<?php echo __("Please specify valid  date") ?>"}

                    }
                });

                // When click edit button
                $("#frmSave").data('edit', <?php echo $editMode ? '1' : '0' ?>);

                // When click edit button
                $("#editBtn").click(function() {
                    var editMode = $("#frmSave").data('edit');
                    if (editMode == 1) {
                        // Set lock = 1 when requesting a table lock
                        location.href="<?php echo url_for('admin/saveNotice?id=' . $disAct->notice_code . '&lock=1') ?>";
                    }
                    else {
                        $('#frmSave').submit();
                    }

                });

                //When click reset buton
                $("#btnClear").click(function() {
                    location.href="<?php echo url_for('admin/saveNotice?id=' . $disAct->notice_code . '&lock=0') ?>";
                });

                //When Click back button
                $("#btnBack").click(function() {
                    location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/admin/listNotice')) ?>";

        });



    });
</script>



