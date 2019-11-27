<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author     - Hashan Peiris
 *  On (Date)  - 27 July 2011
 *  Comments   - Admin Module CompanyService Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 */
class CompanyService extends BaseService {

    private $companyDao;

    function __construct() {
        $this->companyDao = new CompanyDao();
    }

    public function setCompanyDao(CompanyDao $companyDao) {
        $this->companyDao = $companyDao;
    }

    public function getCompanyDao() {
        return $this->companyDao;
    }

    public function getCompany() {

        return $this->companyDao->getCompany();
    }

    public function getEmployeeList() {

        $employeeService = new EmployeeService();
        return $employeeService->getEmployeeList();
    }

    public function getSupervisorEmployeeList($supervisorId) {

        $employeeService = new EmployeeService();
        return $employeeService->getSupervisorEmployeeList($supervisorId);
    }

    public function getEmployeeListAsJson() {

        $employeeService = new EmployeeService();
        return $employeeService->getEmployeeListAsJson();
    }

    public function saveCompany(Company $company, CompanyStructure $companyStructure) {
        $conn = Doctrine_Manager :: connection();
        $conn->beginTransaction();

        $this->companyDao->saveCompany($company, $companyStructure);

        $conHandler = new ConcurrencyHandler();
        $conHandler->resetTableLock('hs_hr_compstructtree', array($companyStructure->id), 1);

        $conn->commit();
        return true;
    }

    public function getCompanyLocation($orderField = "loc_code", $orderBy = "ASC") {

        return $this->companyDao->getCompanyLocation($orderField, $orderBy);
    }

    public function saveCompanyLocation(Location $location) {

        return $this->companyDao->saveCompanyLocation($location);
    }

    public function deleteCompanyLocation($locationCodes = array()) {

        return $this->companyDao->deleteCompanyLocation($locationCodes);
    }

    public function searchCompanyLocation($searchMode, $searchValue) {

        return $this->companyDao->searchCompanyLocation($searchMode, $searchValue);
    }

    public function readLocation($id) {

        return $this->companyDao->readLocation($id);
    }

    public function getCompanyProperty($orderField = "prop_id", $orderBy = "ASC") {

        return $this->companyDao->getCompanyProperty($orderField, $orderBy);
    }

    public function getCompanyPropertyForSupervisor($subordinates, $orderField = "prop_id", $orderBy = "ASC") {

        return $this->companyDao->getCompanyPropertyForSupervisor($subordinates, $orderField, $orderBy);
    }

    public function saveCompanyProperty(CompanyProperty $companyProperty) {

        return $this->companyDao->saveCompanyProperty($companyProperty);
    }

    public function deleteCompanyProperty($propertyList = array()) {

        return $this->companyDao->deleteCompanyProperty($propertyList);
    }

    public function readCompanyProperty($id) {

        return $this->companyDao->readCompanyProperty($id);
    }

    public function saveCompanyStructure(CompanyStructure $companyStructure) {
        $conn = Doctrine_Manager :: connection();
        $conn->beginTransaction();

        $this->companyDao->saveCompanyStructure($companyStructure);

        $conHandler = new ConcurrencyHandler();
        $conHandler->resetTableLock('hs_hr_compstructtree', array($companyStructure->id), 1);

        $conn->commit();
        return true;
    }

    public function readCompanyStructure($id) {

        return $this->companyDao->readCompanyStructure($id);
    }

    function getCompanyStructureList($parentId = null) {

        return $this->companyDao->getCompanyStructureList($parentId);
    }

    public function deleteCompanyStructure($id) {

        return $this->companyDao->deleteCompanyStructure($id);
    }

    public function getCompanyStructureHierarchy() {

        $recusiveList = array();
        $list = $this->getCompanyStructureList(1);
        $parentLookup = array();
        $grouped = array();
        $maxDepth = 0;

        foreach ($list as $k => $node) {
            $recusiveList[$node->getId()]['x'] = $node;
        }

        $list = $this->getCompanyStructureList();

        $lastKey = null;

        foreach ($list as $k => $node) {

            if (isset($recusiveList[$node->getParnt()])) {
                $rows = $recusiveList[$node->getParnt()];

                foreach ($rows as $k => $v) {
                    $lastKey = $k;
                }

                if ($lastKey != "") {
                    $lastKey .= "|" . $node->getId();
                } else {
                    $lastKey = $node->getId();
                }

                $recusiveList[$node->getParnt()][$lastKey] = $node;

                $grouped[$node->getParnt()] = $lastKey;
                if ($maxDepth < count(explode("|", $lastKey))) {
                    $maxDepth = count(explode("|", $lastKey));
                }
            } else {

                $parentLookup[$node->getParnt()] = $node;
                $maxDepth = 1;
            }
        }

        //records not sorted by its parent
        foreach ($parentLookup as $parentId => $node) {

            foreach ($grouped as $k => $v) {

                $parents = explode("|", $v);
                if ($parents[count($parents) - 1] == $parentId) {
                    $v .= "|" . $node->getId();
                    $recusiveList[$k][$v] = $node;
                    $grouped[$k] = $v;
                    if ($maxDepth < count(explode("|", $v))) {
                        $maxDepth = count(explode("|", $v));
                    }
                }
            }
        }
        $recusiveList['maxDepth'] = $maxDepth;

        return $recusiveList;
    }

    public function getSubDivisionList() {


        return $this->companyDao->getSubDivisionList();
    }

    public function getCompanyDetailsById($id) {
        return $this->companyDao->getCompanyDetailsById($id);
    }

    public function readDeflevelById($id) {

        return $this->companyDao->readDeflevelById($id);
    }

    public function readActingCompanyStructure($Emp, $j) {
        return $this->companyDao->readActingCompanyStructure($Emp, $j);
    }

    public function saveActingWorkstation(EmpActiveWorkstation $ActingWorkstation) {
        return $this->companyDao->saveActingWorkstation($ActingWorkstation);
    }

    public function readActingCompanyStructureLoad($emp) {
        return $this->companyDao->readActingCompanyStructureLoad($emp);
    }

    public function deleteActingWorkstation($empno, $compId) {
        return $this->companyDao->deleteActingWorkstation($empno, $compId);
    }

    public function getUserDefLevel($empID) {
        return $this->companyDao->getUserDefLevel($empID);
    }

    public function readCompanyStructurebyTitle($title) {
        return $this->companyDao->readCompanyStructurebyTitle($title);
    }

}