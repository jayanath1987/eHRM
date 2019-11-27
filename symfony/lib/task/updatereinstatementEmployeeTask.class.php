<?php

class updatereinstatementEmployeeTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'propel'),
      // add your own options here
    ));

    $this->namespace        = 'updatereinstatement';
    $this->name             = 'employee';
    $this->briefDescription = '';
    $this->detailedDescription = <<<EOF
The [updatereinstatement:employee|INFO] task does things.
Call it with:

  [php symfony updatereinstatement:employee|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
$databaseManager = new sfDatabaseManager(sfProjectConfiguration::getApplicationConfiguration('orangehrm', 'prod', true));
        $connection = $databaseManager->getDatabase("doctrine")->getConnection();
        $conn = Doctrine_Manager::getInstance()->connection($connection);
      $connection= Doctrine_Manager::getInstance()->connection();

      $ReinstatementService = new ReinstatementService();
        try{
              $conn = Doctrine_Manager::getInstance()->connection();
              $conn->beginTransaction();
        $ReinstatementList=$ReinstatementService->getPendingUpadateReinstatement();
        foreach($ReinstatementList as $Reinstatement){
            $PayrollEmployee=$ReinstatementService->readPayrollEmployee($Reinstatement->emp_number);
            
            if($PayrollEmployee){
            $PayrollEmployee->setEmp_epf_number($Reinstatement->emp_epf_number);
            $PayrollEmployee->save();
            }    
            
                }
                $conn->commit();
                $output=$Reinstatement->rei_date .' - Reinstatement SUCCESS'."\n";
             } catch (sfStopException $e) {
                 
             } catch (Exception $e) {
                $conn->rollback();
                $output=$Reinstatement->rei_date .' - Reinstatement WARNING'."\n";
            }
        echo $output;
  }
}
