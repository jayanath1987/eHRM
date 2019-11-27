<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.autocomplete.js')?>"></script>

<div class="outerbox">
<div class="maincontent">

    <div class="mainHeading"><h2><?php echo __("View Report")?></h2></div>
	<?php echo message();?>
	<form name="frmSearchBox" id="frmSearchBox" method="post" action="">
	 	<input type="hidden" name="mode" value="search" />
		<div class="searchbox">
                    <label for="cmbSearchMode"><?php echo __("Search By")?></label>
                    <select name="cmbSearchMode" id="cmbSearchMode">
                        <option value="all"><?php echo __("--Select--")?></option>
                        <option value="rn_rpt_name" <?php if($searchMode == 'rn_rpt_name'){ echo "selected";}?>><?php echo __("Report Name")?></option>
                    </select>

                    <label for="txtSearchValue"><?php echo __("Search For:")?></label>
                    <input type="text" size="15" name="txtSearchValue" id="txtSearchValue" value="<?php echo $searchValue?>" />
                    <input type="button" class="plainbtn" id="btnSearch"
                        value="<?php echo __("Search")?>" />
                    <input type="reset" class="plainbtn" id="btnReset"
                         value="<?php echo __("Reset")?>" />
                    <label for="cmbSearchMode" ><?php echo __("Language")?></label>
                    <select name="cmbReportLanguage" id="cmbReportLanguage" onchange="LoadReportList();">
                        <option value="en" <?php if($reportLanguage == 'en'){ echo "selected";}?>><?php echo __("English")?></option>
                        <option value="si" <?php if($reportLanguage == 'si'){ echo "selected";}?>><?php echo __("Sinhala")?></option>
                        <option value="ta" <?php if($reportLanguage == 'ta'){ echo "selected";}?>><?php echo __("Tamil")?></option>
                    </select>
                    <br class="clear"/>
                </div>
        </form>
        <div class="actionbar">        
        <div class="noresultsbar"></div>
        <div class="pagingbar">
            <?php
            if (is_object($pglay)) {
                if ($pglay->getPager()->haveToPaginate() == 1) {
                    echo $pglay->display();
                }
            }
            ?>
        </div>

        <br class="clear" />
    </div>
    <br class="clear" />
    <form name="standardView" id="standardView" method="post" action="">
        <input type="hidden" name="mode" id="mode" value=""/>
    	<table cellpadding="0" cellspacing="0" class="data-table">
            <thead>
                <tr>
                    <td width="10">
                    </td>                    
                    <td scope="col">
                        <?php echo $sorter->sortLink('rn_rpt_name', __('Report Name'), '@report_list', ESC_RAW); ?>
                    </td>
                </tr>
            </thead>

            <tbody>
    		<?php
    		 $row = 0;
    		 foreach($listReport as $report){
    			$cssClass = ($row %2) ? 'even' : 'odd';
			$row = $row + 1;

                        //Define data columns according culture
                        $reportNameCol = ($userCulture == "en") ? "rn_rpt_name" : "rn_rpt_name_" . $userCulture;
                        $reportName = $report->$reportNameCol=="" ? $report->rn_rpt_name : $report->$reportNameCol;

                        $id = $report->rn_rpt_id;
                        $repPath = $report->rn_rpt_path;

                        $reportURL = $reportServerPath . $report->rn_rpt_path;
                ?>

		<tr class="<?php echo $cssClass?>">
                    <td></td>
                    <td class="">
                        <a href="<?php echo url_for('report/viewReportData?__report='.$repPath.'&reportLanguage='.$reportLanguage.'&id='.$id)?>" target="_blank"><?php echo $reportName?></a>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
</form>
</div>
</div>
<script type="text/javascript">

function LoadReportList() {
    var language = $('#cmbReportLanguage');
    if (language.val()=='en') {
        location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/report/viewReportList?selectedLanguage=en')) ?>";
    } else if (language.val()=='si') {
        location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/report/viewReportList?selectedLanguage=si')) ?>";
    } else if (language.val()=='ta') {
        location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/report/viewReportList?selectedLanguage=ta')) ?>";
    }
}

$(document).ready(function() {	        

	//When click Search Button
	$("#btnSearch").click(function() {
		$("#mode").attr('value', 'save');

                var searchMode = $('#cmbSearchMode');

                if (searchMode.val() == 'all')  {
                        alert('<?php echo __("Please select a field to search")?>');
                        searchMode.focus();
                        return false;
                } else {
                        $('#frmSearchBox').submit();
                        return true;
                }
	});

        //When click Reset Button
	$("#btnReset").click(function() {
                location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/report/viewReportList')) ?>";
	});

});

</script>

