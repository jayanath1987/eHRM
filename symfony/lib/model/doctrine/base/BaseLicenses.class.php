<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseLicenses extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('hs_hr_licenses');
        $this->hasColumn('licenses_code', 'string', 13, array(
             'type' => 'string',
             'primary' => true,
             'length' => '13',
             ));
        $this->hasColumn('licenses_desc', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
             ));
    }

    public function setUp()
    {
        $this->hasMany('EmployeeLicense', array(
             'local' => 'licenses_code',
             'foreign' => 'licenses_code'));
    }
}