<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseNotificationEmployee extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('hs_hr_notification_employee');
        $this->hasColumn('not_id', 'integer', 11, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => '11',
             ));
        $this->hasColumn('mod_id', 'string', 36, array(
             'type' => 'string',
             'length' => '36',
             ));
        $this->hasColumn('not_message', 'string', 500, array(
             'type' => 'string',
             'length' => '500',
             ));
        $this->hasColumn('emp_number', 'integer', 7, array(
             'type' => 'integer',
             'length' => '7',
             ));
        $this->hasColumn('status', 'string', 1, array(
             'type' => 'string',
             'length' => '1',
             ));
        $this->hasColumn('from', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('to', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('create_date', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('create_emp_number', 'integer', 7, array(
             'type' => 'integer',
             'length' => '7',
             ));
    }

    public function setUp()
    {
        $this->hasOne('Employee', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasOne('Employee as EmployeeCreate', array(
             'local' => 'create_emp_number',
             'foreign' => 'emp_number'));
    }
}