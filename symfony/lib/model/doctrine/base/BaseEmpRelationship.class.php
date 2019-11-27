<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseEmpRelationship extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('hs_hr_relationship');
        $this->hasColumn('rel_code', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'length' => '4',
             ));
        $this->hasColumn('rel_name', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
             ));
        $this->hasColumn('rel_name_si', 'string', 50, array(
             'type' => 'string',
             'default' => '',
             'length' => '50',
             ));
        $this->hasColumn('rel_name_ta', 'string', 50, array(
             'type' => 'string',
             'default' => '',
             'length' => '50',
             ));
    }

    public function setUp()
    {
        $this->hasMany('EmpDependent', array(
             'local' => 'rel_code',
             'foreign' => 'rel_code'));
    }
}