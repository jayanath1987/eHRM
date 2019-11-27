<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseReportDetails extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('hs_hr_rn_report');
        $this->hasColumn('rn_rpt_id', 'integer', 10, array(
             'type' => 'integer',
             'primary' => true,
             'length' => '10',
             ));
        $this->hasColumn('rn_rpt_name', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('rn_rpt_name_si', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('rn_rpt_name_ta', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('rn_rpt_path', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('mod_id', 'string', 36, array(
             'type' => 'string',
             'length' => '36',
             ));
    }

    public function setUp()
    {
        $this->hasOne('Module', array(
             'local' => 'mod_id',
             'foreign' => 'mod_id'));

        $this->hasMany('ReportCapability', array(
             'local' => 'rn_rpt_id',
             'foreign' => 'rn_rpt_id'));
    }
}