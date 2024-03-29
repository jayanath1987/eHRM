<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseEBMasterHead extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('hs_hr_eb_master_head');
        $this->hasColumn('ebh_id', 'integer', 11, array(
             'type' => 'integer',
             'primary' => true,
             'length' => '11',
             ));
        $this->hasColumn('grade_code', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             ));
        $this->hasColumn('ebh_exp_year', 'integer', 11, array(
             'type' => 'integer',
             'length' => '11',
             ));
        $this->hasColumn('ebh_exam_name', 'string', 200, array(
             'type' => 'string',
             'length' => '200',
             ));
        $this->hasColumn('ebh_exam_name_si', 'string', 200, array(
             'type' => 'string',
             'length' => '200',
             ));
        $this->hasColumn('ebh_exam_name_ta', 'string', 200, array(
             'type' => 'string',
             'length' => '200',
             ));
    }

    public function setUp()
    {
        $this->hasOne('Grade', array(
             'local' => 'grade_code',
             'foreign' => 'grade_code'));

        $this->hasMany('EBMasterDetail', array(
             'local' => 'ebh_id',
             'foreign' => 'ebh_id'));
    }
}