<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseEmployeeLeaveEntitlement extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('hs_hr_employee_leave_quota');
        $this->hasColumn('leave_type_id', 'string', 13, array(
             'type' => 'string',
             'primary' => true,
             'length' => '13',
             ));
        $this->hasColumn('employee_id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'length' => '4',
             ));
        $this->hasColumn('leave_period_id', 'integer', 7, array(
             'type' => 'integer',
             'primary' => true,
             'length' => '7',
             ));
        $this->hasColumn('no_of_days_allotted', 'decimal', 6, array(
             'type' => 'decimal',
             'scale' => false,
             'length' => '6',
             ));
        $this->hasColumn('leave_taken', 'decimal', 6, array(
             'type' => 'decimal',
             'default' => '0.00',
             'scale' => false,
             'length' => '6',
             ));
        $this->hasColumn('leave_brought_forward', 'decimal', 6, array(
             'type' => 'decimal',
             'default' => '0.00',
             'scale' => false,
             'length' => '6',
             ));
        $this->hasColumn('leave_carried_forward', 'decimal', 6, array(
             'type' => 'decimal',
             'default' => '0.00',
             'scale' => false,
             'length' => '6',
             ));
    }

    public function setUp()
    {
        $this->hasOne('LeaveType', array(
             'local' => 'leave_type_id',
             'foreign' => 'leaveTypeId'));

        $this->hasOne('Employee', array(
             'local' => 'employee_id',
             'foreign' => 'empNumber'));

        $this->hasOne('LeavePeriod', array(
             'local' => 'leave_period_id',
             'foreign' => 'leavePeriodId'));
    }
}