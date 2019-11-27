<?php
/*
 * This file is part of the dtXmlReporter package.
 * (c) 2009 Daniel Leech <dan@xmlreporter.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Connection strategy for Propel
 *
 * These classes enable the connection/s to be inferred from an existing
 * database abstraction, e.g. Propel, Doctrine or custom config.
 *
 * @author Daniel Leech <dan@dantleech.com>
 * @package dtXmlReporter
 */
class dtXmlReporterDbConnectionStrategy_propel12
{
  public function init()
  {
    $propel_config = Propel::getConfiguration();

    foreach ($propel_config['datasources'] as $name => $datasource)
    {
      $connection_array = $datasource['connection'];
      $connection = new dtXmlReporterDbConnection;
      $connection -> db_host = $connection_array['hostspec'];
      $connection -> db_name = $connection_array['database'];
      $connection -> db_pass = $connection_array['password'];
      $connection -> db_user = $connection_array['username'];

      dtXmlReporterDb::$connections[$name] = $connection;
    }
  }
}
