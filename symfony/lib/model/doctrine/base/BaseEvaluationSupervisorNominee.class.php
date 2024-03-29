<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseEvaluationSupervisorNominee extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('hs_hr_evl_evaluation_supervisor');
        $this->hasColumn('evl_id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => '4',
             ));
        $this->hasColumn('eval_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             ));
        $this->hasColumn('emp_number', 'integer', 7, array(
             'type' => 'integer',
             'length' => '7',
             ));
        $this->hasColumn('sup_num', 'integer', 7, array(
             'type' => 'integer',
             'length' => '7',
             ));
        $this->hasColumn('eval_sup_flag', 'string', 1, array(
             'type' => 'string',
             'length' => '1',
             ));
        $this->hasColumn('evl_nomine_emp_number', 'integer', 7, array(
             'type' => 'integer',
             'length' => '7',
             ));
    }

    public function setUp()
    {
        $this->hasOne('EvaluationCompany', array(
             'local' => 'eval_id',
             'foreign' => 'eval_id'));

        $this->hasOne('EmployeeMaster as Employee', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasOne('EmployeeMaster as Supervisor', array(
             'local' => 'sup_num',
             'foreign' => 'emp_number'));

        $this->hasOne('EmployeeMaster as Nominee', array(
             'local' => 'evl_nomine_emp_number',
             'foreign' => 'emp_number'));
    }
}