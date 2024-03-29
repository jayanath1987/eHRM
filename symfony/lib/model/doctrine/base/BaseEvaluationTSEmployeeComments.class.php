<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseEvaluationTSEmployeeComments extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('hs_hr_evl_ts_emp_comment_detail');
        $this->hasColumn('etc_id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => '4',
             ));
        $this->hasColumn('emp_ts_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             ));
        $this->hasColumn('etc_comment', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('etc_date', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('emp_number', 'integer', 7, array(
             'type' => 'integer',
             'length' => '7',
             ));
    }

    public function setUp()
    {
        $this->hasOne('Employee', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasOne('EvaluationTSEmployee', array(
             'local' => 'emp_ts_id',
             'foreign' => 'emp_ts_id'));
    }
}