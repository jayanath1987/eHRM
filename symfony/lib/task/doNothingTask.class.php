<?php

class doNothingTask extends sfBaseTask {

    protected function configure() {
        // // add your own arguments here
        // $this->addArguments(array(
        //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
        // ));

        $this->addOptions(array(
            new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
            new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
            new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
                // add your own options here
        ));

        $this->namespace = '';
        $this->name = 'doNothing';
        $this->briefDescription = '';
        $this->detailedDescription = <<<EOF
The [doNothing|INFO] task does things.
Call it with:

  [php symfony doNothing|INFO]
EOF;
    }

    protected function execute($arguments = array(), $options = array()) {
        // initialize the database connection


        $databaseManager = new sfDatabaseManager(sfProjectConfiguration::getApplicationConfiguration('orangehrm', 'prod', true));
        $connection = $databaseManager->getDatabase("doctrine")->getConnection();
        $conn = Doctrine_Manager::getInstance()->connection($connection);

        //$empDao=new EmployeeDao();





        for ($i = 0; $i < 300; $i++) {

            $stmt = $conn->prepare("insert into test_process (value) values(100)");

            $stmt->execute();

        }



      
    }

}
