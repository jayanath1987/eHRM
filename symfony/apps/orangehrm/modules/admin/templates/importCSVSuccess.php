<div class="formpage">
    <div class="outerbox">
        <div class="mainHeading"><h2>Upload Successful. Continuing with Data Import</h2></div>
        <h3>Summary</h3>
        <span class="wideFormLabel">ETA</span>
        <span id="divETA" class="wideFormValue">Estimating...</span>
        <br class="clear"/>
        <span class="wideFormLabel">Progress</span>
        <div id="divProgressBarContainer" class="wideFormValue">
            <div style="width:200px; display: block; float: left; height: 10px; border: solid 1px #000000;">
                <span id="progressBar" style="width: 0%;">&nbsp;</span>
            </div>
            <span style="display: block; float:left; padding-left:5px;" id="spanProgressPercentage">0%</span>
        </div>
        <br class="clear"/>
        <span class="wideFormLabel">No. of rows imported</span>
        <span id="divNoOfRecordsImported" class="wideFormValue">-</span>
        <br class="clear"/>

        <span class="wideFormLabel">No. of rows which failed to import</span>
        <span id="divNoOfRecordsFailed" class="wideFormValue">-</span>
        <br class="clear"/>

        <span class="wideFormLabel">Final result</span>
        <span id="divFinalResult" class="wideFormValue">Import in progress...</span>
        <br class="clear"/>
    </div>

    <div id="failureDetails" style="display: none">
        <h3>Details of failed rows</h3>
        <div class="outerbox">
            <table cellspacing="0" cellpadding="4" style="border: none; with: 700px;">
                <thead>
                    <tr>
                        <th width="50px" class="tableMiddleMiddle">Row</th>
                        <th width="275px" class="tableMiddleMiddle">Error</th>
                        <th width="350px" class="tableMiddleMiddle">Comments</th>
                    </tr>
                </thead>
                <tbody id="importStatusResults">
                </tbody>
            </table>
        </div>
    </div>
    <input type="hidden" id="totalNoOfRecords" value="<?php echo $result->getNoOfRecords(); ?>" />
    <input type="hidden" id="delimiterLevels" value="<?php echo $delimiterLevels; ?>" />
    <input type="hidden" id="url" value="<?php echo url_for(public_path("../../lib/controllers/CentralController.php?uniqcode=IMPAJAX&importType=")) . $result->getImportType(); ?>" />

</div>

<style type="text/css">
    #progressBar {
        background-color: #FFCC00;
        display: block;
        height: 10px;
    }
</style>
<!-- since logic is much complex need to refactor at a later stage -->
<script language="javascript" type="text/javascript">
<?php
$tempFiles = $result->getTempFileList();
$importType = $result->getImportType();
?>

            var requestLinkPrefix = <?php echo url_for(public_path("../../lib/controllers/CentralController.php?uniqcode=IMPAJAX&importType=" . $importType)); ?>;
            requestLinkPrefix     = requestLinkPrefix + "&file=";
            var requestFiles = new Array();
            var fileIndex = 0;

            var totalNoOfRecords = <?php echo $result->getNoOfRecords(); ?>;
            var noOfRecordsProcessed = 0;
            var noOfRecordsImported	 = 0;
            var noOfRecordsFailed	 = 0;
            var noOfRecordsSkipped	 = 0;
            var startTime = null;
            var rowStyleEven = false;
            var delimiterLevels = new Array('<?php echo $delimiterLevels; ?>');

<?php
$i = 0;

foreach ($tempFiles as $file) {
?>
                requestFiles[<?php echo $i; ?>] = "<?php echo base64_encode($file); ?>";
<?php
    $i++;
}
?>

            msg_INCORRECT_COLUMN_NUMBER 		= "Incorrect number of columns";
            msg_MISSING_WORKSTATION          = "Workstation not found";
            msg_COMPULSARY_FIELDS_MISSING_DATA 	= "Compulsary fields missing in data";
            msg_DD_DATA_INCOMPLETE  = "Direct Deposit data is not complete";
            msg_INVALID_TYPE 			= "Invalid field data type";
            msg_DUPLICATE_EMPLOYEE_ID 		= "Employee ID is in use";
            msg_DUPLICATE_EMPLOYEE_NAME 	= "Employee with same name exists";
            msg_FIELD_TOO_LONG            = "Field too long";

            /*
             */
            function $($id) {
                return document.getElementById($id);
            }

            function initImport(index) {
                var xmlHTTPObject = null;

                try {
                    xmlHTTPObject = new XMLHttpRequest();
                } catch (e) {
                    try {
                        xmlHTTPObject = new ActiveXObject("Msxml2.XMLHTTP");
                    } catch (e) {
                        xmlHTTPObject = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                }

                if (xmlHTTPObject == null)
                    alert("Your browser does not support AJAX!");

                xmlHTTPObject.onreadystatechange = function() {
                    if (xmlHTTPObject.readyState == 4){
                        response = xmlHTTPObject.responseText;
                        results = response.split(delimiterLevels[0]);

                        results[0] = parseInt(results[0]);
                        results[1] = parseInt(results[1]);
                        results[2] = parseInt(results[2]);

                        completedRecords = results[0] + results[1];
                        noOfRecordsProcessed += completedRecords;
                        noOfRecordsImported += results[0];
                        noOfRecordsFailed += results[1];
                    }
                    if (results[3] && results[3] != '') {
                        errors = results[3].split(delimiterLevels[1]);
                        for (i in errors) {
                            error = errors[i].split(delimiterLevels[2]);
                            error[0] = parseInt(error[0]) + (fileIndex * <?php echo $recordLimit; ?>);
                            error[1] = eval('msg_' + error[1]);
                            displayErrors(error);
                        }
                    }

                    if (totalNoOfRecords > 0) {
                        progressPercentage = Math.ceil((noOfRecordsProcessed / totalNoOfRecords) * 100);
                    } else {
                        progressPercentage = 0;
                    }
                    changeProgressBar(progressPercentage);
                    $('divNoOfRecordsImported').innerHTML = noOfRecordsImported + '/' + totalNoOfRecords;
                    $('divNoOfRecordsFailed').innerHTML = noOfRecordsFailed;

                    if (startTime == null) {
                        startTime = new Date();
                    } else {
                        timeElasped = new Date() - startTime;
                        timeRemaining = ((timeElasped / progressPercentage) * (100 - progressPercentage)) / 1000;

                        if (timeRemaining != 0) {
                            $('divETA').innerHTML = Math.ceil(timeRemaining) + " seconds";
                        } else {
                            $('divETA').innerHTML = "Import completed";
                        }
                    }
                    if (fileIndex < requestFiles.length - 1) {
                        fileIndex++;
                        initImport(fileIndex);
                    } else {
                        showFinalResults();
                    }
                }

                xmlHTTPObject.open('GET', requestLinkPrefix + requestFiles[index], true);
                xmlHTTPObject.send(null);
            }

            function displayErrors(error) {

                $('failureDetails').style.display = 'block';

                tbody = $('importStatusResults');

                var tableRow = document.createElement('tr');
                tableData = new Array();

                for (i in error) {
                    tableData[i] = document.createElement('td');
                    tableData[i].className = (rowStyleEven) ? 'even' : 'odd';
                    tableData[i].innerHTML = error[i];
                    tableRow.appendChild(tableData[i]);
                }

                tbody.appendChild(tableRow);

                rowStyleEven = !rowStyleEven;

            }

            function showFinalResults() {

                if (noOfRecordsFailed == 0) {
                    style = "success";

                    if (noOfRecordsImported == 0) {
                        // No failures, nothing to import
                        finalResult = "No rows were imported";
                    } else {
                        // import success
                        finalResult = "Import successful";
                    }
                } else {
                    style = "error";

                    if (noOfRecordsImported == 0) {
                        // all failures
                        finalResult = "Import failed, no rows imported";
                    } else {
                        // some successes, some failures
                        finalResult = "Some rows failed to import";
                    }
                }

                $('divFinalResult').className = $('divFinalResult').className + " " + style;
                $('divFinalResult').innerHTML = finalResult;
                $('divETA').innerHTML = "Import completed";
            }

            function changeProgressBar(pecentage) {
                $('progressBar').style.width = pecentage + '%';
                $('spanProgressPercentage').innerHTML = pecentage + '%';
            }


            if (document.getElementById && document.createElement) {
                roundBorder('outerbox');
            }

            $(document).ready(function() {
                initImport(fileIndex);
            });



</script>