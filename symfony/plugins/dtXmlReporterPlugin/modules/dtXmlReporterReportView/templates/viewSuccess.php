<?php if (@$error) : ?>
  <h2>Error encountered when rendering report</h2>
  <div class="error">
    <?php echo nl2br(htmlentities($error)) ?>
  </div>
<?php else : ?>
  <?php if ($xml_error_count) : ?>
    <div class="error">
      <?php echo $xml_error_count.' serious errors were encountered when rendering this query. Please check the logs' ?>
    </div>
  <?php endif ?>
  <?php if ($report -> getFilters()) : ?>
    <?php include_partial('filters', array('report' => $report)) ?>
  <?php endif?>
  <?php echo $report_html ?>
<?php endif ?>
