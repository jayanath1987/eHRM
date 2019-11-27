<?php $pluginExportTypesFound = false; ?>

<div class="formpage">
    <div class="outerbox">
        <div class="mainHeading"><h2>Export HR Data</h2></div>
        <form name="frmDataExport" id="frmDataExport" method="post" action="<?php echo url_for('admin/export'); ?>">
            <?php echo $form['_csrf_token']; ?>
            <label for="cmbExportType">Export Type<span class="required">*</span></label>
            <select name="cmbExportType" id="cmbExportType" class="formSelect">
                <option value="0">--Select--</option>
                <?php foreach ($exportTypes as $k => $v) {
                    if (!is_int($k)) {
                        $v .= " " . "(+)";
                        $pluginExportTypesFound = true;
                    } ?>
                    <option value="<?php echo $k; ?>"><?php echo $v; ?></option>
<?php } ?>
                </select>
<?php if ($pluginExportTypesFound) { ?>
                    <div class="fieldHint">Export Types marked with (+) are defined in Plugin files and are not editable via the UI.</div>
<?php } ?>
                <div class="fieldHint">Custom export types can be managed <a href="<?php echo url_for('admin/defineCustomExport'); ?>">Here</a></div>
            <br class="clear"/>
            <div class="formbuttons">
                <input type="button" class="exportbutton" onclick="exportData();" value="Export" />
            </div>
        </form>
    </div>
</div>