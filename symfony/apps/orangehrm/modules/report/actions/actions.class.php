<?php

/**
 * OrangeHRM is a comprehensive Human Resource Management (HRM) System that captures
 * all the essential functionalities required for any enterprise.
 * Copyright (C) 2006 OrangeHRM Inc., http://www.orangehrm.com
 *
 * OrangeHRM is free software; you can redistribute it and/or modify it under the terms of
 * the GNU General Public License as published by the Free Software Foundation; either
 * version 2 of the License, or (at your option) any later version.
 *
 * OrangeHRM is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
 * without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with this program;
 * if not, write to the Free Software Foundation, Inc., 51 Franklin Street, Fifth Floor,
 * Boston, MA  02110-1301, USA
 */
/**
 * Actions class for Report module
 *
 *-------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 27 July 2011 (today)
 *  Comments  - Report related Functions 
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
**/

include ('../../lib/common/LocaleUtil.php');
class reportActions extends sfActions {
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
	
    private $service;

    public function setService($service) {
            $this->service = $service;
    }

    public function getService() {
            return $this->service;
    }

    /**
     * List Assigned Report List
     * @param sfWebRequest $request
     * @return unknown_type
     */
    public function executeViewReportList(sfWebRequest $request) {
        try {          
            $this->userCulture = $this->getUser()->getCulture();
            $reportService = new ReportService();

            $this->sorter = new ListSorter('propoerty.sort', 'admin_module', $this->getUser(), array('rn_rpt_id', ListSorter::ASCENDING));
            $this->sorter->setSort(array($request->getParameter('sort'), $request->getParameter('order')));

            $this->searchMode = ($request->getParameter('cmbSearchMode') == '') ? 'all' : $request->getParameter('cmbSearchMode');
            $this->searchValue = ($request->getParameter('txtSearchValue') == '') ? '' : $request->getParameter('txtSearchValue');

            $this->sort = ($request->getParameter('sort') == '') ? 'rn_rpt_name' : $request->getParameter('sort');
            $this->order = ($request->getParameter('order') == '') ? 'ASC' : $request->getParameter('order');

            
            if ($request->isMethod('post')) {
                $this->reportLanguage = ($request->getParameter('cmbReportLanguage') == '') ? $this->userCulture : $request->getParameter('cmbReportLanguage');
            } else {
                $this->reportLanguage = ($request->getParameter('selectedLanguage') == '') ? $this->userCulture : $request->getParameter('selectedLanguage');
            }
            if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
                $user=$_SESSION['user'];
            }

            $result = $reportService->searchReport($this->searchMode, $this->searchValue, $this->userCulture, $request->getParameter('page'), $this->sort, $this->order, $user);

            $this->listReport = $result['data'];
            $this->pglay = $result['pglay'];
            $this->pglay->setTemplate('<a href="{%url}">{%page}</a>');
            $this->pglay->setSelectedTemplate('{%page}');

        } catch (sfStopException $sf) {

        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('default/error');
        }
    }

    /**
     * View report data
     * @param sfWebRequest $request
     * @return unknown_type
     */
    public function executeViewReportData(sfWebRequest $request) {
        try {
            $sysConf = OrangeConfig::getInstance()->getSysConf();
            $reportServerPath = $sysConf->getReportServerPath();
            $valid=0;
            $repPath = $request->getParameter('__report');
            $repLanguage = $request->getParameter('reportLanguage');
            $id = $request->getParameter('id');

            if(isset($_SESSION['empNumber']) && !empty($_SESSION['empNumber'])) {
                $user=$_SESSION['empNumber'];
            }
            if($_SESSION['user']!='USR001'){
            $reportDao= new ReportDao();
            $reports=$reportDao->ReportAccess($user);
            foreach($reports as $report){
                if( $report['rn_rpt_id']== $id && $report['rn_rpt_path']== $repPath){
                    $valid=1;
                    break;
                }
            }
            }else{
                $valid=1;
            }
            
            $currentDate = getdate();
            $hour = $currentDate[hours];

            $securityToken = md5($repPath.$user.$hour);
            setcookie('report_security',$securityToken,0,'/');

            // Redirect browser
            $this->dest = $reportServerPath."/frameset?__report=".urlencode($repPath);
            $this->dest .= "&__showtitle=false";
            $this->dest .= "&__locale=".$repLanguage;
            $this->dest .= "&__user=" . urlencode($user);
            if($valid==1){
            header("Location: $this->dest" );
            }else{
                $this->redirect('default/accessDenied');
            }

        } catch (sfStopException $sf) {

        } catch (Exception $e) {
            $errMsg = new CommonException($e->getMessage(), $e->getCode());
            $this->setMessage('WARNING', $errMsg->display());
            $this->redirect('default/error');
        }
    }



    public function setMessage( $messageType , $message = array(),$persist=false) {
        $this->getUser()->setFlash('messageType', $messageType);
        $this->getUser()->setFlash('message', $message);
    }

    /**
     * Set's the current page number in the user session.
     * @param $page int Page Number
     * @return None
     */
    protected function setPage($page) {
        $this->getUser()->setAttribute('report.page', $page, 'report_module');
    }

    /**
     * Get the current page number from the user session.
     * @return int Page number
     */
    protected function getPage() {
        return $this->getUser()->getAttribute('report.page', 1, 'report_module');
    }

}
