<?php $pluginImportTypesFound = false; ?>

<div class="formpage">
    <div class="outerbox">
        <div class="mainHeading"><h2>Import HR Data</h2></div>
        <?php if ($message != "") {
 ?>
            <div class="messagebar">
                <span class="requirednotice"><?php echo $message; ?></span>
            </div>
<?php } ?>
        <form id="frmDataImport" name="frmDataImport" method="post" action="<?php echo url_for('admin/importCSV') ?>" enctype="multipart/form-data">
            <label for="cmbImportType">Import Type<span class="required">*</span></label>
            <select name="cmbImportType" id="cmbImportType" class="formSelect">
                <option value="0">-- Select --</option>
                <?php
                foreach ($customImportList as $k => $v) {
                    if (!is_int($k)) {
                        $pluginImportTypesFound = true;
                        $v .= ' (+)';
                    }
                ?>
                        <option value="<?php echo $k; ?>"><?php echo $v; ?></option>
            <?php } ?>
                </select>
<?php if ($pluginImportTypesFound) { ?>
                    <div class="fieldHint">Import Types marked with (+) are defined in Plugin files and are not editable via the UI.</div>
<?php } ?>
                <div class="fieldHint">Custom import types can be managed <a href='<?php echo url_for('admin/listCustomImport') ?>'>here</a></div>
            <br class="clear"/>
            <label for="importFile">CSV File<span class="required">*</span></label>
            <input type="file" name="importFile" id="importFile" />
            <div class="formbuttons">
                <input type="button" class="exportbutton" id="btnImport" onclick="importCSVData();" onmouseover="moverButton(this);" onmouseout="moutButton(this);" value="Import" />
            </div>
        </form>
    </div>
    <div class="requirednotice" id="footerMessage">&nbsp;</div>
</div>
<script type="text/javascript">
    function importCSVData()
    {
        if($("#cmbImportType").val() == 0) {
            $("#footerMessage").html("Select import type");
            return false;
        }

        if($("#importFile").val() == "") {
            $("#footerMessage").html("Choose a CSV file to import");
            return false;
        } else {
            var fileName = $("#importFile").val();
            if(fileName.indexOf(".csv") == -1) {
                $("#footerMessage").html("Choose a CSV file to import");
                return false;
            }
        }

        $("#frmDataImport").submit();
    }
</script>