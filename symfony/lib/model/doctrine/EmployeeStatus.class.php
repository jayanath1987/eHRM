<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class EmployeeStatus extends BaseEmployeeStatus
{
    const EMPLOYMENT_STATUS_ID_TERMINATED = "EST000";
    
    public function __toString() {
        return $this->name;
    }  
}