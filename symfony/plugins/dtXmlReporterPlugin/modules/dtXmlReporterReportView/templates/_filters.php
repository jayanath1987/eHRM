<div class="filters">
<form action="<?php echo url_for(array('module' => 'dtXmlReporterReportView', 'action' => 'view', 'report_id' => $sf_params -> get('report_id') )) ?>" method="GET"> 
<table>
<tr>
  <tr>
    <td>
  <?php foreach ($report -> getFilters() as $filter) : ?>
    <div style="display: inline; white-space: nowrap">
      <b><?php echo $filter -> getLabel() ?></b>&nbsp;
      <?php echo $filter -> render() ?>
    </div>
  <?php endforeach ?>
    </td>
  </tr>
  <tr>
  <td style="text-align: right">
    <input type="submit" value="Apply filters"/>
  </td>
</tr>
</table>
</form>
</div>
 
