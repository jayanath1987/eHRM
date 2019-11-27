<?php
/**
 * ExportForm, UI to export data to CSV file
 *
 * @author Sujith T
 */
class ExportForm extends sfForm {

   /**
    * Configuring
    */
   public function configure() {
      $this->widgetSchema->setNameFormat('export[%s]');
   }
}
?>
