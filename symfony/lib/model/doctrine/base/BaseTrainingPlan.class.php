<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseTrainingPlan extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('hs_hr_td_tarining_plan');
        $this->hasColumn('td_plan_id', 'integer', 25, array(
             'type' => 'integer',
             'primary' => true,
             'length' => '25',
             ));
        $this->hasColumn('td_plan_month', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
             ));
        $this->hasColumn('td_plan_year', 'string', 4, array(
             'type' => 'string',
             'length' => '4',
             ));
        $this->hasColumn('td_inst_id', 'integer', 6, array(
             'type' => 'integer',
             'length' => '6',
             ));
        $this->hasColumn('td_course_id', 'integer', 6, array(
             'type' => 'integer',
             'length' => '6',
             ));
        $this->hasColumn('td_plan_training_summery', 'string', 200, array(
             'type' => 'string',
             'length' => '200',
             ));
        $this->hasColumn('td_plan_training_frowhom', 'string', 200, array(
             'type' => 'string',
             'length' => '200',
             ));
        $this->hasColumn('td_plan_resource_person', 'string', 200, array(
             'type' => 'string',
             'length' => '200',
             ));
        $this->hasColumn('level_code', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             ));
    }

    public function setUp()
    {
        $this->hasOne('Level', array(
             'local' => 'level_code',
             'foreign' => 'level_code'));

        $this->hasOne('TrainingInstitute', array(
             'local' => 'td_inst_id',
             'foreign' => 'td_inst_id'));

        $this->hasOne('TrainingCourse', array(
             'local' => 'td_course_id',
             'foreign' => 'td_course_id'));
    }
}