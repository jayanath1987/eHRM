<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ROOT_PATH . '/lib/common/LocaleUtil.php';
/**
 * Form class for employee contact detail
 */
class EmployeeEBExamForm extends sfForm {

    public function configure() {
              $this->setWidgets(array(
                'txtEmpID' => new sfWidgetFormInputHidden(),
                'txtExamId' => new sfWidgetFormInputHidden(),
                'txtEBxamdescEn' =>new sfWidgetFormInput(),
                'txtEBxamdescSi' =>new sfWidgetFormInput(),
                'txtEBxamdescTa' => new sfWidgetFormInput(),
                'txtEbResultEn' => new sfWidgetFormInput(),
                'txtEbResultSi' => new sfWidgetFormInput(),
                'txtEbResultTa' => new sfWidgetFormInput(),
                'cmbExamStatus' => new sfWidgetFormInput(),
                'txtEbexamDate' => new sfWidgetFormInput(),                

    ));

    
    $this->setValidators(array(
                'txtEmpID' => new sfValidatorString(array('required' => true)),
                'txtExamId' => new sfValidatorString(array('required' => false)),
                'txtEBxamdescEn' =>new sfValidatorString(array('required' => false)),
                'txtEBxamdescSi' =>new sfValidatorString(array('required' => false)),
                'txtEBxamdescTa' => new sfValidatorString(array('required' => false)),
                'txtEbResultEn' => new sfValidatorString(array('required' => false)),
                'txtEbResultSi' => new sfValidatorString(array('required' => false)),
                'txtEbResultTa' => new sfValidatorString(array('required' => false)),
                'cmbExamStatus' => new sfValidatorString(array('required' => false)),
                'txtEbexamDate' => new sfValidatorString(array('required' => false)),
                 
          ));
    }

     /**
     * Get Employee object with values filled using form values
     */
    public function getEBexam($empNumber,$ExamId) {

        $ebExam = Doctrine::getTable('EBExam')->find(array('ebexam_id' => $ExamId,'emp_number' => $empNumber));
                                                                      

        if (is_object($ebExam)==false) {
            $ebExam=new EBExam();
            $ebExam->emp_number=$empNumber;           
        }
      
        //$ebExam->emp_number = $this->getValue('txtEmpID');
        if($this->getValue('txtEbexamDate')!= null){
        $ebExam->ebexam_date = LocaleUtil::getInstance()->convertToStandardDateFormat($this->getValue('txtEbexamDate'));
        }else{
            $ebExam->ebexam_date =null;
        }
        $ebExam->ebexam_description=$this->getValue('txtEBxamdescEn');
        $ebExam->ebexam_description_si=$this->getValue('txtEBxamdescSi');
        $ebExam->ebexam_description_ta=$this->getValue('txtEBxamdescTa');
        $ebExam->ebexam_results=$this->getValue('txtEbResultEn');
        $ebExam->ebexam_results_si=$this->getValue('txtEbResultSi');
        $ebExam->ebexam_results_ta=$this->getValue('txtEbResultTa');
        $ebExam->ebexam_status=$this->getValue('cmbExamStatus');

        return $ebExam;
    }

}
?>
