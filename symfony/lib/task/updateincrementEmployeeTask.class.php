<?php
//require_once ('/../../../lib/common/LocaleUtil.php');
//include ('/var/www/eSamudhiHRM/lib/common/LocaleUtil.php');
class updateincrementEmployeeTask extends sfBaseTask
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

    $this->namespace        = 'updateincrement';
    $this->name             = 'employee';
    $this->briefDescription = '';
    $this->detailedDescription = <<<EOF
The [updateincrement:employee|INFO] task does things.
Call it with:

  [php symfony updateincrement:employee|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    //$databaseManager = new sfDatabaseManager($this->configuration);
    //$connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();
    
      $databaseManager = new sfDatabaseManager(sfProjectConfiguration::getApplicationConfiguration('orangehrm', 'prod', true));
        $connection = $databaseManager->getDatabase("doctrine")->getConnection();
        $conn = Doctrine_Manager::getInstance()->connection($connection);


      $connection= Doctrine_Manager::getInstance()->connection();

      
      $SalarayIncrementService=new SalarayIncrementService();
      try{
          $conn = Doctrine_Manager::getInstance()->connection();
          $conn->beginTransaction();    
          $List=$SalarayIncrementService->getSalaryIncrementEffectiveDateToday();
          foreach($List as $emp){
              $employee=$SalarayIncrementService->findEmployee($emp->emp_number);
              $employee->setGrade_code($emp->inc_new_grade_code);
              $employee->setSlt_scale_year($emp->inc_new_slt_scale_year);
              $SalarayIncrementService->saveEmployee($employee);
          }
          $conn->commit();
          $output=$emp->inc_effective_date.' - Increment SUCCESS'."\n";   
      
          
      } catch (sfStopException $e) {
                        
      } catch (Exception $e) {
            $conn->rollback();
            $output=$emp->inc_effective_date.' - Increment WARNING'."\n";

        }
      echo $output;
    // add your code here
  }
}
