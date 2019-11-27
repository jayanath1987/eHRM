<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseEmpRoleGroup extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('hs_hr_emp_role_group');
        $this->hasColumn('role_group_id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'length' => '4',
             ));
        $this->hasColumn('role_group_name', 'string', 200, array(
             'type' => 'string',
             'length' => '200',
             ));
        $this->hasColumn('role_group_name_si', 'string', 200, array(
             'type' => 'string',
             'length' => '200',
             ));
        $this->hasColumn('role_group_name_ta', 'string', 200, array(
             'type' => 'string',
             'length' => '200',
             ));
    }

    public function setUp()
    {
        $this->hasMany('CompanyStructureDetails', array(
             'local' => 'role_group_id',
             'foreign' => 'role_group_id'));
    }
}