<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery-ui.min.js') ?>"></script>
<!--<link href="<?php echo public_path('../../themes/orange/css/jquery/jquery-ui.css') ?>" rel="stylesheet" type="text/css"/>-->
<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.validate.js') ?>"></script>
<!--<link href="../../themes/orange/css/style.css" rel="stylesheet" type="text/css"/>-->
<script type="text/javascript" src="<?php echo public_path('../../scripts/time.js') ?>"></script>
<link href="<?php echo public_path('../../images/jquerybubblepopup-theme/jquery.bubblepopup.v2.3.1.css') ?>" rel="stylesheet" type="text/css"/>
<script src="<?php echo public_path('../../scripts/jquery/jquery.bubblepopup.v2.3.1.min.js') ?>" type="text/javascript"></script>

<?php

$editMode = ($mode != 'select_subunit');
$mymode = $mode;

$sysConfig=new sysConf();
?>
<?php if($mode == 'select_subunit'){ ?>


    <div id="layerComStruct" style="background-color: white; border-style: solid; border-color: #FAD163;">
                <div id="errorMsgDiv"><?php echo message(); ?></div>
                <h2><?php echo __("Company Info : Company Structure") ?></h2>
                <br />
                <div id="MainDiv">
                <form name="frmSave" id="frmSave" method="post"  action="">
            <div class="leftCol">
                <label class="controlLabel" for="txtLocationCode"><?php echo __("Section") ?> <span class="required">*</span></label>
            </div>
            <div class="centerCol">
                <select name="cmbProvince" id="cmbProvince" class="formSelect" style="width: 160px;" tabindex="4" onchange='getData(this.value,"3","District");'>

                    <option value=""><?php echo __("--Select--") ?></option>
                    <?php foreach ($ProvinceList as $Province) {
                        ?>
                        <option value="<?php echo $Province->id ?>" title="<?php
                        $abc = "title_" . $userCulture;
                        if ($userCulture == "en")
                            echo $Province->title;
                        else
                            if($Province->$abc==null){
                                echo $Province->title;
                            }else{
                                echo $Province->$abc;
                            }
             
                        ?>">
                     <?php
                        $abc = "title_" . $userCulture;
                        if ($userCulture == "en")
                            echo $Province->title;
                        else
                            if($Province->$abc==null){
                                echo $Province->title;
                            }else{
                                echo $Province->$abc;
                            }
             
                        ?></option>
                    <?php } ?>

                </select>
            </div>
            <br class="clear"/>
            <div class="leftCol" id="devDistrict" ></div> <br class="clear"/>
            <div class="leftCol" id="devDivision" ></div> <br class="clear"/>
            <div class="leftCol" id="devZone" ></div> <br class="clear"/>
            <div class="leftCol" id="devWasam" ></div> <br class="clear"/>
            <?php  if(!isset($_GET['button'])){
                
                ?>
            <div class="leftCol" id="sumbit" ><div class="formbuttons">
            <input type="button" class="editbutton" id="btnsubmit"
                                       value="<?php echo __("Submit") ?>" tabindex="8" /></div> <br class="clear"/>        
            
            </div> 
            <?php }  ?>
            </form>
                  
       
    </div>
    </div>
<?php }else { ?>
<!-- @author - sujith -->
<!-- when modifying please have very meaningful names for variables and follow camel notation -->
<table cellspacing="0" cellpadding="5px">
    <tr>
        <!-- section to display company structure hierarchy -->
        <td>
        </td>
        <td valign="top">
            <div id="layerComStruct" style="background-color: white; border-style: solid; border-color: #FAD163; ">
                <div id="errorMsgDiv"><?php echo message(); ?></div>
                <h2><?php echo __("Company Info : Company Structure") ?></h2>
                <br />

                <?php if ($rootName == "") { ?>

                    <div class="err"><?php echo __("Please define Company General Information first!") ?></div>
                <?php } else {
                ?>  
                    <table id="tblCompStruct" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse" >
                        <tr>
                            <td>
                                
                            </td>


                        </tr>
                        <!--cannot use $v here to access elements since its a sfOutputEscaperArrayDecorator object -->

                        <tr>

                            <td>
                                <table border="0" >

                                    <tr>
                                        <td>
           
         
         <form name="frmShowGrid" id="frmShowGrid" method="post" action="<?php echo url_for('admin/listCompanyStructure') ?>">

             <div class="leftCol">
                 <label style="margin-top:0px;" for="txtLocationCode"><?php echo __("Category") ?></label>
             </div>
             <div class="centerCol">
                  
                 <?php
                    $sysConf=new sysConf();
                   
                 ?>
                <select name="cmbHicCategory" id="cmbHicCategory"  style="width: 100px;" tabindex="4" onchange='getData(this.value,"3","District");'>

                    <option value=""><?php echo __("--Select--") ?></option>
                    <option value="<?php echo $sysConf->ProvinceLevel; ?>" <?php if($sysConf->ProvinceLevel==$selectedCat) echo "selected" ?> ><?php echo __("Province") ?></option>
                    <option value="<?php echo $sysConf->DistrictLevel; ?>" <?php if($sysConf->DistrictLevel==$selectedCat) echo "selected" ?>><?php echo __("District") ?></option>
                    <option value="<?php echo $sysConf->DivisionLevel; ?>" <?php if($sysConf->DivisionLevel==$selectedCat) echo "selected" ?>><?php echo __("Division") ?></option>
                   
                    <option value="<?php echo $sysConf->ZonalLevel; ?>" <?php if($sysConf->ZonalLevel==$selectedCat) echo "selected"  ?>><?php echo __("Zone") ?></option>
                    <option value="<?php echo $sysConf->WasamLevel; ?>" <?php if($sysConf->WasamLevel==$selectedCat) echo "selected" ?> ><?php echo __("Wasam") ?></option>
<!--                    <option value="0" <?php if("0"==$selectedCat) echo "selected"  ?>><?php echo __("HeadOffice") ?></option>-->

                </select>
             
<!--                 <input style="margin-left:10px;margin-top:10px; " type="submit"  value="show" class="plainbtn" />-->
  
              
            </div>
             <br/>
 <div class="leftCol">
                 <label style="margin-top:0px;" for="txtLocationCode">  <?php echo __("Search By") ?></label>
             </div>
         <div class="centerCol">

             
                <select name="cmbSearchMode" id="cmbSearchMode" style="width:100px;">
                    <option value="all"><?php echo __("--Select--") ?></option>
                    <option value="id" <?php if($searchMode=="id") echo "selected"; ?>><?php echo __("Code") ?></option>
                    <option value="title" <?php if($searchMode=="title") echo "selected"; ?>><?php echo __("Name") ?></option>
                </select>
        </div>
                 <br/>
     <div class="leftCol">
         <label style="margin-top:0px;" for="txtSearchValue"><?php echo __("Search For:") ?></label>
         </div>
                 <div class="centerCol">
                <input type="text" style="width:100px;"  name="txtSearchValue" id="txtSearchValue" value="<?php echo $searchValue ?>" />
                  </div>
                  <br/>
                 <div class="leftCol">
                <input type="button" class="plainbtn" id="btnSearch"
                       value="<?php echo __("Search") ?>" />
                <input type="reset" class="plainbtn" id="btnResetsearch"
                       value="<?php echo __("Reset") ?>" />
                </div>

       

             <br/>
                 
             <input type="hidden" name="mode" id="mode" value=""/>
            <table cellpadding="0" cellspacing="0" class="data-table" style="width:320px;">
                <thead>
                    <tr>
                        <td style="width:50px;">
                            
                        </td>
                        <td scope="col" style="width:50px;">
                        </td>
                        <td scope="col" style="width:100px;">
                            <?php echo  __('Code'); ?>
                        </td>
                        <td scope="col" style="width:100px;">
                            <?php echo  __('Description'); ?>
                        </td>
                    </tr>
                </thead>

                <tbody>
                    
                    <?php
                            $row = 0;
                            foreach ($listComPanyStrut as $comHie) {
                                $cssClass = ($row % 2) ? 'even' : 'odd';
                                $row = $row + 1;
                    ?>
                             <tr class="<?php echo $cssClass ?>"  >
                                 <td valign='bottom' style="width:50px;">
                                   <?php
                                if($sysConf->headOfficeCode==$comHie['id']){
                                    
                                }
                            else{ ?>
                                <a href='javascript:editCompanyStructure("add", "<?php echo $comHie['id']; ?>","Add a sub-division to #Division")' class='add addLink'><?php echo __("Add") ?></a>
                            <?php } ?>
                                </td>
                                <td valign="bottom"><a href="javascript:deleteCompanyStructure(<?php echo $comHie['id']; ?>,'<?php echo __("Are you sure you want to delete #SubDivision?"); ?>');" class="add deleteLink" style="width:50px;"><?php echo __("Delete") ?></a></td>
                                   

                          <td class="" style="width:100px;">
                            
                           <a class="add linkHint" onMouseOver="LoadHicTooltip(this.id)" id="<?php echo $comHie['id']; ?>"  href="javascript:editCompanyStructure('update', <?php echo $comHie['id']; ?>,'<?php echo __("Edit"); ?>');">
                                            <?php echo $comHie['comp_code']; ?>
                           </a>
                           <?php
                             if($userCulture=="en"){
                                 $title=$comHie['title'];
                             }else{
                                 if($comHie['title_'.$userCulture]==""){
                                      $title=$comHie['title'];
                                 }
                                 else{
                                     $title=$comHie['title_'.$userCulture];
                                 }
                             }
                           ?>
                                        <?php
                                        $childTitle = $title;
                                        $updString = $comHie['id'] . "|" . $comHie['parnt'] . "|" . $comHie['title'] . "|" . $comHie['title_si'] . "|" . $comHie['title_ta'] . "|" . $comHie['address'] . "|" . $comHie['address_si'] . "|" . $comHie['address_ta'] . "|" . $row['phone_intercom'] . "|" . $comHie['phone_vip'] . "|" . $comHie['phone_direct_line'] . "|" . $comHie['phone_extension'] . "|" . $comHie['fax'] . "|" . $comHie['email'] . "|" . $comHie['url'] . "|" . $comHie['emp_number'] . "|" . $childTitle . "|" . $employeeName . "|" . $comHie['def_level'] . "|" . $comHie['comp_code']."|".$comHie['comp_location_code']."|".$comHie['comp_reference_code']."|".$comHie['comp_isfunctional'];
                                        ?>
                           <input type="hidden" id="structureData_<?php echo $comHie['id']; ?>" value="<?php echo $updString; ?>" />
                         </td>
                        <td class="" style="width:100px;">
                            <a class="add linkHint" onMouseOver="LoadHicTooltip(this.id)" id="<?php echo $comHie['id']; ?>"  href="javascript:editCompanyStructure('update', <?php echo $comHie['id']; ?>,'<?php echo __("Edit"); ?>');"> 
                            <?php
                             if($userCulture=="en"){
                                 $title=$comHie['title'];
                             }else{
                                 if($comHie['title_'.$userCulture]==""){
                                      $title=$comHie['title'];
                                 }
                                 else{
                                     $title=$comHie['title_'.$userCulture];
                                 }
                             }
                           ?>
                            <?php
                             echo $title;
                            ?>
                            </a>
                        </td>
                        

                             </tr>
<?php } ?>
                </tbody>
            </table>
              <div class="noresultsbar"></div>
            <div class="pagingbar"><?php echo is_object($pglay) ? $pglay->display() : ''; ?> </div>
            <br class="clear" />
        </form>
        
                                        </td>
                                    </tr>
                                </table>    
                                </td>

                            </tr>

                            <input type="hidden" id="deleteAction" value="<?php echo url_for('admin/listCompanyStructure'); ?>" />
                        </table>
                <?php } ?>
                                </div>
                            </td>

        <?php if ($mode != 'select_subunit') {
 ?>
                                        <!-- section to display forms to insert edit company structure -->
                                        <td valign="top">
                                            <!-- Add/Edit Sub Division form -->
                                            <div id="layerForm"  class="formpage4col" style="margin-right:10px;width:460px;display:none;">
                                                <div class="outerbox">
                                                    <div class="subHeading"><h3 id="parnt">&nbsp;</h3></div>
                                                    <form name="frmAddNode" id="frmAddNode" method="post" action="<?php echo url_for('admin/saveCompanyStructure') ?>">
                                                        <input type="hidden" value="" id="txtParnt" name="txtParnt"/>
                                                        <input type="hidden" value="" id="txtDefLevel" name="txtDefLevel"/>
                                                        <input type="hidden" value="" id="id" name="id"/>
                                                        <div class="leftCol">
                                                            <label for="txtCompanyName"><?php echo __("Division code") ?><span class="required">*</span></label>
                                                        </div>
                                                        <div class="centerCol">
                                                            <input id="txtDivisionCode" name="txtDivisionCode" type="text"
                                                                   class="formInputText required"
                                                                   value="" maxlength="20" tabindex="1" style="width:250px;"/>
                                                        </div>
                                                        <br class="clear"/>
                                                        <div class="leftCol">
                                                            <label for="txtCompanyName"><?php echo __("Division Name") ?><span class="required">*</span></label>
                                                        </div>
                                                        <div class="centerCol">
                                                            <input id="txtCompanyName" name="txtCompanyName" type="text"
                                                                   class="formInputText required"
                                                                   value="" maxlength="200" tabindex="1" style="width:250px;"/>
                                                        </div>
                                                        <br class="clear"/>

                                                        <div class="leftCol">
                                                            <label for="txtCompanyNameSI"><?php echo __("Division Name (Sinhala)") ?></label>
                                                        </div>
                                                        <div class="centerCol">
                                                            <input id="txtCompanyNameSI" name="txtCompanyNameSI" style="width:250px;" type="text" class="formInputText"
                                                                   value="" maxlength="200" tabindex="1"/>
                                                        </div>
                                                        <br class="clear"/>

                                                        <div class="leftCol">
                                                            <label for="txtCompanyNameTA"><?php echo __("Division Name (Tamil)") ?></label>
                                                        </div>
                                                        <div class="centerCol">
                                                            <input id="txtCompanyNameTA" name="txtCompanyNameTA" style="width:250px;" type="text" class="formInputText"
                                                                   value="" maxlength="200" tabindex="1"/>
                                                        </div>
                                                        <br class="clear"/>
                                                        
                                                    <div class="leftCol">
                                                            <label for="lblCompanyNameTA"><?php echo __("Location DB Reference Code") ?></label>
                                                        </div>
                                                        <div class="centerCol">
                                                            <input id="txtLocationDBReferenceCode" name="txtLocationDBReferenceCode" style="width:250px;" type="text" class="formInputText"
                                                                   value="" maxlength="30" tabindex="1"/>
                                                        </div>
                                                        <br class="clear"/>
                                                        
                                                      <div class="leftCol">
                                                            <label for="lblAdditionalReferenceCode"><?php echo __("Additional Reference Code") ?></label>
                                                        </div>
                                                        <div class="leftCol">
                                                            <input id="txtAdditionalReferenceCode" name="txtAdditionalReferenceCode" style="width:250px;" type="text" class="formInputText"
                                                                   value="" maxlength="20" tabindex="1"/>
                                                        </div>
                                                        <br class="clear"/>
                                                        <div class="centerCol">
                                                            <table>
                                                                <tr>
                                                                    <td>
                                                                        <label for="lblradioFunctional" style="width:50px;"><?php echo __("Functional") ?></label>
                                                                    </td>
                                                                    <td>
                                                                       <input id="radioFunctional" name="radioFunctional"  type="radio" value="1" <?php ?> class="formInputText"
                                                                   value=""  tabindex="1"/>
                                                                    </td>
                                                                    <td>
                                                                        <label for="lblradioFunctional" style="width:50px;"><?php echo __("Non Functional") ?></label>
                                                                    </td>
                                                                    <td>
                                                                        <input id="radioNonFunctional" name="radioFunctional"  type="radio" value="0" class="formInputText"
                                                                   value=""  tabindex="1"/>
                                                                    </td>
                                                                </tr>

                                                            </table>

                                                        </div>
                                                        
                                                        <br class="clear"/> 
                                                        <div id="bulkemp" >
                                                            <div class="leftCol">
                                                                <label id="lblemp" class="controlLabel" ><?php echo __("Division Head(s)") ?> </label>
                                                            </div>
                                                            <div class="centerCol" style="padding-top: 8px;">
                                                                <input class="button" type="button" value="..." id="empRepPopBtn" name="empRepPopBtn" <?php echo $disabled; ?> /><br>
                                                                <input  type="hidden" name="txtEmpId" id="txtEmpId" value="<?php echo $etid; ?>"/>
                                                            </div>
                                                            <br class="clear"/>
                                                            <div id="employeeGrid" class="centerCol" style="margin-left:10px; margin-top: 8px; width: 400px; border-style:  solid; border-color: #FAD163; ">
                                                                <div style="">
                                                                    <div class="centerCol" style='width:100px; background-color:#FAD163;'>
                                                                        <label class="languageBar" style="padding-left:2px; padding-top:2px;padding-bottom: 1px; background-color:#FAD163; margin-top: 0px;  color:#444444;"><?php echo __("Id") ?></label>
                                                                    </div>
                                                                    <div class="centerCol" style='width:150px;  background-color:#FAD163;'>
                                                                        <label class="languageBar" style="padding-left:2px; padding-top:2px;padding-bottom: 1px; background-color:#FAD163; margin-top: 0px; color:#444444; text-align:inherit"><?php echo __("Employee Name") ?></label>
                                                                    </div>
                                                                    <div class="centerCol" style='width:100px;  background-color:#FAD163;'>
                                                                        <label class="languageBar" style="padding-left:2px; padding-top:2px;padding-bottom: 1px; background-color:#FAD163; margin-top: 0px; color:#444444; text-align:inherit"><?php echo __("Role") ?></label>
                                                                    </div>
                                                                    <div class="centerCol" style='width:50px;   background-color:#FAD163;'>
                                                                        <label class="languageBar" style="width:50px; padding-left: 0px; padding-top:2px;padding-bottom: 1px; background-color:#FAD163; margin-top: 0px; color:#444444; text-align:inherit"><?php echo __("Remove") ?></label>
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

                            <div class="leftCol">
                                <label for="txtAddress"><?php echo __("Address") ?></label>
                            </div>
                            <div class="centerCol">
                                <textarea id='txtAddress' name='txtAddress'  class="formTextArea"
                                          rows="3" cols="20" tabindex="3" ></textarea>
                            </div>
                            <br class="clear"/>

                            <div class="leftCol">
                                <label for="txtAddressSI"><?php echo __("Address (Sinhala)") ?></label>
                            </div>
                            <div class="centerCol">
                                <textarea id='txtAddressSI' name='txtAddressSI'  class="formTextArea"
                                          rows="3" cols="20" tabindex="3" ></textarea>
                            </div>
                            <br class="clear"/>

                            <div class="leftCol">
                                <label for="txtAddressTA"><?php echo __("Address (Tamil)") ?></label>
                            </div>
                            <div class="centerCol">
                                <textarea id='txtAddressTA' name='txtAddressTA'  class="formTextArea"
                                          rows="3" cols="20" tabindex="3" ></textarea>
                            </div>
                            <br class="clear"/>

                            <div class="leftCol">
                                <label for="txtPhoneIntercom"><?php echo __("Telephone (Intercom)") ?></label>
                            </div>
                            <div class="centerCol">
                                <input id='txtPhoneIntercom' name='txtPhoneIntercom' type="text"  class="formInputText"
                                       value="" maxlength="30" tabindex="5"/>
                            </div>
                            <br class="clear"/>

                            <div class="leftCol">
                                <label for="txtPhoneVIP"><?php echo __("Telephone (VIP)") ?></label>
                            </div>
                            <div class="centerCol">
                                <input id='txtPhoneVIP' name='txtPhoneVIP' type="text"  class="formInputText"
                                       value="" maxlength="30" tabindex="5"/>
                            </div>
                            <br class="clear"/>

                            <div class="leftCol">
                                <label for="txtPhoneDirectLine"><?php echo __("Telephone (Direct Line)") ?></label>
                            </div>
                            <div class="centerCol">
                                <input id='txtPhoneDirectLine' name='txtPhoneDirectLine' type="text"  class="formInputText"
                                       value="" maxlength="30" tabindex="5"/>
                            </div>
                            <br class="clear"/>

                            <div class="leftCol">
                                <label for="txtPhoneExtension"><?php echo __("Telephone (Extension)") ?></label>
                            </div>
                            <div class="centerCol">
                                <input id='txtPhoneExtension' name='txtPhoneExtension' type="text"  class="formInputText"
                                       value="" maxlength="30" tabindex="5"/>
                            </div>
                            <br class="clear"/>

                            <div class="leftCol">
                                <label for="txtFax"><?php echo __("Fax") ?></label>
                            </div>
                            <div class="centerCol">
                                <input id="txtFax" name="txtFax" type="text"   class="formInputText"
                                       value="" maxlength="30" tabindex="6"/>
                            </div>
                            <br class="clear"/>

                            <div class="leftCol">
                                <label for="txtEmail"><?php echo __("Email") ?></label>
                            </div>
                            <div class="centerCol">
                                <input type="text" name="txtEmail" id="txtEmail" class="formInputText"
                                       value="" maxlength="100" tabindex="7"/>
                            </div>
                            <br class="clear"/>

                            <div class="leftCol">
                                <label for="txtURL"><?php echo __("URL") ?></label>
                            </div>
                            <div class="centerCol">
                                <input type="text" name="txtURL" id="txtURL" class="formInputText"
                                       value="" maxlength="200" tabindex="7"/>
                            </div>
                            <br class="clear"/>

                            <div class="formbuttons">
                                <input type="button" class="editbutton" id="btnEdit"
                                       onmouseover="moverButton(this);" onmouseout="moutButton(this);"
                                       value="<?php echo __("Edit") ?>" tabindex="8" />
                                <input type="button" class="clearbutton"   id="btnReset"
                                       onmouseover="moverButton(this);" onmouseout="moutButton(this);"
                                       value="<?php echo __("Reset") ?>" tabindex="9" />
                                <input type="button" class="savebutton" onclick="hideAddEditSubDivision();" id="btnHide"
                                       value="<?php echo __("Hide") ?>"/>
                            </div>
                        </form>
                    </div>
                                                <div class="requirednotice" ><?php echo __("Fields marked with an asterisk") ?><span class="required"> * </span> <?php echo __("are required") ?></div>
                    <br class="clear" />

                </div>
            </td>
<?php } ?>
                                </tr>
                            </table>
<?php } ?>
                            <script type="text/javascript">
                                // <![CDATA[

                                var limthiecodelevel="<?php echo $hiecodelevel; ?>";
                                var myArray2= new Array();
                                var empstatArray= new Array();
                                var id;
                                var k;
                                var counter=0;
                                var compId=null;
                                
                                function getData(id,def,div){
                                  var nextdiv;
                                  var nextdef;
                                  var divlang;
                                  if(div=="District"){
                                      nextdiv="Division";
                                      nextdef="4";
                                      divlang="<?php echo __("District"); ?>";
                                      $("#cmbDistrict").remove();
                                      $("#cmbDivision").remove();
                                      $("#cmbZone").remove();
                                      $("#cmbWasam").remove();
                                      $("#lblDistrict").remove();
                                      $("#lblDivision").remove();
                                      $("#lblZone").remove();
                                      $("#lblWasam").remove();                                      
                                  }else if(div=="Division"){
                                      nextdiv="Zone";
                                      nextdef="5";
                                      divlang="<?php echo __("Division"); ?>";
                                      $("#cmbDivision").remove();
                                      $("#cmbZone").remove();
                                      $("#cmbWasam").remove();
                                      $("#lblDivision").remove();
                                      $("#lblZone").remove();
                                      $("#lblWasam").remove();                                      
                                  }else if(div=="Zone"){
                                      $("#cmbZone").remove();
                                      $("#cmbWasam").remove();
                                      $("#lblZone").remove();
                                      $("#lblWasam").remove();                                      
                                      nextdiv="Wasam";
                                      nextdef="6";
                                      divlang="<?php echo __("Zone"); ?>";
                                  }else if(div=="Wasam"){
                                      divlang="<?php echo __("Wasam"); ?>";
                                  }
                                $.post(

                                "<?php echo url_for('admin/AjaxloadData') ?>", //Ajax file

                                { id : id , def : def  },  // create an object will all values

                                //function that is called when server returns a value.
                                function(data){
                                    if(data!=''){
                                    var selectbox="<div  name='lbl"+div+"' id='lbl"+div+"' class='leftCol'><label for='txtLocationCode' class='controlLabel'>"+divlang;
                                    if(div=="District"){
                                    selectbox=selectbox +"<span class='required'>*</span>";
                                    }
                                    $("cmb"+div).empty();
                                    selectbox=selectbox +"</label></div>";
                                    selectbox=selectbox +"<div  class='centerCol'><select name='cmb"+div+"' id='cmb"+div+"' class='formSelect' style='width: 160px;' tabindex='4' ";
                                    if(limthiecodelevel > nextdef){
                                        selectbox=selectbox +"onchange='getData(this.value,\""+nextdef+"\",\""+nextdiv+"\");'"; 
                                    }                                       
                                    
                                    selectbox=selectbox +">";
                                    selectbox=selectbox +"<option value=''><?php echo __('--Select--') ?></option>";
                                    $.each(data, function(key, value) {

                                        selectbox=selectbox +"<option value="+key+" title='"+value+"' >"+value+"</option>";
                                    });
                                    selectbox=selectbox +"</select></div>";
                                    $("#dev"+div).html(selectbox);
                                    }
                                },

                                //How you want the data formated when it is returned from the server.
                                "json"

                            );
                            
                            }
                                
                                
                                
                                
                                function SelectEmployee(data){

                                    myArr=new Array();
                                    lol=new Array();
                                    myArr = data.split('|');

                                    addtoGrid(myArr,null);
                                    //addtoGrid(myArr);
                                }

                                function addtoGrid(empid,compId){

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
                                    if(arraycp.length>0){
                                        $.ajax({
                                            type: "POST",
                                            async:false,
                                            url: "<?php echo url_for('admin/LoadGrid') ?>",
                                            data: { 'empid[]' : arraycp,compId: compId },
                                            dataType: "json",
                                            beforeSend: function(){

                                                $('#ajaxLoader').show();
                                            },
                                            success: function(data){
                                                $('#ajaxLoader').hide();

                                                $('#tohide').show();
                                                var childdiv="";
                                                var lockm=$("#frmAddNode").data('edit');
                                                var disable;
                                                if(lockm==0){
                                                    disable="disabled";
                                                }else{
                                                    disable="";
                                                }

                                                $.each(data, function(key, value) {
                                                    var word=value.split("|");

                                                    childdiv="<div id='row_"+counter+"' style='padding-top:0px;'>";
                                                    childdiv+="<div class='centerCol' id='master' style='width:100px;'>";
                                                    childdiv+="<div id='employeename' style='height:30px; padding-left:3px;'>"+word[0]+"</div>";
                                                    childdiv+="</div>";

                                                    childdiv+="<div class='centerCol' id='master' style='width:150px;'>";
                                                    childdiv+="<div id='employeename' style='height:30px; padding-left:3px;'>"+word[1]+"</div>";
                                                    childdiv+="</div>";

                                                    childdiv+="<div class='centerCol' id='master' style='width:100px;'>";
                                                    childdiv+="<div id='employeename' style='height:30px; padding-left:3px;'>"
                                                    childdiv+="<select class='cmbrole' name='CmbEmpRole_"+counter+"' id='CmbEmpRole_"+counter+"'  style='width: 90px;'>";
                                                    childdiv+="<option value='' ><?php echo __("--Select--") ?></option>";
<?php foreach ($emprole as $row) { ?>
                                                                childdiv+="<option value='<?php echo $row['role_group_id']; ?>'";
                                                                if(word[5]=='<?php echo $row['role_group_id']; ?>'){
                                                                    childdiv+="selected=selected";
                                                                }
                                                                childdiv+="><?php if ($userCulture == "en") {
                                            echo $row['role_group_name'];
                                        } else {
                                            if ($row['role_group_name_' . $userCulture] == null) {
                                                echo $row['role_group_name'];
                                            } else {
                                                echo $row['role_group_name_' . $userCulture];
                                            }
                                        } ?></option>";
<?php } ?>
                                                            childdiv+="</select></div></div>";

                                                            childdiv+="<div class='centerCol' id='master' style='width:30px;'>";
                                                            childdiv+="<div id='employeename' style='height:30px; padding-left:3px;'><a href='#' class='rurl' style='width:50px;' onclick='deleteCRow("+counter+","+word[4]+")'><?php echo __('Remove') ?></a><input type='hidden' name='EmpNumber_[]' value="+word[4]+" ></div>";
                                                            childdiv+="</div>";
                                                            childdiv+="<input type='hidden' name='hiddenEmpID_"+counter+"' value="+word[4]+" ></div></br>";
                                                            $('#tohide').append(childdiv);

                                                            counter++;

                                                        });

                                                    }
                                                });
                                            }



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
                                        var editMode = $("#frmAddNode").data('edit');
                                        if(editMode!=0){
                                            answer = confirm("<?php echo __("Do you really want to Delete?") ?>");

                                            if (answer !=0)
                                            {

                                                $("#row_"+id).remove();
                                                removeByValue(myArray2, value);

                                                $('#hiddeni').val(Number($('#hiddeni').val())-1);

                                            }
                                            else{
                                                return false;
                                            }}

                                        }






                                        function getCompanyDetails(id){
                                            $.post("<?php echo url_for('admin/GetCompanyDetailsById') ?>",
                                            { id: id },
                                            function(data){
                                                setCompanyDetails(data);
                                                //getCompanyStructureTreeDetails(id)
                                            },
                                            "json"
                                        );
                                        }
                                        function getCompanyStructureTreeDetails(id){
                                            $.post("<?php echo url_for('admin/GetCompanyStructureTreeDetailsById') ?>",
                                            { id: id },
                                            function(data){
                                                setCompanyStructureTreeDetailsPageLoad(data);
                                            },
                                            "json"
                                        );
                                        }
                                        function setCompanyStructureTreeDetailsPageLoad(data){
                                            $.each(data, function(key,value) {
                                                var word=value.split("|");
                                                addtoGrid(word[1],word[0]);
                                            });
                                        }

                                        function lockCompanyDetails(id){
                                            $.post("<?php echo url_for('admin/lockCompanyDetails') ?>",
                                            { id: id },
                                            function(data){
                                                if (data.recordLocked==true) {
                                                    getCompanyDetails(id);
                                                    $("#frmAddNode").data('edit', '1'); // In edit mode
                                                    setCompanyDetailsAttributes();
                                                }else {
                                                    alert("<?php echo __("Can not update. Record locked by another user.") ?>");
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
                                                $("#frmAddNode").data('edit', '0'); // In view mode
                                                setCompanyDetailsAttributes();
                                            },
                                            "json"
                                        );
                                        }
                                        function addtoGridToEdit(id){

                                                $.ajax({
                                                    type: "POST",
                                                    async:false,
                                                    url: "<?php echo url_for('admin/getUnitHeadListbyId') ?>",
                                                    data: { id: id },
                                                    dataType: "json",
                                                    beforeSend: function(){


                                                    },
                                                    success: function(data){
                                                        $('#tohide').empty();
                                                        myArray2=new Array();
                                                        addtoGrid(data,id);

                                                    }
                                                });


                                        }

                                        function setCompanyDetails(data){

                                            $("#txtDivisionCode").val(data.comp_code);
                                            $("#txtCompanyName").val(data.title);
                                            if(data.title_si!=null){
                                                $("#txtCompanyNameSI").val(data.title_si);
                                            }
                                            if(data.title_ta!=null){
                                                $("#txtCompanyNameTA").val(data.title_ta);
                                            }
                                            $("#txtUnitHead").val(data.emp_display_name);
                                            if(data.emp_number!=null){
                                                $("#txtUnitHeadEmpId").val(data.emp_number);
                                            }
                                            if(data.address!=null){
                                                $("#txtAddress").val(data.address);
                                            }
                                            if(data.address_si!=null){
                                                $("#txtAddressSI").val(data.address_si);
                                            }
                                            if(data.address_ta!=null){
                                                $("#txtAddressTA").val(data.address_ta);
                                            }
                                            if(data.phone_intercom!=null){
                                                $("#txtPhoneIntercom").val(data.phone_intercom);
                                            }
                                            if(data.phone_vip!=null){
                                                $("#txtPhoneVIP").val(data.phone_vip);
                                            }
                                            if(data.phone_direct_line!=null){
                                                $("#txtPhoneDirectLine").val(data.phone_direct_line);
                                            }
                                            if(data.phone_extension!=null){
                                                $("#txtPhoneExtension").val(data.phone_extension);
                                            }
                                            if(data.fax!=null){
                                                $("#txtFax").val(data.fax);
                                            }
                                            if(data.email!=null){
                                                $("#txtEmail").val(data.email);
                                            }
                                            if(data.url!=null){
                                                $("#txtURL").val(data.url);
                                            }
                                            if(data.comp_location_code!=null){
                                                $("#txtLocationDBReferenceCode").val(data.comp_location_code);
                                            }
                                            if(data.comp_reference_code!=null){
                                                $("#txtAdditionalReferenceCode").val(data.comp_reference_code);
                                            }
                                            if(data.comp_isfunctional==1){
                                                $("#radioFunctional").attr('checked', true);
                                            }
                                            if(data.comp_isfunctional==0){
                                                $("#radioNonFunctional").attr('checked', true);
                                            }
                                        }

                                        function setCompanyDetailsAttributes() {

                                            buttonSecurityCommon(null,null,"btnEdit",null);
                                            buttonSecurityCommonMultiple("addLink",null,null,"deleteLink");
                                            var editMode = $("#frmAddNode").data('edit');
                                            if (editMode == 0) {
                                                $('#frmAddNode :input').attr('disabled','disabled');
                                                $('#btnEdit').removeAttr('disabled');
                                                $('#btnHide').removeAttr('disabled');

                                                $("#btnEdit").attr('value',"<?php echo __("Edit"); ?>");
                                                $("#btnEdit").attr('title',"<?php echo __("Edit"); ?>");
                                            }
                                            else {
                                                $('.cmbrole').removeAttr('disabled');
                                                $('#frmAddNode :input').removeAttr('disabled');

                                                $("#btnEdit").attr('value',"<?php echo __("Save"); ?>");
                                                $("#btnEdit").attr('title',"<?php echo __("Save"); ?>");
                                            }
                                        }

                                        function editCompanyStructure(mode, id, message) {

                                            $("label.errortd[generated='true']").css('display', 'none');

                                            var structureData = ($("#structureData_" + id).val()).split("|");
                                            var caption = "";
                                           

                                            //this is to unlock update screen
                                            if(mode == 'update') {
                                                $('#tohide').show();
                                                $('#errorMsgDiv').hide();
                                                $('#ajaxLoader').hide();
                                                addtoGridToEdit(id);

                                                $("#id").val(id);
                                                $("#txtParnt").val(structureData[1]);
                                                $("#txtCompanyName").val(structureData[2]);
                                                $("#txtCompanyNameSI").val(structureData[3]);
                                                $("#txtCompanyNameTA").val(structureData[4]);
                                                $("#txtUnitHead").val(structureData[17]);
                                                $("#txtUnitHeadEmpId").val(structureData[15]);
                                                $("#txtAddress").val(structureData[5]);
                                                $("#txtAddressSI").val(structureData[6]);
                                                $("#txtAddressTA").val(structureData[7]);
                                                $("#txtPhoneIntercom").val(structureData[8]);
                                                $("#txtPhoneVIP").val(structureData[9]);
                                                $("#txtPhoneDirectLine").val(structureData[10]);
                                                $("#txtPhoneExtension").val(structureData[11]);
                                                $("#txtFax").val(structureData[12]);
                                                $("#txtEmail").val(structureData[13]);
                                                $("#txtURL").val(structureData[14]);

                                                caption = message + " " + structureData[16];
                                                $("#frmAddNode").data('edit', '0');
                                                $("#txtDefLevel").val(structureData[18]);
                                                $("#txtDivisionCode").val(structureData[19]);
                                                $("#txtLocationDBReferenceCode").val(structureData[20]);
                                                $("#txtAdditionalReferenceCode").val(structureData[21]);
                                                $("#radioFunctional").val();
                                                  
                                                if(structureData[22]==1){
                                                $("#radioFunctional").attr('checked', true);
                                                }
                                                if(structureData[22]==0){
                                                $("#radioNonFunctional").attr('checked', true);
                                                }
                                                
                                            }

                                            //this screen to unlock add screen
                                            if(mode == 'add') {
                                                $('#ajaxLoader').hide();
                                                $('#tohide').empty();
                                                $('#errorMsgDiv').hide();    
                                                document.forms[1].reset('');
                                                $("#btnEdit").show();
                                                $("#id").val("");
                                                $("#txtParnt").val(id);
                                                 
                                              
                                               
                                                $("#txtDefLevel").val(parseInt(structureData[18])+1);
                                             
                                                caption = message.replace(/#Division/g,structureData[16]);
                                                

                                                $("#frmAddNode").data('edit', '2');
                                            }else{
                                                getCompanyDetails($('#id').val());
                                            }
                                            $("#layerForm").show();
                                            $("#parnt").html(caption);

                                            setCompanyDetailsAttributes();

                                        }
                                        function validateHieCode(id,divisionCode){
                                           
                                            $.ajax({
                                                type: "POST",
                                                async:false,
                                                url: "<?php echo url_for('admin/ValidateHieCode') ?>",
                                                data: { id: id,divisionCode: divisionCode },
                                                dataType: "json",
                                                beforeSend: function(){


                                                },
                                                success: function(data){
                                                   if(data=="1"){
                                                        $('#frmAddNode').submit();
                                                   }
                                                   else{
                                                       var r=confirm("Division code has been used in the system (LDAP) do you want to change it?");
                                                         if (r==true)
                                                             {
                                                                 $('#frmAddNode').submit();
                                                              }
                                                                 else
                                                              {
                                                             $("label.errortd[generated='true']").css('display', 'none');

                                                            // 0 - view, 1 - edit, 2 - add
                                                            var editMode = $("#frmAddNode").data('edit');
                                                            if (editMode == 1) {
                                                                unlockCompanyDetails($('#id').val());
                                                                return false;
                                                            }
                                                            else {
                                                                document.forms['frmAddNode'].reset('');
                                                            }
                                                              }
                                                   }

                                                }
                                            });
                                        }
                                         //When click Search Button
                                            $("#btnSearch").click(function() {
//                                                $("#mode").attr('value', 'save');
                                                    

                                             if($('#cmbSearchMode').val()!="all"){
                                                if ($('#txtSearchValue').val() == '')  {
                                                    alert('<?php echo __("Please enter search value") ?>');
                                                    $('#txtSearchValue').focus();
                                                    return false;
                                            }else{
                                                 $('#frmShowGrid').submit();
                                             }
                                             }else{
                                                 $('#frmShowGrid').submit();
                                             }

                                            });

                             

                                                // Load Hicracy ToolTip
                           function LoadHicTooltip(eleId){
                                 
//                            alert(eleId.href);
//                               alert($('#'+eleId).attr("href"));

//                                var Birthday=$("#txtDOB").val();
//                                var Gender=$("#cmbGender").val();
             
                                $.ajax({
                                    type: "POST",
                                    async:false,
                                    url: "<?php echo url_for('pim/DisplayEmpHirache') ?>",
                                        data: { wst: eleId },
                                        dataType: "json",
                                    
                                   
                                    success: function(data){
                                        if(data!=null){
                                            
                                                                  var row="<table style='background-color:#FAF8CC; width:275px; boder:1'>";
                                                                var temp=0;
                                                                if(data.name10 !=null){
                                                                    row+="<tr ><td align='left' style='width:150px'>"+data.nameLevel10+"-"+data.name10+"</td></tr>";
                                                                    temp=1;}
                                                                if(data.name9 !=null){
                                                                    row+="<tr><td style='width:100px'>";
                                                                    if(temp==1){
                                                                        row+="<label class='lbllevel' style='width:100px;'>"+data.nameLevel9+"</label><img src='<?php echo public_path('images/rarrowdown.jpg') ?>' width='20px' height='10px' border='0' alt='add' /><br/>";
                                                                    }
                                                                    row+=data.name9+"</td></tr>";
                                                                    temp=1;
                                                                }
                                                                if(data.name8 !=null){
                                                                    row+="<tr><td style='width:100px'>";
                                                                    if(temp==1){
                                                                        row+="<label class='lbllevel' style='width:100px;'>"+data.nameLevel8+"</label><img src='<?php echo public_path('images/rarrowdown.jpg') ?>' width='20px' height='10px' border='0' alt='add' /><br/>";
                                                                    }
                                                                    row+=data.name8+"</td></tr>";
                                                                    temp=1;
                                                                }
                                                                if(data.name7 !=null){
                                                                    row+="<tr><td style='width:100px'>";
                                                                    if(temp==1){
                                                                        row+="<label class='lbllevel' style='width:100px;'>"+data.nameLevel7+"</label><img src='<?php echo public_path('images/rarrowdown.jpg') ?>' width='20px' height='10px' border='0' alt='add' /><br/>";
                                                                    }
                                                                    row+=data.name7+"</td></tr>";
                                                                    temp=1;
                                                                }
                                                                if(data.name6 !=null){
                                                                    row+="<tr><td style='width:100px'>";
                                                                    if(temp==1){
                                                                        row+="<label class='lbllevel' style='width:100px;'>"+data.nameLevel6+"</label><img src='<?php echo public_path('images/rarrowdown.jpg') ?>' width='20px' height='10px' border='0' alt='add' /><br/>";
                                                                    }
                                                                    row+=data.name6+"</td></tr>";
                                                                    temp=1;
                                                                }
                                                                if(data.name5 !=null){
                                                                    row+="<tr><td style='width:100px'>";
                                                                    if(temp==1){
                                                                        row+="<label class='lbllevel' style='width:100px;'>"+data.nameLevel5+"</label><img src='<?php echo public_path('images/rarrowdown.jpg') ?>' width='20px' height='10px' border='0' alt='add' /><br/>";
                                                                    }
                                                                    row+=data.name5+"</td></tr>";
                                                                    temp=1;
                                                                }
                                                                if(data.name4 !=null){
                                                                    row+="<tr><td style='width:100px'>";
                                                                    if(temp==1){
                                                                        row+="<label class='lbllevel' style='width:100px;'>"+data.nameLevel4+"</label><img src='<?php echo public_path('images/rarrowdown.jpg') ?>' width='20px' height='10px' border='0' alt='add' /><br/>";
                                                                    }
                                                                    row+=data.name4+"</td></tr>";
                                                                    temp=1;
                                                                }
                                                                if(data.name3 !=null){
                                                                    row+="<tr><td style='width:100px'>";
                                                                    if(temp==1){
                                                                        row+="<label class='lbllevel' style='width:100px;'>"+data.nameLevel3+"</label><img src='<?php echo public_path('images/rarrowdown.jpg') ?>' width='20px' height='10px' border='0' alt='add' /><br/>";
                                                                    }
                                                                    row+=data.name3+"</td></tr>";
                                                                    temp=1;
                                                                }
                                                                if(data.name2 !=null){
                                                                    row+="<tr><td style='width:100px'>";
                                                                    if(temp==1){
                                                                        row+="<label class='lbllevel' style='width:100px;'>"+data.nameLevel2+"</label><img src='<?php echo public_path('images/rarrowdown.jpg') ?>' width='20px' height='10px' border='0' alt='add' /><br/>";
                                                                    }
                                                                    row+=data.name2+"</td></tr>";
                                                                    temp=1;
                                                                }
                                                                if(data.name1 !=null){
                                                                    row+="<tr><td style='width:100px'>";
                                                                    if(temp==1){
                                                                        row+="<label class='lbllevel' style='width:100px;'>"+data.nameLevel1+"</label><img src='<?php echo public_path('images/rarrowdown.jpg') ?>' width='20px' height='10px' border='0' alt='add' /><br/>";
                                                                    }
                                                                    row+=data.name1+"</td></tr>";
                                                                    temp=1;
                                                                }

                                                                row+="</table>";

                                      
                                        if( $('.linkHint').HasBubblePopup() ){
                                             $('.linkHint').RemoveBubblePopup();
                                }
                                         $('.linkHint').CreateBubblePopup({
                                         innerHtml: row,
                                         innerHtmlStyle: {
                                                    color:'#333333',
                                                    'text-align':'center'
                                                    },

                                        themeName: 	'orange',
                                        themePath: 	'<?php echo public_path('../../images/jquerybubblepopup-theme') ?>'
                                        });
                                        }
                                    }
                                    });

                                   }

                                        $(document).ready(function()
                                        {

                                             if($('#cmbSearchMode').val()=="all"){
                                                $('#txtSearchValue').attr("readonly",true);
                                             }else{
                                                 $('#txtSearchValue').attr("readonly",false);
                                             }

                                             $('#cmbSearchMode').change(function() {
                                           
                                                if($('#cmbSearchMode').val()=="all"){
                                                $('#txtSearchValue').attr("readonly",true);
                                             }else{
                                                 $('#txtSearchValue').attr("readonly",false);
                                             }

                                             });
                                             $("#btnResetsearch").click(function() {
                                                location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/admin/listCompanyStructure')) ?>";
                                            });

                                            
                                            
                                           
                                            $('#tohide').empty();
                                            buttonSecurityCommon(null,null,"btnEdit",null);
                                            
                                            $("#frmAddNode").data('edit', '0'); // In view mode
                                            setCompanyDetailsAttributes();

                                            $('#empRepPopBtn').click(function() {

                                                var popup=window.open('<?php echo public_path('../../symfony/web/index.php/pim/searchEmployee?type=multiple&method=SelectEmployee'); ?>','Locations','height=450,width=800,resizable=1,scrollbars=1');

                                                if(!popup.opener) popup.opener=self;
                                                popup.focus();
                                            });


                                            // hide validation error messages
                                            $("label.errortd[generated='true']").css('display', 'none');

                                            // Switch edit mode or submit data when edit/save button is clicked
                                            $("#btnEdit").click(function() {

                                                var editMode = $("#frmAddNode").data('edit');
                                                if (editMode == 0) {
                                                    lockCompanyDetails($('#id').val());
                                                    return false;
                                                }
                                                else {
                                                    //alert("hi");
                                                    var nodeId=$('#id').val();
                                                    var divisionCode=$("#txtDivisionCode").val();
                                                    validateHieCode(nodeId,divisionCode);
                                                    
                                                }
                                            });
                                            
                                            $('#btnsubmit').click(function() {
                                                var name;
                                                var id;
                                                $("select option:selected").each(function (key,value) {
                                                  if($(this).val()){
                                                  name = $(this).text();
                                                  id = $(this).val();
                                                  
                                                  }
                                                 });
                                                                                                  

                                                if($("#cmbProvince").val()==""){
                                                    alert("<?php echo __('Section is required.') ?>");
                                                    return false;
                                                    
                                                }
//                                                if($("#cmbDistrict").val()==""){
//                                                    alert("<?php echo __('District is required.') ?>");
//                                                    return false;
//                                                    
//                                                }
                                                //  alert(name);
                                                var method = '<?php echo $method; ?>';
                                                eval('window.opener.' + method + '("' + id + '","' + id + '");');
                                                window.close();
                                                
                                            });

                                            $('#btnReset').click(function() {
                                                // hide validation error messages
                                                $("label.errortd[generated='true']").css('display', 'none');

                                                // 0 - view, 1 - edit, 2 - add
                                                var editMode = $("#frmAddNode").data('edit');
                                                if (editMode == 1) {
                                                    unlockCompanyDetails($('#id').val());
                                                    return false;
                                                }
                                                else {
                                                    document.forms['frmAddNode'].reset('');
                                                }
                                            });

                                            //When click employee selection button
                                            $('#empSearchPopBtn').click(function() {
                                                var popup=window.open('<?php echo public_path('../../symfony/web/index.php/pim/searchEmployee?type=single&method=SelectEmployee&reason=companyHead'); ?>','Locations','height=450,width=800,resizable=1,scrollbars=1');

                                                if(!popup.opener) popup.opener=self;
                                                popup.focus();
                                            });

//                                            
                                            $("#frmAddNode").validate({
                                                rules: {
                                                    txtCompanyName: { required: true, noSpecialCharsOnly: true,maxlength: 200 },
                                                    txtDivisionCode: { required: true, noSpecialCharsOnly: true,maxlength: 20 },
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
                                                    txtURL: {url: true},
                                                    txtLocationDBReferenceCode:{noSpecialCharsOnly: true},
                                                    txtAdditionalReferenceCode:{noSpecialCharsOnly: true}    
                                                },
                                                messages: {
                                                    txtCompanyName: { required: "<?php echo __('This field is required.') ?>", noSpecialCharsOnly: "<?php echo __('No invalid characters are allowed') ?>",maxlength: "<?php echo __("Length should be less than 200 characters") ?>" },
                                                    txtDivisionCode:{ required: "<?php echo __('This field is required.') ?>", noSpecialCharsOnly: "<?php echo __('No invalid characters are allowed') ?>",maxlength: "<?php echo __("Length should be less than 20 characters") ?>" },
                                                    txtCompanyNameSI: { noSpecialCharsOnly: "<?php echo __('No invalid characters are allowed') ?>",maxlength: "<?php echo __("Length should be less than 200 characters") ?>" },
                                                    txtCompanyNameTA: { noSpecialCharsOnly: "<?php echo __('No invalid characters are allowed') ?>",maxlength: "<?php echo __("Length should be less than 200 characters") ?>" },
                                                    txtAddress: {maxlength: "<?php echo __("Length should be less than 200 characters") ?>",noSpecialCharsOnly: "<?php echo __('No invalid characters are allowed') ?>"},
                                                    txtAddressSI: {maxlength: "<?php echo __("Length should be less than 200 characters") ?>",noSpecialCharsOnly: "<?php echo __('No invalid characters are allowed') ?>"},
                                                    txtAddressTA: {maxlength: "<?php echo __("Length should be less than 200 characters") ?>",noSpecialCharsOnly: "<?php echo __('No invalid characters are allowed') ?>"},
                                                    txtPhoneIntercom: "<?php echo __("Invalid Telephone (Intercom) number") ?>",
                                                    txtPhoneVIP: "<?php echo __("Invalid Telephone (VIP) number") ?>",
                                                    txtPhoneDirectLine: "<?php echo __("Invalid Telephone (Direct Line) number") ?>",
                                                    txtPhoneExtension: "<?php echo __("Invalid Telephone (Extension) number") ?>",
                                                    txtFax: "<?php echo __("Invalid Fax number") ?>",
                                                    txtEmail: "<?php echo __("Invalid E-Mail"); ?>",
                                                    txtURL: "<?php echo __("Invalid URL"); ?>",
                                                    txtLocationDBReferenceCode:{noSpecialCharsOnly: "<?php echo __('No invalid characters are allowed') ?>"},
                                                    txtAdditionalReferenceCode:{noSpecialCharsOnly: "<?php echo __('No invalid characters are allowed') ?>"} 
                                                        },
                                                        errorClass: "errortd",
                                                          submitHandler: function(form) {
                                                          $('#btnEdit').unbind('click').click(function() {return false}).val("<?php echo __('Wait..'); ?>");
                                                          form.submit();
                                                        }
                                                    });
                                                });

                                                // ]]>
                                    </script>

<?php if ($mode == 'select_subunit') {  ?> 
                                    
                                        <script type="text/javascript">
                                            // <![CDATA[
                                            $('a').click(function() {

                                            var nodeId=$(this).attr('id');

                                                valueString = $("#structureData_"+nodeId).val();
                                              
                                                data = valueString.split('|');

                                                var method = '<?php echo $method; ?>';
                                                eval('window.opener.' + method + '("' + data[0] + '","' + data[16] + '");');
                                                window.close();
                                            });
                                            // ]]>
                                        </script>
<?php } ?>
