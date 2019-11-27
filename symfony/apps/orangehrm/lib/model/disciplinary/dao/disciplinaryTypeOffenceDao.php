<?php
/**
 * -------------------------------------------------------------------------------------------------------
 *  Author    - Jayanath Liyanage
 *  On (Date) - 21 June 2011
 *  Comments  - Employee Disciplinary
 *  Version   - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 * */

class DisciplinaryTypeOffenceDao extends BaseDao {

    
    public function saveActiontype(DisciplinaryActionType $disaction) {



        $disaction->save();

        return true;
    }

    

        public function getCurrentActiontypes($id) {


        $query = Doctrine_Query::create()
                        ->from('Incidents i')
                        ->where('i.dis_inc_id = ?', $id);
        return $query->fetchArray();
    }

    public function readActiontype($id) {

        return Doctrine::getTable('DisciplinaryActionType')->find($id);
    }

        public function getLastActiontype() {

        $query= Doctrine_Query::create()
                        ->select('MAX(dis_acttype_id)')
                        ->from('DisciplinaryActionType d');
        return $query->fetchArray();
    }

       
    public function saveOffence(Offence $offence) {



        $offence->save();

        return true;
    }
    public function updateOffence($request,$dOffence){
            $dOffence->setDis_acttype_id($request->getParameter('cmbActiontype'));

                if (strlen($request->getParameter('txtOffence'))) {

                    $dOffence->setDis_offence_name(trim($request->getParameter('txtOffence')));
                } else {
                    $dOffence->setDis_offence_name(null);
                }
                if (strlen($request->getParameter('txtOffencesi'))) {
                    $dOffence->setDis_offence_name_si(trim($request->getParameter('txtOffencesi')));
                } else {
                    $dOffence->setDis_offence_name_si(null);
                }
                if (strlen($request->getParameter('txtOffenceta'))) {
                    $dOffence->setDis_offence_name_ta(trim($request->getParameter('txtOffenceta')));
                } else {
                    $dOffence->setDis_offence_name_ta(null);
                }
              return  $dOffence->save();

        
    }

        public function getLastoffecnce() {

        $query= Doctrine_Query::create()
                        ->select('MAX(dis_offence_id)')
                        ->from('Offence o');
        return $query->fetchArray();
    }

        public function readOffence($id) {

        return Doctrine::getTable('Offence')->find($id);
    }

        public function deleteOffence($id) {



        $query = Doctrine_Query::create()
                        ->delete('Offence')
                        ->where('dis_offence_id=' . $id);

        $numDeleted = $query->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

        public function getActiontypes() {
        $query = Doctrine_Query::create()
                        ->from('DisciplinaryActionType d');
        return $query->execute();
    }

    

        public function saveFinalAction(DisiplinaryFinalAction $DisiplinaryFinalAction) {

        $DisiplinaryFinalAction->save();
        return true;
    }

        public function readFinalAction($id) {

        return Doctrine::getTable('DisiplinaryFinalAction')->find($id);
    }

    public function deleteFinalAction($id) {

        $query = Doctrine_Query::create()
                        ->delete('DisiplinaryFinalAction')
                        ->where('dis_fna_code=' . $id);

        $numDeleted = $query->execute();
        if ($numDeleted > 0) {
            return true;
        }
        return false;
    }

    public function getFinalActiontypes() {
        $query = Doctrine_Query::create()
                        ->select('d.*')
                        ->from('DisiplinaryFinalAction d');
        return $query->execute();
    }
    
        public function getFinalActiontypesfiltered($type) {
        $query= Doctrine_Query::create()
                        ->select('d.*')
                        ->from('DisiplinaryFinalAction d')
                        ->where('d.dis_fna_type=' . $type);
        return $query->execute();
    }
    
    
public function searchFinalAction($searchMode, $searchValue, $culture="en", $orderField = 'b.dis_fna_code', $orderBy = 'ASC', $page = 1) {
        if ($searchMode == "dis_fna_name_") {
            if ($culture == "en")
                $feildName = "b.dis_fna_name";
            else
                $feildName="b.dis_fna_name_" . $culture;
        }
        $q = Doctrine_Query::create()
                        ->select('b.*')
                        ->from('DisiplinaryFinalAction b');

        if ($searchValue != "") {
            $q->where($feildName . ' LIKE ?', '%' . trim($searchValue) . '%');
        }
        $q->orderBy($orderField . ' ' . $orderBy);


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
    
}

?>
