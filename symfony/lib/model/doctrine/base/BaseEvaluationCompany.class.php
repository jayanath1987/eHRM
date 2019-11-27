<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseEvaluationCompany extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('hs_hr_evl_evaluation');
        $this->hasColumn('eval_id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => '4',
             ));
        $this->hasColumn('eval_code', 'string', 10, array(
             'type' => 'string',
             'length' => '10',
             ));
        $this->hasColumn('eval_name', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('eval_name_si', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('eval_name_ta', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('eval_desc', 'string', 200, array(
             'type' => 'string',
             'length' => '200',
             ));
        $this->hasColumn('eval_desc_si', 'string', 200, array(
             'type' => 'string',
             'length' => '200',
             ));
        $this->hasColumn('eval_desc_ta', 'string', 200, array(
             'type' => 'string',
             'length' => '200',
             ));
        $this->hasColumn('eval_year', 'string', 4, array(
             'type' => 'string',
             'length' => '4',
             ));
        $this->hasColumn('eval_active', 'string', 1, array(
             'type' => 'string',
             'length' => '1',
             ));
        $this->hasColumn('rate_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             ));
    }

    public function setUp()
    {
        $this->hasOne('PerformanceRate', array(
             'local' => 'rate_id',
             'foreign' => 'rate_id'));

        $this->hasMany('EvaluationSupervisorNominee', array(
             'local' => 'eval_id',
             'foreign' => 'eval_id'));

        $this->hasMany('EvaluationFunctionsTask', array(
             'local' => 'eval_id',
             'foreign' => 'eval_id'));

        $this->hasMany('EvaluationSkillEmployee', array(
             'local' => 'eval_id',
             'foreign' => 'eval_id'));

        $this->hasMany('EvaluationTSEmployee', array(
             'local' => 'eval_id',
             'foreign' => 'eval_id'));

        $this->hasMany('EvaluationEmployee', array(
             'local' => 'eval_id',
             'foreign' => 'eval_id'));
    }
}