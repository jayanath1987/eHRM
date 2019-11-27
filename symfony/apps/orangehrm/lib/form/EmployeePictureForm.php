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
 * Form class for employee picture
 */
class EmployeePictureForm extends sfForm {

    public function configure() {

        // Note: Widget names were kept from old non-symfony version
        $this->setWidgets(array(
            'EmpID' => new sfWidgetFormInputHidden(),
            'MAX_FILE_SIZE' => new sfWidgetFormInputHidden(),
            'photofile' => new sfWidgetFormInputFile(),
        ));

         $message = sfContext::getInstance()->getI18N()->__('Invalid File type. Jpeg/gif/png/pjpeg only');
         $maxSizemessage=sfContext::getInstance()->getI18N()->__('Photograph size should be less than to 1 MB');

        $this->setValidators(array(
            'EmpID' => new sfValidatorNumber(array('required' => true, 'min' => 0)),
            'MAX_FILE_SIZE' => new sfValidatorNumber(array('required' => true)),
            'photofile' => new sfValidatorFile(array('required' => false)),
        ));
    }

    /**
     * Save employee contract
     */
    public function save() {

        $empNumber = $this->getValue('EmpID');

        $empPicture = false;

        $q = Doctrine_Query::create()
                        ->select('p.emp_number')
                        ->from('EmpPicture p')
                        ->where('p.emp_number = ?', $empNumber);
        $result = $q->execute();

        if ($result->count() == 1) {
            $empPicture = $result[0];
        } else {
            $empPicture = new EmpPicture();
            $empPicture->emp_number = $empNumber;
        }

        $file = $this->getValue('photofile');

        $tempName = $file->getTempName();

        $empPicture->picture = file_get_contents($tempName);
        
        $empPicture->filename = $file->getOriginalName();
        $empPicture->file_type = $file->getType();
        $empPicture->size = $file->getSize();




        $empPicture->save();
    }

}

