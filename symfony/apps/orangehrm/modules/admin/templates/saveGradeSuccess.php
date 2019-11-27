<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.validate.js') ?>"></script>
<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.numeric.js') ?>"></script>
<div class="formpage4col" >
    <div class="navigation">

    </div>
    <div id="status"></div>
    <div class="outerbox">
        <div class="mainHeading"><h2><?php echo __("Add Grade") ?></h2></div>
        <form name="frmSave" id="frmSave" method="post"  action="<?php echo url_for('admin/saveGrade'); ?>">
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
                <label for="txtLocationCode"><?php echo __("Grade Name") ?> <span class="required">*</span></label>
            </div>
            <div class="centerCol">

                <input id="txtName"  name="txtName" type="text"  class="formInputText" value="" maxlength="100" />
                <input id="txtGradeId"  name="txtGradeId" type="hidden"  class="formInputText" value="" maxlength="100" />
            </div>

            <div class="centerCol">

                <input id="txtNamesi"  name="txtNamesi" type="text"  class="formInputText" value="" maxlength="100" />
            </div>

            <div class="centerCol">

                <input id="txtNameta"  name="txtNameta" type="text"  class="formInputText" value="" maxlength="100" />
            </div>
            <br class="clear"/>
            <div class="leftCol">
                <label for="txtLocationCode"><?php echo __("Basic Salary") ?> <span class="required">*</span></label>
            </div>
            <div class="centerCol">
            
                <input id="txtBasicsal"  name="txtBasicsal" type="text"  class="formInputText" value="" maxlength="10" onkeypress='return onkeyUpevent(event,this.id)' onblur='return validationGrade(event,this.id)' />
            </div>
            <br class="clear"/>
            <div class="leftCol">
                <label for="txtLocationCode"><?php echo __("Scale Years (Up to)") ?> <span class="required">*</span></label>
            </div>
            <div class="centerCol">

                <input id="txtScaleYear"  name="txtScaleYear" type="text"  class="formInputText" value="" maxlength="2" onkeypress='return onkeyUpevent(event,this.id)' onblur='return validationGrade(event,this.id)' />
            </div>
            <div class="centerCol">
                <label for="txtLocationCode"><?php echo __("Increment Amount") ?> <span class="required">*</span></label>
            </div>
            <div class="centerCol">

                <input id="txtIncrimentAmount"  name="txtIncrimentAmount" type="text"  class="formInputText" value="" maxlength="8" onkeypress='return onkeyUpevent(event,this.id)' onblur='return validationGrade(event,this.id)' />
            </div>
            <br class="clear"/>
                        <div id="bulkemp" >

                <div id="employeeGrid" class="centerCol" style="margin-left:10px; margin-top: 8px; width: 410px; border-style:  solid; border-color: #FAD163; ">
                    <div style="">
                        <div class="centerCol" style='width:100px; background-color:#FAD163;'>
                            <label class="languageBar" style="width:100px; padding-left:2px; padding-top:2px;padding-bottom: 1px; background-color:#FAD163; margin-top: 0px;  color:#444444;"><?php echo __("Years") ?></label>
                        </div>
                        <div class="centerCol" style='width:100px;  background-color:#FAD163;'>
                            <label class="languageBar" style="width:100px; padding-left:2px; padding-top:2px;padding-bottom: 1px; background-color:#FAD163; margin-top: 0px; color:#444444; text-align:inherit"><?php echo __("Increment Rate") ?></label>
                        </div>
                        <div class="centerCol" style='width:110px;  background-color:#FAD163;'>
                            <label class="languageBar" style="width:100px; padding-left:2px; padding-top:2px;padding-bottom: 1px; background-color:#FAD163; margin-top: 0px; color:#444444; text-align:inherit"><?php echo __("Salary") ?></label>
                        </div>
                        <div class="centerCol" style='width:100px;   background-color:#FAD163;'>
                            <label class="languageBar" style="width:100px; padding-left: 0px; padding-top:2px;padding-bottom: 1px; background-color:#FAD163; margin-top: 0px; color:#444444; text-align:inherit"><?php echo __("Remove") ?></label>
                        </div>

                    </div>
                    <div id="tohide">
                        <?php
                        if (strlen($childDiv)) {
                            echo $sf_data->getRaw('childDiv');
                        }
                        ?>

                    </div>
                    <br class="clear"/>
                </div>
            </div>


            <br class="clear"/>
            <div class="formbuttons">
                <input type="button" class="savebutton" id="editBtn"

                       value="<?php echo __("Save") ?>" tabindex="8" />
                <input type="button" class="clearbutton"  id="resetBtn"
                       value="<?php echo __("Reset") ?>" tabindex="9" />
                <input type="button" class="backbutton" id="Addtogridbutton"
                       value="<?php echo __("Add to Grid") ?>" onclick="addtoGrid($('#txtScaleYear').val())" tabindex="10" />
                <input type="button" class="backbutton" id="btnBack"
                       value="<?php echo __("Back") ?>" tabindex="11" />
            </div>
        </form>
    </div>

</div>
<div class="requirednotice"><?php echo __("Fields marked with an asterisk") ?><span class="required"> * </span> <?php echo __("are required") ?></div>
<script type="text/javascript">
                        var myArray2= new Array();
                        var empstatArray= new Array();

    function onkeyUpevent(event,id){




    }
            function validationGrade(e,id){
            if(isNaN($('#'+id).val())){
                alert("<?php echo __('Please enter digits') ?>");
                $('#'+id).val("");
                return false;
            }
            }
            function addtoGrid(empid){
                if($('#txtBasicsal').val()==""){
                   alert('<?php echo __("Please enter basic salary")?>');
                   return false;
                }
                if($('#txtScaleYear').val()==""){
                   alert('<?php echo __("Please enter scale years")?>');
                   return false;
                }
                if($('#txtIncrimentAmount').val()==""){
                   alert('<?php echo __("Please enter increment amount")?>');
                   return false;
                }


                var newBS=parseFloat($('#txtBasicsal').val());
                var currentBS=parseFloat($("#lblBS_0").val());
                if(newBS!=currentBS){
                    var bConfirmed = confirm("<?php echo __("Are you sure you want to calculate slots ?") ?>");
                    if (bConfirmed){
                    $.each(myArray2,function(key, value1){
                    $("#row_"+value1).remove();
                    });

                    myArray2 = new Array();
                    }else{
                        return false;
                    }
                    }

                var arraycp=new Array();

                var arraycp = $.merge([], myArray2);

                var items= new Array();

                for(var d=0; d<=$('#txtScaleYear').val(); d++){
                items[d]=d;
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

                "<?php echo url_for('admin/LoadGrid') ?>", //Ajax file



                { 'empid[]' : arraycp },  // create an object will all values

                //function that is c    alled when server returns a value.
                function(data){
                    var childdiv="";
                    var i=0;

                    $.each(arraycp, function(key, value) {
                                    childdiv="<div id='row_"+value+"' style='padding-top:0px;'>";
                                    childdiv+="<div class='centerCol' id='master' style='width:100px;'>";
                                    childdiv+="<div id='employeename' style='height:25px; padding-left:3px;'><input type='text' readonly='readonly' style='width:90px; color:#444444;' name='txtSY_"+value+"' id='txtSY_"+value+"' value='"+value+"'/></div>";
                                    childdiv+="</div>";

                                    childdiv+="<div class='centerCol' id='master' style='width:100px;'>";
                                    childdiv+="<div id='employeename' style='height:25px; padding-left:3px;'><input type='text' readonly='readonly' style='width:90px; color:#444444;' name='txtAM_"+value+"' id='txtAM_"+value+"'";
                                        if(value==0){
                                    childdiv+="value="+value;
                                        }else{
                                    childdiv+="value="+parseFloat($('#txtIncrimentAmount').val()).toFixed(2);
                                        }
                                    childdiv+="></div></div>";


                                    childdiv+="<div class='centerCol' id='master' style='width:110px;'>";
                                    childdiv+="<div style='height:25px; padding-left:3px;'><input type='text' readonly='readonly' style='width:90px; color:#444444;' name='lblBS_"+value+"' id='lblBS_"+value+"'";
                                        if(value==0){

                                    var BS=parseFloat($('#txtBasicsal').val());
                                    childdiv+="value="+BS;

                                        }else{
                                            var Amnt=value-1;
                                            var BS=parseFloat($("#lblBS_"+Amnt).val());
                                            var Inc=parseFloat($('#txtIncrimentAmount').val());
                                            var newSal=parseFloat(BS+Inc).toFixed(2);
                                            if(newSal>=9999999999){
                                                alert("<?php echo __("Basic salary maximum length has exceeded. Maximum basic salaray amount is 9999999999")?>");
                                                location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/admin/saveGrade')) ?>";
                                                return false;
                                        }
                                    childdiv+="value="+newSal;

                                    }
                                    childdiv+=" /></div></div>";

                                    childdiv+="<div class='centerCol' id='master' style='width:100px;'>";
                                    childdiv+="<div id='employeename' style='height:25px; padding-left:3px;'><a href='#' style='width:100px;' onclick='deleteCRow("+value+","+value+")'><?php echo __('Remove') ?></a><input type='hidden' name='SLTYR_[]' value='' ></div>";
                                    childdiv+="</div>";
                                    childdiv+="<input type='hidden' name='noofhead' value="+value+" ></div>";

$('#employeeGrid').append(childdiv);
                        i++;
                        
                    });
                    k=i;
                    

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
            var max=Math.max.apply(null, myArray2);
            if(max==id){
                answer = confirm("<?php echo __("Do you really want to delete?") ?>");

                if (answer !=0)
                {

                    $("#row_"+id).remove();
                    removeByValue(myArray2, value);

                    $('#hiddeni').val(Number($('#hiddeni').val())-1);

                }
                else{
                    return false;
                }
                }else{
                    alert("<?php echo __("Please remove last slot year first.") ?>");
                    return false;
                }

            }

            
    $(document).ready(function() {

        buttonSecurityCommon(null,"editBtn",null,null);


        //Validate the form
        $("#frmSave").validate({

            rules: {
                txtName: { required: true,noSpecialCharsOnly: true, maxlength:100 },
                txtNamesi: {noSpecialCharsOnly: true, maxlength:100 },
                txtNameta: {noSpecialCharsOnly: true, maxlength:100 },
                txtBasicsal:{required: true,noSpecialCharsOnly:true },
                txtScaleYear:{required: true,noSpecialCharsOnly:true },
                txtIncrimentAmount:{required: true,noSpecialCharsOnly:true }
            },
            messages: {
                txtName: {required:"<?php echo __("This field is required") ?>",maxlength:"<?php echo __("Maximum 100 Characters") ?>",noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>"},
                txtNamesi:{maxlength:"<?php echo __("Maximum 100 Characters") ?>",noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>"},
                txtNameta:{maxlength:"<?php echo __("Maximum 100 Characters") ?>",noSpecialCharsOnly:"<?php echo __("Special Characters are not allowed") ?>"},
                txtBasicsal:{required:"<?php echo __("This field is required") ?>",number:"<?php echo __("Invalid Value") ?>",noSpecialCharsOnly:"<?php echo __("No invalid characters are allowed") ?>"},
                txtScaleYear:{required:"<?php echo __("This field is required") ?>",number:"<?php echo __("Invalid Value") ?>",noSpecialCharsOnly:"<?php echo __("No invalid characters are allowed") ?>"},
                txtIncrimentAmount:{required:"<?php echo __("This field is required") ?>",number:"<?php echo __("Invalid Value") ?>",noSpecialCharsOnly:"<?php echo __("No invalid characters are allowed") ?>"}
                

            },

            submitHandler: function(form) {
                $('#editBtn').unbind('click').click(function() {return false}).val("<?php echo __('Wait..'); ?>");
                form.submit();
            }
        });

        $("#frmSave").data('edit', <?php echo $editMode ? '1' : '0' ?>);

        // When click edit button
        $("#editBtn").click(function() {
            if(myArray2==""){
                    alert("<?php echo __("Grade slot can not be blank.") ?>");
                    return false;
                }else{

            $('#frmSave').submit();
                }
                                         
        });

        //When click reset buton
        $("#resetBtn").click(function() {
            document.forms[0].reset('');
        });

        //When Click back button
        $("#btnBack").click(function() {
            location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/admin/listGrade')) ?>";
        });

    });
</script>

