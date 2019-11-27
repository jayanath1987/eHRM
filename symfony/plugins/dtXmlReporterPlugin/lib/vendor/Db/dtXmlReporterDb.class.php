<?php
/*
 * This file is part of the dtXmlReporter package.
 * (c) 2009 Daniel Leech <dan@xmlreporter.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * dtXmlReporterDb
 * DB abstraction for dtXmlReporter
 *
 * @package dtXmlReporter
 * @author Daniel Leech <xmlreporter@dantleech.com>
 */
class dtXmlReporterDb
{
  /**
   * Key => Connection array of connection objects
   */
  static public $connections = array();

  static public $default_connection = 'default';

  static public $connection_strategy = 'default';

  /**
   * Initializes the connections
   */
  public static function init()
  {
    $strategy_name = 'dtXmlReporterDbConnectionStrategy_'.self::$connection_strategy;

    if (!class_exists($strategy_name))
    {
      throw new dtXmlReporterDbException(sprintf('Cannot instantiate connection strategy "%s". Class not found.', $strategy_name));
    }
    
    $strategy = new $strategy_name;
    $strategy -> init();
  }

  /**
   * Return a SimpleXML result set from given query
   * @param string $query_string
   */
  public static function resultSetFromQuery($query_string, $connection = null, SimpleXMLElement $result_set = null)
  {
    $query = self::executeSql($query_string, $connection);

    $results = $query -> fetchAll(PDO::FETCH_ASSOC);
    
    if (is_null($result_set))
    {
      $result_set = new SimpleXMLElement('<resultset/>');
    }
    
    foreach ($results as $row)
    {
      $simple_xml_row = $result_set -> addChild('row');
      foreach ($row as $field => $value)
      {
        $value = htmlspecialchars($value);
        $child = $simple_xml_row -> addChild('field', $value);
        $child -> addAttribute('name', $field);
      }
    }
    
    return $result_set;
  }
  
  public static function executeSql($query_string, $connection_name = null)
  {
    self::init();

    static $query_count = 0;

    if (!$connection_name)
      $connection_name = self::$default_connection;

    if (!array_key_exists($connection_name, self::$connections))
      throw new Exception('No connection with name "'.$connection_name.'" has been registered');
    
    $pdo = self::$connections[$connection_name]->getPdo();
    
    if (!$query = $pdo->prepare($query_string))
{
throw new dtXmlReporterDbException('Could not prepare query ('.$query_string.'). Error: '.print_r($pdo -> errorInfo(), true));
}
    
    if (!$query -> execute())
      throw new dtXmlReporterDbException(sprintf('Could not execute query [%s], "%s"', $query_string, print_r($query->errorInfo(), true)));
    
    if (dtXmlReporter::$query_logging_enabled)
    {
      dtXmlReporter::log('dt_xml_reporter_query.log', '#'.$query_count.' : '.$query_string."\n\n");
    }

    $query_count++;

    return $query;
  }

}
?>
