<?php
/**
*-------------------------------------------------------------------------------------------------------
 *  Author     - Roshan wijesena
 *  On (Date)  - 27 July 2011
 *  Comments   - Admin Module Attachtype Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
*/

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class LdapConnect {

    private $ldap_host;
    private $ldap_port;
    private $ldap_username;
    private $ldap_password;    
    private $basedn;    
    private $ldap_objectClass;
    private $ldap_conn;

    public function __construct() {

        $conf = new sysConf();
        $this->ldap_host = $conf->ldap_host;
        $this->ldap_port = $conf->ldap_port;
        $this->ldap_username = $conf->ldap_username;
        $this->ldap_password = $conf->ldap_password;
        $this->basedn = $conf->ldap_basedn;
        $this->ldap_objectClass = $conf->ldap_objectClass;
        $this->rootDn=$conf->rootDn;
    }

    public function ldap_connect() {

        $ds = ldap_connect($this->ldap_host, $this->ldap_port);

        if (!$ds) {
            //connection faild
            throw new CommonException("", 100);
        }
        ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
        if (ldap_bind($ds, $this->ldap_username, $this->ldap_password)) {

        } else {
            //auth fail.
            throw new CommonException("", 101);
        }
        $this->ldap_conn = $ds;
    }

    public function ldap_addEntry($cn, $employeeID) {

        $dn = "cn=" . $cn . "," . $this->basedn;

        $ldaprecord['objectclass'] = $this->ldap_objectClass;
        //$ldaprecord['objectclass'] = "AnyObjectClassName";

        $ldaprecord['cn'] = $cn;
        $ldaprecord['sn'] = $cn;
        $ldaprecord['EmployeeID'] = $employeeID;

        $r = ldap_add($this->ldap_conn, $dn, $ldaprecord);

        if (!$r) {
            throw new CommonException("", 102);
        } else {
            return true;
        }
    }

    public function ladp_readEntry($cn) {

        $dn = $this->rootDn;
        $filter = "(EmployeeID=$cn)";
        $justthese = array("DepartmentCode", "DesignationCode", "DistrictCode", "DivisionCode", "Email", "sn", "FirstName", "FirstNameSI", "FirstNameTA", "LastName", "LastNameSI", "LastNameTA", "EmployeeActiveFlag", "cn", "EmployeeID", "WasamCode", "ZoneCode");

        $sr = ldap_search($this->ldap_conn, $dn, $filter, $justthese);

        $entry = ldap_get_entries($this->ldap_conn, $sr);
      //die(print_r($entry));
        return $entry;
    }

    public function ldap_updateEntry($cn, $toUpdate, $newCn) {

        $dn = "cn=" . $cn . "," . $this->basedn;
        

        ldap_connect();


        foreach ($toUpdate as $key => $value) {
            

            $exploedValue = explode("|", $value);
            $ldaprecord['objectclass'] = $this->ldap_objectClass;

            $ldaprecord[$exploedValue[1]] = $exploedValue[0];
        }

        
        $r = ldap_modify($this->ldap_conn, $dn, $ldaprecord);


        if($newCn!=""){
       
       
        $newrdn="cn=".$newCn;
        
      

        $dnnew = $this->basedn;

        $r = ldap_rename($this->ldap_conn, $dn, $newrdn, $dnnew, true);
                 
        }
 
        if (!$r) {
            throw new CommonException("", 103);
        } else {

            echo "Successfully Updated";
        }
    }

}

?>
