<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author     - Givantha Kalansuriya
 *  On (Date)  - 27 July 2011
 *  Comments   - Recruitment Module AdvertisementService Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 */
class AdvertisementService extends BaseService {

    private $advertisementDao;

    /**
     * AdvertisementService construct
     */
    public function __construct() {
        $this->advertisementDao = new AdvertisementDao();
    }

    /**
     *
     * Executes saveAdvertisement Service
     * 
     * @param Advertisement $advertisement
     * @return type 
     */
    public function saveAdvertisement(Advertisement $advertisement, $request) {
        return $this->advertisementDao->saveAdvertisement($advertisement, $request);
    }

    /**
     * 
     * Executes getAdvertisementList Service
     *
     * @return type 
     */
    public function getAdvertisementList() {
        return $this->advertisementDao->getAdvertisementList();
    }

    /**
     *
     * Executes readAdvertisement Service
     * 
     * @param type $id
     * @return type 
     */
    public function readAdvertisement($id) {
        return $this->advertisementDao->getAdvertisementById($id);
    }

    /**
     * 
     * Executes getVacancyTitleList Service
     *
     * @return type 
     */
    public function getVacancyTitleList() {
        return $this->advertisementDao->getVacancyTitleList();
    }

    /**
     *
     * Executes readattach Service
     * 
     * @param type $atId
     * @return type 
     */
    public function readattach($atId) {
        return $this->advertisementDao->readattach($atId);
    }

    /**
     *
     * Executes readattach Service
     * 
     * @param type $atId
     * @return type 
     */
    public function getAttachment($id, $adid) {
        return $this->advertisementDao->getAttachment($id, $adid);
    }

    /**
     *
     * Executes readChargeSheet Service
     * 
     * @param type $atId
     * @return type 
     */
    public function readChargeSheet($atId) {
        return $this->advertisementDao->readChargeSheet($atId);
    }

    /**
     * 
     * Executes saveAdvertisementAttachment Service
     *
     * @param AdvertisementAttachment $advertisementAttachment
     * @return type 
     */
    public function saveAdvertisementAttachment(AdvertisementAttachment $advertisementAttachment) {
        return $this->advertisementDao->saveAdvertisementAttachment($advertisementAttachment);
    }

    /**
     * 
     * Executes readMaxAdvertisementid Service
     *
     * @return type 
     */
    public function readMaxAdvertisementid() {
        return $this->advertisementDao->readmaxretid();
    }

    /**
     *
     * Executes readAdvertisementAttachment Service
     * 
     * @param type $id
     * @param type $atid
     * @return type 
     */
    public function readAdvertisementAttachment($id, $atid) {
        return $this->advertisementDao->readAdvertisementAttachment($id, $atid);
    }

    /**
     *
     * Executes readAdvertisementAttachment2 Service
     * 
     * @param type $id
     * @param type $atid
     * @return type 
     */
    public function readAdvertisementAttachment2($id, $atid) {
        return $this->advertisementDao->readAdvertisementAttachment2($id, $atid);
    }

    /**
     *
     * Executes updatch Service
     * 
     * @param type $aid
     * @return type 
     */
    public function updatch($aid) {
        return $this->advertisementDao->updatch($aid);
    }

    /**
     *
     * Executes updatch Service
     * 
     * @param type $aid
     * @return type 
     */
    public function deleteImage($aid) {
        return $this->advertisementDao->deleteImage($aid);
    }

}

?>
