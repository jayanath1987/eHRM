<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseWfMainAppPerson extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('hs_hr_wf_main_app_person');
        $this->hasColumn('wfmain_id', 'integer', 50, array(
             'type' => 'integer',
             'primary' => true,
             'length' => '50',
             ));
        $this->hasColumn('wfmain_sequence', 'integer', 50, array(
             'type' => 'integer',
             'primary' => true,
             'length' => '50',
             ));
        $this->hasColumn('wf_main_app_employee', 'string', 200, array(
             'type' => 'string',
             'primary' => true,
             'length' => '200',
             ));
    }

    public function setUp()
    {
        $this->hasOne('WfMain', array(
             'local' => 'wfmain_id',
             'foreign' => 'wfmain_id'));

        $this->hasOne('Employee', array(
             'local' => 'wf_main_app_employee',
             'foreign' => 'emp_number'));
    }
}