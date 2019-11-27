<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 21 June 2011
 *  Comments  - Employee Disciplinary
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */
class DisciplinaryIncidentDao extends BaseService {

    public function saveIncident($request, $incident) {

        $timetoHR = $request->getParameter('cmbHH');
        $timetoMM = $request->getParameter('cmbMM');
        $ReportedtimeHH = $request->getParameter('cmbIncidentReportHH');
        $ReportedtimeMM = $request->getParameter('cmbIncidentReportMM');
        $IncidenttotimeHH = $request->getParameter('cmbIncidentToHH');
        $IncidenttotimeMM = $request->getParameter('cmbIncidentToMM');

        if ($ReportedtimeHH != -1 && $ReportedtimeMM != -1) {
            $Reportedtime = $ReportedtimeHH . ":" . $ReportedtimeMM;
        } elseif ($ReportedtimeHH == -1 && $ReportedtimeMM != -1) {
            $Reportedtime = "00:" . $ReportedtimeMM;
        } elseif ($ReportedtimeHH != -1 && $ReportedtimeMM == -1) {
            $Reportedtime = $ReportedtimeHH . ":00";
        } else {

            $Reportedtime = "";
        }

        if ($IncidenttotimeHH != -1 && $IncidenttotimeMM != -1) {
            $Incidenttotime = $IncidenttotimeHH . ":" . $IncidenttotimeMM;
        } elseif ($IncidenttotimeHH == -1 && $IncidenttotimeMM != -1) {
            $Incidenttotime = "00:" . $IncidenttotimeMM;
        } elseif ($IncidenttotimeHH != -1 && $IncidenttotimeMM == -1) {
            $Incidenttotime = $IncidenttotimeHH . ":00";
        } else {

            $Incidenttotime = "";
        }

        if ($timetoHR != -1 && $timetoMM != -1) {
            $totime = $timetoHR . ":" . $timetoMM;
        } elseif ($timetoHR == -1 && $timetoMM != -1) {
            $totime = "00:" . $timetoMM;
        } elseif ($timetoHR != -1 && $timetoMM == -1) {
            $totime = $timetoHR . ":00";
        } else {

            $totime = "";
        }

        $incident->setDis_inc_time($totime);
        $incident->setDis_inc_reportedtime($Reportedtime);
        $incident->setDis_inc_totime($Incidenttotime);
        if ($request->getParameter('txtIncidentReportDate') != null) {
            $incident->setDis_inc_reporteddate(LocaleUtil::getInstance()->convertToStandardDateFormat($request->getParameter('txtIncidentReportDate')));
        } else {
            $incident->setDis_inc_reporteddate(null);
        }
        if ($request->getParameter('txtIncidentToDate') != null) {
            $incident->setDis_inc_todate(LocaleUtil::getInstance()->convertToStandardDateFormat($request->getParameter('txtIncidentToDate')));
        } else {
            $incident->setDis_inc_todate(null);
        }
        $incident->setDis_inc_level(0);
        $incident->setDis_inc_isclosed(0);
        $incident->setDis_inc_incident($request->getParameter('txtIncident'));
        $incident->setDis_inc_incident_si($request->getParameter('txtIncidentSi'));
        $incident->setDis_inc_incident_ta($request->getParameter('txtIncidentTa'));
        $incident->setDis_inc_reportedby($request->getParameter('txtEmpname'));
        if ($request->getParameter('txtIncidentDate') != null) {
            $incident->setDis_inc_date(LocaleUtil::getInstance()->convertToStandardDateFormat($request->getParameter('txtIncidentDate')));
        } else {
            $incident->setDis_inc_date(null);
        }
        $incident->setDis_acttype_id($request->getParameter('cmbActiontype'));


        return $incident->save();
    }

    public function updateIncident($request, $currentIncident) {

        $timetoHR = $request->getParameter('cmbHH');
        $timetoMM = $request->getParameter('cmbMM');

        if ($timetoHR != -1 && $timetoMM != -1) {
            $totime = $timetoHR . ":" . $timetoMM;
        } elseif ($timetoHR == -1 && $timetoMM != -1) {
            $totime = "00:" . $timetoMM;
        } elseif ($timetoHR != -1 && $timetoMM == -1) {
            $totime = $timetoHR . ":00";
        } else {

            $totime = "";
        }

        $currentIncident->setDis_acttype_id($request->getParameter('cmbActiontype'));
        $currentIncident->setDis_inc_level(1);
        if ($request->getParameter('optInvolveType') == 0) {
            if ($request->getParameter('optChargesheetExplanation') == "0") {
                $currentIncident->setDis_inc_chargesheet_comment($request->getParameter('txtPrimSummary'));
                $currentIncident->setDis_inc_caseclosed_comment($request->getParameter('txtAcomment'));
                $currentIncident->setDis_inc_isclosed(1);
                $currentIncident->setDis_inc_furtheraction_flg(0);
            } else {
//                die(print_r($_POST));
                $currentIncident->setDis_inc_chargesheet_comment($request->getParameter('txtPrimSummary1'));
                $currentIncident->setDis_inc_caseclosed_comment($request->getParameter('txtAcomment1'));
                $currentIncident->setDis_inc_isclosed(1);
                $currentIncident->setDis_inc_furtheraction_flg(0);
            }
            //$currentIncident->setDis_inc_isclosed($request->getParameter('optactionType'));
        } else if ($request->getParameter('optInvolveType') == 1) {
            if ($request->getParameter('optactionType') == 1) {
                $currentIncident->setDis_inc_intedicted_flg(1);
                $currentIncident->setDis_inc_furtheraction_flg(1);
                $currentIncident->setDis_inc_isclosed(0);
            } else {
                $currentIncident->setDis_inc_isclosed(0);
                $currentIncident->setDis_inc_furtheraction_flg(1);
            }
        }
        //$currentIncident->setDis_inc_isclosed($request->getParameter('optactionType'));
        if ($request->getParameter('txtIncidentDate') != null) {
            $currentIncident->setDis_inc_date(LocaleUtil::getInstance()->convertToStandardDateFormat($request->getParameter('txtIncidentDate')));
        } else {
            $currentIncident->setDis_inc_date(null);
        }
        $currentIncident->setDis_inc_time($totime);
        $currentIncident->setDis_inc_incident($request->getParameter('txtIncident'));
        $currentIncident->setDis_inc_incident_si($request->getParameter('txtIncidentSi'));
        $currentIncident->setDis_inc_incident_ta($request->getParameter('txtIncidentTa'));

        $currentIncident->setDis_inc_reportedby($request->getParameter('txtReportedEmpId'));
        $currentIncident->setDis_inc_prelim_com($request->getParameter('txtAcomment'));
        $currentIncident->setDis_inc_type($request->getParameter('optInvolveType'));
//        $currentIncident->setDis_inc_prim_summary($request->getParameter('txtPrimSummary'));
        $currentIncident->setDis_inc_reportedby($request->getParameter('txtEmpname'));

        $currentIncident->setDis_inc_major_mionor_flg($request->getParameter('optInvolveType'));
        $currentIncident->setDis_inc_ifchargesheetissued_flg($request->getParameter('optChargesheetExplanation'));

        $currentIncident->setDis_inc_intedicted_comment($request->getParameter('txtFutherInterdictedComment'));

        $currentIncident->setDis_inc_investigation_auditfb($request->getParameter('txtInvestigationAuditFB'));
        return $currentIncident->save();
    }

    public function updateIncidentLevel2($request, $currentIncident) {

        $currentIncident->setDis_inc_level(1);

        if ($request->getParameter('optactionType') == 0) {
            $currentIncident->setDis_inc_isclosed(0);
        } else if ($request->getParameter('optactionType') == 1 || $request->getParameter('optactionType') == null) {
            $currentIncident->setDis_inc_isclosed(1);
        }

        $currentIncident->setDis_inc_time($totime);
        $currentIncident->setDis_inc_inq_officer($request->getParameter('txtInqueryOfficer'));
        $currentIncident->setDis_inc_pro_officer($request->getParameter('txtProsecOfficer'));
        $currentIncident->setDis_inc_defe_officer($request->getParameter('txtdefenOfficer'));
        $currentIncident->setDis_inc_inquery_comment($request->getParameter('txtCommentsInquery'));
        $currentIncident->setDis_inc_prelim_com($request->getParameter('txtPreComment'));
        if ($request->getParameter('cmbFinalActionTkn') != '') {
            $currentIncident->setDis_fna_code($request->getParameter('cmbFinalActionTkn'));
        } else {
            $currentIncident->setDis_fna_code(null);
        }
        if (strlen($request->getParameter('txtFinActTknDate'))) {
            $currentIncident->setDis_inc_finact_tkndate(LocaleUtil::getInstance()->convertToStandardDateFormat($request->getParameter('txtFinActTknDate')));
        } else {
            $currentIncident->setDis_inc_finact_tkndate(null);
        }

        $currentIncident->setDis_inc_finact_tknby($request->getParameter('txtFinalActionTknby'));
        $currentIncident->setDis_inc_type($request->getParameter('optInvolveType'));
        $currentIncident->setDis_inc_finalaction_comment($request->getParameter('txtFinalActionComments'));
        if ($request->getParameter('chkappeal')) {
            $currentIncident->setDis_inc_appeal_flg($request->getParameter('chkappeal'));
            if ($request->getParameter('txtAppealDate') != null) {
                $currentIncident->setDis_inc_appeal_date($request->getParameter('txtAppealDate'));
            } else {
                $currentIncident->setDis_inc_appeal_date(null);
            }
            $currentIncident->setDis_inc_appeal_board_comment($request->getParameter('txtAppealBoardComments'));
            $currentIncident->setDis_inc_appeal_labour_comment($request->getParameter('txtAppealLabourComment'));
        } else {
            $currentIncident->setDis_inc_appeal_flg(null);
        }
        if (strlen($request->getParameter('txtFileDate'))) {
            $currentIncident->setDis_inc_filedate(LocaleUtil::getInstance()->convertToStandardDateFormat($request->getParameter('txtFileDate')));
        } else {
            $currentIncident->setDis_inc_filedate(null);
        }

        $currentIncident->setDis_inc_reportedby($request->getParameter('txtEmpname'));
        return $currentIncident->save();
    }

    public function getMaxIncidentId() {
        $q = Doctrine_Query::create()
                ->select('MAX(dis_inc_id)')
                ->from('Incidents I');
        return $q->fetchArray();
    }

    public function saveInvolvedEmp($invoEmp) {



        $invoEmp->save();

        return true;
    }

    public function saveOffenceList(OffenceList $offlist) {


        $offlist->save();

        return true;
    }

    public function saveDisAttachment(DisAttachment $attach) {

        $attach->save();

        return true;
    }

    public function updatedisemp($id, $eno, $majmin, $type) {

        $q = Doctrine_Query::create()
                ->update('DisEmployeeInvolved d')
                ->set('d.dis_inv_type', '?', array($majmin))
                ->set('d.dis_fna_code', '?', array($type))
                ->where('d.dis_inc_id = ?', $id)
                ->andwhere('d.emp_number= ?', $eno);
        $q->execute();

        return true;
    }

    public function deleteOffenceList($incId) {

        $q = Doctrine_Query::create()
                ->delete('OffenceList i')
                ->where('i.dis_inc_id = ?', $incId);
        $numDeleted = $q->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    public function readChargeSheet($id, $type) {

        $q = Doctrine_Query::create()
                ->from('DisAttachment d')
                ->where('d.dis_inc_id = ?', array($id))
                ->andwhere('d.dis_attach_category = ?', array($type));
        return $q->execute();
    }

    public function readOffenceList($id) {

        $q = Doctrine_Query::create()
                ->from('OffenceList o')
                ->where('o.dis_inc_id = ?', $id);
        return $q->fetchArray();
    }

    public function checkChargeSheet($id, $type) {

        $q = Doctrine_Query::create()
                ->select('COUNT(a.dis_inc_id)')
                ->from('DisAttachment a')
                ->where('a.dis_inc_id = ?', array($id))
                ->andwhere('a.dis_attach_category = ?', array($type));


        return $q->fetchArray();
    }

   

    public function readIncidentByID($id) {

        return Doctrine::getTable('Incidents')->find($id);
    }

    public function getInvolvedEmpListByID($id) {
        $q = Doctrine_Query::create()
                ->from('DisEmployeeInvolved d')
                ->leftJoin('d.Employee e')
                ->where('d.dis_inc_id = ?', array($id));
        return $q->execute();
    }

    public function Loadoffence($id) {
        $q = Doctrine_Query::create()
                ->select('o.*')
                ->from('Offence o')
                ->where('dis_acttype_id = ?', $id);

        return $q->execute();
    }

    public function GetListedEmpids($id) {

        $q = Doctrine_Query::create()
                ->select('d.*')
                ->from('DisEmployeeInvolved d')
                ->where('d.dis_inc_id = ?', array($id));


        return $q->execute();
    }

}

?>
