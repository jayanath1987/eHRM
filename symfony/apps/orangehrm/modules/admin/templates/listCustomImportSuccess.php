<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.autocomplete.js') ?>"></script>


<div class="outerbox">
    <div class="maincontent">
        <div class="mainHeading"><h2><?php echo __("Custom Import Definitions") ?></h2></div>
        <form name="frmSearchBox" id="frmSearchBox" method="post" action="">
            <input type="hidden" name="mode" value="search" />
            <div class="searchbox">
                <label for="searchMode"><?php echo __("Search By") ?></label>
                <select name="searchMode" id="searchMode">
                    <option value="all"><?php echo __("--Select--") ?></option>
                    <?php foreach ($searchParams as $k => $value) {
 ?>
                        <option value="<?php echo $k; ?>" <?php if ($searchMode == $k) {
                            echo "selected";
                        } ?>><?php echo __($value); ?></option>
<?php } ?>
                </select>

                <label for="searchValue">Search For:</label>
                <input type="text" size="20" name="searchValue" id="searchValue" value="<?php echo $searchValue ?>" />
                <input type="submit" class="plainbtn" value="<?php echo __("Search") ?>" />
                <input type="reset" class="plainbtn" value="<?php echo __("Reset") ?>" />
                <br class="clear"/>
            </div>
        </form>
        <div class="actionbar">
            <div class="actionbuttons">
<?php $url = public_path('../../symfony/web/index.php/admin/defineCustomImport'); ?>
                    <input type="button" class="plainbtn" value="<?php echo __("Add") ?>" onclick="navigateUrl('<?php echo $url; ?>');" />
                    <input type="button" class="plainbtn" value="<?php echo __("Delete") ?>" onclick="checkBeforeDelete('chkImportId', 'standardView');" />
                </div>
                <div class="noresultsbar"></div>
                <div class="pagingbar"> </div>
                <br class="clear" />
            </div>
            <br class="clear" />
            <form name="standardView" id="standardView" method="post" action="">
                <input type="hidden" name="mode" id="mode" value="delete" />
                <table cellpadding="0" cellspacing="0" class="data-table">
                    <thead>
                        <tr>
                            <td><input type="checkbox" class="checkbox" name="allCheck" value="" id="allCheck" onclick="selectAllForDelete(this.id);"/></td>
                            <td scope="col"><?php echo $sorter->sortLink('import_id', __('Import Id'), '@customImport_list', ESC_RAW); ?></td>
                            <td scope="col"><?php echo $sorter->sortLink('name', __('Name'), '@customImport_list', ESC_RAW); ?></td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $rowCss = 'odd';
                    foreach ($listCustomImport as $k => $customImport) {
                        if ($rowCss == 'odd') {
                            $rowCss = 'even';
                        } else {
                            $rowCss = 'odd';
                        }
                    ?>
                        <tr class="<?php echo $rowCss; ?>">
                            <td width="5%"><input type='checkbox' class='checkbox innercheckbox' name='chkImportId[]' id="chkImportId_<?php echo $k; ?>" value='<?php echo $customImport->getImportId(); ?>' /></td>
                            <td width="25%"><a href="<?php echo url_for('admin/defineCustomImport?mode=update&import_id=' . $customImport->getImportId()); ?>"><?php echo $customImport->getImportId(); ?></a></td>
                            <td><a href="<?php echo url_for('admin/defineCustomImport?mode=update&import_id=' . $customImport->getImportId()); ?>"><?php echo $customImport->getName(); ?></a></td>
                        </tr>
<?php } ?>
                <input type="hidden" value="<?php echo count($listCustomImport); ?>" id="numRecords" />
                </tbody>
            </table>
        </form>
    </div>
</div>