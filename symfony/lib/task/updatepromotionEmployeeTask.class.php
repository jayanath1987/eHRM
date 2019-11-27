<?php

class updatepromotionEmployeeTask extends sfBaseTask
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

    $this->namespace        = 'updatepromotion';
    $this->name             = 'employee';
    $this->briefDescription = '';
    $this->detailedDescription = <<<EOF
The [updatepromotion:employee|INFO] task does things.
Call it with:

  [php symfony updatepromotion:employee|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
        $databaseManager = new sfDatabaseManager(sfProjectConfiguration::getApplicationConfiguration('orangehrm', 'prod', true));
        $connection = $databaseManager->getDatabase("doctrine")->getConnection();
        $conn = Doctrine_Manager::getInstance()->connection($connection);
      $connection= Doctrine_Manager::getInstance()->connection();

      $PromotionService = new promotionService();
        try{
              $conn = Doctrine_Manager::getInstance()->connection();
              $conn->beginTransaction();
        $PromotionList=$PromotionService->getPendingUpadatePromotions();
        foreach($PromotionList as $Promotion){
            $Employee=$PromotionService->getEmployee($Promotion->emp_number);
            $Employee->setJob_title_code($Promotion->jobtit_code);
            $Employee->setEmp_status($Promotion->estat_code);
            $Employee->setLevel_code($Promotion->level_code);
            $Employee->setService_code($Promotion->service_code);
            $Employee->setClass_code($Promotion->class_code);
            $Employee->setGrade_code($Promotion->grade_code);
            $Employee->setSlt_scale_year($Promotion->slt_id);
            $Employee->setEmp_salary_inc_date($Promotion->emp_salary_inc_date);
            $Employee->setWork_station($Promotion->prm_divition);
            
            $empDeflevelById=$PromotionService->readDeflevelById($Promotion->emp_number);
                       
                        if($empDeflevelById){

                            $empDeflevel = $empDeflevelById;
                        }
                        
                        for ($i = 1; $i <= 10; $i++) {

                            $emp_def_col = "hie_code_" . $i;
                            $empDeflevel->$emp_def_col = null;
                            $Employee->$emp_def_col = null;
                        }
                        

                        $hieCode = $Promotion->prm_divition;

                        $division = $PromotionService->readCompanyStructure($hieCode);
                        $defLevel = $division->getDefLevel();
                         while ($defLevel > 0 && $hieCode > 0) {

                            $hieCodeCol = "hie_code_" . $defLevel;
                            
                            $empDeflevel->$hieCodeCol = $hieCode;
                            $Employee->$hieCodeCol = $hieCode;
                            
                            $hieCode = $division->getParnt();
                            $division = $PromotionService->readCompanyStructure($hieCode);

                            $defLevel = $defLevel - 1;
                        }
                        $empDeflevel->emp_number = $Employee->empNumber;
                        $empDeflevel->save();
            
            
            $Employee->save();
                }
                $conn->commit();
                $output=$Promotion->prm_effective_date.' - Promotion SUCCESS'."\n";
             } catch (sfStopException $e) {
                 
             } catch (Exception $e) {
                $conn->rollback();
                $output=$Promotion->prm_effective_date.' - Promotion WARNING'."\n";
            }
        echo $output;
    
  }
}
