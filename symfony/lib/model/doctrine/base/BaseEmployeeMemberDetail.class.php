<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseEmployeeMemberDetail extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('hs_hr_emp_member_detail');
        $this->hasColumn('emp_number', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'length' => '4',
             ));
        $this->hasColumn('membship_code', 'string', 13, array(
             'type' => 'string',
             'primary' => true,
             'length' => '13',
             ));
        $this->hasColumn('membtype_code', 'string', 13, array(
             'type' => 'string',
             'primary' => true,
             'length' => '13',
             ));
        $this->hasColumn('ememb_subscript_amount as subscription', 'decimal', 15, array(
             'type' => 'decimal',
             'scale' => false,
             'length' => '15',
             ));
        $this->hasColumn('ememb_subscript_ownership as ownership', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));
        $this->hasColumn('ememb_commence_date as commence_date', 'timestamp', 25, array(
             'type' => 'timestamp',
             'length' => '25',
             ));
        $this->hasColumn('ememb_renewal_date as renewal_date', 'timestamp', 25, array(
             'type' => 'timestamp',
             'length' => '25',
             ));
    }

    public function setUp()
    {
        $this->hasOne('MembershipType', array(
             'local' => 'membtype_code',
             'foreign' => 'membtype_code'));

        $this->hasOne('Membership', array(
             'local' => 'membship_code',
             'foreign' => 'membship_code'));

        $this->hasOne('Employee', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasOne('EmployeeMaster', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));
    }
}