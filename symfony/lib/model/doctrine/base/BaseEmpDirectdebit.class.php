<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseEmpDirectdebit extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('hs_hr_emp_directdebit');
        $this->hasColumn('emp_number', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'length' => '4',
             ));
        $this->hasColumn('dd_seqno as seqno', 'decimal', 2, array(
             'type' => 'decimal',
             'primary' => true,
             'length' => '2',
             ));
        $this->hasColumn('dd_routing_num as routing_num', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => '4',
             ));
        $this->hasColumn('dd_account as account', 'string', 100, array(
             'type' => 'string',
             'default' => '',
             'notnull' => true,
             'length' => '100',
             ));
        $this->hasColumn('dd_amount as amount', 'decimal', 11, array(
             'type' => 'decimal',
             'notnull' => true,
             'scale' => false,
             'length' => '11',
             ));
        $this->hasColumn('dd_account_type as account_type', 'string', 20, array(
             'type' => 'string',
             'default' => '',
             'notnull' => true,
             'length' => '20',
             ));
        $this->hasColumn('dd_transaction_type as transaction_type', 'string', 20, array(
             'type' => 'string',
             'default' => '',
             'notnull' => true,
             'length' => '20',
             ));
    }

    public function setUp()
    {
        $this->hasOne('Employee', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));

        $this->hasOne('EmployeeMaster', array(
             'local' => 'emp_number',
             'foreign' => 'emp_number'));
    }
}