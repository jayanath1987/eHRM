<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseServiceDetails extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('hs_hr_service');
        $this->hasColumn('service_code', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'length' => '4',
             ));
        $this->hasColumn('service_name', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('service_name_si', 'string', 100, array(
             'type' => 'string',
             'default' => '',
             'length' => '100',
             ));
        $this->hasColumn('service_name_ta', 'string', 100, array(
             'type' => 'string',
             'default' => '',
             'length' => '100',
             ));
    }

    public function setUp()
    {
        $this->hasMany('Employee', array(
             'local' => 'service_code',
             'foreign' => 'service_code'));

        $this->hasMany('EmployeeMaster', array(
             'local' => 'service_code',
             'foreign' => 'service_code'));

        $this->hasMany('Promotion', array(
             'local' => 'service_code',
             'foreign' => 'service_code'));

        $this->hasMany('EBExam', array(
             'local' => 'service_code',
             'foreign' => 'service_code'));

        $this->hasMany('JobRole', array(
             'local' => 'service_code',
             'foreign' => 'service_code'));

        $this->hasMany('PerformanceEvaluationDetail', array(
             'local' => 'service_code',
             'foreign' => 'service_code'));
    }
}