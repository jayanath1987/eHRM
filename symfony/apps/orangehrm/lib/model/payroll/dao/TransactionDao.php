<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - roshan
 *  On (Date) - 22 Augest 2011
 *  Comments  - Payroll Module Administartion Data Access CRUD operation
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class TransactionDao extends BaseDao {

    public function readTtype($id) {

        return Doctrine::getTable('PRTransActiontype')->find($id);
    }

    public function saveObj($request) {

        $conn = Doctrine_Manager::getInstance()->connection();
        $conn->beginTransaction();

        $transActionService = new TransactionService();



        $TransType = $transActionService->readTtype($request->getParameter('txtTID'));

        if (!$TransType) {
            $TransType = new PRTransActiontype();
            if ($TransType->trn_typ_user_code == '') {

                $idGenService = new IDGeneratorService();
                $idGenService->setEntity($TransType);
                $TransType->setTrn_typ_user_code($idGenService->getNextID());
            }
        }

        if (strlen($request->getParameter('txtCode'))) {

            $TransType->setTrn_typ_user_code(trim($request->getParameter('txtCode')));
        }
        if (($request->getParameter('txtName')) != null) {
            $TransType->setTrn_typ_name(trim($request->getParameter('txtName')));
        } else {
            $TransType->setTrn_typ_name(null);
        }
        if (($request->getParameter('txtNameSi')) != null) {
            $TransType->setTrn_typ_name_si(trim($request->getParameter('txtNameSi')));
        } else {
            $TransType->setTrn_typ_name_si(null);
        }
        if (($request->getParameter('txtNameTa')) != null) {
            $TransType->setTrn_typ_name_ta(trim($request->getParameter('txtNameTa')));
        } else {
            $TransType->setTrn_typ_name_ta(null);
        }
        if (($request->getParameter('cmbPeriod')) != null) {
            $TransType->setTrn_typ_type(trim($request->getParameter('cmbPeriod')));
        }
        if (($request->getParameter('cmbType')) != null) {
            $TransType->setErndedcon(trim($request->getParameter('cmbType')));
        } else {
            $TransType->setErndedcon(null);
        }


        $TransType->save();
        $conn->commit();
    }

    public function getDefaultTransactionTypeId() {
        $idGenService = new IDGeneratorService();
        $idGenService->setEntity(new PRTransActiontype());
        return $idGenService->getNextID(false);
    }

    public function searchTransactiontypes($searchMode="", $searchValue="", $culture="", $page=1, $orderField='t.trn_typ_code', $orderBy='ASC') {


        switch ($searchMode) {

            case "code":
                $feildName = "t.trn_typ_user_code";
                break;
            case "name":
                if ($culture == "en") {
                    $feildName = "t.trn_typ_name";
                } else {
                    $feildName = "t.trn_typ_name_" . $culture;
                }
                break;
        }

        $q = Doctrine_Query::create()
                ->select('t.*')
                ->from('PRTransActiontype t');
        if ($searchValue != "") {

            $q->where($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
        }
        $q->orderBy($orderField . ' ' . $orderBy);


        // Number of records for a one page
        $sysConf = new sysConf();
        $resultsPerPage = $sysConf->getRowLimit() ? $sysConf->getRowLimit() : 10;

        // Pager object
        $pagerLayout = new CommonhrmPager(
                        new Doctrine_Pager(
                                $q,
                                $page,
                                $resultsPerPage
                        ),
                        new Doctrine_Pager_Range_Sliding(array(
                            'chunk' => 5
                        )),
                        "?page={%page_number}&mode=search&searchValue={$searchValue}&searchMode={$searchMode}&sort={$orderField}&order={$orderBy}"
        );

        $pager = $pagerLayout->getPager();
        $res = array();
        $res['data'] = $pager->execute();
        $res['pglay'] = $pagerLayout;

        return $res;
    }

    public function deleteTranaActionType($id) {

        $q = Doctrine_Query::create()
                ->delete('PRTransActiontype')
                ->where('trn_typ_code=' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    public function readTDetailtype($id) {
        return Doctrine::getTable('PRTransDetails')->find($id);
    }

    public function getDefaultTransactionDetailId() {

        $idGenService = new IDGeneratorService();
        $idGenService->setEntity(new PRTransDetails());
        return $idGenService->getNextID(false);
    }

    public function getAllTransTypeByFilter() {

        $q = Doctrine_Query::create()
                ->select('*')
                ->from('PRTransDetails p')
                ->leftJoin('p.PRTransActiontype t on p.trn_typ_code=t.trn_typ_code')
                ->where('t.erndedcon!=0');


        return $q->execute();
    }

    public function getAllTransType() {
        $q = Doctrine_Query::create()
                ->select('*')
                ->from('PRTransActiontype p');

        return $q->execute();
    }

    public function saveDetailObj($request) {

        $TransType = "";
        $conn = Doctrine_Manager::getInstance()->connection();
        $conn->beginTransaction();

        $transActionService = new TransactionService();

        $TransDetailType = $transActionService->readTDetailtype($request->getParameter('txtTDID'));

        if (!$TransDetailType) {
            $TransDetailType = new PRTransDetails();
            if ($TransDetailType->trn_dtl_user_code == '') {

                $idGenService = new IDGeneratorService();
                $idGenService->setEntity($TransDetailType);
                $TransDetailType->setTrn_dtl_user_code($idGenService->getNextID());
            }
        }


        if (strlen($request->getParameter('txtCode'))) {

            $TransDetailType->setTrn_dtl_user_code(trim($request->getParameter('txtCode')));
        }
        if (($request->getParameter('txtName')) != null) {
            $TransDetailType->setTrn_dtl_name(trim($request->getParameter('txtName')));
        } else {
            $TransDetailType->setTrn_dtl_name(null);
        }
        if (($request->getParameter('txtNameSi')) != null) {
            $TransDetailType->setTrn_dtl_name_si(trim($request->getParameter('txtNameSi')));
        } else {
            $TransDetailType->setTrn_dtl_name_si(null);
        }
        if (($request->getParameter('txtNameTa')) != null) {
            $TransDetailType->setTrn_dtl_name_ta(trim($request->getParameter('txtNameTa')));
        } else {
            $TransDetailType->setTrn_dtl_name_ta(null);
        }
        $TransDetailType->setTrn_disable_flg(1);

        if (($request->getParameter('txtNarrationName')) != null) {
            $TransDetailType->setTrn_dtl_payslipnarration(trim($request->getParameter('txtNarrationName')));
        } else {
            $TransDetailType->setTrn_dtl_payslipnarration(null);
        }
        if (($request->getParameter('txtNarrationNameSi')) != null) {
            $TransDetailType->setTrn_dtl_payslipnarration_si(trim($request->getParameter('txtNarrationNameSi')));
        } else {
            $TransDetailType->setTrn_dtl_payslipnarration_si(null);
        }
        if (($request->getParameter('txtNarrationNameTa')) != null) {
            $TransDetailType->setTrn_dtl_payslipnarration_ta(trim($request->getParameter('txtNarrationNameTa')));
        } else {
            $TransDetailType->setTrn_dtl_payslipnarration_ta(null);
        }
        if (($request->getParameter('txtOrderPaySlip')) != null) {
            $TransDetailType->setTrn_dtl_display_order(trim($request->getParameter('txtOrderPaySlip')));
        } else {
            $TransDetailType->setTrn_dtl_display_order(null);
        }
        if (($request->getParameter('chkProration')) != null) {
            $TransDetailType->setTrn_dtl_isprorate_flg(trim($request->getParameter('chkProration')));
        } else {
            $TransDetailType->setTrn_dtl_isprorate_flg(0);
        }
        if (($request->getParameter('chkEnable')) != null) {
            $TransDetailType->setTrn_disable_flg(trim($request->getParameter('chkEnable')));
        } else {
            $TransDetailType->setTrn_disable_flg(1);
        }
        if (($request->getParameter('chkDefaultTrans')) != null) {
            $TransDetailType->setTrn_dtl_isdefault_flg(trim($request->getParameter('chkDefaultTrans')));
        } else {
            $TransDetailType->setTrn_dtl_isdefault_flg(0);
        }

        if (($request->getParameter('optAddToPay')) != null) {
            $TransDetailType->setTrn_dtl_addtonetpay(trim($request->getParameter('optAddToPay')));
        }
        if (($request->getParameter('txtEmplyr')) != null) {
            $TransDetailType->setTrn_dtl_eyrcont(trim($request->getParameter('txtEmplyr')));
        } else {
            $TransDetailType->setTrn_dtl_eyrcont(null);
        }
        if (($request->getParameter('txtEmply')) != null) {
            $TransDetailType->setTrn_dtl_empcont(trim($request->getParameter('txtEmply')));
        } else {
            $TransDetailType->setTrn_dtl_empcont(null);
        }

        if (($request->getParameter('txtFormula')) != null) {
            $TransDetailType->setTrn_dtl_formula(trim($request->getParameter('txtFormula')));
        } else {
            $TransDetailType->setTrn_dtl_formula(null);
        }

        if (strlen($request->getParameter('cmbTransType'))) {
            $transType = explode("|", ($request->getParameter('cmbTransType')));
            $TransType = trim($transType[0]);
            $TransDetailType->setTrn_typ_code(trim($transType[0]));
        } else {
            $TransDetailType->setTrn_typ_code(null);
        }
        if (strlen($request->getParameter('ChkIsbsTxn'))) {
            $TransDetailType->setTrn_dtl_isbasetxn_flg(trim(1));
        } else {
            $TransDetailType->setTrn_dtl_isbasetxn_flg(0);
        }
        
        if (strlen($request->getParameter('optAgent'))) {
            $TransDetailType->setTrn_dtl_agent_bank_flg($request->getParameter('optAgent'));
        } else {
            $TransDetailType->setTrn_dtl_agent_bank_flg(null);
        }
        
        if (strlen($request->getParameter('cmbBank'))) {
            $TransDetailType->setTrn_dtl_bank_code($request->getParameter('cmbBank'));
        } else {
            $TransDetailType->setTrn_dtl_bank_code(null);
        }
        
        if (strlen($request->getParameter('cmbBranch'))) {
            $TransDetailType->setTrn_dtl_branch_code($request->getParameter('cmbBranch'));
        } else {
            $TransDetailType->setTrn_dtl_branch_code(null);
        }
        if (strlen($request->getParameter('ReferenceNo'))) {
            $TransDetailType->setTrn_dtl_account_no($request->getParameter('ReferenceNo'));
        } else {
            $TransDetailType->setTrn_dtl_account_no(null);
        }
        
        $TransDetailType->save();

        $isTransTypeCont = $this->isTransTypeCont($TransType);
        $isTransTypeCont = $isTransTypeCont[0]->erndedcon;


        $maxDetailId = $this->getMaxDetailId();
        $this->deleteContibution($request->getParameter('txtTDID'));

        for ($i = 0; $i < count($_POST['chkTransType']); $i++) {





            if ($isTransTypeCont == 0) {

                $payContibution = new PayRollContributeBase();
                if (strlen($TransDetailType->trn_dtl_code)) {

                    $payContibution->setTrn_dtl_code($TransDetailType->trn_dtl_code);
                    $payContibution->setTrn_contribute_code($TransDetailType->trn_dtl_code);
                } else {
                    $payContibution->setTrn_dtl_code($maxDetailId[0]['MAX']);
                    $payContibution->setTrn_contribute_code($maxDetailId[0]['MAX']);
                }

                $payContibution->setTrn_dtl_base_code($_POST['chkTransType'][$i]);
                $payContibution->save();
            }
        }


        $this->deleteBsnTrans($request->getParameter('txtTDID'));

//                 print_r($_POST['chkBsnPreivous']);die;
        for ($i = 0; $i < count($_POST['chkTransTypeBsn']); $i++) {

            $explode = explode("|", $_POST['chkTransTypeBsn'][$i]);
//                    die(print_r($explode));

            $PayRollTransBase = new PayRollTransBase();

            if (strlen($TransDetailType->trn_dtl_code)) {


                $PayRollTransBase->setTrn_dtl_code($TransDetailType->trn_dtl_code);
            } else {
                $PayRollTransBase->setTrn_dtl_code($maxDetailId[0]['MAX']);
            }


            $PayRollTransBase->setTrn_dtl_base_code($explode[1]);
            if (strlen($explode[0])) {
                $PayRollTransBase->setTrn_base_prev_flg($explode[0]);
            } else {
                $PayRollTransBase->setTrn_base_prev_flg(0);
            }
            $PayRollTransBase->save();
        }



        $conn->commit();
    }

    public function deleteContibution($id) {

        $q = Doctrine_Query::create()
                ->delete('PayRollContributeBase p')
                ->where('p.trn_dtl_code = ?', $id);
        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    public function deleteBsnTrans($id) {

        $q = Doctrine_Query::create()
                ->delete('PayRollTransBase p')
                ->where('p.trn_dtl_code = ?', $id);
        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    public function getMaxDetailId() {
        $q = Doctrine_Query::create()
                ->select('MAX(trn_dtl_code)')
                ->from('PRTransDetails p');
        return $q->fetchArray();
    }

    public function searchTransactionDetails($searchMode="", $searchValue="", $culture="", $page=1, $orderField='t.trn_dtl_code', $orderBy='ASC') {


        switch ($searchMode) {

            case "code":
                $feildName = "t.trn_dtl_user_code";
                break;
            case "name":
                if ($culture == "en") {
                    $feildName = "t.trn_dtl_name";
                } else {
                    $feildName = "t.trn_dtl_name_" . $culture;
                }
                break;
        }

        $q = Doctrine_Query::create()
                ->select('t.*')
                ->from('PRTransDetails t');
        if ($searchValue != "") {

            $q->where($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
        }
        $q->orderBy($orderField . ' ' . $orderBy);


        // Number of records for a one page
        $sysConf = new sysConf();
        $resultsPerPage = $sysConf->getRowLimit() ? $sysConf->getRowLimit() : 10;

        // Pager object
        $pagerLayout = new CommonhrmPager(
                        new Doctrine_Pager(
                                $q,
                                $page,
                                $resultsPerPage
                        ),
                        new Doctrine_Pager_Range_Sliding(array(
                            'chunk' => 5
                        )),
                        "?page={%page_number}&mode=search&searchValue={$searchValue}&searchMode={$searchMode}&sort={$orderField}&order={$orderBy}"
        );

        $pager = $pagerLayout->getPager();
        $res = array();
        $res['data'] = $pager->execute();
        $res['pglay'] = $pagerLayout;

        return $res;
    }

    public function getContListByID($id) {

        $q = Doctrine_Query::create()
                ->select('p.trn_dtl_code')
                ->from('PayRollContributeBase p')
                ->where('p.trn_dtl_base_code = ?', $id);
//                        ->andWhere();
        return $q->execute();
    }

    public function getContListByFilter($id) {

        $q = Doctrine_Query::create()
                ->select('p.trn_dtl_base_code')
                ->from('PayRollContributeBase p')
                ->where('p.trn_dtl_code = ?', $id);

        return $q->execute();
    }

    public function getcontCodeBuTypeID($detailCode, $typeId) {

        $q = Doctrine_Query::create()
                ->select('p.trn_contribute_code')
                ->from('PayRollContributeBase p')
                ->where('p.trn_dtl_code = ?', array($detailCode))
                ->andWhere('p.trn_dtl_base_code =?', array($typeId));

        return $q->execute();
    }

    public function getcontTypeForFilter($tDetailId) {
        $q = Doctrine_Query::create()
                ->select('p.trn_dtl_base_code')
                ->from('PayRollContributeBase p')
                ->where('p.trn_dtl_code = ?', $tDetailId);
//                        ->andWhere();
        return $q->execute();
    }

    public function getBaseTransListByID($id) {

        $q = Doctrine_Query::create()
                ->select('p.trn_dtl_base_code,p.trn_base_prev_flg')
                ->from('PayRollTransBase p')
                ->where('p.trn_dtl_code = ?', $id);
        return $q->execute();
    }

    public function getPrvflgByid($id) {

        $q = Doctrine_Query::create()
                ->select('p.trn_base_prev_flg')
                ->from('PayRollTransBase p')
                ->where('p.trn_dtl_base_code = ?', $id);

        return $q->fetchArray();
    }

    public function deleteTranaActionDetails($id) {

        $q = Doctrine_Query::create()
                ->delete('PRTransDetails')
                ->where('trn_dtl_code=' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    public function deleteTranaActionBase($id) {

        $q = Doctrine_Query::create()
                ->delete('PayRollTransBase')
                ->where('trn_dtl_code=' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    public function deleteTranaActionContibution($id) {
        $q = Doctrine_Query::create()
                ->delete('PayRollContributeBase')
                ->where('trn_dtl_code=' . $id);

        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    public function getAllTransactionDetails() {

        $q = Doctrine_Query::create()
                ->select('*')
                ->from('PRTransDetails');


        return $q->execute();
    }

    public function getAllContList() {

        $q = Doctrine_Query::create()
                ->select('*')
                ->from('PRTransDetails p')
                ->leftJoin('p.PRTransActiontype t on p.trn_typ_code=t.trn_typ_code')
                ->where('t.erndedcon=0');


        return $q->execute();
    }

    public function isTransTypeCont($id) {
        $q = Doctrine_Query::create()
                ->select('*')
                ->from('PRTransActiontype p')
                ->where('p.trn_typ_code=?', array($id));


        return $q->execute();
    }

    public function getAllTransactionDetailsForBase($detailId) {

        $q = Doctrine_Query::create()
                ->select('d.*')
                ->from('PRTransDetails d')
                ->leftJoin('d.PRTransActiontype t on t.trn_typ_code=d.trn_typ_code')
                ->where('d.trn_dtl_isbasetxn_flg=0')
                ->andWhere('t.erndedcon !=?', "0")
                ->andWhere('d.trn_dtl_code!= ?', array($detailId));

        return $q->execute();
    }

}