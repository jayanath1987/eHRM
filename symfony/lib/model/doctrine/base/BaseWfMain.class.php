<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseWfMain extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('hs_hr_wf_main');
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
        $this->hasColumn('wfmain_app_date', 'date', 25, array(
             'type' => 'date',
             'length' => '25',
             ));
        $this->hasColumn('wfmain_comments', 'string', 200, array(
             'type' => 'string',
             'length' => '200',
             ));
        $this->hasColumn('wfmain_flow_id', 'integer', 50, array(
             'type' => 'integer',
             'length' => '50',
             ));
        $this->hasColumn('wfmain_iscomplete_flg', 'integer', 10, array(
             'type' => 'integer',
             'length' => '10',
             ));
        $this->hasColumn('wftype_code', 'integer', 50, array(
             'type' => 'integer',
             'length' => '50',
             ));
        $this->hasColumn('wfmain_approving_emp_number', 'integer', 200, array(
             'type' => 'integer',
             'length' => '200',
             ));
        $this->hasColumn('wfmain_orderid', 'integer', 50, array(
             'type' => 'integer',
             'length' => '50',
             ));
        $this->hasColumn('wfmain_application_date', 'date', 25, array(
             'type' => 'date',
             'length' => '25',
             ));
        $this->hasColumn('wfmain_current_date', 'date', 25, array(
             'type' => 'date',
             'length' => '25',
             ));
        $this->hasColumn('wfmain_is_hr_approved', 'integer', 10, array(
             'type' => 'integer',
             'length' => '10',
             ));
        $this->hasColumn('wfmain_previous_id', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
             ));
    }

    public function setUp()
    {
        $this->hasOne('Employee', array(
             'local' => 'wfmain_approving_emp_number',
             'foreign' => 'emp_number'));

        $this->hasMany('TransferRequest', array(
             'local' => 'wfmain_id',
             'foreign' => 'wfmain_id'));

        $this->hasMany('TrainAssign', array(
             'local' => 'wfmain_id',
             'foreign' => 'wfmain_id'));

        $this->hasMany('WfMainAppPerson', array(
             'local' => 'wfmain_id',
             'foreign' => 'wfmain_id'));

        $this->hasMany('WfModule', array(
             'local' => 'wfmain_id',
             'foreign' => 'wfmain_id'));

        $this->hasMany('Wftype', array(
             'local' => 'wftype_code',
             'foreign' => 'wftype_code'));

        $this->hasMany('VacancyRequisition', array(
             'local' => 'wfmain_id',
             'foreign' => 'wfmain_id'));
    }
}