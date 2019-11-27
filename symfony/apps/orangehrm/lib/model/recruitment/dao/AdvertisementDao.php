<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Givantha Kalansuriya
 *  On (Date) - 17 June 2011
 *  Comments  - Recruitment Module Advertisement Data Access CRUD operation
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class AdvertisementDao extends BaseDao {

    /**
     *
     * Executes getAdvertisementList function
     * 
     * @return Advertisement list 
     */
    public function getAdvertisementList() {
        $q = Doctrine_Query::create()
                ->select('a.*')
                ->from('Advertisement a');
        return $q->execute();
    }

    /**
     *
     * Executes saveAdvertisement function
     * 
     * @param Advertisement $advertisement
     * @return Advertisement 
     */
    public function saveAdvertisement(Advertisement $advertisement, $request) {


        if (strlen($request->getParameter('cmbVacanyTitle'))) {
            $advertisement->setRec_req_id(trim($request->getParameter('cmbVacanyTitle')));
        } else {
            $advertisement->setRec_req_id(null);
        }
        if (strlen($request->getParameter('txtDescription'))) {
            $advertisement->setRec_adv_desc(trim($request->getParameter('txtDescription')));
        } else {
            $advertisement->setRec_adv_desc(null);
        }
        if (strlen($request->getParameter('txtDescriptionSi'))) {
            $advertisement->setRec_adv_desc_si(trim($request->getParameter('txtDescriptionSi')));
        } else {
            $advertisement->setRec_adv_desc_si(null);
        }
        if (strlen($request->getParameter('txtDescriptionTa'))) {
            $advertisement->setRec_adv_desc_ta(trim($request->getParameter('txtDescriptionTa')));
        } else {
            $advertisement->setRec_adv_desc_ta(null);
        }
        if (strlen($request->getParameter('txtOpeningDate'))) {
            $advertisement->setRec_adv_opening_date(trim($request->getParameter('txtOpeningDate')));
        } else {
            $advertisement->setRec_adv_opening_date(null);
        }
        if (strlen($request->getParameter('txtClosingDate'))) {
            $advertisement->setRec_adv_closing_date(trim($request->getParameter('txtClosingDate')));
        } else {
            $advertisement->setRec_adv_closing_date(null);
        }


        $advertisement->save();
        return $advertisement;
    }

    /**
     *
     * Executes getAdvertisementById function
     * 
     * @param type $id
     * @return $advertisement 
     */
    public function getAdvertisementById($id) {
        $advertisement = Doctrine::getTable('Advertisement')->find($id);
        return $advertisement;
    }

    /**
     *
     * Executes getVacancyTitleList function
     * 
     * @return VacancyRequisition 
     */
    public function getVacancyTitleList() {
        $q = Doctrine_Query::create()
                ->select('v.rec_req_id,v.rec_req_vacancy_title,v.rec_req_vacancy_title_si,v.rec_req_vacancy_title_ta')
                ->from('VacancyRequisition v')
                ->orderBy('v.rec_req_id');
        return $q->execute();
    }

    /**
     *
     * Executes readattach function
     * 
     * @param type $atid
     * @return AdvertisementAttachment 
     */
    public function readattach($atid) {

        $q = Doctrine_Query::create()
                ->select('count(t.rec_adv_attach_id)')
                ->from('AdvertisementAttachment t')
                ->where('t.rec_adv_id = ?', $atid);
        return $q->fetchArray();
    }

    /**
     *
     * Executes readattach function
     * 
     * @param type $atid
     * @return AdvertisementAttachment 
     */
    public function getAttachment($id, $adid) {

        $q = Doctrine_Query::create()
                ->select('t.*')
                ->from('AdvertisementAttachment t')
                ->where('t.rec_adv_attach_id = ?', $id)
                ->andWhere('t.rec_adv_id  = ?', $adid);

        return $q->fetchArray();
    }

    /**
     *
     * Executes readattach function
     * 
     * @param type $atid
     * @return AdvertisementAttachment 
     */
    public function readChargeSheet($id) {

        $q = Doctrine_Query::create()
                ->from('AdvertisementAttachment t')
                ->where('t.rec_adv_id = ?', array($id));
        return $q->execute();
    }

    /**
     *
     * Executes saveAdvertisementAttachment function
     * 
     * @param AdvertisementAttachment $advertisementAttachment 
     */
    public function saveAdvertisementAttachment(AdvertisementAttachment $advertisementAttachment) {
        $advertisementAttachment->save();
    }

    /**
     *
     * Executes readmaxretid function
     * 
     * @return Advertisement MaxId 
     */
    public function readmaxretid() {
        $q = Doctrine_Query::create()
                ->select('MAX(rec_adv_id)')
                ->from('Advertisement a');
        return $q->execute();
    }

    /**
     *
     * Executes updatch function
     * 
     * @param type $aid
     * @return CandidateCvAttachment 
     */
    public function updatch($aid) {

        $q = Doctrine_Query::create()
                ->delete('AdvertisementAttachment t')
                ->where('t.rec_adv_id =' . $aid);
        return $q->execute();
    }

    public function deleteImage($id) {

        $q = Doctrine_Query::create()
                ->delete('AdvertisementAttachment p')
                ->where('p.rec_adv_id = ?', $id);

        $q->execute();
        return true;
    }

    public function deleteImage2($id) {

        $q = Doctrine_Query::create()
                ->delete('CvAttachment p')
                ->where('p.rec_can_id = ?', $id);

        $q->execute();
        return true;
    }

    public function getVacancyRequisition($titleId) {

        $q = Doctrine_Query::create()
                ->from('VacancyRequisition vr')
                ->where('vr.rec_req_id = ?', array($titleId));
//        die(print_r($q->execute()));
        return $q->execute();
    }

}

?>
