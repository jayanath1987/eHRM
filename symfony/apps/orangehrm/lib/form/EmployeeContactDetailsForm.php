<?php
/*
// OrangeHRM is a comprehensive Human Resource Management (HRM) System that captures
// all the essential functionalities required for any enterprise.
// Copyright (C) 2006 OrangeHRM Inc., http://www.orangehrm.com

// OrangeHRM is free software; you can redistribute it and/or modify it under the terms of
// the GNU General Public License as published by the Free Software Foundation; either
// version 2 of the License, or (at your option) any later version.

// OrangeHRM is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
// without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
// See the GNU General Public License for more details.

// You should have received a copy of the GNU General Public License along with this program;
// if not, write to the Free Software Foundation, Inc., 51 Franklin Street, Fifth Floor,
// Boston, MA  02110-1301, USA
*/

/**
 * Form class for employee contact detail
 */
class EmployeeContactDetailsForm extends sfForm {

    public function configure() {

        $this->setWidgets(array(
            'txtEmpID' => new sfWidgetFormInputHidden(),
            'txtOffAddline1' => new sfWidgetFormInput(),
            'txtOffAddline1SI' => new sfWidgetFormInput(),
            'txtOffAddline1TA' => new sfWidgetFormInput(),
            'txtOffAddline2' => new sfWidgetFormInput(),
            'txtOffAddline2SI' => new sfWidgetFormInput(),
            'txtOffAddline2TA' => new sfWidgetFormInput(),
            'txtOffPostOffice' => new sfWidgetFormInput(),
            'txtOffPostOfficeSI' => new sfWidgetFormInput(),
            'txtOffPostOfficeTA' => new sfWidgetFormInput(),
            'txtOffPostalCode' => new sfWidgetFormInput(),
            'cmbCountry'=>new sfWidgetFormInput(),
            'txtOffIntercom' => new sfWidgetFormInput(),
            'txtOffVIP' => new sfWidgetFormInput(),
            'txtOffDirect' => new sfWidgetFormInput(),
            'txtOffExt' => new sfWidgetFormInput(),
            'txtOffFax' => new sfWidgetFormInput(),
            'txtOffEmail' => new sfWidgetFormInput(),
            'txtOffURL' => new sfWidgetFormInput(),
            
            'txtresAddline1' => new sfWidgetFormInput(),
            'txtresAddline1SI' => new sfWidgetFormInput(),
            'txtresAddline1TA' => new sfWidgetFormInput(),
            'txtresAddline2' => new sfWidgetFormInput(),
            'txtresAddline2SI' => new sfWidgetFormInput(),
            'txtresAddline2TA' => new sfWidgetFormInput(),
            'txtresPostOffice' => new sfWidgetFormInput(),
            'txtresPostOfficeSI' => new sfWidgetFormInput(),
            'txtresPostOfficeTA' => new sfWidgetFormInput(),
            'txtresPostalCode' => new sfWidgetFormInput(),
            'txtresDivisiSec' => new sfWidgetFormInput(),
            'txtresDivisiSecSI' => new sfWidgetFormInput(),
            'txtresDivisiSecTA' => new sfWidgetFormInput(),
            'txtresPoliceStaion' => new sfWidgetFormInput(),
            'txtresPoliceStaionSI' => new sfWidgetFormInput(),
            'txtresPoliceStaionTA' => new sfWidgetFormInput(),
            'txtresDistric' => new sfWidgetFormInput(),
            'txtresDistricSI' => new sfWidgetFormInput(),
            'txtresDistricTA' => new sfWidgetFormInput(),
            'txtresPhone' => new sfWidgetFormInput(),
            'txtresFax' => new sfWidgetFormInput(),
            'txtresMobile' => new sfWidgetFormInput(),
            'txtresEmail' => new sfWidgetFormInput(),
            
            'txtperAddline1' => new sfWidgetFormInput(),
            'txtperAddline1SI' => new sfWidgetFormInput(),
            'txtperAddline1TA' => new sfWidgetFormInput(),
            'txtperAddline2' => new sfWidgetFormInput(),
            'txtperAddline2SI' => new sfWidgetFormInput(),
            'txtperAddline2TA' => new sfWidgetFormInput(),
            'txtperPostOffice' => new sfWidgetFormInput(),
            'txtperPostOfficeSI' => new sfWidgetFormInput(),
            'txtperPostOfficeTA' => new sfWidgetFormInput(),
            'txtperPostalCode' => new sfWidgetFormInput(),
            'txtperDivisiSec' => new sfWidgetFormInput(),
            'txtperDivisiSecSI' => new sfWidgetFormInput(),
            'txtperDivisiSecTA' => new sfWidgetFormInput(),
            'txtperPoliceStaion' => new sfWidgetFormInput(),
            'txtperPoliceStaionSI' => new sfWidgetFormInput(),
            'txtperPoliceStaionTA' => new sfWidgetFormInput(),
            'txtperDistric' => new sfWidgetFormInput(),
            'txtperDistricSI' => new sfWidgetFormInput(),
            'txtperDistricTA' => new sfWidgetFormInput(),
            'txtperPhone' => new sfWidgetFormInput(),
            'txtperFax' => new sfWidgetFormInput(),
            'txtperMobile' => new sfWidgetFormInput(),
            'txtperEmail' => new sfWidgetFormInput(),
            
            'txtothAddline1' => new sfWidgetFormInput(),
            'txtothAddline1SI' => new sfWidgetFormInput(),
            'txtothAddline1TA' => new sfWidgetFormInput(),
            'txtothAddline2' => new sfWidgetFormInput(),
            'txtothAddline2SI' => new sfWidgetFormInput(),
            'txtothAddline2TA' => new sfWidgetFormInput(),
            'txtothPostOffice' => new sfWidgetFormInput(),
            'txtothPostOfficeSI' => new sfWidgetFormInput(),
            'txtothPostOfficeTA' => new sfWidgetFormInput(),
            'txtothPostalCode' => new sfWidgetFormInput(),
            'txtothDivisiSec' => new sfWidgetFormInput(),
            'txtothDivisiSecSI' => new sfWidgetFormInput(),
            'txtothDivisiSecTA' => new sfWidgetFormInput(),
            'txtothPoliceStaion' => new sfWidgetFormInput(),
            'txtothPoliceStaionSI' => new sfWidgetFormInput(),
            'txtothPoliceStaionTA' => new sfWidgetFormInput(),
            'txtothDistric' => new sfWidgetFormInput(),
            'txtothDistricSI' => new sfWidgetFormInput(),
            'txtothDistricTA' => new sfWidgetFormInput(),
            'txtothPhone' => new sfWidgetFormInput(),
            'txtothFax' => new sfWidgetFormInput(),
            'txtothMobile' => new sfWidgetFormInput(),
            'txtothEmail' => new sfWidgetFormInput(),
            'txtothEmail' => new sfWidgetFormInput(),
        ));

        $this->setValidators(array(
            'txtEmpID' => new sfValidatorString(array('required' => true)),
            'txtOffAddline1' => new sfValidatorString(array('required' => false)),
            'txtOffAddline1SI' => new sfValidatorString(array('required' => false)),
            'txtOffAddline1TA' => new sfValidatorString(array('required' => false)),
            'txtOffAddline2' => new sfValidatorString(array('required' => false)),
            'txtOffAddline2SI' => new sfValidatorString(array('required' => false)),
            'txtOffAddline2TA' => new sfValidatorString(array('required' => false)),
            'txtOffPostOffice' => new sfValidatorString(array('required' => false)),
            'txtOffPostOfficeSI' => new sfValidatorString(array('required' => false)),
            'txtOffPostOfficeTA' => new sfValidatorString(array('required' => false)),
            'txtOffPostalCode' => new sfValidatorString(array('required' => false)),
            'cmbCountry'=> new sfValidatorString(array('required' => false)),
            'txtOffIntercom' => new sfValidatorString(array('required' => false)),
            'txtOffVIP' => new sfValidatorString(array('required' => false)),
            'txtOffDirect' => new sfValidatorString(array('required' => false)),
            'txtOffExt' => new sfValidatorString(array('required' => false)),
            'txtOffFax' => new sfValidatorString(array('required' => false)),
            'txtOffEmail' => new sfValidatorString(array('required' => false)),
            'txtOffURL' => new sfValidatorString(array('required' => false)),

            'txtresAddline1' => new sfValidatorString(array('required' => false)),
            'txtresAddline1SI' => new sfValidatorString(array('required' => false)),
            'txtresAddline1TA' => new sfValidatorString(array('required' => false)),
            'txtresAddline2' => new sfValidatorString(array('required' => false)),
            'txtresAddline2SI' => new sfValidatorString(array('required' => false)),
            'txtresAddline2TA' => new sfValidatorString(array('required' => false)),
            'txtresPostOffice' => new sfValidatorString(array('required' => false)),
            'txtresPostOfficeSI' => new sfValidatorString(array('required' => false)),
            'txtresPostOfficeTA' => new sfValidatorString(array('required' => false)),
            'txtresPostalCode' => new sfValidatorString(array('required' => false)),
            'txtresDivisiSec' => new sfValidatorString(array('required' => false)),
            'txtresDivisiSecSI' => new sfValidatorString(array('required' => false)),
            'txtresDivisiSecTA' => new sfValidatorString(array('required' => false)),
            'txtresPoliceStaion' => new sfValidatorString(array('required' => false)),
            'txtresPoliceStaionSI' => new sfValidatorString(array('required' => false)),
            'txtresPoliceStaionTA' => new sfValidatorString(array('required' => false)),
            'txtresDistric' => new sfValidatorString(array('required' => false)),
            'txtresDistricSI' => new sfValidatorString(array('required' => false)),
            'txtresDistricTA' => new sfValidatorString(array('required' => false)),
            'txtresPhone' => new sfValidatorString(array('required' => false)),
            'txtresFax' => new sfValidatorString(array('required' => false)),
            'txtresMobile' =>new sfValidatorString(array('required' => false)),
            'txtresEmail' => new sfValidatorString(array('required' => false)),

            'txtperAddline1' => new sfValidatorString(array('required' => false)),
            'txtperAddline1SI' => new sfValidatorString(array('required' => false)),
            'txtperAddline1TA' => new sfValidatorString(array('required' => false)),
            'txtperAddline2' => new sfValidatorString(array('required' => false)),
            'txtperAddline2SI' => new sfValidatorString(array('required' => false)),
            'txtperAddline2TA' => new sfValidatorString(array('required' => false)),
            'txtperPostOffice' => new sfValidatorString(array('required' => false)),
            'txtperPostOfficeSI' => new sfValidatorString(array('required' => false)),
            'txtperPostOfficeTA' => new sfValidatorString(array('required' => false)),
            'txtperPostalCode' => new sfValidatorString(array('required' => false)),
            'txtperDivisiSec' => new sfValidatorString(array('required' => false)),
            'txtperDivisiSecSI' => new sfValidatorString(array('required' => false)),
            'txtperDivisiSecTA' => new sfValidatorString(array('required' => false)),
            'txtperPoliceStaion' => new sfValidatorString(array('required' => false)),
            'txtperPoliceStaionSI' => new sfValidatorString(array('required' => false)),
            'txtperPoliceStaionTA' => new sfValidatorString(array('required' => false)),
            'txtperDistric' => new sfValidatorString(array('required' => false)),
            'txtperDistricSI' => new sfValidatorString(array('required' => false)),
            'txtperDistricTA' => new sfValidatorString(array('required' => false)),
            'txtperPhone' => new sfValidatorString(array('required' => false)),
            'txtperFax' => new sfValidatorString(array('required' => false)),
            'txtperMobile' => new sfValidatorString(array('required' => false)),
            'txtperEmail' => new sfValidatorString(array('required' => false)),

            'txtothAddline1' => new sfValidatorString(array('required' => false)),
            'txtothAddline1SI' => new sfValidatorString(array('required' => false)),
            'txtothAddline1TA' => new sfValidatorString(array('required' => false)),
            'txtothAddline2' => new sfValidatorString(array('required' => false)),
            'txtothAddline2SI' => new sfValidatorString(array('required' => false)),
            'txtothAddline2TA' => new sfValidatorString(array('required' => false)),
            'txtothPostOffice' => new sfValidatorString(array('required' => false)),
            'txtothPostOfficeSI' => new sfValidatorString(array('required' => false)),
            'txtothPostOfficeTA' => new sfValidatorString(array('required' => false)),
            'txtothPostalCode' =>new sfValidatorString(array('required' => false)),
            'txtothDivisiSec' => new sfValidatorString(array('required' => false)),
            'txtothDivisiSecSI' => new sfValidatorString(array('required' => false)),
            'txtothDivisiSecTA' => new sfValidatorString(array('required' => false)),
            'txtothPoliceStaion' => new sfValidatorString(array('required' => false)),
            'txtothPoliceStaionSI' => new sfValidatorString(array('required' => false)),
            'txtothPoliceStaionTA' => new sfValidatorString(array('required' => false)),
            'txtothDistric' => new sfValidatorString(array('required' => false)),
            'txtothDistricSI' => new sfValidatorString(array('required' => false)),
            'txtothDistricTA' =>new sfValidatorString(array('required' => false)),
            'txtothPhone' => new sfValidatorString(array('required' => false)),
            'txtothFax' =>new sfValidatorString(array('required' => false)),
            'txtothMobile' => new sfValidatorString(array('required' => false)),
            'txtothEmail' => new sfValidatorString(array('required' => false)),
            
        ));
    }

    
            
    /**
     * Get Employee contact object with values filled using form values
     */
    public function getEmployeeContact() {

        $service = new EmployeeService();
        $empContact = $service->getEmployeeContact($this->getValue("txtEmpID"));

        if (is_object($empContact)==false) {
            $empContact = new EmpContact();
            $empContact->emp_number=$this->getValue("txtEmpID");
        }
        
        $empContact->con_off_addLine1=$this->getValue('txtOffAddline1');
        $empContact->con_off_addLine1_si=$this->getValue('txtOffAddline1SI');
        $empContact->con_off_addLine1_ta=$this->getValue('txtOffAddline1TA');
        $empContact->con_off_addLine2=$this->getValue('txtOffAddline2');
        $empContact->con_off_addLine2_si=$this->getValue('txtOffAddline2SI');
        $empContact->con_off_addLine2_ta=$this->getValue('txtOffAddline2TA');
        $empContact->con_off_del_postoffice=$this->getValue('txtOffPostOffice');
        $empContact->con_off_del_postoffice_si=$this->getValue('txtOffPostOfficeSI');
        $empContact->con_off_del_postoffice_ta=$this->getValue('txtOffPostOfficeTA');
        $empContact->con_off_postal_code=$this->getValue('txtOffPostalCode');
        $empContact->con_off_country=$this->getValue('cmbCountry');
//        $empContact->con_off_country_si=$this->getValue('txtOffCity');
//        $empContact->con_off_country_ta=$this->getValue('txtOffCitySI');
        $empContact->con_off_intercom=$this->getValue('txtOffIntercom');
        $empContact->con_off_vip=$this->getValue('txtOffVIP');
        $empContact->con_off_direct=$this->getValue('txtOffDirect');
        $empContact->con_off_ext=$this->getValue('txtOffExt');
        $empContact->con_off_fax=$this->getValue('txtOffFax');
        $empContact->con_off_email=$this->getValue('txtOffEmail');
        $empContact->con_off_url=$this->getValue('txtOffURL');
        
        $empContact->con_res_addLine1=$this->getValue('txtresAddline1');
        $empContact->con_res_addLine1_si=$this->getValue('txtresAddline1SI');
        $empContact->con_res_addLine1_ta=$this->getValue('txtresAddline1TA');
        $empContact->con_res_addLine2=$this->getValue('txtresAddline2');
        $empContact->con_res_addLine2_si=$this->getValue('txtresAddline2SI');
        $empContact->con_res_addLine2_ta=$this->getValue('txtresAddline2TA');
        $empContact->con_res_del_postoffice=$this->getValue('txtresPostOffice');
        $empContact->con_res_del_postoffice_si=$this->getValue('txtresPostOfficeSI');
        $empContact->con_res_del_postoffice_ta=$this->getValue('txtresPostOfficeTA');
        $empContact->con_res_postal_code=$this->getValue('txtresPostalCode');
        $empContact->con_res_div_sectretariat=$this->getValue('txtresDivisiSec');
        $empContact->con_res_div_sectretariat_si=$this->getValue('txtresDivisiSecSI');
        $empContact->con_res_div_sectretariat_ta=$this->getValue('txtresDivisiSecTA');
        $empContact->con_res_policesation=$this->getValue('txtresPoliceStaion');
        $empContact->con_res_policesation_si=$this->getValue('txtresPoliceStaionSI');
        $empContact->con_res_policesation_ta=$this->getValue('txtresPoliceStaionTA');
        $empContact->con_res_district=$this->getValue('txtresDistric');
        $empContact->con_res_district_si=$this->getValue('txtresDistricSI');
        $empContact->con_res_district_ta=$this->getValue('txtresDistricTA');
        $empContact->con_res_phone=$this->getValue('txtresPhone');
        $empContact->con_res_fax=$this->getValue('txtresFax');
        $empContact->con_res_mobile=$this->getValue('txtresMobile');
        $empContact->con_res_email=$this->getValue('txtresEmail');
        
        $empContact->con_per_addLine1=$this->getValue('txtperAddline1');
        $empContact->con_per_addLine1_si=$this->getValue('txtperAddline1SI');
        $empContact->con_per_addLine1_ta=$this->getValue('txtperAddline1TA');
        $empContact->con_per_addLine2=$this->getValue('txtperAddline2');
        $empContact->con_per_addLine2_si=$this->getValue('txtperAddline2SI');
        $empContact->con_per_addLine2_ta=$this->getValue('txtperAddline2TA');
        $empContact->con_per_del_postoffice=$this->getValue('txtperPostOffice');
        $empContact->con_per_del_postoffice_si=$this->getValue('txtperPostOfficeSI');
        $empContact->con_per_del_postoffice_ta=$this->getValue('txtperPostOfficeTA');
        $empContact->con_per_postal_code=$this->getValue('txtperPostalCode');
        $empContact->con_per_div_sectretariat=$this->getValue('txtperDivisiSec');
        $empContact->con_per_div_sectretariat_si=$this->getValue('txtperDivisiSecSI');
        $empContact->con_per_div_sectretariat_ta=$this->getValue('txtperDivisiSecTA');
        $empContact->con_per_policesation=$this->getValue('txtperPoliceStaion');
        $empContact->con_per_policesation_si=$this->getValue('txtperPoliceStaionSI');
        $empContact->con_per_policesation_ta=$this->getValue('txtperPoliceStaionTA');
        $empContact->con_per_district=$this->getValue('txtperDistric');
        $empContact->con_per_district_si=$this->getValue('txtperDistricSI');
        $empContact->con_per_district_ta=$this->getValue('txtperDistricTA');
        $empContact->con_per_phone=$this->getValue('txtperPhone');
        $empContact->con_per_fax=$this->getValue('txtperFax');
        $empContact->con_per_mobile=$this->getValue('txtperMobile');
        $empContact->con_per_email=$this->getValue('txtperEmail');

       $empContact->con_oth_addLine1=$this->getValue('txtothAddline1');
        $empContact->con_oth_addLine1_si=$this->getValue('txtothAddline1SI');
        $empContact->con_oth_addLine1_ta=$this->getValue('txtothAddline1TA');
        $empContact->con_oth_addLine2=$this->getValue('txtothAddline2');
        $empContact->con_oth_addLine2_si=$this->getValue('txtothAddline2SI');
        $empContact->con_oth_addLine2_ta=$this->getValue('txtothAddline2TA');
        $empContact->con_oth_del_postoffice=$this->getValue('txtothPostOffice');
        $empContact->con_oth_del_postoffice_si=$this->getValue('txtothPostOfficeSI');
        $empContact->con_oth_del_postoffice_ta=$this->getValue('txtothPostOfficeTA');
        $empContact->con_oth_postal_code=$this->getValue('txtothPostalCode');
        $empContact->con_oth_div_sectretariat=$this->getValue('txtothDivisiSec');
        $empContact->con_oth_div_sectretariat_si=$this->getValue('txtothDivisiSecSI');
        $empContact->con_oth_div_sectretariat_ta=$this->getValue('txtothDivisiSecTA');
        $empContact->con_oth_policesation=$this->getValue('txtothPoliceStaion');
        $empContact->con_oth_policesation_si=$this->getValue('txtothPoliceStaionSI');
        $empContact->con_oth_policesation_ta=$this->getValue('txtothPoliceStaionTA');
        $empContact->con_oth_district=$this->getValue('txtothDistric');
        $empContact->con_oth_district_si=$this->getValue('txtothDistricSI');
        $empContact->con_oth_district_ta=$this->getValue('txtothDistricTA');
        $empContact->con_oth_phone=$this->getValue('txtothPhone');
        $empContact->con_oth_fax=$this->getValue('txtothFax');
        $empContact->con_oth_mobile=$this->getValue('txtothMobile');
        $empContact->con_oth_email=$this->getValue('txtothEmail');
        
        return $empContact;
    }

}

