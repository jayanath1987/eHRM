<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseOfficeOutDetails extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('hs_hr_leave_office_out_detail');
        $this->hasColumn('oo_id', 'integer', 11, array(
             'type' => 'integer',
             'primary' => true,
             'length' => '11',
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

        $this->hasOne('OfficeOut', array(
             'local' => 'oo_id',
             'foreign' => 'oo_id'));
    }
}