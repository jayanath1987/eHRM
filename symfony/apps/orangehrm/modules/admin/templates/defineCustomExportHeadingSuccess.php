<div class="formpage">
    <div class="navigation">
        <input type="button" class="backbutton" id="btnBack" value="<?php echo __("Back") ?>" tabindex="5" onclick="goBack();"/>
    </div>
    <div class="outerbox">
        <div class="mainHeading"><h2><?php echo __("Define CSV Heading for Custom Export : " . $customExport->getName()); ?></h2></div>

        <!-- user form to save data -->
        <form name="frmCustomExport" id="frmCustomExport" method="post" action="<?php echo url_for('admin/saveCustomExportHeading?export_id=' . $customExport->getExportId()); ?>">
            <table class="simpleList" >
                <tr>
                    <th width="125" style="align:left;">Assigned Fields</th>
                    <th width="40">CSV column headings</th>
                </tr>
                <?php
                $rowCss = 'odd';
                foreach ($fields as $k => $field) {
                    if ($rowCss == 'odd') {
                        $rowCss = 'even';
                    } else {
                        $rowCss = 'odd';
                    }
                ?>
                    <tr class="<?php echo $rowCss; ?>">
                        <td align="left"><input type="hidden" name="assignedFields[]" value="<?php echo $field ?>" /><?php echo $field; ?></td>
                        <td><input type="text" value="<?php echo $field ?>" id="headings_<?php echo $k; ?>" name="headings[]" /></td>
                    </tr>
<?php } ?>
            </table>
            <input type="hidden" id="numFields" value="<?php echo count($fields); ?>" />
            <div class="formbuttons">
                <input type="button" class="savebutton" onmouseover="moverButton(this);" onmouseout="moutButton(this);" onclick="javascript:validateCustomExportHeadingSave();"
                       value="<?php echo __("Save"); ?>" />
                <input type="reset" class="clearbutton" onmouseover="moverButton(this);" onmouseout="moutButton(this);"
                       value="<?php echo __("Reset"); ?>" />
            </div>
        </form>
    </div>
</div>