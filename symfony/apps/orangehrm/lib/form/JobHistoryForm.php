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
require_once ROOT_PATH . '/lib/common/LocaleUtil.php';
/**
 * Form class for employee job history add
 */
class JobHistoryForm extends sfForm {

    const HISTORY_TYPE_JOBTITLE = "JOB";
    const HISTORY_TYPE_SUBDIVISION = "SUB";
    const HISTORY_TYPE_LOCATION = "LOC";

    public function configure() {

        $historyTypes = array(self::HISTORY_TYPE_JOBTITLE, self::HISTORY_TYPE_SUBDIVISION,
            self::HISTORY_TYPE_LOCATION);

        // Note: Widget names were kept from old non-symfony version
        $this->setWidgets(array(
            'EmpID' => new sfWidgetFormInputHidden(),

            // TODO: Use sfWidgetFormChoice() instead
            'cmbHistoryItemType' => new sfWidgetFormSelect(array('choices'=>array())),

            'cmbJobTitleHistory' => new sfWidgetFormSelect(array('choices'=>array())),
            'cmbLocationHistory' => new sfWidgetFormSelect(array('choices'=>array())),
            'cmbHistorySubDiv' => new sfWidgetFormSelect(array('choices'=>array())),
            'txtHistorySubDiv' => new sfWidgetFormInput(),

            'txtEmpHistoryItemFrom' => new sfWidgetFormInput(),
            'txtEmpHistoryItemTo' => new sfWidgetFormInput()
        ));

        $this->setValidators(array(
            'EmpID' => new sfValidatorString(array('required' => true)),
            'cmbHistoryItemType' => new sfValidatorChoice(array('required' => true,
                                                       'choices' => $historyTypes,
                                                       'multiple' => false)),
            'cmbJobTitleHistory' => new sfValidatorString(array('required' => false)),
            'cmbLocationHistory' => new sfValidatorString(array('required' => false)),
            'cmbHistorySubDiv' => new sfValidatorString(array('required' => false)),
			'txtHistorySubDiv' => new sfValidatorString(array('required' => false)),
            'txtEmpHistoryItemFrom' => new sfValidatorString(array('required' => false)),
            'txtEmpHistoryItemTo' => new sfValidatorString(array('required' => false))
        ));
    }

    /**
     * Save employee history item
     */
    public function save() {

        $historyItem = null;

        $type = $this->getValue('cmbHistoryItemType');

        switch ($type) {
            case self::HISTORY_TYPE_JOBTITLE:
                $historyItem = new EmpJobtitleHistory();
                $historyItem->code = $this->getValue('cmbJobTitleHistory');

                // find job title name
                $q = Doctrine_Query::create($conn)
                        ->select('j.jobtit_name')
                        ->from('JobTitle j')
                        ->where('j.id = ?', $historyItem->code);
                $result = $q->execute();

                if ($result->count() != 1) {
                    throw new PIMServiceException('jobtitle ' . $historyItem->code . ' not found');
                }

                $historyItem->name =  $result[0]->name;
                break;
            case self::HISTORY_TYPE_SUBDIVISION:
                $historyItem = new EmpSubdivisionHistory();
                $historyItem->code = $this->getValue('cmbHistorySubDiv');

                // find location name
                $q = Doctrine_Query::create($conn)
                        ->select('c.title')
                        ->from('CompanyStructure c')
                        ->where('c.id = ?', $historyItem->code);
                $result = $q->execute();

                if ($result->count() != 1) {
                    throw new PIMServiceException('company structure position ' . $historyItem->code . ' not found');
                }
               
                $historyItem->name = $result[0]->title;

                break;
            case self::HISTORY_TYPE_LOCATION:
                $historyItem = new EmpLocationHistory();
                $historyItem->code = $this->getValue('cmbLocationHistory');

                // find location name
                $q = Doctrine_Query::create($conn)
                        ->select('l.loc_name')
                        ->from('Location l')
                        ->where('l.loc_code = ?', $historyItem->code);
                $result = $q->execute();

                if ($result->count() != 1) {
                    throw new PIMServiceException('company structure position ' . $historyItem->code . ' not found');
                }
                $historyItem->name = $result[0]->loc_name;

                break;
            default:
                // This will not happen because validation will fail
                //TODO: Change exception
                throw new PIMServiceException();
        }

        $historyItem->emp_number = $this->getValue('EmpID');
        if($this->getValue('txtEmpHistoryItemFrom')!= null){
        $historyItem->start_date = LocaleUtil::getInstance()->convertToStandardDateFormat($this->getValue('txtEmpHistoryItemFrom'));
        }else{
          $historyItem->start_date =null;
        }
        if($this->getValue('txtEmpHistoryItemTo')!= null){
        $historyItem->end_date = LocaleUtil::getInstance()->convertToStandardDateFormat($this->getValue('txtEmpHistoryItemTo'));
        }else{
            $historyItem->end_date =null;
        }
        $historyItem->save();
    }

}

