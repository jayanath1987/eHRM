     

     function validateFormFields (data) {

       erroris = 0;

        $('#repname_error').html('');
        $('#empname_error').html('');
        $('#agegroup_error').html('');
        $('#paygrad_error').html('');
        $('#education_error').html('');
        $('#status_error').html('');
        $('#servicep_error').html('');
        $('#joindate_error').html('');
        $('#altleast_one_field_error').html('');
        $('#jobtitle_error').html('');
        $('#language_error').html('');
        $('#skills_error').html('');

        $('#define_report_form input').removeClass('error2col');
        
        //Report Name
        if ($('#report_RepName').val() == "") {
            $('#repname_error').html('<label  generated="true" class="error">'+reportNameReqired+'</label>');       
            $('#report_RepName').addClass('error2col');
            erroris = 1;
        }

        if (jQuery.inArray(trim($('#report_RepName').val().toLowerCase()), repnames)>-1 ) {
           $('#repname_error').html('<label  generated="true" class="error">'+reportNameAlredyUsed+'</label>');
           erroris = 1;
        }
        // check if at least one field selected
        if(!($('#report_cbx_0').is(':checked') || $('#report_cbx_1').is(':checked') || $('#report_cbx_2').is(':checked'))) {

            $('#altleast_one_field_error').html('<label  generated="true" class="error">'+atLeastOneField+'</label>');
            $('#PIM_PerDet_Body').show(); // open the toggle box
            erroris = 1;
        }
        //Emp Name
        if($('#report_cbxEmpName').is(':checked')) {
          
            if ($('#report_txtEmployee').val() == "") {

                showErrorInDiv('#empname_error','#report_txtEmployee',empNameEmpty);
            }

            if ($('#report_txtEmployee').val() != "") { // check if employee exist

                if(!findEmployee(trim($('#report_txtEmployee').val()),data)){                   

                   showErrorInDiv('#empname_error','#report_txtEmployee',empNotExist);
                }
                
            }


        }
        //Age group
        if($('#report_cbxAgeGroup').is(':checked')) {

            if ($('#report_selectAgeGroup :selected').text()== "Select") { // not selected

                      showErrorInDiv('#agegroup_error',0,selectAgeGroup);
            }

            if ($('#report_selectAgeGroup :selected').text()== "Less Than") {
                 
                 if($('#report_txtAgeGroupCompare').val() == '') {                      

                     showErrorInDiv('#agegroup_error','#report_txtAgeGroupCompare',fromValueEmpty);
                 }

                 if(isNaN($('#report_txtAgeGroupCompare').val())) { //not a number                      
                     showErrorInDiv('#agegroup_error','#report_txtAgeGroupCompare',fromValueNumber);
                 }


            }

            if ($('#report_selectAgeGroup :selected').text()== "Greater Than") {
                
                if($('#report_txtAgeGroupCompare').val() == '') {                    
                    showErrorInDiv('#agegroup_error','#report_txtAgeGroupCompare',fromValueEmpty);
                 }

                 if(isNaN($('#report_txtAgeGroupCompare').val())) { //not a number
                     showErrorInDiv('#agegroup_error','#report_txtAgeGroupCompare',fromValueNumber);
                 }
            }

            if ($('#report_selectAgeGroup :selected').text()== "Between") {               
                
                

                if($('#report_txtAgeGroupCompare').val() == '') {
                     showErrorInDiv('#agegroup_error','#report_txtAgeGroupCompare',fromValueEmpty);
                 }

                 if(isNaN($('#report_txtAgeGroupCompare').val())) { //not a number
                     showErrorInDiv('#agegroup_error','#report_txtAgeGroupCompare',fromValueNumber);
                 }


                if( $('#report_txtAgeGroupRange').val() == '' ) {
                      showErrorInDiv('#agegroup_error','#report_txtAgeGroupRange',toValueEmpty);
                }

                if(isNaN( $('#report_txtAgeGroupRange').val())  ) {
                      showErrorInDiv('#agegroup_error','#report_txtAgeGroupRange',toValueNumber);
                }
               
                if( parseInt(trim($('#report_txtAgeGroupCompare').val())) >=  parseInt(trim($('#report_txtAgeGroupRange').val()))  ) {
                    showErrorInDiv('#agegroup_error','#report_txtAgeGroupCompare',messageageless);
                }
                

            }

        }
        //Pay Grade
        if($('#report_cbxPayGrade').is(':checked')) {

            if ($('#report_selectPayGrade :selected').text()== "Select") {                  
                      showErrorInDiv('#paygrad_error',0,selectPayGrade);
            }
        }
        //Education
        if($('#report_cbxEducation').is(':checked')) {
       
            if ($('#report_selectEducation :selected').text()== "Select") {                 
                     showErrorInDiv('#education_error',0,selectEducation);
            }
        }
        //Employee Status
        if($('#report_cbxEmpStatus').is(':checked')) {

            if ($('#report_selectEmpStatus :selected').text()== "Select") {                     
                     showErrorInDiv('#status_error',0,selectEmpStatus);
            }
        }
        // Service Period
        if($('#report_cbxServicePeriod').is(':checked')) {

            if ($('#report_selectServicePeriod :selected').text()== "Select") {                    
                      showErrorInDiv('#servicep_error',0,selectServicperiod);
            }

            if ($('#report_selectServicePeriod :selected').text() == "Less Than") {
                                  
                 if($('#report_txtServicePeriodCompare').val() == '') {

                   showErrorInDiv('#servicep_error','#report_txtServicePeriodCompare',servicperiodFromEmpty);
                 }

                 if(isNaN($('#report_txtServicePeriodCompare').val())){

                   showErrorInDiv('#servicep_error','#report_txtServicePeriodCompare',servicperiodFromNumber);

                 }
            }

            if ($('#report_selectServicePeriod :selected').text() == "Greater Than") {
                
                if($('#report_txtServicePeriodCompare').val() == '') {

                   showErrorInDiv('#servicep_error','#report_txtServicePeriodCompare',servicperiodFromEmpty);
                 }

                 if(isNaN($('#report_txtServicePeriodCompare').val())){

                   showErrorInDiv('#servicep_error','#report_txtServicePeriodCompare',servicperiodFromNumber);

                 }
            }

            if ($('#report_selectServicePeriod :selected').text() == "Between") {

                if($('#report_txtServicePeriodCompare').val() == '') {

                   showErrorInDiv('#servicep_error','#report_txtServicePeriodCompare',servicperiodFromEmpty);
                 }

                 if(isNaN($('#report_txtServicePeriodCompare').val())){

                   showErrorInDiv('#servicep_error','#report_txtServicePeriodCompare',servicperiodFromNumber);

                 }

                 if($('#report_txtServicePeriodRange').val() == '') {

                   showErrorInDiv('#servicep_error','#report_txtServicePeriodRange',servicperiodFromEmpty);
                 }

                 if(isNaN($('#report_txtServicePeriodRange').val())){

                   showErrorInDiv('#servicep_error','#report_txtServicePeriodRange',servicperiodToNumber);

                 }
                
                if(parseInt(trim($('#report_txtServicePeriodCompare').val())) >=  parseInt(trim($('#report_txtServicePeriodRange').val())) ) {
                     showErrorInDiv('#servicep_error','#report_txtServicePeriodCompare',servicperiodFromLess);
                }
            }

        }

        // Join Date
        if($('#report_cbxJoineDate').is(':checked')) {

            var fromdate = $('#report_txtJoineDateCompare').val();
            var fromdatearray = fromdate.split("-");  //  mm/dd/yyyy
            var fromdateString = fromdatearray[1] +"/" + fromdatearray[2] + "/" +  fromdatearray[0];

            
            if ($('#report_selectJoineDate :selected').text()== "Select") { 
                     
                     showErrorInDiv('#joindate_error',0,selectJoinDate);
            }

            if ($('#report_selectJoineDate :selected').text() == "Joined Before") {
                 if($('#report_txtJoineDateCompare').val() == '') {                   
                     showErrorInDiv('#joindate_error','#report_txtJoineDateCompare',joinDateFromEmpty);
                 }

                 if(!isGoodDate(fromdateString)) {

                 showErrorInDiv('#joindate_error','#report_txtJoineDateCompare',messageageInvalidDate);
                 
                }
            }

            if ($('#report_selectJoineDate :selected').text() == "Joined After") {
                 if($('#report_txtJoineDateCompare').val() == '') {

                     showErrorInDiv('#joindate_error','#report_txtJoineDateCompare',joinDateFromEmpty);
                 }

                 if(!isGoodDate(fromdateString)) {

                 showErrorInDiv('#joindate_error','#report_txtJoineDateCompare',messageageInvalidDate);

                }
            }


            
            if ($('#report_selectJoineDate :selected').text() == "Joined In Between") {
                 if($('#report_txtJoineDateCompare').val() == '') {
                     showErrorInDiv('#joindate_error','#report_txtJoineDateCompare',joinDateFromEmpty);
                 }

                 if($('#report_txtJoineDateRange').val() == '') {
                    showErrorInDiv('#joindate_error','#report_txtJoineDateCompare',joinDateToEmpty);
                 }

                var todate = $('#report_txtJoineDateRange').val();
                var todatearray = todate.split("-");  //  mm/dd/yyyy
                var todateString = todatearray[1] +"/" + todatearray[2] + "/" +  todatearray[0];

                if(!isGoodDate(fromdateString)) {
                 showErrorInDiv('#joindate_error','#report_txtJoineDateCompare',messageageInvalidDate);

                }

                if(!isGoodDate(todateString)) {                    
                    showErrorInDiv('#joindate_error','#report_txtJoineDateRange',messageageInvalidDate);
                }

                var fromDateGreater = new Date();
                fromDateGreater.setFullYear(fromdatearray[0],fromdatearray[1]-1,fromdatearray[2]);

                var toDateGrerater = new Date(todatearray[0], todatearray[1], todatearray[2]);
               toDateGrerater.setFullYear(todatearray[0],todatearray[1]-1,todatearray[2]);

                if (fromDateGreater > toDateGrerater){
                     showErrorInDiv('#joindate_error','#report_txtJoineDateRange',fromDateshdGreater);
                }
            }
            

            
        }

        // Job Title
        if($('#report_cbxJobTitle').is(':checked')) {

            if ($('#report_selectJobTitle :selected').text()== "Select") { // not selected               
                showErrorInDiv('#jobtitle_error',0,selectJobTitle);
            }
        }

        // Language
        if($('#report_cbxLanguage').is(':checked')) {

            if ($('#report_selectLanguage :selected').text()== "Select") { // not selected                
                showErrorInDiv('#language_error',0,selectLanguage);
            }
        }

        // Skills
        if($('#report_cbxSkills').is(':checked')) {

            if ($('#report_selectSkills :selected').text()== "Select") { // not selected               
                 showErrorInDiv('#skills_error',0,selectSkill);
            }
        }

        if(erroris == 1) {
            return false;
        } else {
            return true;
        }
     }
     function showHideFields () {

        $('#lblAgeTo').hide();
        $('#lblServiceTo').hide();
        $('#lblJoinTo').hide();
        $('#btnJoinTo').hide();

        if ($('#report_selectAgeGroup :selected').text()== "Between") {
           $('#report_txtAgeGroupCompare').show();
           $('#report_txtAgeGroupRange').show();
           $('#lblAgeTo').show();
        }

        if ($('#report_selectServicePeriod :selected').text()== "Between") {
           $('#report_txtServicePeriodCompare').show();
           $('#report_txtServicePeriodRange').show();
           $('#lblServiceTo').show();
        }

        if ($('#report_selectJoineDate :selected').text()== "Joined In Between") {
           $('#report_txtJoineDateCompare').show();
           $('#report_txtJoineDateRange').show();
           $('#lblJoinTo').show();
           $('#btnJoinTo').show();
        }
     }

     function createFieldList()  {

        selectFieldList = [];
         var i=0;
         var cbxName = "";
         var y = 0;

         for(i = 0;i<selectFieldNumber;i++) {
            cbxName = "#report_cbx_" + i;
            if($(cbxName).is(':checked')) {
                selectFieldList[y] = $(cbxName).val();
                 y++;
            }

         }

         var fieldsString;
        fieldsString = arrayToString(selectFieldList);
        $('#report_FieldList').val(fieldsString);
    }

    function createCriteria() {

        criteriaList = [];
        var i=0;
        // Search employee name
       if($('#report_cbxEmpName').is(':checked')) {

            if ($('#report_txtEmpId').val() != "" && $('#report_txtEmpId').val() != -1 && $('#report_txtEmployee').val().toLowerCase() != "all") {
                criteriaList[i] = EMPNO + CONDITION_SEPERATOR + EQUALS+ CONDITION_SEPERATOR + $('#report_txtEmpId').val();
            } else {
                criteriaList[i] = EMPNO + CONDITION_SEPERATOR + EQUALS + CONDITION_SEPERATOR + ALL;
            }
        i++;
        }
        // Age group
        if($('#report_cbxAgeGroup').is(':checked')) {

            if ($('#report_selectAgeGroup :selected').text()== "Less Than") {
                criteriaList[i] = AGE  + CONDITION_SEPERATOR + LESSTHAN + CONDITION_SEPERATOR + $('#report_txtAgeGroupCompare').val();
            }

            if ($('#report_selectAgeGroup :selected').text()== "Greater Than") {
                criteriaList[i] = AGE  + CONDITION_SEPERATOR + GREATERTHAN + CONDITION_SEPERATOR + $('#report_txtAgeGroupCompare').val();
            }

            if ($('#report_selectAgeGroup :selected').text()== "Between") {
                criteriaList[i] = AGE  + CONDITION_SEPERATOR + BETWEEN + CONDITION_SEPERATOR + $('#report_txtAgeGroupCompare').val()
                    + CONDITION_SEPERATOR + $('#report_txtAgeGroupRange').val();
            }
        i++;
        }
        // Pay Grade
        if($('#report_cbxPayGrade').is(':checked')) {

            criteriaList[i] = PAYGRADE + CONDITION_SEPERATOR + EQUALS+ CONDITION_SEPERATOR + $('#report_selectPayGrade').val();
        i++;
        }

        // Education
        if($('#report_cbxEducation').is(':checked')) {

            criteriaList[i] = EDUCATION + CONDITION_SEPERATOR + EQUALS+ CONDITION_SEPERATOR + $('#report_selectEducation').val();
        i++;
        }

        // Employee Status
        if($('#report_cbxEmpStatus').is(':checked')) {

            criteriaList[i] = EMPSTATUS + CONDITION_SEPERATOR + EQUALS+ CONDITION_SEPERATOR + $('#report_selectEmpStatus').val();
        i++;
        }

        // Service Period
        if($('#report_cbxServicePeriod').is(':checked')) {

            if ($('#report_selectServicePeriod :selected').text() == "Less Than") {
                criteriaList[i] = SERVICEPERI  + CONDITION_SEPERATOR + LESSTHAN + CONDITION_SEPERATOR + $('#report_txtServicePeriodCompare').val();
            }

            if ($('#report_selectServicePeriod :selected').text() == "Greater Than") {
                criteriaList[i] = SERVICEPERI  + CONDITION_SEPERATOR + GREATERTHAN + CONDITION_SEPERATOR + $('#report_txtServicePeriodCompare').val();
            }

            if ($('#report_selectServicePeriod :selected').text() == "Between") {
                criteriaList[i] = SERVICEPERI  + CONDITION_SEPERATOR + BETWEEN + CONDITION_SEPERATOR + $('#report_txtServicePeriodCompare').val()
                    + CONDITION_SEPERATOR + $('#report_txtServicePeriodRange').val();
            }
        i++;
        }

        // Join Date
        if($('#report_cbxJoineDate').is(':checked')) {

            if ($('#report_selectJoineDate :selected').text() == "Joined Before") {
                criteriaList[i] = JOINDATE  + CONDITION_SEPERATOR + LESSTHAN + CONDITION_SEPERATOR + $('#report_txtJoineDateCompare').val();
            }

            if ($('#report_selectJoineDate :selected').text() == "Joined After" ) {
                criteriaList[i] = JOINDATE  + CONDITION_SEPERATOR + GREATERTHAN + CONDITION_SEPERATOR + $('#report_txtJoineDateCompare').val();
            }

            if ($('#report_selectJoineDate :selected').text() == "Joined In Between") {
                criteriaList[i] = JOINDATE  + CONDITION_SEPERATOR + BETWEEN + CONDITION_SEPERATOR + $('#report_txtJoineDateCompare').val()
                    + CONDITION_SEPERATOR + $('#report_txtJoineDateRange').val();
            }
        i++;
        }

        // Employee JobTitle
        if($('#report_cbxJobTitle').is(':checked')) {
            criteriaList[i] = JOBTITLE + CONDITION_SEPERATOR + EQUALS+ CONDITION_SEPERATOR + $('#report_selectJobTitle').val();
        i++;
        }

        // Employee Language
        if($('#report_cbxLanguage').is(':checked')) {
            criteriaList[i] = LANGUAGE + CONDITION_SEPERATOR + EQUALS+ CONDITION_SEPERATOR + $('#report_selectLanguage').val();
        i++;
        }

        // Employee SKILL
        if($('#report_cbxSkills').is(':checked')) {
            criteriaList[i] = SKILLS + CONDITION_SEPERATOR + EQUALS+ CONDITION_SEPERATOR + $('#report_selectSkills').val();
        i++;
        }

      var criteriaString;

      criteriaString = arrayToString(criteriaList);

      $('#report_CriteriaList').val(criteriaString);
    }

     function arrayToString(flist){
    
        var stringlist = "";

        for(var i = 0 ; i < flist.length; i++) {
             stringlist =  stringlist + flist[i] + CRITERIA_SEPERATOR;
        }

        return stringlist.substring(0, stringlist.length-1);
    
    }

    function showAgeRageInputs() {
        if ($('#report_selectAgeGroup :selected').text()== "Less Than") {
           $('#report_txtAgeGroupCompare').show();
           $('#report_txtAgeGroupRange').hide();
           $('#lblAgeTo').hide();
        }

        if ($('#report_selectAgeGroup :selected').text()== "Greater Than") {
           $('#report_txtAgeGroupCompare').show();
           $('#report_txtAgeGroupRange').hide();
            $('#lblAgeTo').hide();
        }

        if ($('#report_selectAgeGroup :selected').text()== "Between") {
           $('#report_txtAgeGroupCompare').show();
           $('#report_txtAgeGroupRange').show();
           $('#lblAgeTo').show();
        }
    }

    function showServicePeriodInputs() {

        if ($('#report_selectServicePeriod :selected').text()== "Less Than") {
           $('#report_txtServicePeriodCompare').show();
           $('#report_txtServicePeriodRange').hide();
           $('#lblServiceTo').hide();
        }

        if ($('#report_selectServicePeriod :selected').text()== "Greater Than") {
           $('#report_txtServicePeriodCompare').show();
           $('#report_txtServicePeriodRange').hide();
           $('#lblServiceTo').hide();
        }

        if ($('#report_selectServicePeriod :selected').text()== "Between") {
           $('#report_txtServicePeriodCompare').show();
           $('#report_txtServicePeriodRange').show();
           $('#lblServiceTo').show();
        }

    }

    function showJoinDateInputs() {

        if ($('#report_selectJoineDate :selected').text()== "Joined After") {
           $('#report_txtJoineDateCompare').show();
           $('#report_txtJoineDateRange').hide();
           $('#lblJoinTo').hide();
           $('#btnJoinTo').hide();
        }

        if ($('#report_selectJoineDate :selected').text()== "Joined Before") {
           $('#report_txtJoineDateCompare').show();
           $('#report_txtJoineDateRange').hide();
           $('#lblJoinTo').hide();
           $('#btnJoinTo').hide();
        }

        if ($('#report_selectJoineDate :selected').text()== "Joined In Between") {
           $('#report_txtJoineDateCompare').show();
           $('#report_txtJoineDateRange').show();

           $('#btnJoinTo').show();
           $('#lblJoinTo').show();
        }

    }

function changeTitle (element) {

        if($(element).attr('id') == "AsGpHead")  {

                if(agTit == 0) {
                    $("div#AsGpTxt").text(txtAssignToGrpMinus);
                } else {
                    $("div#AsGpTxt").text(txtAssignToGrpPlus);
                }
                (agTit == 1) ? agTit=0 : agTit=1;
            }

            if($(element).attr('id') == "SeleHead")  {

                if(seTit == 0) {
                    $("div#SeleTxt").text(txtSelectionCriteMinus);
                } else {
                    $("div#SeleTxt").text(txtSelectionCritePlus);
                }
                (seTit == 1) ? seTit=0 : seTit=1;
            }

            if($(element).attr('id') == "FieldHead")  {

                if(feTit == 0) {
                    $("div#FieldTxt").text(txtSelectFieldsMinus);
                } else {
                    $("div#FieldTxt").text(txtSelectFieldsPlus);
                }
                (feTit == 1) ? feTit=0 : feTit=1;
            }


            if($(element).attr('id') == "PIM_PerDet")  {

                if(perDit == 0) {
                    $("div#PIM_PerDet_Text").text(txtPersonalDetailsMinus);
                } else {
                    $("div#PIM_PerDet_Text").text(txtPersonalDetailsPlus);
                }
                (perDit == 1) ? perDit=0 : perDit=1;
            }

            if($(element).attr('id') == "PIM_Contact")  {

                if(perCon == 0) {
                    $("div#PIM_Contact_Text").text(txtContactDetailsMinus);
                } else {
                    $("div#PIM_Contact_Text").text(txtContactDetailsPlus);
                }
                (perCon == 1) ? perCon=0 : perCon=1;
            }

            if($(element).attr('id') == "PIM_Job")  {

                if(perjob == 0) {
                    $("div#PIM_Job_Text").text(txtJobDetailsMinus);
                } else {
                    $("div#PIM_Job_Text").text(txtJobDetailsPlus);
                }
                (perjob == 1) ? perjob=0 : perjob=1;
            }

             if($(element).attr('id') == "PIM_Salary")  {

                if(persal == 0) {
                    $("div#PIM_Salary_Text").text(txtSalaryDetailsMinus);
                } else {
                    $("div#PIM_Salary_Text").text(txtSalaryDetailsPlus);
                }
                (persal == 1) ? persal=0 : persal=1;
            }

            if($(element).attr('id') == "PIM_ReportTo")  {

                if(perrep == 0) {
                    $("div#PIM_ReportTo_Text").text(txtReportToMinus);
                } else {
                    $("div#PIM_ReportTo_Text").text(txtReportToPlus);
                }
                (perrep == 1) ? perrep=0 : perrep=1;
            }

             if($(element).attr('id') == "PIM_WrkExpe")  {

                if(perwrkex == 0) {
                    $("div#PIM_WrkExpe_Text").text(txtWorkExperienceMinus);
                } else {
                    $("div#PIM_WrkExpe_Text").text(txtWorkExperiencePlus);
                }
                (perwrkex == 1) ? perwrkex=0 : perwrkex=1;
            }

            if($(element).attr('id') == "PIM_Education")  {

                if(peredu == 0) {
                    $("div#PIM_Education_Text").text(txtEducationMinus);
                } else {
                    $("div#PIM_Education_Text").text(txtEducationPlus);
                }
                (peredu == 1) ? peredu=0 : peredu=1;
            }

            if($(element).attr('id') == "PIM_Languages")  {

                if(perlang == 0) {
                    $("div#PIM_Languages_Text").text(txtLanguageMinus);
                } else {
                    $("div#PIM_Languages_Text").text(txtLanguagePlus);
                }
                (perlang == 1) ? perlang=0 : perlang=1;
            }

            if($(element).attr('id') == "PIM_Skills")  {

                if(perskill == 0) {
                    $("div#PIM_Skills_Text").text(txtSkillMinus);
                } else {
                    $("div#PIM_Skills_Text").text(txtSkillPlus);
                }
                (perskill == 1) ? perskill=0 : perskill=1;
            }

    }


 // check date JavaScript function
// if date is valid then function returns true, otherwise returns false
function isGoodDate(txtDate){
  var objDate;  // date object initialized from the txtDate string
  var mSeconds; // milliseconds from txtDate

  // date length should be 10 characters - no more, no less
  if (txtDate.length != 10) return false;

  // extract day, month and year from the txtDate string
  // expected format is mm/dd/yyyy
  // subtraction will cast variables to integer implicitly
  var day   = txtDate.substring(3,5)  - 0;
  var month = txtDate.substring(0,2)  - 1; // because months in JS start with 0
  var year  = txtDate.substring(6,10) - 0;

  // third and sixth character should be /
  if (txtDate.substring(2,3) != '/') return false;
  if (txtDate.substring(5,6) != '/') return false;

  // test year range
  if (year < 999 || year > 3000) return false;

  // convert txtDate to the milliseconds
  mSeconds = (new Date(year, month, day)).getTime();

  // initialize Date() object from calculated milliseconds
  objDate = new Date();
  objDate.setTime(mSeconds);

  // compare input parameter date and created Date() object
  // if difference exists then date isn't valid
  if (objDate.getFullYear() != year)  return false;
  if (objDate.getMonth()    != month) return false;
  if (objDate.getDate()     != day)   return false;

  // otherwise return true
  return true;  
}

/*
 * Checks if employee exist in the  jason variable data
 */
function findEmployee(emname,data) {

     var foundName = false;
     for(var i=0;i<data.length;i++){

        var obj = data[i];
        for(var key in obj){

            var attrName = key;
            var attrValue = obj[key];
            
            if(attrName == 'name') {                
                if((emname.toLowerCase() == attrValue.toLowerCase()) || emname.toLowerCase() == 'all') {
                foundName = true;
                }
            }

        }
    }
 return  foundName;

}

function showErrorInDiv(divId,fieldname,errormessage) {
    
    $(divId).html('<label  generated="true" class="error">'+errormessage+'</label>');
    $('#selection_criteria').show(); // open the toggle box
    if(fieldname != 0) {
    $(fieldname).addClass('error2col');
    }
    erroris = 1;

}