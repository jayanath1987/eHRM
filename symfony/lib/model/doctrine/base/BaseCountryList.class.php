<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseCountryList extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('hs_hr_country');
        $this->hasColumn('cou_code', 'string', 2, array(
             'type' => 'string',
             'fixed' => 1,
             'primary' => true,
             'length' => '2',
             ));
        $this->hasColumn('name', 'string', 80, array(
             'type' => 'string',
             'default' => '',
             'notnull' => true,
             'length' => '80',
             ));
        $this->hasColumn('cou_name', 'string', 80, array(
             'type' => 'string',
             'default' => '',
             'notnull' => true,
             'length' => '80',
             ));
        $this->hasColumn('cou_name_si', 'string', 80, array(
             'type' => 'string',
             'default' => '',
             'length' => '80',
             ));
        $this->hasColumn('cou_name_ta', 'string', 80, array(
             'type' => 'string',
             'default' => '',
             'length' => '80',
             ));
        $this->hasColumn('iso3', 'string', 3, array(
             'type' => 'string',
             'fixed' => 1,
             'length' => '3',
             ));
        $this->hasColumn('numcode', 'integer', 2, array(
             'type' => 'integer',
             'length' => '2',
             ));
    }

}