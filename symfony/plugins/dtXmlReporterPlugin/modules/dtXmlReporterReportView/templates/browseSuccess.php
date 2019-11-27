<?php use_stylesheet('/sf/sf_admin/css/main') ?>
<h2>Browse</h2>
<div id ="sf_admin_container">
<table class="sf_admin_list">
  <thead>
    <th>Categories</th>
  </thead>
  <tbody>
      <?php if ($parent_category) : ?>
      <tr>
        <td>
          <?php echo image_tag(sfConfig::get('sf_admin_web_dir').'/images/first.png') ?>
          <?php echo link_to('Back', 'dtXmlReporterReportView/browse?category_id='.$parent_category -> getAttribute('id')) ?>
        </td>
      </tr>
      <?php endif ?>
      <?php foreach($categories as $category) : ?>
     <tr>
        <td>
          <?php echo image_tag(sfConfig::get('sf_admin_web_dir').'/images/list.png') ?>
          <?php echo link_to($category -> getAttribute('name'), 'dtXmlReporterReportView/browse?category_id='.$category -> getAttribute('id')) 
          ?>
        </td>
       </tr>
    <?php endforeach ?>
  </tbody>
</table>

<table class="sf_admin_list">
  <thead>
    <th colspan="2">Reports</th>
  </thead>
  <tbody>
  <?php if ($reports -> item(0)) : ?>
    <?php foreach($reports as $i => $report) : ?>
      <tr>
        <td><?php echo $i+1 ?>.</td>
        <td>
          <?php if ($report -> getAttribute('inactive') == 'true') : ?>
            <span style="color: #aaaaaa; font-style: italic;"><?php echo $report -> getAttribute('name') ?> (inactive)</span>
          <?php elseif ($report -> getAttribute('locked') == true) : ?>
            <span style="color: #aaaaaa; font-style: italic;"><?php echo $report -> getAttribute('name') ?> (locked)</span>
          <?php else : ?>
            <?php echo link_to($report -> getAttribute('name'),'dtXmlReporterReportView/view?report_id='.$report -> getAttribute('id')) ?>
          <?php endif ?>
        </td>
      </tr>
    <?php endforeach ?>
  <?php else: ?>
    <tr>
      <td colspan="2">No reports here.</td>
    </tr>
  <?php endif ?>
  </tbody>
</table>


</div>
