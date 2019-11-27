<?php

class payProcessEmployeeTask extends sfBaseTask {

    protected function configure() {
        // // add your own arguments here
        $this->addArguments(array(
            new sfCommandArgument('EmpList', sfCommandArgument::REQUIRED, 'My argument'),
        ));
        $this->addArguments(array(
            new sfCommandArgument('startDate', sfCommandArgument::REQUIRED, 'startDate'),
        ));
        $this->addArguments(array(
            new sfCommandArgument('endDate', sfCommandArgument::REQUIRED, 'endDate'),
        ));
         $this->addArguments(array(
            new sfCommandArgument('batchId', sfCommandArgument::REQUIRED, 'batchId'),
        ));
         $this->addArguments(array(
            new sfCommandArgument('pro_user', sfCommandArgument::REQUIRED, 'pro_user'),
        ));
         $this->addArguments(array(
            new sfCommandArgument('prltype', sfCommandArgument::REQUIRED, 'prltype'),
        ));

        $this->addOptions(array(
            new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
            new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
            new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'propel'),
                // add your own options here
        ));

        $this->namespace = 'payProcess';
        $this->name = 'employee';
        $this->briefDescription = '';
        $this->detailedDescription = <<<EOF
The [payProcess:employee|INFO] task does things.
Call it with:

  [php symfony payProcess:employee|INFO]
EOF;
    }

    protected function execute($arguments = array(), $options = array()) {
        // initialize the database connection

       

        $databaseManager = new sfDatabaseManager(sfProjectConfiguration::getApplicationConfiguration('orangehrm', 'prod', true));
        $connection = $databaseManager->getDatabase("doctrine")->getConnection();

        $connection = Doctrine_Manager::getInstance()->connection();

        //echo $arguments['startDate'];
//        $stmt = $connection->prepare("");
//        $stmt->execute();
//   //print_r($arguments['EmpList'][2]);
        $pieces = explode(",", $arguments['EmpList']);

//        for ($i = 0; $i < 2000; $i++) {
//            $insertSql = "INSERT INTO  test_process (value)
//                           VALUES ('$i');";
//
//            $stmtInsert = $connection->prepare("$insertSql");
//            $stmtInsert->execute();
//        }
        
        //JBLProgressbar insert
        $DeleteSql="DELETE FROM hs_pr_progressbar_status WHERE pb_startdate LIKE '{$arguments['startDate']}' AND pb_user = '{$arguments['pro_user']}' AND prl_type_code = '{$arguments['prltype']}'";
        $st = $connection->prepare("$DeleteSql");
        $st->execute();
                    
        $employeeTot=count($pieces);
        $prsdate=date("Ymd");
         $ProgressSql = "INSERT INTO hs_pr_progressbar_status (pb_user, pb_startdate, pb_enddate
                            ,pb_emp_total_count, prl_type_code, pb_processtime, pb_emp_remain_count, pb_status)
                            VALUES ('{$arguments['pro_user']}','{$arguments['startDate']}', '{$arguments['endDate']}', '{$employeeTot}', '{$arguments['prltype']}', '{$prsdate}','{$employeeTot}','0');";

                    $st1 = $connection->prepare("$ProgressSql");
                    $st1->execute();
        //End JBLProgressBar
        for ($i = 0; $i < count($pieces); $i++) {
            $j=$i+1;
            $grosssalary = 0;
            $netPay = 0;


            $stmtSp = $connection->prepare(" call spinitaliseemployeepaydetails('{$arguments['startDate']}','{$arguments['endDate']}',$pieces[$i]);");
            $stmtSp->execute();
            $stmtSp = $connection->prepare(" call spprocesstransactions('{$arguments['startDate']}','{$arguments['endDate']}',$pieces[$i]);");
            $stmtSp->execute();
           
           
            $lastPayQuery="select MAX(pay_sch_st_date) as fromDate,MAX(pay_sch_end_date) as endDate from hs_pr_pay_schedule where pay_sch_disabled_flg=1 and pay_hie_code={$arguments['batchId']}";
            $stmtlp = $connection->prepare("$lastPayQuery");
            $stmtlp->execute();
            while ($LPdetails = $stmtlp->fetch()) {
               
                $lastPLfromDate=$LPdetails['fromDate'];
             
                $lastPLtoDate=$LPdetails['endDate'];
            }

            
            $sql = "SELECT e.trn_dtl_code,d.trn_dtl_formula
                  FROM hs_pr_txn_eligibility e
                  left join hs_pr_transaction_details d on e.trn_dtl_code=d.trn_dtl_code
                  left join hs_pr_transaction_type t on d.trn_typ_code=t.trn_typ_code                  
                  where d.trn_dtl_isbasetxn_flg=1
                  and e.emp_number={$pieces[$i]} and tre_stop_flag=0";

            $stmt = $connection->prepare("$sql");
            $stmt->execute();

            while ($row = $stmt->fetch()) {
                $detailCode = $row['trn_dtl_code'];
                $formula = $row['trn_dtl_formula'];
                

                 
                $query1 = "select getBaseTransGrossPrev( $detailCode,'{$lastPLfromDate}','{$lastPLtoDate}',{$pieces[$i]} )+getBaseTransGross( $detailCode,'{$lastPLfromDate}','{$lastPLtoDate}',{$pieces[$i]} )   as totamount";
                        
                        
                  

               


                $stmt1 = $connection->prepare("$query1");
                $stmt1->execute();
                while ($row1 = $stmt1->fetch()) {
                    $totamount = $row1['totamount'];
                   
                    $replaceWord = str_replace("txnword", $totamount, $formula);

                    $treAmount = eval('return ' . $replaceWord . ';');
                    $insertSql = "INSERT INTO hs_pr_processedtxn (trn_startdate, trn_enddate, trn_dtl_code
                            ,emp_number, trn_proc_emp_amt, trn_proc_eyr_amt, trn_ytd_amount, trn_contribution
                            ,trn_hourswkd, dbgroup_user_id, trn_proc_emp_fullamt, trn_ytd_eyr_amount)
                            VALUES ('{$arguments['startDate']}', '{$arguments['endDate']}', '{$detailCode}', '{$pieces[$i]}', '{$treAmount}', NULL, NULL, NULL, NULL, NULL, '{$treAmount}', NULL);";

                    $stmt2 = $connection->prepare("$insertSql");
                    $stmt2->execute();
                }
            }

            $stmtSp = $connection->prepare("call spprocesstxncontributions('{$arguments['startDate']}','{$arguments['endDate']}',$pieces[$i]);");
            $stmtSp->execute();
            $stmtSp = $connection->prepare(" call spprocessloans('{$arguments['startDate']}','{$arguments['endDate']}',$pieces[$i]);");
            $stmtSp->execute();
            $stmtSp = $connection->prepare(" call spprocessgrosssalary('{$arguments['startDate']}','{$arguments['endDate']}',$pieces[$i]);");
            $stmtSp->execute();
            while ($row = $stmtSp->fetch()) {
                $grosssalary = $row['grosssalary'];
            }
            unset($stmtSp);
            $stmtSNetPay = $connection->prepare("call spprocessnetpay('{$arguments['startDate']}','{$arguments['endDate']}','{$pieces[$i]}','{$grosssalary}');");
            $stmtSNetPay->execute();
            while ($row = $stmtSNetPay->fetch()) {
                $netPay = $row['netpay'];
            }
            unset($stmtSNetPay);
            $stmtSp = $connection->prepare(" set @var='';");
            $stmtSp->execute();
            $stmtSp = $connection->prepare("call spaddpayprocess('{$arguments['startDate']}','{$arguments['endDate']}','{$pieces[$i]}','{$grosssalary}','{$netPay}',@var);");
            $stmtSp->execute();
            $stmtSp = $connection->prepare("call spbanktransfer('{$arguments['startDate']}','{$arguments['endDate']}',$pieces[$i]);");
            $stmtSp->execute();

            if($netPay<0){
                $stmterror = $connection->prepare("call spPrException('{$arguments['startDate']}','{$arguments['endDate']}',$pieces[$i],'{$arguments['batchId']}','1');");
                $stmterror->execute();
            }
            else{
                $stmterror = $connection->prepare("call spPrException('{$arguments['startDate']}','{$arguments['endDate']}',$pieces[$i],'{$arguments['batchId']}','2');");
                $stmterror->execute();
            }

            $insertSql = "INSERT INTO  hs_pr_processedemp (pro_payfrequency, pro_startdate, pro_enddate
                            ,emp_number, pro_processed,pro_inserttime,pro_batch_id,pro_user)
                            VALUES ('1','{$arguments['startDate']}', '{$arguments['endDate']}', '{$pieces[$i]}', '1', NOW(),'{$arguments['batchId']}','{$arguments['pro_user']}');";

            $stmtInsert = $connection->prepare("$insertSql");
            $stmtInsert->execute();

            $updateSql="UPDATE hs_pr_pay_schedule set pay_sch_processed_flg=1 where pay_sch_st_date='{$arguments['startDate']}' and pay_sch_end_date='{$arguments['endDate']}'";
             $stmtUpdate = $connection->prepare("$updateSql");
            $stmtUpdate->execute();


//        $stmt = $connection->prepare("INSERT INTO test_process (value) VALUES ('{$results}')");
//        $stmt->execute();
            
        //progress bar

            //echo $result="\n".$i."_". time();
            
            //JBLProgressbar update
             $updateProgressbarSql="UPDATE hs_pr_progressbar_status set pb_emp_remain_count= (pb_emp_remain_count-1)  WHERE pb_startdate LIKE '{$arguments['startDate']}' AND pb_user = '{$arguments['pro_user']}' AND prl_type_code = '{$arguments['prltype']}'";
             $st3 = $connection->prepare("$updateProgressbarSql");
             $st3->execute();
             if(count($pieces)==$j){
             $updateProgressbarSql2="UPDATE hs_pr_progressbar_status set pb_status= '1'  WHERE pb_startdate LIKE '{$arguments['startDate']}' AND pb_user = '{$arguments['pro_user']}' AND prl_type_code = '{$arguments['prltype']}'";
             $st4 = $connection->prepare("$updateProgressbarSql2");
             $st4->execute();    
             }
             
            //end update

        }
//        print $arguments['pro_user'].$arguments['startDate'].$arguments['endDate'].$employeeTot.$arguments['prltype']."_".  date("Ymd");
    }

}
