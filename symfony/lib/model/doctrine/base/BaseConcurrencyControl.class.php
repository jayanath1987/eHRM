<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseConcurrencyControl extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('hs_hr_concurrency_control');
        $this->hasColumn('con_table_name', 'string', 100, array(
             'type' => 'string',
             'primary' => true,
             'length' => '100',
             ));
        $this->hasColumn('con_table_key', 'string', 100, array(
             'type' => 'string',
             'primary' => true,
             'length' => '100',
             ));
        $this->hasColumn('con_activity_id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'length' => '4',
             ));
        $this->hasColumn('con_created_date', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('con_created_by', 'string', 36, array(
             'type' => 'string',
             'length' => '36',
             ));
    }

    public function setUp()
    {
        $this->hasOne('FormLockDetails', array(
             'local' => 'con_table_name',
             'foreign' => 'con_table_name'));
    }
}