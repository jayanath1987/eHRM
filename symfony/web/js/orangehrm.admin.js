/* All js functions need to be written here
 * Module sepcific functions SHOULD be written inside module js file
 * orangehrm.<module_name>.js added as part of refactoring
 *
 * @author sujith
 **/
function checkBeforeDelete(checkBoxPrefix, formName)
{
   selected = false;
   for(i=0; i < $("#numRecords").val(); i++) {
      if($("#" + checkBoxPrefix + "_" + i).attr('checked')) {
         selected = true;
         break;
      }
   }

   if(selected) {
      $("#" + formName).submit();
   } else {
      alert("Please select any of the record to delete");
   }
}

function selectAllForDelete(commonCheckBoxName)
{
   if ($('#' + commonCheckBoxName).attr('checked')){
      $('.innercheckbox').attr('checked','checked');
   }else{
      $('.innercheckbox').removeAttr('checked');
   }
}

function saveCustomImport()
{
   $("#messageName").html("&nbsp;");
   if($("#txtFieldName").val() == "") {
      $("#messageName").html("Enter import name");
      return false;
   }
   $("#frmCustomImport").submit();
}

function moveVertical(direction, listBoxName)
{
   var selectObj = document.getElementById(listBoxName);
   if(direction == 'up') {
   	for (i = 1; i<selectObj.length; i++) {
			if (selectObj.options[i].selected) {

				opt = selectObj.options[i];
				selectObj.removeChild(opt);
				selectObj.insertBefore(opt, selectObj.options[i-1]);
			}
		}
   }

   if(direction == 'down') {

      for (i = selectObj.length - 2; i >= 0; i--) {
         if (selectObj.options[i].selected) {
            nextOpt = selectObj.options[i+1];
            selectObj.removeChild(nextOpt);
            selectObj.insertBefore(nextOpt, selectObj.options[i]);
         }
      }
   }
}

function optionMoveFields(from_field, to_field) {

   var available  = $("#" + from_field).children();
   var assigned   = $("#" + to_field);

   for(i=0; i < available.length; i++) {
      if(available[i].selected) {
         assigned.append(available[i]);
      }
   }
}

function optionMoveFieldsDefineCustomImport(from_field, to_field)
{
   flag = true;
   if(from_field == "cmbAssignedFields") {
      $("#"+ from_field + " :selected").each(function(i, selected) {
         if($(selected).val() == "firstName" || $(selected).val() == "lastName") {
            alert("The following fields are compulsary and cannot be removed: (" + $(selected).text() + ")");
            flag = false;
            return false;
         }
      });
   }

   if(flag) {
      optionMoveFields(from_field, to_field);
   }
}

/*function importCustomData(url) {
   var requestFiles = new Array();
	var fileIndex = 0;

	var totalNoOfRecords     = $("#totalNoOfRecords").val();
	var noOfRecordsProcessed = 0;
	var noOfRecordsImported	 = 0;
	var noOfRecordsFailed	 = 0;
	var noOfRecordsSkipped	 = 0;
	var startTime            = null;
	var rowStyleEven         = false;
	var delimiterLevels      = ($("#delimiterLevels").val()).split(",");


}*/

function validateCustomExportHeadingSave()
{
   //save after the validation
   for(i=0; i < parseInt($("#numFields").val()); i++) {
      if($("#headings_" + i).val() == "") {
         alert("Heading field : " + (i + 1) + " must be entered, cannot leave it empty");
         return false;
      }
   }

   $("#frmCustomExport").submit();
   return true;
}

function exportData()
{
  if($("#cmbExportType").val() == 0) {
     alert("Please select an export type");
     return false;
  }
  $("#frmDataExport").submit();
  return true;
}

function editCompanyStructure(mode, id, message) { 

   var structureData = ($("#structureData_" + id).val()).split("|");
   var caption = "";

   //this is to unlock update screen
   if(mode == 'update') {
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
   }

   //this screen to unlock add screen
   if(mode == 'add') {  
      $("#id").val("");
      $("#txtParnt").val(id);
      document.forms[0].reset('');
      caption = message.replace(/#Division/g,structureData[16]);
   }
   $("#layerForm").show();   
   $("#parnt").html(caption);
}

function validateSubDivision() {
   if($("#txtTitle").val() == "") {
      alert("Sub-division name cannot be empty");
      return false;
   }  

   $("#frmAddNode").submit();
   return true;
}

function deleteCompanyStructure(node_id,message) {
   var structureData = ($("#structureData_" + node_id).val()).split("|");
   var response = confirm(message.replace(/#SubDivision/g,structureData[16]));

   if(response) {
      url = $("#deleteAction").val() + "?mode=delete&node_id=" + node_id;
      navigateUrl(url);
   }
}

function showDefineLocationInCompanyStructure() {

   $("#addLocationSection").hide(1000);
   if($("#cmbLocation").val() == "Other") {
      $("#addLocationSection").show(1000);
   }
}

function ajaxPostLocation() {
   //we impose some validation before ajax posting
   var msg = "Following errors found on the form: \n\n";
   var flag = true;
   if($("#txtName").val() == "") {
      msg = msg + "Cannot leave location name empty \n";
      flag = false;
   }

   if($("#cmbCountry").val() == "") {
      msg = msg + "Select a country from the list \n";
      flag = false;
   }

   if($("#txtAddress").val() == "") {
      msg = msg + "Address cannot be left empty \n";
      flag = false;
   }

   if($("#txtZipCode").val() == "") {
      msg = msg + "Zip Code cannot be left empty";
   }
   
   if(!flag) {
      alert(msg);
   } else {
      $.post($("#url").val(), $("#frmSave").serialize(), function(data) {
         var option = "<option value='" + data + "'>" + $("#txtName").val();
         $("#cmbLocation").children().each(function(i, opt){
            if($(opt).val() == "") {
               $(opt).after(option);
            }
         });

         $("#cmbLocation").val(data);
         $("#addLocationSection").hide(1000);
      });
   }
   return flag;
}

function hideAddEditSubDivision() {
   $("#layerForm").hide(1000);
}