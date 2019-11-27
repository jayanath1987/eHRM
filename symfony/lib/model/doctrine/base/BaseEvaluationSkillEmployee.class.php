<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseEvaluationSkillEmployee extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('hs_hr_evl_skill_emp');
        $this->hasColumn('emp_skill_id', 'integer', 4, array(
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
        $this->hasColumn('skill_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             ));
        $this->hasColumn('emp_skill_from_date', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('emp_skill_to_date', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('emp_skill_active_flg', 'string', 1, array(
             'type' => 'string',
             'length' => '1',
             ));
        $this->hasColumn('emp_skill_approve_flg', 'string', 1, array(
             'type' => 'string',
             'length' => '1',
             ));
        $this->hasColumn('emp_skill_target_indicater', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('emp_skill_sup_comment', 'string', 500, array(
             'type' => 'string',
             'length' => '500',
             ));
        $this->hasColumn('emp_skill_mod_comment', 'string', 500, array(
             'type' => 'string',
             'length' => '500',
             ));
        $this->hasColumn('emp_skill_sup_mid_achive', 'float', 2147483647, array(
             'type' => 'float',
             'length' => '2147483647',
             ));
        $this->hasColumn('emp_skill_sup_end_achive', 'float', 2147483647, array(
             'type' => 'float',
             'length' => '2147483647',
             ));
        $this->hasColumn('emp_skill_sup_mid_marks', 'float', 2147483647, array(
             'type' => 'float',
             'length' => '2147483647',
             ));
        $this->hasColumn('emp_skill_sup_end_marks', 'float', 2147483647, array(
             'type' => 'float',
             'length' => '2147483647',
             ));
        $this->hasColumn('emp_skill_mod_end_marks', 'float', 2147483647, array(
             'type' => 'float',
             'length' => '2147483647',
             ));
        $this->hasColumn('emp_skill_mod_end_achive', 'float', 2147483647, array(
             'type' => 'float',
             'length' => '2147483647',
             ));
        $this->hasColumn('emp_skill_weight', 'float', 2147483647, array(
             'type' => 'float',
             'length' => '2147483647',
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

        $this->hasOne('EvaluationSkill', array(
             'local' => 'skill_id',
             'foreign' => 'skill_id'));

        $this->hasMany('EvaluationSkillEmployeeComments', array(
             'local' => 'emp_skill_id',
             'foreign' => 'emp_skill_id'));
    }
}