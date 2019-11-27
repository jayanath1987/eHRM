<?php
/*
 * This file is part of the dtXmlReporter package.
 * (c) 2009 Daniel Leech <dan@xmlreporter.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * dtXmlReporterDbConnection
 * Represents a DB connection
 *
 * @package dtXmlReporter
 * @author Daniel Leech <xmlreporter@dantleech.com>
 */
class dtXmlReporterDbConnection
{
  // too lazy now to put in get / sets
  public $db_name = null;
  public $db_host = null;
  public $db_user = null;
  public $db_pass = null;
  
  public function getPdo()
  {
    $pdo = new PDO(sprintf('mysql:dbname=%s;host=%s', $this->db_name, $this->db_host), $this->db_user, $this->db_pass);
    return $pdo;
  }
}
?>
