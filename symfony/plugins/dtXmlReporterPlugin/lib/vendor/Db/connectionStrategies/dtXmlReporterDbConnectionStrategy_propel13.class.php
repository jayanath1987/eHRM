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
class dtXmlReporterDbConnectionStrategy_propel13
{
  public function init()
  {
    $propel_config = Propel::getConfiguration();
    
    foreach ($propel_config['datasources'] as $name => $datasource)
    {
      if (is_array($datasource))
      {
        $connection_array = $datasource['connection'];
        $dsn = $connection_array['dsn'];
        
        preg_match('&dbname=(.*?);&', $dsn, $matches);
        
        if (!$dbname = $matches[1])
        {
          throw new dtXmlReporterDbException('Could not get dbname from DSN ('.$dsn.')');
        }

        preg_match('&host=(.*?)$&', $dsn, $matches);
        if (!$host = $matches[1])
        {
          throw new dtXmlReporterDbException('Could not get HOST from DSN ('.$dsn.')');
        }
        $connection = new dtXmlReporterDbConnection;
        $connection -> db_host = $host;
        $connection -> db_name = $dbname;
        $connection -> db_pass = $connection_array['password'];
        $connection -> db_user = $connection_array['user'];

        dtXmlReporterDb::$connections[$name] = $connection;
      }
    }
  }
}
