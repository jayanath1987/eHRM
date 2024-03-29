<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseLeaveAttachment extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('hs_hr_leave_attachment');
        $this->hasColumn('leave_attach_id', 'integer', 20, array(
             'type' => 'integer',
             'primary' => true,
             'length' => '20',
             ));
        $this->hasColumn('leave_app_id', 'integer', 20, array(
             'type' => 'integer',
             'primary' => true,
             'length' => '20',
             ));
        $this->hasColumn('leave_attach_filename', 'string', 200, array(
             'type' => 'string',
             'length' => '200',
             ));
        $this->hasColumn('leave_attach_size', 'integer', 11, array(
             'type' => 'integer',
             'length' => '11',
             ));
        $this->hasColumn('leave_attach_attachment', 'blob', 2147483647, array(
             'type' => 'blob',
             'length' => '2147483647',
             ));
        $this->hasColumn('leave_attach_type', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
    }

    public function setUp()
    {
        $this->hasOne('Promotion', array(
             'local' => 'leave_app_id',
             'foreign' => 'leave_app_id'));
    }
}