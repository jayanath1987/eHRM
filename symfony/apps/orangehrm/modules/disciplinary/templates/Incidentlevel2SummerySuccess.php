<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/jquery.autocomplete.js')?>"></script>

<div class="outerbox">
<div class="maincontent">

	<div class="mainHeading"><h2><?php echo __("Incident Summary")?></h2></div>
	<?php echo message()?>
	<form name="frmSearchBox" id="frmSearchBox" method="post" action="" onsubmit="return validateform();">
	 	<input type="hidden" name="mode" value="search">
		<div class="searchbox">
	        <label for="searchMode"><?php echo __("Search By")?></label>


	        <select name="searchMode" id="searchMode">
	            <option value="all"><?php echo __("--Select--")?></option>

	            <option value="code" <?php if($searchMode == 'id'){ echo "selected";}?>><?php echo __("Code")?></option>
	            <option value="rby" <?php if($searchMode == 'rby'){ echo "selected";}?>><?php echo __("Reported By")?></option>
                <option value="date" <?php if($searchMode == 'date'){ echo "selected";}?>><?php echo __("Incident Date")?></option>

	        </select>


	        <label for="searchValue"><?php echo __("Search For") ?>:</label>
                
	        <input type="text" size="20" name="searchValue" id="searchValue" value="<?php echo $searchValue?>" />
                
	        <input type="submit" class="plainbtn"
	            value="<?php echo __("Search")?>" />
	        <input type="reset" class="plainbtn"
	             value="<?php echo __("Reset")?>" id="resetBtn" />
	        <br class="clear"/>
	    </div>
    </form>
      <div class="actionbar">
        <div class="actionbuttons">

            <input type="button" class="plainbtn" id="buttonAdd"
                value="<?php echo __("Add")?>" />


             <input type="button" class="plainbtn" id="buttonRemove"
                    value="<?php echo __("Delete")?>" />

        </div>
        <div class="noresultsbar"></div>
        <div class="pagingbar"><?php echo is_object($pglay)?$pglay->display():''; ?></div>
    <br class="clear" />
    </div>
     <br class="clear" />
     <form name="standardView" id="standardView" method="post" action="<?php echo url_for('disciplinary/DeleteActionType') ?>">
     <input type="hidden" name="mode" id="mode" value="">
    	<table cellpadding="0" cellspacing="0" class="data-table">
			<thead>
            <tr>
				<td width="50">

					<input type="checkbox" class="checkbox" name="allCheck" value="" id="allCheck" />

				</td>


					<td scope="col">
	<?php echo $sorter->sortLink('i.dis_inc_id', __('Code'), '@Dis_pen_insident_sum', ESC_RAW); ?>

					</td>

<td scope="col">
<?php
                            if ($culture == "en")
                                $feildName = "e.emp_display_name";
                            else
                                $feildName="e.emp_display_name_" . $culture;
                            ?>
	<?php echo $sorter->sortLink($feildName, __('Reported By'), '@Dis_pen_insident_sum', ESC_RAW); ?>

					</td>
                    
                    <td scope="col">
	<?php echo $sorter->sortLink('i.dis_inc_date', __('Incident Date'), '@Dis_pen_insident_sum', ESC_RAW); ?>

					</td>
                    <td scope="col">
	<?php echo $sorter->sortLink('i.dis_inc_prim_summary', __('Incident Summary'), '@Dis_pen_insident_sum', ESC_RAW); ?>

					</td>
                    <td scope="col">
	<?php echo $sorter->sortLink('i.dis_inc_isclosed', __('Status'), '@Dis_pen_insident_sum', ESC_RAW); ?>

					</td>
                    <td scope="col">
	<?php echo __(''); ?>

					</td>

            </tr>
    		</thead>

            <tbody>
    		<?php
    		 $row = 0;
    		foreach($inscidentList as $list){
    			$cssClass = ($row %2) ? 'even' : 'odd';
				$row = $row + 1;
    			?>
                       <tr class="<?php echo $cssClass?>">
       				<td>
                    
						<input type='checkbox' class='checkbox innercheckbox' name='chkLocID[]' id="chkLoc" value='<?php echo $list->getDis_acttype_id()?>' />
				</td>
                    <td>
                            <?php $list->dis_inc_id; ?>
                    </td>
		 			<td class="">
		 
                         <?php
                         
 
  if($culture=='en'){
                                  $abc = "emp_display_name";
                              }else{
                                  $abc = "emp_display_name_".$culture;
                              }
                              if($list->Employee->$abc==""){
                               echo $list->Employee->emp_display_name;} else
                                   {echo $list->Employee->$abc;}
 ?>
                                 
		 			</td>
                    <td>
                    <?php
                    echo $list->dis_inc_date; 
                    ?>
                    </td>
                    <td>
                    <?php
                      
                     $dd=$list->dis_inc_prim_summary;
                            $rest = substr($list->dis_inc_prim_summary, 0,100);
                             
                                   if (strlen($dd) > 100) {
                                       echo $rest ?>.<span title="<?php echo $dd ?>">...</span> <?php
                                    } else {
                                        echo $rest;
                                    }
                     
                     ?>
                    </td>
<td>    
<?php
     
     if($list->dis_inc_isclosed==0){
        echo __("Ongoing");
     }else{
        echo __("Closed");
     }
     
     ?>
     
    </td>
    <td>
    <a href="<?php echo url_for('disciplinary/UpdateInsidentlevel2?id='.$list->dis_inc_id) ?>"><?php echo __("View");?></a>
    </td>

		 	</tr>
			 	<?php }?>
            </tbody>
 		</table>
</form>
</div>
</div>
<script type="text/javascript">
 

function validateform(){

                if($("#searchValue").val()=="")
                {

                   alert("<?php echo __('Please enter search value')?>");
                    return false;

                }
                if($("#searchMode").val()=="all"){
                    alert("<?php echo __('Please select the search mode')?>");
                    return false;
                }
                else{
                    $("#frmSearchBox").submit();
                }
    
}


$(document).ready(function() {

   $("#buttonRemove").click(function() {
                        $("#mode").attr('value', 'delete');
                        if($('input[name=chkLocID[]]').is(':checked')){
                            answer = confirm("<?php echo __("Do you really want to Delete?") ?>");
                        }


                        else{
                            alert("<?php echo __("select at least one check box to delete") ?>");

                        }

                        if (answer !=0)
                        {

                            $("#standardView").submit();

                        }
                        else{
                            return false;
                        }

                    });


	//When click add button
	$("#buttonAdd").click(function() {
		location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/disciplinary/SaveInsident')) ?>";

   });
    $("#btnBack").click(function() {
				 location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/disciplinary/IncidentSummary')) ?>";
				});

	// When Click Main Tick box
	$("#allCheck").click(function() {
		if ($('#allCheck').attr('checked')){

			$('.innercheckbox').attr('checked','checked');
		}else{
			$('.innercheckbox').removeAttr('checked');
		}
	});

	$(".innercheckbox").click(function() {
		if($(this).attr('checked'))
		{

		}else
		{
			$('#allCheck').removeAttr('checked');
		}
	});


                    $("#resetBtn").click(function() {
					//document.forms[0].reset('');
                                  location.href = "<?php echo url_for(public_path('../../symfony/web/index.php/disciplinary/IncidentSummary')) ?>";
				 });


});


</script>

