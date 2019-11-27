<?php

require_once 'PHPUnit/Framework.php';

define('ROOT_PATH', dirname(__FILE__) . '/../../');
define('SF_APP_NAME', 'orangehrm');
define('SF_ENV', 'test');
define('SF_CONN', 'doctrine');

if (SF_APP_NAME != '') {
    require_once(dirname(__FILE__) . '/../config/ProjectConfiguration.class.php');
    AllTests::$configuration = ProjectConfiguration::getApplicationConfiguration(SF_APP_NAME, SF_ENV, true);
    sfContext::createInstance(AllTests::$configuration);
}

class AllTests {

    public static $configuration = null;
    public static $databaseManager = null;
    public static $connection = null;

    protected function setUp() {

        if (self::$configuration) {
            // initialize database manager
            self::$databaseManager = new sfDatabaseManager(self::$configuration);
            self::$databaseManager->loadConfiguration();

            if (SF_CONN != '')
                self::$connection = self::$databaseManager->getDatabase(SF_CONN);
        }
    }

    public static function suite() {
        $suite = new PHPUnit_Framework_TestSuite('PHPUnit');

        // execute action unit tests

        /*
          $coredir = new DirectoryIterator(dirname(__FILE__). '/actions');
          while ($coredir->valid()) {
          if (strpos( $coredir, 'Test.php' ) !== false) {
          $suite->addTestFile(  dirname(__FILE__). '/actions/'. $coredir );
          }
          $coredir->next();
          }
         */

        /*
          //execute core service classes
          $coredir = new DirectoryIterator( dirname(__FILE__). '/model/core/service' );
          while($coredir->valid()) {
          if( strpos( $coredir, 'Test.php' ) !== false ) {
          $suite->addTestFile(  dirname(__FILE__). '/model/core/service/'. $coredir );

          }
          $coredir->next();
          }
         */
        /*
          //ADMIN Latest test case
          $dir = new DirectoryIterator( dirname(__FILE__). '/model/admin/dao/' );
          while($dir->valid()) {
          if( strpos( $dir, 'adminDaoTest.php' ) !== false ) {

          $suite->addTestFile(  dirname(__FILE__). '/model/admin/dao/'. $dir );

          }
          $dir->next();
          }

          ////PIM Latest test case
          $dir = new DirectoryIterator( dirname(__FILE__). '/model/pim/dao/' );
          while($dir->valid()) {
          if( strpos( $dir, 'pimDaoTest.php' ) !== false ) {

          $suite->addTestFile(  dirname(__FILE__). '/model/pim/dao/'. $dir );

          }
          $dir->next();
          }




         */


        //Execute Admin Dao class
        /*  	  $dir = new DirectoryIterator( dirname(__FILE__). '/model/admin/dao' );
          while($dir->valid()) {
          if( strpos( $dir, 'Test.php' ) !== false ) {
          $suite->addTestFile(  dirname(__FILE__). '/model/admin/dao/'. $dir );

          }
          $dir->next();
          }

          //Execute Admin service class
          $dir = new DirectoryIterator( dirname(__FILE__). '/model/admin/service' );
          while($dir->valid()) {
          if( strpos( $dir, 'Test.php' ) !== false ) {
          $suite->addTestFile(  dirname(__FILE__). '/model/admin/service/'. $dir );

          }
          $dir->next();
          } */

        /*
          //Execute PIM DAO class
          $dir = new DirectoryIterator( dirname(__FILE__). '/model/pim/dao' );
          while($dir->valid()) {
          if( strpos( $dir, 'Test.php' ) !== false ) {
          $suite->addTestFile(  dirname(__FILE__). '/model/pim/dao/'. $dir );

          }
          $dir->next();
          }

          //Execute PIM Service  class
          $dir = new DirectoryIterator( dirname(__FILE__). '/model/pim/service' );
          while($dir->valid()) {
          if( strpos( $dir, 'Test.php' ) !== false ) {
          $suite->addTestFile(  dirname(__FILE__). '/model/pim/service/'. $dir );

          }
          $dir->next();
          }

          //Execute report service class
          $dir = new DirectoryIterator( dirname(__FILE__). '/model/report/service' );
          while($dir->valid()) {
          if( strpos( $dir, 'Test.php' ) !== false ) {
          $suite->addTestFile(  dirname(__FILE__). '/model/report/service/'. $dir );

          }
          $dir->next();
          }

          //Execute ReportDao class
          $dir = new DirectoryIterator( dirname(__FILE__). '/model/report/dao' );
          while($dir->valid()) {
          if( strpos( $dir, 'Test.php' ) !== false ) {
          $suite->addTestFile(  dirname(__FILE__). '/model/report/dao/'. $dir );

          }
          $dir->next();
          }

          //Execute leave service class
          $dir = new DirectoryIterator( dirname(__FILE__). '/model/leave/dao' );
          while($dir->valid()) {
          if( strpos( $dir, 'Test.php' ) !== false ) {

          $suite->addTestFile(  dirname(__FILE__). '/model/leave/dao/'. $dir );

          }
          $dir->next();
          }

          //Execute leave service class
          $dir = new DirectoryIterator( dirname(__FILE__). '/model/leave/service' );
          while($dir->valid()) {
          if( strpos( $dir, 'Test.php' ) !== false ) {

          $suite->addTestFile(  dirname(__FILE__). '/model/leave/service/'. $dir );

          }
          $dir->next();
          }

          //Execute leave service class
          $dir = new DirectoryIterator( dirname(__FILE__). '/model/leave/entity' );
          while($dir->valid()) {
          if( strpos( $dir, 'Test.php' ) !== false ) {

          $suite->addTestFile(  dirname(__FILE__). '/model/leave/entity/'. $dir );

          }
          $dir->next();
          }

          //Execute leave rule class
          $dir = new DirectoryIterator( dirname(__FILE__). '/model/leave/rule' );
          while($dir->valid()) {
          if( strpos( $dir, 'Test.php' ) !== false ) {

          $suite->addTestFile(  dirname(__FILE__). '/model/leave/rule/'. $dir );

          }
          $dir->next();
          } */

        /*
          //Transfer Module
          $dir = new DirectoryIterator( dirname(__FILE__). '/model/transfer/dao/' );
          while($dir->valid()) {
          if( strpos( $dir, 'Test.php' ) !== false ) {

          $suite->addTestFile(  dirname(__FILE__). '/model/transfer/dao/'. $dir );

          }
          $dir->next();
          }


          //traing module
          $dir = new DirectoryIterator( dirname(__FILE__). '/model/training/dao/' );
          while($dir->valid()) {
          if( strpos( $dir, 'Test.php' ) !== false ) {

          $suite->addTestFile(  dirname(__FILE__). '/model/training/dao/'. $dir );

          }
          $dir->next();
          }
         */
//            //Promotion Module
//                $dir = new DirectoryIterator( dirname(__FILE__). '/model/promotion/dao/' );
//        while($dir->valid()) {
//            if( strpos( $dir, 'Test.php' ) !== false ) {
//
//                $suite->addTestFile(  dirname(__FILE__). '/model/promotion/dao/'. $dir );
//
//            }
//            $dir->next();
//        }
//        //retirement
//        $dir = new DirectoryIterator( dirname(__FILE__). '/model/retirement/dao/' );
//        while($dir->valid()) {
//            if( strpos( $dir, 'Test.php' ) !== false ) {
//
//                $suite->addTestFile(  dirname(__FILE__). '/model/retirement/dao/'. $dir );
//
//            }
//            $dir->next();
//        }
//
//         //knw
//        $dir = new DirectoryIterator( dirname(__FILE__). '/model/knw/dao/' );
//        while($dir->valid()) {
//            if( strpos( $dir, 'Test.php' ) !== false ) {
//
//                $suite->addTestFile(  dirname(__FILE__). '/model/knw/dao/'. $dir );
//
//            }
//            $dir->next();
//        }
//
// //wbm
//        $dir = new DirectoryIterator( dirname(__FILE__). '/model/wbm/dao/' );
//        while($dir->valid()) {
//            if( strpos( $dir, 'Test.php' ) !== false ) {
//
//                $suite->addTestFile(  dirname(__FILE__). '/model/wbm/dao/'. $dir );
//
//            }
//            $dir->next();
//        }
//
//         //Attendance
//        $dir = new DirectoryIterator( dirname(__FILE__). '/model/attendance/dao/' );
//        while($dir->valid()) {
//            if( strpos( $dir, 'Test.php' ) !== false ) {
//
//                $suite->addTestFile(  dirname(__FILE__). '/model/attendance/dao/'. $dir );
//
//            }
//            $dir->next();
//        }


        /*

          //disciplinary module

          $dir = new DirectoryIterator( dirname(__FILE__). '/model/disciplinary/dao/' );
          while($dir->valid()) {
          if( strpos( $dir, 'Test.php' ) !== false ) {

          $suite->addTestFile(  dirname(__FILE__). '/model/disciplinary/dao/'. $dir );

          }
          $dir->next();
          }
          ////Admin Delete Test
          $dir = new DirectoryIterator( dirname(__FILE__). '/model/' );
          while($dir->valid()) {
          if( strpos( $dir, 'deleteAdminDaoTest.php' ) !== false ) {

          $suite->addTestFile(  dirname(__FILE__). '/model/'. $dir );

          }
          $dir->next();
          }
         */


//        //Leave module
//
//        $dir = new DirectoryIterator(dirname(__FILE__) . '/model/Leave/dao/');
//        while ($dir->valid()) {
//            if (strpos($dir, 'LeaveDaoTest.php') !== false) {
//
//                $suite->addTestFile(dirname(__FILE__) . '/model/Leave/dao/' . $dir);
//            }
//            $dir->next();
//        }

//Performance module

        $dir = new DirectoryIterator(dirname(__FILE__) . '/model/performance/dao/');
        while ($dir->valid()) {
            if (strpos($dir, 'PerformanceDaoTest.php') !== false) {

                $suite->addTestFile(dirname(__FILE__) . '/model/performance/dao/' . $dir);
            }
            $dir->next();
        }


        // $suite->addTestFile(  dirname(__FILE__). '/model/performance/service/EmailServiceTest.php' );
        return $suite;
    }

}
