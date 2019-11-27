<?php


class AttendanceProcessTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'propel'),
      // add your own options here
    )); 

    $this->namespace        = '';
    $this->name             = 'AttendanceProcess';
    $this->briefDescription = '';
    $this->detailedDescription = <<<EOF
The [AttendanceProcess|INFO] task does things.
Call it with:

  [php symfony AttendanceProcess|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
   
        $databaseManager = new sfDatabaseManager(sfProjectConfiguration::getApplicationConfiguration('orangehrm', 'prod', true));
        $connection = $databaseManager->getDatabase("doctrine")->getConnection();
        $conn = Doctrine_Manager::getInstance()->connection($connection);
        $connection = Doctrine_Manager::getInstance()->connection();
        
        
    // add your code here
        
    $attendanceDao = new attendanceDao();
    
            $data = $attendanceDao->filterdata(); //read data statues 0

            $abc = null;
            foreach ($data as $row) {
                $attendanceDao = new attendanceDao();


                $selectdata = $attendanceDao->getAttendanceminmaxdata($row['clk_date'], $row['clk_no']); //find min & max
                $timeStamp = strtotime($row['clk_date']); //find Day
                $day = getdate($timeStamp);
                $attendanceDao = new attendanceDao();
                $wdt = $attendanceDao->getdaydata($day['weekday']); //find Day in & out time
                $timerin = strtotime($wdt[0][adt_intime]);
                $timeuin = strtotime($selectdata[0]['MIN']);

                $x = $timeuin - $timerin;
                if ($x > 0) {
                    $latetimeHHn = (int) ($x / 3600);
                    $k = ($x % 3600);
                    $latetimeMMn = (int) ($k / 60);
                    $m = $k % 60;
                    $latetimeSSn = (int) ($m / 1);


                    if (!strlen($latetimeHHn)) {
                        $latetimeHHn = '00';
                    } else if (strlen($latetimeHHn) == 1) {
                        $latetimeHHn = '0' . $latetimeHHn;
                    }
                    if (!strlen($latetimeMMn)) {
                        $latetimeMMn = '00';
                    } else if (strlen($latetimeMMn) == 1) {
                        $latetimeMMn = '0' . $latetimeMMn;
                    }
                    if (!strlen($latetimeSSn)) {
                        $latetimeSSn = '00';
                    } else if (strlen($latetimeSSn) == 1) {
                        $latetimeSSn = '0' . $latetimeSSn;
                    }
                    $latetime = $latetimeHHn . ":" . $latetimeMMn . ":" . $latetimeSSn;
                } else {
                    $latetime = "00:00:00";
                }
                $timerout = strtotime($wdt[0][adt_outtime]);
                $timeuout = strtotime($selectdata[0]['MAX']);

                $y = $timerout - $timeuout;
                if ($y > 0) {

                    $earlytimeHHn = (int) ($y / 3600);
                    $l = ($y % 3600);
                    $earlytimeMMn = (int) ($l / 60);
                    $n = $l % 60;
                    $earlytimeSSn = (int) ($n / 1);

                    if (!strlen($earlytimeHHn)) {
                        $earlytimeHHn = '00';
                    } else if (strlen($earlytimeHHn) == 1) {
                        $earlytimeHHn = '0' . $earlytimeHHn;
                    }
                    if (!strlen($earlytimeMMn)) {
                        $earlytimeMMn = '00';
                    } else if (strlen($earlytimeMMn) == 1) {
                        $earlytimeMMn = '0' . $earlytimeMMn;
                    }
                    if (!strlen($earlytimeSSn)) {
                        $earlytimeSSn = '00';
                    } else if (strlen($earlytimeSSn) == 1) {
                        $earlytimeSSn = '0' . $earlytimeSSn;
                    }
                    $earlytime = $earlytimeHHn . ":" . $earlytimeMMn . ":" . $earlytimeSSn;
                } else {
                    $earlytime = "00:00:00";
                }
                //read employee
                $empno = $attendanceDao->reademp($row['clk_no']);
                if (strlen($empno[0]['empNumber'])) {
                    //insert row
                    $dailyatten = new Attendance();
                    $attendanceDao = new attendanceDao();
                    $dailyatten->setClk_no($row['clk_no']);
                    $dailyatten->setEmp_number($empno[0]['empNumber']);
                    $dailyatten->setAtn_date($row['clk_date']);
                    $dailyatten->setAtn_intime($selectdata[0]['MIN']);
                    $dailyatten->setAtn_outtime($selectdata[0]['MAX']);
                    $dailyatten->setAtn_latetime($latetime);
                    $dailyatten->setAtn_earlydeptime($earlytime);
                    $dailyatten->setDt_id($wdt[0]['dt_id']);

                    try {
//beging transactions
                        $conn = Doctrine_Manager::getInstance()->connection();
                        $conn->beginTransaction();
                        $dd = $attendanceDao->Rreadaattnup($row['clk_no'], $row['clk_date'], $empno[0]['empNumber']);
                        if ($dd[0]['COUNT'] == 0) {
                            $abc = $attendanceDao->saveAttandance($dailyatten);
                        } else {
                            $dailyatten = new Attendance();
                            $dailyatten = $attendanceDao->readaattnup2($row['clk_no'], $row['clk_date'], $empno[0]['empNumber']);
                            $dailyatten->setAtn_intime($selectdata[0]['MIN']);
                            $dailyatten->setAtn_outtime($selectdata[0]['MAX']);
                            $dailyatten->setAtn_latetime($latetime);
                            $dailyatten->setAtn_earlydeptime($earlytime);
                            $dailyatten->setDt_id($wdt[0]['dt_id']);
                            
                            $datetime1 = new DateTime($selectdata[0]['MAX']);
                            $datetime2 = new DateTime($selectdata[0]['MIN']);
                            $interval = $datetime1->diff($datetime2);

                            $hours   = $interval->format('%h');
                            $minutes = $interval->format('%i');
                            if($hours < 10){
                                $hours="0".$hours;
                            }
                            if($minutes < 10){
                                $minutes="0".$minutes;
                            }

                            //echo $hours .":".$minutes;
                            
                            
                            $dailyatten->setAtn_work_hours($hours .":".$minutes);
                            $abc = $attendanceDao->saveAttandance($dailyatten);
                        }
                        //update clock statues
                        $clck = new AttendanceClockDetails();
                        $atncDao = new attendanceDao();
                        $clck = 1;

                        $abc = $atncDao->updateclk($row['clk_no'], $row['clk_date'], $clck);
                        $conn->commit();
                    } catch (Exception $e) {
                        $conn->rollBack();
                        $errMsg = new CommonException($e->getMessage(), $e->getCode());
                        $this->setMessage('WARNING', $errMsg->display());
                        $this->redirect('attendance/Text');
                    }
                }
            }
    
  }
}
