$(document).ready(function(){

    /* Clearing auto-fill fields */
    $("#leaveSummary_txtEmpName").click(function(){
        $(this).attr('value', '');
        $("#leaveSummary_cmbEmpId").attr('value', 0);
    });

    /* Auto completion of employees */
    $("#leaveSummary_txtEmpName").autocomplete(empdata, {
        formatItem: function(item) {
            return item.name;
        }, matchContains:"word"
    }).result(function(event, item) {
        $('#leaveSummary_cmbEmpId').val(item.id);
    });

    /* *Search button */
    $('#btnSearch').click(function(){
        recheckEmpId();
        adjustEmpId();
        $('#hdnAction').val('search');
        $('#frmLeaveSummarySearch').submit();
    });

    var errorCount = 0;
    var errorMessage = '';

    function validateLeaveEntitlement() {

        $('.formInputText').each(function(){

            element = $(this);

            /* Remove current error message */
            element.siblings('div').empty()

            if (element.val() == '') {
                errorCount++;
                errorMessage = lang_empty;
                showErrorMessages(element, errorMessage);
            } else if (isNaN(element.val())) {
                errorCount++;
                errorMessage = lang_not_numeric;
                showErrorMessages(element, errorMessage);
            }

        });

    }

    function showErrorMessages(element, errorMessage) {

        errorDisplay = element.siblings('div');
        errorDisplay.append(errorMessage);

    }

    function adjustEmpId() {

        empName = $.trim($('#leaveSummary_txtEmpName').val()).toLowerCase();

        if (empName != 'all' && $('#leaveSummary_cmbEmpId').val() == 0) {
            $('#leaveSummary_cmbEmpId').val('-1');
        }

    }

    function recheckEmpId() {

        var empDataArray = eval(empdata); // TODO: Try to replace eval()
        var empDateCount = empDataArray.length;

        var i;
        for (i=0; i<empDateCount; i++) {

            fieldName = $.trim($('#leaveSummary_txtEmpName').val()).toLowerCase();
            arrayName = empDataArray[i].name.toLowerCase();
            
            if (fieldName == arrayName) {
                $('#leaveSummary_cmbEmpId').val(empDataArray[i].id);
                break;
            }

        }


    }

    /* Save button */
    $('#btnSave').click(function(){

        validateLeaveEntitlement();

        if (errorCount == 0) {
            $('#hdnAction').val('save');
            $('#frmLeaveSummarySearch').submit();
        }

    });




});







